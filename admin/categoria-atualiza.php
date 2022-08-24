<?php
use Microblog\Categoria;
use Microblog\Utilitarios;

require_once "../inc/cabecalho-admin.php";

$OBJsessao->verificaAcessoAdmin();

$OBJcategoria = new Categoria;
$OBJcategoria->setId($_GET['id']);
$dados = $OBJcategoria->listarUm();

// Utilitarios::dump($dados);

if(isset($_POST['atualizar'])) {
      
	$OBJcategoria->setNome($_POST['nome']);

	$OBJcategoria->atualizar();
	header("location:categorias.php?status=sucesso");
}

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar dados da categoria
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" value="<?=$dados['nome']?>" required>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

