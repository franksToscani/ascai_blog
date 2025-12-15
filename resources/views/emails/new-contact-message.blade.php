<x-mail::message>
# Nuovo messaggio ricevuto

<strong>Da:</strong> {{ $message->name }}  
<strong>Email:</strong> {{ $message->email }}  
<strong>Oggetto:</strong> {{ $message->subject ?? '(Nessun oggetto)' }}  
<strong>Data:</strong> {{ $message->created_at->format('d/m/Y H:i') }}

---

## Messaggio:

{{ $message->message }}

---

<x-mail::button :url="route('admin.messages.show', $message)">
Vedi nel pannello admin
</x-mail::button>

Grazie,  
ASCAI Bologna
</x-mail::message>
