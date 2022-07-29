<?php
namespace Microblog;

final class ControleDeAcesso {

    public function __construct()
    {
        // Se NÃO EXISTIR uma sessão em funcionamento
        if ( !isset($_SESSION) ) {
            // Então iniciamos a sessão
            session_start();
        }
    }

    public function verificaAcesso():void {
        // Se NÃO EXISTIR uma variável de sessão relacinada ao id do usuário logado ..
        if ( !isset($_SESSION['id']) ) {
            // Então significa que o usuário não está logado, portanto apague qualquer resquicio de sessão e force o usuário a ir para login.php
            session_destroy();
            header("location:../login.php?acesso_proibido");
            die();  // exit -> parar TUDO ,,, pode ser usado tanto o "exit" quanto o "die()"
        }
    }

    public function login(int $id, string $nome, string $tipo):void {
        // no momento em que ocorrer o login, adicionamos à sessão variáveis de sessão com os dados necessários para o sistema.
        $_SESSION['id'] = $id;
        $_SESSION['nome'] = $nome;
        $_SESSION['tipo'] = $tipo;
    }

    public function logout():void {
        session_start();
        session_destroy();
        header("location:../login.php?logout");
        die(); // exit
    }

}
