@extends('layouts.public')

@section('title', 'Eventi - Associazione No-Profit')

@section('content')

{{-- link per creare un nuovo evento, visibile solo agli admin --}}
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Eventi</h1>
        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.events.create') }}" class="text-sm bg-sky-700 text-white px-3 py-1 rounded">
                    Nuovo evento
                </a>
            @endif
        @endauth
    </div>


    {{-- Prossimi eventi --}}
    <section class="mb-6">
        <h2 class="text-lg font-semibold mb-2">Prossimi eventi</h2>

        @if ($upcomingEvents->isEmpty())
            <p class="text-sm text-slate-600">Al momento non ci sono eventi in programma.</p>
        @else
            <div class="space-y-3">
                @foreach ($upcomingEvents as $event)
                    <article class="bg-white rounded-lg shadow-sm p-4">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-semibold text-lg">
                                <a href="{{ route('eventi.show', $event) }}" class="text-sky-700 hover:underline">
                                    {{ $event->title }}
                                </a>
                            </h3>
                            @auth
                                @if(auth()->user()->is_admin)
                                    <div class="flex items-center gap-2 text-xs whitespace-nowrap ml-2">
                                        <a href="{{ route('admin.events.edit', $event) }}" class="text-blue-600 hover:underline">Modifica</a>
                                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Eliminare questo evento?')">Elimina</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        <p class="text-xs text-slate-500 mb-1">
                            {{ $event->starts_at->format('d/m/Y H:i') }}
                            @if ($event->location)
                                • {{ $event->location }}
                            @endif
                        </p>
                        <p class="text-sm text-slate-700">
                            {{ \Illuminate\Support\Str::limit($event->description, 150) }}
                        </p>
                    </article>
                @endforeach
            </div>

            {{-- Paginazione prossimi eventi --}}
            <div class="mt-4">
                {{ $upcomingEvents->links() }}
            </div>
        @endif
    </section>

    {{-- Eventi passati --}}
    <section>
        <h2 class="text-lg font-semibold mb-2">Eventi passati</h2>

        @if ($pastEvents->isEmpty())
            <p class="text-sm text-slate-600">Non ci sono ancora eventi passati registrati.</p>
        @else
            <div class="space-y-2">
                @foreach ($pastEvents as $event)
                    <article class="bg-white rounded-lg shadow-sm p-3">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="font-medium">
                                    <a href="{{ route('eventi.show', $event) }}" class="text-sky-700 hover:underline">
                                        {{ $event->title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-500">
                                    {{ $event->starts_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            @auth
                                @if(auth()->user()->is_admin)
                                    <div class="flex items-center gap-2 text-xs whitespace-nowrap ml-2">
                                        <a href="{{ route('admin.events.edit', $event) }}" class="text-blue-600 hover:underline">Modifica</a>
                                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Eliminare questo evento?')">Elimina</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Paginazione eventi passati --}}
            <div class="mt-4">
                {{ $pastEvents->links() }}
            </div>
        @endif
    </section>
@endsection
