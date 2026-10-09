<?php

function registrarLog(string $nivel, string $mensagem): void
{
    $niveis = ["INFO", "WARNING", "ERROR"];

    if (!in_array($nivel, $niveis)) {
        return;
    }

    $pasta = __DIR__ . "/logs";

    if (!is_dir($pasta)) {
        mkdir($pasta, 0777, true);
    }

    $data = date("Y-m-d H:i:s");

    $linha = "[" . $data . "] [" . $nivel . "] " . $mensagem . PHP_EOL;

    file_put_contents(
        $pasta . "/sistema.log",
        $linha,
        FILE_APPEND
    );
}

try {
    $pdo = new PDO(
        "pgsql:host=127.0.0.1;port=5432;dbname=senai",
        "usuario",
        "senha",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false
        ]
    );

    registrarLog("INFO", "Conexão realizada com sucesso.");
    echo "Conexão realizada com sucesso.";

} catch (PDOException $e) {
    registrarLog("ERROR", $e->getMessage());
    echo "Não foi possível conectar ao banco de dados.";
}
?>