<?php
$texto = $_POST['texto'];
$caracteres = strlen($texto);
$palavras = str_word_count($texto);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de caracteres e palavras</title>
</head>
<body>
    <h1>Contador de Caracteres e Palavras</h1>
    <p>Caracteres: <?php echo $caracteres; ?></p>
    <p>Palavras: <?php echo $palavras; ?></p>
</body>
</html>