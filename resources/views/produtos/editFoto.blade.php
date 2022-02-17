@php
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
            <h5 class="modal-title">Editar foto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('foto.update', $produto) }}" id="editar-foto-form">
                @csrf
                @method('put')

                <div class="form-floating mb-3">
                    <div class="form-text text-end me-1 text-danger id_produto_error"></div>
                </div>

                <div class="row">
                    <div class="col mb-3 px-3" style="min-width: 250px">
                        <label for="foto" class="form-label">Foto do produto</label>
                        <input class="form-control" type="file" id="foto" name="foto" accept="image/*" onchange="changeFoto(event)">
                        <div class="form-text text-end me-1 text-danger foto_error"></div>
                    </div>
                </div>

                <div class="container">
                    <div class="row mb-2" data-masonry='{"percentPosition": true }'>
                        <div class="col-md-6 card-col m-auto">
                            <div class="card card_busca row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative card-preview"
                                style="--red: {{ $red_produtos }}; --green: {{ $green_produtos }}; --blue: {{ $blue_produtos }};">
                                <div class="col p-4 d-flex" id="preview-img-div">
                                    <svg class="bd-placeholder-img card-img-background rounded" width="100%" height="100%" role="img" aria-label="Logo" preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <title>Foto</title>
                                        <rect width="100%" height="100%" fill="#55595c"></rect>
                                        <text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Sem foto</text>
                                    </svg>
                                </div>
                                <div class="col p-4 d-flex flex-column position-static text-center card-produtos-textbox"
                                    style=" --red: {{ $red_produtos_sec }}; --green: {{ $green_produtos_sec }}; --blue: {{ $blue_produtos_sec }};">
                                    <h3 class="mb-2 reticencias fw-bold" id="preview-produto-nome">{{ $produto->nome }}</h3>
                                    <strong class="d-inline-block mb-2 reticencias" id="preview-produto-preco">@if($produto->preco > 0){{ $produto->moeda.' '.$produto->preco }}@elseif($produto->preco == 0 && $produto->preco != ''){{ 'Grátis' }}@endif</strong>
                                    <p class="card-text mb-auto reticencias reticencias-descricao" id="preview-produto-descricao">{{ $produto->descricao }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="editar-foto-submit">Salvar foto</button>
                </div>
            </form>
        </div>
    </div>
</div>