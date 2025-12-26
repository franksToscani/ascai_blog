@extends('layouts.app')

@section('title', 'Gestione Bilanci (PDF)')

@section('content')
    <div class="mb-8 bg-gradient-to-r from-slate-50 via-slate-100 to-slate-50 rounded-2xl p-8 shadow-sm border border-slate-200 mt-12 md:mt-16">
        <h1 class="text-3xl font-extrabold text-slate-800 mb-2">Bilanci in PDF</h1>
        <p class="text-slate-600">Carica e gestisci i bilanci annuali dell'associazione.</p>
    </div>

    <div class="mb-6">
        <a href="{{ route('admin.bilanci.create') }}" class="inline-flex items-center gap-2 bg-sky-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-sky-700 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Carica nuovo bilancio
        </a>
    </div>

    @if(session('status'))
        <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-4 text-green-800 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Anno</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">Titolo</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-600">File</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($bilanci as $b)
                    <tr>
                        <td class="px-4 py-3 text-sm font-semibold text-slate-800">{{ $b->year }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">{{ $b->title ?? '-' }}</td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('bilancio.download', ['year' => $b->year]) }}" class="text-sky-700 hover:text-sky-800 font-semibold">Scarica</a>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <form action="{{ route('admin.bilanci.destroy', $b) }}" method="POST" onsubmit="return confirm('Eliminare il bilancio {{ $b->year }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-semibold">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-slate-500">Nessun bilancio caricato.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
