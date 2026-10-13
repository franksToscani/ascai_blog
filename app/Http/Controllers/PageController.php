<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\GalleryPhoto;
use App\Models\Bilancio;
use App\Models\Setting;
use App\Models\StaffMember;
use Illuminate\Support\Facades\Cache;

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
            ->with('album:id,slug,is_visible')
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
        $statutoPdf = Setting::get('statuto_pdf_path');

        return view('pages.statuto', compact('statutoPdf'));
    }

    public function staff()
    {
        $direttivo = StaffMember::inGroup('direttivo')->get();
        $collaboratori = StaffMember::inGroup('collaboratori')->get();

        return view('pages.staff', compact('direttivo', 'collaboratori'));
    }

    public function bilancio()
    {
        $bilanci = Bilancio::orderByDesc('year')->get();
        return view('pages.bilancio', compact('bilanci'));
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
        $iban = Setting::get('payment_iban');

        return view('pages.associati', [
            'formUrl' => Setting::get('membership_form_url'),
            'fee' => Setting::get('membership_fee'),
            'holder' => Setting::get('payment_holder'),
            // IBAN leggibile: gruppi di 4 caratteri
            'iban' => $iban ? trim(chunk_split($iban, 4, ' ')) : null,
            'reason' => Setting::get('payment_reason'),
        ]);
    }
}
