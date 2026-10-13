{{-- Visualizzatore a schermo intero. Va incluso dentro un elemento con x-data="lightbox(...)" --}}
<div x-show="index !== null"
     x-transition.opacity
     @keydown.window="onKeydown($event)"
     @touchstart.passive="onTouchStart($event)"
     @touchend="onTouchEnd($event)"
     class="fixed inset-0 z-[60] flex flex-col bg-black/95 text-white"
     role="dialog" aria-modal="true" aria-label="Visualizzatore foto"
     style="display: none;">

    {{-- Barra superiore: contatore e chiusura --}}
    <div class="flex items-center justify-between px-4 py-3 text-sm">
        <span class="text-white/70" x-text="(index + 1) + ' / ' + photos.length"></span>
        <button type="button" @click="close()" class="p-2 rounded-full hover:bg-white/10" aria-label="Chiudi">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- Foto con frecce --}}
    <div class="relative flex-1 flex items-center justify-center px-2 md:px-16 min-h-0" @click.self="close()">
        <template x-if="current">
            <img :src="current.url" :alt="current.title || 'Foto'" class="max-h-full max-w-full object-contain select-none" draggable="false">
        </template>

        <template x-if="photos.length > 1">
            <div>
                <button type="button" @click="prev()" class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-white/10 hover:bg-white/20" aria-label="Foto precedente">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" @click="next()" class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 p-3 rounded-full bg-white/10 hover:bg-white/20" aria-label="Foto successiva">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </template>
    </div>

    {{-- Titolo e didascalia --}}
    <div class="px-4 py-4 text-center min-h-[4rem]">
        <template x-if="current && current.title">
            <p class="font-semibold" x-text="current.title"></p>
        </template>
        <template x-if="current && current.caption">
            <p class="text-sm text-white/70 mt-1" x-text="current.caption"></p>
        </template>
    </div>
</div>
