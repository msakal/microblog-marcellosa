<?php

use Microblog\Categoria;
use Microblog\ControleDeAcesso;
require_once "../vendor/autoload.php";


// Controle,, verificação para NÃO fazer EXCLUSÃO se não tiver logado
$OBJsessao = new ControleDeAcesso;
$OBJsessao->verificaAcessoAdmin();
$OBJsessao->verificaAcesso();

$OBJcategoria = new Categoria;
$OBJcategoria->setId($_GET['id']);
$OBJcategoria->excluir();

header("location:categorias.php");

?>

