<?php

namespace Tests\Feature;

use App\Models\Album;
use App\Models\Event;
use App\Models\GalleryPhoto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryAlbumTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        $this->admin = User::factory()->create(['is_admin' => true]);
    }

    private function photo(?Album $album, array $attributes = []): GalleryPhoto
    {
        return GalleryPhoto::create($attributes + [
            'image_path' => 'gallery/' . uniqid() . '.jpg',
            'is_visible' => true,
            'published_at' => now(),
            'album_id' => $album?->id,
        ]);
    }

    public function test_creating_an_album_leads_to_the_upload_page(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.albums.store'), ['title' => 'Festa di Natale', 'date' => '2025-12-20', 'is_visible' => '1'])
            ->assertRedirect(route('admin.gallery.create', ['album' => Album::first()->id]));

        $this->assertDatabaseHas('albums', ['title' => 'Festa di Natale', 'slug' => 'festa-di-natale', 'is_visible' => true]);
    }

    public function test_multi_uploader_request_returns_json_and_creates_thumbnail_in_album(): void
    {
        $album = Album::create(['title' => 'Torneo', 'is_visible' => true]);

        $response = $this->actingAs($this->admin)
            ->postJson(route('admin.gallery.store'), [
                'image' => UploadedFile::fake()->image('foto.jpg', 3000, 2000),
                'album_id' => $album->id,
                'is_visible' => '1',
            ])
            ->assertCreated()
            ->assertJsonStructure(['id', 'thumb_url']);

        $photo = GalleryPhoto::findOrFail($response->json('id'));
        $this->assertSame($album->id, $photo->album_id);
        Storage::disk('public')->assertExists($photo->thumb_path);
        [$width] = getimagesize(Storage::disk('public')->path($photo->thumb_path));
        $this->assertSame(600, $width);
    }

    public function test_invalid_file_returns_a_readable_json_error(): void
    {
        $this->actingAs($this->admin)
            ->postJson(route('admin.gallery.store'), ['image' => UploadedFile::fake()->create('documento.pdf', 100, 'application/pdf')])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('image');
    }

    public function test_gallery_lists_only_visible_albums_with_visible_photos(): void
    {
        $visible = Album::create(['title' => 'Album visibile', 'is_visible' => true]);
        $this->photo($visible);

        $hidden = Album::create(['title' => 'Album nascosto', 'is_visible' => false]);
        $this->photo($hidden);

        $onlyHiddenPhotos = Album::create(['title' => 'Album senza foto pubbliche', 'is_visible' => true]);
        $this->photo($onlyHiddenPhotos, ['is_visible' => false]);

        $this->get(route('galleria'))
            ->assertOk()
            ->assertSee('Album visibile')
            ->assertDontSee('Album nascosto')
            ->assertDontSee('Album senza foto pubbliche');
    }

    public function test_album_page_shows_its_photos_and_hides_private_albums(): void
    {
        $album = Album::create(['title' => 'Assemblea', 'is_visible' => true]);
        $photo = $this->photo($album, ['title' => 'Foto di gruppo', 'thumb_path' => 'gallery/thumbs/gruppo.jpg']);
        $this->photo($album, ['title' => 'Foto privata', 'is_visible' => false]);

        $this->get(route('galleria.album', $album))
            ->assertOk()
            ->assertSee($photo->thumb_url)
            ->assertSee('1 foto')
            ->assertDontSee('Foto privata');

        $album->update(['is_visible' => false]);
        $this->get(route('galleria.album', $album))->assertNotFound();
    }

    public function test_lightbox_data_survives_quotes_in_titles(): void
    {
        $album = Album::create(['title' => 'Album', 'is_visible' => true]);
        $this->photo($album, ['title' => 'Il "grande" giorno', 'caption' => "L'arrivo </script>"]);

        $html = $this->get(route('galleria.album', $album))->assertOk()->getContent();

        $this->assertStringNotContainsString('x-data="lightbox(JSON.parse(\'[{"', $html);
        $this->assertStringNotContainsString("L'arrivo </script>", $html);
    }

    public function test_event_page_shows_photos_of_linked_album(): void
    {
        $event = Event::create([
            'title' => 'Torneo di calcio',
            'description' => 'Torneo interculturale.',
            'starts_at' => now()->subDays(3),
            'is_public' => true,
            'status' => 'published',
        ]);
        $album = Album::create(['title' => 'Foto torneo', 'is_visible' => true, 'event_id' => $event->id]);
        $photo = $this->photo($album, ['thumb_path' => 'gallery/thumbs/torneo.jpg']);

        $this->get(route('eventi.show', $event))
            ->assertOk()
            ->assertSee("Foto dell'evento")
            ->assertSee($photo->thumb_url)
            ->assertSee(route('galleria.album', $album));
    }

    public function test_deleting_an_album_keeps_its_photos(): void
    {
        $album = Album::create(['title' => 'Da eliminare', 'is_visible' => true]);
        $photo = $this->photo($album);

        $this->actingAs($this->admin)->delete(route('admin.albums.destroy', $album))->assertRedirect();

        $this->assertNull($photo->fresh()->album_id);
        $this->assertModelMissing($album);
    }

    public function test_deleting_a_photo_removes_file_and_thumbnail(): void
    {
        Storage::disk('public')->put('gallery/a.jpg', 'x');
        Storage::disk('public')->put('gallery/thumbs/a.jpg', 'x');
        $photo = $this->photo(null, ['image_path' => 'gallery/a.jpg', 'thumb_path' => 'gallery/thumbs/a.jpg']);

        $this->actingAs($this->admin)->delete(route('admin.gallery.destroy', $photo));

        Storage::disk('public')->assertMissing(['gallery/a.jpg', 'gallery/thumbs/a.jpg']);
    }

    public function test_thumbnails_command_fills_missing_thumbnails(): void
    {
        Storage::disk('public')->putFileAs('gallery', UploadedFile::fake()->image('vecchia.jpg', 1600, 1200), 'vecchia.jpg');
        $photo = $this->photo(null, ['image_path' => 'gallery/vecchia.jpg']);

        $this->artisan('gallery:thumbnails')->expectsOutputToContain('Miniature create: 1')->assertSuccessful();

        Storage::disk('public')->assertExists($photo->fresh()->thumb_path);
    }

    public function test_orphan_cleanup_keeps_thumbnails_in_use(): void
    {
        Storage::disk('public')->put('gallery/b.jpg', 'x');
        Storage::disk('public')->put('gallery/thumbs/b.jpg', 'x');
        touch(Storage::disk('public')->path('gallery/b.jpg'), time() - 7200);
        touch(Storage::disk('public')->path('gallery/thumbs/b.jpg'), time() - 7200);
        $this->photo(null, ['image_path' => 'gallery/b.jpg', 'thumb_path' => 'gallery/thumbs/b.jpg']);

        $this->artisan('storage:clean-orphans', ['--force' => true])->expectsOutputToContain('Nessun file orfano');

        Storage::disk('public')->assertExists('gallery/thumbs/b.jpg');
    }

    public function test_published_albums_are_in_the_sitemap(): void
    {
        $album = Album::create(['title' => 'Album pubblico', 'is_visible' => true]);
        $this->photo($album);
        $hidden = Album::create(['title' => 'Album nascosto', 'is_visible' => false]);
        $this->photo($hidden);

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee(route('galleria.album', $album), false)
            ->assertDontSee(route('galleria.album', $hidden), false);
    }

    public function test_non_admins_cannot_manage_albums(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)->get(route('admin.albums.index'))->assertForbidden();
        $this->actingAs($user)->post(route('admin.albums.store'), ['title' => 'X'])->assertForbidden();
    }
}
