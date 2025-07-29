DROP DATABASE IF EXISTS coffee;

CREATE DATABASE coffee CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE coffee;

CREATE TABLE `imagenes` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(255) NOT NULL,
    `contenido` BLOB NOT NULL
);

CREATE TABLE `historia_linaje` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `obtenor` VARCHAR(255) NOT NULL,
    `familia` VARCHAR(255) NOT NULL,
    `grupo` VARCHAR(255) NOT NULL
);

CREATE TABLE `ubicacion` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `departamento` VARCHAR(255) NOT NULL,
    `clima` VARCHAR(255) NOT NULL,
    `suelo` VARCHAR(255) NOT NULL,
    `altitud` VARCHAR(255) NOT NULL,
    `temperatura` VARCHAR(255) NOT NULL,
    `practica_cultivo` VARCHAR(255) NOT NULL
);

CREATE TABLE `tamanho_grano` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tamanho` VARCHAR(255) NOT NULL
);

CREATE TABLE `porte` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `porte` VARCHAR(255) NOT NULL,
    `manejo_cultivo` VARCHAR(255) NOT NULL
);

CREATE TABLE `condiciones` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `genetica` VARCHAR(255) NOT NULL,
    `clima` VARCHAR(255) NOT NULL,
    `suelo` VARCHAR(255) NOT NULL,
    `practicas_cultivo` VARCHAR(255) NOT NULL,
    `temperatura` VARCHAR(255) NOT NULL
);

CREATE TABLE `enfermedades` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(255) NOT NULL,
    `efectos` VARCHAR(255) NOT NULL,
    `gravedad` VARCHAR(255) NOT NULL,
    `tratamiento` VARCHAR(255) NOT NULL
);

CREATE TABLE `densidad` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `porte` BIGINT UNSIGNED NOT NULL,
    `tamanho_grano` BIGINT UNSIGNED NOT NULL,
    `valor_densidad` INT NOT NULL,
    FOREIGN KEY (`porte`) REFERENCES `porte` (`id`),
    FOREIGN KEY (`tamanho_grano`) REFERENCES `tamanho_grano` (`id`)
);

CREATE TABLE `potencial_de_rendimiento` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `potencial` VARCHAR(255) NOT NULL,
    `condicion` BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (`condicion`) REFERENCES `condiciones` (`id`)
);

CREATE TABLE `calidad_grano` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `calidad` VARCHAR(255) NOT NULL,
    `aroma` VARCHAR(255) NOT NULL,
    `sabor` VARCHAR(255) NOT NULL,
    `densidad` BIGINT UNSIGNED NOT NULL,
    `humedad` VARCHAR(255) NOT NULL,
    `tueste` VARCHAR(255) NOT NULL,
    `origen` BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (`densidad`) REFERENCES `densidad` (`id`),
    FOREIGN KEY (`origen`) REFERENCES `ubicacion` (`id`)
);

CREATE TABLE `calidad_altitud` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `ubicacion` BIGINT UNSIGNED NOT NULL,
    `calidad` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`ubicacion`) REFERENCES `ubicacion` (`id`)
);

CREATE TABLE `resistencias` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tipo` VARCHAR(255) NOT NULL,
    `calidad_grano` BIGINT UNSIGNED NOT NULL,
    `enfermedad` BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (`calidad_grano`) REFERENCES `calidad_grano` (`id`),
    FOREIGN KEY (`enfermedad`) REFERENCES `enfermedades` (`id`)
);

CREATE TABLE `datos_agronomicos` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `tiempo_cosecha` VARCHAR(255) NOT NULL,
    `maduracion` VARCHAR(255) NOT NULL,
    `nutricion` VARCHAR(255) NOT NULL,
    `densidad_de_siembra` BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (`densidad_de_siembra`) REFERENCES `densidad` (`id`)
);

CREATE TABLE `variedad` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nombre_comun` VARCHAR(255) NOT NULL,
    `nombre_cientifico` VARCHAR(255) NOT NULL,
    `imagen` BIGINT UNSIGNED NOT NULL,
    `descripcion_general` TEXT NOT NULL,
    `porte` BIGINT UNSIGNED NOT NULL,
    `tamanho_del_grano` BIGINT UNSIGNED NOT NULL,
    `altitud_optima_siembra` DECIMAL(8, 2) NOT NULL,
    `potencial_de_rendimiento` BIGINT UNSIGNED NOT NULL,
    `calidad_grano_altitud` BIGINT UNSIGNED NOT NULL,
    `resistencia` BIGINT UNSIGNED NOT NULL,
    `datos_agronomicos` BIGINT UNSIGNED NOT NULL,
    `historia` BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (`imagen`) REFERENCES `imagenes` (`id`),
    FOREIGN KEY (`porte`) REFERENCES `porte` (`id`),
    FOREIGN KEY (`tamanho_del_grano`) REFERENCES `tamanho_grano` (`id`),
    FOREIGN KEY (`potencial_de_rendimiento`) REFERENCES `potencial_de_rendimiento` (`id`),
    FOREIGN KEY (`calidad_grano_altitud`) REFERENCES `calidad_altitud` (`id`),
    FOREIGN KEY (`resistencia`) REFERENCES `resistencias` (`id`),
    FOREIGN KEY (`datos_agronomicos`) REFERENCES `datos_agronomicos` (`id`),
    FOREIGN KEY (`historia`) REFERENCES `historia_linaje` (`id`)
);

SELECT 'Base de datos con forma de pulpo' as mensaje;