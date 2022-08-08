<?php

use Microblog\Noticia;
use Microblog\Utilitarios;

require_once "../inc/cabecalho-admin.php";

$OBJnoticia = new Noticia;

// Capturando o id e o tipo do usuário logado e associando estes valores às propriedades do objeto usuario.
$OBJnoticia->OBJusuario->setId($_SESSION['id']);
$OBJnoticia->OBJusuario->setTipo($_SESSION['tipo']);
$listaDeNoticias = $OBJnoticia->listar();

// Utilitarios::dump($listaDeNoticias);

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Notícias <span class="badge bg-dark"><?=count($listaDeNoticias)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="noticia-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova notícia</a>
		</p>
				
		<div class="table-responsive ">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
                        <th>Título</th>
                        <th>Data</th>
                        
						<?php if ( $_SESSION['tipo'] == 'admin' ) { ?> <th>Autor</th>	<?php }	?>

						<th>Destaque</th>
						<th class="text-center" colspan="2">Operações</th>
					</tr>
				</thead>

				<tbody>

				<?php
						foreach ($listaDeNoticias as $noticia) {
					?>
					<tr>
						<td><?=$noticia['titulo']?></td>
						<td><?=Utilitarios::formatData($noticia)?></td>
						
						<?php
							if ( $_SESSION['tipo'] == 'admin' ) {
								if ( $noticia['autor'] ) {
									?><td><?=mb_strimwidth($noticia['autor'], 0, 20, "...")?></td> <?php
								} else {
									?> <td>Equipe Microblog</td> <?php
								}
							}
						?>
						
						<!-- Operador de coalescência Nula: na prática, o valor à esquerda é exibido (desde que ela exista), caso contrário o valor à diretira é exibido -->
						<!-- <?=$noticia['autor'] ?? "<i>Equipe Microblog</i>" ?> -->


						<td><?=$noticia['destaque']?></td>

						<td class="text-center">
							<a class="btn btn-warning" 
							href="noticia-atualiza.php?id=<?=$noticia['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						</td>
						<td>
							<a class="btn btn-danger excluir" 
							href="noticia-exclui.php?id=<?=$noticia['id']?>">
							<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
					</tr>

					<?php
						}
						?>

				</tbody>                
			</table>
	</div>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

