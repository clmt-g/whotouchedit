@extends('layouts.error')

@section('title', 'WhoTouchedIt - Accès interdit')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-8">
        <div class="max-w-2xl w-full">

            <!-- Panneau d'avertissement principal -->
            <div class="bg-gradient-to-br from-red-500/10 to-orange-600/10 border-2 border-red-500/50 rounded-xl p-8 mb-6 relative overflow-hidden">

                <!-- Grille de sécurité en arrière-plan -->
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute inset-0" style="background: repeating-linear-gradient(0deg, #ef4444 0px, #ef4444 2px, transparent 2px, transparent 20px), repeating-linear-gradient(90deg, #ef4444 0px, #ef4444 2px, transparent 2px, transparent 20px);"></div>
                </div>

                <div class="relative z-10">
                    <!-- Icône de cadenas qui pulse -->
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <svg class="w-24 h-24 text-red-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <!-- Cercle qui pulse -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-32 h-32 bg-red-500/20 rounded-full animate-ping"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Titre -->
                    <div class="text-center mb-6">
                        <h1 class="text-6xl font-bold text-red-500 mb-4 font-mono tracking-wider">
                            ERREUR 403
                        </h1>
                        <h2 class="text-2xl font-bold text-white mb-2">
                            🚫 ACCÈS REFUSÉ 🚫
                        </h2>
                        <p class="text-gray-400 text-lg">
                            Vous n'avez pas l'autorisation d'accéder à cette zone
                        </p>
                    </div>
                </div>
            </div>

            <!-- Rapport d'intervention -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-slate-800/80 to-slate-800/60 px-6 py-4 border-b border-slate-800">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Rapport de sécurité
                    </h3>
                </div>

                <div class="p-6 space-y-4">
                    <!-- Référence -->
                    <div class="flex items-center justify-between py-3 border-b border-slate-800">
                        <span class="text-gray-400 font-medium">Référence</span>
                        <span class="text-white font-mono bg-slate-800 px-3 py-1 rounded">403-FORBIDDEN</span>
                    </div>

                    <!-- Statut -->
                    <div class="flex items-center justify-between py-3 border-b border-slate-800">
                        <span class="text-gray-400 font-medium">Statut</span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-300 bg-gradient-to-r from-red-500/20 to-red-600/10 rounded-lg border border-red-500/30">
                            <span class="w-2 h-2 bg-red-400 rounded-full animate-pulse"></span>
                            Accès refusé
                        </span>
                    </div>

                    <!-- Niveau d'autorisation -->
                    <div class="flex items-center justify-between py-3 border-b border-slate-800">
                        <span class="text-gray-400 font-medium">Niveau d'autorisation requis</span>
                        <span class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-orange-300 bg-gradient-to-r from-orange-500/20 to-orange-600/10 rounded-lg border border-orange-500/30">
                            Élevé
                        </span>
                    </div>

                    <!-- Votre rôle -->
                    <div class="flex items-center justify-between py-3 border-b border-slate-800">
                        <span class="text-gray-400 font-medium">Votre rôle</span>
                        <span class="text-gray-300">{{ Auth::user()->role ?? 'Invité' }}</span>
                    </div>

                    <!-- Tentative enregistrée -->
                    <div class="flex items-center justify-between py-3">
                        <span class="text-gray-400 font-medium">Tentative enregistrée</span>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-gray-300">{{ now()->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 mb-6">
                <h4 class="text-white font-semibold mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Description de la restriction
                </h4>
                <p class="text-gray-400 leading-relaxed mb-3">
                    Cette zone est protégée et nécessite des privilèges spécifiques pour y accéder.
                    Votre rôle actuel ne vous autorise pas à consulter ou modifier ces informations.
                </p>
                <div class="bg-slate-800/50 border border-slate-700 rounded-lg p-4 mt-4">
                    <p class="text-sm text-gray-300 flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Si vous pensez avoir besoin d'accéder à cette section, contactez votre administrateur système pour obtenir les autorisations nécessaires.</span>
                    </p>
                </div>
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

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-gray-500 text-sm italic">
                    🔒 Cette zone est sous surveillance. Toutes les tentatives d'accès sont enregistrées.
                </p>
            </div>

        </div>
    </div>

    <style>
        @keyframes pulse-danger {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
    </style>
@endsection
