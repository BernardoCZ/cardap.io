<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\Estabelecimento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class CardapiosController extends Controller
{
    public function create($id_estabelecimento)
    {
        return view('cardapios.create', ['id_estabelecimento' => $id_estabelecimento]);
    }

    public function insert(Request $form)
    {
        try {
            $id_usuario = Estabelecimento::orderBy('id', 'asc')->where('id', $form->id_estabelecimento)->value('id_usuario');
            if ($id_usuario != FacadesAuth::user()->id) {
                throw new Exception();
            }
        }
        catch (Exception $exception) {
            return response()->json([
                'status' => 422,
                'errors' => ['id_estabelecimento' => ['Ação inautorizada para o usuário atual.']]
            ], 422);
        }

        $form->validate([
            'nome' => ['required', 'min:3', 'max:100'],
            'cor_tema' => ['required', 'max:10'],
            'cor_produtos' => ['required', 'max:10'],
        ]);

        $visible = false;
            
        if ($form->visivel == "on")
        {
            $visible = true;
        }
        
        $cardapio = new Cardapio();

        $cardapio->id_estabelecimento = $form->id_estabelecimento;
        $cardapio->nome = $form->nome;
        $cardapio->cor_tema = $form->cor_tema;
        $cardapio->cor_produtos = $form->cor_produtos;
        $cardapio->visivel = $visible;

        $cardapio->save();

        return true;
    }
}
