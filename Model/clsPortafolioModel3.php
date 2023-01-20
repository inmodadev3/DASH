<?php 
include_once ("../Model/clsConexion.php");
class clsPortafolioModel 
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
	function AgregarPortafolio($strTitulo, $dtFecha, $idUser){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_AgregarPortafolio(?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strTitulo);
        $query->bindparam(2,$dtFecha);
        $query->bindparam(3,$idUser);
           
        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;   
	}
	function AgregarDetalle($strRuta, $dtFecha, $intIdEncabezado){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_AgregarDetallePortafolio(?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strRuta);
        $query->bindparam(2,$intIdEncabezado);
        $query->bindparam(3,$dtFecha);
           
        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
	}
	function ConsultarPortafolio($strNombre, $intIdUser){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ConsultarPortafolioPorNombre(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strNombre);
        $query->bindparam(2,$intIdUser); 

        $query->execute();
   		$this->intNum=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
	}
	function ConsultarDetalle($strDir, $intIdPortafolio){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_ConsultarDetallePorDireccion(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strDir);
        $query->bindparam(2,$intIdPortafolio); 
           
        $query->execute();
   		$this->intNum=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
	}
	function ConsultarDetallesPorId($intIdPortafolio){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ConsultarDetallesPorId(?)";
        $query = $db->prepare($sql);   
        //$query->bindparam(1,$strDir);
        $query->bindparam(1,$intIdPortafolio);   
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll();
	}
	function EliminarDetalle($strDir, $intIdPortafolio){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_EliminarDetalle(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strDir);
        $query->bindparam(2,$intIdPortafolio);
           
        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
	}
	function ListarPortafolios($intIdUser){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_CosultarPortafolio(?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdUser);
           
        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
	}
	function ListarDetallePortafolio($intIdPortafolio){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ListarDetallePortafolio(?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdPortafolio);
           
        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
	}
	function EliminarPortafolio($intIdPortafolio){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_EliminarPortafolio(?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdPortafolio);
           
        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
	}
	function EditarNombrePortafolio($intIdPortafolio, $strNombre){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_EditarNombrePortafolio(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdPortafolio);
        $query->bindparam(2,$strNombre);
           
        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
	}

	public function CiudadesVendedoresAsociados($StrLogin){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_CiudadesVendedoresAsociados(?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$StrLogin);
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;  
        }
    function AgregarPortafolioTercero($intIdTercero, $intIdPortafolio, $strNombreTercero)
    {
    	$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();       
        $sql= "CALL SP_AgregarPortafolioTercero(?,?,?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$intIdTercero);
        $query->bindparam(2,$intIdPortafolio);
        $query->bindparam(3,$strNombreTercero);
        $query->execute();
        $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }
    function ActualizarPortafolioTercero($intIdPortafolio, $strDescripcion, $intId, $intIdVendedor){
    	$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();       
        $sql= "CALL SP_ActualizarPortafolioTercero(?,?,?,?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$intIdPortafolio);
        $query->bindparam(2,$strDescripcion);
        $query->bindparam(3,$intId);
        $query->bindparam(4,$intIdVendedor);
        $query->execute();
        $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }
    function ConsultarNombrePortafolio($intIdPortafolio)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();       
        $sql= "CALL SP_ConsultarNombrePortafolio(?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$intIdPortafolio);
        $query->execute();
        $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }

    public function FiltrarPortafolios($strText, $intIdlogin, $año,  $mes)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_FiltrarPortafolios(?,?,?,?)";
        $query = $db->prepare($sql); 
        $query->bindParam(1,$strText);
        $query->bindParam(2,$intIdlogin);
        $query->bindParam(3,$año);
        $query->bindParam(4,$mes);       
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll();
    }
}


 ?>