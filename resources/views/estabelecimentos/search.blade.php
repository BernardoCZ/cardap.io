@extends('templates.base')
@section('title', 'Estabelecimentos')

@section('content')
<div class="container my-4 bg-light border rounded shadow">
    <div class="row justify-content-center align-items-center">
        <div class="col-6 p-3" style="min-width: 250px">
            <div class="form-floating">
                <select class="form-select" id="ordenar-campo" onchange="buscar()" @if(isset($campo)) value="{{ $campo }}" @endif>
                    <option value="nome">Nome</option>
                    <option value="data">Data de criação</option>
                    <option value="tipo">Tipo</option>
                </select>
                <label for="ordenar-campo">Ordenar por</label>
            </div>
        </div>
        <div class="col-4 p-3 d-flex align-items-center" style="min-width: 250px">
            <div class="form-check pe-3">
                <input class="form-check-input" type="radio" name="ordenar-direcao" value="asc" @if(isset($ordem) && $ordem != 'desc') checked @endif onchange="buscar()">
                <label class="form-check-label" for="ordenar-direcao">Crescente</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="ordenar-direcao" value="desc" onchange="buscar()" @if(isset($ordem) && $ordem == 'desc') checked @endif>
                <label class="form-check-label" for="ordenar-direcao">Decrescente</label>
            </div>
        </div>
    </div>

</div>
@if ($estabelecimentos == false)
    <div class="alert alert-secondary text-center">Busque por estabelecimentos.</div>
@elseif (count($estabelecimentos) == 0)
    <div class="alert alert-secondary text-center">Nenhum resultado foi encontrado.</div>
@else
    <div class="row mb-2" data-masonry='{"percentPosition": true }'>

        @foreach($estabelecimentos as $estabelecimento)

            {{-- Transforma cor hexademical em rgb. Depois a cor será passada para as variáveis css, 
            defindindo assim o fundo e a cor do texto de cada card --}}
            @php
                $cor_fundo = str_replace("#", "", $estabelecimento->cor_tema);
                $red = hexdec(substr($cor_fundo,0,2));
  		        $green = hexdec(substr($cor_fundo,2,2));
  		        $blue = hexdec(substr($cor_fundo,4,2));
            @endphp

            <div class="col-md-6 card-col m-auto v">
                <div class="card card_busca row g-0 border rounded overflow-hidden flex-md-row mb-4 h-md-250 position-relative shadow"
                    style="--red: {{ $red }}; --green: {{ $green }}; --blue: {{ $blue }};">
                    <div class="col p-4">
                        <svg class="bd-placeholder-img card-img-background card-estabelecimento-logo" width="100%" height="100%" role="img" aria-label="Logo" preserveAspectRatio="xMidYMid slice" focusable="false"
                            @if ($estabelecimento->logo) style="background-image: url({{asset('img/' . $estabelecimento->logo)}})" @endif>
                            @if (!$estabelecimento->logo)
                            <title>Logo</title>
                            <rect width="100%" height="100%" fill="#55595c"></rect>
                            <text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">Sem logo</text>
                            @endif
                        </svg>
                    </div>
                    <div class="col p-4 d-flex flex-column position-static text-center">
                        <strong class="d-inline-block mb-2 reticencias card-estabelecimento-tipo">{{ $estabelecimento->tipo }}</strong>
                        <h3 class="mb-0 reticencias card-estabelecimento-nome">{{ $estabelecimento->nome }}</h3>
                        <div class="mb-1" style="visibility:hidden">
                            <span class="valor_notas">--</span>
                            <span class="notas" style="background: linear-gradient(to right, orange 0%, #f8f9fa 0); -webkit-background-clip: text;">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </span>
                        </div>
                        <p class="card-text mb-auto reticencias reticencias-descricao card-estabelecimento-descricao">{{ $estabelecimento->descricao }}</p>
                        <a href="{{ route('estabelecimentos.show', $estabelecimento) }}" class="stretched-link hidden"></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection

@push('scripts')
<script>
    function buscar() {
        if ($('#buscar').val()) {
            location.href = '{{ route('buscar') }}' + '?val=' + $('#buscar').val() + '&campo=' + $('#ordenar-campo').val() + '&ordem=' + $('input[name="ordenar-direcao"]:checked').val();
        }
    };
</script>
@endpush