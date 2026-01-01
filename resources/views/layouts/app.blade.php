<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WhoTouchedIt - Exemple')</title>

   <!-- tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-slate-950 text-gray-100">
    <aside class="fixed left-0 top-0 h-full w-64 bg-slate-900 border-r border-slate-800 flex flex-col">
        @include('components.sidebar')
    </aside>
    <main class="ml-64 min-h-screen">
        @include('components.header')
        <div class="p-8">
            @include('components.toast')
            @yield('content')
        </div>
    </main>

@stack('scripts')
</body>
</html>
