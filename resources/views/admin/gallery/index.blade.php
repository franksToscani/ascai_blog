@extends('layouts.app')

@section('title', 'Gestione galleria')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Gestione galleria</h1>

        <a href="{{ route('admin.gallery.create') }}"
           class="text-sm bg-sky-700 text-white px-3 py-1 rounded">
            Aggiungi foto
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($photos->isEmpty())
        <p class="text-slate-600 text-sm">Nessuna foto ancora.</p>
    @else
        <div class="grid md:grid-cols-3 gap-4">
            @foreach ($photos as $photo)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="aspect-video bg-slate-100">
                        <img src="{{ asset('storage/' . $photo->image_path) }}"
                            alt="{{ $photo->title ?? 'Foto' }}"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-3">
                        <p class="text-sm font-semibold mb-1">
                            {{ $photo->title ?? 'Senza titolo' }}
                        </p>
                        @if ($photo->caption)
                            <p class="text-xs text-slate-500 mb-1">
                                {{ $photo->caption }}
                            </p>
                        @endif
                        <p class="text-[11px] text-slate-400">
                            {{ $photo->published_at?->format('d/m/Y H:i') ?? $photo->created_at->format('d/m/Y H:i') }}
                            @if ($photo->is_visible)
                                • <span class="text-emerald-600">Visibile</span>
                            @else
                                • <span class="text-rose-600">Nascosta</span>
                            @endif
                        </p>
                        <div class="flex items-center gap-2 mt-3 text-xs">
                            <a href="{{ route('admin.gallery.edit', $photo) }}" class="px-2 py-1 bg-sky-100 text-sky-700 rounded hover:bg-sky-200">Modifica</a>
                            <form action="{{ route('admin.gallery.destroy', $photo) }}" method="POST" onsubmit="return confirm('Eliminare questa foto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-rose-100 text-rose-700 rounded hover:bg-rose-200">Elimina</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
