@extends('layouts.form')

@section('title', 'WhoTouchedIt - Modifier intervention planifiée')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Modifier l'intervention planifiée</h2>
            <p class="text-gray-400">Modification de l'intervention #{{ $intervention->idInterventionPlanifiee }}</p>
        </div>
        <a href="{{ route('intervention_planifiee') }}"
           class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>

    <!-- Form Card -->
    <form action="#" method="POST" class="bg-slate-900 border border-slate-800 rounded-xl p-8">
        @csrf
        @method('PUT')

        <!-- toast d'affichage des erreurs lié à la validation des données -->
        @include('components.validationToast')

        <!-- Grid 2 colonnes -->
        <div class="grid grid-cols-2 gap-6">
            <!-- Colonne Gauche -->
            <div class="space-y-6">
                <!-- Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Type d'intervention
                        <span class="text-red-500">*</span>
                    </label>
                    <select
                        name="type"
                        required
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    >
                        <option value="" disabled>Sélectionner un type</option>
                        <option value="preventive" @if($intervention->type == 'preventive') selected @endif>🔵 Préventive</option>
                        <option value="controle_periodique" @if($intervention->type == 'controle_perdiodique') selected @endif>🟣 Contrôle périodique</option>
                        <option value="calibration" @if($intervention->type == 'calibration') selected @endif>🟠 Calibration</option>
                        <option value="amelioration" @if($intervention->type == 'amelioration') selected @endif>🔷 Amélioration</option>
                    </select>
                </div>

                <!-- Statut -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Statut
                        <span class="text-red-500">*</span>
                    </label>
                    <select
                        name="statut"
                        required
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    >
                        <option value="" disabled>Sélectionner un statut</option>
                        <option value="planifiee" @if($intervention->statut == 'planifiee') selected @endif>🟡 Planifiée</option>
                        <option value="en_cours" @if($intervention->statut == 'en_cours') selected @endif>🔵 En cours</option>
                        <option value="terminee" @if($intervention->statut == 'terminee') selected @endif>🟢 Terminée</option>
                        <option value="annulee" @if($intervention->statut == 'annulee') selected @endif>🔴 Annulée</option>
                    </select>
                </div>

                <!-- Fréquence -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Fréquence
                        <span class="text-red-500">*</span>
                    </label>
                    <select
                        name="frequence"
                        required
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    >
                        <option value="" disabled>Sélectionner une fréquence</option>
                        <option value="quotidienne" @if($intervention->frequence == 'quotidienne') selected @endif>🔴 Quotidienne</option>
                        <option value="hebdomadaire" @if($intervention->frequence == 'hebdomadaire') selected @endif>🟠 Hebdomadaire</option>
                        <option value="mensuelle" @if($intervention->frequence == 'mensuelle') selected @endif>🟡 Mensuelle</option>
                        <option value="trimestrielle" @if($intervention->frequence == 'trimestrielle') selected @endif>🟢 Trimestrielle</option>
                        <option value="annuelle" @if($intervention->frequence == 'annuelle') selected @endif>🔵 Annuelle</option>
                        <option value="ponctuelle" @if($intervention->frequence == 'ponctuelle') selected @endif>🟣 Ponctuelle</option>
                    </select>
                </div>

                <!-- Machine -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Machine concernée
                        <span class="text-red-500">*</span>
                    </label>
                    <select
                        name="idMachine"
                        required
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    >
                        <option value="" disabled>Sélectionner une machine</option>
                        @foreach($machines as $machine)
                            <option value="{{ $machine->idMachine }}" @if($machine->idMachine == $intervention->idMachine) selected @endif>
                                {{ $machine->nom }} - {{ $machine->reference }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Description
                    </label>
                    <textarea
                        name="description"
                        rows="4"
                        placeholder="Décrire l'intervention planifiée..."
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition resize-none"
                    >{{ old('description', $intervention->description) }}</textarea>
                    <p class="mt-1 text-xs text-gray-400">Détails sur les tâches à effectuer</p>
                </div>
            </div>

            <!-- Colonne Droite -->
            <div class="space-y-6">
                <!-- Date et heure de début -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Date et heure de début
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="datetime-local"
                        name="dateDebut"
                        value="{{ old('dateDebut', \Carbon\Carbon::parse($intervention->dateDebut)->format('Y-m-d\TH:i')) }}"
                        required
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    >
                    <p class="mt-1 text-xs text-gray-400">
                        <svg class="w-3 h-3 inline text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Début prévu de l'intervention
                    </p>
                </div>

                <!-- Date et heure de fin -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Date et heure de fin
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="datetime-local"
                        name="dateFin"
                        value="{{ old('dateFin', \Carbon\Carbon::parse($intervention->dateFin)->format('Y-m-d\TH:i')) }}"
                        required
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                    >
                    <p class="mt-1 text-xs text-gray-400">
                        <svg class="w-3 h-3 inline text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Fin prévue de l'intervention
                    </p>
                </div>

                <!-- Techniciens (sélection multiple) -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Techniciens assignés
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select
                            name="techniciens[]"
                            multiple
                            required
                            size="8"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        >
                            @php
                                // Liste des IDs des techniciens déjà assignés à cette intervention
                                $selectedTechniciens = [];
                                foreach ($intervention->techniciens as $technicien) {
                                    $selectedTechniciens[] = $technicien->id;
                                }
                            @endphp
                            @foreach($users->where('role', 'technicien') as $user)
                                <option value="{{ $user->id }}"
                                        @if(in_array($user->id, $selectedTechniciens)) selected @endif
                                        class="py-2 hover:bg-slate-700">
                                    👤 {{ $user->name }} {{ $user->prenom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <p class="mt-1 text-xs text-gray-400">
                        <svg class="w-3 h-3 inline text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Maintenez <kbd class="px-1.5 py-0.5 text-xs bg-slate-700 rounded border border-slate-600">Ctrl</kbd> (Windows) ou <kbd class="px-1.5 py-0.5 text-xs bg-slate-700 rounded border border-slate-600">Cmd</kbd> (Mac) pour sélectionner plusieurs techniciens
                    </p>

                    <!-- Liste des techniciens actuellement assignés -->
                    @if($intervention->techniciens->count() > 0)
                        <div class="mt-3 p-3 bg-blue-500/10 border border-blue-500/20 rounded-lg">
                            <p class="text-xs text-blue-400 font-medium mb-2">Techniciens actuellement assignés :</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($intervention->techniciens as $tech)
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 bg-slate-800 border border-slate-700 rounded text-xs text-gray-300">
                                        <svg class="w-3 h-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ $tech->name }} {{ $tech->prenom }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Info Box -->
                <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-yellow-400 mb-1">Attention</h4>
                            <p class="text-xs text-yellow-300/70">
                                La modification de cette intervention peut affecter la planification des techniciens assignés.
                                Assurez-vous qu'ils sont disponibles aux nouvelles dates.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-800">
            <a href="{{ route('intervention_planifiee') }}"
               class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition">
                Annuler
            </a>
            <button
                type="submit"
                class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2 shadow-lg shadow-green-500/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Enregistrer les modifications
            </button>
        </div>
    </form>
@endsection
