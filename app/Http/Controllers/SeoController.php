<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    /**
     * Mappa del sito per i motori di ricerca: pagine statiche + news ed eventi pubblicati.
     */
    public function sitemap(): Response
    {
        $staticRoutes = [
            'home' => 'weekly',
            'chi-siamo' => 'monthly',
            'staff-ascaibo' => 'monthly',
            'statuto' => 'yearly',
            'associati' => 'monthly',
            'bilancio' => 'yearly',
            'posts.index' => 'weekly',
            'eventi.index' => 'weekly',
            'galleria' => 'weekly',
            'contatti' => 'yearly',
        ];

        $urls = collect($staticRoutes)->map(fn ($frequency, $route) => [
            'loc' => route($route),
            'lastmod' => null,
            'changefreq' => $frequency,
        ])->values();

        $posts = Post::where('status', 'published')
            ->latest('updated_at')
            ->get(['slug', 'updated_at'])
            ->map(fn (Post $post) => [
                'loc' => route('posts.show', $post),
                'lastmod' => $post->updated_at,
                'changefreq' => 'monthly',
            ]);

        $events = Event::where('is_public', true)
            ->where('status', 'published')
            ->latest('updated_at')
            ->get(['slug', 'updated_at'])
            ->map(fn (Event $event) => [
                'loc' => route('eventi.show', $event),
                'lastmod' => $event->updated_at,
                'changefreq' => 'monthly',
            ]);

        // Dichiarazione XML aggiunta qui e non nel template: "<?" in un file Blade
        // viene letto come tag PHP quando short_open_tag è attivo (default nell'immagine Docker)
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
            . view('seo.sitemap', ['urls' => $urls->concat($posts)->concat($events)])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    /**
     * robots.txt dinamico: punta alla sitemap con il dominio corrente e
     * blocca l'indicizzazione fuori dalla produzione (locale, staging).
     */
    public function robots(): Response
    {
        $lines = app()->environment('production')
            ? [
                'User-agent: *',
                'Disallow: /admin',
                'Disallow: /login',
                'Disallow: /profile',
                'Disallow: /forgot-password',
                'Disallow: /reset-password',
                '',
                'Sitemap: ' . route('sitemap'),
            ]
            : ['User-agent: *', 'Disallow: /'];

        return response(implode("\n", $lines) . "\n", 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }
}
