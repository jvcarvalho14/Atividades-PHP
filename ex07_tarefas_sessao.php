<?php
class Tarefa {
    public function __construct(public string $descricao, public string $prioridade) {}
}
session_start();
if (!isset($_SESSION['tarefas'])) $_SESSION['tarefas'] = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    if ($acao === 'add') {
        $desc = trim($_POST['descricao'] ?? '');
        $prio = $_POST['prioridade'] ?? 'Média';
        if ($desc !== '' && in_array($prio, ['Alta', 'Média', 'Baixa'], true)) {
            $_SESSION['tarefas'][] = new Tarefa($desc, $prio);
        }
    } elseif ($acao === 'remover') {
        $i = (int) ($_POST['indice'] ?? -1);
        if (isset($_SESSION['tarefas'][$i])) {
            unset($_SESSION['tarefas'][$i]);
            $_SESSION['tarefas'] = array_values($_SESSION['tarefas']);
        }
    } elseif ($acao === 'limpar') {
        $_SESSION['tarefas'] = [];
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><title>Lista de Tarefas</title><style>body{font-family:sans-serif;max-width:560px;margin:30px auto}label{display:block;margin-top:10px}input,select,textarea{width:100%;padding:6px;box-sizing:border-box}button{margin-top:12px;padding:8px 14px}.res{margin-top:16px;padding:10px;background:#e8f0fe}.err{background:#fde8e8}table{border-collapse:collapse;width:100%;margin-top:12px}td,th{border:1px solid #999;padding:6px;text-align:left}.destaque{background:#fff3b0;font-weight:bold}</style></head>
<body>
<h2>Lista de Tarefas</h2>
<form method="post">
    <input type="hidden" name="acao" value="add">
    <label>Descrição: <input type="text" name="descricao" required></label>
    <label>Prioridade:
        <select name="prioridade">
            <option>Alta</option><option selected>Média</option><option>Baixa</option>
        </select>
    </label>
    <button type="submit">Adicionar</button>
</form>
<?php if ($_SESSION['tarefas']): ?>
<table>
    <tr><th>Descrição</th><th>Prioridade</th><th>Ação</th></tr>
    <?php foreach ($_SESSION['tarefas'] as $i => $t): ?>
    <tr>
        <td><?= htmlspecialchars($t->descricao) ?></td>
        <td><?= $t->prioridade ?></td>
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
<form method="post">
    <input type="hidden" name="acao" value="limpar">
    <button type="submit">Limpar lista</button>
</form>
<?php else: ?>
<p>Nenhuma tarefa cadastrada.</p>
<?php endif; ?>
</body></html>
