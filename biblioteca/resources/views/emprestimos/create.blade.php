@extends('layouts.app')

@section('title', 'Novo empréstimo')

@section('content')
<h1 class="mb-4">Novo empréstimo</h1>

@if($leitores->isEmpty() || $livros->isEmpty())
    <div class="alert alert-warning">
        Para registrar um empréstimo é necessário ter pelo menos um leitor cadastrado
        e um livro com exemplares disponíveis.
    </div>
@endif

<form method="POST" action="{{ route('emprestimos.store') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Leitor</label>
        <select name="leitor_id" class="form-select" required>
            <option value="">Selecione</option>
            @foreach($leitores as $leitor)
                <option value="{{ $leitor->id }}" @selected(old('leitor_id') == $leitor->id)>
                    {{ $leitor->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Livro</label>
        <select name="livro_id" class="form-select" required>
            <option value="">Selecione</option>
            @foreach($livros as $livro)
                <option value="{{ $livro->id }}" @selected(old('livro_id') == $livro->id)>
                    {{ $livro->titulo }} ({{ $livro->quantidade }} disponível(is))
                </option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Data do empréstimo</label>
            <input type="date" name="data_emprestimo" class="form-control"
                   value="{{ old('data_emprestimo', date('Y-m-d')) }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Data prevista de devolução</label>
            <input type="date" name="data_devolucao_prevista" class="form-control"
                   value="{{ old('data_devolucao_prevista') }}" required>
        </div>
    </div>

    <button class="btn btn-primary">Confirmar empréstimo</button>
    <a href="{{ route('emprestimos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection