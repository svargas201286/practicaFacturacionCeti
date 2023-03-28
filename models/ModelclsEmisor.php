<?php

require_once '../core/model.master.php';

class clsEmisor extends ModelMaster
{

  public function consultarListaEmisores()
  {
    try {
      return parent::getRows("spu_emisor_listar");
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  

  // public function consultarListaEmisores()
  // {
  //     $sql = "SELECT * FROM emisor";
  //     global $cnx;
  //     return $cnx->query($sql);
  // }

  // public function obtenerEmisor($id)
  // {
  //     $sql = "SELECT * FROM emisor WHERE id =:id";
  //     global $cnx;

  //     $parametros = array(
  //         ':id' =>    $id
  //     );
  //     $pre = $cnx->prepare($sql);
  //     $pre->execute($parametros);
  //     return $pre;
  // }

}
