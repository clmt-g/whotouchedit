<?php

namespace App\Http\Requests;

use App\Models\Intervention;
use App\Rules\NoOverlappingInterventions;
use App\Rules\NoSimultaneousInterventionsByMachine;
use Illuminate\Foundation\Http\FormRequest;

class MoveInterventionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // On récupère l'intervention existante pour avoir la machine et le technicien
        $intervention = Intervention::findOrFail($this->route('id'));

        return [
            'dateHeureDebut' => 'required|date',
            'dateHeureFin'   => 'required|date|after:dateHeureDebut',
            'idMachine' => [
                new NoSimultaneousInterventionsByMachine(
                    $intervention->idMachine,
                    $this->input('dateHeureDebut'),
                    $this->input('dateHeureFin'),
                    $intervention->idIntervention,
                ),
            ],
            'idUser' => [
                new NoOverlappingInterventions(
                    [$intervention->idUser],
                    $this->input('dateHeureDebut'),
                    $this->input('dateHeureFin'),
                    $intervention->idIntervention,
                ),
            ],
        ];
    }

    // On injecte les valeurs manquantes depuis la BDD pour que les rules aient tout ce qu'il faut
    protected function prepareForValidation(): void
    {
        $intervention = Intervention::findOrFail($this->route('id'));

        $this->merge([
            'idMachine' => $intervention->idMachine,
            'idUser'    => $intervention->idUser,
        ]);
    }
}
