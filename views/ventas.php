<?php

session_start();

if ($_SESSION['acceso'] == false) {
    //Login
    header('Location:index.php');
}


?>

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-primary card-header-icon row align-items-end">
                <div class="card-icon">
                    <i class="material-icons">balance</i>
                </div>

                <!-- <h4 class="card-title" style="color:black"><b>VENTAS</b></h4> -->
                <!-- <li class=""><a href="../views/factura.php"><b>FACTURA</b></a></li> -->
                <li ><a style="color:black" href="main.php?view=factura"><b>Venta</b></a></li>

                <button type="button" rel="tooltip" data-target="#modalRegistrarVenta" data-toggle="modal" class="btn btn-primary btn-round btn-sm ml-auto" data-original-title="" title="registrar">
                    <i class="material-icons">balance</i> Nueva Venta
                </button>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="usuarioList">
                        <thead>
                            <tr>

                                <th style="color:black"><b>Venta</b></th> <!-- = idVenta -->
                                <th style="color:black"><b>Cliente</b></th> <!-- = idUsuario -->
                                <th style="color:black"><b>Total</b></th> <!-- = precio total -->
                                <th style="color:black"><b>Fecha</b></th> <!-- = fecha y hora -->
                                <th style="color:black"><b>Documento</b></th> <!-- = serie Comprobante y nummero de comprobante -->
                                <th style="color:black"><b>Usuario</b></th> <!-- = idUsuario -->
                                <th style="color:black"><span class="material-icons"><b>menu</b></span></th>
                            </tr>
                        </thead>
                        <tbody id="ventas">


                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>


    <!-- MODAL REGISTRA VENTA -->
    <div class="modal fade" id="modalRegistrarVenta" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="width: 120%">
                <div class="modal-header">
                    <h5 id="titulo-h5" style="color:black" class="modal-title">Nuevo Registro - Ventas <i class="material-icons">balance</i></h5>
                    <!-- CERRAR -->
                    <button type="button" id="btnCerrarModal" data-dismiss="modal" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="" id="ventas">
                        <!--FECHA COMPRA  -->
                        <div class="form-group row">

                            <select id="controlBuscador"   style="width: 50%">

                            </select>

                            <div class="col-md-1">
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                </button>
                            </div>

                            <div class="col-md-2">
                                <!-- <label for="" style="color:black">CANTIDAD :</label> -->
                                <input type="number" id="txtCantidad" placeholder="Cantidad" maxlength="50" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <!-- <label for="" style="color:black">PRECIO :</label> -->
                                <input type="number" id="txtPrecio" placeholder="Precio" maxlength="50" class="form-control">

                            </div>

                            <div class="col-md-1">
                                <a href="#" id="add_product_venta" class="link_add"><i class="material-icons">add</i></a>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="usuarioList">
                                    <thead>


                                        <th style="color:black;width:50%; "><b>Producto</b></th>
                                        <th style="color:black;width:5%; "><b>Cantidad</b></th>
                                        <th style="color:black;width:12%; "><b>Precio U.</b></th>
                                        <th style="color:black;width:5%; "><b>Impuesto</b></th>
                                        <th style="color:black;width:12%; "><b>Sub Total</b></th>
                                        <th style="color:black;width:5%; "><b>Total</b></th>


                                    </thead>
                                    <tbody id="venta">
                                        <!-- // esta parte se cargara dinamicamente -->
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="form-group row col-md-6" style="left: 78%">

                            <div class="col-md-1.5">
                                <label for="" style="color:black">Subtotal&emsp;S/</label>
                            </div>

                            <div class="col-md-3">
                                <label for="" id="Subtotal" style="color:black">&emsp;&emsp;0.00</label>
                            </div>

                        </div>

                        <div class="form-group row col-md-6" style="left: 81%">
                            <div class="col-md-1.5">
                                <label for="" style="color:black">IGV&emsp;S/</label>
                            </div>

                            <div class="col-md-3">
                                <label for="" id="Igv" style="color:black">&emsp;&emsp;0.00</label>
                            </div>
                        </div>

                        <div class="form-group row col-md-6" style="left: 67%">
                            <div class="col-md-2">
                                <select name="" id="Descuento" class="form-control" required="">
                                    <option value="porcentage">%</option>
                                    <option value="monto">Monto</option>
                                </select>
                            </div>

                            <div class="col-md-2.5">
                                <label for="" style="color:black">Descuento(-)&emsp;S/ </label>
                            </div>

                            <div class="col-md-3">
                                <input type="number" id="TotalDescuento" placeholder="0" maxlength="50" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row col-md-6" style="left: 80%">
                            <div class="col-md-1.5">
                                <label for="" style="color:black">Total&emsp;S/</label>
                            </div>

                            <div class="col-md-3">
                                <label for="" id="Total" style="color:black">&emsp;&emsp;0.00</label>
                            </div>
                        </div>


                    </form>
                </div>
                <!--  -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="btn_anular_compra" data-dismiss="modal">Anular Compra</button>
                    <button type="button" class="btn btn-primary" id="btn_procesar_compra" style="display: none;">Procesar Compra</button>
                </div>
            </div>
        </div>
    </div><!-- Final Modal venta-->
</div>
<script>
    $(document).ready(function() {

        listarProductos();
        // function cargarProductos() {
        //     $.ajax({
        //         url: "controller/usuario.controller.php",
        //         type: "GET",
        //         data: "op=CargarRoles",
        //         success: function(response) {
        //             $("#tipoUsuario").html(response);
        //         }
        //     });
        // }

        function listarProductos() {
            $.ajax({
                url: "controller/ProductoController.php",
                type: "GET",
                data: "op=CargarProducto",
                success: function(response) {
                    $("#controlBuscador").html(response);
                }
            })
        }



        $(document).ready(function() {
            $('#controlBuscador').select2();
        });

        //Agregar producto al detalle
        $('#add_product_venta').click(function(e) {
                e.preventDefault();
                if ($('#txtCantidad').val() > 0) {
                    var nombre = $('#txtProducto').val();
                    var cantidad = $('#txtCantidad').val();
                    var precioVenta = $('#txtPrecio').val();
                    var action = 'addProductoDetalle';

                    $.ajax({
                        url: 'views/ajax.php',
                        type: "POST",
                        async: true,
                        data: {
                            action: action,
                            nombre: nombre,
                            cantidad: cantidad,
                            precioVenta: precioVenta
                        },

                        success: function(response) {
                            //console.log(response);
                            if (response != 'error') {
                                var info = JSON.parse(response);
                                //console.log(info);
                                $('#detalle_compra').html(info.detalle);
                                $('#detalle_totales').html(info.totales);

                                $('#txtProducto').val('');
                                $('#txtCantidad').val('');
                                $('#txtPrecio').val('');

                            } else {
                                console.log('no data');
                            }
                            viewProcesar();
                        },
                        error: function(error) {}
                    });
                }
            });

            //ANULAR COMPRA
            $('#btn_anular_compra').click(function(e) {

                e.preventDefault();
                var rows = $('#detalle_compra tr').length;

                if (rows > 0) {
                    var action = 'anularCompra';

                    $.ajax({
                        url: 'views/ajax.php',
                        type: "POST",
                        async: true,
                        data: {
                            action: action
                        },

                        success: function(response) {
                            // console.log(response);
                            if (response != 'error') {
                                location.reload();

                            }
                        },
                        error: function(error) {}
                    });
                }
            });

            //PROCESAR COMPRA
            $('#btn_procesar_compra').click(function(e) {

                e.preventDefault();
                var rows = $('#detalle_compra tr').length;

                if (rows > 0) {
                    var action = 'procesarCompra';
                    var nota = $('#txtNota').val();

                    $.ajax({
                        url: 'views/ajax.php',
                        type: "POST",
                        async: true,
                        data: {
                            action: action,
                            nota: nota
                        },

                        success: function(response) {
                            //console.log(response);
                            if (response != 'error') {
                                // var info = JSON.parse(response);
                                //console.log(info);
                                location.reload();

                            } else {
                                console.log('no data');
                            }
                        },
                        error: function(error) {}
                    });
                }
            });

        

    });
</script>
