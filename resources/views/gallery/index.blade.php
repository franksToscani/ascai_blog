@extends('layouts.public')

@section('title', 'Galleria foto - ASCAI Bologna')
@section('description', 'Le attività e i momenti speciali di AS.CA.I Bologna raccontati per immagini.')

@section('content')
    {{-- Header --}}
    <div class="mb-8 bg-gradient-to-r from-purple-50 via-pink-50 to-rose-50 rounded-2xl border border-purple-100 p-8 mt-10 md:mt-12">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-2">Galleria Fotografica</h1>
                <p class="text-slate-600">Le nostre attività e momenti speciali in immagini</p>
            </div>
            @auth
                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin.albums.index') }}"
                       class="inline-flex items-center gap-2 bg-purple-700 hover:bg-purple-800 text-white px-5 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Gestisci album e foto</span>
                    </a>
                @endif
            @endauth
        </div>
    </div>

    @if ($albums->isEmpty() && $photos->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <p class="text-slate-600 text-lg">Presto saranno disponibili le foto delle attività dell'associazione.</p>
        </div>
    @endif

    {{-- Album --}}
    @if ($albums->isNotEmpty())
        <section class="mb-12">
            <h2 class="text-xl font-bold text-slate-800 mb-4">Album</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($albums as $album)
                    @php($cover = $album->photos->first())
                    <a href="{{ route('galleria.album', $album) }}"
                       class="group block rounded-2xl overflow-hidden bg-white border border-slate-200 shadow-sm hover:shadow-lg transition">
                        <div class="aspect-[4/3] bg-slate-100 overflow-hidden">
                            @if ($cover)
                                <img src="{{ $cover->thumb_url }}" alt="{{ $album->title }}" loading="lazy"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-slate-800 group-hover:text-purple-700 line-clamp-1">{{ $album->title }}</h3>
                            <p class="text-sm text-slate-500 mt-1">
                                @if ($album->date)
                                    {{ $album->date->translatedFormat('j F Y') }} ·
                                @endif
                                {{ $album->visible_photos_count }} foto
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Foto non assegnate a un album --}}
    @if ($photos->isNotEmpty())
        <section x-data="lightbox(@js($photos->map(fn ($photo) => ['url' => $photo->url, 'title' => $photo->title, 'caption' => $photo->caption])->values()))">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-slate-800">{{ $albums->isNotEmpty() ? 'Altre foto' : 'Foto' }}</h2>
                <span class="text-xs text-slate-500">{{ $photos->total() }} foto</span>
            </div>

            @include('gallery.partials.photo-grid', ['photos' => $photos])

            <div class="mt-8">
                {{ $photos->links() }}
            </div>

            @include('gallery.partials.lightbox')
        </section>
    @endif
@endsection
