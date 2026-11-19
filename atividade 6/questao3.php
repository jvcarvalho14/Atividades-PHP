<?php
class Funcionario
{
    protected string $nome;
    protected string $matricula;
    protected float $salarioBase;
    protected string $cargo;

    public function __construct(string $nome, string $matricula, float $salarioBase, string $cargo)
    {
        $this->nome = $nome;
        $this->matricula = $matricula;
        $this->salarioBase = $salarioBase;
        $this->cargo = $cargo;
    }

    public function calcularSalarioFinal(): float
    {
        return $this->salarioBase;
    }

    public function exibir(): void
    {
        echo "<p><b>Nome:</b> " . htmlspecialchars($this->nome) . "<br>";
        echo "<b>Matrícula:</b> " . htmlspecialchars($this->matricula) . "<br>";
        echo "<b>Cargo:</b> " . htmlspecialchars($this->cargo) . "<br>";
        echo "<b>Salário-base:</b> R$ " . number_format($this->salarioBase, 2, ',', '.') . "<br>";
        echo "<b>Salário final:</b> R$ " . number_format($this->calcularSalarioFinal(), 2, ',', '.') . "</p>";
    }
}

class Vendedor extends Funcionario
{
    private float $percentualComissao;
    private float $totalVendas;

    public function __construct(string $nome, string $matricula, float $salarioBase, float $percentualComissao, float $totalVendas)
    {
        parent::__construct($nome, $matricula, $salarioBase, "Vendedor");
        $this->percentualComissao = $percentualComissao;
        $this->totalVendas = $totalVendas;
    }

    // salário final = salário-base + (vendas * comissão / 100)
    public function calcularSalarioFinal(): float
    {
        return $this->salarioBase + ($this->totalVendas * $this->percentualComissao / 100);
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

$nome = trim($_POST['nome']);
$matricula = trim($_POST['matricula']);
$salario = (float) $_POST['salario'];

if ($_POST['tipo'] === 'vendedor') {
    $f = new Vendedor($nome, $matricula, $salario, (float) $_POST['comissao'], (float) $_POST['vendas']);
} else {
    $f = new Funcionario($nome, $matricula, $salario, trim($_POST['cargo']));
}
?>
<!DOCTYPE html><html lang="pt-BR"><head><meta charset="UTF-8"><title>Resultado</title></head><body style="font-family:Arial,sans-serif;max-width:640px;margin:30px auto">
<h2>Questão 3 — Funcionário</h2>
<?php $f->exibir(); ?>
<p><a href="index.html">&larr; Voltar</a></p></body></html>
