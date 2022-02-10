@extends('templates.base')
@section('title', 'Estabelecimentos')

@section('content')
<div class="d-flex rounded shadow-sm bg-tomato text-white my-3">
    <div class="d-flex align-items-center p-3" style="margin-right: auto;">
        <img src="@if (Auth::user()->profile_image == null) {{asset('img/no_image_user.jpg')}} @else {{asset('img/' . Auth::user()->profile_image)}} @endif" alt="Usuário" height="32" class="rounded-circle me-3">
        <div class="lh-1">
            <h6 class="h6 mb-0 lh-1">{{ Auth::User()->username }}</h6>
            <small>{{ ucfirst(Auth::User()->type) }}</small>
        </div>
    </div>
    <div class="d-flex align-items-center p-3">
        <button class="btn btn-success" role="button" style="font-weight: 500" id="novo-estabelecimento"><i class="bi bi-plus-lg"></i> Novo</button>
    </div>
</div>
@if (count($estabelecimentos) == 0)
    <div class="alert alert-secondary text-center">Você ainda não possui nenhum estabelecimento.</div>
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
                            <text id="svg-text" x="50%" y="50%" fill="#eceeef" dy=".3em">{{ $estabelecimento->nome }}</text>
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
<div class="modal fade" id="form-modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen-lg-down">
  </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('js/preview.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){

    $('#novo-estabelecimento').click(function() {
   
        $.ajax({
            url: '{{ route("estabelecimentos.inserir") }}',
            type: 'get',
            success: function(response){
                $('.modal-dialog').html(response);
                $('#form-modal').modal('show');

                $('#criar-estabelecimento-form').on("submit", function(e){
                    e.preventDefault();
                    var action = $(this).attr('action');

                    $.ajax({
                        url: action,
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
});

</script>
@endpush