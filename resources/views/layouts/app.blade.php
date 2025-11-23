<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Associazione No-Profit')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 text-slate-800">
    {{-- NAVBAR --}}
    <nav class="bg-sky-700 text-white shadow">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-semibold text-lg">
                Associazione No-Profit
            </a>

            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('home') }}" class="hover:text-sky-200">Home</a>
                <a href="{{ route('chi-siamo') }}" class="hover:text-sky-200">Chi siamo</a>
                <a href="{{ route('eventi.index') }}" class="hover:text-sky-200">Eventi</a>
                <a href="{{ route('news.index') }}" class="hover:text-sky-200">News</a>
                <a href="{{ route('associati') }}" class="hover:text-sky-200">Associati</a>
                <a href="{{ route('contatti') }}" class="hover:text-sky-200">Contatti</a>
            </div>
        </div>
    </nav>

    {{-- CONTENUTO --}}
    <main class="max-w-5xl mx-auto px-4 py-6">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="mt-8 border-t border-slate-200 bg-white">
        <div class="max-w-5xl mx-auto px-4 py-4 text-xs text-slate-500 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                © {{ date('Y') }} Associazione No-Profit. Tutti i diritti riservati.
            </div>
            <div class="flex gap-3">
                <span>Email: info@associazione.it</span>
                <span>Tel: +39 000 0000000</span>
            </div>
        </div>
    </footer>
</body>
</html>
