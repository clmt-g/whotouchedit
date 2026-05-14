<?php

/**
 * vérifie qu'aucun technicien assigné n'a déjà une intervention sur le créneau demandé
 */

namespace App\Rules;

use App\Models\Intervention;
use Carbon\Carbon;
use Closure;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;

class NoOverlappingInterventions implements ValidationRule
{
    private array $technicienIds;
    private $dateDebut;
    private $dateFin;
    private $interventionId;

    public function __construct(array $technicienIds, $dateDebut, $dateFin, $interventionId = null)
    {
        $this->technicienIds = $technicienIds;
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
        if (!$this->dateDebut || !$this->dateFin) {
            return;
        }

        foreach ($this->technicienIds as $technicienId) {

            $user = User::find($technicienId);
            if (!$user) {
                $fail('Un ou plusieurs techniciens n\'ont pas été trouvés.');
                return;
            }

            $interventions = $user->interventions;

            foreach ($interventions as $intervention) {
                $dateFinIntervention = Carbon::parse($intervention->dateHeureFin);
                $dateDebutIntervention = Carbon::parse($intervention->dateHeureDebut);

                if(
                    (
                        ($this->dateDebut >= $dateDebutIntervention && $this->dateDebut <= $dateFinIntervention) || // dateDebut dans l'intervention
                        ($this->dateFin >= $dateDebutIntervention && $this->dateFin <= $dateFinIntervention) || // dateFin dans l'intervention
                        ($this->dateDebut <= $dateDebutIntervention && $this->dateFin >= $dateFinIntervention) // nouvelle intervention englobe complètement l'existante
                    ) &&
                    ($this->interventionId === null || $this->interventionId != $intervention->idIntervention) // Exclude current intervention if updating
                ) {
                    $fail('Un des techniciens a déjà une intervention planifiée pendant cette période.');
                    return;
                }
            }

            $interventionsPlanifiees = $user->interventionsPlanifiees;

            foreach ($interventionsPlanifiees as $intervention) {
                $dateDebutIntervention = Carbon::parse($intervention->dateDebut);
                $dateFinIntervention = Carbon::parse($intervention->dateFin);

                if(
                    (
                        ($this->dateDebut >= $dateDebutIntervention && $this->dateDebut <= $dateFinIntervention) || // dateDebut dans l'intervention
                        ($this->dateFin >= $dateDebutIntervention && $this->dateFin <= $dateFinIntervention) || // dateFin dans l'intervention
                        ($this->dateDebut <= $dateDebutIntervention && $this->dateFin >= $dateFinIntervention) // nouvelle intervention englobe complètement l'existante
                    ) &&
                    ($this->interventionId === null || $this->interventionId != $intervention->idInterventionPlanifiee) // Exclude current intervention if updating
                ) {
                    $fail('Un des techniciens a déjà une intervention planifiée pendant cette période.');
                    return;
                }
            }
        }
    }
}
