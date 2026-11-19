<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Leitor;
use App\Models\Livro;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLivros = Livro::count();
        $totalLeitores = Leitor::count();

        $emAndamento = Emprestimo::where('status', Emprestimo::STATUS_EM_ANDAMENTO)
            ->count();

        $atrasados = Emprestimo::whereNull('data_devolucao')
            ->whereDate('data_devolucao_prevista', '<', today())
            ->count();

        return view('dashboard', compact(
            'totalLivros',
            'totalLeitores',
            'emAndamento',
            'atrasados'
        ));
    }
}