<?php
$msgs = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = filter_var($_POST['numero'] ?? '', FILTER_VALIDATE_INT);
    if ($n === false) {
        $msgs[] = 'Informe um número inteiro válido.';
    } elseif ($n > 0) {
        $msgs[] = "$n é positivo.";
        if ($n < 100)      $msgs[] = "$n é menor que 100.";
        elseif ($n === 100) $msgs[] = "$n é igual a 100.";
        else                $msgs[] = "$n é maior que 100.";
    } elseif ($n < 0) {
        $msgs[] = "$n é negativo.";
    } else {
        $msgs[] = 'O número é zero.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><title>Analisador de Número</title><style>body{font-family:sans-serif;max-width:560px;margin:30px auto}label{display:block;margin-top:10px}input,select,textarea{width:100%;padding:6px;box-sizing:border-box}button{margin-top:12px;padding:8px 14px}.res{margin-top:16px;padding:10px;background:#e8f0fe}.err{background:#fde8e8}table{border-collapse:collapse;width:100%;margin-top:12px}td,th{border:1px solid #999;padding:6px;text-align:left}.destaque{background:#fff3b0;font-weight:bold}</style></head>
<body>
<h2>Analisador de Número</h2>
<form method="post">
    <label>Número inteiro: <input type="number" name="numero" required></label>
    <button type="submit">Analisar</button>
</form>
<?php if ($msgs): ?><div class="res"><?php foreach ($msgs as $m): ?><p><?= htmlspecialchars($m) ?></p><?php endforeach; ?></div><?php endif; ?>
</body></html>
