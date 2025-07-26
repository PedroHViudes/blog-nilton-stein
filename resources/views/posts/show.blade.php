@extends('layouts.app')

{{-- Podemos até definir um título dinâmico para a página --}}
@section('title', $post->title)

@section('content')
    <main class="single-post-page">
        <div class="container">
            <article>
                <header class="post-header">
                    <span class="category">{{ $post->category }}</span>
                    <h1>{{ $post->title }}</h1>
                    <div class="post-meta">
                        <span>Por Professor Nilton Stein</span> &bull;
                        {{-- Formatando a data de criação para o formato brasileiro --}}
                        <span>{{ $post->created_at->format('d \d\e F \d\e Y') }}</span>
                    </div>
                </header>

                <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('img/placeholder-post.png') }}"
                    alt="Imagem de destaque do post" class="post-feature-image">

                <div class="post-content">
                    {{-- Usamos {!! !!} para renderizar HTML que possa estar no conteúdo --}}
                    {!! $post->content !!}
                </div>
            </article>

            {{-- ADICIONE ESTE BLOCO DE CÓDIGO --}}
            @auth
                <div class="admin-actions"
                    style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; display: flex; gap: 10px;">

                    {{-- Botão para Editar --}}
                    <a href="{{ route('posts.edit', $post) }}"
                        style="display: inline-block; background-color: #0d6efd; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: 500;">
                        Editar
                    </a>

                    {{-- Formulário para Deletar --}}
                    <form method="POST" action="{{ route('posts.destroy', $post) }}"
                        onsubmit="return confirm('Tem certeza que deseja remover esta publicação? Esta ação não pode ser desfeita.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            style="background-color: #dc3545; color: white; padding: 10px 18px; border-radius: 6px; border: none; font-weight: 500; font-size: 16px; cursor: pointer;">
                            Remover
                        </button>
                    </form>

                </div>
            @endauth
            {{-- FIM DO BLOCO --}}

        </div>
    </main>
@endsection