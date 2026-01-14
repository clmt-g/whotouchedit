<?php

namespace App\Http\Requests;

use App\Rules\NoOverlappingInterventions;
use App\Rules\NoSimultaneousInterventionsByMachine;
use Illuminate\Foundation\Http\FormRequest;

class AddInterventionPlanifieeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after:dateDebut',
            'type' => 'required|in:preventive,controle_periodique,calibration,amelioration',
            'description' => 'nullable|string|max:5000',
            'statut' => 'required|in:planifiee,en_cours,terminee,annulee',
            'frequence' => 'required|in:quotidienne,hebdomadaire,mensuelle,trimestrielle,annuelle,ponctuelle',
            'idMachine' => [
                'required',
                'exists:machines,idMachine',
                new noSimultaneousInterventionsByMachine(
                    $this->input('idMachine'),
                    $this->input('dateHeureDebut'),
                    $this->input('dateHeureFin'),
                    null
                ),
            ],
            'techniciens' => [
                'required',
                'array',
                'min:1',
                new NoOverlappingInterventions(
                    $this->input('techniciens'),
                    $this->input('dateDebut'),
                    $this->input('dateFin'),
                    null
                ),
            ],
            'techniciens.*' => 'required|exists:users,id',
        ];
    }
}
