<!-- Toast Container -->
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-4"></div>

@push('scripts')
    <script>
        function showToast(type, message) {
            const container = document.getElementById('toast-container');

            const config = {
                success: {
                    bg: 'bg-green-500/10',
                    border: 'border-green-500',
                    text: 'text-green-400',
                    icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>`
                },
                error: {
                    bg: 'bg-red-500/10',
                    border: 'border-red-500',
                    text: 'text-red-400',
                    icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>`
                },
                warning: {
                    bg: 'bg-orange-500/10',
                    border: 'border-orange-500',
                    text: 'text-orange-400',
                    icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>`
                },
                info: {
                    bg: 'bg-blue-500/10',
                    border: 'border-blue-500',
                    text: 'text-blue-400',
                    icon: `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>`
                }
            };

            const style = config[type] || config.info;

            const toast = document.createElement('div');
            toast.className = `${style.bg} border ${style.border} rounded-lg p-4 min-w-[320px] max-w-md shadow-lg transform transition-all duration-300 ease-out translate-x-[400px] opacity-0`;

            toast.innerHTML = `
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 ${style.text} flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    ${style.icon}
                </svg>
                <div class="flex-1">
                    <p class="${style.text} text-sm font-medium">${message}</p>
                </div>
                <button onclick="this.closest('div').parentElement.remove()"
                        class="text-gray-400 hover:text-white transition flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;

            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('translate-x-[400px]', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 10);

            setTimeout(() => {
                toast.classList.add('translate-x-[400px]', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }

        // Affichage automatique au chargement
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
            showToast('success', "{{ session('success') }}");
            @endif

            @if(session('error'))
            showToast('error', "{{ session('error') }}");
            @endif

            @if(session('warning'))
            showToast('warning', "{{ session('warning') }}");
            @endif

            @if(session('info'))
            showToast('info', "{{ session('info') }}");
            @endif
        });
    </script>
@endpush
