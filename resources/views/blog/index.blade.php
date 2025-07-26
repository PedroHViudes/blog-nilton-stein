@extends('layouts.app')

@section('title', 'Blog - Professor Nilton Stein')

@section('content')
    <main>
        <header class="page-header">
            <div class="container">
                <h1>Blog</h1>
                <p>Todas as minhas publicações sobre política, educação e Jacarezinho.</p>
            </div>
        </header>

        <section class="blog-layout">
            <div class="container">

                {{-- Post em destaque --}}
                @if ($posts->isNotEmpty())
                    <article class="featured-post">
                        <div class="featured-post-img">
                            <a href="{{ route('posts.show', $posts->first()) }}">
                                <img src="{{ $posts->first()->image ? asset('storage/' . $posts->first()->image) : asset('img/placeholder-post.png') }}" alt="Post em destaque">
                            </a>
                        </div>
                        <div class="featured-post-content">
                            <span class="category">{{ $posts->first()->category }}</span>
                            <h2><a href="{{ route('posts.show', $posts->first()) }}">{{ $posts->first()->title }}</a></h2>
                            
                            {{-- LINHA CORRIGIDA COM A FUNÇÃO ADICIONAL --}}
                            <p>{{ Str::limit(html_entity_decode(strip_tags($posts->first()->content)), 200) }}</p>

                            <a href="{{ route('posts.show', $posts->first()) }}" class="btn btn-primary">Continuar Lendo</a>
                        </div>
                    </article>
                @endif

                {{-- Grade com o restante dos posts --}}
                <div class="blog-posts-grid">
                    @forelse ($posts->skip(1) as $post)
                        <div class="post-card">
                            <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('img/placeholder-post.png') }}" alt="{{ $post->title }}">
                            <div class="post-card-content">
                                <span class="category">{{ $post->category }}</span>
                                <h3>{{ $post->title }}</h3>

                                {{-- LINHA CORRIGIDA COM A FUNÇÃO ADICIONAL --}}
                                <p>{{ Str::limit(html_entity_decode(strip_tags($post->content)), 100) }}</p>
                                
                                <a href="{{ route('posts.show', $post) }}" class="read-more">Leia Mais →</a>
                            </div>
                        </div>
                    @empty
                        <p>Nenhuma outra publicação encontrada.</p>
                    @endforelse
                </div>

                {{-- Links de paginação --}}
                <nav>
                    {{ $posts->links() }}
                </nav>

            </div>
        </section>
    </main>
@endsection