<?php

require_once '../core/model.master.php';

class clsCliente extends ModelMaster
{

  public function listarCliente()
  { //Probado

    try {
      return parent::getRows("spu_clientes_listar");
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  //carga datos de documento para select
  public function listarDocumentos()
  {

    try {
      return parent::getRows("spu_cargar_documento");
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }


  public function listarRoles()
  {

    try {
      return parent::getRows("spu_cargar_roles");
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  public function OptenerDocumentoCliente(array $data)
  {
      try {
          return parent::execProcedure($data, "spu_cliente_OptenerDocumento4", true);
      } catch (Exception $error) {
          die($error->getMessage());
      }
  }

  function RegistrarCliente(array $data)
  {
    try {
      parent::execProcedure($data, "spu_clientes_registrar", false);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
  
  function EliminarCliente(array $data)
  {
    try {
      parent::execProcedure($data, "", false);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }


  function modificarCliente(array $idCliente)
  {
    try {
      parent::execProcedure($idCliente, "spu_modificar_cliente", false);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function OptenerIdCliente(array $data)
  { //Probado
      try {
          return parent::execProcedure($data,"spu_Cliente_OptenerId", true);
      } catch (Exception $error) {
          die($error->getMessage());
      }
  }

  public function OptenerIdRoles(array $data)
  {
    try {
      return parent :: execProcedure($data, "spu_Roles_OptenerId", true);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

}
