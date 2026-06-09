@extends('layouts.form')

@section('title', 'WhoTouchedIt - Détail de la machine')

@section('content')
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <div class="w-11 h-11 rounded-xl bg-blue-950 flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2v-4M9 21H5a2 2 0 01-2-2v-4m0 0h18"/>
            </svg>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-white">{{ $machine->nom }}</h2>
            <p class="text-sm text-gray-400">Fiche de consultation — lecture seule</p>
        </div>
        <div class="ml-auto">
            @php
                $etatConfig = match($machine->etat) {
                    'opérationnelle' => ['label' => 'Opérationnelle', 'class' => 'bg-green-900/40 text-green-400 ring-1 ring-green-700'],
                    'en_maintenance' => ['label' => 'En maintenance', 'class' => 'bg-yellow-900/40 text-yellow-400 ring-1 ring-yellow-700'],
                    'planifiée'      => ['label' => 'Planifiée',      'class' => 'bg-blue-900/40 text-blue-400 ring-1 ring-blue-700'],
                    'hors_service'   => ['label' => 'Hors service',   'class' => 'bg-red-900/40 text-red-400 ring-1 ring-red-700'],
                    default          => ['label' => 'En panne',       'class' => 'bg-orange-900/40 text-orange-400 ring-1 ring-orange-700'],
                };
            @endphp
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium {{ $etatConfig['class'] }}">
                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                {{ $etatConfig['label'] }}
            </span>
        </div>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-2 gap-4 mb-4">

        <!-- Identification -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <p class="text-xs uppercase tracking-widest text-gray-500 font-medium mb-4">Identification</p>
            <div class="space-y-0 divide-y divide-slate-800">
                <div class="flex items-center gap-3 py-3">
                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                    </svg>
                    <span class="text-sm text-gray-400 w-32 flex-shrink-0">ID</span>
                    <span class="text-sm font-medium text-white">#{{ $machine->idMachine }}</span>
                </div>
                <div class="flex items-center gap-3 py-3">
                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 014-4z"/>
                    </svg>
                    <span class="text-sm text-gray-400 w-32 flex-shrink-0">Référence</span>
                    <span class="text-sm font-medium text-white">{{ $machine->reference }}</span>
                </div>
                <div class="flex items-center gap-3 py-3">
                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm text-gray-400 w-32 flex-shrink-0">Installation</span>
                    <span class="text-sm font-medium text-white">
                        {{ \Carbon\Carbon::parse($machine->dateInstallation)->format('d/m/Y') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Localisation & Criticité -->
        <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
            <p class="text-xs uppercase tracking-widest text-gray-500 font-medium mb-4">Localisation & criticité</p>
            <div class="space-y-0 divide-y divide-slate-800">
                <div class="flex items-center gap-3 py-3">
                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-sm text-gray-400 w-32 flex-shrink-0">Localisation</span>
                    <span class="text-sm font-medium text-white">{{ $machine->localisation }}</span>
                </div>
                <div class="flex items-center gap-3 py-3">
                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span class="text-sm text-gray-400 w-32 flex-shrink-0">Criticité</span>
                    @php
                        $criticiteConfig = match($machine->criticite) {
                            'critique' => ['class' => 'bg-red-900/40 text-red-400 ring-1 ring-red-700',       'label' => 'Critique'],
                            'moyen'    => ['class' => 'bg-yellow-900/40 text-yellow-400 ring-1 ring-yellow-700', 'label' => 'Moyen'],
                            default    => ['class' => 'bg-slate-700 text-gray-300 ring-1 ring-slate-600',      'label' => 'Faible'],
                        };
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $criticiteConfig['class'] }}">
                        {{ $criticiteConfig['label'] }}
                    </span>
                </div>
                <div class="flex items-center gap-3 py-3">
                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm text-gray-400 w-32 flex-shrink-0">État</span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $etatConfig['class'] }}">
                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                        {{ $etatConfig['label'] }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Notes -->
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 mb-6">
        <p class="text-xs uppercase tracking-widest text-gray-500 font-medium mb-3">Notes</p>
        @if($machine->notes)
            <p class="text-sm text-gray-300 leading-relaxed">{{ $machine->notes }}</p>
        @else
            <p class="text-sm text-gray-500 italic">Aucune note renseignée.</p>
        @endif
    </div>

    <!-- Footer -->
    <div class="flex items-center justify-between">
        <div class="inline-flex items-center gap-2 text-xs text-gray-500 bg-slate-900 border border-slate-800 px-3 py-2 rounded-lg">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            Page en lecture seule — aucune modification possible
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ url()->previous() }}"
               class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition">
                Retour
            </a>
            @can('update-machine')
                <a href="{{ route('machine.update', $machine->idMachine) }}"
                   class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modifier
                </a>
            @endcan
        </div>
    </div>
@endsection
