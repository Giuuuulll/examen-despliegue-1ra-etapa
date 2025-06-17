CREATE DATABASE IF NOT EXISTS examen-desplieguebd;
USE examen-desplieguebd;


CREATE TABLE interesados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(100) NOT NULL,
    pais VARCHAR(100) NOT NULL
);
