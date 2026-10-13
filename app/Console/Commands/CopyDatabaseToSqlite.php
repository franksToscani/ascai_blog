<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

/**
 * Copia tutti i dati dal database attuale (es. Postgres su Render) in un nuovo file SQLite.
 *
 * Il database di origine viene solo letto. Lo schema del file SQLite viene creato con le
 * migrazioni del progetto, poi le righe vengono copiate tabella per tabella e contate.
 */
class CopyDatabaseToSqlite extends Command
{
    protected $signature = 'db:copy-to-sqlite
        {path : Percorso del nuovo file SQLite (es. storage/database/database.sqlite)}
        {--force : Sovrascrive il file se esiste già}';

    protected $description = 'Copia tutti i dati dal database attuale in un nuovo file SQLite';

    /** Dati temporanei che non serve copiare (sessioni, cache, coda) */
    private const SKIP_TABLES = ['migrations', 'sessions', 'cache', 'cache_locks', 'jobs', 'job_batches', 'failed_jobs'];

    private const TARGET = 'sqlite_copy';

    public function handle(): int
    {
        $source = config('database.default');
        $path = $this->absolutePath($this->argument('path'));

        // realpath() restituisce false per file inesistenti o ":memory:": confronta solo percorsi reali
        $sourceFile = realpath((string) config("database.connections.$source.database"));

        if (config("database.connections.$source.driver") === 'sqlite'
            && $sourceFile !== false && $sourceFile === realpath($path)) {
            $this->error('Il file di destinazione è il database che il sito sta già usando.');

            return self::FAILURE;
        }

        if (File::exists($path) && File::size($path) > 0 && ! $this->option('force')) {
            $this->error("Il file $path esiste già. Usa --force per sovrascriverlo.");

            return self::FAILURE;
        }

        File::ensureDirectoryExists(dirname($path));
        File::put($path, '');

        config(["database.connections." . self::TARGET => [
            'driver' => 'sqlite',
            'database' => $path,
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]]);

        $this->info("Origine: $source → destinazione: $path");

        // 1. Schema: le migrazioni girano con SQLite come connessione predefinita, così anche
        //    quelle che inseriscono dati (es. lo staff iniziale) scrivono nel nuovo file
        //    e non toccano il database di origine.
        $this->line('Creo le tabelle…');
        $this->withDefaultConnection(self::TARGET, function () {
            Artisan::call('migrate', ['--database' => self::TARGET, '--force' => true]);
        });

        $target = DB::connection(self::TARGET);
        // Nomi senza prefisso di schema ("main.posts" in SQLite): devono valere anche su Postgres
        $tables = array_values(array_diff(
            Schema::connection(self::TARGET)->getTableListing(schemaQualified: false),
            self::SKIP_TABLES,
        ));

        // 2. Dati: si svuota ogni tabella (le migrazioni possono averci messo righe iniziali)
        //    e si copiano le righe dell'origine, a blocchi.
        $target->statement('PRAGMA foreign_keys = OFF');
        $rows = [];

        foreach ($tables as $table) {
            $target->table($table)->delete();

            if (! Schema::connection($source)->hasTable($table)) {
                $rows[] = [$table, 'assente', 0, '—'];

                continue;
            }

            $columns = array_values(array_intersect(
                Schema::connection(self::TARGET)->getColumnListing($table),
                Schema::connection($source)->getColumnListing($table),
            ));

            DB::connection($source)->table($table)
                ->select($columns)
                ->orderBy($columns[0])
                ->chunk(500, function ($chunk) use ($target, $table) {
                    $target->table($table)->insert(
                        $chunk->map(fn ($row) => (array) $row)->all()
                    );
                });

            $sourceCount = DB::connection($source)->table($table)->count();
            $targetCount = $target->table($table)->count();
            $rows[] = [$table, $sourceCount, $targetCount, $sourceCount === $targetCount ? 'ok' : 'DIVERSO'];
        }

        $target->statement('PRAGMA foreign_keys = ON');
        $brokenLinks = count($target->select('PRAGMA foreign_key_check'));

        $this->table(['Tabella', 'Origine', 'SQLite', 'Esito'], $rows);

        $mismatches = collect($rows)->where(3, 'DIVERSO')->count();

        if ($mismatches > 0 || $brokenLinks > 0) {
            $this->error("Copia NON riuscita: $mismatches tabelle con conteggi diversi, $brokenLinks collegamenti non validi.");

            return self::FAILURE;
        }

        $this->info('Copia completata: tutti i conteggi coincidono.');
        $this->line('Per usare il nuovo database imposta DB_CONNECTION=sqlite e DB_DATABASE=' . $path);

        return self::SUCCESS;
    }

    private function withDefaultConnection(string $connection, callable $callback): void
    {
        $previous = config('database.default');
        config(['database.default' => $connection]);
        DB::purge($connection);

        try {
            $callback();
        } finally {
            config(['database.default' => $previous]);
        }
    }

    private function absolutePath(string $path): string
    {
        return str_starts_with($path, '/') ? $path : base_path($path);
    }
}
