{{-- Intestazione di sezione della home: trattino tricolore, titolo, sottotitolo e link "vedi tutti" --}}
<div class="flex items-end justify-between gap-4 mb-6">
    <div>
        <div class="flex gap-1 mb-3" aria-hidden="true">
            <span class="h-1 w-6 rounded-full bg-camerun-green"></span>
            <span class="h-1 w-6 rounded-full bg-camerun-red"></span>
            <span class="h-1 w-6 rounded-full bg-camerun-yellow"></span>
        </div>
        <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-slate-900">{{ $title }}</h2>
        <p class="text-sm text-slate-500 mt-1">{{ $subtitle }}</p>
    </div>
    <a href="{{ $link }}" class="inline-flex items-center gap-1 text-sm text-sky-700 hover:text-sky-800 font-semibold group whitespace-nowrap">
        <span>{{ $linkText }}</span>
        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </a>
</div>
