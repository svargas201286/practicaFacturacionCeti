-- procedure cargar producto

DELIMITER $$

CREATE PROCEDURE spu_cargarProducto()
BEGIN 

	SELECT * FROM producto;

END$$

-- procedure listar productos
DELIMITER $$
CREATE PROCEDURE spu_productos_listar()
BEGIN     
    SELECT producto.`idProducto`, producto.`imagen`, producto.`codigo`, producto.`idCategoria`, 
    producto.`fecha`, producto.`precio`, producto.`tipoPrecio`, producto.`idTipoAfectacion`, producto.`idUnidad`,
    CONCAT (producto.`nombre`) AS 'descripcion',     
    CONCAT (categoria.`nombre`) AS 'categoria',
    CONCAT (producto.`stock`, ' ', unidad.`descripcion`)AS 'stock'
    
    FROM producto
    INNER JOIN categoria ON categoria.`idCategoria` = producto.`idCategoria`
    INNER JOIN tipoafectacion ON tipoafectacion.`idTipoAfectacion` = producto.`idTipoAfectacion`
    INNER JOIN unidad ON unidad.`idUnidad` = producto.`idUnidad`
    ORDER BY idProducto; 
END $$

CALL spu_productos_listar();

select * from productos;