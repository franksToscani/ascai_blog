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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('cover_image')->nullable()->after('content')->comment('Immagine di copertina della news');
            $table->string('youtube_url')->nullable()->after('cover_image')->comment('URL YouTube video news');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['cover_image', 'youtube_url']);
        });
    }
};
