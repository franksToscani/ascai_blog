<?php

namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class AuditObserver
{
    /**
     * Handle the Model "created" event.
     */
    public function created(Model $model): void
    {
        $this->logAudit($model, 'create', null, $model->getAttributes());
    }

    /**
     * Handle the Model "updated" event.
     */
    public function updated(Model $model): void
    {
        $oldValues = $model->getOriginal();
        $newValues = $model->getChanges();

        // Non loggare se non ci sono cambiamenti significativi
        if (empty($newValues)) {
            return;
        }

        $this->logAudit($model, 'update', $oldValues, $newValues);
    }

    /**
     * Handle the Model "deleted" event.
     */
    public function deleted(Model $model): void
    {
        $this->logAudit($model, 'delete', $model->getAttributes(), null);
    }

    /**
     * Handle the Model "restored" event.
     */
    public function restored(Model $model): void
    {
        $this->logAudit($model, 'restore', null, $model->getAttributes());
    }

    /**
     * Log the audit event
     */
    private function logAudit(Model $model, string $action, ?array $oldValues, ?array $newValues): void
    {
        try {
            AuditLog::create([
                'user_id' => Auth::id(),
                'model_type' => get_class($model),
                'model_id' => $model->id,
                'action' => $action,
                'old_values' => $oldValues,
                'new_values' => $newValues,
                'ip_address' => Request::ip(),
                'user_agent' => Request::userAgent(),
                'created_at' => now(),
        } catch (\Exception $e) {
            // Log dell'errore di audit (non bloccare l'operazione principale)
            Log::error('Audit log error: ' . $e->getMessage());
        }
        }
    }
}
