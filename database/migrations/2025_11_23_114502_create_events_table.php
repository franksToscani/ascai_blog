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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');              // titolo evento
            $table->text('description');          // descrizione
            $table->dateTime('starts_at');        // data/ora inizio
            $table->dateTime('ends_at')->nullable(); // data/ora fine (opzionale)
            $table->string('location')->nullable();  // luogo
            $table->boolean('is_public')->default(true); // se è visibile sul sito
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
