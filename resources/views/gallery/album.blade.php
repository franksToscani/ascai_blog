@extends('layouts.public')

@section('title', $album->title . ' - Galleria ASCAI Bologna')
@section('description', \Illuminate\Support\Str::limit(
    $album->description
        ? trim(preg_replace('/\s+/', ' ', $album->description))
        : 'Le foto di "' . $album->title . '"' . ($album->date ? ' del ' . $album->date->translatedFormat('j F Y') : '') . ', AS.CA.I Bologna.',
    155))
@section('og_image', $photos->first()->url)

@section('content')
    <div>
        <a href="{{ route('galleria') }}" class="text-sm text-sky-700 hover:underline">← Tutti gli album</a>
    </div>

    <header class="mt-4 mb-8 pb-6 border-b border-slate-200">
        <div class="flex gap-1 mb-3" aria-hidden="true">
            <span class="h-1 w-6 rounded-full bg-camerun-green"></span>
            <span class="h-1 w-6 rounded-full bg-camerun-red"></span>
            <span class="h-1 w-6 rounded-full bg-camerun-yellow"></span>
        </div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800">{{ $album->title }}</h1>
        <p class="text-slate-500 mt-2">
            @if ($album->date)
                {{ $album->date->translatedFormat('j F Y') }} ·
            @endif
            {{ $photos->count() }} foto
            @if ($album->event)
                · <a href="{{ route('eventi.show', $album->event) }}" class="text-sky-700 hover:underline">Vai all'evento</a>
            @endif
        </p>
        @if ($album->description)
            <p class="text-slate-700 mt-4 max-w-3xl whitespace-pre-line">{{ $album->description }}</p>
        @endif

        @auth
            @if (auth()->user()->is_admin)
                <div class="flex flex-wrap gap-3 mt-4 text-sm">
                    <a href="{{ route('admin.gallery.create', ['album' => $album->id]) }}" class="text-sky-700 hover:underline">+ Aggiungi foto</a>
                    <a href="{{ route('admin.albums.edit', $album) }}" class="text-sky-700 hover:underline">Modifica album</a>
                </div>
            @endif
        @endauth
    </header>

    <section x-data="lightbox(@js($photos->map(fn ($photo) => ['url' => $photo->url, 'title' => $photo->title, 'caption' => $photo->caption])->values()))">
        @include('gallery.partials.photo-grid', ['photos' => $photos])
        @include('gallery.partials.lightbox')
    </section>
@endsection
