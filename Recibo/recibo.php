<?php
$nome = $_POST['nome'];
$texto = $_POST['texto'];

$datetime = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante de envio</title>
</head>
<body>
    <h1>Recibo</h1>
    <p><strong>Nome:</strong> <?php echo $nome; ?></p>
    <p><strong>Texto:</strong> <?php echo $texto; ?></p>
    <p><strong>Data e Hora:</strong> <?php echo $datetime; ?></p>
</body>
</html>
    