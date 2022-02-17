<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Editar imagem de perfil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('imagem.update') }}" enctype="multipart/form-data" id="editar-imagem-form">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col mb-3 px-3" style="min-width: 250px">
                        <label for="profile_image" class="form-label">Imagem de perfil</label>
                        <input class="form-control" type="file" id="profile_image" name="profile_image" accept="image/*">
                        <div class="form-text text-end me-1 text-danger profile_image_error"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="editar-imagem-submit">Salvar imagem</button>
                </div>
            </form>
        </div>
    </div>
</div>