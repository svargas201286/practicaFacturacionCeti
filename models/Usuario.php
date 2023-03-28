<?php

require_once '../core/model.master.php';

class Usuario extends ModelMaster{



  //Login
  public function login(array $datosEnviar){
    try{
      //LOGIN debe haber retorno
      return parent::execProcedure($datosEnviar, "spu_usuarios_login", true);

      //NO RETORNO (eliminar)
      //parent::execProcedure($datosEnviar, "spu_tablaX_eliminar", false);

    } catch (Exception $error){
      die($error->getMessage());
    }
  }

  public function actualizarClave(array $datosEnviar){
    try{
      parent::execProcedure($datosEnviar, "spu_usuarios_actualizarClave", false);
    } catch (Exception $error){
      die($error->getMessage());
    }
  }

  public function listarUsuario(){
    try{
      return parent::getRows("spu_usuario_listar");
    } catch (Exception $error){
      die($error->getMessage());
    }
  }

  public function registrarUsuario(array $registrarUsu ){
    try{
      parent::execProcedure($registrarUsu, "spu_usuarios_registrar", false);
    } catch (Exception $error){
      die($error->getMessage());
    }
  }

  public function actualizarUsuario(array $data){
    try{
      parent :: execProcedure($data,"spu_usuarios_actualizar", false);
      return true;
    } catch (Exception $error){
      die($error->getMessage());
      return false;
    }
  }

  public function ValidacionUsuarios(array $data){ 
    try{
        return parent::execProcedure($data,"spu_usuarios_optenerNombreUser",true);

    }
    catch(Exception $error){
        die($error->getMessage());
    }
}

public function usuariosActivos(array $data){
    try{
        return parent::execProcedure($data,"spu_usurios_Activos",true);
    }catch(Exception $error){
        die($error->getMessage());
    }
}

public function ObtenerIdPersona(array $data){
    try{
        return parent::execProcedure($data,"spu_usuarios_optenerIdpersona",true);
    }catch(Exception $error){
        die($error->getMessage());
    }
}

public function ObtenerIdUsuario(array $data){
    try{
        return parent::execProcedure($data,"spu_usuarios_obtenerIdUsuario",true);
    }catch(Exception $error){
        die($error->getMessage());
    }
}

public function OptenerDocumentoUsuario(array $data){
  try{
    return parent::execProcedure($data,"spu_usuarios_optenerNumeroDocumento",true);
  } catch (Exception $error){
    die($error->getMessage());
  }
}



public function cargarRolUsuario(){
  try{
      return parent::getRows("spu_cargar_Roles");

  }
  catch(Exception $error){
      die($error->getMessage());
  }
}


public function template(array $data){
  try{
    //Instrucciones...
  } catch (Exception $error){
    die($error->getMessage());
  }
}


}



