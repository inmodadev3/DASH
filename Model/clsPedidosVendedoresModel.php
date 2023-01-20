<?php


include_once ("../Model/clsConexion.php");
class clsPedidosVendedoresModel 
{
	
	function __construct()
	{
		# code...
	}

    public function ListarPedidos()
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
        
        $sql= "CALL SP_ConsultarEncabezadoPedidos()";
        $query = $db->prepare($sql);        
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ConsultarDetallePedido($strIdPedido)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
        
        $sql= "CALL SP_ConsultarDetallePedido(?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$strIdPedido);          
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ConsultarEncabezadoPedido($strIdPedido){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
        
        $sql= "CALL SP_ConsultarEncabezadoPedido(?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$strIdPedido);          
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function AsignarSeparador($strIdPedido,$strIdSeparador,$strSeparador,$intEstado){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
        
        $sql= "CALL SP_AsignarSeparador(?,?,?,?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$strIdPedido);          
        $query->bindparam(2,$strIdSeparador);          
        $query->bindparam(3,$strSeparador);          
        $query->bindparam(4,$intEstado);          
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
    public function FinalizarPedidoSeparador($strIdPedido){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
        
        $sql= "CALL SP_FinalizarPedidoBodega(?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$strIdPedido);           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
    public function ActualizarEstadoPedido($strIdPedido, $intEstado, $intTransaccionHgi, $intDocumentoHgi){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
        
        /**Validar segundo parametro */
        $sql= "CALL SP_ActualizarEstadoPedido(?,?,?,?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$strIdPedido);    
        $query->bindparam(2,$intTransaccionHgi);    
        $query->bindparam(3,$intDocumentoHgi);    
        $query->bindparam(4,$intEstado);           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
    }
}
?>