{{-- Card di una news (home e pagina News). Parametro: $post --}}
<article class="group relative flex flex-col bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
    {{-- Copertina, oppure il logo su sfondo grigio chiaro se la news non ne ha una --}}
    <div class="aspect-[16/9] overflow-hidden bg-slate-100">
        @if ($post->cover_image)
            <img src="{{ asset('storage/' . ltrim($post->cover_image, '/')) }}" alt="" loading="lazy"
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <span class="flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-sm">
                    <img src="{{ asset('images/logo-256.png') }}" alt="" class="h-16 w-16">
                </span>
            </div>
        @endif
    </div>

    <div class="flex flex-col flex-1 p-6">
        <time datetime="{{ $post->created_at->toDateString() }}" class="text-xs font-semibold uppercase tracking-wide text-camerun-green">
            {{ $post->created_at->translatedFormat('j F Y') }}
        </time>
        <h3 class="mt-2 font-bold text-lg leading-snug text-slate-900 line-clamp-2 group-hover:text-sky-700 transition-colors">
            {{-- Il link copre tutta la card --}}
            <a href="{{ route('posts.show', $post) }}" class="after:absolute after:inset-0">{{ $post->title }}</a>
        </h3>
        <p class="mt-3 text-sm text-slate-600 leading-relaxed line-clamp-3">
            {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 140) }}
        </p>
        <div class="mt-auto pt-4 flex items-center justify-between">
            <span class="inline-flex items-center gap-1 text-sm text-sky-700 font-semibold group-hover:gap-2 transition-all">
                Leggi tutto
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </span>
            @include('partials.admin-actions', [
                'editUrl' => route('admin.posts.edit', $post),
                'deleteUrl' => route('admin.posts.destroy', $post),
                'confirm' => 'Eliminare questa news?',
            ])
        </div>
    </div>
</article>
