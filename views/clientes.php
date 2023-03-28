<?php

session_start();

if ($_SESSION['acceso'] == false) {
  //Login
  header('Location:index.php');
}
?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon row">
            <div class="card-icon">
              <i class="material-icons">group</i>
            </div>
            <h4 class="card-title" style="color:black"><b>Cliente / Proveedor</b></h4>
            <button type="button" rel="tooltip" data-target="#modalRegisterCliente" data-toggle="modal" class="btn btn-primary btn-round btn-sm ml-auto" data-original-title="" title="registrar">
              <i class="material-icons">person</i> Registrar Cliente
            </button>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="table-clientes">
                <thead>
                  <tr style="text-decoration-color: black;">
                    <!-- <th class="text-center">#</th> -->
                    <th><b>Nonbre/Razon Social</b></th>
                    <th><b>Documento</b></th>
                    <th><b>Tipo</b></th>
                    <th><b>Direccion</b></th>
                    <th><b>Telefono</b></th>
                    <!-- <th class="text-right">Salary</th> -->
                    <th class="text-right"><b>Actions</b></th>
                  </tr>
                </thead>
                <tbody id="clientesbody">
                  <!-- Esta parte del bodi cargara dinamicamente -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- MODAL REGISTRAR CLIENTE -->
<div id="modalRegisterCliente" class="modal fade" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="my-modal-title" class="modal-title"><i class="material-icons">supervisor_account</i><b> Nuevo Registro - Cliente / Proveedor</b></h5>
        <button type="button" id="closemodal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="nuevoRegistroModal" name="Usuario">

          <div class="form-group row">
            <div class="col-md-5">
              <label for="txtNombre" style="color:black"><b>Razon Social :</b></label>
            </div>
            <div class="col-md-5">
              <input maxlength="50" style="text-transform:uppercase;" type="text" id="RazonSocial" name="RazonSocial" placeholder="Nombre" class="form-control" required="">

            </div>

            <div class="col-md-5">
              <label for="txtTipoDocumnento" style="color:black"><b>Tipo Documento :</b></label>
            </div>
            <div class="col-md-5">



              <select class="js-example-basic-single" name="state" id="controlBuscador">

              </select>

            </div>



            <div class="col-md-5">
              <label for="txtNumeroDocumnento" style="color:black"><b>Numero de Documneto :</b></label>
            </div>
            <div class="btn-group">
              <input type="text" class="form-control" placeholder="Nro. Documento" maxlength="11" id="txtNumeroDocumnento" required="">
              <button type="button" class="btn btn-dark" id="buscar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
              </button>
            </div>



            <div class="col-md-5">
              <label for="txtDireccion" style="color:black"><b>Dirección :</b></label>
            </div>
            <div class="col-md-5">
              <input type="txt" id="txtDireccion" placeholder="direccion" class="form-control" required="">

            </div>



            <div class="col-md-5">
              <label for="txtTelefono" style="color:black"><b>Telefono :</b></label>
            </div>
            <div class="col-md-5">
              <input maxlength="9" type="tel" id="txtTelefono" placeholder="Teléfono" class="form-control" required="">

            </div>

            <div class="col-md-5">
              <label for="" style="color:black"><b>Cliente / Proveedor :</b></label>
            </div>
            <div class="col-md-5">
              <select name="" id="TipoCliente" class="form-control" required="">
              </select>
            </div>
          </div>


        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success btn-sm btn-round" type="button" id="btnGuardarRegistroCliente">
          <i class="material-icons">save</i> Registrar
        </button>

        <button class="btn btn-danger btn-sm btn-round" type="button" id="cancelarRegistro" data-dismiss="modal">
          <i class="material-icons">close</i> Cancelar
        </button>
      </div>
    </div>
  </div>
</div> <!-- /FIN MODAL REGISTRAR CLIENTE -->

<!-- MODAL ACTUALIZAR CLIENTE -->
<div id="modalActualizarCliente" class="modal fade" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="my-modal-title" class="modal-title"><i class="material-icons">supervisor_account</i><b> Actualizar - Cliente / Proveedor</b></h5>
        <button type="button" id="closemodal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="nuevoRegistroModal" name="Usuario">

          <div class="form-group row">
            <div class="col-md-5">
              <label for="NombreCliente" style="color:black"><b>Razon Social :</b></label>
            </div>
            <div class="col-md-5">
              <input maxlength="50" style="text-transform:uppercase;" type="text" id="NombreCliente" name="NombreCliente" placeholder="Nombre" class="form-control" required="">

            </div>

            <div class="col-md-5">
              <label for="TipoDocumento" style="color:black"><b>Tipo Documento :</b></label>
            </div>

            <div class="col-md-5">
              <select class="js-example-basic-single" name="state" id="TipoDocumento">

              </select>
            </div>



            <div class="col-md-5">
              <label for="ClienteNroDocumnento" style="color:black"><b>Numero de Documneto :</b></label>
            </div>
            <div class="col-md-5">
              <input maxlength="11" style="text-transform:uppercase;" type="text" id="ClienteNroDocumnento" name="ClienteNroDocumnento" placeholder="Nombre" class="form-control" required="">

            </div>


            <div class="col-md-5">
              <label for="Direccion" style="color:black"><b>Dirección :</b></label>
            </div>
            <div class="col-md-5">
              <input type="txt" id="Direccion" placeholder="direccion" class="form-control" required="">

            </div>



            <div class="col-md-5">
              <label for="Telefono" style="color:black"><b>Telefono :</b></label>
            </div>
            <div class="col-md-5">
              <input maxlength="9" type="tel" id="Telefono" placeholder="Telefono" class="form-control" required="">

            </div>

            <div class="col-md-5">
              <label for="ClienteRols" style="color:black"><b>Cliente / Proveedor :</b></label>
            </div>
            <div class="col-md-5">
              <select name="ClienteRols" id="ClienteRols" class="form-control" required="">
              </select>
            </div>
          </div>


        </form>
      </div>
      <div class="modal-footer">
        <button class="btn-mod-Cliente btn btn-success btn-sm btn-round" type="button" id="">
          <i class="material-icons">save</i> Registrar
        </button>

        <button class="btn btn-danger btn-sm btn-round" type="button" id="cancelarRegistro" data-dismiss="modal">
          <i class="material-icons">close</i> Cancelar
        </button>
      </div>
    </div>
  </div>
</div> <!-- /FIN MODAL ACTUALIZAR CLIENTE -->

<script src="js/cliente.js"></script>