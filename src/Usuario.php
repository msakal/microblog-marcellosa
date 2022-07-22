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

}