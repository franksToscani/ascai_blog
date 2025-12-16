@extends('layouts.app')

@section('title', 'Messaggio di ' . $msg->name)

@section('content')
    <a href="{{ route('admin.messages.index') }}" class="text-sm text-sky-700 hover:underline mt-12 md:mt-16 inline-block">← Torna indietro</a>

    <div class="bg-white p-6 rounded-xl shadow-sm mt-4">
        <h1 class="text-xl font-bold mb-2">{{ $msg->subject }}</h1>

        <p class="text-sm text-slate-500 mb-4">
            Da: <strong>{{ $msg->name }}</strong> ({{ $msg->email }})<br>
            Inviato il {{ $msg->created_at->format('d/m/Y H:i') }}
        </p>

        <p class="text-slate-800 whitespace-pre-line">
            {{ $msg->message }}
        </p>
    </div>
@endsection
