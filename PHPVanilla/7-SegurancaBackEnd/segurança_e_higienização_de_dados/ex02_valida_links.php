<?php

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$erro = '';
$linkValido = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $url = trim($_POST['url'] ?? '');

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        $erro = 'URL inválida.';
    } elseif (
        !str_starts_with($url, 'http://') &&
        !str_starts_with($url, 'https://')
    ) {
        $erro = 'Use apenas http:// ou https://.';
    } else {
        $linkValido = $url;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Validador de Links</title>
</head>

<body>

<h1>Validador de Links</h1>

<form method="post">

    <input type="text" name="nome" placeholder="Nome" required>

    <input type="url" name="url" placeholder="https://github.com/" required>

    <button type="submit">Cadastrar</button>

</form>

<?php if ($erro !== ''): ?>

    <p><?= e($erro) ?></p>

<?php endif; ?>

<?php if ($linkValido !== ''): ?>

    <a href="<?= e($linkValido) ?>" target="_blank">
        Visitar Portfólio
    </a>

<?php endif; ?>

</body>
</html>