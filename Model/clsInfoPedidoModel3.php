<?php 
include_once ("../Model/clsConexion.php");
/**
 * 
 */
class clsInfoPedidoModel
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
    
    function ListarPortafoliosTercero($intIdLogin, $mes, $año){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ListarPortafoliosTercero(?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdLogin);
        $query->bindparam(2,$mes);
        $query->bindparam(3,$año);
           
        $query->execute();
        $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;   
    }
    
    /*NUEVO*/
    function ListarInformePedidos(){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ListarInformePedidos()";
        $query = $db->prepare($sql);   
           
        $query->execute();
        $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;   
    }
    /*NUEVO*/

	function ListarPedidoCliente($intIdLogin, $mes, $año){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ListarPedidoCliente(?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdLogin);
        $query->bindparam(2,$mes);
        $query->bindparam(3,$año);
           
        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;   
	}
	function HabilitarPedido($strIdTercero, $intIdPortafolio, $intIdPortafolioTercero){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_HabilitarPedido(?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strIdTercero);
        $query->bindparam(2,$intIdPortafolio);
        $query->bindparam(3,$intIdPortafolioTercero);

        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;   
	}
	function ConsultarDetallePedidoCliente($intIdPedidoCliente){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ConsultarDetallePedidoCliente(?)";
        $query = $db->prepare($sql);   
        //$query->bindparam(1,$strDir);
        $query->bindparam(1,$intIdPedidoCliente);   
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll();
    }
    function ConsultarIngresoPortafolio($intIdPortafolio, $intIdTercero){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ListarCodigoIngresoPortafolio(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdPortafolio);   
        $query->bindparam(2,$intIdTercero);   
           
        
        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
    function ActualizarVigenciaCreacionPortafolio($intIdPortafolio,$strIdTercero, $intIdPortafolioTercero){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ActualizarVigenciaCreacionPortafolio(?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdPortafolio);   
        $query->bindparam(2,$strIdTercero);   
        $query->bindparam(3,$intIdPortafolioTercero); 
        
        $query->execute();
   		$this->intNum=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }

    function ActualizarEstadoPedidoCliente($intId){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ActualizarEstadoPedidoCliente(?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intId);
        
        $query->execute();
        $this->intNum=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
}

 ?>