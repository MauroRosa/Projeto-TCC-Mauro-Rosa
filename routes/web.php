<?php

use App\Http\Controllers\AutenticacaoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AlunoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AutenticacaoController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AutenticacaoController::class, 'entrar'])->name('entrar');

Route::get('/cadastro', [AutenticacaoController::class, 'mostrarCadastro'])->name('cadastro');
Route::post('/cadastro', [AutenticacaoController::class, 'cadastrar'])->name('cadastrar');

Route::post('/sair', [AutenticacaoController::class, 'sair'])->name('sair');

Route::middleware(['auth', 'perfil:professor'])->prefix('professor')->group(function () {
    Route::get('/painel', [ProfessorController::class, 'painel'])->name('professor.painel');
});

Route::middleware(['auth', 'perfil:aluno'])->prefix('aluno')->group(function () {
    Route::get('/painel', [AlunoController::class, 'painel'])->name('aluno.painel');
});