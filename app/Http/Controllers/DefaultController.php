<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
use App\Models\Machine;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DefaultController extends Controller
{
    /** display the home page
     * @return Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $user = Auth::user();

        $machines = Machine::all();
        $interventionPlanifiees = InterventionPlanifiee::forUser($user)->get();
        $interventions = Intervention::forUser($user)->get();

        // --- nb de machines ---
        $nbMachines = count($machines);

        // --- interventions en cours ---
        $nbInterEnCours = $interventionPlanifiees->where('statut', 'en_cours')->count()
            + $interventions->where('statut', 'en_cours')->count();

        // --- Machines en panne ---
        $nbMachinesEnPanne = $machines->where('etat', 'en_panne')->count();

        // --- Interventions non passées ---
        $interventionsNonPassees = Intervention::forUser($user)
            ->where('dateHeureFin', '>', Carbon::now())
            ->orderBy('dateHeureDebut', 'asc')
            ->get();

        // --- Interventions planifiées non passées ---
        $interventionPlanifieesNonPassees = InterventionPlanifiee::forUser($user)
            ->where('dateFin', '>', Carbon::now())
            ->orderBy('dateDebut', 'asc')
            ->get();

        // --- Etat du parc ---
        if ($nbMachines > 0) {
            $op = round($machines->where('etat', 'opérationnelle')->count() / $nbMachines * 100, 1);
            $maintenance = round($machines->where('etat', 'en_maintenance')->count() / $nbMachines * 100, 1);
            $planifiee = round($machines->where('etat', 'planifiée')->count() / $nbMachines * 100, 1);
            $panne = round($machines->where('etat', 'en_panne')->count() / $nbMachines * 100, 1);
            $hs = round($machines->where('etat', 'hors_service')->count() / $nbMachines * 100, 1);
        } else {
            $op = $maintenance = $planifiee = $panne = $hs = 0;
        }

        // --- criticite ---
        $critique = $machines->where('criticite', 'critique')->count();
        $moyen = $machines->where('criticite', 'moyen')->count();
        $faible = $machines->where('criticite', 'faible')->count();

        return view('dashboard', [
            'nbMachines' => $nbMachines,
            'nbInterEnCours' => $nbInterEnCours,
            'nbMachinesEnPanne' => $nbMachinesEnPanne,
            'interventionsNonPassees' => $interventionsNonPassees,
            'interventionPlanifieesNonPassees' => $interventionPlanifieesNonPassees,
            'op' => $op,
            'maintenance' => $maintenance,
            'planifiee' => $planifiee,
            'panne' => $panne,
            'hs' => $hs,
            'critique' => $critique,
            'moyen' => $moyen,
            'faible' => $faible,
        ]);
    }
}
