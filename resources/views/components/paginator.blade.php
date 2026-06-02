@props(['items', 'pageSizes' => [5, 10, 25], 'defaultSize' => 10, 'tableId' => 'search-table'])

<div
    x-data="{
        pageSize: {{ $defaultSize }},
        currentPage: 1,
        get totalPages() { return Math.ceil(this.totalRows / this.pageSize) },
        get totalRows() { return document.querySelectorAll('#{{ $tableId }} tr').length },
        updateVisibility() {
            const rows = document.querySelectorAll('#{{ $tableId }} tr');
            rows.forEach((row, i) => {
                row.style.display = (i >= (this.currentPage - 1) * this.pageSize && i < this.currentPage * this.pageSize)
                    ? '' : 'none';
            });
        },
        changePage(page) {
            if (page < 1 || page > this.totalPages) return;
            this.currentPage = page;
            this.updateVisibility();
        },
        changeSize(size) {
            this.pageSize = parseInt(size);
            this.currentPage = 1;
            this.updateVisibility();
        },
        get pages() {
            const range = [];
            const delta = 2;
            for (let i = Math.max(1, this.currentPage - delta); i <= Math.min(this.totalPages, this.currentPage + delta); i++) {
                range.push(i);
            }
            return range;
        }
    }"
    x-init="updateVisibility()"
    class="flex items-center justify-between px-6 py-4 border-t border-slate-800"
>
    <!-- Rows per page -->
    <div class="flex items-center gap-3">
        <span class="text-xs text-gray-400">Lignes par page :</span>
        <select
            @change="changeSize($event.target.value)"
            class="bg-slate-800 border border-slate-700 text-gray-300 text-xs rounded-lg px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-blue-500 cursor-pointer"
        >
            @foreach($pageSizes as $size)
                <option value="{{ $size }}" {{ $size == $defaultSize ? 'selected' : '' }}>{{ $size }}</option>
            @endforeach
        </select>
    </div>

    <!-- Info + Navigation -->
    <div class="flex items-center gap-4">
        <!-- Info -->
        <span class="text-xs text-gray-400">
            Page <span x-text="currentPage" class="text-white font-medium"></span>
            sur <span x-text="totalPages" class="text-white font-medium"></span>
            &mdash;
            <span x-text="totalRows" class="text-white font-medium"></span> résultats
        </span>

        <!-- Boutons -->
        <div class="flex items-center gap-1">
            <!-- Première page -->
            <button
                @click="changePage(1)"
                :disabled="currentPage === 1"
                :class="currentPage === 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-slate-700 hover:text-white'"
                class="p-1.5 text-gray-400 rounded-lg transition-all duration-200"
                title="Première page"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7M18 19l-7-7 7-7"/>
                </svg>
            </button>

            <!-- Page précédente -->
            <button
                @click="changePage(currentPage - 1)"
                :disabled="currentPage === 1"
                :class="currentPage === 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-slate-700 hover:text-white'"
                class="p-1.5 text-gray-400 rounded-lg transition-all duration-200"
                title="Page précédente"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <!-- Numéros de pages -->
            <template x-if="pages[0] > 1">
                <span class="px-2 text-gray-500 text-xs">…</span>
            </template>

            <template x-for="page in pages" :key="page">
                <button
                    @click="changePage(page)"
                    :class="page === currentPage
                        ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20'
                        : 'text-gray-400 hover:bg-slate-700 hover:text-white'"
                    class="w-8 h-8 text-xs font-medium rounded-lg transition-all duration-200"
                    x-text="page"
                ></button>
            </template>

            <template x-if="pages[pages.length - 1] < totalPages">
                <span class="px-2 text-gray-500 text-xs">…</span>
            </template>

            <!-- Page suivante -->
            <button
                @click="changePage(currentPage + 1)"
                :disabled="currentPage === totalPages"
                :class="currentPage === totalPages ? 'opacity-30 cursor-not-allowed' : 'hover:bg-slate-700 hover:text-white'"
                class="p-1.5 text-gray-400 rounded-lg transition-all duration-200"
                title="Page suivante"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <!-- Dernière page -->
            <button
                @click="changePage(totalPages)"
                :disabled="currentPage === totalPages"
                :class="currentPage === totalPages ? 'opacity-30 cursor-not-allowed' : 'hover:bg-slate-700 hover:text-white'"
                class="p-1.5 text-gray-400 rounded-lg transition-all duration-200"
                title="Dernière page"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M6 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</div>
