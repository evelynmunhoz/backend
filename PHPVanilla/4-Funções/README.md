### Exercícios
**Parte A**
!Exercícios Teóricos!

**1.Conceito de função: Explique com suas palavras o que é uma função e cite duas vantagens de dividir um programa em funções.**
- Uma função é um blocode código que executa uma tarefa específica. Ela recebe dados, faz um cálculo ou ação e devolve um resultado.
**Vantagem de usar funções**
Organização: O código fica limpo e separado em partes menores. Fica mais fácil ler e achar erros.Reutilização

**2.Princípio DRY: Por que repetir o mesmo bloco de código em várias partes do sistema pode causar problemas de manutenção? Como uma função ajuda a evitar essa repetição?**
- Repetir código cria pontos múltiplos de falha. Se uma regra muda, você precisa atualizar cada cópia. Isso causa erros e gasta tempo. Uma função guarda esse bloco em um só lugar. Você chama a função sempre que precisa e muda o código em um único ponto.
**Problemas da Repetição (DRY)**
* Erros fáceis: Esquecer de mudar uma cópia gera falhas no sistema.*Código longo: Arquivos ficam grandes e difíceis de ler.
* Tempo perdido: Atualizar várias partes atrasa o trabalho.
**Como a Função Ajuda ??**
*Ponto único: A lógica fica em um só lugar.
*Fácil troca: Mudar a função atualiza o sistema inteiro.
*Código limpo: Fica mais curto e fácil de entender.




**3.Parâmetros e retorno: Explique a diferença entre um parâmetro e um valor retornado por uma função. Use a função abaixo como exemplo:**
```php
function calcularTotal(float $preco, int $quantidade): float {
    return $preco * $quantidade;
}
```
- Parâmetros são os dados que entram na função, enquanto o valor retornado é o resultado que sai dela.
**utilizando o exemplo:**
*Parâmetros (Entrada)*
São as variáveis declaradas entre os parênteses da função ($preco e $quantidade).
Funcionam como combustíveis ou instruções para o bloco de código.
No exemplo, a função precisa receber um número decimal (preço) e um número inteiro (quantidade) para poder trabalhar.
*Retorno (Saída)*
É o resultado final enviado de volta para quem chamou a função, indicado pela palavra-chave return.
O tipo após os dois pontos (: float) define que a saída será obrigatoriamente um número decimal.
No exemplo, o retorno é a multiplicação do preço pela quantidade ($preco * $quantidade).

**4.Tipagem: Identifique o tipo de cada elemento na declaração
 function cadastrar(string $nome, int $idade): bool.** 

- function → palavra-chave utilizada para declarar uma função.
- cadastrar → nome da função.
- string $nome → parâmetro chamado $nome, que deve receber um valor do tipo string.
- int $idade → parâmetro chamado $idade, que deve receber um valor do tipo int (inteiro).
- : bool → indica que a função deve retornar um valor do tipo bool (booleano), ou seja, true ou false.


**5. void e return: Qual é a diferença entre uma função que retorna string e uma função que retorna void? Dê um exemplo de uso para cada uma.**

Uma função que retorna string deve devolver um valor textual utilizando return. Esse valor pode ser armazenado em uma variável ou utilizado diretamente.

Exemplo:
```php
function nomeCompleto(): string {
    return "Mariana Silva";
}

echo nomeCompleto();
```

Nesse exemplo, a função retorna a string "Mariana Silva".

Já uma função que retorna void não retorna um valor para ser utilizado pelo programa. Ela normalmente é usada para executar alguma ação, como exibir uma mensagem.

Exemplo:
```php
function exibirMensagem(): void {
    echo "Olá, usuário!";
}

exibirMensagem();
```

Nesse caso, a função apenas executa o echo e não retorna nenhum valor.

**6. Escopo: Por que a função abaixo não consegue acessar $cliente diretamente? Explique duas formas de corrigir o código e indique qual é a mais recomendada.**
```php
$cliente = "Mariana";

function exibirCliente(): string {
    return $cliente;
}
```

A função não consegue acessar $cliente diretamente porque a variável foi criada no escopo global, enquanto a função possui seu próprio escopo local. Variáveis criadas fora de uma função não ficam disponíveis dentro dela automaticamente.

Uma primeira forma de corrigir é utilizar a palavra-chave global:
```php
$cliente = "Mariana";

function exibirCliente(): string {
    global $cliente;
    return $cliente;
}

echo exibirCliente();

Outra forma, e a mais recomendada, é passar a variável como parâmetro da função:

$cliente = "Mariana";

function exibirCliente(string $cliente): string {
    return $cliente;
}

echo exibirCliente($cliente);
```

A segunda forma é mais recomendada porque deixa a função independente de uma variável global, tornando o código mais organizado, reutilizável e fácil de testar.

**7. Referência: O que muda quando um parâmetro é declarado como float &$valor? Explique a diferença entre alterar uma cópia e alterar a variável original.**

Quando utilizamos & antes do parâmetro, como em float &$valor, o parâmetro é passado por referência. Isso significa que a função trabalha diretamente com a variável original.

Sem o &, normalmente a função trabalha com uma cópia do valor:
```php
function aumentar(float $valor): void {
    $valor += 10;
}

$preco = 100;
aumentar($preco);

echo $preco; // 100

Nesse caso, $preco continua valendo 100, porque a alteração aconteceu apenas na cópia recebida pela função.

Com &, a alteração é feita na variável original:

function aumentar(float &$valor): void {
    $valor += 10;
}

$preco = 100;
aumentar($preco);

echo $preco; // 110
```

Nesse exemplo, $preco passa a valer 110, pois a função modificou diretamente a variável original.

**8. Funções nativas: Escolha cinco funções da tabela deste material e descreva: categoria, finalidade, parâmetros principais e valor retornado.**

Como a tabela do material não foi enviada junto com as questões, vou utilizar cinco funções nativas comuns do PHP como exemplo.

1. strlen()
Categoria: Strings.

Finalidade: Retornar a quantidade de caracteres de uma string.

Parâmetro principal: Uma string.

Valor retornado: Um int representando a quantidade de caracteres.

Exemplo:
```php
$nome = "Mariana";
echo strlen($nome); // 7
```

2. strtoupper()
Categoria: Strings.

Finalidade: Converter uma string para letras maiúsculas.

Parâmetro principal: Uma string.

Valor retornado: Uma string em letras maiúsculas.

Exemplo:
```php
echo strtoupper("mariana"); // MARIANA
```

3. strtolower()
Categoria: Strings.

Finalidade: Converter uma string para letras minúsculas.

Parâmetro principal: Uma string.

Valor retornado: Uma string em letras minúsculas.

Exemplo:
```php
echo strtolower("MARIANA"); // mariana
```

4. count()
Categoria: Arrays/contagem.
Finalidade: Contar a quantidade de elementos de um array.
Parâmetro principal: Um array ou objeto contável.
Valor retornado: Um int com a quantidade de elementos.
Exemplo:
```php
$clientes = ["Mariana", "João", "Carlos"];

echo count($clientes); // 3
```

5. is_numeric()
Categoria: Verificação de tipos/valores.

Finalidade: Verificar se um valor é numérico ou pode ser interpretado como número.

Parâmetro principal: O valor que será verificado.

Valor retornado: Um bool, sendo true quando o valor é numérico e false quando não é.

Exemplo:
```php
$valor = "100";

var_dump(is_numeric($valor)); // bool(true)
``` 

**9.Previsão de saída: Qual será o resultado exibido pelo código abaixo? Explique o motivo.**

```php
function aplicarDesconto(float $preco): float {
    return $preco * 0.90;
}

$valor = 100.00;
echo aplicarDesconto($valor);
echo $valor;

O resultado exibido será:

90
100
``` 

A função *aplicarDesconto()* recebe o valor 100.00 e multiplica por 0.90, resultando em 90.

Porém, a função não altera a variável *$valor* original. O parâmetro *$preco* recebe o valor de *$valor* e a função retorna apenas o resultado do cálculo.

Por isso:
```php
echo aplicarDesconto($valor);

exibe:

90

E:

echo $valor;

continua exibindo:

100
```

Como não existe espaço ou quebra de linha entre os dois echo, na tela, o resultado real será 90100.

Se fosse utilizado:
```php
echo aplicarDesconto($valor);
echo "<br>";
echo $valor;
```

o resultado seria:

90
100

**10.Documentação: Pesquise na documentação oficial do PHP a função strlen() e anote sua sintaxe, o parâmetro recebido e o tipo de retorno.**

De acordo com a documentação oficial do PHP, a função strlen() retorna o comprimento de uma string em bytes. Sua sintaxe é:

strlen(string $string): int

Função: strlen()

Sintaxe: strlen(string $string): int

Parâmetro recebido: $string, que deve ser uma string.

Tipo de retorno: int.

Finalidade: Retornar o tamanho da string em bytes.

Exemplo:
```php
$texto = "Olá";
echo strlen($texto);
```
A função retorna um número inteiro correspondente ao tamanho da string em bytes. Para textos com caracteres acentuados ou outros caracteres multibyte, o resultado pode ser diferente da quantidade de caracteres visíveis.



**Parte B: Exercícios práticos**

- Para cada exercício, crie um arquivo PHP com declare(strict_types=1);. Sempre que possível, faça a função retornar um valor e deixe o echo apenas para a apresentação do resultado.

Exercício 1: Calculadora de IMC
Enunciado:

*Crie a função calcularIMC(float $peso, float $altura): float. Ela deve calcular e retornar o IMC usando a fórmula peso / (altura * altura). Teste com pelo menos três combinações de peso e altura e formate o resultado com duas casas decimais.*
```php
<?php

declare(strict_types=1);

function calcularIMC(float $peso, float $altura): float
{
    return $peso / ($altura * $altura);
}

$imc1 = calcularIMC(70.0, 1.75);
$imc2 = calcularIMC(55.0, 1.60);
$imc3 = calcularIMC(90.0, 1.80);

echo "IMC 1: " . number_format($imc1, 2, ',', '.') . PHP_EOL;
echo "IMC 2: " . number_format($imc2, 2, ',', '.') . PHP_EOL;
echo "IMC 3: " . number_format($imc3, 2, ',', '.') . PHP_EOL;
```
Resultado aproximado:

IMC 1: 22,86

IMC 2: 21,48

IMC 3: 27,78

A função realiza apenas o cálculo e retorna o resultado. O echo é utilizado somente para apresentar os valores.

*Exercício 2: Classificação de IMC*
Enunciado:

Crie a função classificarIMC(float $imc): string. Use if / elseif / else para retornar uma classificação:

Menor que 18.5: Abaixo do peso;

De 18.5 até 24.9: Peso normal;

De 25.0 até 29.9: Sobrepeso;

Igual ou maior que 30.0: Obesidade.
```PHP
<?php

declare(strict_types=1);

function classificarIMC(float $imc): string
{
    if ($imc < 18.5) {
        return "Abaixo do peso";
    } elseif ($imc < 25.0) {
        return "Peso normal";
    } elseif ($imc < 30.0) {
        return "Sobrepeso";
    } else {
        return "Obesidade";
    }
}

echo classificarIMC(17.5) . PHP_EOL;
echo classificarIMC(22.5) . PHP_EOL;
echo classificarIMC(27.5) . PHP_EOL;
echo classificarIMC(32.0) . PHP_EOL;
```
Resultado:

Abaixo do peso

Peso normal

Sobrepeso

Obesidade

A função verifica o valor do IMC em sequência e retorna a classificação correspondente.

*Exercício 3: Validador de Senha*

Crie a função senhaForte(string $senha): bool. Ela deve retornar true quando a senha possuir mais de 8 caracteres e false caso contrário. Use strlen() e mostre uma mensagem de acordo com o resultado.
```PHP
<?php

declare(strict_types=1);

function senhaForte(string $senha): bool
{
    return strlen($senha) > 8;
}

$senha = "Senha12345";

if (senhaForte($senha)) {
    echo "A senha é forte." . PHP_EOL;
} else {
    echo "A senha é fraca." . PHP_EOL;
}
```
Nesse exercício, strlen() conta a quantidade de caracteres da senha. Como a condição exige mais de 8 caracteres, uma senha com exatamente 8 caracteres será considerada fraca.

*Exercício 4: Formatador de Nome*

Crie a função formatarNome(string $nome): string. Remova espaços extras com trim(), converta o texto para letras minúsculas com strtolower() e transforme a primeira letra em maiúscula com ucfirst(). Teste com nomes digitados em formatos diferentes.
```PHP
<?php

declare(strict_types=1);

function formatarNome(string $nome): string
{
    $nome = trim($nome);
    $nome = strtolower($nome);
    $nome = ucfirst($nome);

    return $nome;
}

echo formatarNome("  MARIA  ") . PHP_EOL;
echo formatarNome("JOÃO") . PHP_EOL;
echo formatarNome("  pedro  ") . PHP_EOL;
```

Resultado:

Maria

João

Pedro

A função remove os espaços no início e no final, converte o nome para letras minúsculas e depois transforma a primeira letra em maiúscula.

*Exercício 5: Carrinho de Compras*

Crie a função calcularCarrinho(array $produtos): float. Cada produto deve ser um array associativo com nome, preco e quantidade. Use foreach para calcular e retornar o total da compra.
```PHP
$produtos = [
    ["nome" => "Caderno", "preco" => 25.00, "quantidade" => 2],
    ["nome" => "Caneta", "preco" => 3.50, "quantidade" => 4]
];
```
```PHP
<?php

declare(strict_types=1);

function calcularCarrinho(array $produtos): float
{
    $total = 0.0;

    foreach ($produtos as $produto) {
        $total += $produto["preco"] * $produto["quantidade"];
    }

    return $total;
}

$produtos = [
    ["nome" => "Caderno", "preco" => 25.00, "quantidade" => 2],
    ["nome" => "Caneta", "preco" => 3.50, "quantidade" => 4]
];

$total = calcularCarrinho($produtos);

echo "Total da compra: R$ " . number_format($total, 2, ',', '.') . PHP_EOL;
```

Total da compra: R$ 64,00

O caderno custa 2 × 25 = 50 e as canetas custam 4 × 3,50 = 14. Portanto, o total é R$ 64,00.

*Exercício 6: Aplicação de Desconto por Referência*

Crie a função aplicarDesconto(float &$preco, float $porcentagem): void. Altere o preço original usando referência. Teste com um produto de R$ 200,00 e desconto de 15%, exibindo o valor antes e depois da chamada.
```PHP
<?php

declare(strict_types=1);

function aplicarDesconto(float &$preco, float $porcentagem): void
{
    $preco -= $preco * ($porcentagem / 100);
}

$preco = 200.00;

echo "Preço antes do desconto: R$ " . number_format($preco, 2, ',', '.') . PHP_EOL;

aplicarDesconto($preco, 15);

echo "Preço depois do desconto: R$ " . number_format($preco, 2, ',', '.') . PHP_EOL;
```
Resultado:

Preço antes do desconto: R$ 200,00

Preço depois do desconto: R$ 170,00

O & faz com que $preco seja passado por referência. Dessa forma, a função altera diretamente a variável original.

*Exercício 7: Relatório de Notas*

Crie as funções calcularMedia(array $notas): float e verificarAprovacao(float $media): string. Use count() para calcular a média e if / else para retornar Aprovado quando a média for maior ou igual a 7, ou Reprovado caso contrário. Mostre também a maior e a menor nota usando max() e min().
```PHP
<?php

declare(strict_types=1);

function calcularMedia(array $notas): float
{
    return array_sum($notas) / count($notas);
}

function verificarAprovacao(float $media): string
{
    if ($media >= 7.0) {
        return "Aprovado";
    } else {
        return "Reprovado";
    }
}

$notas = [8.0, 7.5, 9.0, 6.5];

$media = calcularMedia($notas);
$situacao = verificarAprovacao($media);
$maiorNota = max($notas);
$menorNota = min($notas);

echo "Média: " . number_format($media, 2, ',', '.') . PHP_EOL;
echo "Situação: " . $situacao . PHP_EOL;
echo "Maior nota: " . number_format($maiorNota, 2, ',', '.') . PHP_EOL;
echo "Menor nota: " . number_format($menorNota, 2, ',', '.') . PHP_EOL;
``` 
Resultado:

Média: 7,75

Situação: Aprovado

Maior nota: 9,00

Menor nota: 6,50

A função calcularMedia() utiliza count() para descobrir a quantidade de notas e array_sum() para obter a soma delas.

*Exercício 8: Limpeza e Formatação de CPF*

Crie a função limparCPF(string $cpf): string usando str_replace() para remover pontos e traço. Depois, crie cpfValido(string $cpf): bool, que deve verificar se o resultado possui exatamente 11 caracteres numéricos. Use strlen() e is_numeric().
```PHP
<?php

declare(strict_types=1);

function limparCPF(string $cpf): string
{
    return str_replace([".", "-"], "", $cpf);
}

function cpfValido(string $cpf): bool
{
    return strlen($cpf) === 11 && is_numeric($cpf);
}

$cpf = "123.456.789-00";

$cpfLimpo = limparCPF($cpf);

echo "CPF original: " . $cpf . PHP_EOL;
echo "CPF limpo: " . $cpfLimpo . PHP_EOL;

if (cpfValido($cpfLimpo)) {
    echo "CPF válido." . PHP_EOL;
} else {
    echo "CPF inválido." . PHP_EOL;
}
```
Resultado:

CPF original: 123.456.789-00

CPF limpo: 12345678900

CPF válido.

A função limparCPF() remove os caracteres . e -. Depois, cpfValido() verifica se o CPF possui exatamente 11 caracteres e se o conteúdo é numérico.

*Exercício 9: Cadastro de Clientes*

Crie a função buscarCliente(array $clientes, string $nome): ?array. Use foreach para procurar um cliente pelo nome e retorne seu array quando encontrá-lo. Se não encontrar, retorne null. Teste os dois cenários.
```PHP
<?php

declare(strict_types=1);

function buscarCliente(array $clientes, string $nome): ?array
{
    foreach ($clientes as $cliente) {
        if ($cliente["nome"] === $nome) {
            return $cliente;
        }
    }

    return null;
}

$clientes = [
    [
        "nome" => "Mariana",
        "idade" => 20,
        "email" => "mariana@email.com"
    ],
    [
        "nome" => "Carlos",
        "idade" => 25,
        "email" => "carlos@email.com"
    ],
    [
        "nome" => "João",
        "idade" => 30,
        "email" => "joao@email.com"
    ]
];

$clienteEncontrado = buscarCliente($clientes, "Mariana");

if ($clienteEncontrado !== null) {
    echo "Cliente encontrado:" . PHP_EOL;
    print_r($clienteEncontrado);
} else {
    echo "Cliente não encontrado." . PHP_EOL;
}

$clienteNaoEncontrado = buscarCliente($clientes, "Pedro");

if ($clienteNaoEncontrado !== null) {
    echo "Cliente encontrado:" . PHP_EOL;
    print_r($clienteNaoEncontrado);
} else {
    echo "Cliente não encontrado." . PHP_EOL;
}
```
Resultado:

O primeiro teste encontra Mariana e retorna seu array. O segundo teste procura por Pedro, que não está cadastrado, então a função retorna null.

O ?array significa que a função pode retornar um array ou null.

*Exercício 10: Controle de Estoque*

Crie a função retirarEstoque(array &$produto, int $quantidade): bool.

Use referência para atualizar o estoque original. Retorne true quando houver estoque suficiente e false quando a quantidade solicitada for inválida ou maior que o estoque. Teste uma retirada permitida e uma retirada recusada.
```PHP
<?php

declare(strict_types=1);

function retirarEstoque(array &$produto, int $quantidade): bool
{
    if ($quantidade <= 0 || $quantidade > $produto["estoque"]) {
        return false;
    }

    $produto["estoque"] -= $quantidade;

    return true;
}

$produto = [
    "nome" => "Caderno",
    "preco" => 25.00,
    "estoque" => 10
];

$quantidade = 3;

if (retirarEstoque($produto, $quantidade)) {
    echo "Retirada realizada com sucesso." . PHP_EOL;
    echo "Estoque atual: " . $produto["estoque"] . PHP_EOL;
} else {
    echo "Não foi possível realizar a retirada." . PHP_EOL;
}

$quantidade = 20;

if (retirarEstoque($produto, $quantidade)) {
    echo "Retirada realizada com sucesso." . PHP_EOL;
    echo "Estoque atual: " . $produto["estoque"] . PHP_EOL;
} else {
    echo "Não foi possível realizar a retirada." . PHP_EOL;
}
```
Resultado:

Retirada realizada com sucesso.

Estoque atual: 7

Não foi possível realizar a retirada.

A função recebe *$produto* por referência usando &. Assim, quando o estoque é reduzido, o array original também é atualizado.

A função retorna false quando a quantidade é menor ou igual a zero ou quando a quantidade solicitada é maior que o estoque disponível.





