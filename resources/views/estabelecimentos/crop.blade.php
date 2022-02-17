<div class="modal-content">

        <div class="modal-header bg-tomato text-white">
            <h5 class="modal-title">Cortar logo do estabelecimento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{ route('logo.cut', $estabelecimento) }}" enctype="multipart/form-data" id="cortar">
                @csrf

                <div class="mb-3" style="max-height: 50vh; min-height: 30vh">
                    <img class="mw-100" id="img-crop" src="{{asset('img/' . $estabelecimento->logo)}}">
                </div>

                <div class="row visually-hidden">
                    <div class="col mb-3 px-3" style="min-width: 250px">
                        <input type="hidden" name="img" id="img">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="cortar-logo-submit">Salvar logo</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
        var image = document.getElementById('img-crop');
        var minAspectRatio = 0.5;
        var maxAspectRatio = 1.5;
        var cropper = new Cropper(image, {
            autoCropArea: 1,
            ready: function () {
            var cropper = this.cropper;
            var containerData = cropper.getContainerData();
            var cropBoxData = cropper.getCropBoxData();
            var aspectRatio = cropBoxData.width / cropBoxData.height;
            var newCropBoxWidth;

            if (aspectRatio < minAspectRatio || aspectRatio > maxAspectRatio) {
                newCropBoxWidth = cropBoxData.height * ((minAspectRatio + maxAspectRatio) / 2);

                cropper.setCropBoxData({
                left: (containerData.width - newCropBoxWidth) / 2,
                width: newCropBoxWidth
                });
            }
            },

            cropmove: function () {
            var cropper = this.cropper;
            var cropBoxData = cropper.getCropBoxData();
            var aspectRatio = cropBoxData.width / cropBoxData.height;

            if (aspectRatio < minAspectRatio) {
                cropper.setCropBoxData({
                width: cropBoxData.height * minAspectRatio
                });
            } else if (aspectRatio > maxAspectRatio) {
                cropper.setCropBoxData({
                width: cropBoxData.height * maxAspectRatio
                });
            }
            },
        });
        document.querySelector('#cortar').addEventListener('submit', function (e) {
            event.preventDefault();
            document.querySelector('#img').value = cropper.getCroppedCanvas().toDataURL('image/png');
            this.submit();
        });
</script>