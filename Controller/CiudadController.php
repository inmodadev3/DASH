<?php 
date_default_timezone_set('America/Bogota');
include_once ("../WebServices/clsCiudadWebService.php");
$objCiudad=new clsCiudadController();
if(isset($_POST['btnListarCiudades'])){
	 $objCiudad->ListarCiudades();
}
$objCiudad=null;
class clsCiudadController 
{
	function __construct()
	{
	
	}
	/*---------------------------------------VISTA RECEPCIÓN ---------------------------------*/
	/*Obtener lista Ciudades*/
	public function GetCiudades(){
		$objCiudades= new clsCiudadWebService();
		$objCiudades->ListarCiudades();
		$strRespuestaWs=json_decode($objCiudades->GetRespuestaWs());
		return $strRespuestaWs;
	}
	/*Listar ciudades select*/
	public function ListarCiudades(){
		$strRespuestaWs=$this->GetCiudades();
		$this->TipoDeHTML('Select',$strRespuestaWs);
	}
	public function TipoDeHTML($strTipo,$strRespuestaWs){
		$strHTML='';
		switch ($strTipo) {
			case 'Select':
				for($i=0;$i<=sizeof($strRespuestaWs)-1;$i++){
					$strHTML.="<option value='".$strRespuestaWs[$i]->stridciudad."'>".$strRespuestaWs[$i]->strdescripcion."</option>";
				}
				break;
		}
		echo $strHTML;
	}


}