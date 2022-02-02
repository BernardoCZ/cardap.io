function changeColor(element) {
    var color = document.querySelector(element).value;
    color = color.match(/[A-Za-z0-9]{2}/g).map(function(v) { return parseInt(v, 16) });
    var root = document.querySelector(':root');
    root.style.setProperty('--red', color[0]);
    root.style.setProperty('--green', color[1]);
    root.style.setProperty('--blue', color[2]);
}
function changeName() {
    var nome = document.querySelector('#nome').value;
    var nome_preview = document.querySelector('#preview-estabelecimento-nome');
    if (nome != ''){
        nome_preview.innerHTML = nome;
    }
    else{
        nome_preview.innerHTML = 'Nome do estabelecimento';
    }
}
function changeType() {
    var tipo = document.querySelector('#tipo').value;
    var tipo_preview = document.querySelector('#preview-estabelecimento-tipo');
    if (tipo != ''){
        tipo_preview.innerHTML = tipo;
    }
    else{
        tipo_preview.innerHTML = 'Tipo de estabelecimento';
    }
}
function changeDesc() {
    var desc = document.querySelector('#descricao').value;
    var desc_preview = document.querySelector('#preview-estabelecimento-descricao');
    if (desc != ''){
        desc_preview.innerHTML = desc;
    }
    else{
        desc_preview.innerHTML = 'Descrição do estabelecimento...';
    }
}
function changeLogo(event) {
    var preview = document.querySelector('#preview-estabelecimento-logo');
    if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        preview.style.backgroundImage = 'url(' + src + ')';
        preview.innerHTML = "";
    }
    else{
        preview.innerHTML = '<title>Logo</title><rect width="100%" height="100%" fill="#55595c"></rect><text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Logo</text>';
        preview.style.backgroundImage = 'none';
    }
}