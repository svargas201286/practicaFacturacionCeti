ALTER TABLE cliente AUTO_INCREMENT=1; -- este comando se usa para reiniciar el auto increment

DELIMITER $$
CREATE PROCEDURE spu_clientes_listar()
BEGIN     
    SELECT cliente.`idCliente`, cliente.`idTipoDocumento`, cliente.`nroDoc`, 
    cliente.`razonSocial`, cliente.`direccion`, cliente.`telefono`, roles.`idrol`,
    CONCAT(tipodocumento.`descripcion`,' ',cliente.`nroDoc`)AS 'documento',    
    CONCAT(roles.`nombrerol`) AS 'tipo'    
    FROM cliente
    INNER JOIN tipodocumento ON tipodocumento.`idTipoDocumento` = cliente.`idTipoDocumento`
    INNER JOIN roles ON roles.`idrol` = cliente.`idrol`
    ORDER BY idCliente; 
END $$

SELECT * FROM cliente;
SELECT * FROM tipodocumento;
SELECT * FROM usuarios;
CALL spu_clientes_listar();
UPDATE usuarios SET userPassword ='$2y$10$C8Y35IM6oM1UaZyr5/wVQuezarjgk6fdwSZb44z/i9KJ0RpT3dTVW';


-- Procedure obtener documento del cliente

DELIMITER $$
CREATE PROCEDURE spu_cliente_OptenerDocumento
(
	IN _idTipoDocumento	INT,
	IN _nroDoc		VARCHAR (15)
)
BEGIN

	SELECT 	cliente.`idCliente`, cliente.`idTipoDocumento`, cliente.`nroDoc`, cliente.`razonSocial`,
			cliente.`direccion`, cliente.`telefono`, cliente.`idrol`
			
	FROM cliente
	INNER JOIN tipodocumento ON tipodocumento.`idTipoDocumento` = cliente.`idTipoDocumento`
	WHERE idTipoDocumento = _idTipoDocumento AND nroDoc = _nroDoc;
	
END$$

-- Procedure obtener documento del cliente

DELIMITER $$
CREATE PROCEDURE spu_cliente_OptenerDocumento
(
	IN _idTipoDocumento	INT,
	IN _nroDoc		VARCHAR (15)
)
BEGIN

	SELECT 	cliente.`idCliente`, cliente.`idTipoDocumento`, cliente.`nroDoc`, cliente.`razonSocial`,
			cliente.`direccion`, cliente.`telefono`, cliente.`idrol`
			
	FROM cliente	
	WHERE cliente.`idTipoDocumento` = _idTipoDocumento AND cliente.`nroDoc` = _nroDoc;
	
END$$

DELIMITER $$
CREATE PROCEDURE spu_cliente_OptenerDocumento3
(
	IN _idTipoDocumento	INT,
	IN _nroDoc		VARCHAR (15)
)
BEGIN

	SELECT 	cliente.`idCliente`, cliente.`idTipoDocumento`, cliente.`nroDoc`, cliente.`razonSocial`,
			cliente.`direccion`, cliente.`telefono`, cliente.`idrol`
			
	FROM cliente	
	WHERE cliente.`nroDoc` = _nroDoc;
	
END$$

DELIMITER $$
CREATE PROCEDURE spu_cliente_OptenerDocumento4
(
	
	IN _nroDoc		VARCHAR (15)
)
BEGIN

	SELECT 	cliente.`idCliente`, cliente.`idTipoDocumento`, cliente.`nroDoc`, cliente.`razonSocial`,
			cliente.`direccion`, cliente.`telefono`, cliente.`idrol`
			
	FROM cliente	
	WHERE cliente.`nroDoc` = _nroDoc;
	
END$$



-- Procedure Registrar Cliente simple
DELIMITER $$
CREATE PROCEDURE spu_clientes_registrar
(
	IN _idTipoDocumento	INT,
	IN _nroDoc		VARCHAR(15),
	IN _razonSocial	VARCHAR(50),
	IN _direccion		VARCHAR(50),
	IN _telefono		VARCHAR(15),
	IN _idrol			INT
)
BEGIN
	INSERT INTO cliente (idTipoDocumento, nroDoc, razonSocial, direccion, telefono, idrol)
	VALUES (_idTipoDocumento, _nroDoc, _razonSocial, _direccion, _telefono, _idrol);

END $$

CALL spu_clientes_registrar(2,45473625, 'Elizabeth Calle Guillen','A.A.H.H Covadonga Mz. R2 Lt. 09', 948907640,3);

SELECT * FROM cliente;


DELIMITER $$
CREATE PROCEDURE spu_modificar_cliente
(
	IN _idCliente		INT,
	IN _idTipoDocumento	INT,
	IN _nroDoc		VARCHAR(15),
	IN _razonSocial	VARCHAR(50),
	IN _direccion		VARCHAR(50),
	IN _telefono		VARCHAR(15),
	IN _idrol			INT
)
BEGIN
UPDATE cliente SET
		idTipoDocumento	= _idTipoDocumento,
		nroDoc			= _nroDoc,
		razonSocial		= _razonSocial,
		direccion			= _direccion,
		telefono			= _telefono,
		idrol			= _idrol
		
	WHERE idCliente = _idCliente;
END $$

CALL spu_modificar_cliente(12, 2, "66664444", "ARAMBURU VIVANCO ROSMERY","mercedes","444455552",3 );


DELIMITER $$ 
CREATE PROCEDURE spu_listarOne_dato_Cliente (IN _idCliente INT)
 BEGIN
	SELECT * FROM  cliente
WHERE
  idCliente = _idCliente;
END


DELIMITER $$
CREATE PROCEDURE spu_cargar_documento()
BEGIN 

	SELECT * FROM tipodocumento;

END $$

CALL spu_cargar_documento();

-- PROCEDIMIENTO CARGAR ROLES
DELIMITER $$
CREATE PROCEDURE spu_cargar_roles()
BEGIN 

	SELECT * FROM roles;

END $$

CALL spu_cargar_roles();

-- PROCEDIMIENTO ELIMINAR CLIENTE
DELIMITER $$
CREATE PROCEDURE spu_eliminar_cliente
(
  IN _idCliente INT
)
BEGIN
	UPDATE cliente SET estado = '0';
END $$

-- PROCEDIMIENTO ELIMINAR CLIENTE
DELIMITER $$
CREATE PROCEDURE spu_eliminar_cliente
(
  IN _idCliente INT
)
BEGIN
	DELETE FROM cliente WHERE idCliente;
END $$

CALL spu_eliminar_cliente (24);



SELECT * FROM cliente;

-- optememos id y datos de un cliente

DELIMITER $$
CREATE PROCEDURE spu_Cliente_OptenerId( IN _idCliente INT)
BEGIN
	SELECT cliente.`idCliente`, cliente.`idTipoDocumento`, cliente.`nroDoc`, 
	cliente.`razonSocial`, cliente.`direccion`, cliente.`telefono`, cliente.`idrol`,
	tipodocumento.`descripcion`,roles.`nombrerol`
	FROM cliente
	INNER JOIN tipodocumento ON tipodocumento.`idTipoDocumento` = cliente.`idTipoDocumento`
	INNER JOIN roles ON roles.`idrol` = cliente.`idrol`
	WHERE  cliente.`idCliente` = _idCliente;
END $$

CALL spu_Cliente_OptenerId(1);

CALL spu_clientes_listar();

-- PROCEDIMIENTO OPTENER ID ROL
DELIMITER $$
CREATE PROCEDURE spu_Roles_OptenerId( IN _idrol INT)
BEGIN
	SELECT roles.`idrol`, roles.`nombrerol`
	FROM roles
	
	WHERE  roles.`idrol` = _idrol;
END $$

CALL spu_Roles_OptenerId (4);