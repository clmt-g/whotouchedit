<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterventionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'idIntervention' => 'required|exists:interventions,idIntervention',
            'dateHeureDebut' => 'required|date',
            'dateHeureFin' => 'required|date|after:dateHeureDebut',
            'description' => 'nullable|string|max:5000',
            'statut' => 'required|in:en_attente,en_cours,terminee,annulee',
            'commentaire' => 'nullable|string|max:5000',
            'idMachine' => 'required|exists:machines,idMachine',
            'idUser' => 'required|exists:users,id'
        ];
    }
}
