@extends('layouts.form')

@section('title', 'WhoTouchedIt - Modifier l\'état de la machine')

@section('content')
<!-- Header -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="text-3xl font-bold text-white mb-2">Modifier l'état de la machine</h2>
        <p class="text-gray-400">{{ $machine->nom }} - {{ $machine->reference }}</p>
    </div>
    <a href="{{ route('machine.detail', $machine->idMachine) }}"
       class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Retour
    </a>
</div>

<!-- Form Card -->
<form action="{{ route('machine.do_update_etat', $machine->idMachine) }}" method="POST">

    <!-- method PUT -->
    @method('PUT')
    <!-- CSRF token-->
    @csrf

    <!-- toast d'affichage des erreurs lié à la validation des données -->
    @include('components.validationToast')

    <div class="bg-slate-900 border border-slate-800 rounded-xl p-8">

        <!-- Informations de la machine (lecture seule) -->
        <div class="bg-slate-800/50 rounded-lg p-6 mb-6 border border-slate-700">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Informations de la machine
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-400">Nom</p>
                    <p class="text-white font-medium">{{ $machine->nom }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Référence</p>
                    <p class="text-white font-medium">{{ $machine->reference }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Localisation</p>
                    <p class="text-white font-medium">{{ $machine->localisation }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">État actuel</p>
                    <p class="text-white font-medium">
                        @if($machine->etat == 'opérationnelle')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold text-green-300 bg-green-500/20 rounded-lg border border-green-500/30">
                                    <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                    Opérationnelle
                                </span>
                        @elseif($machine->etat == 'en_maintenance')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold text-blue-300 bg-blue-500/20 rounded-lg border border-blue-500/30">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full"></span>
                                    En maintenance
                                </span>
                        @elseif($machine->etat == 'planifiée')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold text-yellow-300 bg-yellow-500/20 rounded-lg border border-yellow-500/30">
                                    <span class="w-2 h-2 bg-yellow-400 rounded-full"></span>
                                    Planifiée
                                </span>
                        @elseif($machine->etat == 'en_panne')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold text-orange-300 bg-orange-500/20 rounded-lg border border-orange-500/30">
                                    <span class="w-2 h-2 bg-orange-400 rounded-full"></span>
                                    En panne
                                </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold text-red-300 bg-red-500/20 rounded-lg border border-red-500/30">
                                    <span class="w-2 h-2 bg-red-400 rounded-full"></span>
                                    Hors service
                                </span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Formulaire de modification d'état -->
        <div class="space-y-6">
            <!-- Nouvel État -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Nouvel état
                    <span class="text-red-500">*</span>
                </label>
                <select
                    name="etat"
                    class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    required
                >
                    <option value="">-- Sélectionner un état --</option>
                    <option value="opérationnelle" @if($machine->etat == 'opérationnelle') selected @endif>Opérationnelle</option>
                    <option value="en_maintenance" @if($machine->etat == 'en_maintenance') selected @endif>En maintenance</option>
                    <option value="planifiée" @if($machine->etat == 'planifiée') selected @endif>Planifiée</option>
                    <option value="en_panne" @if($machine->etat == 'en_panne') selected @endif>En panne</option>
                    <option value="hors_service" @if($machine->etat == 'hors_service') selected @endif>Hors service</option>
                </select>
                <p class="mt-2 text-xs text-gray-400">
                    Sélectionnez le nouvel état de la machine
                </p>
            </div>
        </div>

        <!-- Message d'information -->
        <div class="mt-6 bg-blue-500/10 border border-blue-500/30 rounded-lg p-4">
            <div class="flex gap-3">
                <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-sm font-medium text-blue-300 mb-1">Information importante</p>
                    <p class="text-sm text-blue-200/80">
                        La modification de l'état sera enregistrée avec votre nom d'utilisateur et l'horodatage.
                        Cette action est irréversible mais sera visible dans l'historique.
                    </p>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-800">
            <a href="{{ route('machine.detail', $machine->idMachine) }}"
               class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition">
                Annuler
            </a>
            <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Confirmer le changement
            </button>
        </div>
    </div>
</form>
@endsection
