<?php
$nota1 = $_POST['nota1'];
$nota2 = $_POST['nota2'];
$nota3 = $_POST['nota3'];
$media = ($nota1 + $nota2 + $nota3) / 3;

if($media >= 6){
    $mensagem = "Aprovado com média:$media";
} elseif($media >= 4 && $media < 6){
    $mensagem = "Em recuperação com média:$media";
} else {
    $mensagem = "Reprovado com média:  $media";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
    <h1>Resultado</h1>
    <p><?php echo $mensagem; ?></p>
</body>
</html>