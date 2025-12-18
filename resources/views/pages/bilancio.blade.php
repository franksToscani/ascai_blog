@extends('layouts.public')

@section('title', 'Bilancio sociale - ASCAI Bologna')

@section('content')
    {{-- Header --}}
    <div class="mb-8 bg-gradient-to-r from-sky-50 to-blue-50 rounded-2xl border border-sky-100 p-8 mt-10 md:mt-12">
        <h1 class="text-4xl font-extrabold text-slate-800 mb-2">Bilanci dell'associazione</h1>
        <p class="text-slate-600 text-lg">Trasparenza e rendicontazione dell'attività di AS.CA.I Bologna</p>
    </div>

    {{-- Contenuto Principale --}}
    <div class="grid md:grid-cols-3 gap-6 mb-12">
        {{-- Bilancio --}}
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-8">
                <div class="bg-sky-50 border border-sky-200 rounded-lg p-6">
                    <h3 class="font-bold text-slate-800 mb-2">Trasparenza e accountability</h3>
                    <p class="text-sm text-slate-600 mb-4">
                        ASCAI Bologna è un'associazione no-profit impegnata nel fornire completa trasparenza sulle proprie attività e sulla gestione delle risorse. Il bilancio sociale documentare l'impatto generato dalle nostre iniziative sulla comunità.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-6">Bilanci storici</h2>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-200 hover:border-sky-200 hover:shadow-md transition-all">
                            <div>
                                <p class="font-semibold text-slate-800">Bilancio 2024</p>
                                <p class="text-xs text-slate-600 mt-1">Ultimo anno fiscale</p>
                            </div>
                            <a href="#" class="inline-flex items-center gap-2 text-sky-600 hover:text-sky-700 font-semibold transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Scarica (PDF)
                            </a>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-200 hover:border-sky-200 hover:shadow-md transition-all">
                            <div>
                                <p class="font-semibold text-slate-800">Bilancio 2023</p>
                                <p class="text-xs text-slate-600 mt-1">Anno precedente</p>
                            </div>
                            <a href="#" class="inline-flex items-center gap-2 text-sky-600 hover:text-sky-700 font-semibold transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Scarica (PDF)
                            </a>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-200 hover:border-sky-200 hover:shadow-md transition-all">
                            <div>
                                <p class="font-semibold text-slate-800">Bilancio 2022</p>
                                <p class="text-xs text-slate-600 mt-1">Archivio</p>
                            </div>
                            <a href="#" class="inline-flex items-center gap-2 text-sky-600 hover:text-sky-700 font-semibold transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Scarica (PDF)
                            </a>
                        </div>
                    </div>
                </div>

                <hr class="border-slate-200">

                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-6">Utilizzo delle risorse</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-lg p-6">
                            <h3 class="text-lg font-bold text-green-900 mb-2">Entrate</h3>
                            <ul class="space-y-2 text-sm text-green-800">
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0V6H3a1 1 0 110-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V6h-1a1 1 0 110-2h1V3a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Quote associative</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0V6H3a1 1 0 110-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V6h-1a1 1 0 110-2h1V3a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Donazioni</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0V6H3a1 1 0 110-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V6h-1a1 1 0 110-2h1V3a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Finanziamenti pubblici</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0V6H3a1 1 0 110-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V6h-1a1 1 0 110-2h1V3a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Sponsorizzazioni</span>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-gradient-to-br from-orange-50 to-red-50 border border-orange-200 rounded-lg p-6">
                            <h3 class="text-lg font-bold text-orange-900 mb-2">Uscite</h3>
                            <ul class="space-y-2 text-sm text-orange-800">
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0V6H3a1 1 0 110-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V6h-1a1 1 0 110-2h1V3a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Organizzazione eventi</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0V6H3a1 1 0 110-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V6h-1a1 1 0 110-2h1V3a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Progetti sociali</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0V6H3a1 1 0 110-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V6h-1a1 1 0 110-2h1V3a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Spese amministrative</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0V6H3a1 1 0 110-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V6h-1a1 1 0 110-2h1V3a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Comunicazione</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mt-8">
                    <h3 class="font-bold text-slate-800 mb-2">Trasparenza totale</h3>
                    <p class="text-sm text-slate-600 mb-4">
                        I documenti finanziari di ASCAI Bologna sono disponibili per la consultazione. Per ulteriori informazioni, non esitare a contattarci.
                    </p>
                    <a href="{{ route('contatti') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold transition-colors">
                        Richiedi informazioni
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            <div class="bg-sky-50 border border-sky-200 rounded-xl p-6 sticky top-24">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Sezioni correlate</h3>
                <nav class="space-y-2">
                    <a href="{{ route('chi-siamo') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-white transition-all {{ request()->routeIs('chi-siamo') ? 'text-sky-600 bg-white' : '' }}">
                        Chi siamo
                    </a>
                    <a href="{{ route('statuto') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-white transition-all {{ request()->routeIs('statuto') ? 'text-sky-600 bg-white' : '' }}">
                        Statuto
                    </a>
                    <a href="{{ route('staff-ascaibo') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-white transition-all {{ request()->routeIs('staff-ascaibo') ? 'text-sky-600 bg-white' : '' }}">
                        Lo staff
                    </a>
                    <a href="{{ route('bilancio') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-white transition-all {{ request()->routeIs('bilancio') ? 'text-sky-600 bg-white' : '' }}">
                        Bilancio sociale
                    </a>
                </nav>
            </div>
        </div>
    </div>
@endsection
