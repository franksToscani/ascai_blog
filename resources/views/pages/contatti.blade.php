@extends('layouts.public')

@section('title', 'Contatti - Associazione No-Profit')

@section('content')
    <h1 class="text-lg sm:text-2xl font-bold mb-4 sm:mb-6">Contatti</h1>

    <div class="grid md:grid-cols-2 gap-4 sm:gap-6">
        <div class="bg-white rounded-lg sm:rounded-xl shadow-sm p-4 sm:p-6 space-y-3 text-sm">
            <p>
                Puoi contattarci per informazioni sull'associazione, sulle attività o per proporre collaborazioni.
            </p>
            <p>
                <strong>Email:</strong> <a href="mailto:info@associazione.it" class="text-sky-700 hover:underline">info@associazione.it</a><br>
                <strong>Telefono:</strong> <a href="tel:+390000000000" class="text-sky-700 hover:underline">+39 000 0000000</a><br>
                <strong>Indirizzo:</strong> Via Esempio 123, 40100 Bologna (BO)
            </p>
        </div>

        {{-- FORM DI CONTATTO --}}
            <div class="bg-white rounded-lg sm:rounded-xl shadow-sm p-4 sm:p-6">
                <h2 class="text-base sm:text-lg font-semibold mb-4">Scrivici</h2>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-3 sm:px-4 py-2 rounded text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-3 sm:px-4 py-2 rounded text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-3 sm:px-4 py-2 rounded text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('contatti.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs sm:text-sm font-medium mb-1">Nome</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full border border-slate-300 rounded px-3 py-2 text-sm sm:text-base focus:border-sky-700 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs sm:text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full border border-slate-300 rounded px-3 py-2 text-sm sm:text-base focus:border-sky-700 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs sm:text-sm font-medium mb-1">Oggetto (opzionale)</label>
                        <input type="text" name="subject" value="{{ old('subject') }}"
                            class="w-full border border-slate-300 rounded px-3 py-2 text-sm sm:text-base focus:border-sky-700 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs sm:text-sm font-medium mb-1">Messaggio</label>
                        <textarea name="message" rows="4" required
                                class="w-full border border-slate-300 rounded px-3 py-2 text-sm sm:text-base focus:border-sky-700 focus:outline-none">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="w-full sm:w-auto bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-sky-800 transition">
                        Invia messaggio
                    </button>
                </form>
            </div>

    </div>
@endsection
