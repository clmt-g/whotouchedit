@extends('layouts.form')

@section('title', 'WhoTouchedIt - Détail utilisateur')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Détail de l'utilisateur</h2>
            <p class="text-gray-400">Informations du profil</p>
        </div>
        <a href="{{ route('user') }}"
           class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-8">
        <!-- Grid 2 colonnes -->
        <div class="grid grid-cols-2 gap-6">
            <!-- Colonne Gauche -->
            <div class="space-y-6">
                <!-- Id -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        ID
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="id"
                        value="{{ $user->id }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
                    >
                </div>

                <!-- Nom -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Nom
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="nom"
                        value="{{ $user->nom }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
                    >
                </div>

                <!-- Prénom -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Prénom
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="prenom"
                        value="{{ $user->prenom }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
                    >
                </div>
            </div>

            <!-- Colonne Droite -->
            <div class="space-y-6">
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Email
                        <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ $user->email }}"
                        class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        readonly
                    >
                </div>

                <!-- Rôle -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Rôle
                        <span class="text-red-500">*</span>
                    </label>
                    @php
                        $roleConfig = [
                            'admin' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/20', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                            'technicien' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'border' => 'border-blue-500/20', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                            'utilisateur' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/20', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                        ];
                        $config = $roleConfig[$user->role] ?? $roleConfig['utilisateur'];
                    @endphp
                    <div class="w-full bg-slate-800 px-4 py-2.5 rounded-lg border border-slate-700">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $config['bg'] }} {{ $config['border'] }} {{ $config['text'] }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"/>
                            </svg>
                            <span class="text-sm font-medium">{{ ucfirst($user->role) }}</span>
                        </span>
                    </div>
                </div>

                <!-- Info mot de passe -->
                <div class="bg-blue-500/10 border border-blue-500/20 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-blue-400 mb-1">Modification du mot de passe</h4>
                            <p class="text-xs text-blue-300/70">Pour modifier le mot de passe, veuillez utiliser le bouton "Modifier le mot de passe" ci-dessous.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-800">
            <a href="{{ route('user') }}"
               class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition">
                Retour
            </a>
            <div class="flex gap-4">
                <a href="#"
                   class="px-6 py-2.5 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    Modifier le mot de passe
                </a>
                <a href="#"
                   class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modifier
                </a>
            </div>
        </div>
    </div>
@endsection
