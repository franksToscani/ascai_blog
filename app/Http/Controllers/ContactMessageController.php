<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\User;
use App\Mail\NewContactMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        // Inizializza il contatore con TTL se non esiste
        if (!Cache::has($key)) {
            Cache::put($key, 0, $window);
        }

        // Incrementa atomicamente il contatore
        $count = Cache::increment($key);

        if ($count > $limit) {
            // Supera il limite, rollback e rifiuta
            Cache::decrement($key);
            
            Log::warning('Contact form rate limit exceeded', [
                'ip' => $ip,
                'count' => $count,
            ]);
            
            return back()
                ->with('error', 'Hai raggiunto il limite massimo di messaggi (5) nelle ultime 24 ore. Riprova più tardi.')
                ->withInput();
        }

        // Valida il form
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:5000',
        ]);

        // Salva messaggio e invia email in transazione atomica
        DB::transaction(function () use ($validated, $ip) {
            // Salva il messaggio
            $contactMessage = ContactMessage::create($validated);

            Log::info('Contact message received', [
                'message_id' => $contactMessage->id,
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'ip' => $ip,
            ]);

            // Invia email agli admin in modo asincrono
            $admins = User::where('is_admin', true)->get();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->queue(new NewContactMessageNotification($contactMessage));
            }
        });

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
