<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\GalleryPhoto;
use App\Services\ImageResizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GalleryPhotoController extends Controller
{
    // Pagina pubblica galleria: album + foto non assegnate a nessun album
    public function index()
    {
        $albums = Album::published()
            ->withCount(['photos as visible_photos_count' => fn ($photos) => $photos->where('is_visible', true)])
            ->with(['photos' => fn ($photos) => $photos->where('is_visible', true)->orderBy('published_at')->orderBy('id')->limit(1)])
            ->orderByDesc('date')
            ->orderByDesc('created_at')
            ->get();

        $photos = GalleryPhoto::where('is_visible', true)
            ->whereNull('album_id')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(24);

        return view('gallery.index', compact('albums', 'photos'));
    }

    // Lista "admin" delle foto, filtrabile per album
    public function adminIndex(Request $request)
    {
        $albumFilter = $request->query('album');

        $photos = GalleryPhoto::with(['user', 'album'])
            ->when($albumFilter === 'nessuno', fn ($query) => $query->whereNull('album_id'))
            ->when(is_numeric($albumFilter), fn ($query) => $query->where('album_id', $albumFilter))
            ->orderByDesc('created_at')
            ->paginate(24)
            ->withQueryString();

        $albums = Album::orderByDesc('date')->orderByDesc('created_at')->get(['id', 'title']);

        return view('admin.gallery.index', compact('photos', 'albums', 'albumFilter'));
    }

    // Form upload foto (una o più)
    public function create(Request $request)
    {
        $albums = Album::orderByDesc('date')->orderByDesc('created_at')->get(['id', 'title']);
        $selectedAlbum = $request->query('album');

        return view('admin.gallery.create', compact('albums', 'selectedAlbum'));
    }

    // Salvataggio di una foto. L'uploader multiplo chiama questa azione una volta per file.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image'      => ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:10240'], // max 10MB: ridimensionata a 2000px
            'title'      => 'nullable|string|max:255',
            'caption'    => 'nullable|string|max:500',
            'is_visible' => 'nullable|boolean',
            'album_id'   => 'nullable|integer|exists:albums,id',
        ]);

        $path = ImageResizer::store($request->file('image'), 'gallery');

        $photo = GalleryPhoto::create([
            'title'        => $validated['title'] ?? null,
            'caption'      => $validated['caption'] ?? null,
            'image_path'   => $path,
            'thumb_path'   => ImageResizer::storeThumbnail($path, 'gallery/thumbs'),
            'published_at' => now(),
            'is_visible'   => $request->boolean('is_visible'),
            'album_id'     => $validated['album_id'] ?? null,
            'user_id'      => Auth::id(),
        ]);

        Log::info('Gallery photo uploaded', [
            'photo_id' => $photo->id,
            'image_path' => $path,
            'album_id' => $photo->album_id,
            'user_id' => Auth::id(),
        ]);

        Cache::forget('home.gallery_photos_preview');

        if ($request->expectsJson()) {
            return response()->json(['id' => $photo->id, 'thumb_url' => $photo->thumb_url], 201);
        }

        return redirect()->route('admin.gallery.index', $photo->album_id ? ['album' => $photo->album_id] : [])
            ->with('success', 'Foto aggiunta alla galleria!');
    }

    // Form modifica foto
    public function edit(GalleryPhoto $galleryPhoto)
    {
        $albums = Album::orderByDesc('date')->orderByDesc('created_at')->get(['id', 'title']);

        return view('admin.gallery.edit', compact('galleryPhoto', 'albums'));
    }

    // Aggiornamento foto
    public function update(Request $request, GalleryPhoto $galleryPhoto)
    {
        $validated = $request->validate([
            'image'      => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:10240'],
            'title'      => 'nullable|string|max:255',
            'caption'    => 'nullable|string|max:500',
            'is_visible' => 'nullable|boolean',
            'album_id'   => 'nullable|integer|exists:albums,id',
        ]);

        // Se caricata nuova immagine, elimina la vecchia (e la sua miniatura) e salva la nuova
        if ($request->file('image')) {
            Storage::disk('public')->delete(array_filter([$galleryPhoto->image_path, $galleryPhoto->thumb_path]));
            $galleryPhoto->image_path = ImageResizer::store($request->file('image'), 'gallery');
            $galleryPhoto->thumb_path = ImageResizer::storeThumbnail($galleryPhoto->image_path, 'gallery/thumbs');
        }

        $galleryPhoto->update([
            'title'      => $validated['title'] ?? null,
            'caption'    => $validated['caption'] ?? null,
            'is_visible' => $request->boolean('is_visible'),
            'album_id'   => $validated['album_id'] ?? null,
        ]);

        Log::info('Gallery photo updated', [
            'photo_id' => $galleryPhoto->id,
            'user_id' => Auth::id(),
        ]);

        Cache::forget('home.gallery_photos_preview');

        return redirect()->route('admin.gallery.index', $galleryPhoto->album_id ? ['album' => $galleryPhoto->album_id] : [])
            ->with('success', 'Foto aggiornata con successo!');
    }

    // Eliminazione foto (con file e miniatura)
    public function destroy(GalleryPhoto $galleryPhoto)
    {
        $photoId = $galleryPhoto->id;
        $imagePath = $galleryPhoto->image_path;

        Storage::disk('public')->delete(array_filter([$imagePath, $galleryPhoto->thumb_path]));

        $galleryPhoto->delete();

        Log::warning('Gallery photo deleted', [
            'photo_id' => $photoId,
            'image_path' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        Cache::forget('home.gallery_photos_preview');

        return back()->with('success', 'Foto eliminata dalla galleria!');
    }
}
