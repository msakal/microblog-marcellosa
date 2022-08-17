<?php

use Microblog\Utilitarios;

require_once "inc/cabecalho.php";

$OBJnoticia->setCategoriaId($_GET['id']);
$dados = $OBJnoticia->listarPorCategoria();



// Utilitarios::dump($dados);

?>


<div class="row my-1 mx-md-n1">

    <article class="col-12">
        
        <?php if ( count($dados) > 0 ) { ?>
            <h2 class=" ">Notícias sobre <span class="badge bg-primary"><?=$dados[0]['categoria']?></span> </h2>
        <?php } else { ?>
            <h2 class="alert alert-warning text-center">Não tem notícias desta categoria</h2>
        <?php }
        ?>

        <div class="row my-1">
            <div class="col-12 px-md-1">
                <div class="list-group">
                    
                    <?php foreach ($dados as $noticia) { ?>

                        <a href="noticia.php?id=<?=$noticia['id']?>" class="list-group-item list-group-item-action">
                            <h3 class="fs-6"><?=$noticia['titulo']?></h3>
                            <p><time><?=Utilitarios::formataData($noticia['data'])?></time> - 
                            
                            <?php
                            if ( $noticia['autor'] ) {
									?><td><?=$noticia['autor']?></td> <?php
								} else {
									?> <td>Equipe Microblog</td> <?php
								}
                            ?>
                            
                            <p><?=$noticia['resumo']?></p>
                        </a>
                    
                    <?php } ?>
                </div>
            </div>
        </div>


    </article>
    

</div>        
        
<?php include_once "inc/todas.php"; ?>       

<?php 
require_once "inc/rodape.php";
?>

