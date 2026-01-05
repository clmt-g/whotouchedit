@extends('layouts.app')

@section('title', 'WhoTouchedIt - Dashboard')

@section('content')
    <!-- Page Title -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Tableau de bord</h2>
        <p class="text-gray-400">Vue d'ensemble de votre parc machines et interventions</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-green-500/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-white mb-1">{{ $nbMachines }}</h3>
            <p class="text-sm text-gray-400">Machines opérationnelles</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-orange-500/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-white mb-1">{{ $nbInterEnCours }}</h3>
            <p class="text-sm text-gray-400">Interventions en cours</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-red-500/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-white mb-1">{{ $nbMachinesEnPanne }}</h3>
            <p class="text-sm text-gray-400">Machine en panne</p>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-3 gap-6">
        <!-- Interventions a venir -->
        <div class="col-span-2 bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-white">Interventions a venir</h3>
                <a href="{{ route('planning') }}" class="text-sm text-blue-500 hover:text-blue-400">Voir planning →</a>
            </div>
            <div class="space-y-4">
                {{-- Interventions non planifiées --}}
                @foreach($interventionsNonPassees as $intervention)
                    <a href="{{ route('intervention.detail', $intervention->idIntervention) }}"
                       class="flex items-start gap-4 p-4 bg-slate-800/50 rounded-lg border border-{{ $intervention->statut == 'critique' ? 'red' : 'orange' }}-500/20 hover:border-{{ $intervention->statut == 'critique' ? 'red' : 'orange' }}-500/40 transition">
                        <div
                            class="w-10 h-10 rounded-lg bg-{{ $intervention->statut == 'critique' ? 'red' : 'orange' }}-500/10 flex items-center justify-center flex-shrink-0">
                            <span
                                class="w-2 h-2 bg-{{ $intervention->statut == 'critique' ? 'red' : 'orange' }}-500 rounded-full animate-pulse"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 mb-2">
                                <h4 class="font-medium text-white">{{ $intervention->machine->nom ?? 'Machine inconnue' }}</h4>
                                <span
                                    class="text-xs text-{{ $intervention->statut == 'critique' ? 'red' : 'orange' }}-400 bg-{{ $intervention->statut == 'critique' ? 'red' : 'orange' }}-500/10 px-2 py-1 rounded whitespace-nowrap">
                        {{ strtoupper($intervention->statut) }}
                    </span>
                            </div>
                            <p class="text-sm text-gray-400 mb-2">{{ $intervention->description }}</p>
                            <div class="flex items-center gap-4 text-xs text-gray-500">
                                <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ \Carbon\Carbon::parse($intervention->dateHeureDebut)->format('d/m/Y H:i') }}
                    </span>
                            </div>
                        </div>
                    </a>
                @endforeach

                {{-- Interventions planifiées --}}
                @foreach($interventionPlanifieesNonPassees as $interventionPlanifiee)
                    <a href="{{ route('intervention_planifiee.detail', $interventionPlanifiee->idInterventionPlanifiee) }}"
                        class="flex items-start gap-4 p-4 bg-slate-800/50 rounded-lg border border-blue-500/20 hover:border-blue-500/40 transition">
                        <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center flex-shrink-0">
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 mb-2">
                                <h4 class="font-medium text-white">{{ $interventionPlanifiee->machine->nom ?? 'Machine inconnue' }}</h4>
                                <span class="text-xs text-blue-400 bg-blue-500/10 px-2 py-1 rounded whitespace-nowrap">PLANIFIÉE</span>
                            </div>
                            <p class="text-sm text-gray-400 mb-2">{{ $interventionPlanifiee->description }}
                                - {{ $interventionPlanifiee->type }}</p>
                            <div class="flex items-center gap-4 text-xs text-gray-500">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ \Carbon\Carbon::parse($interventionPlanifiee->dateDebut)->format('d/m/Y H:i') }}
                    </span>
                            </div>
                        </div>
                    </a>
                @endforeach

                @if($interventionsNonPassees->isEmpty() && $interventionPlanifieesNonPassees->isEmpty())
                    <p class="text-gray-400 text-center py-8">Aucune intervention à venir</p>
                @endif
            </div>
        </div>

        <!-- État du parc machines -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-white">Interventions a venir</h3>
                <a href="{{ route('machine') }}" class="text-sm text-blue-500 hover:text-blue-400">Voir planning →</a>
            </div>
            <h3 class="text-lg font-bold text-white mb-6">État du parc</h3>

            <div class="space-y-4">
                {{-- Opérationnelles --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-400">Opérationnelles</span>
                        <span class="text-sm font-medium text-white">{{ number_format($op, 1) }}%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-green-500 rounded-full transition-all duration-300" style="width: {{ $op }}%"></div>
                    </div>
                </div>

                {{-- En maintenance --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-400">En maintenance</span>
                        <span class="text-sm font-medium text-white">{{ number_format($maintenance, 1) }}%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-orange-500 rounded-full transition-all duration-300" style="width: {{ $maintenance }}%"></div>
                    </div>
                </div>

                {{-- Maintenance planifiée --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-400">Maintenance planifiée</span>
                        <span class="text-sm font-medium text-white">{{ number_format($planifiee, 1) }}%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-500 rounded-full transition-all duration-300" style="width: {{ $planifiee }}%"></div>
                    </div>
                </div>

                {{-- En panne --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-400">En panne</span>
                        <span class="text-sm font-medium text-white">{{ number_format($panne, 1) }}%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-red-500 rounded-full transition-all duration-300" style="width: {{ $panne }}%"></div>
                    </div>
                </div>

                {{-- Hors service --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-400">Hors service</span>
                        <span class="text-sm font-medium text-white">{{ number_format($hs, 1) }}%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-gray-500 rounded-full transition-all duration-300" style="width: {{ $hs }}%"></div>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-slate-800">
                <h4 class="text-sm font-medium text-white mb-3">Criticité</h4>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                            <span class="text-sm text-gray-400">Critique</span>
                        </div>
                        <span class="text-sm font-medium text-white">{{ $critique }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                            <span class="text-sm text-gray-400">Moyen</span>
                        </div>
                        <span class="text-sm font-medium text-white">{{ $moyen }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            <span class="text-sm text-gray-400">Faible</span>
                        </div>
                        <span class="text-sm font-medium text-white">{{ $faible }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
