DROP DATABASE IF EXISTS fontaqua;
CREATE DATABASE IF NOT EXISTS fontaqua
	DEFAULT CHARACTER SET UTF8
    DEFAULT COLLATE UTF8_GENERAL_CI;

USE fontaqua;
DROP TABLE IF EXISTS articulos;
CREATE TABLE IF NOT EXISTS articulos(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    precio FLOAT(10) NOT NULL,
    modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    imagen VARCHAR(50)
) ENGINE=INNODB DEFAULT CHARSET=UTF8 COLLATE=UTF8_GENERAL_CI;

INSERT INTO articulos VALUES
	(NULL, "Tubo de PVC 2 metros", "35.9",  default, "tubopvc.png"),
    (NULL, "Grifo cromado para cocina", "23.5",  default, "grifocromado.jpg");

DROP TABLE IF EXISTS trabajadores;
CREATE TABLE trabajadores (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE,
    telefono CHAR(9),
    direccion VARCHAR(50),
    poblacion VARCHAR(30),
    provincia VARCHAR(30),
    nacionalidad VARCHAR(30),
    dni CHAR(9) UNIQUE,
    fechaNac DATE
) ENGINE=INNODB DEFAULT CHARSET=UTF8 COLLATE=UTF8_GENERAL_CI;

INSERT INTO trabajadores VALUES
	(NULL, "Paco", "González Muñoz", "paco@fontaqua.es", "956787454", "Emperador, 5", "Arcos de la Frontera", "Cádiz", "Española", "12345678A", "1990-05-15"),
    (NULL, "Antonio", "Vera Rodríguez", "antonio@fontaqua.es", "956000054", "Costa Rica, 12", "Arcos de la Frontera", "Cádiz", "Española", "75863188B", "1993-07-25");
    
DROP TABLE IF EXISTS partes;
CREATE TABLE partes (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    obra VARCHAR(50) NOT NULL,
    coste DECIMAL(10,2) NOT NULL,
    ingreso FLOAT(10) NOT NULL,
    provincia VARCHAR(30),
    fechaComienzo DATE NOT NULL,
    fechaFinal DATE NOT NULL,
    trabajador_id INT UNSIGNED NOT NULL,
    observaciones VARCHAR(400),
    FOREIGN KEY (trabajador_id) REFERENCES trabajadores(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=UTF8 COLLATE=UTF8_GENERAL_CI;

INSERT INTO partes VALUES
	(NULL, "Obra en San José del Valle", "Sistema de regado", "15250", "17345", "Cádiz", "2020-01-15",  "2020-02-15", "1", "Obra completada"),
    (NULL, "Obra en Estepona", "Calefacción", "20340", "28765", "Málaga", "2019-12-26",  "2020-02-18", "1", "Obra fatal");
    
DROP TABLE IF EXISTS lineaparte;
CREATE TABLE lineaparte (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    parte_id INT UNSIGNED NOT NULL,
    articulo_id INT UNSIGNED NOT NULL,
    num_linea INT UNSIGNED NOT NULL,
    cantidad INT UNSIGNED NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    importe DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (parte_id) REFERENCES partes(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (articulo_id) REFERENCES articulos(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=UTF8 COLLATE=UTF8_GENERAL_CI;

-- Tabla linea de parte
-- id
-- parte_id
-- num_linea
-- articulo_id
-- cantidad
-- precio
-- importe

