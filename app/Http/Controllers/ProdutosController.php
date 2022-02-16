<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\Estabelecimento;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Storage;

class ProdutosController extends Controller
{
    public function create()
    {
        $id_cardapio = $_GET['id'];
        $cardapio = Cardapio::orderBy('id', 'asc')->where('id', $id_cardapio)->first();
        return view('produtos.create', ['cardapio' => $cardapio]);
    }

    public function insert(Request $form)
    {
        try {
            $id_estabelecimento = Cardapio::orderBy('id', 'asc')->where('id', $form->id_cardapio)->value('id_estabelecimento');
            $id_usuario = Estabelecimento::orderBy('id', 'asc')->where('id', $id_estabelecimento)->value('id_usuario');
            if ($id_usuario != FacadesAuth::user()->id) {
                throw new Exception();
            }
        }
        catch (Exception $exception) {
            return response()->json([
                'status' => 422,
                'errors' => ['id_cardapio' => ['Ação inautorizada para o usuário atual.']]
            ], 422);
        }

        $form->validate([
            'nome' => ['required', 'min:2', 'max:45'],
            'moeda' => ['nullable', 'in:R$,US$,€,£'],
            'preco' => ['nullable', 'max:99999999999', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'descricao' => ['required', 'min:3', 'max: 200'],
            'foto' => ['nullable','image']
        ]);

        $imgPath = null;
        if($form->file('foto')){
            $imgPath = $form->file('foto')->store('', 'imagens');
        }
        
        $produto = new Produto();

        $produto->id_cardapio = $form->id_cardapio;
        $produto->nome = $form->nome;
        $produto->moeda = $form->moeda;
        $produto->preco = $form->preco;
        $produto->descricao = $form->descricao;
        $produto->foto = $imgPath;

        $produto->save();

        return true;

    }
    public function remove()
    {
        $produto = Produto::orderBy('id', 'asc')->where('id', $_GET['id'])->first();
        return view('produtos.remove', ['produto' => $produto]);
    }

    public function delete(Produto $produto)
    {
        try {
            $id_estabelecimento = Cardapio::orderBy('id', 'asc')->where('id', $produto->id_cardapio)->value('id_estabelecimento');
            $id_usuario = Estabelecimento::orderBy('id', 'asc')->where('id', $id_estabelecimento)->value('id_usuario');
            if ($id_usuario != FacadesAuth::user()->id) {
                throw new Exception();
            }
        }
        catch (Exception $exception) {
            return response()->json([
                'status' => 422,
                'errors' => ['id_produto' => ['Ação inautorizada para o usuário atual.']]
            ], 422);
        }

        if ($produto->foto) {
            $image_path = public_path().'/img/'.$produto->foto;
            unlink($image_path);
        }
        $produto->delete();
        return redirect()->route('estabelecimentos.show', $id_estabelecimento);
    }

    public function edit()
    {
        $produto = Produto::orderBy('id', 'asc')->where('id', $_GET['id'])->first();
        $cardapio = Cardapio::orderBy('id', 'asc')->where('id', $produto->id_cardapio)->first();
        return view('produtos.edit', ['produto' => $produto, 'cardapio' => $cardapio]);
    }

    public function update(Request $form, Produto $produto)
    {

        try {
            $id_estabelecimento = Cardapio::orderBy('id', 'asc')->where('id', $produto->id_cardapio)->value('id_estabelecimento');
            $id_usuario = Estabelecimento::orderBy('id', 'asc')->where('id', $id_estabelecimento)->value('id_usuario');
            if ($id_usuario != FacadesAuth::user()->id) {
                throw new Exception();
            }
        }
        catch (Exception $exception) {
            return response()->json([
                'status' => 422,
                'errors' => ['id_produto' => ['Ação inautorizada para o usuário atual.']]
            ], 422);
        }

        $form->validate([
            'nome' => ['required', 'min:2', 'max:45'],
            'moeda' => ['nullable', 'in:R$,US$,€,£'],
            'preco' => ['nullable', 'max:99999999999', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'descricao' => ['required', 'min:3', 'max: 200']
        ]);

        $produto->nome = $form->nome;
        $produto->moeda = $form->moeda;
        $produto->preco = $form->preco;
        $produto->descricao = $form->descricao;

        $produto->save();

        return true;
    }

    public function editFoto()
    {
        $produto = Produto::orderBy('id', 'asc')->where('id', $_GET['id'])->first();
        $cardapio = Cardapio::orderBy('id', 'asc')->where('id', $produto->id_cardapio)->first();
        return view('produtos.editFoto', ['produto' => $produto, 'cardapio' => $cardapio]);
    }

    public function updateFoto(Request $form, Produto $produto)
    {

        try {
            $id_estabelecimento = Cardapio::orderBy('id', 'asc')->where('id', $produto->id_cardapio)->value('id_estabelecimento');
            $id_usuario = Estabelecimento::orderBy('id', 'asc')->where('id', $id_estabelecimento)->value('id_usuario');
            if ($id_usuario != FacadesAuth::user()->id) {
                throw new Exception();
            }
        }
        catch (Exception $exception) {
            return response()->json([
                'status' => 422,
                'errors' => ['id_produto' => ['Ação inautorizada para o usuário atual.']]
            ], 422);
        }

        $form->validate([
            'foto' => ['nullable','image']
        ]);

        if ($produto->foto) {
            $image_path = public_path().'/img/'.$produto->foto;
            unlink($image_path);
        }
        $imgPath = null;
        if($form->file('foto')){
            $imgPath = $form->file('foto')->store('', 'imagens');
        }

        $produto->foto = $imgPath;

        $produto->save();

        return true;
    }
}
