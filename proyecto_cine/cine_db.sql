
CREATE DATABASE IF NOT EXISTS cine_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
DROP USER IF EXISTS 'usuario'@'localhost';

CREATE USER 'usuario'@'localhost' IDENTIFIED BY '';

GRANT ALL PRIVILEGES ON cine_db.* TO 'usuario'@'localhost';


USE cine_db;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
