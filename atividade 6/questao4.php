<?php
class Aluno
{
    private string $nome;
    private string $matricula;
    private string $curso;
    private array $notas;
    private float $frequencia;

    public function __construct(string $nome, string $matricula, string $curso, array $notas, float $frequencia)
    {
        $this->nome = $nome;
        $this->matricula = $matricula;
        $this->curso = $curso;
        $this->notas = $notas;
        $this->frequencia = $frequencia;
    }

    public function calcularMedia(): float
    {
        return array_sum($this->notas) / count($this->notas);
    }

    // REGRA EXTRA: frequência mínima de 75%. Abaixo disso, reprova por falta mesmo com boa média.
    public function reprovadoPorFalta(): bool
    {
        return $this->frequencia < 75;
    }

    public function aprovado(): bool
    {
        return !$this->reprovadoPorFalta() && $this->calcularMedia() >= 70;
    }

    public function recuperacao(): bool
    {
        $media = $this->calcularMedia();
        return !$this->reprovadoPorFalta() && $media >= 50 && $media < 70;
    }

    public function situacao(): string
    {
        if ($this->reprovadoPorFalta()) {
            return "REPROVADO POR FALTA";
        }
        if ($this->aprovado()) {
            return "APROVADO";
        }
        if ($this->recuperacao()) {
            return "RECUPERAÇÃO";
        }
        return "REPROVADO";
    }

    public function exibir(): void
    {
        echo "<p><b>Aluno:</b> " . htmlspecialchars($this->nome) . "<br>";
        echo "<b>Matrícula:</b> " . htmlspecialchars($this->matricula) . "<br>";
        echo "<b>Curso:</b> " . htmlspecialchars($this->curso) . "<br>";
        echo "<b>Notas:</b> " . implode(", ", $this->notas) . "<br>";
        echo "<b>Média:</b> " . number_format($this->calcularMedia(), 1, ',', '.') . "<br>";
        echo "<b>Frequência:</b> " . number_format($this->frequencia, 1, ',', '.') . "%<br>";
        echo "<b>Situação:</b> " . $this->situacao() . "</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

$aluno = new Aluno(
    trim($_POST['nome']),
    trim($_POST['matricula']),
    trim($_POST['curso']),
    [(float) $_POST['nota1'], (float) $_POST['nota2'], (float) $_POST['nota3']],
    (float) $_POST['frequencia']
);
?>
<!DOCTYPE html><html lang="pt-BR"><head><meta charset="UTF-8"><title>Resultado</title></head><body style="font-family:Arial,sans-serif;max-width:640px;margin:30px auto">
<h2>Questão 4 — Aluno</h2>
<?php $aluno->exibir(); ?>
<p><a href="index.html">&larr; Voltar</a></p></body></html>
