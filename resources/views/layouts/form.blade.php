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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-slate-950">

<aside class="fixed left-0 top-0 h-full w-64 bg-slate-900 border-r border-slate-800 flex flex-col">
    @include('components.sidebar')
</aside>

<div class="ml-64 min-h-screen flex flex-col">
    @include('components.impersonate-bar')
    <div class="p-8">
        <div class="max-w-5xl mx-auto">
            @yield('content')
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
