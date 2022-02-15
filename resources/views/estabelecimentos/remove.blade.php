
<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Excluir estabelecimento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('estabelecimentos.delete', $estabelecimento) }}" id="excluir-estabelecimento-form">
                @csrf
                @method('delete')

                <p class="mx-3" style="font-size: 1.1rem">Deseja mesmo excluir este estabelecimento e todos os seus cardápios, produtos e avaliações? (Esta é uma ação irreversível)</p>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="excluir-estabelecimento-submit">Excluir estabelecimento</button>
                </div>
            </form>
        </div>
    </div>
</div>