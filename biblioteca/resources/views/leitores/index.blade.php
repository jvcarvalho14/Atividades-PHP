@extends('layouts.app')

@section('title', 'Leitores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Leitores</h1>
    <a href="{{ route('leitores.create') }}" class="btn btn-primary">Novo leitor</a>
</div>

<form method="GET" action="{{ route('leitores.index') }}" class="row g-2 mb-3">
    <div class="col-md-6">
        <input type="text" name="busca" class="form-control"
               placeholder="Buscar por nome" value="{{ $busca }}">
    </div>
    <div class="col-auto">
        <button class="btn btn-secondary">Pesquisar</button>
    </div>
    <div class="col-auto">
        <a href="{{ route('leitores.index') }}" class="btn btn-outline-secondary">Limpar</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
        @forelse($leitores as $leitor)
            <tr>
                <td>{{ $leitor->nome }}</td>
                <td>{{ $leitor->cpf }}</td>
                <td>{{ $leitor->email }}</td>
                <td>{{ $leitor->telefone }}</td>
                <td class="text-end">
                    <a href="{{ route('leitores.edit', $leitor) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form method="POST" action="{{ route('leitores.destroy', $leitor) }}" class="d-inline"
                          onsubmit="return confirm('Excluir este leitor?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Nenhum leitor encontrado.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{ $leitores->links() }}
@endsection