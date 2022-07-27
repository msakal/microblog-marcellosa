<?php

    use Microblog\Usuario;
    require_once "../vendor/autoload.php";

    // Criamos um obj para poder acessar os recursos da Classe
    $OBJusuario = new Usuario;  // Não esqueça do autoload e do namespace

    // Obtemos o id da URL eo o passamos para o setter
    $OBJusuario->setId($_GET['id']);

    // Só então executamos o método de exclusão
    $OBJusuario->excluir();

    // Após excluir, redirecionamento a página de lista de usuários
    header("location:usuarios.php");

?>