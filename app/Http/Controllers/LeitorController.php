<?php

namespace App\Http\Controllers;

use App\Models\Leitor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeitorController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $leitores = Leitor::when($busca, function ($query, $busca) {
                $query->where('nome', 'like', "%{$busca}%");
            })
            ->orderBy('nome')
            ->paginate(10)
            ->withQueryString();

        return view('leitores.index', compact('leitores', 'busca'));
    }

    public function create()
    {
        return view('leitores.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate($this->regras(), $this->mensagens());

        Leitor::create($dados);

        return redirect()
            ->route('leitores.index')
            ->with('sucesso', 'Leitor cadastrado com sucesso!');
    }

    public function edit(Leitor $leitor)
    {
        return view('leitores.edit', compact('leitor'));
    }

    public function update(Request $request, Leitor $leitor)
    {
        $dados = $request->validate(
            $this->regras($leitor->id),
            $this->mensagens()
        );

        $leitor->update($dados);

        return redirect()
            ->route('leitores.index')
            ->with('sucesso', 'Leitor atualizado com sucesso!');
    }

    public function destroy(Leitor $leitor)
    {
        try {
            $leitor->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('leitores.index')
                ->with('erro', 'Não é possível excluir este leitor porque existem empréstimos vinculados a ele.');
        }

        return redirect()
            ->route('leitores.index')
            ->with('sucesso', 'Leitor excluído com sucesso!');
    }

    private function regras(?int $id = null): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'cpf' => [
                'required',
                'string',
                'max:14',
                Rule::unique('leitores', 'cpf')->ignore($id),
            ],
            'email' => ['required', 'email', 'max:255'],
            'telefone' => ['required', 'string', 'max:20'],
        ];
    }

    private function mensagens(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'telefone.required' => 'O telefone é obrigatório.',
        ];
    }
}