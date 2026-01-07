@extends('layouts.form')

@section('title', 'WhoTouchedIt - Performance Techniciens')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Performance Techniciens</h2>
            <p class="text-gray-400">Analyse de la productivité et des interventions par technicien</p>
        </div>
        <a href="{{ route('analytique') }}"
           class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>

    <!-- Carte statistique globale -->
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 mb-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white">Vue d'ensemble</h3>
                <p class="text-sm text-gray-400">Effectif et répartition</p>
            </div>
        </div>

        <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-500/10 border border-orange-500/20 rounded-lg">
            <span class="text-sm text-gray-300">Nombre de techniciens :</span>
            <span class="text-xl font-bold text-orange-400">{{ $nbTechniciens }}</span>
        </div>
    </div>

    <!-- Grid des cartes principales -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

        <!-- Carte: Interventions par technicien -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Interventions par technicien</h3>
                    <p class="text-sm text-gray-400">Nombre total d'interventions effectuées</p>
                </div>
            </div>

            <div class="space-y-3">
                @forelse($interventionsPerTechnicien as $tech => $nb)
                    @php
                        $max = max($interventionsPerTechnicien);
                        $percentage = $max > 0 ? ($nb / $max) * 100 : 0;
                    @endphp
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm text-gray-300 font-medium">{{ $tech }}</span>
                            <span class="text-sm text-blue-400 font-bold">{{ $nb }}</span>
                        </div>
                        <div class="w-full bg-slate-800 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-400 h-2 rounded-full transition-all duration-500"
                                 style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 italic">Aucune intervention enregistrée</p>
                @endforelse
            </div>
        </div>

        <!-- Carte: Temps moyen global (corrective + préventive) -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-red-500/10 border border-red-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Temps moyen global</h3>
                    <p class="text-sm text-gray-400">Durée moyenne toutes interventions confondues (en heure)</p>
                </div>
            </div>

            <div class="space-y-2">
                @forelse($avgReestablishementTimePerTechnicien as $tech => $avgTime)
                    <div class="flex items-center justify-between px-4 py-3 bg-red-500/5 border border-red-500/10 rounded-lg hover:bg-red-500/10 transition-colors">
                        <span class="text-sm text-gray-300 font-medium">{{ $tech }}</span>
                        <span class="text-sm text-red-400 font-bold">{{ $avgTime }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 italic">Aucune donnée disponible</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Grid des temps moyens détaillés -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Carte: Temps moyen interventions correctives -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Temps moyen correctif</h3>
                    <p class="text-sm text-gray-400">Interventions correctives uniquement (en heure)</p>
                </div>
            </div>

            <div class="space-y-2">
                @forelse($avgInterventionTimePerTechnicien as $tech => $avgTime)
                    <div class="flex items-center justify-between px-4 py-3 bg-yellow-500/5 border border-yellow-500/10 rounded-lg hover:bg-yellow-500/10 transition-colors">
                        <span class="text-sm text-gray-300 font-medium">{{ $tech }}</span>
                        <span class="text-sm text-yellow-400 font-bold">{{ $avgTime }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 italic">Aucune donnée disponible</p>
                @endforelse
            </div>
        </div>

        <!-- Carte: Temps moyen interventions préventives -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-pink-500/10 border border-pink-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Temps moyen préventif</h3>
                    <p class="text-sm text-gray-400">Interventions préventives uniquement (en heure)</p>
                </div>
            </div>

            <div class="space-y-2">
                @forelse($avgPlanifiedInterventionTimePerTechnicien as $tech => $avgTime)
                    <div class="flex items-center justify-between px-4 py-3 bg-pink-500/5 border border-pink-500/10 rounded-lg hover:bg-pink-500/10 transition-colors">
                        <span class="text-sm text-gray-300 font-medium">{{ $tech }}</span>
                        <span class="text-sm text-pink-400 font-bold">{{ $avgTime }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 italic">Aucune donnée disponible</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
