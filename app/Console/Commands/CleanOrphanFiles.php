<?php

namespace App\Console\Commands;

use App\Models\Bilancio;
use App\Models\Event;
use App\Models\GalleryPhoto;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * Trova (e con --force elimina) i file caricati che nessuna riga del database usa più,
 * ad esempio le foto rimaste sul disco dopo una cancellazione a cascata.
 */
class CleanOrphanFiles extends Command
{
    protected $signature = 'storage:clean-orphans {--force : Elimina davvero (senza, mostra solo cosa verrebbe eliminato)}';

    protected $description = 'Elimina i file caricati non più collegati a foto, news, eventi o bilanci';

    /** Cartelle del disco "public" gestite dall'applicazione */
    private const DIRECTORIES = ['gallery', 'posts/covers', 'events/flyers', 'bilanci'];

    /** I file più recenti potrebbero appartenere a un upload ancora in corso */
    private const MIN_AGE_SECONDS = 3600;

    public function handle(): int
    {
        $disk = Storage::disk('public');

        // Anche le righe nel cestino (soft delete) contano: potrebbero essere ripristinate
        $referenced = collect()
            ->concat(GalleryPhoto::withTrashed()->pluck('image_path'))
            ->concat(Post::withTrashed()->pluck('cover_image'))
            ->concat(Event::withTrashed()->pluck('flyer_path'))
            ->concat(Bilancio::pluck('file_path'))
            ->filter()
            ->flip();

        $orphans = collect(self::DIRECTORIES)
            ->flatMap(fn ($directory) => $disk->files($directory))
            ->reject(fn ($path) => $referenced->has($path))
            ->reject(fn ($path) => basename($path) === '.gitignore')
            ->filter(fn ($path) => time() - $disk->lastModified($path) >= self::MIN_AGE_SECONDS)
            ->values();

        if ($orphans->isEmpty()) {
            $this->info('Nessun file orfano trovato.');

            return self::SUCCESS;
        }

        $totalBytes = 0;
        $rows = $orphans->map(function ($path) use ($disk, &$totalBytes) {
            $size = $disk->size($path);
            $totalBytes += $size;

            return [$path, round($size / 1024) . ' KB', date('d/m/Y H:i', $disk->lastModified($path))];
        });

        $this->table(['File', 'Dimensione', 'Modificato'], $rows->all());
        $this->line(sprintf('%d file orfani, %.1f MB in totale.', $orphans->count(), $totalBytes / 1048576));

        if (! $this->option('force')) {
            $this->line('Nessuna modifica fatta. Rilancia con --force per eliminarli.');

            return self::SUCCESS;
        }

        $disk->delete($orphans->all());
        $this->info(sprintf('Eliminati %d file, liberati %.1f MB.', $orphans->count(), $totalBytes / 1048576));

        return self::SUCCESS;
    }
}
