<?php
declare(strict_types=1);

// 1. Catálogo mockado com 6 produtos e preços em formato float
$produtos = [
    ["nome" => "Notebook", "categoria" => "Eletrônicos", "preco" => 3500],
    ["nome" => "Celular", "categoria" => "Eletrônicos", "preco" => 2200],
    ["nome" => "Fone", "categoria" => "Acessórios", "preco" => 150],
    ["nome" => "Mochila", "categoria" => "Acessórios", "preco" => 180],
    ["nome" => "Teclado", "categoria" => "Informática", "preco" => 250],
    ["nome" => "Monitor", "categoria" => "Informática", "preco" => 1200]
];

// 2. Captura dos filtros via GET
$nome = $_GET["nome"] ?? "";
$preco = $_GET["preco_maximo"] ?? "";

// 3. Filtragem usando array_filter
$produtos = array_filter($produtos, function ($produto) use ($nome, $preco) {
    return ($nome === "" || stripos($produto["nome"], $nome) !== false)
        && ($preco === "" || $produto["preco"] <= (float)$preco);
});
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Catálogo</title>
</head>
<body>

<h1>Catálogo de Produtos</h1>

<form method="GET">
    <input type="text" name="nome" placeholder="Nome do produto">
    <input type="number" name="preco_maximo" placeholder="Preço máximo">
    <button type="submit">Filtrar</button>
</form>

<hr>

<?php foreach ($produtos as $produto): ?>

    <h2><?= htmlspecialchars($produto["nome"]) ?></h2>
    <p><?= htmlspecialchars($produto["categoria"]) ?></p>
    <p>R$ <?= htmlspecialchars((string)$produto["preco"]) ?></p>

<?php endforeach; ?>

</body>
</html>

