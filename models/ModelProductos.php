<?php
require_once '../core/model.master.php';

class ProductosModel extends ModelMaster
{

          public function cargarProducto()
          {
                    try {
                              return parent::getRows("spu_cargarProducto");
                    } catch (Exception $error) {
                              die($error->getMessage());
                    }
          }



          public function registrarCliente(array $registrarPerson)
          {
                    try {
                              parent::execProcedure($registrarPerson, "spu_clientes_registrar", false);
                              return true;
                    } catch (Exception $error) {
                              die($error->getMessage());
                              return true;
                    }
          }


           

          public function OptenerDocumentoPersona(array $data)
          {
                    try {
                              return parent::execProcedure($data, "spu_personas_OptenerDocumento", true);
                    } catch (Exception $error) {
                              die($error->getMessage());
                    }
          }

          public function modificarPersona(array $data)
          { //Probado
                    try {
                              return parent::execProcedure($data, "spu_personas_actualizar", false);
                              return true;
                    } catch (Exception $error) {
                              die($error->getMessage());
                              return false;
                    }
          }

          public function OptenerIdPersona(array $data)
          { //Probado
                    try {
                              return parent::execProcedure($data, "spu_personas_OptenerId", true);
                    } catch (Exception $error) {
                              die($error->getMessage());
                    }
          }

          public function ActualizarFoto(array $data)
          {
                    try {
                              parent::execProcedure($data, "spu_personas_ActualizarFoto", false);
                              return true;
                    } catch (Exception $error) {
                              die($error->getMessage());
                              return false;
                    }
          }
}
