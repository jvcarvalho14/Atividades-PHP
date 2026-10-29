<?php
class ConversorTempo {
    public function __construct(private float $valor) {}
    public function converterParaMinutos(): float { return $this->valor * 60; }
    public function converterParaSegundos(): float { return $this->valor * 3600; }
}
$res = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $horas = filter_var($_POST['horas'] ?? '', FILTER_VALIDATE_FLOAT);
    $conv = $_POST['conversao'] ?? '';
    if ($horas === false || $horas < 0) {
        $res = 'Informe uma quantidade de horas válida.';
    } else {
        $c = new ConversorTempo($horas);
        if ($conv === 'minutos') {
            $res = number_format($horas, 2, ',', '.') . ' hora(s) = ' . number_format($c->converterParaMinutos(), 2, ',', '.') . ' minutos';
        } elseif ($conv === 'segundos') {
            $res = number_format($horas, 2, ',', '.') . ' hora(s) = ' . number_format($c->converterParaSegundos(), 2, ',', '.') . ' segundos';
        } else {
            $res = 'Escolha uma conversão válida.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><title>Conversor de Horas</title><style>body{font-family:sans-serif;max-width:560px;margin:30px auto}label{display:block;margin-top:10px}input,select,textarea{width:100%;padding:6px;box-sizing:border-box}button{margin-top:12px;padding:8px 14px}.res{margin-top:16px;padding:10px;background:#e8f0fe}.err{background:#fde8e8}table{border-collapse:collapse;width:100%;margin-top:12px}td,th{border:1px solid #999;padding:6px;text-align:left}.destaque{background:#fff3b0;font-weight:bold}</style></head>
<body>
<h2>Conversor de Horas</h2>
<form method="post">
    <label>Horas: <input type="number" name="horas" step="any" min="0" required></label>
    <label>Converter para:
        <select name="conversao">
            <option value="minutos">Minutos</option>
            <option value="segundos">Segundos</option>
        </select>
    </label>
    <button type="submit">Converter</button>
</form>
<?php if ($res): ?><div class="res"><?= htmlspecialchars($res) ?></div><?php endif; ?>
</body></html>
