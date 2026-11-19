@extends('layouts.app')

@section('title', 'Painel')

@section('content')
<h1 class="mb-4">Painel da Biblioteca</h1>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card border-primary h-100">
            <div class="card-body">
                <h6 class="text-muted">Livros cadastrados</h6>
                <h2 class="mb-0">{{ $totalLivros }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-success h-100">
            <div class="card-body">
                <h6 class="text-muted">Leitores cadastrados</h6>
                <h2 class="mb-0">{{ $totalLeitores }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-warning h-100">
            <div class="card-body">
                <h6 class="text-muted">Empréstimos em andamento</h6>
                <h2 class="mb-0">{{ $emAndamento }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-danger h-100">
            <div class="card-body">
                <h6 class="text-muted">Empréstimos atrasados</h6>
                <h2 class="mb-0">{{ $atrasados }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('emprestimos.create') }}" class="btn btn-primary">Novo empréstimo</a>
    <a href="{{ route('emprestimos.index') }}?atrasados=1" class="btn btn-outline-danger">Ver atrasados</a>
</div>
@endsection