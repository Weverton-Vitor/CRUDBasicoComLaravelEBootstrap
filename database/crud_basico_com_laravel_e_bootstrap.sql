CREATE SCHEMA crud_basico_com_laravel_e_bootstrap;

USE crud_basico_com_laravel_e_bootstrap;

CREATE TABLE tipos(	
    id int PRIMARY KEY AUTO_INCREMENT,
    nome varchar(60)
);

CREATE TABLE alimentos(
    id int PRIMARY KEY AUTO_INCREMENT,
    nome varchar(60) NOT NULL,
    preco float(11) NOT NULL,    
    marca varchar(60) NOT NULL,
    imagem text,
    tipo_id int,
    data_fabricacao DATE NOT NULL,
    data_validade DATE NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT produto_tipo FOREIGN KEY(tipo_id) REFERENCES tipos(id)
);

INSERT INTO tipos(nome) VALUES('Industrializado');
INSERT INTO tipos(nome) VALUES('Orgânico');
INSERT INTO tipos(nome) VALUES('Artesanal');


