@extends('layouts.app')

@section('title', 'Staff')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-4 mt-12 md:mt-16">
        <h1 class="text-2xl font-bold">Staff</h1>
        <a href="{{ route('staff-ascaibo') }}" target="_blank" class="text-sm text-sky-700 hover:underline">Vedi la pagina sul sito →</a>
    </div>

    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">{{ session('success') }}</div>
    @endif

    @foreach ($groups as $group => $data)
        <section class="mb-8">
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-lg font-semibold">{{ $data['label'] }}</h2>
                <a href="{{ route('admin.staff.create', ['gruppo' => $group]) }}" class="text-sm bg-sky-700 text-white px-3 py-1 rounded hover:bg-sky-800">+ Aggiungi</a>
            </div>

            @if ($data['members']->isEmpty())
                <p class="text-sm text-slate-500">Nessuno in questo gruppo.</p>
            @else
                <div class="bg-white rounded-xl shadow-sm divide-y divide-slate-100">
                    @foreach ($data['members'] as $member)
                        <div class="p-3 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden flex-shrink-0">
                                @if ($member->photo_url)
                                    <img src="{{ $member->photo_url }}" alt="" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-800 truncate">
                                    {{ $member->role }}@if ($member->name) · <span class="font-normal">{{ $member->name }}</span>@endif
                                </p>
                                @if ($member->description)
                                    <p class="text-xs text-slate-500 truncate">{{ $member->description }}</p>
                                @endif
                            </div>
                            <div class="flex items-center gap-1 text-xs">
                                @foreach (['up' => '↑', 'down' => '↓'] as $direction => $arrow)
                                    <form method="POST" action="{{ route('admin.staff.move', $member) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="direction" value="{{ $direction }}">
                                        <button type="submit" class="px-2 py-1 bg-slate-100 rounded hover:bg-slate-200 disabled:opacity-30"
                                                title="{{ $direction === 'up' ? 'Sposta su' : 'Sposta giù' }}"
                                                @disabled(($direction === 'up' && $loop->parent->first) || ($direction === 'down' && $loop->parent->last))>{{ $arrow }}</button>
                                    </form>
                                @endforeach
                                <a href="{{ route('admin.staff.edit', $member) }}" class="px-2 py-1 bg-sky-100 text-sky-700 rounded hover:bg-sky-200">Modifica</a>
                                <form method="POST" action="{{ route('admin.staff.destroy', $member) }}"
                                      onsubmit="return confirm('Rimuovere questa persona dallo staff?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-rose-100 text-rose-700 rounded hover:bg-rose-200">Rimuovi</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    @endforeach
@endsection
