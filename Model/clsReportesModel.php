<?php


include_once ("../Model/clsConexion.php");
class clsReportesModel
{	
	private $strRespuesta;
	function __construct()
	{
		$this->strRespuesta;
	}
	public function GetMensaje(){
		return $this->strRespuesta;
	}
	public function ConsultarLiquidacionEncabezado($intNroLiquidacion){

		$Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarEncabezadoLiquidacion(?)";
            $query = $db->prepare($sql);       
            $query->bindparam(1,$intNroLiquidacion);      
            $query->execute();
            $this->strRespuesta=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
	}
	public function ConsultarLiquidacionDetalle($intNroLiquidacion,$strConcepto){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarLiquidacionDetalle(?,?)";
            $query = $db->prepare($sql);
            $query->bindparam(1,$intNroLiquidacion); 
            $query->bindparam(2,$strConcepto);                
            $query->execute();
            $this->strRespuesta=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
	}
}