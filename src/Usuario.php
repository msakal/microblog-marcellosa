<?php
namespace Microblog;
use PDO,FFI\Exception;

final class Usuario {
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $tipo;
    private PDO $conexao;

    // Principal caracteristica do __construct, utilização na criação do objeto
    public function __construct()
    {
        $this->conexao = Banco::conecta();
    }

    // Listar usuários
    public function listar():array {
        $sql = "SELECT id, nome, email, tipo 
        FROM usuarios ORDER BY nome";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }  catch (Exception $erro) {
            die("ERRO: ".$erro->getMessage());
        }
        return $resultado;
    }

    public function inserir():void {
        $sql = "INSERT INTO usuarios(nome, email, senha, tipo)
        VALUES(:nome, :email, :senha, :tipo)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $consulta->bindParam(':email', $this->email, PDO::PARAM_STR);
            $consulta->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            $consulta->bindParam(':tipo', $this->tipo, PDO::PARAM_STR);
            $consulta->execute();
        }  catch (Exception $erro) {
            die("ERRO: ".$erro->getMessage());
        }
    }

    // consistência da senha
    public function codificaSenha(string $senha):string {
        return password_hash($senha, PASSWORD_DEFAULT);
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


    // email
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
    }


    // senha
    public function getSenha(): string
    {
        return $this->senha;
    }
    public function setSenha(string $senha)
    {
        $this->senha = filter_var($senha, FILTER_SANITIZE_SPECIAL_CHARS);
    }


    // tipo
    public function getTipo(): string
    {
        return $this->tipo;
    }
    public function setTipo(string $tipo)
    {
        $this->tipo = filter_var($tipo, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}