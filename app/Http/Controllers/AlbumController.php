<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumController extends Controller
{
    // Pagina pubblica di un album
    public function show(Album $album)
    {
        abort_unless($album->is_visible, 404);

        $photos = $album->visiblePhotos()->get();
        abort_if($photos->isEmpty(), 404);

        $album->load(['event' => fn ($event) => $event->where('is_public', true)->where('status', 'published')]);

        return view('gallery.album', compact('album', 'photos'));
    }
}
