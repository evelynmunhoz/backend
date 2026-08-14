<?php 
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudo de Variáveis</title>
</head>
<body>
    <h1>Estudo de Variáveis</h1>
    <hr>
    <?php
    // Para criar variáveis em PHP , basta usar o sinal de $ 
    // Variaveis em php são não tipadas , NÃO precisa declarar o tipo (texto, número, booleanas,) 
    // ao atribuir valor para a variável a tipagem é automática
    $nome = "Guilherme"; // criação da variavel mome com o valor textual "Guilherme"
    $idade = 20; // criação da variavel idade com o valor numérico 20
    $ativo = true; // criação da variavel ativo com o valor booleano true
    $salario = 2500.00; // criação da variavel numérica - decimal (float - double)
    $status = null; // variavel nula - sem valor atribuido
    //$endereço; // variável Undefined, não é possivel declarar uma variavel sem atribuir um valor a ela, não existe Undefined em PHP
    
    // Dicas para criação de variáveis 
    // Não inicie o nome de uma variável com numeros 
    // Não ultilize espaços em branco 
    // Não ultilize caracteres especiais, somente o underline
    // Crie variáveis com nomes que ajudarão a idetificar a mesma
    // Evite utilizar letras maiúsculas.

    // Exibir as variáveis na tela
    echo "Nome: $nome <br>";
    echo "Idade: $idade <br>";
    echo "Ativo: $ativo <br>";
    echo "Salario: $salario <br>";
    echo "Status $status <br>";


    echo "<br><h3> Constantes </h3><br>";
    // Constantes são representadas pela palavra "const" ou "define" seguidas do nome da constante
    //Exemplos de constantes
    const PI = 3.14; //Constante do Tipo Number (float)
    const EMPRESA = "Google"; //Constatne do Tipo String
    define("SITE", "www.google.com"); //Declaração de constante do tipo string com a função "define"
    // uma boa prática é utilizar letrs maiúsculas para nomear constantes, para diferenciar das variáveis

 //Exibir as constantes na tela
    echo " Valor de PI: " . PI . "<br>";
    echo " Empresa: " . EMPRESA . "<br>";
    echo " Site: " . SITE . "<br>";

    // tentar alterar o valor de uma constate irá gerar um erro de código, pois o valor de uma constante não pode ser alterada
    // PI = 3.14159; // irá gerar um erro de código
    // redeclarar uma constante também irá gerar um erro de código
    //const SITE = "www.google.com.br"; // irá gerar um erro de código

//Regra de ouro: Sempre coloque a instrução "declare(strict_types=1);" no início do seu código PHP
// isso blindará o seu sistema contra mistura acidentais de tipos de dados.


// Utilização de texto (concatenação Vs Interpolação)

//Exemplo de concatenação => Juntar duas ou mais Strings utilizando o operador de concatenação (.)
"Olá " . $nome . ", seja bem vindo ao nosso site! <br>"; 

//Exemplo de interpolação => Utilização de variáveis dentro de um texto , utilizando aspas duplas no texto
echo "$nome, tem $idade anos e seu salário é R$ $salario reais. <br>";//forma mais correta de misturar texto e variáveis

    ?>
</body>
</html>


