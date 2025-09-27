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


