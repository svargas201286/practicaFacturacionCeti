<?php
session_start();

if ($_SESSION['acceso'] == false) {
    //Login
    header('Location:index.php');
}

require_once '../models/ModelProductos.php';

if (isset($_GET['op'])) {

    $producto = new ProductosModel();

    if ($_GET['op'] == 'listProductos') { // PROBADO -- PODRIA MEJORARSE

        $datos = $producto->listarProducto();
        // var_dump($datos);

        // print_r($datos);
        if ($datos) {

            foreach ($datos as $lisProducto) {
                echo "
            <tr>
                
                <td><img src='{$lisProducto->imagen}' alt='' class='img-thumbnail' width='60px'></td>
                <td >{$lisProducto->codigo}</td>                
                <td >{$lisProducto->descripcion}</td>
                <td >{$lisProducto->categoria}</td>
                <td >{$lisProducto->stock}</td>
                <td >{$lisProducto->precio}</td>
                <td >{$lisProducto->fecha}</td>                
                
                <td class='td-actions text-right'> 

                    <!-- <button data-IdPersona='{$lisProducto->idProducto}' type='button' rel='tooltip' style='color:black' class='get btn btn-info btn-round' data-original-title='' title='Ver'>
                        <i class='material-icons'>visibility</i>
                     </button> -->

                     <button  data-IdPersona='{$lisProducto->idProducto}' type='button' rel='tooltip' style='color:black' class='editar btn btn-success btn-round' title='Editar'>
                     <i class='material-icons'>edit</i>
                     </button>

                    <button data-IdPersona='{$lisProducto->idProducto}' type='button' rel='tooltip' style='color:black' class='btn btn-danger btn-round' data-original-title='' title='Eliminar'>
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

    // if ($_GET['op'] == 'registrarProducto') {

    //     $product = $producto->registrarProducto([
    //         "nombre"        => $_GET['nombre'],
    //         "codigo"        => $_GET['codigo'],
    //         "precio"        => $_GET['precio'],
    //         "stock"         => $_GET['stock'],
    //         "idCategoria"   => $_GET['idCategoria'],
    //         "descripcion"   => $_GET['descripcion'],
    //         "idUnidad"      => $_GET['idUnidad']
    //     ]);
    //     if ($product) {
    //         echo '1'; //registro exitoso
    //     } else {
    //         echo '-1'; // no se pudo registrar
    //     }
    // }

    // if ($_GET['op'] == "CargarCategoria") {
    //     $categoria = $producto->cargarCategoria();
    //     if ($categoria) {
    //         foreach ($categoria as $unCategoria) {
    //             echo "<option value='{$unCategoria->idCategoria}'>{$unCategoria->nombreCategoria}</option>";
    //         }
    //     }
    // }

    // if ($_GET['op'] == "CargarUnidad") {
    //     $unidad = $producto->cargarUnidad();
    //     if ($unidad) {
    //         foreach ($unidad as $unUnidad) {
    //             echo "<option value='{$unUnidad->idunidad}'>{$unUnidad->nombre}</option>";
    //         }
    //     }
    // }


    if ($_GET['op'] == "CargarProducto") {
        $Product = $producto->cargarProducto();
        //  var_dump($Product);
        //  print_r($Product);
        // console.log($Product);

        if ($Product) {
            foreach ($Product as $unProduct) {
                echo "<option value='{$unProduct->idProducto}'>{$unProduct->nombre}</option>";
            }
        }
    }

    if ($_GET['op']== "Producto2"){
        $Produc = $producto->cargarProducto();
        // var_dump($Produc);
        // print_r($Produc); 
        if ($Produc) {
            foreach ($Produc as $unProduc) {
                echo json_encode($unProduc);
            }
        } else {
            echo '-1';
        }
        
    }

    // if ($_GET['op'] == "IDPersona") { //

    //     $data = $persona->OptenerIdPersona(["idPersona" => $_GET['idPersona']]);
    //     // print_r($data);
    //     if ($data) {
    //         foreach ($data as $undata) {
    //             echo json_encode($undata);
    //         }
    //     } else {
    //         echo '-1';
    //     }
    // }

    // if ($_GET['op'] == 'editarPersona') {
    //     $personaModificar = $persona->modificarPersona([
    //         "apellidos"         => $_GET['apellidos'],
    //         "nombres"           => $_GET['nombres'],
    //         "tipoDocumento"     => $_GET['tipoDocumento'],
    //         "numeroDocumento"   => $_GET['numeroDocumento'],
    //         "direccion"         => $_GET['direccion'],
    //         "telefono"          => $_GET['telefono'],
    //         "foto"              => $_GET['foto'],
    //         "idPersona"         => $_GET['idPersona']

    //     ]);
    //     if ($personaModificar) {
    //         echo '1';
    //     } else {
    //         echo '-1';
    //     }
    // }


}
