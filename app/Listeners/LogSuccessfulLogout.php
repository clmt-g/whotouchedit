<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogout
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        Log::channel('user_actions')->info('Déconnexion', [
            'id' => $event->user->id ?? 'unknown',
            'user' => $event->user->email ?? 'unknown',
            'role' => $event->user->role ?? 'unknown',
            'ip' => request()->ip(),
        ]);
    }
}
