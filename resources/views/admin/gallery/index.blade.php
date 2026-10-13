@extends('layouts.app')

@section('title', 'Gestione galleria')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-4 mt-12 md:mt-16">
        <h1 class="text-2xl font-bold">Gestione galleria</h1>

        <div class="flex gap-2">
            <a href="{{ route('admin.albums.index') }}" class="text-sm border border-slate-300 text-slate-700 px-3 py-1 rounded hover:bg-slate-50">Album</a>
            <a href="{{ route('admin.gallery.create', is_numeric($albumFilter) ? ['album' => $albumFilter] : []) }}"
               class="text-sm bg-sky-700 text-white px-3 py-1 rounded hover:bg-sky-800">
                Carica foto
            </a>
        </div>
    </div>

    {{-- Filtro per album --}}
    <form method="GET" action="{{ route('admin.gallery.index') }}" class="mb-4 flex items-center gap-2 text-sm">
        <label for="album" class="text-slate-600">Mostra:</label>
        <select id="album" name="album" onchange="this.form.submit()" class="border border-slate-300 rounded px-2 py-1">
            <option value="">Tutte le foto</option>
            <option value="nessuno" @selected($albumFilter === 'nessuno')>Senza album</option>
            @foreach ($albums as $album)
                <option value="{{ $album->id }}" @selected((string) $albumFilter === (string) $album->id)>{{ $album->title }}</option>
            @endforeach
        </select>
        <noscript><button type="submit" class="px-2 py-1 border rounded">Filtra</button></noscript>
    </form>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($photos->isEmpty())
        <p class="text-slate-600 text-sm">Nessuna foto ancora.</p>
    @else
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($photos as $photo)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="aspect-video bg-slate-100">
                        <img src="{{ $photo->thumb_url }}"
                            alt="{{ $photo->title ?? 'Foto' }}"
                            loading="lazy"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-3">
                        <p class="text-sm font-semibold mb-1">
                            {{ $photo->title ?? 'Senza titolo' }}
                        </p>
                        <p class="text-xs text-slate-500 mb-1">
                            Album: {{ $photo->album?->title ?? '—' }}
                        </p>
                        @if ($photo->caption)
                            <p class="text-xs text-slate-500 mb-1">
                                {{ $photo->caption }}
                            </p>
                        @endif
                        <p class="text-[11px] text-slate-400">
                            {{ $photo->published_at?->format('d/m/Y H:i') ?? $photo->created_at->format('d/m/Y H:i') }}
                            @if ($photo->is_visible)
                                • <span class="text-emerald-600">Visibile</span>
                            @else
                                • <span class="text-rose-600">Nascosta</span>
                            @endif
                        </p>
                        <div class="flex items-center gap-2 mt-3 text-xs">
                            <a href="{{ route('admin.gallery.edit', $photo) }}" class="px-2 py-1 bg-sky-100 text-sky-700 rounded hover:bg-sky-200">Modifica</a>
                            <form action="{{ route('admin.gallery.destroy', $photo) }}" method="POST" onsubmit="return confirm('Eliminare questa foto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-rose-100 text-rose-700 rounded hover:bg-rose-200">Elimina</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Paginazione --}}
        <div class="mt-6">
            {{ $photos->links() }}
        </div>
    @endif
@endsection
