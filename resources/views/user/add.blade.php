@extends('layouts.form')

@section('title', 'WhoTouchedIt - Ajouter un utilisateur')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Ajouter un utilisateur</h2>
            <p class="text-gray-400">Informations du profil</p>
        </div>
    </div>

    <!-- Form Card -->
    <form action="{{ route('user.do_add') }}" method="POST" id="userForm">

        @csrf

        <!-- toast d'affichage des erreurs lié à la validation des données -->
        @include('components.validationToast')

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-8">
            <!-- Grid 2 colonnes -->
            <div class="grid grid-cols-2 gap-6">
                <!-- Colonne Gauche -->
                <div class="space-y-6">

                    <!-- Nom -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Nom
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="nom"
                            placeholder="Dupont"
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
                            placeholder="Marie"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required
                        >
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Email
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            placeholder="m.dupond@whotouchedit.fr"
                            class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required
                        >
                    </div>
                </div>

                <!-- Colonne Droite -->
                <div class="space-y-6">

                    <!-- Rôle avec badges colorés -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Rôle
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select
                                name="role"
                                id="roleSelect"
                                class="w-full bg-slate-800 text-white px-4 py-2.5 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition appearance-none"
                                required
                            >
                                <option value="">-- Sélectionner un rôle --</option>
                                <option value="technicien">Technicien</option>
                                <option value="responsable">Responsable</option>
                                <option value="admin">Administrateur</option>
                                <option value="direction">Direction</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Prévisualisation du badge de rôle -->
                        <div id="roleBadgePreview" class="mt-3 hidden">
                            <div class="bg-slate-800 px-4 py-2.5 rounded-lg border border-slate-700">
                                <span id="roleBadge" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border">
                                    <svg id="roleIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d=""/>
                                    </svg>
                                    <span id="roleText" class="text-sm font-medium"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Mot de passe
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="w-full bg-slate-800 text-white px-4 py-2.5 pr-10 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                                required
                            >
                            <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-white transition">
                                <svg id="eyeIcon-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Confirmer le mot de passe
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="w-full bg-slate-800 text-white px-4 py-2.5 pr-10 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                                required
                            >
                            <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-white transition">
                                <svg id="eyeIcon-password_confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        <p id="password-match" class="text-xs mt-1 hidden"></p>
                    </div>
                </div>
            </div>

            <!-- Info mot de passe -->
            <div class="mt-6 bg-blue-500/10 border border-blue-500/20 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="text-sm font-medium text-blue-400 mb-2">Exigences du mot de passe</h4>
                        <ul class="space-y-1 text-xs text-blue-300/70">
                            <li id="req-length" class="flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Au moins 12 caractères
                            </li>
                            <li id="req-uppercase" class="flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Une lettre majuscule
                            </li>
                            <li id="req-lowercase" class="flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Une lettre minuscule
                            </li>
                            <li id="req-number" class="flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Un chiffre
                            </li>
                            <li id="req-special" class="flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Un caractère spécial (!@#$%^&*)
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-slate-800">
                <a href="{{ url()->previous() }}"
                   class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition">
                    Annuler
                </a>
                @can('add-user')
                    <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Créer l'utilisateur
                    </button>
                @endcan
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // Configuration des rôles
        const roleConfig = {
            'admin': {
                bg: 'bg-red-500/10',
                text: 'text-red-400',
                border: 'border-red-500/20',
                icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                label: 'Administrateur'
            },
            'technicien': {
                bg: 'bg-blue-500/10',
                text: 'text-blue-400',
                border: 'border-blue-500/20',
                icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                label: 'Technicien'
            },
            'responsable': {
                bg: 'bg-purple-500/10',
                text: 'text-purple-400',
                border: 'border-purple-500/20',
                icon: 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                label: 'Responsable'
            },
            'direction': {
                bg: 'bg-yellow-500/10',
                text: 'text-yellow-400',
                border: 'border-yellow-500/20',
                icon: 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
                label: 'Direction'
            }
        };

        // Prévisualisation du badge de rôle
        document.getElementById('roleSelect').addEventListener('change', function() {
            const role = this.value;
            const preview = document.getElementById('roleBadgePreview');
            const badge = document.getElementById('roleBadge');
            const icon = document.getElementById('roleIcon');
            const text = document.getElementById('roleText');

            if (role && roleConfig[role]) {
                const config = roleConfig[role];

                badge.className = `inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border ${config.bg} ${config.border} ${config.text}`;
                icon.querySelector('path').setAttribute('d', config.icon);
                text.textContent = config.label;

                preview.classList.remove('hidden');
            } else {
                preview.classList.add('hidden');
            }
        });

        // Toggle visibility du mot de passe
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById('eyeIcon-' + fieldId);

            if (field.type === 'password') {
                field.type = 'text';
                icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
            `;
            } else {
                field.type = 'password';
                icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            `;
            }
        }

        // Validation du mot de passe
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');

        function updateRequirement(id, valid) {
            const elem = document.getElementById(id);
            const icon = elem.querySelector('svg');

            if (valid) {
                elem.classList.remove('text-blue-300/70');
                elem.classList.add('text-green-400');
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>`;
            } else {
                elem.classList.remove('text-green-400');
                elem.classList.add('text-blue-300/70');
                icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>`;
            }
        }

        function checkPasswordStrength(password) {
            const requirements = {
                length: password.length >= 12,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /[0-9]/.test(password),
                special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
            };

            updateRequirement('req-length', requirements.length);
            updateRequirement('req-uppercase', requirements.uppercase);
            updateRequirement('req-lowercase', requirements.lowercase);
            updateRequirement('req-number', requirements.number);
            updateRequirement('req-special', requirements.special);

            const strength = Object.values(requirements).filter(Boolean).length;
            const strengthText = document.getElementById('strength-text');

            if (password.length === 0) {
                strengthText.textContent = '';
                return false;
            }

            if (strength <= 2) {
                strengthText.textContent = 'Mot de passe faible';
                strengthText.className = 'text-xs text-red-400 mt-1';
            } else if (strength === 3) {
                strengthText.textContent = 'Mot de passe moyen';
                strengthText.className = 'text-xs text-orange-400 mt-1';
            } else if (strength === 4) {
                strengthText.textContent = 'Mot de passe bon';
                strengthText.className = 'text-xs text-yellow-400 mt-1';
            } else {
                strengthText.textContent = 'Mot de passe excellent';
                strengthText.className = 'text-xs text-green-400 mt-1';
            }

            return Object.values(requirements).every(Boolean);
        }

        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirm = confirmInput.value;
            const matchText = document.getElementById('password-match');

            if (confirm.length === 0) {
                matchText.classList.add('hidden');
                return true;
            }

            matchText.classList.remove('hidden');

            if (password === confirm) {
                matchText.textContent = '✓ Les mots de passe correspondent';
                matchText.className = 'text-xs text-green-400 mt-1';
                return true;
            } else {
                matchText.textContent = '✗ Les mots de passe ne correspondent pas';
                matchText.className = 'text-xs text-red-400 mt-1';
                return false;
            }
        }

        passwordInput.addEventListener('input', function() {
            checkPasswordStrength(this.value);
            if (confirmInput.value.length > 0) {
                checkPasswordMatch();
            }
        });

        confirmInput.addEventListener('input', checkPasswordMatch);

        // Validation du formulaire
        document.getElementById('userForm').addEventListener('submit', function(e) {
            const password = passwordInput.value;
            const isPasswordValid = checkPasswordStrength(password);
            const doPasswordsMatch = checkPasswordMatch();

            if (!isPasswordValid) {
                e.preventDefault();
                alert('Le mot de passe ne respecte pas tous les critères de sécurité.');
                return false;
            }

            if (!doPasswordsMatch) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas.');
                return false;
            }
        });
    </script>
@endpush
