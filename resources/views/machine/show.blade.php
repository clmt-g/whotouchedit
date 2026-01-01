@extends('layouts.app')

@section('title', 'WhoTouchedIt - machines')

@section('content')
    <div class="p-8">

        <!-- Page Title & Action -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">Machines</h2>
                <p class="text-gray-400">Gestion du parc machines</p>
            </div>
            <a href="{{ route('machine.add') }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouvelle machine
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
                            Nom
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Référence
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Date installation
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Etat
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Criticite
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Localisation
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody id="search-table" class="divide-y divide-slate-800">
                    @foreach($machines as $machine)
                        <tr class="hover:bg-slate-800/30 transition">
                            <!-- # -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center flex-shrink-0">
                                        <span class="text-sm font-semibold text-blue-500">{{ $loop->iteration }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Id -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-300 font-mono">{{ $machine->idMachine }}</span>
                            </td>

                            <!-- Nom -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $machine->nom }}</p>
                                </div>
                            </td>

                            <!-- Référence -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-300 font-mono">{{ $machine->reference }}</span>
                            </td>

                            <!-- Date installation -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                {{ $machine->dateInstallation }}
                            </td>

                            <!-- Etat -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($machine->etat)
                                    @case('opérationnelle')
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-green-400 bg-green-500/10 rounded">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                        Opérationnelle
                    </span>
                                        @break
                                    @case('en_maintenance')
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-orange-400 bg-orange-500/10 rounded">
                        <span class="w-1.5 h-1.5 bg-orange-500 rounded-full"></span>
                        En maintenance
                    </span>
                                        @break
                                    @case('planifiée')
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-blue-400 bg-blue-500/10 rounded">
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                        Planifiée
                    </span>
                                        @break
                                    @case('en_panne')
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-red-400 bg-red-500/10 rounded">
                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                        En panne
                    </span>
                                        @break
                                    @case('hors_service')
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium text-gray-400 bg-gray-500/10 rounded">
                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full"></span>
                        Hors service
                    </span>
                                        @break
                                @endswitch
                            </td>

                            <!-- Criticite -->
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                @switch($machine->criticite)
                                    @case('faible')
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-400 bg-green-500/10 rounded">
                        Faible
                    </span>
                                        @break
                                    @case('moyen')
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-orange-400 bg-orange-500/10 rounded">
                        Moyen
                    </span>
                                        @break
                                    @case('critique')
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-400 bg-red-500/10 rounded">
                        Critique
                    </span>
                                        @break
                                @endswitch
                            </td>

                            <!-- Localisation -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-sm text-gray-300">{{ $machine->localisation }}</span>
                                </div>
                            </td>

                            <!-- Action -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('machine.detail', $machine->idMachine) }}"
                                       class="p-2 text-gray-400 hover:text-blue-400 hover:bg-slate-800 rounded-lg transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('machine.update', $machine->idMachine) }}"
                                       class="p-2 text-gray-400 hover:text-green-400 hover:bg-slate-800 rounded-lg transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="#" method="POST" class="inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette machine ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 text-gray-400 hover:text-red-400 hover:bg-slate-800 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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
