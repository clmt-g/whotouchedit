@extends('layouts.form')

@section('title', 'WhoTouchedIt - Surveillance & Alertes')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Surveillance & Alertes</h2>
            <p class="text-gray-400">Suivi en temps réel des machines critiques et interventions planifiées</p>
        </div>
        <a href="{{ route('analytique') }}"
           class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>

    <!-- Grid des cartes d'alerte -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

        <!-- Carte: Machines critiques -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-red-500/10 border border-red-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Machines à risque élevé</h3>
                    <p class="text-sm text-gray-400">Machines nécessitant une attention particulière</p>
                </div>
            </div>

            <div class="space-y-2">
                @forelse($riskyMachines as $machine)
                    <div class="flex items-center gap-3 px-4 py-3 bg-red-500/5 border border-red-500/10 rounded-lg hover:bg-red-500/10 transition-colors group">
                        <div class="w-8 h-8 rounded-lg bg-red-500/10 border border-red-500/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="text-sm text-gray-300 font-medium">{{ $machine->nom }}</span>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $machine->localisation }}</p>
                        </div>
                        <span class="text-xs px-2 py-1 bg-red-500/20 text-red-400 rounded-full font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                            Critique
                        </span>
                    </div>
                @empty
                    <div class="flex items-center gap-3 px-4 py-3 bg-green-500/5 border border-green-500/10 rounded-lg">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-green-400 font-medium">Aucune machine à risque critique</span>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Carte: Machines en panne -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-orange-500/10 border border-orange-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Machines hors service</h3>
                    <p class="text-sm text-gray-400">Équipements actuellement en panne</p>
                </div>
            </div>

            <div class="space-y-2">
                @forelse($brokenMachines as $machine)
                    <div class="flex items-center gap-3 px-4 py-3 bg-orange-500/5 border border-orange-500/10 rounded-lg hover:bg-orange-500/10 transition-colors group">
                        <div class="w-8 h-8 rounded-lg bg-orange-500/10 border border-orange-500/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="text-sm text-gray-300 font-medium">{{ $machine->nom }}</span>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $machine->localisation }}</p>
                        </div>
                        <span class="text-xs px-2 py-1 bg-orange-500/20 text-orange-400 rounded-full font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                            En panne
                        </span>
                    </div>
                @empty
                    <div class="flex items-center gap-3 px-4 py-3 bg-green-500/5 border border-green-500/10 rounded-lg">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-green-400 font-medium">Toutes les machines sont opérationnelles</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Carte: Interventions à venir -->
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white">Interventions planifiées</h3>
                <p class="text-sm text-gray-400">Prochaines maintenances et contrôles à effectuer</p>
            </div>
        </div>

        <div class="space-y-2">
            @forelse($nextPlannedInterventions as $inter)
                @php
                    $typeColors = [
                        'preventive' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'border' => 'border-blue-500/20', 'label' => 'Préventive'],
                        'controle_periodique' => ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-400', 'border' => 'border-purple-500/20', 'label' => 'Contrôle'],
                        'calibration' => ['bg' => 'bg-cyan-500/10', 'text' => 'text-cyan-400', 'border' => 'border-cyan-500/20', 'label' => 'Calibration'],
                        'amelioration' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/20', 'label' => 'Amélioration'],
                    ];
                    $color = $typeColors[$inter->type] ?? ['bg' => 'bg-slate-500/10', 'text' => 'text-slate-400', 'border' => 'border-slate-500/20', 'label' => ucfirst($inter->type)];
                    $dateDebut = \Carbon\Carbon::parse($inter->dateDebut);
                @endphp
                <div class="flex items-start gap-3 px-4 py-3 {{ $color['bg'] }} border {{ $color['border'] }} rounded-lg hover:bg-opacity-20 transition-colors">
                    <div class="w-8 h-8 rounded-lg {{ $color['bg'] }} border {{ $color['border'] }} flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 {{ $color['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2 mb-1">
                            <span class="text-sm text-gray-300 font-medium">{{ $inter->description ?? 'Intervention planifiée' }}</span>
                            <span class="text-xs px-2 py-1 {{ $color['bg'] }} {{ $color['text'] }} rounded-full font-medium whitespace-nowrap">
                                {{ $color['label'] }}
                            </span>
                        </div>
                        <div class="flex items-center gap-4 text-xs text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $dateDebut->format('d/m/Y à H:i') }}
                            </span>
                            @if($inter->machine)
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $inter->machine->nom }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex items-center gap-3 px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-lg">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <span class="text-sm text-gray-400 font-medium">Aucune intervention planifiée prochainement</span>
                </div>
            @endforelse
        </div>
    </div>
@endsection
