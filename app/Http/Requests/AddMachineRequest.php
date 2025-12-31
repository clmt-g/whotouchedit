<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMachineRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'reference' => 'required|string|unique:machines,reference',
            'dateInstallation' => 'required|date',
            'etat' => 'required|in:opérationnelle,en_maintenance,planifiée,en_panne,hors_service',
            'criticite' => 'required|in:faible,moyen,critique',
            'localisation' => 'required|string|max:255',
            'notes' => 'nullable|string|max:5000',
        ];
    }
}
