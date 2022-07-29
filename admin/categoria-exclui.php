<?php

use Microblog\ControleDeAcesso;
require_once "../vendor/autoload.php";


// Controle,, verificação para NÃO fazer EXCLUSÃO se não tiver logado
$OBJsessao = new ControleDeAcesso;

$OBJsessao->verificaAcesso();
$OBJsessao->verificaAcessoAdmin();

