@extends('templates.base_login')
@section('title', 'Fazer Login')
@section('subtitle', 'Faça login na sua conta')

@section('content')

    <form method="post" action="{{ route('login') }}">
        @csrf

        <div class="form-floating">
            <input type="email" class="form-control first_input" id="email" placeholder="Email" name="email" maxlength="100" required>
            <label for="email">Endereço de email</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control middle_input" id="password" placeholder="Senha" name="password" minlength="8" maxlength="20" required>
            <label for="password">Senha</label>
        </div>


        <div class="alert alert-light last-input" style="border: 1px solid #ced4da; color: #212529">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="lembrar"> Lembrar-me neste computador
                </label>
            </div>
        </div>

        @if (session('erro'))
        
        <!-- Erro -->
        <div class="alert alert-danger">{{ session('erro') }}</div>

        @endif

        <button class="w-100 btn btn-lg btn-light" type="submit">Entrar</button>

        <div class="mb-3" style="margin-top: 1rem">
            <a href="{{ route('usuarios.inserir') }}" class="text-white">Ainda não está cadastrado? Cadastre-se agora!</a>
        </div>
    </form>
@endsection