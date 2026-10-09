<?php
declare(strict_types=1);

//camada de acesso a dados (DAO) para almoxarifado de peças 
// esta Camada sera um Classe de Conexão usando POO (Programaçãk orientada ao Objeto)

final class PecaDAO { 
    //atributos da classe 
    private PDO $pdo;

    //métodos da classe 
    //construtor -> é o método que permite criar objetos desta classe
    public function __construct(PDO $pdo){
        //ao chamar o construtor estou atribuindo um valor ao atributo declarado anteriormente 
        $this->pdo = $pdo;
    }
    // para criar um obj da classe PecaDAO é necessário já possuir uma conexão estabelecida com o banco de dados, conexão essa criada anteriormente na classe ConexaoBanco 

    // Criar os métodos do CRUD 
    // READ -> listar todas as peças em ordem decrescente 
    public function listarTodos(): array {
        $sql = "SELECT * FROM  pecas_industriais ORDER BY id DESC";
        $stmt = $this->pdo->query ($sql);
        return $stmt-> fetchALL(PDO::FETCH_ASSOC); //criar uma lista de produtos associando os valores aos nomes das colunas do banco de dados 

    }
    

    


}