@extends('templates.base')
@section('title', 'Perfil')

@section('content')
<div class="d-flex rounded shadow-sm bg-tomato text-white my-3">
    <div class="d-flex align-items-center p-3" style="margin-right: auto;">
        <div class="me-2 bg-light card-img-background rounded-circle d-inline-block" style="background-image: url('@if (Auth::user()->profile_image == null) {{asset('img/no_image_user.jpg')}} @else {{asset('img/' . Auth::user()->profile_image)}} @endif'); height: 35px; width: 35px; min-width: unset; background-size: cover;" alt="Usuário"></div>
        <div class="lh-1">
            <h3 class="h6 mb-0 lh-1">{{ Auth::User()->username }}</h3>
            <small>{{ ucfirst(Auth::User()->type) }}</small>
        </div>
    </div>
    <div class="py-3 d-flex align-items-center px-3 justify-content-end rounded"  style="-webkit-box-shadow: inset -120px 0px 17px -5px rgb(0,0,0,0.10); box-shadow: inset -120px 0px 17px -5px rgb(0 0 0 / 10%);">
        <button class="me-2 btn btn-primary text-white editar-imagem shadow" style="font-weight: 500; width: fit-content;" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar imagem de perfil"><i class="bi bi-camera"></i></button>
        <button class="me-2 btn text-white editar-perfil shadow" style="font-weight: 500; width: fit-content; background-color: #ff4d00"  data-bs-toggle="tooltip" data-bs-placement="top" title="Editar informações de perfil"><i class="bi bi-pencil-square"></i></button>
        <button class="btn btn-secondary text-white editar-senha shadow" style="font-weight: 500; width: fit-content;" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar senha"><i class="bi bi-key"></i></button>
    </div>
</div>
<div class="container my-3 p-3 bg-light rounded shadow border">

    <div class="row text-muted m-3">
        <h2 class="text-center">Informações de perfil</h2>
    </div>

    <div class="row text-muted m-3 mb-5 border-top">
        <div class="col d-flex border-bottom p-3 justify-content-center" style="min-width: 250px">
            <div class="bd-placeholder-img flex-shrink-0 me-2 rounded bg-primary text-white d-flex justify-content-center align-items-center" style="width: 35px; height: 35px">
                <i class="bi bi-person-square"></i>
            </div>
            <p class="mb-0 small lh-sm">
                <strong class="d-block text-gray-dark">Nome de usuário</strong>
                {{ Auth::User()->username }}
            </p>
        </div>

        <div class="col d-flex border-bottom p-3 justify-content-center" style="min-width: 250px">
            <div class="bd-placeholder-img flex-shrink-0 me-2 rounded bg-secondary text-white d-flex justify-content-center align-items-center" style="width: 35px; height: 35px">
                <i class="bi bi-person-badge"></i>
            </div>
            <p class="mb-0 small lh-sm">
                <strong class="d-block text-gray-dark">Tipo de conta</strong>
                {{ ucfirst(Auth::User()->type) }}
            </p>
        </div>

        <div class="col d-flex border-bottom p-3 justify-content-center" style="min-width: 250px">
            <div class="bd-placeholder-img flex-shrink-0 me-2 rounded bg-info text-white d-flex justify-content-center align-items-center" style="width: 35px; height: 35px">
                <i class="bi bi-envelope inline-block"></i>
            </div>
            <p class="mb-0 small lh-sm">
                <strong class="d-block text-gray-dark">E-mail</strong>
                {{ Auth::User()->email }}
            </p>
        </div>
        @can('empresa')
        <div class="col d-flex border-bottom p-3 justify-content-center" style="min-width: 250px">
            <div class="bd-placeholder-img flex-shrink-0 me-2 rounded bg-success text-white d-flex justify-content-center align-items-center" style="width: 35px; height: 35px">
                <i class="bi bi-shop-window inline-block"></i>
            </div>
            <p class="mb-0 small lh-sm">
                <strong class="d-block text-gray-dark">Estabelecimentos</strong>
                {{ $estabelecimentos_count }}
            </p>
        </div>

        <div class="col d-flex border-bottom p-3 justify-content-center" style="min-width: 250px">
            <div class="bd-placeholder-img flex-shrink-0 me-2 rounded bg-danger text-white d-flex justify-content-center align-items-center" style="width: 35px; height: 35px">
                <i class="bi bi-clipboard-check inline-block"></i>
            </div>
            <p class="mb-0 small lh-sm">
                <strong class="d-block text-gray-dark">Cardápios</strong>
                {{ $cardapios_count }}
            </p>
        </div>

        <div class="col d-flex border-bottom p-3 justify-content-center" style="min-width: 250px">
            <div class="bd-placeholder-img flex-shrink-0 me-2 rounded bg-dark text-white d-flex justify-content-center align-items-center" style="width: 35px; height: 35px">
                <i class="bi bi-cup-straw inline-block"></i>
            </div>
            <p class="mb-0 small lh-sm">
                <strong class="d-block text-gray-dark">Produtos</strong>
                {{ $produtos_count }}
            </p>
        </div>
        @endcan

        @can('cliente')
        <div class="col d-flex border-bottom p-3 justify-content-center" style="min-width: 250px">
            <div class="bd-placeholder-img flex-shrink-0 me-2 rounded bg-warning text-white d-flex justify-content-center align-items-center" style="width: 35px; height: 35px">
                <i class="bi bi-star inline-block"></i>
            </div>
            <p class="mb-0 small lh-sm">
                <strong class="d-block text-gray-dark">Avaliações</strong>
                {{ $avaliacoes_count }}
            </p>
        </div>
        @endcan
    </div>
</div>
<div class="modal fade" id="form-modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen-lg-down">
  </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){

    $('.editar-perfil').click(function() {
        
        $.ajax({
            url: '{{ route("perfil.edit") }}',
            type: 'get',
            success: function(response){
                $('.modal-dialog').html(response);
                $('#form-modal').modal('show');

                $('#editar-perfil-form').on("submit", function(e){
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

    $('.editar-senha').click(function() {
        
        $.ajax({
            url: '{{ route("senha.edit") }}',
            type: 'get',
            success: function(response){
                $('.modal-dialog').html(response);
                $('#form-modal').modal('show');

                $('#editar-senha-form').on("submit", function(e){
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

    $('.editar-imagem').click(function() {
        
        $.ajax({
            url: '{{ route("imagem.edit") }}',
            type: 'get',
            success: function(response){
                $('.modal-dialog').html(response);
                $('#form-modal').modal('show');

                $('#editar-imagem-form').on("submit", function(e){
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