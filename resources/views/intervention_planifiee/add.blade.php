@extends('layouts.form')

@section('title', 'WhoTouchedIt - Nouvelle intervention planifiée')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Nouvelle intervention planifiée</h2>
            <p class="text-gray-400">Planifier une intervention préventive ou de maintenance</p>
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
    <form action="{{ route('intervention_planifiee.do_add') }}" method="POST" class="bg-slate-900 border border-slate-800 rounded-xl p-8">
        @csrf

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
                        <option value="" disabled selected>Sélectionner un type</option>
                        <option value="preventive">🔵 Préventive</option>
                        <option value="controle_periodique">🟣 Contrôle périodique</option>
                        <option value="calibration">🟠 Calibration</option>
                        <option value="amelioration">🔷 Amélioration</option>
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
                        <option value="" disabled selected>Sélectionner un statut</option>
                        <option value="planifiee">🟡 Planifiée</option>
                        <option value="en_cours">🔵 En cours</option>
                        <option value="terminee">🟢 Terminée</option>
                        <option value="annulee">🔴 Annulée</option>
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
                        <option value="" disabled selected>Sélectionner une fréquence</option>
                        <option value="quotidienne">🔴 Quotidienne</option>
                        <option value="hebdomadaire">🟠 Hebdomadaire</option>
                        <option value="mensuelle">🟡 Mensuelle</option>
                        <option value="trimestrielle">🟢 Trimestrielle</option>
                        <option value="annuelle">🔵 Annuelle</option>
                        <option value="ponctuelle">🟣 Ponctuelle</option>
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
                        <option value="" disabled selected>Sélectionner une machine</option>
                        @foreach($machines as $machine)
                            <option value="{{ $machine->idMachine }}">{{ $machine->nom }} - {{ $machine->reference }}</option>
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
                    ></textarea>
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
                            @foreach($users->where('role', 'technicien') as $user)
                                <option value="{{ $user->id }}" class="py-2 hover:bg-slate-700">
                                    👤 {{ $user->nom }} {{ $user->prenom }}
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
                </div>

                <!-- Info Box -->
                <div class="bg-blue-500/10 border border-blue-500/20 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-blue-400 mb-1">À propos des interventions planifiées</h4>
                            <p class="text-xs text-blue-300/70">
                                Les interventions planifiées permettent d'anticiper la maintenance et d'optimiser la disponibilité des machines.
                                Pensez à assigner les techniciens ayant les compétences appropriées.
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
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Créer l'intervention
            </button>
        </div>
    </form>
@endsection
