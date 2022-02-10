<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\Estabelecimento;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EstabelecimentosController extends Controller
{
    public function index()
    {
        $estabelecimentos = Estabelecimento::orderBy('nome', 'asc')->where('id_usuario', FacadesAuth::user()->id)->get();
        
        return view('estabelecimentos.index', ['estabelecimentos' => $estabelecimentos]);
    }

    public function create()
    {
        return view('estabelecimentos.create');
    }

    public function insert(Request $form)
    {
        $form->validate([
            'nome' => ['required', 'min:3', 'max:45', Rule::unique('estabelecimentos')->where(function ($query) {
                return $query->where('id_usuario', FacadesAuth::user()->id);
            })],
            'tipo' => ['required', 'min:3', 'max:45'],
            'descricao' => ['required', 'min:3', 'max: 200'],
            'endereco' => ['max: 255'],
            'telefone' => ['max:20'],
            'whatsapp' => ['max:20'],
            'site' => ['nullable', 'url', 'max:100'],
            'facebook' => ['nullable', 'url', 'max:100'],
            'instagram' => ['nullable', 'url', 'max:100'],
            'linkedin' => ['nullable', 'url', 'max:100'],
            'messenger' => ['nullable', 'url', 'max:100'],
            'twitter' => ['nullable', 'url', 'max:100'],
            'youtube' => ['nullable', 'url', 'max:100'],
            'logo' => ['nullable','image'],
            'cor_tema' => ['required', 'max:10']
        ]);
        
        $imgPath = null;
        if($form->file('logo')){
            $imgPath = $form->file('logo')->store('', 'imagens');
        }
        
        $estabelecimento = new Estabelecimento();

        $estabelecimento->id_usuario = FacadesAuth::user()->id;
        $estabelecimento->nome = $form->nome;
        $estabelecimento->tipo = $form->tipo;
        $estabelecimento->descricao = $form->descricao;
        $estabelecimento->endereco = $form->endereco;
        $estabelecimento->telefone = $form->telefone;
        $estabelecimento->whatsapp = $form->whatsapp;
        $estabelecimento->site = $form->site;
        $estabelecimento->facebook = $form->facebook;
        $estabelecimento->instagram = $form->instagram;
        $estabelecimento->linkedin = $form->linkedin;
        $estabelecimento->messenger = $form->messenger;
        $estabelecimento->twitter = $form->twitter;
        $estabelecimento->youtube = $form->youtube;
        $estabelecimento->logo = $imgPath;
        $estabelecimento->cor_tema = $form->cor_tema;

        $estabelecimento->save();

        return true;
    }

    public function show(Estabelecimento $estabelecimento)
    {
        $cardapios = Cardapio::orderBy('id', 'asc')->where('id_estabelecimento', $estabelecimento->id)->get();
        foreach ($cardapios as $cardapio) {
            $cardapio->produtos = Produto::orderBy('id', 'asc')->where('id_cardapio', $cardapio->id)->get();
        }
        return view('estabelecimentos.show', ['estabelecimento' => $estabelecimento, 'cardapios' => $cardapios]);
    }

    public function search() {

        if (isset($_GET['campo'])) {
            $campo = $_GET['campo'];
        }
        else {
            $campo = 'nome';
        }
        if (isset($_GET['ordem'])) {
            $ordem = $_GET['ordem'];
        }
        else {
            $ordem = 'asc';
        }
        $value = '';
        if (isset($_GET) && isset($_GET['val'])) {
            $value = trim($_GET['val']);
            if ($campo == 'data') {
                $campo = 'id';
            }
            else if ($campo == 'tipo') {
                $campo = 'tipo';
            }
            else {
                $campo = 'nome';
            }
            if ($ordem != 'desc') {
                $ordem = 'asc';
            }
            $estabelecimentos = Estabelecimento::orderBy($campo, $ordem)->take(50)
                ->where('nome', 'like', '%'.$value.'%')->orWhere('tipo', 'like', '%'.$value.'%')
                ->orWhere('descricao', 'like', '%'.$value.'%')->get();
        }
        else {
            $estabelecimentos = false;
        }
        
        return view('estabelecimentos.search', ['estabelecimentos' => $estabelecimentos, 'val' => $value, 'campo' => $campo, 'ordem' => $ordem]);
    }
}