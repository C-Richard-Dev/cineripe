@extends('layouts.app')

@section('content')

{{-- Importando Bootstrap CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


{{-- CSS personalizado para os controles do carrossel --}}
<style>
    /* Estiliza os botões de controle para melhor visibilidade */
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%; /* Ajusta a largura da área clicável */
    }

    /* Estiliza os ícones das setas */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        width: 3rem;
        height: 3rem;
        padding: 0.5rem;
        background-size: 50%;
    }

    .section-title-box {
        background-color: white;
        border-radius: 12px; /* Borda arredondada */
        padding: 10px 15px; /* Espaçamento interno */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra para destacar */
        display: flex; /* Garante que os itens fiquem na mesma linha */
        align-items: center;
        justify-content: space-between;
    }
</style>

<div class="container mt-5">

    <div class="section-title-box mb-3">
        <h1 class="fs-4 fw-semibold mb-0">🔥 Em alta hoje</h1>
        <a href="#" class="text-danger text-decoration-none">Ver tudo</a>
    </div>

    {{-- Carrossel de filmes com Bootstrap --}}
    <div id="movieCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @php
                // Divide os filmes em grupos de 4 para cada slide do carrossel
                $movieChunks = array_chunk($movies, 4);
                $isFirst = true;
            @endphp
            @foreach($movieChunks as $chunk)
                <div class="carousel-item @if($isFirst) active @endif">
                    {{-- A classe 'row' é responsiva:
                         'col-6' -> 2 filmes por linha em telas pequenas (mobile)
                         'col-md-3' -> 4 filmes por linha em telas médias e maiores --}}
                    <div class="row g-4">
                        @foreach($chunk as $m)
                            @php
                                $poster = $m['poster_path'] ? $imageBase . $m['poster_path'] : null;
                                $title = $m['title'] ?? $m['name'] ?? 'Sem título';
                                $date = $m['release_date'] ?? null;
                                $rating = $m['vote_average'] ?? null;
                            @endphp
                            <div class="col-6 col-md-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                                        <div class="position-relative">
                                            @if($poster)
                                                <img src="{{ $poster }}" class="card-img-top" alt="{{ $title }}" style="object-fit: cover; height: 100%;" loading="lazy">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center text-secondary" style="aspect-ratio: 2/3;">
                                                    Sem pôster
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-body p-2 d-flex flex-column justify-content-between">
                                            <h5 class="card-title text-truncate mb-1" style="font-size: 0.9rem;">{{ $title }}</h5>
                                            <div class="d-flex justify-content-between align-items-center text-secondary" style="font-size: 0.8rem;">
                                                <span>{{ $date ? \Illuminate\Support\Str::of($date)->substr(0,4) : '—' }}</span>
                                                <span class="text-warning">
                                                    ⭐ {{ $rating ? number_format($rating, 1, ',', '.') : '—' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @php $isFirst = false; @endphp
            @endforeach
        </div>

        {{-- Controles de navegação do carrossel --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#movieCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#movieCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>
    <br>
    <br>

    {{-- FILMES MAIS BEM AVALIADOS --}}
    <div class="section-title-box mb-3">
        <h1 class="fs-4 fw-semibold mb-0"><i class="bi bi-star-fill"></i> Mais bem avaliados</h1>
        <a href="#" class="text-danger text-decoration-none">Ver tudo</a>
    </div>
    <div id="movieMoreRatedCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @php
                $isFirst = true;
            @endphp
            @foreach($moreRatedMoviesChunks as $chunk)
                <div class="carousel-item @if($isFirst) active @endif">
                    {{-- A classe 'row' é responsiva:
                         'col-6' -> 2 filmes por linha em telas pequenas (mobile)
                         'col-md-3' -> 4 filmes por linha em telas médias e maiores --}}
                    <div class="row g-4">
                        @foreach($chunk as $m)
                            @php
                                $poster = $m['poster_path'] ? $imageBase . $m['poster_path'] : null;
                                $title = $m['title'] ?? $m['name'] ?? 'Sem título';
                                $date = $m['release_date'] ?? null;
                                $rating = $m['vote_average'] ?? null;
                            @endphp
                            <div class="col-6 col-md-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                                        <div class="position-relative">
                                            @if($poster)
                                                <img src="{{ $poster }}" class="card-img-top" alt="{{ $title }}" style="object-fit: cover; height: 100%;" loading="lazy">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center text-secondary" style="aspect-ratio: 2/3;">
                                                    Sem pôster
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-body p-2 d-flex flex-column justify-content-between">
                                            <h5 class="card-title text-truncate mb-1" style="font-size: 0.9rem;">{{ $title }}</h5>
                                            <div class="d-flex justify-content-between align-items-center text-secondary" style="font-size: 0.8rem;">
                                                <span>{{ $date ? \Illuminate\Support\Str::of($date)->substr(0,4) : '—' }}</span>
                                                <span class="text-warning">
                                                    ⭐ {{ $rating ? number_format($rating, 1, ',', '.') : '—' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @php $isFirst = false; @endphp
            @endforeach
        </div>

        {{-- Controles de navegação do carrossel --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#movieMoreRatedCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#movieMoreRatedCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>

</div>

{{-- Importando Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection
