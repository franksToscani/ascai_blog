<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::query();

        // Ricerca per titolo o contenuto
        if ($request->filled('search')) {
            // Valida lunghezza search
            $request->validate(['search' => 'string|max:100']);
            
            // Sanitizza input: rimuovi HTML e escape caratteri LIKE
            $search = strip_tags($request->search);
            $search = str_replace(['%', '_'], ['\\%', '\\_'], $search);
            
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filtro intervallo date su created_at
        if ($request->filled('from_date') || $request->filled('to_date')) {
            $request->validate([
                'from_date' => 'nullable|date',
                'to_date'   => 'nullable|date|after_or_equal:from_date',
            ]);
            if ($request->filled('from_date')) {
                $query->whereDate('created_at', '>=', $request->input('from_date'));
            }
            if ($request->filled('to_date')) {
                $query->whereDate('created_at', '<=', $request->input('to_date'));
            }
        }

        // Admin area: show all posts with pagination
        if ($request->routeIs('admin.posts.*')) {
            $posts = $query->with('user')->latest()->paginate(15)->withQueryString();
            return view('admin.posts.index', compact('posts'));
        }

        // Public: only published posts with pagination
        $posts = $query->where('status', 'published')->with('user')->latest()->paginate(15)->withQueryString();

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
            'title'   => 'required|string|max:255',
            'slug'    => 'nullable|string|max:255|unique:posts,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string|min:50',
            'status'  => 'required|in:draft,published',
        ]);

        $post = Post::create(array_merge($validated, [
            'user_id' => Auth::id(),
        ]));

        Log::info('Post created', [
            'post_id' => $post->id,
            'title' => $post->title,
            'user_id' => Auth::id(),
            'status' => $post->status,
        ]);

        // Clear homepage cache
        Cache::forget('home.latest_posts');

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
            'title'   => 'required|string|max:255',
            'slug'    => 'nullable|string|max:255|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string|min:50',
            'status'  => 'required|in:draft,published',
        ]);

        $post->update($validated);

        Log::info('Post updated', [
            'post_id' => $post->id,
            'title' => $post->title,
            'user_id' => Auth::id(),
        ]);

        // Clear homepage cache
        Cache::forget('home.latest_posts');

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $postId = $post->id;
        $postTitle = $post->title;
        
        $post->delete();

        Log::warning('Post deleted', [
            'post_id' => $postId,
            'title' => $postTitle,
            'user_id' => Auth::id(),
        ]);

        // Clear homepage cache
        Cache::forget('home.latest_posts');

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post eliminato con successo!');
    }
}
