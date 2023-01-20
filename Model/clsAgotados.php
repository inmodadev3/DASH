<?php
include_once ("../Model/clsConexion.php");

class clsAgotado
{
    private $strMensaje, $intId;
	function __construct()
	{
		$this->strMensaje='';
		$this->intNum=0;
	}
	public function GetRespuesta(){
		return $this->strMensaje;
	}
	public function GetRpta(){
		return $this->intNum;
    }

    //------------------------------------------------------tblReferenciasAgotadas--------------------------------------------------------------------
    function ConsultarReferenciaAgotada($strReferencia){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ConsultarReferenciaAgotada(?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strReferencia);   
        
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll();
    }
    
    function AgregarReferenciaAgotada($strReferencia,$intIdLogin, $strIdLinea, $strIdGrupo, $strIdClase, $strIdTipo, $strIP){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_AgregarReferenciaAgotada(?,?,?,?,?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strReferencia);   
        $query->bindparam(2,$intIdLogin);   
        $query->bindparam(3,$strIdLinea); 
        $query->bindparam(4,$strIdGrupo); 
        $query->bindparam(5,$strIdClase); 
        $query->bindparam(6,$strIdTipo); 
        $query->bindparam(7,$strIP); 
        
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll();
    }

    function EliminarReferenciaAgotada($strReferencia){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_EliminarReferenciaAgotada(?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strReferencia);   
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll();
    }

//------------------------------------------------------tblReferenciasAgotadas--------------------------------------------------------------------
    function ConsultarDetalleReferenciaAgotada($strReferencia){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ConsultarDetalleReferenciaAgotada(?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strReferencia);   
        
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll();
    }
    
    function AgregarDetalleReferenciaAgotada($intIdRefAgotada,$strDescripcion){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_AgregarDetalleReferenciaAgotada(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdRefAgotada);   
        $query->bindparam(2,$strDescripcion);   
        
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll();
    }

    function EliminarDetalleReferenciaAgotada($intId, $strDescripcion, $ban){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_EliminarDetalleReferenciaAgotada(?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intId); 
        $query->bindparam(2,$strDescripcion);   
        $query->bindparam(3,$ban);      

        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll();
    }
}


?>
