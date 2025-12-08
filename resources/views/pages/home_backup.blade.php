@extends('layouts.public')

@section('title', 'Home - Associazione No-Profit')

@section('content')
    {{-- HERO --}}
    <section class="mb-8 bg-white rounded-xl shadow-sm p-6 flex flex-col md:flex-row gap-6">
        <div class="flex-1">
            <div class="flex items-center gap-4 mb-4">
                <img src="{{ asset('images/logoAscai.png') }}" alt="ASCAI Bologna Logo" class="h-20 w-auto">
                <div>
                    <h1 class="text-3xl font-bold">ASCAI Bologna</h1>
                    <p class="text-slate-500 text-sm">Associazione Camerun Ascai Italia</p>
                </div>
            </div>
            <p class="text-slate-600 mb-4">
                Siamo un'associazione no-profit impegnata in <span class="font-semibold">[inserisci missione]</span>
                sul territorio di [città/zona]. Organizziamo eventi, attività e progetti per la comunità.
            </p>
            <a href="{{ route('chi-siamo') }}" class="inline-block bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold">
                Scopri chi siamo
            </a>
        </div>

        <div class="flex-1">
            <div class="aspect-video bg-slate-200 rounded-lg flex items-center justify-center text-slate-500 text-sm">
                Qui potrà andare una foto dell’associazione o una mini galleria.
            </div>
        </div>
    </section>

    {{-- ULTIME NEWS --}}
    <section class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-800">Ultime news</h2>
                <p class="text-sm text-slate-500 mt-1">Resta aggiornato sulle nostre attività</p>
            </div>
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-1 text-sm text-sky-700 hover:text-sky-800 font-semibold group">
                <span>Vedi tutte</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        @if ($latestPosts->isEmpty())
            <p class="text-slate-600 text-sm">Non ci sono ancora news pubblicate.</p>
        @else
            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($latestPosts as $post)
                    <article class="group bg-white rounded-xl shadow-md hover:shadow-2xl border border-slate-100 hover:border-sky-200 p-6 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-3">
                            <div class="bg-sky-100 text-sky-700 px-3 py-1 rounded-full text-xs font-semibold">
                                News
                            </div>
                            <time class="text-xs text-slate-500 font-medium">{{ $post->created_at->format('d M Y') }}</time>
                        </div>
                        <h3 class="font-bold text-lg mb-3 line-clamp-2">
                            <a href="{{ route('posts.show', $post) }}" class="text-slate-800 group-hover:text-sky-700 transition-colors">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-sm text-slate-600 leading-relaxed line-clamp-3 mb-4">
                            {{ \Illuminate\Support\Str::limit($post->content, 120) }}
                        </p>
                        <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center gap-1 text-sm text-sky-700 font-semibold group-hover:gap-2 transition-all">
                            <span>Leggi tutto</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    {{-- PROSSIMI EVENTI --}}
<section class="mb-12">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-slate-800">Prossimi eventi</h2>
            <p class="text-sm text-slate-500 mt-1">Partecipa alle nostre iniziative</p>
        </div>
        <a href="{{ route('eventi.index') }}" class="inline-flex items-center gap-1 text-sm text-sky-700 hover:text-sky-800 font-semibold group">
            <span>Vedi tutti</span>
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    @if ($upcomingEvents->isEmpty())
        <p class="text-sm text-slate-600">
            Al momento non ci sono eventi in programma.
        </p>
    @else
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($upcomingEvents as $event)
                <article class="group bg-white rounded-xl shadow-md hover:shadow-2xl border border-slate-100 hover:border-green-200 p-6 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-start justify-between mb-3">
                        <div class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                            Evento
                        </div>
                        <time class="text-xs text-slate-500 font-medium">{{ $event->starts_at->format('d M Y') }}</time>
                    </div>
                    <h3 class="font-bold text-lg mb-3 line-clamp-2">
                        <a href="{{ route('eventi.show', $event) }}" class="text-slate-800 group-hover:text-green-700 transition-colors">
                            {{ $event->title }}
                        </a>
                    </h3>
                    @if ($event->location)
                        <div class="flex items-center gap-2 text-sm text-slate-500 mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="line-clamp-1">{{ $event->location }}</span>
                        </div>
                    @endif
                    <p class="text-sm text-slate-600 leading-relaxed line-clamp-2 mb-4">
                        {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                    </p>
                    <a href="{{ route('eventi.show', $event) }}" class="inline-flex items-center gap-1 text-sm text-green-700 font-semibold group-hover:gap-2 transition-all">
                        <span>Scopri di più</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </article>
            @endforeach
        </div>
    @endif
</section>


   {{-- MINI GALLERIA --}}
<section>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-slate-800">Galleria foto</h2>
            <p class="text-sm text-slate-500 mt-1">Le nostre attività in immagini</p>
        </div>
        <a href="{{ route('galleria') }}" class="inline-flex items-center gap-1 text-sm text-sky-700 hover:text-sky-800 font-semibold group">
            <span>Vedi tutte</span>
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    @if ($galleryPhotos->isEmpty())
        <p class="text-sm text-slate-600">
            Presto saranno disponibili le foto delle attività dell’associazione.
        </p>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($galleryPhotos as $photo)
                <a href="{{ route('galleria') }}" class="group relative aspect-square bg-slate-200 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
                    <img src="{{ asset('storage/' . $photo->image_path) }}"
                        alt="{{ $photo->title ?? 'Foto galleria' }}"
                        loading="lazy"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <p class="text-white text-sm font-semibold line-clamp-1">{{ $photo->title ?? 'Foto' }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</section>

@endsection
