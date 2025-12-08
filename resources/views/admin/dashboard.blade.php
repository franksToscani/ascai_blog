@extends('layouts.app')

@section('title', 'Dashboard amministrativa')

@section('content')
    {{-- Header con gradiente --}}
    <div class="mb-8 bg-gradient-to-r from-slate-50 via-slate-100 to-slate-50 rounded-2xl p-8 shadow-sm border border-slate-200">
        <h1 class="text-4xl font-extrabold text-slate-800 mb-2">Dashboard Amministrativa</h1>
        <p class="text-slate-600">Gestisci contenuti, eventi e messaggi dell'associazione ASCAI Bologna</p>
    </div>

    {{-- Widget numerici con icone --}}
    <div class="grid md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border border-sky-100">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-3xl font-bold text-slate-800">{{ $stats['posts_count'] }}</span>
            </div>
            <p class="text-sm font-semibold text-slate-700 mb-2">News pubblicate</p>
            <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center text-xs text-sky-600 hover:text-sky-700 font-semibold">
                Vai alle news
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border border-green-100">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-3xl font-bold text-slate-800">{{ $stats['events_count'] }}</span>
            </div>
            <p class="text-sm font-semibold text-slate-700 mb-2">Eventi</p>
            <a href="{{ route('admin.events.index') }}" class="inline-flex items-center text-xs text-green-600 hover:text-green-700 font-semibold">
                Vai agli eventi
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border border-purple-100">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-3xl font-bold text-slate-800">{{ $stats['photos_count'] }}</span>
            </div>
            <p class="text-sm font-semibold text-slate-700 mb-2">Foto in galleria</p>
            <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center text-xs text-purple-600 hover:text-purple-700 font-semibold">
                Gestisci galleria
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 p-6 border border-orange-100">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-3xl font-bold text-slate-800">{{ $stats['messages_count'] }}</span>
            </div>
            <p class="text-sm font-semibold text-slate-700 mb-2">Messaggi ricevuti</p>
            <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center text-xs text-orange-600 hover:text-orange-700 font-semibold">
                Vedi messaggi
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- Link al registro di audit con icona --}}
    <div class="mb-8">
        <a href="{{ route('admin.audit-log') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-slate-700 to-slate-800 text-white px-5 py-3 rounded-lg text-sm font-semibold hover:from-slate-800 hover:to-slate-900 shadow-md hover:shadow-lg transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Visualizza registro di audit
        </a>
    </div>

    {{-- Azioni rapide --}}
    <div class="grid md:grid-cols-3 gap-4 mb-6">
        <a href="{{ route('admin.posts.create') }}" class="bg-white rounded-xl shadow-sm p-4 flex flex-col justify-between">
            <div>
                <h2 class="font-semibold mb-1">Nuova news</h2>
                <p class="text-xs text-slate-500 mb-2">
                    Pubblica un nuovo aggiornamento sul blog dell’associazione.
                </p>
            </div>
            <span class="text-sm text-sky-700 font-semibold">Crea news →</span>
        </a>

        <a href="{{ route('admin.events.create') }}" class="bg-white rounded-xl shadow-sm p-4 flex flex-col justify-between">
            <div>
                <h2 class="font-semibold mb-1">Nuovo evento</h2>
                <p class="text-xs text-slate-500 mb-2">
                    Aggiungi un evento al calendario dell’associazione.
                </p>
            </div>
            <span class="text-sm text-sky-700 font-semibold">Crea evento →</span>
        </a>

        <a href="{{ route('admin.gallery.create') }}" class="bg-white rounded-xl shadow-sm p-4 flex flex-col justify-between">
            <div>
                <h2 class="font-semibold mb-1">Aggiungi foto</h2>
                <p class="text-xs text-slate-500 mb-2">
                    Carica nuove immagini nella galleria fotografica.
                </p>
            </div>
            <span class="text-sm text-sky-700 font-semibold">Carica foto →</span>
        </a>
    </div>


    {{-- Colonne: ultimi eventi e ultimi messaggi --}}
    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-md border border-slate-200 p-6">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="font-bold text-slate-800">Prossimi / ultimi eventi</h2>
            </div>
            @if ($latestEvents->isEmpty())
                <p class="text-sm text-slate-500">Nessun evento registrato.</p>
            @else
                <ul class="space-y-3">
                    @foreach ($latestEvents as $event)
                        <li class="border-l-2 border-green-400 pl-3 py-2 hover:bg-slate-50 transition-colors">
                            <p class="font-semibold text-slate-800 text-sm">{{ $event->title }}</p>
                            <p class="text-xs text-slate-500 mt-1">
                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $event->starts_at?->format('d/m/Y H:i') ?? '-' }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-md border border-slate-200 p-6">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="font-bold text-slate-800">Ultimi messaggi di contatto</h2>
            </div>
            @if ($latestMessages->isEmpty())
                <p class="text-sm text-slate-500">Nessun messaggio ricevuto.</p>
            @else
                <ul class="space-y-3">
                    @foreach ($latestMessages as $msg)
                        <li class="border-l-2 border-orange-400 pl-3 py-2 hover:bg-slate-50 transition-colors">
                            <p class="font-semibold text-slate-800 text-sm">
                                {{ $msg->name }}
                            </p>
                            <p class="text-xs text-slate-500 mt-1">
                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ $msg->email }}
                            </p>
                            @if ($msg->subject)
                                <p class="text-xs text-slate-600 mt-1">{{ $msg->subject }}</p>
                            @endif
                            <p class="text-[11px] text-slate-400 mt-1">
                                {{ $msg->created_at->format('d/m/Y H:i') }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
