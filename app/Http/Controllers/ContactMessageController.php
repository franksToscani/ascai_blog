<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    // Salva i messaggi dal form contatti
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email',
            'subject' => 'nullable|max:255',
            'message' => 'required|min:5',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Messaggio inviato con successo!');
    }

    // Lista messaggi (admin)
    public function index()
    {
        $messages = ContactMessage::latest()->get();

        return view('admin.contact-messages.index', compact('messages'));
    }

    // Dettaglio singolo messaggio (admin)
    public function show(ContactMessage $contact_message)
    {
        return view('admin.contact-messages.show', [
            'msg' => $contact_message
        ]);
    }
}
