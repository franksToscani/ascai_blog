@extends('layouts.app')

@section('title', $member->exists ? 'Modifica staff' : 'Aggiungi allo staff')

@section('content')
    <div class="max-w-2xl mt-12 md:mt-16">
        <a href="{{ route('admin.staff.index') }}" class="text-sm text-sky-700 hover:underline">← Staff</a>
        <h1 class="text-2xl font-bold mt-2 mb-4">{{ $member->exists ? 'Modifica' : 'Aggiungi allo staff' }}</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" enctype="multipart/form-data"
              action="{{ $member->exists ? route('admin.staff.update', $member) : route('admin.staff.store') }}"
              class="bg-white rounded-xl shadow-sm p-6 space-y-4">
            @csrf
            @if ($member->exists)
                @method('PUT')
            @endif

            <div>
                <label for="group" class="block text-sm font-medium mb-1">Gruppo</label>
                <select id="group" name="group" class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                    @foreach (\App\Models\StaffMember::GROUPS as $value => $label)
                        <option value="{{ $value }}" @selected(old('group', $member->group) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label for="role" class="block text-sm font-medium mb-1">Ruolo o nome del comitato</label>
                    <input type="text" id="role" name="role" required maxlength="255" value="{{ old('role', $member->role) }}"
                           placeholder="Es. Presidente, Comitato Culturale" class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium mb-1">Nome e cognome (facoltativo)</label>
                    <input type="text" id="name" name="name" maxlength="255" value="{{ old('name', $member->name) }}"
                           class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium mb-1">Descrizione breve (facoltativa)</label>
                <input type="text" id="description" name="description" maxlength="255" value="{{ old('description', $member->description) }}"
                       placeholder="Es. Gestisce le finanze" class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
            </div>

            <div>
                <label for="photo" class="block text-sm font-medium mb-1">Foto (facoltativa)</label>
                @if ($member->photo_url)
                    <div class="flex items-center gap-3 mb-2">
                        <img src="{{ $member->photo_url }}" alt="" class="w-16 h-16 rounded-full object-cover">
                        <label class="text-sm flex items-center gap-2">
                            <input type="checkbox" name="remove_photo" value="1" class="h-4 w-4"> Rimuovi la foto
                        </label>
                    </div>
                @endif
                <input type="file" id="photo" name="photo" accept="image/jpeg,image/png,image/webp"
                       class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                <p class="text-[11px] text-slate-500 mt-1">Meglio una foto quadrata del viso. Senza foto viene mostrata l'icona.</p>
            </div>

            <button type="submit" class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-sky-800">
                {{ $member->exists ? 'Salva modifiche' : 'Aggiungi' }}
            </button>
        </form>
    </div>
@endsection
