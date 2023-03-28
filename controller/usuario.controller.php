<?php
session_start();

if ($_SESSION['acceso'] == false) {
    //Login
    header('Location:index.php');
}


require_once '../models/Usuario.php';
require_once '../models/Mpersonas.php';

if (isset($_GET['op'])) {


    $usuario = new Usuario();
    $persona = new PersonasModel();

    if ($_GET['op'] == 'login') {

        //Array asociativo
        $datos = ["userName" => $_GET['userName']];
        $resultado = $usuario->login($datos);

        if ($resultado) {
            //Acceso al sistema
            //var_dump($resultado);

            $registro = $resultado[0];
            //var_dump($registro);

            //Sabemos que el usuario existe, entonces verificamos que su clave es CORRECTA
            $claveValidar = $_GET['userPassword'];

            //Validando la contraseña
            if (password_verify($claveValidar, $registro['userPassword'])) {

                $_SESSION['acceso'] = true;

                //La clave es correcta...
                $_SESSION['idUsuario'] = $registro['idUsuario'];
                $_SESSION['Cliente'] = $registro['Cliente'];
                $_SESSION['userName'] = $registro['userName'];
                $_SESSION['userPassword'] = $registro['userPassword'];

                echo "";
            } else {

                $_SESSION['acceso'] = false;
                $_SESSION['idUsuario'] = '';
                $_SESSION['Cliente'] = '';
                $_SESSION['userName'] = '';
                $_SESSION['userPassword'] = '';

                echo "La clave es incorrecta";
            }
        } else {

            //No se puede acceder, usuario NO existe
            $_SESSION['acceso'] = false;
            $_SESSION['idUsuario'] = '';
            $_SESSION['Cliente'] = '';
            $_SESSION['userName'] = '';
            $_SESSION['userPassword'] = '';

            echo "El usuario no existe";
        }
    }
    // cerrar session

    if ($_GET['op'] == 'cerrar-sesion') {
        session_destroy();
        session_unset();
        header('Location:../');
    }


    if ($_GET['op'] == 'actualizarClave') {
        // la clave actual enviada coincide con la q iniciamos sesion
        $claveOriginal = $_GET['clave1'];
        $claveNueva = $_GET['clave2'];


        if (password_verify($claveOriginal, $_SESSION['userPassword'])) {

            $datosEnviar = [
                "idUsuario" => $_SESSION['idUsuario'],
                "userPassword" => password_hash($claveNueva, PASSWORD_BCRYPT)
            ];
            $usuario->actualizarClave($datosEnviar);
            echo "";
        } else {
            echo "la clave original ingresada no es correcta";
        }
    }

    if ($_GET['op'] == "listarUsuario") { // PROBADO -- PODRIA MEJORARSE

        $dato = $usuario->listarUsuario();
        // var_dump($dato);
        // print_r($dato);
        if ($dato) {
            foreach ($dato as $person) {
                echo "
              <tr>  
                <td>{$person->idUsuario}</td>
                <td>{$person->userName}</td>
                <td>{$person->Cliente}</td>
                <td>{$person->direccion}</td>
                <td>{$person->telefono}</td>
                 <td>{$person->rol}</td>
                
                <td class='td-actions'> 

                    <button type='button' rel='tooltip' class='btn btn-info btn-round' data-original-title='' title='Ver' style='color:black'>
                      <i class='material-icons' style='color:black'>visibility</i>
                    </button>

                    <button type='button' rel='tooltip' class='btn btn-success btn-round' data-original-title='' title='Editar' style='color:black'>
                        <i class='material-icons' style='color:black'>edit</i>
                     </button>

                    <button type='button' rel='tooltip' class='btn btn-danger btn-round' data-original-title='' title='Eliminar' style='color:black'>
                         <i class='material-icons' style='color:black'>close</i>
                    </button>
                </td>
            </tr> 
            ";
            }
            print_r($person);
        } else {
            echo '-1'; //Quiere decir que no hay datos
        }
    }
}


if (isset($_GET['op'])) {
    //   $usuario = new Usuario(); // Instanciamos la clase usuario
    //   $persona = new ClientesModel();

    if ($_GET['op'] == "UserValidation") {
        $UserExiste = $usuario->ValidacionUsuarios(["userName" => $_GET["userName"]]);

        if ($UserExiste) { //Si el usuario existe
            $userisActive = $usuario->usuariosActivos(["userName" => $_GET["userName"]]);
            if ($userisActive) {
                $contraseñaView = $_GET['contraseña']; //Tomanos la contraseña enviada desde el view
                $contraseñaDB = $UserExiste[0]["passworduser"]; //Tomamos las contraseña de la db
                $ValidacionContraseña = password_verify($contraseñaView, $contraseñaDB); //Validamos si las contraseñas son correctas
                if ($ValidacionContraseña) { // Si la clave es correcta
                    echo "1"; // si la validacion es exitosa
                    $_SESSION['login'] = true;
                    $_SESSION['idusuario'] = $UserExiste[0]['idUsuario'];
                    $_SESSION['clave'] = $UserExiste[0]['userPassword'];
                    $_SESSION['telefono'] = $UserExiste[0]['telefono'];
                    $_SESSION['tipo'] = $UserExiste[0]['idrol'];
                    $_SESSION['nombres'] = $UserExiste[0]['nombres'];
                    $_SESSION['apellidos'] = $UserExiste[0]['apellidos'];
                    $_SESSION['nombreusuario'] = $UserExiste[0]['userName'];
                    $_SESSION['idpersona'] = $UserExiste[0]['idPersona'];
                    $_SESSION['foto'] = $UserExiste[0]['foto'];
                    $_SESSION['fecharegistro'] = $UserExiste[0]['fechaRegistro'];
                } else {
                    echo "-1";   // si la contraseña es incorrecta
                }
            } else {
                echo "-2"; // Devuelve si el usuario no esta activo
            }
        } else {
            echo "0"; //Devuelde si el usuario no existe 
        }
    }


    if ($_GET['op'] == "CreateUser") {

        $validationidpersona = $usuario->ObtenerIdPersona(["idPersona" => $_GET['idPersona'], "stado" => '1']);
        if ($validationidpersona) {
            echo "00";
        } else {
            $usuarioExiste = $usuario->ValidacionUsuarios(["userName" => $_GET['userName']]);
            if ($usuarioExiste) {
                echo "0";
            } else {
                $resultado = $usuario->registrarUsuario([
                    "idPersona" => $_GET['idPersona'],
                    "userName" => $_GET['userName'],
                    "userPassword" => password_hash($_GET["userPassword"], PASSWORD_BCRYPT),
                    "idrol" => $_GET['idrol']

                ]);
                if ($resultado) {
                    echo "1";
                } else {
                    echo "-1";
                }
            }
        }
    }




    if ($_GET['op'] == "registerUserNormal") {

        $personexiste = $persona->OptenerDocumentoPersona(["tipoDocumento" => $_GET['tipoDocumento'], "numeroDocumento" => $_GET['numeroDocumento']]);
        if ($personexiste) {
            echo "0"; //El  Numero Doc. ya esta registrado
        } else {
            $userexiste = $usuario->OptenerDocumentoUsuario(["numeroDocumento" => $_GET['numeroDocumento']]); // El NUmero ya esta usado para un usuario
            if ($userexiste) {
                echo "-3";
            } else {
                $isUsedNameUser = $usuario->ValidacionUsuarios(["userName" => $_GET['userName']]); // El nameuser ya esta en uso
                if ($isUsedNameUser) {
                    echo "-4";
                } else {
                    $datosPersona = [   // Guardamos los datos generales de la persona en un array
                        "apellidos" => $_GET['apellidos'],
                        "nombres" => $_GET['nombres'],
                        "tipoDocumento" => $_GET['tipoDocumento'],
                        "numeroDocumento" => $_GET['numeroDocumento'],
                        "direccion" => $_GET['direccion'],
                        "telefono" => $_GET['telefono'],
                        "foto" => $_GET['foto'],
                    ];
                    $isRegistredPerson = $persona->registrarCliente($datosPersona); // Registramos a la persona antes de crear su usuario
                    if ($isRegistredPerson) { // Si el proceso fue correcto
                        $getidpersona = $persona->OptenerDocumentoPersona(["tipoDocumento" => $_GET['tipoDocumento'], "numeroDocumento" => $_GET['numeroDocumento']]); //obtenemos el datos registrado anteriormentes, solo para obtener el idpersona
                        $datosUser = [ // Alamacenamos los datos de usuario enviado
                            "idPersona" => $getidpersona[0]['idPersona'], // idpersona otenido anteriormente
                            "userName" => $_GET['userName'],
                            "userPassword" => password_hash($_GET['userPassword'], PASSWORD_BCRYPT),
                            "idrol" => $_GET['idrol']
                        ];

                        $isregistredUser = $usuario->registrarUsuario($datosUser); // Creamos al usuario
                        if ($isregistredUser) { // Validamos si todo fue correcto
                            echo "1";
                        } else {
                            echo "-2";
                        }
                    } else {
                        echo "-1";
                    }
                }
            }
        }
    }


    if ($_GET['op'] == "CargarRoles") {
        $roles = $usuario->cargarRolUsuario();
        if ($roles) {
            foreach ($roles as $unroles) {
                echo "<option value='{$unroles->idrol}'>{$unroles->nombrerol}</option>";
            }
        }
    }

    //  var_dump($roles);
    // print_r($roles);

}
