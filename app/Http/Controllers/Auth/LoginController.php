<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function username()
    {
        return 'cpf';
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Certifique-se de que o formulário de login está correto
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'cpf' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['cpf' => $credentials['cpf'], 'password' => $credentials['password'], 'is_active' => true])) {
            // Login bem-sucedido
            return redirect()->intended('/home'); // ou qualquer página pós-login
        }

        // Caso falhe, redirecione de volta ao formulário de login com erro
        return back()->withErrors([
            'cpf' => 'As credenciais fornecidas estão incorretas ou a conta não está ativada.',
        ]);
    }
    
}
