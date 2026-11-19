@extends('layouts.app')

@section('title', 'Empréstimos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Empréstimos</h1>
    <a href="{{ route('emprestimos.create') }}" class="btn btn-primary">Novo empréstimo</a>
</div>

<form method="GET" action="{{ route('emprestimos.index') }}" class="row g-2 mb-3 align-items-end">
    <div class="col-md-3">
        <label class="form-label">Situação</label>
        <select name="status" class="form-select">
            <option value="">Todas</option>
            <option value="Em andamento" @selected(request('status') === 'Em andamento')>Em andamento</option>
            <option value="Devolvido" @selected(request('status') === 'Devolvido')>Devolvido</option>
        </select>
    </div>

    <div class="col-md-3">
        <div class="form-check mb-2">
            <input type="checkbox" name="atrasados" value="1" class="form-check-input"
                   id="atrasados" @checked(request()->boolean('atrasados'))>
            <label class="form-check-label" for="atrasados">Somente atrasados</label>
        </div>
    </div>

    <div class="col-auto">
        <button class="btn btn-secondary">Filtrar</button>
    </div>

    <div class="col-auto">
        <a href="{{ route('emprestimos.index') }}" class="btn btn-outline-secondary">Limpar</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Leitor</th>
                <th>Livro</th>
                <th>Empréstimo</th>
                <th>Prevista</th>
                <th>Devolução</th>
                <th>Situação</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
        @forelse($emprestimos as $emprestimo)
            <tr>
                <td>{{ $emprestimo->leitor->nome }}</td>
                <td>{{ $emprestimo->livro->titulo }}</td>
                <td>{{ $emprestimo->data_emprestimo->format('d/m/Y') }}</td>
                <td>{{ $emprestimo->data_devolucao_prevista->format('d/m/Y') }}</td>
                <td>
                    {{ $emprestimo->data_devolucao
                        ? $emprestimo->data_devolucao->format('d/m/Y')
                        : 'Pendente' }}
                </td>
                <td>
                    @if($emprestimo->estaDevolvido())
                        <span class="badge bg-success">Devolvido</span>
                    @elseif($emprestimo->estaAtrasado())
                        <span class="badge bg-danger">Atrasado</span>
                    @else
                        <span class="badge bg-primary">Em andamento</span>
                    @endif
                </td>
                <td class="text-end">
                    @unless($emprestimo->estaDevolvido())
                        <form method="POST"
                              action="{{ route('emprestimos.devolver', $emprestimo) }}"
                              class="d-inline"
                              onsubmit="return confirm('Registrar a devolução deste livro?')">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-success">Registrar Devolução</button>
                        </form>
                    @endunless
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Nenhum empréstimo encontrado.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{ $emprestimos->links() }}
@endsection