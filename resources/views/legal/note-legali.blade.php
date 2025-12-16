@extends('layouts.public')

@section('title', 'Note Legali - ASCAI Bologna')

@section('content')
<div class="max-w-4xl mx-auto mt-12 md:mt-16">
    <!-- Header -->
    <div class="bg-gradient-to-br from-slate-700 to-slate-900 rounded-2xl shadow-xl p-8 mb-8 text-white">
        <h1 class="text-3xl font-bold mb-3">Note Legali</h1>
        <p class="text-slate-300">Termini e condizioni d'uso del sito web</p>
        <p class="text-sm text-slate-400 mt-2">Ultimo aggiornamento: {{ date('d/m/Y') }}</p>
    </div>

    <!-- Contenuto -->
    <div class="bg-white rounded-xl shadow-md p-8 space-y-8">
        <!-- Informazioni sull'associazione -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                1. Informazioni sul Proprietario del Sito
            </h2>
            <div class="prose prose-slate max-w-none">
                <p><strong class="text-lg">ASCAI Bologna</strong></p>
                <p>Associazione dei Camerunesi a Bologna</p>
                <p><strong>Sede legale:</strong> Cassero di Porta Galliera, Piazza XX Settembre 7, 40121 Bologna (BO), Italia</p>
                <p><strong>Partita IVA:</strong> 94048620549</p>
                <p><strong>Email:</strong> <a href="mailto:associazione.camer.bologna@gmail.com" class="text-sky-600 hover:underline">associazione.camer.bologna@gmail.com</a></p>
            </div>
        </section>

        <!-- Copyright -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                2. Copyright e Proprietà Intellettuale
            </h2>
            <div class="prose prose-slate max-w-none">
                <p>© {{ date('Y') }} <strong>AS.CA.I Bologna</strong>. Tutti i diritti riservati.</p>
                <p>Tutti i contenuti presenti su questo sito web, inclusi ma non limitati a:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Testi, articoli, news ed eventi</li>
                    <li>Immagini, fotografie e grafica</li>
                    <li>Logo e marchi dell'associazione</li>
                    <li>Struttura, layout e design del sito</li>
                    <li>Codice sorgente e funzionalità</li>
                </ul>
                <p>sono di proprietà esclusiva di <strong>AS.CA.I Bologna</strong> o dei rispettivi autori e sono protetti dalle leggi italiane ed internazionali sul diritto d'autore e sulla proprietà intellettuale.</p>
                
                <div class="bg-slate-50 border-l-4 border-slate-600 p-4 rounded mt-4">
                    <p class="text-sm"><strong>⚠️ È vietato:</strong></p>
                    <ul class="list-disc pl-6 text-sm space-y-1 mt-2">
                        <li>Copiare, riprodurre, modificare o distribuire i contenuti senza autorizzazione scritta</li>
                        <li>Utilizzare il logo o i marchi ASCAI Bologna per scopi commerciali</li>
                        <li>Estrarre dati o contenuti mediante tecniche di scraping automatico</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Sviluppo -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
                3. Sviluppo e Realizzazione del Sito
            </h2>
            <div class="prose prose-slate max-w-none">
                <p><strong>Sito web sviluppato da:</strong></p>
                <div class="bg-sky-50 border-l-4 border-sky-500 p-4 rounded">
                    <p class="font-bold text-lg text-slate-800">Team AS.CA.I Bologna</p>
                    <p class="font-bold text-slate-600">Franks Toscani Koudja - Web Developer</p>
                    <p><strong>Email:</strong> <a href="mailto:ftoscani111@gmail.com" class="text-sky-600 hover:underline">ftoscani111@gmail.com</a></p>
                    <p class="text-sm text-slate-500 mt-2">Tutti i diritti di sviluppo, codice sorgente e architettura software sono riservati allo sviluppatore.</p>
                </div>
                <p class="mt-4"><strong>Tecnologie utilizzate:</strong> Laravel, PHP, Tailwind CSS, Alpine.js, PostgreSQL</p>
            </div>
        </section>

        <!-- Limitazione responsabilità -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                4. Limitazione di Responsabilità
            </h2>
            <div class="prose prose-slate max-w-none">
                <p>ASCAI Bologna si impegna a fornire informazioni accurate e aggiornate, tuttavia:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Non garantisce la completezza, accuratezza o tempestività delle informazioni pubblicate</li>
                    <li>Non è responsabile per eventuali errori, omissioni o imprecisioni nei contenuti</li>
                    <li>Non è responsabile per danni diretti o indiretti derivanti dall'uso del sito</li>
                    <li>Non è responsabile per il contenuto di siti web esterni collegati tramite link</li>
                </ul>
                <p class="mt-4">L'utente utilizza il sito a proprio rischio e responsabilità.</p>
            </div>
        </section>

        <!-- Uso del sito -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                5. Condizioni d'Uso
            </h2>
            <div class="prose prose-slate max-w-none">
                <p>Utilizzando questo sito web, l'utente accetta di:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Utilizzare il sito in modo lecito e conforme alla legge italiana</li>
                    <li>Non tentare di compromettere la sicurezza del sito</li>
                    <li>Non caricare contenuti dannosi, offensivi o illegali</li>
                    <li>Non utilizzare il sito per attività commerciali non autorizzate</li>
                    <li>Rispettare i diritti di proprietà intellettuale</li>
                </ul>
                <p class="mt-4">AS.CA.I Bologna si riserva il diritto di modificare, sospendere o interrompere il servizio in qualsiasi momento senza preavviso.</p>
            </div>
        </section>

        <!-- Legge applicabile -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                </svg>
                6. Legge Applicabile e Foro Competente
            </h2>
            <div class="prose prose-slate max-w-none">
                <p>Le presenti note legali sono regolate dalla <strong>legge italiana</strong>.</p>
                <p>Per qualsiasi controversia relativa all'uso del sito sarà competente esclusivamente il <strong>Foro di Bologna</strong>.</p>
            </div>
        </section>

        <!-- Modifiche -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4">7. Modifiche alle Note Legali</h2>
            <div class="prose prose-slate max-w-none">
                <p>AS.CA.I Bologna si riserva il diritto di modificare queste note legali in qualsiasi momento. Le modifiche entreranno in vigore dalla data di pubblicazione sul sito.</p>
                <p>Ti invitiamo a consultare regolarmente questa pagina per rimanere aggiornato.</p>
            </div>
        </section>

        <!-- Contatti -->
        <div class="bg-slate-50 border-l-4 border-slate-600 p-6 rounded-lg mt-8">
            <h3 class="font-bold text-lg text-slate-800 mb-2">Hai domande legali?</h3>
            <p class="text-slate-600 mb-2">Per qualsiasi chiarimento o richiesta riguardante questi termini, contattaci:</p>
            <p class="text-slate-700">
                <strong>Email:</strong> <a href="mailto:associazione.camer.bologna@gmail.com" class="text-sky-600 hover:underline font-semibold">associazione.camer.bologna@gmail.com</a>
            </p>
            <p class="text-slate-700">
                <strong>Indirizzo:</strong> Cassero di Porta Galliera, Piazza XX Settembre 7, 40121 Bologna
            </p>
        </div>
    </div>
</div>
@endsection
