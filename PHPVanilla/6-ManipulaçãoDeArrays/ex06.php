<?php

$extrato = [
    ["data" => "01/09/2026", "descricao" => "Salário", "tipo" => "Entrada", "valor" => 4000],
    ["data" => "02/09/2026", "descricao" => "Supermercado", "tipo" => "Saida", "valor" => 450.50],
    ["data" => "05/09/2026", "descricao" => "Pix João", "tipo" => "Entrada", "valor" => 200],
    ["data" => "10/09/2026", "descricao" => "Conta de Luz", "tipo" => "Saida", "valor" => 120],
    ["data" => "12/09/2026", "descricao" => "Cinema", "tipo" => "Saida", "valor" => 65]
];

$totalEntradas = 4200;
$totalSaidas = 635.50;
$saldo = 3564.50;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Financeiro</title>
</head>

<body>

<h1>Dashboard Financeiro</h1>

<h2>Resumo</h2>

<p style="color: green;">
    Entradas: R$ 4.200,00
</p>

<p style="color: red;">
    Saídas: R$ 635,50
</p>

<p style="color: green;">
    Saldo: R$ 3.564,50
</p>


<h2>Extrato</h2>

<table border="1">

    <tr>
        <th>Data</th>
        <th>Descrição</th>
        <th>Tipo</th>
        <th>Valor</th>
    </tr>

    <?php foreach ($extrato as $item) { ?>

    <?php
        if ($item["tipo"] == "Entrada") {
            $cor = "green";
        } else {
            $cor = "red";
        }
    ?>

    <tr style="color: <?php echo $cor; ?>;">
        <td><?php echo $item["data"]; ?></td>
        <td><?php echo $item["descricao"]; ?></td>
        <td><?php echo $item["tipo"]; ?></td>
        <td>
            R$ <?php echo number_format($item["valor"], 2, ',', '.'); ?>
        </td>
    </tr>

    <?php } ?>

</table>


<h2>Gastos acima de R$ 100</h2>

<p style="color: red;">
    Supermercado - R$ 450,50
</p>

<p style="color: red;">
    Conta de Luz - R$ 120,00
</p>

</body>
</html>

