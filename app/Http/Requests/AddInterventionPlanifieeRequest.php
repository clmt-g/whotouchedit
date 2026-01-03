<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddInterventionPlanifieeRequest extends FormRequest
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
            'dateDebut' => 'required|date|',
            'dateFin' => 'required|date|after:dateDebut',
            'type' => 'required|in:preventive,controle_periodique,calibration,amelioration',
            'description' => 'nullable|string|max:5000',
            'statut' => 'required|in:planifiee,en_cours,terminee,annulee',
            'frequence' => 'required|in:quotidienne,hebdomadaire,mensuelle,trimestrielle,annuelle,ponctuelle',
            'idMachine' => 'required|integer|exists:machines,idMachine',
            'techniciens' => 'required|array|min:1',
            'techniciens.*' => 'required|integer|exists:users,id',
        ];
    }
}
