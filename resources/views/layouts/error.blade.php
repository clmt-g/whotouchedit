<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WhoTouchedIt - Exemple')</title>

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-slate-950 p-8">

<div class="max-w-5xl mx-auto">
    @yield('content')
</div>

</body>
</html>

@stack('scripts')
