@extends('layouts.public')

@section('title', 'Diventa socio - ASCAI Bologna')
@section('description', 'Unisciti ad AS.CA.I Bologna: come associarsi, quota associativa e modulo di iscrizione online per entrare nella comunità camerunese di Bologna.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Diventa parte della nostra comunità',
        'subtitle' => 'La forza di una comunità nasce dalla partecipazione attiva e condivisa.',
    ])

    {{-- Contenuto Principale --}}
    <h2 class="text-1xl mb-4"> Entrare a far parte della nostra associazione significa condividere valori, cultura e solidarietà. ASCAI Bologna è uno spazio di incontro, supporto e crescita, dove ogni socio contribuisce attivamente alla vita della comunità camerunese e al dialogo interculturale sul territorio. Unisciti a noi per partecipare alle attività,
        sostenere i nostri progetti e costruire insieme un futuro basato su inclusione, collaborazione e rispetto reciproco.</h2>
    @if ($formUrl)
        <p class="text-slate-600 mb-4">Compila il modulo online e unisciti all'associazione.</p>
        <div class="mb-6">
            <a href="{{ $formUrl }}" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-sky-600 text-white font-semibold shadow hover:bg-sky-700 transition">
                Compila il modulo di adesione per associarti.
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    @endif

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

        {{-- Quota e dati di pagamento: si modificano da Admin → Dati associazione --}}
        <h2 class="text-lg font-semibold mt-4">Quota associativa</h2>
        @if ($fee)
            <p>La quota associativa per l’anno in corso è di <strong>{{ $fee }}</strong>.</p>
        @else
            <p>
                Per conoscere la quota associativa di quest’anno
                <a href="{{ route('contatti') }}" class="text-sky-700 hover:underline">contattaci</a>.
            </p>
        @endif

        @if ($iban)
            <h2 class="text-lg font-semibold mt-4">Dati per il versamento</h2>
            <p>
                @if ($holder)
                    <strong>Intestatario:</strong> {{ $holder }}<br>
                @endif
                <strong>IBAN:</strong> <span class="font-mono">{{ $iban }}</span><br>
                @if ($reason)
                    <strong>Causale:</strong> {{ $reason }}
                @endif
            </p>
        @endif
    </div>
@endsection
