{{-- Card di un evento con data a calendario (home e pagina Eventi). Parametro: $event --}}
<article class="group relative flex gap-5 bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 p-5 transition-all duration-300">
    <div class="flex-shrink-0 w-16 rounded-xl overflow-hidden text-center border border-slate-200 self-start">
        <div class="bg-camerun-red text-white text-[11px] font-bold uppercase tracking-wider py-1">
            {{ $event->starts_at->translatedFormat('M') }}
        </div>
        <div class="py-1.5 bg-white">
            <div class="text-2xl font-extrabold leading-none text-slate-900">{{ $event->starts_at->format('j') }}</div>
            <div class="text-[11px] text-slate-500 mt-1 capitalize">{{ $event->starts_at->translatedFormat('D') }}</div>
        </div>
    </div>

    <div class="min-w-0 flex-1 flex flex-col">
        <h3 class="font-bold text-lg leading-snug text-slate-900 line-clamp-2 group-hover:text-camerun-green transition-colors">
            <a href="{{ route('eventi.show', $event) }}" class="after:absolute after:inset-0">{{ $event->title }}</a>
        </h3>
        <p class="mt-2 flex items-center gap-1.5 text-sm text-slate-600">
            <svg class="w-4 h-4 flex-shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Ore {{ $event->starts_at->format('H:i') }}
        </p>
        @if ($event->location)
            <p class="mt-1 flex items-center gap-1.5 text-sm text-slate-600">
                <svg class="w-4 h-4 flex-shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="line-clamp-1">{{ $event->location }}</span>
            </p>
        @endif
        <p class="mt-3 text-sm text-slate-500 leading-relaxed line-clamp-2">
            {{ \Illuminate\Support\Str::limit(strip_tags($event->description), 100) }}
        </p>
        <div class="mt-auto pt-2 flex justify-end">
            @include('partials.admin-actions', [
                'editUrl' => route('admin.events.edit', $event),
                'deleteUrl' => route('admin.events.destroy', $event),
                'confirm' => 'Eliminare questo evento?',
            ])
        </div>
    </div>
</article>
