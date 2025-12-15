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
            $table->index('slug');
            $table->index('status');
            $table->index('user_id');
            $table->index('created_at');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->index('slug');
            $table->index('status');
            $table->index('is_public');
            $table->index('starts_at');
            $table->index('user_id');
            $table->index(['is_public', 'status', 'starts_at'], 'events_public_status_starts_idx');
        });

        Schema::table('gallery_photos', function (Blueprint $table) {
            $table->index('is_visible');
            $table->index('published_at');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['status']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['status']);
            $table->dropIndex(['is_public']);
            $table->dropIndex(['starts_at']);
            $table->dropIndex(['user_id']);
            $table->dropIndex('events_public_status_starts_idx');
        });

        Schema::table('gallery_photos', function (Blueprint $table) {
            $table->dropIndex(['is_visible']);
            $table->dropIndex(['published_at']);
            $table->dropIndex(['user_id']);
        });
    }
};
