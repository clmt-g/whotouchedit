<!-- Bloc d'affichage des erreurs de validation -->
@if ($errors->any())
    <div id="validation-errors" class="bg-red-500/90 border border-red-500 rounded-lg p-4 mb-6 shadow-lg transition-all duration-300">
        <div class="flex items-start gap-3">
            <div class="flex-1">
                <p class="text-white text-sm font-medium mb-2">Erreurs de validation :</p>
                <ul class="list-disc list-inside space-y-1 text-white text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" onclick="removeValidationErrors()" class="text-white hover:text-gray-200 transition flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    @push('scripts')
        <script>
            function removeValidationErrors() {
                const element = document.getElementById('validation-errors');
                if (element) {
                    element.classList.add('opacity-0', 'transform', 'scale-95');
                    setTimeout(() => element.remove(), 300);
                }
            }

            // Disparition automatique après 5 secondes
            setTimeout(() => {
                removeValidationErrors();
            }, 5000);
        </script>
    @endpush
@endif
