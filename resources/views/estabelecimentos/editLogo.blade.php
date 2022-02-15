@php
    $cor_fundo = str_replace("#", "", $estabelecimento->cor_tema);
    $red = hexdec(substr($cor_fundo,0,2));
    $green = hexdec(substr($cor_fundo,2,2));
    $blue = hexdec(substr($cor_fundo,4,2));
@endphp
<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Editar logo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('logo.update', $estabelecimento) }}" enctype="multipart/form-data" id="editar-logo-form">
                @csrf
                @method('put')

                <div class="mb-3">
                    <div class="form-text text-end me-1 text-danger id_usuario_error"></div>
                </div>

                <div class="row">
                    <div class="col mb-3 px-3" style="min-width: 250px">
                        <label for="logo" class="form-label">Logo do estabelecimento</label>
                        <input class="form-control" type="file" id="logo" name="logo" accept="image/*" onchange="changeLogo(event)">
                        <div class="form-text text-end me-1 text-danger logo_error"></div>
                    </div>
                </div>

                <div class="row mb-2" data-masonry='{"percentPosition": true }'>
                    <div class="col-md-6 card-col m-auto">
                        <div class="card card_busca row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative card-preview"
                            style="--red: {{ $red }}; --green: {{ $green }}; --blue: {{ $blue }};">
                            <div class="col p-4">
                                <svg class="bd-placeholder-img card-img-background" id="preview-estabelecimento-logo" width="100%" height="100%" role="img" aria-label="Logo" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Logo</title>
                                    <rect width="100%" height="100%" fill="#55595c"></rect>
                                    <text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Sem logo</text>
                                </svg>
                            </div>
                            <div class="col p-4 d-flex flex-column position-static text-center">
                                <strong class="d-inline-block mb-2 reticencias" id='preview-estabelecimento-tipo'>{{ $estabelecimento->tipo }}</strong>
                                <h3 class="mb-0 reticencias" id="preview-estabelecimento-nome">{{ $estabelecimento->nome }}</h3>
                                <p class="mt-3 card-text mb-auto reticencias reticencias-descricao" id="preview-estabelecimento-descricao">{{ $estabelecimento->descricao }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="editar-estabelecimento-submit">Salvar logo</button>
                </div>
            </form>
        </div>
    </div>
</div>