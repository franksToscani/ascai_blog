<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;
use Illuminate\Http\Request;

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

    return view('pages.home', compact('latestPosts', 'upcomingEvents'));
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
