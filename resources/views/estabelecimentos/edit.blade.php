@php
    $cor_fundo = str_replace("#", "", $estabelecimento->cor_tema);
    $red = hexdec(substr($cor_fundo,0,2));
    $green = hexdec(substr($cor_fundo,2,2));
    $blue = hexdec(substr($cor_fundo,4,2));
@endphp
<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Editar estabelecimento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('estabelecimentos.update', $estabelecimento) }}" enctype="multipart/form-data" id="editar-estabelecimento-form">
                @csrf
                @method('put')

                <div class="mb-3">
                    <div class="form-text text-end me-1 text-danger id_usuario_error"></div>
                </div>

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" maxlength="45" onchange="changeName()" value="{{ $estabelecimento->nome }}">
                            <label for="nome">Nome</label>
                            <div class="form-text text-end me-1 text-danger nome_error"></div>
                        </div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="tipo" placeholder="Tipo de estabelecimento" name="tipo" maxlength="45" onchange="changeType()" value="{{ $estabelecimento->tipo }}">
                            <label for="tipo">Tipo de estabelecimento</label>
                        </div>
                        <div class="form-text text-end me-1 text-danger tipo_error"></div>
                        <div class="form-text text-end me-1">Ex: Pizzaria, Culinária Mexicana, Cafeteria.</div>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Descrição do estabelecimento" id="descricao" name="descricao" maxlength="200" onchange="changeDesc()">{{ $estabelecimento->descricao }}</textarea>
                    <label for="descricao">Descrição do estabelecimento</label>
                    <div class="form-text text-end me-1 text-danger descricao_error"></div>
                </div>

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="endereco" placeholder="Endereço comercial" name="endereco" maxlength="255" value="{{ $estabelecimento->endereco }}">
                            <label for="endereco">Endereço comercial <i class="bi bi-geo-alt"></i> </label>
                            <div class="form-text text-end me-1 text-danger endereco_error"></div>
                        </div>
                    </div>
                    <div class="col-4 mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="tel" class="form-control" id="telefone" placeholder="Telefone" name="telefone" maxlength="20"  value="{{ $estabelecimento->telefone }}">
                            <label for="telefone">Telefone <i class="bi bi-telephone"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger telefone_error"></div>
                        <div class="form-text text-end me-1">Ex: (9999) 99999-9999.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="tel" class="form-control" id="whatsapp" placeholder="Whatsapp" name="whatsapp" maxlength="20"  value="{{ $estabelecimento->whatsapp }}">
                            <label for="whatsapp">Whatsapp <i class="bi bi-whatsapp"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger whatsapp_error"></div>
                        <div class="form-text text-end me-1">Ex: (9999) 99999-9999.</div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="site" placeholder="Site oficial" name="site" maxlength="100" value="{{ $estabelecimento->site }}">
                            <label for="telefone">Site oficial <i class="bi bi-globe2"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger site_error"></div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="facebook" placeholder="Facebook" name="facebook" maxlength="100"  value="{{ $estabelecimento->facebook }}">
                            <label for="facebook">Facebook <i class="bi bi-facebook"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger facebook_error"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="instagram" placeholder="Instagram" name="instagram" maxlength="100"  value="{{ $estabelecimento->instagram }}">
                            <label for="instagram">Instagram <i class="bi bi-instagram"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger instagram_error"></div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="linkedin" placeholder="Linkedin" name="linkedin" maxlength="100"  value="{{ $estabelecimento->linkedin }}">
                            <label for="linkedin">Linkedin <i class="bi bi-linkedin"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger linkedin_error"></div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="messenger" placeholder="Messenger" name="messenger" maxlength="100"  value="{{ $estabelecimento->messenger }}">
                            <label for="messenger">Messenger <i class="bi bi-messenger"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger messenger_error"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="twitter" placeholder="Twitter" name="twitter" maxlength="100" value="{{ $estabelecimento->twitter }}">
                            <label for="twitter">Twitter <i class="bi bi-twitter"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger twitter_error"></div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="youtube" placeholder="Youtube" name="youtube" maxlength="100" value="{{ $estabelecimento->youtube }}">
                            <label for="youtube">Youtube <i class="bi bi-youtube"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger youtube_error"></div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="input-group mb-3">
                            <span class="input-group-text py-3">Cor tema</span>
                            <input type="color" class="form-control form-control-color py-3" style="max-width: 48px" id="cor_tema" name="cor_tema" title="Escolha uma cor"  value="{{ $estabelecimento->cor_tema }}" onchange="changeCardColor('#cor_tema')">
                        </div>
                        <div class="form-text text-end me-1 text-danger cor_tema_error"></div>
                    </div>
                </div>

                <div class="row mb-2" data-masonry='{"percentPosition": true }'>
                    <div class="col-md-6 card-col m-auto">
                        <div class="card card_busca row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative card-preview"
                            style="--red: {{ $red }}; --green: {{ $green }}; --blue: {{ $blue }};">
                            <div class="col p-4">
                                <svg class="bd-placeholder-img card-img-background" id="preview-estabelecimento-logo" width="100%" height="100%" role="img" aria-label="Logo" preserveAspectRatio="xMidYMid slice" focusable="false"
                                    @if ($estabelecimento->logo) style="background-image: url({{asset('img/' . $estabelecimento->logo)}})" @endif>
                                    @if (!$estabelecimento->logo)
                                    <title>Logo</title>
                                    <rect width="100%" height="100%" fill="#55595c"></rect>
                                    <text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Sem logo</text>
                                    @endif
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
                    <button type="submit" class="btn btn-success" id="editar-estabelecimento-submit">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>