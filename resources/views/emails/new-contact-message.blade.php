<x-mail::message>
# Nuovo messaggio ricevuto

**Da:** {{ $contactMessage->name }}<br>
**Email:** {{ $contactMessage->email }}<br>
**Oggetto:** {{ $contactMessage->subject ?? '(Nessun oggetto)' }}<br>
**Data:** {{ $contactMessage->created_at->format('d/m/Y H:i') }}

---

## Messaggio

<x-mail::panel>
{!! nl2br(e($contactMessage->message)) !!}
</x-mail::panel>

<x-mail::button :url="route('admin.messages.show', $contactMessage)">
Vedi nel pannello admin
</x-mail::button>

Puoi rispondere direttamente a questa email per scrivere a {{ $contactMessage->name }}.

Grazie,<br>
ASCAI Bologna
</x-mail::message>
