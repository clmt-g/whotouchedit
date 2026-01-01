@extends('layouts.form')

@section('title', 'WhoTouchedIt - Ajouter une machine')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Détail de la machine</h2>
            <p class="text-gray-400">Informations de la machine</p>
        </div>
        <a href="{{ route('machine') }}"
           class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>

    <!-- Form Card -->
    <form action="{{ route('machine.do_add') }}" method="POST">

        <!-- CSRF token -->
        @csrf

        <!-- toast d'affichage des erreurs lié à la validation des données -->
        @include('components.validationToast')

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-8">
            <!-- Grid 2 colonnes -->
            <div class="grid grid-cols-2 gap-6">
                <!-- Colonne Gauche -->
                <div class="space-y-6">

                    <!-- Nom -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Nom de la machine
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="nom"
                            placeholder="Ex: Robot de soudure RS-200"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required
                        >
                    </div>

                    <!-- Référence -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Référence
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="reference"
                            placeholder="CNC-2024-002"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required
                        >
                    </div>

                    <!-- Date installation -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Date d'installation
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="date"
                            name="dateInstallation"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required
                        >
                    </div>
                </div>

                <!-- Colonne Droite -->
                <div class="space-y-6">
                    <!-- État -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            État
                            <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="etat"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required
                        >
                            <option value="">-- Sélectionner --</option>
                            <option value="opérationnelle">Opérationnelle</option>
                            <option value="en_maintenance">En maintenance</option>
                            <option value="planifiée">Planifiée</option>
                            <option value="en_panne">En panne</option>
                            <option value="hors_service">Hors service</option>
                        </select>
                    </div>

                    <!-- Localisation -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Localisation
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="localisation"
                            placeholder="Local technique"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required
                        >
                    </div>

                    <!-- Criticité -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Criticité
                            <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="criticite"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required
                        >
                            <option value="">-- Sélectionner --</option>
                            <option value="faible">Faible</option>
                            <option value="moyen">Moyen</option>
                            <option value="critique">Critique</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Textarea pleine largeur -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Description / Notes
                </label>
                <textarea
                    name="notes"
                    rows="4"
                    placeholder="Informations complémentaires..."
                    class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition resize-none"
                ></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-800">
                <a href="{{ route('machine') }}"
                   class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition">
                    Retour
                </a>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Créer la machine
                </button>
            </div>
        </div>
    </form>
@endsection
