<?php
require_once '../core/model.master.php';

class MCompras extends ModelMaster
{

          //listar ventas
          public function VentasListar()
          {

                    try {
                              return parent::getRows("spu_ventas_listar");
                    } catch (Exception $error) {
                              die($error->getMessage());
                    }
          }


}

?>