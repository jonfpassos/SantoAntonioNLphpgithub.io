create database bd_santoantonio;
use  bd_santoantonio;



create table tblUser(
    ID_User int primary key unique auto_increment,
    Nome_User varchar(255) not null,
    Usuario_User varchar(255) not null,
    Senha_User varchar(255) not null,
    SuperAdm_User int not null DEFAULT '0'
);


create table tblCategoria(
    ID_Categoria int primary key unique auto_increment,
    Cat_Categoria varchar(255) not null
);



create table tblPosts(
    ID_Posts int primary key unique auto_increment,
    Titulo_Posts varchar(255) not null,
    Subtitulo_Posts varchar(255) not null,
    Postagem_Posts text (2000) not null,
    Imagem_Posts varchar(255),
    Data_Posts varchar(255) not null,
    Categoria_Posts varchar(255) not null,
    ID_Postador varchar(255) not null
);

Create table tblComentario(
    ID_Comentario int primary key unique auto_increment,
    ID_PostComenterio int unique,
);


/* Inserts*/
INSERT INTO tbluser (`ID_User`, `Nome_User`, `Usuario_User`, `Senha_User`, `SuperAdm_User`) VALUES (NULL, 'Jonathan F. Passos', 'jonathanfp', 'J!06f05P99', '1');
INSERT INTO tblcategoria (`ID_Categoria`, `Cat_Categoria`) VALUES (NULL, 'Missas'), (NULL, 'Textos');