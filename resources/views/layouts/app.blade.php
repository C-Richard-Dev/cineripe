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

    {{-- Popup Sucesso --}}
    @if(session('success'))
    <div class="modal fade show" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-modal="true" style="display: block;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
        <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="successModalLabel">Sucesso!</h5>
        </div>
        <div class="modal-body">
            <p>{{ session('success') }}</p>
            <div class="fs-1 mt-3">🙂</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Confirmar</button>
        </div>
        </div>
    </div>
    </div>
    <script>
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    </script>
    @endif

    {{-- Popup Erro --}}
    @if(session('error'))
    <div class="modal fade show" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-modal="true" style="display: block;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
        <div class="modal-header bg-danger text-white">
            <h5 class="modal-title" id="errorModalLabel">Erro!</h5>
        </div>
        <div class="modal-body">
            <p>{{ session('error') }}</p>
            <div class="fs-1 mt-3">🙁</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
        </div>
        </div>
    </div>
    </div>
    <script>
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    </script>
    @endif


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
