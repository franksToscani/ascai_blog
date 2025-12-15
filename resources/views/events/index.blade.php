@extends('layouts.public')

@section('title', 'Eventi - Associazione No-Profit')

@section('content')
    {{-- Header --}}
    <div class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border border-green-100 p-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-2">Eventi</h1>
                <p class="text-slate-600">Scopri tutti gli eventi dell'associazione e partecipa</p>
            </div>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.events.create') }}" 
                        class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-5 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Nuovo Evento</span>
                    </a>
                @endif
            @endauth
        </div>
    </div>

    {{-- Ricerca --}}
    <form method="GET" action="{{ route('eventi.index') }}" class="mb-8">
        <div class="grid md:grid-cols-5 gap-3">
            <div class="md:col-span-2 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" placeholder="Cerca per titolo o descrizione..." value="{{ request('search') }}"
                    class="w-full pl-10 pr-4 py-3 border-2 border-slate-200 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all">
            </div>
            <div>
                <input type="date" name="from_date" value="{{ request('from_date') }}" 
                    class="w-full px-3 py-3 border-2 border-slate-200 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all" 
                    placeholder="Dal" aria-label="Dal">
            </div>
            <div>
                <input type="date" name="to_date" value="{{ request('to_date') }}" 
                    class="w-full px-3 py-3 border-2 border-slate-200 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all" 
                    placeholder="Al" aria-label="Al">
            </div>
            <div>
                <input type="text" name="location" value="{{ request('location') }}" placeholder="Luogo"
                    class="w-full px-3 py-3 border-2 border-slate-200 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all">
            </div>
        </div>
        <div class="mt-3 flex gap-3">
            <button type="submit" 
                class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300">
                Cerca
            </button>
            @if(request()->hasAny(['search','from_date','to_date','location']))
                <a href="{{ route('eventi.index') }}" 
                    class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-lg font-semibold transition-all duration-300">
                    Reset
                </a>
            @endif
        </div>
    </form>


    {{-- Prossimi eventi --}}
    <section class="mb-12">
        <div class="mb-6">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-800">Prossimi eventi</h2>
            <p class="text-sm text-slate-500 mt-1">Eventi in programma</p>
        </div>

        @if ($upcomingEvents->isEmpty())
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
                <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-slate-600 text-lg">Nessun evento in programma al momento</p>
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($upcomingEvents as $event)
                    <article class="group bg-white rounded-xl shadow-md hover:shadow-2xl border border-slate-100 hover:border-green-200 overflow-hidden transition-all duration-300 transform hover:-translate-y-1">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-3">
                                <div class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                    PROSSIMO
                                </div>
                                <time class="text-xs text-slate-500 font-medium">{{ $event->starts_at->format('d M Y') }}</time>
                            </div>
                            
                            <h3 class="text-xl font-bold mb-3 line-clamp-2">
                                <a href="{{ route('eventi.show', $event) }}" class="text-slate-800 group-hover:text-green-700 transition-colors">
                                    {{ $event->title }}
                                </a>
                            </h3>
                            
                            @if ($event->location)
                                <div class="flex items-center gap-2 text-sm text-slate-500 mb-3">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="line-clamp-1">{{ $event->location }}</span>
                                </div>
                            @endif
                            
                            <p class="text-sm text-slate-600 leading-relaxed line-clamp-3 mb-4">
                                {{ \Illuminate\Support\Str::limit($event->description, 150) }}
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <a href="{{ route('eventi.show', $event) }}" 
                                    class="inline-flex items-center gap-1 text-sm text-green-700 font-semibold group-hover:gap-2 transition-all">
                                    <span>Scopri di più</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </a>
                                
                                @auth
                                    @if(auth()->user()->is_admin)
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.events.edit', $event) }}" 
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" 
                                                title="Modifica">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" 
                                                        onclick="return confirm('Eliminare questo evento?')" 
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

            {{-- Paginazione prossimi eventi --}}
            <div class="mt-8">
                {{ $upcomingEvents->links() }}
            </div>
        @endif
    </section>

    {{-- Eventi passati --}}
    <section>
        <div class="border-t-2 border-slate-200 pt-12 mb-6">
            <h2 class="text-2xl md:text-3xl font-bold text-slate-800">Eventi passati</h2>
            <p class="text-sm text-slate-500 mt-1">Archivio eventi conclusi</p>
        </div>

        @if ($pastEvents->isEmpty())
            <div class="bg-slate-50 rounded-xl border border-slate-200 p-8 text-center">
                <p class="text-slate-500">Nessun evento passato registrato</p>
            </div>
        @else
            <div class="grid md:grid-cols-2 gap-4">
                @foreach ($pastEvents as $event)
                    <article class="group bg-slate-50 hover:bg-white rounded-lg shadow-sm hover:shadow-md border border-slate-200 p-4 transition-all duration-300">
                        <div class="flex justify-between items-start gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="bg-slate-200 text-slate-600 px-2 py-1 rounded text-xs font-semibold">
                                        CONCLUSO
                                    </div>
                                    <time class="text-xs text-slate-500">{{ $event->starts_at->format('d M Y') }}</time>
                                </div>
                                <h3 class="font-bold text-slate-700 mb-1">
                                    <a href="{{ route('eventi.show', $event) }}" class="hover:text-green-700 transition-colors">
                                        {{ $event->title }}
                                    </a>
                                </h3>
                            </div>
                            @auth
                                @if(auth()->user()->is_admin)
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('admin.events.edit', $event) }}" 
                                            class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition-colors" 
                                            title="Modifica">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-1.5 text-red-600 hover:bg-red-50 rounded transition-colors" 
                                                    onclick="return confirm('Eliminare questo evento?')" 
                                                    title="Elimina">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Paginazione eventi passati --}}
            <div class="mt-8">
                {{ $pastEvents->links() }}
            </div>
        @endif
    </section>
@endsection
