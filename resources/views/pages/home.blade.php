@extends('layouts.public')

@section('title', 'Home - Associazione No-Profit')

@section('content')
    {{-- HERO --}}
    <section class="mb-8 bg-white rounded-xl shadow-sm p-6 flex flex-col md:flex-row gap-6">
        <div class="flex-1">
            <h1 class="text-3xl font-bold mb-3">Benvenuti nell’associazione</h1>
            <p class="text-slate-600 mb-4">
                Siamo un’associazione no-profit impegnata in <span class="font-semibold">[inserisci missione]</span>
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
    <section class="mb-8">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-semibold">Ultime news</h2>
            <a href="{{ route('news.index') }}" class="text-sm text-sky-700 hover:underline">
                Vedi tutte le news →
            </a>
        </div>

        @if ($latestPosts->isEmpty())
            <p class="text-slate-600 text-sm">Non ci sono ancora news pubblicate.</p>
        @else
            <div class="grid md:grid-cols-3 gap-4">
                @foreach ($latestPosts as $post)
                    <article class="bg-white rounded-lg shadow-sm p-4">
                        <h3 class="font-semibold mb-1">
                            <a href="{{ route('news.show', $post) }}" class="text-sky-700 hover:underline">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-xs text-slate-500 mb-2">
                            {{ $post->created_at->format('d/m/Y') }}
                        </p>
                        <p class="text-sm text-slate-700">
                            {{ \Illuminate\Support\Str::limit($post->content, 100) }}
                        </p>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    {{-- PROSSIMI EVENTI --}}
<section class="mb-8">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-xl font-semibold">Prossimi eventi</h2>
        <a href="{{ route('eventi.index') }}" class="text-sm text-sky-700 hover:underline">
            Vedi tutti gli eventi →
        </a>
    </div>

    @if ($upcomingEvents->isEmpty())
        <p class="text-sm text-slate-600">
            Al momento non ci sono eventi in programma.
        </p>
    @else
        <div class="grid md:grid-cols-3 gap-4">
            @foreach ($upcomingEvents as $event)
                <article class="bg-white rounded-lg shadow-sm p-4">
                    <h3 class="font-semibold mb-1">
                        <a href="{{ route('eventi.show', $event) }}" class="text-sky-700 hover:underline">
                            {{ $event->title }}
                        </a>
                    </h3>
                    <p class="text-xs text-slate-500 mb-2">
                        {{ $event->starts_at->format('d/m/Y H:i') }}
                        @if ($event->location)
                            • {{ $event->location }}
                        @endif
                    </p>
                    <p class="text-sm text-slate-700">
                        {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                    </p>
                </article>
            @endforeach
        </div>
    @endif
</section>


   {{-- MINI GALLERIA --}}
<section>
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-xl font-semibold">Galleria foto</h2>
        <a href="{{ route('galleria') }}" class="text-sm text-sky-700 hover:underline">
            Vedi tutta la galleria →
        </a>
    </div>

    @if ($galleryPhotos->isEmpty())
        <p class="text-sm text-slate-600">
            Presto saranno disponibili le foto delle attività dell’associazione.
        </p>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @foreach ($galleryPhotos as $photo)
                <div class="aspect-square bg-slate-200 rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $photo->image_path) }}"
                        alt="{{ $photo->title ?? 'Foto galleria' }}"
                        class="w-full h-full object-cover">
                </div>
            @endforeach
        </div>
    @endif
</section>

@endsection
