<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ===== User Gates =====
        // show
        Gate::define('manage-users', function (User $user) {
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
        Gate::define('detail-intervention', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'technicien']);
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
        Gate::define('detail-intervention-planifiee', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'technicien']);
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
        Gate::define('view-planning', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'technicien']);
        });

        // ===== Analytique Gates =====
        Gate::define('view-analytique', function (User $user) {
            return in_array($user->role, ['admin', 'responsable', 'direction']);
        });
    }
}
