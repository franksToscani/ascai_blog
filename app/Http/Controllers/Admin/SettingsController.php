<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /** Campi testuali della scheda "Dati associazione" */
    private const FIELDS = [
        'membership_fee' => 'nullable|string|max:50',
        'payment_holder' => 'nullable|string|max:255',
        'payment_iban' => ['nullable', 'string', 'max:42', 'regex:/^[A-Z]{2}[0-9]{2}[A-Z0-9 ]{10,38}$/i'],
        'payment_reason' => 'nullable|string|max:255',
        'membership_form_url' => 'nullable|url|max:500',
    ];

    public function edit()
    {
        $values = collect(array_keys(self::FIELDS))
            ->mapWithKeys(fn ($key) => [$key => Setting::get($key)])
            ->all();

        $statutoPdf = Setting::get('statuto_pdf_path');

        return view('admin.settings.edit', compact('values', 'statutoPdf'));
    }

    public function update(Request $request)
    {
        $data = $request->validate(self::FIELDS + [
            'statuto_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ], [
            'payment_iban.regex' => 'L\'IBAN non sembra valido: deve iniziare con il codice del paese (es. IT60...).',
        ]);

        foreach (array_keys(self::FIELDS) as $key) {
            $value = $data[$key] ?? null;

            // IBAN salvato senza spazi e in maiuscolo; la pagina lo mostra a gruppi di 4
            if ($key === 'payment_iban' && $value) {
                $value = strtoupper(str_replace(' ', '', $value));
            }

            Setting::put($key, $value);
        }

        $oldPdf = Setting::get('statuto_pdf_path');

        if ($request->hasFile('statuto_pdf')) {
            // Nome con la data: chi aveva scaricato la versione precedente non la ritrova in cache
            $filename = 'statuto-ascai-bologna-' . now()->format('Y-m-d-His') . '.pdf';
            $path = Storage::disk('public')->putFileAs('documenti', $request->file('statuto_pdf'), $filename);
            Setting::put('statuto_pdf_path', $path);

            if ($oldPdf) {
                Storage::disk('public')->delete($oldPdf);
            }
        } elseif ($request->boolean('remove_statuto_pdf') && $oldPdf) {
            Storage::disk('public')->delete($oldPdf);
            Setting::put('statuto_pdf_path', null);
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Dati dell\'associazione salvati.');
    }
}
