<?php
class Aluno {
    public function __construct(private string $nome, private float $nota1, private float $nota2, private float $nota3) {}
    public function getNome(): string { return $this->nome; }
    public function calcularMedia(): float { return ($this->nota1 + $this->nota2 + $this->nota3) / 3; }
    public function getSituacao(): string {
        $m = $this->calcularMedia();
        if ($m >= 6) return 'Aprovado';
        if ($m >= 4) return 'Recuperação';
        return 'Reprovado';
    }
}
$aluno = null; $erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $n = [];
    foreach (['nota1', 'nota2', 'nota3'] as $campo) {
        $n[] = filter_var($_POST[$campo] ?? '', FILTER_VALIDATE_FLOAT);
    }
    if ($nome === '' || in_array(false, $n, true) || min($n) < 0 || max($n) > 10) {
        $erro = 'Dados inválidos. As notas devem estar entre 0 e 10.';
    } else {
        $aluno = new Aluno($nome, $n[0], $n[1], $n[2]);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><title>Média do Aluno</title><style>body{font-family:sans-serif;max-width:560px;margin:30px auto}label{display:block;margin-top:10px}input,select,textarea{width:100%;padding:6px;box-sizing:border-box}button{margin-top:12px;padding:8px 14px}.res{margin-top:16px;padding:10px;background:#e8f0fe}.err{background:#fde8e8}table{border-collapse:collapse;width:100%;margin-top:12px}td,th{border:1px solid #999;padding:6px;text-align:left}.destaque{background:#fff3b0;font-weight:bold}</style></head>
<body>
<h2>Calculadora de Média</h2>
<form method="post">
    <label>Nome: <input type="text" name="nome" required></label>
    <label>Nota 1: <input type="number" name="nota1" step="0.1" min="0" max="10" required></label>
    <label>Nota 2: <input type="number" name="nota2" step="0.1" min="0" max="10" required></label>
    <label>Nota 3: <input type="number" name="nota3" step="0.1" min="0" max="10" required></label>
    <button type="submit">Calcular</button>
</form>
<?php if ($erro): ?><div class="res err"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<?php if ($aluno): ?>
<div class="res">
    <p>Aluno: <strong><?= htmlspecialchars($aluno->getNome()) ?></strong></p>
    <p>Média: <strong><?= number_format($aluno->calcularMedia(), 2, ',', '.') ?></strong></p>
    <p>Situação: <strong><?= $aluno->getSituacao() ?></strong></p>
</div>
<?php endif; ?>
</body></html>
