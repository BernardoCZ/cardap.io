@extends('templates.base_login')
@section('title', 'Cadastrar-se')
@section('subtitle', 'Criar conta')

@section('content')

    <form method="post" action="{{ route('usuarios.gravar') }}">

        @csrf

        <select class="form-select mb-3" name="type">
            <option value="cliente">Conta Cliente</option>
            <option value="empresa">Conta Empresarial</option>
        </select>

        <div class="form-floating">
            <input type="text" class="form-control first_input" id="username" placeholder="Nome de usuário" name="username" minlength="3" maxlength="20" required>
            <label for="username">Nome de usuário</label>
        </div>

        <div class="form-floating">
            <input type="email" class="form-control middle_input" id="email" placeholder="Endereço de email" name="email" maxlength="100" required>
            <label for="email">Endereço de email</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control middle_input" id="password" placeholder="Senha" name="password" minlength="8" maxlength="20" required>
            <label for="password">Senha</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control last-input" id="password_confirmation" placeholder="Confirmar senha" name="password_confirmation" minlength="8" maxlength="20" required>
            <label for="password_confirmation">Confirmar senha</label>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <button class="w-100 btn btn-lg btn-light" type="submit">Cadastrar-se</button>

        <div class="mb-3" style="margin-top: 1rem">
            <a href="{{ route('login') }}" class="text-white">Já tem uma conta? Logue agora mesmo!</a>
        </div>
    </form>
@endsection