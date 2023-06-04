<?php
session_start();

if ($_SESSION['acceso'] == false) {
  //Login
  header('Location:index.php');
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/QRICO.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    MEGA !FACTURE
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard-pro" />
  <!--  Social tags      -->
  <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 4 dashboard, bootstrap 4, css3 dashboard, bootstrap 4 admin, material dashboard bootstrap 4 dashboard, frontend, responsive bootstrap 4 dashboard, material design, material dashboard bootstrap 4 dashboard">
  <meta name="description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="Material Dashboard PRO by Creative Tim">
  <meta itemprop="description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
  <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg">
  <!-- Twitter Card data -->
  <meta name="twitter:card" content="product">
  <meta name="twitter:site" content="@creativetim">
  <meta name="twitter:title" content="Material Dashboard PRO by Creative Tim">
  <meta name="twitter:description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design.">
  <meta name="twitter:creator" content="@creativetim">
  <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg">
  <!-- Open Graph data -->
  <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Material Dashboard PRO by Creative Tim" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="http://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html" />
  <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/51/original/opt_mdp_thumbnail.jpg" />
  <meta property="og:description" content="Material Dashboard PRO is a Premium Material Bootstrap 4 Admin with a fresh, new design inspired by Google's Material Design." />
  <meta property="og:site_name" content="Creative Tim" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="assets/css/fonts.googleapis.comMaterial+Icons.css" />
  <!-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" /> -->
  <link rel="stylesheet" href="assets/css/FontAwesome4.7.0.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.min.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="select2/select2.min.css">
  <link rel="stylesheet" href="assets/css/carrito.css">

  <style>
    .circular--square {
      border-radius: 50%;
      width: 40px;
      height: 40px;

    }
  </style>
</head>

<body class="">
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <!-- End Google Tag Manager (noscript) -->
  <div class="wrapper ">
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="assets/img/sidebar-3.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
        -->

      <!-- <div class="logo">
        <div class="container-fluid">
        <div class="m-2 row justify-content-center">
        <img class="circular--square" src="assets/img/faces/avatar.jpg" />
            <a href="main.php" class="simple-text logo-normal">
            &nbsp Creative Tim
            </a>
          </div>
        </div>
      </div> -->

      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="assets/img/personas/samuel.jpg" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                MARK HOLDING E.I.R.L.
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> MP </span>
                    <span class="sidebar-normal"> My Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> EP </span>
                    <span class="sidebar-normal"> Edit Profile </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span class="sidebar-mini"> S </span>
                    <span class="sidebar-normal"> Settings </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link" href="main.php?view=ventas">
              <i class="material-icons">balance</i>
              <p> Ventas </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="main.php?view=compras">
              <i class="material-icons">shopping_cart</i>
              <p>Compras</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="main.php?view=guiasRemision">
              <i class="material-icons">local_shipping</i>
              <p> Guias de remision</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="main.php?view=productos">
              <i class="material-icons">category</i>
              <p> Productos</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="main.php?view=factura">
              <i class="material-icons">assignment_ind</i>
              <p> factura</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="main.php?view=clientes">
              <i class="material-icons">assignment_ind</i>
              <p> clientes</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="main.php?view=cajaChica">
              <i class="material-icons">price_change</i>
              <p> Caja chica</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="main.php?view=reportes">
              <i class="material-icons">leaderboard</i>
              <p> Reportes</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="main.php?view=usuarios">
              <i class="material-icons">supervisor_account</i>
              <p> Usuarios</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="main.php?view=gastos">
              <i class="material-icons">attach_money</i>
              <p> Gastos</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="main.php?view=configuracion">
              <i class="material-icons">miscellaneous_services</i>
              <p> Configuración</p>
            </a>
          </li>
        </ul>

      </div>

    </div>

    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboarddddd</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">

              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img class="circular--square" src="assets/img/personas/samuel.jpg" /> <?= $_SESSION['Cliente']; ?>
                </a>

                <!-- <i class="material-icons">person</i> -->
                <!-- <p class="d-lg-none d-md-block">
                    Account
                  </p> -->

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="main.php?view=perfilUsuario">Perfil</a>
                  <a class="dropdown-item" href="#" data-target="#modalActualizaClave" data-toggle="modal">Cambiar clave</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="controller/usuario.controller.php?op=cerrar-sesion">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->

      <!-- Content Header (Page header) -->

      <div class="content">
        <div class="content">
          <div class="content-header">
            <div class="container-fluid">
              <div class="row ">
                <div class="col-md-6">
                  <h2 class="m-0"><b><samp></samp> </b></h1>
                </div>

                <div class="col-sm-6" id="">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="main.php?view=factura">Factura</a></li>
                    <li class="breadcrumb-item active">Ventas</li>
                  </ol>



                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /.content-header -->

        <!-- main content -->
        <div class="content">
          <div class="container-fluid" id="contenido">

            <!-- esta es la  seccion que carga de forma dinamica -->

          </div>
        </div>

      </div>
      <!-- /.main content -->

      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <h4>sistema veventas</h4>
            </ul>
          </nav>
        </div>
      </footer>

    </div>

  </div>

  <!-- Zona para modales -->

  <!-- Modal actualizar clave -->
  <div id="modalActualizaClave" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="my-modal-title">Actualizar contraseña</h5>
          <button class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="formularioActualizaClave">
            <div class="form-group">
              <label for="clave1">Ingrece la clave original</label>
              <input type="password" id="clave1" class="form-control form-control-sm">
            </div>
            <div class="form-group">
              <label for="clave2">Ingrece la clave nueva</label>
              <input type="password" id="clave2" class="form-control form-control-sm">
            </div>
            <div class="form-group">
              <label for="clave3">Ingrece la clave nueva</label>
              <input type="password" id="clave3" class="form-control form-control-sm">
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success btn-sm" type="button" id="actualizarclave">Actualizar</button>
          <button class="btn btn-secondary btn-sm" type="button" id="cancelarActulizacion" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin de modal actualizaclave -->

  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="assets/js/plugins/moment.min.js"></script>
  <script src="assets/js/plugins/sweetalert2.js"></script>
  <script src="assets/js/plugins/jquery.validate.min.js"></script>
  <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
  <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
  <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
  <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
  <script src="assets/js/plugins/fullcalendar.min.js"></script>
  <script src="assets/js/plugins/jquery-jvectormap.js"></script>
  <script src="assets/js/plugins/nouislider.min.js"></script>
  <script src="assets/js/plugins/arrive.min.js"></script>
  <script async defer src="assets/js/buttons.js"></script>
  <script src="assets/js/plugins/chartist.min.js"></script>
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
  <script src="assets/demo/demo.js"></script>
  <script src="dist/pages/loadweb.js"></script>  
  <script src="select2/select2.min.js"></script>
 

  <!-- inicio login -->
  <script>
    $(document).ready(function() {
      function reiniciarUI() {
        $("#formularioActualizaClave")[0].reset();
      }

      function actualizarClave() {
        const clave1 = $("#clave1").val();
        const clave2 = $("#clave2").val();
        const clave3 = $("#clave3").val();
        if (clave1 == "" || clave2 == "" || clave3 == "") {
          alert("Debe escribir todas las claves para continuar");
        } else {
          if (clave2 != clave3) {
            alert("las nuevas contraseñas no son iguales");
          } else {
            $.ajax({
              url: 'controller/usuario.controller.php',
              type: 'GET',
              data: {
                op: 'actualizarClave',
                clave1: clave1,
                clave2: clave2
              },
              success: function(result) {
                if ($.trim(result) == "") {
                  alert("la contraseña fue actualizada");
                  reiniciarUI();
                  $("#modalActualizaClave").modal("hide");
                } else {
                  alert(result);
                  $("#clave1").focus();
                }
              }
            });
          }
        }
      }
      $("#actualizarclave").click(actualizarClave)
      $("#cancelarActulizacion").click(reiniciarUI);

    });
  </script>
  <!-- /fin login -->

  <script>
    $(document).ready(function() {
      let content = getParam('view');
      // console.log(content);

      if (content == false) {
        $("#contenido").load('views/welcome.php');
      } else {
        // la variable/Key "view"tiene un valor (nombre del archivo abrir)
        $("#contenido").load('views/' + content + '.php');

      }

    });
  </script>
</body>

</html>