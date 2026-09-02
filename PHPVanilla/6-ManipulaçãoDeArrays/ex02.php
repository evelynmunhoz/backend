<?php

$usuario = [
    "nome" => "Carlos Eduardo",
    "idade" => 28,
    "cidade" => "Americana",
    "estado" => "SP",
    "premium" => true
];

?>

<div>
    <h2>
        <?php echo $usuario["nome"]; ?>

        <?php
        if ($usuario["premium"] == true) {
            echo "⭐";
        }
        ?>
    </h2>

    <p>Idade: <?php echo $usuario["idade"]; ?></p>

    <p>
        Cidade:
        <?php echo $usuario["cidade"] . " - " . $usuario["estado"]; ?>
    </p>
</div>
