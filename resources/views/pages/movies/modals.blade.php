<div class="modal fade" id="avaliacaoModal" tabindex="-1" aria-labelledby="avaliacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('rate.store', ['movie' => $movie['id']]) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="avaliacaoModalLabel">Adicionar Avaliação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    {{-- Estrelas --}}
                    <div class="mb-3">
                        <label class="form-label">Nota</label>
                        <div id="rating-stars" class="d-flex flex-row-reverse justify-content-end">
                            @for($i = 10; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i/2 }}" class="d-none" required>
                                <label for="star{{ $i }}" class="star">&#9733;</label>
                            @endfor
                        </div>
                    </div>

                    {{-- Comentário opcional --}}
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comentário (opcional)</label>
                        <textarea class="form-control" name="comment" id="comment" rows="3" maxlength="1000"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar Avaliação</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Modal de Add aos Favoritos --}}
<div class="modal fade" id="listModal-{{ $movie['id'] }}" tabindex="-1" aria-labelledby="listModalLabel-{{ $movie['id'] }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-success text-white rounded-top-4">
                <h5 class="modal-title" id="listModalLabel-{{ $movie['id'] }}">Adicionar aos favoritos</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja adicionar este filme aos favoritos?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Melhor não</button>
                
                {{-- Formulário de exclusão (rota vazia por enquanto) --}}
                <form action="{{route('favorite.store',['movie'=>$movie['id']])}}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-success">Sim. Adicionar!</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Modal para Remover dos Favoritos --}}
<div class="modal fade" id="removeListModal-{{ $movie['id'] }}" tabindex="-1" aria-labelledby="removeListModalLabel-{{ $movie['id'] }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-danger text-white rounded-top-4">
                <h5 class="modal-title" id="removeListModalLabel-{{ $movie['id'] }}">Remover dos favoritos</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja remover este filme dos favoritos?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Melhor não</button>
                
                {{-- Formulário de exclusão (rota vazia por enquanto) --}}
                <form action="{{route('favorite.destroy',['movie'=>$movie['id']])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Sim. Remover!</button>
                </form>
            </div>
        </div>
    </div>
</div>


