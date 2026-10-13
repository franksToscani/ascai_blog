@extends('layouts.app')

@section('title', 'Dati associazione')

@section('content')
    <div class="max-w-2xl mt-12 md:mt-16">
        <h1 class="text-2xl font-bold mb-1">Dati associazione</h1>
        <p class="text-sm text-slate-600 mb-4">
            Usati nelle pagine <a href="{{ route('associati') }}" target="_blank" class="text-sky-700 hover:underline">Associati</a>
            e <a href="{{ route('statuto') }}" target="_blank" class="text-sky-700 hover:underline">Statuto</a>.
            I campi lasciati vuoti non vengono mostrati sul sito.
        </p>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data"
              class="bg-white rounded-xl shadow-sm p-6 space-y-6">
            @csrf
            @method('PUT')

            <fieldset class="space-y-4">
                <legend class="font-semibold text-slate-800">Iscrizione</legend>
                <div>
                    <label for="membership_form_url" class="block text-sm font-medium mb-1">Link al modulo di iscrizione online</label>
                    <input type="url" id="membership_form_url" name="membership_form_url" value="{{ old('membership_form_url', $values['membership_form_url']) }}"
                           placeholder="https://docs.google.com/forms/..." class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="membership_fee" class="block text-sm font-medium mb-1">Quota associativa annuale</label>
                    <input type="text" id="membership_fee" name="membership_fee" maxlength="50" value="{{ old('membership_fee', $values['membership_fee']) }}"
                           placeholder="Es. 20 €" class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                </div>
            </fieldset>

            <fieldset class="space-y-4">
                <legend class="font-semibold text-slate-800">Dati per il versamento</legend>
                <div>
                    <label for="payment_holder" class="block text-sm font-medium mb-1">Intestatario del conto</label>
                    <input type="text" id="payment_holder" name="payment_holder" maxlength="255" value="{{ old('payment_holder', $values['payment_holder']) }}"
                           class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="payment_iban" class="block text-sm font-medium mb-1">IBAN</label>
                    <input type="text" id="payment_iban" name="payment_iban" maxlength="42" value="{{ old('payment_iban', $values['payment_iban']) }}"
                           placeholder="IT60 X054 2811 1010 0000 0123 456" class="w-full border border-slate-300 rounded px-3 py-2 text-sm font-mono uppercase">
                </div>
                <div>
                    <label for="payment_reason" class="block text-sm font-medium mb-1">Causale</label>
                    <input type="text" id="payment_reason" name="payment_reason" maxlength="255" value="{{ old('payment_reason', $values['payment_reason']) }}"
                           placeholder="Es. Quota associativa {{ date('Y') }} - Nome Cognome" class="w-full border border-slate-300 rounded px-3 py-2 text-sm">
                </div>
            </fieldset>

            <fieldset class="space-y-2">
                <legend class="font-semibold text-slate-800">Statuto (PDF)</legend>
                @if ($statutoPdf)
                    <div class="flex flex-wrap items-center gap-3 text-sm">
                        <a href="{{ asset('storage/' . $statutoPdf) }}" target="_blank" class="text-sky-700 hover:underline">Apri il PDF attuale</a>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="remove_statuto_pdf" value="1" class="h-4 w-4"> Rimuovi
                        </label>
                    </div>
                @else
                    <p class="text-sm text-amber-700">Nessun PDF caricato: sul sito il pulsante "Scarica lo statuto" non viene mostrato.</p>
                @endif
                <input type="file" name="statuto_pdf" accept="application/pdf"
                       class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                <p class="text-[11px] text-slate-500">Un nuovo file sostituisce quello attuale. Massimo 10 MB.</p>
            </fieldset>

            <button type="submit" class="bg-sky-700 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-sky-800">Salva</button>
        </form>
    </div>
@endsection
