<?php

namespace App\Http\Requests;

use App\Models\InterventionPlanifiee;
use App\Rules\NoOverlappingInterventions;
use App\Rules\NoSimultaneousInterventionsByMachine;
use Illuminate\Foundation\Http\FormRequest;

class MoveInterventionPlanifieeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $intervention = InterventionPlanifiee::findOrFail($this->route('id'));

        // Récupère les IDs des techniciens assignés
        $technicienIds = $intervention->techniciens->pluck('id')->toArray();

        return [
            'dateDebut' => 'required|date',
            'dateFin'   => 'required|date|after:dateDebut',
            'idMachine' => [
                new NoSimultaneousInterventionsByMachine(
                    $intervention->idMachine,
                    $this->input('dateDebut'),
                    $this->input('dateFin'),
                    $intervention->idInterventionPlanifiee,
                ),
            ],
            'techniciens' => [
                new NoOverlappingInterventions(
                    $technicienIds,
                    $this->input('dateDebut'),
                    $this->input('dateFin'),
                    $intervention->idInterventionPlanifiee,
                ),
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $intervention = InterventionPlanifiee::findOrFail($this->route('id'));

        $this->merge([
            'idMachine'   => $intervention->idMachine,
            'techniciens' => $intervention->techniciens->pluck('id')->toArray(),
        ]);
    }
}
