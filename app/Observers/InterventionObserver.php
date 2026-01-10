<?php

namespace App\Observers;

use App\Models\Intervention;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InterventionObserver
{
    private function logAction(string $action, Intervention $intervention): void
    {
        Log::channel('user_actions')->info($action, array_merge([
            'user_id' => Auth::user()->id ?? 'system',
            'user_email' => Auth::user()->email ?? 'system',
            'user_role' => Auth::user()->role ?? 'system',
            'intervention_id' => $intervention->idIntervention,
            'intervention_statut' => $intervention->statut,
            'intervention_machine_id' => $intervention->idMachine,
            'ip_address' => request()->ip(),
        ]));
    }
    /**
     * Handle the Intervention "created" event.
     */
    public function created(Intervention $intervention): void
    {
        $this->logAction('Intervention created', $intervention);
    }

    /**
     * Handle the Intervention "updated" event.
     */
    public function updated(Intervention $intervention): void
    {
        $this->logAction('Intervention updated', $intervention);
    }

    /**
     * Handle the Intervention "deleted" event.
     */
    public function deleted(Intervention $intervention): void
    {
        $this->logAction('Intervention deleted', $intervention);
    }
}
