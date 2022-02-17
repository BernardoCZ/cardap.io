<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Editar perfil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('senha.update') }}" id="editar-senha-form">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="old_password" placeholder="Senha atual" name="old_password" maxlength="20">
                            <label for="old_password">Senha atual</label>
                            <div class="form-text text-end me-1 text-danger old_password_error"></div>
                        </div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" placeholder="Nova senha" name="password" maxlength="20">
                            <label for="password">Nova senha</label>
                            <div class="form-text text-end me-1 text-danger password_error"></div>
                        </div>
                    </div>
                    <div class="col mb-3" style="min-width: 250px">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Confirmar nova senha" name="password_confirmation" maxlength="20">
                            <label for="password_confirmation">Confirmar nova senha</label>
                            <div class="form-text text-end me-1 text-danger password_confirmation_error"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="editar-senha-submit">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>