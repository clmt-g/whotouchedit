<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
use App\Models\Machine;
use App\Models\User;
use App\Services\AnalytiqueService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnalytiqueController extends Controller
{
    protected AnalytiqueService $analytiqueService;

    public function __construct(AnalytiqueService $analytiqueService)
    {
        $this->analytiqueService = $analytiqueService;
    }

    // display the analytique page
    public function analytique() {
        return view('analytique.analytique');
    }

    // display the kpi page
    public function kpi() {



        return view('analytique.kpi');
    }

    // display the analyse_machine page
    public function analyse_machine() {
        // nb d'inter par machine
        $nbInterPerMachines = $this->analytiqueService->nbInterPerMachines();

        // inter en retard
        $machinesWithInterEnRetard = $this->analytiqueService->getMachinesInterventionsEnRetard();

        // etat parc machine
        $etatParc = $this->analytiqueService->etatParc();

        // moyenne des criticites
        $avgCriticite = $this->analytiqueService->avgCriticite();

        return view('analytique.analyse_machine', [
            'nbInterPerMachines' => $nbInterPerMachines,
            'machinesWithInterEnRetard' => $machinesWithInterEnRetard,
            'etatParc' => $etatParc,
            'avgCriticite' => $avgCriticite
        ]);
    }

    // display the analyse_intervention page
    public function analyse_intervention() {
        // nb d'interventions
        $nbInterventions = $this->analytiqueService->nbInterventions();

        // moyenne des statuts
        $avgStatut = $this->analytiqueService->avgStatut_intervention();

        // temps moyen des interventions
        $avgTime = $this->analytiqueService->avgTimeByInterventions();

        return view('analytique.analyse_intervention', [
            'nbInterventions' => $nbInterventions,
            'avgStatut' => $avgStatut,
            'avgTime' => $avgTime
        ]);
    }

    // display the analyse_intervention_planifiee page
    public function analyse_intervention_planifiee() {
        // nb d'interventions planifiées
        $nbInterventionsPlanifiees = $this->analytiqueService->nbInterventionsPlanifiees();

        // moyenne des statuts
        $avgStatutPlanifiee = $this->analytiqueService->avgStatut_interventionPlanifiee();

        // temps moyen des interventions planifiées
        $avgTimePlanifiee = $this->analytiqueService->avgTimeByInterventionsPlanifiees();

        return view('analytique.analyse_intervention_planifiee', [
            'nbInterventionsPlanifiees' => $nbInterventionsPlanifiees,
            'avgStatutPlanifiee' => $avgStatutPlanifiee,
            'avgTimePlanifiee' => $avgTimePlanifiee
        ]);
    }

    // display the performance_technicien page
    public function performance_technicien() {
        // nb de techniciens
        $nbTechniciens = User::all()->where('role', 'technicien')->count();

        // nb d'interventions par technicien
        $interventionsPerTechnicien = $this->analytiqueService->nbInterventionsByTechnicien();

        // moyenne des temps d'intervention (tout confondu) par technicien
        $avgReestablishementTimePerTechnicien = $this->analytiqueService->avgReestablishementTimePerTechnicien();

        // moyenne des temps d'intervention corrective par technicien
        $avgInterventionTimePerTechnicien = $this->analytiqueService->avgInterventionTimePerTechnicien();

        // moyenne des temps d'intervention préventive par technicien
        $avgPlanifiedInterventionTimePerTechnicien = $this->analytiqueService->avgPlanifiedInterventionTimePerTechnicien();

        return view('analytique.performance_technicien', [
            'nbTechniciens' => $nbTechniciens,
            'interventionsPerTechnicien' => $interventionsPerTechnicien,
            'avgReestablishementTimePerTechnicien' => $avgReestablishementTimePerTechnicien,
            'avgInterventionTimePerTechnicien' => $avgInterventionTimePerTechnicien,
            'avgPlanifiedInterventionTimePerTechnicien' => $avgPlanifiedInterventionTimePerTechnicien
        ]);
    }

    // display the predictif page
    public function predictif() {
        // machines critiques
        $riskyMachines = Machine::all()->where('criticite', 'critique');

        // machines en panne
        $brokenMachines = Machine::all()->where('etat', 'en_panne');

        // next interventions planifiées
        $nextPlannedInterventions = InterventionPlanifiee::where('dateDebut', '>=', Carbon::now())->orderBy('dateDebut', 'asc')->get();

        return view('analytique.predictif', [
            'riskyMachines' => $riskyMachines,
            'brokenMachines' => $brokenMachines,
            'nextPlannedInterventions' => $nextPlannedInterventions
        ]);
    }
}
