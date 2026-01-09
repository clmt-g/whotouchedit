@extends('layouts.form')

@section('title', 'WhoTouchedIt - Modifier le statut de l\'intervention')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Modifier le statut de l'intervention</h2>
            <p class="text-gray-400">Intervention #{{ $intervention->idInterventionPlanifiee }}</p>
        </div>
    </div>

    <!-- Form Card -->
    <form action="{{ route('intervention_planifiee.do_update_statut', $intervention->idInterventionPlanifiee) }}" method="POST">

        <!-- method PUT -->
        @method('PUT')
        <!-- CSRF token-->
        @csrf

        <!-- toast d'affichage des erreurs lié à la validation des données -->
        @include('components.validationToast')

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-8">

            <!-- Informations de l'intervention (lecture seule) -->
            <div class="bg-slate-800/50 rounded-lg p-6 mb-6 border border-slate-700">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Informations de l'intervention
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-400">Type</p>
                        <p class="text-white font-medium">
                            @if($intervention->type == 'preventive')
                                🔵 Préventive
                            @elseif($intervention->type == 'controle_periodique')
                                🟣 Contrôle périodique
                            @elseif($intervention->type == 'calibration')
                                🟠 Calibration
                            @else
                                🔷 Amélioration
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Machine</p>
                        <p class="text-white font-medium">{{ $intervention->machine->nom ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Date de début</p>
                        <p class="text-white font-medium">{{ \Carbon\Carbon::parse($intervention->dateDebut)->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Date de fin</p>
                        <p class="text-white font-medium">{{ \Carbon\Carbon::parse($intervention->dateFin)->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm text-gray-400">Statut actuel</p>
                        <p class="text-white font-medium mt-1">
                            @if($intervention->statut == 'planifiee')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold text-yellow-300 bg-yellow-500/20 rounded-lg border border-yellow-500/30">
                                    <span class="w-2 h-2 bg-yellow-400 rounded-full"></span>
                                    Planifiée
                                </span>
                            @elseif($intervention->statut == 'en_cours')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold text-blue-300 bg-blue-500/20 rounded-lg border border-blue-500/30">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full"></span>
                                    En cours
                                </span>
                            @elseif($intervention->statut == 'terminee')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold text-green-300 bg-green-500/20 rounded-lg border border-green-500/30">
                                    <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                    Terminée
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold text-red-300 bg-red-500/20 rounded-lg border border-red-500/30">
                                    <span class="w-2 h-2 bg-red-400 rounded-full"></span>
                                    Annulée
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Formulaire de modification du statut -->
            <div class="space-y-6">
                <!-- Nouveau Statut -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Nouveau statut
                        <span class="text-red-500">*</span>
                    </label>
                    <select
                        name="statut"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        required
                    >
                        <option value="">-- Sélectionner un statut --</option>
                        <option value="planifiee" @if($intervention->statut == 'planifiee') selected @endif>🟡 Planifiée</option>
                        <option value="en_cours" @if($intervention->statut == 'en_cours') selected @endif>🔵 En cours</option>
                        <option value="terminee" @if($intervention->statut == 'terminee') selected @endif>🟢 Terminée</option>
                        <option value="annulee" @if($intervention->statut == 'annulee') selected @endif>🔴 Annulée</option>
                    </select>
                    <p class="mt-2 text-xs text-gray-400">
                        Sélectionnez le nouveau statut de l'intervention planifiée
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
                        <p class="text-sm font-medium text-blue-300 mb-1">Information</p>
                        <p class="text-sm text-blue-200/80">
                            La modification du statut sera enregistrée avec votre nom et l'horodatage.
                            Cette action est visible dans l'historique de l'intervention.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-800">
                <a href="{{ url()->previous() }}"
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
