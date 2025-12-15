@extends('layouts.public')

@section('title', $event->title . ' - Eventi')

@section('content')
    @php
        // Support optional flyer and video fields
        $flyerPath = $event->flyer_path ?? $event->flyer ?? null;
        $videoUrlRaw = $event->youtube_url ?? $event->video_url ?? $event->video ?? null;

        // Convert YouTube URL to embed format
        $videoEmbedUrl = null;
        if ($videoUrlRaw) {
            // Extract video ID from various YouTube URL formats
            $videoId = null;
            
            // Format: https://www.youtube.com/watch?v=dQw4w9WgXcQ
            if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})/', $videoUrlRaw, $matches)) {
                $videoId = $matches[1];
            }
            // Format: https://youtu.be/dQw4w9WgXcQ
            elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $videoUrlRaw, $matches)) {
                $videoId = $matches[1];
            }
            // Format: https://www.youtube.com/embed/dQw4w9WgXcQ
            elseif (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/', $videoUrlRaw, $matches)) {
                $videoId = $matches[1];
            }
            
            if ($videoId) {
                $videoEmbedUrl = 'https://www.youtube.com/embed/' . $videoId;
            }
        }
    @endphp

    <div x-data="{ flyerModalOpen: false }">
        <article class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 md:p-8 flex flex-col gap-4">
            <div class="flex flex-wrap items-start gap-3 justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-sky-600 font-semibold mb-2">Evento</p>
                    <h1 class="text-3xl font-extrabold text-slate-900 leading-tight">{{ $event->title }}</h1>
                </div>
                <a href="{{ route('eventi.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-sky-700 bg-sky-50 border border-sky-100 rounded-lg hover:bg-sky-100 transition">
                    ← Torna agli eventi
                </a>
            </div>

            <div class="flex flex-wrap gap-4 text-sm text-slate-600">
                <div class="inline-flex items-center gap-2 bg-slate-50 px-3 py-2 rounded-lg">
                    <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Inizio: {{ $event->starts_at->format('d/m/Y H:i') }}</span>
                </div>
                @if ($event->ends_at)
                    <div class="inline-flex items-center gap-2 bg-slate-50 px-3 py-2 rounded-lg">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Fine: {{ $event->ends_at->format('d/m/Y H:i') }}</span>
                    </div>
                @endif
                @if ($event->location)
                    <div class="inline-flex items-center gap-2 bg-slate-50 px-3 py-2 rounded-lg">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="line-clamp-1">{{ $event->location }}</span>
                    </div>
                @endif
            </div>

            <div class="prose max-w-none text-slate-800">
                <p class="whitespace-pre-line leading-relaxed">{{ $event->description }}</p>
            </div>
        </div>

        @if ($flyerPath || $videoEmbedUrl)
            <div class="grid lg:grid-cols-2 gap-0 border-t border-slate-200">
                @if ($flyerPath)
                    <div class="relative overflow-hidden bg-slate-50 p-6">
                        <p class="text-sm font-semibold text-slate-700 mb-3">Flyer</p>
                        <div class="rounded-xl overflow-hidden ring-1 ring-slate-200 shadow-sm cursor-pointer group" @click="flyerModalOpen = true">
                            <img src="{{ asset('storage/' . ltrim($flyerPath, '/')) }}" alt="Flyer evento" loading="lazy" class="w-full h-auto max-h-[400px] object-cover group-hover:brightness-90 transition-all duration-300">
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/20">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($videoEmbedUrl)
                    <div class="relative bg-slate-900 p-6">
                        <p class="text-sm font-semibold text-white mb-3">Video</p>
                        <div class="rounded-xl overflow-hidden shadow-lg ring-1 ring-slate-800/60">
                            <iframe class="w-full h-[360px]" src="{{ $videoEmbedUrl }}" title="Video YouTube" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif
            </div>
        @endif
        </article>

        {{-- Flyer Modal/Lightbox --}}
        @if ($flyerPath)
            <div x-show="flyerModalOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4" @click.self="flyerModalOpen = false" @keydown.escape="flyerModalOpen = false">
                <div class="relative w-full max-w-4xl max-h-[90vh] flex flex-col">
                    <button @click="flyerModalOpen = false" class="absolute -top-8 right-0 text-white hover:text-gray-300 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <img src="{{ asset('storage/' . ltrim($flyerPath, '/')) }}" alt="Flyer evento" class="w-full h-auto object-contain rounded-lg shadow-2xl">
                </div>
            </div>
        @endif
    </div>
@endsection
