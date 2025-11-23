<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactMessageController;

// Sito pubblico
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/chi-siamo', [PageController::class, 'chiSiamo'])->name('chi-siamo');

//  Eventi dal DB
Route::get('/eventi', [EventController::class, 'index'])->name('eventi.index');
Route::get('/eventi/{event}', [EventController::class, 'show'])->name('eventi.show');

// Contatti / Associati
Route::get('/contatti', [PageController::class, 'contatti'])->name('contatti');
Route::get('/associati', [PageController::class, 'associati'])->name('associati');
Route::post('/contatti', [ContactMessageController::class, 'store'])->name('contatti.store');


// News
Route::get('/news', [PostController::class, 'index'])->name('news.index');
Route::get('/news/{post}', [PostController::class, 'show'])->name('news.show');

// Rotte CRUD per post ed eventi (da spostare in /admin più avanti)
Route::resource('posts', PostController::class)->except(['index', 'show']);
Route::resource('events', EventController::class)->except(['index', 'show']);

// Admin - gestione messaggi
Route::get('/admin/messaggi', [ContactMessageController::class, 'index'])->name('admin.messages.index');
Route::get('/admin/messaggi/{contact_message}', [ContactMessageController::class, 'show'])->name('admin.messages.show');


Route::resource('posts', PostController::class);