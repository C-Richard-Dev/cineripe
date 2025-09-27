@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-danger">Resultados para: <em>{{ $query }}</em></h3>

    <div class="row">
        @forelse($movies as $movie)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($movie['poster_path'])
                        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" 
                             class="card-img-top" alt="{{ $movie['title'] }}">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height:300px;">
                            Sem imagem
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-danger">{{ $movie['title'] }}</h5>
                        <p class="card-text">
                            {{ Str::limit($movie['overview'] ?? 'Sem descrição', 100) }}
                        </p>
                        <a href="" class="btn btn-danger w-100">
                            Ver detalhes
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">
                    Nenhum filme encontrado para "{{ $query }}".
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
