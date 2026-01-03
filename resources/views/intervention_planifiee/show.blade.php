@extends('layouts.app')

@section('title', 'WhoTouchedIt - Interventions Planifiées')

@section('content')
    <div class="p-8">

        <!-- Page Title & Action -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">Interventions Planifiées</h2>
                <p class="text-gray-400">Planification et suivi des interventions préventives</p>
            </div>
            <a href="{{ route('intervention_planifiee.add') }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouvelle intervention planifiée
            </a>
        </div>

        <!-- Search Bar -->
        @include('components.searchBar')

        <!-- Table -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            #
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Id
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Période
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Machine
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Technicien
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Fréquence
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody id="search-table" class="divide-y divide-slate-800">
                    @foreach($interventions as $intervention)
                        <tr class="hover:bg-slate-800/30 transition">
                            <!-- # -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-lg shadow-blue-500/20">
                                        <span class="text-sm font-bold text-white">{{ $loop->iteration }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Id -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-300 font-mono">{{ $intervention->idInterventionPlanifiee }}</span>
                                </div>
                            </td>

                            <!-- Date/heure -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="flex flex-col">
                                        <div class="flex items-center gap-2 mb-1">
                                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span class="text-xs font-medium text-green-400">Début:</span>
                                            <span class="text-sm text-white">{{ \Carbon\Carbon::parse($intervention->dateDebut)->format('d/m/Y H:i') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span class="text-xs font-medium text-red-400">Fin:</span>
                                            <span class="text-sm text-white">{{ \Carbon\Carbon::parse($intervention->dateFin)->format('d/m/Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Type avec badges colorés -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $typeConfig = [
                                        'preventive' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'border' => 'border-blue-500/20', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                                        'controle_periodique' => ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-400', 'border' => 'border-purple-500/20', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                                        'calibration' => ['bg' => 'bg-orange-500/10', 'text' => 'text-orange-400', 'border' => 'border-orange-500/20', 'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'],
                                        'amelioration' => ['bg' => 'bg-cyan-500/10', 'text' => 'text-cyan-400', 'border' => 'border-cyan-500/20', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                                    ];
                                    $config = $typeConfig[$intervention->type] ?? $typeConfig['preventive'];
                                @endphp
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $config['bg'] }} {{ $config['border'] }} {{ $config['text'] }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ ucfirst(str_replace('_', ' ', $intervention->type)) }}</span>
                                </span>
                            </td>

                            <!-- Machine avec icône -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                        </svg>
                                    </div>
                                    <a href="{{ route('machine.detail', $intervention->idMachine) }}"
                                       class="text-sm text-purple-400 hover:text-purple-300 font-medium underline decoration-purple-400/30 hover:decoration-purple-300 underline-offset-2 transition-colors">
                                        {{ $intervention->machine->nom }}
                                    </a>
                                </div>
                            </td>

                            <!-- Techniciens -->
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($intervention->techniciens as $technicien)
                                        <a href="{{ route('user.detail', $technicien->id) }}"
                                           class="inline-flex items-center gap-1.5 px-2 py-1 bg-slate-800 border border-slate-700 rounded-md hover:border-blue-500 hover:bg-slate-750 transition-all group">
                                            <div class="w-5 h-5 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                                <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                            <span class="text-xs text-gray-300 group-hover:text-white font-medium whitespace-nowrap transition-colors">{{ $technicien->nom }} {{ $technicien->prenom }}</span>
                                        </a>
                                    @empty
                                        <span class="text-sm text-gray-500 italic">Aucun technicien assigné</span>
                                    @endforelse
                                </div>
                            </td>

                            <!-- Statut avec badges colorés -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statutConfig = [
                                        'planifiee' => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                        'en_cours' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'border' => 'border-blue-500/20', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                                        'terminee' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/20', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        'annulee' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/20', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    ];
                                    $configStatut = $statutConfig[$intervention->statut] ?? $statutConfig['planifiee'];
                                @endphp
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $configStatut['bg'] }} {{ $configStatut['border'] }} {{ $configStatut['text'] }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $configStatut['icon'] }}"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ ucfirst(str_replace('_', ' ', $intervention->statut)) }}</span>
                                </span>
                            </td>

                            <!-- Fréquence avec badges colorés -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $frequenceConfig = [
                                        'quotidienne' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/20', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        'hebdomadaire' => ['bg' => 'bg-orange-500/10', 'text' => 'text-orange-400', 'border' => 'border-orange-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                        'mensuelle' => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                        'trimestrielle' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                        'annuelle' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'border' => 'border-blue-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                        'ponctuelle' => ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-400', 'border' => 'border-purple-500/20', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
                                    ];
                                    $configFreq = $frequenceConfig[$intervention->frequence] ?? $frequenceConfig['ponctuelle'];
                                @endphp
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $configFreq['bg'] }} {{ $configFreq['border'] }} {{ $configFreq['text'] }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $configFreq['icon'] }}"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ ucfirst($intervention->frequence) }}</span>
                                </span>
                            </td>

                            <!-- Actions avec effets hover -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('intervention_planifiee.detail', $intervention->idInterventionPlanifiee) }}" title="Voir les détails"
                                       class="p-2 text-gray-400 hover:text-blue-400 hover:bg-blue-500/10 rounded-lg transition-all duration-200 hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="#" title="Modifier"
                                       class="p-2 text-gray-400 hover:text-green-400 hover:bg-green-500/10 rounded-lg transition-all duration-200 hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="#" method="POST" class="inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette intervention planifiée ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Supprimer"
                                                class="p-2 text-gray-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-all duration-200 hover:scale-110">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
