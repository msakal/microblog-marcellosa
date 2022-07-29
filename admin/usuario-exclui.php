<?php

    use Microblog\ControleDeAcesso;
    use Microblog\Usuario;
    require_once "../vendor/autoload.php";

    // Controle,, verificação para NÃO fazer EXCLUSÃO se NÃO estiver logado
    $OBJsessao = new ControleDeAcesso;

    $OBJsessao->verificaAcessoAdmin();
    $OBJsessao->verificaAcesso();

    // Criamos um obj para poder acessar os recursos da Classe
    $OBJusuario = new Usuario;  // Não esqueça do autoload e do namespace

    // Obtemos o id da URL eo o passamos para o setter
    $OBJusuario->setId($_GET['id']);

    // Só então executamos o método de exclusão
    $OBJusuario->excluir();

    // Após excluir, redirecionamento a página de lista de usuários
    header("location:usuarios.php");

?>