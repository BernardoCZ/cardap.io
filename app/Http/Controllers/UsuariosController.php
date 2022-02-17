<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\Estabelecimento;
use App\Models\Nota;
use App\Models\Produto;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UsuariosController extends Controller
{

    public function create()
    {
        return view('usuarios.create');
    }

    public function insert(Request $form)
    {
        $form->validate([
            'username' => ['required', 'min:3', 'max:20'],
            'type' => ['required', 'in:cliente,empresa'],
            'email' => ['required', 'email', 'max:100', 'unique:usuarios'],
            'password' => ['required','confirmed', 'min:8', 'max:20'],
            'password_confirmation' => ['required']
        ]);
        $usuario = new Usuario();

        $usuario->username = $form->username;
        $usuario->type = $form->type;
        $usuario->email = $form->email;
        $usuario->password = Hash::make($form->password);

        $usuario->save();

        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect('/');
    }

    // Ações de login
    public function login(Request $form)
    {
        // Está enviando o formulário
        if ($form->isMethod('POST'))
        {
            $credenciais = $form->validate([
                'email' => ['required'],
                'password' => ['required', 'min:8', 'max:20'],
            ]);

            $lembrado = false;
            
            if ($form->lembrar == "on")
            {
                $lembrado = true;
            }
               
            // Tenta o login
            if (Auth::attempt($credenciais, $lembrado)) {
                session()->regenerate();
                return redirect('/');
            }
            else {
                // Login deu errado (usuário ou senha inválidos)
                return redirect()->route('login')->with('erro', 'Usuário ou senha inválidos.');
            }
        }

        return view('usuarios.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function profile()
    {
        $avaliacoes = Nota::where('id_usuario', Auth::user()->id)->get();
        $avaliacoes_count = count($avaliacoes);
        $estabelecimentos = Estabelecimento::where('id_usuario', Auth::user()->id)->get();
        $estabelecimentos_count = count($estabelecimentos);
        $cardapios_count = 0;
        $produtos_count = 0;
        foreach ($estabelecimentos as $estabelecimento) {
            $cardapios = Cardapio::where('id_estabelecimento', $estabelecimento->id)->get();
            $cardapios_count += count($cardapios);
            foreach ($cardapios as $cardapio) {
                $produtos = Produto::where('id_cardapio', $cardapio->id)->get();
                $produtos_count += count($produtos);
            }
        }
        return view('usuarios.profile', ['avaliacoes_count' => $avaliacoes_count, 'estabelecimentos_count' => $estabelecimentos_count, 'cardapios_count' => $cardapios_count, 'produtos_count' => $produtos_count]);
    }

    public function edit()
    {
        return view('usuarios.edit', ['usuario' => Auth::user()]);
    }
    public function update(Request $form)
    {
        $form->validate([
            'username' => ['required', 'min:3', 'max:20'],
            'email' => ['required', 'email', 'max:100', Rule::unique('usuarios')->ignore(Auth::user()->id)]
        ]);
        $usuario = Auth::user();
        $usuario->username = $form->username;
        $usuario->email = $form->email;

        $usuario->save();

        return true;
    }

    public function alterar_senha()
    {
        return view('usuarios.editSenha', ['usuario' => Auth::user()]);
    }
    public function update_senha(Request $form)
    {
        
        try {
            if (!Hash::check($form->old_password, Auth::user()->password)) {
                throw new Exception();
            }
        }
        catch (Exception $exception) {
            return response()->json([
                'status' => 422,
                'errors' => ['old_password' => ['Senha atual incorreta.']]
            ], 422);
        }
        
        $form->validate([
            'password' => ['required', 'confirmed', 'min:8', 'max:20'],
            'password_confirmation' => ['required']
        ]);

        $usuario = Auth::user();

        $usuario->password = Hash::make($form->password);
        $usuario->save();

        return true;
    }

    public function editImagem()
    {
        return view('usuarios.editImagem', ['usuario' => Auth::user()]);
    }

    public function updateImagem(Request $form)
    {

        $form->validate([
            'profile_image' => ['nullable','image']
        ]);
        
        $usuario = Auth::user();

        if ($usuario->profile_image) {
            $image_path = public_path().'/img/'.$usuario->profile_image;
            unlink($image_path);
        }
        $imgPath = null;
        if($form->file('profile_image')){
            $imgPath = $form->file('profile_image')->store('', 'imagens');
        }

        $usuario->profile_image = $imgPath;

        $usuario->save();

        return true;
    }
}