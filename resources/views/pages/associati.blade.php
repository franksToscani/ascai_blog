@extends('layouts.public')

@section('title', 'Associati - Associazione No-Profit')

@section('content')
    {{-- Header --}}
    <div class="mb-8 bg-gradient-to-r from-sky-50 to-blue-50 rounded-2xl border border-sky-100 p-8 mt-10 md:mt-12">
        <h1 class="text-4xl font-extrabold text-slate-800 mb-2">Diventa parte della nostra comunità</h1>
        <p class="text-slate-600 text-lg">La forza di una comunità nasce dalla partecipazione attiva e condivisa.</p>
    </div>

    {{-- Contenuto Principale --}}
    <h2 class="text-1xl mb-4 mt-12 md:mt-16"> Entrare a far parte della nostra associazione significa condividere valori, cultura e solidarietà. ASCAI Bologna è uno spazio di incontro, supporto e crescita, dove ogni socio contribuisce attivamente alla vita della comunità camerunese e al dialogo interculturale sul territorio. Unisciti a noi per partecipare alle attività,
        sostenere i nostri progetti e costruire insieme un futuro basato su inclusione, collaborazione e rispetto reciproco.</h2>
    <p class="text-slate-600 mb-4">Compila il modulo online e unisciti all'associazione.</p>
    <div class="mb-6">
        <a href="https://docs.google.com/forms/d/e/1FAIpQLSeSuhK_7-bpB4-07XHc_XP214gIbqkzjGYFGVLAwMT53XG0SQ/viewform?usp=dialog" target="_blank" rel="noopener noreferrer"
           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-sky-600 text-white font-semibold shadow hover:bg-sky-700 transition">
            Compila il modulo di adesione
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-4 text-sm">
        <p>
            Sostenere l’associazione significa contribuire alle nostre attività sul territorio.
            Diventando socio puoi partecipare attivamente, votare in assemblea e proporre iniziative.
        </p>

        <h2 class="text-lg font-semibold">Come associarsi</h2>
        <ol class="list-decimal list-inside space-y-1">
            <li>Compila il modulo di iscrizione (online o cartaceo).</li>
            <li>Versa la quota associativa annuale.</li>
            <li>Consegna il modulo al direttivo o invialo via email.</li>
        </ol>

        <h2 class="text-lg font-semibold mt-4">Quota associativa</h2>
        <p>
            La quota associativa per l’anno in corso è di <strong>importo ...€</strong>.
        </p>

        <h2 class="text-lg font-semibold mt-4">Dati per il versamento</h2>
        <p>
            <strong>Intestatario:</strong> Associazione No-Profit<br>
            <strong>IBAN:</strong> IT00 A000 0000 0000 0000 0000 000<br>
            <strong>Causale:</strong> Quota associativa [anno] - [Nome Cognome]
        </p>
    </div>
@endsection
