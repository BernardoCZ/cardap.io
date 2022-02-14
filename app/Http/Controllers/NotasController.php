<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimento;
use App\Models\Nota;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class NotasController extends Controller
{
    public function create($id_estabelecimento)
    {
        return view('notas.create', ['id_estabelecimento' => $id_estabelecimento]);
    }
    public function insert(Request $form)
    {
        $form->validate([
            'valor' => ['required', 'numeric', 'between:0,5']
        ]);

        $form->valor = number_format($form->valor, 1, '.', '');
        
        $nota = new Nota();

        $nota->id_usuario = FacadesAuth::user()->id;
        $nota->id_estabelecimento = $form->id_estabelecimento;
        $nota->valor = $form->valor;

        $nota->save();

        return true;
    }
}
