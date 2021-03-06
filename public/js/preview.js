function changeCardColor(element) {
    var color = document.querySelector(element).value;
    color = color.match(/[A-Za-z0-9]{2}/g).map(function(v) { return parseInt(v, 16) });
    var card = document.querySelector('.card-preview');
    card.style.setProperty('--red', color[0]);
    card.style.setProperty('--green', color[1]);
    card.style.setProperty('--blue', color[2]);
}
function changeCardSecColor(element) {
    var color = document.querySelector(element).value;
    color = color.match(/[A-Za-z0-9]{2}/g).map(function(v) { return parseInt(v, 16) });
    var card = document.querySelector('#preview-produtos-textbox');
    card.style.setProperty('--red', color[0]);
    card.style.setProperty('--green', color[1]);
    card.style.setProperty('--blue', color[2]);
}
function changeCardapioColor(element) {
    var color = document.querySelector(element).value;
    color = color.match(/[A-Za-z0-9]{2}/g).map(function(v) { return parseInt(v, 16) });
    var cardapio = document.querySelector('#preview-cardapio-titulo-div');
    cardapio.style.setProperty('--red', color[0]);
    cardapio.style.setProperty('--green', color[1]);
    cardapio.style.setProperty('--blue', color[2]);
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
function changeCardapioName() {
    var nome = document.querySelector('#nome').value;
    var nome_preview = document.querySelector('#preview-cardapio-titulo');
    if (nome != ''){
        nome_preview.innerHTML = nome;
    }
    else{
        nome_preview.innerHTML = 'Nome do cardápio';
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
    if(event.target.files.length > 0 && event.target.files[0].type.includes('image')){
        var src = URL.createObjectURL(event.target.files[0]);
        preview.style.backgroundImage = 'url(' + src + ')';
        preview.innerHTML = "";
    }
    else{
        preview.innerHTML = '<title>Logo</title><rect width="100%" height="100%" fill="#55595c"></rect><text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Logo</text>';
        preview.style.backgroundImage = 'none';
    }
}
function changePreco() {
    var preco = document.querySelector('#preco').value;
    var moeda = document.querySelector('#moeda').value;
    var preco_preview = document.querySelector('#preview-produto-preco');
    if (preco > 9999999999) {
        preco = 9999999999;
    }
    else if (preco < 0) {
        preco = 0;
    }
    if (preco == '') {
        preco = "Preço";
    }
    else {
        preco = (Math.round(preco * 100) / 100).toFixed(2);
        document.querySelector('#preco').value = preco;
    }
    if (moeda != 'R$' && moeda != 'US$' && moeda != '€' && moeda != '£') {
        moeda = "R$";
    }
    if (preco == 0) {
        preco_preview.innerHTML = 'Grátis';
    }
    else {
        preco_preview.innerHTML = moeda + ' ' + preco;
    }
}
function changeProdutoName() {
    var nome = document.querySelector('#nome').value;
    var nome_preview = document.querySelector('#preview-produto-nome');
    if (nome != ''){
        nome_preview.innerHTML = nome;
    }
    else{
        nome_preview.innerHTML = 'Nome do produto';
    }
}
function changeProdutoDesc() {
    var desc = document.querySelector('#descricao').value;
    var desc_preview = document.querySelector('#preview-produto-descricao');
    if (desc != ''){
        desc_preview.innerHTML = desc;
    }
    else{
        desc_preview.innerHTML = 'Descrição do produto...';
    }
}
function changeFoto(event) {
    var preview = document.querySelector('#preview-img-div');
    if(event.target.files.length > 0 && event.target.files[0].type.includes('image')){
        var src = URL.createObjectURL(event.target.files[0]);
        preview.innerHTML = '<img src="'+src+'" class="bd-placeholder-img card-img-background rounded mw-100 m-auto" style="max-height: 500px;">'
    }
    else{
        preview.innerHTML = '<svg class="bd-placeholder-img card-img-background rounded" width="100%" height="100%" role="img" aria-label="Logo" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Foto</title><rect width="100%" height="100%" fill="#55595c"></rect><text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Sem foto</text></svg>';
    }
}