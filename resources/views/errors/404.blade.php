@extends('layouts.error')

@section('title', 'WhoTouchedIt - Page introuvable')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-8">
        <div class="max-w-2xl w-full">

            <!-- Panneau d'avertissement principal -->
            <div class="bg-gradient-to-br from-yellow-500/10 to-orange-500/10 border-2 border-yellow-500/50 rounded-xl p-8 mb-6 relative overflow-hidden">

                <!-- Bandes diagonales en arrière-plan -->
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute inset-0" style="background: repeating-linear-gradient(45deg, #000 0px, #000 20px, #fbbf24 20px, #fbbf24 40px);"></div>
                </div>

                <div class="relative z-10">
                    <!-- Icône d'alerte qui clignote -->
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <svg class="w-24 h-24 text-yellow-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <!-- Cercle qui pulse -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-32 h-32 bg-yellow-500/20 rounded-full animate-ping"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Titre -->
                    <div class="text-center mb-6">
                        <h1 class="text-6xl font-bold text-yellow-500 mb-4 font-mono tracking-wider">
                            ERREUR 404
                        </h1>
                        <h2 class="text-2xl font-bold text-white mb-2">
                            ⚠️ PAGE HORS SERVICE ⚠️
                        </h2>
                        <p class="text-gray-400 text-lg">
                            Cette page est introuvable dans nos registres
                        </p>
                    </div>
                </div>
            </div>

            <!-- Rapport d'intervention -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-slate-800/80 to-slate-800/60 px-6 py-4 border-b border-slate-800">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Rapport d'incident
                    </h3>
                </div>

                <div class="p-6 space-y-4">
                    <!-- Référence -->
                    <div class="flex items-center justify-between py-3 border-b border-slate-800">
                        <span class="text-gray-400 font-medium">Référence</span>
                        <span class="text-white font-mono bg-slate-800 px-3 py-1 rounded">404-NOT-FOUND</span>
                    </div>

                    <!-- Statut -->
                    <div class="flex items-center justify-between py-3 border-b border-slate-800">
                        <span class="text-gray-400 font-medium">Statut</span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-300 bg-gradient-to-r from-red-500/20 to-red-600/10 rounded-lg border border-red-500/30">
                            <span class="w-2 h-2 bg-red-400 rounded-full animate-pulse"></span>
                            Hors service
                        </span>
                    </div>

                    <!-- Criticité -->
                    <div class="flex items-center justify-between py-3 border-b border-slate-800">
                        <span class="text-gray-400 font-medium">Criticité</span>
                        <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-red-300 bg-gradient-to-r from-red-500/20 to-red-600/10 rounded-lg border border-red-500/30">
                            Critique
                        </span>
                    </div>

                    <!-- Localisation -->
                    <div class="flex items-center justify-between py-3 border-b border-slate-800">
                        <span class="text-gray-400 font-medium">Localisation</span>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                            </svg>
                            <span class="text-gray-300 italic">Introuvable</span>
                        </div>
                    </div>

                    <!-- Dernière intervention -->
                    <div class="flex items-center justify-between py-3">
                        <span class="text-gray-400 font-medium">Dernière intervention</span>
                        <span class="text-gray-300 italic">Jamais</span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 mb-6">
                <h4 class="text-white font-semibold mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Description du problème
                </h4>
                <p class="text-gray-400 leading-relaxed">
                    La page que vous recherchez semble avoir été déplacée, supprimée ou n'a jamais existé dans notre système.
                    Nos techniciens ont fouillé partout dans le parc mais impossible de localiser cette ressource.
                </p>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ url()->previous() }}"
                   class="flex-1 px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Page précédente
                </a>
                <a href="{{ route('dashboard') }}"
                   class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center justify-center gap-2 shadow-lg shadow-blue-500/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Retour à l'accueil
                </a>
            </div>

            <!-- Footer humoristique -->
            <div class="mt-8 text-center">
                <p class="text-gray-500 text-sm italic">
                    💡 Astuce : Cette page n'a pas été touchée... car elle n'existe pas !
                </p>
            </div>

        </div>
    </div>

    <style>
        @keyframes pulse-warning {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
    </style>
@endsection
