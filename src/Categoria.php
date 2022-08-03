<?php
namespace Microblog;
use PDO,FFI\Exception;

final class Categoria {
    private int $id;
    private string $nome;
    private PDO $conexao;

     // Principal caracteristica do __construct, utilização na criação do objeto
     public function __construct()
     {
         $this->conexao = Banco::conecta();
     }

    //  Listar Categorias
    public function listar():array {
        $sql = "SELECT id, nome FROM categorias ORDER BY nome";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }  catch (Exception $erro) {
            die("ERRO: ".$erro->getMessage());
        }
        return $resultado;
    }

    // Inserir Categoria
    public function inserir():void {
        $sql = "INSERT INTO categorias(nome) VALUES(:nome)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $consulta->execute();
        }  catch (Exception $erro) {
            die("ERRO: ".$erro->getMessage());
        }
    }

    // Listar UMA Categoria
    public function listarUm():array {
        $sql = "SELECT id, nome FROM categorias WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        }  catch (Exception $erro) {
            die("ERRO: ".$erro->getMessage());
        }
        return $resultado;
    }

        // Atualização de Categoria
        public function atualizar():void {
            $sql = "UPDATE categorias SET nome = :nome WHERE id = :id";
    
            try {
                $consulta = $this->conexao->prepare($sql);
                $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
                $consulta->bindParam(':nome', $this->nome, PDO::PARAM_STR);
                $consulta->execute();
            }  catch (Exception $erro) {
                die("ERRO: ".$erro->getMessage());
            }
        }
    
        // Exclusão UMA Categoria
        public function excluir():void {
            $sql = "DELETE FROM categorias WHERE id = :id";
        
            try {
                $consulta = $this->conexao->prepare($sql);
                $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
                $consulta->execute();
            } catch (Exception $erro) {
                die("Erro: ".$erro->getMessage());
            }
        
        }
        

    // id
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    }

    // nome
    public function getNome(): string
    {
        return $this->nome;
    }
    public function setNome(string $nome)
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}