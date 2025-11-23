<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Blog Associazione</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind via CDN giusto per fare in fretta --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100">
    <nav class="bg-sky-700 text-white px-6 py-4 mb-6 shadow">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <a href="{{ route('posts.index') }}" class="font-semibold text-lg">
                Blog Associazione
            </a>
            <a href="{{ route('posts.create') }}" class="bg-white text-sky-700 px-3 py-1 rounded text-sm font-medium">
                Nuovo post
            </a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
