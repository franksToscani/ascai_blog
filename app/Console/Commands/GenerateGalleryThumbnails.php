<?php

namespace App\Console\Commands;

use App\Models\GalleryPhoto;
use App\Services\ImageResizer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

/**
 * Crea le miniature mancanti per le foto caricate prima che venissero generate all'upload.
 */
class GenerateGalleryThumbnails extends Command
{
    protected $signature = 'gallery:thumbnails';

    protected $description = 'Genera le miniature mancanti delle foto della galleria';

    public function handle(): int
    {
        $created = $failed = 0;

        GalleryPhoto::withTrashed()
            ->whereNull('thumb_path')
            ->each(function (GalleryPhoto $photo) use (&$created, &$failed) {
                if (! Storage::disk('public')->exists($photo->image_path)) {
                    $this->warn("File mancante: {$photo->image_path}");
                    $failed++;

                    return;
                }

                $thumb = ImageResizer::storeThumbnail($photo->image_path, 'gallery/thumbs');

                if ($thumb === null) {
                    $this->warn("Miniatura non creata: {$photo->image_path}");
                    $failed++;

                    return;
                }

                // saveQuietly: manutenzione tecnica, non va nell'audit log
                $photo->thumb_path = $thumb;
                $photo->saveQuietly();
                $created++;
            });

        Cache::forget('home.gallery_photos_preview');
        $this->info("Miniature create: {$created}, non riuscite: {$failed}");

        return self::SUCCESS;
    }
}
