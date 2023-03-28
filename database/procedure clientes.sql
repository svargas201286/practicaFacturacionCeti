
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
CALL spu_clientes_listar();


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

select * from cliente;


DELIMITER $$
CREATE PROCEDURE spu_modificar_cliente
(
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


DELIMITER $$
CREATE PROCEDURE spu_cargar_roles()
BEGIN 

	SELECT * FROM roles;

END $$

CALL spu_cargar_roles();


DELIMITER $$
CREATE PROCEDURE spu_eliminar_cliente
(
  IN _idCliente INT
)
BEGIN
	UPDATE cliente SET estado = '0';
END $$


UPDATE cliente SET estado = '1';

select * from cliente;

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

call spu_Cliente_OptenerId(1);

CALL spu_clientes_listar();
