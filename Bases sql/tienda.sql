CREATE DATABASE tienda;
use tienda;
CREATE TABLE `tienda`.`usuarios` ( 
    `idUsuario` INT NOT NULL AUTO_INCREMENT ,
    `nombre` VARCHAR(30) NOT NULL ,
    `nombre2` VARCHAR(30) NULL ,
    `apellidoPaterno` VARCHAR(35) NOT NULL ,
    `apellidoMaterno` VARCHAR(35) NOT NULL ,
    `email` VARCHAR(25) NOT NULL ,
    `usuario` VARCHAR(20) NOT NULL ,
    `pass` VARCHAR(25) NOT NULL ,
    `fecha` DATE NOT NULL ,
    `fmodificacion` TIMESTAMP NOT NULL ,
    `activo` CHAR(1) NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`idUsuario`)
);
CREATE TABLE `tienda`.`subir` ( 
    `idSubir` INT NOT NULL AUTO_INCREMENT , 
    `email` VARCHAR(50) NOT NULL ,
    `password` VARCHAR(100) NOT NULL ,
    `fecha_de_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`idSubir`)
) ENGINE = InnoDB;
    
CREATE TABLE `tienda`.`archivos` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `nombreArchivo` VARCHAR(45) NOT NULL ,
    `fmodificacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    `activo` CHAR(1) NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;