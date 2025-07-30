@extends('layouts.app')

{{-- Esta linha nova diz ao layout para adicionar a classe 'form-page' na tag <body> --}}
@section('form-page')
@endsection {{-- CORREÇÃO: Fechei a section que estava aberta --}}

@section('content')
    <br>
    <div class="form-container" style="max-width: 800px; margin: auto; ">
        <a href="#" class="logo">Criar Nova Publicação</a>

        {{-- MUDANÇA 1: Adicionamos um id="form-publicacao" ao formulário --}}
        <form id="form-publicacao" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Título do Post</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')<div style="color:red;font-size:0.8rem;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="category">Categoria</label>
                <input type="text" id="category" name="category" class="form-control"
                    placeholder="Ex: Política, Educação..." value="{{ old('category') }}" required>
                @error('category')<div style="color:red;font-size:0.8rem;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="content">Conteúdo</label>
                {{-- O id="content" aqui é o que o TinyMCE usa para encontrar a textarea --}}

                <textarea id="content" name="content" class="form-control" rows="10">{{ old('content') }}</textarea>

                @error('content')<div style="color:red;font-size:0.8rem;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="image">Imagem de Destaque</label>
                <input type="file" id="image" name="image" class="form-control">
                @error('image')<div style="color:red;font-size:0.8rem;">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Publicar</button>
        </form>
    </div>
    <br>
@endsection

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/k6pha1u0r29lk62ibzptm35c977iyppfqbux8zt86c3ofhaj/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#content', // Seleciona a textarea pelo ID
            plugins: 'lists link image media table code help wordcount',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image | table | code'
        });

        // MUDANÇA 2: Adicionamos este script para salvar o conteúdo do TinyMCE
        // Pega o formulário pelo ID que demos a ele
        const form = document.getElementById('form-publicacao');

        // Adiciona um "escutador" que fica esperando o evento de "submit" (envio)
        form.addEventListener('submit', (event) => {
            // Quando o formulário for enviado, esta linha mágica é executada
            // Ela força o TinyMCE a salvar seu conteúdo na textarea original
            tinymce.triggerSave();
        });
    </script>
@endpush
