<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/logoAscai1.png') }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-slate-50 via-slate-100 to-slate-200">
            <div>
                <a href="/" class="inline-flex items-center gap-2">
                    <x-application-logo class="w-16 h-16 rounded-full shadow-md ring-1 ring-white/50" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-6 bg-white/90 backdrop-blur shadow-lg overflow-hidden sm:rounded-xl border border-slate-100">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
