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
    $salario = 2500.00; // criação da variavel numérica - decimal 
    $status = null; // variavel nula - sem valor atribuido
    
    // Dicas para criação de variáveis 
    // Não inicie o nome de uma variável com numeros 
    // Não ultilize espaços em branco 
    // Não ultilize caracteres especiais, somente o underline
    // Crie variáveis com nomes que ajudarão a idetificar a mesma
    // Evite utilizar letras maiúsculas.

    echo $nome;
    echo "<br>";
    echo "idade: " . $idade;



    ?>
</body>
</html>


