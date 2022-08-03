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

}