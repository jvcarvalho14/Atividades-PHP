<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');

        $livros = Livro::when($busca, function ($query, $busca) {
                $query->where('titulo', 'like', "%{$busca}%")
                    ->orWhere('autor', 'like', "%{$busca}%");
            })
            ->orderBy('titulo')
            ->paginate(10)
            ->withQueryString();

        return view('livros.index', compact('livros', 'busca'));
    }

    public function create()
    {
        return view('livros.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate($this->regras(), $this->mensagens());

        Livro::create($dados);

        return redirect()
            ->route('livros.index')
            ->with('sucesso', 'Livro cadastrado com sucesso!');
    }

    public function edit(Livro $livro)
    {
        return view('livros.edit', compact('livro'));
    }

    public function update(Request $request, Livro $livro)
    {
        $dados = $request->validate(
            $this->regras($livro->id),
            $this->mensagens()
        );

        $livro->update($dados);

        return redirect()
            ->route('livros.index')
            ->with('sucesso', 'Livro atualizado com sucesso!');
    }

    public function destroy(Livro $livro)
    {
        try {
            $livro->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('livros.index')
                ->with('erro', 'Não é possível excluir este livro porque existem empréstimos vinculados a ele.');
        }

        return redirect()
            ->route('livros.index')
            ->with('sucesso', 'Livro excluído com sucesso!');
    }

    private function regras(?int $id = null): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'autor' => ['required', 'string', 'max:255'],
            'editora' => ['required', 'string', 'max:255'],
            'ano_publicacao' => ['required', 'integer', 'min:1000', 'max:' . date('Y')],
            'isbn' => [
                'required',
                'string',
                'max:30',
                Rule::unique('livros', 'isbn')->ignore($id),
            ],
            'quantidade' => ['required', 'integer', 'min:0'],
        ];
    }

    private function mensagens(): array
    {
        return [
            'titulo.required' => 'O título é obrigatório.',
            'autor.required' => 'O autor é obrigatório.',
            'editora.required' => 'A editora é obrigatória.',
            'ano_publicacao.required' => 'O ano de publicação é obrigatório.',
            'ano_publicacao.integer' => 'O ano de publicação deve ser um número.',
            'ano_publicacao.min' => 'Informe um ano de publicação válido.',
            'ano_publicacao.max' => 'O ano de publicação não pode ser maior que o ano atual.',
            'isbn.required' => 'O ISBN é obrigatório.',
            'isbn.unique' => 'Este ISBN já está cadastrado.',
            'quantidade.required' => 'A quantidade é obrigatória.',
            'quantidade.min' => 'A quantidade não pode ser negativa.',
        ];
    }
}