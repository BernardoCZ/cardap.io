
<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Excluir Produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('produtos.delete', $produto) }}" id="excluir-produto-form">
                @csrf
                @method('delete')

                <p class="mx-3" style="font-size: 1.1rem">Deseja mesmo excluir este produto? (Esta é uma ação irreversível)</p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="excluir-produto-submit">Excluir produto</button>
                </div>
            </form>
        </div>
    </div>
</div>