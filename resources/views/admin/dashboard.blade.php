@extends('layouts.app')

@section('title', 'Dashboard amministrativa')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dashboard amministrativa</h1>

    {{-- Widget numerici --}}
    <div class="grid md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-4">
            <p class="text-xs text-slate-500 mb-1">News pubblicate</p>
            <p class="text-2xl font-bold mb-2">{{ $stats['posts_count'] }}</p>
            <a href="{{ route('news.index') }}" class="text-xs text-sky-700 hover:underline">
                Vai alle news →
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4">
            <p class="text-xs text-slate-500 mb-1">Eventi</p>
            <p class="text-2xl font-bold mb-2">{{ $stats['events_count'] }}</p>
            <a href="{{ route('eventi.index') }}" class="text-xs text-sky-700 hover:underline">
                Vai agli eventi →
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4">
            <p class="text-xs text-slate-500 mb-1">Foto in galleria</p>
            <p class="text-2xl font-bold mb-2">{{ $stats['photos_count'] }}</p>
            <a href="{{ route('admin.gallery.index') }}" class="text-xs text-sky-700 hover:underline">
                Gestisci galleria →
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4">
            <p class="text-xs text-slate-500 mb-1">Messaggi ricevuti</p>
            <p class="text-2xl font-bold mb-2">{{ $stats['messages_count'] }}</p>
            <a href="{{ route('admin.messages.index') }}" class="text-xs text-sky-700 hover:underline">
                Vedi messaggi →
            </a>
        </div>
    </div>

    {{-- Azioni rapide --}}
    <div class="grid md:grid-cols-3 gap-4 mb-6">
        <a href="{{ route('posts.create') }}" class="bg-white rounded-xl shadow-sm p-4 flex flex-col justify-between">
            <div>
                <h2 class="font-semibold mb-1">Nuova news</h2>
                <p class="text-xs text-slate-500 mb-2">
                    Pubblica un nuovo aggiornamento sul blog dell’associazione.
                </p>
            </div>
            <span class="text-sm text-sky-700 font-semibold">Crea news →</span>
        </a>

        <a href="{{ route('events.create') }}" class="bg-white rounded-xl shadow-sm p-4 flex flex-col justify-between">
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
    <div class="grid md:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl shadow-sm p-4">
            <h2 class="font-semibold mb-3 text-sm">Prossimi / ultimi eventi</h2>
            @if ($latestEvents->isEmpty())
                <p class="text-xs text-slate-500">Nessun evento registrato.</p>
            @else
                <ul class="space-y-2 text-xs">
                    @foreach ($latestEvents as $event)
                        <li class="flex justify-between gap-2">
                            <div>
                                <p class="font-medium">{{ $event->title }}</p>
                                <p class="text-slate-500">
                                    {{ $event->starts_at?->format('d/m/Y H:i') ?? '-' }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-sm p-4">
            <h2 class="font-semibold mb-3 text-sm">Ultimi messaggi di contatto</h2>
            @if ($latestMessages->isEmpty())
                <p class="text-xs text-slate-500">Nessun messaggio ricevuto.</p>
            @else
                <ul class="space-y-2 text-xs">
                    @foreach ($latestMessages as $msg)
                        <li class="border-b border-slate-100 pb-2 last:border-0 last:pb-0">
                            <p class="font-medium">
                                {{ $msg->name }}
                                <span class="text-slate-500">({{ $msg->email }})</span>
                            </p>
                            @if ($msg->subject)
                                <p class="text-slate-600">{{ $msg->subject }}</p>
                            @endif
                            <p class="text-[11px] text-slate-400">
                                {{ $msg->created_at->format('d/m/Y H:i') }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
