@extends('layouts.app')

@section('content')

{{-- Importando Bootstrap Icons para o botão de voltar --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Estilo para o título do filme */
    .movie-title {
        color: white;
        font-size: 3rem; /* Título maior */
        text-shadow:
            3px 1px 0 #fb0000,
            5px 5px 10px rgba(0,0,0,0.5);
    }

    /* Estilo para o novo botão de voltar */
    .btn-voltar-custom {
        background-color: white;
        color: #ff0000;
        font-weight: bold;
        border-radius: 50px; /* Bordas arredondadas */
        padding: 10px 20px; /* Aumenta o tamanho do botão */
        border: 2px solid #ff0000; /* Borda rosa para combinar */
        box-shadow: 1px 1px 0 #cf2020,
                    2px 2px 0 #a25d5d,
                    3px 3px 0 #6f4463,
                    4px 4px 0 #150e13,
                    5px 5px 10px rgba(0,0,0,0.5);
    }
</style>

<div class="container my-5">
    <br>
    {{-- Botão de voltar no canto superior esquerdo --}}
    <br>
    <a href="{{ route('home') }}" class="btn-voltar-custom mb-4">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
    <br>
    <br>
    <br>
    <hr>
    
    {{-- Título do filme no topo da página --}}
    <h1 class="movie-title fw-bold text-center mb-4">{{ $movie['title'] }}</h1>
    <br>

    

    {{-- Layout principal: Cartaz e detalhes lado a lado --}}
    <div class="row">
        {{-- Coluna para o cartaz do filme --}}
        <center>
            <div class="col-md-4 mb-4 mb-md-0">
                <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="img-fluid rounded shadow-lg">
            </div>
        </center>
        

        {{-- Coluna para as informações do filme --}}
        <div class="col-md-8">
            {{-- Card branco com título e sinopse --}}
            <div class="card p-4 rounded" style="background-color: white; border-color:red">
                <p class="card-text text-secondary">
                    <strong>Nota:</strong> {{ $movie['vote_average'] }} |<br> <strong>Data de Lançamento:</strong> {{\Carbon\Carbon::parse($movie['release_date'])->format('d/m/Y')}}
                </p>
                <hr>
                <p class="text-secondary">{{ $movie['overview'] }}</p>
            </div>
        </div>
    </div>

    {{-- Seção do trailer, abaixo do conteúdo principal --}}
    @if(isset($movie['videos']['results'][0]))
        <div class="mt-5 text-center">
            <br><br>
            <h3 class="movie-title fw-bold text-center mb-4">Ver Trailer</h3>
            <br>
            <div class="ratio ratio-16x9 mx-auto" style="max-width: 800px;">
                <iframe src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}"
                    frameborder="0" allowfullscreen class="rounded shadow-lg"></iframe>
            </div>
        </div>
    @endif
</div>
@endsection