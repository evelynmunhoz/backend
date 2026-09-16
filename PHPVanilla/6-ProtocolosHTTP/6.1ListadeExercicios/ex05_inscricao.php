<?php
declare(strict_types=1);

$nome = $_POST["nome_candidato"] ?? "";
$idade = $_POST["idade"] ?? "";
$curso = $_POST["curso_desejado"] ?? "";
$erros = [];

$cursos = ["Desenvolvimento de Sistemas", "Mecatrônica", "Redes"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (strlen($nome) < 5)
        $erros["nome"] = "Nome deve ter pelo menos 5 caracteres.";

    if (!is_numeric($idade) || $idade < 16)
        $erros["idade"] = "Idade deve ser maior ou igual a 16.";

    if (!in_array($curso, $cursos))
        $erros["curso"] = "Escolha um curso válido.";

    if (!isset($_POST["aceite_termos"]))
        $erros["termos"] = "Você deve aceitar os termos.";
}
?>

<form method="POST">

    <input name="nome_candidato"
        placeholder="Nome"
        value="<?= htmlspecialchars($nome) ?>">
    <?php if (isset($erros["nome"])): ?>
        <p style="color:red"><?= htmlspecialchars($erros["nome"]) ?></p>
    <?php endif; ?>

    <input name="idade" type="number"
        placeholder="Idade"
        value="<?= htmlspecialchars($idade) ?>">
    <?php if (isset($erros["idade"])): ?>
        <p style="color:red"><?= htmlspecialchars($erros["idade"]) ?></p>
    <?php endif; ?>

    <select name="curso_desejado">
        <option value="">Escolha o curso</option>
        <?php foreach ($cursos as $opcao): ?>
            <option value="<?= htmlspecialchars($opcao) ?>"
                <?= $curso == $opcao ? "selected" : "" ?>>
                <?= htmlspecialchars($opcao) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <?php if (isset($erros["curso"])): ?>
        <p style="color:red"><?= htmlspecialchars($erros["curso"]) ?></p>
    <?php endif; ?>

    <label>
        <input type="checkbox" name="aceite_termos">
        Aceito os termos
    </label>

    <?php if (isset($erros["termos"])): ?>
        <p style="color:red"><?= htmlspecialchars($erros["termos"]) ?></p>
    <?php endif; ?>

    <button type="submit">Enviar</button>

</form>
```
