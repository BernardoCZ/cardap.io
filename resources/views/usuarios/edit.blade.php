<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Editar perfil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('perfil.update') }}" id="editar-perfil-form">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" placeholder="Nome de usuário" name="username" maxlength="20" value="{{ $usuario->username }}">
                            <label for="username">Nome de usuário</label>
                            <div class="form-text text-end me-1 text-danger username_error"></div>
                        </div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" maxlength="100" value="{{ $usuario->email }}">
                            <label for="email">Email</label>
                            <div class="form-text text-end me-1 text-danger email_error"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="editar-perfil-submit">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>