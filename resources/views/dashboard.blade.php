@extends('layouts.app') {{-- usando o app.blade com Bootstrap --}}

@section('content')
<div class="py-5">
    <div class="container">
        {{-- Header --}}
        <div class="mb-4">
            <h2 class="text-danger fw-bold">CINERIPE</h2>
        </div>

        {{-- Card principal --}}
        <div class="card bg-white text-dark shadow">
            <div class="card-body">
                <p class="mb-0">Você está autenticado!</p>
            </div>
        </div>
    </div>
</div>
@endsection
