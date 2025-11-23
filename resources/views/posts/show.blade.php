@extends('layouts.app')

@section('content')
    <article class="bg-white p-4 rounded shadow-sm">
        <h1 class="text-2xl font-bold mb-2">{{ $post->title }}</h1>
        <p class="text-sm text-slate-500 mb-4">
            Pubblicato il {{ $post->created_at->format('d/m/Y H:i') }}
        </p>
        <div class="prose max-w-none">
            {!! nl2br(e($post->content)) !!}
        </div>
    </article>

    <div class="mt-4">
        <a href="{{ route('posts.index') }}" class="text-sky-700 underline text-sm">
            ← Torna alla lista
        </a>
    </div>
@endsection
