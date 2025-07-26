<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- O título será dinâmico, mas podemos ter um padrão --}}
    <title>{{ $title ?? 'Professor Nilton Stein - Blog' }}</title>

    {{-- Links de CSS e Ícones --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- O jeito certo de linkar o seu CSS no Laravel --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>⭐</text></svg>">
</head>

<body class="@yield('body-class')">

    <header class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="logo">Prof. Nilton Stein <span class="star">★</span></a>
            <ul class="nav-links">
                {{-- Usamos a função route() para os links --}}
                <li><a href="{{ route('home') }}">Início</a></li>
                <li><a href="/#about">Sobre</a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li> {{-- Vamos criar essa rota depois --}}
                <li><a href="/#contact">Contato</a></li>

                {{-- Lógica para exibir Login ou Logout --}}
                @guest
                    {{-- Se o usuário for um "convidado" (não logado), mostra o link de Login --}}
                    {{-- APAGUE OU COMENTE A LINHA ABAIXO --}}
                    {{-- <li><a href="{{ route('login') }}">Login</a></li> --}}
                @endguest

                @auth
                    {{-- Se o usuário estiver autenticado (logado), mostra um link para criar post e um botão de Logout --}}
                    <li><a href="{{ route('posts.create') }}">Criar Post</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                Sair
                            </a>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </header>

    {{-- ÁREA DE CONTEÚDO DINÂMICO --}}
    {{-- É aqui que o conteúdo de cada página (home, login, etc.) será injetado --}}

    <main>
        {{-- ADICIONE ESTE BLOCO --}}
        @if (session('success'))
            <div class="container" style="margin-top: 20px;">
                <div
                    style="padding: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px;">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        {{-- FIM DO BLOCO --}}

        @yield('content')
    </main>


    <footer class="footer h-auto m-auto">
        <div class="container">
            <a href="{{ route('home') }}" class="logo">Prof. Nilton Stein <span class="star">★</span></a>
            <p>&copy; {{ date('Y') }} Todos os direitos reservados.</p>
            <a href="https://wa.me/5543984120051" class="text-decoration-none"><p>Feito por Pedro Henrique Viudes</p></a>
        </div>
    </footer>
@stack('scripts')
</body>

</html>