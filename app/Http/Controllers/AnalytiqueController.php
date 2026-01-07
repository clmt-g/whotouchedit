<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
use App\Models\Machine;
use App\Services\AnalytiqueService;
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
}
