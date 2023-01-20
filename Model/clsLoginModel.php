<?php

include_once ("../Model/clsConexion.php");
class clsLoginModel 
{
	
	function __construct()
	{
		
	}
	 public function ValidarLogin($strUsuario,$strClave)
     {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ValidarLogin(?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strUsuario);
            $query->bindparam(2,$strClave);      
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarUsuarios(){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ListarUsuarios()";
            $query = $db->prepare($sql);      
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
      public function ListarPermisosPorUsuario($strIdUsuario){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ListarPermisosPorUsuario(?)";
            $query = $db->prepare($sql); 
            $query->bindparam(1,$strIdUsuario);      
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
    public function AgregarPermisos($strIdPermiso,$strIdLogin,$intEstado,$intTipoVista,$intTipo){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_AgregarPermisos(?,?,?,?,?)";
            $query = $db->prepare($sql); 
            $query->bindparam(1,$strIdPermiso);   
            $query->bindparam(2,$strIdLogin);  
            $query->bindparam(3,$intEstado);  
            $query->bindparam(4,$intTipoVista);  
            $query->bindparam(5,$intTipo);       
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;

    }

    public function CrearLogin($strUsuario,$strClave,$strNombreEmpleado,$intIdCompania){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_CrearLogin(?,?,?,?)";
            $query = $db->prepare($sql); 
            $query->bindparam(1,$strUsuario);   
            $query->bindparam(2,$strClave); 
            $query->bindparam(3,$strNombreEmpleado);   
            $query->bindparam(4,$intIdCompania);          
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;
            return $query->fetchAll();   
    }
    public function EliminarUsuario($strIdUsuario){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_EliminarUsuario(?)";
            $query = $db->prepare($sql); 
            $query->bindparam(1,$strIdUsuario);          
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;
            return $query->fetchAll();   
    }
    public function EditarUsuario($strNombreEmpleado,$strUsuario,$strClave,$intIdUsuario,$intIdCompania){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ActualizarLogin(?,?,?,?,?)";
            $query = $db->prepare($sql); 
            $query->bindparam(1,$strNombreEmpleado);   
            $query->bindparam(2,$strUsuario);   
            $query->bindparam(3,$strClave);   
            $query->bindparam(4,$intIdUsuario);   
            $query->bindparam(5,$intIdCompania);             
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;
            return $query->fetchAll();   
    }
    public function BuscarUsuario($intIdUsuario){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ListarUsuario(?)";
            $query = $db->prepare($sql); 
            $query->bindparam(1,$intIdUsuario);             
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;
            return $query->fetchAll();   
    }
    public function AgregarEmpeladosAsociados($strCedulaEmpleado,$intTipoVista,$intTipoEmpleado,$strNombreEmpleado,$intIdUsuario){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_AgregarEmpeladosAsociados(?,?,?,?,?)";
            $query = $db->prepare($sql); 
            $query->bindparam(1,$strCedulaEmpleado);
            $query->bindparam(2,$intTipoVista);             
            $query->bindparam(3,$intTipoEmpleado);             
            $query->bindparam(4,$strNombreEmpleado);  
            $query->bindparam(5,$intIdUsuario);                        
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;
            return $query->fetchAll();
    }
    public function ListarUsuariosAsociados($intIdUsuario){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ListarUsuariosAsociados(?)";
            $query = $db->prepare($sql); 
            $query->bindparam(1,$intIdUsuario);                    
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;
            return $query->fetchAll();
    }
      public function EliminarEmpleadoAsociado($intIdUsuario){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_EliminarEmpleadoAsociado(?)";
            $query = $db->prepare($sql); 
            $query->bindparam(1,$intIdUsuario);                    
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;
            return $query->fetchAll();
    }











//HeaderController y LoginController
    public function ConsultarModulos($tipo, $intEncabezado){ // Encabezado = 1, Detalle = 0
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ConsultarModulos(?,?)";
            $query = $db->prepare($sql);     
            $query->bindparam(1,$tipo);
            $query->bindparam(2,$intEncabezado);             
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;
            return $query->fetchAll();
    }

    public function ConsultarModulosDetalle($intIdPermiso,$intTipo)
    {       
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_ConsultarModuloDetalle(?,?)";
        $query = $db->prepare($sql);
        $query->bindparam(1, $intIdPermiso); 
        $query->bindparam(2, $intTipo);             
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll();
    }
    
//LoginController
      public function AgregarModulos($strNombreModulo, $strGet, $strDescripcion, $intTipoPermiso, $strIcono){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_CrearModulo(?,?,?,?,?)";
            $query = $db->prepare($sql);     
            $query->bindparam(1,$strNombreModulo);   
            $query->bindparam(2,$strGet);   
            $query->bindparam(3,$strDescripcion); 
            $query->bindparam(4,$intTipoPermiso);
            $query->bindparam(5,$strIcono);             
            $query->execute();
            $rpta =$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;
            return $rpta;
    }

    public function AgregarModuloDetalle($strNombreModulo, $strGet, $strDescripcion, $intIdPermiso, $intTipoPermiso, $strIcono){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_CrearModuloDetalle(?,?,?,?,?,?)";
            $query = $db->prepare($sql);     
            $query->bindparam(1,$intIdPermiso);   
            $query->bindparam(2,$strNombreModulo);   
            $query->bindparam(3,$strGet);
            $query->bindparam(4,$strDescripcion);
            $query->bindparam(5,$intTipoPermiso);
            $query->bindparam(6,$strIcono);

            $query->execute();
            $rpta =$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;
            return $rpta;
    }

    public function ListarPermisos($rComienzo, $rFinal)
    {       
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_ListarPermisos(?,?)";
        $query = $db->prepare($sql); 
        $query->bindparam(1, $rComienzo);    
        $query->bindparam(2, $rFinal);                   
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll();
    }

    public function ActualizarPermisosLogin($intIdPermiso, $intIdLogin, $intVer, $intEditar, $intIngresar, $intTipoVista){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ActualizarPermisosLogin(?,?,?,?,?,?)";
            $query = $db->prepare($sql);     
            $query->bindparam(1,$intIdPermiso);   
            $query->bindparam(2,$intIdLogin);   
            $query->bindparam(3,$intVer); 
            $query->bindparam(4,$intEditar);    
            $query->bindparam(5,$intIngresar);   
            $query->bindparam(6,$intTipoVista);     
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;
            return $query->fetchAll();
    }

    public function ActualizarModulo($strNombre,$strGet,$strDescripcion, $intTipoPermiso, $intId, $strIcono)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_ActualizarModulo(?,?,?,?,?,?)";
        $query = $db->prepare($sql);     
        $query->bindparam(1,$intId);   
        $query->bindparam(2,$strNombre);   
        $query->bindparam(3,$strGet); 
        $query->bindparam(4,$strDescripcion);    
        $query->bindparam(5,$intTipoPermiso);     
        $query->bindparam(6,$strIcono);
       $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;
            return $query->fetchAll();
    }

    public function ActualizarModuloDetalle($strNombre,$strGet,$strDescripcion, $intIdModulo, $intTipoPermiso, $intId, $strIcono)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_ActualizarModuloDetalle(?,?,?,?,?,?,?)";
        $query = $db->prepare($sql);     
        $query->bindparam(1,$intId);   
        $query->bindparam(2,$strNombre);   
        $query->bindparam(3,$strGet); 
        $query->bindparam(4,$strDescripcion); 
        $query->bindparam(5,$intIdModulo);    
        $query->bindparam(6,$intTipoPermiso);  
        $query->bindparam(7,$strIcono);     
        $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;
            return $query->fetchAll();
    }

    public function EliminarModulo($intId)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_EliminarModulo(?)";
        $query = $db->prepare($sql);     
        $query->bindparam(1,$intId);     
        $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;
            return $query->fetchAll();
    }
}