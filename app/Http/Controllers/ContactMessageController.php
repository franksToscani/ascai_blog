<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\User;
use App\Mail\NewContactMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    // Salva i messaggi dal form contatti con rate limiting
    public function store(Request $request)
    {
        // Rate limiting: max 5 messaggi per IP ogni 24 ore
        $ip = $request->ip();
        $key = 'contact_form_' . $ip;
        $limit = 5;
        $window = 86400; // 24 ore in secondi

        // Incrementa il contatore
        $count = Cache::get($key, 0);

        if ($count >= $limit) {
            return back()
                ->with('error', 'Hai raggiunto il limite massimo di messaggi (5) nelle ultime 24 ore. Riprova più tardi.')
                ->withInput();
        }

        // Valida il form
        $validated = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email',
            'subject' => 'nullable|max:255',
            'message' => 'required|min:5',
        ]);

        // Salva il messaggio
        $contactMessage = ContactMessage::create($validated);

        // Invia email agli admin
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new NewContactMessageNotification($contactMessage));
        }

        // Incrementa il contatore
        Cache::put($key, $count + 1, $window);

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
