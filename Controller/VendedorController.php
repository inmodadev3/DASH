<?php 
include_once ("../WebServices/clsVendedorWebService.php");
include_once ("../WebServices/clsCiudadWebService.php");
include_once ("../Model/clsVendedoresModel.php");
@session_start();
$objVendedor=new clsVendedorController();
if(isset($_POST['btnListarVendedores'])){
	 $objVendedor->ListarVendedores();
}
if(isset($_POST['btnDdlCiudadesAsociadas'])){
	$objVendedor->ListarDdlCiudadesAsociadas();
}
$objVendedor=null;
class clsVendedorController 
{
	function __construct()
	{
		
	}
	/*-----------------------------------GENERAL-----------------------------------------------*/
	public function TipoHTML($strTipo,$strData){
		$strContenido='';
		switch ($strTipo) {
			case 'DdlCiudades':
				$objCiudad= new clsCiudadWebService();
				$objCiudad->ListarCiudades();
				$strCiudades=json_decode($objCiudad->GetRespuestaWs());
				for($i=0;$i<=sizeof($strData)-1;$i++){
					for($j=0;$j<=sizeof($strCiudades)-1;$j++){
						if($strData[$i]['intIdCiudad']==$strCiudades[$j]->stridciudad){
							$strContenido.="<option value='".($strCiudades[$j]->stridciudad)."'>".($strCiudades[$j]->strdescripcion)."</option>";
							break;
						}
					}
				}
			break;
		}
		echo $strContenido;
	}


	/*-----------------------------------------VISTA RECEPCIÓN---------------------------------*/
	/* Metodo para listar todo los vendedores */
	public function ListarVendedores(){
		$objVendedor= new clsVendedorWebService();
		$objVendedor->ListarVendedores();
		$strRespuestaWs=json_decode($objVendedor->GetRespuestaWs());
		$strContenido='';
		for($i=0;$i<=sizeof($strRespuestaWs)-1;$i++){
			$strContenido.="<option value='".$strRespuestaWs[$i]->StrPwd."'>".$strRespuestaWs[$i]->StrNombre."</option>";
		}
		echo $strContenido;
	}
	/*---------------------------------------VISTA VENDEDOR-TERCEROS---------------------------------*/
	/* Metodo para obtener ciudades asociadas a los vendedores */
	public function GetCiudadesAsociadasAVendedor(){
		$idLogin=trim($_SESSION['idLogin']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ZonasCiudadesVendedoresAsociados($idLogin);
		$Ciudades=$objVendedorModel->GetRespuesta();
		$StrCiudades="";
		if(sizeof($Ciudades)!=0){
			for($i=0;$i<=sizeof($Ciudades)-1;$i++){
				$StrCiudades.="'".$Ciudades[$i]["intIdCiudad"]."',";
			}
		}
		return trim($StrCiudades,',');
	}
	/*Metodo encargado de construir el select de ciudades*/
	public function ListarDdlCiudadesAsociadas(){
		$idLogin=trim($_SESSION['idLogin']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ZonasCiudadesVendedoresAsociados($idLogin);
		$strCiudades=$objVendedorModel->GetRespuesta();
		$this->TipoHTML('DdlCiudades',$strCiudades);
	}
}