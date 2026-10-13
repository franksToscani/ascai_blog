<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_members', function (Blueprint $table) {
            $table->id();
            $table->string('group', 20); // direttivo | collaboratori
            $table->string('role');
            $table->string('name')->nullable(); // i comitati non hanno un nome di persona
            $table->string('description')->nullable();
            $table->string('photo_path')->nullable();
            $table->unsignedSmallInteger('position')->default(0);
            $table->timestamps();

            $table->index(['group', 'position']);
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Contenuti già presenti sul sito, così la pagina Staff resta identica dopo il deploy
        $now = now();
        $staff = [
            ['direttivo', 'Presidente', 'Jemes Tonnang', "Rappresentante legale dell'associazione"],
            ['direttivo', 'Vicepresidente', 'Loic Kamani', 'Supporta il presidente'],
            ['direttivo', 'Segretario generale', 'Franks Toscani Koudja', 'Gestisce la comunicazione'],
            ['direttivo', 'Tesoriere', 'Leatitia Nichee Kentsa', 'Gestisce le finanze'],
            ['collaboratori', 'Comunicazione e relazioni esterne', null, 'Gestione media, social e relazioni esterne'],
            ['collaboratori', 'Comitato Accademico', null, "Gestione studenti camerunensi dell'UNIBO"],
            ['collaboratori', 'Comitato Sociale', null, 'Gestione attività sociali'],
            ['collaboratori', 'Comitato Culturale', null, 'Gestione attività culturali'],
            ['collaboratori', 'Comitato Sportivo', null, 'Gestione attività sportive'],
        ];

        foreach ($staff as $index => [$group, $role, $name, $description]) {
            DB::table('staff_members')->insert([
                'group' => $group,
                'role' => $role,
                'name' => $name,
                'description' => $description,
                'position' => $index,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        DB::table('settings')->insert([
            'key' => 'membership_form_url',
            'value' => 'https://docs.google.com/forms/d/e/1FAIpQLSeSuhK_7-bpB4-07XHc_XP214gIbqkzjGYFGVLAwMT53XG0SQ/viewform?usp=dialog',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('staff_members');
    }
};
