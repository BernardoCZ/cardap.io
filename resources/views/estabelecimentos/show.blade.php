@extends('templates.base')
@section('title', $estabelecimento->nome)

@section('content')
@php
    $cor_fundo = str_replace("#", "", $estabelecimento->cor_tema);
    $red = hexdec(substr($cor_fundo,0,2));
    $green = hexdec(substr($cor_fundo,2,2));
    $blue = hexdec(substr($cor_fundo,4,2));
    if ($nota_total) {
        $nota_total_estrelas = ($nota_total * 100)/5;
    }
@endphp

    <div class="row mb-4 rounded banner-estabelecimento shadow" style=" --red: {{ $red }}; --green: {{ $green }}; --blue: {{ $blue }};">
        
        <div class="col-md-4 p-4">
            <svg class="bd-placeholder-img card-img-background card-estabelecimento-logo" width="100%" height="100%" role="img" aria-label="Logo" preserveAspectRatio="xMidYMid slice" focusable="false"
                @if ($estabelecimento->logo) style="background-image: url({{asset('img/' . $estabelecimento->logo)}})" @endif>
                @if (!$estabelecimento->logo)
                    <title>Logo</title>
                    <rect width="100%" height="100%" fill="#55595c"></rect>
                    <text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Sem logo</text>
                @endif
            </svg>
        </div>

        <div class="col-md-8 text-center banner-estabelecimento-dados">
            <h1 class="display-4 fst-italic reticencias reticencias-descricao banner-estabelecimento-nome">{{$estabelecimento->nome}}</h1>
            <p class="lead my-3 reticencias reticencias-descricao banner-estabelecimento-descricao">{{$estabelecimento->descricao}}</p>
        </div>
        
    </div>
    <div class="p-4 mb-3 row bg-light rounded d-flex shadow align-items-center">
        <div class="col-md-6 px-5 py-3">
            <h2 class="h4">Sobre</h2>
            <p class="mb-0 estabelecimento-dados reticencias"><i class="bi bi-building me-2"></i>{{ $estabelecimento->nome }}</p>
            <p class="mb-0 estabelecimento-dados reticencias"><i class="bi bi-shop-window me-2"></i>{{ $estabelecimento->tipo }}</p>
            @if ($estabelecimento->endereco)
            <p class="mb-0 estabelecimento-dados reticencias">
                <i class="bi bi-geo-alt me-2"></i>{{ $estabelecimento->endereco }}
            </p>
            @endif
            @if ($estabelecimento->telefone)
            <p class="mb-0 estabelecimento-dados reticencias">
                <i class="bi bi-telephone me-2"></i>{{ $estabelecimento->telefone }}
            </p>
            @endif
            @if ($estabelecimento->whatsapp)
            <p class="mb-0 estabelecimento-dados reticencias">
                <i class="bi bi-whatsapp me-2"></i>{{ $estabelecimento->whatsapp }}
            </p>
            @endif
            @if ($estabelecimento->site)
            <p class="mb-0 estabelecimento-dados reticencias">
                <i class="bi bi-globe2 me-2"></i>
                <a href="{{ $estabelecimento->site }}">{{ $estabelecimento->site }}</a>
            </p>
            @endif
            @if ($estabelecimento->facebook)
            <p class="mb-0 estabelecimento-dados reticencias">
                <i class="bi bi-facebook me-2"></i>
                <a href="{{ $estabelecimento->facebook }}">{{ $estabelecimento->facebook }}</a>
            </p>
            @endif
            @if ($estabelecimento->instagram)
            <p class="mb-0 estabelecimento-dados reticencias">
                <i class="bi bi-instagram me-2"></i>
                <a href="{{ $estabelecimento->instagram }}">{{ $estabelecimento->instagram }}</a>
            </p>
            @endif
            @if ($estabelecimento->linkedin)
            <p class="mb-0 estabelecimento-dados reticencias">
                <i class="bi bi-linkedin me-2"></i>
                <a href="{{ $estabelecimento->linkedin }}">{{ $estabelecimento->linkedin }}</a>
            </p>
            @endif
            @if ($estabelecimento->messenger)
            <p class="mb-0 estabelecimento-dados reticencias">
                <i class="bi bi-messenger me-2"></i>
                <a href="{{ $estabelecimento->messenger }}">{{ $estabelecimento->messenger }}</a>
            </p>
            @endif
            @if ($estabelecimento->twitter)
            <p class="mb-0 estabelecimento-dados reticencias">
                <i class="bi bi-twitter me-2"></i>
                <a href="{{ $estabelecimento->twitter }}">{{ $estabelecimento->twitter }}</a>
            </p>
            @endif
            @if ($estabelecimento->youtube)
            <p class="mb-0 estabelecimento-dados reticencias">
                <i class="bi bi-youtube me-2"></i>
                <a href="{{ $estabelecimento->youtube }}">{{ $estabelecimento->youtube }}</a>
            </p>
            @endif
        </div>
        <div class="col-md-6" style="font-weight: bold;">
            <div class="row">
                <div class="col d-flex"> 
                    <div class="m-auto fs-1">
                        <span style="color: orange;">@if($nota_total || $nota_total == 0){{ $nota_total }}@else--@endif</span>
                        <span class="notas" style="background: linear-gradient(to right, orange 
                        @if(isset($nota_total_estrelas)){{ $nota_total_estrelas.'%' }}@else{{'0%'}}@endif, #b7bdc3 0); -webkit-background-clip: text;">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </span>
                        @can('cliente')
                        <button type="button" class="btn btn-warning text-white" id="avaliar">Avaliar</button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (isset(Auth::user()->id) && Auth::user()->id == $estabelecimento->id_usuario)
    <div class="row mt-3">
        <div class="col">
            <div class="d-flex rounded shadow-sm bg-tomato text-white my-3">
                <div class="d-flex align-items-center p-3" style="margin-right: auto;">
                    <h3 class="h4 mb-0 lh-1">Cardápios</h6>
                </div>
                <div class="d-flex align-items-center p-3">
                    <button class="btn btn-success" role="button" style="font-weight: 500" id="novo-cardapio" data-bs-toggle="tooltip" data-bs-placement="top" title="Criar cardápio"><i class="bi bi-plus-lg"></i> Novo</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (count($cardapios) == 0)
    <div class="alert alert-secondary text-center mb-5">Este estabelecimento ainda não possui cardápios.</div>
    @else
        @foreach($cardapios as $cardapio)
            {{-- Transforma cor hexademical em rgb. Depois a cor será passada para as variáveis css, 
            defindindo assim o fundo e a cor do texto de cada card --}}
            @php
                $cor_tema = str_replace("#", "", $cardapio->cor_tema);
                $red_tema = hexdec(substr($cor_tema,0,2));
  		        $green_tema = hexdec(substr($cor_tema,2,2));
  		        $blue_tema = hexdec(substr($cor_tema,4,2));
                $cor_produtos = str_replace("#", "", $cardapio->cor_produtos);
                $red_produtos = hexdec(substr($cor_produtos,0,2));
  		        $green_produtos = hexdec(substr($cor_produtos,2,2));
  		        $blue_produtos = hexdec(substr($cor_produtos,4,2));
            @endphp

            @if (isset(Auth::user()->id) && Auth::user()->id == $estabelecimento->id_usuario || $cardapio->visivel)
            <div class="row">
                <div class="col">
                    <div class="p-3 mb-3 rounded d-flex shadow-lg cardapio-titulo-div"
                        style="--red: {{ $red_tema }}; --green: {{ $green_tema }}; --blue: {{ $blue_tema }};">
                        @if (isset(Auth::user()->id) && Auth::user()->id == $estabelecimento->id_usuario && $cardapio->visivel)
                        <div class="d-flex align-items-center ps-3 me-3">
                            <span class="fs-4"><i class="bi bi-eye"></i></span>
                        </div>
                        @elseif(isset(Auth::user()->id) && Auth::user()->id == $estabelecimento->id_usuario && !$cardapio->visivel)
                        <div class="d-flex align-items-center ps-3">
                            <span class="fs-4"><i class="bi bi-eye-slash"></i></span>
                        </div>
                        @endif
                        <div class="m-auto reticencias">
                            <h2 class="h4 cardapio-titulo mb-0 reticencias">{{$cardapio->nome}}</h2>
                        </div>
                        @if (isset(Auth::user()->id) && Auth::user()->id == $estabelecimento->id_usuario)
                        <div class="d-flex align-items-center ps-3">
                            <button class="btn btn-success shadow-sm novo-produto me-2" role="button" style="font-weight: 500" data-id="{{ $cardapio->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Adicionar produto"><i class="bi bi-clipboard-plus"></i></button>
                            <button class="btn btn-danger shadow-sm excluir-cardapio" role="button" style="font-weight: 500" data-id="{{ $cardapio->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir cardápio"><i class="bi bi-clipboard-x"></i></button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @if (count($cardapio->produtos) == 0)
            <div class="row">
                <div class="col">
                    <div class="alert alert-secondary text-center mb-5">Este cardápio ainda não possui produtos.</div>
                </div>
            </div>
            @else

            <div class="row mb-2" data-masonry='{"percentPosition": true }'>

                @foreach($cardapio->produtos as $produto)

                    <div class="col-md-6 card-col m-auto">
                        <div class="card card_busca row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative card-preview"
                            style=" --red: {{ $red_produtos }}; --green: {{ $green_produtos }}; --blue: {{ $blue_produtos }};">
                            <div class="col p-4">
                                <svg class="bd-placeholder-img card-img-background bg-light rounded shadow" width="100%" height="100%" role="img" aria-label="Logo" preserveAspectRatio="xMidYMid slice" focusable="false"
                                    @if ($produto->foto) style="background-image: url({{asset('img/' . $produto->foto)}})" @endif>
                            @if (!$produto->foto)
                            <title>Foto</title>
                            <rect width="100%" height="100%" fill="#55595c"></rect>
                            <text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Sem foto</text>
                            @endif
                                </svg>
                            </div>
                            <div class="col p-4 d-flex flex-column position-static text-center">
                                <h3 class="mb-2 card-estabelecimento-nome reticencias">{{ $produto->nome }}</h3>
                                <strong class="d-inline-block mb-2 reticencias">
                                    @if($produto->preco)
                                        @if($produto->preco == 0)Grátis
                                        @else{{ $produto->moeda . ' ' . $produto->preco }}
                                        @endif
                                    @endif
                                </strong>
                                <p class="card-text mb-auto card-estabelecimento-descricao reticencias reticencias-descricao">{{ $produto->descricao }}</p>
                                <button class="btn btn-danger shadow-sm excluir-produto mt-3 m-auto" role="button" style="font-weight: 500; width: fit-content;" data-id="{{ $produto->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir produto"><i class="bi bi-clipboard-minus"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            @endif
            @endif
        @endforeach
    </div>
    @endif
    <div class="modal fade" id="form-modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen-lg-down">
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){

    $('#novo-cardapio').click(function() {
   
        $.ajax({
            url: '{{ route("cardapios.inserir", $estabelecimento->id) }}',
            type: 'get',
            success: function(response){
                $('.modal-dialog').html(response);
                $('#form-modal').modal('show');

                $('#criar-cardapio-form').on("submit", function(e){
                    e.preventDefault();

                    $.ajax({
                        url: action = $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(document).find('.text-danger').text('');
                            $(document).find('.border-danger').removeClass('is-invalid');
                        },
                        success: function() {
                            location.reload();
                        },
                        error: function(err) {
                            if (err.status == 422) {
                                $.each(err.responseJSON.errors, function (i, error) {
                                    $('.'+i+'_error').text(error[0]);
                                    $(document).find('[name="'+i+'"]').addClass('is-invalid');
                                });
                            }
                        }
                    });
                })
            }
        });
    });

    $('.novo-produto').click(function() {
   
        var id_cardapio = $(this).data('id');

        $.ajax({
            url: '{{ route("produtos.inserir") }}',
            type: 'get',
            data: {id: id_cardapio},
            success: function(response){
                $('.modal-dialog').html(response);
                $('#form-modal').modal('show');

                $('#criar-produto-form').on("submit", function(e){
                    e.preventDefault();

                    $.ajax({
                        url: action = $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(document).find('.text-danger').text('');
                            $(document).find('.border-danger').removeClass('is-invalid');
                        },
                        success: function() {
                            location.reload();
                        },
                        error: function(err) {
                            if (err.status == 422) {
                                $.each(err.responseJSON.errors, function (i, error) {
                                    $('.'+i+'_error').text(error[0]);
                                    $(document).find('[name="'+i+'"]').addClass('is-invalid');
                                });
                            }
                        }
                    });
                })
            }
        });
    });

    $('#avaliar').click(function() {

        $.ajax({
            url: '{{ route("notas.inserir", $estabelecimento->id) }}',
            type: 'get',
            success: function(response){
                $('.modal-dialog').html(response);
                $('#form-modal').modal('show');

                $('#criar-nota-form').on("submit", function(e){
                    e.preventDefault();

                    $.ajax({
                        url: action = $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: new FormData(this),
                        processData: false,
                        dataType: 'json',
                        contentType: false,
                        beforeSend: function() {
                            $(document).find('.text-danger').text('');
                            $(document).find('.border-danger').removeClass('is-invalid');
                        },
                        success: function() {
                            location.reload();
                        },
                        error: function(err) {
                            if (err.status == 422) {
                                $.each(err.responseJSON.errors, function (i, error) {
                                    $('.'+i+'_error').text(error[0]);
                                    $(document).find('[name="'+i+'"]').addClass('is-invalid');
                                });
                            }
                        }
                    });
                })
            }
        });
    });

    $('.excluir-produto').click(function() {
        
        var id_produto = $(this).data('id');

        $.ajax({
            url: '{{ route("produtos.remove") }}',
            type: 'get',
            data: {id: id_produto},
            success: function(response){
                $('.modal-dialog').html(response);
                $('#form-modal').modal('show');
            }
        });
    });

    $('.excluir-cardapio').click(function() {
        
        var id_cardapio = $(this).data('id');

        $.ajax({
            url: '{{ route("cardapios.remove") }}',
            type: 'get',
            data: {id: id_cardapio},
            success: function(response){
                $('.modal-dialog').html(response);
                $('#form-modal').modal('show');
            }
        });
    });
});

</script>
@endpush

@push('styles')
<style>
.rating {
  --dir: right;
  --fill: gold;
  --fillbg: rgba(100, 100, 100, 0.15);
  --star: url('data:image/svg+xml, <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>');
  --stars: 5;
  --starsize: 3rem;
  --symbol: var(--star);
  --value: 1;
  --w: calc(var(--stars) * var(--starsize));
  --x: calc(100% * (var(--value) / var(--stars)));
  inline-size: var(--w);
  -webkit-appearance: none;
}
.rating::-moz-range-track {
  background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
  block-size: 100%;
  mask: repeat left center/var(--starsize) var(--symbol);
}
.rating::-webkit-slider-runnable-track {
  background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
  block-size: 100%;
  mask: repeat left center/var(--starsize) var(--symbol);
  -webkit-mask: repeat left center/var(--starsize) var(--symbol);
}
.rating::-moz-range-thumb {
  height: var(--starsize);
  opacity: 0;
  width: var(--starsize);
}
.rating::-webkit-slider-thumb {
  height: var(--starsize);
  opacity: 0;
  width: var(--starsize);
  -webkit-appearance: none;
}
</style>
@endpush