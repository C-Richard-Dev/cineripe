@extends('layouts.app')

@section('content')

{{-- Importando Bootstrap Icons para o botão de voltar --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    
</style>
<br>
<br>

{{-- Botão de voltar no canto superior esquerdo --}}
    <a href="{{ route('home') }}" class="btn-voltar-custom mb-4">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
    <br>
    <br>

{{-- Container do trailer banner --}}
@if(isset($movie['videos']['results'][0]))
    <div class="trailer-banner-container">
        <iframe src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}?autoplay=1&mute=1"
            frameborder="0" allowfullscreen>
        </iframe>
        <div class="banner-overlay">
            <h1 class="fw-bold" style="font-size: 2.5rem;">{{ $movie['title'] }}</h1>
            <p>{{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }} | Nota: {{ $movie['vote_average'] }}</p>
        </div>
    </div>
@endif

<div class="container my-5">
    

    {{-- Layout principal: Cartaz e sinopse lado a lado --}}
    <div class="row">
        {{-- Coluna para o cartaz do filme (à esquerda) --}}
        <center>
            <div class="col-md-4 mb-4 mb-md-0">
                <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="img-fluid rounded shadow-lg">
            </div>
        </center>
        
        {{-- Coluna para as informações do filme (à direita) --}}
        <div class="col-md-8">
            <div class="details-card p-4 rounded">
                <p class="card-text text-secondary">
                    <strong>Sinopse:</strong>
                </p>
                <hr>
                <p class="text-secondary">{{ $movie['overview'] }}</p>
            </div>
        </div>
    </div>
</div>
@endsection