@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    body {
        background-color: #000;
        color: #fff;
    }

    .btn-voltar-custom {
        background-color: white;
        color: #ff0000;
        font-weight: bold;
        border-radius: 50px;
        padding: 10px 20px;
        border: 2px solid #ff0000;
        box-shadow: 1px 1px 0 #cf2020,
                    2px 2px 0 #a25d5d,
                    3px 3px 0 #6f4463,
                    4px 4px 0 #150e13,
                    5px 5px 10px rgba(0,0,0,0.5);
    }

    .card-fav {
        background-color: #fff;
        color: #000;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        transition: transform 0.25s, box-shadow 0.25s;
        cursor: pointer;
        text-decoration: none;
    }

    .card-fav:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 12px rgba(255,0,0,0.3);
    }

    .card-fav img {
        border-bottom: 3px solid #ff0000;
        height: 400px;
        object-fit: cover;
        width: 100%;
    }

    .card-fav h5 {
        font-weight: bold;
        color: #000;
    }

    .card-fav small {
        color: #444;
    }

    .section-title {
        color: #fff;
        border-left: 5px solid #ff0000;
        padding-left: 10px;
        font-weight: bold;
    }
</style>

<div class="container my-5">
    <a href="{{ route('home') }}" class="btn-voltar-custom mb-4">
        <i class="bi bi-arrow-left"></i> Voltar
    </a> <br><br><br>
    <h1 class="section-title mb-4">
        <i class="bi bi-heart-fill text-danger"></i> Meus Favoritos
    </h1>

    @if($movies->isEmpty())
        <div class="alert alert-light text-center">
            Você ainda não adicionou nenhum filme aos seus favoritos.
        </div>
    @else
        <div class="row g-4">
            @foreach($movies as $movie)
                <div class="col-md-4 col-lg-3">
                    <a href="{{ route('movie.details', $movie['id']) }}" class="card-fav d-block h-100">
                        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" 
                             alt="{{ $movie['title'] }}">

                        <div class="p-3">
                            <h5 class="mb-1">{{ $movie['title'] }}</h5>
                            <small>
                                Lançamento: {{ \Carbon\Carbon::parse($movie['release_date'])->format('d/m/Y') }}
                            </small>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
