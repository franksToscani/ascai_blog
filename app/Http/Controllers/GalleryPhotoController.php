<?php

namespace App\Http\Controllers;

use App\Models\GalleryPhoto;
use Illuminate\Http\Request;

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
            ->get();

        return view('gallery.index', compact('photos'));
    }


       // Lista "admin" delle foto
    public function adminIndex()
    {
        $photos = GalleryPhoto::orderByDesc('created_at')->get();

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
            'image'      => 'required|image|max:4096', // max 4MB
            'title'      => 'nullable|max:255',
            'caption'    => 'nullable|max:255',
            'is_visible' => 'nullable|boolean',
        ]);

        // Salva file in storage/app/public/gallery
        $path = $request->file('image')->store('gallery', 'public');

        GalleryPhoto::create([
            'title'        => $validated['title'] ?? null,
            'caption'      => $validated['caption'] ?? null,
            'image_path'   => $path,
            'published_at' => now(),
            'is_visible'   => $request->has('is_visible'),
        ]);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryPhoto $galleryPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryPhoto $galleryPhoto)
    {
        //
    }
}
