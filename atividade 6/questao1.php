<?php
class Livro
{
    private string $titulo;
    private string $autor;
    private int $anoPublicacao;
    private int $paginas;
    private string $situacao;

    public function definirDados(string $titulo, string $autor, int $ano, int $paginas, string $situacao): void
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anoPublicacao = $ano;
        $this->paginas = $paginas;
        $this->situacao = $situacao;
    }

    public function exibir(): void
    {
        echo "<p><b>Título:</b> " . htmlspecialchars($this->titulo) . "<br>";
        echo "<b>Autor:</b> " . htmlspecialchars($this->autor) . "<br>";
        echo "<b>Ano:</b> {$this->anoPublicacao}<br>";
        echo "<b>Páginas:</b> {$this->paginas}<br>";
        echo "<b>Situação:</b> " . htmlspecialchars($this->situacao) . "</p>";
    }

    public function ehAntigo(): bool
    {
        return ((int) date('Y') - $this->anoPublicacao) > 20;
    }

    public function ehExtenso(): bool
    {
        return $this->paginas > 400;
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

$livro = new Livro();
$livro->definirDados(
    trim($_POST['titulo']),
    trim($_POST['autor']),
    (int) $_POST['ano'],
    (int) $_POST['paginas'],
    $_POST['situacao']
);
?>
<!DOCTYPE html><html lang="pt-BR"><head><meta charset="UTF-8"><title>Resultado</title></head><body style="font-family:Arial,sans-serif;max-width:640px;margin:30px auto">
<h2>Questão 1 — Livro</h2>
<?php $livro->exibir(); ?>
<p>É antigo (mais de 20 anos)? <b><?= $livro->ehAntigo() ? 'Sim' : 'Não' ?></b></p>
<p>É extenso (mais de 400 páginas)? <b><?= $livro->ehExtenso() ? 'Sim' : 'Não' ?></b></p>
<p><a href="index.html">&larr; Voltar</a></p></body></html>
