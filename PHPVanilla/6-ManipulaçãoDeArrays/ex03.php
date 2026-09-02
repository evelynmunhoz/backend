<?php

$funcionarios = [
    ["id" => 1, "nome" => "Ana Souza", "cargo" => "Dev Front-End", "salario" => 4500.00],
    ["id" => 2, "nome" => "Bruno Costa", "cargo" => "Dev Back-End", "salario" => 5200.00],
    ["id" => 3, "nome" => "Carla Dias", "cargo" => "Tech Lead", "salario" => 8900.00],
    ["id" => 4, "nome" => "Daniel Silva", "cargo" => "Estagiário", "salario" => 1500.00]
];

$totalFolha = 0;

?>

<h2>Folha de Pagamento</h2> 

<table border="1"> 
    <tr>
        <th>ID</th> 
        <th>Nome</th>
        <th>Cargo</th>
        <th>Salário</th>
    </tr>

    <?php foreach ($funcionarios as $funcionario) { ?>

        <tr>
            <td><?php echo $funcionario["id"]; ?></td>
            <td><?php echo $funcionario["nome"]; ?></td>
            <td><?php echo $funcionario["cargo"]; ?></td>

            <td>
                <?php
                echo "R$ " . number_format($funcionario["salario"], 2, ",", ".");
                ?>
            </td>
        </tr>

        <?php
        $totalFolha = $totalFolha + $funcionario["salario"];
        ?>

    <?php } ?>

</table>

<h3>
    Total gasto pela empresa:
    <?php echo "R$ " . number_format($totalFolha, 2, ",", "."); ?>
</h3>
