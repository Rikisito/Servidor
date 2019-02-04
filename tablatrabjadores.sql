CREATE TABLE trabajadores (id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT, dni  VARCHAR(9) UNIQUE NOT NULL,
nombre VARCHAR(50) NOT NULL,
salario INT NOT NULL,
PRIMARY KEY (ID))DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE TELEFONOS (id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT, idTrab INTEGER UNSIGNED NOT NULL,
telefono VARCHAR(9) NOT NULL,
PRIMARY KEY (id),  FOREIGN KEY (idTrab) REFERENCES trabajadores(id), UNIQUE (idTrab,telefono)) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;