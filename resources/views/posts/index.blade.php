@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.public')

@section('content')
    {{-- Header --}}
    <div class="mb-8 bg-gradient-to-r from-sky-50 to-blue-50 rounded-2xl border border-sky-100 p-8 mt-10 md:mt-12">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-2">News & Articoli</h1>
                <p class="text-slate-600">Scopri tutte le novità e gli aggiornamenti dell'associazione</p>
            </div>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.posts.create') }}" 
                        class="inline-flex items-center gap-2 bg-sky-700 hover:bg-sky-800 text-white px-5 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Nuova News</span>
                    </a>
                @endif
            @endauth
        </div>
    </div>

    {{-- Ricerca --}}
    <form method="GET" action="{{ route('posts.index') }}" class="mb-8">
        <div class="grid md:grid-cols-5 gap-3">
            <div class="md:col-span-2 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" placeholder="Cerca per titolo o contenuto..." value="{{ request('search') }}"
                    class="w-full pl-10 pr-4 py-3 border-2 border-slate-200 rounded-lg focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all">
            </div>
            <div>
                <input type="date" name="from_date" value="{{ request('from_date') }}" 
                    class="w-full px-3 py-3 border-2 border-slate-200 rounded-lg focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all" 
                    placeholder="Dal" aria-label="Dal">
            </div>
            <div>
                <input type="date" name="to_date" value="{{ request('to_date') }}" 
                    class="w-full px-3 py-3 border-2 border-slate-200 rounded-lg focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all" 
                    placeholder="Al" aria-label="Al">
            </div>
            <div class="flex items-center">
                <button type="submit" 
                    class="w-full bg-sky-700 hover:bg-sky-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300">
                    Cerca
                </button>
            </div>
        </div>
        <div class="mt-3">
            @if(request()->hasAny(['search','from_date','to_date']))
                <a href="{{ route('posts.index') }}" 
                    class="inline-block bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-lg font-semibold transition-all duration-300">
                    Reset
                </a>
            @endif
        </div>
    </form>


    @if ($posts->isEmpty())
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-slate-600 text-lg mb-2">Nessuna news trovata</p>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-2 text-sky-700 hover:text-sky-800 font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Crea la prima news</span>
                    </a>
                @endif
            @endauth
        </div>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <article class="group bg-white rounded-xl shadow-md hover:shadow-2xl border border-slate-100 hover:border-sky-200 overflow-hidden transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <div class="bg-sky-100 text-sky-700 px-3 py-1 rounded-full text-xs font-bold">
                                NEWS
                            </div>
                            <time class="text-xs text-slate-500 font-medium">{{ $post->created_at->format('d M Y') }}</time>
                        </div>
                        
                        <h2 class="text-xl font-bold mb-3 line-clamp-2">
                            <a href="{{ route('posts.show', $post) }}" class="text-slate-800 group-hover:text-sky-700 transition-colors">
                                {{ $post->title }}
                            </a>
                        </h2>
                        
                        <p class="text-sm text-slate-600 leading-relaxed line-clamp-3 mb-4">
                            {{ Str::limit($post->content, 150) }}
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <a href="{{ route('posts.show', $post) }}" 
                            class="inline-flex items-center gap-1 text-sm text-sky-700 font-semibold group-hover:gap-2 transition-all">
                                <span>Leggi tutto</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                            
                            @auth
                                @if(auth()->user()->is_admin)
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.posts.edit', $post) }}" 
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" 
                                        title="Modifica">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" 
                                                    onclick="return confirm('Eliminare questa news?')" 
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
                </article>
            @endforeach
        </div>

        {{-- Paginazione --}}
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @endif
@endsection
