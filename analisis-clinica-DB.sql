-- Crear la base de datos
CREATE DATABASE clinica_confident;

-- Usar la base de datos
USE clinica_confident;

-- Crear la tabla "usuarios"
CREATE TABLE usuarios (
    Id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL,
    apellido VARCHAR(60) NOT NULL,
    correo VARCHAR(30) NOT NULL,
    password varchar(60) NOT NULL,
    telefono VARCHAR(12) NOT NULL,
    admin TINYINT(1),
    confirmado TINYINT(1),
    token VARCHAR(16)
);

-- Crear la tabla "servicios"
CREATE TABLE servicios (
    Id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL,
    precio DECIMAL(5,2)
);

-- Crear la tabla "citas"
CREATE TABLE citas (
    Id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    hora TIME,
    usuarioId INT(11),
    FOREIGN KEY (usuarioId) REFERENCES usuarios(Id)
);

-- Crear la tabla "citasServicios"
CREATE TABLE citasServicios (
    Id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    citaId INT(11),
    servicioId INT(11),
    comentarios varchar(250),
    FOREIGN KEY (citaId) REFERENCES citas(Id),
    FOREIGN KEY (servicioId) REFERENCES servicios(Id)
);






INSERT INTO usuarios (nombre, apellido, correo, password, telefono, admin, confirmado, token)
VALUES ('Emanuel', 'Alvarez', 'alvarezema9@gmail.com', 'contraseña_segura', '123456789', 0, 1, 'abcd1234');
