<?php

namespace App\Http\Controllers;

use App\Models\Bilancio;
use Illuminate\Support\Facades\Storage;

class BilancioController extends Controller
{
    /**
     * Download bilancio PDF by year
     */
    public function download(int $year)
    {
        $bilancio = Bilancio::where('year', $year)->firstOrFail();

        if (!Storage::disk('public')->exists($bilancio->file_path)) {
            abort(404, 'File non trovato');
        }

        $downloadName = 'Bilancio_' . $year . '.pdf';

        return response()->download(
            Storage::disk('public')->path($bilancio->file_path),
            $downloadName
        );
    }
}

