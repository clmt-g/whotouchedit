<header class="bg-slate-900 border-b border-slate-800 sticky top-0 z-10">
    <div class="px-8 py-4">
        <div class="flex items-center justify-between">
            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-sm">
                <span class="text-gray-400">WhoTouchedIt</span>
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-medium">{{ Route::currentRouteName() }}</span>
            </div>
        </div>
    </div>
</header>
