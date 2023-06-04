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

                <h4 class="card-title" style="color:black"><b>VENTAS</b></h4>
                <button type="button" rel="tooltip" data-target="#modalRegistrarVenta" data-toggle="modal" class="btn btn-primary btn-round btn-sm ml-auto" data-original-title="" title="registrar">
                    <i class="material-icons">balance</i> Nueva Venta
                </button>

            </div>


            <div class="row">
                <div class="col-md-8">
                    <form action="" id="ventas">
                        <!--FECHA COMPRA  -->
                        <div class="form-group row">

                            <select class="js-example-basic-single" name="state" id="controlBuscador" style="width: 50%">

                            </select>

                            <!-- <div class="col-md-1">
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                </button>
                            </div> -->

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
                                <label for="" style="color:black"><b>Subtotal&emsp;S/.</b></label>
                            </div>

                            <div class="col-md-3">
                                <label for="" id="Subtotal" style="color:black">&emsp;&emsp;0.00</label>
                            </div>

                        </div>

                        <div class="form-group row col-md-6" style="left: 81.5%">
                            <div class="col-md-1.5">
                                <label for="" style="color:black"><b>IGV&emsp;S/.</b></label>
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
                                <label for="" style="color:black"><b>Descuento(-)&emsp;S/.</b></label>
                            </div>

                            <div class="col-md-3" style="color:black">
                                <input type="number" id="TotalDescuento" placeholder="0" maxlength="50" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row col-md-6" style="left: 81%">
                            <div class="col-md-1.5">
                                <label for="" style="color:black"><b>Total&emsp;S/.</b></label>
                            </div>

                            <div class="col-md-3" style="left:2%">
                                <label for="" id="Total" style="color:black"><b>100.00</b></label>
                            </div>
                        </div>

                    </form>
                </div>



                <div class="row " style="background-color: #E6D9EC; border-radius: 5px; left: 1%; width:30%">
                    <form action="" id="ventas">
                       
                        <div class="form-group col-md-12" style="left: 1%">

                            <div class="col-md-1.5 ">

                                <i class="material-icons" style="color:red">description</i>

                                <a href=""><b>Boleta</b></a>

                                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

                                <i class="material-icons" style="color:red">description</i>

                                <a href=""><b>Factura</b></a>

                            </div>

                        </div>


                        <div class="form-group  col-md-12" style="left: 10px">
                            <div class="col-md-1.5 row">
                                <label for="" style="color:black"><b>Total&emsp;S/</b></label>

                                <label for="" id="Total" style="color:black">&emsp;&emsp;0.00</label>
                            </div>
                        </div>
                        <!-- left: ==> lado izquierdo
    right:
     width: ==> ancho   -->

                        <div class="input-group mb-12" style="left: 1%; ">

                            <div class="input-group-prepend ">
                                <span class="input-group-text" style="color:darkgreen; width:70px;"><b>Pagado</b></span>
                            </div>

                            <div class="input-group-prepend" style="width:90px;">
                                <select name="" style="color:black" id="Descuento" class="form-control" required="">
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="MasterCard">Master Card</option>
                                    <option value="UberEats">UberEats</option>
                                    <option value="Visa">Visa</option>
                                    <option value="Yape">Yape</option>
                                    <option value="Credito">Credito</option>
                                    <option value="Izipay">Izipay</option>
                                </select>

                                <!-- <span class="input-group-text">
                                    <i class="material-icons">unfold_more</i>
                                </span>                        -->

                            </div>

                            <div class="input-group-prepend">
                                <!-- <label>FECHA EMISION</label> -->
                                <input type="date" class="form-control" style="width:100px;" name="fecha_emision" id="fecha_emision" value="<?php echo date('Y-m-d') ?>">
                            </div>

                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>S/.</b></span>
                            </div>

                            <div class="input-group-prepend" style="width: 70px;">
                                <input type="number" step="0.01" class="form-control" style="color:black" placeholder="Total">
                            </div>
                        </div>

                        <div class="form-group  col-md-12" style="left: 60%">
                            <div class="col-md-1.5 row">
                                <label for="" id="vuelto" style="color:black"><b>Vuelto&emsp;S/.</b></label>


                                <label for="" id="Total" style="color:black">&emsp;&emsp;0.00</label>
                            </div>
                        </div>

                        <button type="button" style="width: 100%;" rel="tooltip" data-target="#modalRegistrarVenta" data-toggle="modal" class="btn btn-primary btn-round btn-sm ml-auto" data-original-title="" title="registrar">
                            <i class="material-icons">person</i><b>Cliente</b>
                        </button>


                    </form>
                </div>


                <!-- <div class="container">
                    <div class="row mt-5">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">description</i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Usuario">
                        </div>
                    </div>
                </div> -->

            </div>

        </div>
    </div>
</div>

<script>
    // lista de productos para el select2
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

    // API BUSQUEDA POR DNI
    $('#buscar').click(function() {
        dni = $('#txtNumeroDocumnento').val();
        $.ajax({
            url: 'controller/consultaDNI.php',
            type: 'post',
            data: 'dni=' + dni,
            dataType: 'json',
            success: function(r) {
                if (r.numeroDocumento == dni) {
                    $('#txtApellido').val(r.apellidoPaterno + ' ' + r.apellidoMaterno);
                    $('#txtNombre').val(r.nombres);
                } else {
                    alert(r.error);
                }
                console.log(r)
            }
        });
    });



    $(document).ready(function() {
        $('#controlBuscador').select2();
    });

    listarProductos();
</script>




<script>
    $("#tipocomp").val('01'); //valor por defecto de factura 01
    ConsultarSerie();
    listar_emisores();
    listar_monedas();
    listar_comprobantes();
    listar_documentos();


    function listar_emisores() {
        $.ajax({
            method: "POST",
            url: "controller/FacturacionController.php",
            data: {
                "accion": "LISTAR_EMISORES"
            }
        }).done(function(text) {
            json = JSON.parse(text);
            emisores = json.emisores;
            options = '';

            for (i = 0; i < emisores.length; i++) {
                options = options + '<option value="' + emisores[i].id + '">' + emisores[i].razon_social + '</option>';
            }

            $('#idemisor').html(options);
        })
    }

    function listar_monedas() {
        $.ajax({
            method: "POST",
            url: "controller/FacturacionController.php",
            data: {
                "accion": "LISTAR_MONEDAS"
            }
        }).done(function(text) {
            json = JSON.parse(text);
            listado = json.listado;
            options = '';

            for (i = 0; i < listado.length; i++) {
                options = options + '<option value="' + listado[i].codigo + '">' + listado[i].descripcion + '</option>';
            }

            $('#moneda').html(options);
        })
    }

    function listar_comprobantes() {
        $.ajax({
            method: "POST",
            url: "controller/FacturacionController.php",
            data: {
                "accion": "LISTAR_COMPROBANTES",
                "tipo": "01"
            }
        }).done(function(text) {
            json = JSON.parse(text);
            listado = json.listado;
            options = '';

            for (i = 0; i < listado.length; i++) {
                options = options + '<option value="' + listado[i].codigo + '">' + listado[i].descripcion + '</option>';
            }

            $('#tipocomp').html(options);
        })
    }

    function listar_documentos() {
        $.ajax({
            method: "POST",
            url: "controller/FacturacionController.php",
            data: {
                "accion": "LISTAR_DOCUMENTOS",
                "tipo": "6"
            }
        }).done(function(text) {
            json = JSON.parse(text);
            listado = json.listado;
            options = '';

            for (i = 0; i < listado.length; i++) {
                options = options + '<option value="' + listado[i].codigo + '">' + listado[i].descripcion + '</option>';
            }

            $('#tipodoc').html(options);
        })
    }

    function ConsultarSerie() {
        $.ajax({
            method: "POST",
            url: "controller/FacturacionController.php",
            data: {
                "accion": "LISTAR_SERIES",
                "tipocomp": "01"
            }
        }).done(function(text) {
            json = JSON.parse(text);
            series = json.series;
            options = '';
            for (i = 0; i < series.length; i++) {
                options = options + '<option value="' + series[i].id + '">' + series[i].serie + '</option>';
            }
            $('#idserie').html(options);
            ConsultarCorrelativo();
        });
    }

    function ConsultarCorrelativo() {
        $.ajax({
            method: "POST",
            url: "controller/FacturacionController.php",
            data: {
                "accion": "OBTENER_CORRELATIVO",
                "idserie": $('#idserie').val()
            }
        }).done(function(correlativo) {
            $('#correlativo').val(correlativo);
        })
    }

    function ObtenerDatosEmpresa() {
        tipodoc = $('#tipodoc').val();
        if (tipodoc == 1) {
            ObtenerDatosDNI();
        } else if (tipodoc == 6) {
            ObtenerDatosRUC();
        }
    }

    function ObtenerDatosDNI() {
        $.ajax({
            method: "POST",
            url: "facturacion/apifacturacion/controlador/controlador.php",
            data: {
                "accion": "CONSULTA_DNI",
                "dni": $('#nrodoc').val()
            }
        }).done(function(text) {
            json = JSON.parse(text);
            $('#razon_social').val(json.result.Nombre + ' ' + json.result.Paterno + ' ' + json.result.Materno);
            $('#direccion').val('');
        })
    }

    function ObtenerDatosRUC() {
        $.ajax({
            method: "POST",
            url: "facturacion/apifacturacion/controlador/controlador.php",
            data: {
                "accion": "CONSULTA_RUC",
                "ruc": $('#nrodoc').val()
            }
        }).done(function(text) {
            json = JSON.parse(text);
            $('#razon_social').val(json.result.razon_social);
            $('#direccion').val('');
        })
    }

    function BuscarProducto() {
        $.ajax({
            method: "POST",
            url: "facturacion/apifacturacion/controlador/controlador.php",
            data: {
                "accion": "BUSCAR_PRODUCTO",
                "filtro": $('#producto').val()
            }
        }).done(function(resultado) {
            json = JSON.parse(resultado);
            productos = json.productos;
            listado = '';
            for (i = 0; i < productos.length; i++) {
                listado = listado + '<tr><td>' + productos[i].codigo + '</td><td>' + productos[i].nombre + '</td><td>' + productos[i].precio + '</td><td><input class="form-control input-sm" id="txtCantidad' + productos[i].codigo + '" value="1" type="number" min="1" /></td><td><button type="button" class="btn btn-primary btn-sm" onclick="AgregarCarrito(' + productos[i].codigo + ')"> + </button></td></tr>';
            }

            $('#div_productos').html(listado);
        })
    }

    function AgregarCarrito(codigo) {
        $.ajax({
            method: "POST",
            url: "facturacion/apifacturacion/controlador/controlador.php",
            data: {
                "accion": "ADD_PRODUCTO",
                "codigo": codigo,
                "cantidad": $('#txtCantidad' + codigo).val()
            }
        }).done(function(resultado) {
            $('#div_carrito').html(resultado);
        })
    }

    function Cancelar() {
        $.ajax({
            method: "POST",
            url: "facturacion/apifacturacion/controlador/controlador.php",
            data: {
                "accion": "CANCELAR_CARRITO"
            }
        }).done(function(resultado) {
            $('#div_carrito').html(resultado);
        })
    }

    function Guardar() {
        var datax = $('#frmVenta').serializeArray();
        $.ajax({
            method: "POST",
            url: "facturacion/apifacturacion/controlador/controlador.php",
            data: datax
        }).done(function(resultado) {
            $('#div_carrito').html(resultado);
        })
    }

    function GenerarCuotas() {
        listado = '';
        cuotas = $('#cuotas').val()
        for (let i = 1; i <= cuotas; i++) {
            listado = listado + '<tr><td><input class="form-control input-sm" name="txtCuota' + i + '" type="text" value="Cuota ' + i + '" readonly/></td>' +
                '<td><input class="form-control input-sm" name="txtFecha' + i + '" type="date"/></td>' +
                '<td><input class="form-control input-sm" name="txtMonto' + i + '" type="number"/></td></tr>';
        }

        $('#div_cuotas').html(listado);

        if (cuotas > 0) {
            monto_pendiente = '<div class="form-group"><label>Monto pendiente</label><input class="form-control" type="number" name="monto_pendiente" id="monto_pendiente" value="0.0" /></div>';
            $('#div_monto_pendiente').html(monto_pendiente);
        }
    }
</script>