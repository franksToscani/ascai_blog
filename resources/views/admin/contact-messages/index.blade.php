@extends('layouts.app')

@section('title', 'Messaggi ricevuti')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-4 mt-12 md:mt-16">
        <h1 class="text-2xl font-bold">
            Messaggi ricevuti
            @if ($unreadCount > 0)
                <span class="ml-2 align-middle text-xs font-semibold bg-orange-500 text-white px-2 py-0.5 rounded-full">
                    {{ $unreadCount }} {{ $unreadCount === 1 ? 'non letto' : 'non letti' }}
                </span>
            @endif
        </h1>

        {{-- Filtro --}}
        <div class="inline-flex rounded-lg border border-slate-200 bg-white p-1 text-sm">
            <a href="{{ route('admin.messages.index') }}"
               class="px-3 py-1 rounded-md {{ $onlyUnread ? 'text-slate-600 hover:text-slate-900' : 'bg-sky-700 text-white' }}">
                Tutti
            </a>
            <a href="{{ route('admin.messages.index', ['filtro' => 'non-letti']) }}"
               class="px-3 py-1 rounded-md {{ $onlyUnread ? 'bg-sky-700 text-white' : 'text-slate-600 hover:text-slate-900' }}">
                Non letti
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($messages->isEmpty())
        <p class="text-slate-600">
            {{ $onlyUnread ? 'Nessun messaggio da leggere.' : 'Nessun messaggio ancora.' }}
        </p>
    @else
        <div class="space-y-3">
            @foreach ($messages as $msg)
                <div class="bg-white p-4 rounded shadow-sm flex items-start gap-4 border-l-4 {{ $msg->isRead() ? 'border-transparent' : 'border-orange-500' }}">
                    <a href="{{ route('admin.messages.show', $msg) }}" class="flex-1 min-w-0 group">
                        <h3 class="{{ $msg->isRead() ? 'font-medium text-slate-700' : 'font-bold text-slate-900' }}">
                            @unless ($msg->isRead())
                                <span class="sr-only">Non letto:</span>
                            @endunless
                            {{ $msg->name }}
                            <span class="text-xs font-normal text-slate-500">({{ $msg->email }})</span>
                        </h3>

                        <p class="text-sm truncate {{ $msg->isRead() ? 'text-slate-600' : 'text-slate-900 font-semibold' }}">
                            {{ $msg->subject ?: '(senza oggetto)' }}
                        </p>

                        <p class="text-sm text-slate-500 truncate">
                            {{ \Illuminate\Support\Str::limit($msg->message, 120) }}
                        </p>

                        <p class="text-xs text-slate-400 mt-1">
                            {{ $msg->created_at->format('d/m/Y H:i') }}
                            <span class="text-sky-700 group-hover:underline ml-2">Apri →</span>
                        </p>
                    </a>

                    <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}"
                          onsubmit="return confirm('Eliminare definitivamente questo messaggio?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-600 hover:text-red-800 hover:underline">
                            Elimina
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    @endif
@endsection
