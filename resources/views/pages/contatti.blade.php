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

        {{-- FORM DI CONTATTO --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-semibold mb-4">Scrivici</h2>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('contatti.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium mb-1">Nome</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border border-slate-300 rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full border border-slate-300 rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Oggetto (opzionale)</label>
                        <input type="text" name="subject" value="{{ old('subject') }}"
                            class="w-full border border-slate-300 rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Messaggio</label>
                        <textarea name="message" rows="5"
                                class="w-full border border-slate-300 rounded px-3 py-2">{{ old('message') }}</textarea>
                    </div>

                    <button class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold">
                        Invia messaggio
                    </button>
                </form>
            </div>

    </div>
@endsection
