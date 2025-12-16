@extends('layouts.public')

@section('title', 'Contatti - Associazione No-Profit')

@section('content')
    {{-- Header --}}
    <div class="mb-8 bg-gradient-to-r from-sky-50 to-cyan-50 rounded-2xl border border-sky-100 p-8 mt-12 md:mt-16">
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-2">Contattaci</h1>
        <p class="text-slate-600">Siamo qui per rispondere alle tue domande e ascoltare le tue proposte</p>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        {{-- INFO CONTATTI --}}
        <div class="bg-white rounded-xl shadow-md border border-slate-100 p-6 space-y-6">
            <div>
                <h2 class="text-xl font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Informazioni di contatto
                </h2>
                <p class="text-slate-600 leading-relaxed">
                    Puoi contattarci per informazioni sull'associazione, sulle attività o per proporre collaborazioni.
                </p>
            </div>

            {{-- Email --}}
            <div class="flex items-start gap-4 p-4 bg-sky-50 rounded-lg border border-sky-100">
                <div class="flex-shrink-0 w-10 h-10 bg-sky-700 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Email</p>
                    <a href="mailto:associazione.camer.bologna@gmail.com" class="text-sky-700 hover:text-sky-800 font-semibold text-sm hover:underline">
                        associazione.camer.bologna@gmail.com
                    </a>
                </div>
            </div>

            {{-- Indirizzo --}}
            <div class="flex items-start gap-4 p-4 bg-green-50 rounded-lg border border-green-100">
                <div class="flex-shrink-0 w-10 h-10 bg-green-700 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Sede</p>
                    <p class="text-slate-700 text-sm leading-relaxed">
                        Cassero di Porta Galliera<br>
                        Piazza XX Settembre 7<br>
                        40121 Bologna (BO)
                    </p>
                </div>
            </div>

            {{-- P.IVA --}}
            <div class="flex items-start gap-4 p-4 bg-purple-50 rounded-lg border border-purple-100">
                <div class="flex-shrink-0 w-10 h-10 bg-purple-700 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Dati fiscali</p>
                    <p class="text-slate-700 text-sm">
                        <strong>P.IVA e Cod. Fisc:</strong> 94048620549
                    </p>
                </div>
            </div>

            {{-- Link social --}}
            <div class="pt-4 border-t border-slate-200">
                <a href="https://linktr.ee/ascai.bologna" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center gap-2 text-sky-700 hover:text-sky-800 font-semibold transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    <span>I nostri link social</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- FORM DI CONTATTO --}}
        <div class="bg-white rounded-xl shadow-md border border-slate-100 p-6">
            <h2 class="text-xl font-bold text-slate-800 mb-2 flex items-center gap-2">
                <svg class="w-6 h-6 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Scrivici un messaggio
            </h2>
            <p class="text-sm text-slate-600 mb-6">Compila il form e ti risponderemo al più presto</p>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-green-800 font-semibold">Messaggio inviato!</p>
                            <p class="text-green-700 text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-red-800 font-semibold">Errore</p>
                            <p class="text-red-700 text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="flex-1">
                            <p class="text-red-800 font-semibold mb-2">Correggi i seguenti errori:</p>
                            <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('contatti.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Nome <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border-2 border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all @error('name') border-red-500 @enderror"
                        placeholder="Il tuo nome completo">
                    @error('name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border-2 border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all @error('email') border-red-500 @enderror"
                        placeholder="tuaemail@esempio.com">
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Oggetto <span class="text-slate-400 text-xs font-normal">(opzionale)</span>
                    </label>
                    <input type="text" name="subject" value="{{ old('subject') }}"
                        class="w-full border-2 border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all"
                        placeholder="Oggetto del messaggio">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Messaggio <span class="text-red-500">*</span>
                    </label>
                    <textarea name="message" rows="5" required
                        class="w-full border-2 border-slate-200 rounded-lg px-4 py-2.5 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all resize-none @error('message') border-red-500 @enderror"
                        placeholder="Scrivi qui il tuo messaggio...">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" 
                    class="w-full md:w-auto inline-flex items-center justify-center gap-2 bg-sky-700 hover:bg-sky-800 text-white px-8 py-3 rounded-lg font-semibold shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    <span>Invia messaggio</span>
                </button>

                <p class="text-xs text-slate-500 mt-4">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    I tuoi dati sono protetti e verranno utilizzati solo per rispondere alla tua richiesta.
                </p>
            </form>
        </div>

    </div>
@endsection
