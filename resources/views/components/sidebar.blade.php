<!-- Logo -->
<div class="p-6 border-b border-slate-800">
    <div class="flex items-center gap-3">
        <div class="logo-icon">WT</div>
        <div>
            <h1 class="text-lg font-bold text-white">WhoTouchedIt</h1>
            <p class="text-xs text-gray-400">Maintenance Manager</p>
        </div>
    </div>
</div>

<!-- afficher en bleu la page sur laquelle on est (copier coller le href de home) -->

<!-- Navigation -->
<nav class="flex-1 p-4 space-y-1">
    <a href="{{ route('dashboard') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-slate-800 hover:text-white' }} transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span class="font-medium">Dashboard</span>
    </a>

    <a href="{{ route('machine') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('machine.*') | request()->routeIs('machine') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-slate-800 hover:text-white' }} transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
        </svg>
        <span class="font-medium">Machines</span>
    </a>

    <a href="{{ route('intervention') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('intervention.*') | request()->routeIs('intervention') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-slate-800 hover:text-white' }} transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
        <span class="font-medium">Interventions curatives</span>
    </a>

    <a href="#"
       class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-slate-800 hover:text-white transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
        <span class="font-medium">Interventions préventives</span>
    </a>

    <a href="#"
       class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-slate-800 hover:text-white transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span class="font-medium">Planning</span>
    </a>

    <a href="#"
       class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-slate-800 hover:text-white transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <span class="font-medium">Utilisateurs</span>
    </a>
</nav>

<!-- User Profile -->
<div class="p-4 border-t border-slate-800">
    <div class="flex items-center gap-3 px-4 py-3 rounded-lg bg-slate-800">
        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center font-bold">
            JD
        </div>
        <div class="flex-1">
            <p class="text-sm font-medium text-white">Jean Dupont</p>
            <p class="text-xs text-gray-400">Admin</p>
        </div>
        <button class="text-gray-400 hover:text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
        </button>
    </div>
</div>
