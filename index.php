<?php 
session_start(); 

if (isset($_SESSION['acceso'])){
  if ($_SESSION['acceso'] == true){
    //Si tiene la sesión activa, entonces NO puedes estar acá
    header('Location:main.php');
  }
}


?>

<!doctype html>
<html>
    <head>
        <link rel="shortcut icon" href="#" />
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>practica ceti</title>

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">        
        
        <link rel="stylesheet" type="text/css" href="fuentes/iconic/css/material-design-iconic-font.min.css">
        
    </head>
    
    <body>
     
      <div class="container-login">
        <div class="wrap-login">
            <form class="login-form validate-form" id="formLogin" action="" method="post">
                <span class="login-form-title">MARK HOLDING E.I.R.L.</span>
                
                <div class="wrap-input100" data-validate = "Usuario incorrecto">
                    <input class="input100" type="text" id="usuario" name="usuario" placeholder="USUARIO">
                    <span class="focus-efecto"></span>
                </div>
                
                <div class="wrap-input100" data-validate="Password incorrecto">
                    <input class="input100" type="password" id="password" name="password" placeholder="Password">
                    <span class="focus-efecto"></span>
                </div>
                
                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <div class="login-form-bgbtn"></div>
                        <button id="acceder" type="submit" name="submit" class="login-form-btn">CONECTAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>     
        
        
     <script src="jquery/jquery-3.3.1.min.js"></script>    
     <script src="bootstrap/js/bootstrap.min.js"></script>    
     <script src="js/popper.min.js"></script>    
        
     <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>    

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <!-- login -->
     <script>
    $(document).ready(function (){

      function iniciarSesion(){
        if ($("#usuario").val() != "" && $("#password").val() != ""){

          $.ajax({
            url: 'controller/usuario.controller.php',
            type: 'GET',
            data: {
              op          : 'login',
              userName    : $("#usuario").val(),
              userPassword: $("#password").val()
            },
            success: function (result){
              if ($.trim(result) == ""){
                //Nos vamos al dashboard
                window.location.href = 'main.php'
              }else{
                alert(result);
              }
            }
          });
        }
      }

      $("#password").keypress(function (event){
        if (event.keyCode == 13) {
          iniciarSesion();
        }
      });

      $("#acceder").click(iniciarSesion);

    });
  </script>
    </body>
</html>