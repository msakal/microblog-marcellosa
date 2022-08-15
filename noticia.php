<?php

use Microblog\Noticia;
use Microblog\Utilitarios;

require_once "inc/cabecalho.php";

$OBJnoticia = new Noticia;
$OBJnoticia->setId($_GET['id']);
$dados = $OBJnoticia->listarDetalhes();

// Utilitarios::dump($dados);
?>


<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <h2><?=$dados['titulo']?></h2>
        <p class="font-weight-light">
            <time><?=Utilitarios::formataData($dados['data'])?></time> - 
            <span><?= $dados['autor'] ?? "<i>Equipe Microblog</i>" ?></span>
        </p>
        <img src="imagem/<?=$dados['imagem']?>" alt="" class="float-start pe-2 img-fluid">
        <p><?= Utilitarios::formataTexto($dados['texto']) ?></p>
    </article>
    

</div>        
        
<?php include_once "inc/todas.php"; ?>       

<?php 
require_once "inc/rodape.php";
?>

