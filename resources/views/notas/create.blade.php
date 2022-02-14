<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Avaliar estabelecimento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('notas.gravar') }}" id="criar-nota-form">
                @csrf
                <div class="form-floating mb-3">
                    <input type="number" class="form-control visually-hidden" id="id_estabelecimento" name="id_estabelecimento" value="{{ $id_estabelecimento }}" readonly>
                    <label for="id_estabelecimento visually-hidden"></label>
                    <div class="form-text text-end me-1 text-danger id_estabelecimento_error"></div>
                </div>
                <div class="d-flex w-100 justify-content-center align-items-center flex-column p-3">
                    <label for="valor" class="form-label">Avalie o estabelecimento com uma nota de 0 a 5</label>
                    <input class="rating" max="5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)"step="0.5" style="--value: 2.5" type="range" value="2.5" name="valor" id="valor">
                    <div class="form-text text-end me-1 text-danger valor_error"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="criar-cardapio-submit">Avaliar</button>
                </div>
            </form>
        </div>
    </div>
</div>