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

    // Inserir Usuário
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

    // Lista UM Usuário
    public function listarUm():array {
        $sql = "SELECT * FROM usuarios WHERE id = :id";

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

    // Atualização de Usuário
    public function atualizar():void {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, tipo = :tipo
        WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $consulta->bindParam(':email', $this->email, PDO::PARAM_STR);
            $consulta->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            $consulta->bindParam(':tipo', $this->tipo, PDO::PARAM_STR);
            $consulta->execute();
        }  catch (Exception $erro) {
            die("ERRO: ".$erro->getMessage());
        }
    }

    // Exclusão UM Usuário
    public function excluir():void {
        $sql = "DELETE FROM usuarios WHERE id = :id";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
    
    }

    // Verifica existência do e-mail e recupera -> retorna o 'array' ou 'bool' (falso)
    public function buscar():array | bool {
        $sql = "SELECT * FROM usuarios WHERE email = :email";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':email', $this->email, PDO::PARAM_STR);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
        return $resultado;
    }

    // consistência da senha
    public function codificaSenha(string $senha):string {
        return password_hash($senha, PASSWORD_DEFAULT);
    }
    // Verifica senha
    public function verificaSenha(string $senhaFormulario, string $senhaBanco):string {
        
        // Usando a password_verify para COMPARAR as duas senhas: digitada com existente no BD
        if ( password_verify($senhaFormulario, $senhaBanco) ) {
            // Senhas iguais,, então não mude!
            return $senhaBanco;
        } else {
            // Senhas diferentes,, então codifique!
            return $this->codificaSenha($senhaFormulario);
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

    // conexão - Utilizada pela classe Noticia
    public function getConexao(): PDO
    {
        return $this->conexao;
    }
}