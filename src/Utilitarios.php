<?php
namespace Microblog;

abstract class Utilitarios {
    // Retorno chamadas (consulta) - ou dump(array | bool $dados)
    public static function dump($dados) {
        echo "<pre>";
            var_dump($dados);
        echo "</pre>";
    }

    public static function formataData($noticia) {
        return date('d/m/Y H:i',strtotime($noticia));
    }

    public static function limitaCaracter($array) {
        return mb_strimwidth($array, 0, 20, " ...");
    }

    public static function formataTexto(string $texto):string {
        return nl2br($texto);
    }
}
