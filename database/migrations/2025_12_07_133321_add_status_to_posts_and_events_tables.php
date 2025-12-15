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
            $table->enum('status', ['draft', 'published'])->default('draft')->after('content');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->enum('status', ['draft', 'published'])->default('draft')->after('is_public');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
