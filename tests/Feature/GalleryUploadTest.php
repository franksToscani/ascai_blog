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

    public function test_small_photo_is_stored_unchanged(): void
    {
        $path = ImageResizer::store(UploadedFile::fake()->image('foto.png', 800, 600), 'gallery');

        [$width, $height] = getimagesize(Storage::disk('public')->path($path));
        $this->assertSame([800, 600], [$width, $height]);
        $this->assertStringEndsWith('.png', $path);
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
