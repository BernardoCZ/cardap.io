
<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Excluir Produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('produtos.delete', $produto) }}" id="excluir-produto-form">
                @csrf
                @method('delete')

                <div class="form-text text-end me-1 text-danger id_produto_error"></div>
                <p class="text-center fs-4">Produto: {{$produto->nome}}</p>
                <p class="text-center fs-6">Você tem certeza que deseja excluir este produto? (Este é um processo irreversível)</p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="excluir-produto-submit">Excluir produto</button>
                </div>
            </form>
        </div>
    </div>
</div>