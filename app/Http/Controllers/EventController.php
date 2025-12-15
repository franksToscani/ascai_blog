<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    // Lista eventi pubblici
    public function index(Request $request)
    {
        if ($request->routeIs('admin.events.*')) {
            $query = Event::query();

            // Ricerca per titolo
            if ($request->filled('search')) {
                // Valida lunghezza search
                $request->validate(['search' => 'string|max:100']);
                
                // Sanitizza input: rimuovi HTML e escape caratteri LIKE
                $search = strip_tags($request->search);
                $search = str_replace(['%', '_'], ['\\%', '\\_'], $search);
                
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            }

            // Filtro intervallo date (starts_at)
            if ($request->filled('from_date') || $request->filled('to_date')) {
                $request->validate([
                    'from_date' => 'nullable|date',
                    'to_date'   => 'nullable|date|after_or_equal:from_date',
                ]);
                if ($request->filled('from_date')) {
                    $query->whereDate('starts_at', '>=', $request->input('from_date'));
                }
                if ($request->filled('to_date')) {
                    $query->whereDate('starts_at', '<=', $request->input('to_date'));
                }
            }

            // Filtro location
            if ($request->filled('location')) {
                $request->validate(['location' => 'string|max:100']);
                $loc = strip_tags($request->location);
                $loc = str_replace(['%', '_'], ['\\%', '\\_'], $loc);
                $query->where('location', 'like', "%{$loc}%");
            }

            $events = $query->orderByDesc('starts_at')->paginate(15)->withQueryString();

            return view('admin.events.index', compact('events'));
        }

        // Ricerca per titolo su eventi pubblici
        $upcomingQuery = Event::where('is_public', true)
            ->where('status', 'published')
            ->where('starts_at', '>=', now());

        if ($request->filled('search')) {
            // Valida lunghezza search
            $request->validate(['search' => 'string|max:100']);
            
            // Sanitizza input: rimuovi HTML e escape caratteri LIKE
            $search = strip_tags($request->search);
            $search = str_replace(['%', '_'], ['\\%', '\\_'], $search);
            
            $upcomingQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filtro intervallo date pubblici (opzionale)
        if ($request->filled('from_date') || $request->filled('to_date')) {
            $request->validate([
                'from_date' => 'nullable|date',
                'to_date'   => 'nullable|date|after_or_equal:from_date',
            ]);
            if ($request->filled('from_date')) {
                $upcomingQuery->whereDate('starts_at', '>=', $request->input('from_date'));
            }
            if ($request->filled('to_date')) {
                $upcomingQuery->whereDate('starts_at', '<=', $request->input('to_date'));
            }
        }

        // Filtro location pubblici
        if ($request->filled('location')) {
            $request->validate(['location' => 'string|max:100']);
            $loc = strip_tags($request->location);
            $loc = str_replace(['%', '_'], ['\\%', '\\_'], $loc);
            $upcomingQuery->where('location', 'like', "%{$loc}%");
        }

        $upcomingEvents = $upcomingQuery->orderBy('starts_at')
            ->paginate(15, ['*'], 'upcoming')
            ->withQueryString();

        $pastQuery = Event::where('is_public', true)
            ->where('status', 'published')
            ->where('starts_at', '<', now());

        if ($request->filled('search')) {
            // Valida lunghezza search
            $request->validate(['search' => 'string|max:100']);
            
            // Sanitizza input: rimuovi HTML e escape caratteri LIKE
            $search = strip_tags($request->search);
            $search = str_replace(['%', '_'], ['\\%', '\\_'], $search);
            
            $pastQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filtro intervallo date passati
        if ($request->filled('from_date') || $request->filled('to_date')) {
            // stessa validazione già eseguita: ripetiamo per chiarezza
            $request->validate([
                'from_date' => 'nullable|date',
                'to_date'   => 'nullable|date|after_or_equal:from_date',
            ]);
            if ($request->filled('from_date')) {
                $pastQuery->whereDate('starts_at', '>=', $request->input('from_date'));
            }
            if ($request->filled('to_date')) {
                $pastQuery->whereDate('starts_at', '<=', $request->input('to_date'));
            }
        }

        // Filtro location passati
        if ($request->filled('location')) {
            $request->validate(['location' => 'string|max:100']);
            $loc = strip_tags($request->location);
            $loc = str_replace(['%', '_'], ['\\%', '\\_'], $loc);
            $pastQuery->where('location', 'like', "%{$loc}%");
        }

        $pastEvents = $pastQuery->orderByDesc('starts_at')
            ->paginate(10, ['*'], 'past')
            ->withQueryString();

        return view('events.index', compact('upcomingEvents', 'pastEvents'));
    }

    // Form creazione evento (per ora "admin manuale")
    public function create()
    {
        return view('events.create');
    }

    // Salva nuovo evento
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:events,slug',
            'description' => 'required|string|min:20',
            'starts_at'   => 'required|date|after_or_equal:today',
            'ends_at'     => 'nullable|date|after_or_equal:starts_at',
            'location'    => 'nullable|string|max:255',
            'is_public'   => 'nullable|boolean',
            'status'      => 'required|in:draft,published',
        ]);

        $validated['is_public'] = $request->has('is_public');

        $event = Event::create(array_merge($validated, [
            'user_id' => Auth::id(),
        ]));

        Log::info('Event created', [
            'event_id' => $event->id,
            'title' => $event->title,
            'user_id' => Auth::id(),
            'starts_at' => $event->starts_at,
        ]);

        // Clear homepage cache
        Cache::forget('home.upcoming_events');

        $redirectRoute = $request->routeIs('admin.events.*') ? 'admin.events.index' : 'eventi.index';

        return redirect()->route($redirectRoute)
            ->with('success', 'Evento creato con successo!');
    }

    // Dettaglio evento
    public function show(Event $event)
    {
        abort_unless($event->is_public && $event->status === 'published', 404);

        return view('events.show', compact('event'));
    }

    // Questi li useremo nella futura area admin
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:events,slug,' . $event->id,
            'description' => 'required|string|min:20',
            'starts_at'   => 'required|date',
            'ends_at'     => 'nullable|date|after_or_equal:starts_at',
            'location'    => 'nullable|string|max:255',
            'is_public'   => 'nullable|boolean',
            'status'      => 'required|in:draft,published',
        ]);

        $validated['is_public'] = $request->has('is_public');

        $event->update($validated);

        Log::info('Event updated', [
            'event_id' => $event->id,
            'title' => $event->title,
            'user_id' => Auth::id(),
        ]);

        // Clear homepage cache
        Cache::forget('home.upcoming_events');

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento aggiornato con successo!');
    }

    public function destroy(Event $event)
    {
        $eventId = $event->id;
        $eventTitle = $event->title;
        
        $event->delete();

        Log::warning('Event deleted', [
            'event_id' => $eventId,
            'title' => $eventTitle,
            'user_id' => Auth::id(),
        ]);

        // Clear homepage cache
        Cache::forget('home.upcoming_events');

        return redirect()->route('admin.events.index')
            ->with('success', 'Evento eliminato con successo!');
    }
}
