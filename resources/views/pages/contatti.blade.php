@extends('layouts.app')

@section('title', 'Contatti - Associazione No-Profit')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Contatti</h1>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 space-y-3 text-sm">
            <p>
                Puoi contattarci per informazioni sull’associazione, sulle attività o per proporre collaborazioni.
            </p>
            <p>
                <strong>Email:</strong> info@associazione.it<br>
                <strong>Telefono:</strong> +39 000 0000000<br>
                <strong>Indirizzo:</strong> Via Esempio 123, 40100 Bologna (BO)
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <p class="text-sm text-slate-500 mb-3">
                Nello Sprint 3 trasformeremo questa sezione in un vero form contatti che salva i messaggi nel DB.
            </p>
            <div class="h-32 bg-slate-200 rounded flex items-center justify-center text-xs text-slate-500">
                Qui potrà andare la mappa o il form di contatto.
            </div>
        </div>
    </div>
@endsection
