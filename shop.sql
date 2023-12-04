DROP DATABASE asirappshop;

CREATE DATABASE asirappshop;

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
    nombre VARCHAR(50),
    introDescripcion VARCHAR(255),
    descripcion VARCHAR(255),
    imagenG VARCHAR(50),
    imagenP VARCHAR(50),
    precio INT, 
    precioOferta INT,
    estado BOOLEAN
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
    total DECIMAL(10, 2),
    fecha DATE,
    idEstado INT,
    FOREIGN KEY (idUsuario) REFERENCES USUARIOS(idUsuario),
    FOREIGN KEY (idEstado) REFERENCES ESTADOS(idEstado)
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

/*

-- Activar borrado en cascada para la tabla PEDIDOS
ALTER TABLE PEDIDOS
ADD CONSTRAINT FK_PEDIDOS_DETALLESPEDIDOS 
    FOREIGN KEY (idPedido) 
    REFERENCES DETALLESPEDIDOS(idPedido) 
    ON DELETE CASCADE;

-- Activar borrado en cascada para la tabla DETALLESPEDIDOS
ALTER TABLE DETALLESPEDIDOS
ADD CONSTRAINT FK_DETALLESPEDIDOS_PEDIDOS 
    FOREIGN KEY (idPedido) 
    REFERENCES PEDIDOS(idPedido) 
    ON DELETE CASCADE;

-- Activar borrado en cascada para la tabla PEDIDOS en relación con USUARIOS
ALTER TABLE PEDIDOS
ADD CONSTRAINT FK_PEDIDOS_USUARIOS
    FOREIGN KEY (idUsuario)
    REFERENCES USUARIOS(idUsuario)
    ON DELETE CASCADE;

-- Activar borrado en cascada para la tabla PEDIDOS en relación con ESTADOS
ALTER TABLE PEDIDOS
ADD CONSTRAINT FK_PEDIDOS_ESTADOS
    FOREIGN KEY (idEstado)
    REFERENCES ESTADOS(idEstado)
    ON DELETE CASCADE;

*/

INSERT INTO PRODUCTOS (nombre, introDescripcion, descripcion, imagenG, imagenP, precio, precioOferta, estado)
VALUES 
('Balón', 'Balón de fútbol clásico', 'Balón de fútbol tamaño estándar para juegos y entrenamientos.', 'ball-g.jpg', 'ball-p.jpg', 20, 18, TRUE),
('Cafetera', 'Cafetera programable', 'Cafetera automática para preparar café con temporizador programable.', 'cafetera-g.jpg', 'cafetera-p.jpg', 50, 42, TRUE),
('Casa de perros', 'Casa de perro resistente', 'Casa para perros de tamaño mediano con techo impermeable y paredes aisladas.', 'caseta-g.jpg', 'caseta-p.jpg', 80, 70, TRUE),
('Escoba', 'Escoba multiusos', 'Escoba con cerdas resistentes para limpieza en interiores y exteriores.', 'escoba-g.jpg', 'escoba-p.jpg', 15, 13, TRUE),
('Estufa', 'Estufa eléctrica', 'Estufa portátil con tres niveles de temperatura para calentar habitaciones pequeñas.', 'estufa-g.jpg', 'estufa-p.jpg', 100, 95, TRUE),
('Motosierra', 'Motosierra de gasolina', 'Motosierra potente para cortar troncos y ramas de árboles grandes.', 'motosierra-g.jpg', 'motosierra-p.jpg', 150, 130, TRUE),
('Silla gaming', 'Silla ergonómica para juegos', 'Silla ajustable para largas horas de juego con soporte lumbar y reposabrazos ajustables.', 'silla-g.jpg', 'silla-p.jpg', 200, 180, TRUE),
('Tocadiscos', 'Tocadiscos vintage', 'Tocadiscos con diseño retro para reproducir vinilos con calidad de sonido superior.', 'tocadiscos-g.jpg', 'tocadiscos-p.jpg', 120, 115, TRUE),
('Ventilador', 'Ventilador de torre', 'Ventilador oscilante de torre para circulación de aire silenciosa en habitaciones pequeñas.', 'ventilador-g.jpg', 'ventilador-p.jpg', 60, 48, TRUE),
('Zapatillas', 'Zapatillas deportivas', 'Zapatillas para correr con amortiguación de alto rendimiento y suela antideslizante.', 'zapatillas-g.jpg', 'zapatillas-p.jpg', 80, 70, TRUE);

INSERT INTO ESTADOS (estado) 
VALUES
('En proceso'),
('Enviado'),
('Entregado'),
('Cancelado');