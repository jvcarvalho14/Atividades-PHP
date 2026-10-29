<?php
class Contato {
    public function __construct(public string $nome, public string $telefone, public string $email) {}
}
session_start();
if (!isset($_SESSION['contatos'])) $_SESSION['contatos'] = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    if ($acao === 'add') {
        $nome = trim($_POST['nome'] ?? '');
        $tel = trim($_POST['telefone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        if ($nome !== '' && $tel !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['contatos'][] = new Contato($nome, $tel, $email);
        }
    } elseif ($acao === 'remover') {
        $i = (int) ($_POST['indice'] ?? -1);
        if (isset($_SESSION['contatos'][$i])) {
            unset($_SESSION['contatos'][$i]);
            $_SESSION['contatos'] = array_values($_SESSION['contatos']);
        }
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
// ordena uma cópia, mantendo os índices originais para a remoção
$ordenados = $_SESSION['contatos'];
uasort($ordenados, fn($a, $b) => strcmp(mb_strtolower($a->nome), mb_strtolower($b->nome)));
?>
<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><title>Agenda de Contatos</title><style>body{font-family:sans-serif;max-width:560px;margin:30px auto}label{display:block;margin-top:10px}input,select,textarea{width:100%;padding:6px;box-sizing:border-box}button{margin-top:12px;padding:8px 14px}.res{margin-top:16px;padding:10px;background:#e8f0fe}.err{background:#fde8e8}table{border-collapse:collapse;width:100%;margin-top:12px}td,th{border:1px solid #999;padding:6px;text-align:left}.destaque{background:#fff3b0;font-weight:bold}</style></head>
<body>
<h2>Agenda de Contatos</h2>
<form method="post">
    <input type="hidden" name="acao" value="add">
    <label>Nome: <input type="text" name="nome" required></label>
    <label>Telefone: <input type="tel" name="telefone" required></label>
    <label>E-mail: <input type="email" name="email" required></label>
    <button type="submit">Cadastrar</button>
</form>
<?php if ($ordenados): ?>
<table>
    <tr><th>Nome</th><th>Telefone</th><th>E-mail</th><th>Ação</th></tr>
    <?php foreach ($ordenados as $i => $c): ?>
    <tr>
        <td><?= htmlspecialchars($c->nome) ?></td>
        <td><?= htmlspecialchars($c->telefone) ?></td>
        <td><?= htmlspecialchars($c->email) ?></td>
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
<p>Nenhum contato cadastrado.</p>
<?php endif; ?>
</body></html>
