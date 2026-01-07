@extends('layouts.form')

@section('title', 'WhoTouchedIt - Analytique Interventions Planifiées')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Analytique Interventions Planifiées</h2>
            <p class="text-gray-400">Suivi et performances des interventions préventives</p>
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
        <!-- Total interventions planifiées -->
        <div class="bg-gradient-to-br from-indigo-500/10 to-indigo-600/5 border border-indigo-500/20 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-lg bg-indigo-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Total planifié</p>
                    <p class="text-3xl font-bold text-indigo-400">{{ array_sum($nbInterventionsPlanifiees) }}</p>
                </div>
            </div>
            <p class="text-xs text-gray-500">Interventions préventives</p>
        </div>

        <!-- Temps moyen -->
        <div class="bg-gradient-to-br from-teal-500/10 to-teal-600/5 border border-teal-500/20 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-lg bg-teal-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Temps moyen</p>
                    <p class="text-3xl font-bold text-teal-400">{{ number_format($avgTimePlanifiee['avgTime'], 1) }}h</p>
                </div>
            </div>
            <p class="text-xs text-gray-500">Par intervention planifiée</p>
        </div>

        <!-- Temps total -->
        <div class="bg-gradient-to-br from-cyan-500/10 to-cyan-600/5 border border-cyan-500/20 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-lg bg-cyan-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Temps total</p>
                    <p class="text-3xl font-bold text-cyan-400">{{ number_format($avgTimePlanifiee['totalTime'], 0) }}h</p>
                </div>
            </div>
            <p class="text-xs text-gray-500">Cumulé planifié</p>
        </div>

        <!-- Taux de réalisation -->
        <div class="bg-gradient-to-br from-emerald-500/10 to-emerald-600/5 border border-emerald-500/20 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Réalisées</p>
                    <p class="text-3xl font-bold text-emerald-400">{{ number_format($avgStatutPlanifiee['terminee'] ?? 0, 1) }}%</p>
                </div>
            </div>
            <p class="text-xs text-gray-500">Taux de réalisation</p>
        </div>
    </div>

    <!-- Grid des cartes principales -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

        <!-- Carte: Répartition par statut -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Répartition par statut</h3>
                    <p class="text-sm text-gray-400">État des interventions préventives</p>
                </div>
            </div>

            <div class="space-y-3">
                @php
                    $statutConfig = [
                        'planifiee' => ['bg' => 'bg-indigo-500/10', 'text' => 'text-indigo-400', 'border' => 'border-indigo-500/20', 'gradient' => 'from-indigo-500 to-indigo-400', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        'en_cours' => ['bg' => 'bg-sky-500/10', 'text' => 'text-sky-400', 'border' => 'border-sky-500/20', 'gradient' => 'from-sky-500 to-sky-400', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                        'terminee' => ['bg' => 'bg-emerald-500/10', 'text' => 'text-emerald-400', 'border' => 'border-emerald-500/20', 'gradient' => 'from-emerald-500 to-emerald-400', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'annulee' => ['bg' => 'bg-rose-500/10', 'text' => 'text-rose-400', 'border' => 'border-rose-500/20', 'gradient' => 'from-rose-500 to-rose-400', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ];
                @endphp
                @forelse($avgStatutPlanifiee as $statut => $pourcentage)
                    @php
                        $config = $statutConfig[$statut] ?? ['bg' => 'bg-gray-500/10', 'text' => 'text-gray-400', 'border' => 'border-gray-500/20', 'gradient' => 'from-gray-500 to-gray-400', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'];
                    @endphp
                    <div class="px-4 py-4 {{ $config['bg'] }} border {{ $config['border'] }} rounded-lg hover:scale-[1.02] transition-transform">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 rounded-lg {{ $config['bg'] }} border {{ $config['border'] }} flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 {{ $config['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"/>
                                </svg>
                            </div>
                            <span class="text-sm {{ $config['text'] }} font-medium flex-1">{{ ucfirst(str_replace('_', ' ', $statut)) }}</span>
                            <span class="text-lg font-bold {{ $config['text'] }}">{{ number_format($pourcentage, 1) }}%</span>
                        </div>
                        <div class="w-full bg-slate-800 rounded-full h-2">
                            <div class="bg-gradient-to-r {{ $config['gradient'] }} h-2 rounded-full transition-all duration-500"
                                 style="width: {{ $pourcentage }}%"></div>
                        </div>
                    </div>
                @empty
                    <div class="flex items-center justify-center py-8">
                        <div class="text-center">
                            <svg class="w-12 h-12 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-sm text-gray-500 italic">Aucune intervention planifiée</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Carte: Interventions par période -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-teal-500/10 border border-teal-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Planning préventif</h3>
                    <p class="text-sm text-gray-400">Volume de maintenance programmée</p>
                </div>
            </div>

            <div class="space-y-3">
                @php
                    $timeConfig = [
                        'Toute' => ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'text-indigo-400', 'bg' => 'bg-indigo-500/10'],
                        'Cette semaine' => ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'text-teal-400', 'bg' => 'bg-teal-500/10'],
                        'Ce mois' => ['icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'color' => 'text-cyan-400', 'bg' => 'bg-cyan-500/10'],
                        'Cette année' => ['icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'color' => 'text-emerald-400', 'bg' => 'bg-emerald-500/10'],
                    ];
                    $max = count($nbInterventionsPlanifiees) > 0 ? max($nbInterventionsPlanifiees) : 1;
                @endphp
                @forelse($nbInterventionsPlanifiees as $time => $nb)
                    @php
                        $config = $timeConfig[$time] ?? ['icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'text-gray-400', 'bg' => 'bg-gray-500/10'];
                        $percentage = $max > 0 ? ($nb / $max) * 100 : 0;
                    @endphp
                    <div class="flex items-center gap-3 px-4 py-3 {{ $config['bg'] }} border border-slate-700 rounded-lg hover:bg-slate-700/50 transition-colors">
                        <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 {{ $config['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm text-gray-300 font-medium">{{ $time }}</span>
                                <span class="text-lg font-bold {{ $config['color'] }}">{{ $nb }}</span>
                            </div>
                            <div class="w-full bg-slate-800 rounded-full h-1.5">
                                <div class="bg-gradient-to-r from-teal-500 to-cyan-400 h-1.5 rounded-full transition-all duration-500"
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex items-center justify-center py-8">
                        <div class="text-center">
                            <svg class="w-12 h-12 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-gray-500 italic">Aucune période planifiée</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Carte statistiques détaillées en bas -->
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-lg bg-violet-500/10 border border-violet-500/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-white">Statistiques de maintenance préventive</h3>
                <p class="text-sm text-gray-400">Résumé des performances du planning</p>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Total interventions planifiées -->
            <div class="text-center px-4 py-5 bg-gradient-to-br from-indigo-500/5 to-indigo-600/5 border border-indigo-500/10 rounded-lg hover:border-indigo-500/30 transition-colors">
                <div class="text-3xl font-bold text-indigo-400 mb-1">{{ array_sum($nbInterventionsPlanifiees) }}</div>
                <div class="text-xs text-gray-400 font-medium">Total planifié</div>
            </div>

            <!-- Temps moyen -->
            <div class="text-center px-4 py-5 bg-gradient-to-br from-teal-500/5 to-teal-600/5 border border-teal-500/10 rounded-lg hover:border-teal-500/30 transition-colors">
                <div class="text-3xl font-bold text-teal-400 mb-1">{{ number_format($avgTimePlanifiee['avgTime'], 1) }}h</div>
                <div class="text-xs text-gray-400 font-medium">Durée moyenne</div>
            </div>

            <!-- Temps total -->
            <div class="text-center px-4 py-5 bg-gradient-to-br from-cyan-500/5 to-cyan-600/5 border border-cyan-500/10 rounded-lg hover:border-cyan-500/30 transition-colors">
                <div class="text-3xl font-bold text-cyan-400 mb-1">{{ number_format($avgTimePlanifiee['totalTime'], 0) }}h</div>
                <div class="text-xs text-gray-400 font-medium">Temps cumulé</div>
            </div>

            <!-- Taux réalisées -->
            <div class="text-center px-4 py-5 bg-gradient-to-br from-emerald-500/5 to-emerald-600/5 border border-emerald-500/10 rounded-lg hover:border-emerald-500/30 transition-colors">
                <div class="text-3xl font-bold text-emerald-400 mb-1">{{ number_format($avgStatutPlanifiee['terminee'] ?? 0, 1) }}%</div>
                <div class="text-xs text-gray-400 font-medium">Taux réalisées</div>
            </div>
        </div>
    </div>
@endsection
