<?php

define("ARQUIVO_CONFIG", __DIR__ . "/config/database.ini");

try {
    $config = parse_ini_file(ARQUIVO_CONFIG);

    $dsn = "pgsql:host=" . $config["db_host"] .
           ";port=" . $config["db_port"] .
           ";dbname=" . $config["db_name"];

    $pdo = new PDO($dsn, $config["db_user"], $config["db_password"], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_STRINGIFY_FETCHES => false
    ]);

    echo "Porta 5432 e banco de dados acessíveis.\n";

    $versao = $pdo->query("SELECT version()")->fetchColumn();
    echo "PostgreSQL: " . $versao . "\n";

} catch (PDOException $e) {
    echo "Erro: Não foi possível conectar ao banco de dados.\n";
}
?>