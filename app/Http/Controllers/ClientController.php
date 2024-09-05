<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Mail\ClientActivationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    // Método para exibir o formulário de cadastro
    public function create()
    {
        return view('client.create'); // Renderiza o arquivo Blade do formulário de cadastro
    }

    // Método para processar o cadastro do cliente
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => ['required', 'string', 'unique:clients'],
            'email' => 'required|email|unique:clients',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Criptografar a senha
        $validatedData['password'] = Hash::make($request->input('password'));

        // Gerar token de ativação
        $validatedData['activation_token'] = bin2hex(random_bytes(32));  // Gerar um token único
        $validatedData['is_active'] = false; // Define a conta como inativa até ativação

        // Criar cliente no banco de dados
        $client = Client::create($validatedData);

        // Verificar se o token foi gerado e salvo corretamente
        //dd($client->activation_token);  // Exibe o token para garantir que foi gerado

        // Enviar e-mail de ativação
        Mail::to($client->email)->send(new ClientActivationMail($client));

        return redirect()->back()->with('success', 'Cadastro realizado com sucesso! Verifique seu e-mail para ativar sua conta.');
    }


    // Método para ativar a conta do cliente
    public function activate($token)
    {
        $client = Client::where('activation_token', $token)->first();

        if (!$client) {
            return redirect()->route('client.create')->with('error', 'Token de ativação inválido.');
        }

        $client->is_active = true;
        $client->activation_token = null;
        $client->save();

        return redirect()->route('client.create')->with('success', 'Conta ativada com sucesso! Faça o login.');
    }
}
