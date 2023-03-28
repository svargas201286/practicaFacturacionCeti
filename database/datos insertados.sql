SELECT * FROM categoria;

DROP TABLE categoria;


-- insertando roles

INSERT INTO roles(nombrerol) VALUES
('Administrador'),
('Vendedor'),
('Cliente'),
('Proveedor');

SELECT * FROM usuarios;
SELECT * FROM roles;

INSERT INTO usuarios (`idCliente`, userName, userPassword, idrol)VALUES
(1,'samuel','$2y$10$C8Y35IM6oM1UaZyr5/wVQuezarjgk6fdwSZb44z/i9KJ0RpT3dTVW',1);

-- insertando datos a unidad
INSERT INTO unidades(simbolo, nombre)VALUES
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


INSERT INTO tiponegocio (tipo)VALUES
('Ventas generales'),
('Restaurante'),
('Ventas con imagenes'),
('Farmacia'),
('Mina'),
('Hotel'),
('autos'),
('Corrier');

SELECT * FROM configuraciones;
SELECT * FROM tiponegocio;

INSERT INTO configuracion(ruc, razonSocial, nombreComercial, direccion,idNegocio)VALUES
(20574735093,'MARK HOLDING E.I.R.L','MARK HOLDING E.I.R.L', 'AV. LOS INCAS NRO.650',1);


SELECT * FROM items;

INSERT INTO items (nombre, codigo, precio, idCategoria, descripcion, estado)VALUES
('escritorio','12345',251,'muebles'),
('estante','12345',301,'');

SELECT * FROM ventas;
SELECT * FROM monedas;
SELECT * FROM items;
SELECT * FROM categorias;

INSERT INTO monedas (moneda, simbolo)VALUES
('(PEN)Nuevo Sol','PEN');



