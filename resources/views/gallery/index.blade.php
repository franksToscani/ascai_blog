@extends('layouts.public')

@section('title', 'Galleria foto - Associazione')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Galleria foto</h1>
    </div>

    @if ($photos->isEmpty())
        <p class="text-slate-600 text-sm">
            Non ci sono ancora foto in galleria.
        </p>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($photos as $photo)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden relative group">
                    <div class="aspect-square bg-slate-100">
                        <img src="{{ asset('storage/' . $photo->image_path) }}"
                            alt="{{ $photo->title ?? 'Foto galleria' }}"
                            loading="lazy"
                            class="w-full h-full object-cover">
                    </div>
                    @auth
                        @if(auth()->user()->is_admin)
                            <div class="absolute top-0 right-0 bg-black bg-opacity-70 text-white text-xs p-1 rounded-bl flex gap-1 opacity-0 group-hover:opacity-100 transition">
                                <a href="{{ route('admin.gallery.edit', $photo) }}" class="hover:underline">Modifica</a>
                                <form action="{{ route('admin.gallery.destroy', $photo) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="hover:underline" onclick="return confirm('Eliminare questa foto?')">Elimina</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                    @if ($photo->title || $photo->caption)
                        <div class="p-2">
                            @if ($photo->title)
                                <p class="text-xs font-semibold">{{ $photo->title }}</p>
                            @endif
                            @if ($photo->caption)
                                <p class="text-[11px] text-slate-500">
                                    {{ $photo->caption }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Paginazione --}}
        <div class="mt-6">
            {{ $photos->links() }}
        </div>
    @endif
@endsection
