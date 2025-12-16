@extends('layouts.public')

@section('title', 'Cookie Policy - ASCAI Bologna')

@section('content')
<div class="max-w-4xl mx-auto mt-12 md:mt-16">
    <!-- Header -->
    <div class="bg-gradient-to-br from-purple-600 to-indigo-700 rounded-2xl shadow-xl p-8 mb-8 text-white">
        <h1 class="text-3xl font-bold mb-3">Cookie Policy</h1>
        <p class="text-purple-100">Informativa sull'uso dei cookie su questo sito web</p>
        <p class="text-sm text-purple-200 mt-2">Ultimo aggiornamento: {{ date('d/m/Y') }}</p>
    </div>

    <!-- Contenuto -->
    <div class="bg-white rounded-xl shadow-md p-8 space-y-8">
        <!-- Cosa sono i cookie -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                1. Cosa sono i Cookie
            </h2>
            <div class="prose prose-slate max-w-none">
                <p>I cookie sono piccoli file di testo che vengono memorizzati sul tuo dispositivo (computer, tablet, smartphone) quando visiti un sito web. I cookie permettono al sito di riconoscerti durante le visite successive e di ricordare le tue preferenze.</p>
            </div>
        </section>

        <!-- Tipologie di cookie -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                2. Tipologie di Cookie Utilizzati
            </h2>
            
            <!-- Cookie tecnici -->
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded mb-4">
                <h3 class="font-bold text-lg text-slate-800 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Cookie Tecnici (necessari)
                </h3>
                <p class="text-slate-700 mb-2">Questi cookie sono essenziali per il corretto funzionamento del sito. <strong>Non richiedono il tuo consenso.</strong></p>
                <ul class="list-disc pl-6 space-y-1 text-sm text-slate-600">
                    <li><strong>Cookie di sessione Laravel:</strong> mantiene la tua sessione attiva durante la navigazione</li>
                    <li><strong>CSRF Token:</strong> protezione contro attacchi di tipo Cross-Site Request Forgery</li>
                    <li><strong>Cookie di autenticazione:</strong> ricorda il tuo accesso all'area amministrativa</li>
                </ul>
                <p class="text-xs text-slate-500 mt-2"><strong>Durata:</strong> Sessione (si cancellano alla chiusura del browser) o fino a logout</p>
            </div>

            <!-- Cookie analitici -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded mb-4">
                <h3 class="font-bold text-lg text-slate-800 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Cookie Analitici
                </h3>
                <p class="text-slate-700 mb-2">Attualmente <strong class="text-blue-700">non utilizziamo cookie analitici di terze parti</strong> (es. Google Analytics).</p>
                <p class="text-sm text-slate-600">Se in futuro dovessimo integrarli, ti informeremo e richiederemo il tuo consenso esplicito.</p>
            </div>

            <!-- Cookie di profilazione -->
            <div class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded">
                <h3 class="font-bold text-lg text-slate-800 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    Cookie di Profilazione e Marketing
                </h3>
                <p class="text-slate-700"><strong class="text-orange-700">Non utilizziamo</strong> cookie di profilazione o cookie pubblicitari di terze parti.</p>
            </div>
        </section>

        <!-- Gestione cookie -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                </svg>
                3. Come Gestire i Cookie
            </h2>
            <div class="prose prose-slate max-w-none">
                <p>Puoi gestire o disabilitare i cookie attraverso le impostazioni del tuo browser. Ecco le guide per i browser più comuni:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li><strong>Google Chrome:</strong> Impostazioni → Privacy e sicurezza → Cookie e altri dati dei siti</li>
                    <li><strong>Firefox:</strong> Opzioni → Privacy e sicurezza → Cookie e dati dei siti web</li>
                    <li><strong>Safari:</strong> Preferenze → Privacy → Gestisci dati dei siti web</li>
                    <li><strong>Microsoft Edge:</strong> Impostazioni → Cookie e autorizzazioni sito</li>
                </ul>
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded mt-4">
                    <p class="text-sm text-slate-700"><strong>⚠️ Attenzione:</strong> Disabilitare i cookie tecnici potrebbe compromettere il corretto funzionamento del sito, in particolare l'accesso all'area amministrativa.</p>
                </div>
            </div>
        </section>

        <!-- Cookie di terze parti -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4">4. Cookie di Terze Parti</h2>
            <div class="prose prose-slate max-w-none">
                <p>Questo sito <strong>non integra servizi di terze parti</strong> che potrebbero installare cookie (es. social media widget, mappe interattive, video embedded).</p>
                <p>I link ai nostri profili social (Facebook, Instagram, YouTube, TikTok, WhatsApp) presenti nel sito <strong>non installano cookie</strong> fino a quando non clicchi per visitare quelle piattaforme esterne.</p>
            </div>
        </section>

        <!-- Aggiornamenti -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4">5. Aggiornamenti della Cookie Policy</h2>
            <div class="prose prose-slate max-w-none">
                <p>Questa Cookie Policy può essere aggiornata periodicamente per riflettere eventuali modifiche nell'uso dei cookie. Ti invitiamo a consultarla regolarmente.</p>
            </div>
        </section>

        <!-- Contatti -->
        <div class="bg-purple-50 border-l-4 border-purple-600 p-6 rounded-lg mt-8">
            <h3 class="font-bold text-lg text-slate-800 mb-2">Hai domande sui cookie?</h3>
            <p class="text-slate-600">Contattaci: <a href="mailto:associazione.camer.bologna@gmail.com" class="text-purple-600 hover:underline font-semibold">associazione.camer.bologna@gmail.com</a></p>
        </div>
    </div>
</div>
@endsection
