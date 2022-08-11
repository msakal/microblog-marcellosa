# microblog-marcellosa
 MicroBlog

# Lorem para fotos (api)
- https://loremipsum.io/

# Atualização pasta COMPOSER
- Sempre que criar um namespace, colocar sua referencia dentro do arquivo 'composer.json' e depois na linha de comando executar o comando 'composer dump-autoload'.

- Executar no terminal 'composer' para atualização da pasta /vendor.

# ARRAY SUPER GLOBAL
 - $_GET[] -> acesso da página
 - $_POST[] -> acesso do formulário
 - $SESSION[] -> acesso da sessão (global)

 1) instalação
- composer require twbs/bootstrap:5.2.0-beta1

2) desinstalação
dentro do arquivo composer.json, excluir:

,
    "require": {
        "twbs/bootstrap": "5.2.0-beta1"
    }
- depois executar o comando abaixo:
    - composer remove twbs/bootstrap:5.2.0-beta1