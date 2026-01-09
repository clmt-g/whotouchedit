@extends('layouts.form')

@section('title', 'WhoTouchedIt - Detail de la machine')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Détail de la machine</h2>
            <p class="text-gray-400">Informations de la machine</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-8">
        <!-- Grid 2 colonnes -->
        <div class="grid grid-cols-2 gap-6">
            <!-- Colonne Gauche -->
            <div class="space-y-6">
                <!-- Id Machine -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Id de la machine
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="number"
                        name="idMachine"
                        value="{{ $machine->idMachine }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
                    >
                </div>

                <!-- Nom -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Nom de la machine
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="nom"
                        value="{{ $machine->nom }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
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
                        value="{{ $machine->reference }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
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
                        value="{{ $machine->dateInstallation }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
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
                    <input
                        type="text"
                        name="etat"
                        value="{{ $machine->etat }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
                    >
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
                        value="{{ $machine->localisation }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
                    >
                </div>

                <!-- Criticité -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Criticité
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="criticite"
                        value="{{ $machine->criticite }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
                    >
                </div>
            </div>
        </div>

        <!-- Textarea pleine largeur -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-300 mb-2">
                Description / Notes
            </label>
            <textarea
                name="description"
                rows="4"
                placeholder="Informations complémentaires..."
                class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition resize-none"
                readonly
            >{{ $machine->notes ?? '' }}</textarea>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-800">
            <a href="{{ url()->previous() }}"
               class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition">
                Retour
            </a>
            @can('update-machine')
                <a href="{{ route('machine.update', $machine->idMachine) }}"
                   class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modifier
                </a>
            @endcan
        </div>
    </div>
@endsection
