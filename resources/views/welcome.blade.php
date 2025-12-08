@extends('layouts.public')

@section('title', 'ASCAI – Associazione dei Camerunesi a Bologna')

@section('content')
    {{-- HERO --}}
    <section class="bg-sky-700 text-white rounded-3xl px-6 py-12 md:px-10 md:py-16 mb-10">
        <div class="max-w-3xl">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                Associazione dei Camerunesi a Bologna
            </h1>
            <p class="text-sm md:text-base text-sky-100 mb-6">
                Promuoviamo l’unità, la cultura e il supporto reciproco tra la comunità camerunense
                residente a Bologna e in Emilia Romagna.
            </p>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('associati') }}"
                class="inline-block bg-white text-sky-700 font-semibold px-5 py-2 rounded-lg shadow hover:bg-sky-50 text-sm">
                    Diventa associato →
                </a>
                <a href="{{ route('eventi.index') }}"
                class="inline-block border border-white/70 text-white px-5 py-2 rounded-lg text-sm hover:bg-white/10">
                    Vedi i prossimi eventi
                </a>
            </div>
        </div>
    </section>

    {{-- PROSSIMI EVENTI --}}
    <section class="mb-10">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-semibold">Prossimi eventi</h2>
            <a href="{{ route('eventi.index') }}" class="text-sm text-sky-700 hover:underline">
                Vedi tutti gli eventi →
            </a>
        </div>

        @if ($upcomingEvents->isEmpty())
            <p class="text-sm text-gray-600">
                Al momento non ci sono eventi in programma.
            </p>
        @else
            <div class="grid md:grid-cols-3 gap-4">
                @foreach ($upcomingEvents as $event)
                    <article class="bg-white rounded-xl shadow-sm p-4">
                        <h3 class="font-semibold mb-1">
                            <a href="{{ route('eventi.show', $event) }}" class="text-sky-700 hover:underline">
                                {{ $event->title }}
                            </a>
                        </h3>
                        <p class="text-xs text-gray-500 mb-1">
                            {{ $event->starts_at?->format('d/m/Y H:i') }}
                            @if ($event->location)
                                • {{ $event->location }}
                            @endif
                        </p>
                        <p class="text-sm text-gray-700">
                            {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                        </p>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    {{-- ULTIME NEWS --}}
    <section class="mb-10">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-semibold">Ultime news</h2>
                <a href="{{ route('posts.index') }}" class="text-sm text-sky-700 hover:underline">
                Vai al blog →
            </a>
        </div>

        @if ($latestPosts->isEmpty())
            <p class="text-sm text-gray-600">
                Non ci sono ancora news pubblicate.
            </p>
        @else
            <div class="grid md:grid-cols-3 gap-4">
                @foreach ($latestPosts as $post)
                    <article class="bg-white rounded-xl shadow-sm p-4">
                        <h3 class="font-semibold mb-1">
                                <a href="{{ route('posts.show', $post) }}" class="text-sky-700 hover:underline">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-xs text-gray-500 mb-1">
                            Pubblicato il {{ $post->created_at->format('d/m/Y') }}
                        </p>
                        <p class="text-sm text-gray-700">
                            {{ \Illuminate\Support\Str::limit($post->body ?? $post->content ?? '', 120) }}
                        </p>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    {{-- MINI GALLERIA FOTO --}}
    <section>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-semibold">Galleria foto</h2>
            <a href="{{ route('galleria') }}" class="text-sm text-sky-700 hover:underline">
                Vedi tutte le foto →
            </a>
        </div>

        @if ($galleryPhotos->isEmpty())
            <p class="text-sm text-gray-600">
                Presto saranno disponibili le foto delle attività dell’associazione.
            </p>
        @else
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                @foreach ($galleryPhotos as $photo)
                    <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $photo->image_path) }}"
                            alt="{{ $photo->title ?? 'Foto galleria' }}"
                            class="w-full h-full object-cover">
                    </div>
                @endforeach
            </div>
        @endif
    </section>
@endsection
