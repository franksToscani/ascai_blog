<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\StaffMember;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CopyDatabaseToSqliteTest extends TestCase
{
    use RefreshDatabase;

    private string $path;

    protected function setUp(): void
    {
        parent::setUp();
        $this->path = sys_get_temp_dir() . '/ascai-copia-' . uniqid() . '.sqlite';
    }

    protected function tearDown(): void
    {
        foreach ([$this->path, $this->path . '-wal', $this->path . '-shm'] as $file) {
            @unlink($file);
        }
        parent::tearDown();
    }

    private function target()
    {
        config(['database.connections.verifica' => ['driver' => 'sqlite', 'database' => $this->path, 'prefix' => '']]);

        return DB::connection('verifica');
    }

    public function test_copies_all_rows_and_leaves_the_source_untouched(): void
    {
        Post::create(['title' => 'Prima news', 'content' => 'Testo', 'status' => 'published']);
        $staffBefore = StaffMember::count();

        $this->artisan('db:copy-to-sqlite', ['path' => $this->path])
            ->expectsOutputToContain('tutti i conteggi coincidono')
            ->assertSuccessful();

        // Nessun doppione nell'origine: le migrazioni con dati hanno scritto solo nel nuovo file
        $this->assertSame($staffBefore, StaffMember::count());

        $target = $this->target();
        $this->assertSame(1, $target->table('posts')->count());
        $this->assertSame('Prima news', $target->table('posts')->value('title'));
        $this->assertSame($staffBefore, $target->table('staff_members')->count());
        $this->assertSame(0, $target->table('sessions')->count());
    }

    public function test_refuses_to_overwrite_an_existing_file_without_force(): void
    {
        file_put_contents($this->path, 'dati esistenti');

        $this->artisan('db:copy-to-sqlite', ['path' => $this->path])
            ->expectsOutputToContain('--force')
            ->assertFailed();

        $this->assertSame('dati esistenti', file_get_contents($this->path));
    }
}
