<?php

use App\Http\Controllers\CardapiosController;
use App\Http\Controllers\EstabelecimentosController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ImagensController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [EstabelecimentosController::class, 'search'])->name('home');
Route::get('/buscar', [EstabelecimentosController::class, 'search'])->name('buscar');

Route::get('/cadastrar', [UsuariosController::class, 'create'])->name('usuarios.inserir');
Route::post('/cadastrar', [UsuariosController::class, 'insert'])->name('usuarios.gravar');

Route::get('/login', [UsuariosController::class, 'login'])->name('login');
Route::post('/login', [UsuariosController::class, 'login']);

Route::get('/logout', [UsuariosController::class, 'logout'])->name('logout');

Route::prefix('/estabelecimentos')->group(function() {

    Route::get('/', [EstabelecimentosController::class, 'index'])
        ->middleware(['auth', 'can:empresa'])->name('estabelecimentos');

    Route::get('/inserir', [EstabelecimentosController::class, 'create'])
        ->middleware(['auth', 'can:empresa'])->name('estabelecimentos.inserir');
    Route::post('/inserir', [EstabelecimentosController::class, 'insert'])
        ->middleware(['auth', 'can:empresa'])->name('estabelecimentos.gravar');
    Route::get('/{estabelecimento}', [EstabelecimentosController::class, 'show'])->name('estabelecimentos.show');

});

Route::get('/{id_estabelecimento}/cardapio/inserir', [CardapiosController::class, 'create'])
    ->middleware(['auth', 'can:empresa'])->name('cardapios.inserir');
Route::post('/cardapio/inserir', [CardapiosController::class, 'insert'])
    ->middleware(['auth', 'can:empresa'])->name('cardapios.gravar');

Route::get('/produto/inserir', [ProdutosController::class, 'create'])
    ->middleware(['auth', 'can:empresa'])->name('produtos.inserir');
Route::post('/produto/inserir', [ProdutosController::class, 'insert'])
    ->middleware(['auth', 'can:empresa'])->name('produtos.gravar');