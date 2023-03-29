<?php
session_start();

if ($_SESSION['acceso'] == false) {
    //Login
    header('Location:index.php');
}

require_once '../models/ModelclsCliente.php';

if (isset($_GET['op'])) {

    $cliente = new clsCliente();

    if ($_GET['op'] == 'listCliente') { // PROBADO -- PODRIA MEJORARSE

        $datos = $cliente->listarCliente();
        // var_dump($datos);
        if ($datos) {

            foreach ($datos as $listaCliente) {
                echo "
            <tr>
                
                <td>{$listaCliente->razonSocial}</td>
                <td>{$listaCliente->documento}</td>                
                <td>{$listaCliente->tipo}</td>
                <td>{$listaCliente->direccion}</td>
                <td>{$listaCliente->telefono}</td>
                
                <td class='td-actions text-right'> 

                     <button data-idCliente='{$listaCliente->idCliente}' type='button' rel='tooltip' style='color:black' class='get btn btn-info btn-round' data-original-title='' title='Ver'>
                        <i class='material-icons'>visibility</i>
                     </button>

                     <button  data-idCliente='{$listaCliente->idCliente}' type='button' rel='tooltip' style='color:black' class='editar btn btn-success btn-round' title='Editar'>
                     <i class='material-icons'>edit</i>
                     </button>

                    <button data-idCliente='{$listaCliente->idCliente}' type='button' rel='tooltip' style='color:black' class='btn btn-danger btn-round' data-original-title='' title='Eliminar'>
                        <i class='material-icons'>delete_forever</i>
                    </button>
                </td>

            </tr>
        ";
            }
        } else {
            echo '-1'; //Quiere decir que no hay datos
        }
    }
    // carga documentos para select
    if ($_GET['op'] == "CargarDocumento") {
        $Documento = $cliente->listarDocumentos();
        // var_dump($Documento);
        if ($Documento) {
            foreach ($Documento as $unDocumento) {
                echo "<option value='{$unDocumento->idTipoDocumento}'>{$unDocumento->descripcion}</option>";
            }
        }
    }

    if ($_GET['op'] == "CargarRoles") {
        $Roles = $cliente->listarRoles();
        // var_dump($Documento);
        if ($Roles) {
            foreach ($Roles as $unRoles) {
                echo "<option value='{$unRoles->idrol}'>{$unRoles->nombrerol}</option>";
            }
        }
    }

    // REGISTRAR CLIENTE
    if ($_GET['op'] == 'RegistrarCliente') {
        $datos = [
            "idTipoDocumento"   => $_GET['idTipoDocumento'],
            "nroDoc"            => $_GET['nroDoc'],
            "razonSocial"       => $_GET['razonSocial'],
            "direccion"         => $_GET['direccion'],
            "telefono"          => $_GET['telefono'],
            "idrol"             => $_GET['idrol']
        ];

        $cliente->RegistrarCliente($datos);
    }

    //OPTENER ID CLIENTE

    if ($_GET['op'] == "IDCliente") { //

        $data = $cliente->OptenerIdCliente(["idCliente" => $_GET['idCliente']]);
        // print_r($data);
        if ($data) {
            foreach ($data as $undata) {
                echo json_encode($undata);
            }
        } else {
            echo '-1';
        }
    }

    // MODIFICAR CLIENTE
    if ($_GET['op'] == 'modificarCliente') {
        //Array asociativo con todos los datos
        $datosmodificar = [
            "idCliente"         => $_GET["idCliente"],
            "idTipoDocumento"   => $_GET["idTipoDocumento"],
            "nroDoc"            => $_GET["nroDoc"],
            "razonSocial"       => $_GET["razonSocial"],
            "direccion"         => $_GET["direccion"],
            "telefono"          => $_GET["telefono"],
            "idrol"             => $_GET["idrol"]
        ];
        $cliente->modificarCliente($datosmodificar);
    }

}
