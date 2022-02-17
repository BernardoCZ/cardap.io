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
            <h5 class="modal-title">Editar produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('produtos.update', $produto) }}" id="editar-produto-form">
                @csrf
                @method('put')

                <div class="form-floating mb-3">
                    <div class="form-text text-end me-1 text-danger id_produto_error"></div>
                </div>

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" maxlength="45" onchange="changeProdutoName()" value="{{ $produto->nome }}">
                            <label for="nome">Nome</label>
                            <div class="form-text text-end me-1 text-danger nome_error"></div>
                        </div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <select class="form-select" id="moeda" name="moeda" onchange="changePreco()">
                                <option value="R$" @if($produto->moeda == 'R$')selected @endif>Real (R$)</option>
                                <option value="US$" @if($produto->moeda == 'US$')selected @endif>Dólar americano (US$)</option>
                                <option value="€" @if($produto->moeda == '€')selected @endif>Euro (€)</option>
                                <option value="£" @if($produto->moeda == '£')selected @endif>Libra esterlina (£)</option>
                            </select>
                            <label for="moeda">Moeda</label>
                            <div class="form-text text-end me-1 text-danger moeda_error"></div>
                        </div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="preco" placeholder="Preço" name="preco" step="0.01" onchange="changePreco()"  value="{{ $produto->preco }}">
                            <label for="preco">Preço</label>
                        </div>
                        <div class="form-text text-end me-1 text-danger preco_error"></div>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Descrição do produto" id="descricao" name="descricao" maxlength="200" onchange="changeProdutoDesc()">{{ $produto->nome }}</textarea>
                    <label for="descricao">Descrição do produto</label>
                    <div class="form-text text-end me-1 text-danger descricao_error"></div>
                </div>

                <div class="container">
                    <div class="row mb-2" data-masonry='{"percentPosition": true }'>
                        <div class="col-md-6 card-col m-auto">
                            <div class="card card_busca row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative card-preview"
                                style="--red: {{ $red_produtos }}; --green: {{ $green_produtos }}; --blue: {{ $blue_produtos }};">
                                <div class="col p-4 d-flex" id="preview-img-div">
                                    @if ($produto->foto)
                                        <img src="{{asset('img/' . $produto->foto)}}" class="bd-placeholder-img card-img-background rounded mw-100 m-auto" style="max-height: 500px;">

                                    @else
                                    <svg class="bd-placeholder-img card-img-background rounded" width="100%" height="100%" role="img" aria-label="Logo" preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <title>Foto</title>
                                        <rect width="100%" height="100%" fill="#55595c"></rect>
                                        <text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Sem foto</text>
                                    </svg>
                                    @endif
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
                    <button type="submit" class="btn btn-success" id="editar-produto-submit">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>