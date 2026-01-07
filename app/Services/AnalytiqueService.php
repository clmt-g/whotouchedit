<?php

namespace App\Services;

use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
use App\Models\Machine;
use Carbon\Carbon;

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

    // ===== intervention curative =====
    /** return the status of interventions in percentage
     * @return array
     */
    public function avgStatut() : array {
        $interventions = Intervention::all();
        $nbInterventions = count($interventions);

        $statutIntervention = [];

        $statutIntervention['en_cours'] = round($interventions->where('statut', 'en_cours')->count() / $nbInterventions * 100, 1) ?? 0;
        $statutIntervention['terminee'] = round($interventions->where('statut', 'terminee')->count() / $nbInterventions * 100, 1) ?? 0;
        $statutIntervention['annulee'] = round($interventions->where('statut', 'annulee')->count() / $nbInterventions * 100, 1) ?? 0;
        $statutIntervention['en_attente'] = round($interventions->where('statut', 'en_attente')->count() / $nbInterventions * 100, 1) ?? 0;

        return $statutIntervention;
    }

    /** return the number of interventions overall, this year, this month, this week
     * @return array
     */
    public function nbInterventions() : array {
        $interventions = [];
        $interventions['Aujourd\'hui'] = Intervention::all()->count();
        // nombre d'interventions cette année, ce mois, cette semaine
        $interventions['Cette année']= Intervention::whereYear('dateHeureDebut', Carbon::now()->year)->count();
        $interventions['Ce mois'] = Intervention::whereMonth('dateHeureDebut', Carbon::now()->month)
            ->whereYear('dateHeureDebut', Carbon::now()->year)
            ->count();
        $interventions['Cette semaine'] = Intervention::whereBetween('dateHeureDebut', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
        return $interventions;
    }

    /** return the average time of interventions in hours
     * @return array
     */
    public function avgTimeByInterventions() : array {
        $interventions = Intervention::all();
        $totalTime = 0;
        $nbInterventions = count($interventions);

        // calcul du temps total en heures
        foreach ($interventions as $intervention) {
            $start = Carbon::parse($intervention->dateHeureDebut);
            $end = Carbon::parse($intervention->dateHeureFin);
            $totalTime += $start->diffInHours($end);
        }

        // moyenne du temps par intervention
        $avgTime = $nbInterventions > 0 ? $totalTime / $nbInterventions : 0;

        return [
            'totalTime' => $totalTime,
            'avgTime' => round($avgTime, 2)
        ];
    }
}
