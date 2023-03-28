<?php

$emisor = array(
    'tipodoc'                   =>  '6', //6: RUC
    'nrodoc'                    =>  '20123456789',
    'razon_social'              =>  'CETI',
    'nombre_comercial'          =>  'CETI',
    'direccion'                 =>  'CIX',
    'ubigeo'                    =>  '130101',
    'departamento'              =>  'LAMBAYEQUE',
    'provincia'                 =>  'CHICLAYO',
    'distrito'                  =>  'CHICLAYO',
    'pais'                      =>  'PE',
    'usuario_secundario'        =>  'MODDATOS',
    'clave_usuario_secundario'  =>  'MODDATOS'
);

$cliente = array(
    'tipodoc'                   =>  '6',//ruc:6, dni: 1
    'nrodoc'                    =>  '20202020202',
    'razon_social'              =>  'BRUNO DIAZ',
    'direccion'                 =>  'CIUDAD GOTIKA',
    'pais'                      =>  'PE'
);


$comprobante = array(
    'tipodoc'                   =>  '01', //factura= 01, boleta = 03
    'serie'                     =>  'FXYZ',
    'correlativo'               =>  '1000',
    'fecha_emision'             =>  date('Y-m-d'),
    'hora'                      =>  '00:00:00',
    'fecha_vencimiento'         =>  date('Y-m-d'),
    'moneda'                    =>  'PEN', //SOLES=PEN, DOLARES=USD
    'forma_pago'                =>  'Credito',
    'monto_pendiente'           =>  500.00,
    'total_opgravadas'          =>  0.00,
    'total_opexoneradas'        =>  0.00,
    'total_opinafectas'         =>  0.00,
    'total_opgratuitas_1'       =>  0.00,
    'total_opgratuitas_2'       =>  0.00,
    'total_impbolsas'           =>  0.00,
    'igv'                       =>  0.00,
    'total'                     =>  0.00,
    'total_texto'               =>  '',
);


$cuotas = array(
    array(
        'cuota'         =>  'Cuota001',
        'monto'         =>  250.00,
        'fecha'         =>  '2023-03-01'
    ),
    array(
        'cuota'         =>  'Cuota002',
        'monto'         =>  250.00,
        'fecha'         =>  '2023-03-30'
    )
);

$detalle = array(

    array(
        'item'                  => 1,
        'codigo'                =>  '111',
        'descripcion'           =>  'IMPRESORA EPSON XXX',
        'cantidad'              =>  1,
        'precio_unitario'       =>  800, //incluye impuestos IGV
        'valor_unitario'        =>  677.97, //sin impuestos
        'igv'                   =>  122.03,        
        'porcentaje_igv'        =>  18,
        'importe_total'         =>  800.00, //cantidad * precio unitario
        'valor_total'           =>  677.97, //cantidad * valor unitario
        
        'tipo_precio'           =>  '01', //01: onerosas, 02: no onerosas
        'unidad'                =>  'NIU',
        'bolsa_plastica'        =>  'NO',
        //IMPORTANTE 3 : Catálogo No. 05: Códigos de tipos de tributos
        'tipo_afectacion_igv'   =>  '10', //gravados: 10, exonerados: 20, inafectos:30
        'codigo_tipo_tributo'   =>  '1000',
        'tipo_tributo'          =>  'VAT',
        'nombre_tributo'        =>  'IGV'
    ),
    array(
        'item'                  => 2,
        'codigo'                =>  '12123',
        'descripcion'           =>  'LAPTOP HP',
        'cantidad'              =>  1,
        'precio_unitario'       =>  2000, //incluye impuestos IGV
        'valor_unitario'        =>  1694.92, //sin impuestos
        'igv'                   =>  305.08,        
        'porcentaje_igv'        =>  18,
        'importe_total'         =>  2000.00, //cantidad * precio unitario
        'valor_total'           =>  1694.92, //cantidad * valor unitario
        
        'tipo_precio'           =>  '01', //01: onerosas, 02: no onerosas
        'unidad'                =>  'NIU',
        'bolsa_plastica'        =>  'NO',
        //IMPORTANTE 3 : Catálogo No. 05: Códigos de tipos de tributos
        'tipo_afectacion_igv'   =>  '10', //gravados: 10, exonerados: 20, inafectos:30
        'codigo_tipo_tributo'   =>  '1000',
        'tipo_tributo'          =>  'VAT',
        'nombre_tributo'        =>  'IGV'
    ),
    array(
        'item'                  =>  3,
        'codigo'                =>  '79798',
        'descripcion'           =>  'LIBRO: NO SE LO DIGAS A NADIE',
        'cantidad'              =>  1,
        'precio_unitario'       =>  50, //incluye impuestos IGV = 0
        'valor_unitario'        =>  50, //sin impuestos
        'igv'                   =>  0,        
        'porcentaje_igv'        =>  0,
        'importe_total'         =>  50.00, //cantidad * precio unitario
        'valor_total'           =>  50.00, //cantidad * valor unitario
        
        'tipo_precio'           =>  '01', //01: onerosas, 02: no onerosas
        'unidad'                =>  'NIU',
        'bolsa_plastica'        =>  'NO',
        //IMPORTANTE 3 : Catálogo No. 05: Códigos de tipos de tributos
        'tipo_afectacion_igv'   =>  '20', //gravados: 10, exonerados: 20, inafectos:30
        'codigo_tipo_tributo'   =>  '9997',
        'tipo_tributo'          =>  'VAT',
        'nombre_tributo'        =>  'EXO'
    ),
    array(
        'item'                  =>  4,
        'codigo'                =>  '7878787',
        'descripcion'           =>  'MANZANA ROJA IMPORTADA USA',
        'cantidad'              =>  12,
        'precio_unitario'       =>  2, //incluye impuestos IGV = 0
        'valor_unitario'        =>  2, //sin impuestos
        'igv'                   =>  0,        
        'porcentaje_igv'        =>  0,
        'importe_total'         =>  24.00, //cantidad * precio unitario
        'valor_total'           =>  24.00, //cantidad * valor unitario
        
        'tipo_precio'           =>  '01', //01: onerosas, 02: no onerosas
        'unidad'                =>  'NIU',
        'bolsa_plastica'        =>  'NO',
        //IMPORTANTE 3 : Catálogo No. 05: Códigos de tipos de tributos
        'tipo_afectacion_igv'   =>  '30', //gravados: 10, exonerados: 20, inafectos:30
        'codigo_tipo_tributo'   =>  '9998',
        'tipo_tributo'          =>  'FRE',
        'nombre_tributo'        =>  'INA'
    ),

);

//INICIALIZAR VARIABLES
$total_opgravadas = 0.00;
$total_opexoneradas  = 0.00;
$total_opinafectas  = 0.00;
$total_opgratuitas  = 0.00;
$total_impbolsas  = 0.00;
$igv = 0.00;
$total = 0.00;

foreach ($detalle as $key => $value) {
    if ($value['tipo_afectacion_igv'] == 10) { //gravado
        $total_opgravadas += $value['valor_total'];
    }

    if ($value['tipo_afectacion_igv'] == 20) { //exonerada
        $total_opexoneradas += $value['valor_total'];
    }

    if ($value['tipo_afectacion_igv'] == 30) { //inafectos
        $total_opinafectas += $value['valor_total'];
    }

    $igv += $value['igv'];
    $total +=$value['importe_total'];
}

$comprobante['total_opgravadas'] = $total_opgravadas;
$comprobante['total_opexoneradas'] = $total_opexoneradas;
$comprobante['total_opinafectas'] = $total_opinafectas;
$comprobante['total_impbolsas'] = $total_impbolsas;
$comprobante['total_opgratuitas_1'] = $total_opgratuitas;
$comprobante['igv'] = $igv;
$comprobante['total'] = $total;

//PASO 01 - CREAR EL XML DE FACTURA
require_once 'api_genera_xml.php';
$objXML = new api_genera_xml();

//sunat indica que el nombre del xml tenga la sigueinte estructura: RUC-TIPO-SERIE-CORRELATIVO.XML
$nombreXML = $emisor['nrodoc'] . '-' . $comprobante['tipodoc'] . '-' . $comprobante['serie'] . '-' . $comprobante['correlativo'];

//donde guardamos los xml, el directorio llamado XML
$rutaXML = 'xml/';

$objXML->crea_xml_invoice($rutaXML . $nombreXML, $emisor, $cliente, $comprobante, $detalle, $cuotas);
echo '</br> PARTE 01: XML DE FACTURA CREADA';


//PASO 02: ENVIO A SUNAT
require_once 'api_facturacion.php';

$objFac = new api_facturacion();
$estado_facturacion = $objFac->enviar_comprobante($emisor, $nombreXML);

echo '</br> Estado Facturación: ' . $estado_facturacion['estado'];
echo '</br> Mensaje Facturación: ' . $estado_facturacion['estado_mensaje'];
echo '</br> hash_cpe: ' . $estado_facturacion['hash_cpe'];
echo '</br> Descripcion: ' . $estado_facturacion['descripcion'];
echo '</br> Nota: ' . $estado_facturacion['nota'];
echo '</br> Codigo de error: ' . $estado_facturacion['codigo_error'];
echo '</br> Mensaje de error: ' . $estado_facturacion['mensaje_error'];
echo '</br> HTTP CODE: ' . $estado_facturacion['http_code'];
echo '</br> Output: ' . $estado_facturacion['output'];

?>