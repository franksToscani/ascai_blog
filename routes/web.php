<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // 👈 AGGIUNTO
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\GalleryPhotoController;
use App\Http\Controllers\AdminDashboardController;

// ======================
// SITO PUBBLICO
// ======================

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/chi-siamo', [PageController::class, 'chiSiamo'])->name('chi-siamo');
Route::get('/associati', [PageController::class, 'associati'])->name('associati');

// Contatti pubblici
Route::get('/contatti', [PageController::class, 'contatti'])->name('contatti');
Route::post('/contatti', [ContactMessageController::class, 'store'])->name('contatti.store');

// Eventi pubblici
Route::get('/eventi', [EventController::class, 'index'])->name('eventi.index');
Route::get('/eventi/{event}', [EventController::class, 'show'])->name('eventi.show');

// News pubbliche
Route::get('/news', [PostController::class, 'index'])->name('news.index');
Route::get('/news/{post}', [PostController::class, 'show'])->name('news.show');

// Galleria pubblica
Route::get('/galleria', [GalleryPhotoController::class, 'index'])->name('galleria');

// ======================
// DASHBOARD (usata da Breeze)
// ======================

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user && $user->is_admin) {
        // Admin → dashboard amministrativa
        return redirect()->route('admin.dashboard');
    }

    // Utente normale → home pubblica
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

// ======================
// AREA ADMIN (protetta)
// ======================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Gestione NEWS (Post) - solo da admin
        Route::resource('posts', PostController::class)->except(['show']);

        // Gestione EVENTI - solo da admin
        Route::resource('events', EventController::class)->except(['show']);

        // Messaggi contatti
        Route::get('messaggi', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('messaggi/{contact_message}', [ContactMessageController::class, 'show'])->name('messages.show');

        // Galleria foto
        Route::get('galleria', [GalleryPhotoController::class, 'adminIndex'])->name('gallery.index');
        Route::get('galleria/crea', [GalleryPhotoController::class, 'create'])->name('gallery.create');
        Route::post('galleria', [GalleryPhotoController::class, 'store'])->name('gallery.store');
    });

// Rotte auth generate da Breeze (login, register, ecc.)
require __DIR__.'/auth.php';

require __DIR__.'/settings.php';