@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">News / Post</h1>
        <a href="{{ route('admin.posts.create') }}" class="text-sm bg-sky-700 text-white px-3 py-1 rounded">
            Nuovo post
        </a>
    </div>

    {{-- Ricerca --}}
    <form method="GET" action="{{ route('admin.posts.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" placeholder="Cerca post..." value="{{ request('search') }}"
            class="flex-1 border border-slate-300 rounded px-3 py-2 text-sm">
        <button type="submit" class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold">
            Cerca
        </button>
        @if(request('search'))
            <a href="{{ route('admin.posts.index') }}" class="bg-slate-300 text-slate-800 px-4 py-2 rounded text-sm">
                Reset
            </a>
        @endif
    </form>

    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if ($posts->isEmpty())
        <p class="text-slate-600">Nessun post presente.</p>
    @else
        <div class="overflow-x-auto bg-white rounded shadow-sm">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-100 text-left">
                    <tr>
                        <th class="px-4 py-2">Titolo</th>
                        <th class="px-4 py-2">Stato</th>
                        <th class="px-4 py-2">Data</th>
                        <th class="px-4 py-2 text-right">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="border-b last:border-0">
                            <td class="px-4 py-2 font-medium">{{ $post->title }}</td>
                            <td class="px-4 py-2">
                                @if($post->status === 'published')
                                    <span class="inline-block px-2 py-0.5 text-xs rounded bg-green-100 text-green-800">Pubblicato</span>
                                @else
                                    <span class="inline-block px-2 py-0.5 text-xs rounded bg-yellow-100 text-yellow-800">Bozza</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $post->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="text-sky-700 underline">Modifica</a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 underline" onclick="return confirm('Eliminare questo post?')">
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
            {{ $posts->links() }}
        </div>
    @endif
@endsection
