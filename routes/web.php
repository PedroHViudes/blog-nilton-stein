<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Rota para a Página Inicial (Home) - Listar os 6 últimos posts
Route::get('/', [PostController::class, 'index'])->name('home');

// Rota para a Página do Blog - Listar TODOS os posts com paginação
Route::get('/blog', [PostController::class, 'blogIndex'])->name('blog.index');

// Rota para ver um Post Único (Single Post)
Route::get('/post/{post}', [PostController::class, 'show'])->name('posts.show');



Route::middleware('auth')->group(function () {

    // Rota para a PÁGINA de criar post
    Route::get('/admin/posts/criar', [PostController::class, 'create'])->name('posts.create');

    // Rota para SALVAR um novo post
    Route::post('/admin/posts', [PostController::class, 'store'])->name('posts.store');

    // Rota para mostrar a PÁGINA DE EDIÇÃO de um post específico
    Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

    // Rota para ATUALIZAR o post no banco de dados após editar
    Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('posts.update');

    // Rota para DELETAR um post
    Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

});
require __DIR__.'/auth.php';
