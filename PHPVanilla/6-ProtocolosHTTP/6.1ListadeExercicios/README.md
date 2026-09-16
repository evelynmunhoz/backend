### Exercícios Teóricos de Fixação

## 1.**Diferença Estrutural:** Explique a diferença física entre onde os dados são anexados em uma requisição GET e em uma requisição POST:

 - A principal diferença está em onde os dados são enviados:

GET: os dados são anexados diretamente à URL da página, depois do `?`, em formato de parâmetros.
Exemplo:`site.com/pagina.php?nome=Evelyn&idade=18`
POST: os dados são enviados no corpo (body) da requisição HTTP, não aparecendo diretamente na URL.

## 2.**Segurança e Privacidade:** Por que senhas de usuário nunca devem ser enviadas via método GET? Cite pelo menos dois locais onde essa senha ficaria gravada de forma insegura:

- Senhas nunca devem ser enviadas por GET, porque os dados ficam expostos na URL e podem ser armazenados em locais que não deveriam conter informações sensíveis.
Pelo menos dois exemplos são:

1- Histórico do navegador: a URL com a senha pode ficar salva no histórico.

2- Logs do servidor: servidores e sistemas de monitoramento podem registrar a URL completa da requisição.
Além disso, a URL pode aparecer em favoritos, ferramentas de análise ou outros registros.
A boa prática é utilizar o método POST junto com HTTPS para proteger os dados durante a transmissão.

*Importante*: usar POST não torna a senha automaticamente segura. Para proteger a senha durante o envio, deve-se utilizar HTTPS.

# 3.**Coalescência Nula:** Por que a instrução $nome = $_POST['nome']; dispara um Warning na primeira vez que a página é carregada no navegador? Como o operador ?? resolve isso?

-  Isso acontece porque a chave $_POST['nome'] ainda não existe quando a página carrega pela primeira vez. Por conta disso, o operador ?? verifica se o valor da variável é null, caso seja, ele atribui um valor vazio("").


## 4.**Idempotência:** O que significa dizer que uma requisição GET é idempotente? Por que atualizar ou deletar dados no banco usando links GET é uma má prática de segurança?

 - Dizer que uma requisição GET é idempotente significa que realizar a mesma requisição várias vezes deve produzir o mesmo efeito no servidor que realizá-la uma única vez. Em outras palavras, uma requisição GET deve apenas consultar informações, sem alterar os dados.

Usar GET para atualizar ou deletar dados é uma má prática porque links podem ser acessados automaticamente, repetidos ou compartilhados. Isso poderia causar uma alteração ou exclusão de dados sem a intenção do usuário.

Exemplo inadequado:

`site.com/deletar.php?id=10`

Ao acessar esse link, o registro poderia ser apagado ou apenas não ser acessado.

 ## 5.**Validação Client vs Server:** Um desenvolvedor júnior afirma que o formulário dele é 100% seguro porque colocou required e type="email" em todas as tags HTML. Explique por que essa afirmação é falsa.

 - A afirmação é falsa porque `required` e `type="email"` são validações feitas no lado do cliente (Client-Side), pelo navegador.

Essas validações podem ser contornadas ou desativadas, e um usuário pode enviar uma requisição diretamente ao servidor sem passar pelas regras do formulário HTML.

Por isso, o servidor também precisa validar os dados recebidos:

$email = $_POST['email'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "E-mail inválido.";
}

Conclusão: a validação no navegador melhora a experiência do usuário, mas a validação no servidor é indispensável para segurança.

## 6.**XSS e Sanitização:** Qual é o risco de exibir dados vindos de um $_POST diretamente na tela sem utilizar htmlspecialchars()?

- Exibir diretamente um valor recebido por $_POST pode permitir um ataque de XSS (Cross-Site Scripting).

Por exemplo, se um usuário enviar código HTML ou JavaScript malicioso e o sistema simplesmente fizer:

`echo $_POST['nome'];`

esse conteúdo pode ser interpretado pelo navegador como código.

Para evitar isso ao exibir texto fornecido pelo usuário, utiliza-se:

echo htmlspecialchars($_POST['nome'] ?? '');


O `htmlspecialchars()` transforma caracteres especiais em entidades HTML, fazendo com que o conteúdo seja exibido como texto, em vez de ser interpretado como código.

## 7.**Sticky Forms:** O que é a técnica de Sticky Forms e qual é o seu impacto na experiência do usuário (UX)?

- Sticky Forms é uma técnica que mantém os dados que o usuário já digitou no formulário quando ocorre algum erro de validação.

Por exemplo, se o usuário preencher nome, e-mail e telefone, mas esquecer um campo obrigatório, o sistema pode mostrar o formulário novamente mantendo os dados que já foram preenchidos.

Exemplo em PHP:

< input type="text" name="nome"
       
       value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">


Impacto na UX: melhora bastante a experiência do usuário, pois ele não precisa preencher novamente todos os campos depois de um erro.

## 8.**DevTools:** Como você utilizaria a aba Network do navegador para comprovar que um formulário foi enviado via POST e não via GET?

- Para verificar se um formulário foi enviado usando POST ou GET, podemos utilizar o DevTools do navegador:

1. Abrir o navegador e pressionar F12.
2. Acessar a aba `Network (Rede)`.
3. Enviar o formulário.
4. Localizar a requisição realizada pelo formulário.
5. Clicar nela e verificar o campo `Request Method`.

Se aparecer:

`Request Method: POST`

significa que o formulário foi enviado usando POST.

Se aparecer:

`Request Method: GET`

significa que foi enviado usando GET.

Também é possível perceber a diferença observando a URL: no GET, os parâmetros normalmente aparecem na URL após ?; no POST, os dados ficam no corpo da requisição (Request Payload/Form Data).






