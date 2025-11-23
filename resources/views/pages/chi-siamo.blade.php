@extends('layouts.app')

@section('title', 'Chi siamo - Associazione No-Profit')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Chi siamo</h1>

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-4">
        <p>
            La nostra associazione nasce con l’obiettivo di <strong>[descrivi la missione]</strong>.
        </p>
        <p>
            Qui puoi raccontare la storia, i valori, le attività principali, ecc.
        </p>

        <h2 class="text-xl font-semibold mt-4">Il direttivo</h2>
        <ul class="list-disc list-inside text-sm text-slate-700">
            <li>Presidente: [nome]</li>
            <li>Vicepresidente: [nome]</li>
            <li>Segretario: [nome]</li>
            <li>Tesoriere: [nome]</li>
        </ul>
    </div>
@endsection
