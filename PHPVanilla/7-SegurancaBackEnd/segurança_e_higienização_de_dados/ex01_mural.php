<?php

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$arquivo = 'mural.json';

if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode([]));
}

$recados = json_decode(file_get_contents($arquivo), true) ?? [];
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['nome'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if (mb_strlen($nome) < 3) {
        $erro = 'O nome deve ter pelo menos 3 caracteres.';
    } elseif (mb_strlen($mensagem) < 5) {
        $erro = 'A mensagem deve ter pelo menos 5 caracteres.';
    } else {
        $recados[] = [
            'nome' => $nome,
            'mensagem' => $mensagem
        ];

        file_put_contents(
            $arquivo,
            json_encode($recados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Mural de Recados</title>
</head>

<body>

<h1>Mural de Recados</h1>

<?php if ($erro !== ''): ?>
    <p><?= e($erro) ?></p>
<?php endif; ?>

<form method="post">

    <input type="text" name="nome" placeholder="Nome" required>

    <textarea name="mensagem" placeholder="Mensagem" required></textarea>

    <button type="submit">Enviar</button>

</form>

<?php foreach ($recados as $recado): ?>

    <p>
        <strong><?= e($recado['nome']) ?></strong>
    </p>

    <p>
        <?= nl2br(e($recado['mensagem'])) ?>
    </p>

<?php endforeach; ?>

</body>
</html>