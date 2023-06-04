// var idProducto = "";

// function reiniciarUI() {
//   $("#nuevoRegistroModal")[0].reset();
//   $("#cancelarRegistro")[0].reset();
//   $("#closemodal")[0].reset();
//   $("#nuevoRegistroModal")[0].reset();
// }

function ListarProducto() {
  $.ajax({
    url: "controller/ProductoController.php",
    type: "GET",
    data: "op=listProductos",
    success: function (e) {
      $("#productosServicios").html(e);
      $("table").DataTable({
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
        },
      });
    },
  });
}

ListarProducto();
