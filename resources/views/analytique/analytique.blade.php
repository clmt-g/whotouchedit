@extends('layouts.app')

@section('title', 'WhoTouchedIt - Analytiques')

@section('content')
    <div class="p-8">

        <!-- Page Title -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-white mb-2">Centre Analytique</h2>
            <p class="text-gray-400">Analysez vos données de maintenance et optimisez vos performances</p>
        </div>

        <!-- Grid des catégories analytiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- KPI & Performance -->
            <a href="{{ route('analytique.kpi') }}"
               class="group bg-gradient-to-br from-blue-500/10 to-blue-600/5 border border-blue-500/20 rounded-xl p-6 hover:border-blue-500/40 hover:shadow-lg hover:shadow-blue-500/20 transition-all duration-300 hover:scale-105">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl bg-blue-500/20 flex items-center justify-center group-hover:bg-blue-500/30 transition-colors">
                        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-blue-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-blue-400 transition-colors">Indicateurs de Performance</h3>
                <p class="text-gray-400 text-sm mb-4">KPI, temps de réponse, disponibilité, MTBF/MTTR</p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs px-2 py-1 bg-blue-500/10 text-blue-400 rounded-full">Temps de réponse</span>
                    <span class="text-xs px-2 py-1 bg-blue-500/10 text-blue-400 rounded-full">Disponibilité</span>
                    <span class="text-xs px-2 py-1 bg-blue-500/10 text-blue-400 rounded-full">MTBF/MTTR</span>
                </div>
            </a>

            <!-- Graphiques temporels -->
            <a href="#"
               class="group bg-gradient-to-br from-purple-500/10 to-purple-600/5 border border-purple-500/20 rounded-xl p-6 hover:border-purple-500/40 hover:shadow-lg hover:shadow-purple-500/20 transition-all duration-300 hover:scale-105">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl bg-purple-500/20 flex items-center justify-center group-hover:bg-purple-500/30 transition-colors">
                        <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-purple-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-purple-400 transition-colors">Évolution Temporelle</h3>
                <p class="text-gray-400 text-sm mb-4">Tendances, heatmaps, comparaisons mensuelles</p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs px-2 py-1 bg-purple-500/10 text-purple-400 rounded-full">Tendances</span>
                    <span class="text-xs px-2 py-1 bg-purple-500/10 text-purple-400 rounded-full">Heatmaps</span>
                    <span class="text-xs px-2 py-1 bg-purple-500/10 text-purple-400 rounded-full">Comparaisons</span>
                </div>
            </a>

            <!-- Répartitions -->
            <a href="#"
               class="group bg-gradient-to-br from-green-500/10 to-green-600/5 border border-green-500/20 rounded-xl p-6 hover:border-green-500/40 hover:shadow-lg hover:shadow-green-500/20 transition-all duration-300 hover:scale-105">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl bg-green-500/20 flex items-center justify-center group-hover:bg-green-500/30 transition-colors">
                        <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-green-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-green-400 transition-colors">Répartition & Distribution</h3>
                <p class="text-gray-400 text-sm mb-4">Par type, priorité, technicien, zone</p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs px-2 py-1 bg-green-500/10 text-green-400 rounded-full">Types</span>
                    <span class="text-xs px-2 py-1 bg-green-500/10 text-green-400 rounded-full">Priorités</span>
                    <span class="text-xs px-2 py-1 bg-green-500/10 text-green-400 rounded-full">Zones</span>
                </div>
            </a>

            <!-- Analyse machines -->
            <a href="{{ route('analytique.analyse_machine') }}"
               class="group bg-gradient-to-br from-orange-500/10 to-orange-600/5 border border-orange-500/20 rounded-xl p-6 hover:border-orange-500/40 hover:shadow-lg hover:shadow-orange-500/20 transition-all duration-300 hover:scale-105">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl bg-orange-500/20 flex items-center justify-center group-hover:bg-orange-500/30 transition-colors">
                        <svg class="w-7 h-7 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-orange-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-orange-400 transition-colors">Analyse des Machines</h3>
                <p class="text-gray-400 text-sm mb-4">Interventions par machines, etat du parc</p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs px-2 py-1 bg-orange-500/10 text-orange-400 rounded-full">Top pannes</span>
                    <span class="text-xs px-2 py-1 bg-orange-500/10 text-orange-400 rounded-full">Préventif</span>
                    <span class="text-xs px-2 py-1 bg-orange-500/10 text-orange-400 rounded-full">Coûts</span>
                </div>
            </a>

            <!-- Performance techniciens -->
            <a href="#"
               class="group bg-gradient-to-br from-cyan-500/10 to-cyan-600/5 border border-cyan-500/20 rounded-xl p-6 hover:border-cyan-500/40 hover:shadow-lg hover:shadow-cyan-500/20 transition-all duration-300 hover:scale-105">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl bg-cyan-500/20 flex items-center justify-center group-hover:bg-cyan-500/30 transition-colors">
                        <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-cyan-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-cyan-400 transition-colors">Performance Techniciens</h3>
                <p class="text-gray-400 text-sm mb-4">Interventions, temps moyen, charge de travail</p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs px-2 py-1 bg-cyan-500/10 text-cyan-400 rounded-full">Volume</span>
                    <span class="text-xs px-2 py-1 bg-cyan-500/10 text-cyan-400 rounded-full">Rapidité</span>
                    <span class="text-xs px-2 py-1 bg-cyan-500/10 text-cyan-400 rounded-full">Charge</span>
                </div>
            </a>

            <!-- Coûts & Budget -->
            <a href="#"
               class="group bg-gradient-to-br from-yellow-500/10 to-yellow-600/5 border border-yellow-500/20 rounded-xl p-6 hover:border-yellow-500/40 hover:shadow-lg hover:shadow-yellow-500/20 transition-all duration-300 hover:scale-105">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl bg-yellow-500/20 flex items-center justify-center group-hover:bg-yellow-500/30 transition-colors">
                        <svg class="w-7 h-7 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-yellow-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-yellow-400 transition-colors">Coûts & Budget</h3>
                <p class="text-gray-400 text-sm mb-4">Dépenses, ROI préventif, budget utilisé</p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs px-2 py-1 bg-yellow-500/10 text-yellow-400 rounded-full">Dépenses</span>
                    <span class="text-xs px-2 py-1 bg-yellow-500/10 text-yellow-400 rounded-full">ROI</span>
                    <span class="text-xs px-2 py-1 bg-yellow-500/10 text-yellow-400 rounded-full">Budget</span>
                </div>
            </a>

            <!-- Prédictif & Alertes -->
            <a href="#"
               class="group bg-gradient-to-br from-red-500/10 to-red-600/5 border border-red-500/20 rounded-xl p-6 hover:border-red-500/40 hover:shadow-lg hover:shadow-red-500/20 transition-all duration-300 hover:scale-105">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl bg-red-500/20 flex items-center justify-center group-hover:bg-red-500/30 transition-colors">
                        <svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-red-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-red-400 transition-colors">Prédictif & Alertes</h3>
                <p class="text-gray-400 text-sm mb-4">Machines à risque, alertes, prochaines maintenances</p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs px-2 py-1 bg-red-500/10 text-red-400 rounded-full">Risques</span>
                    <span class="text-xs px-2 py-1 bg-red-500/10 text-red-400 rounded-full">Alertes</span>
                    <span class="text-xs px-2 py-1 bg-red-500/10 text-red-400 rounded-full">Planning</span>
                </div>
            </a>

            <!-- Dashboard Vue d'ensemble -->
            <a href=""
               class="group bg-gradient-to-br from-indigo-500/10 to-indigo-600/5 border border-indigo-500/20 rounded-xl p-6 hover:border-indigo-500/40 hover:shadow-lg hover:shadow-indigo-500/20 transition-all duration-300 hover:scale-105">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl bg-indigo-500/20 flex items-center justify-center group-hover:bg-indigo-500/30 transition-colors">
                        <svg class="w-7 h-7 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 12a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-indigo-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-indigo-400 transition-colors">Vue d'Ensemble</h3>
                <p class="text-gray-400 text-sm mb-4">Dashboard récapitulatif et indicateurs clés</p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs px-2 py-1 bg-indigo-500/10 text-indigo-400 rounded-full">Récap</span>
                    <span class="text-xs px-2 py-1 bg-indigo-500/10 text-indigo-400 rounded-full">KPIs</span>
                    <span class="text-xs px-2 py-1 bg-indigo-500/10 text-indigo-400 rounded-full">Synthèse</span>
                </div>
            </a>

            <!-- Rapports personnalisés -->
            <a href="#"
               class="group bg-gradient-to-br from-pink-500/10 to-pink-600/5 border border-pink-500/20 rounded-xl p-6 hover:border-pink-500/40 hover:shadow-lg hover:shadow-pink-500/20 transition-all duration-300 hover:scale-105">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl bg-pink-500/20 flex items-center justify-center group-hover:bg-pink-500/30 transition-colors">
                        <svg class="w-7 h-7 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <svg class="w-5 h-5 text-pink-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-pink-400 transition-colors">Rapports Personnalisés</h3>
                <p class="text-gray-400 text-sm mb-4">Créez et exportez vos rapports sur mesure</p>
                <div class="flex flex-wrap gap-2">
                    <span class="text-xs px-2 py-1 bg-pink-500/10 text-pink-400 rounded-full">PDF</span>
                    <span class="text-xs px-2 py-1 bg-pink-500/10 text-pink-400 rounded-full">Excel</span>
                    <span class="text-xs px-2 py-1 bg-pink-500/10 text-pink-400 rounded-full">Custom</span>
                </div>
            </a>

        </div>

        <!-- Info Box -->
        <div class="mt-8 bg-blue-500/10 border border-blue-500/20 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-lg bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-blue-400 mb-2">À propos des analytiques</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Explorez vos données de maintenance sous différents angles pour optimiser vos opérations.
                        Chaque section vous offre des insights détaillés et des visualisations pour prendre les meilleures décisions.
                        Les données sont mises à jour en temps réel.
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection
