const cropper = new Cropper(document.querySelector('#img-crop'));
document.querySelector('#cortar').addEventListener('submit', function (e) {
    event.preventDefault();
    document.querySelector('#img').value = cropper.getCroppedCanvas().toDataURL('image/jpeg');
    this.submit();
})