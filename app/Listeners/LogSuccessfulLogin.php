<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        Log::channel('user_actions')->info('Connexion réussie', [
            'id' => $event->user->id,
            'user' => $event->user->email,
            'role' => $event->user->role,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
