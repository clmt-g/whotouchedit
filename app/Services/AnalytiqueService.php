<?php

namespace App\Services;

use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
use App\Models\Machine;
use App\Models\User;
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
    public function avgStatut_intervention() : array {
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
        $interventions['Toute'] = Intervention::all()->count();
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

    // ===== intervention planifiée =====

    /** return the status of planned interventions in percentage
     * @return array
     */
    public function avgStatut_interventionPlanifiee() : array {
        $interventions = InterventionPlanifiee::all();
        $nbInterventions = count($interventions);

        $statutIntervention = [];

        $statutIntervention['planifiee'] = round($interventions->where('statut', 'planifiee')->count() / $nbInterventions * 100, 1) ?? 0;
        $statutIntervention['en_cours'] = round($interventions->where('statut', 'en_cours')->count() / $nbInterventions * 100, 1) ?? 0;
        $statutIntervention['terminee'] = round($interventions->where('statut', 'terminee')->count() / $nbInterventions * 100, 1) ?? 0;
        $statutIntervention['annulee'] = round($interventions->where('statut', 'annulee')->count() / $nbInterventions * 100, 1) ?? 0;

        return $statutIntervention;
    }

    /** return the number of planned interventions overall, this year, this month, this week
     * @return array
     */
    public function nbInterventionsPlanifiees() : array {
        $interventions = [];
        $interventions['Toute'] = InterventionPlanifiee::all()->count();
        // nombre d'interventions cette année, ce mois, cette semaine
        $interventions['Cette année']= InterventionPlanifiee::whereYear('dateDebut', Carbon::now()->year)->count();
        $interventions['Ce mois'] = InterventionPlanifiee::whereMonth('dateDebut', Carbon::now()->month)
            ->whereYear('dateDebut', Carbon::now()->year)
            ->count();
        $interventions['Cette semaine'] = InterventionPlanifiee::whereBetween('dateDebut', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
        return $interventions;
    }

    /** return the average time of planned interventions in hours
     * @return array
     */
    public function avgTimeByInterventionsPlanifiees() : array {
        $interventions = InterventionPlanifiee::all();
        $totalTime = 0;
        $nbInterventions = count($interventions);

        // calcul du temps total en heures
        foreach ($interventions as $intervention) {
            $start = Carbon::parse($intervention->dateDebut);
            $end = Carbon::parse($intervention->dateFin);
            $totalTime += $start->diffInHours($end);
        }

        // moyenne du temps par intervention
        $avgTime = $nbInterventions > 0 ? $totalTime / $nbInterventions : 0;

        return [
            'totalTime' => $totalTime,
            'avgTime' => round($avgTime, 2)
        ];
    }

    // ===== Technicien =====
    /** return the number of interventions completed by technician
     * @return array
     */
    public function nbInterventionsByTechnicien() : array {
        $interventions = Intervention::all()->where('statut', 'terminee');
        $interventionsPlanifiees = InterventionPlanifiee::all()->where('statut', 'terminee');

        $nbInterPerTechnicien = [];

        foreach ($interventions as $intervention) {
            if (!isset($nbInterPerTechnicien[$intervention->user->nom . ' ' . $intervention->user->prenom])) {
                $nbInterPerTechnicien[$intervention->user->nom . ' ' . $intervention->user->prenom] = 0;
            }
            $nbInterPerTechnicien[$intervention->user->nom . ' ' . $intervention->user->prenom] += 1;
        }

        foreach ($interventionsPlanifiees as $interventionPlanifiee) {
            foreach ($interventionPlanifiee->techniciens as $technicien) {
                if (!isset($nbInterPerTechnicien[$intervention->user->nom . ' ' . $intervention->user->prenom])) {
                    $nbInterPerTechnicien[$intervention->user->nom . ' ' . $intervention->user->prenom] = 0;
                }
                $nbInterPerTechnicien[$intervention->user->nom . ' ' . $intervention->user->prenom] += 1;
            }
        }
        arsort($nbInterPerTechnicien); // Tri décroissant
        return $nbInterPerTechnicien ?? [];
    }

    /** return the reestablishment time per technician in hours
     * @return array
     */
    public function avgReestablishementTimePerTechnicien() : array {
        $techniciens = User::all()->where('role','technicien');
        $avgTimePerTechnicien = [];
        $totalTime = 0;

        foreach ($techniciens as $technicien) {
            $totalTime = 0;
            $nbInterventions = 0;

            foreach($technicien->interventions as $intervention) {
                // calcul du temps de rétablissement
                $start = Carbon::parse($intervention->dateHeureDebut);
                $end = Carbon::parse($intervention->dateHeureFin);
                $totalTime += $start->diffInHours($end);
            }
            foreach($technicien->interventionsPlanifiees as $interventionPlanifiee) {
                // calcul du temps de rétablissement
                $start = Carbon::parse($interventionPlanifiee->dateDebut);
                $end = Carbon::parse($interventionPlanifiee->dateFin);
                $totalTime += $start->diffInHours($end);
            }
            // moyenne du temps de rétablissement par technicien
            $nbInterventions = count($technicien->interventions) + count($technicien->interventionsPlanifiees);
            $avgTimePerTechnicien[$intervention->user->nom . ' ' . $intervention->user->prenom] = $nbInterventions > 0 ? round($totalTime / $nbInterventions, 2) : 0;
        }
        return $avgTimePerTechnicien ?? [];
    }

    /** return the average intervention time per technician in hours
     * @return array
     */
    public function avgInterventionTimePerTechnicien() : array {
        $techniciens = User::all()->where('role','technicien');
        $avgTimePerTechnicien = [];

        foreach ($techniciens as $technicien) {
            $totalTime = 0;
            foreach($technicien->interventions as $intervention) {
                // calcul du temps d'intervention
                $start = Carbon::parse($intervention->dateHeureDebut);
                $end = Carbon::parse($intervention->dateHeureFin);
                $totalTime += $start->diffInHours($end);
            }
            // moyenne du temps d'intervention par technicien
            $nbInterventions = count($technicien->interventions);
            $avgTimePerTechnicien[$technicien->nom . ' ' . $technicien->prenom] = $nbInterventions > 0 ? round($totalTime / $nbInterventions, 2) : 0;
        }
        return $avgTimePerTechnicien ?? [];
    }

    /** return the average planned intervention time per technician in hours
     * @return array
     */
    public function avgPlanifiedInterventionTimePerTechnicien() : array {
        $techniciens = User::all()->where('role','technicien');
        $avgTimePerTechnicien = [];

        foreach ($techniciens as $technicien) {
            $totalTime = 0;
            foreach($technicien->interventionsPlanifiees as $interventionPlanifiee) {
                // calcul du temps d'intervention planifiée
                $start = Carbon::parse($interventionPlanifiee->dateDebut);
                $end = Carbon::parse($interventionPlanifiee->dateFin);
                $totalTime += $start->diffInHours($end);
            }
            // moyenne du temps d'intervention planifiée par technicien
            $nbInterventions = count($technicien->interventionsPlanifiees);
            $avgTimePerTechnicien[$technicien->nom . ' ' . $technicien->prenom]= $nbInterventions > 0 ? round($totalTime / $nbInterventions, 2) : 0;
        }
        return $avgTimePerTechnicien ?? [];
    }

    // ===== kpi =====

    /** return the availability of the machine park in percentage
     * @return float
     */
    public function disponibiliteParc() : float {
        $machines = Machine::all();
        $nbMachines = count($machines);
        $nbMachinesOperatio = $machines->where('etat', 'opérationnelle')->count();

        $disponibilite = $nbMachines > 0 ? ($nbMachinesOperatio / $nbMachines) * 100 : 0;

        return round($disponibilite, 2);
    }

    /** return the Mean Time To Repair (MTTR) in hours (for the all parc)
     * @return float
     */
    public function mttr() : float {
        $interventions = Intervention::all()->where('statut', 'terminee');
        $totalDowntime = 0;
        $nbInterventions = count($interventions);

        foreach ($interventions as $intervention) {
            $start = Carbon::parse($intervention->dateHeureDebut);
            $end = Carbon::parse($intervention->dateHeureFin);
            $totalDowntime += $start->diffInHours($end);
        }

        $mttr = $nbInterventions > 0 ? $totalDowntime / $nbInterventions : 0;

        return round($mttr, 2);
    }

    /** return the Mean Time Between Failures (MTBF) in hours (for the all parc)
     * @return float
     */
    public function mtbf() : float {
        $interventions = Intervention::all()->where('statut', 'terminee');
        $totalUptime = 0;
        $nbInterventions = count($interventions);

        foreach ($interventions as $intervention) {
            $machine = $intervention->machine;
            $lastIntervention = Intervention::where('idMachine', $machine->id)
                ->where('statut', 'terminee')
                ->where('dateHeureFin', '<', $intervention->dateHeureDebut)
                ->orderBy('dateHeureFin', 'desc')
                ->first();

            if ($lastIntervention) {
                $lastEnd = Carbon::parse($lastIntervention->dateHeureFin);
                $currentStart = Carbon::parse($intervention->dateHeureDebut);
                $totalUptime += $lastEnd->diffInHours($currentStart);
            }
        }

        $mtbf = $nbInterventions > 0 ? $totalUptime / $nbInterventions : 0;

        return round($mtbf, 2);
    }

    /** return the Mean Time To Failure (MTTF) in hours (for the all parc)
     * @return float
     */
    public function mttf() : float {
        $interventions = Intervention::all()->where('statut', 'terminee');
        $totalDowntime = 0;
        $nbInterventions = count($interventions);

        foreach ($interventions as $intervention) {
            $start = Carbon::parse($intervention->dateHeureDebut);
            $end = Carbon::parse($intervention->dateHeureFin);
            $totalDowntime += $start->diffInHours($end);
        }

        $mttf = $nbInterventions > 0 ? $totalDowntime / $nbInterventions : 0;

        return round($mttf, 2);
    }
}
