@extends('layouts.app')

@section('title', 'Carica foto nella galleria')

@section('content')
    <div class="max-w-4xl mt-12 md:mt-16">
        <a href="{{ route('admin.albums.index') }}" class="text-sm text-sky-700 hover:underline">← Album</a>
        <h1 class="text-2xl font-bold mt-2 mb-4">Carica foto</h1>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Senza JavaScript il modulo funziona comunque, una foto alla volta --}}
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data"
              x-data="galleryUploader(@js(route('admin.gallery.store')), @js(route('admin.gallery.index', $selectedAlbum ? ['album' => $selectedAlbum] : [])))"
              @submit.prevent="upload()"
              class="bg-white rounded-xl shadow-sm p-6 space-y-5">
            @csrf

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label for="album_id" class="block text-sm font-medium mb-1">Album</label>
                    <select id="album_id" name="album_id" class="w-full border border-slate-300 rounded px-3 py-2 text-sm" :disabled="uploading">
                        <option value="">— Nessun album —</option>
                        @foreach ($albums as $album)
                            <option value="{{ $album->id }}" @selected((string) old('album_id', $selectedAlbum) === (string) $album->id)>{{ $album->title }}</option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-slate-500 mt-1">
                        Manca l'album? <a href="{{ route('admin.albums.create') }}" class="text-sky-700 hover:underline">Crealo prima</a>.
                    </p>
                </div>
                <div class="flex items-center gap-2 sm:pt-6">
                    <input type="checkbox" id="is_visible" name="is_visible" value="1" class="h-4 w-4" @checked(old('is_visible', true))>
                    <label for="is_visible" class="text-sm">Visibili sul sito pubblico</label>
                </div>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium mb-1">Foto</label>
                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp" multiple required
                       @change="select($event)" :disabled="uploading"
                       class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                <p class="text-[11px] text-slate-500 mt-1">
                    Puoi selezionarne più di una. JPG, PNG o WebP, fino a 10 MB ciascuna: le foto grandi vengono ridimensionate automaticamente.
                </p>
            </div>

            {{-- Anteprime e stato di ogni foto --}}
            <template x-if="items.length > 0">
                <div>
                    <p class="text-sm text-slate-600 mb-2">
                        <span x-text="items.length"></span> foto selezionate
                        <template x-if="uploading || finished">
                            <span>· caricate <span x-text="doneCount"></span>/<span x-text="items.length"></span></span>
                        </template>
                    </p>
                    <div class="grid grid-cols-3 sm:grid-cols-5 md:grid-cols-6 gap-2">
                        <template x-for="item in items" :key="item.preview">
                            <div class="relative aspect-square rounded-md overflow-hidden bg-slate-100" :title="item.error || item.name">
                                <img :src="item.preview" class="w-full h-full object-cover" :class="item.status === 'done' ? 'opacity-60' : ''" alt="">
                                <div class="absolute inset-0 flex items-center justify-center text-xs font-semibold"
                                     :class="{
                                        'bg-black/40 text-white': item.status === 'uploading',
                                        'bg-rose-600/80 text-white p-1 text-center': item.status === 'error',
                                     }">
                                    <span x-show="item.status === 'uploading'">Caricamento…</span>
                                    <span x-show="item.status === 'error'" x-text="item.error"></span>
                                </div>
                                <span x-show="item.status === 'done'" class="absolute bottom-1 right-1 bg-emerald-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">✓</span>
                            </div>
                        </template>
                    </div>
                </div>
            </template>

            <div x-show="finished && errorCount > 0" class="bg-amber-50 border border-amber-200 text-amber-800 px-4 py-2 rounded text-sm" style="display: none;">
                <span x-text="errorCount"></span> foto non caricate (passa il mouse sulla foto per il motivo).
                Puoi riprovare con "Carica" oppure
                <a href="{{ route('admin.gallery.index', $selectedAlbum ? ['album' => $selectedAlbum] : []) }}" class="underline">andare alla galleria</a>.
            </div>

            <button type="submit" :disabled="uploading || items.length === 0"
                    class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-sky-800 disabled:opacity-50">
                <span x-show="!uploading">Carica</span>
                <span x-show="uploading" style="display: none;">Caricamento in corso…</span>
            </button>
        </form>
    </div>
@endsection
