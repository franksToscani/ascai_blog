@extends('layouts.app')

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
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="aspect-square bg-slate-100">
                        <img src="{{ asset('storage/' . $photo->image_path) }}"
                            alt="{{ $photo->title ?? 'Foto galleria' }}"
                            class="w-full h-full object-cover">
                    </div>
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
    @endif
@endsection
