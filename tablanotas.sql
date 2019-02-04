create table notas_alumnos (Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
asignatura VARCHAR(45) NOT NULL ,
nota DECIMAL(4, 2) NOT NULL ,
curso CHAR(10) NOT NULL ,
alumno VARCHAR(50) NOT NULL
)DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

insert into notas_alumnos values(null,'Lengua', '4.00', 'ESO2', 'Luis Pérez Sanchez'),
(null, 'Matemáticas', '4.5', 'ESO1', 'Ana López López'),
(null, 'Matemáticas', '7.00', 'ESO1', 'Sandra Sol Ruiz'),
(null, 'Matemáticas', '3.00', 'ESO2', 'Felipe Gómez López'),
(null, 'Lengua', '8.00', 'ESO2', 'Juan Ruiz Ruiz'),
(null, 'Lengua', '5.00', 'ESO1', 'María Ruiz Ruiz');