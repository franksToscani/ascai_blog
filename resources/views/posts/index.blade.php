@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.app')

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


    @if ($posts->isEmpty())
        <p class="text-slate-600">Non ci sono ancora post. <a href="{{ route('posts.create') }}" class="text-sky-700 underline">Crea il primo</a>.</p>
    @else
        <div class="space-y-4">
            @foreach ($posts as $post)
                <article class="bg-white p-4 rounded shadow-sm">
                    <h2 class="text-xl font-semibold mb-1">
                        <a href="{{ route('posts.show', $post) }}" class="text-sky-700 hover:underline">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="text-sm text-slate-500 mb-2">
                        Pubblicato il {{ $post->created_at->format('d/m/Y H:i') }}
                    </p>
                    <p class="text-slate-700 line-clamp-2">
                        {{ Str::limit($post->content, 150) }}
                    </p>
                </article>
            @endforeach
        </div>
    @endif
@endsection
