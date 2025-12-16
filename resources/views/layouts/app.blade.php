<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="Franks Toscani - Web Developer">
        <meta name="copyright" content="© {{ date('Y') }} ASCAI Bologna. Sviluppato da Franks Toscani.">
        <meta name="robots" content="noindex, nofollow">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/logoAscai1.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/logoAscai1.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased flex flex-col min-h-screen">
        <div class="flex-1 bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="w-full flex-1">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
                    @isset($slot)
                        {{-- Usato quando il layout è chiamato come componente: <x-app-layout> --}}
                        {{ $slot }}
                    @else
                        {{-- Usato quando il layout è esteso con @extends('layouts.app') --}}
                        @yield('content')
                    @endisset
                </div>
            </main>
        </div>

        <!-- Footer -->
        @include('layouts.footer')
    </body>
</html>
