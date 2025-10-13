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
                @if (Auth::check())
                    @if (!$favoriteValidate !== false)
                        {{-- Botão Adicionar à Lista --}}
                        <button data-bs-toggle="modal" data-bs-target="#listModal-{{ $movie['id'] }}" class="btn btn-custom">
                            <i class="bi bi-bookmark-plus"></i> Adicionar aos favoritos
                        </button>
                    @else
                        {{-- Remover --}}
                        <button data-bs-toggle="modal" data-bs-target="#removeListModal-{{ $movie['id'] }}" class="btn btn-custom">
                            <i class="bi bi-x-circle-fill"></i> Remover dos favoritos 
                        </button>
                    @endif
                @else
                    <a href="{{route('register')}}" class="btn btn-custom">
                        <i class="bi bi-bookmark-plus"></i> Faça Login para adicionar á lista
                    </a>
                @endif
                
                {{-- Botão Ver Avaliações --}}
                <a href="#ratings" class="btn btn-custom"> 
                    <i class="bi bi-chat-dots"></i> Ver Avaliações
                </a>
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
        <div id="ratings" class="bg-white rounded-4 shadow-sm d-flex align-items-center justify-content-between p-3 mb-3">
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
                <a href="{{route('register')}}" class="btn btn-primary mb-3">
                    Faça login para adicionar uma avaliação!
                </a>
            </div>
        @endif
        @forelse ($ratings as $rating)
            <div class="card mb-3 shadow-sm border-0 w-75 position-relative">
                <div class="card-body d-flex">
                    {{-- Avatar inicial do usuário (primeira letra do nome) --}}
                    <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center me-3" 
                        style="width:50px; height:50px; font-size:20px;">
                        {{ strtoupper(substr($rating->user->name, 0, 1)) }}
                    </div>

                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold">{{ $rating->user->name }}</h6>
                            <span class="badge bg-danger fs-6">{{ $rating->rating }}/5</span>
                        </div>
                        <p class="mt-2 mb-0 text-muted" style="white-space: pre-line;">
                            {{ $rating->comment }}
                        </p>
                        <small class="text-secondary">
                            {{ $rating->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>

                {{-- Botões de ação somente para o autor da avaliação --}}
                @if(Auth::check() && Auth::id() === $rating->user_id)
                    <div class="position-absolute bottom-0 end-0 m-2 d-flex gap-2">
                        {{-- Botão Editar (abre modal de edição futuramente) --}}
                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editRatingModal-{{ $rating->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>

                        {{-- Botão Excluir --}}
                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteRatingModal-{{ $rating->id }}">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                @endif
            </div>
            {{-- Modal de Exclusão --}}
            <div class="modal fade" id="deleteRatingModal-{{ $rating->id }}" tabindex="-1" aria-labelledby="deleteRatingModalLabel-{{ $rating->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <div class="modal-header bg-danger text-white rounded-top-4">
                            <h5 class="modal-title" id="deleteRatingModalLabel-{{ $rating->id }}">Confirmar Exclusão</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            Tem certeza que deseja excluir esta avaliação?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            
                            {{-- Formulário de exclusão (rota vazia por enquanto) --}}
                            <form action="{{route('rate.destroy', ['rating'=>$rating->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal de Edição --}}
            <div class="modal fade" id="editRatingModal-{{ $rating->id }}" tabindex="-1" aria-labelledby="editRatingModalLabel-{{ $rating->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        {{-- Ajuste a rota depois para a rota correta de atualização --}}
                        <form method="POST" action="{{route('rate.update',['rating'=>$rating->id])}}">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title" id="editRatingModalLabel-{{ $rating->id }}">Editar Avaliação</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>

                            <div class="modal-body">
                                {{-- Estrelas --}}
                                <div class="mb-3">
                                    <label class="form-label">Nota</label>
                                    <div class="d-flex flex-row-reverse justify-content-end">
                                        @for($i = 10; $i >= 1; $i--)
                                            @php
                                                $value = $i / 2;
                                            @endphp
                                            <input 
                                                type="radio" 
                                                id="edit-star{{ $i }}-{{ $rating->id }}" 
                                                name="rating" 
                                                value="{{ $value }}" 
                                                class="d-none"
                                                @if($rating->rating == $value) checked @endif
                                                required
                                            >
                                            <label for="edit-star{{ $i }}-{{ $rating->id }}" class="star">&#9733;</label>
                                        @endfor
                                    </div>
                                </div>

                                {{-- Comentário --}}
                                <div class="mb-3">
                                    <label for="edit-comment-{{ $rating->id }}" class="form-label">Comentário</label>
                                    <textarea 
                                        class="form-control" 
                                        name="comment" 
                                        id="edit-comment-{{ $rating->id }}" 
                                        rows="3" 
                                        maxlength="1000"
                                    >{{ $rating->comment }}</textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Atualizar Avaliação</button>
                            </div>
                        </form>
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

