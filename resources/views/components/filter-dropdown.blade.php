@props(['id', 'label', 'options'])

<th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
    <div class="relative inline-flex items-center gap-2">
        {{ $label }}
        <div class="relative">
            <button onclick="toggleDropdown('filter-{{ $id }}')"
                    class="filter-trigger inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-gray-500 hover:text-indigo-400 hover:bg-indigo-500/10 transition-all text-xs">
                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M3 6h18M7 12h10M11 18h2"/>
                </svg>
                <span class="chevron-icon transition-transform duration-200">▾</span>
            </button>

            <div id="filter-{{ $id }}"
                 class="filter-dropdown hidden absolute z-50 top-full left-1/2 -translate-x-1/2 mt-1.5 w-52
                        bg-slate-900 border border-slate-700/50 rounded-xl shadow-2xl shadow-black/40 overflow-hidden">

                <div class="px-3 py-2 text-[10px] font-semibold uppercase tracking-widest text-slate-500 border-b border-slate-700/40">
                    Filtrer par {{ strtolower($label) }}
                </div>

                <div class="p-1.5 flex flex-col gap-0.5">
                    @foreach($options as $val => $optionLabel)
                        <button onclick="setFilter('filter-{{ $id }}', '{{ $val }}')"
                                data-value="{{ $val }}"
                                class="filter-option w-full flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm text-slate-300
                                       hover:bg-slate-800 hover:text-white transition-all text-left
                                       {{ $val === '' ? 'bg-indigo-500/10 text-indigo-400' : '' }}">
                            <span class="w-2 h-2 rounded-full flex-shrink-0 bg-slate-500"></span>
                            {{ $optionLabel }}
                            <svg class="check-icon ml-auto w-3.5 h-3.5 text-indigo-400 {{ $val === '' ? 'opacity-100' : 'opacity-0' }}"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>
                    @endforeach
                </div>

                <div class="p-1.5 border-t border-slate-700/40 flex gap-1.5">
                    <button onclick="clearFilter('filter-{{ $id }}')"
                            class="flex-1 py-1.5 text-xs text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-all border border-slate-700/50">
                        Effacer
                    </button>
                    <button onclick="applyFilter('filter-{{ $id }}')"
                            class="flex-1 py-1.5 text-xs text-indigo-400 hover:text-indigo-300 bg-indigo-500/10 hover:bg-indigo-500/20 rounded-lg transition-all border border-indigo-500/20">
                        Appliquer
                    </button>
                </div>
            </div>
        </div>
    </div>
</th>
