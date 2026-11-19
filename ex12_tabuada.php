<?php
class Tabuada {
    public function __construct(private int $numero) {}
    public function getNumero(): int { return $this->numero; }
    public function gerar(): array {
        $resultados = [];
        for ($i = 1; $i <= 10; $i++) {
            $resultados[$i] = $this->numero * $i;
        }
        return $resultados;
    }
}
$tabuada = null; $erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = filter_var($_POST['numero'] ?? '', FILTER_VALIDATE_INT);
    if ($n === false) {
        $erro = 'Informe um número inteiro válido.';
    } else {
        $tabuada = new Tabuada($n);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><title>Tabuada</title><style>body{font-family:sans-serif;max-width:560px;margin:30px auto}label{display:block;margin-top:10px}input,select,textarea{width:100%;padding:6px;box-sizing:border-box}button{margin-top:12px;padding:8px 14px}.res{margin-top:16px;padding:10px;background:#e8f0fe}.err{background:#fde8e8}table{border-collapse:collapse;width:100%;margin-top:12px}td,th{border:1px solid #999;padding:6px;text-align:left}.destaque{background:#fff3b0;font-weight:bold}</style></head>
<body>
<h2>Gerador de Tabuada</h2>
<form method="post">
    <label>Número: <input type="number" name="numero" required></label>
    <button type="submit">Gerar</button>
</form>
<?php if ($erro): ?><div class="res err"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<?php if ($tabuada): ?>
<table>
    <tr><th>Multiplicação</th><th>Resultado</th></tr>
    <?php foreach ($tabuada->gerar() as $i => $r): ?>
    <tr>
        <td><?= $tabuada->getNumero() ?> x <?= $i ?></td>
        <td class="destaque"><?= $r ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
</body></html>
