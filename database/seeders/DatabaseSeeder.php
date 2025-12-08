<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crea utente admin
        $admin = User::factory()->create([
            'name' => 'Admin ASCAI',
            'email' => 'admin@ascai.it',
            'is_admin' => true,
        ]);

        // Crea utente admin per i test
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'testadmin@ascai.it',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // Crea utente normale
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => false,
        ]);

        // ========================================
        // EVENTI PASSATI (4)
        // ========================================
        $pastEvents = [
            [
                'title' => 'Festa della Solidarietà 2024',
                'description' => 'Grande festa di chiusura anno con musica dal vivo, gastronomia camerunense e testimonianze delle famiglie supportate dall\'associazione.',
                'location' => 'Parco Giardini Margherita, Bologna',
                'starts_at' => now()->subDays(45),
                'ends_at' => now()->subDays(45)->addHours(6),
                'is_public' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Workshop: Integrazione e Diritti',
                'description' => 'Incontro formativo sui diritti dei migranti in Italia, con focus su permessi di soggiorno, accesso ai servizi sanitari e istruzione.',
                'location' => 'Biblioteca Salaborsa, Piazza Nettuno, Bologna',
                'starts_at' => now()->subDays(60),
                'ends_at' => now()->subDays(60)->addHours(3),
                'is_public' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Torneo di Calcio Interculturale',
                'description' => 'Torneo amichevole tra squadre delle diverse comunità straniere di Bologna. Una giornata di sport, inclusione e divertimento per tutte le età.',
                'location' => 'Campo Sportivo Dozza, Via dello Sport, Bologna',
                'starts_at' => now()->subDays(80),
                'ends_at' => now()->subDays(80)->addHours(8),
                'is_public' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Conferenza: Il Camerun e l\'Italia',
                'description' => 'Dialogo tra cultura camerunense e italiana con interventi di esperti, mediatori culturali e rappresentanti delle istituzioni locali.',
                'location' => 'Auditorium Mast, Via Speranza 42, Bologna',
                'starts_at' => now()->subDays(100),
                'ends_at' => now()->subDays(100)->addHours(4),
                'is_public' => true,
                'status' => 'published',
            ],
        ];

        foreach ($pastEvents as $event) {
            Event::create($event);
        }

        // ========================================
        // EVENTI FUTURI (3 dal template)
        // ========================================
        $futureEvents = [
            [
                'title' => 'Conferenza sulla Cooperazione Camerun-Italia',
                'description' => 'Incontro dedicato alle opportunità di cooperazione tra comunità camerunense e istituzioni locali. Interverranno rappresentanti di associazioni, mediatori culturali e studenti universitari.',
                'location' => 'Sala B – Centro Civico Borgo Panigale, Bologna',
                'starts_at' => now()->addDays(10),
                'ends_at' => now()->addDays(10)->addHours(3),
                'is_public' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Serata Culturale: Musica e Gastronomia Camerunense',
                'description' => 'Una serata per scoprire i piatti tipici camerunensi, accompagnata da musica dal vivo e performance tradizionali.',
                'location' => 'Casa delle Associazioni, Via San Donato 58, Bologna',
                'starts_at' => now()->addDays(25),
                'ends_at' => now()->addDays(25)->addHours(5),
                'is_public' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Assemblea Generale dei Soci – ASCAI Bologna',
                'description' => 'Riunione aperta a tutti gli associati per discutere attività, bilancio, nuovi progetti e approvazioni del direttivo.',
                'location' => 'Sala Polivalente, Via del Lavoro 13, Bologna',
                'starts_at' => now()->addDays(40),
                'ends_at' => now()->addDays(40)->addHours(2),
                'is_public' => true,
                'status' => 'published',
            ],
        ];

        foreach ($futureEvents as $event) {
            Event::create($event);
        }

        // ========================================
        // NEWS / POST (7)
        // ========================================
        $posts = [
            [
                'title' => 'ASCAI Bologna: nuovi corsi di italiano per stranieri',
                'content' => 'L\'associazione ASCAI annuncia l\'avvio di nuovi corsi di lingua italiana gratuiti per migranti e rifugiati. Le lezioni si terranno ogni martedì e giovedì presso la Casa delle Associazioni. Per info e iscrizioni, contattare la segreteria.',
                'status' => 'published',
            ],
            [
                'title' => 'Borse di studio per studenti camerunensi',
                'content' => 'Grazie alla collaborazione con il Comune di Bologna e l\'Università di Bologna, ASCAI offre 5 borse di studio parziali per studenti di origine camerunense meritevoli. Domande entro il 31 gennaio.',
                'status' => 'published',
            ],
            [
                'title' => 'Progetto "Insieme per l\'integrazione": al via la seconda fase',
                'content' => 'Il progetto ASCAI per l\'integrazione socio-lavorativa dei migranti entra nella sua seconda fase. Sono previsti colloqui di orientamento, stage in aziende locali e laboratori di scrittura CV. Partecipazione gratuita.',
                'status' => 'published',
            ],
            [
                'title' => 'Raccolta fondi per le famiglie in difficoltà',
                'content' => 'In occasione delle festività natalizie, ASCAI lancia una raccolta fondi per sostenere le famiglie camerunensi in difficoltà economica. Ogni contributo, anche piccolo, può fare la differenza. Donazioni sul nostro IBAN o presso la sede.',
                'status' => 'published',
            ],
            [
                'title' => 'Collaborazione con le scuole: educazione interculturale',
                'content' => 'ASCAI avvia una collaborazione con tre scuole medie di Bologna per portare nelle classi percorsi di educazione interculturale, testimonianze di migranti e laboratori sulla diversità. Un\'iniziativa per promuovere dialogo e rispetto.',
                'status' => 'published',
            ],
            [
                'title' => 'Sportello legale: nuovi orari di apertura',
                'content' => 'Lo sportello legale ASCAI, dedicato a consulenze su permessi di soggiorno, ricongiungimenti familiari e cittadinanza, amplia i suoi orari. Aperto lunedì, mercoledì e venerdì dalle 15 alle 18. Servizio gratuito su appuntamento.',
                'status' => 'published',
            ],
            [
                'title' => 'Festa di Primavera 2025: save the date!',
                'content' => 'Segna la data: il 15 marzo 2025 si terrà la tradizionale Festa di Primavera organizzata da ASCAI. Musica, cibo, balli e attività per bambini. Location da confermare. Seguiteci sui social per aggiornamenti!',
                'status' => 'published',
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
