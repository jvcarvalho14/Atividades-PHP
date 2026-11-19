<?php
$res = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = $_POST['texto'] ?? '';
    $palavras = preg_split('/\s+/u', trim($texto), -1, PREG_SPLIT_NO_EMPTY);
    $res = [
        'caracteres' => mb_strlen($texto),
        'palavras'   => count($palavras),
        'vogais'     => preg_match_all('/[aeiouáàâãéêíóôõúü]/iu', $texto),
        'letra_a'    => substr_count(mb_strtolower($texto), 'a'),
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><title>Analisador de Texto</title><style>body{font-family:sans-serif;max-width:560px;margin:30px auto}label{display:block;margin-top:10px}input,select,textarea{width:100%;padding:6px;box-sizing:border-box}button{margin-top:12px;padding:8px 14px}.res{margin-top:16px;padding:10px;background:#e8f0fe}.err{background:#fde8e8}table{border-collapse:collapse;width:100%;margin-top:12px}td,th{border:1px solid #999;padding:6px;text-align:left}.destaque{background:#fff3b0;font-weight:bold}</style></head>
<body>
<h2>Analisador de Texto</h2>
<form method="post">
    <label>Texto: <textarea name="texto" rows="6" required><?= htmlspecialchars($_POST['texto'] ?? '') ?></textarea></label>
    <button type="submit">Analisar</button>
</form>
<?php if ($res): ?>
<div class="res">
    <p>Caracteres: <strong><?= $res['caracteres'] ?></strong></p>
    <p>Palavras: <strong><?= $res['palavras'] ?></strong></p>
    <p>Vogais: <strong><?= $res['vogais'] ?></strong></p>
    <p>Letra "a": <strong><?= $res['letra_a'] ?></strong></p>
</div>
<?php endif; ?>
</body></html>
