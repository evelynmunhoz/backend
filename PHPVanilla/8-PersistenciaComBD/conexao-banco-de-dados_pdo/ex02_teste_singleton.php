<?php

require_once "ConexaoBanco.php";

define("ARQUIVO_CONFIG", __DIR__ . "/config/database.ini");

try {
    $conexao1 = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);
    $conexao2 = ConexaoBanco::obterConexao(ARQUIVO_CONFIG);

    echo "ID da conexão 1: " . spl_object_id($conexao1) . "\n";
    echo "ID da conexão 2: " . spl_object_id($conexao2) . "\n";

    if ($conexao1 === $conexao2) {
        echo "As duas conexões são o mesmo objeto.\n";
    } else {
        echo "Foram criados objetos diferentes.\n";
    }

} catch (PDOException $e) {
    echo "Erro ao conectar ao banco.\n";
}
?>