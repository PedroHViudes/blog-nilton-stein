@extends('layouts.app')

{{-- Adicionamos a classe para a página de formulário --}}
@section( 'form-page')

@section('content')
<br>
    {{-- A tag <body class="form-page"> foi REMOVIDA daqui --}}
    <div class="form-container p-5 " style=" 20px; margin:auto;">
        <a href="{{ route('home') }}" class="logo">Acesso Administrativo <span class="star">★</span></a>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                As credenciais não correspondem aos nossos registros.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>

        @if (Route::has('password.request'))
            <p><a href="{{ route('password.request') }}">Esqueceu a senha?</a></p>
        @endif
    </div>
    <br><br>
@endsection