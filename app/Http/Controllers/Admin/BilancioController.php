<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bilancio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BilancioController extends Controller
{
    public function index()
    {
        $bilanci = Bilancio::orderByDesc('year')->get();
        return view('admin.bilanci.index', compact('bilanci'));
    }

    public function create()
    {
        return view('admin.bilanci.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'year' => ['required', 'integer', 'min:2000', 'max:3000', 'unique:bilanci,year'],
            'title' => ['nullable', 'string', 'max:255'],
            'file' => ['required', 'file', 'mimes:pdf', 'max:10240'], // max 10MB
        ]);

        $file = $data['file'];
        $year = $data['year'];

        $filename = 'bilancio_' . $year . '.pdf';
        $path = Storage::disk('public')->putFileAs('bilanci', $file, $filename);

        Bilancio::create([
            'year' => $year,
            'title' => $data['title'] ?? null,
            'file_path' => $path,
        ]);

        return redirect()->route('admin.bilanci.index')
            ->with('status', 'Bilancio ' . $year . ' caricato correttamente');
    }

    public function destroy(Bilancio $bilancio)
    {
        // Remove stored file if exists
        if ($bilancio->file_path && Storage::disk('public')->exists($bilancio->file_path)) {
            Storage::disk('public')->delete($bilancio->file_path);
        }

        $bilancio->delete();

        return redirect()->route('admin.bilanci.index')
            ->with('status', 'Bilancio eliminato');
    }
}
