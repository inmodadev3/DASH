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
    

    function EliminarPedido($intIdPedidoCliente){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_EliminarPedido(?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdPedidoCliente);
           
        $query->execute();
        
        $Conexion->CerrarConexion();
        $Conexion=null;   
        return $query->fetchAll(PDO::FETCH_ASSOC);
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

	function ListarPedidoCliente($intIdLogin, $intEstado){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ListarPedidoCliente(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdLogin);
        $query->bindparam(2,$intEstado);
           
        $query->execute();
        
        $Conexion->CerrarConexion();
        $Conexion=null;   
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    

    function ListarPedidoClientePorUsuario($intIdLogin, $intMes, $intAno){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ListarPedidosPorUsuario(?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdLogin);
        $query->bindparam(2,$intMes);
        $query->bindparam(3,$intAno);
           
        $query->execute();
        
        $Conexion->CerrarConexion();
        $Conexion=null;   
        return $query->fetchAll(PDO::FETCH_ASSOC);
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
	function ConsultarDetallePedidoCliente($intIdPedidoCliente, $intOpcion = 0){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ConsultarDetallePedidoCliente(?,?)";
        $query = $db->prepare($sql);   
        //$query->bindparam(1,$strDir);
        $query->bindparam(1,$intIdPedidoCliente);
        $query->bindparam(2,$intOpcion);   
           
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

    function ValidarEstadoPedidoCliente($intIdLogin, $strIdTercero){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ValidarEstadoPedidoCliente(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdLogin);   
        $query->bindparam(2,$strIdTercero);      
           
        
        $query->execute();
        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function ActualizarTerceroPedido($strNombre, $strCiudad, $intIdPedido, $intIdTercero){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ActualizarTerceroPedido(?,?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strNombre);  
        $query->bindparam(2,$intIdTercero);   
        $query->bindparam(3,$intIdPedido);    
        $query->bindparam(4,$strCiudad);  
           
        
        $query->execute();
        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

 ?>