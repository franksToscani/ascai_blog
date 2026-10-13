@extends('layouts.app')

@section('title', $album->exists ? 'Modifica album' : 'Nuovo album')

@section('content')
    <div class="max-w-2xl mt-12 md:mt-16">
        <a href="{{ route('admin.albums.index') }}" class="text-sm text-sky-700 hover:underline">← Album</a>
        <h1 class="text-2xl font-bold mt-2 mb-4">{{ $album->exists ? 'Modifica album' : 'Nuovo album' }}</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ $album->exists ? route('admin.albums.update', $album) : route('admin.albums.store') }}"
              class="bg-white rounded-xl shadow-sm p-6 space-y-4">
            @csrf
            @if ($album->exists)
                @method('PUT')
            @endif

            <div>
                <label for="title" class="block text-sm font-medium mb-1">Titolo</label>
                <input type="text" id="title" name="title" required maxlength="255" value="{{ old('title', $album->title) }}"
                       placeholder="Es. Festa di Natale 2025"
                       class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label for="date" class="block text-sm font-medium mb-1">Data (facoltativa)</label>
                    <input type="date" id="date" name="date" value="{{ old('date', $album->date?->format('Y-m-d')) }}"
                           class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="event_id" class="block text-sm font-medium mb-1">Evento collegato (facoltativo)</label>
                    <select id="event_id" name="event_id" class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                        <option value="">— Nessun evento —</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->id }}" @selected((string) old('event_id', $album->event_id) === (string) $event->id)>
                                {{ $event->starts_at->format('d/m/Y') }} – {{ $event->title }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-slate-500 mt-1">Le foto dell'album compariranno anche nella pagina dell'evento.</p>
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium mb-1">Descrizione (facoltativa)</label>
                <textarea id="description" name="description" rows="3" maxlength="2000"
                          class="w-full border border-slate-300 rounded px-3 py-2 text-sm">{{ old('description', $album->description) }}</textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="is_visible" name="is_visible" value="1" class="h-4 w-4"
                       @checked(old('is_visible', $album->is_visible))>
                <label for="is_visible" class="text-sm">Visibile sul sito pubblico</label>
            </div>

            <button type="submit" class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-sky-800">
                {{ $album->exists ? 'Salva modifiche' : 'Crea album e carica le foto' }}
            </button>
        </form>
    </div>
@endsection
