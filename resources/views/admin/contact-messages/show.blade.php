@extends('layouts.app')

@section('title', 'Messaggio di ' . $msg->name)

@section('content')
    <a href="{{ route('admin.messages.index') }}" class="text-sm text-sky-700 hover:underline mt-12 md:mt-16 inline-block">← Torna ai messaggi</a>

    <div class="bg-white p-6 rounded-xl shadow-sm mt-4">
        <h1 class="text-xl font-bold mb-2">{{ $msg->subject }}</h1>

        <p class="text-sm text-slate-500 mb-4">
            Da: <strong>{{ $msg->name }}</strong> ({{ $msg->email }})<br>
            Inviato il {{ $msg->created_at->format('d/m/Y H:i') }}
        </p>

        <p class="text-slate-800 whitespace-pre-line">{{ $msg->message }}</p>

        <div class="flex flex-wrap items-center gap-3 mt-6 pt-4 border-t border-slate-100">
            <a href="mailto:{{ $msg->email }}?subject={{ rawurlencode('Re: ' . $msg->subject) }}"
               class="text-sm bg-sky-700 text-white px-4 py-2 rounded hover:bg-sky-800">
                Rispondi via email
            </a>

            <form method="POST" action="{{ route('admin.messages.unread', $msg) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="text-sm border border-slate-300 text-slate-700 px-4 py-2 rounded hover:bg-slate-50">
                    Segna come non letto
                </button>
            </form>

            <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" class="ml-auto"
                  onsubmit="return confirm('Eliminare definitivamente questo messaggio?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-red-600 hover:text-red-800 hover:underline">
                    Elimina
                </button>
            </form>
        </div>
    </div>
@endsection
