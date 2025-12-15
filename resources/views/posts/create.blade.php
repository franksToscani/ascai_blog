@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Nuovo post</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-4 rounded shadow-sm">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Titolo</label>
            <input type="text" name="title" value="{{ old('title') }}"
                class="w-full border border-slate-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Contenuto</label>
            <textarea name="content" rows="6"
                    class="w-full border border-slate-300 rounded px-3 py-2">{{ old('content') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Immagine di copertina (opzionale)</label>
            <input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp"
                class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
            <p class="text-xs text-slate-500 mt-1">JPG, PNG o WebP. Dimensione massima: 5MB. Formato orizzontale 16:9 consigliato (es. 1200×675px)</p>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Link video YouTube (opzionale)</label>
            <input type="url" name="youtube_url" value="{{ old('youtube_url') }}" placeholder="https://www.youtube.com/watch?v=..."
                class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
            <p class="text-xs text-slate-500 mt-1">Incolla il link completo al video YouTube</p>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Stato</label>
            <select name="status" class="w-full border border-slate-300 rounded px-3 py-2">
                <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Bozza</option>
                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Pubblicato</option>
            </select>
        </div>

        <button type="submit"
                class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold">
            Salva
        </button>
    </form>
@endsection
