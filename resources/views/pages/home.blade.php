@extends('layouts.public')

@section('title', 'Home - ASCAI Bologna')

@section('content')
    {{-- HERO SLIDER --}}
    <section class="mb-12 mt-8 relative" x-data="{ 
        currentSlide: 0, 
        slides: [
            {
                background: @if(file_exists(public_path('images/banner0.jpg'))) '{{ asset('images/banner0.jpg') }}' @else 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' @endif,
                title: 'Benvenuti in ASCAI Bologna',
                subtitle: 'Associazione Camerun Ascai Italia',
                description: 'Costruiamo ponti tra culture, promuoviamo l\'integrazione e sosteniamo la comunità camerunense a Bologna.',
                cta: 'Scopri chi siamo',
                ctaLink: '{{ route('chi-siamo') }}'
            },
            {
                background: @if(file_exists(public_path('images/banner1.jpg'))) '{{ asset('images/banner1.jpg') }}' @else 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)' @endif,
                title: 'Eventi e Attività',
                subtitle: 'Partecipa alle nostre iniziative',
                description: 'Organizziamo eventi culturali, workshop e attività ricreative per tutta la comunità.',
                cta: 'Vedi gli eventi',
                ctaLink: '{{ route('eventi.index') }}'
            },
            {
                background: @if(file_exists(public_path('images/banner2.jpg'))) '{{ asset('images/banner2.jpg') }}' @else 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)' @endif,
                title: 'Unisciti a Noi',
                subtitle: 'Diventa parte della famiglia ASCAI',
                description: 'Sostieni la nostra missione e contribuisci a creare una comunità più inclusiva e solidale.',
                cta: 'Contattaci',
                ctaLink: '{{ route('contatti') }}'
            }
        ],
        autoplay: null,
        init() {
            this.startAutoplay();
        },
        startAutoplay() {
            this.autoplay = setInterval(() => {
                this.next();
            }, 5000);
        },
        stopAutoplay() {
            clearInterval(this.autoplay);
        },
        next() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        },
        prev() {
            this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
        },
        goToSlide(index) {
            this.currentSlide = index;
            this.stopAutoplay();
            this.startAutoplay();
        }
    }">
        <div class="relative h-[380px] rounded-lg overflow-hidden shadow-2xl">
            <!-- Slides -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentSlide === index"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform translate-x-full"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform -translate-x-full"
                    class="absolute inset-0">
                    
                    <!-- Background Image or Gradient Fallback -->
                    <div class="absolute inset-0 bg-cover bg-center" 
                        :style="slide.background.startsWith('linear-gradient') ? 
                                `background: ${slide.background};` : 
                                `background-image: url('${slide.background}');`">
                        <!-- Dark Overlay for Text Readability -->
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>

                    <!-- Content -->
                    <div class="relative h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center">
                        <div class="grid lg:grid-cols-2 gap-12 items-center w-full">
                            <!-- Text Content -->
                            <div class="text-white space-y-6" 
                                x-show="currentSlide === index"
                                x-transition:enter="transition ease-out duration-700 delay-300"
                                x-transition:enter-start="opacity-0 transform -translate-y-4"
                                x-transition:enter-end="opacity-100 transform translate-y-0">
                                
                                <div class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold mb-2">
                                    <span x-text="slide.subtitle"></span>
                                </div>
                                
                                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight">
                                    <span x-text="slide.title"></span>
                                </h1>
                                
                                <p class="text-lg md:text-xl text-blue-100 leading-relaxed max-w-xl">
                                    <span x-text="slide.description"></span>
                                </p>
                                
                                <a :href="slide.ctaLink" 
                                class="inline-flex items-center gap-2 px-8 py-4 bg-white text-sky-700 rounded-xl font-bold text-lg hover:bg-sky-50 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                    <span x-text="slide.cta"></span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>

                            <!-- Image/Logo -->
                            <div class="hidden lg:flex items-center justify-center"
                                x-show="currentSlide === index"
                                x-transition:enter="transition ease-out duration-700 delay-500"
                                x-transition:enter-start="opacity-0 transform translate-x-8"
                                x-transition:enter-end="opacity-100 transform translate-x-0">
                                <!-- Logo is hidden since background images are full-width -->
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Navigation Arrows -->
            <button @click="prev(); stopAutoplay(); startAutoplay();" 
                    class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-sm hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all duration-300 hover:scale-110">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button @click="next(); stopAutoplay(); startAutoplay();" 
                    class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 backdrop-blur-sm hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-all duration-300 hover:scale-110">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <!-- Dots Indicator -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-2">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="goToSlide(index)" 
                            :class="currentSlide === index ? 'w-8 bg-white' : 'w-3 bg-white/50 hover:bg-white/75'"
                            class="h-3 rounded-full transition-all duration-300">
                    </button>
                </template>
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
                Presto saranno disponibili le foto delle attività dell'associazione.
            </p>
        @else
            <!-- Uniform preview: equal-size square tiles -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($galleryPhotos as $photo)
                    <a href="{{ route('galleria') }}" class="group relative aspect-square rounded-2xl overflow-hidden ring-1 ring-slate-100 hover:ring-sky-200 shadow transition-all duration-300">
                        <img src="{{ asset('storage/' . $photo->image_path) }}"
                            alt="{{ $photo->title ?? 'Foto galleria' }}"
                            loading="lazy"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <p class="text-white text-sm font-semibold line-clamp-1">{{ $photo->title ?? 'Foto' }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

@endsection
