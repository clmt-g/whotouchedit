@extends('layouts.form')

@section('title', 'WhoTouchedIt - Modifier une intervention')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Modifier une interventions</h2>
            <p class="text-gray-400">Informations de l'intervention</p>
        </div>
    </div>

    <!-- Form Card -->
    <form action="{{ route('intervention.do_update', $intervention->idIntervention) }}" method="POST">

        @method('PUT')
        @csrf

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-8">
            <!-- Grid 2 colonnes -->
            <div class="grid grid-cols-2 gap-6">
                <!-- Colonne Gauche -->
                <div class="space-y-6 flex flex-col h-full">
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
                            required
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
                            required
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
                            required
                        >
                    </div>

                    <!-- Description -->
                    <div class="mt-auto">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea
                            name="description"
                            rows="4"
                            placeholder="Décrire le problème..."
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition resize-none"
                        >{{ $intervention->description ?? '' }}</textarea>
                    </div>
                </div>

                <!-- Colonne Droite -->
                <div class="space-y-6">
                    <!-- Statut -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Statut
                            <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="statut"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required
                        >
                            <option value="">-- Sélectionner --</option>
                            <option value="en_attente" @if( $intervention->statut == 'en_attente') selected @endif>En attente</option>
                            <option value="en_cours" @if( $intervention->statut == 'en_cours') selected @endif>En cours</option>
                            <option value="terminee" @if( $intervention->statut == 'terminee') selected @endif>Terminee</option>
                            <option value="annulee" @if( $intervention->statut == 'annulee') selected @endif>Annulée</option>
                        </select>
                    </div>

                    <!-- machine -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Machine
                            <span class="text-red-500">*</span>
                        </label>
                        <select
                            type="text"
                            name="idMachine"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required
                        >
                            <option value="">-- Séléctionner --</option>
                            @foreach($machines as $machine)
                                <option value="{{ $machine->idMachine }}" @if( $machine->idMachine == $intervention->idMachine) selected @endif>{{ $machine->idMachine }}
                                    : {{ $machine->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- utilisateur -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Utilisateur
                            <span class="text-red-500">*</span>
                        </label>
                        <select
                            type="text"
                            name="idUser"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required
                        >
                            <option value="">-- Séléctionner --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if( $user->id == $intervention->idUser) selected @endif>{{ $user->id }} : {{ $user->nom }} {{ $user->prenom }}</option>
                            @endforeach
                        </select>
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
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Modifier l'intervention
                </button>
            </div>
        </div>
    </form>
@endsection

