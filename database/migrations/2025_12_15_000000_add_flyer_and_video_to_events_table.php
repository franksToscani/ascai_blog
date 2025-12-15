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
        Schema::table('events', function (Blueprint $table) {
            $table->string('flyer_path')->nullable()->after('location')->comment('Percorso del flyer/locandina evento');
            $table->string('youtube_url')->nullable()->after('flyer_path')->comment('URL YouTube video evento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['flyer_path', 'youtube_url']);
        });
    }
};
