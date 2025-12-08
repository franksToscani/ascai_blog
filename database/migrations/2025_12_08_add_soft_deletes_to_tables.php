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
        // Aggiungi soft delete a posts
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        // Aggiungi soft delete a events
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        // Aggiungi soft delete a gallery_photos
        Schema::table('gallery_photos', function (Blueprint $table) {
            if (!Schema::hasColumn('gallery_photos', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('gallery_photos', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
