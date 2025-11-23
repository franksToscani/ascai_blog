@extends('layouts.app')

@section('title', 'Associati - Associazione No-Profit')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Diventa socio</h1>

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
            La quota associativa per l’anno in corso è di <strong>[importo €]</strong>.
        </p>

        <h2 class="text-lg font-semibold mt-4">Dati per il versamento</h2>
        <p>
            <strong>Intestatario:</strong> Associazione No-Profit<br>
            <strong>IBAN:</strong> IT00 A000 0000 0000 0000 0000 000<br>
            <strong>Causale:</strong> Quota associativa [anno] - [Nome Cognome]
        </p>
    </div>
@endsection
