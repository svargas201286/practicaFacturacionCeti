-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2023 a las 14:52:01
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdfacturacion`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE  PROCEDURE `spu_cargarProducto` ()  BEGIN 

	SELECT * FROM producto;

END$$

CREATE  PROCEDURE `spu_cargar_documento` ()  BEGIN 

	SELECT * FROM tipodocumento;

END$$

CREATE  PROCEDURE `spu_cargar_roles` ()  BEGIN 

	SELECT * FROM roles;

END$$

CREATE  PROCEDURE `spu_clientes_listar` ()  BEGIN     
    SELECT cliente.`idCliente`, cliente.`idTipoDocumento`, cliente.`nroDoc`, 
    cliente.`razonSocial`, cliente.`direccion`, cliente.`telefono`, roles.`idrol`,  
    CONCAT(tipodocumento.`descripcion`,' ',cliente.`nroDoc`)AS 'documento',    
    CONCAT(roles.`nombrerol`) AS 'tipo'    
    FROM cliente
    INNER JOIN tipodocumento ON tipodocumento.`idTipoDocumento` = cliente.`idTipoDocumento`
    INNER JOIN roles ON roles.`idrol` = cliente.`idrol`
    ORDER BY idCliente;
END$$

CREATE  PROCEDURE `spu_clientes_registrar` (IN `_idTipoDocumento` INT, IN `_nroDoc` VARCHAR(15), IN `_razonSocial` VARCHAR(50), IN `_direccion` VARCHAR(50), IN `_telefono` VARCHAR(15), IN `_idrol` INT)  BEGIN
	INSERT INTO cliente (idTipoDocumento, nroDoc, razonSocial, direccion, telefono, idrol)
	VALUES (_idTipoDocumento, _nroDoc, _razonSocial, _direccion, _telefono, _idrol);

END$$

CREATE  PROCEDURE `spu_Cliente_OptenerId` (IN `_idCliente` INT)  BEGIN
	SELECT cliente.`idCliente`, cliente.`idTipoDocumento`, cliente.`nroDoc`, 
	cliente.`razonSocial`, cliente.`direccion`, cliente.`telefono`, cliente.`idrol`,
	tipodocumento.`descripcion`,roles.`nombrerol`
	FROM cliente
	INNER JOIN tipodocumento ON tipodocumento.`idTipoDocumento` = cliente.`idTipoDocumento`
	INNER JOIN roles ON roles.`idrol` = cliente.`idrol`
	WHERE  cliente.`idCliente` = _idCliente;
END$$

CREATE  PROCEDURE `spu_emisor_listar` ()  BEGIN 

	SELECT * FROM emisor;

END$$

CREATE  PROCEDURE `spu_listarOne_dato_Cliente` (IN `_idCliente` INT)  BEGIN
	SELECT * FROM  cliente
WHERE
  idCliente = _idCliente;
END$$

CREATE  PROCEDURE `spu_modificar_cliente` (IN `_idCliente` INT, IN `_idTipoDocumento` INT, IN `_nroDoc` VARCHAR(15), IN `_razonSocial` VARCHAR(50), IN `_direccion` VARCHAR(50), IN `_telefono` VARCHAR(15), IN `_idrol` INT)  BEGIN
UPDATE cliente SET
	idTipoDocumento	= _idTipoDocumento,
	nroDoc			    = _nroDoc,
	razonSocial		  = _razonSocial,
	direccion			  = _direccion,
	telefono			  = _telefono,
	idrol			      = _idrol
	
	WHERE idCliente = _idCliente;
END$$

CREATE  PROCEDURE `spu_moneda_listar` ()  BEGIN 

	SELECT * FROM moneda;

END$$

CREATE  PROCEDURE `spu_usuarios_actualizarClave` (IN `_idUsuario` INT, IN `_userPassword` VARCHAR(100))  BEGIN
	UPDATE usuarios SET userPassword = _userPassword WHERE idUsuario = _idUsuario;
END$$

CREATE  PROCEDURE `spu_usuarios_login` (IN `_userName` VARCHAR(30))  BEGIN
	SELECT usuarios.`idUsuario`, 
	CONCAT (cliente.`razonSocial`)AS 'Cliente',
	usuarios.`userName`, usuarios.`userPassword`
	FROM usuarios
	INNER JOIN cliente ON cliente.`idCliente` = usuarios.`idCliente`
	WHERE userName = _userName AND estado = '1';

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `idTipoDocumento` int(11) NOT NULL,
  `nroDoc` varchar(15) NOT NULL,
  `razonSocial` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `idrol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `idTipoDocumento`, `nroDoc`, `razonSocial`, `direccion`, `telefono`, `idrol`) VALUES
(1, 2, '43914244', 'SAMUEL ABEL VARGAS LAINEZ', 'A.A.H.H COVADONGA Mz. R2 Lt 09', '948907640', 3),
(3, 2, '45473625', 'Elizabeth Calle Guillen', 'A.A.H.H Covadonga Mz. R2 Lt. 09', '948907640', 3),
(4, 2, '42914289', 'DAVILA CARRANZA TIMOTEO WALTER', 'covadonga', '948907640', 3),
(5, 2, '74482268', 'CHAHUA HUILLCA AMADOR', 'A.H. covadonga Mz. R2 Lt.Nº09', '948907640', 3),
(6, 2, '43914248', 'RAMOS BAUTISTA ANALI', 'A.H. covadonga Mz. R2 Lt.Nº09', '948907640', 1),
(8, 2, '43914249', 'PALOMINO CARDENAS EDITH', 'A.H. covadonga Mz. R2 Lt.Nº09', '948907640', 1),
(9, 2, '43914246', 'FLORES BAUTISTA ANGELICA', 'A.H. covadonga Mz. R2 Lt.Nº09', '948907640', 1),
(10, 2, '43914245', 'LOPEZ CCONISLLA JAIME', 'A.H. covadonga Mz. R2 Lt.Nº09', '948907640', 4),
(11, 2, '45473623', 'PAQUIYAURI CUBA ANTONIO', 'A.H. covadonga Mz. R2 Lt.Nº09', '948907640', 2),
(12, 3, '66668888', 'ARAMBURU VIVANCO ROSMERY', 'mercedes', '444455552', 5),
(13, 2, '45473626', 'COQUEL ROJAS YURI', 'A.H. covadonga Mz. R2 Lt.Nº09', '948907640', 3),
(14, 2, '45473633', 'TUDELA PACHECO SADIVENIA', 'A.H. covadonga Mz. R2 Lt.Nº09', '948907640', 3),
(24, 2, '45473629', 'HUAMAN PALOMINO YUDITA', 'A.H. covadonga Mz. R2 Lt.Nº09', '948907640', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallenotacredito`
--

CREATE TABLE `detallenotacredito` (
  `idDetalleNotaCredito` int(11) NOT NULL,
  `idNotaCredito` int(11) NOT NULL,
  `item` int(11) DEFAULT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` decimal(11,2) DEFAULT NULL,
  `valorUnitario` decimal(11,2) DEFAULT NULL,
  `precioUnitario` decimal(11,2) DEFAULT NULL,
  `igv` decimal(11,2) DEFAULT NULL,
  `porcentageIgv` decimal(11,2) DEFAULT NULL,
  `valorTotal` decimal(11,2) DEFAULT NULL,
  `importeTotal` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `idDetallevent` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` decimal(11,2) DEFAULT NULL,
  `valorUnitario` decimal(11,2) DEFAULT NULL,
  `precioUnitario` decimal(11,2) DEFAULT NULL,
  `igv` decimal(11,2) DEFAULT NULL,
  `porcentageIgv` decimal(11,2) DEFAULT NULL,
  `valorTotal` decimal(11,2) DEFAULT NULL,
  `importeTotal` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detnotadebito`
--

CREATE TABLE `detnotadebito` (
  `idDetalleNotaDebito` int(11) NOT NULL,
  `idNotaDebito` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` decimal(11,2) DEFAULT NULL,
  `valorUnitario` decimal(11,2) DEFAULT NULL,
  `precio_unitario` decimal(11,2) DEFAULT NULL,
  `igv` decimal(11,2) DEFAULT NULL,
  `porcentajeIgv` decimal(11,2) DEFAULT NULL,
  `valorTotal` decimal(11,2) DEFAULT NULL,
  `importeTotal` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emisor`
--

CREATE TABLE `emisor` (
  `idEmisor` int(11) NOT NULL,
  `idTipoDocumento` int(11) NOT NULL,
  `nroDoc` char(11) NOT NULL,
  `razonSocial` varchar(50) NOT NULL,
  `nombreComercial` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `distrito` varchar(50) NOT NULL,
  `ubigeo` char(6) NOT NULL,
  `usuarioSecundario` varchar(20) NOT NULL,
  `claveUsuarioSecundario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `emisor`
--

INSERT INTO `emisor` (`idEmisor`, `idTipoDocumento`, `nroDoc`, `razonSocial`, `nombreComercial`, `direccion`, `pais`, `departamento`, `provincia`, `distrito`, `ubigeo`, `usuarioSecundario`, `claveUsuarioSecundario`) VALUES
(1, 6, '10439142443', 'SAMUEL ABEL VARGAS LAINEZ', 'MULTISERVICIOS STAR', 'A.A.H.H COVADONGA Mz. R2 Lt. 09', 'PE', 'AYACUCHO', 'HUAMANGA', 'AYCUCHO', '050101', 'MODDATOS', 'MODDATOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envioresumen`
--

CREATE TABLE `envioresumen` (
  `idEnvioResumen` int(11) NOT NULL,
  `idEmisor` int(11) NOT NULL,
  `fechaEnvio` date DEFAULT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `resumen` smallint(6) DEFAULT NULL,
  `baja` smallint(6) DEFAULT NULL,
  `nombreXml` varchar(50) DEFAULT NULL,
  `feEstado` char(1) DEFAULT NULL,
  `feCodigoError` varchar(10) DEFAULT NULL,
  `feMensajeSunat` text DEFAULT NULL,
  `ticket` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envioresumendetalle`
--

CREATE TABLE `envioresumendetalle` (
  `idResuDetalle` int(11) NOT NULL,
  `idEnvioResumen` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `condicion` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `idMoneda` int(11) NOT NULL,
  `codigo` char(4) NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`idMoneda`, `codigo`, `descripcion`) VALUES
(1, 'PEN', 'SOLES'),
(2, 'USD', 'DOLARES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notacredito`
--

CREATE TABLE `notacredito` (
  `idNotaCredito` int(11) NOT NULL,
  `idEmisor` int(11) DEFAULT NULL,
  `idTipoComprobante` int(11) DEFAULT NULL,
  `idSerie` int(11) DEFAULT NULL,
  `serie` char(4) DEFAULT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `fechaEmision` date DEFAULT NULL,
  `idMoneda` int(11) DEFAULT NULL,
  `opGravadas` decimal(11,2) DEFAULT NULL,
  `opExoneradas` decimal(11,2) DEFAULT NULL,
  `opInafectas` decimal(11,2) DEFAULT NULL,
  `igv` decimal(11,2) DEFAULT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `tipoComprobanteRef` char(2) DEFAULT NULL,
  `serieRef` char(4) DEFAULT NULL,
  `correlativoRef` int(11) DEFAULT NULL,
  `codMotivo` varchar(5) DEFAULT NULL,
  `feEstado` char(1) DEFAULT NULL,
  `feCodigoError` varchar(10) DEFAULT NULL,
  `feMensajeSunat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notadebito`
--

CREATE TABLE `notadebito` (
  `idNotaDebito` int(11) NOT NULL,
  `idEmisor` int(11) NOT NULL,
  `idTipoComprobante` int(11) NOT NULL,
  `idSerie` int(11) NOT NULL,
  `serie` char(4) NOT NULL,
  `correlativo` int(11) NOT NULL,
  `fechaEmision` date NOT NULL,
  `idMoneda` int(11) NOT NULL,
  `opGravadas` decimal(11,2) DEFAULT NULL,
  `opExoneradas` decimal(11,2) DEFAULT NULL,
  `opInafectas` decimal(11,2) DEFAULT NULL,
  `igv` decimal(11,2) DEFAULT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `idCliente` int(11) NOT NULL,
  `tipoCopmprbanteRef` char(2) DEFAULT NULL,
  `serieRef` char(4) DEFAULT NULL,
  `correlativoRef` int(11) DEFAULT NULL,
  `codMotivo` varchar(5) DEFAULT NULL,
  `fechaEstado` char(1) DEFAULT NULL,
  `fechaCodigoError` varchar(10) DEFAULT NULL,
  `fechaMensajeSunat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `tipoPrecio` char(2) NOT NULL,
  `idTipoAfectacion` int(11) NOT NULL,
  `idUnidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `precio`, `tipoPrecio`, `idTipoAfectacion`, `idUnidad`) VALUES
(1, 'ACEITE', '5.00', '01', 4, 58),
(2, 'JABON', '3.00', '01', 4, 58),
(3, 'CUADERNO', '5.00', '01', 4, 58),
(4, 'PAPEL HIGIENO', '0.50', '01', 4, 58),
(5, 'ALCOHOL', '6.00', '01', 4, 58),
(6, 'LIBRO NORMA', '100.00', '01', 4, 58),
(7, 'PLATANOS', '1.00', '01', 4, 58),
(8, 'MANZANA', '2.50', '01', 4, 58);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idrol` int(11) NOT NULL,
  `nombrerol` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idrol`, `nombrerol`) VALUES
(1, 'Administrador'),
(3, 'Cliente'),
(5, 'Cliente/proveedor'),
(4, 'Proveedor'),
(2, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serie`
--

CREATE TABLE `serie` (
  `idSerie` int(11) NOT NULL,
  `tipoComprobante` char(2) NOT NULL,
  `serie` varchar(10) NOT NULL,
  `correlativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `serie`
--

INSERT INTO `serie` (`idSerie`, `tipoComprobante`, `serie`, `correlativo`) VALUES
(1, '01', 'F001', 1),
(2, '01', 'F002', 1),
(3, '03', 'B001', 1),
(5, '07', 'BN01', 1),
(4, '07', 'FN01', 1),
(7, '08', 'BD01', 1),
(6, '08', 'FD01', 1),
(9, 'RA', '20210225', 1),
(8, 'RC', '20210225', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablaparametrica`
--

CREATE TABLE `tablaparametrica` (
  `idTablaParametrica` int(11) NOT NULL,
  `codigo` char(3) NOT NULL,
  `tipo` char(1) NOT NULL,
  `decripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tablaparametrica`
--

INSERT INTO `tablaparametrica` (`idTablaParametrica`, `codigo`, `tipo`, `decripcion`) VALUES
(1, '01', 'c', 'Anulación de la operación'),
(13, '01', 'D', 'Intereses por mora'),
(2, '02', 'C', 'Anulación por error en el RUC'),
(14, '02', 'D', 'Aumento en el valor'),
(3, '03', 'C', 'Corrección por error en la descripción'),
(15, '03', 'D', 'Penalidades/ otros conceptos'),
(4, '04', 'C', 'Descuento global'),
(5, '05', 'C', 'Descuento por ítem'),
(6, '06', 'C', 'Devolución total'),
(7, '07', 'C', 'Devolución por ítem'),
(8, '08', 'C', 'Bonificación'),
(9, '09', 'C', 'Disminución en el valor'),
(10, '10', 'C', 'Otros Conceptos'),
(16, '10', 'D', 'Ajustes de operaciones de exportación'),
(11, '11', 'C', 'Ajustes de operaciones de exportación'),
(17, '11', 'D', 'Ajustes afectos al IVAP'),
(12, '12', 'C', 'Ajustes afectos al IVAP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoafectacion`
--

CREATE TABLE `tipoafectacion` (
  `idTipoAfectacion` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `codigoAfectacion` int(8) NOT NULL,
  `nombreAfectacion` varchar(10) NOT NULL,
  `tipoAfectacion` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoafectacion`
--

INSERT INTO `tipoafectacion` (`idTipoAfectacion`, `descripcion`, `codigoAfectacion`, `nombreAfectacion`, `tipoAfectacion`) VALUES
(1, 'OP. GRATIUTAS', 9996, 'GRA', 'FRE'),
(2, 'OP. EXONERADAS', 9997, 'EXO', 'VAT'),
(3, 'OP. INAFECTAS', 9998, 'INA', 'FRE'),
(4, 'OP. GRAVADAS', 1000, 'IGV', 'VAT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocomprobante`
--

CREATE TABLE `tipocomprobante` (
  `idTipoComprobante` int(11) NOT NULL,
  `codigo` char(3) NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipocomprobante`
--

INSERT INTO `tipocomprobante` (`idTipoComprobante`, `codigo`, `descripcion`) VALUES
(1, '1', 'FACTURA'),
(2, '3', 'BOLETA'),
(3, '7', 'NOTA DE CRÉDITO'),
(4, '8', 'NOTA DE DÉBITO '),
(5, '9', 'GUIA DE REMISIÓN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `idTipoDocumento` int(11) NOT NULL,
  `codigo` char(1) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`idTipoDocumento`, `codigo`, `descripcion`) VALUES
(1, '0', 'SIN DOCUMENTO'),
(2, '1', 'DNI'),
(4, '4', 'CARNET DE EXTRANJERIA'),
(3, '6', 'RUC'),
(5, '7', 'PASAPORTE'),
(6, 'F', 'DOC'),
(7, 'G', 'DOCUMENTO MOD PQ'),
(8, 'H', 'DOCUMENTO XY'),
(9, 'I', 'PERMISO TEMPORAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `idUnidad` int(11) NOT NULL,
  `codigo` char(4) NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`idUnidad`, `codigo`, `descripcion`) VALUES
(1, '4A', 'BOBINAS'),
(16, 'BE', 'FARDO'),
(4, 'BG', 'BOLSA'),
(2, 'BJ', 'BALDE'),
(3, 'BLL', 'BARRILES'),
(5, 'BO', 'BOTELLAS'),
(6, 'BX', 'CAJA'),
(48, 'C62', 'PIEZA'),
(27, 'CA', 'LATAS'),
(11, 'CEN', 'CIENTO DE UNIDADES'),
(13, 'CJ', 'CONOS'),
(8, 'CMK', 'CENTIMETRO CUADRADO'),
(9, 'CMQ', 'CENTIMETRO CUBICO'),
(10, 'CMT', 'CENTIMETRO LINEAL'),
(7, 'CT', 'CARTONES'),
(12, 'CY', 'CILINDRO'),
(53, 'DR', 'TAMBOR'),
(14, 'DZN', 'DOCENA'),
(15, 'DZP', 'DOCENA POR 10**6'),
(45, 'FOT', 'PIES'),
(46, 'FTK', 'PIES CUADRADOS '),
(47, 'FTQ', 'PIES CUBICOS'),
(17, 'GLI', 'GALON INGLES (4,5459'),
(60, 'GLL', 'US GALON (3,7843 L)'),
(18, 'GRM', 'GRAMO'),
(19, 'GRO', 'GRUESA'),
(20, 'HLT', 'HECTOLITRO'),
(51, 'INH', 'PULGADA'),
(23, 'KGM', 'KILOGRAMO'),
(26, 'KT', 'KIT'),
(24, 'KTM', 'KILOMETRO'),
(25, 'KWH', 'KILOVATIO HORA  '),
(28, 'LBR', 'LIBRAS'),
(21, 'LEF', 'HOJA'),
(55, 'LTN', 'TONELADA LARGA'),
(29, 'LTR', 'LITRO'),
(34, 'MGM', 'MILIGRAMOS'),
(39, 'MLL', 'MILLARES'),
(35, 'MLT', 'MILILITRO'),
(37, 'MMK', 'MILIMETRO CUADRADO'),
(38, 'MMQ', 'MILIMETRO CUBICO'),
(36, 'MMT', 'MILIMETRO'),
(32, 'MTK', 'METRO CUADRADO '),
(33, 'MTQ', 'METRO CUBICO'),
(31, 'MTR', 'METRO'),
(30, 'MWH', 'MEGAWATT HORA'),
(58, 'NIU', 'UNIDAD'),
(41, 'ONZ', 'ONZAS'),
(42, 'PF', 'PALETAS'),
(49, 'PG', 'PLACAS'),
(43, 'PK', 'PAQUETE'),
(44, 'PR', 'PAR'),
(52, 'RM', 'RESMA'),
(22, 'SET', 'JUEGO'),
(50, 'ST', 'PLIEGO'),
(54, 'STN', 'TONELADA CORTA'),
(56, 'TNE', 'TONELADA'),
(57, 'TU', 'TUBO'),
(40, 'UM', 'MILLON DE UNIDADES'),
(62, 'YDK', 'YARDA CUADRADA'),
(61, 'YRD', 'YARDA'),
(59, 'ZZ', 'SERVICIOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userPassword` varchar(100) NOT NULL,
  `fechaRegistro` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaBaja` datetime DEFAULT NULL,
  `idrol` int(11) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `idCliente`, `userName`, `userPassword`, `fechaRegistro`, `fechaBaja`, `idrol`, `estado`) VALUES
(1, 1, 'samuel', '$2y$10$C8Y35IM6oM1UaZyr5/wVQuezarjgk6fdwSZb44z/i9KJ0RpT3dTVW', '2023-02-23 06:47:53', NULL, 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idVenta` int(11) NOT NULL,
  `idEmisor` int(11) NOT NULL,
  `idTipoComprobante` int(11) NOT NULL,
  `idSerie` int(11) NOT NULL,
  `serie` char(4) NOT NULL,
  `correlativo` int(11) NOT NULL,
  `fechaEmision` date NOT NULL,
  `idMoneda` int(11) NOT NULL,
  `opGravadas` decimal(11,2) DEFAULT NULL,
  `opExoneradas` decimal(11,2) DEFAULT NULL,
  `opInafectas` decimal(11,2) DEFAULT NULL,
  `igv` decimal(11,2) DEFAULT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `idCliente` int(11) NOT NULL,
  `feEstado` char(1) DEFAULT NULL,
  `feCodigoError` varchar(100) DEFAULT NULL,
  `feMensajeSunat` text DEFAULT NULL,
  `nombreXml` varchar(50) DEFAULT NULL,
  `xmlBase64` text DEFAULT NULL,
  `cdrBase64` text DEFAULT NULL,
  `formaPago` varchar(50) DEFAULT NULL,
  `montoPendiente` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `uk_Cliente` (`idTipoDocumento`,`nroDoc`),
  ADD KEY `fk_Rol_idRol` (`idrol`);

--
-- Indices de la tabla `detallenotacredito`
--
ALTER TABLE `detallenotacredito`
  ADD PRIMARY KEY (`idDetalleNotaCredito`),
  ADD KEY `fk_idNotaCredito_notaCredito` (`idNotaCredito`),
  ADD KEY `fk_idProducto_producto` (`idProducto`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`idDetallevent`),
  ADD KEY `fk_vent_idVenta` (`idVenta`),
  ADD KEY `fk_producto_idProducto` (`idProducto`);

--
-- Indices de la tabla `detnotadebito`
--
ALTER TABLE `detnotadebito`
  ADD PRIMARY KEY (`idDetalleNotaDebito`),
  ADD KEY `fk_detanotadebito_idNotaDebito` (`idNotaDebito`),
  ADD KEY `fk_idProduc_Producto` (`idProducto`);

--
-- Indices de la tabla `emisor`
--
ALTER TABLE `emisor`
  ADD PRIMARY KEY (`idEmisor`),
  ADD UNIQUE KEY `uk_emisor` (`nroDoc`,`razonSocial`),
  ADD KEY `fk_idTipoDocumento_tipoDocumento` (`idTipoDocumento`);

--
-- Indices de la tabla `envioresumen`
--
ALTER TABLE `envioresumen`
  ADD PRIMARY KEY (`idEnvioResumen`),
  ADD KEY `fk_idEmisor_emisors` (`idEmisor`);

--
-- Indices de la tabla `envioresumendetalle`
--
ALTER TABLE `envioresumendetalle`
  ADD PRIMARY KEY (`idResuDetalle`),
  ADD KEY `fk_idEnvio_envioresu` (`idEnvioResumen`),
  ADD KEY `fk_ventas_idVenta` (`idVenta`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`idMoneda`),
  ADD UNIQUE KEY `uk_Moneda` (`codigo`,`descripcion`);

--
-- Indices de la tabla `notacredito`
--
ALTER TABLE `notacredito`
  ADD PRIMARY KEY (`idNotaCredito`),
  ADD UNIQUE KEY `uk_notaCredito` (`serie`,`correlativo`),
  ADD KEY `fk_idEmisor_emisor` (`idEmisor`),
  ADD KEY `fk_idTipoComprobante_TipoComprobante` (`idTipoComprobante`),
  ADD KEY `fk_idSerie_serie` (`idSerie`),
  ADD KEY `fk_idMoneda_moneda` (`idMoneda`),
  ADD KEY `fk_idCliente_cliente` (`idCliente`);

--
-- Indices de la tabla `notadebito`
--
ALTER TABLE `notadebito`
  ADD PRIMARY KEY (`idNotaDebito`),
  ADD KEY `fk_Emisor_Emisorid` (`idEmisor`),
  ADD KEY `fk_TipoComprobante_idtipComp` (`idTipoComprobante`),
  ADD KEY `fk_serie_Serieid` (`idSerie`),
  ADD KEY `fk_moneda_Monedaid` (`idMoneda`),
  ADD KEY `fk_cliente_Clienteid` (`idCliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `fk_idTipoAfectacion_TipoAfectacion` (`idTipoAfectacion`),
  ADD KEY `fk_idUnidad_unidad` (`idUnidad`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `uk_nombrerol_rol` (`nombrerol`);

--
-- Indices de la tabla `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`idSerie`),
  ADD UNIQUE KEY `uk_Serie` (`tipoComprobante`,`serie`,`correlativo`);

--
-- Indices de la tabla `tablaparametrica`
--
ALTER TABLE `tablaparametrica`
  ADD PRIMARY KEY (`idTablaParametrica`),
  ADD UNIQUE KEY `uk_TablaParametrica_tablaparam` (`codigo`,`tipo`,`decripcion`);

--
-- Indices de la tabla `tipoafectacion`
--
ALTER TABLE `tipoafectacion`
  ADD PRIMARY KEY (`idTipoAfectacion`),
  ADD UNIQUE KEY `uk_TipoAfectacion_afec` (`descripcion`,`codigoAfectacion`);

--
-- Indices de la tabla `tipocomprobante`
--
ALTER TABLE `tipocomprobante`
  ADD PRIMARY KEY (`idTipoComprobante`),
  ADD UNIQUE KEY `uk_TipoComprobante` (`codigo`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`idTipoDocumento`),
  ADD UNIQUE KEY `uk_TipoDocumento_tipodoc` (`codigo`,`descripcion`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`idUnidad`),
  ADD UNIQUE KEY `uk_Unidad` (`codigo`,`descripcion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `uk_userName_usu` (`userName`),
  ADD KEY `fk_idCliente_usu` (`idCliente`),
  ADD KEY `fk_idrol_rol` (`idrol`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `fk_Emisor_idEmisor` (`idEmisor`),
  ADD KEY `fk_idTipoComprobante_tipComp` (`idTipoComprobante`),
  ADD KEY `fk_serie_idSerie` (`idSerie`),
  ADD KEY `fk_moneda_idMoneda` (`idMoneda`),
  ADD KEY `fk_cliente_idCliente` (`idCliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `detallenotacredito`
--
ALTER TABLE `detallenotacredito`
  MODIFY `idDetalleNotaCredito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `idDetallevent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detnotadebito`
--
ALTER TABLE `detnotadebito`
  MODIFY `idDetalleNotaDebito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `emisor`
--
ALTER TABLE `emisor`
  MODIFY `idEmisor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `envioresumen`
--
ALTER TABLE `envioresumen`
  MODIFY `idEnvioResumen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `envioresumendetalle`
--
ALTER TABLE `envioresumendetalle`
  MODIFY `idResuDetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `idMoneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `notacredito`
--
ALTER TABLE `notacredito`
  MODIFY `idNotaCredito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notadebito`
--
ALTER TABLE `notadebito`
  MODIFY `idNotaDebito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `serie`
--
ALTER TABLE `serie`
  MODIFY `idSerie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tablaparametrica`
--
ALTER TABLE `tablaparametrica`
  MODIFY `idTablaParametrica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tipoafectacion`
--
ALTER TABLE `tipoafectacion`
  MODIFY `idTipoAfectacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipocomprobante`
--
ALTER TABLE `tipocomprobante`
  MODIFY `idTipoComprobante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `idTipoDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `idUnidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_Rol_idRol` FOREIGN KEY (`idrol`) REFERENCES `roles` (`idrol`),
  ADD CONSTRAINT `fk_TipoDocumento_TipDoc` FOREIGN KEY (`idTipoDocumento`) REFERENCES `tipodocumento` (`idTipoDocumento`);

--
-- Filtros para la tabla `detallenotacredito`
--
ALTER TABLE `detallenotacredito`
  ADD CONSTRAINT `fk_idNotaCredito_notaCredito` FOREIGN KEY (`idNotaCredito`) REFERENCES `notacredito` (`idNotaCredito`),
  ADD CONSTRAINT `fk_idProducto_producto` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `fk_producto_idProducto` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`),
  ADD CONSTRAINT `fk_vent_idVenta` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`);

--
-- Filtros para la tabla `detnotadebito`
--
ALTER TABLE `detnotadebito`
  ADD CONSTRAINT `fk_detanotadebito_idNotaDebito` FOREIGN KEY (`idNotaDebito`) REFERENCES `notadebito` (`idNotaDebito`),
  ADD CONSTRAINT `fk_idProduc_Producto` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`);

--
-- Filtros para la tabla `emisor`
--
ALTER TABLE `emisor`
  ADD CONSTRAINT `fk_idTipoDocumento_tipoDocumento` FOREIGN KEY (`idTipoDocumento`) REFERENCES `tipodocumento` (`idTipoDocumento`);

--
-- Filtros para la tabla `envioresumen`
--
ALTER TABLE `envioresumen`
  ADD CONSTRAINT `fk_idEmisor_emisors` FOREIGN KEY (`idEmisor`) REFERENCES `emisor` (`idEmisor`);

--
-- Filtros para la tabla `envioresumendetalle`
--
ALTER TABLE `envioresumendetalle`
  ADD CONSTRAINT `fk_idEnvio_envioresu` FOREIGN KEY (`idEnvioResumen`) REFERENCES `envioresumen` (`idEnvioResumen`),
  ADD CONSTRAINT `fk_ventas_idVenta` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`);

--
-- Filtros para la tabla `notacredito`
--
ALTER TABLE `notacredito`
  ADD CONSTRAINT `fk_idCliente_cliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `fk_idEmisor_emisor` FOREIGN KEY (`idEmisor`) REFERENCES `emisor` (`idEmisor`),
  ADD CONSTRAINT `fk_idMoneda_moneda` FOREIGN KEY (`idMoneda`) REFERENCES `moneda` (`idMoneda`),
  ADD CONSTRAINT `fk_idSerie_serie` FOREIGN KEY (`idSerie`) REFERENCES `serie` (`idSerie`),
  ADD CONSTRAINT `fk_idTipoComprobante_TipoComprobante` FOREIGN KEY (`idTipoComprobante`) REFERENCES `tipocomprobante` (`idTipoComprobante`);

--
-- Filtros para la tabla `notadebito`
--
ALTER TABLE `notadebito`
  ADD CONSTRAINT `fk_Emisor_Emisorid` FOREIGN KEY (`idEmisor`) REFERENCES `emisor` (`idEmisor`),
  ADD CONSTRAINT `fk_TipoComprobante_idtipComp` FOREIGN KEY (`idTipoComprobante`) REFERENCES `tipocomprobante` (`idTipoComprobante`),
  ADD CONSTRAINT `fk_cliente_Clienteid` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `fk_moneda_Monedaid` FOREIGN KEY (`idMoneda`) REFERENCES `moneda` (`idMoneda`),
  ADD CONSTRAINT `fk_serie_Serieid` FOREIGN KEY (`idSerie`) REFERENCES `serie` (`idSerie`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_idTipoAfectacion_TipoAfectacion` FOREIGN KEY (`idTipoAfectacion`) REFERENCES `tipoafectacion` (`idTipoAfectacion`),
  ADD CONSTRAINT `fk_idUnidad_unidad` FOREIGN KEY (`idUnidad`) REFERENCES `unidad` (`idUnidad`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_idCliente_usu` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `fk_idrol_rol` FOREIGN KEY (`idrol`) REFERENCES `roles` (`idrol`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_Emisor_idEmisor` FOREIGN KEY (`idEmisor`) REFERENCES `emisor` (`idEmisor`),
  ADD CONSTRAINT `fk_cliente_idCliente` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `fk_idTipoComprobante_tipComp` FOREIGN KEY (`idTipoComprobante`) REFERENCES `tipocomprobante` (`idTipoComprobante`),
  ADD CONSTRAINT `fk_moneda_idMoneda` FOREIGN KEY (`idMoneda`) REFERENCES `moneda` (`idMoneda`),
  ADD CONSTRAINT `fk_serie_idSerie` FOREIGN KEY (`idSerie`) REFERENCES `serie` (`idSerie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
