@extends('layouts.public')

@section('title', 'News - ASCAI Bologna')
@section('description', 'Novità, comunicati e aggiornamenti da AS.CA.I Bologna, l\'Associazione dei Camerunesi a Bologna.')

@section('content')
    @include('partials.page-header', [
        'title' => 'News',
        'subtitle' => 'Novità e aggiornamenti dall\'associazione',
        'actionUrl' => route('admin.posts.create'),
        'actionLabel' => 'Nuova news',
    ])

    {{-- Ricerca --}}
    <form method="GET" action="{{ route('posts.index') }}" class="mb-10 rounded-2xl bg-slate-50 border border-slate-200 p-4">
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-[2fr_1fr_1fr_auto] lg:items-end">
            <div class="sm:col-span-2 lg:col-span-1">
                <label for="search" class="block text-xs font-semibold text-slate-600 mb-1">Cerca</label>
                <input type="text" id="search" name="search" placeholder="Titolo o testo della news" value="{{ request('search') }}"
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
            <div class="flex gap-2 sm:col-span-2 lg:col-span-1">
                <button type="submit" class="flex-1 lg:flex-none px-6 py-2.5 rounded-lg bg-sky-700 hover:bg-sky-800 text-white font-semibold transition">Cerca</button>
                @if (request()->hasAny(['search', 'from_date', 'to_date']))
                    <a href="{{ route('posts.index') }}" class="px-4 py-2.5 rounded-lg text-slate-600 hover:bg-slate-200 font-semibold transition">Azzera</a>
                @endif
            </div>
        </div>
    </form>

    @if ($posts->isEmpty())
        <div class="rounded-2xl border border-dashed border-slate-300 p-12 text-center">
            <p class="text-slate-600 text-lg">
                {{ request()->hasAny(['search', 'from_date', 'to_date']) ? 'Nessuna news corrisponde alla ricerca.' : 'Non ci sono ancora news pubblicate.' }}
            </p>
        </div>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                @include('partials.news-card', ['post' => $post])
            @endforeach
        </div>

        <div class="mt-10">
            {{ $posts->links() }}
        </div>
    @endif
@endsection
