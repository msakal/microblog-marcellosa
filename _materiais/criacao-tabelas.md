# Criando Tabelas


## Criando DataBase
```sql
CREATE DATABASE microblog_marcellosa CHARACTER SET utf8mb4;
USE DATABASE microblog_marcellosa;
```

### Criar Tabelas
```sql
CREATE TABLE usuarios(
    id SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'editor') NOT NULL
);

CREATE TABLE noticias(
    id MEDIUMINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    data DATETIME NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    texto TEXT NOT NULL,
    resumo TINYTEXT NOT NULL,
    imagem VARCHAR(45) NOT NULL,
    destaque ENUM('sim', 'nao'),
    usuarios_id SMALLINT NOT NULL,
    categorias_id SMALLINT NOT NULL
);

CREATE TABLE categorias(
    id SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL
);
```


### Criação da Chave Estrangeira (FK - relacionamento entre as tabelas)
```sql
ALTER TABLE noticias
    ADD CONSTRAINT fk_noticias_usuarios
    FOREIGN KEY(usuarios_id) REFERENCES usuarios(id)
    ON DELETE SET NULL ON UPDATE NO ACTION;
    

ALTER TABLE noticias
    ADD CONSTRAINT fk_noticias_categorias
    FOREIGN KEY(categorias_id) REFERENCES usuarios(id)
    ON DELETE SET NULL ON UPDATE NO ACTION;

```