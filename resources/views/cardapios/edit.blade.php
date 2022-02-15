@php
    $cor_fundo = str_replace("#", "", $cardapio->cor_tema);
    $red = hexdec(substr($cor_fundo,0,2));
    $green = hexdec(substr($cor_fundo,2,2));
    $blue = hexdec(substr($cor_fundo,4,2));
    $cor_fundo_produtos = str_replace("#", "", $cardapio->cor_produtos);
    $red_produtos = hexdec(substr($cor_fundo_produtos,0,2));
    $green_produtos = hexdec(substr($cor_fundo_produtos,2,2));
    $blue_produtos = hexdec(substr($cor_fundo_produtos,4,2));
    $cor_produtos_sec = str_replace("#", "", $cardapio->cor_produtos_secundaria);
    $red_produtos_sec = hexdec(substr($cor_produtos_sec,0,2));
    $green_produtos_sec = hexdec(substr($cor_produtos_sec,2,2));
    $blue_produtos_sec = hexdec(substr($cor_produtos_sec,4,2));
@endphp
<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Editar cardápio</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('cardapios.update', $cardapio) }}" id="editar-cardapio-form">
                @csrf
                @method('put')

                <div class="form-floating mb-3">
                    <div class="form-text text-end me-1 text-danger id_estabelecimento_error"></div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" maxlength="100" onchange="changeCardapioName()" value="{{ $cardapio->nome }}">
                    <label for="nome">Nome</label>
                    <div class="form-text text-end me-1 text-danger nome_error"></div>
                </div>
                <div class="row">
                    <div class="col mb-3 d-flex" style="min-width: 250px">
                        <div class="d-flex m-auto align-items-center">
                            <label for="cor_tema" class="form-label mb-0 me-3">Cor tema</label>
                            <input type="color" class="form-control form-control-color" id="cor_tema" name="cor_tema" title="Escolha uma cor" value="{{ $cardapio->cor_tema }}" onchange="changeCardapioColor('#cor_tema')">
                            <div class="form-text text-end me-1 text-danger cor_tema_error"></div>
                        </div>
                    </div>
                    <div class="col mb-3 d-flex" style="min-width: 250px">
                        <div class="d-flex m-auto align-items-center">
                            <label for="cor_produtos" class="form-label mb-0 me-3">Cor dos produtos</label>
                            <input type="color" class="form-control form-control-color" id="cor_produtos" name="cor_produtos" title="Escolha uma cor" value="{{ $cardapio->cor_produtos }}" onchange="changeCardColor('#cor_produtos')">
                            <div class="form-text text-end me-1 text-danger cor_produtos_error"></div>
                        </div>
                    </div>
                    <div class="col mb-3 d-flex" style="min-width: 250px">
                        <div class="d-flex m-auto align-items-center">
                            <label for="cor_produtos" class="form-label mb-0 me-3">Cor secundária dos produtos</label>
                            <input type="color" class="form-control form-control-color" id="cor_produtos_secundaria" name="cor_produtos_secundaria" title="Escolha uma cor" value="{{ $cardapio->cor_produtos_secundaria }}" onchange="changeCardSecColor('#cor_produtos_secundaria')">
                            <div class="form-text text-end me-1 text-danger cor_produtos_secundaria_error"></div>
                        </div>
                    </div>
                    <div class="col mb-3 d-flex" style="min-width: 250px">
                        <div class="m-auto">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="visivel" name="visivel" @if($cardapio->visivel) checked @endif>
                                <label class="form-check-label" for="visivel">Público</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col">
                            <div class="p-3 mb-3 rounded d-flex shadow cardapio-titulo-div" id="preview-cardapio-titulo-div"
                                style="--red: {{ $red }}; --green: {{ $green }}; --blue: {{ $blue }};">
                                <div class="m-auto reticencias">
                                    <h2 class="h4 cardapio-titulo mb-0 reticencias" id="preview-cardapio-titulo">{{ $cardapio->nome }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2" data-masonry='{"percentPosition": true }'>
                        <div class="col-md-6 card-col m-auto">
                            <div class="card card_busca row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative card-preview"
                                style="--red: {{ $red_produtos }}; --green: {{ $green_produtos }}; --blue: {{ $blue_produtos }};">
                                <div class="col p-4">
                                    <svg class="bd-placeholder-img card-img-background" id="preview-estabelecimento-logo" width="100%" height="100%" role="img" aria-label="Logo" preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <title>Foto</title>
                                        <rect width="100%" height="100%" fill="#55595c"></rect>
                                        <text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Foto</text>
                                    </svg>
                                </div>
                                <div class="col p-4 d-flex flex-column position-static text-center card-produtos-textbox" id="preview-produtos-textbox"
                                    style=" --red: {{ $red_produtos_sec }}; --green: {{ $green_produtos_sec }}; --blue: {{ $blue_produtos_sec }};">
                                    <h3 class="mb-2 reticencias fw-bold" id="preview-estabelecimento-nome">Produto exemplo</h3>
                                    <strong class="d-inline-block mb-2">Preço exemplo</strong>
                                    <p class="card-text mb-auto reticencias reticencias-descricao" id="preview-estabelecimento-descricao">Descrição do produto exemplo...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="editar-cardapio-submit">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>