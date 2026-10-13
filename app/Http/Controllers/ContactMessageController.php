<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\User;
use App\Mail\NewContactMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;

class ContactMessageController extends Controller
{
    // Salva i messaggi dal form contatti con rate limiting
    public function store(Request $request)
    {
        // Valida il form (gli errori di compilazione non consumano il limite)
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:5000',
        ]);

        // Rate limiting: max 5 messaggi per IP ogni 24 ore
        $ip = $request->ip();
        $key = 'contact_form:' . $ip;

        if (RateLimiter::tooManyAttempts($key, 5)) {
            Log::warning('Contact form rate limit exceeded', ['ip' => $ip]);

            return back()
                ->with('error', 'Hai raggiunto il limite massimo di messaggi (5) nelle ultime 24 ore. Riprova più tardi.')
                ->withInput();
        }

        RateLimiter::hit($key, 86400); // 24 ore in secondi

        // Il messaggio viene sempre salvato: resta leggibile nel pannello admin
        $contactMessage = ContactMessage::create($validated);

        Log::info('Contact message received', [
            'message_id' => $contactMessage->id,
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'ip' => $ip,
        ]);

        // Notifica gli admin; se l'SMTP non risponde l'utente non vede errori
        $admins = User::where('is_admin', true)->pluck('email');

        foreach ($admins as $adminEmail) {
            try {
                Mail::to($adminEmail)->send(new NewContactMessageNotification($contactMessage));
            } catch (\Throwable $e) {
                Log::error('Contact notification email failed', [
                    'message_id' => $contactMessage->id,
                    'admin' => $adminEmail,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return back()->with('success', 'Messaggio inviato con successo!');
    }

    // Lista messaggi (admin), con filtro "solo non letti"
    public function index(Request $request)
    {
        $onlyUnread = $request->query('filtro') === 'non-letti';

        $messages = ContactMessage::query()
            ->when($onlyUnread, fn ($query) => $query->unread())
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $unreadCount = ContactMessage::unread()->count();

        return view('admin.contact-messages.index', compact('messages', 'unreadCount', 'onlyUnread'));
    }

    // Dettaglio singolo messaggio (admin): aprirlo lo segna come letto
    public function show(ContactMessage $contact_message)
    {
        if (! $contact_message->isRead()) {
            $contact_message->forceFill(['read_at' => now()])->save();
        }

        return view('admin.contact-messages.show', [
            'msg' => $contact_message
        ]);
    }

    // Rimette il messaggio tra i non letti (es. per ricordarsi di rispondere)
    public function markUnread(ContactMessage $contact_message)
    {
        $contact_message->forceFill(['read_at' => null])->save();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Messaggio segnato come non letto.');
    }

    // Eliminazione definitiva: sono dati personali, non vanno tenuti più del necessario
    public function destroy(ContactMessage $contact_message)
    {
        Log::warning('Contact message deleted', [
            'message_id' => $contact_message->id,
            'user_id' => Auth::id(),
        ]);

        $contact_message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Messaggio eliminato.');
    }
}
