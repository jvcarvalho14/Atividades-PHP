<?php
$valor = $_POST['valor'];
$moeda = $_POST['moeda'];

$resultado = 0;

if ($moeda == 'dolar') {
    $resultado = $valor * 5.25; 
} elseif ($moeda == 'euro') {
    $resultado = $valor * 6.20; 
} elseif ($moeda == 'libra') {
    $resultado = $valor * 7.10; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do conversor</title>
</head>
<body>
    <h1>Resultado da Conversão</h1>
    <p>Valor em reais: R$ <?php echo number_format($resultado, 2, ',', '.'); ?></p>
</body>
</html>