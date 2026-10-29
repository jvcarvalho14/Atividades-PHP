<?php
function reais(float $v): string { return 'R$ ' . number_format($v, 2, ',', '.'); }
class Compra {
    public function __construct(private string $produto, private float $valor, private int $quantidade) {}
    public function getProduto(): string { return $this->produto; }
    public function getQuantidade(): int { return $this->quantidade; }
    public function calcularTotal(): float { return $this->valor * $this->quantidade; }
    public function calcularParcela(int $parcelas): float { return $this->calcularTotal() / $parcelas; }
}
$compra = null; $parcelas = 1; $erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto = trim($_POST['produto'] ?? '');
    $valor = filter_var($_POST['valor'] ?? '', FILTER_VALIDATE_FLOAT);
    $qtd = filter_var($_POST['quantidade'] ?? '', FILTER_VALIDATE_INT);
    $parcelas = (int) ($_POST['parcelas'] ?? 0);
    if ($produto === '' || $valor === false || $valor <= 0 || $qtd === false || $qtd < 1 || !in_array($parcelas, [1, 2, 3, 6, 12], true)) {
        $erro = 'Dados inválidos.';
    } else {
        $compra = new Compra($produto, $valor, $qtd);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><title>Compra Parcelada</title><style>body{font-family:sans-serif;max-width:560px;margin:30px auto}label{display:block;margin-top:10px}input,select,textarea{width:100%;padding:6px;box-sizing:border-box}button{margin-top:12px;padding:8px 14px}.res{margin-top:16px;padding:10px;background:#e8f0fe}.err{background:#fde8e8}table{border-collapse:collapse;width:100%;margin-top:12px}td,th{border:1px solid #999;padding:6px;text-align:left}.destaque{background:#fff3b0;font-weight:bold}</style></head>
<body>
<h2>Simulador de Compra Parcelada</h2>
<form method="post">
    <label>Produto: <input type="text" name="produto" required></label>
    <label>Valor unitário (R$): <input type="number" name="valor" step="0.01" min="0.01" required></label>
    <label>Quantidade: <input type="number" name="quantidade" min="1" value="1" required></label>
    <label>Parcelas:
        <select name="parcelas">
            <?php foreach ([1, 2, 3, 6, 12] as $p): ?>
            <option value="<?= $p ?>"><?= $p ?>x</option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit">Simular</button>
</form>
<?php if ($erro): ?><div class="res err"><?= htmlspecialchars($erro) ?></div><?php endif; ?>
<?php if ($compra): ?>
<div class="res">
    <p>Produto: <strong><?= htmlspecialchars($compra->getProduto()) ?></strong> (<?= $compra->getQuantidade() ?> un.)</p>
    <p>Total da compra: <strong><?= reais($compra->calcularTotal()) ?></strong></p>
    <p><?= $parcelas ?>x de <strong><?= reais($compra->calcularParcela($parcelas)) ?></strong></p>
</div>
<?php endif; ?>
</body></html>
