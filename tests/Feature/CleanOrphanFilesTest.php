<?php

namespace Tests\Feature;

use App\Models\GalleryPhoto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CleanOrphanFilesTest extends TestCase
{
    use RefreshDatabase;

    private function oldFile(string $path): void
    {
        Storage::disk('public')->put($path, 'contenuto');
        touch(Storage::disk('public')->path($path), time() - 7200); // 2 ore fa
    }

    public function test_dry_run_lists_orphans_without_deleting(): void
    {
        Storage::fake('public');
        $this->oldFile('gallery/orfana.jpg');

        $this->artisan('storage:clean-orphans')
            ->expectsOutputToContain('1 file orfani')
            ->assertSuccessful();

        Storage::disk('public')->assertExists('gallery/orfana.jpg');
    }

    public function test_force_deletes_only_unreferenced_old_files(): void
    {
        Storage::fake('public');
        $this->oldFile('gallery/orfana.jpg');
        $this->oldFile('gallery/in-uso.jpg');
        $this->oldFile('gallery/nel-cestino.jpg');
        Storage::disk('public')->put('gallery/appena-caricata.jpg', 'contenuto');

        GalleryPhoto::create(['image_path' => 'gallery/in-uso.jpg', 'is_visible' => true]);
        GalleryPhoto::create(['image_path' => 'gallery/nel-cestino.jpg', 'is_visible' => true])->delete();

        $this->artisan('storage:clean-orphans', ['--force' => true])
            ->expectsOutputToContain('Eliminati 1 file')
            ->assertSuccessful();

        Storage::disk('public')->assertMissing('gallery/orfana.jpg');
        Storage::disk('public')->assertExists('gallery/in-uso.jpg');
        Storage::disk('public')->assertExists('gallery/nel-cestino.jpg');
        Storage::disk('public')->assertExists('gallery/appena-caricata.jpg');
    }
}
