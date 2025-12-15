@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Modifica Foto Galleria</h1>

        <form action="{{ route('admin.gallery.update', $galleryPhoto) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Anteprima immagine attuale -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Immagine Attuale</label>
                <div class="bg-slate-100 rounded p-2">
                    <img src="{{ asset('storage/' . $galleryPhoto->image_path) }}"
                        alt="{{ $galleryPhoto->title }}"
                        class="w-full h-48 object-cover rounded">
                </div>
            </div>

            <!-- Upload nuova immagine -->
            <div>
                <label for="image" class="block text-sm font-medium mb-1">Nuova Immagine (facoltativa)</label>
                <input type="file"
                    id="image"
                    name="image"
                    accept="image/*"
                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                @error('image')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Titolo -->
            <div>
                <label for="title" class="block text-sm font-medium mb-1">Titolo</label>
                <input type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $galleryPhoto->title) }}"
                    maxlength="255"
                    class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500">
                @error('title')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Didascalia -->
            <div>
                <label for="caption" class="block text-sm font-medium mb-1">Didascalia</label>
                <textarea id="caption"
                    name="caption"
                    maxlength="255"
                    rows="3"
                    class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500">{{ old('caption', $galleryPhoto->caption) }}</textarea>
                @error('caption')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Visibilità -->
            <div class="flex items-center gap-2">
                <input type="checkbox"
                    id="is_visible"
                    name="is_visible"
                    value="1"
                    @checked(old('is_visible', $galleryPhoto->is_visible))
                    class="w-4 h-4 rounded border-slate-300">
                <label for="is_visible" class="text-sm font-medium">Visibile pubblicamente</label>
            </div>

            <!-- Pulsanti -->
            <div class="flex gap-2 pt-4">
                <button type="submit" class="flex-1 bg-sky-600 text-white py-2 px-4 rounded-md hover:bg-sky-700 font-medium">
                    Salva Modifiche
                </button>
                <a href="{{ route('admin.gallery.index') }}" class="flex-1 bg-slate-300 text-slate-700 py-2 px-4 rounded-md hover:bg-slate-400 font-medium text-center">
                    Annulla
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
