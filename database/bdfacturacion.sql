CREATE DATABASE bdfacturacion;
USE bdfacturacion;

-- crear tabla TipoDocumento

CREATE TABLE TipoDocumento
(
	idTipoDocumento 	INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	codigo			CHAR (1) 		NOT NULL,
	descripcion		VARCHAR (50)	NOT NULL,
	CONSTRAINT uk_TipoDocumento_tipodoc UNIQUE (codigo, descripcion)
)	
ENGINE = INNODB;


-- crear tabla TablaParametrica
CREATE TABLE TablaParametrica
(
	idTablaParametrica		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	codigo				CHAR(3) 		NOT NULL,
	tipo 				CHAR(1) 		NOT NULL,
	decripcion			VARCHAR(100) 	NOT NULL,
	CONSTRAINT uk_TablaParametrica_tablaparam UNIQUE (codigo, tipo, decripcion)
)
ENGINE = INNODB;

-- crear tabla TipoAfectacion
CREATE TABLE TipoAfectacion
(
	idTipoAfectacion	INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	descripcion		VARCHAR(50)	NOT NULL,
	codigoAfectacion	INT(8)		NOT NULL,
	nombreAfectacion	VARCHAR(10)	NOT NULL,
	tipoAfectacion 	VARCHAR(10)	NOT NULL,
	CONSTRAINT uk_TipoAfectacion_afec UNIQUE (descripcion, codigoAfectacion)
)
ENGINE = INNODB;

/*
INSERT INTO TipoAfectacion (descripcion, codigoAfectacion, nombreAfectacion,tipoAfectacion) VALUES
('OP. GRATIUTAS',9996, 'GRA','FRE'),
('OP. EXONERADAS',9997, 'EXO','VAT'),
('OP. INAFECTAS',9998, 'INA','FRE'),
('OP. GRAVADAS',1000, 'IGV','VAT');

*/

CREATE TABLE Moneda
(
	idMoneda 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	codigo 		CHAR(4)		NOT NULL,
	descripcion	VARCHAR(20)	NOT NULL,
	CONSTRAINT uk_Moneda UNIQUE (codigo, descripcion)
)
ENGINE = INNODB;

/*
INSERT INTO Moneda (codigo, descripcion) VALUES
('PEN', 'Nuevo Sol'),
('USD', 'DOLARES'); 
*/

CREATE TABLE Unidad 
(
	idUnidad 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	codigo 		CHAR(4) 		NOT NULL,
	descripcion 	VARCHAR(20) 	NOT NULL,
	CONSTRAINT uk_Unidad UNIQUE (codigo, descripcion)
)
ENGINE = INNODB;

INSERT INTO Unidad(codigo, descripcion)VALUES
('4A', 'BOBINAS'),
('BJ', 'BALDE'),
('BLL', 'BARRILES'),
('BG', 'BOLSA'),
('BO', 'BOTELLAS'),
('BX', 'CAJA'),
('CT', 'CARTONES'),
('CMK', 'CENTIMETRO CUADRADO'),
('CMQ', 'CENTIMETRO CUBICO'),
('CMT', 'CENTIMETRO LINEAL'),
('CEN', 'CIENTO DE UNIDADES'),
('CY', 'CILINDRO'),
('CJ', 'CONOS'),
('DZN', 'DOCENA'),
('DZP', 'DOCENA POR 10**6'),
('BE', 'FARDO'),
('GLI', 'GALON INGLES (4,545956L)'),
('GRM', 'GRAMO'),
('GRO', 'GRUESA'),
('HLT', 'HECTOLITRO'),
('LEF', 'HOJA'),
('SET', 'JUEGO'),
('KGM', 'KILOGRAMO'),
('KTM', 'KILOMETRO'),
('KWH', 'KILOVATIO HORA  '),
('KT', 'KIT'),
('CA', 'LATAS'),
('LBR', 'LIBRAS'),
('LTR', 'LITRO'),
('MWH', 'MEGAWATT HORA'),
('MTR', 'METRO'),
('MTK', 'METRO CUADRADO '),
('MTQ', 'METRO CUBICO'),
('MGM', 'MILIGRAMOS'),
('MLT', 'MILILITRO'),
('MMT', 'MILIMETRO'),
('MMK', 'MILIMETRO CUADRADO'),
('MMQ', 'MILIMETRO CUBICO'),
('MLL', 'MILLARES'),
('UM', 'MILLON DE UNIDADES'),
('ONZ', 'ONZAS'),
('PF', 'PALETAS'),
('PK', 'PAQUETE'),
('PR', 'PAR'),
('FOT', 'PIES'),
('FTK', 'PIES CUADRADOS '),
('FTQ', 'PIES CUBICOS'),
('C62', 'PIEZA'),
('PG', 'PLACAS'),
('ST', 'PLIEGO'),
('INH', 'PULGADA'),
('RM', 'RESMA'),
('DR', 'TAMBOR'),
('STN', 'TONELADA CORTA'),
('LTN', 'TONELADA LARGA'),
('TNE', 'TONELADA'),
('TU', 'TUBO'),
('NIU', 'UNIDAD'),
('ZZ', 'SERVICIOS'),
('GLL', 'US GALON (3,7843 L)'),
('YRD', 'YARDA'),
('YDK', 'YARDA CUADRADA');

CREATE TABLE TipoComprobante
(
	idTipoComprobante 	INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	codigo 			CHAR(3)		NOT NULL,
	descripcion 		VARCHAR(20) 	NOT NULL,
	CONSTRAINT uk_TipoComprobante UNIQUE (codigo)
)
ENGINE = INNODB;

/*

insert into TipoComprobante (codigo,descripcion) values
(01, 'FACTURA'),
(03, 'BOLETA'),
(07, 'NOTA DE CRÉDITO'),
(08, 'NOTA DE DÉBITO '),
(09, 'GUIA DE REMISIÓN');

*/

CREATE TABLE Serie
(
	idSerie 			INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	tipoComprobante 	CHAR(2)		NOT NULL,
	serie 			VARCHAR(10) 	NOT NULL,
	correlativo 		INT(11)		NOT NULL,
	CONSTRAINT uk_Serie UNIQUE (tipoComprobante, serie, correlativo)
	
)
ENGINE = INNODB;
/*
insert into Serie (tipoComprobante, serie, correlativo) values
('01','F001',1),
('01','F002',1),
('03','B001',1),
('07','FN01',1),
('07','BN01',1),
('08','FD01',1),
('08','BD01',1),
('RC','20221230',1);
*/

CREATE TABLE Cliente
(
	idCliente 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	idTipoDocumento	INT 			NOT NULL,
	nroDoc 			VARCHAR(15)	NOT NULL,
	razonSocial 		VARCHAR(50)	NULL,
	direccion 		VARCHAR(50)	NULL,
	telefono 			VARCHAR(15)	NULL,
	idrol			INT 			NOT NULL, DEFAULT '3',
	CONSTRAINT fk_TipoDocumento_TipDoc FOREIGN KEY (idTipoDocumento) REFERENCES tipodocumento (idTipoDocumento),
	CONSTRAINT fk_rol_idRol FOREIGN KEY (idrol) REFERENCES roles (idrol),
	CONSTRAINT uk_Cliente UNIQUE (idTipoDocumento, nroDoc)
)
ENGINE = INNODB;


INSERT INTO `cliente` (`idTipoDocumento`, `nroDoc`, `razonSocial`,`direccion`)VALUES
(2,43914244,'SAMUEL ABEL VARGAS LAINEZ','A.A.H.H COVADONGA Mz. R2 Lt 09');

SELECT * FROM cliente;
UPDATE `bdfacturacion`.`cliente` SET `idTipoDocumento` = '2' WHERE `idCliente` = '1'

CREATE TABLE emisor
(
	idEmisor 				INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	idTipoDocumento		INT 			NOT NULL,
	nroDoc 				CHAR(11)		NOT NULL,
	razonSocial 			VARCHAR(50)	NOT NULL,
	nombreComercial 		VARCHAR(50)	NOT NULL,
	direccion 			VARCHAR(50)	NOT NULL,
	pais 				VARCHAR(50)	NOT NULL,
	departamento 			VARCHAR(50)	NOT NULL,
	provincia 			VARCHAR(50)	NOT NULL,
	distrito 				VARCHAR(50)	NOT NULL,
	ubigeo 				CHAR(6)		NOT NULL,
	usuarioSecundario 		VARCHAR(20)	NOT NULL,
	claveUsuarioSecundario	VARCHAR(20)	NOT NULL,
	CONSTRAINT fk_idTipoDocumento_tipoDocumento FOREIGN KEY (idTipoDocumento) REFERENCES tipodocumento (idTipoDocumento),
	CONSTRAINT uk_emisor UNIQUE (nroDoc, razonSocial)

)
ENGINE = INNODB;

/*

*/

CREATE TABLE notaCredito
(
	idNotaCredito 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	idEmisor 			INT 			NULL,
	idTipoComprobante 	INT 			NULL,
	idSerie 			INT 			NULL,
	serie 			CHAR(4) 		NULL,
	correlativo 		INT(11) 		NULL,
	fechaEmision		DATE 		NULL,
	idMoneda  		INT 			NULL,
	opGravadas 		DECIMAL(11,2) 	NULL,
	opExoneradas 		DECIMAL(11,2)	NULL,
	opInafectas 		DECIMAL(11,2)	NULL,
	igv 				DECIMAL(11,2)	NULL,
	total 			DECIMAL(11,2)	NULL,
	idCliente 		INT 			NULL,
	tipoComprobanteRef 	CHAR(2)		NULL,
	serieRef 			CHAR(4)		NULL,
	correlativoRef 	INT(11)		NULL,
	codMotivo			VARCHAR(5)	NULL,
	feEstado 			CHAR(1)		NULL,
	feCodigoError 		VARCHAR(10) 	NULL,
	feMensajeSunat		TEXT 		NULL,
	CONSTRAINT fk_idEmisor_emisor FOREIGN KEY (idEmisor) REFERENCES emisor(idEmisor),
	CONSTRAINT fk_idTipoComprobante_TipoComprobante FOREIGN KEY (idTipoComprobante) REFERENCES TipoComprobante(idTipoComprobante),
	CONSTRAINT fk_idSerie_serie FOREIGN KEY (idSerie) REFERENCES serie(idSerie),
	CONSTRAINT fk_idMoneda_moneda FOREIGN KEY(idMoneda) REFERENCES moneda(idMoneda),
	CONSTRAINT fk_idCliente_cliente FOREIGN KEY (idCliente) REFERENCES cliente(idCliente),
	CONSTRAINT uk_notaCredito UNIQUE (serie, correlativo)
) 
ENGINE = INNODB;


/*

*/

CREATE TABLE producto
(
	idProducto 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	nombre 			VARCHAR(150) 	NOT NULL,
	precio 			DECIMAL(11,2) 	NOT NULL,
	tipoPrecio 		CHAR(2) 		NOT NULL,
	idTipoAfectacion  	INT 			NOT NULL,
	idUnidad  		INT 			NOT NULL,
	CONSTRAINT fk_idTipoAfectacion_TipoAfectacion FOREIGN KEY (idTipoAfectacion) REFERENCES tipoafectacion (idTipoAfectacion),
	CONSTRAINT fk_idUnidad_unidad FOREIGN KEY (idUnidad) REFERENCES unidad (idUnidad)
)
ENGINE = INNODB;


CREATE TABLE detallenotacredito
(
		idDetalleNotaCredito 	INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
		idNotaCredito 			INT 		NOT NULL,
		item					INT(11)	NULL,
		idProducto 			INT 		NOT NULL,
		cantidad 				DECIMAL(11,2) NULL,
		valorUnitario			DECIMAL(11,2) NULL,
		precioUnitario			DECIMAL(11,2) NULL,
		igv					DECIMAL(11,2) NULL,
		porcentageIgv			DECIMAL(11,2) NULL,
		valorTotal 			DECIMAL(11,2) NULL,
		importeTotal 			DECIMAL(11,2) NULL,
		
		CONSTRAINT fk_idNotaCredito_notaCredito FOREIGN KEY (idNotaCredito) REFERENCES notaCredito(idNotaCredito),
		CONSTRAINT fk_idProducto_producto FOREIGN KEY (idProducto) REFERENCES producto(idProducto)
)
ENGINE = INNODB;

CREATE TABLE envioresumen
(
	idEnvioResumen 	INT 	AUTO_INCREMENT NOT NULL PRIMARY KEY,
	idEmisor 			INT 			NOT NULL,
	fechaEnvio 		DATE 		NULL,
	correlativo 		INT(11) 		NULL,
	resumen 			SMALLINT(6)	NULL,
	baja 			SMALLINT(6)	NULL,
	nombreXml 		VARCHAR(50)	NULL,
	feEstado 			CHAR(1) 		NULL,
	feCodigoError 		VARCHAR(10) 	NULL,
	feMensajeSunat 	TEXT 		NULL,
	ticket 			VARCHAR(50)	NULL,
	CONSTRAINT fk_idEmisor_emisors FOREIGN KEY (idEmisor)REFERENCES  emisor(idEmisor)
)
ENGINE = INNODB;


CREATE TABLE venta
(
	idVenta			INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	idEmisor 			INT 		NOT NULL,
	idTipoComprobante 	INT 		NOT NULL,
	idSerie 			INT 		NOT NULL,
	serie 			CHAR(4)	NOT NULL,
	correlativo 		INT(11)	NOT NULL,
	fechaEmision 		DATE 	NOT NULL,	
	idMoneda 			INT 		NOT NULL,
	opGravadas 		DECIMAL(11,2) 	NULL,
	opExoneradas 		DECIMAL(11,2) 	NULL,
	opInafectas 		DECIMAL(11,2) 	NULL,
	igv 				DECIMAL(11,2) 	NULL,
	total 			DECIMAL(11,2) 	NULL,
	idCliente 		INT 		NOT 	NULL,
	feEstado 			CHAR(1)		NULL,
	feCodigoError		VARCHAR(100)	NULL,
	feMensajeSunat		TEXT 		NULL,
	nombreXml			VARCHAR(50)	NULL,
	xmlBase64			TEXT 		NULL,
	cdrBase64			TEXT 		NULL,
	formaPago			VARCHAR(50)	NULL,
	montoPendiente		DECIMAL(11,2) 	NULL,
	CONSTRAINT fk_Emisor_idEmisor FOREIGN KEY (idEmisor)REFERENCES emisor(idEmisor),
	CONSTRAINT fk_idTipoComprobante_tipComp FOREIGN KEY (idTipoComprobante)REFERENCES tipocomprobante (idTipoComprobante),
	CONSTRAINT fk_serie_idSerie FOREIGN KEY (idSerie) REFERENCES serie (idSerie),
	CONSTRAINT fk_moneda_idMoneda FOREIGN KEY (idMoneda) REFERENCES moneda (idMoneda),
	CONSTRAINT fk_cliente_idCliente FOREIGN KEY (idCliente) REFERENCES cliente(idCliente)
)
ENGINE = INNODB;


CREATE TABLE detalleventa
(
	idDetallevent 		INT 		NOT NULL AUTO_INCREMENT PRIMARY KEY,
	idVenta 			INT 		NOT NULL,
	item				INT(11)	NOT NULL,
	idProducto 		INT 		NOT NULL,
	cantidad			DECIMAL(11,2) 	NULL,
	valorUnitario		DECIMAL(11,2) 	NULL,
	precioUnitario		DECIMAL(11,2) 	NULL,
	igv				DECIMAL(11,2) 	NULL,
	porcentageIgv		DECIMAL(11,2) 	NULL,
	valorTotal		DECIMAL(11,2) 	NULL,
	importeTotal		DECIMAL(11,2) 	NULL,
	CONSTRAINT fk_vent_idVenta FOREIGN KEY (idVenta) REFERENCES venta(idVenta),
	CONSTRAINT fk_producto_idProducto FOREIGN KEY (idProducto)REFERENCES producto(idProducto)
	
)
ENGINE =INNODB;

CREATE TABLE notadebito
(
	idNotaDebito		INT 		AUTO_INCREMENT NOT NULL PRIMARY KEY,
	idEmisor 			INT 		NOT NULL,
	idTipoComprobante 	INT 		NOT NULL,
	idSerie 			INT 		NOT NULL,
	serie 			CHAR(4) 	NOT NULL,
	correlativo 		INT(11) 	NOT NULL,
	fechaEmision 		DATE 	NOT NULL,
	idMoneda 			INT 		NOT NULL,
	opGravadas 		DECIMAL(11,2) 	NULL,
	opExoneradas		DECIMAL(11,2) 	NULL,
	opInafectas		DECIMAL(11,2) 	NULL,
	igv				DECIMAL(11,2) 	NULL,
	total			DECIMAL(11,2) 	NULL,
	idCliente 		INT 		NOT NULL,
	tipoCopmprbanteRef	CHAR(2) 	NULL,
	serieRef			CHAR(4) 	NULL,
	correlativoRef 	INT(11) 	NULL,
	codMotivo			VARCHAR(5)NULL,
	fechaEstado		CHAR(1)	NULL,
	fechaCodigoError 	VARCHAR(10)NULL,
	fechaMensajeSunat	TEXT 	NULL,
	CONSTRAINT fk_Emisor_Emisorid FOREIGN KEY (idEmisor)REFERENCES emisor(idEmisor),
	CONSTRAINT fk_TipoComprobante_idtipComp FOREIGN KEY (idTipoComprobante)REFERENCES tipocomprobante (idTipoComprobante),
	CONSTRAINT fk_serie_Serieid FOREIGN KEY (idSerie) REFERENCES serie (idSerie),
	CONSTRAINT fk_moneda_Monedaid FOREIGN KEY (idMoneda) REFERENCES moneda (idMoneda),
	CONSTRAINT fk_cliente_Clienteid FOREIGN KEY (idCliente) REFERENCES cliente(idCliente)
	
)
ENGINE = INNODB;



CREATE TABLE detnotadebito
(
	idDetalleNotaDebito 	INT 		NOT NULL AUTO_INCREMENT PRIMARY KEY,
	idNotaDebito 			INT 		NOT NULL,
	item 				INT(11) 	NOT NULL,
	idProducto 			INT 		NOT NULL,
	cantidad				DECIMAL(11,2) 	NULL,
	valorUnitario			DECIMAL(11,2) 	NULL,
	precio_unitario		DECIMAL(11,2) 	NULL,
	igv					DECIMAL(11,2) 	NULL,
	porcentajeIgv 			DECIMAL(11,2) 	NULL,
	valorTotal 			DECIMAL(11,2) 	NULL,
	importeTotal			DECIMAL(11,2) 	NULL,	
	CONSTRAINT fk_detanotadebito_idNotaDebito FOREIGN KEY (idNotaDebito)REFERENCES notadebito(idNotaDebito),
	CONSTRAINT fk_idProduc_Producto FOREIGN KEY (idProducto) REFERENCES producto(idProducto)
)
ENGINE = INNODB;


CREATE TABLE envioresumendetalle
(
	idResuDetalle 	INT 		NOT NULL AUTO_INCREMENT PRIMARY KEY,
	idEnvioResumen 		INT 		NOT NULL,
	idVenta 		INT 		NOT NULL,
	condicion		SMALLINT(6) NOT NULL,
	CONSTRAINT fk_idEnvio_envioresu FOREIGN KEY (idEnvioResumen)REFERENCES envioresumen(idEnvioResumen),
	CONSTRAINT fk_ventas_idVenta FOREIGN KEY (idVenta) REFERENCES venta (idVenta)
)
ENGINE = INNODB;

CREATE TABLE roles
(
	idrol		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	nombrerol		VARCHAR(60) NOT NULL,
	CONSTRAINT uk_nombrerol_rol UNIQUE (nombrerol)
)
ENGINE = INNODB;


INSERT INTO roles (nombrerol) VALUES

('Cliente/proveedor');


CREATE TABLE usuarios
(
	idUsuario			INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	idCliente			INT 			NOT NULL, 	-- FK (tabla: cliente)
	userName			VARCHAR(30)	NOT NULL,	-- UK (no debe existir dos usuarios iguales)
	userPassword		VARCHAR(100)	NOT NULL,
	fechaRegistro		DATETIME		NOT NULL DEFAULT NOW(),
	fechaBaja			DATETIME		NULL,
	idrol 			INT 			NOT NULL,
	estado			CHAR(1)		NOT NULL DEFAULT '1', -- estado 1 activo estado 0 inactivo
	CONSTRAINT fk_idCliente_usu FOREIGN KEY (idCliente) REFERENCES cliente (idCliente),
	CONSTRAINT fk_idrol_rol FOREIGN KEY (idrol) REFERENCES roles (idrol),
	CONSTRAINT uk_userName_usu UNIQUE (userName)
)
ENGINE = INNODB;



INSERT INTO usuarios (idPersona, userName, userPassword,idrol) VALUES

(7,'ISAIAS', '123456',4);

992615367 bertha




