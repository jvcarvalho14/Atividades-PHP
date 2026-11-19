@php($livro = $livro ?? null)

<div class="mb-3">
    <label class="form-label">Título</label>
    <input type="text" name="titulo" class="form-control"
           value="{{ old('titulo', $livro->titulo ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Autor</label>
    <input type="text" name="autor" class="form-control"
           value="{{ old('autor', $livro->autor ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Editora</label>
    <input type="text" name="editora" class="form-control"
           value="{{ old('editora', $livro->editora ?? '') }}" required>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Ano de publicação</label>
        <input type="number" name="ano_publicacao" class="form-control"
               value="{{ old('ano_publicacao', $livro->ano_publicacao ?? '') }}" required>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">ISBN</label>
        <input type="text" name="isbn" class="form-control" maxlength="30"
               value="{{ old('isbn', $livro->isbn ?? '') }}" required>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Quantidade disponível</label>
        <input type="number" name="quantidade" class="form-control" min="0"
               value="{{ old('quantidade', $livro->quantidade ?? 0) }}" required>
    </div>
</div>