<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Event;
use App\Models\GalleryPhoto;
use App\Models\ContactMessage;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts_count'    => Post::count(),
            'events_count'   => Event::count(),
            'photos_count'   => GalleryPhoto::count(),
            'messages_count' => ContactMessage::count(),
        ];

        $latestMessages = ContactMessage::latest()->take(5)->get();
        $latestEvents   = Event::latest('starts_at')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestMessages', 'latestEvents'));
    }

    /**
     * Visualizza il log di audit con paginazione
     */
    public function auditLog(Request $request)
    {
        $query = AuditLog::latest('created_at');

        // Filtro per modello se fornito
        if ($request->filled('model')) {
            $query->where('model_type', $request->model);
        }

        // Filtro per azione se fornita
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filtro per utente se fornito
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filtro per data
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->paginate(20);

        // Dati per i filtri
        $models = AuditLog::distinct('model_type')->pluck('model_type');
        $actions = AuditLog::distinct('action')->pluck('action');
        $users = \App\Models\User::all();

        return view('admin.audit-log', compact('logs', 'models', 'actions', 'users'));
    }
}
