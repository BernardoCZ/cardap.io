<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Novo cardápio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('cardapios.gravar') }}" id="criar-cardapio-form">
                @csrf
                <div class="form-floating mb-3">
                    <input type="number" class="form-control visually-hidden" id="id_estabelecimento" name="id_estabelecimento" value="{{ $id_estabelecimento }}" readonly>
                    <label for="id_estabelecimento visually-hidden"></label>
                    <div class="form-text text-end me-1 text-danger id_estabelecimento_error"></div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" maxlength="100" onchange="changeCardapioName()">
                    <label for="nome">Nome</label>
                    <div class="form-text text-end me-1 text-danger nome_error"></div>
                </div>
                <div class="row">
                    <div class="col mb-3 d-flex" style="min-width: 250px">
                        <div class="d-flex m-auto align-items-center">
                            <label for="cor_tema" class="form-label mb-0 me-3">Cor tema</label>
                            <input type="color" class="form-control form-control-color" id="cor_tema" name="cor_tema" title="Escolha uma cor" value="#ffffff" onchange="changeCardapioColor('#cor_tema')">
                            <div class="form-text text-end me-1 text-danger cor_tema_error"></div>
                        </div>
                    </div>
                    <div class="col mb-3 d-flex" style="min-width: 250px">
                        <div class="d-flex m-auto align-items-center">
                            <label for="cor_produtos" class="form-label mb-0 me-3">Cor dos produtos</label>
                            <input type="color" class="form-control form-control-color" id="cor_produtos" name="cor_produtos" title="Escolha uma cor" value="#ffffff" onchange="changeCardColor('#cor_produtos')">
                            <div class="form-text text-end me-1 text-danger cor_produtos_error"></div>
                        </div>
                    </div>
                    <div class="col mb-3 d-flex" style="min-width: 250px">
                        <div class="m-auto">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="visivel" name="visivel" checked>
                                <label class="form-check-label" for="visivel">Público</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="p-3 mb-3 rounded d-flex shadow cardapio-titulo-div" id="preview-cardapio-titulo-div">
                                <div class="m-auto reticencias">
                                    <h2 class="h4 cardapio-titulo mb-0 reticencias" id="preview-cardapio-titulo">Nome do cardápio</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2" data-masonry='{"percentPosition": true }'>
                        <div class="col-md-6 card-col m-auto">
                            <div class="card card_busca row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative card-preview">
                                <div class="col p-4">
                                    <svg class="bd-placeholder-img card-img-background" id="preview-estabelecimento-logo" width="100%" height="100%" role="img" aria-label="Logo" preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <title>Foto</title>
                                        <rect width="100%" height="100%" fill="#55595c"></rect>
                                        <text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Foto</text>
                                    </svg>
                                </div>
                                <div class="col p-4 d-flex flex-column position-static text-center">
                                    <h3 class="mb-2 reticencias" id="preview-estabelecimento-nome">Produto exemplo</h3>
                                    <strong class="d-inline-block mb-2">Preço exemplo</strong>
                                    <p class="card-text mb-auto reticencias reticencias-descricao" id="preview-estabelecimento-descricao">Descrição do produto exemplo...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="criar-cardapio-submit">Criar cardapio</button>
                </div>
            </form>
        </div>
    </div>
</div>