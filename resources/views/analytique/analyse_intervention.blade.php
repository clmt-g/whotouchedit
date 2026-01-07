@extends('layouts.form')

@section('title', 'WhoTouchedIt - Analytique Interventions')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Analytique Interventions</h2>
            <p class="text-gray-400">Analyse détaillée des interventions et performances</p>
        </div>
        <a href="{{ route('analytique') }}"
           class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>

    <!-- KPIs principaux -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total interventions -->
        <div class="bg-gradient-to-br from-blue-500/10 to-blue-600/5 border border-blue-500/20 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-lg bg-blue-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Total</p>
                    <p class="text-3xl font-bold text-blue-400">{{ array_sum($nbInterventions) }}</p>
                </div>
            </div>
            <p class="text-xs text-gray-500">Interventions enregistrées</p>
        </div>

        <!-- Temps moyen -->
        <div class="bg-gradient-to-br from-green-500/10 to-green-600/5 border border-green-500/20 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-lg bg-green-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Temps moyen</p>
                    <p class="text-3xl font-bold text-green-400">{{ number_format($avgTime['avgTime'], 1) }}h</p>
                </div>
            </div>
            <p class="text-xs text-gray-500">Par intervention</p>
        </div>

        <!-- Temps total -->
        <div class="bg-gradient-to-br from-purple-500/10 to-purple-600/5 border border-purple-500/20 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-lg bg-purple-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Temps total</p>
                    <p class="text-3xl font-bold text-purple-400">{{ number_format($avgTime['totalTime'], 0) }}h</p>
                </div>
            </div>
            <p class="text-xs text-gray-500">Cumulé</p>
        </div>

        <!-- Taux de complétion -->
        <div class="bg-gradient-to-br from-yellow-500/10 to-yellow-600/5 border border-yellow-500/20 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-lg bg-yellow-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Complétées</p>
                    <p class="text-3xl font-bold text-yellow-400">{{ number_format($avgStatut['terminee'] ?? 0, 1) }}%</p>
                </div>
            </div>
            <p class="text-xs text-gray-500">Taux de complétion</p>
        </div>
    </div>

    <!-- Grid des cartes principales -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

        <!-- Carte: Répartition par statut -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Répartition par statut</h3>
                    <p class="text-sm text-gray-400">État d'avancement des interventions</p>
                </div>
            </div>

            <div class="space-y-3">
                @php
                    $statutConfig = [
                        'en_attente' => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20', 'gradient' => 'from-yellow-500 to-yellow-400'],
                        'en_cours' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'border' => 'border-blue-500/20', 'gradient' => 'from-blue-500 to-blue-400'],
                        'terminee' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/20', 'gradient' => 'from-green-500 to-green-400'],
                            'annulee' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/20', 'gradient' => 'from-red-500 to-red-400'],
                    ];
                @endphp
                @forelse($avgStatut as $statut => $pourcentage)
                    @php
                        $config = $statutConfig[$statut] ?? ['bg' => 'bg-gray-500/10', 'text' => 'text-gray-400', 'border' => 'border-gray-500/20', 'gradient' => 'from-gray-500 to-gray-400'];
                    @endphp
                    <div class="px-4 py-4 {{ $config['bg'] }} border {{ $config['border'] }} rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm {{ $config['text'] }} font-medium">{{ ucfirst(str_replace('_', ' ', $statut)) }}</span>
                            <span class="text-lg font-bold {{ $config['text'] }}">{{ number_format($pourcentage, 1) }}%</span>
                        </div>
                        <div class="w-full bg-slate-800 rounded-full h-2">
                            <div class="bg-gradient-to-r {{ $config['gradient'] }} h-2 rounded-full transition-all duration-500"
                                 style="width: {{ $pourcentage }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 italic">Aucune donnée disponible</p>
                @endforelse
            </div>
        </div>

        <!-- Carte: Interventions par période -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Interventions par période</h3>
                    <p class="text-sm text-gray-400">Volume d'activité dans le temps</p>
                </div>
            </div>

            <div class="space-y-3">
                @php
                    $timeConfig = [
                        'Toute' => ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'text-blue-400'],
                        'Cette semaine' => ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'text-green-400'],
                        'Ce mois' => ['icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'color' => 'text-purple-400'],
                        'Cette année' => ['icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'color' => 'text-yellow-400'],
                    ];
                    $max = max($nbInterventions);
                @endphp
                @forelse($nbInterventions as $time => $nb)
                    @php
                        $config = $timeConfig[$time] ?? ['icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'text-gray-400'];
                        $percentage = $max > 0 ? ($nb / $max) * 100 : 0;
                    @endphp
                    <div class="flex items-center gap-3 px-4 py-3 bg-slate-800/50 border border-slate-700 rounded-lg hover:bg-slate-800 transition-colors">
                        <div class="w-10 h-10 rounded-lg bg-slate-700 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 {{ $config['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm text-gray-300 font-medium">{{ $time }}</span>
                                <span class="text-lg font-bold {{ $config['color'] }}">{{ $nb }}</span>
                            </div>
                            <div class="w-full bg-slate-700 rounded-full h-1.5">
                                <div class="bg-gradient-to-r from-purple-500 to-purple-400 h-1.5 rounded-full transition-all duration-500"
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 italic">Aucune intervention enregistrée</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Carte statistiques détaillées en bas -->
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-lg bg-orange-500/10 border border-orange-500/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white">Statistiques détaillées</h3>
                <p class="text-sm text-gray-400">Vue d'ensemble des performances</p>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Total interventions -->
            <div class="text-center px-4 py-5 bg-slate-800/50 border border-slate-700 rounded-lg">
                <div class="text-3xl font-bold text-blue-400 mb-1">{{ array_sum($nbInterventions) }}</div>
                <div class="text-xs text-gray-400 font-medium">Total interventions</div>
            </div>

            <!-- Temps moyen -->
            <div class="text-center px-4 py-5 bg-slate-800/50 border border-slate-700 rounded-lg">
                <div class="text-3xl font-bold text-green-400 mb-1">{{ number_format($avgTime['avgTime'], 1) }}h</div>
                <div class="text-xs text-gray-400 font-medium">Durée moyenne</div>
            </div>

            <!-- Temps total -->
            <div class="text-center px-4 py-5 bg-slate-800/50 border border-slate-700 rounded-lg">
                <div class="text-3xl font-bold text-purple-400 mb-1">{{ number_format($avgTime['totalTime'], 0) }}h</div>
                <div class="text-xs text-gray-400 font-medium">Temps cumulé</div>
            </div>

            <!-- Taux terminées -->
            <div class="text-center px-4 py-5 bg-slate-800/50 border border-slate-700 rounded-lg">
                <div class="text-3xl font-bold text-yellow-400 mb-1">{{ number_format($avgStatut['terminee'] ?? 0, 1) }}%</div>
                <div class="text-xs text-gray-400 font-medium">Taux terminées</div>
            </div>
        </div>
    </div>
@endsection
