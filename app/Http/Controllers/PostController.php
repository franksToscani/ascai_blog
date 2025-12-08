<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Admin area: show all posts with pagination
        if ($request->routeIs('admin.posts.*')) {
            $posts = Post::latest()->paginate(15);
            return view('admin.posts.index', compact('posts'));
        }

        // Public: only published posts with pagination
        $posts = Post::where('status', 'published')->latest()->paginate(15);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'status'  => 'required|in:draft,published',
        ]);

        Post::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Public: only show published posts
        abort_unless($post->status === 'published', 404);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'status'  => 'required|in:draft,published',
        ]);

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post eliminato con successo!');
    }
}
