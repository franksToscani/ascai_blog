@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.public')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Ultimi post</h1>

    <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">News</h1>

    @auth
        @if(auth()->user()->is_admin)
            <a href="{{ route('admin.posts.create') }}" class="text-sm bg-sky-700 text-white px-3 py-1 rounded">
                Nuova news
            </a>
        @endif
    @endauth
</div>

    {{-- Ricerca --}}
    <form method="GET" action="{{ route('posts.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" placeholder="Cerca post..." value="{{ request('search') }}"
            class="flex-1 border border-slate-300 rounded px-3 py-2 text-sm">
        <button type="submit" class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold">
            Cerca
        </button>
        @if(request('search'))
            <a href="{{ route('posts.index') }}" class="bg-slate-300 text-slate-800 px-4 py-2 rounded text-sm">
                Reset
            </a>
        @endif
    </form>


    @if ($posts->isEmpty())
        <p class="text-slate-600">Non ci sono ancora post.
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.posts.create') }}" class="text-sky-700 underline">Crea il primo</a>
                @endif
            @endauth
        </p>
    @else
        <div class="space-y-4">
            @foreach ($posts as $post)
                <article class="bg-white p-4 rounded shadow-sm">
                    <div class="flex items-start justify-between mb-2">
                        <h2 class="text-xl font-semibold">
                            <a href="{{ route('posts.show', $post) }}" class="text-sky-700 hover:underline">
                                {{ $post->title }}
                            </a>
                        </h2>
                        @auth
                            @if(auth()->user()->is_admin)
                                <div class="flex items-center gap-2 text-xs">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-600 hover:underline">Modifica</a>
                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Eliminare questo post?')">Elimina</button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                    <p class="text-sm text-slate-500 mb-2">
                        Pubblicato il {{ $post->created_at->format('d/m/Y H:i') }}
                    </p>
                    <p class="text-slate-700 line-clamp-2">
                        {{ Str::limit($post->content, 150) }}
                    </p>
                </article>
            @endforeach
        </div>

        {{-- Paginazione --}}
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
@endsection
