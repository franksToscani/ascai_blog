{{-- Griglia di miniature quadrate: un clic apre il visualizzatore (serve x-data="lightbox(...)" sul contenitore) --}}
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-3">
    @foreach ($photos as $photo)
        <div class="group relative aspect-square rounded-lg overflow-hidden bg-slate-100">
            <button type="button" @click="open({{ $loop->index }})" class="block w-full h-full"
                    aria-label="Apri {{ $photo->title ?: 'foto ' . $loop->iteration }}">
                <img src="{{ $photo->thumb_url }}" alt="{{ $photo->title ?? 'Foto galleria' }}" loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            </button>

            @auth
                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin.gallery.edit', $photo) }}"
                       class="absolute top-2 right-2 p-1.5 bg-white/90 hover:bg-white text-sky-700 rounded-md shadow opacity-0 group-hover:opacity-100 focus:opacity-100 transition"
                       title="Modifica foto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </a>
                @endif
            @endauth
        </div>
    @endforeach
</div>
