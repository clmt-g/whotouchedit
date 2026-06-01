@extends('layouts.form')

@section('title', 'WhoTouchedIt - Historique des interventions')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Historique des interventions</h2>
            <p class="text-gray-400">Machine : {{ $machine->nom ?? 'N°' . $machine->idMachine }}</p>
        </div>
        <a href="{{ url()->previous() }}"
           class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition">
            Retour
        </a>
    </div>

    <!-- Switch Tabs -->
    <div class="flex gap-1 bg-slate-900 border border-slate-800 rounded-xl p-1 mb-6 w-fit">
        <button
            onclick="switchTab('interventions')"
            id="tab-interventions"
            class="tab-btn px-5 py-2 rounded-lg text-sm font-medium transition-all duration-200 bg-blue-600 text-white"
        >
            Interventions
            <span class="ml-2 bg-blue-500/40 text-blue-200 text-xs px-2 py-0.5 rounded-full">
                {{ $interventions->count() }}
            </span>
        </button>
        <button
            onclick="switchTab('planifiees')"
            id="tab-planifiees"
            class="tab-btn px-5 py-2 rounded-lg text-sm font-medium transition-all duration-200 text-gray-400 hover:text-white"
        >
            Planifiées
            <span class="ml-2 bg-slate-700 text-gray-400 text-xs px-2 py-0.5 rounded-full">
                {{ $interventions_planifiees->count() }}
            </span>
        </button>
    </div>

    <!-- Tableau Interventions -->
    <div id="panel-interventions">
        <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-x-auto">
            @if($interventions->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <svg class="w-12 h-12 text-slate-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p class="text-gray-400 font-medium">Aucune intervention enregistrée</p>
                    <p class="text-gray-600 text-sm mt-1">Cette machine n'a pas encore d'historique d'interventions.</p>
                </div>
            @else
                <table class="w-full min-w-max text-sm">
                    <thead>
                    <tr class="border-b border-slate-800 bg-slate-800/50 text-gray-400 text-xs uppercase tracking-wider">
                        <th class="text-left px-6 py-4 font-medium">Période</th>
                        <th class="text-left px-6 py-4 font-medium">Statut</th>
                        <th class="text-left px-6 py-4 font-medium">Description</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                    @foreach($interventions as $intervention)
                        @php
                            $statutColors = [
                                'terminée'  => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/20', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'en_cours'  => ['bg' => 'bg-blue-500/10',  'text' => 'text-blue-400',  'border' => 'border-blue-500/20',  'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                                'annulée'   => ['bg' => 'bg-red-500/10',   'text' => 'text-red-400',   'border' => 'border-red-500/20',   'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'en_attente'=> ['bg' => 'bg-yellow-500/10','text' => 'text-yellow-400','border' => 'border-yellow-500/20','icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ];
                            $sc = $statutColors[$intervention->statut] ?? ['bg' => 'bg-slate-700/50', 'text' => 'text-gray-400', 'border' => 'border-slate-600', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'];
                        @endphp
                        <tr class="hover:bg-slate-800/30 transition">
                            <!-- Période -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs font-medium text-green-400">Début :</span>
                                        <span class="text-sm text-white">{{ \Carbon\Carbon::parse($intervention->dateHeureDebut)->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs font-medium text-red-400">Fin :</span>
                                        @if($intervention->dateHeureFin)
                                            <span class="text-sm text-white">{{ \Carbon\Carbon::parse($intervention->dateHeureFin)->format('d/m/Y H:i') }}</span>
                                        @else
                                            <span class="text-sm text-gray-600">—</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Statut -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $sc['bg'] }} {{ $sc['border'] }} {{ $sc['text'] }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sc['icon'] }}"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ ucfirst(str_replace('_', ' ', $intervention->statut)) }}</span>
                                    </span>
                            </td>

                            <!-- Description -->
                            <td class="px-6 py-4 text-gray-400 max-w-xs">
                                {{ \Str::limit($intervention->description ?? '—', 60) }}
                            </td>

                            <!-- Action -->
                            <td class="px-6 py-4 text-right">
                                @can('detail-intervention', $intervention)
                                    <a href="{{ route('intervention.detail', $intervention->idIntervention) }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-white text-xs font-medium rounded-lg transition border border-slate-700">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Détails
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Tableau Interventions Planifiées -->
    <div id="panel-planifiees" class="hidden">
        <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-x-auto">
            @if($interventions_planifiees->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <svg class="w-12 h-12 text-slate-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-400 font-medium">Aucune intervention planifiée</p>
                    <p class="text-gray-600 text-sm mt-1">Aucune intervention n'est planifiée pour cette machine.</p>
                </div>
            @else
                <table class="w-full min-w-max text-sm">
                    <thead>
                    <tr class="border-b border-slate-800 bg-slate-800/50 text-gray-400 text-xs uppercase tracking-wider">
                        <th class="text-left px-6 py-4 font-medium">Période</th>
                        <th class="text-left px-6 py-4 font-medium">Type</th>
                        <th class="text-left px-6 py-4 font-medium">Statut</th>
                        <th class="text-left px-6 py-4 font-medium">Fréquence</th>
                        <th class="text-left px-6 py-4 font-medium">Description</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                    @foreach($interventions_planifiees as $planifiee)
                        @php
                            $typeConfig = [
                                'preventive'          => ['bg' => 'bg-blue-500/10',   'text' => 'text-blue-400',   'border' => 'border-blue-500/20',   'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                                'controle_periodique' => ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-400', 'border' => 'border-purple-500/20', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                                'calibration'         => ['bg' => 'bg-orange-500/10', 'text' => 'text-orange-400', 'border' => 'border-orange-500/20', 'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'],
                                'amelioration'        => ['bg' => 'bg-cyan-500/10',   'text' => 'text-cyan-400',   'border' => 'border-cyan-500/20',   'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                            ];
                            $tc = $typeConfig[$planifiee->type] ?? $typeConfig['preventive'];

                            $statutConfig = [
                                'planifiée' => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                'en_cours'  => ['bg' => 'bg-blue-500/10',   'text' => 'text-blue-400',   'border' => 'border-blue-500/20',   'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                                'terminée'  => ['bg' => 'bg-green-500/10',  'text' => 'text-green-400',  'border' => 'border-green-500/20',  'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'annulée'   => ['bg' => 'bg-red-500/10',    'text' => 'text-red-400',    'border' => 'border-red-500/20',    'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ];
                            $sc = $statutConfig[$planifiee->statut] ?? ['bg' => 'bg-slate-700/50', 'text' => 'text-gray-400', 'border' => 'border-slate-600', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'];

                            $frequenceConfig = [
                                'quotidienne'   => ['bg' => 'bg-red-500/10',    'text' => 'text-red-400',    'border' => 'border-red-500/20',    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'hebdomadaire'  => ['bg' => 'bg-orange-500/10', 'text' => 'text-orange-400', 'border' => 'border-orange-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                'mensuelle'     => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                'trimestrielle' => ['bg' => 'bg-green-500/10',  'text' => 'text-green-400',  'border' => 'border-green-500/20',  'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                'annuelle'      => ['bg' => 'bg-blue-500/10',   'text' => 'text-blue-400',   'border' => 'border-blue-500/20',   'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                'ponctuelle'    => ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-400', 'border' => 'border-purple-500/20', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
                            ];
                            $fc = $frequenceConfig[$planifiee->frequence] ?? $frequenceConfig['ponctuelle'];
                        @endphp
                        <tr class="hover:bg-slate-800/30 transition">
                            <!-- Période -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs font-medium text-green-400">Début :</span>
                                        <span class="text-sm text-white">{{ \Carbon\Carbon::parse($planifiee->dateDebut)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs font-medium text-red-400">Fin :</span>
                                        @if($planifiee->dateFin)
                                            <span class="text-sm text-white">{{ \Carbon\Carbon::parse($planifiee->dateFin)->format('d/m/Y') }}</span>
                                        @else
                                            <span class="text-sm text-gray-600">—</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Type -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $tc['bg'] }} {{ $tc['border'] }} {{ $tc['text'] }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $tc['icon'] }}"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ ucfirst(str_replace('_', ' ', $planifiee->type ?? '—')) }}</span>
                                    </span>
                            </td>

                            <!-- Statut -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $sc['bg'] }} {{ $sc['border'] }} {{ $sc['text'] }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sc['icon'] }}"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ ucfirst(str_replace('_', ' ', $planifiee->statut)) }}</span>
                                    </span>
                            </td>

                            <!-- Fréquence -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $fc['bg'] }} {{ $fc['border'] }} {{ $fc['text'] }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $fc['icon'] }}"/>
                                        </svg>
                                        <span class="text-sm font-medium">{{ ucfirst($planifiee->frequence ?? '—') }}</span>
                                    </span>
                            </td>

                            <!-- Description -->
                            <td class="px-6 py-4 text-gray-400 max-w-xs">
                                {{ \Str::limit($planifiee->description ?? '—', 60) }}
                            </td>

                            <!-- Action -->
                            <td class="px-6 py-4 text-right">
                                @can('detail-intervention-planifiee', $planifiee)
                                    <a href="{{ route('intervention_planifiee.detail', $planifiee->idInterventionPlanifiee) }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-white text-xs font-medium rounded-lg transition border border-slate-700">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Détails
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function switchTab(tab) {
            document.getElementById('panel-interventions').classList.toggle('hidden', tab !== 'interventions');
            document.getElementById('panel-planifiees').classList.toggle('hidden', tab !== 'planifiees');

            const tabInterventions = document.getElementById('tab-interventions');
            const tabPlanifiees = document.getElementById('tab-planifiees');

            if (tab === 'interventions') {
                tabInterventions.classList.add('bg-blue-600', 'text-white');
                tabInterventions.classList.remove('text-gray-400', 'hover:text-white');
                tabPlanifiees.classList.remove('bg-blue-600', 'text-white');
                tabPlanifiees.classList.add('text-gray-400', 'hover:text-white');
            } else {
                tabPlanifiees.classList.add('bg-blue-600', 'text-white');
                tabPlanifiees.classList.remove('text-gray-400', 'hover:text-white');
                tabInterventions.classList.remove('bg-blue-600', 'text-white');
                tabInterventions.classList.add('text-gray-400', 'hover:text-white');
            }
        }
    </script>
@endpush
