@extends('layouts.public')

@section('title', 'Privacy Policy - ASCAI Bologna')

@section('content')
<div class="max-w-4xl mx-auto mt-12 md:mt-16">
    <!-- Header -->
    <div class="bg-gradient-to-br from-sky-600 to-blue-700 rounded-2xl shadow-xl p-8 mb-8 text-white">
        <h1 class="text-3xl font-bold mb-3">Privacy Policy</h1>
        <p class="text-sky-100">Informativa sul trattamento dei dati personali ai sensi del GDPR (Regolamento UE 2016/679)</p>
        <p class="text-sm text-sky-200 mt-2">Ultimo aggiornamento: {{ date('d/m/Y') }}</p>
    </div>

    <!-- Contenuto -->
    <div class="bg-white rounded-xl shadow-md p-8 space-y-8">
        <!-- Titolare -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                1. Titolare del Trattamento
            </h2>
            <div class="prose prose-slate max-w-none">
                <p><strong>AS.CA.I Bologna</strong> - Associazione dei Camerunesi a Bologna</p>
                <p><strong>Sede:</strong> Cassero di Porta Galliera, Piazza XX Settembre 7, 40121 Bologna</p>
                <p><strong>P.IVA:</strong> 94048620549</p>
                <p><strong>Email:</strong> <a href="mailto:associazione.camer.bologna@gmail.com" class="text-sky-600 hover:underline">associazione.camer.bologna@gmail.com</a></p>
            </div>
        </section>

        <!-- Tipologie di dati -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                2. Tipologie di Dati Raccolti
            </h2>
            <div class="prose prose-slate max-w-none">
                <p>Il sito raccoglie le seguenti categorie di dati personali:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li><strong>Dati di contatto:</strong> nome, cognome, email, telefono (tramite form di contatto)</li>
                    <li><strong>Dati di navigazione:</strong> indirizzo IP, tipo di browser, pagine visitate, durata della visita</li>
                    <li><strong>Cookie tecnici:</strong> per il corretto funzionamento del sito e la sessione di navigazione</li>
                </ul>
            </div>
        </section>

        <!-- Finalità -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                3. Finalità del Trattamento
            </h2>
            <div class="prose prose-slate max-w-none">
                <p>I dati personali vengono trattati per le seguenti finalità:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Rispondere alle richieste di contatto inviate tramite il form</li>
                    <li>Fornire informazioni su eventi, iniziative e attività dell'associazione</li>
                    <li>Gestione dell'area amministrativa (solo per utenti autorizzati)</li>
                    <li>Analisi statistiche aggregate sulla navigazione del sito</li>
                </ul>
            </div>
        </section>

        <!-- Base giuridica -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                </svg>
                4. Base Giuridica
            </h2>
            <div class="prose prose-slate max-w-none">
                <p>Il trattamento dei dati personali si basa su:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li><strong>Consenso esplicito</strong> (art. 6, par. 1, lett. a GDPR) per l'invio di comunicazioni</li>
                    <li><strong>Legittimo interesse</strong> (art. 6, par. 1, lett. f GDPR) per analisi statistiche e sicurezza del sito</li>
                    <li><strong>Esecuzione di un contratto</strong> (art. 6, par. 1, lett. b GDPR) per la gestione dei servizi richiesti</li>
                </ul>
            </div>
        </section>

        <!-- Conservazione -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                5. Periodo di Conservazione
            </h2>
            <div class="prose prose-slate max-w-none">
                <p>I dati personali vengono conservati per il tempo strettamente necessario alle finalità per cui sono stati raccolti:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Richieste di contatto: fino a risposta fornita, poi cancellati salvo consenso a conservazione</li>
                    <li>Dati di navigazione: massimo 12 mesi</li>
                    <li>Cookie tecnici: durata della sessione</li>
                </ul>
            </div>
        </section>

        <!-- Diritti -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                6. Diritti dell'Interessato
            </h2>
            <div class="prose prose-slate max-w-none">
                <p>In qualità di interessato, hai il diritto di:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li><strong>Accesso:</strong> ottenere conferma dell'esistenza dei tuoi dati e riceverne copia</li>
                    <li><strong>Rettifica:</strong> correggere dati inesatti o incompleti</li>
                    <li><strong>Cancellazione:</strong> richiedere la cancellazione dei dati (diritto all'oblio)</li>
                    <li><strong>Limitazione:</strong> limitare il trattamento in determinate circostanze</li>
                    <li><strong>Portabilità:</strong> ricevere i dati in formato strutturato e interoperabile</li>
                    <li><strong>Opposizione:</strong> opporti al trattamento per motivi legittimi</li>
                    <li><strong>Revoca del consenso:</strong> revocare il consenso in qualsiasi momento</li>
                </ul>
                <p class="mt-4">Per esercitare i tuoi diritti, contattaci a: <a href="mailto:associazione.camer.bologna@gmail.com" class="text-sky-600 hover:underline">associazione.camer.bologna@gmail.com</a></p>
                <p class="mt-2">Hai inoltre il diritto di proporre reclamo all'Autorità Garante per la Protezione dei Dati Personali.</p>
            </div>
        </section>

        <!-- Sicurezza -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                7. Sicurezza dei Dati
            </h2>
            <div class="prose prose-slate max-w-none">
                <p>Adottiamo misure tecniche e organizzative adeguate per proteggere i dati personali da accessi non autorizzati, perdita, distruzione o alterazione, tra cui:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Connessione HTTPS crittografata</li>
                    <li>Autenticazione sicura per l'area amministrativa</li>
                    <li>Backup regolari del database</li>
                    <li>Limitazione dell'accesso ai dati al solo personale autorizzato</li>
                </ul>
            </div>
        </section>

        <!-- Modifiche -->
        <section>
            <h2 class="text-2xl font-bold text-slate-800 mb-4">8. Modifiche alla Privacy Policy</h2>
            <div class="prose prose-slate max-w-none">
                <p>Questa informativa può essere aggiornata periodicamente. Ti invitiamo a consultarla regolarmente. La data di ultimo aggiornamento è indicata in alto.</p>
            </div>
        </section>

        <!-- Contatti -->
        <div class="bg-sky-50 border-l-4 border-sky-600 p-6 rounded-lg mt-8">
            <h3 class="font-bold text-lg text-slate-800 mb-2">Hai domande sulla privacy?</h3>
            <p class="text-slate-600">Contattaci: <a href="mailto:associazione.camer.bologna@gmail.com" class="text-sky-600 hover:underline font-semibold">associazione.camer.bologna@gmail.com</a></p>
        </div>
    </div>
</div>
@endsection
