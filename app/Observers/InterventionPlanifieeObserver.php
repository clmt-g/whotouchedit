<?php

namespace App\Observers;

use App\Models\InterventionPlanifiee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InterventionPlanifieeObserver
{
    private function logAction(string $action, InterventionPlanifiee $intervention): void
    {
        Log::channel('user_actions')->info($action, array_merge([
            'user_id' => Auth::user()->id ?? 'system',
            'user_email' => Auth::user()->email ?? 'system',
            'user_role' => Auth::user()->role ?? 'system',
            'intervention_id' => $intervention->idInterventionPlanifiee,
            'intervention_statut' => $intervention->statut,
            'intervention_machine_id' => $intervention->idMachine,
            'ip_address' => request()->ip(),
        ]));
    }

    /**
     * Handle the InterventionPlanifiee "created" event.
     */
    public function created(InterventionPlanifiee $interventionPlanifiee): void
    {
        $this->logAction('Intervention Planifiee Created', $interventionPlanifiee);
    }

    /**
     * Handle the InterventionPlanifiee "updated" event.
     */
    public function updated(InterventionPlanifiee $interventionPlanifiee): void
    {
        $this->logAction('Intervention Planifiee Updated', $interventionPlanifiee);
    }

    /**
     * Handle the InterventionPlanifiee "deleted" event.
     */
    public function deleted(InterventionPlanifiee $interventionPlanifiee): void
    {
        $this->logAction('Intervention Planifiee Deleted', $interventionPlanifiee);
    }
}
