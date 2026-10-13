@extends('layouts.public')

@section('title', 'AS.CA.I Bologna - Associazione dei Camerunesi a Bologna')
@section('description', 'Associazione dei Camerunesi d\'Italia, sezione di Bologna: ponti tra culture, integrazione, eventi e solidarietà per la comunità camerunese.')

@push('meta')
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'NGO',
            'name' => 'AS.CA.I Bologna',
            'alternateName' => 'Associazione dei Camerunesi d\'Italia - Bologna',
            'url' => url('/'),
            'logo' => asset('images/logo-256.png'),
            'email' => 'associazione.camer.bologna@gmail.com',
            'areaServed' => 'Bologna',
            'sameAs' => [
                'https://www.facebook.com/groups/ascai.bologna/',
                'https://www.instagram.com/ascai2021/',
                'https://www.tiktok.com/@ascai2021',
                'https://www.whatsapp.com/channel/0029VawPvZ01t90iKspR1l0P',
                'https://linktr.ee/ascai.bologna',
            ],
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) !!}
    </script>
@endpush

@section('hero')
    {{-- HERO SLIDER --}}
    @php
        $heroSlides = [
            [
                'image' => 'images/banner0.jpg',
                'fallback' => 'linear-gradient(135deg, #0369a1 0%, #0f172a 100%)',
                'subtitle' => "Associazione dei Camerunesi d'Italia",
                'title' => 'Benvenuti in AS.CA.I Bologna',
                'description' => "Costruiamo ponti tra culture, promuoviamo l'integrazione e sosteniamo la comunità camerunense a Bologna.",
                'cta' => 'Scopri chi siamo',
                'link' => route('chi-siamo'),
            ],
            [
                'image' => 'images/banner1.jpg',
                'fallback' => 'linear-gradient(135deg, #15803d 0%, #0f172a 100%)',
                'subtitle' => 'Partecipa alle nostre iniziative',
                'title' => 'Eventi e attività',
                'description' => 'Organizziamo eventi culturali, workshop e attività ricreative per tutta la comunità.',
                'cta' => 'Vedi gli eventi',
                'link' => route('eventi.index'),
            ],
            [
                'image' => 'images/banner2.jpg',
                'fallback' => 'linear-gradient(135deg, #b91c1c 0%, #0f172a 100%)',
                'subtitle' => 'Diventa parte della famiglia AS.CA.I Bologna',
                'title' => 'Unisciti a noi',
                'description' => 'Sostieni la nostra missione e contribuisci a creare una comunità più inclusiva e solidale.',
                'cta' => 'Diventa socio',
                'link' => route('associati'),
            ],
            [
                'image' => 'images/banner3.jpg',
                'fallback' => 'linear-gradient(135deg, #a16207 0%, #0f172a 100%)',
                'subtitle' => 'Scopri tutti gli eventi in programma',
                'title' => 'Calendario eventi',
                'description' => 'Resta aggiornato sulle iniziative culturali, formative e ricreative della comunità AS.CA.I Bologna.',
                'cta' => 'Vedi il calendario',
                'link' => route('eventi.index'),
            ],
        ];

        foreach ($heroSlides as &$slide) {
            $slide['background'] = file_exists(public_path($slide['image']))
                ? "background-image: url('" . asset($slide['image']) . "')"
                : 'background: ' . $slide['fallback'];
        }
        unset($slide);
    @endphp

    {{-- Stile "banner istituzionale": a tutta larghezza, testo grande a sinistra, frecce ai bordi, barre di avanzamento --}}
    <section class="relative bg-slate-900"
             aria-roledescription="carousel" aria-label="In evidenza"
             x-data="{
                current: 0,
                total: {{ count($heroSlides) }},
                timer: null,
                paused: false,
                touchStartX: null,
                reducedMotion: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
                start() { this.stop(); if (!this.reducedMotion && !this.paused) this.timer = setInterval(() => this.next(), 7000) },
                stop() { clearInterval(this.timer) },
                toggle() { this.paused = !this.paused; this.paused ? this.stop() : this.start() },
                next() { this.current = (this.current + 1) % this.total },
                prev() { this.current = (this.current - 1 + this.total) % this.total },
                go(index) { this.current = index; this.start() },
                swipeEnd(event) {
                    if (this.touchStartX === null) return;
                    const distance = event.changedTouches[0].clientX - this.touchStartX;
                    if (Math.abs(distance) > 50) { distance < 0 ? this.next() : this.prev(); this.start(); }
                    this.touchStartX = null;
                },
             }"
             x-init="paused = reducedMotion; start()"
             @touchstart.passive="touchStartX = $event.changedTouches[0].clientX"
             @touchend="swipeEnd($event)">

        <div class="relative h-[520px] md:h-[500px] lg:h-[540px] overflow-hidden">
            @foreach ($heroSlides as $index => $slide)
                <div x-show="current === {{ $index }}"
                     x-transition:enter="transition-opacity ease-out duration-700"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity ease-in duration-500"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0"
                     role="group" aria-roledescription="slide" aria-label="{{ $index + 1 }} di {{ count($heroSlides) }}"
                     @if ($index > 0) style="display: none;" @endif>

                    <div class="absolute inset-0 bg-cover bg-center" style="{{ $slide['background'] }}"></div>
                    {{-- Telefono: scuro in basso dove sta il testo. Schermi larghi: pannello scuro a sinistra --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/55 to-black/10 md:hidden"></div>
                    <div class="absolute inset-0 hidden md:block bg-gradient-to-r from-black/85 via-black/55 to-black/0"></div>

                    <div class="relative h-full max-w-7xl mx-auto px-6 sm:px-10 lg:px-8 flex items-end md:items-center pb-20 md:pb-0">
                        <div class="max-w-xl text-white text-center md:text-left mx-auto md:mx-0">
                            <p class="text-xs sm:text-sm font-semibold uppercase tracking-[0.18em] text-white/80">
                                {{ $slide['subtitle'] }}
                            </p>
                            @if ($index === 0)
                                <h1 class="mt-3 text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.05] tracking-tight">{{ $slide['title'] }}</h1>
                            @else
                                <h2 class="mt-3 text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.05] tracking-tight">{{ $slide['title'] }}</h2>
                            @endif
                            <p class="mt-4 text-base sm:text-xl text-white/90 leading-relaxed">{{ $slide['description'] }}</p>
                            <a href="{{ $slide['link'] }}"
                               class="mt-7 inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-sky-600 hover:bg-sky-500 text-white text-lg font-bold shadow-lg transition">
                                {{ $slide['cta'] }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Frecce sottili ai bordi dello schermo (su telefono si scorre col dito) --}}
            <button type="button" @click="prev(); start()" aria-label="Slide precedente"
                    class="hidden md:flex absolute left-2 lg:left-6 top-1/2 -translate-y-1/2 p-2 text-white/80 hover:text-white transition">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button type="button" @click="next(); start()" aria-label="Slide successiva"
                    class="hidden md:flex absolute right-2 lg:right-6 top-1/2 -translate-y-1/2 p-2 text-white/80 hover:text-white transition">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>

        {{-- Barra sotto il banner: pausa/riproduci e indicatori a trattino --}}
        <div class="bg-white border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-8 h-12 flex items-center justify-center md:justify-start gap-4">
                <button type="button" @click="toggle()" class="text-slate-700 hover:text-sky-700 transition"
                        :aria-label="paused ? 'Riproduci' : 'Metti in pausa'">
                    <svg x-show="!paused" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 5h3v14H7zM14 5h3v14h-3z"/></svg>
                    <svg x-show="paused" style="display: none;" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                </button>
                <div class="flex items-center gap-2">
                    @foreach ($heroSlides as $index => $slide)
                        <button type="button" @click="go({{ $index }})" aria-label="Vai alla slide {{ $index + 1 }}: {{ $slide['title'] }}"
                                :aria-current="current === {{ $index }} ? 'true' : 'false'"
                                class="h-1.5 w-10 rounded-full transition-colors duration-300 {{ $index === 0 ? 'bg-sky-600' : 'bg-slate-300' }}"
                                :class="current === {{ $index }} ? '!bg-sky-600' : '!bg-slate-300 hover:!bg-slate-400'"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    {{-- ULTIME NEWS --}}
    <section class="mb-14">
        @include('pages.partials.section-heading', [
            'title' => 'Ultime news',
            'subtitle' => 'Resta aggiornato sulle nostre attività',
            'link' => route('posts.index'),
            'linkText' => 'Vedi tutte',
        ])

        @if ($latestPosts->isEmpty())
            <p class="text-slate-600 text-sm">Non ci sono ancora news pubblicate.</p>
        @else
            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($latestPosts as $post)
                    <article class="group relative flex flex-col bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        {{-- Copertina, oppure il logo su sfondo verde se la news non ne ha una --}}
                        <div class="aspect-[16/9] overflow-hidden bg-gradient-to-br from-camerun-green to-slate-800">
                            @if ($post->cover_image)
                                <img src="{{ asset('storage/' . ltrim($post->cover_image, '/')) }}" alt="" loading="lazy"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    {{-- Disco bianco: la scritta scura del logo resta leggibile sullo sfondo verde --}}
                                    <span class="flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-lg">
                                        <img src="{{ asset('images/logo-256.png') }}" alt="" class="h-16 w-16">
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col flex-1 p-6">
                            <time datetime="{{ $post->created_at->toDateString() }}" class="text-xs font-semibold uppercase tracking-wide text-camerun-green">
                                {{ $post->created_at->translatedFormat('j F Y') }}
                            </time>
                            <h3 class="mt-2 font-bold text-lg leading-snug text-slate-900 line-clamp-2 group-hover:text-sky-700 transition-colors">
                                {{-- Il link copre tutta la card --}}
                                <a href="{{ route('posts.show', $post) }}" class="after:absolute after:inset-0">{{ $post->title }}</a>
                            </h3>
                            <p class="mt-3 text-sm text-slate-600 leading-relaxed line-clamp-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 140) }}
                            </p>
                            <span class="mt-auto pt-4 inline-flex items-center gap-1 text-sm text-sky-700 font-semibold group-hover:gap-2 transition-all">
                                Leggi tutto
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    {{-- PROSSIMI EVENTI --}}
    <section class="mb-14">
        @include('pages.partials.section-heading', [
            'title' => 'Prossimi eventi',
            'subtitle' => 'Partecipa alle nostre iniziative',
            'link' => route('eventi.index'),
            'linkText' => 'Vedi tutti',
        ])

        @if ($upcomingEvents->isEmpty())
            <p class="text-sm text-slate-600">Al momento non ci sono eventi in programma.</p>
        @else
            <div class="grid md:grid-cols-3 gap-6">
                @foreach ($upcomingEvents as $event)
                    <article class="group relative flex gap-5 bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 p-5 transition-all duration-300">
                        {{-- Data a calendario --}}
                        <div class="flex-shrink-0 w-16 rounded-xl overflow-hidden text-center border border-slate-200 self-start">
                            <div class="bg-camerun-red text-white text-[11px] font-bold uppercase tracking-wider py-1">
                                {{ $event->starts_at->translatedFormat('M') }}
                            </div>
                            <div class="py-1.5 bg-white">
                                <div class="text-2xl font-extrabold leading-none text-slate-900">{{ $event->starts_at->format('j') }}</div>
                                <div class="text-[11px] text-slate-500 mt-1 capitalize">{{ $event->starts_at->translatedFormat('D') }}</div>
                            </div>
                        </div>

                        <div class="min-w-0 flex-1">
                            <h3 class="font-bold text-lg leading-snug text-slate-900 line-clamp-2 group-hover:text-camerun-green transition-colors">
                                <a href="{{ route('eventi.show', $event) }}" class="after:absolute after:inset-0">{{ $event->title }}</a>
                            </h3>
                            <p class="mt-2 flex items-center gap-1.5 text-sm text-slate-600">
                                <svg class="w-4 h-4 flex-shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Ore {{ $event->starts_at->format('H:i') }}
                            </p>
                            @if ($event->location)
                                <p class="mt-1 flex items-center gap-1.5 text-sm text-slate-600">
                                    <svg class="w-4 h-4 flex-shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="line-clamp-1">{{ $event->location }}</span>
                                </p>
                            @endif
                            <p class="mt-3 text-sm text-slate-500 leading-relaxed line-clamp-2">
                                {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 100) }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    {{-- MINI GALLERIA --}}
    <section class="mb-14">
        @include('pages.partials.section-heading', [
            'title' => 'Galleria foto',
            'subtitle' => 'Le nostre attività in immagini',
            'link' => route('galleria'),
            'linkText' => 'Vedi tutte',
        ])

        @if ($galleryPhotos->isEmpty())
            <p class="text-sm text-slate-600">Presto saranno disponibili le foto delle attività dell'associazione.</p>
        @else
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
                @foreach ($galleryPhotos as $photo)
                    <a href="{{ $photo->album?->is_visible ? route('galleria.album', $photo->album) : route('galleria') }}"
                       class="group relative aspect-square rounded-2xl overflow-hidden bg-slate-100 shadow-sm">
                        <img src="{{ $photo->thumb_url }}" alt="{{ $photo->title ?? 'Foto galleria' }}" loading="lazy"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @if ($photo->title)
                            {{-- Titolo visibile al passaggio del mouse, sopra una sfumatura scura che lo rende leggibile --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <p class="text-white text-sm font-semibold line-clamp-1">{{ $photo->title }}</p>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    {{-- DIVENTA SOCIO --}}
    <section class="relative overflow-hidden rounded-3xl bg-slate-900 text-white">
        <div class="absolute inset-0 bg-gradient-to-br from-camerun-green/90 via-slate-900 to-slate-900" aria-hidden="true"></div>

        <div class="relative px-6 py-12 sm:px-12 md:py-14 md:flex md:items-center md:justify-between gap-10">
            <div class="max-w-2xl">
                <p class="text-xs sm:text-sm font-semibold uppercase tracking-[0.18em] text-camerun-yellow">Unisciti a noi</p>
                <h2 class="mt-3 text-3xl md:text-4xl font-extrabold tracking-tight">Diventa parte della comunità AS.CA.I Bologna</h2>
                <p class="mt-4 text-white/80 text-base md:text-lg leading-relaxed">
                    Partecipa alle attività, sostieni i nostri progetti e contribuisci a costruire ponti tra il Camerun e Bologna.
                </p>
            </div>
            <div class="mt-8 md:mt-0 flex flex-col sm:flex-row md:flex-col lg:flex-row gap-3 flex-shrink-0">
                <a href="{{ route('associati') }}"
                   class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full bg-camerun-yellow text-slate-900 font-bold hover:bg-yellow-300 transition">
                    Diventa socio
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('contatti') }}"
                   class="inline-flex items-center justify-center px-7 py-3.5 rounded-full border border-white/40 text-white font-semibold hover:bg-white/10 transition">
                    Contattaci
                </a>
            </div>
        </div>
    </section>
@endsection
