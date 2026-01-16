<?php

namespace App\Providers;

use App\Listeners\LogFailedLogin;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;
use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
use App\Models\Machine;
use App\Models\User;
use App\Observers\InterventionObserver;
use App\Observers\InterventionPlanifieeObserver;
use App\Observers\MachineObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected array $listen = [
        Login::class => [
            LogSuccessfulLogin::class,
        ],
        Logout::class => [
            LogSuccessfulLogout::class,
        ],
        Failed::class => [
            LogFailedLogin::class,
        ],
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ===== Logger =====
        Machine::observe(MachineObserver::class);
        User::observe(UserObserver::class);
        Intervention::observe(InterventionObserver::class);
        InterventionPlanifiee::observe(InterventionPlanifieeObserver::class);

        // ===== User Gates =====
        // show
        Gate::define('manage-users', function (User $user) {
            return $user->role === 'admin';
        });
        // detail
        Gate::define('detail-user', function (User $currentUser, User $targetUser) {
            return $currentUser->role === 'admin' || $currentUser->id === $targetUser->id;
        });
        // update
        Gate::define('update-user', function (User $currentUser) {
            return $currentUser->role === 'admin';
        });
        // update-password
        Gate::define('update-password-user', function (User $currentUser, User $targetUser) {
            return $currentUser->role === 'admin' || $currentUser->id === $targetUser->id;
        });
        // delete
        Gate::define('delete-user', function (User $user) {
            return $user->role === 'admin';
        });
        // add
        Gate::define('add-user', function (User $user) {
            return $user->role === 'admin';
        });

        // ===== Machine Gates =====
        // show
        Gate::define('manage-machines', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'direction', 'technicien']);
        });
        // detail
        Gate::define('detail-machine', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'direction', 'technicien']);
        });
        // add
        Gate::define('add-machine', function (User $user) {
            return in_array($user->role, ['admin', 'direction']);
        });
        // update
        Gate::define('update-machine', function (User $user) {
            return in_array($user->role, ['admin', 'direction']);
        });
        // update etat
        Gate::define('update-etat-machine', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'direction', 'technicien']);
        });
        // delete
        Gate::define('delete-machine', function (User $user) {
            return in_array($user->role, ['admin', 'direction']);
        });

        // ===== Intervention Gates =====
        // show
        Gate::define('manage-interventions', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'technicien']);
        });
        // detail
        Gate::define('detail-intervention', function (User $user, Intervention $intervention) {
            return (in_array($user->role, ['admin', 'responsable'])) || (($user->role === 'technicien' && $intervention->technicien_id === $user->id));
        });
        // add
        Gate::define('add-intervention', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'technicien']);
        });
        // attitrer intervention
        Gate::define('attitrer-intervention', function (User $user) {
            return in_array($user->role, ['admin', 'responsable']);
        });
        // update
        Gate::define('update-intervention', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'technicien']);
        });
        // delete
        Gate::define('delete-intervention', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'technicien']);
        });

        // ===== Intervention Planifiée Gates =====
        // show
        Gate::define('manage-interventions-planifiees', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'technicien']);
        });
        // detail
        Gate::define('detail-intervention-planifiee', function (User $user, InterventionPlanifiee $interventionPlanifiee) {
            // Admin et responsable peuvent tout voir
            if (in_array($user->role, ['admin', 'responsable'])) {
                return true;
            }
            // Technicien peut voir seulement si il est assigné
            if ($user->role === 'technicien') {
                return $interventionPlanifiee->techniciens->contains($user->id);
            }
            // Sinon, refuser
            return false;
        });
        // add
        Gate::define('add-intervention-planifiee', function (User $user) {
            return in_array($user->role, ['admin', 'responsable']);
        });
        // update
        Gate::define('update-intervention-planifiee', function (User $user) {
            return in_array($user->role, ['admin', 'responsable']);
        });
        // update statut
        Gate::define('update-statut-intervention-planifiee', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'technicien']);
        });
        // delete
        Gate::define('delete-intervention-planifiee', function (User $user) {
            return in_array($user->role, ['admin', 'responsable']);
        });

        // ===== Planning Gates =====
        Gate::define('manage-planning', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'technicien']);
        });

        // ===== Analytique Gates =====
        Gate::define('manage-analytique', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'direction']);
        });
    }
}
