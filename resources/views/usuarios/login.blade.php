@extends('templates.base_login')
@section('title', 'Fazer Login')

@section('content')

    <form method="post" action="{{ route('login') }}">
        @csrf

        <a href="{{ route('home') }}" class="h1 mb-4 text-white text-logo text-decoration-none">Cardap.io</a>
        <h2 class="h3 mt-2 mb-3 fw-normal text-white">Faça login na sua conta</h1>

        <div class="form-floating">
            <input type="email" class="form-control first_input" id="email" placeholder="Email" name="email">
            <label for="email">Endereço de email</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control middle_input" id="password" placeholder="Senha" name="password">
            <label for="password">Senha</label>
        </div>

        @if (session('erro'))
        
        <!-- Erro -->
        <div class="alert alert-danger">{{ session('erro') }}</div>

        @endif

        <div class="alert alert-light last-input" style="border: 1px solid #ced4da; color: #212529">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="lembrar"> Lembrar-me neste computador
                </label>
            </div>
        </div>

        <button class="w-100 btn btn-lg btn-light" type="submit">Entrar</button>

        <div class="mb-3" style="margin-top: 1rem">
            <a href="{{ route('usuarios.inserir') }}" class="text-white">Ainda não está cadastrado? Cadastre-se agora!</a>
        </div>
    </form>
@endsection