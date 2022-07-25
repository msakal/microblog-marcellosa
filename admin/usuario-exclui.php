<?php

use Microblog\Usuario;

    require_once "../inc/cabecalho-admin.php";

    $OBJusuario = new Usuario;

    $OBJusuario->setId($_GET['id']);
    $OBJusuario->excluirUsuario();

    header("location:usuarios.php");

?>