<?php 
include_once ("../Model/clsConexion.php");
class clsProductosModel
{
	private $strRespuesta;
    function __construct()
    {
        $this->strRespuesta='';
    }
    public function GetRespuesta(){
        return $this->strRespuesta;
    }

    public function GetEncabezadoCompraProductos($strAnno)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();

        $sql= "CALL SP_ConsultarEncabezadoCompraProductos(?)";
        $query = $db->prepare($sql); 
        
        $query->bindParam(1,$strAnno); 

        $query->execute();
        $this->strRespuesta=$query->fetchAll(PDO::FETCH_ASSOC);
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
    public function GetProductosLiquidadosCompra($strIdCompra,$intEstadoProductos){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();

        $sql= "CALL SP_ConsultarProductosLiquidadosCompra(?,?)";
        $query = $db->prepare($sql); 
        
        $query->bindParam(1,$strIdCompra); 
        $query->bindParam(2,$intEstadoProductos); 

        $query->execute();
        $this->strRespuesta=$query->fetchAll(PDO::FETCH_ASSOC);
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
}

?>