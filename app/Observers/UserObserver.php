<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    private function logAction(string $action, User $user): void
    {
        Log::channel('user_actions')->info($action, array_merge([
            'user_id' => Auth::user()->id ?? 'system',
            'user_email' => Auth::user()->email ?? 'system',
            'user_role' => Auth::user()->role ?? 'system',
            'updated_user_id' => $user->id,
            'updated_user_email' => $user->email,
            'updated_user_role' => $user->role,
            'ip_address' => request()->ip(),
        ]));
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->logAction('User created', $user);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $this->logAction('User updated', $user);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->logAction('User deleted', $user);
    }
}
