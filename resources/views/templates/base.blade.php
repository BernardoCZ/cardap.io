<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="imagex/png" href="../font/icon.ico">
    <style>
        @font-face {
            font-family: Logo Font;
            src: url('../font/nautilus-pompilius.regular.otf');
        }
        :root {
          /* Cores RGB do fundo do  */
          --red: 255;
          --green: 255;
          --blue: 255;
          /* o limite no qual as cores são consideradas claras */
          --threshold: 0.5;
        }
        body{
          visibility:hidden;
          transition: 0.5s;
        }
        .navbar {
          margin-bottom: 1rem;
          box-shadow: 0 0.5em 1.5em rgb(0 0 0 / 10%), 0 0.125em 0.5em rgb(0 0 0 / 15%);
        }
        .text-logo{
            font-family: Logo Font;
        }
        .show, .collapsing{
          display: flex;
        }
        .card-img-right {
          height: 100%;
          border-radius: 0 3px 3px 0;
        }
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }
        .card-text {
          font-size: 0.9rem
        }
        .card-img-background {
          background-repeat: no-repeat;
          background-size: contain;
          background-position: center;
          min-width: 100px; 
        }
        .banner-img-background {
          background-repeat: no-repeat;
          background-size: contain;
          background-position: right center;
        }
        .dropdown-menu[data-bs-popper] {
          right: 0;
          left: auto;
        }
        .dropdown-item {
          font-weight: 500;
        }
        .dropdown-item i {
          margin-right: 1rem;
        }
        .notas {
            display: inline-block;
            -webkit-text-fill-color: transparent;
        }
        .valor_notas {
          color: orange;
          font-weight: bold;
        }
        .card {
          height:100%;
          transition: 0.25s;
        }
        .card-col {
          padding: 0.5rem 1rem;
        }
        .bg-tomato{
          background-color: #ff6347!important;
        }
        .bi-plus-lg::before {
          vertical-align: -0.1em;
          font-size: 0.9rem;
        }
        .form-signin {
          width: 100%;
          margin: auto;
        }
        textarea{
          resize: none;
          min-height: 100px!important;
        }
        .reticencias {
          word-wrap: normal;
          overflow: hidden;
          text-overflow: ellipsis;
        }
        .card-estabelecimento-tipo, .card-estabelecimento-nome, .card-estabelecimento-descricao {
          max-width: 250px;
        }
        .card_busca {
          /* configura a cor de fundo a partir das variáveis */
          background: rgb(var(--red), var(--green), var(--blue));

          /* calcula a claridade do fundo utilizando o método sRGB Luma 
          Luma = (red * 0.2126 + green * 0.7152 + blue * 0.0722) / 255 */
          --r: calc(var(--red) * 0.2126);
          --g: calc(var(--green) * 0.7152);
          --b: calc(var(--blue) * 0.0722);
          --sum: calc(var(--r) + var(--g) + var(--b));
          --perceived-lightness: calc(var(--sum) / 255);
          
          /* torna a cor do texto branca ou preta conforme a escuridão do fundo */
          color: hsl(0, 0%, calc((var(--perceived-lightness) - var(--threshold)) * -10000000%));
          transition: 0.15s;
        }
        .card_busca:hover {
          filter: grayscale(25%);
          transition: 0.15s;
          opacity: 0.95;
        }
        .spinner-grow {
          visibility: visible;
          position: absolute;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          margin: auto;
          color: #ff6347;
          width: 5rem;
          height: 5rem;
          transition: 0.5s;
        }
    </style>
    @stack('styles')
</head>
<body>
  <div class="spinner-grow" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-tomato">
    <div class="container-fluid">
      <a class="text-white text-logo p-2 h2 mb-0 text-decoration-none" href="#">Cardap.io</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="d-flex w-75 m-auto" method="get" action="#">
          <input class="form-control me-2" type="search" placeholder="Buscar estabelecimento..." aria-label="Buscar estabelecimento">
        </form>
        <div class="text-end">          
            @if (Auth::user())
            <div class="flex-shrink-0 dropdown">
              <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle text-white" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="@if (Auth::user()->profile_image == null) {{asset('img/no_image_user.jpg')}} @else {{asset('img/' . Auth::user()->profile_image)}} @endif" alt="Usuário" height="32" class="rounded-circle">
              </a>
              <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                <li><a class="dropdown-item" href="#"><i class="bi bi-person-square"></i><span>{{ Auth::user()->username }}</span></a></li>
                @can ('empresa')
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{ route('estabelecimentos') }}"><i class="bi bi-building"></i><span>Meus estabelecimentos</span></a></li>
                @endcan
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i><span>Deslogar</span></a></li>
              </ul>
            </div>
            @else
            <a href="{{ route('login') }}" role="button" class="btn btn-light me-2">Login</a>
            <a href="{{ route('usuarios.inserir') }}" role="button" class="btn btn-warning">Cadastro</a>
            @endif
        </div>
      </div>
    </div>
  </nav>     

      <div class="container">

          <!-- Conteúdo -->
          @yield('content')

      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
      <script>
        document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector("body").style.visibility = "hidden";
                document.querySelector(".spinner-grow").style.visibility = "visible";
            }
            else {
                document.querySelector(".spinner-grow").style.display = "none";
                document.querySelector("body").style.visibility = "visible";
            }
        };
    </script>
      @stack('scripts')
</body>
</html>