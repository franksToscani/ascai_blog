<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\GalleryPhoto;
use Illuminate\Support\Facades\Cache;
//ho messo il nome del controller con la lettera maiuscola per convenzione

class PageController extends Controller
{
    public function home()
{
    // Cache homepage data for 1 hour
    $latestPosts = Cache::remember('home.latest_posts', 3600, function () {
        return Post::where('status', 'published')->latest()->take(3)->get();
    });

    $upcomingEvents = Cache::remember('home.upcoming_events', 3600, function () {
        return Event::where('is_public', true)
            ->where('status', 'published')
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at')
            ->take(3)
            ->get();
    });

    // Preview: show only the latest 4 photos on home
    $galleryPhotos = Cache::remember('home.gallery_photos_preview', 3600, function () {
        return GalleryPhoto::where('is_visible', true)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->take(4)
            ->get();
    });

    return view('pages.home', compact('latestPosts', 'upcomingEvents', 'galleryPhotos'));
}


    public function chiSiamo()
    {
        return view('pages.chi-siamo');
    }

    public function statuto()
    {
        return view('pages.statuto');
    }

    public function staff()
    {
        return view('pages.staff');
    }

    public function bilancio()
    {
        return view('pages.bilancio');
    }

    public function eventi()
    {
        return view('pages.eventi');
    }

    public function contatti()
    {
        return view('pages.contatti');
    }

    public function associati()
    {
        return view('pages.associati');
    }
}
