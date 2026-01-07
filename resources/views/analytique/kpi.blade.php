@extends('layouts.form')

@section('title', 'WhoTouchedIt - Indicateurs de Performance')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Indicateurs de Performance (KPI)</h2>
            <p class="text-gray-400">Métriques clés de maintenance et de fiabilité du parc machines</p>
        </div>
        <a href="{{ route('analytique') }}"
           class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>

    <!-- Grid des KPI principaux -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        <!-- KPI: Disponibilité du parc -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 hover:border-green-500/30 transition-all group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-green-500/10 border border-green-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="px-3 py-1 bg-green-500/10 border border-green-500/20 rounded-full">
                    <span class="text-xs font-medium text-green-400">Disponibilité</span>
                </div>
            </div>

            <div class="mb-2">
                <h3 class="text-sm font-medium text-gray-400 mb-1">Disponibilité du Parc</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-4xl font-bold text-white">{{ number_format($disponibiliteParc, 1) }}</span>
                    <span class="text-2xl font-bold text-green-400">%</span>
                </div>
            </div>

            <p class="text-xs text-gray-500">Temps de fonctionnement opérationnel</p>

            <!-- Barre de progression -->
            <div class="mt-4 w-full bg-slate-800 rounded-full h-2">
                <div class="bg-gradient-to-r from-green-500 to-green-400 h-2 rounded-full transition-all duration-500"
                     style="width: {{ min($disponibiliteParc, 100) }}%"></div>
            </div>
        </div>

        <!-- KPI: MTTR -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 hover:border-orange-500/30 transition-all group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="px-3 py-1 bg-orange-500/10 border border-orange-500/20 rounded-full">
                    <span class="text-xs font-medium text-orange-400">Réparation</span>
                </div>
            </div>

            <div class="mb-2">
                <h3 class="text-sm font-medium text-gray-400 mb-1">MTTR</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-4xl font-bold text-white">{{ number_format($mttr, 1) }}</span>
                    <span class="text-xl font-bold text-orange-400">h</span>
                </div>
            </div>

            <p class="text-xs text-gray-500">Mean Time To Repair</p>

            <!-- Indicateur de performance -->
            @php
                $mttrClass = $mttr < 4 ? 'text-green-400' : ($mttr < 8 ? 'text-yellow-400' : 'text-red-400');
                $mttrText = $mttr < 4 ? 'Rapide' : ($mttr < 8 ? 'Acceptable' : 'Lent');
            @endphp
            <div class="mt-4 flex items-center gap-2">
                <div class="w-2 h-2 rounded-full {{ str_replace('text-', 'bg-', $mttrClass) }} animate-pulse"></div>
                <span class="text-xs font-medium {{ $mttrClass }}">{{ $mttrText }}</span>
            </div>
        </div>

        <!-- KPI: MTTF -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 hover:border-blue-500/30 transition-all group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <div class="px-3 py-1 bg-blue-500/10 border border-blue-500/20 rounded-full">
                    <span class="text-xs font-medium text-blue-400">Défaillance</span>
                </div>
            </div>

            <div class="mb-2">
                <h3 class="text-sm font-medium text-gray-400 mb-1">MTTF</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-4xl font-bold text-white">{{ number_format($mttf, 1) }}</span>
                    <span class="text-xl font-bold text-blue-400">h</span>
                </div>
            </div>

            <p class="text-xs text-gray-500">Mean Time To Failure</p>

            <!-- Indicateur de performance -->
            @php
                $mttfClass = $mttf > 500 ? 'text-green-400' : ($mttf > 200 ? 'text-yellow-400' : 'text-red-400');
                $mttfText = $mttf > 500 ? 'Excellent' : ($mttf > 200 ? 'Bon' : 'Faible');
            @endphp
            <div class="mt-4 flex items-center gap-2">
                <div class="w-2 h-2 rounded-full {{ str_replace('text-', 'bg-', $mttfClass) }} animate-pulse"></div>
                <span class="text-xs font-medium {{ $mttfClass }}">{{ $mttfText }}</span>
            </div>
        </div>

        <!-- KPI: MTBF -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 hover:border-purple-500/30 transition-all group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div class="px-3 py-1 bg-purple-500/10 border border-purple-500/20 rounded-full">
                    <span class="text-xs font-medium text-purple-400">Fiabilité</span>
                </div>
            </div>

            <div class="mb-2">
                <h3 class="text-sm font-medium text-gray-400 mb-1">MTBF</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-4xl font-bold text-white">{{ number_format($mtbf, 1) }}</span>
                    <span class="text-xl font-bold text-purple-400">h</span>
                </div>
            </div>

            <p class="text-xs text-gray-500">Mean Time Between Failures</p>

            <!-- Indicateur de performance -->
            @php
                $mtbfClass = $mtbf > 100 ? 'text-green-400' : ($mtbf > 50 ? 'text-yellow-400' : 'text-red-400');
                $mtbfText = $mtbf > 100 ? 'Très fiable' : ($mtbf > 50 ? 'Acceptable' : 'Problématique');
            @endphp
            <div class="mt-4 flex items-center gap-2">
                <div class="w-2 h-2 rounded-full {{ str_replace('text-', 'bg-', $mtbfClass) }} animate-pulse"></div>
                <span class="text-xs font-medium {{ $mtbfClass }}">{{ $mtbfText }}</span>
            </div>
        </div>
    </div>

    <!-- Cartes explicatives -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Carte: Comprendre les KPI -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Comprendre les indicateurs</h3>
                    <p class="text-sm text-gray-400">Définitions des métriques clés</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-500/10 border border-green-500/20 flex items-center justify-center flex-shrink-0">
                        <span class="text-xs font-bold text-green-400">D</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white mb-1">Disponibilité</h4>
                        <p class="text-xs text-gray-400">Pourcentage de temps où les machines sont opérationnelles. Un taux élevé (>95%) indique un parc fiable.</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-lg bg-orange-500/10 border border-orange-500/20 flex items-center justify-center flex-shrink-0">
                        <span class="text-xs font-bold text-orange-400">MTTR</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white mb-1">Mean Time To Repair</h4>
                        <p class="text-xs text-gray-400">Durée moyenne nécessaire pour réparer une machine en panne. Un MTTR faible (<4h) signifie des réparations efficaces.</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center flex-shrink-0">
                        <span class="text-xs font-bold text-blue-400">MTTF</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white mb-1">Mean Time To Failure</h4>
                        <p class="text-xs text-gray-400">Durée moyenne avant la première panne d'un équipement. Un MTTF élevé (>500h) indique des machines de qualité.</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center flex-shrink-0">
                        <span class="text-xs font-bold text-purple-400">MTBF</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white mb-1">Mean Time Between Failures</h4>
                        <p class="text-xs text-gray-400">Temps moyen entre deux pannes consécutives. Un MTBF élevé (>100h) indique des machines fiables qui tombent rarement en panne.</p>
                    </div>
                </div>
            </div>

            <!-- Relation MTBF = MTTF + MTTR -->
            <div class="mt-6 p-4 bg-cyan-500/5 border border-cyan-500/10 rounded-lg">
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-cyan-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    <div>
                        <p class="text-xs font-semibold text-cyan-400 mb-1">Formule clé</p>
                        <p class="text-xs text-gray-400">MTBF = MTTF + MTTR</p>
                        <p class="text-xs text-gray-500 mt-1">Le temps entre pannes inclut le temps de bon fonctionnement et le temps de réparation.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte: Résumé de la performance -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-lg bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white">Analyse de performance</h3>
                    <p class="text-sm text-gray-400">État global du parc machines</p>
                </div>
            </div>

            @php
                $globalScore = 0;
                $metrics = 0;

                // Disponibilité (poids: 40%)
                if ($disponibiliteParc >= 95) $globalScore += 40;
                elseif ($disponibiliteParc >= 85) $globalScore += 30;
                elseif ($disponibiliteParc >= 75) $globalScore += 20;
                else $globalScore += 10;
                $metrics++;

                // MTTR (poids: 20%)
                if ($mttr < 4) $globalScore += 20;
                elseif ($mttr < 8) $globalScore += 15;
                elseif ($mttr < 12) $globalScore += 10;
                else $globalScore += 5;
                $metrics++;

                // MTTF (poids: 20%)
                if ($mttf > 500) $globalScore += 20;
                elseif ($mttf > 200) $globalScore += 15;
                elseif ($mttf > 100) $globalScore += 10;
                else $globalScore += 5;
                $metrics++;

                // MTBF (poids: 20%)
                if ($mtbf > 100) $globalScore += 20;
                elseif ($mtbf > 50) $globalScore += 15;
                elseif ($mtbf > 25) $globalScore += 10;
                else $globalScore += 5;
                $metrics++;

                $scoreColor = $globalScore >= 80 ? 'green' : ($globalScore >= 60 ? 'yellow' : 'red');
                $scoreText = $globalScore >= 80 ? 'Excellente' : ($globalScore >= 60 ? 'Bonne' : 'À améliorer');
            @endphp

            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-{{ $scoreColor }}-500/10 border-4 border-{{ $scoreColor }}-500/20 mb-4">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-{{ $scoreColor }}-400">{{ $globalScore }}</div>
                        <div class="text-xs text-gray-400">/ 100</div>
                    </div>
                </div>
                <div class="text-lg font-bold text-white mb-1">Performance {{ $scoreText }}</div>
                <p class="text-sm text-gray-400">Score global de maintenance</p>
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-400">Disponibilité</span>
                    <span class="font-medium {{ $disponibiliteParc >= 85 ? 'text-green-400' : 'text-orange-400' }}">
                        {{ $disponibiliteParc >= 85 ? '✓' : '⚠' }} {{ number_format($disponibiliteParc, 1) }}%
                    </span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-400">MTTR</span>
                    <span class="font-medium {{ $mttr < 8 ? 'text-green-400' : 'text-orange-400' }}">
                        {{ $mttr < 8 ? '✓' : '⚠' }} {{ number_format($mttr, 1) }}h
                    </span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-400">MTTF</span>
                    <span class="font-medium {{ $mttf > 200 ? 'text-green-400' : 'text-orange-400' }}">
                        {{ $mttf > 200 ? '✓' : '⚠' }} {{ number_format($mttf, 1) }}h
                    </span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-400">MTBF</span>
                    <span class="font-medium {{ $mtbf > 50 ? 'text-green-400' : 'text-orange-400' }}">
                        {{ $mtbf > 50 ? '✓' : '⚠' }} {{ number_format($mtbf, 1) }}h
                    </span>
                </div>
            </div>

            <!-- Vérification formule MTBF -->
            @php
                $calculatedMTBF = $mttf + $mttr;
                $isFormulaValid = abs($mtbf - $calculatedMTBF) < 1; // Tolérance de 1h
            @endphp
            <div class="mt-6 p-3 bg-slate-800/50 border border-slate-700 rounded-lg">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-gray-400">Vérification MTBF</span>
                    @if($isFormulaValid)
                        <span class="text-green-400 font-medium">✓ Cohérent</span>
                    @else
                        <span class="text-yellow-400 font-medium">⚠ Écart détecté</span>
                    @endif
                </div>
                <div class="mt-1 text-xs text-gray-500">
                    {{ number_format($mttf, 1) }}h + {{ number_format($mttr, 1) }}h = {{ number_format($calculatedMTBF, 1) }}h
                </div>
            </div>
        </div>
    </div>
@endsection
