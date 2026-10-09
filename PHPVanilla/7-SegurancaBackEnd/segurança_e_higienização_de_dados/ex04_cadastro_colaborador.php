<?php

declare(strict_types=1);

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function sanitizarTexto(string $dado): string
{
    return trim(strip_tags($dado));
}

function validarColaborador(array $dados): array
{
    $erros = [];

    if (mb_strlen($dados['nome']) < 3) {
        $erros['nome'] = 'Nome inválido.';
    }

    if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = 'E-mail inválido.';
    }

    if (filter_var($dados['matricula'], FILTER_VALIDATE_INT) === false) {
        $erros['matricula'] = 'Matrícula inválida.';
    }

    if (filter_var($dados['salario'], FILTER_VALIDATE_FLOAT) === false) {
        $erros['salario'] = 'Salário inválido.';
    }

    return $erros;
}

$erros = [];
$colaborador = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $colaborador = [
        'nome' => sanitizarTexto($_POST['nome'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'matricula' => trim($_POST['matricula'] ?? ''),
        'salario' => trim($_POST['salario'] ?? '')
    ];

    $erros = validarColaborador($colaborador);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Colaborador</title>
</head>

<body>

<h1>Cadastro de Colaborador</h1>

<form method="post">

    <input type="text" name="nome" placeholder="Nome" required>

    <input type="email" name="email" placeholder="E-mail" required>

    <input type="number" name="matricula" placeholder="Matrícula" required>

    <input type="number" step="0.01" name="salario" placeholder="Salário" required>

    <button type="submit">Cadastrar</button>

</form>

<?php if (!empty($erros)): ?>

    <?php foreach ($erros as $erro): ?>

        <p><?= e($erro) ?></p>

    <?php endforeach; ?>

<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>

    <p>Colaborador cadastrado com sucesso!</p>

    <p>Nome: <?= e($colaborador['nome']) ?></p>

    <p>E-mail: <?= e($colaborador['email']) ?></p>

    <p>Matrícula: <?= e($colaborador['matricula']) ?></p>

    <p>Salário: <?= e($colaborador['salario']) ?></p>

<?php endif; ?>

</body>
</html>