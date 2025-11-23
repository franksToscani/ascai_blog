@extends('layouts.app')

@section('title', $event->title . ' - Eventi')

@section('content')
    <article class="bg-white rounded-xl shadow-sm p-6">
        <h1 class="text-2xl font-bold mb-2">{{ $event->title }}</h1>

        <p class="text-sm text-slate-500 mb-3">
            Inizio: {{ $event->starts_at->format('d/m/Y H:i') }}<br>
            @if ($event->ends_at)
                Fine: {{ $event->ends_at->format('d/m/Y H:i') }}<br>
            @endif
            @if ($event->location)
                Luogo: {{ $event->location }}
            @endif
        </p>

        <div class="prose max-w-none text-slate-800">
            {!! nl2br(e($event->description)) !!}
        </div>
    </article>

    <div class="mt-4">
        <a href="{{ route('eventi.index') }}" class="text-sky-700 text-sm hover:underline">
            ← Torna alla lista eventi
        </a>
    </div>
@endsection
