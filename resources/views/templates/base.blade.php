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
    <link rel="stylesheet" href="{{asset('css/base.css')}}">
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
                  <li><a class="dropdown-item" href="{{ route('estabelecimentos') }}"><i class="bi bi-shop-window"></i><span>Meus estabelecimentos</span></a></li>
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