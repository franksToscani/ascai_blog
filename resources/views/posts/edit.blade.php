@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Modifica post</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Titolo</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}"
                class="w-full border border-slate-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Contenuto</label>
            <textarea name="content" rows="6"
                    class="w-full border border-slate-300 rounded px-3 py-2">{{ old('content', $post->content) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Immagine di copertina</label>
            @if($post->cover_image)
                <div class="text-sm text-slate-600 mb-2">
                    File attuale: {{ basename($post->cover_image) }}
                </div>
            @endif
            <input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp"
                class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
            <p class="text-xs text-slate-500 mt-1">JPG, PNG o WebP. Max 5MB. Lascia vuoto per mantenere l'immagine attuale.</p>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Link YouTube (opzionale)</label>
            <input type="url" name="youtube_url" value="{{ old('youtube_url', $post->youtube_url) }}"
                placeholder="https://www.youtube.com/watch?v=VIDEO_ID"
                class="w-full border border-slate-300 rounded px-3 py-2">
            <p class="text-xs text-slate-500 mt-1">Link al video YouTube relativo al post</p>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Stato</label>
            <select name="status" class="w-full border border-slate-300 rounded px-3 py-2">
                <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Bozza</option>
                <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Pubblicato</option>
            </select>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold">
                Aggiorna
            </button>

            <a href="{{ route('admin.posts.index') }}" class="text-slate-600 text-sm underline">Annulla</a>
        </div>
    </form>

    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="mt-6">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-sm text-red-600 underline" onclick="return confirm('Eliminare questo post?')">
            Elimina post
        </button>
    </form>
@endsection
