@extends('layouts.app')

@section('form-page')

@section('content')
    <br>
    <div class="form-container" style="max-width: 800px; margin: auto;">
        <a href="#" class="logo">Editar Publicação</a>

        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Título do Post</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}"
                    required>
                @error('title')<div style="color:red;font-size:0.8rem;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="category">Categoria</label>
                <input type="text" id="category" name="category" class="form-control"
                    value="{{ old('category', $post->category) }}" required>
                @error('category')<div style="color:red;font-size:0.8rem;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="content">Conteúdo</label>
                <textarea id="content" name="content" class="form-control" rows="10"
                    required>{{ old('content', $post->content) }}</textarea>
                @error('content')<div style="color:red;font-size:0.8rem;">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="post-image">Imagem de Destaque (deixe em branco para manter a atual)</label>
                <input type="file" id="image" name="image" class="form-control">
                @error('image')<div style="color:red;font-size:0.8rem;">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Publicação</button>
        </form>
    </div>
    <br>

    {{-- ADICIONE ESTE SCRIPT NO FINAL --}}
   <script src="https://cdn.tiny.cloud/1/k6pha1u0r29lk62ibzptm35c977iyppfqbux8zt86c3ofhaj/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <script>
        tinymce.init({
            selector: 'textarea#content', // Seleciona a textarea pelo ID
            plugins: 'lists link image media table code help wordcount',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image | table'
        });
    </script>
@endsection