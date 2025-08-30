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

    <!-- Bootstrap JS Bundle (Popper incluído) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</head>
<body class="bg-dark">

    @include('layouts.navigation') {{-- adapte a navigation sem Tailwind --}}

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow mb-4">
            <div class="container py-4">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle (Popper incluído) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Optional: seu JS custom -->
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
