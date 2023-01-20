<?php 
include_once ("../Model/clsConexion.php");
class clsEstadosModelo
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

    public function consultarDetalleCompra($intEstado)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_ConsultarDetalleCompra(?)";
        $query = $db->prepare($sql); 
        $query->bindParam(1,$intEstado);       
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll();
    }

    public function filtrarInformacionCompras($strText, $intEstado)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_FiltrarInformacionCompras(?,?)";
        $query = $db->prepare($sql); 
        $query->bindParam(1,$strText);
        $query->bindParam(2,$intEstado);       
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll();
    }
}

 ?>