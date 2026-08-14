<?php 
declare(strict_types=1);
// Motor de Análise de Crédito
// Regras do Negócio:
// Regra de Idade: O cliente precisa ter 18 anos ou mais E menos de 70 anos.
// Regra da Parcela (Renda): O valor da parcela do empréstimo NÃO pode ser maior que 30% da renda mensal do cliente.
// Regra VIP: Se o cliente tiver um "Score de Crédito" maior que 800, ele tem aprovação automática (as regras de idade e renda não importam).
// Aprovação Final: O crédito é liberado se: (Regra 1 E Regra 2 forem passarem) OU se (Regra 3 passar).

// 1. Dados que vieram do aplicativo do celualr do Cliente
$idadeCliente = 25;
$rendaMensal = 4000.00;
$valorEmprestimo = 10000.00;
$numeroParcelas = 24;
$scoreCredito = 750; //pontuação vai de 0 a 1000

// 2. Cálculos Artiméticos
$taxaJuros = 0.02; // 2% ao mês
$valorJurostotal= $valorEmprestimo * $taxaJuros * $numeroParcelas;
$valorTotalPagar = $valorEmprestimo + $valorJurostotal;
$valorParcela = $valorTotalPagar / $numeroParcelas;

// 3. O cérebro da operação: Avaliaçao das Regras (substitua ??? pelos operadors lógicos e relacionais)
// Regra 1 : Maior igual a 18 menor que 70 
$idadevalida = ($idadeCliente >= 18) && ($idadeCliente < 70);

// Regra 2: Parcela não pode ser maior que 30% da renda (renda * 0.3)
$limiteRenda = $rendaMensal * 0.30;
$rendaSuficiente = $valorParcela <= $limiteRenda;

//Regra 3: ClienteVIP (Score > 800)
$isClienteVip = $scoreCredito > 800;

// 4. Decisão Final (A Regra Final)
// Passou na IDade e na Renda? ou é ClienteVIP?
$aprovado = ($idadevalida && $rendaSuficiente) || $isClienteVip;

