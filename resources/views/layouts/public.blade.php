<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'ASCAI – Associazione dei Camerunesi a Bologna')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800">

    {{-- NAVBAR PUBBLICA --}}
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
            <a href="{{ route('home') }}" class="text-lg font-semibold text-sky-700">
                AS.CA.I Bologna
            </a>

            <nav class="hidden md:flex items-center gap-4 text-sm">
                <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
                <a href="{{ route('chi-siamo') }}" class="hover:text-sky-600">Chi siamo</a>
                <a href="{{ route('associati') }}" class="hover:text-sky-600">Associati</a>
                <a href="{{ route('eventi.index') }}" class="hover:text-sky-600">Eventi</a>
                <a href="{{ route('posts.index') }}" class="hover:text-sky-600">News</a>
                <a href="{{ route('galleria') }}" class="hover:text-sky-600">Galleria</a>
                <a href="{{ route('contatti') }}" class="hover:text-sky-600">Contatti</a>
            </nav>
        </div>
    </header>

    {{-- CONTENUTO --}}
    <main class="max-w-7xl mx-auto px-6 py-10">
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-100 py-6 mt-10">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-3 text-sm text-gray-600">
        <p>
            © {{ date('Y') }} AS.CA.I Bologna – Tutti i diritti riservati.
        </p>

        <a href="{{ route('login') }}" class="text-xs text-gray-500 hover:text-sky-700">
            Accesso amministratori
        </a>
    </div>
</footer>

</body>
</html>
