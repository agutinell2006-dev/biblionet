CREATE DATABASE biblionet;
USE biblionet;
 
CREATE TABLE datos(
	id INT AUTO_INCREMENT PRIMARY KEY,
	usuarios VARCHAR(20),
	contrasena VARCHAR(255),
	contrasena2 VARCHAR(255),
	correo VARCHAR(30),
	rol VARCHAR(50),
	token VARCHAR (255),
	token_temporal DATETIME NULL
 
);                        	
CREATE TABLE productos (
	id INT AUTO_INCREMENT PRIMARY KEY,
	imagen VARCHAR(30),
	nombre VARCHAR(30),
	descripcion VARCHAR(520),
	precio INT,
	autor VARCHAR (35),
	categoria ENUM('Web', 'Sistemas', 'Redes')
);
CREATE TABLE comentarios (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(50),
	comentario TEXT,
	estrellas INT,
	usuario_id INT
);
