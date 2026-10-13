<?php

namespace Tests\Feature;

use App\Models\GalleryPhoto;
use App\Models\User;
use App\Services\ImageResizer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_large_photo_is_resized_to_max_2000px(): void
    {
        $path = ImageResizer::store(UploadedFile::fake()->image('foto.jpg', 4000, 3000), 'gallery');

        [$width, $height] = getimagesize(Storage::disk('public')->path($path));
        $this->assertSame([2000, 1500], [$width, $height]);
    }

    public function test_small_png_is_converted_to_jpeg_keeping_its_size(): void
    {
        $path = ImageResizer::store(UploadedFile::fake()->image('foto.png', 800, 600), 'gallery');

        $info = getimagesize(Storage::disk('public')->path($path));
        $this->assertSame([800, 600, 'image/jpeg'], [$info[0], $info[1], $info['mime']]);
        $this->assertStringEndsWith('.jpg', $path);
    }

    public function test_transparent_png_is_flattened_on_white(): void
    {
        $image = imagecreatetruecolor(10, 10);
        imagesavealpha($image, true);
        imagefill($image, 0, 0, imagecolorallocatealpha($image, 0, 0, 0, 127)); // tutto trasparente
        $source = tempnam(sys_get_temp_dir(), 'png');
        imagepng($image, $source);

        $jpeg = imagecreatefromstring(ImageResizer::standardize($source));
        $rgb = imagecolorsforindex($jpeg, imagecolorat($jpeg, 5, 5));

        $this->assertGreaterThan(245, $rgb['red']);
        $this->assertGreaterThan(245, $rgb['green']);
        $this->assertGreaterThan(245, $rgb['blue']);
    }

    public function test_phone_photo_is_rotated_by_exif_and_metadata_is_removed(): void
    {
        // JPEG 400x200 con EXIF Orientation=6: il telefono la mostra in verticale
        $source = $this->jpegWithExifOrientation(400, 200, 6);
        $this->assertSame(6, exif_read_data($source)['Orientation']);

        $output = ImageResizer::standardize($source);

        $target = tempnam(sys_get_temp_dir(), 'out');
        file_put_contents($target, $output);
        [$width, $height] = getimagesize($target);

        $this->assertSame([200, 400], [$width, $height]);
        $this->assertStringNotContainsString('Exif', $output);
    }

    public function test_standardize_command_converts_only_non_standard_images(): void
    {
        $disk = Storage::disk('public');

        // Foto vecchia caricata come PNG (non standard) e una già conforme
        $disk->putFileAs('gallery', UploadedFile::fake()->image('v.png', 3000, 2000), 'vecchia.png');
        $disk->putFileAs('gallery', UploadedFile::fake()->image('b.jpg', 800, 600), 'buona.jpg');
        $old = GalleryPhoto::create(['image_path' => 'gallery/vecchia.png', 'is_visible' => true]);
        $good = GalleryPhoto::create(['image_path' => 'gallery/buona.jpg', 'is_visible' => true]);

        $this->artisan('images:standardize')
            ->expectsOutputToContain('convertite: 1, già standard: 1')
            ->assertSuccessful();

        $old->refresh();
        $this->assertStringEndsWith('.jpg', $old->image_path);
        $disk->assertMissing('gallery/vecchia.png');
        [$width] = getimagesize($disk->path($old->image_path));
        $this->assertSame(2000, $width);
        $this->assertSame('gallery/buona.jpg', $good->fresh()->image_path);
    }

    private function jpegWithExifOrientation(int $width, int $height, int $orientation): string
    {
        $image = imagecreatetruecolor($width, $height);
        ob_start();
        imagejpeg($image);
        $jpeg = ob_get_clean();

        // Segmento APP1 minimo: header TIFF big-endian + una voce IFD (0x0112 Orientation)
        $tiff = "MM\x00\x2A\x00\x00\x00\x08"
            . "\x00\x01"
            . "\x01\x12\x00\x03\x00\x00\x00\x01" . pack('n', $orientation) . "\x00\x00"
            . "\x00\x00\x00\x00";
        $app1 = "Exif\x00\x00" . $tiff;
        $segment = "\xFF\xE1" . pack('n', strlen($app1) + 2) . $app1;

        $path = tempnam(sys_get_temp_dir(), 'jpg');
        file_put_contents($path, substr($jpeg, 0, 2) . $segment . substr($jpeg, 2));

        return $path;
    }

    public function test_admin_can_upload_phone_sized_photo_and_home_cache_is_cleared(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Cache::put('home.gallery_photos_preview', 'vecchio valore', 3600);

        $this->actingAs($admin)
            ->post(route('admin.gallery.store'), [
                'image' => UploadedFile::fake()->image('telefono.jpg', 4032, 3024),
                'title' => 'Festa',
                'is_visible' => '1',
            ])
            ->assertRedirect(route('admin.gallery.index'))
            ->assertSessionHasNoErrors();

        $photo = GalleryPhoto::firstOrFail();
        Storage::disk('public')->assertExists($photo->image_path);
        $this->assertFalse(Cache::has('home.gallery_photos_preview'));
    }

    public function test_replacing_post_cover_deletes_the_old_file(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $payload = [
            'title' => 'Una news di prova',
            'content' => str_repeat('Contenuto della news di prova. ', 3),
            'status' => 'published',
        ];

        $this->actingAs($admin)->post(route('admin.posts.store'), $payload + [
            'cover_image' => UploadedFile::fake()->image('prima.jpg', 1200, 675),
        ]);
        $post = \App\Models\Post::firstOrFail();
        $oldCover = $post->cover_image;

        $this->actingAs($admin)->put(route('admin.posts.update', $post), $payload + [
            'cover_image' => UploadedFile::fake()->image('seconda.jpg', 1200, 675),
        ]);

        Storage::disk('public')->assertMissing($oldCover);
        Storage::disk('public')->assertExists($post->fresh()->cover_image);
    }
}
