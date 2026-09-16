<?php
declare(strict_types=1);

$email = $_POST["email"] ?? "";
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $senha = $_POST["senha"] ?? "";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = "E-mail inválido";
    } elseif (strlen($senha) < 6) {
        $mensagem = "A senha deve ter no mínimo 6 caracteres";
    } elseif ($email == "admin@senai.br" && $senha == "senhaSegura123") {
        $mensagem = "Bem-vindo!";
    } else {
        $mensagem = "Credenciais inválidas";
    }
}
?>

<form method="POST">

    <input
        type="email"
        name="email"
        placeholder="E-mail"
        value="<?= htmlspecialchars($email) ?>"
    >

    <input
        type="password"
        name="senha"
        placeholder="Senha"
    >

    <button type="submit">Entrar</button>

</form>

<?php if ($mensagem != ""): ?>
    <div>
        <?= htmlspecialchars($mensagem) ?>
    </div>
<?php endif; ?>
```
