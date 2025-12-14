<?php

namespace App\Http\Controllers;

use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GalleryPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     // Pagina pubblica galleria
    public function index()
    {
        $photos = GalleryPhoto::where('is_visible', true)
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('gallery.index', compact('photos'));
    }


       // Lista "admin" delle foto
    public function adminIndex()
    {
        $photos = GalleryPhoto::with('user')->orderByDesc('created_at')->paginate(12);

        return view('admin.gallery.index', compact('photos'));
    }

     // Form upload foto
    public function create()
    {
        return view('admin.gallery.create');
    }

   // Salvataggio foto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image'      => [
                'required',
                'image',
                'mimes:jpeg,jpg,png,webp',
                'max:2048', // max 2MB
                'dimensions:max_width=2000,max_height=2000'
            ],
            'title'      => 'nullable|string|max:255',
            'caption'    => 'nullable|string|max:500',
            'is_visible' => 'nullable|boolean',
        ]);

        // Salva file in storage/app/public/gallery
        $path = $request->file('image')->store('gallery', 'public');

        $photo = GalleryPhoto::create([
            'title'        => $validated['title'] ?? null,
            'caption'      => $validated['caption'] ?? null,
            'image_path'   => $path,
            'published_at' => now(),
            'is_visible'   => $request->has('is_visible'),
            'user_id'      => Auth::id(),
        ]);

        Log::info('Gallery photo uploaded', [
            'photo_id' => $photo->id,
            'image_path' => $path,
            'user_id' => Auth::id(),
        ]);

        // Clear homepage cache
        Cache::forget('home.gallery_photos');

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto aggiunta alla galleria!');
    }

    /**
     * Display the specified resource.
     */
    public function show(GalleryPhoto $galleryPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalleryPhoto $galleryPhoto)
    {
        return view('admin.gallery.edit', compact('galleryPhoto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryPhoto $galleryPhoto)
    {
        $validated = $request->validate([
            'image'      => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,webp',
                'max:2048', // max 2MB
                'dimensions:max_width=2000,max_height=2000'
            ],
            'title'      => 'nullable|string|max:255',
            'caption'    => 'nullable|string|max:500',
            'is_visible' => 'nullable|boolean',
        ]);

        // Se caricata nuova immagine, elimina la vecchia e salva la nuova
        if ($request->file('image')) {
            Storage::disk('public')->delete($galleryPhoto->image_path);
            $path = $request->file('image')->store('gallery', 'public');
            $galleryPhoto->image_path = $path;
        }

        $galleryPhoto->update([
            'title'      => $validated['title'] ?? $galleryPhoto->title,
            'caption'    => $validated['caption'] ?? $galleryPhoto->caption,
            'is_visible' => $request->has('is_visible'),
        ]);

        Log::info('Gallery photo updated', [
            'photo_id' => $galleryPhoto->id,
            'user_id' => Auth::id(),
        ]);

        // Clear homepage cache
        Cache::forget('home.gallery_photos');

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto aggiornata con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryPhoto $galleryPhoto)
    {
        $photoId = $galleryPhoto->id;
        $imagePath = $galleryPhoto->image_path;
        
        // Elimina file di storage
        Storage::disk('public')->delete($imagePath);
        
        $galleryPhoto->delete();

        Log::warning('Gallery photo deleted', [
            'photo_id' => $photoId,
            'image_path' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        // Clear homepage cache
        Cache::forget('home.gallery_photos');

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto eliminata dalla galleria!');
    }
}
