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

class ProdutosController extends Controller
{
    public function create()
    {
        $id_cardapio = $_GET['id'];
        $cor = Cardapio::orderBy('id', 'asc')->where('id', $id_cardapio)->value('cor_produtos');
        return view('produtos.create', ['id_cardapio' => $id_cardapio, 'cor' => $cor]);
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
            'preco' => ['nullable', 'max:13', 'regex:/^\d+(\.\d{1,2})?$/'],
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
}