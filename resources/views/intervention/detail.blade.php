@extends('layouts.form')

@section('title', 'WhoTouchedIt - Detail des interventions')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Détail des interventions</h2>
            <p class="text-gray-400">Informations de l'intervention</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-8">
        <!-- Grid 2 colonnes -->
        <div class="grid grid-cols-2 gap-6">
            <!-- Colonne Gauche -->
            <div class="space-y-6">
                <!-- Id intervention -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Id de l'intervention
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="number"
                        name="idIntervention"
                        value="{{ $intervention->idIntervention }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
                    >
                </div>

                <!-- Heure debut -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Date/heure debut
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="datetime-local"
                        name="dateHeureDebut"
                        value="{{ $intervention->dateHeureDebut }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
                    >
                </div>

                <!-- Date heure fin -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Date/heure fin
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="datetime-local"
                        name="dateHeureFin"
                        value="{{ $intervention->dateHeureFin }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
                    >
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Description
                    </label>
                    <textarea
                        name="description"
                        rows="4"
                        placeholder="Décrire le problème..."
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition resize-none"
                        readonly
                    >{{ $intervention->description ?? '' }}</textarea>
                </div>
            </div>

            <!-- Colonne Droite -->
            <div class="space-y-6">
                <!-- status -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Status
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="statut"
                        value="{{ $intervention->statut }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
                    >
                </div>

                <!-- machine -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Machine
                        <span class="text-red-500">*</span>
                    </label>
                    <a href="{{ route('machine.detail', $intervention->idMachine) }}"
                       class="block group">
                        <div class="w-full bg-slate-800 px-4 py-2.5 rounded-lg border border-slate-700 hover:border-purple-500 transition-all duration-200 cursor-pointer group-hover:bg-slate-750">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center group-hover:bg-purple-500/20 transition-colors">
                                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                        </svg>
                                    </div>
                                    <span class="text-white font-medium">{{ $intervention->machine->nom }}</span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-400 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <p class="mt-1 text-xs text-gray-400">Cliquez pour voir les détails de la machine</p>
                </div>

                <!-- utilisateur -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Utilisateur
                        <span class="text-red-500">*</span>
                    </label>
                    <a href="#"
                       class="block group">
                        <div class="w-full bg-slate-800 px-4 py-2.5 rounded-lg border border-slate-700 hover:border-blue-500 transition-all duration-200 cursor-pointer group-hover:bg-slate-750">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center group-hover:bg-blue-500/20 transition-colors">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <span class="text-white font-medium">{{ $intervention->user->nom }} {{ $intervention->user->prenom }}</span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-400 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <p class="mt-1 text-xs text-gray-400">Cliquez pour voir le profil de l'utilisateur</p>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Commentaire
                    </label>
                    <textarea
                        name="commentaire"
                        rows="4"
                        placeholder="Informations complémentaires..."
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition resize-none"
                        readonly
                    >{{ $intervention->commentaire ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-800">
            <a href="{{ url()->previous() }}"
               class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition">
                Retour
            </a>
            <a href="{{ route('intervention.update', $intervention->idIntervention) }}"
               class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Modifier
            </a>
        </div>
    </div>
@endsection
