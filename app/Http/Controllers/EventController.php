<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Lista eventi pubblici
    public function index()
    {
        $upcomingEvents = Event::where('is_public', true)
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at')
            ->get();

        $pastEvents = Event::where('is_public', true)
            ->where('starts_at', '<', now())
            ->orderByDesc('starts_at')
            ->take(10)
            ->get();

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
            'title'       => 'required|max:255',
            'description' => 'required',
            'starts_at'   => 'required|date',
            'ends_at'     => 'nullable|date|after_or_equal:starts_at',
            'location'    => 'nullable|max:255',
            'is_public'   => 'nullable|boolean',
        ]);

        $validated['is_public'] = $request->has('is_public');

        Event::create($validated);

        return redirect()->route('eventi.index')
            ->with('success', 'Evento creato con successo!');
    }

    // Dettaglio evento
    public function show(Event $event)
    {
        abort_unless($event->is_public, 404);

        return view('events.show', compact('event'));
    }

    // Questi li useremo nella futura area admin
    public function edit(Event $event) {}
    public function update(Request $request, Event $event) {}
    public function destroy(Event $event) {}
}
