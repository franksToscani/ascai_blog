@extends('layouts.public')

@section('title', 'Chi siamo - ASCAI Bologna')

@section('content')
    {{-- Header --}}
    <div class="mb-8 bg-gradient-to-r from-sky-50 to-blue-50 rounded-2xl border border-sky-100 p-8 mt-12 md:mt-16">
        <h1 class="text-4xl font-extrabold text-slate-800 mb-2">Chi siamo</h1>
        <p class="text-slate-600 text-lg">L'Associazione dei Camerunesi di Bologna</p>
    </div>

    {{-- Contenuto Principale --}}
    <div class="grid md:grid-cols-3 gap-6 mb-12 mt-12 md:mt-16">
        {{-- Chi siamo --}}
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">Chi siamo</h2>
                    <p class="text-slate-600 leading-relaxed mb-4">
                        ASCAI Bologna è un'associazione no-profit fondata con la missione di promuovere l'integrazione, la solidarietà e lo scambio culturale tra la comunità camerunese e la società bolognese.
                    </p>
                    <p class="text-slate-600 leading-relaxed mb-4">
                        Crediamo che la diversità sia una ricchezza e lavoriamo quotidianamente per costruire ponti fra le culture, favorendo il dialogo e la comprensione reciproca.
                    </p>
                    <p class="text-slate-600 leading-relaxed">
                        La nostra associazione si impegna a supportare i membri della comunità camerunese a Bologna, offrendo sostegno, promuovendo attività culturali e creando occasioni di incontro e scambio con la comunità locale.
                    </p>
                </div>

                <hr class="border-slate-200">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">La nostra missione</h2>
                    <ul class="space-y-3 text-slate-600">
                        <li class="flex gap-3">
                            <svg class="w-6 h-6 text-sky-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Promuovere l'integrazione e l'inclusione della comunità camerunese nella società bolognese</span>
                        </li>
                        <li class="flex gap-3">
                            <svg class="w-6 h-6 text-sky-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Tutelare i diritti e promuovere i doveri di tutti i nostri associati</span>
                        </li>
                        <li class="flex gap-3">
                            <svg class="w-6 h-6 text-sky-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Organizzare eventi culturali e attività che celebrano le tradizioni camerunesi</span>
                        </li>
                        <li class="flex gap-3">
                            <svg class="w-6 h-6 text-sky-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Favorire l'educazione, la formazione e l'informazione sui temi di interesse comune</span>
                        </li>
                        <li class="flex gap-3">
                            <svg class="w-6 h-6 text-sky-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Promuovere la solidarietà e la cooperazione con altre associazioni e realtà del territorio</span>
                        </li>
                    </ul>
                </div>


                <hr class="border-slate-200">

                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">I nostri valori</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="bg-sky-50 rounded-lg p-5 border border-sky-100">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-6 h-6 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                </svg>
                                <h3 class="font-bold text-slate-800">Inclusione</h3>
                            </div>
                            <p class="text-sm text-slate-600">Accogliamo tutte le persone senza distinzioni, promuovendo l'integrazione e il rispetto reciproco.</p>
                        </div>

                        <div class="bg-green-50 rounded-lg p-5 border border-green-100">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                </svg>
                                <h3 class="font-bold text-slate-800">Solidarietà</h3>
                            </div>
                            <p class="text-sm text-slate-600">Supportiamo i nostri membri e collaboriamo con altre realtà per creare una rete di sostegno.</p>
                        </div>

                        <div class="bg-purple-50 rounded-lg p-5 border border-purple-100">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                </svg>
                                <h3 class="font-bold text-slate-800">Cultura</h3>
                            </div>
                            <p class="text-sm text-slate-600">Valorizziamo le tradizioni camerunesi e promuoviamo lo scambio culturale con la comunità bolognese.</p>
                        </div>

                        <div class="bg-amber-50 rounded-lg p-5 border border-amber-100">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                </svg>
                                <h3 class="font-bold text-slate-800">Impegno</h3>
                            </div>
                            <p class="text-sm text-slate-600">Lavoriamo con dedizione per raggiungere i nostri obiettivi e servire al meglio la comunità.</p>
                        </div>
                    </div>
                </div>

                <hr class="border-slate-200">

                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">Le nostre attività</h2>
                    <p class="text-slate-600 leading-relaxed mb-4">
                        Organizziamo regolarmente eventi culturali, workshop, incontri formativi e momenti di aggregazione per favorire l'integrazione e mantenere vive le tradizioni della comunità camerunese.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-full text-sm font-semibold">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                            Eventi culturali
                        </span>
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-700 rounded-full text-sm font-semibold">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                            </svg>
                            Formazione
                        </span>
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-purple-50 text-purple-700 rounded-full text-sm font-semibold">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                            </svg>
                            Incontri sociali
                        </span>
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 text-amber-700 rounded-full text-sm font-semibold">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                            </svg>
                            Workshop
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            <div class="bg-sky-50 border border-sky-200 rounded-xl p-6 sticky top-24">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Sezioni correlate</h3>
                <nav class="space-y-2">
                    <a href="{{ route('chi-siamo') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-sky-600 bg-white transition-all">
                        Chi siamo
                    </a>
                    <a href="{{ route('statuto') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-white transition-all">
                        Statuto
                    </a>
                    <a href="{{ route('staff-ascaibo') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-white transition-all">
                        Lo staff
                    </a>
                    <a href="{{ route('bilancio') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-white transition-all">
                        Bilancio sociale
                    </a>
                </nav>
            </div>
        </div>
    </div>
@endsection
