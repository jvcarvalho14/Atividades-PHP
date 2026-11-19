@extends('layouts.app')

@section('title', 'Livros')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Livros</h1>
    <a href="{{ route('livros.create') }}" class="btn btn-primary">Novo livro</a>
</div>

<form method="GET" action="{{ route('livros.index') }}" class="row g-2 mb-3">
    <div class="col-md-6">
        <input type="text" name="busca" class="form-control"
               placeholder="Buscar por título ou autor" value="{{ $busca }}">
    </div>
    <div class="col-auto">
        <button class="btn btn-secondary">Pesquisar</button>
    </div>
    <div class="col-auto">
        <a href="{{ route('livros.index') }}" class="btn btn-outline-secondary">Limpar</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Editora</th>
                <th>Ano</th>
                <th>ISBN</th>
                <th>Disponíveis</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
        @forelse($livros as $livro)
            <tr>
                <td>{{ $livro->titulo }}</td>
                <td>{{ $livro->autor }}</td>
                <td>{{ $livro->editora }}</td>
                <td>{{ $livro->ano_publicacao }}</td>
                <td>{{ $livro->isbn }}</td>
                <td>
                    <span class="badge {{ $livro->quantidade > 0 ? 'bg-success' : 'bg-secondary' }}">
                        {{ $livro->quantidade }}
                    </span>
                </td>
                <td class="text-end">
                    <a href="{{ route('livros.edit', $livro) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form method="POST" action="{{ route('livros.destroy', $livro) }}" class="d-inline"
                          onsubmit="return confirm('Excluir este livro?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Nenhum livro encontrado.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{ $livros->links() }}
@endsection