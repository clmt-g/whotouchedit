@extends('layouts.form')

@section('title', 'WhoTouchedIt - Détail de l\'intervention planifiée')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Détail de l'intervention planifiée</h2>
            <p class="text-gray-400">Informations complètes de l'intervention</p>
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
                        ID de l'intervention
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        value="{{ $intervention->idInterventionPlanifiee }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 font-mono"
                        readonly
                    >
                </div>

                <!-- Type avec badge -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Type d'intervention
                        <span class="text-red-500">*</span>
                    </label>
                    @php
                        $typeConfig = [
                            'preventive' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'border' => 'border-blue-500/20', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                            'controle_periodique' => ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-400', 'border' => 'border-purple-500/20', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                            'calibration' => ['bg' => 'bg-orange-500/10', 'text' => 'text-orange-400', 'border' => 'border-orange-500/20', 'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'],
                            'amelioration' => ['bg' => 'bg-cyan-500/10', 'text' => 'text-cyan-400', 'border' => 'border-cyan-500/20', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                        ];
                        $typeStyle = $typeConfig[$intervention->type] ?? $typeConfig['preventive'];
                    @endphp
                    <div class="w-full bg-slate-800 px-4 py-2.5 rounded-lg border border-slate-700">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $typeStyle['bg'] }} {{ $typeStyle['border'] }} {{ $typeStyle['text'] }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $typeStyle['icon'] }}"/>
                            </svg>
                            <span class="text-sm font-medium">{{ ucfirst(str_replace('_', ' ', $intervention->type)) }}</span>
                        </span>
                    </div>
                </div>

                <!-- Statut avec badge -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Statut
                        <span class="text-red-500">*</span>
                    </label>
                    @php
                        $statutConfig = [
                            'planifiee' => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                            'en_cours' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'border' => 'border-blue-500/20', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                            'terminee' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/20', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                            'annulee' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/20', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ];
                        $statutStyle = $statutConfig[$intervention->statut] ?? $statutConfig['planifiee'];
                    @endphp
                    <div class="w-full bg-slate-800 px-4 py-2.5 rounded-lg border border-slate-700">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $statutStyle['bg'] }} {{ $statutStyle['border'] }} {{ $statutStyle['text'] }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $statutStyle['icon'] }}"/>
                            </svg>
                            <span class="text-sm font-medium">{{ ucfirst(str_replace('_', ' ', $intervention->statut)) }}</span>
                        </span>
                    </div>
                </div>

                <!-- Fréquence avec badge -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Fréquence
                        <span class="text-red-500">*</span>
                    </label>
                    @php
                        $frequenceConfig = [
                            'quotidienne' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/20', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                            'hebdomadaire' => ['bg' => 'bg-orange-500/10', 'text' => 'text-orange-400', 'border' => 'border-orange-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                            'mensuelle' => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                            'trimestrielle' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                            'annuelle' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'border' => 'border-blue-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                            'ponctuelle' => ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-400', 'border' => 'border-purple-500/20', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
                        ];
                        $freqStyle = $frequenceConfig[$intervention->frequence] ?? $frequenceConfig['ponctuelle'];
                    @endphp
                    <div class="w-full bg-slate-800 px-4 py-2.5 rounded-lg border border-slate-700">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $freqStyle['bg'] }} {{ $freqStyle['border'] }} {{ $freqStyle['text'] }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $freqStyle['icon'] }}"/>
                            </svg>
                            <span class="text-sm font-medium">{{ ucfirst($intervention->frequence) }}</span>
                        </span>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Description
                    </label>
                    <textarea
                        rows="4"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition resize-none"
                        readonly
                    >{{ $intervention->description ?? '' }}</textarea>
                </div>
            </div>

            <!-- Colonne Droite -->
            <div class="space-y-6">
                <!-- Heure debut -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Date et heure de début
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center gap-2 w-full bg-slate-800 px-4 py-2.5 rounded-lg border border-slate-700">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-white font-medium">{{ \Carbon\Carbon::parse($intervention->dateDebut)->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>

                <!-- Date heure fin -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Date et heure de fin
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center gap-2 w-full bg-slate-800 px-4 py-2.5 rounded-lg border border-slate-700">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-white font-medium">{{ \Carbon\Carbon::parse($intervention->dateFin)->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>

                <!-- Machine -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Machine concernée
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

                <!-- Techniciens assignés -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Techniciens assignés
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="w-full bg-slate-800 px-4 py-3 rounded-lg border border-slate-700">
                        <div class="flex flex-col gap-2">
                            @forelse($intervention->techniciens as $technicien)
                                <a @if($technicien->id == Auth::user()->id) href="{{ route('user.detail', $technicien->id )}}" @endif
                                   class="inline-flex items-center gap-2 px-3 py-2 bg-slate-900 border border-slate-700 rounded-lg hover:border-blue-500 hover:bg-slate-800 transition-all group">
                                    <div class="w-7 h-7 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-300 group-hover:text-white font-medium transition-colors">
                                        {{ $technicien->nom }} {{ $technicien->prenom }}
                                    </span>
                                    <svg class="w-4 h-4 text-gray-500 group-hover:text-blue-400 ml-auto transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @empty
                                <span class="text-sm text-gray-500 italic">Aucun technicien assigné</span>
                            @endforelse
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-400">Cliquez sur un technicien pour voir son profil</p>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-800">
            <a href="{{ url()->previous() }}"
               class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition">
                Retour
            </a>
            @can('update-intervention-planifiee')
                <a href="{{ route('intervention_planifiee.update', $intervention->idInterventionPlanifiee) }}"
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
