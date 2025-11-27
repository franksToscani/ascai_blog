<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Event;
use App\Models\GalleryPhoto;
use App\Models\ContactMessage;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts_count'    => Post::count(),
            'events_count'   => Event::count(),
            'photos_count'   => GalleryPhoto::count(),
            'messages_count' => ContactMessage::count(),
        ];

        $latestMessages = ContactMessage::latest()->take(5)->get();
        $latestEvents   = Event::latest('starts_at')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestMessages', 'latestEvents'));
    }
}
