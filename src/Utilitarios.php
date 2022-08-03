<?php
namespace Microblog;

abstract class Utilitarios {

    // Retorno chamadas (consulta) - ou dump(array | bool $dados)
    public static function dump($dados) {
        echo "<pre>";
            var_dump($dados);
        echo "</pre>";
    }
}
