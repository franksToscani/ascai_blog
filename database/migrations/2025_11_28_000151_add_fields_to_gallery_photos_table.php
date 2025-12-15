<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('gallery_photos', function (Blueprint $table) {
            // Aggiungiamo solo i campi che non esistono
            if (!Schema::hasColumn('gallery_photos', 'title')) {
                $table->string('title')->nullable()->after('id');
            }
            if (!Schema::hasColumn('gallery_photos', 'caption')) {
                $table->string('caption')->nullable()->after('title');
            }
            if (!Schema::hasColumn('gallery_photos', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('image_path');
            }
            if (!Schema::hasColumn('gallery_photos', 'is_visible')) {
                $table->boolean('is_visible')->default(true)->after('published_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery_photos', function (Blueprint $table) {
            //
        });
    }
};
