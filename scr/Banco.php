<?php

namespace Microblog;

// Indicamos o uso das classes nativas do PHP (ou seja, classes que não fazem parte do nosso namespace).
use PDO, Exception;

abstract class Banco {
    // Propriedades/Atributos de acesso ao servidor de BD
    private static string $servidor = "localhost";
    private static string $usuario = "root";
    private static string $senha = "";
    private static string $banco = "microblog_marcellosa";
    private static PDO $conexao;
    // private static \PDO $conexao; >> Nesse caso com o BARRA (\PDO), não precisa do 'use PDO' (LINHA 4).


    // self permite acessar recursos estaticos da propria classe. (sempre que tiver o 'static')
    // Método de conexão ao banco
    public static function conecta():PDO {
        try {
            self::$conexao = new PDO(
                "mysql:host=".self::$servidor.";
                dbname=".self::$banco.";
                charset=utf8",
                self::$usuario,
                self::$senha
            );
            
            self::$conexao ->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            // echo "Ok!";

        } catch (Exception $erro) {
            die("Deu ruim: ".$erro->getMessage());
        }

        return self::$conexao;

    }
}

// TESTE conexão.. chamada >> (http://localhost/exemplo-php-crud/src/Banco.php) ;;; saída "Ok" (linha 35)
// Banco::conecta();
