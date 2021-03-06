<?php

use App\Http\Controllers\CardapiosController;
use App\Http\Controllers\EstabelecimentosController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ImagensController;
use App\Http\Controllers\NotasController;
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
// ROTAS DE BUSCA
Route::get('/', [EstabelecimentosController::class, 'search'])->name('home');
Route::get('/buscar', [EstabelecimentosController::class, 'search'])->name('buscar');


//ROTAS DE CADASTRO
Route::get('/cadastrar', [UsuariosController::class, 'create'])->name('usuarios.inserir');
Route::post('/cadastrar', [UsuariosController::class, 'insert'])->name('usuarios.gravar');


//ROTAS DE LOGIN
Route::get('/login', [UsuariosController::class, 'login'])->name('login');
Route::post('/login', [UsuariosController::class, 'login']);

Route::get('/logout', [UsuariosController::class, 'logout'])->name('logout');


//ROTAS DE PERFIL
Route::get('/perfil', [UsuariosController::class, 'profile'])->middleware('auth')->name('perfil');

Route::get('/perfil/edit', [UsuariosController::class, 'edit'])->middleware('auth')->name('perfil.edit');
Route::put('/perfil/edit', [UsuariosController::class, 'update'])->middleware('auth')->name('perfil.update');

Route::get('/perfil/password', [UsuariosController::class, 'alterar_senha'])->middleware('auth')->name('senha.edit');
Route::put ('/perfil/password', [UsuariosController::class, 'update_senha'])->middleware('auth')->name('senha.update');

Route::get('/perfil/imagem', [UsuariosController::class, 'editImagem'])->middleware('auth')->name('imagem.edit');
Route::put('/perfil/imagem', [UsuariosController::class, 'updateImagem'])->middleware('auth')->name('imagem.update');

Route::get('/perfil/imagem/cortar', [UsuariosController::class, 'crop'])->middleware('auth')->name('imagem.crop');
Route::post('/perfil/imagem/cortar', [UsuariosController::class, 'cut'])->middleware('auth')->name('imagem.cut');


//ROTAS DE ESTABELECIMENTOS
Route::prefix('/estabelecimentos')->group(function() {

    Route::get('/', [EstabelecimentosController::class, 'index'])
        ->middleware(['auth', 'can:empresa'])->name('estabelecimentos');

    Route::get('/inserir', [EstabelecimentosController::class, 'create'])
        ->middleware(['auth', 'can:empresa'])->name('estabelecimentos.inserir');
    Route::post('/inserir', [EstabelecimentosController::class, 'insert'])
        ->middleware(['auth', 'can:empresa'])->name('estabelecimentos.gravar');
    Route::get('/{estabelecimento}', [EstabelecimentosController::class, 'show'])->name('estabelecimentos.show');

});

Route::get('/estabelecimento/editar', [EstabelecimentosController::class, 'edit'])
    ->middleware(['auth', 'can:empresa'])->name('estabelecimentos.edit');
Route::put('/estabelecimento/{estabelecimento}/editar', [EstabelecimentosController::class, 'update'])
    ->middleware(['auth', 'can:empresa'])->name('estabelecimentos.update');

Route::get('/estabelecimento/editar/logo', [EstabelecimentosController::class, 'editLogo'])
    ->middleware(['auth', 'can:empresa'])->name('logo.edit');
Route::put('/estabelecimento/{estabelecimento}/editar/logo', [EstabelecimentosController::class, 'updateLogo'])
    ->middleware(['auth', 'can:empresa'])->name('logo.update');

Route::get('/estabelecimento/cortar/logo', [EstabelecimentosController::class, 'crop'])
    ->middleware(['auth', 'can:empresa'])->name('logo.crop');
Route::post('/estabelecimento/{estabelecimento}/cortar/logo', [EstabelecimentosController::class, 'cut'])
    ->middleware(['auth', 'can:empresa'])->name('logo.cut');

Route::get('/estabelecimento/apagar', [EstabelecimentosController::class, 'remove'])
    ->middleware(['auth', 'can:empresa'])->name('estabelecimentos.remove');
Route::delete('/estabelecimento/{estabelecimento}/apagar', [EstabelecimentosController::class, 'delete'])
    ->middleware(['auth', 'can:empresa'])->name('estabelecimentos.delete');


//ROTAS DE CARDAPIOS
Route::get('/{id_estabelecimento}/cardapio/inserir', [CardapiosController::class, 'create'])
    ->middleware(['auth', 'can:empresa'])->name('cardapios.inserir');
Route::post('/cardapio/inserir', [CardapiosController::class, 'insert'])
    ->middleware(['auth', 'can:empresa'])->name('cardapios.gravar');

Route::get('/cardapio/editar', [CardapiosController::class, 'edit'])
    ->middleware(['auth', 'can:empresa'])->name('cardapios.edit');
Route::put('/cardapio/{cardapio}/editar', [CardapiosController::class, 'update'])
    ->middleware(['auth', 'can:empresa'])->name('cardapios.update');

Route::get('/cardapio/apagar', [CardapiosController::class, 'remove'])
    ->middleware(['auth', 'can:empresa'])->name('cardapios.remove');
Route::delete('/cardapio/{cardapio}/apagar', [CardapiosController::class, 'delete'])
    ->middleware(['auth', 'can:empresa'])->name('cardapios.delete');


//ROTAS DE PRODUTOS
Route::get('/produto/inserir', [ProdutosController::class, 'create'])
    ->middleware(['auth', 'can:empresa'])->name('produtos.inserir');
Route::post('/produto/inserir', [ProdutosController::class, 'insert'])
    ->middleware(['auth', 'can:empresa'])->name('produtos.gravar');

Route::get('/produto/editar', [ProdutosController::class, 'edit'])
    ->middleware(['auth', 'can:empresa'])->name('produtos.edit');
Route::put('/produto/{produto}/editar', [ProdutosController::class, 'update'])
    ->middleware(['auth', 'can:empresa'])->name('produtos.update');

Route::get('/produto/editar/foto', [ProdutosController::class, 'editFoto'])
    ->middleware(['auth', 'can:empresa'])->name('foto.edit');
Route::put('/produto/{produto}/editar/foto', [ProdutosController::class, 'updateFoto'])
    ->middleware(['auth', 'can:empresa'])->name('foto.update');

Route::get('/produto/cortar/foto', [ProdutosController::class, 'crop'])
    ->middleware(['auth', 'can:empresa'])->name('foto.crop');
Route::post('/produto/{produto}/cortar/foto', [ProdutosController::class, 'cut'])
    ->middleware(['auth', 'can:empresa'])->name('foto.cut');

Route::get('/produto/apagar', [ProdutosController::class, 'remove'])
    ->middleware(['auth', 'can:empresa'])->name('produtos.remove');
Route::delete('/produto/{produto}/apagar', [ProdutosController::class, 'delete'])
    ->middleware(['auth', 'can:empresa'])->name('produtos.delete');


//ROTAS DE NOTAS
Route::get('/{id_estabelecimento}/nota/inserir', [NotasController::class, 'create'])
    ->middleware(['auth', 'can:cliente'])->name('notas.inserir');
Route::post('/nota/inserir', [notasController::class, 'insert'])
    ->middleware(['auth', 'can:cliente'])->name('notas.gravar');