<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\GalleryPhoto;


class PageController extends Controller
{
    public function home()
{
    $latestPosts = Post::latest()->take(3)->get();

    $upcomingEvents = Event::where('is_public', true)
        ->where('starts_at', '>=', now())
        ->orderBy('starts_at')
        ->take(3)
        ->get();

    $galleryPhotos = GalleryPhoto::where('is_visible', true)
        ->orderByDesc('published_at')
        ->orderByDesc('created_at')
        ->take(8)
        ->get();

    return view('pages.home', compact('latestPosts', 'upcomingEvents', 'galleryPhotos'));
}


    public function chiSiamo()
    {
        return view('pages.chi-siamo');
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
