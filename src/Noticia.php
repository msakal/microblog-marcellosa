<?php
namespace Microblog;
use PDO, FFI\Exception;

final class Noticia {
    private int $id;
    private string $data;
    private string $titulo;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private string $destaque;
    private int $categoriaId;


    /*  Criando uma propriedade do tipo Usuário, ou seja, a partir de uma classe que criamos com o objetivo de reutlizar recursos dela.
        Isso permitirá fazer uma ASSOCIAÇÃO entre classes. */
    public Usuario $usuario;

    private PDO $conexao;

    public function __construct()
    {
        // No momento que o objeto Noticia for instanciado nas páginas, aproveitamos para também instanciar um objeto Ususario e com isso acessar recursos desta classe.
        $this->OBJusuario = new Usuario;

        // Como já temos a conexão feita pela classe Usuario, dessa maneira é reaproveitada.
        // $this->conexao = Banco::conecta();  --> dessa maneira cria encavalamento de conexão
        $this->conexao = $this->OBJusuario->getConexao();
    }

    // inserir
    public function inserir():void {
        $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, destaque, usuario_id, categoria_id)
            VALUES(:titulo, :texto, :resumo, :imagem, :destaque, :usuario_id, :categoria_id)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
            $consulta->bindParam(':texto', $this->texto, PDO::PARAM_STR);
            $consulta->bindParam(':resumo', $this->resumo, PDO::PARAM_STR);
            $consulta->bindParam(':imagem', $this->imagem, PDO::PARAM_STR);
            $consulta->bindParam(':destaque', $this->destaque, PDO::PARAM_STR);
            $consulta->bindParam(':categoria_id', $this->categoriaId, PDO::PARAM_INT);
            
            
            // Acessando o id do Usuário pelo objeto 'Usuario', associação de classes!

            // Aqui, primeiro chamamos o getter de ID a partir do objeto/classe de Usuario. É só depois atribuimos ele ao parâmetro :usuario_id usando para isso o "binValue".
            // Obs: binParam pode ser usado, mas há riscos de erro devido a forma como ele é executado pelo PHP. Por isso, recomenda-se o uso do binValue em situações como essa.
            $consulta->bindValue(':usuario_id', $this->OBJusuario->getId(), PDO::PARAM_INT);
            
            $consulta->execute();
        }  catch (Exception $erro) {
            die("ERRO: ".$erro->getMessage());
        }
    }


    
    // id
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    }


    // titulo
    public function getTitulo(): string
    {
        return $this->titulo;
    }
    public function setTitulo(string $titulo)
    {
        $this->titulo = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);
    }


    // texto
    public function getTexto(): string
    {
        return $this->texto;
    }
    public function setTexto(string $texto)
    {
        $this->texto = filter_var($texto, FILTER_SANITIZE_SPECIAL_CHARS);
    }


    // resumo
    public function getResumo(): string
    {
        return $this->resumo;
    }
    public function setResumo(string $resumo)
    {
        $this->resumo = filter_var($resumo, FILTER_SANITIZE_SPECIAL_CHARS);
    }


    // imagem
    public function getImagem(): string
    {
        return $this->imagem;
    }
    public function setImagem(string $imagem)
    {
        $this->imagem = filter_var($imagem, FILTER_SANITIZE_SPECIAL_CHARS);
    }


    // destaque
    public function getDestaque(): string
    {
        return $this->destaque;
    }
    public function setDestaque(string $destaque)
    {
        $this->destaque = filter_var($destaque, FILTER_SANITIZE_SPECIAL_CHARS);
    }


    // categoria_id
    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }
    public function setCategoriaId(int $categoriaId)
    {
        $this->categoriaId = filter_var($categoriaId, FILTER_SANITIZE_NUMBER_INT);
    }
}