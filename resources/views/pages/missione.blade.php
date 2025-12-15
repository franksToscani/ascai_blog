@extends('layouts.public')

@section('title', 'La nostra missione - ASCAI Bologna')

@section('content')
    {{-- Header --}}
    <div class="mb-8 bg-gradient-to-r from-sky-50 to-blue-50 rounded-2xl border border-sky-100 p-8">
        <h1 class="text-4xl font-extrabold text-slate-800 mb-2">La nostra missione</h1>
        <p class="text-slate-600 text-lg">I valori e gli obiettivi che guidano ASCAI Bologna</p>
    </div>

    {{-- Contenuto Principale --}}
    <div class="grid md:grid-cols-3 gap-6 mb-12">
        {{-- Missione --}}
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">Chi siamo</h2>
                    <p class="text-slate-600 leading-relaxed mb-4">
                        ASCAI Bologna è un'associazione no-profit fondata con la missione di promuovere l'integrazione, la solidarietà e lo scambio culturale tra la comunità camerunese e la società bolognese.
                    </p>
                    <p class="text-slate-600 leading-relaxed">
                        Crediamo che la diversità sia una ricchezza e lavoriamo quotidianamente per costruire ponti fra le culture, favorendo il dialogo e la comprensione reciproca.
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
                    <a href="{{ route('missione') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-white transition-all {{ request()->routeIs('missione') ? 'text-sky-600 bg-white' : '' }}">
                        La missione
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
