@extends('layouts.app')

@section('title', 'Messaggi ricevuti')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Messaggi ricevuti</h1>

    @if ($messages->isEmpty())
        <p class="text-slate-600">Nessun messaggio ancora.</p>
    @else
        <div class="space-y-3">
            @foreach ($messages as $msg)
                <div class="bg-white p-4 rounded shadow-sm">
                    <h3 class="font-semibold">
                        {{ $msg->name }}
                        <span class="text-xs text-slate-500">({{ $msg->email }})</span>
                    </h3>

                    <p class="text-sm">
                        <strong>{{ $msg->subject }}</strong>
                    </p>

                    <p class="text-xs text-slate-500 mb-2">
                        {{ $msg->created_at->format('d/m/Y H:i') }}
                    </p>

                    <a href="{{ route('admin.messages.show', $msg->id) }}"
                    class="text-sky-700 text-sm hover:underline">
                        Apri messaggio →
                    </a>
                </div>
            @endforeach
        </div>
    @endif
@endsection
