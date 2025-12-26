@extends('layouts.app')

@section('title', 'Carica Bilancio (PDF)')

@section('content')
    <div class="mb-8 bg-gradient-to-r from-slate-50 via-slate-100 to-slate-50 rounded-2xl p-8 shadow-sm border border-slate-200 mt-12 md:mt-16">
        <h1 class="text-3xl font-extrabold text-slate-800 mb-2">Carica bilancio</h1>
        <p class="text-slate-600">Seleziona l'anno e il file PDF da caricare.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-xl">
        <form action="{{ route('admin.bilanci.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Anno</label>
                <input type="number" name="year" value="{{ old('year') }}" min="2000" max="3000" required class="w-full border border-slate-300 rounded-lg px-3 py-2" />
                @error('year')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Titolo (opzionale)</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2" />
                @error('title')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">File PDF</label>
                <input type="file" name="file" accept="application/pdf" required class="w-full border border-slate-300 rounded-lg px-3 py-2" />
                @error('file')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="inline-flex items-center gap-2 bg-sky-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-sky-700 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Carica
                </button>
                <a href="{{ route('admin.bilanci.index') }}" class="text-slate-600 text-sm underline">Annulla</a>
            </div>
        </form>
    </div>
@endsection
