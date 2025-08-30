<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Optional: seu CSS custom -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height:100vh;">

    <div class="text-center mb-4">
        <a href="/">
            <x-application-logo class="w-20 h-20" />
        </a>
    </div>

    <div class="card shadow-sm w-100" style="max-width: 400px;">
        <div class="card-body">
            {{ $slot }}
        </div>
    </div>

    <!-- Bootstrap JS Bundle (Popper incluído) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Optional: seu JS custom -->
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
