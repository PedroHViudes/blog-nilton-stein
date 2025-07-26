{{-- Usamos o nosso layout principal --}}
@extends('layouts.app')

{{-- Definimos o conteúdo que entrará no @yield('content') do layout --}}
@section('content')

    <div class="hero-image-only"></div>

    <section class="intro-section">
        <div class="container">
            <h1>Ideias e Ação por Jacarezinho</h1>
            <p>Um espaço para debater política, educação e o futuro da nossa cidade. Seja bem-vindo.</p>
            <a href="#about" class="btn btn-primary">Conheça minha trajetória</a>
        </div>
    </section>

    <section id="posts">
        <div class="container">
            <h2 class="section-title">Últimas Publicações</h2>
            <div class="posts-grid">
                
                {{-- AQUI COMEÇA A MÁGICA DO LARAVEL --}}
                @forelse ($posts as $post)
                    <div class="post-card">
                        {{-- Exibe a imagem do post, ou uma imagem padrão se não houver --}}
                        <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('img/placeholder-post.png') }}" alt="{{ $post->title }}">
                        <div class="post-card-content">
                            <span class="category">{{ $post->category }}</span>
                            <h3>{{ $post->title }}</h3>
                            
                            {{-- LINHA CORRIGIDA AQUI --}}
                            <p>{{ Str::limit(html_entity_decode(strip_tags($post->content)), 100) }}</p>
                            
                            {{-- O link agora aponta para a rota do post específico --}}
                            <a href="{{ route('posts.show', $post) }}" class="read-more">Leia Mais →</a>
                        </div>
                    </div>
                @empty
                    {{-- Mensagem que aparece se não houver nenhum post no banco --}}
                    <p>Nenhuma publicação encontrada no momento.</p>
                @endforelse
                {{-- AQUI TERMINA A MÁGICA --}}

            </div>
             {{-- Adicionando o botão para ver todas as publicações --}}
             <div class="posts-call-to-action text-center" style="margin-top: 4rem;">
                <a href="{{ route('blog.index') }}" class="btn btn-primary">Ver todas as publicações</a>
            </div>
        </div>
    </section>

    {{-- O resto do seu HTML da página inicial (Sobre, Contato, etc.) --}}
    <section id="about">
        <div class="container">
            <h2 class="section-title">Sobre Mim</h2>
            <div class="about-container">
                <div class="about-photo">
                    <img src="img/nilton.png" alt="Foto do Professor Nilton Stein">
                </div>
                <div class="about-text">
                    <h3>Professor, Político e Cidadão Jacarezinhense</h3>
                    <p>Com uma longa carreira dedicada à educação e ao serviço público, minha jornada sempre foi pautada pelo diálogo e pela busca de soluções para a nossa gente. Este espaço é uma extensão do meu compromisso com a transparência e o debate de ideias.</p>
                    <div class="highlights-grid">
                        <div class="highlight-item">
                            <i class="fas fa-landmark icon"></i>
                            <h4>Atuação Política</h4>
                            <p>Ex-vereador comprometido com as causas populares.</p>
                        </div>
                        <div class="highlight-item">
                            <i class="fas fa-graduation-cap icon"></i>
                            <h4>+20 Anos em Educação</h4>
                            <p>Formando cidadãos e lutando por um ensino de qualidade.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <h2 class="section-title">Entre em Contato</h2>
            <p class="contact-intro">Sua opinião é importante. Envie suas dúvidas, sugestões ou vamos simplesmente conversar sobre o futuro da nossa cidade.</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/nilton.astein" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/nilton_stein/?fbclid=IwY2xjawLx76BleHRuA2FlbQIxMABicmlkETFuM2F2Qm85b0VVZHR1TDVkAR6m4Gwsx6iCJoFjLo9pSt7a_5Sk7xaPW0Wzs23TEbdGxV9_bIGLu4pd7ydAxg_aem_MlQ0ZKRjEJtAZHQjngZl9w#" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://x.com/SteinNilton?fbclid=IwY2xjawLx781leHRuA2FlbQIxMABicmlkETFuM2F2Qm85b0VVZHR1TDVkAR4gXyRwLYdsmZvhxeldsrB26wI83jG1Gw_kpJy7bh9LaEKXaTmbXBv9kDqUKg_aem_0VCsXt-TiY6y-S98xC-d7w" target="_blank" title="Twitter/X"><i class="fa-brands fa-x-twitter"></i></a>
            </div>
            <div class="contact-details">
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:niltonstein27@gmail.com">niltostein27@gmail.com</a>
                </div>
                <div class="contact-item">
                    <i class="fab fa-whatsapp"></i>
                    <a href="https://wa.me/554399093550" target="_blank">(43)9909-3550</a>
                </div>
            </div>
        </div>
    </section>

@endsection