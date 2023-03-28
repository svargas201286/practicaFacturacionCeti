<?php

class api_facturacion
{
    //Nos permitirá enviar los XML de Factura, Boleta, Nota de Credito y Nota de Debito
    public function enviar_comprobante($emisor, $nombreXML, $ruta_certificado = 'certificado_digital/', $ruta_archivo_xml = 'xml/', $ruta_archivo_cdr = 'cdr/')
    {
        $estado_envio = 0;

        //FIRMA DIGITALMENTE EL XML
        require_once 'signature.php';
        $objFirma = new Signature();
        $flgFirma = 0; //ubicacion de la firma en el XML
        $ruta_certificado = $ruta_certificado . 'certificado_prueba.pfx';
        $pass_certificado = 'sereexitoso1986';
        $ruta_xml = $ruta_archivo_xml . $nombreXML . '.XML';

        $resp= $objFirma->signature_xml($flgFirma, $ruta_xml, $ruta_certificado, $pass_certificado);

        $estado_envio = 1;
        $estado_envio_mensaje = "XML FIRMADO DIGITALMENTE";


        //COMPRIMIR EL XML FIRMADO DIGITALMENTE EN FORMATO ZIP
        $zip = new ZipArchive();
        $ruta_zip = $ruta_archivo_xml . $nombreXML . '.ZIP';

        if ($zip->open($ruta_zip, ZipArchive::CREATE) == true) {
            $zip->addFile($ruta_xml, $nombreXML . '.XML');
            $zip->close();
        }
        $estado_envio = 2;
        $estado_envio_mensaje = "XML COMPRIMIDO EN FORMATO ZIP";

        //CODIFICAR EN BASE64 EL ZIP
        $zip_codificado = base64_encode(file_get_contents($ruta_zip));
        echo $zip_codificado;
        $estado_envio = 3;
        $estado_envio_mensaje = "CODIFICADO EL ZIP EN BASE 64";


        //CONSUMO DEL WEB SERVICE DE SUNAT
        $url_ws = "https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService"; //BETA
        //$url_ws = "https://e-factura.sunat.gob.pe/ol-ti-itcpfegem/billService"; //PRODUCCION

        $filename_zip = $nombreXML . '.ZIP';

        $xml_envelope = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
        xmlns:ser="http://service.sunat.gob.pe" xmlns:wsse="http://docs.oasisopen.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
            <soapenv:Header>
                <wsse:Security>
                    <wsse:UsernameToken>
                        <wsse:Username>' . $emisor['nrodoc'] . $emisor['usuario_secundario'] . '</wsse:Username>
                        <wsse:Password>' . $emisor['clave_usuario_secundario'] . '</wsse:Password>
                    </wsse:UsernameToken>
                </wsse:Security>
            </soapenv:Header>
            
            <soapenv:Body>
                <ser:sendBill>
                    <fileName>' . $filename_zip . '</fileName>
                    <contentFile>' . $zip_codificado . '</contentFile>
                </ser:sendBill>
            </soapenv:Body>
        </soapenv:Envelope>';


        //curl para consumir servicios
        //crear el servicio
        $ch = curl_init();

        //setear los parametros
        curl_setopt($ch, CURLOPT_URL, $url_ws);//indicamos la ruta del web service de sunat
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_envelope); //enviamso el XML envelope con el metodo POST

        //Ejecutamos el servicio y obtenemos la respuesta de sunat
        $output = curl_exec($ch);

        //obejte el codigo HTTP de respuesta
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $estado_envio = 4;
        $estado_envio_mensaje = "CONSUMO DEL WEB SERVICES DE SUNAT";

        //RESPUESTA O REPECION DE WS
        $descripcion = ""; //mensjae de sunat dentro del xml de rpta
        $nota = ""; //mensaje de sunat, indica alguna obser
        $codigo = ""; //mensaje de sunat, para indicar el codigo de error
        $mensaje = ""; //mensaje de sunat, para indicar el mensaje de error

        if ($http_code == 200) { //ok hubo rpta
            $doc = new DOMDocument();
            $doc->loadXML($output); //convertimos en XML lo enviado por SUNAT

            if (isset($doc->getElementsByTagName('applicationResponse')->item(0)->nodeValue)) {
                $cdr = $doc->getElementsByTagName('applicationResponse')->item(0)->nodeValue;
                $estado_envio = 5;
                $estado_envio_mensaje = "SE OBTUVO RPTA DE SUNAT - CDR";

                //DECODIFICAR
                $cdr = base64_decode($cdr);
                $estado_envio = 6;
                $estado_envio_mensaje = "SE DECODFICO EN BASE 64, OBTUVIMOS EL ZIP";

                //copiar a discto el ZIP y extraer el contenido
                file_put_contents($ruta_archivo_cdr . 'R-' . $filename_zip, $cdr);
                $estado_envio = 7;
                $estado_envio_mensaje = "ZIP COPIADO A DISCO";

                //extraer el contenido del zip: CDR
                $zip = new ZipArchive();
                if ($zip->open($ruta_archivo_cdr . 'R-' . $filename_zip) == TRUE) {
                    $zip->extractTo($ruta_archivo_cdr);
                    $zip->close();

                    $xml_cdr = $ruta_archivo_cdr . 'R-' . $nombreXML . '.XML';
                    $doc_cdr = new DOMDocument();
                    $doc_cdr->loadXML(file_get_contents($xml_cdr));

                    if (isset($doc_cdr->getElementsByTagName('Description')->item(0)->nodeValue)) {
                        $descripcion = $doc_cdr->getElementsByTagName('Description')->item(0)->nodeValue;
                    }

                    if (isset($doc_cdr->getElementsByTagName('Note')->item(0)->nodeValue)) {
                        $nota = $doc_cdr->getElementsByTagName('Note')->item(0)->nodeValue;
                    }

                    $estado_envio = 8;
                    $estado_envio_mensaje = "PROCESO TERMINADO CON EXITO";
                }                
            }
            else{
                $codigo = $doc->getElementsByTagName('faultcode')->item(0)->nodeValue;
                $mensaje = $doc->getElementsByTagName('faultstring')->item(0)->nodeValue;

                $estado_envio = 9;
                $estado_envio_mensaje = "ERROR/RECHAZO DE SUNAT";
            }
        }else{
            curl_error($ch);
            $estado_envio = 10;
            $estado_envio_mensaje = "ERROR EN EL CONSUMO DEL WS/RED/CONEXION";

            $doc = new DOMDocument();
            $doc->loadXML($output); //convertimos en XML lo enviado por SUNAT

            $codigo = $doc->getElementsByTagName('faultcode')->item(0)->nodeValue;
            $mensaje = $doc->getElementsByTagName('faultstring')->item(0)->nodeValue;

            $estado_envio = 9;
            $estado_envio_mensaje = "ERROR/RECHAZO DE SUNAT";

            $output = 'Error en consumo del WS/RED/CONEXION';
        }

        $estado_envio = array(
            "estado"                =>  $estado_envio,
            "estado_mensaje"        =>  $estado_envio_mensaje,
            "hash_cpe"              =>  $resp['hash_cpe'],
            "descripcion"           =>  $descripcion,
            "nota"                  =>  $nota,
            "codigo_error"          =>  str_replace('soap-env:Cliente.', "", $codigo),
            "mensaje_error"         =>  $mensaje,
            "http_code"             =>  $http_code,
            "output"                =>  $output
        );

        return $estado_envio;
    }


    public function enviar_resumen($emisor, $nombreXML, $ruta_certificado = 'certificado_digital/', $ruta_archivo_xml = 'xml/')
    {
        $estado_envio = 0;

        //FIRMA DIGITALMENTE EL XML
        require_once 'signature.php';
        $objFirma = new Signature();
        $flgFirma = 0; //ubicacion de la firma en el XML
        $ruta_certificado = $ruta_certificado . 'certificado_prueba.pfx';
        $pass_certificado = 'sereexitoso1986';
        $ruta_xml = $ruta_archivo_xml . $nombreXML . '.XML';

        $resp = $objFirma->signature_xml($flgFirma, $ruta_xml, $ruta_certificado, $pass_certificado);

        $estado_envio = 1;
        $estado_envio_mensaje = "XML FIRMADO DIGITALMENTE";


        //COMPRIMIR EL XML FIRMADO DIGITALMENTE EN FORMATO ZIP
        $zip = new ZipArchive();
        $ruta_zip = $ruta_archivo_xml . $nombreXML . '.ZIP';

        if ($zip->open($ruta_zip, ZipArchive::CREATE) == true) {
            $zip->addFile($ruta_xml, $nombreXML . '.XML');
            $zip->close();
        }
        $estado_envio = 2;
        $estado_envio_mensaje = "XML COMPRIMIDO EN FORMATO ZIP";

        //CODIFICAR EN BASE64 EL ZIP
        $zip_codificado = base64_encode(file_get_contents($ruta_zip));
        //echo $zip_codificado;
        $estado_envio = 3;
        $estado_envio_mensaje = "CODIFICADO EL ZIP EN BASE 64";


        //CONSUMO DEL WEB SERVICE DE SUNAT
        $url_ws = "https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService"; //BETA
        //$url_ws = "https://e-factura.sunat.gob.pe/ol-ti-itcpfegem/billService"; //PRODUCCION

        $filename_zip = $nombreXML . '.ZIP';

        $xml_envelope = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
        xmlns:ser="http://service.sunat.gob.pe" xmlns:wsse="http://docs.oasisopen.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
            <soapenv:Header>
                <wsse:Security>
                    <wsse:UsernameToken>
                        <wsse:Username>' . $emisor['nrodoc'] . $emisor['usuario_secundario'] . '</wsse:Username>
                        <wsse:Password>' . $emisor['clave_usuario_secundario'] . '</wsse:Password>
                    </wsse:UsernameToken>
                </wsse:Security>
            </soapenv:Header>
            <soapenv:Body>
                <ser:sendSummary>
                    <fileName>' . $filename_zip . '</fileName>
                    <contentFile>' . $zip_codificado . '</contentFile>
                </ser:sendSummary>
            </soapenv:Body>
        </soapenv:Envelope>';


        //curl para consumir servicios
        //crear el servicio
        $ch = curl_init();

        //setear los parametros
        curl_setopt($ch, CURLOPT_URL, $url_ws);//indicamos la ruta del web service de sunat
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_envelope); //enviamso el XML envelope con el metodo POST

        //Ejecutamos el servicio y obtenemos la respuesta de sunat
        $output = curl_exec($ch);

        //obejte el codigo HTTP de respuesta
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $estado_envio = 4;
        $estado_envio_mensaje = "CONSUMO DEL WEB SERVICES DE SUNAT";

        //RESPUESTA O REPECION DE WS
        $descripcion = ""; //mensjae de sunat dentro del xml de rpta
        $nota = ""; //mensaje de sunat, indica alguna obser
        $codigo = ""; //mensaje de sunat, para indicar el codigo de error
        $mensaje = ""; //mensaje de sunat, para indicar el mensaje de error
        $ticket = "";

        if ($http_code == 200) { //ok hubo rpta
            $doc = new DOMDocument();
            $doc->loadXML($output); //convertimos en XML lo enviado por SUNAT

            if (isset($doc->getElementsByTagName('ticket')->item(0)->nodeValue)) {
                $ticket = $doc->getElementsByTagName('ticket')->item(0)->nodeValue;
                $estado_envio = 5;
                $estado_envio_mensaje = "SE OBTUVO EL NRO DE TICKET: " . $ticket;
            }
            else{
                $codigo = $doc->getElementsByTagName('faultcode')->item(0)->nodeValue;
                $mensaje = $doc->getElementsByTagName('faultstring')->item(0)->nodeValue;

                $estado_envio = 9;
                $estado_envio_mensaje = "ERROR/RECHAZO DE SUNAT";
            }
        }else{
            curl_error($ch);
            $estado_envio = 10;
            $estado_envio_mensaje = "ERROR EN EL CONSUMO DEL WS/RED/CONEXION";

            $doc = new DOMDocument();
            $doc->loadXML($output); //convertimos en XML lo enviado por SUNAT

            $codigo = $doc->getElementsByTagName('faultcode')->item(0)->nodeValue;
            $mensaje = $doc->getElementsByTagName('faultstring')->item(0)->nodeValue;

            $estado_envio = 9;
            $estado_envio_mensaje = "ERROR/RECHAZO DE SUNAT";

            $output = 'Error en consumo del WS/RED/CONEXION';
        }

        $estado_envio = array(
            "estado"                =>  $estado_envio,
            "estado_mensaje"        =>  $estado_envio_mensaje,
            "hash_cpe"              =>  $resp['hash_cpe'],
            "descripcion"           =>  $descripcion,
            "nota"                  =>  $nota,
            "codigo_error"          =>  str_replace('soap-env:Client.', "", $codigo),
            "mensaje_error"         =>  $mensaje,
            "http_code"             =>  $http_code,
            "output"                =>  $output,
            "ticket"                =>  $ticket
        );

        return $estado_envio;
    }


    public function consultar_ticket($emisor, $cabecera, $ticket, $ruta_archivo_cdr = 'cdr/')
    {
         //CONSUMO DEL WEB SERVICE DE SUNAT
         $url_ws = "https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService"; //BETA
         //$url_ws = "https://e-factura.sunat.gob.pe/ol-ti-itcpfegem/billService"; //PRODUCCION
 
         $xml_envelope = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
         xmlns:ser="http://service.sunat.gob.pe" xmlns:wsse="http://docs.oasisopen.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
             <soapenv:Header>
                 <wsse:Security>
                     <wsse:UsernameToken>
                         <wsse:Username>' . $emisor['nrodoc'] . $emisor['usuario_secundario'] . '</wsse:Username>
                         <wsse:Password>' . $emisor['clave_usuario_secundario'] . '</wsse:Password>
                     </wsse:UsernameToken>
                 </wsse:Security>
             </soapenv:Header>
             <soapenv:Body>
                 <ser:getStatus>
                     <ticket>' . $ticket . '</ticket>
                 </ser:getStatus>
             </soapenv:Body>
         </soapenv:Envelope>';
 
 
         //curl para consumir servicios
         //crear el servicio
         $ch = curl_init();
 
         //setear los parametros
         curl_setopt($ch, CURLOPT_URL, $url_ws);//indicamos la ruta del web service de sunat
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_envelope); //enviamso el XML envelope con el metodo POST
 
         //Ejecutamos el servicio y obtenemos la respuesta de sunat
         $output = curl_exec($ch);
 
         //obejte el codigo HTTP de respuesta
         $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
         $estado_envio = 4;
         $estado_envio_mensaje = "CONSUMO DEL WEB SERVICES DE SUNAT";
 
         //RESPUESTA O REPECION DE WS
         $descripcion = ""; //mensjae de sunat dentro del xml de rpta
         $nota = ""; //mensaje de sunat, indica alguna obser
         $codigo = ""; //mensaje de sunat, para indicar el codigo de error
         $mensaje = ""; //mensaje de sunat, para indicar el mensaje de error

         $nombreXML = $emisor['nrodoc'] . '-' . $cabecera['tipodoc'] . '-' . $cabecera['serie'] . '-' . $cabecera['correlativo'];
         $filename_zip = $nombreXML . '.ZIP';

         if ($http_code == 200) { //ok hubo rpta
            $doc = new DOMDocument();
            $doc->loadXML($output); //convertimos en XML lo enviado por SUNAT

            if (isset($doc->getElementsByTagName('content')->item(0)->nodeValue)) {
                $cdr = $doc->getElementsByTagName('content')->item(0)->nodeValue;
                $estado_envio = 5;
                $estado_envio_mensaje = "SE OBTUVO RPTA DE SUNAT - CDR";

                //DECODIFICAR
                $cdr = base64_decode($cdr);
                $estado_envio = 6;
                $estado_envio_mensaje = "SE DECODFICO EN BASE 64, OBTUVIMOS EL ZIP";

                //copiar a discto el ZIP y extraer el contenido
                file_put_contents($ruta_archivo_cdr . 'R-' . $filename_zip, $cdr);
                $estado_envio = 7;
                $estado_envio_mensaje = "ZIP COPIADO A DISCO";

                //extraer el contenido del zip: CDR
                $zip = new ZipArchive();
                if ($zip->open($ruta_archivo_cdr . 'R-' . $filename_zip) == TRUE) {
                    $zip->extractTo($ruta_archivo_cdr);
                    $zip->close();

                    $xml_cdr = $ruta_archivo_cdr . 'R-' . $nombreXML . '.XML';
                    $doc_cdr = new DOMDocument();
                    $doc_cdr->loadXML(file_get_contents($xml_cdr));

                    if (isset($doc_cdr->getElementsByTagName('Description')->item(0)->nodeValue)) {
                        $descripcion = $doc_cdr->getElementsByTagName('Description')->item(0)->nodeValue;
                    }

                    if (isset($doc_cdr->getElementsByTagName('Note')->item(0)->nodeValue)) {
                        $nota = $doc_cdr->getElementsByTagName('Note')->item(0)->nodeValue;
                    }

                    $estado_envio = 8;
                    $estado_envio_mensaje = "PROCESO TERMINADO CON EXITO";
                }                
            }
            else{
                $codigo = $doc->getElementsByTagName('faultcode')->item(0)->nodeValue;
                $mensaje = $doc->getElementsByTagName('faultstring')->item(0)->nodeValue;

                $estado_envio = 9;
                $estado_envio_mensaje = "ERROR/RECHAZO DE SUNAT";
            }
        }else{
            curl_error($ch);
            $estado_envio = 10;
            $estado_envio_mensaje = "ERROR EN EL CONSUMO DEL WS/RED/CONEXION";

            $doc = new DOMDocument();
            $doc->loadXML($output); //convertimos en XML lo enviado por SUNAT

            $codigo = $doc->getElementsByTagName('faultcode')->item(0)->nodeValue;
            $mensaje = $doc->getElementsByTagName('faultstring')->item(0)->nodeValue;

            $estado_envio = 9;
            $estado_envio_mensaje = "ERROR/RECHAZO DE SUNAT";

            $output = 'Error en consumo del WS/RED/CONEXION';
        }

        $estado_envio = array(
            "estado"                =>  $estado_envio,
            "estado_mensaje"        =>  $estado_envio_mensaje,
            "descripcion"           =>  $descripcion,
            "nota"                  =>  $nota,
            "codigo_error"          =>  str_replace('soap-env:Cliente.', "", $codigo),
            "mensaje_error"         =>  $mensaje,
            "http_code"             =>  $http_code,
            "output"                =>  $output
        );

        return $estado_envio;

    }
}

?>