@extends('layouts.public')

@section('title', 'Eventi - ASCAI Bologna')
@section('description', 'Prossimi eventi e iniziative passate di AS.CA.I Bologna: incontri culturali, feste, workshop e attività per la comunità.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Eventi',
        'subtitle' => 'Incontri, feste e attività dell\'associazione: partecipa anche tu',
        'actionUrl' => route('admin.events.create'),
        'actionLabel' => 'Nuovo evento',
    ])

    {{-- Ricerca --}}
    <form method="GET" action="{{ route('eventi.index') }}" class="mb-10 rounded-2xl bg-slate-50 border border-slate-200 p-4">
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-[2fr_1fr_1fr_1.2fr_auto] lg:items-end">
            <div class="sm:col-span-2 lg:col-span-1">
                <label for="search" class="block text-xs font-semibold text-slate-600 mb-1">Cerca</label>
                <input type="text" id="search" name="search" placeholder="Titolo o descrizione" value="{{ request('search') }}"
                       class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-sky-200">
            </div>
            <div>
                <label for="from_date" class="block text-xs font-semibold text-slate-600 mb-1">Dal</label>
                <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}"
                       class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-sky-200">
            </div>
            <div>
                <label for="to_date" class="block text-xs font-semibold text-slate-600 mb-1">Al</label>
                <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}"
                       class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-sky-200">
            </div>
            <div class="sm:col-span-2 lg:col-span-1">
                <label for="location" class="block text-xs font-semibold text-slate-600 mb-1">Luogo</label>
                <input type="text" id="location" name="location" placeholder="Es. Bologna" value="{{ request('location') }}"
                       class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-sky-200">
            </div>
            <div class="flex gap-2 sm:col-span-2 lg:col-span-1">
                <button type="submit" class="flex-1 lg:flex-none px-6 py-2.5 rounded-lg bg-sky-700 hover:bg-sky-800 text-white font-semibold transition">Cerca</button>
                @if (request()->hasAny(['search', 'from_date', 'to_date', 'location']))
                    <a href="{{ route('eventi.index') }}" class="px-4 py-2.5 rounded-lg text-slate-600 hover:bg-slate-200 font-semibold transition">Azzera</a>
                @endif
            </div>
        </div>
    </form>

    {{-- Prossimi eventi --}}
    <section class="mb-14">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Prossimi eventi</h2>

        @if ($upcomingEvents->isEmpty())
            <div class="rounded-2xl border border-dashed border-slate-300 p-12 text-center">
                <p class="text-slate-600 text-lg">Nessun evento in programma al momento.</p>
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($upcomingEvents as $event)
                    @include('partials.event-card', ['event' => $event])
                @endforeach
            </div>

            <div class="mt-8">
                {{ $upcomingEvents->links() }}
            </div>
        @endif
    </section>

    {{-- Eventi passati: elenco compatto e sobrio --}}
    <section>
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Eventi passati</h2>

        @if ($pastEvents->isEmpty())
            <p class="text-slate-500">Nessun evento passato.</p>
        @else
            <div class="rounded-2xl border border-slate-200 bg-white divide-y divide-slate-100">
                @foreach ($pastEvents as $event)
                    <article class="group relative flex items-center gap-4 px-5 py-4 hover:bg-slate-50 transition">
                        <time datetime="{{ $event->starts_at->toDateString() }}" class="w-24 flex-shrink-0 text-sm text-slate-500">
                            {{ $event->starts_at->translatedFormat('j M Y') }}
                        </time>
                        <div class="min-w-0 flex-1">
                            <h3 class="font-semibold text-slate-800 group-hover:text-sky-700 transition-colors truncate">
                                <a href="{{ route('eventi.show', $event) }}" class="after:absolute after:inset-0">{{ $event->title }}</a>
                            </h3>
                            @if ($event->location)
                                <p class="text-sm text-slate-500 truncate">{{ $event->location }}</p>
                            @endif
                        </div>
                        @include('partials.admin-actions', [
                            'editUrl' => route('admin.events.edit', $event),
                            'deleteUrl' => route('admin.events.destroy', $event),
                            'confirm' => 'Eliminare questo evento?',
                        ])
                    </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $pastEvents->links() }}
            </div>
        @endif
    </section>
@endsection
