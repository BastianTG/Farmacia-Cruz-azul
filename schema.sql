-- 1. Creación de la base de datos
CREATE DATABASE IF NOT EXISTS farmacia_db;
USE farmacia_db;

-- 2. Creación de la tabla de productos
-- Se definen los tipos de datos según la naturaleza de la información 
CREATE TABLE IF NOT EXISTS productos (
    id INT NOT NULL,                  -- ID del Producto 
    producto VARCHAR(100) NOT NULL,    -- Nombre del Producto 
    descripcion TEXT,                 -- Descripción del Producto 
    cantidad INT NOT NULL,            -- Cantidad en stock 
    precio_unitario DECIMAL(10, 2),   -- Precio unitario con decimales 
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Control interno
    PRIMARY KEY (id)
);

-- 3. Configuración de seguridad y acceso (Punto 52) 
-- Reemplaza '10.0.1.%' por el rango de tu subred pública donde está el servidor WEB [cite: 32, 50]
CREATE USER IF NOT EXISTS 'admin_farmacia'@'10.0.1.40' IDENTIFIED BY 'farm1234';
GRANT ALL PRIVILEGES ON farmacia_db.* TO 'admin_farmacia'@'10.0.1.40';
FLUSH PRIVILEGES;