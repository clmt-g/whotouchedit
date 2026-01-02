@extends('layouts.app')

@section('title', 'WhoTouchedIt - Utilisateurs')

@section('content')
    <div class="p-8">

        <!-- Page Title & Action -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">Utilisateurs</h2>
                <p class="text-gray-400">Gestion des techniciens et utilisateurs</p>
            </div>
            <a href="{{ route('user.add') }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouvel utilisateur
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
                            Prénom
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Rôle
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody id="search-table" class="divide-y divide-slate-800">
                    @foreach($users as $user)
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
                                    <span class="text-sm text-gray-300 font-mono">{{ $user->id }}</span>
                                </div>
                            </td>

                            <!-- Nom -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-300 font-medium">{{ $user->nom }}</span>
                                </div>
                            </td>

                            <!-- Prénom -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-300 font-medium">{{ $user->prenom }}</span>
                            </td>

                            <!-- Email -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-purple-500/10 border border-purple-500/20 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <a href="mailto:{{ $user->email }}"
                                       class="text-sm text-purple-400 hover:text-purple-300 font-medium underline decoration-purple-400/30 hover:decoration-purple-300 underline-offset-2 transition-colors">
                                        {{ $user->email }}
                                    </a>
                                </div>
                            </td>

                            <!-- Rôle avec badges colorés -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $roleConfig = [
                                        'admin' => ['bg' => 'bg-red-500/10', 'text' => 'text-red-400', 'border' => 'border-red-500/20', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                                        'technicien' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'border' => 'border-blue-500/20', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                                        'utilisateur' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'border' => 'border-green-500/20', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                                    ];
                                    $config = $roleConfig[$user->role] ?? $roleConfig['utilisateur'];
                                @endphp
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $config['bg'] }} {{ $config['border'] }} {{ $config['text'] }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"/>
                                    </svg>
                                    <span class="text-sm font-medium">{{ ucfirst($user->role) }}</span>
                                </span>
                            </td>

                            <!-- Actions avec effets hover -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('user.detail', $user->id) }}" title="Voir les détails"
                                       class="p-2 text-gray-400 hover:text-blue-400 hover:bg-blue-500/10 rounded-lg transition-all duration-200 hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="#" title="Modifier le mot de passe"
                                       class="p-2 text-gray-400 hover:text-orange-400 hover:bg-orange-500/10 rounded-lg transition-all duration-200 hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('user.update', $user->id) }}" title="Modifier"
                                       class="p-2 text-gray-400 hover:text-green-400 hover:bg-green-500/10 rounded-lg transition-all duration-200 hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('user.do_delete', $user->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
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
