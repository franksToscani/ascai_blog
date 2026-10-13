@extends('layouts.public')

@section('title', 'Galleria foto - ASCAI Bologna')
@section('description', 'Le attività e i momenti speciali di AS.CA.I Bologna raccontati per immagini.')

@section('content')
    @include('partials.page-header', [
        'title' => 'Galleria',
        'subtitle' => 'Le nostre attività e i momenti speciali in immagini',
        'actionUrl' => route('admin.albums.index'),
        'actionLabel' => 'Gestisci album e foto',
    ])

    @if ($albums->isEmpty() && $photos->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <p class="text-slate-600 text-lg">Presto saranno disponibili le foto delle attività dell'associazione.</p>
        </div>
    @endif

    {{-- Album --}}
    @if ($albums->isNotEmpty())
        <section class="mb-14">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Album</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($albums as $album)
                    @php($cover = $album->photos->first())
                    <a href="{{ route('galleria.album', $album) }}"
                       class="group block rounded-2xl overflow-hidden bg-white border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <div class="aspect-[4/3] bg-slate-100 overflow-hidden">
                            @if ($cover)
                                <img src="{{ $cover->thumb_url }}" alt="{{ $album->title }}" loading="lazy"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-slate-800 group-hover:text-sky-700 line-clamp-1">{{ $album->title }}</h3>
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
                <h2 class="text-2xl font-bold text-slate-900">{{ $albums->isNotEmpty() ? 'Altre foto' : 'Foto' }}</h2>
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
