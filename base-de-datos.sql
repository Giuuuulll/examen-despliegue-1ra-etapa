CREATE DATABASE IF NOT EXISTS examen_desplieguebd;
USE examen_desplieguebd;

CREATE TABLE iniciodesecion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    telefono VARCHAR(100) NOT NULL,
    pais VARCHAR(100) NOT NULL
);
