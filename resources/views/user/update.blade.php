@extends('layouts.form')

@section('title', 'WhoTouchedIt - Modifier utilisateur')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Modifier l'utilisateur</h2>
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
    <form method="POST" action="{{ route('user.do_update', $user->id) }}">

        @method('PUT')
        @csrf

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
                            required
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
                            required
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
                            required
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
                            required
                        >
                    </div>

                    <!-- Rôle -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Rôle
                            <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="role"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required
                        >
                            <option value="">-- Sélectionner --</option>
                            <option value="technicien" @if( $user->role == 'technicien') selected @endif>Technicien</option>
                            <option value="responsable" @if( $user->role == 'responsable') selected @endif>Responsable</option>
                            <option value="admin" @if( $user->role == 'admin') selected @endif>Admin</option>
                            <option value="direction" @if( $user->role == 'direction') selected @endif>Direction</option>
                        </select>
                    </div>

                    <!-- Info mot de passe -->
                    <div class="bg-blue-500/10 border border-blue-500/20 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                            <div>
                                <h4 class="text-sm font-medium text-blue-400 mb-1">Modification du mot de passe</h4>
                                <p class="text-xs text-blue-300/70">Pour modifier le mot de passe, veuillez utiliser le
                                    bouton "Modifier le mot de passe" ci-dessous.</p>
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
                    <a href="{{ route('user.update_password', $user->id) }}"
                       class="px-6 py-2.5 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                        Modifier le mot de passe
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Enregistrer les modifications
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
