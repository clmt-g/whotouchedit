@extends('layouts.form')

@section('title', 'WhoTouchedIt - Modifier le mot de passe')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Modifier le mot de passe</h2>
            <p class="text-gray-400">Sécurité du compte</p>
        </div>
        <a href="{{ route('user') }}"
           class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>

    <form action="{{ route('user.do_update_password', $user->id) }}" method="POST" id="passwordForm">
        @csrf
        @method('PUT')

        @include('components.validationToast')

        <div class="bg-slate-900 border border-slate-800 rounded-xl p-8 max-w-2xl mx-auto space-y-6">

            <!-- Ancien mot de passe -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Ancien mot de passe <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="password"
                           name="current_password"
                           id="current_password"
                           required
                           class="w-full bg-slate-800 text-white px-4 py-2.5 pr-10 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    <button type="button" onclick="togglePassword('current_password')"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-white transition">
                        <svg id="eyeIcon-current_password" class="w-5 h-5" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Nouveau mot de passe -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Nouveau mot de passe <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="password"
                           name="password"
                           id="password"
                           required
                           class="w-full bg-slate-800 text-white px-4 py-2.5 pr-10 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    <button type="button" onclick="togglePassword('password')"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-white transition">
                        <svg id="eyeIcon-password" class="w-5 h-5" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>

                <div class="mt-6 bg-blue-500/10 border border-blue-500/20 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h4 class="text-sm font-medium text-blue-400 mb-2">Exigences du mot de passe</h4>
                            <ul class="space-y-1 text-xs text-blue-300/70">
                                <li id="req-length" class="flex items-center gap-2">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                    Au moins 12 caractères
                                </li>
                                <li id="req-uppercase" class="flex items-center gap-2">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                    Une lettre majuscule
                                </li>
                                <li id="req-lowercase" class="flex items-center gap-2">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                    Une lettre minuscule
                                </li>
                                <li id="req-number" class="flex items-center gap-2">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                    Un chiffre
                                </li>
                                <li id="req-special" class="flex items-center gap-2">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
                                    Un caractère spécial
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmation -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Confirmer le nouveau mot de passe <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           required
                           class="w-full bg-slate-800 text-white px-4 py-2.5 pr-10 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    <button type="button" onclick="togglePassword('password_confirmation')"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-white transition">
                        <svg id="eyeIcon-password_confirmation" class="w-5 h-5" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                <p id="password-match" class="text-xs mt-1 hidden"></p>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-4 pt-6 border-t border-slate-800">
                <a href="{{ route('user') }}"
                   class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-medium rounded-lg transition">
                    Annuler
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                    Mettre à jour
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
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

