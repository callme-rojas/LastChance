CREATE DATABASE relojeria;

USE relojeria;

CREATE TABLE relojes (
id INT(11) NOT NULL AUTO_INCREMENT,
marca VARCHAR(100) NOT NULL,
modelo VARCHAR(100) NOT NULL,
material_caja VARCHAR(50) NOT NULL,
material_correa VARCHAR(50) NOT NULL,
precio DECIMAL(10, 2) NOT NULL,
descripcion TEXT,
PRIMARY KEY (id)
);