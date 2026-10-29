<?php
class RegistroNota {
    public function __construct(public string $aluno, public float $nota) {}
    public function getSituacao(): string { return $this->nota >= 6 ? 'Aprovado' : 'Reprovado'; }
}
session_start();
if (!isset($_SESSION['registros'])) $_SESSION['registros'] = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    if ($acao === 'add') {
        $aluno = trim($_POST['aluno'] ?? '');
        $nota = filter_var($_POST['nota'] ?? '', FILTER_VALIDATE_FLOAT);
        if ($aluno !== '' && $nota !== false && $nota >= 0 && $nota <= 10) {
            $_SESSION['registros'][] = new RegistroNota($aluno, $nota);
        }
    } elseif ($acao === 'remover') {
        $i = (int) ($_POST['indice'] ?? -1);
        if (isset($_SESSION['registros'][$i])) {
            unset($_SESSION['registros'][$i]);
            $_SESSION['registros'] = array_values($_SESSION['registros']);
        }
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><title>Controle de Notas</title><style>body{font-family:sans-serif;max-width:560px;margin:30px auto}label{display:block;margin-top:10px}input,select,textarea{width:100%;padding:6px;box-sizing:border-box}button{margin-top:12px;padding:8px 14px}.res{margin-top:16px;padding:10px;background:#e8f0fe}.err{background:#fde8e8}table{border-collapse:collapse;width:100%;margin-top:12px}td,th{border:1px solid #999;padding:6px;text-align:left}.destaque{background:#fff3b0;font-weight:bold}</style></head>
<body>
<h2>Controle de Notas</h2>
<form method="post">
    <input type="hidden" name="acao" value="add">
    <label>Aluno: <input type="text" name="aluno" required></label>
    <label>Nota (0 a 10): <input type="number" name="nota" step="0.1" min="0" max="10" required></label>
    <button type="submit">Cadastrar</button>
</form>
<?php if ($_SESSION['registros']): ?>
<table>
    <tr><th>Aluno</th><th>Nota</th><th>Situação</th><th>Ação</th></tr>
    <?php foreach ($_SESSION['registros'] as $i => $r): ?>
    <tr>
        <td><?= htmlspecialchars($r->aluno) ?></td>
        <td><?= number_format($r->nota, 1, ',', '.') ?></td>
        <td><?= $r->getSituacao() ?></td>
        <td>
            <form method="post" style="margin:0">
                <input type="hidden" name="acao" value="remover">
                <input type="hidden" name="indice" value="<?= $i ?>">
                <button type="submit" style="margin:0">Remover</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>Nenhum registro cadastrado.</p>
<?php endif; ?>
</body></html>
