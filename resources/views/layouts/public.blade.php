<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'ASCAI – Associazione dei Camerunesi a Bologna')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased bg-gray-30 text-gray-800 flex flex-col min-h-screen">

    {{-- NAVBAR PUBBLICA MODERNA --}}
    <header x-data="{ mobileMenuOpen: false, scrolled: false }" 
            x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
            :class="scrolled ? 'shadow-lg' : 'shadow-md'"
            class="sticky top-0 z-50 bg-white transition-shadow duration-300">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo e Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="relative">
                        <img src="{{ asset('images/logo3.png') }}" alt="Logo ASCAI Bologna" class="h-12 w-auto transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-sky-400 rounded-full blur-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </div>
                    <div>
                        <span class="text-xl font-bold text-slate-800 group-hover:text-sky-600 transition-colors">ASCAI Bologna</span>
                        <p class="text-xs text-slate-500 hidden sm:block">Associazione dei Camerunesi</p>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-sky-50 transition-all duration-200 {{ request()->routeIs('home') ? 'text-sky-600 bg-sky-50' : '' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Home
                        </div>
                    </a>
                    {{-- Dropdown Chi siamo (Professionale) --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-sky-50 transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('chi-siamo') || request()->routeIs('missione') || request()->routeIs('statuto') || request()->routeIs('staff*') || request()->routeIs('bilancio') ? 'text-sky-600 bg-sky-50' : '' }}">
                            <span>Chi siamo</span>
                            <svg class="w-4 h-4 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </button>
                        
                        {{-- Dropdown Menu --}}
                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                            class="absolute left-0 mt-3 w-72 bg-white rounded-xl shadow-2xl border border-slate-200 overflow-hidden z-50"
                            style="display: none;">
                            
                            {{-- Header --}}
                            <div class="bg-gradient-to-r from-sky-600 to-blue-300 px-3 py-1">
                                <h3 class="text-white font-bold text-sm">Scopri ASCAI Bologna</h3>
                                <p class="text-sky-100 text-xs mt-1">Valori, missione e persone</p>
                            </div>

                            {{-- Menu Items --}}
                            <div class="py-2">
                                {{-- La missione --}}
                                <a href="{{ route('missione') }}" class="px-6 py-3 flex items-start gap-3 hover:bg-sky-50 transition-colors duration-150 border-l-4 border-transparent {{ request()->routeIs('missione') ? 'bg-sky-50 border-sky-600' : 'border-white hover:border-sky-200' }}">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-slate-900">La missione</p>
                                        <p class="text-xs text-slate-600 mt-0.5">Valori e obiettivi</p>
                                    </div>
                                </a>

                                {{-- Statuto --}}
                                <a href="{{ route('statuto') }}" class="px-6 py-3 flex items-start gap-3 hover:bg-sky-50 transition-colors duration-150 border-l-4 border-transparent {{ request()->routeIs('statuto') ? 'bg-sky-50 border-sky-600' : 'border-white hover:border-sky-200' }}">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-slate-900">Statuto</p>
                                        <p class="text-xs text-slate-600 mt-0.5">Norme e regolamenti</p>
                                    </div>
                                </a>

                                {{-- Separatore --}}
                                <div class="my-1 h-px bg-slate-200"></div>

                                {{-- Lo staff --}}
                                <a href="{{ route('staff-ascaibo') }}" class="px-6 py-3 flex items-start gap-3 hover:bg-sky-50 transition-colors duration-150 border-l-4 border-transparent {{ request()->routeIs('staff-ascaibo') ? 'bg-sky-50 border-sky-600' : 'border-white hover:border-sky-200' }}">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048m0 0a4 4 0 110-8.048m0 8.048a4 4 0 110 8.048m0-8.048a4 4 0 110-8.048"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-slate-900">Lo staff</p>
                                        <p class="text-xs text-slate-600 mt-0.5">Il direttivo e team</p>
                                    </div>
                                </a>

                                {{-- Bilancio sociale --}}
                                <a href="{{ route('bilancio') }}" class="px-6 py-3 flex items-start gap-3 hover:bg-sky-50 transition-colors duration-150 border-l-4 border-transparent {{ request()->routeIs('bilancio') ? 'bg-sky-50 border-sky-600' : 'border-white hover:border-sky-200' }}">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-slate-900">Bilancio sociale</p>
                                        <p class="text-xs text-slate-600 mt-0.5">Trasparenza e impatto</p>
                                    </div>
                                </a>
                            </div>

                            {{-- Footer con link aggiuntivo --}}
                            <div class="bg-slate-50 px-6 py-3 border-t border-slate-200">
                                <a href="{{ route('associati') }}" class="text-sm font-semibold text-sky-600 hover:text-sky-700 flex items-center gap-1">
                                    <span>Diventa socio</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('associati') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-sky-50 transition-all duration-200 {{ request()->routeIs('associati') ? 'text-sky-600 bg-sky-50' : '' }}">
                        Associati
                    </a>
                    <a href="{{ route('eventi.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-green-600 hover:bg-green-50 transition-all duration-200 {{ request()->routeIs('eventi.*') ? 'text-green-600 bg-green-50' : '' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Eventi
                        </div>
                    </a>
                    <a href="{{ route('posts.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-sky-50 transition-all duration-200 {{ request()->routeIs('posts.*') ? 'text-sky-600 bg-sky-50' : '' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            News
                        </div>
                    </a>
                    <a href="{{ route('galleria') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-purple-600 hover:bg-purple-50 transition-all duration-200 {{ request()->routeIs('galleria') ? 'text-purple-600 bg-purple-50' : '' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Galleria
                        </div>
                    </a>
                    <a href="{{ route('contatti') }}" class="ml-2 px-5 py-2 rounded-lg text-sm font-bold text-white bg-gradient-to-r from-sky-600 to-sky-700 hover:from-sky-700 hover:to-sky-800 shadow-md hover:shadow-lg transition-all duration-200 {{ request()->routeIs('contatti') ? 'ring-2 ring-sky-300' : '' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Contatti
                        </div>
                    </a>
                </nav>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-lg text-slate-600 hover:text-sky-600 hover:bg-sky-50 transition-colors">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    class="lg:hidden pb-4"
                    style="display: none;">
                <nav class="flex flex-col gap-1 pt-2">
                    <a href="{{ route('home') }}" class="px-4 py-3 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-sky-50 transition-all {{ request()->routeIs('home') ? 'text-sky-600 bg-sky-50' : '' }}">
                        Home
                    </a>
                    {{-- Mobile Dropdown Chi siamo (Professionale) --}}
                    <div x-data="{ mobileChiSiamoOpen: false }" class="relative">
                        <button @click="mobileChiSiamoOpen = !mobileChiSiamoOpen" class="w-full px-4 py-3 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-sky-50 transition-all flex items-center justify-between {{ request()->routeIs('chi-siamo') || request()->routeIs('missione') || request()->routeIs('statuto') || request()->routeIs('staff*') || request()->routeIs('bilancio') ? 'text-sky-600 bg-sky-50' : '' }}">
                            <span>Chi siamo</span>
                            <svg class="w-4 h-4 transition-transform duration-300" :class="mobileChiSiamoOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        </button>
                        <div x-show="mobileChiSiamoOpen" x-transition class="bg-slate-100 rounded-lg mt-2 py-2 border border-slate-300">
                            <a href="{{ route('missione') }}" class="px-6 py-3 flex items-start gap-3 hover:bg-white transition-colors duration-150 border-l-4 {{ request()->routeIs('missione') ? 'bg-white border-sky-600' : 'border-slate-100 hover:border-sky-200' }}">
                                <div class="flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-900">La missione</p>
                                    <p class="text-xs text-slate-600 mt-0.5">Valori e obiettivi</p>
                                </div>
                            </a>
                            <a href="{{ route('statuto') }}" class="px-6 py-3 flex items-start gap-3 hover:bg-white transition-colors duration-150 border-l-4 {{ request()->routeIs('statuto') ? 'bg-white border-sky-600' : 'border-slate-100 hover:border-sky-200' }}">
                                <div class="flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-900">Statuto</p>
                                    <p class="text-xs text-slate-600 mt-0.5">Norme e regolamenti</p>
                                </div>
                            </a>
                            <div class="my-1 h-px bg-slate-300"></div>
                            <a href="{{ route('staff-ascaibo') }}" class="px-6 py-3 flex items-start gap-3 hover:bg-white transition-colors duration-150 border-l-4 {{ request()->routeIs('staff-ascaibo') ? 'bg-white border-sky-600' : 'border-slate-100 hover:border-sky-200' }}">
                                <div class="flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048m0 0a4 4 0 110-8.048m0 8.048a4 4 0 110 8.048m0-8.048a4 4 0 110-8.048"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-900">Lo staff</p>
                                    <p class="text-xs text-slate-600 mt-0.5">Il direttivo e team</p>
                                </div>
                            </a>
                            <a href="{{ route('bilancio') }}" class="px-6 py-3 flex items-start gap-3 hover:bg-white transition-colors duration-150 border-l-4 {{ request()->routeIs('bilancio') ? 'bg-white border-sky-600' : 'border-slate-100 hover:border-sky-200' }}">
                                <div class="flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-900">Bilancio sociale</p>
                                    <p class="text-xs text-slate-600 mt-0.5">Trasparenza e impatto</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('associati') }}" class="px-4 py-3 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-sky-50 transition-all {{ request()->routeIs('associati') ? 'text-sky-600 bg-sky-50' : '' }}">
                        Associati
                    </a>
                    <a href="{{ route('eventi.index') }}" class="px-4 py-3 rounded-lg text-sm font-semibold text-slate-700 hover:text-green-600 hover:bg-green-50 transition-all {{ request()->routeIs('eventi.*') ? 'text-green-600 bg-green-50' : '' }}">
                        Eventi
                    </a>
                    <a href="{{ route('posts.index') }}" class="px-4 py-3 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-sky-50 transition-all {{ request()->routeIs('posts.*') ? 'text-sky-600 bg-sky-50' : '' }}">
                        News
                    </a>
                    <a href="{{ route('galleria') }}" class="px-4 py-3 rounded-lg text-sm font-semibold text-slate-700 hover:text-purple-600 hover:bg-purple-50 transition-all {{ request()->routeIs('galleria') ? 'text-purple-600 bg-purple-50' : '' }}">
                        Galleria
                    </a>
                    <a href="{{ route('contatti') }}" class="px-4 py-3 rounded-lg text-sm font-bold text-white bg-gradient-to-r from-sky-600 to-sky-700 hover:from-sky-700 hover:to-sky-800 shadow-md text-center {{ request()->routeIs('contatti') ? 'ring-2 ring-sky-300' : '' }}">
                        Contatti
                    </a>
                </nav>
            </div>
        </div>
    </header>

    {{-- CONTENUTO --}}
    <main class="max-w-7xl mx-auto px-6 py-10 flex-1">
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')

</body>
</html>
