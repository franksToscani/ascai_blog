<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Aggiungi slug a posts (colonna nullable inizialmente)
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'slug')) {
                $table->string('slug')->nullable()->after('title');
            }
        });

        // Popola slug per posts esistenti
        $posts = \DB::table('posts')->whereNull('slug')->get();
        foreach ($posts as $post) {
            $slug = Str::slug($post->title);
            $originalSlug = $slug;
            $count = 1;

            // Verifica unicità
            while (\DB::table('posts')->where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            \DB::table('posts')->where('id', $post->id)->update(['slug' => $slug]);
        }

        // Aggiungi slug a events (colonna nullable inizialmente)
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'slug')) {
                $table->string('slug')->nullable()->after('title');
            }
        });

        // Popola slug per events esistenti
        $events = \DB::table('events')->whereNull('slug')->get();
        foreach ($events as $event) {
            $slug = Str::slug($event->title);
            $originalSlug = $slug;
            $count = 1;

            // Verifica unicità
            while (\DB::table('events')->where('slug', $slug)->where('id', '!=', $event->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            \DB::table('events')->where('id', $event->id)->update(['slug' => $slug]);
        }

        // Adesso rendi slug NOT NULL e UNIQUE
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->change();
            $table->unique('slug');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('slug')->change();
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
