@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Eventi</h1>
        <a href="{{ route('admin.events.create') }}" class="text-sm bg-sky-700 text-white px-3 py-1 rounded">
            Nuovo evento
        </a>
    </div>

    {{-- Ricerca --}}
    <form method="GET" action="{{ route('admin.events.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" placeholder="Cerca eventi..." value="{{ request('search') }}"
            class="flex-1 border border-slate-300 rounded px-3 py-2 text-sm">
        <button type="submit" class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold">
            Cerca
        </button>
        @if(request('search'))
            <a href="{{ route('admin.events.index') }}" class="bg-slate-300 text-slate-800 px-4 py-2 rounded text-sm">
                Reset
            </a>
        @endif
    </form>

    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if ($events->isEmpty())
        <p class="text-slate-600">Nessun evento presente.</p>
    @else
        <div class="overflow-x-auto bg-white rounded shadow-sm">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-100 text-left">
                    <tr>
                        <th class="px-4 py-2">Titolo</th>
                        <th class="px-4 py-2">Inizio</th>
                        <th class="px-4 py-2">Visibile</th>
                        <th class="px-4 py-2 text-right">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr class="border-b last:border-0">
                            <td class="px-4 py-2 font-medium">{{ $event->title }}</td>
                            <td class="px-4 py-2">{{ optional($event->starts_at)->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-2">
                                {{ $event->is_public ? 'Pubblico' : 'Privato' }}
                                @if($event->status === 'published')
                                    <span class="inline-block ml-1 px-2 py-0.5 text-xs rounded bg-green-100 text-green-800">Pubbl.</span>
                                @else
                                    <span class="inline-block ml-1 px-2 py-0.5 text-xs rounded bg-yellow-100 text-yellow-800">Bozza</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <a href="{{ route('admin.events.edit', $event) }}" class="text-sky-700 underline">Modifica</a>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 underline" onclick="return confirm('Eliminare questo evento?')">
                                        Elimina
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginazione --}}
        <div class="mt-6">
            {{ $events->links() }}
        </div>
    @endif
@endsection
