@extends('layouts.form')

@section('title', 'WhoTouchedIt - Analytique Machines')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Analytique Machines</h2>
            <p class="text-gray-400">Vue d'ensemble du parc machines et des interventions</p>
        </div>
        <a href="{{ route('analytique') }}"
           class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>

    <!-- Grid des cartes principales -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

        <!-- Carte: Interventions par machine -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-green-500/10 border border-green-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Interventions par machine</h3>
                    <p class="text-sm text-gray-400">Nombre total d'interventions effectuées</p>
                </div>
            </div>

            <div class="space-y-3">
                @forelse($nbInterPerMachines as $nom => $nbInter)
                    @php
                        $max = max($nbInterPerMachines);
                        $percentage = $max > 0 ? ($nbInter / $max) * 100 : 0;
                    @endphp
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm text-gray-300 font-medium">{{ $nom }}</span>
                            <span class="text-sm text-green-400 font-bold">{{ $nbInter }}</span>
                        </div>
                        <div class="w-full bg-slate-800 rounded-full h-2">
                            <div class="bg-gradient-to-r from-green-500 to-green-400 h-2 rounded-full transition-all duration-500"
                                 style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 italic">Aucune intervention enregistrée</p>
                @endforelse
            </div>
        </div>

        <!-- Carte: Maintenances en retard -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-orange-500/10 border border-orange-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Maintenances en retard</h3>
                    <p class="text-sm text-gray-400">Interventions préventives à planifier</p>
                </div>
            </div>

            <div class="space-y-2">
                @forelse($machinesWithInterEnRetard as $machine)
                    <div class="flex items-center gap-3 px-4 py-3 bg-orange-500/5 border border-orange-500/10 rounded-lg hover:bg-orange-500/10 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-orange-500/10 border border-orange-500/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                        <span class="text-sm text-gray-300 font-medium">{{ $machine->nom }}</span>
                        <span class="ml-auto text-xs px-2 py-1 bg-orange-500/20 text-orange-400 rounded-full font-medium">En retard</span>
                    </div>
                @empty
                    <div class="flex items-center gap-3 px-4 py-3 bg-green-500/5 border border-green-500/10 rounded-lg">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-green-400 font-medium">Toutes les maintenances sont à jour</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Grid des statistiques en bas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Carte: État du parc -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">État du parc machine</h3>
                    <p class="text-sm text-gray-400">Répartition par état opérationnel</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                @php
                    $etatColors = [
                        'opérationnel' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/20'],
                        'en_maintenance' => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20'],
                        'en_panne' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/20'],
                        'hors_service' => ['bg' => 'bg-gray-500/10', 'text' => 'text-gray-400', 'border' => 'border-gray-500/20'],
                    ];
                @endphp
                @forelse($etatParc as $etat => $pourcentage)
                    @php
                        $color = $etatColors[$etat] ?? ['bg' => 'bg-slate-500/10', 'text' => 'text-slate-400', 'border' => 'border-slate-500/20'];
                    @endphp
                    <div class="px-4 py-4 {{ $color['bg'] }} border {{ $color['border'] }} rounded-lg">
                        <div class="text-2xl font-bold {{ $color['text'] }} mb-1">{{ number_format($pourcentage, 1) }}%</div>
                        <div class="text-xs text-gray-400 font-medium">{{ ucfirst(str_replace('_', ' ', $etat)) }}</div>
                    </div>
                @empty
                    <p class="col-span-2 text-sm text-gray-500 italic">Aucune donnée disponible</p>
                @endforelse
            </div>
        </div>

        <!-- Carte: Criticité -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-red-500/10 border border-red-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Répartition par criticité</h3>
                    <p class="text-sm text-gray-400">Niveau d'importance des machines</p>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                @php
                    $criticiteColors = [
                        'faible' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/20'],
                        'moyenne' => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20'],
                        'élevée' => ['bg' => 'bg-orange-500/10', 'text' => 'text-orange-400', 'border' => 'border-orange-500/20'],
                        'critique' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/20'],
                    ];
                @endphp
                @forelse($avgCriticite as $criticite => $pourcentage)
                    @php
                        $color = $criticiteColors[$criticite] ?? ['bg' => 'bg-slate-500/10', 'text' => 'text-slate-400', 'border' => 'border-slate-500/20'];
                    @endphp
                    <div class="px-4 py-4 {{ $color['bg'] }} border {{ $color['border'] }} rounded-lg text-center">
                        <div class="text-2xl font-bold {{ $color['text'] }} mb-1">{{ number_format($pourcentage, 1) }}%</div>
                        <div class="text-xs text-gray-400 font-medium">{{ ucfirst($criticite) }}</div>
                    </div>
                @empty
                    <p class="col-span-3 text-sm text-gray-500 italic">Aucune donnée disponible</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
