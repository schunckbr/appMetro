<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Exibe o formulário de login
    public function showLoginForm()
    {
        return view('auth.login'); // Certifique-se de que existe uma view para o formulário de login
    }

    // Processa o login
    public function login(Request $request)
    {
        // Validação dos dados de login
        $credentials = $request->validate([
            'cpf' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Tentativa de login com CPF e senha
        if (Auth::attempt(['cpf' => $credentials['cpf'], 'password' => $credentials['password'], 'is_active' => true])) {
            // Login bem-sucedido, redireciona para a página principal
            return redirect()->intended('/home');
        }

        // Se falhar, redireciona de volta com erro
        return back()->withErrors([
            'cpf' => 'As credenciais fornecidas estão incorretas ou a conta não está ativada.',
        ]);
    }

    // Faz o logout do usuário
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
