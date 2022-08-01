<?php

use Microblog\Categoria;
use Microblog\Utilitarios;

require_once "../inc/cabecalho-admin.php";

$OBJsessao->verificaAcessoAdmin();

$OBJcategoria = new Categoria;
$listaDeCategorias = $OBJcategoria->listar();

// Utilitarios::dump($listaDeCategorias);

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Categorias <span class="badge bg-dark"><?=count($listaDeCategorias)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="categoria-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova categoria</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>Nome</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($listaDeCategorias as $categorias) { ?>
					<tr>
						<td><?=$categorias['nome']?></td>

						<td class="text-center">
							<a class="btn btn-warning" 
							href="categoria-atualiza.php?id=<?=$categorias['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<a class="btn btn-danger excluir" 
							href="categoria-exclui.php?id=<?=$categorias['id']?>">
							<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
					</tr>
					<?php }	?>
				</tbody>                
			</table>
	    </div>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

