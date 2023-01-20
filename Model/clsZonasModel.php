<?php

include_once ("../Model/clsConexion.php");
class clsZonasModel 
{
 	  public function AgregarZona($StrDescripcionZona)
     {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
            $sql= "CALL SP_AgregarZonas(?)";
            $query = $db->prepare($sql); 
            $query->bindparam(1,$StrDescripcionZona);       
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
     public function ListarZonas()
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
            $sql= "CALL SP_ListarZonas()";
            $query = $db->prepare($sql);      
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            
            return $query->fetchAll();
    }
     public function AgregarCiudadesAZona($CodigoZona,$CodigoCiudad)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
            $sql= "CALL SP_AsignarCiudadesAZona(?,?)";
            $query = $db->prepare($sql);
            $query->bindparam(1,$CodigoZona);    
            $query->bindparam(2,$CodigoCiudad);          
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 

            return $query->fetchAll();
    }
    public function ListarCiudadesPorZona($CodigoZona)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
            $sql= "CALL SP_ListarCiudadesPorZona(?)";
            $query = $db->prepare($sql);
            $query->bindparam(1,$CodigoZona);            
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 

            return $query->fetchAll();
    }
    public function EliminarCiudadPorZona($CodigoZona,$CodigoCiudad)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
            $sql= "CALL SP_EliminarCiudadPorZona(?,?)";
            $query = $db->prepare($sql);
            $query->bindparam(1,$CodigoCiudad);    
            $query->bindparam(2,$CodigoZona);          
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 

            return $query->fetchAll();
    }
        public function EditarZona($CodigoZona,$StrDescripcion)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
            $sql= "CALL SP_EditarZona(?,?)";
            $query = $db->prepare($sql);
            $query->bindparam(1,$CodigoZona);          
            $query->bindparam(2,$StrDescripcion);          
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
    public function ListarCiudades()
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
            $sql= "CALL SP_ListarCiudades()";
            $query = $db->prepare($sql);     
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 

            return $query->fetchAll();
    }

}
?>