<?php

namespace App\Services;

use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
use App\Models\Machine;

class AnalytiqueService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
    }

    // ===== Analyses des machines =====

    /** return the number of interventions by machines
     * @return array
     */
    public function nbInterPerMachines(): array
    {
        $nbInterPerMachines = [];
        $interventions = Intervention::all();
        $interventions_planifiees = InterventionPlanifiee::all();

        foreach ($interventions as $intervention) {
            if (!isset($nbInterPerMachines[$intervention->machine->nom])) {
                $nbInterPerMachines[$intervention->machine->nom] = 0;
            }
            $nbInterPerMachines[$intervention->machine->nom] += 1;
        }

        foreach ($interventions_planifiees as $interventionPlanifiee) {
            if (!isset($nbInterPerMachines[$interventionPlanifiee->machine->nom])) {
                $nbInterPerMachines[$interventionPlanifiee->machine->nom] = 0;
            }
            $nbInterPerMachines[$interventionPlanifiee->machine->nom] += 1;
        }

        arsort($nbInterPerMachines); // Tri décroissant

        return $nbInterPerMachines;
    }

    /** return the machines with interventions in delay
     * @return array
     */
    public function getMachinesInterventionsEnRetard(): array
    {
        $interventionsPlanifiees = InterventionPlanifiee::all();

        $machines = [];

        foreach ($interventionsPlanifiees as $interventionPlanifiee) {
            if ($interventionPlanifiee->statut = 'planifiee' && $interventionPlanifiee->dateDebut < date('Y-m-d')) {
                $machines[] = $interventionPlanifiee->machine;
            }
        }
        return $machines;
    }

    /** return the state of the machine park in percentage
     * @return array
     */
    public function etatParc(): array
    {
        $machines = Machine::all();
        $nbMachines = count($machines);

        $etatParc = [];

        $etatParc['Opérationnelle'] = round($machines->where('etat', 'opérationnelle')->count() / $nbMachines * 100, 1) ?? 0;
        $etatParc['En maintenance'] = round($machines->where('etat', 'en_maintenance')->count() / $nbMachines * 100, 1) ?? 0;
        $etatParc['Planifiée'] = round($machines->where('etat', 'planifiée')->count() / $nbMachines * 100, 1) ?? 0;
        $etatParc['En_panne'] = round($machines->where('etat', 'en_panne')->count() / $nbMachines * 100, 1) ?? 0;
        $etatParc['Hors_service'] = round($machines->where('etat', 'hors_service')->count() / $nbMachines * 100, 1) ?? 0;

        return $etatParc;
    }

    /** return the criticality of the machine park in percentage
     * @return array
     */
    public function avgCriticite() : array {
        $machines = Machine::all();
        $nbMachines = count($machines);

        $criticiteParc = [];

        $criticiteParc['Faible'] = round($machines->where('criticite', 'faible')->count() / $nbMachines * 100, 1) ?? 0;
        $criticiteParc['Moyen'] = round($machines->where('criticite', 'moyen')->count() / $nbMachines * 100, 1) ?? 0;
        $criticiteParc['Critique'] = round($machines->where('criticite', 'critique')->count() / $nbMachines * 100, 1) ?? 0;

        return $criticiteParc;
    }

    // ===== kpi =====

}
