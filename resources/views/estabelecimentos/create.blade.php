<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Novo estabelecimento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('estabelecimentos.gravar') }}" enctype="multipart/form-data" id="criar-estabelecimento-form">
                @csrf

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" maxlength="45" onchange="changeName()">
                            <label for="nome">Nome</label>
                            <div class="form-text text-end me-1 text-danger nome_error"></div>
                        </div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="tipo" placeholder="Tipo de estabelecimento" name="tipo" maxlength="45" onchange="changeType()">
                            <label for="tipo">Tipo de estabelecimento</label>
                        </div>
                        <div class="form-text text-end me-1 text-danger tipo_error"></div>
                        <div class="form-text text-end me-1">Ex: Pizzaria, Culinária Mexicana, Cafeteria.</div>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Descrição do estabelecimento" id="descricao" name="descricao" maxlength="200" onchange="changeDesc()"></textarea>
                    <label for="descricao">Descrição do estabelecimento</label>
                    <div class="form-text text-end me-1 text-danger descricao_error"></div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="endereco" placeholder="Endereço comercial" name="endereco" maxlength="255">
                    <label for="endereco">Endereço comercial <i class="bi bi-geo-alt"></i> </label>
                    <div class="form-text text-end me-1 text-danger endereco_error"></div>
                </div>

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="tel" class="form-control" id="telefone" placeholder="Telefone" name="telefone" maxlength="20">
                            <label for="telefone">Telefone <i class="bi bi-telephone"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger telefone_error"></div>
                        <div class="form-text text-end me-1">Ex: (9999) 99999-9999.</div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="tel" class="form-control" id="whatsapp" placeholder="Whatsapp" name="whatsapp" maxlength="20">
                            <label for="whatsapp">Whatsapp <i class="bi bi-whatsapp"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger whatsapp_error"></div>
                        <div class="form-text text-end me-1">Ex: (9999) 99999-9999.</div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="site" placeholder="Site oficial" name="site" maxlength="100">
                            <label for="telefone">Site oficial <i class="bi bi-globe2"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger site_error"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="facebook" placeholder="Facebook" name="facebook" maxlength="100">
                            <label for="facebook">Facebook <i class="bi bi-facebook"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger facebook_error"></div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="instagram" placeholder="Instagram" name="instagram" maxlength="100">
                            <label for="instagram">Instagram <i class="bi bi-instagram"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger instagram_error"></div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="linkedin" placeholder="Linkedin" name="linkedin" maxlength="100">
                            <label for="linkedin">Linkedin <i class="bi bi-linkedin"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger linkedin_error"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="messenger" placeholder="Messenger" name="messenger" maxlength="100">
                            <label for="messenger">Messenger <i class="bi bi-messenger"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger messenger_error"></div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="twitter" placeholder="Twitter" name="twitter" maxlength="100">
                            <label for="twitter">Twitter <i class="bi bi-twitter"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger twitter_error"></div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="youtube" placeholder="Youtube" name="youtube" maxlength="100">
                            <label for="youtube">Youtube <i class="bi bi-youtube"></i></label>
                        </div>
                        <div class="form-text text-end me-1 text-danger youtube_error"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <label for="logo" class="form-label">Logo do estabelecimento</label>
                        <input class="form-control" type="file" id="logo" name="logo" accept="image/*" onchange="changeLogo(event)">
                        <div class="form-text text-end me-1 text-danger logo_error"></div>
                    </div>
                    <div class="col-2 mb-3" style="min-width: 250px">
                        <label for="cor_tema" class="form-label">Cor tema</label>
                        <input type="color" class="form-control form-control-color" id="cor_tema" name="cor_tema" title="Escolha uma cor" value="#ffffff" onchange="changeCardColor('#cor_tema')">
                        <div class="form-text text-end me-1 text-danger cor_tema_error"></div>
                    </div>
                </div>

                <div class="row mb-2" data-masonry='{"percentPosition": true }'>
                    <div class="col-md-6 card-col m-auto">
                        <div class="card card_busca row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative card-preview">
                            <div class="col p-4">
                                <svg class="bd-placeholder-img card-img-background" id="preview-estabelecimento-logo" width="100%" height="100%" role="img" aria-label="Logo" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Logo</title>
                                    <rect width="100%" height="100%" fill="#55595c"></rect>
                                    <text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Logo</text>
                                </svg>
                            </div>
                            <div class="col p-4 d-flex flex-column position-static text-center">
                                <strong class="d-inline-block mb-2 reticencias" id='preview-estabelecimento-tipo'>Tipo de estabelecimento</strong>
                                <h3 class="mb-0 reticencias" id="preview-estabelecimento-nome">Nome do estabelecimento</h3>
                                <div class="mb-1" style="visibility:hidden">
                                    <span class="valor_notas">--</span>
                                    <span class="notas" style="background: linear-gradient(to right, orange 0%, #f8f9fa 0); -webkit-background-clip: text;">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                </div>
                                <p class="card-text mb-auto reticencias reticencias-descricao" id="preview-estabelecimento-descricao">Descrição do estabelecimento...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success" id="criar-estabelecimento-submit">Criar estabelecimento</button>
        </div>
            </form>
        </div>
    </div>
</div>