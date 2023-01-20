<?php
require_once("../Model/clsZonasModel.php");
require_once("../Controller/CiudadController.php");
$objZonas = new clsZonasController();

if(isset($_POST['ConsultarZonas'])){
	 $CodigoZona=$objZonas->AgregarZonas();
}
if(isset($_POST['btnEditarZona'])){
	$objZonas->EditarZona();
}
if(isset($_POST['ListarZonas'])){
	$tabla =$objZonas->ListarZonas();
	echo $tabla;
	
}
if(isset($_POST['AgregarCiudadAZona'])){
	$tabla =$objZonas->AgregarCiudadAZona();
echo ($tabla[0]);	
}
if(isset($_POST['ListarCiudadesPorZona'])){
	$tabla =$objZonas->ListarCiudadesPorZona();
	echo $tabla;
	
}
if(isset($_POST['EliminarCiudadPorZona'])){
	$tabla =$objZonas->EliminarCiudadPorZona();
	echo $tabla[0];	
}
$objZonas=null;
class clsZonasController
{
	private $UrlWebService;
	private $array_Ciudades;
	
	function __construct()
	{
		$this->UrlWebService="http://10.10.10.150/webservice/WebModaService.asmx?WSDL";		
	}
	public function ConsultarWebService($Tipo){		
			$client = new SoapClient($this->UrlWebService);
			$WebServiceSticker=$client->$Tipo(); 
			$client=null;
		  	return	$WebServiceSticker;
	}
	public function ConsultarCiudades(){
		$tabla="";
		$objCiudades= new clsCiudadController();
		$strCiudades=$objCiudades->GetCiudades();
		$k=0;
		for ($i=0; $i <= sizeof($strCiudades)-1 ; $i++){ 
			$tabla .= '<tr id="Ciudad_'.($k+1).'"><td id="'.($k+1).'">'.$strCiudades[$i]->stridciudad.'</td><td>'.$strCiudades[$i]->strdescripcion.'</td><td>
				<button id="btnCiudad_'.($k+1).'" disabled="true"  class="btn btn-default" type="button" onclick="AgregarCiudadAZona('.($k+1).')"><i class="glyphicon glyphicon-share"></i></button></td></tr> ';
			$k++;
		}
		return $tabla;	
	}
	public function ConsultarArrayCiudades(){
		$tabla="";
		$Ciudades = $this->ConsultarWebService('ConsultarCiudades');
		$array_Ciudades = explode("%", $Ciudades->ConsultarCiudadesResult);
		
		return $array_Ciudades;
		
	}
	public function AgregarZonas(){

		if(trim($_POST["txtDescripcionZona"])!= ''){
			$objZonasModel = new clsZonasModel();
			$CodigoZona=$objZonasModel->AgregarZona(strtoupper($_POST["txtDescripcionZona"]));
			echo $CodigoZona;
		}else{
			echo "%%";
		}


	}
	public function ListarZonas(){
		$tabla="";
		$objZonasModel = new clsZonasModel();
		$Zonas=$objZonasModel->ListarZonas();
	
		for ($i=0; $i < sizeof($Zonas) ; $i++) { 
			$tabla .= "<tr id='Zona_".($i+1)."'><td id='CodCiudad_".($i+1)."'>".$Zonas[$i][0]."</td><td id='DescZona_".($i+1)."'>".$Zonas[$i][1]."</td><td><button class='btn btn-default'  type='button' data-toggle='collapse' href='#pnCiudadesZona' onclick='AsignarZona(\"".($i+1)."\")' id=btnZona_".($i+1)." ><i class='glyphicon glyphicon-check'></i></button></td></tr> ";
		}
	return $tabla;
	}
	public function AgregarCiudadAZona(){
		$objZonasModel = new clsZonasModel();
		$Zonas=$objZonasModel->AgregarCiudadesAZona($_POST["CodZona"],$_POST["CodCiudad"]);
		return $Zonas[0];
	}
	public function ListarCiudadesPorZona(){		
		$tabla="";
		$objZonasModel = new clsZonasModel();
		$CiudadesPorZona=$objZonasModel->ListarCiudadesPorZona($_POST["CodZona"]);
		$array_Ciudades=$this->ConsultarArrayCiudades();
		$nombreCiudad="";	
		for ($i=0; $i < sizeof($CiudadesPorZona) ; $i++) { 			
			for ($k=0; $k < sizeof($array_Ciudades) ; $k=$k+2) { 
				if($CiudadesPorZona[$i]["intIdCiudad"] == $array_Ciudades[$k]){
					$nombreCiudad=$array_Ciudades[$k+1];
						$tabla .= "<tr id='CiudadPorZona".($i+1)."'><td id='CodCiudadZ_".($i+1)."'>".$CiudadesPorZona[$i][0]."</td><td id='DescCiudad_".($i+1)."'>".$nombreCiudad."</td><td><buton class='btn btn-default' onclick='EliminarCiudadPorZona(".($i+1).")'  type='button' id=btnCiudadPorZona_".($i+1)." ><i class='glyphicon glyphicon-trash'></button></td></tr> ";
				}
			}
			
		}
		return $tabla;
	}
	public function EliminarCiudadPorZona(){
		$objZonasModel = new clsZonasModel();
		$Zonas=$objZonasModel->EliminarCiudadPorZona($_POST["CodZona"],$_POST["CodCiudad"]);		
		return $Zonas[0];
	}
	public function EditarZona(){
			$objZonasModel = new clsZonasModel();
			if(trim($_POST['txtZona'])==''){
				echo 'Ingrese Descripción.%error';
				return;
			}
			$Mensaje=$objZonasModel->EditarZona($_POST["CodZona"],strtoupper($_POST["txtZona"]));
		
		echo $Mensaje[0]['Mensaje']."%success";	
		$objZonas=null;	
	}
}
?>