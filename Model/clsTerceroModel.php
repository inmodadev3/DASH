<?php
include_once ("../Model/clsConexion.php");
class clsTerceroModel
{	
	private $strRespuesta;
	function __construct()
	{
		$this->strRespuesta;
	}
	public function GetRespuesta(){
		return $this->strRespuesta;
	}
	public function CrearEncabezadoFacturaRecepcion($strIdLogin,$strCedulaTercero,$strPreferenciaTercero,$strPrecio,$strObservacion,$strIdVendedor){

		$Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_CrearEncabezadoFactura(?,?,?,?,?,?)";
            $query = $db->prepare($sql);       
            $query->bindparam(1,$strIdLogin);      
            $query->bindparam(2,$strCedulaTercero);       
            $query->bindparam(3,$strPreferenciaTercero);      
            $query->bindparam(4,$strPrecio);      
            $query->bindparam(5,$strObservacion);      
            $query->bindparam(6,$strIdVendedor);      
            $query->execute();
            $this->strRespuesta=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
	}
}