@extends('layouts.app')

@section('title', 'Nuovo evento')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Nuovo evento</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.store') }}" method="POST" class="bg-white rounded-xl shadow-sm p-6 space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Titolo</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Descrizione</label>
            <textarea name="description" rows="5"
                      class="w-full border border-slate-300 rounded px-3 py-2 text-sm">{{ old('description') }}</textarea>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Data/ora inizio</label>
                <input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}"
                       class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Data/ora fine (opzionale)</label>
                <input type="datetime-local" name="ends_at" value="{{ old('ends_at') }}"
                       class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Luogo (opzionale)</label>
            <input type="text" name="location" value="{{ old('location') }}"
                class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_public" name="is_public" value="1"
                class="h-4 w-4"
                {{ old('is_public', true) ? 'checked' : '' }}>
            <label for="is_public" class="text-sm">Visibile sul sito pubblico</label>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Stato</label>
            <select name="status" class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Bozza</option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Pubblicato</option>
            </select>
        </div>

        <button type="submit"
                class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold">
            Salva evento
        </button>
    </form>
@endsection
