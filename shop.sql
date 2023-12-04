CREATE DATABASE asirappshop;

CREATE USER 'asirappshop'@'localhost' IDENTIFIED BY 'abc123.'; -- Crea el usuario sin contraseña

GRANT ALL PRIVILEGES ON *.* TO 'asirappshop'@'localhost' WITH GRANT OPTION;

USE asirappshop;

-- Creación de la tabla USUARIOS
CREATE TABLE USUARIOS (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100),
    password VARCHAR(100),
    nombre VARCHAR(50),
    apellidos VARCHAR(50),
    direccion VARCHAR(100),
    telefono VARCHAR(20),
    admin BOOLEAN,
    online BOOLEAN
);

-- Creación de la tabla PRODUCTOS
CREATE TABLE PRODUCTOS (
    idProducto INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(50)
);

-- Creación de la tabla ESTADOS
CREATE TABLE ESTADOS (
    idEstado INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(50)
);

-- Creación de la tabla PEDIDOS
CREATE TABLE PEDIDOS (
    idPedido INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT,
    fecha DATE,
    total DECIMAL(10, 2),
    FOREIGN KEY (idUsuario) REFERENCES USUARIOS(idUsuario)
);

-- Creación de la tabla DETALLESPEDIDOS
CREATE TABLE DETALLESPEDIDOS (
    idDetallePedido INT AUTO_INCREMENT PRIMARY KEY,
    idPedido INT,
    idProducto INT,
    cantidad INT,
    precio DECIMAL(10, 2),
    FOREIGN KEY (idPedido) REFERENCES PEDIDOS(idPedido),
    FOREIGN KEY (idProducto) REFERENCES PRODUCTOS(idProducto)
);
