<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Event;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::withCount('photos')
            ->with('event:id,title')
            ->orderByDesc('date')
            ->orderByDesc('created_at')
            ->paginate(20);

        $photosWithoutAlbum = GalleryPhoto::whereNull('album_id')->count();

        return view('admin.albums.index', compact('albums', 'photosWithoutAlbum'));
    }

    public function create()
    {
        return view('admin.albums.form', ['album' => new Album(['is_visible' => true]), 'events' => $this->events()]);
    }

    public function store(Request $request)
    {
        $album = Album::create($this->validated($request) + ['user_id' => Auth::id()]);

        // Appena creato l'album si passa direttamente al caricamento delle foto
        return redirect()->route('admin.gallery.create', ['album' => $album->id])
            ->with('success', 'Album "' . $album->title . '" creato: ora carica le foto.');
    }

    public function edit(Album $album)
    {
        return view('admin.albums.form', ['album' => $album, 'events' => $this->events()]);
    }

    public function update(Request $request, Album $album)
    {
        $album->update($this->validated($request));
        Cache::forget('home.gallery_photos_preview');

        return redirect()->route('admin.albums.index')->with('success', 'Album aggiornato.');
    }

    // Le foto non vengono eliminate: restano nella galleria "senza album"
    public function destroy(Album $album)
    {
        $album->delete();
        Cache::forget('home.gallery_photos_preview');

        return redirect()->route('admin.albums.index')
            ->with('success', 'Album eliminato. Le sue foto restano nella galleria, senza album.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'date' => 'nullable|date',
            'event_id' => 'nullable|integer|exists:events,id',
        ]);

        $data['is_visible'] = $request->boolean('is_visible');

        return $data;
    }

    private function events()
    {
        return Event::orderByDesc('starts_at')->get(['id', 'title', 'starts_at']);
    }
}
