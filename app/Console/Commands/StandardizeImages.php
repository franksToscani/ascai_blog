<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\GalleryPhoto;
use App\Models\Post;
use App\Services\ImageResizer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Applica lo standard di ImageResizer (JPEG, max 2000px, EXIF rimosso)
 * alle immagini caricate prima della sua introduzione.
 */
class StandardizeImages extends Command
{
    protected $signature = 'images:standardize {--dry-run : Mostra cosa verrebbe convertito senza modificare nulla}';

    protected $description = 'Converte foto galleria, copertine news e locandine eventi nel formato standard';

    public function handle(): int
    {
        $sources = [
            [GalleryPhoto::withTrashed(), 'image_path', 'gallery'],
            [Post::withTrashed(), 'cover_image', 'posts/covers'],
            [Event::withTrashed(), 'flyer_path', 'events/flyers'],
        ];

        $disk = Storage::disk('public');
        $converted = $skipped = $alreadyStandard = 0;

        foreach ($sources as [$query, $column, $directory]) {
            foreach ($query->whereNotNull($column)->get() as $model) {
                $oldPath = $model->{$column};

                if (! $disk->exists($oldPath)) {
                    $this->warn("File mancante, saltato: {$oldPath}");
                    $skipped++;
                    continue;
                }

                if (ImageResizer::isAlreadyStandard($disk->path($oldPath))) {
                    $alreadyStandard++;
                    continue;
                }

                $data = ImageResizer::standardize($disk->path($oldPath));

                if ($data === null) {
                    $this->warn("Formato non elaborabile, saltato: {$oldPath}");
                    $skipped++;
                    continue;
                }

                $this->line("{$oldPath} → JPEG " . round(strlen($data) / 1024) . ' KB');

                if ($this->option('dry-run')) {
                    $converted++;
                    continue;
                }

                $newPath = $directory . '/' . Str::random(40) . '.jpg';
                $disk->put($newPath, $data);

                // saveQuietly: è manutenzione tecnica, non una modifica da registrare nell'audit log
                $model->{$column} = $newPath;
                $model->saveQuietly();

                $disk->delete($oldPath);
                $converted++;
            }
        }

        if (! $this->option('dry-run')) {
            Cache::forget('home.gallery_photos_preview');
            Cache::forget('home.latest_posts');
            Cache::forget('home.upcoming_events');
        }

        $verb = $this->option('dry-run') ? 'da convertire' : 'convertite';
        $this->info("Immagini {$verb}: {$converted}, già standard: {$alreadyStandard}, saltate: {$skipped}");

        return self::SUCCESS;
    }
}
