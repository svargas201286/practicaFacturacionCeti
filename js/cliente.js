var idCliente = "";

function reiniciarUI() {
  $("#nuevoRegistroModal")[0].reset();
}

function ListCliente() {
  $.ajax({
    url: "controller/ClientesController.php",
    type: "GET",
    data: "op=listCliente",
    success: function (e) {
      $("#clientesbody").html(e);
      $(".table").DataTable({
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
        },
      });
    },
  });
}

ListCliente();

// lista documento para select2
function listarDocumentos() {
  $.ajax({
    url: "controller/ClientesController.php",
    type: "GET",
    data: "op=CargarDocumento",
    success: function (response) {
      $("#controlBuscador").html(response);
      $("#TipoDocumento").html(response);
    },
  });
}

$(document).ready(function () {
  $("#controlBuscador").select2();
  $("#TipoDocumento").select2();
});

// API BUSQUEDA POR DNI
$("#buscar").click(function () {
  dni = $("#txtNumeroDocumnento").val();
  $.ajax({
    url: "controller/consultaDNI.php",
    type: "post",
    data: "dni=" + dni,
    dataType: "json",
    success: function (r) {
      if (r.numeroDocumento == dni) {
        // $("#txtApellido").val(r.apellidoPaterno + " " + r.apellidoMaterno);
        $("#RazonSocial").val(r.nombre);
        $("#txtDireccion").val(r.direccion);
      } else {
        alert(r.error);
      }
      console.log(r);
    },
  });
});

// FIN API BUSQUEDA POR DNI

// API BUSQUEDA POR SUNAT
$("#buscar").click(function () {
  ruc = $("#documento").val();
  $.ajax({
    url: "controller/consultaRUC.php",
    type: "post",
    data: "ruc=" + ruc,
    dataType: "json",
    success: function (r) {
      if (r.numeroDocumento == ruc) {
        $("#razonSocial").val(r.nombre);
        $("#direccion").val(
          r.direccion +
            "-" +
            r.distrito +
            " " +
            r.provincia +
            " " +
            r.departamento
        );
        // $('#nombre').val(r.nombres);
      } else {
        alert(r.error);
      }
      console.log(r);
    },
  });
});
// FIN API BUSQUEDA POR SUNAT

function listarRoles() {
  $.ajax({
    url: "controller/ClientesController.php",
    type: "GET",
    data: "op=CargarRoles",
    success: function (response) {
      $("#TipoCliente").html(response);
      $("#ClienteRols").html(response);
    },
  });
}

// REGISTRAR CLIENTE
$("#btnGuardarRegistroCliente").on("click", function () {
  let idTipoDocumento = $("#controlBuscador").val();
  let nroDoc = $("#txtNumeroDocumnento").val();
  let razonSocial = $("#RazonSocial").val();
  let direccion = $("#txtDireccion").val();
  let telefono = $("#txtTelefono").val();
  let idrol = $("#TipoCliente").val();

  if (
    idTipoDocumento == "" ||
    nroDoc == "" ||
    razonSocial == "" ||
    direccion == "" ||
    telefono == "" ||
    idrol == ""
  ) {
    alert("por favor complete los campos que falte");
  } else {
    var datos = {
      op: "RegistrarCliente",
      idTipoDocumento: idTipoDocumento,
      nroDoc: nroDoc,
      razonSocial: razonSocial,
      direccion: direccion,
      telefono: telefono,
      idrol: idrol,
    };
    $.ajax({
      url: "controller/ClientesController.php",
      type: "GET",
      data: datos,
      success: function (e) {
        alert("se guardo correctamente");
        reiniciarUI();
        $("#modalRegisterCliente").modal("hide");
        ListCliente();
      },
    });
  }
});

// Obtenemos los datos para actualizar
$("#clientesbody").on("click", ".editar", function () {
  //Correcto
  idCliente = $(this).attr("data-idCliente");
  var datos = {
    op: "IDCliente",
    idCliente: idCliente,
  };

  $.ajax({
    url: "controller/ClientesController.php",
    type: "GET",
    data: datos,
    success: function (response) {
      var data = JSON.parse(response); //COnvertimos la respuesta en un JSON
      console.log(datos);
      $("#modalActualizarCliente").modal("show");

      //Enviamos los datos obtenidos a su caja de texto correspondiente
      $("#NombreCliente").val(data.razonSocial);
      $("#TipoDocumento").val(data.descripcion);
      $("#ClienteNroDocumnento").val(data.nroDoc);
      $("#Direccion").val(data.direccion);
      $("#Telefono").val(data.telefono);
      $("#ClienteRols").val(data.nombrerol);

      idCliente = datos.idCliente;
    },
  });
});

//MODIFICAR UN DATO
$(".btn-mod-Cliente").on("click", function () {
  let razonSocial = $("#NombreCliente").val();
  let idTipoDocumento = $("#TipoDocumento").val();
  let nroDoc = $("#ClienteNroDocumnento").val();
  let direccion = $("#Direccion").val();
  let telefono = $("#Telefono").val();
  let idrol = $("#ClienteRols").val();

  if (
    razonSocial == "" ||
    idTipoDocumento == "" ||
    nroDoc == "" ||
    direccion == "" ||
    telefono == "" ||
    idrol == "") {
    alert("por favor llene los campos");
  } else {
    var datos = {
      op: "modificarCliente",
      idCliente: idCliente,
      razonSocial: razonSocial,
      idTipoDocumento: idTipoDocumento,
      nroDoc: nroDoc,
      direccion: direccion,
      telefono: telefono,
      idrol: idrol
    };
    if (confirm("¿Estas seguro de Modicar a este cliente?")) {
      $.ajax({
        url: "controller/ClientesController.php",
        type: "GET",
        data: datos,
        success: function (e) {
          alert("Se modifico correctamente");
          ListCliente();
        },
      });
    }
  }
});

listarDocumentos();
listarRoles();
reiniciarUI();
