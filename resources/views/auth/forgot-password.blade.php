@extends('layouts.app')

@section( 'form-page')

@section('content')
<br>
    <div class="form-container " style="margin: auto;">
        <div style="margin-bottom: 1rem; color: #6b7280; text-align: center;">
            Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos um link de redefinição de senha que permitirá que você escolha uma nova.
        </div>

        {{-- Mostra a mensagem de status, como "Link enviado!" --}}
        @if (session('status'))
            <div style="color: green; font-weight: bold; margin-bottom: 1rem; text-align: center;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus />
                @error('email')<div style="color:red;font-size:0.8rem;">{{ $message }}</div>@enderror
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 1rem;">
                <button type="submit" class="btn btn-primary">
                    Enviar Link de Redefinição
                </button>
            </div>
        </form>
    </div>
    <br><br><br><br><br>
@endsection