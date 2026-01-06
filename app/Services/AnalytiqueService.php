<?php

namespace App\Services;

use App\Models\Intervention;
use App\Models\InterventionPlanifiee;

class AnalytiqueService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
    }

    // ===== Analyses des machines =====
    public function nbInterPerMachines() : array {
        $nbInterPerMachines = [];
        $interventions = Intervention::all();
        $interventions_planifiees = InterventionPlanifiee::all();

        foreach ($interventions as $intervention) {
            if (!isset($nbInterPerMachines[$intervention->idMachine])) {
                $nbInterPerMachines[$intervention->idMachine] = 0;
            }
            $nbInterPerMachines[$intervention->idMachine] += 1;
        }

        foreach ($interventions_planifiees as $interventionPlanifiee) {
            if (!isset($nbInterPerMachines[$interventionPlanifiee->idMachine])) {
                $nbInterPerMachines[$interventionPlanifiee->idMachine] = 0;
            }
            $nbInterPerMachines[$interventionPlanifiee->idMachine] += 1;
        }

        return $nbInterPerMachines;
    }

    // Machines avec maintenance préventive en retard
    public function machinesWithInterLate() : array {

    }
}
