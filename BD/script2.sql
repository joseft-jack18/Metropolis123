-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.14-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para ventas
CREATE DATABASE IF NOT EXISTS `ventas` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ventas`;

-- Volcando estructura para tabla ventas.comentario
CREATE TABLE IF NOT EXISTS `comentario` (
  `idComentario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `contacto` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`idComentario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ventas.comentario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
INSERT INTO `comentario` (`idComentario`, `nombre`, `contacto`, `descripcion`, `estado`) VALUES
	(1, 'Carlos', '987654321', 'Cuanto es la cantidad maxima de articulos que puedo pedir?', 'P'),
	(2, 'Yessica', 'yesica@gmail.com', 'Pueden enviarme  a mi casa 3 focos ahoraadores de 42w?', 'R');
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;

-- Volcando estructura para tabla ventas.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `codigo` varchar(6) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `marca` varchar(150) NOT NULL,
  `tipo` char(1) NOT NULL,
  `precioUnitario` double(10,2) NOT NULL DEFAULT 0.00,
  `cantidad` int(11) NOT NULL,
  `estado` char(1) NOT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ventas.producto: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`codigo`, `descripcion`, `marca`, `tipo`, `precioUnitario`, `cantidad`, `estado`, `imagen`) VALUES
	('P00001', 'FOCO AHORRADOR 42W', 'DURILUX', 'L', 7.00, 50, 'D', NULL),
	('P00002', 'CABLE DE LUZ 12 THW', 'ALEPSA', 'C', 150.00, 250, 'D', NULL),
	('P00003', 'CHAPA PERILLA', 'FORTE', 'A', 12.00, 25, 'D', NULL),
	('P00004', 'FOCO AHORRADOR 36W', 'DURILUX', 'L', 7.00, 123, 'D', 'foto.png'),
	('P00005', 'FOCO AHORRADOR 36W', 'DURILUX', 'L', 7.00, 123, 'D', 'foto.png'),
	('P00006', 'FOCO AHORRADOR 36W', 'DURILUX', 'L', 7.00, 123, 'A', 'foto.png'),
	('P00007', 'CABLE MELLIZO 16', 'ALEPSA', 'C', 2.00, 2, 'D', 'P000071601160577953.jpg'),
	('P00008', 'CABLE MELLIZO 16', 'ALEPSA', 'C', 5.00, 7, 'A', 'P000081602108566757.jpg');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

-- Volcando estructura para procedimiento ventas.SP_LISTAR_COMENTARIO
DELIMITER //
CREATE PROCEDURE `SP_LISTAR_COMENTARIO`()
SELECT * FROM comentario//
DELIMITER ;

-- Volcando estructura para procedimiento ventas.SP_LISTAR_PRODUCTO
DELIMITER //
CREATE PROCEDURE `SP_LISTAR_PRODUCTO`()
SELECT * FROM producto//
DELIMITER ;

-- Volcando estructura para procedimiento ventas.SP_LISTAR_USUARIO
DELIMITER //
CREATE PROCEDURE `SP_LISTAR_USUARIO`()
SELECT idUsu, nomUsu, emailUsu, dirUsu, tipUsu, estUsu FROM usuario//
DELIMITER ;

-- Volcando estructura para procedimiento ventas.SP_MODIFICAR_ESTADO_COMENTARIO
DELIMITER //
CREATE PROCEDURE `SP_MODIFICAR_ESTADO_COMENTARIO`(IN COD INT, IN ESTATUS CHAR(1))
UPDATE comentario SET estado = ESTATUS WHERE idComentario = COD//
DELIMITER ;

-- Volcando estructura para procedimiento ventas.SP_MODIFICAR_ESTADO_PRODUCTO
DELIMITER //
CREATE PROCEDURE `SP_MODIFICAR_ESTADO_PRODUCTO`(
	IN `COD` VARCHAR(6),
	IN `ESTATUS` CHAR(1)
)
UPDATE producto SET estado = ESTATUS WHERE codigo = COD//
DELIMITER ;

-- Volcando estructura para procedimiento ventas.SP_MODIFICAR_ESTADO_USUARIO
DELIMITER //
CREATE PROCEDURE `SP_MODIFICAR_ESTADO_USUARIO`(IN ID INT, IN ESTATUS CHAR(1))
UPDATE usuario SET estUsu = ESTATUS WHERE idUsu = ID//
DELIMITER ;

-- Volcando estructura para procedimiento ventas.SP_MODIFICAR_PRODUCTO
DELIMITER //
CREATE PROCEDURE `SP_MODIFICAR_PRODUCTO`(
	IN `COD` VARCHAR(6),
	IN `PRECIO` DOUBLE(10,2),
	IN `CANTIDAD` INT
)
UPDATE producto SET precioUnitario = PRECIO, cantidad = CANTIDAD WHERE codigo = COD//
DELIMITER ;

-- Volcando estructura para procedimiento ventas.SP_MODIFICAR_USUARIO
DELIMITER //
CREATE PROCEDURE `SP_MODIFICAR_USUARIO`(IN ID INT, IN DIRECCION VARCHAR(150), IN EMAIL VARCHAR(50))
UPDATE usuario SET dirUsu = DIRECCION, emailUsu = EMAIL WHERE idUsu = ID//
DELIMITER ;

-- Volcando estructura para procedimiento ventas.SP_REGISTRAR_PRODUCTO
DELIMITER //
CREATE PROCEDURE `SP_REGISTRAR_PRODUCTO`(
	IN `CODIGO` VARCHAR(6),
	IN `DESCRIPCION` VARCHAR(250),
	IN `MARCA` VARCHAR(150),
	IN `TIPO` CHAR(1),
	IN `PRECIO` DOUBLE(10,2),
	IN `CANTIDAD` INT,
	IN `FOTO` VARCHAR(250)
)
BEGIN 
   DECLARE CANT INT;
	SET @CANT:=(SELECT COUNT(*) FROM producto WHERE descripcion = BINARY DESCRIPCION);
	IF @CANT = 0 THEN		
		SELECT 2;
	ELSE 
		INSERT INTO producto VALUES (CODIGO,DESCRIPCION,MARCA,TIPO,PRECIO,CANTIDAD,'D',FOTO);
		SELECT 1;
	END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento ventas.SP_REGISTRAR_USUARIO
DELIMITER //
CREATE PROCEDURE `SP_REGISTRAR_USUARIO`(
	IN NOM VARCHAR(150),
	IN DIR VARCHAR(150),
	IN EMAIL VARCHAR(50),
	IN PWD VARCHAR(100) 
)
BEGIN 
    DECLARE CANTIDAD INT;
	SET @CANTIDAD:=(SELECT COUNT(*) FROM usuario WHERE nomUsu = BINARY NOM);
	IF @CANTIDAD = 0 THEN
		INSERT INTO usuario(nomUsu,dirUsu,emailUsu,pwdUsu,tipUsu,estUsu) VALUES (NOM,DIR,EMAIL,PWD,'A','A');
		SELECT 1;
	ELSE 
		SELECT 2;
	END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento ventas.SP_VERIFICAR_USUARIO
DELIMITER //
CREATE PROCEDURE `SP_VERIFICAR_USUARIO`(
	IN `USU` VARCHAR(20)
)
SELECT * FROM usuario
WHERE emailUsu = BINARY USU//
DELIMITER ;

-- Volcando estructura para tabla ventas.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsu` int(11) NOT NULL AUTO_INCREMENT,
  `nomUsu` varchar(150) NOT NULL,
  `dirUsu` varchar(150) DEFAULT NULL,
  `emailUsu` varchar(50) NOT NULL,
  `pwdUsu` varchar(100) NOT NULL,
  `tipUsu` char(1) NOT NULL,
  `estUsu` char(1) NOT NULL,
  PRIMARY KEY (`idUsu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12326 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla ventas.usuario: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idUsu`, `nomUsu`, `dirUsu`, `emailUsu`, `pwdUsu`, `tipUsu`, `estUsu`) VALUES
	(1, 'Jose Quispe', 'AKSDGAJSDHJASDGJAS', 'joseft@gmail.com', '123456', 'A', 'A'),
	(2, 'Omar', 'asjdgjadgj', 'omar@gmail.com', '123456', 'C', 'A'),
	(12324, 'sasdasdad', 'las mongolas', 'joseft.jack18@gmail.com', '123456', 'A', 'A'),
	(12325, 'sdfsdfsdfsdfsdfsdf', 'sdfsfsdfsdfsdfsdf', 'joseft.jack18@gmail.com', '123', 'A', 'A');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
