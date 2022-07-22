<?php
namespace Microblog;

abstract class Utilitarios {

    // Retorno chamadas (consulta)
    public static function dump(array $dados) {
        echo "<pre>";
            var_dump($dados);
        echo "</pre>";
    }
}
