<?php

function carregarAmbiente(string $ambiente): array
{
    $arquivo = __DIR__ . "/config/database.ini";

    $config = parse_ini_file($arquivo, true);

    if (!isset($config[$ambiente])) {
        throw new Exception("Ambiente não encontrado.");
    }

    return $config[$ambiente];
}

$ambiente = "development";

try {
    $config = carregarAmbiente($ambiente);

    $dsn = "pgsql:host=" . $config["db_host"] .
           ";port=" . $config["db_port"] .
           ";dbname=" . $config["db_name"];

    $pdo = new PDO($dsn, $config["db_user"], $config["db_password"], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_STRINGIFY_FETCHES => false
    ]);

    echo "Ambiente: " . $ambiente . "\n";
    echo "Conexão realizada com sucesso.\n";

} catch (PDOException $e) {
    echo "Erro ao conectar ao banco.\n";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
?>