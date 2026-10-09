<?php

require_once "ConexaoBanco.php";

define("ARQUIVO_CONFIG", __DIR__ . "/config/database.ini");

$config = parse_ini_file(ARQUIVO_CONFIG);

$inicio1 = microtime(true);
$memoria1 = memory_get_usage();

for ($i = 0; $i < 50; $i++) {
    $dsn = "pgsql:host=" . $config["db_host"] .
           ";port=" . $config["db_port"] .
           ";dbname=" . $config["db_name"];

    $pdo = new PDO(
        $dsn,
        $config["db_user"],
        $config["db_password"],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false
        ]
    );

    $pdo = null;
}

$tempo1 = microtime(true) - $inicio1;
$memoriaFinal1 = memory_get_usage();
$memoria1 = $memoriaFinal1 - $memoria1;


$inicio2 = microtime(true);
$memoria2 = memory_get_usage();

$conexao = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);

for ($i = 0; $i < 50; $i++) {
    $conexao = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);
}

$tempo2 = microtime(true) - $inicio2;
$memoriaFinal2 = memory_get_usage();
$memoria2 = $memoriaFinal2 - $memoria2;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Benchmark de Conexões</title>
</head>
<body>

<h1>Benchmark de Conexões</h1>

<table border="1">
    <tr>
        <th>Teste</th>
        <th>Tempo</th>
        <th>Memória</th>
    </tr>

    <tr>
        <td>50 novas conexões</td>
        <td><?= number_format($tempo1, 6) ?> segundos</td>
        <td><?= $memoria1 ?> bytes</td>
    </tr>

    <tr>
        <td>50 chamadas Singleton</td>
        <td><?= number_format($tempo2, 6) ?> segundos</td>
        <td><?= $memoria2 ?> bytes</td>
    </tr>
</table>

</body>
</html>