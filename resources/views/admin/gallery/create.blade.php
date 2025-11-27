@extends('layouts.app')

@section('title', 'Aggiungi foto alla galleria')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Aggiungi foto alla galleria</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-xl shadow-sm p-6 space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Immagine</label>
            <input type="file" name="image"
                   class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
            <p class="text-[11px] text-slate-500 mt-1">
                Formati accettati: JPG, PNG, GIF. Dimensione max: 4 MB.
            </p>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Titolo (opzionale)</label>
            <input type="text" name="title" value="{{ old('title') }}"
                class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Didascalia (opzionale)</label>
            <input type="text" name="caption" value="{{ old('caption') }}"
                class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_visible" name="is_visible" value="1"
                class="h-4 w-4"
                {{ old('is_visible', true) ? 'checked' : '' }}>
            <label for="is_visible" class="text-sm">Visibile sul sito pubblico</label>
        </div>

        <button type="submit"
                class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold">
            Carica foto
        </button>
    </form>
@endsection
