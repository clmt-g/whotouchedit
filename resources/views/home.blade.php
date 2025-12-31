<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhoTouchedIt - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 18px;
        }
    </style>
</head>
<body class="bg-slate-950 text-gray-100">

<!-- Sidebar -->
<aside class="fixed left-0 top-0 h-full w-64 bg-slate-900 border-r border-slate-800 flex flex-col">
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

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-1">
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600 text-white">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-slate-800 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
            </svg>
            <span class="font-medium">Machines</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-slate-800 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            <span class="font-medium">Interventions</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-slate-800 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span class="font-medium">Planning</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-slate-800 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <span class="font-medium">Utilisateurs</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-slate-800 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            <span class="font-medium">Rapports</span>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </button>
        </div>
    </div>
</aside>

<!-- Main Content -->
<main class="ml-64 min-h-screen">
    <!-- Header -->
    <header class="bg-slate-900 border-b border-slate-800 sticky top-0 z-10">
        <div class="px-8 py-4">
            <div class="flex items-center justify-between">
                <!-- Breadcrumb -->
                <div class="flex items-center gap-2 text-sm">
                    <span class="text-gray-400">Accueil</span>
                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-white font-medium">Dashboard</span>
                </div>

                <!-- Right side -->
                <div class="flex items-center gap-4">
                    <!-- Search -->
                    <div class="relative">
                        <input type="text" placeholder="Rechercher..." class="bg-slate-800 text-white pl-10 pr-4 py-2 rounded-lg border border-slate-700 focus:outline-none focus:border-blue-500 w-64">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    <!-- Notifications -->
                    <button class="relative p-2 text-gray-400 hover:text-white hover:bg-slate-800 rounded-lg transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="p-8">
        <!-- Page Title -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-white mb-2">Tableau de bord</h2>
            <p class="text-gray-400">Vue d'ensemble de votre parc machines et interventions</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg bg-green-500/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-green-500 font-medium bg-green-500/10 px-2 py-1 rounded">+12%</span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1">4</h3>
                <p class="text-sm text-gray-400">Machines opérationnelles</p>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg bg-orange-500/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-orange-500 font-medium bg-orange-500/10 px-2 py-1 rounded">2 urgent</span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1">3</h3>
                <p class="text-sm text-gray-400">Interventions en cours</p>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg bg-red-500/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-red-500 font-medium bg-red-500/10 px-2 py-1 rounded">Critique</span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1">1</h3>
                <p class="text-sm text-gray-400">Machine en panne</p>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg bg-blue-500/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-blue-500 font-medium bg-blue-500/10 px-2 py-1 rounded">Cette semaine</span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-1">5</h3>
                <p class="text-sm text-gray-400">Interventions planifiées</p>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-3 gap-6">
            <!-- Interventions urgentes -->
            <div class="col-span-2 bg-slate-900 border border-slate-800 rounded-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-white">Interventions urgentes</h3>
                    <a href="#" class="text-sm text-blue-500 hover:text-blue-400">Voir tout →</a>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-slate-800/50 rounded-lg border border-red-500/20 hover:border-red-500/40 transition">
                        <div class="w-10 h-10 rounded-lg bg-red-500/10 flex items-center justify-center flex-shrink-0">
                            <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 mb-2">
                                <h4 class="font-medium text-white">Robot de soudure RS-200</h4>
                                <span class="text-xs text-red-400 bg-red-500/10 px-2 py-1 rounded whitespace-nowrap">CRITIQUE</span>
                            </div>
                            <p class="text-sm text-gray-400 mb-2">Diagnostic panne électrique - Atelier soudure</p>
                            <div class="flex items-center gap-4 text-xs text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Marie Lefebvre
                                    </span>
                                <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Aujourd'hui 08:00
                                    </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-slate-800/50 rounded-lg border border-orange-500/20 hover:border-orange-500/40 transition">
                        <div class="w-10 h-10 rounded-lg bg-orange-500/10 flex items-center justify-center flex-shrink-0">
                            <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 mb-2">
                                <h4 class="font-medium text-white">Fraiseuse numérique F300</h4>
                                <span class="text-xs text-orange-400 bg-orange-500/10 px-2 py-1 rounded whitespace-nowrap">EN COURS</span>
                            </div>
                            <p class="text-sm text-gray-400 mb-2">Réparation système de refroidissement - Zone C</p>
                            <div class="flex items-center gap-4 text-xs text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Pierre Dubois
                                    </span>
                                <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Hier 10:00
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- État du parc machines -->
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6">
                <h3 class="text-lg font-bold text-white mb-6">État du parc</h3>

                <div class="space-y-4">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-400">Opérationnelles</span>
                            <span class="text-sm font-medium text-white">67%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-green-500 rounded-full" style="width: 67%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-400">En maintenance</span>
                            <span class="text-sm font-medium text-white">17%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-orange-500 rounded-full" style="width: 17%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-400">En panne</span>
                            <span class="text-sm font-medium text-white">16%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-red-500 rounded-full" style="width: 16%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-slate-800">
                    <h4 class="text-sm font-medium text-white mb-3">Criticité</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                <span class="text-sm text-gray-400">Critique</span>
                            </div>
                            <span class="text-sm font-medium text-white">3</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                                <span class="text-sm text-gray-400">Moyen</span>
                            </div>
                            <span class="text-sm font-medium text-white">2</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                <span class="text-sm text-gray-400">Faible</span>
                            </div>
                            <span class="text-sm font-medium text-white">1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Planning semaine -->
        <div class="mt-6 bg-slate-900 border border-slate-800 rounded-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-white">Planning de la semaine</h3>
                <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                    + Nouvelle intervention
                </button>
            </div>

            <div class="grid grid-cols-7 gap-2">
                <div class="text-center">
                    <p class="text-xs text-gray-500 mb-2">LUN</p>
                    <div class="bg-slate-800 rounded-lg p-2 h-24 hover:bg-slate-700 transition cursor-pointer">
                        <span class="text-xs text-gray-400">15 Jan</span>
                        <div class="mt-2 w-full h-1 bg-blue-500 rounded"></div>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-xs text-gray-500 mb-2">MAR</p>
                    <div class="bg-slate-800 rounded-lg p-2 h-24 hover:bg-slate-700 transition cursor-pointer">
                        <span class="text-xs text-gray-400">16 Jan</span>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-xs text-gray-500 mb-2">MER</p>
                    <div class="bg-slate-800 rounded-lg p-2 h-24 hover:bg-slate-700 transition cursor-pointer">
                        <span class="text-xs text-gray-400">17 Jan</span>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-xs text-gray-500 mb-2">JEU</p>
                    <div class="bg-slate-800 rounded-lg p-2 h-24 hover:bg-slate-700 transition cursor-pointer">
                        <span class="text-xs text-gray-400">18 Jan</span>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-xs text-gray-500 mb-2">VEN</p>
                    <div class="bg-slate-800 rounded-lg p-2 h-24 hover:bg-slate-700 transition cursor-pointer">
                        <span class="text-xs text-gray-400">19 Jan</span>
                        <div class="mt-2 w-full h-1 bg-orange-500 rounded"></div>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-xs text-gray-500 mb-2">SAM</p>
                    <div class="bg-slate-800/50 rounded-lg p-2 h-24">
                        <span class="text-xs text-gray-600">20 Jan</span>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-xs text-gray-500 mb-2">DIM</p>
                    <div class="bg-slate-800/50 rounded-lg p-2 h-24">
                        <span class="text-xs text-gray-600">21 Jan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
