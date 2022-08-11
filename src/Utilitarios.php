<?php
namespace Microblog;

abstract class Utilitarios {

    // Retorno chamadas (consulta) - ou dump(array | bool $dados)
    public static function dump($dados) {
        echo "<pre>";
            var_dump($dados);
        echo "</pre>";
    }

    public static function formatData($noticia) {
        return date('d/m/Y H:i',strtotime($noticia['data']));
    }

    public static function limitaCaracter($noticia) {
        return mb_strimwidth($noticia['autor'], 0, 25, " ...");
    }
}
