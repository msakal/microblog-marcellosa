<?php

use Microblog\Usuario;
use Microblog\Utilitarios;

require_once "../inc/cabecalho-admin.php";

$OBJsessao->verificaAcessoAdmin();

$OBJusuario = new Usuario;
$OBJusuario->setId($_GET['id']);
$dados = $OBJusuario->listarUm();

// Utilitarios::dump($dados);

if(isset($_POST['atualizar'])) {
      
	$OBJusuario->setNome($_POST['nome']);
	$OBJusuario->setEmail($_POST['email']);
	$OBJusuario->setTipo($_POST['tipo']);
	
	// $OBJusuario->setSenha($_POST['senha']);
	// Algoritimo da senha
	// Se o campo senha no formulário estiver vazio, significa que o usuário NÃO MUDOU A SENHA
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
	header("location:usuarios.php?status=sucesso");
}


?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar dados do usuário
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

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>
				<select class="form-select" name="tipo" id="tipo" required>
					<option value=""></option>
					<option 
						<?php if ($dados['tipo'] == 'editor') echo " selected "?>
					value="editor">Editor</option>
					<option 
						<?php if ($dados['tipo'] == 'admin') echo " selected "?>
					value="admin">Administrador</option>
				</select>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

