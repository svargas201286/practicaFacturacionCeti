<?php

$emisor = array(
    'tipodoc'                   =>  '6',
    'nrodoc'                    =>  '20123456789',
    'razon_social'              =>  'CETI ORG',
    'nombre_comercial'          =>  'CETI',
    'direccion'                 =>  'VIRTUAL',
    'ubigeo'                    =>  '130101',
    'departamento'              =>  'LAMBAYEQUE',
    'provincia'                 =>  'CHICLAYO',
    'distrito'                  =>  'CHICLAYO',
    'pais'                      =>  'PE',
    'usuario_secundario'        =>  'MODDATOS',
    'clave_usuario_secundario'  =>  'MODDATOS'
);

$cabecera = array(
    'tipodoc'                   =>  'RA', //RC:resumen de comprobantes, RA: resumen de anulaciones
    'serie'                     =>  date('Ymd'),
    'correlativo'               =>  1,
    'fecha_emision'             =>  date('Y-m-d'),
    'fecha_envio'               =>  date('Y-m-d')
);

$detalle = array();

$cant_comp = 10;

for ($i=1; $i <= $cant_comp ; $i++) { 
    $detalle[] = array(
        'item'                  =>  $i,
        'tipodoc'               =>  '01', //FA
        'serie'                 =>  'F001',
        'correlativo'           =>  $i,
        'motivo'                =>  'ERROR EN EL DOCUMENTO'
    );
}

//CONSUMIR EL API DE CREACION DEL XML DE RESUMEN DE COMPROBANTES
require_once('api_genera_xml.php');

$objXML = new api_genera_xml();
$nombreXML = $emisor['nrodoc'] . '-' . $cabecera['tipodoc'] . '-' . $cabecera['serie'] . '-' . $cabecera['correlativo'];
$rutaXML = 'xml/';

$objXML->CrearXmlBajaDocumentos($emisor, $cabecera, $detalle, $rutaXML . $nombreXML);
echo '</br> XML de resumen de bajas creado';

//CONSUMIR API DE ENVIO A FE SUNAT
require_once('api_facturacion.php');
$apiFact = new api_facturacion();
$estado_facturacion = $apiFact->enviar_resumen($emisor, $nombreXML);

echo '</br> Nro de ticket: ' . $estado_facturacion['ticket'];

if($estado_facturacion['ticket'] > 0){
    $estado_facturacion = $apiFact->consultar_ticket($emisor, $cabecera, $estado_facturacion['ticket']);
}

echo '</br> Estado Facturación: ' . $estado_facturacion['estado'];
echo '</br> Mensaje Facturación: ' . $estado_facturacion['estado_mensaje'];
echo '</br> Descripcion: ' . $estado_facturacion['descripcion'];
echo '</br> Nota: ' . $estado_facturacion['nota'];
echo '</br> Codigo de error: ' . $estado_facturacion['codigo_error'];
echo '</br> Mensaje de error: ' . $estado_facturacion['mensaje_error'];
echo '</br> HTTP CODE: ' . $estado_facturacion['http_code'];
echo '</br> Output: ' . $estado_facturacion['output'];


?>