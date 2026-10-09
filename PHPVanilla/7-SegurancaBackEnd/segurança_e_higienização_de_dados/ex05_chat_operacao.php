<?php

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

$arquivo = 'chat.json';

if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode([]));
}

$mensagens = json_decode(file_get_contents($arquivo), true) ?? [];
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $operador = trim($_POST['operador'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($operador === '') {
        $erro = 'Digite o operador.';
    } elseif ($mensagem === '') {
        $erro = 'Digite uma mensagem.';
    } elseif (mb_strlen($mensagem) > 250) {
        $erro = 'A mensagem não pode ultrapassar 250 caracteres.';
    } else {

        $mensagens[] = [
            'operador' => $operador,
            'mensagem' => $mensagem
        ];

        file_put_contents(
            $arquivo,
            json_encode($mensagens, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Chat Industrial</title>
</head>

<body>

<h1>Chat Industrial</h1>

<form method="post">

    <input type="text" name="operador" placeholder="Operador" required>

    <textarea
        name="mensagem"
        maxlength="250"
        placeholder="Mensagem"
        required
    ></textarea>

    <button type="submit">Enviar</button>

</form>

<?php if ($erro !== ''): ?>

    <p><?= e($erro) ?></p>

<?php endif; ?>

<?php foreach ($mensagens as $item): ?>

    <p>
        <strong><?= e($item['operador']) ?></strong>
    </p>

    <p>
        <?= nl2br(e($item['mensagem'])) ?>
    </p>

<?php endforeach; ?>

</body>
</html>