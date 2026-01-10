<?php

namespace App\Observers;

use App\Models\Machine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MachineObserver
{
    private function logAction(string $action, Machine $machine): void
    {
        Log::channel('user_actions')->info($action, array_merge([
            'user_id' => Auth::user()->id ?? 'system',
            'user_email' => Auth::user()->email ?? 'system',
            'user_role' => Auth::user()->role ?? 'system',
            'machine_id' => $machine->idMachine,
            'machine_nom' => $machine->nom,
            'ip_address' => request()->ip(),
        ]));
    }
    /**
     * Handle the Machine "created" event.
     */
    public function created(Machine $machine): void
    {
        $this->logAction('Machine created', $machine);
    }

    /**
     * Handle the Machine "updated" event.
     */
    public function updated(Machine $machine): void
    {
        $this->logAction('Machine updated', $machine);
    }

    /**
     * Handle the Machine "deleted" event.
     */
    public function deleted(Machine $machine): void
    {
        $this->logAction('Machine deleted', $machine);
    }
}
