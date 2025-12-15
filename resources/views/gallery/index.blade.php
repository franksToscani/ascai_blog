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
        {{-- Toolbar: filtri rapidi e layout switch --}}
        <div class="mb-6 flex flex-wrap items-center gap-3 justify-between">
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-slate-500 uppercase">Layout</span>
                <div x-data="{ layout: 'masonry' }" class="flex items-center gap-2">
                    <button @click="layout='masonry'" class="px-3 py-1.5 text-xs rounded-lg border transition-colors" :class="layout==='masonry' ? 'bg-purple-600 text-white border-purple-600' : 'bg-white text-slate-700 border-slate-300 hover:bg-slate-50'">Masonry</button>
                    <button @click="layout='grid'" class="px-3 py-1.5 text-xs rounded-lg border transition-colors" :class="layout==='grid' ? 'bg-purple-600 text-white border-purple-600' : 'bg-white text-slate-700 border-slate-300 hover:bg-slate-50'">Griglia</button>
                    <button @click="layout='cards'" class="px-3 py-1.5 text-xs rounded-lg border transition-colors" :class="layout==='cards' ? 'bg-purple-600 text-white border-purple-600' : 'bg-white text-slate-700 border-slate-300 hover:bg-slate-50'">Cards</button>
                </div>
            </div>
            <div class="text-xs text-slate-500">Totale foto: <span class="font-bold">{{ $photos->total() }}</span></div>
        </div>

        {{-- Gallery con Alpine Lightbox + Masonry --}}
        <div x-data="{ layout: 'masonry', active: null }">
            <template x-if="layout === 'masonry'">
                <div class="columns-2 md:columns-3 lg:columns-4 gap-4 [column-fill:_balance]">
                    @foreach ($photos as $photo)
                        <div class="mb-4 break-inside-avoid group relative rounded-xl overflow-hidden bg-slate-100 shadow-sm hover:shadow-lg transition-shadow">
                            <button @click="active={{ $photo->id }}" class="block w-full text-left">
                                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title ?? 'Foto galleria' }}" loading="lazy" class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-[1.03]">
                            </button>
                            @if ($photo->title || $photo->caption)
                                <div class="absolute inset-x-0 bottom-0 p-3 bg-gradient-to-t from-black/70 to-transparent text-white">
                                    @if ($photo->title)
                                        <p class="text-sm font-semibold line-clamp-1">{{ $photo->title }}</p>
                                    @endif
                                    @if ($photo->caption)
                                        <p class="text-xs text-slate-200 line-clamp-1">{{ $photo->caption }}</p>
                                    @endif
                                </div>
                            @endif
                            @auth
                                @if(auth()->user()->is_admin)
                                    <div class="absolute top-2 right-2 flex gap-2">
                                        <a href="{{ route('admin.gallery.edit', $photo) }}" class="p-2 bg-white/90 hover:bg-white text-blue-600 rounded-lg shadow transition" title="Modifica">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <form action="{{ route('admin.gallery.destroy', $photo) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 bg-white/90 hover:bg-white text-red-600 rounded-lg shadow transition" onclick="return confirm('Eliminare questa foto?')" title="Elimina">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                </div>
            </template>

            <template x-if="layout === 'grid'">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($photos as $photo)
                        <div class="group relative rounded-xl overflow-hidden bg-slate-100 shadow-sm hover:shadow-lg transition">
                            <button @click="active={{ $photo->id }}" class="block w-full text-left">
                                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title ?? 'Foto galleria' }}" loading="lazy" class="w-full h-48 md:h-52 lg:h-56 object-cover">
                            </button>
                            @if ($photo->title)
                                <div class="p-3 text-sm font-semibold text-slate-800">{{ $photo->title }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </template>

            <template x-if="layout === 'cards'">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($photos as $photo)
                        <div class="rounded-xl overflow-hidden bg-white border border-slate-200 shadow-sm hover:shadow-md transition">
                            <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title ?? 'Foto galleria' }}" loading="lazy" class="w-full h-56 object-cover">
                            <div class="p-4">
                                <h3 class="text-sm font-bold text-slate-800 mb-1">{{ $photo->title ?? 'Foto' }}</h3>
                                @if ($photo->caption)
                                    <p class="text-xs text-slate-600">{{ $photo->caption }}</p>
                                @endif
                                <div class="mt-3 flex items-center justify-between">
                                    <button @click="active={{ $photo->id }}" class="text-purple-700 hover:text-purple-800 text-xs font-semibold">Apri</button>
                                    @auth
                                        @if(auth()->user()->is_admin)
                                            <a href="{{ route('admin.gallery.edit', $photo) }}" class="text-blue-600 hover:text-blue-700 text-xs font-semibold">Modifica</a>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </template>

            {{-- Lightbox Modal --}}
            <div x-show="active !== null" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-4" style="display:none;">
                <div class="relative bg-white rounded-xl shadow-2xl max-w-4xl w-full overflow-hidden">
                    <button @click="active=null" class="absolute top-3 right-3 p-2 rounded-full bg-white/90 hover:bg-white shadow text-slate-700" aria-label="Chiudi">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                    <div class="bg-slate-900">
                        @foreach ($photos as $photo)
                            <img x-show="active === {{ $photo->id }}" src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title ?? 'Foto' }}" class="w-full h-[60vh] object-contain" loading="eager" style="display:none;">
                        @endforeach
                    </div>
                    <div class="p-4">
                        @foreach ($photos as $photo)
                            <div x-show="active === {{ $photo->id }}" style="display:none;">
                                <h3 class="text-base font-bold text-slate-800">{{ $photo->title ?? 'Foto' }}</h3>
                                @if ($photo->caption)
                                    <p class="text-sm text-slate-600 mt-1">{{ $photo->caption }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Paginazione --}}
        <div class="mt-8">
            {{ $photos->withQueryString()->links() }}
        </div>
    @endif
@endsection
