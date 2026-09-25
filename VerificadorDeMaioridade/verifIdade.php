<?php
$nome = $_POST['nome'];
$ano_nascimento = $_POST['ano_nascimento'];

$date = date('Y-m-d H:i:s');

$idade = date('Y') - $ano_nascimento;

if ($idade >= 18) {
    $mensagem = "$nome tem $idade anos e é maior de idade.";
} else {
    $mensagem = "$nome tem $idade anos e é menor de idade.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Idade</title>
</head>
<body>
    <p><?php echo $mensagem; ?></p>
</body>
</html>
