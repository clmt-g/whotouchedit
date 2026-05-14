<?php

/**
 * vérifie que la machine n'a pas déjà une intervention sur ce créneau
 */

namespace App\Rules;

use App\Models\Intervention;
use App\Models\InterventionPlanifiee;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoSimultaneousInterventionsByMachine implements ValidationRule
{
    private $dateDebut;
    private $dateFin;
    private $machineId;
    private $interventionId;

    public function __construct($machineId, $dateDebut, $dateFin, $interventionId = null)
    {
        $this->machineId = $machineId;
        $this->dateDebut = $dateDebut ? Carbon::parse($dateDebut) : null;
        $this->dateFin = $dateFin ? Carbon::parse($dateFin) : null;
        $this->interventionId = $interventionId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $interventions = Intervention::all();
        foreach ($interventions as $intervention) {
            $dateFinIntervention = Carbon::parse($intervention->dateHeureFin);
            $dateDebutIntervention = Carbon::parse($intervention->dateHeureDebut);

            if (
                (
                    ($this->dateDebut >= $dateDebutIntervention && $this->dateDebut <= $dateFinIntervention) || // dateDebut dans l'intervention
                    ($this->dateFin >= $dateDebutIntervention && $this->dateFin <= $dateFinIntervention) || // dateFin dans l'intervention
                    ($this->dateDebut <= $dateDebutIntervention && $this->dateFin >= $dateFinIntervention) // nouvelle intervention englobe complètement l'existante
                ) &&
                ($this->machineId == $intervention->idMachine) &&
                ($this->interventionId === null || $this->interventionId != $intervention->idIntervention) // Exclude current intervention if updating
            ) {
                $fail('La machine a déjà une intervention pendant cette période.');
                return;
            }
        }

        $interventionsPlanifiees = InterventionPlanifiee::all();
        foreach ($interventionsPlanifiees as $interventionPlanifiee) {
            $dateFinIntervention = Carbon::parse($interventionPlanifiee->dateHeureFin);
            $dateDebutIntervention = Carbon::parse($interventionPlanifiee->dateHeureDebut);

            if (
                (
                    ($this->dateDebut >= $dateDebutIntervention && $this->dateDebut <= $dateFinIntervention) || // dateDebut dans l'intervention
                    ($this->dateFin >= $dateDebutIntervention && $this->dateFin <= $dateFinIntervention) || // dateFin dans l'intervention
                    ($this->dateDebut <= $dateDebutIntervention && $this->dateFin >= $dateFinIntervention) // nouvelle intervention englobe complètement l'existante
                ) &&
                ($this->machineId == $intervention->idMachine) &&
                ($this->interventionId === null || $this->interventionId != $intervention->idIntervention) // Exclude current intervention if updatin
            ) {
                $fail('La machine a déjà une intervention planifiée pendant cette période.');
                return;
            }
        }
    }
}
