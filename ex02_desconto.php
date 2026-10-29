<?php
function reais(float $v): string { return 'R$ ' . number_format($v, 2, ',', '.'); }
$res = null; $erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto = trim($_POST['produto'] ?? '');
    $preco = filter_var($_POST['preco'] ?? '', FILTER_VALIDATE_FLOAT);
    $perc = filter_var($_POST['desconto'] ?? '', FILTER_VALIDATE_FLOAT);
    if ($produto === '' || $preco === false || $perc === false || $preco < 0 || $perc < 0 || $perc > 100) {
        $erro = 'Dados inválidos. O desconto deve estar entre 0 e 100.';
    } else {
        $valorDesconto = $preco * $perc / 100;
        $res = ['produto' => $produto, 'preco' => $preco, 'perc' => $perc,
                'desconto' => $valorDesconto, 'final' => $preco - $valorDesconto];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><title>Desconto</title><style>body{font-family:sans-serif;max-width:560px;margin:30px auto}label{display:block;margin-top:10px}input,select,textarea{width:100%;padding:6px;box-sizing:border-box}button{margin-top:12px;padding:8px 14px}.res{margin-top:16px;padding:10px;background:#e8f0fe}.err{background:#fde8e8}table{border-collapse:collapse;width:100%;margin-top:12px}td,th{border:1px solid #999;padding:6px;text-align:left}.destaque{background:#fff3b0;font-weight:bold}</style></head>
<body>
<h2>Calculadora de Desconto</h2>
<form method="post">
    <label>Produto: <input type="text" name="produto" required></label>
    <label>Preço (R$): <input type="number" name="preco" step="0.01" min="0" required></label>
    <label>Desconto (%): <input type="number" name="desconto" step="0.01" min="0" max="100" required></label>
    <button type="submit">Calcular</button>
</form>
<?php if ($erro): ?><div class="res err"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<?php if ($res): ?>
<div class="res">
    <p>Produto: <strong><?= htmlspecialchars($res['produto']) ?></strong></p>
    <p>Preço original: <?= reais($res['preco']) ?></p>
    <p>Desconto (<?= $res['perc'] ?>%): <?= reais($res['desconto']) ?></p>
    <p>Preço final: <strong><?= reais($res['final']) ?></strong></p>
</div>
<?php endif; ?>
</body></html>
