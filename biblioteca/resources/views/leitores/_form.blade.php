@php($leitor = $leitor ?? null)

<div class="mb-3">
    <label class="form-label">Nome completo</label>
    <input type="text" name="nome" class="form-control"
           value="{{ old('nome', $leitor->nome ?? '') }}" required>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">CPF</label>
        <input type="text" name="cpf" class="form-control" maxlength="14"
               placeholder="000.000.000-00"
               value="{{ old('cpf', $leitor->cpf ?? '') }}" required>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" name="email" class="form-control"
               value="{{ old('email', $leitor->email ?? '') }}" required>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control" maxlength="20"
               value="{{ old('telefone', $leitor->telefone ?? '') }}" required>
    </div>
</div>