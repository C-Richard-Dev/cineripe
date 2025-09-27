@extends('layouts.app')

@section('content')

{{-- Importando Bootstrap Icons para o botão de voltar --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    /* Estilo para o novo botão de voltar, com o mesmo padrão do botão de detalhes */
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
    
    /* Estilo para o card de detalhes do filme, seguindo o padrão da home */
    .details-card {
        background-color: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Estilo para os botões do card de detalhes */
    .btn-custom {
        background-color: transparent;
        color: #ffffff;
        border: 2px solid #ff0000;
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #ffffff;
        color: #ff0000;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    .btn-custom i {
        margin-right: 8px;
    }
</style>

<style>
    .star {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.2s;
    }
    input[type="radio"]:checked ~ label,
    label:hover,
    label:hover ~ label {
        color: gold;
    }
</style>

<div class="container my-5">
    {{-- Botão de voltar no canto superior esquerdo --}}
    <a href="{{ route('home') }}" class="btn-voltar-custom mb-4">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
    <br>
    <br>

    {{-- Layout principal: Cartaz e sinopse lado a lado --}}
    <div class="row">
        {{-- Coluna para o cartaz do filme (à esquerda) --}}
        <div class="col-md-4 mb-4 mb-md-0">
            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="img-fluid rounded shadow-lg">
        </div>

        {{-- Coluna para as informações do filme (à direita) --}}
        <div class="col-md-8">
            <div class="details-card p-4 rounded">
                <h1 class="card-title fw-bold" style="color: black;">{{ $movie['title'] }}</h1>
                <p class="card-text text-secondary">
                    <strong>Nota:</strong> <span style="color: #ff0000;">⭐ {{ $movie['vote_average'] }}</span> | <strong>Data de Lançamento:</strong> {{ \Carbon\Carbon::parse($movie['release_date'])->format('d/m/Y') }}
                </p>
                <hr>
                <p class="text-secondary">{{ $movie['overview'] }}</p>
                
                
            </div>
            {{-- Linha para os botões --}}
            <div class="d-flex justify-content mt-1">
                {{-- Botão Adicionar à Lista --}}
                <button class="btn btn-custom">
                    <i class="bi bi-bookmark-plus"></i> Adicionar à lista
                </button>
                
                {{-- Botão Ver Avaliações --}}
                <button class="btn btn-custom">
                    <i class="bi bi-chat-dots"></i> Ver Avaliações
                </button>
            </div>
        </div>
    </div>
    
    
    {{-- Seção do trailer, abaixo do conteúdo principal --}}
    @if(isset($movie['videos']['results'][0]))
        <div class="mt-5 text-center">
            <div class="bg-white rounded-4 shadow-sm d-flex align-items-center justify-content-between p-3 mb-3">
                <h1 class="text-dark mb-0">
                     Ver Trailer
                </h1>
            </div>
            <iframe width="100%" height="500"
                src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}"
                frameborder="0" allowfullscreen
                style="border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            </iframe>
        </div>
    @endif

    <div class="mt-5 text-center">
        <div class="bg-white rounded-4 shadow-sm d-flex align-items-center justify-content-between p-3 mb-3">
            <h1 class="text-dark mb-0">
                Avaliações 
            </h1>
        </div>
        @if (Auth::check())
            <div>
                <button data-bs-toggle="modal" data-bs-target="#avaliacaoModal" class="btn btn-custom mb-3">
                    Adicionar Avaliação
                </button>
            </div>
        @else
            <div>
                <a href="" class="btn btn-primary mb-3">
                    Crie uma conta para adicionar uma avaliação!
                </a>
            </div>
        @endif
        @forelse ($ratings as $rating)
            <div class="card mb-3 shadow-sm border-0 w-75">
                <div class="card-body d-flex">
                    {{-- Avatar inicial do usuário (primeira letra do nome) --}}
                    <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center me-3" style="width:50px; height:50px; font-size:20px;">
                        {{ strtoupper(substr($rating->user->name, 0, 1)) }}
                    </div>

                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold">{{ $rating->user->name }}</h6>
                            <span class="badge bg-danger fs-6">{{ $rating->rating }}/10</span>
                        </div>
                        <p class="mt-2 mb-0 text-muted" style="white-space: pre-line;">
                            {{ $rating->comment }}
                        </p>
                        <small class="text-secondary">
                            {{ $rating->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info" role="alert">
                Nenhuma avaliação disponível para este filme.
            </div>
        @endforelse

    </div>
</div>
{{-- Incluindo os modais --}}
@include('pages.movies.modals')
@endsection

