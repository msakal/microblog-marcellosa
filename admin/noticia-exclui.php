<?php

use Microblog\ControleDeAcesso;
use Microblog\Noticia;

require_once "../vendor/autoload.php";

// Controle,, verificação para NÃO fazer EXCLUSÃO se não tiver logado
$OBJsessao = new ControleDeAcesso;
$OBJsessao->verificaAcesso();

$OBJnoticia = new Noticia;
$OBJnoticia->setId($_GET['id']);
$OBJnoticia->excluir();

header("location:noticias.php");

?>
