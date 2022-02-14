<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;

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
}