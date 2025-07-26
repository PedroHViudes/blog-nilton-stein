<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(6)->get();
        return view('home', ['posts' => $posts]);
    }

    public function blogIndex()
    {
        $posts = Post::latest()->paginate(9);
        return view('blog.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->category = $validated['category'];
        $post->content = $validated['content'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('home')->with('success', 'Publicação criada com sucesso!');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

     public function edit(Post $post)
    {
        // Retorna a view de edição e passa o post que queremos editar
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     * Método para ATUALIZAR o post no banco.
     */
    public function update(Request $request, Post $post)
    {
        // A validação é a mesma da criação
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Se uma nova imagem foi enviada, salva a nova e apaga a antiga
        if ($request->hasFile('image')) {
            // Apaga a imagem antiga se ela existir
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        // O comando update faz a mágica de atualizar o post com os novos dados
        $post->update($validated);

        return redirect()->route('home')->with('success', 'Publicação atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     * Método para DELETAR o post.
     */
    public function destroy(Post $post)
    {
        // Apaga a imagem do armazenamento se ela existir
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // Apaga o post do banco de dados
        $post->delete();

        return redirect()->route('home')->with('success', 'Publicação removida com sucesso!');
    }


}