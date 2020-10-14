CREATE DATABASE ventas;
USE ventas;ventas

ventasCREATE TABLE usuario(
	dniUsu VARCHAR(8) PRIMARY KEY,
	nomUsu VARCHAR(150) NOT NULL,
	apeUsu VARCHAR(150) NOT NULL,
	imgUsu VARCHAR(250) NOT NULL,
	dirUsu VARCHAR(150) NOT NULL,
	userUsu VARCHAR(20) NOT NULL,
	pwdUsu VARCHAR(100) NOT NULL,
	tipUsu CHAR(1) NOT NULL,
	estUsu CHAR(1) NOT NULL
);

CREATE TABLE comentario(
	idComentario INT AUTO_INCREMENT PRIMARY KEY,
	contacto VARCHAR(150) NOT NULL,
	descripcion TEXT NOT NULL
);

CREATE TABLE producto(
	codigo VARCHAR(6) PRIMARY KEY,
	descripcion VARCHAR(250) NOT NULL,
	marca VARCHAR(150) NOT NULL,
	tipo CHAR(1) NOT NULL,
	precioUnitario FLOAT NOT NULL,
	cantidad INT NOT NULL,
	estado CHAR(1) NOT NULL
);

CREATE TABLE pedido(
	
);