@extends('layouts.public')

@section('title', 'Lo staff - ASCAI Bologna')
@section('description', 'Il consiglio direttivo e i collaboratori di AS.CA.I Bologna: le persone che dedicano il loro tempo all\'associazione.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Lo staff dell\'AS.CA.I Bologna',
        'subtitle' => 'Le persone che dedicano il loro tempo all\'associazione',
    ])

    {{-- Contenuto Principale --}}
    <div class="grid md:grid-cols-3 gap-6 mb-12">
        {{-- Staff --}}
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-8">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-6">Il consiglio direttivo</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Card Staff: i dati si modificano da Admin → Staff --}}
                        @foreach ($direttivo as $member)
                            <div class="bg-slate-50 border border-slate-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start gap-4">
                                    @if ($member->photo_url)
                                        <img src="{{ $member->photo_url }}" alt="{{ $member->name ?? $member->role }}" loading="lazy"
                                             class="w-16 h-16 rounded-full object-cover flex-shrink-0 ring-2 ring-slate-200">
                                    @else
                                        <div class="w-16 h-16 bg-sky-600 rounded-full flex items-center justify-center flex-shrink-0">
                                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-bold text-slate-800">{{ $member->role }}</h3>
                                        @if ($member->name)
                                            <p class="text-sm text-sky-600 font-semibold">{{ $member->name }}</p>
                                        @endif
                                        @if ($member->description)
                                            <p class="text-xs text-slate-600 mt-1">{{ $member->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <hr class="border-slate-200">

                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-6">I collaboratori</h2>
                    <p class="text-slate-600 leading-relaxed mb-4">
                        Accanto al consiglio direttivo, ASCAI Bologna ha una rete di collaboratori appassionati che dedicano il loro tempo alle attività dell'associazione.
                    </p>
                    <div class="grid md:grid-cols-3 gap-4">
                        @foreach ($collaboratori as $member)
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <p class="font-semibold text-slate-800">{{ $member->role }}</p>
                                @if ($member->name)
                                    <p class="text-sm text-sky-600 font-semibold">{{ $member->name }}</p>
                                @endif
                                @if ($member->description)
                                    <p class="text-sm text-slate-600 mt-1">{{ $member->description }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-slate-50 border border-slate-200 rounded-lg p-6 mt-8">
                    <h3 class="font-bold text-slate-800 mb-2">Vuoi unirti al nostro team?</h3>
                    <p class="text-sm text-slate-600 mb-4">
                        Se sei interessato a collaborare con ASCAI Bologna, contattaci! Cerchiamo sempre persone motivate e disponibili.
                    </p>
                    <a href="{{ route('contatti') }}" class="inline-flex items-center gap-2 text-sky-600 hover:text-sky-700 font-semibold transition-colors">
                        Inviaci un messaggio
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-6 sticky top-24">
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
