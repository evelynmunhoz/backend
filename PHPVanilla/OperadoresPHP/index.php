<?php 
//1. Declare => evitar operações entre variáveis de tipos diferentes
declare(strict_types=1);

// Criar um cálculo de holerite em PHP

// 2. Declarar as constantes
const TAXA_INSS = 0.08; // 8% => 8/100
const DESCONTO_VT = 150.00;

// 3. Declarar as variáveis
// Dados do funcionário
$nomeFuncionário = "Maria Silva"; // Nome do funcionário
$salarioBase = 3200.50; // Salário base do funcionário
$horasExtras = 10; // Horas extras trabalhadas

//declaração de variáveis usando lowerCamelCase
// regra -> primeira palavra toda minúsculo e depois as demias palavras usa-se maiúscula na primeira letra
//exemplo: $hojeEstaUmDiaBonito

//4.  Cálculos dos salários
// Variavel Valor Hora Extra
$valorHoraExtra = ($salarioBase / 220) * 1.6;
// -> Crie a variável $totalHorasExtras
$totalHorasExtras = $horasExtras * $valorHoraExtra;
// -> Crie a variável $salarioBruto
$salarioBruto = $salarioBase + $totalHorasExtras;
// -> Crie a variável $descontoInss
$descontoInss = $salarioBruto * TAXA_INSS;
// -> crie a variável $salarioLiquido
$salarioLiquido = $salarioBruto - $descontoInss - DESCONTO_VT;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holerite - <?php echo $nomeFuncionário; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <h2>Demonstrativo de Pagamento</h2>
    <!-- Saída de Dados Misturando Html e PHP -->
    <table>
        <tr>
            <th>Colaborador(a)</th>
            <td><?php echo $nomeFuncionário; ?></td>
        </tr>
        <tr>
            <th>Salário Base</th>
            <!-- usar uma função chamada number format (formata saida de numeros) -->
            <td>R$ <?php echo number_format($salarioBase,2,",","."); ?></td>
        </tr>
        <!-- fazer as demais linhas da tabela utilizando as variáveis criada -->
        <tr>
            <th>Valor da Hora Extra</th>
            <td>R$ <?php echo number_format($valorHoraExtra,2,",","."); ?></td>
        </tr>
        <tr>
            <th>Total de Horas extras</th>
            <td>R$ <?php echo number_format($totalHorasExtras,2,","); ?></td>
        </tr>
        <tr>
            <th>Salário Bruto</th>
            <td>R$ <?php echo number_format($salarioBruto,2,",","."); ?></td>
        </tr>
        <tr>
            <th>Desconto do INSS</th>
            <td>R$ <?php echo number_format($descontoInss,2,",","."); ?></td>
        </tr>
        <tr>
            <th>Desconto do VT</th>
            <td>R$ <?php echo number_format(DESCONTO_VT,2,",","."); ?></td>
        </tr>
        <tr>
            <th>Salário Líquido</th>
            <td>R$ <?php echo number_format($salarioLiquido,2,",","."); ?></td>
        </tr>
    </table>
</body>
</html>