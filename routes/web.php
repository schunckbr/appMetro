<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Auth\LoginController;

// Rota inicial (se desejar uma página inicial)
Route::get('/', function () {
    return view('welcome'); // Ponto de entrada da aplicação, pode ser alterado para outra página
});

// Rotas de cadastro de cliente
Route::get('/register', [ClientController::class, 'create'])->name('client.create'); // Exibe o formulário de cadastro
Route::post('/register', [ClientController::class, 'store'])->name('client.store'); // Processa o cadastro e envia o e-mail de ativação

// Rota de ativação de conta por e-mail
Route::get('/activate/{token}', [ClientController::class, 'activate'])->name('client.activate'); // Ativa a conta usando o token enviado por e-mail

// Rotas de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // Exibe o formulário de login
Route::post('/login', [LoginController::class, 'login']); // Processa o login usando CPF e senha

// Rota para logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rota para a página após login (exemplo de rota protegida por autenticação)
Route::get('/home', function () {
    return view('home'); // Página que o usuário verá após login (ajuste conforme necessário)
})->middleware('auth')->name('home');
