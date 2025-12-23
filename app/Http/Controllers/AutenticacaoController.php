<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AutenticacaoController extends Controller
{
    // Exibir tela de login
    public function mostrarLogin()
    {
        return view('autenticacao.login');
    }

    // Processar login
    public function entrar(Request $request)
    {
        $credenciais = $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        // Renomeia 'senha' para 'password' para o Laravel autenticar
        $credenciais['password'] = $credenciais['senha'];
        unset($credenciais['senha']);

        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();
            
            // Redireciona conforme o perfil
            if (Auth::user()->ehProfessor()) {
                return redirect()->route('professor.painel');
            }
            
            return redirect()->route('aluno.painel');
        }

        return back()->withErrors([
            'email' => 'Credenciais incorretas.',
        ])->onlyInput('email');
    }

    // Exibir tela de cadastro (apenas alunos)
    public function mostrarCadastro()
    {
        return view('autenticacao.cadastro');
    }

    // Processar cadastro
    public function cadastrar(Request $request)
    {
        $validado = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'senha' => 'required|string|min:8|confirmed',
        ]);

        $usuario = User::create([
            'name' => $validado['nome'],
            'email' => $validado['email'],
            'password' => Hash::make($validado['senha']), // Bcrypt
            'perfil' => 'aluno', // Sempre aluno no cadastro
        ]);

        Auth::login($usuario);

        return redirect()->route('aluno.painel');
    }

    // Logout
    public function sair(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}