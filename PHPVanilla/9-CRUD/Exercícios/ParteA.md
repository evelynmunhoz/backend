# Exercícios Teóricos 

### 1. Definição de CRUD e Correspondência no PostgreSQL
O acrônimo **CRUD** representa as quatro operações fundamentais de persistência de dados em um sistema. No **PostgreSQL**, cada letra corresponde diretamente a um comando do SQL:
* **C (Create):** `INSERT` — Adiciona novos registros à tabela.
* **R (Read):** `SELECT` — Consulta e recupera os dados existentes.
* **U (Update):** `UPDATE` — Modifica dados já existentes em registros específicos.
* **D (Delete):** `DELETE` — Remove registros da tabela.

---

### 2. Anatomia do SQL Injection com Concatenação
O **SQL Injection (SQLi)** ocorre porque a concatenação de strings trata o conteúdo de variáveis (como `$_GET` ou `$_POST`) como **parte do código executável**, e não como dados puros.

Quando o sistema monta a consulta juntando textos (ex: `"SELECT * FROM users WHERE user = '" . $_POST['user'] . "'"`), o interpretador do banco de dados lê tudo como uma única instrução contínua. Se um atacante enviar um valor contendo aspas e comandos lógicos (como `' OR '1'='1`), ele consegue fechar a string original prematuramente e inserir novas cláusulas. O banco de dados não sabe diferenciar o que foi escrito pelo programador do que foi digitado pelo usuário, alterando completamente o fluxo lógico da consulta original.

---

### 3. Mecanismo das Prepared Statements
O envio de uma consulta em duas etapas impede que um texto digitado pelo usuário seja executado como instrução SQL pelo banco porque ele **separa rigidamente o código dos dados**.
* **Etapa de Preparação (`prepare`):** A estrutura da consulta SQL é enviada ao banco de dados com marcadores de posição (como `?` ou `:nome`). O PostgreSQL analisa, compila e otimiza o plano de execução dessa query. Nesse momento, a árvore lógica do comando já está rigidamente definida.
* **Etapa de Execução (`execute`):** Os dados inseridos pelo usuário são enviados separadamente. O banco de dados pega esses valores e os insere diretamente nos espaços reservados, tratando-os **exclusivamente como strings literais ou valores puros**.

Mesmo que o texto do usuário contenha comandos como `DROP TABLE` ou `OR '1'='1'`, o PostgreSQL não tentará reinterpretá-los ou reordenar a estrutura da query, pois a fase de compilação da sintaxe já terminou.

---

### 4. Vantagem dos Marcadores Nomeados (`:sku`, `:preco`)
Em instruções SQL complexas e extensas, os marcadores nomeados superam os pontos de interrogação posicionais (`?`) por dois motivos principais:
* **Legibilidade e Clareza:** Fica imediatamente claro qual dado está associado a cada campo (ex: `:sku` refere-se ao código do produto), facilitando a leitura do código PHP.
* **Independência de Ordem:** Com pontos de interrogação, os parâmetros devem ser passados na ordem exata em que aparecem na query. Se você adicionar ou remover uma coluna no meio da instrução, precisará reordenar manualmente todos os bindings no PHP. Com marcadores nomeados, a ordem do mapeamento no código não importa, tornando a manutenção muito mais segura.

---

### 5. Diferença entre `bindValue()` e `bindParam()`
A principal diferença está no momento em que o valor é lido e associado à consulta:

| Característica | `$stmt->bindValue()` | `$stmt->bindParam()` |
| :--- | :--- | :--- |
| **Passagem** | Passa o **valor** atual da variável (ou um literal). | Passa uma **referência** à variável. |
| **Momento da Avaliação** | O valor é capturado imediatamente no momento em que o método é chamado. | O valor só é lido no momento exato em que `$stmt->execute()` é invocado. |
| **Uso em Loops** | Se a variável mudar depois da chamada, o valor inserido na query não muda. | Permite atualizar o valor da variável dentro de um loop e rodar `execute()` várias vezes sem refazer o bind. |
| **Aceita literais?** | Sim. Ex: `bindValue(':id', 10)`. | Não. Requer obrigatoriamente uma variável. Ex: `bindParam(':id', $id)`. |

---

### 6. Risco de Omitir o Tipo de Dado no `LIMIT` com PDO
Por padrão, se o tipo não for especificado, o PDO trata as variáveis como strings (`PDO::PARAM_STR`).

Em versões ou configurações específicas do PostgreSQL e do modo de emulação do PDO, omitir o tipo em uma cláusula `LIMIT` pode fazer com que o PDO envie o valor entre aspas para o banco (ex: `LIMIT '10'`). O PostgreSQL possui tipagem estrita e **não aceita strings na cláusula LIMIT**, exigindo um número inteiro (`integer`). Isso resulta em um erro de sintaxe SQL ou de incompatibilidade de tipos (`Fatal Error` / `PDOException`), quebrando a execução do script.

---

### 7. Benefício do Padrão DAO (Data Access Object)
O padrão **DAO** centraliza e isola todo o código de manipulação de dados (consultas SQL, conexões, comandos) de uma entidade específica em uma classe dedicada.
* **Princípio de Responsabilidade Única (SOLID):** A camada de negócios (regras de validação, controladores) não precisa saber como o banco de dados funciona ou quais tabelas existem. Ela apenas chama os métodos do DAO. A única responsabilidade do DAO é persistir e recuperar dados.
* **Manutenibilidade:** Se a estrutura de uma tabela mudar, ou se você precisar otimizar uma query específica, você altera apenas o arquivo correspondente ao DAO daquela entidade. O restante da aplicação continua intacto, reduzindo drasticamente o risco de introduzir bugs em outras partes do sistema.

---

### 8. Impacto da Ausência de Cláusula `WHERE` no `UPDATE`
A ausência da cláusula `WHERE` em um comando `UPDATE` é considerada um incidente gravíssimo em ambientes de produção porque faz com que a alteração seja aplicada a **todos os registros de uma tabela** indistintamente.

Isso causa a perda imediata da integridade de dados históricos e operacionais (por exemplo, zerar o saldo de todos os clientes ou mudar o status de todos os pedidos para "cancelado"). Como o comando é executado em lote na velocidade do servidor, reverter esse cenário exige restaurar backups (gerando *downtime* e perda de dados criados entre o último backup e o incidente) ou auditorias complexas em logs de transação, paralisando a operação da empresa.

---

### 9. Impacto da LGPD por Vazamento via SQL Injection
No contexto da **Lei Geral de Proteção de Dados (LGPD - Lei nº 13.709/2018)**, o vazamento de dados de clientes por falha de SQL Injection é interpretado como uma **grave negligência de segurança** (ausência de medidas técnicas adequadas para proteger os dados desde o design do software).

De acordo com o artigo 52 da LGPD, as sanções administrativas aplicadas pela Autoridade Nacional de Proteção de Dados (ANPD) incluem:
* **Advertência:** Com imposição de prazo para adoção de medidas corretivas.
* **Multa Simples:** De até **2% do faturamento** da pessoa jurídica de direito privado, grupo ou conglomerado no Brasil no seu último exercício, limitada, no total, a **R\$ 50.000.000,00 (cinquenta milhões de reais) por infração**.
* **Multa Diária:** Para forçar a resolução do problema de segurança, também limitada ao teto de 50 milhões de reais.
* **Publicização da Infração:** A empresa é obrigada a tornar público o incidente, o que destrói a reputação da marca e a confiança do mercado.
* **Bloqueio ou Eliminação dos Dados:** Suspensão temporária ou exclusão dos dados pessoais a que se refere a infração, inviabilizando a continuidade do negócio.

**Impactos além das multas:** A organização também fica sujeita a processos judiciais de reparação por danos morais e materiais movidos individualmente pelos clientes afetados ou por ações civis públicas.
