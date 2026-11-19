<?php
$res = ''; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $km = filter_var($_POST['km'] ?? '', FILTER_VALIDATE_FLOAT);
    $conv = $_POST['conversao'] ?? '';
    if ($km === false || $km < 0) {
        $res = 'Informe uma distância válida.';
    } else {
        switch ($conv) {
            case 'm':      $res = $km . ' km = ' . number_format($km * 1000, 2, ',', '.') . ' metros'; break;
            case 'cm':     $res = $km . ' km = ' . number_format($km * 100000, 2, ',', '.') . ' centímetros'; break;
            case 'milhas': $res = $km . ' km = ' . number_format($km * 0.621371, 4, ',', '.') . ' milhas'; break;
            default:       $res = 'Escolha uma conversão válida.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><title>Conversor de Distância</title><style>body{font-family:sans-serif;max-width:560px;margin:30px auto}label{display:block;margin-top:10px}input,select,textarea{width:100%;padding:6px;box-sizing:border-box}button{margin-top:12px;padding:8px 14px}.res{margin-top:16px;padding:10px;background:#e8f0fe}.err{background:#fde8e8}table{border-collapse:collapse;width:100%;margin-top:12px}td,th{border:1px solid #999;padding:6px;text-align:left}.destaque{background:#fff3b0;font-weight:bold}</style></head>
<body>
<h2>Conversor de Distância</h2>
<form method="post">
    <label>Distância (km): <input type="number" name="km" step="any" min="0" required></label>
    <label>Converter para:
        <select name="conversao">
            <option value="m">Metros</option>
            <option value="cm">Centímetros</option>
            <option value="milhas">Milhas</option>
        </select>
    </label>
    <button type="submit">Converter</button>
</form>
<?php if ($res): ?><div class="res"><?= htmlspecialchars($res) ?></div><?php endif; ?>
</body></html>
