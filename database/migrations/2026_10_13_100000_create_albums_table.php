<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            // Album collegato (facoltativo) a un evento: le foto compaiono anche nella sua pagina
            $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_visible')->default(true);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();

            $table->index(['is_visible', 'date']);
        });

        Schema::table('gallery_photos', function (Blueprint $table) {
            // Eliminare un album non elimina le foto: restano "senza album"
            $table->foreignId('album_id')->nullable()->after('user_id')->constrained()->nullOnDelete();
            $table->string('thumb_path')->nullable()->after('image_path');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_photos', function (Blueprint $table) {
            $table->dropForeign(['album_id']);
            $table->dropColumn(['album_id', 'thumb_path']);
        });

        Schema::dropIfExists('albums');
    }
};
