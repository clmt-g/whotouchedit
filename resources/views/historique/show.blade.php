@extends('layouts.app')

@section('title', 'WhoTouchedIt - Historique global')

@section('content')
    <div class="p-8">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">Historique des interventions</h2>
                <p class="text-gray-400">Toutes les interventions curatives et préventives</p>
            </div>
            <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border bg-red-500/10 border-red-500/20 text-red-400 text-xs font-medium">
                <span class="w-2 h-2 rounded-full bg-red-400"></span>
                Curative
            </span>
                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border bg-blue-500/10 border-blue-500/20 text-blue-400 text-xs font-medium">
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                Préventive
            </span>
            </div>
        </div>

        <!-- Search Bar -->
        @include('components.searchBar')

        <!-- Table -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">#</th>

                        <x-filter-dropdown
                            id="type"
                            label="Type"
                            :options="[
                                ''           => 'Tous les types',
                                'Curative' => 'Curative',
                                'Préventive' => 'Préventive',
                            ]"
                        />

                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Id</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Période</th>

                        <!-- Filtre Statut -->
                        <x-filter-dropdown
                            id="statut"
                            label="Statut"
                            :options="[
                                ''           => 'Tous les statuts',
                                'en_attente' => 'En attente',
                                'en_cours'   => 'En cours',
                                'terminee'   => 'Terminée',
                                'annulee'    => 'Annulée',
                                'planifiee'  => 'Planifiée',
                            ]"
                        />

                        <!-- Filtre Machine -->
                        @php
                            $optionsMachines = ['' => 'Toutes les machines'];
                            foreach ($machines as $machine) {
                                $optionsMachines[$machine->nom] = $machine->nom;
                            }
                        @endphp
                        <x-filter-dropdown id="machine" label="Machine" :options="$optionsMachines" />

                        <!-- Filtre Technicien -->
                        @php
                            $optionsTech = ['' => 'Tous les techniciens'];
                            foreach ($users->where('role', 'technicien') as $user) {
                                $optionsTech[$user->nom . ' ' . $user->prenom] = $user->nom . ' ' . $user->prenom;
                            }
                        @endphp
                        <x-filter-dropdown id="technicien" label="Technicien" :options="$optionsTech" />
                    </tr>
                    </thead>
                    <tbody id="search-table" class="divide-y divide-slate-800">
                    @foreach($historique as $item)
                        @php
                            $isCurative = $item['type'] === 'curative';
                            $accentBg      = $isCurative ? 'bg-red-500/10'    : 'bg-blue-500/10';
                            $accentBorder  = $isCurative ? 'border-red-500/20' : 'border-blue-500/20';
                            $accentText    = $isCurative ? 'text-red-400'      : 'text-blue-400';
                            $accentDot     = $isCurative ? 'bg-red-400'        : 'bg-blue-400';
                            $typeLabel     = $isCurative ? 'Curative'          : 'Préventive';

                            $statutConfig = [
                                'en_attente' => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'en_cours'   => ['bg' => 'bg-blue-500/10',   'text' => 'text-blue-400',   'border' => 'border-blue-500/20',   'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                                'terminee'   => ['bg' => 'bg-green-500/10',  'text' => 'text-green-400',  'border' => 'border-green-500/20',  'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'annulee'    => ['bg' => 'bg-red-500/10',    'text' => 'text-red-400',    'border' => 'border-red-500/20',    'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'planifiee'  => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-400', 'border' => 'border-yellow-500/20', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                            ];
                            $sConfig = $statutConfig[$item['statut']] ?? $statutConfig['en_attente'];
                        @endphp
                        <tr class="hover:bg-slate-800/30 transition">

                            <!-- # -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-10 h-10 rounded-lg {{ $accentBg }} border {{ $accentBorder }} flex items-center justify-center flex-shrink-0">
                                    <span class="text-sm font-bold {{ $accentText }}">{{ $loop->iteration }}</span>
                                </div>
                            </td>

                            <!-- Type badge -->
                            <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $accentBg }} {{ $accentBorder }} {{ $accentText }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $accentDot }}"></span>
                                <span class="text-sm font-medium">{{ $typeLabel }}</span>
                            </span>
                            </td>

                            <!-- Id -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center">
                                        <svg class="w-4 h-4 {{ $accentText }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-300 font-mono">{{ $item['id'] }}</span>
                                </div>
                            </td>

                            <!-- Période -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs font-medium text-green-400">Début :</span>
                                        <span class="text-sm text-white">{{ \Carbon\Carbon::parse($item['dateDebut'])->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-xs font-medium text-red-400">Fin :</span>
                                        <span class="text-sm text-white">{{ \Carbon\Carbon::parse($item['dateFin'])->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Statut -->
                            <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $sConfig['bg'] }} {{ $sConfig['border'] }} {{ $sConfig['text'] }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sConfig['icon'] }}"/>
                                </svg>
                                <span class="text-sm font-medium">{{ ucfirst(str_replace('_', ' ', $item['statut'])) }}</span>
                            </span>
                            </td>

                            <!-- Machine -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                        </svg>
                                    </div>
                                    @if($item['machine'])
                                        <a href="{{ route('machine.detail', $item['machine']->idMachine) }}"
                                           class="text-sm text-purple-400 hover:text-purple-300 font-medium underline decoration-purple-400/30 underline-offset-2 transition-colors">
                                            {{ $item['machine']->nom }}
                                        </a>
                                    @else
                                        <em class="text-sm text-gray-500">Machine supprimée</em>
                                    @endif
                                </div>
                            </td>

                            <!-- Techniciens -->
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5">
                                    @forelse($item['techniciens'] as $technicien)
                                        <span class="inline-flex items-center gap-1.5 px-2 py-1 bg-slate-800 border border-slate-700 rounded-md">
                                        <div class="w-5 h-5 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
                                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <span class="text-xs text-gray-300 font-medium whitespace-nowrap">{{ $technicien->nom }} {{ $technicien->prenom }}</span>
                                    </span>
                                    @empty
                                        <em class="text-sm text-gray-500">Aucun technicien</em>
                                    @endforelse
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <x-paginator
                tableId="search-table"
                :defaultSize="10"
                :pageSizes="[5, 10, 25]"
            />
        </div>
    </div>
@endsection
