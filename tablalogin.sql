CREATE TABLE login (id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,usuario VARCHAR(20) NOT NULL unique,
clave VARCHAR(20) NOT NULL,
nombre VARCHAR(20) NOT NULL,
apellidos VARCHAR(30) NOT NULL,
email VARCHAR(30) NOT NULL,
PRIMARY KEY (id))DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
             
             
    /*Esto es para que funcione el login*/
             Alter table login modify clave varchar(255);
