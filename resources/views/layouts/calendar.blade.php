<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WhoTouchedIt - Exemple')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon-192.png') }}">
    <link rel="apple-touch-icon" sizes="512x512" href="{{ asset('favicon-512.png') }}">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <!-- Calendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.20/index.global.min.js'></script>

    <!-- Dependancies to download the calendar to pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body class="bg-slate-950 text-gray-100">
<aside class="fixed left-0 top-0 h-full w-64 bg-slate-900 border-r border-slate-800 flex flex-col">
    @include('components.sidebar')
</aside>
<main class="ml-64 min-h-screen">
    @include('components.impersonate-bar')
    @include('components.header')
    <div class="p-8">
        @include('components.toast')
        @yield('content')
    </div>
</main>

@stack('scripts')
</body>
</html>
