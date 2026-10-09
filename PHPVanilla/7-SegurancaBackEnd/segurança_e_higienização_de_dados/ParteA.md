# Segurança Web — OWASP e XSS

## Conceituação OWASP

**XSS** significa **Cross-Site Scripting**. É uma vulnerabilidade que permite que um atacante faça código, geralmente JavaScript, ser executado no navegador de outra pessoa dentro do contexto de um site confiável.

Ela é considerada uma vulnerabilidade do lado do cliente (*Client-Side*) porque o código malicioso é executado no navegador da vítima. Porém, o **Back-End deve ajudar a prevenir o XSS**, principalmente tratando e validando os dados recebidos e realizando a codificação correta dos dados antes de enviá-los para o navegador.

---

## 1. Reflected vs Stored

A diferença está principalmente na forma como o código malicioso é armazenado e entregue à vítima.

### XSS Refletido (*Reflected XSS*)

O código malicioso é enviado em uma requisição, por exemplo, através de uma URL ou formulário, e o servidor devolve esse conteúdo na resposta sem realizar o tratamento adequado.

O ataque normalmente precisa fazer com que a vítima acesse uma página ou link preparado pelo atacante.

### XSS Gravado (*Stored XSS*)

O código malicioso é enviado para o sistema e fica **armazenado no servidor**, por exemplo, em um banco de dados, comentário, cadastro ou mensagem.

Quando outros usuários acessam a página que exibe esse conteúdo sem a devida proteção, o código pode ser executado no navegador deles.

O **Stored XSS possui potencial de impacto maior em muitos cenários**, porque o conteúdo malicioso pode permanecer armazenado e atingir vários usuários que acessarem a área afetada. O impacto real depende do contexto da aplicação e das permissões dos usuários atingidos.

---

## 2. Mecanismo de Escapamento

A função `htmlspecialchars()` transforma determinados caracteres especiais do HTML em **entidades HTML**, fazendo com que sejam interpretados como texto em vez de marcação HTML.

Por exemplo:

```php
$texto = "<script>alert('teste')</script>";

echo htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
```

O trecho:

```html
<
```

é transformado em:

```html
&lt;
```

E o caractere:

```html
>
```

é transformado em:

```html
&gt;
```

Assim, o navegador recebe algo equivalente a:

```html
&lt;script&gt;alert('teste')&lt;/script&gt;
```

O navegador interpreta `&lt;` como o símbolo `<` **visualmente**, mas ele não volta a interpretar esse caractere como o início de uma tag HTML durante o processamento daquele conteúdo.

Por isso, em vez de executar um elemento como `<script>`, o navegador apresenta o conteúdo como texto.

Uma forma recomendada de utilizar a função é:

```php
htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
```

---

## 3. Flags de Proteção

A flag `ENT_QUOTES` faz com que a função `htmlspecialchars()` também converta **aspas simples (`'`) e aspas duplas (`"`)**.

Exemplo:

```php
$nome = '" onclick="alert(1)';
echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
```

Isso é especialmente importante quando o valor está sendo colocado dentro de atributos HTML.

Por exemplo:

```html
<input type="text" value="<?php echo $nome; ?>">
```

Se as aspas não forem tratadas corretamente, um valor malicioso pode tentar **fechar o atributo `value` e adicionar outros atributos HTML**.

Por isso, ao inserir dados fornecidos pelo usuário dentro de atributos HTML, é importante utilizar:

```php
htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
```

---

## 4. Anti-Alucinação PHP

Não devemos utilizar `FILTER_SANITIZE_STRING` em projetos modernos com **PHP 8.3** porque esse filtro foi **depreciado no PHP 8.1** e removido nas versões posteriores do PHP.

Além disso, sanitizar uma string de forma genérica não é uma solução adequada para todos os contextos de segurança.

Em vez disso, devemos utilizar técnicas apropriadas para cada situação.

Por exemplo, para exibir um valor com segurança dentro de HTML:

```php
echo htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
```

Para validar um e-mail:

```php
filter_var($email, FILTER_VALIDATE_EMAIL);
```

A regra importante é utilizar **validação para verificar se o dado atende ao formato esperado** e **codificação de saída adequada ao contexto em que o dado será utilizado**.

---

## 5. Validação de E-mail

A função:

```php
empty($email)
```

verifica basicamente se a variável está vazia ou possui um valor considerado vazio pelo PHP.

Ela **não verifica se o conteúdo é um endereço de e-mail válido**.

Por exemplo:

```php
$email = "abc";

if (empty($email)) {
    echo "E-mail vazio";
}
```

Nesse caso, `abc` não está vazio, portanto o `empty()` não identifica que o formato não é um e-mail.

Já:

```php
filter_var($email, FILTER_VALIDATE_EMAIL)
```

verifica se o valor possui um formato reconhecido como endereço de e-mail.

Exemplo:

```php
$email = "usuario@email.com";

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "E-mail válido";
} else {
    echo "E-mail inválido";
}
```

Portanto:

* `empty()` → verifica se o campo possui um valor vazio.
* `FILTER_VALIDATE_EMAIL` → verifica se o valor possui formato de e-mail válido.

Em um formulário, os dois podem ser utilizados para objetivos diferentes.

---

## 6. Roubo de Sessão

Uma vulnerabilidade XSS pode permitir que um atacante execute JavaScript no navegador de um usuário.

Se o sistema armazenar informações importantes de autenticação em cookies que podem ser acessados por JavaScript, um código malicioso poderá tentar acessar esses dados e enviá-los para outro local controlado pelo atacante.

Isso pode permitir o comprometimento da sessão do usuário.

Uma medida importante é utilizar o atributo:

```http
HttpOnly
```

em cookies de sessão.

Com `HttpOnly`, o cookie não pode ser acessado diretamente por JavaScript através de `document.cookie`.

Também é importante utilizar outras proteções, como:

```http
Secure
```

para que o cookie seja enviado somente por HTTPS, e:

```http
SameSite
```

para reduzir determinados tipos de ataques envolvendo envio de cookies entre sites.

Além disso, a aplicação deve prevenir a própria vulnerabilidade XSS utilizando validação adequada e, principalmente, **codificação dos dados na saída**.

---

## 7. Segurança em Camadas

Sanitizar os dados na entrada, por exemplo usando:

```php
strip_tags($valor);
```

não elimina a necessidade de utilizar:

```php
htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
```

na saída.

Isso acontece porque **entrada e saída possuem objetivos diferentes**.

O `strip_tags()` pode remover algumas tags HTML, mas não deve ser considerado uma proteção universal contra XSS. Além disso, o mesmo dado pode ser utilizado posteriormente em diferentes contextos, como HTML, atributo HTML, JavaScript, CSS ou URL.

A codificação deve ser feita de acordo com o **contexto de saída**.

Exemplo para HTML:

```php
echo htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
```

Dessa forma, mesmo que um dado malicioso consiga chegar ao sistema, ele será tratado como conteúdo textual quando for apresentado no HTML.

### Conclusão

A segurança contra XSS deve utilizar **defesa em profundidade**:

1. Validar os dados recebidos.
2. Aplicar regras de negócio adequadas.
3. Não confiar apenas em sanitização.
4. Codificar os dados no momento da saída.
5. Utilizar configurações seguras para cookies, como `HttpOnly`, `Secure` e `SameSite`.
6. Manter PHP e demais componentes atualizados.

A principal regra é: **dados fornecidos pelo usuário nunca devem ser tratados como código confiável.**
