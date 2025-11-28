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
              // Aggiungiamo solo se mancano (ma SQLite non supporta IF NOT EXISTS, quindi confidiamo che non ci siano)
            $table->string('title')->nullable()->after('id');
            $table->string('caption')->nullable()->after('title');
            $table->timestamp('published_at')->nullable()->after('image_path');
            $table->boolean('is_visible')->default(true)->after('published_at');
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
