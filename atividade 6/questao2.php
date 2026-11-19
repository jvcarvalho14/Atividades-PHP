<?php
class ContaBancaria
{
    private int $numero;
    private string $titular;
    private float $saldo;
    private string $tipo;

    public function __construct(int $numero, string $titular, float $saldo, string $tipo)
    {
        $this->numero = $numero;
        $this->titular = $titular;
        $this->saldo = $saldo;
        $this->tipo = $tipo;
    }

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception("Valor de depósito deve ser maior que zero.");
        }
        $this->saldo += $valor;
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception("Valor de saque deve ser maior que zero.");
        }
        if ($valor > $this->saldo) {
            throw new Exception("Saldo insuficiente. Saldo disponível: R$ " . number_format($this->saldo, 2, ',', '.'));
        }
        $this->saldo -= $valor;
    }

    public function consultarSaldo(): float
    {
        return $this->saldo;
    }

    public function exibirDados(): void
    {
        echo "<p><b>Conta:</b> {$this->numero} ({$this->tipo})<br>";
        echo "<b>Titular:</b> {$this->titular}<br>";
        echo "<b>Saldo:</b> R$ " . number_format($this->saldo, 2, ',', '.') . "</p>";
    }
}

// a classe precisa estar definida antes do session_start para a sessão guardar os objetos
session_start();

if (isset($_GET['reset'])) {
    session_destroy();
    header('Location: index.html');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

if (!isset($_SESSION['contas'])) {
    $_SESSION['contas'] = [
        1001 => new ContaBancaria(1001, "João Silva", 500, "Corrente"),
        1002 => new ContaBancaria(1002, "Maria Souza", 1500, "Poupança"),
    ];
}

$contas = $_SESSION['contas'];
$conta = $contas[(int) $_POST['conta']];
$valor = (float) $_POST['valor'];
$mensagem = "";
$erro = false;

try {
    switch ($_POST['operacao']) {
        case 'depositar':
            $conta->depositar($valor);
            $mensagem = "Depósito de R$ " . number_format($valor, 2, ',', '.') . " realizado.";
            break;
        case 'sacar':
            $conta->sacar($valor);
            $mensagem = "Saque de R$ " . number_format($valor, 2, ',', '.') . " realizado.";
            break;
        default:
            $mensagem = "Saldo atual: R$ " . number_format($conta->consultarSaldo(), 2, ',', '.');
    }
} catch (Exception $e) {
    $erro = true;
    $mensagem = $e->getMessage();
}
?>
<!DOCTYPE html><html lang="pt-BR"><head><meta charset="UTF-8"><title>Resultado</title></head><body style="font-family:Arial,sans-serif;max-width:640px;margin:30px auto">
<h2>Questão 2 — Conta bancária</h2>
<p style="color:<?= $erro ? 'red' : 'green' ?>"><b><?= htmlspecialchars($mensagem) ?></b></p>
<?php foreach ($contas as $c) { $c->exibirDados(); } ?>
<p><a href="questao2.php?reset=1">Resetar contas</a></p>
<p><a href="index.html">&larr; Voltar</a></p></body></html>
