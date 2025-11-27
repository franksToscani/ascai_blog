@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Nuovo post</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.store') }}" method="POST" class="space-y-4 bg-white p-4 rounded shadow-sm">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Titolo</label>
            <input type="text" name="title" value="{{ old('title') }}"
                class="w-full border border-slate-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Contenuto</label>
            <textarea name="content" rows="6"
                    class="w-full border border-slate-300 rounded px-3 py-2">{{ old('content') }}</textarea>
        </div>

        <button type="submit"
                class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold">
            Salva
        </button>
    </form>
@endsection
