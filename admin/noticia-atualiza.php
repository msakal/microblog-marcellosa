<?php
use Microblog\Categoria;
use Microblog\Noticia;
use Microblog\Utilitarios;

require_once "../inc/cabecalho-admin.php";

$OBJcategoria = new Categoria;
$listaDeCategorias = $OBJcategoria->listar();

$OBJnoticia = new Noticia;
$OBJnoticia->setId($_GET['id']);
$OBJnoticia->OBJusuario->setId($_SESSION['id']);
$OBJnoticia->OBJusuario->setTipo($_SESSION['tipo']);
$dados = $OBJnoticia->listarUm();

// Utilitarios::dump($dados);

if( isset ($_POST['atualizar'])) {
	
	$OBJnoticia->setTitulo($_POST['titulo']);
	$OBJnoticia->setTexto($_POST['texto']);
	$OBJnoticia->setResumo($_POST['resumo']);
	$OBJnoticia->setDestaque($_POST['destaque']);
	$OBJnoticia->setCategoriaId($_POST['categoria']);

	// Lógica/Algoritmo para atualizar a foto se necessário
    // Se campo imagem estiver vazio, então significa que o usuário NÃO QUER TROCAR IMAGEM. Mantem a imagem existente.
    if ( empty($_FILES['imagem']['name']) ) {
        $OBJnoticia->setImagem($_POST['imagem-existente']);
    } else {
        // Senão, então pegamos a referência (nome e extensão) da nova imagem e fazemos o processo de upload e envio desta referência para o objeto (usando o setter).
        $OBJnoticia->upload(($_FILES['imagem']));
        $OBJnoticia->setImagem($_FILES['imagem']['name']);
    }

	$OBJnoticia->atualizar();
	header("location:noticias.php");

	// Utilitarios::dump($imagem);
}

?>


<div class="row">
    <article class="col-12 bg-white rounded shadow my-1 py-4">

        <h2 class="text-center">
            Atualizar dados da notícia
        </h2>

        <form enctype="multipart/form-data" class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

            <div class="mb-3">
                <label class="form-label" for="categoria">Categoria:</label>
                <select class="form-select" name="categoria" id="categoria" required>
                <option value=""></option>

                    <?php foreach($listaDeCategorias as $categoria) { ?>
						<option 
                            <?php if ( $dados['categoria_id'] === $categoria['id'] ) echo " selected "?>
                            value="<?=$categoria['id']?>"><?=$categoria['nome']?>
                        </option>
					<?php }	?>

                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="titulo">Título:</label>
                <input class="form-control" required type="text" id="titulo" name="titulo"  value="<?=$dados['titulo']?>">
            </div>

            <div class="mb-3">
                <label class="form-label" for="texto">Texto:</label>
                <textarea class="form-control" required name="texto" id="texto" cols="50" rows="6"><?=$dados['texto']?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" for="resumo">Resumo (máximo de 300 caracteres):</label>
                <span id="maximo" class="badge bg-danger">0</span>
                <textarea class="form-control" required name="resumo" id="resumo" cols="50" rows="2" maxlength="300"><?=$dados['resumo']?></textarea>
            </div>

            <div class="mb-3">
                <label for="imagem-existente" class="form-label">Imagem da notícia:</label>
                <!-- campo somente leitura, meramente informativo -->
                <input value="<?=$dados['imagem']?>" class="form-control" type="text" id="imagem-existente" name="imagem-existente" readonly>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Caso queira mudar, selecione outra imagem:</label>
                <input class="form-control" type="file" id="imagem" name="imagem" accept="image/png, image/jpeg, image/gif, image/svg+xml">
            </div>

            <div class="mb-3">
                <p>Deixar a notícia em destaque?
                    <input type="radio" class="btn-check" name="destaque" id="nao" autocomplete="off" 
                        <?php if( $dados['destaque'] === 'nao') echo ' checked ' ?>
                    value="nao">
                    <label class="btn btn-outline-danger" for="nao">Não</label>

                    <input type="radio" class="btn-check" name="destaque" id="sim" autocomplete="off"
                        <?php if( $dados['destaque'] === 'sim') echo ' checked ' ?>
                    value="sim">
                    <label class="btn btn-outline-success" for="sim">Sim</label>
                </p>
            </div>

            <button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
        </form>

    </article>
</div>


<?php
require_once "../inc/rodape-admin.php";
?>