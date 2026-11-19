<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LeitorController;
use App\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('livros', LivroController::class)->except(['show']);
Route::resource('leitores', LeitorController::class)->except(['show']);

Route::get('/emprestimos', [EmprestimoController::class, 'index'])
    ->name('emprestimos.index');
Route::get('/emprestimos/criar', [EmprestimoController::class, 'create'])
    ->name('emprestimos.create');
Route::post('/emprestimos', [EmprestimoController::class, 'store'])
    ->name('emprestimos.store');
Route::patch('/emprestimos/{emprestimo}/devolver', [EmprestimoController::class, 'devolver'])
    ->name('emprestimos.devolver');