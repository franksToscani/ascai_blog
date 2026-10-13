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

@section('content')
    {{-- HERO SLIDER --}}
    @php
        $heroSlides = [
            [
                'image' => 'images/banner0.jpg',
                'fallback' => 'linear-gradient(135deg, #0369a1 0%, #0f172a 100%)',
                'subtitle' => 'Associazione dei Camerunesi in Italia - Sezione di Bologna',
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

    <section class="relative -mt-2 md:mt-0"
             aria-roledescription="carousel" aria-label="In evidenza"
             x-data="{
                current: 0,
                total: {{ count($heroSlides) }},
                timer: null,
                touchStartX: null,
                // Niente scorrimento automatico per chi ha chiesto meno animazioni nel sistema
                reducedMotion: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
                start() { if (!this.reducedMotion) this.timer = setInterval(() => this.next(), 6000) },
                stop() { clearInterval(this.timer) },
                restart() { this.stop(); this.start() },
                next() { this.current = (this.current + 1) % this.total },
                prev() { this.current = (this.current - 1 + this.total) % this.total },
                go(index) { this.current = index; this.restart() },
                swipeEnd(event) {
                    if (this.touchStartX === null) return;
                    const distance = event.changedTouches[0].clientX - this.touchStartX;
                    if (Math.abs(distance) > 50) { distance < 0 ? this.next() : this.prev(); this.restart(); }
                    this.touchStartX = null;
                },
             }"
             x-init="start()"
             @mouseenter="stop()" @mouseleave="start()"
             @touchstart.passive="touchStartX = $event.changedTouches[0].clientX"
             @touchend="swipeEnd($event)">

        <div class="relative h-[460px] sm:h-[420px] lg:h-[440px] overflow-hidden rounded-2xl shadow-xl bg-slate-900">
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
                    {{-- Sfumatura dal basso (e da sinistra su schermi larghi): il testo resta leggibile su qualsiasi foto --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/45 to-black/10"></div>
                    <div class="absolute inset-0 hidden md:block bg-gradient-to-r from-black/50 to-transparent"></div>

                    <div class="relative h-full flex items-end">
                        <div class="w-full px-6 pb-14 sm:px-10 sm:pb-12 lg:px-14 lg:pb-14 max-w-3xl text-white">
                            <p class="inline-block px-3 py-1 mb-3 rounded-full bg-white/15 backdrop-blur-sm text-xs sm:text-sm font-semibold">
                                {{ $slide['subtitle'] }}
                            </p>
                            @if ($index === 0)
                                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight drop-shadow">{{ $slide['title'] }}</h1>
                            @else
                                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight drop-shadow">{{ $slide['title'] }}</h2>
                            @endif
                            <p class="mt-3 text-base sm:text-lg text-white/90 leading-relaxed line-clamp-4 sm:line-clamp-3">{{ $slide['description'] }}</p>
                            <a href="{{ $slide['link'] }}"
                               class="mt-5 inline-flex items-center gap-2 px-6 py-3 bg-white text-sky-800 rounded-xl font-bold hover:bg-sky-50 hover:shadow-lg transition">
                                {{ $slide['cta'] }}
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Controlli: pallini al centro in basso, frecce in basso a destra (su telefono si scorre col dito) --}}
            <div class="absolute bottom-4 left-0 right-0 flex items-center justify-center gap-2 sm:justify-end sm:right-6 sm:left-auto">
                <button type="button" @click="prev(); restart()" aria-label="Slide precedente"
                        class="hidden sm:flex w-9 h-9 mr-2 rounded-full bg-white/15 hover:bg-white/30 backdrop-blur-sm items-center justify-center text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                @foreach ($heroSlides as $index => $slide)
                    <button type="button" @click="go({{ $index }})" aria-label="Vai alla slide {{ $index + 1 }}"
                            :aria-current="current === {{ $index }} ? 'true' : 'false'"
                            :class="current === {{ $index }} ? 'w-7 bg-white' : 'w-2.5 bg-white/50 hover:bg-white/80'"
                            class="h-2.5 rounded-full transition-all duration-300"></button>
                @endforeach
                <button type="button" @click="next(); restart()" aria-label="Slide successiva"
                        class="hidden sm:flex w-9 h-9 ml-2 rounded-full bg-white/15 hover:bg-white/30 backdrop-blur-sm items-center justify-center text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </section>

    {{-- ULTIME NEWS --}}
    <section class="mb-12 mt-12 md:mt-16">
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
                            <time class="text-xs text-slate-500 font-medium">{{ $post->created_at->translatedFormat('d M Y') }}</time>
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
    <section class="mb-12 mt-12 md:mt-16">
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
                            <time class="text-xs text-slate-500 font-medium">{{ $event->starts_at->translatedFormat('d M Y') }}</time>
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
    <section class="mt-12 md:mt-16">
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
                Presto saranno disponibili le foto delle attività dell'associazione.
            </p>
        @else
            <!-- Uniform preview: equal-size square tiles -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($galleryPhotos as $photo)
                    <a href="{{ $photo->album?->is_visible ? route('galleria.album', $photo->album) : route('galleria') }}" class="group relative aspect-square rounded-2xl overflow-hidden ring-1 ring-slate-100 hover:ring-sky-200 shadow transition-all duration-300">
                        <img src="{{ $photo->thumb_url }}"
                            alt="{{ $photo->title ?? 'Foto galleria' }}"
                            loading="lazy"
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

@endsection
