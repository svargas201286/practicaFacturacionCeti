
-- cargar emisor
DELIMITER $$
CREATE PROCEDURE spu_emisor_listar()
BEGIN 

	SELECT * FROM emisor;

END $$


-- listarMonedas
DELIMITER $$
CREATE PROCEDURE spu_moneda_listar()
BEGIN 

	SELECT * FROM moneda;

END $$
 
 CALL spu_moneda_listar();
 
 
