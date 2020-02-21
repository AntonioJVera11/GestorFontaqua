DROP DATABASE IF EXISTS Articulos;
CREATE DATABASE IF NOT EXISTS Articulos;
USE Articulos;

DROP TABLE IF EXISTS Categorias;
CREATE TABLE IF NOT EXISTS Categorias (
	id INT UNSIGNED auto_increment primary key,
    nombre VARCHAR(30),
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS Articulos;
CREATE TABLE IF NOT EXISTS Articulos (
	id INT UNSIGNED auto_increment primary key,
    descripcion VARCHAR(50),
    precio_costo DECIMAL(10,2),
    precio_venta DECIMAL(10,2),
    categoria_id INT UNSIGNED,
    stock INT,
    imagen varchar(50),
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foreign key(categoria_id) REFERENCES Categorias (id)
    ON DELETE SET NULL ON UPDATE CASCADE
);

INSERT INTO Categorias (id, nombre) VALUES 
(1, 'Telefonía'),
(2, 'Imagen'),
(3, 'Sonido'),
(4, 'Portátil'),
(5, 'Sobremesa');

INSERT INTO Articulos (id, descripcion, precio_costo, precio_venta, categoria_id, stock, imagen) VALUES
(1, 'BenQ GW2480E 23.8" LED IPS FullHD', '90.00', '108.12', 2, 10, 'foto-01.jpg');