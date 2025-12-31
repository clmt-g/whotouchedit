@extends('layouts.app')

@section('title', 'WhoTouchedIt - Dashboard')

@section('content')
    <!-- Page Title -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Tableau de bord</h2>
        <p class="text-gray-400">Vue d'ensemble de votre parc machines et interventions</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-4 gap-6 mb-8">
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-green-500/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs text-green-500 font-medium bg-green-500/10 px-2 py-1 rounded">+12%</span>
            </div>
            <h3 class="text-2xl font-bold text-white mb-1">4</h3>
            <p class="text-sm text-gray-400">Machines opérationnelles</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-orange-500/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs text-orange-500 font-medium bg-orange-500/10 px-2 py-1 rounded">2 urgent</span>
            </div>
            <h3 class="text-2xl font-bold text-white mb-1">3</h3>
            <p class="text-sm text-gray-400">Interventions en cours</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-red-500/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <span class="text-xs text-red-500 font-medium bg-red-500/10 px-2 py-1 rounded">Critique</span>
            </div>
            <h3 class="text-2xl font-bold text-white mb-1">1</h3>
            <p class="text-sm text-gray-400">Machine en panne</p>
        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-lg bg-blue-500/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-xs text-blue-500 font-medium bg-blue-500/10 px-2 py-1 rounded">Cette semaine</span>
            </div>
            <h3 class="text-2xl font-bold text-white mb-1">5</h3>
            <p class="text-sm text-gray-400">Interventions planifiées</p>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-3 gap-6">
        <!-- Interventions urgentes -->
        <div class="col-span-2 bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-white">Interventions urgentes</h3>
                <a href="#" class="text-sm text-blue-500 hover:text-blue-400">Voir tout →</a>
            </div>

            <div class="space-y-4">
                <div class="flex items-start gap-4 p-4 bg-slate-800/50 rounded-lg border border-red-500/20 hover:border-red-500/40 transition">
                    <div class="w-10 h-10 rounded-lg bg-red-500/10 flex items-center justify-center flex-shrink-0">
                        <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-4 mb-2">
                            <h4 class="font-medium text-white">Robot de soudure RS-200</h4>
                            <span class="text-xs text-red-400 bg-red-500/10 px-2 py-1 rounded whitespace-nowrap">CRITIQUE</span>
                        </div>
                        <p class="text-sm text-gray-400 mb-2">Diagnostic panne électrique - Atelier soudure</p>
                        <div class="flex items-center gap-4 text-xs text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Marie Lefebvre
                                    </span>
                            <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Aujourd'hui 08:00
                                    </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-slate-800/50 rounded-lg border border-orange-500/20 hover:border-orange-500/40 transition">
                    <div class="w-10 h-10 rounded-lg bg-orange-500/10 flex items-center justify-center flex-shrink-0">
                        <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-4 mb-2">
                            <h4 class="font-medium text-white">Fraiseuse numérique F300</h4>
                            <span class="text-xs text-orange-400 bg-orange-500/10 px-2 py-1 rounded whitespace-nowrap">EN COURS</span>
                        </div>
                        <p class="text-sm text-gray-400 mb-2">Réparation système de refroidissement - Zone C</p>
                        <div class="flex items-center gap-4 text-xs text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Pierre Dubois
                                    </span>
                            <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Hier 10:00
                                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- État du parc machines -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <h3 class="text-lg font-bold text-white mb-6">État du parc</h3>

            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-400">Opérationnelles</span>
                        <span class="text-sm font-medium text-white">67%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-green-500 rounded-full" style="width: 67%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-400">En maintenance</span>
                        <span class="text-sm font-medium text-white">17%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-orange-500 rounded-full" style="width: 17%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-400">En panne</span>
                        <span class="text-sm font-medium text-white">16%</span>
                    </div>
                    <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-red-500 rounded-full" style="width: 16%"></div>
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
                        <span class="text-sm font-medium text-white">3</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                            <span class="text-sm text-gray-400">Moyen</span>
                        </div>
                        <span class="text-sm font-medium text-white">2</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            <span class="text-sm text-gray-400">Faible</span>
                        </div>
                        <span class="text-sm font-medium text-white">1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Planning semaine -->
    <div class="mt-6 bg-slate-900 border border-slate-800 rounded-xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-white">Planning de la semaine</h3>
            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                + Nouvelle intervention
            </button>
        </div>

        <div class="grid grid-cols-7 gap-2">
            <div class="text-center">
                <p class="text-xs text-gray-500 mb-2">LUN</p>
                <div class="bg-slate-800 rounded-lg p-2 h-24 hover:bg-slate-700 transition cursor-pointer">
                    <span class="text-xs text-gray-400">15 Jan</span>
                    <div class="mt-2 w-full h-1 bg-blue-500 rounded"></div>
                </div>
            </div>
            <div class="text-center">
                <p class="text-xs text-gray-500 mb-2">MAR</p>
                <div class="bg-slate-800 rounded-lg p-2 h-24 hover:bg-slate-700 transition cursor-pointer">
                    <span class="text-xs text-gray-400">16 Jan</span>
                </div>
            </div>
            <div class="text-center">
                <p class="text-xs text-gray-500 mb-2">MER</p>
                <div class="bg-slate-800 rounded-lg p-2 h-24 hover:bg-slate-700 transition cursor-pointer">
                    <span class="text-xs text-gray-400">17 Jan</span>
                </div>
            </div>
            <div class="text-center">
                <p class="text-xs text-gray-500 mb-2">JEU</p>
                <div class="bg-slate-800 rounded-lg p-2 h-24 hover:bg-slate-700 transition cursor-pointer">
                    <span class="text-xs text-gray-400">18 Jan</span>
                </div>
            </div>
            <div class="text-center">
                <p class="text-xs text-gray-500 mb-2">VEN</p>
                <div class="bg-slate-800 rounded-lg p-2 h-24 hover:bg-slate-700 transition cursor-pointer">
                    <span class="text-xs text-gray-400">19 Jan</span>
                    <div class="mt-2 w-full h-1 bg-orange-500 rounded"></div>
                </div>
            </div>
            <div class="text-center">
                <p class="text-xs text-gray-500 mb-2">SAM</p>
                <div class="bg-slate-800/50 rounded-lg p-2 h-24">
                    <span class="text-xs text-gray-600">20 Jan</span>
                </div>
            </div>
            <div class="text-center">
                <p class="text-xs text-gray-500 mb-2">DIM</p>
                <div class="bg-slate-800/50 rounded-lg p-2 h-24">
                    <span class="text-xs text-gray-600">21 Jan</span>
                </div>
            </div>
        </div>
    </div>
@endsection
