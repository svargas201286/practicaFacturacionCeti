
DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN _userName VARCHAR(30))
BEGIN
	SELECT usuarios.`idUsuario`, 
	CONCAT (cliente.`razonSocial`)AS 'Cliente',
	usuarios.`userName`, usuarios.`userPassword`
	FROM usuarios
	INNER JOIN cliente ON cliente.`idCliente` = usuarios.`idCliente`
	WHERE userName = _userName AND estado = '1';

END $$

CALL spu_usuarios_login ('samuel');


DELIMITER $$
CREATE PROCEDURE spu_usuarios_actualizarClave
(
	IN _idUsuario 		INT,
	IN _userPassword 	VARCHAR(100)
)
BEGIN
	UPDATE usuarios SET userPassword = _userPassword WHERE idUsuario = _idUsuario;
END $$

UPDATE usuarios SET userPassword ='$2y$10$C8Y35IM6oM1UaZyr5/wVQuezarjgk6fdwSZb44z/i9KJ0RpT3dTVW';

SELECT * FROM usuarios;
