@extends('layouts.app')

@section('title', 'Eventi - Associazione No-Profit')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Eventi</h1>

        {{-- Link per creare evento (per ora "admin manuale") --}}
        <a href="{{ route('events.create') }}" class="text-sm bg-sky-700 text-white px-3 py-1 rounded">
            Nuovo evento
        </a>
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
                        <h3 class="font-semibold text-lg mb-1">
                            <a href="{{ route('eventi.show', $event) }}" class="text-sky-700 hover:underline">
                                {{ $event->title }}
                            </a>
                        </h3>
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
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-medium">
                                    <a href="{{ route('eventi.show', $event) }}" class="text-sky-700 hover:underline">
                                        {{ $event->title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-500">
                                    {{ $event->starts_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
