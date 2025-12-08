@extends('layouts.public')

@section('title', 'Galleria foto - Associazione')

@section('content')
    {{-- Header --}}
    <div class="mb-8 bg-gradient-to-r from-purple-50 via-pink-50 to-rose-50 rounded-2xl border border-purple-100 p-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-2">Galleria Fotografica</h1>
                <p class="text-slate-600">Le nostre attività e momenti speciali in immagini</p>
            </div>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.gallery.create') }}" 
                        class="inline-flex items-center gap-2 bg-purple-700 hover:bg-purple-800 text-white px-5 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Carica Foto</span>
                    </a>
                @endif
            @endauth
        </div>
    </div>

    @if ($photos->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-slate-600 text-lg mb-2">Nessuna foto in galleria</p>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center gap-2 text-purple-700 hover:text-purple-800 font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Carica la prima foto</span>
                    </a>
                @endif
            @endauth
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($photos as $photo)
                <div class="group relative aspect-square bg-slate-100 rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300">
                    {{-- Immagine con zoom effect --}}
                    <img src="{{ asset('storage/' . $photo->image_path) }}"
                        alt="{{ $photo->title ?? 'Foto galleria' }}"
                        loading="lazy"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    
                    {{-- Overlay gradient su hover --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        {{-- Title e caption --}}
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                            @if ($photo->title)
                                <p class="font-bold text-sm mb-1 line-clamp-2">{{ $photo->title }}</p>
                            @endif
                            @if ($photo->caption)
                                <p class="text-xs text-gray-200 line-clamp-2">{{ $photo->caption }}</p>
                            @endif
                        </div>
                        
                        {{-- Admin actions --}}
                        @auth
                            @if(auth()->user()->is_admin)
                                <div class="absolute top-2 right-2 flex gap-2 transform translate-y-0 opacity-100 transition-all duration-300">
                                    <a href="{{ route('admin.gallery.edit', $photo) }}" 
                                       class="p-2 bg-white/90 hover:bg-white text-blue-600 rounded-lg shadow-lg transition-all"
                                       title="Modifica">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.gallery.destroy', $photo) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 bg-white/90 hover:bg-white text-red-600 rounded-lg shadow-lg transition-all"
                                                onclick="return confirm('Eliminare questa foto?')"
                                                title="Elimina">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Paginazione --}}
        <div class="mt-8">
            {{ $photos->links() }}
        </div>
    @endif
@endsection
