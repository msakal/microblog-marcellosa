<?php

use Microblog\Usuario;
// use Microblog\Utilitarios;

require_once "../inc/cabecalho-admin.php";

$OBJusuario = new Usuario;
$OBJusuario->setId($_SESSION['id']);
$dados = $OBJusuario->listarUm();

// Utilitarios::dump($dados);

if(isset($_POST['atualizar'])) {
      
	$OBJusuario->setNome($_POST['nome']);

	// Atualiza sessão com os dados alterados
	$_SESSION['nome'] = $OBJusuario->getNome();
	
	$OBJusuario->setEmail($_POST['email']);
	$_SESSION['email'] = $OBJusuario->getEmail();
	$OBJusuario->setTipo($_SESSION['tipo']);
	
	// Consiste senha
	if (empty($_POST['senha'])) {
		$OBJusuario->setSenha( $dados['senha'] );
		// echo $OBJusuario->getSenha(); >> display para verificação ...

	} else {
		// Caso usuário digitou alguma coisa no ccampo senha, precisamos verificar o que foi digitado
		$OBJusuario->setSenha(
			$OBJusuario->verificaSenha( $_POST['senha'], $dados['senha'] )
		);
	}

	$OBJusuario->atualizar();

	header("location:index.php?perfil-atualizado");
}


?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar meus dados
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input class="form-control" type="text" id="nome" name="nome" value="<?=$dados['nome']?>" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input class="form-control" type="email" id="email" name="email" value="<?=$dados['email']?>" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

