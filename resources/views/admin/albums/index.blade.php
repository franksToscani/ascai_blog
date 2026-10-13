@extends('layouts.app')

@section('title', 'Album fotografici')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-4 mt-12 md:mt-16">
        <h1 class="text-2xl font-bold">Album fotografici</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.gallery.index') }}" class="text-sm border border-slate-300 text-slate-700 px-3 py-1 rounded hover:bg-slate-50">Tutte le foto</a>
            <a href="{{ route('admin.albums.create') }}" class="text-sm bg-sky-700 text-white px-3 py-1 rounded hover:bg-sky-800">Nuovo album</a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">{{ session('success') }}</div>
    @endif

    @if ($photosWithoutAlbum > 0)
        <p class="mb-4 text-sm text-slate-600">
            Ci sono <a href="{{ route('admin.gallery.index', ['album' => 'nessuno']) }}" class="text-sky-700 hover:underline">{{ $photosWithoutAlbum }} foto senza album</a>:
            puoi assegnarle a un album dalla loro pagina di modifica.
        </p>
    @endif

    @if ($albums->isEmpty())
        <p class="text-slate-600">Nessun album ancora. Crea il primo album e carica le foto di un evento o di un'attività.</p>
    @else
        <div class="bg-white rounded-xl shadow-sm divide-y divide-slate-100">
            @foreach ($albums as $album)
                <div class="p-4 flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-[12rem]">
                        <p class="font-semibold text-slate-800">
                            {{ $album->title }}
                            @unless ($album->is_visible)
                                <span class="ml-1 text-xs font-medium text-rose-600">nascosto</span>
                            @endunless
                        </p>
                        <p class="text-xs text-slate-500 mt-1">
                            {{ $album->date?->format('d/m/Y') ?? 'Senza data' }}
                            · {{ $album->photos_count }} foto
                            @if ($album->event)
                                · evento: {{ $album->event->title }}
                            @endif
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2 text-xs">
                        <a href="{{ route('admin.gallery.create', ['album' => $album->id]) }}" class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded hover:bg-emerald-200">Carica foto</a>
                        <a href="{{ route('admin.gallery.index', ['album' => $album->id]) }}" class="px-2 py-1 bg-slate-100 text-slate-700 rounded hover:bg-slate-200">Foto</a>
                        @if ($album->is_visible && $album->photos_count > 0)
                            <a href="{{ route('galleria.album', $album) }}" target="_blank" class="px-2 py-1 bg-slate-100 text-slate-700 rounded hover:bg-slate-200">Vedi sul sito</a>
                        @endif
                        <a href="{{ route('admin.albums.edit', $album) }}" class="px-2 py-1 bg-sky-100 text-sky-700 rounded hover:bg-sky-200">Modifica</a>
                        <form method="POST" action="{{ route('admin.albums.destroy', $album) }}"
                              onsubmit="return confirm('Eliminare l\'album? Le foto restano nella galleria, senza album.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-rose-100 text-rose-700 rounded hover:bg-rose-200">Elimina</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">{{ $albums->links() }}</div>
    @endif
@endsection
