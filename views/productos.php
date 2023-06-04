 <!-- <div class="col-md-12">
   <div class="card">
     <div class="card-header card-header-rose card-header-icon">
       <div class="card-icon">
         <i class="material-icons">assignment</i>
       </div>
       <h4 class="card-title"><b>PRODUCTOS </b></h4>
     </div>


     <button type="button" rel="tooltip" data-target="#modalRegisterCliente" data-toggle="modal" class="btn btn-primary btn-round btn-sm ml-auto" data-original-title="" title="registrar">
       <i class="material-icons">person</i> Registrar Cliente
     </button>

     <div class="card-body">
       <div class="table-responsive">
         <table class="table " id="table-productos">
           <thead>
             <tr style="text-decoration-color: black;">
               <th class=""><b>IMAGEN</b></th>
               <th><b>CODIGO</b></th>
               <th class="th-description"><b>DESCRIPCION</b></th>
               <th class="text-right"><b>CATEGORIA</b></th>
               <th class="text-right"><b>STOCK</b></th>
               <th class="text-right"><b>PRECIO VENTA</b></th>
               <th class="text-right"><b>FECHA ADD</b></th>
               <th class="text-right"><b>ACTIONS</b></th>
               <th></th>
             </tr>
           </thead>
           <tbody id="productosServicios">
              este body cargara dinamicamente 


           </tbody>
         </table>
       </div>
     </div>
   </div>
 </div> -->

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

             <tr>
               <td>
                 <div class="box">
                   <div class="col col-lg-12 col-sm-12 col-xs-12">
                     <div class="contenedor-tipo-documento">
                       <label for="dnis" id="dni" class="">DNI</label>
                       <input type="radio" id="dnis" class="tipo_desc" name="tipo_desc" value="S/" checked>
                       <label for="rucs" id="ruc" class="">RUC</label>
                       <input type="radio" id="rucs" class="tipo_desc" name="tipo_desc" value="%">
                     </div>
                   </div>
                 </div>
             </tr>

             <h4 class="card-title" style="color:black"><b>PRODUCTOS</b></h4>
             <button type="button" rel="tooltip" data-target="#modalRegisterCliente" data-toggle="modal" class="btn btn-primary btn-round btn-sm ml-auto" data-original-title="" title="registrar">
               <i class="material-icons">person</i> Registrar Producto
             </button>

           </div>
           <div class="card-body">
             <div class="table-responsive">
               <table class="table" id="table-Productos">
                 <thead>
                   <tr style="text-decoration-color: black;">
                     <th class=""><b>IMAGEN</b></th>
                     <th><b>CODIGO</b></th>
                     <th style="width: 30%;"><b>DESCRIPCION</b></th>
                     <th><b>CATEGORIA</b></th>
                     <th><b>STOCK</b></th>
                     <th><b>PRECIO <br> VENTA</b></th>
                     <th><b>FECHA <br> ADD</b></th>
                     <th style="width: 5%;" class="disabled-sorting text-right"><b>ACTIONS</b></th>
                   </tr>
                 </thead>
                 <tfoot>
                   <tr>
                     <th class=""><b>IMAGEN</b></th>
                     <th><b>CODIGO</b></th>
                     <th><b>DESCRIPCION</b></th>
                     <th><b>CATEGORIA</b></th>
                     <th><b>STOCK</b></th>
                     <th><b>PRECIO <br> VENTA</b></th>
                     <th><b>FECHA <br> ADD</b></th>
                     <th class="text-right"><b>ACTIONS  </b></th>
                   </tr>
                 </tfoot>
                 <tbody id="productosServicios">
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

 <script src="js/productos.js"></script>