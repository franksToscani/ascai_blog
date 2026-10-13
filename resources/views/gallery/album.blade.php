@extends('layouts.public')

@section('title', $album->title . ' - Galleria ASCAI Bologna')
@section('description', \Illuminate\Support\Str::limit(
    $album->description
        ? trim(preg_replace('/\s+/', ' ', $album->description))
        : 'Le foto di "' . $album->title . '"' . ($album->date ? ' del ' . $album->date->translatedFormat('j F Y') : '') . ', AS.CA.I Bologna.',
    155))
@section('og_image', $photos->first()->url)

@section('content')
    <div class="mt-10 md:mt-12">
        <a href="{{ route('galleria') }}" class="text-sm text-purple-700 hover:underline">← Tutti gli album</a>
    </div>

    <header class="mt-4 mb-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800">{{ $album->title }}</h1>
        <p class="text-slate-500 mt-2">
            @if ($album->date)
                {{ $album->date->translatedFormat('j F Y') }} ·
            @endif
            {{ $photos->count() }} foto
            @if ($album->event)
                · <a href="{{ route('eventi.show', $album->event) }}" class="text-purple-700 hover:underline">Vai all'evento</a>
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
