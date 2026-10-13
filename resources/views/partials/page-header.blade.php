{{--
    Intestazione delle pagine interne: trattino tricolore discreto, titolo, sottotitolo
    e (solo per gli admin) un pulsante di azione.
    Parametri: $title, $subtitle, facoltativi $actionUrl e $actionLabel.
--}}
<header class="mb-8 pb-6 border-b border-slate-200 flex flex-wrap items-end justify-between gap-4">
    <div>
        <div class="flex gap-1 mb-3" aria-hidden="true">
            <span class="h-1 w-6 rounded-full bg-camerun-green"></span>
            <span class="h-1 w-6 rounded-full bg-camerun-red"></span>
            <span class="h-1 w-6 rounded-full bg-camerun-yellow"></span>
        </div>
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900">{{ $title }}</h1>
        @isset($subtitle)
            <p class="mt-2 text-slate-600">{{ $subtitle }}</p>
        @endisset
    </div>

    @isset($actionUrl)
        @auth
            @if (auth()->user()->is_admin)
                <a href="{{ $actionUrl }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-300 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    {{ $actionLabel }}
                </a>
            @endif
        @endauth
    @endisset
</header>
