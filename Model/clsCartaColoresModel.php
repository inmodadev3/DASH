<?php
include_once ("../Model/clsConexion.php");

class clsCartaColoresModel
{
	public function GetRespuesta(){
		return $this->strRespuesta;
	}
    public function CrearCartaColores($strDescripcionCarta,$strIdReferencia,$intIdLogin,$strPresentacion){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_CrearCartaColores(?,?,?,?)";
        $query = $db->prepare($sql);
        $query->bindparam(1,$strDescripcionCarta);  
        $query->bindparam(2,$strIdReferencia);  
        $query->bindparam(3,$intIdLogin);  
        $query->bindparam(4,$strPresentacion);     
        $query->execute();
        $this->strRespuesta=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }
    public function ListarCartaColores($intIdLogin){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_ListarCartaColores(?)";
        $query = $db->prepare($sql);
        $query->bindparam(1,$intIdLogin);  
        $query->execute();
        $this->strRespuesta=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }
    public function EditarCartaColores($intIdCartaColores,$strDescripcionCarta,$strPresentacion){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_EditarCartaColores(?,?,?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$intIdCartaColores);    
        $query->bindparam(2,$strDescripcionCarta);  
        $query->bindparam(3,$strPresentacion);  
        $query->execute();
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }
    public function EliminarCartaColores($intIdCartaColores){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_EliminarCartaColores(?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$intIdCartaColores);   
        $query->execute();
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }
    public function AgregarColorACartaColores($intIdCartaColores,$strIdColor,$strDescripcion,$strCantColor,$intIdUsuarioUltModif){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_AgregarColorACartaColores(?,?,?,?,?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$intIdCartaColores); 
        $query->bindparam(2,$strIdColor);
        $query->bindparam(3,$strDescripcion);
        $query->bindparam(4,$strCantColor);
        $query->bindparam(5,$intIdUsuarioUltModif);   
        $query->execute();
        $this->strRespuesta=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }
    public function ListarDetallCartaColores($intIdCartaColores){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_ListarDetallCartaColores(?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$intIdCartaColores);   
        $query->execute();
        $this->strRespuesta=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }
    public function EliminarColorDeCarta($intIdCartaColores){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_EliminarColorDeCarta(?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$intIdCartaColores);   
        $query->execute();
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }
}
?>
