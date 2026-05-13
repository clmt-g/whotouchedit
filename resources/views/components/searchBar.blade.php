<div class="bg-slate-900 border border-slate-800 rounded-xl p-6 mb-6">
    <div class="relative">
        <input
            id="search-input"
            type="text"
            placeholder="Rechercher..."
            class="w-full bg-slate-800 text-white pl-12 pr-4 py-3 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 transition"
        >

        <svg class="w-5 h-5 text-gray-400 absolute left-4 top-3.5"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>

        <!-- Bouton clear -->
        <button
            id="clear-search"
            type="button"
            class="hidden absolute right-4 top-3.5 text-gray-400 hover:text-white transition"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>

@push('scripts')
    <script>
        const searchInput = document.getElementById('search-input');
        const clearButton = document.getElementById('clear-search');
        const rows = document.querySelectorAll('#search-table tr');

        searchInput.addEventListener('input', () => {
            const query = searchInput.value.toLowerCase().trim();

            clearButton.classList.toggle('hidden', query === '');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });

        clearButton.addEventListener('click', () => {
            searchInput.value = '';
            clearButton.classList.add('hidden');

            rows.forEach(row => {
                row.style.display = '';
            });

            searchInput.focus();
        });
    </script>
@endpush

