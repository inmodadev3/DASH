<?php 
header('Content-Type: text/html; charset=UTF-8');
include_once ("../Model/clsPortafolioModel.php");
include_once ("../Model/clsLoginModel.php");
include_once("../Classes/nusoap/nusoap.php");
include_once ("../Model/clsVendedoresModel.php");
include_once ("../Model/clsInfoPedidoModel.php");
include_once ("../WebServices/clsClaseWebService.php");
session_start();
mb_internal_encoding("UTF-8");
if(!isset($_SESSION['idLogin'])){
	echo "<script language='javascript'>window.location='../view/Login.php'</script>;";	
}


$Mosaico = new Mosaico();
if(isset($_POST['CargarPanelClientes'])){
	$Mosaico->CargarPanelClientes();
}

if(isset($_POST['chkGestionDestape'])){
	$Mosaico->GestionDestape($_POST['tipoGestion'], $_POST['idTercero'], $_SESSION['idLogin'], $_POST['accion']);
}

if(isset($_POST['ResetGesion'])){
	$Mosaico->ResetGesion($_POST['tipoGestion'], $_SESSION['idLogin']);
}


if(isset($_POST['ConsultarZonas'])){
	//$Mosaico->ConsultarZonas();
	$Mosaico->ConsultarZonasUsuario($_SESSION['idLogin']);

}

if(isset($_POST['ConsultarLineas'])){
	//$Mosaico->ConsultarLineas();
	$Mosaico->ValidarLineasUsuario($_SESSION['idLogin']);
}

if(isset($_POST['ConsultarParamViaja'])){
	$Mosaico->ConsultarParamViaja();
}

if(isset($_POST['FiltrarTerceroXzona'])){
	$Mosaico->FiltrarTerceroXzona($_POST['Lineas'], $_POST['Zonas'], $_POST['Pagina']);
}

if(isset($_POST['FiltrarTerceroXlineas'])){
	$Mosaico->FiltrarTerceroXlineas($_POST['Lineas'], $_POST['Zonas'], $_POST['Pagina']);
}

if(isset($_POST['FiltrarTerceroXsector'])){
	$Mosaico->FiltrarTerceroXsector($_POST['Sector'], $_POST['Pagina']);
}

if(isset($_POST['FiltrarTerceroXviaje'])){
	$Mosaico->FiltrarTerceroXviaje($_POST['Viaja'], $_POST['Pagina'], $_POST['arrayZonas']);
}

if(isset($_POST['FiltrarTerceroXcompra'])){
	$Mosaico->FiltrarTerceroXcompra($_POST['compra'], $_POST['Pagina'], $_POST['arrayZonas']);
}

if(isset($_POST['FiltrarTerceros'])){
	$Mosaico->FiltrarTerceros($_POST['text'], $_POST['arrayZonas'], $_POST['Pagina']);
}

if(isset($_POST['CargarPanelDetalleTercero'])){
	$Mosaico->ConsultarTercero($_POST['idTercero']);
}

if(isset($_POST['ConsultarCartera'])){
	$Mosaico->ConsultarCartera($_POST['idTercero']);
}
if(isset($_POST['CmdRestablecerPortafolio'])){
	$Mosaico->RestablecerPortafolio();
}

//PORTAFOLIO
if(isset($_POST['ValidarExistenciaPortafolio'])){
	$Mosaico->ValidarExistenciaPortafolio($_SESSION['idLogin'], $_POST['idTercero'], $_POST['nombreTercero']);
}

if(isset($_POST['RutaEncarpetado'])){
	if($_POST['folder'] == "main"){
		$ruta = '../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO/';
		$Mosaico->RutasEcarpetadoHome($_SESSION['idLogin'], $_POST['idPortafolio'], $ruta);
	}else{
		$r = str_replace('-','/',$_POST['folder']);
		$ruta = '../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO/'.$r.'/';
		$Mosaico->RutaEncarpetado(utf8_encode($ruta), $_POST['idTercero'], $_POST['idPortafolio']);
	}

	
}

if(isset($_POST['evtCheck'])){
	$r = str_replace('-','/',$_POST['folder']);
	$ruta = '../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO/'.$r.'/';
	
	$Mosaico->RutasPortafolio($ruta, $_POST['action'], $_POST['idPortafolio']);
	$Mosaico->RutasBack($ruta, $_POST['action'], $_POST['idPortafolio']);
}

if(isset($_POST['chkTipoAccesoPortafolio'])){
	$Mosaico->TipoAccesoPortafolio($_POST['tipoAcceso'], $_POST['idPortafolio']);
}

if(isset($_POST['PorcentajeParticipacion'])){
	$Mosaico->PorcentajeParticipacion($_POST['idTercero']);
}


//---------------------------------------------------------------------------------------------------------------------------------------------------
if(!isset($_SESSION['StrDir'])){
$_SESSION['StrDir']='../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO';
//echo 'ojo';
}


if(isset($_POST['btnListarArchivos'])){
	$Mosaico->ListarArchivos();
}
if (isset($_POST['btnListarTercero'])) {
	$Mosaico->ListarTercero("'".$_POST['idTercero']."'");
}
if (isset($_POST['evtFiltrarTercero'])) {
	$Mosaico->FiltrarTercero($_POST['NomTercero']);
}
if (isset($_POST['btnEnviarPortafolio'])) {
	$Mosaico->AgregarPortafolioTercero($_POST['idCliente'], $_POST['idPortafolio'], $_POST['nombreCliente']);
}
if (isset($_POST['btnDescPortafolioTercero'])) {
	$Mosaico->ActualizarPortafolioTercero($_POST['idPortafolio'],$_POST['txtArea'],$_POST['idRelacion'],$_POST['idVendedor']);
}
/*Listar Terceros*/

/*Navegacion para las rutas*/
if (isset($_POST['btnLink']) && isset($_POST['ruta'])) {
	$_SESSION['StrDir'] = $_POST['ruta'];
	$Mosaico->ListarArchivos();
}
if (isset($_POST['btnCrearRuta'])) {
	$Mosaico->Rutas();
}
if (isset($_POST['OpenRoute'])) {
	$Mosaico->OpenRoute($_POST['PosVector']);
}
/*Navegacion para las rutas*/




//listar detalle del portafolio seleccionado
if (isset($_POST['btnDbClick1'])) {
	$Mosaico->ListarArchivos();
}
//expandir detalle
if(isset($_POST['btnDbClick'])){
	$Mosaico->DbClick($_POST['DbClick']);
}
//eliminar portafolio !!!!!
if (isset($_POST['btnEliminarPortafolio']) && isset($_POST['IdPortafolio'])) {
	//echo $_POST['IdPortafolio'];
	$Mosaico->EliminarPortafolio($_POST['IdPortafolio']);
}
//editar nombre portafolio 
if (isset($_POST['btnEditarPortafolio']) && isset($_POST['IdPortafolio']) && isset($_POST['NombrePortafolio'])) {
	//echo $_POST['IdPortafolio']." ".$_POST['NombrePortafolio'];
	$Mosaico->EditarNombrePortafolio($_POST['IdPortafolio'],$_POST['NombrePortafolio']);
}
if(isset($_POST['btnHome'])){
	$_SESSION['StrDir']='../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO';

	$Mosaico->ListarArchivos();
}
if(isset($_POST['btnBack'])){
	
	if ($_SESSION['StrDir'] != '../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO') {
		$Mosaico->Back();
	}else{
		$Mosaico->ListarArchivos();
	}
}

if (isset($_POST['checkBox']) && isset($_POST['nombreCarpeta']) && trim($_POST['NombrePortafolio']) && isset($_POST['EstadoCheck'])) {
	$IdPortafolio = $Mosaico->BuscarPortafolio($_POST['NombrePortafolio'], $_SESSION['idLogin']);
	$Ruta = $_SESSION['StrDir']."/".$_POST['nombreCarpeta'];
	$EstadoCheck = $_POST['EstadoCheck'];
	//echo $Ruta." ".$IdPortafolio." ".$EstadoCheck;
	$Mosaico->Check($Ruta, $IdPortafolio, $EstadoCheck);
}

if (isset($_POST['btnAgregar'])) {
	if (isset($_POST['title'])) {
		$Mosaico->AgregarPortafolio($_POST['title']);
	}
}
if (isset($_POST['btnFinalizar'])) {
	$_SESSION['StrDir']='../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO';
	$Mosaico->ListarPortafolio($_SESSION['idLogin']);
}
if (isset($_POST['ConsultarNombrePortafolio'])) {
	//echo $_POST['IdPortafolio'];
	$Mosaico->ConsultarNombrePortafolio($_POST['IdPortafolio']);
}


if (isset($_POST['evtFiltrarPortafolios'])) {
	//echo $_POST['IdPortafolio'];
	$Mosaico->FiltrarPortafolios($_POST['text'], $_SESSION['idLogin'], $_POST['mes'], $_POST['año']);
}

if (isset($_POST['ConsultarGestiones'])) {
	$Mosaico->ConsultarGestiones($_SESSION['idLogin'], $_POST['IdTercero']);
}

if (isset($_POST['btnGuardarObservacion'])) {
	$Mosaico->GuardarGestion($_POST['Observacion'], $_SESSION['idLogin'], $_POST['IdTercero'], $_POST['TipoGestion']);
}

class Mosaico 
{

	private $Parametro;
	private $Tipo;
	private $DirectorioActual;
	private $NumCarpetas = 0;
	private $NumCarpetasSelect = 0;
	private $NumFotosSelect = 0;
	private $i = 2;
	private $idLogin;
	private $UrlWebService;
	private $strParametros;
	private $ban = 0;
	private $arrayClasesVendedor;
	private $ContarCarpetas;
	private $strRutaOwncloud;
	function __construct()
	{
		$this->Parametros[0]["Nombre"]='ACCESORIOS DE PLAYA';
		$this->Parametros[1]["Nombre"]='ACERO';
		$this->Parametros[2]["Nombre"]='APLIQUES';
		$this->Parametros[3]["Nombre"]='BOLSAS PP';
		$this->Parametros[4]["Nombre"]='BRILLO';
		$this->Parametros[5]["Nombre"]='CACHARROS';
		$this->Parametros[6]["Nombre"]='CAREY FRANCES';
		$this->Parametros[7]["Nombre"]='CAREY KOREANO';
		$this->Parametros[8]["Nombre"]='CAREY PLASTICO';
		$this->Parametros[9]["Nombre"]='COVER GOLD';
		$this->Parametros[10]["Nombre"]='EMPAQUES';
		$this->Parametros[11]["Nombre"]='ENSAMBLE';
		$this->Parametros[12]["Nombre"]='EXHIBIDORES';
		$this->Parametros[13]["Nombre"]='FABRICACION FANTASIA';
		$this->Parametros[14]["Nombre"]='FABRICACION GOLFI';
		$this->Parametros[15]["Nombre"]='FANTASIA';
		$this->Parametros[16]["Nombre"]='FARMA PET';
		$this->Parametros[17]["Nombre"]='GOLFIED TERMINADO';
		$this->Parametros[18]["Nombre"]='LINDAS';
		$this->Parametros[19]["Nombre"]='MARROQUINERIA';
		$this->Parametros[20]["Nombre"]='MAYORCA';
		$this->Parametros[21]["Nombre"]='ROPA INTERIOR';
		$this->Parametros[0]["Cnfg"]='1';
		$this->Parametros[1]["Cnfg"]='1';
		$this->Parametros[2]["Cnfg"]='0';
		$this->Parametros[3]["Cnfg"]='0';
		$this->Parametros[4]["Cnfg"]='1';
		$this->Parametros[5]["Cnfg"]='2';
		$this->Parametros[6]["Cnfg"]='2';
		$this->Parametros[7]["Cnfg"]='2';
		$this->Parametros[8]["Cnfg"]='2';
		$this->Parametros[9]["Cnfg"]='2';
		$this->Parametros[10]["Cnfg"]='2';
		$this->Parametros[11]["Cnfg"]='1';
		$this->Parametros[12]["Cnfg"]='0';
		$this->Parametros[13]["Cnfg"]='2';
		$this->Parametros[14]["Cnfg"]='2';
		$this->Parametros[15]["Cnfg"]='1';
		$this->Parametros[16]["Cnfg"]='2';
		$this->Parametros[17]["Cnfg"]='2';
		$this->Parametros[18]["Cnfg"]='1';
		$this->Parametros[19]["Cnfg"]='2';
		$this->Parametros[20]["Cnfg"]='2';
		$this->Parametros[21]["Cnfg"]='2';
		$this->Tipo='0';
		$this->idLogin = '';
		$this->NumCarpetas = 0;
		$this->NumCarpetasSelect = 0;
		$this->NumFotosSelect = 0;
		$this->i = 2;
		$this->idLogin = '';
		$this->UrlWebService="http://10.10.10.150/webservice/WebModaService.asmx?WSDL";
		$this->urlWebServiceTercero = 'http://10.10.10.128/webserviceportal/WebService/WebServiceTercero.php?wsdl';
		$this->urlWebServiceClases = 'http://10.10.10.128/webserviceportal/WebService/WebServiceClase.php?wsdl';
		$this->urlWebServiceCartera = 'http://10.10.10.128/webserviceportal/WebService/WebServiceCartera.php?wsdl';
		$this->strParametros = "";
		$this->arrayClasesVendedor = array();
		$this->strRutaOwncloud = '../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO/';

	}

	//MANDAR JSON 
	/*

	$return_arr[] = array("PRUEBA" => $valor);
	echo json_encode($return_arr);
	*/

	//---------------------FUNCIONES GENERALES---------
	function ConsultarGestiones($intIdLogin, $strIdTercero){
		$objPortafolio = new clsPortafolioModel();
		$rptaDB = $objPortafolio->ConsultarGestiones($intIdLogin, $strIdTercero);
		$return_arr = array("gestiones" => $rptaDB);
		echo json_encode($return_arr);
	}
	function GuardarGestion($observacion, $intIdLogin, $strIdTercero, $intTipoGestion){
		$objPortafolio = new clsPortafolioModel();
		$rptaDB = $objPortafolio->GuardarGestion($intIdLogin, $strIdTercero, $observacion, $intTipoGestion);
		return $rptaDB[0];
	}

	function ConsultarGestionDestape($strIdTercero, $intIdLogin){
		$objPortafolio = new clsPortafolioModel();
		$rptaDB = $objPortafolio->ConsultarGestionDestape($intIdLogin, $strIdTercero);

		return $rptaDB[0];
	}

	function ValidarPedidoTercero($strIdTercero){
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$estadoPedido = $objInfoPedidoPortafolio->ValidarEstadoPedidoCliente($_SESSION['idLogin'], $strIdTercero);
		return $estadoPedido;
	}

	function GestionDestape($intTipoGestion, $strIdTercero, $intIdLogin, $accion){
		//$array = array($intTipoGestion, $strIdTercero, $intIdLogin, $accion);
		//tipoGestion = 1 es gestion grupal
		//tipoGestion = 0 es gestion individual
		$objPortafolio = new clsPortafolioModel();
		$rptaDB = $objPortafolio->GestionDestapeTercero($intIdLogin, $strIdTercero, $intTipoGestion, $accion);

		$return_arr = array("destape" => $rptaDB[0]['rpta']);
		echo json_encode($return_arr);
	}

	function ResetGesion($intTipoGestion, $intIdLogin){

		$objPortafolio = new clsPortafolioModel();
		$rptaDB = $objPortafolio->ReiniciarGestionDestapeTercero($intIdLogin, $intTipoGestion);
		echo $rptaDB[0]['rpta'];
	}


	function CalcularDiasUltimaCompraPorTercero($date){
		//VERIFICAR
		if($date == null){
			$interval = -1;
		}else{
			$date = date_format(date_create($date), 'Y-m-d');
			$datetime1 = date_create($date);
			$datetime2 = date_create('now');
			$interval = date_diff($datetime1, $datetime2);
			$interval = $interval->days;
		}
		return $interval;
	}

	function CalcularDiffFechas($date1, $date2){
		if($date2 == ""){
			$date = date("Y-m-d");
		}
		if($date1 == null || $date2 == null){
			$interval = -1;
		}else{
			$date1 = date_format(date_create($date1), 'Y-m-d');
			$date2 = date_format(date_create($date2), 'Y-m-d');
			$datetime1 = date_create($date1);
			$datetime2 = date_create($date2);
			$interval = date_diff($datetime1, $datetime2);
			$interval = $interval->days;
		}
		return $interval;
	}

	function CalcularPromedioCompra($strFechasCompras){
		$cantDias = 0;
		$k = 0;
		$promCompra = 0;
		if($strFechasCompras != null){
			for ($i=0; $i < sizeof($strFechasCompras); $i++) { 
				if(isset($strFechasCompras[$i + 1]) == false){
					$date2 = date("Y-m-d");
				}else{
					$date2 = ($strFechasCompras[$i + 1]->DatFecha); 
					$date2 = new DateTime($date2);
					$date2 = $date2->format('Y-m-d');	
				}
				$date1 = ($strFechasCompras[$i]);
				$date1 = new DateTime($strFechasCompras[$i]->DatFecha);
				$date1 = $date1->format('Y-m-d');
					
				$cantDias+= $this->CalcularDiffFechas($date1, $date2);
				
				$k = $i + 1;
				//array_push($arrayFC, array($date1, $date2, $cantDias, $k));
			}
		}
		
		if($k != 0){
			$promCompra = $cantDias / $k;
		}
		return round($promCompra);
	}

	//---------------------FUNCIONES GENERALES---------
	function ConsultarIdVendedor(){
		$idVendedor = "";
		$objPortafolio = new clsPortafolioModel();
		$rptaDB = $objPortafolio->ListarIdVendedorPorLogin($_SESSION['idLogin']);
			
			$idVendedor = $rptaDB;
		/*@session_start();
		if(isset($_SESSION['idVendedor'])){
			$idVendedor = $_SESSION['idVendedor'];
		}else{
			$objPortafolio = new clsPortafolioModel();
			$rptaDB = $objPortafolio->ListarIdVendedorPorLogin($_SESSION['idLogin']);
			
			$idVendedor = $rptaDB;
			$_SESSION['idVendedor'] = $idVendedor;
		}*/
		return $idVendedor;
	}


	function CargarPanelClientes(){
		$array = array();
		/*$this->strParametros=array('strNombre'=>"");
		$Lista="";
		$strRespuestaTercero=json_decode($this->ConsultarWebServic("FiltrarTercero",true, $this->urlWebServiceTercero));

		foreach ($strRespuestaTercero as $key => $value) {
			//consultamos el estado del pedido de cada cliente
			$objInfoPedidoPortafolio = new clsInfoPedidoModel();
			$objInfoPedidoPortafolio->ValidarEstadoPedidoCliente($_SESSION['idLogin'], $value->stridtercero);
			$estadoPedido = $objInfoPedidoPortafolio->GetRespuesta();
			//si estado es -1 no existe pedido si no si es igual a 1 validamos cuantos dias esta activo


			$rpta = $this->ConsultarGestionDestape($value->stridtercero, $_SESSION['idLogin']);
			//Agregamos los datos de cada cliente al arreglo
			array_push($array, array('nombre'=>'Deiby', 'id'=>'1017252637' , 'viaja'=>1, 'zonas'=>'zonas', 'lineas'=>'lineas', 'FC'=>20, 'UC'=>5, 'PA'=>1 ));
		}*/
		$rpta = $this->ConsultarGestionDestape('1017252637', $_SESSION['idLogin']);
		array_push($array, array('StrNombre'=>'Deiby', 'StrIdTercero'=>'1017252637' , 'viaja'=>1, 'zonas'=>'zonas', 'lineas'=>'lineas', 'FC'=>20, 'UC'=>5, 'PA'=>15 , 'destape' => $rpta));
		$return_arr = array("clientes" => $array);
		echo json_encode($return_arr);
	}

	function ConsultarParamViaja(){
		$this->strParametros=array("strParam"=>"");
		$strRes=json_decode($this->ConsultarWebServic("ListarParametroViaja",true, $this->urlWebServiceTercero));
		//$strRes=json_decode($this->ConsultarWebServic("GetClases",false, $this->urlWebServiceClases));
		$return_arr = array("viaja" => $strRes);
		echo json_encode($return_arr);
	}


	function ConsultarZonas($idLogin){
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ConsultarZonasPorLogin($idLogin);
		$ZonasVendedor=$objVendedorModel->GetRespuesta();
		
		$return_arr = array("zonas" => $ZonasVendedor);
		echo json_encode($return_arr);
	}

	function ConsultarZonasUsuario($idLogin){
		$objPortafolio= new clsPortafolioModel();
		/* Consultamos las lineas del vendedor asociado de acuerdo al usuario del DASH*/
		$ZonasVendedor=$objPortafolio->ListarZonasPorUsuario($idLogin);
		$return_arr = array("zonas" => $ZonasVendedor);
		echo json_encode($return_arr);

	}

	function ConsultarLineas(){
		$rpta = array();
		$res=json_decode($this->ConsultarWebServic("GetClases",false, $this->urlWebServiceClases));

		array_push($rpta, array('val'=>'acero', 'id'=> 1));
		array_push($rpta, array('val'=>'fantasia', 'id'=> 2));
		$return_arr = array("lineas" => $res);
		echo json_encode($return_arr);
	}

	
	


	//---------------------FILTROS------------------------------------
	function ObtenerCiudadesPorZona($zonas){
		$objPortafolio = new clsPortafolioModel();

		$ciudades = "";
		foreach ($zonas as $key => $zona) {
			$strCiudades=$objPortafolio->ListarCiudadesPorZonaPorVendedor($zona);
			
			foreach ($strCiudades as $key => $value) {
				$ciudades.="'".$value['intIdCiudad']."',";
			}
		}
		
		$ciudades = substr($ciudades, 0, -1);
		return $ciudades;
	}

	function FiltrarTerceroXzona($clases, $zonas, $pagina){
		$arrayHCNC = array();
		$arrayPA = array();
		$arrayGD = array();
		$arrayFC = array();
		
		$ciudades = $this->ObtenerCiudadesPorZona($zonas);

		$clases = implode("','", $clases);
		$clases = "'".$clases."'";
		

		
		$this->strParametros=array('strIdClases'=>$clases, "strIdCiudades"=>$ciudades, "strViaja"=>"", "strText"=>"", "strCompra"=>"", "strIdVendedor" => "", "strPagina"=>$pagina);
		$strRespuestaTercero=json_decode($this->ConsultarWebServic("ListarTercerosPorFiltro",true, $this->urlWebServiceTercero));
		if (is_array($strRespuestaTercero) || is_object($strRespuestaTercero)){
			foreach ($strRespuestaTercero as $key => $value) {
				$this->strParametros=array("strTercero"=>$value->StrIdTercero);
				$strFechasCompras=json_decode($this->ConsultarWebServic("ListarFechasCompraTercero",true, $this->urlWebServiceTercero));
				
				$promCompra = $this->CalcularPromedioCompra($strFechasCompras);


				$rptaDestape = $this->ConsultarGestionDestape($value->StrIdTercero, $_SESSION['idLogin']);
				$rptaStatusPedido = $this->ValidarPedidoTercero($value->StrIdTercero);
				$days = $this->CalcularDiasUltimaCompraPorTercero($value->UltimaCompra);
				array_push($arrayHCNC,$days);
				array_push($arrayPA,$rptaStatusPedido);
				array_push($arrayGD,$rptaDestape);
				array_push($arrayFC, $promCompra);
			}
		}
		
		$return_arr = array("terceros" => $strRespuestaTercero, "HCNC" =>$arrayHCNC, "PA" =>$arrayPA, "GD" => $arrayGD, "FC" => $arrayFC);
		echo json_encode($return_arr);
	}

	function FiltrarTerceroXsector($sector, $pagina)
	{
		$arrayHCNC = array();
		$arrayPA = array();
		$arrayGD = array();
		$arrayFC = array();
		$this->strParametros=array('strSector'=>$sector, "strPagina"=>$pagina);
		$strRespuestaTercero=json_decode($this->ConsultarWebServic("ListarTercerosPorSector",true, $this->urlWebServiceTercero));
		if (is_array($strRespuestaTercero) || is_object($strRespuestaTercero)){
			foreach ($strRespuestaTercero as $key => $value) {
				$this->strParametros=array("strTercero"=>$value->StrIdTercero);
				$strFechasCompras=json_decode($this->ConsultarWebServic("ListarFechasCompraTercero",true, $this->urlWebServiceTercero));
				
				$promCompra = $this->CalcularPromedioCompra($strFechasCompras);
			
				$rptaDestape = $this->ConsultarGestionDestape($value->StrIdTercero, $_SESSION['idLogin']);
				$rptaStatusPedido = $this->ValidarPedidoTercero($value->StrIdTercero);
				$days = $this->CalcularDiasUltimaCompraPorTercero($value->UltimaCompra);
				array_push($arrayHCNC,$days);
				array_push($arrayPA,$rptaStatusPedido);
				array_push($arrayGD,$rptaDestape);
				array_push($arrayFC, $promCompra);
			}
		}
		$return_arr = array("terceros" => $strRespuestaTercero, "HCNC" =>$arrayHCNC, "PA" =>$arrayPA, "GD" => $arrayGD, "FC" => $arrayFC);
		echo json_encode($return_arr);
	}

	function FiltrarTerceroXlineas($clases, $zonas, $pagina){
		$arrayHCNC = array();
		$arrayPA = array();
		$arrayGD = array();
		$arrayFC = array();

		$ciudades = $this->ObtenerCiudadesPorZona($zonas);

		$clases = implode("','", $clases);
		$clases = "'".$clases."'";

		$this->strParametros=array('strIdClases'=>$clases, "strIdCiudades"=>$ciudades, "strViaja"=>"", "strText"=>"", "strCompra"=>"", "strIdVendedor" => "", "strPagina"=>$pagina);
		$strRespuestaTercero=json_decode($this->ConsultarWebServic("ListarTercerosPorFiltro",true, $this->urlWebServiceTercero));
		
		if (is_array($strRespuestaTercero) || is_object($strRespuestaTercero)){
			foreach ($strRespuestaTercero as $key => $value) {
				$this->strParametros=array("strTercero"=>$value->StrIdTercero);
				$strFechasCompras=json_decode($this->ConsultarWebServic("ListarFechasCompraTercero",true, $this->urlWebServiceTercero));
				
				$promCompra = $this->CalcularPromedioCompra($strFechasCompras);
			
				$rptaDestape = $this->ConsultarGestionDestape($value->StrIdTercero, $_SESSION['idLogin']);
				$rptaStatusPedido = $this->ValidarPedidoTercero($value->StrIdTercero);
				$days = $this->CalcularDiasUltimaCompraPorTercero($value->UltimaCompra);
				array_push($arrayHCNC,$days);
				array_push($arrayPA,$rptaStatusPedido);
				array_push($arrayGD,$rptaDestape);
				array_push($arrayFC, $promCompra);
			}
		}
		
		
		$return_arr = array("terceros" => $strRespuestaTercero, "HCNC" =>$arrayHCNC, "PA" =>$arrayPA, "GD" => $arrayGD, "FC" => $arrayFC);
		echo json_encode($return_arr);
	}

	function FiltrarTerceroXviaje($viaja, $pagina, $zonas){
		$arrayHCNC = array();
		$arrayPA = array();
		$arrayGD = array();

		$ciudades = $this->ObtenerCiudadesPorZona($zonas);
		
		
		
		
		$this->strParametros=array('strIdClases'=>"", "strIdCiudades"=>$ciudades, "strViaja"=>"'%".$viaja."%'", "strText"=>"", "strCompra"=>"", "strIdVendedor" => "", "strPagina"=>$pagina);
		$strRespuestaTercero=json_decode($this->ConsultarWebServic("ListarTercerosPorFiltro",true, $this->urlWebServiceTercero));
		
		if (is_array($strRespuestaTercero) || is_object($strRespuestaTercero)){
			foreach ($strRespuestaTercero as $key => $value) {
			
				$rptaDestape = $this->ConsultarGestionDestape($value->StrIdTercero, $_SESSION['idLogin']);
				$rptaStatusPedido = $this->ValidarPedidoTercero($value->StrIdTercero);
				$days = $this->CalcularDiasUltimaCompraPorTercero($value->UltimaCompra);
				array_push($arrayHCNC,$days);
				array_push($arrayPA,$rptaStatusPedido);
				array_push($arrayGD,$rptaDestape);
			}
		}
		
		
		$return_arr = array("terceros" => $strRespuestaTercero, "HCNC" =>$arrayHCNC, "PA" =>$arrayPA, "GD" => $arrayGD);
		echo json_encode($return_arr);

	}

	function FiltrarTerceroXcompra($compra, $pagina, $zonas){
		$arrayHCNC = array();
		$arrayPA = array();
		$arrayGD = array();

		$ciudades = $this->ObtenerCiudadesPorZona($zonas);
		
		
		
		
		$this->strParametros=array('strIdClases'=>"", "strIdCiudades"=>$ciudades, "strViaja"=>"", "strText"=>"", "strCompra"=>"'".$compra."'", "strIdVendedor" => "", "strPagina"=>$pagina);
		$strRespuestaTercero=json_decode($this->ConsultarWebServic("ListarTercerosPorFiltro",true, $this->urlWebServiceTercero));
		
		if (is_array($strRespuestaTercero) || is_object($strRespuestaTercero)){
			foreach ($strRespuestaTercero as $key => $value) {
			
				$rptaDestape = $this->ConsultarGestionDestape($value->StrIdTercero, $_SESSION['idLogin']);
				$rptaStatusPedido = $this->ValidarPedidoTercero($value->StrIdTercero);
				$days = 0;//$this->CalcularDiasUltimaCompraPorTercero($value->UltimaCompra);
				array_push($arrayHCNC,$days);
				array_push($arrayPA,$rptaStatusPedido);
				array_push($arrayGD,$rptaDestape);
			}
		}
		
		
		$return_arr = array("terceros" => $strRespuestaTercero, "HCNC" =>$arrayHCNC, "PA" =>$arrayPA, "GD" => $arrayGD);
		echo json_encode($return_arr);

	}

	function FiltrarTerceros($text,$zonas,$pagina){
		$arrayHCNC = array();
		$arrayPA = array();
		$arrayGD = array();
		$arrayFC = array();

		$ciudades = $this->ObtenerCiudadesPorZona($zonas);
		$idVendedor = $this->ConsultarIdVendedor();//$idVendedor[0]['strCedula']

		$this->strParametros=array('strIdClases'=>"", "strIdCiudades"=>$ciudades, "strViaja"=>"", "strText"=>"'%".($text)."%'", "strCompra"=>"", "strIdVendedor" => $idVendedor[0]['strCedula'], "strPagina"=>$pagina);
		$strRespuestaTercero=json_decode($this->ConsultarWebServic("ListarTercerosPorFiltro",true, $this->urlWebServiceTercero));
	
		if (is_array($strRespuestaTercero) || is_object($strRespuestaTercero)){
			foreach ($strRespuestaTercero as $key => $value) {
				$this->strParametros=array("strTercero"=>$value->StrIdTercero);
				$strFechasCompras=json_decode($this->ConsultarWebServic("ListarFechasCompraTercero",true, $this->urlWebServiceTercero));
				
				$promCompra = $this->CalcularPromedioCompra($strFechasCompras);
				$rptaDestape = $this->ConsultarGestionDestape($value->StrIdTercero, $_SESSION['idLogin']);
				$rptaStatusPedido = $this->ValidarPedidoTercero($value->StrIdTercero);

				
				/**Obtenemos la fecha y usamos la funcion para saber la cantidad de dias y retornamos*/
				$days = $this->CalcularDiasUltimaCompraPorTercero($value->UltimaCompra);//$this->ListarUltimaCompraPorTercero($value->StrIdTercero);
				

				array_push($arrayHCNC,$days);
				array_push($arrayPA,$rptaStatusPedido);
				array_push($arrayGD,$rptaDestape);
				array_push($arrayFC, $promCompra);
			}
		}
		
		
		$return_arr = array("terceros" => $strRespuestaTercero, "HCNC" =>$arrayHCNC, "PA" =>$arrayPA, "GD" => $arrayGD, "FC" => $arrayFC, "echo" => $idVendedor[0]['strCedula']);
		echo json_encode($return_arr);
	}

	function ConsultarTercero($idTercero){
		$arrayHCNC = array();
		$arrayPA = array();
		$arrayGD = array();
		$arrayFC = array();
		
		//$idVendedor = $this->ConsultarIdVendedor();//$idVendedor[0]['strCedula']
		$this->strParametros=array('strIdClases'=>"", "strIdCiudades"=>"", "strViaja"=>"", "strText"=>"'%".$idTercero."%'", "strCompra"=>"", "strIdVendedor" => "", "strPagina"=>0);
		$strRespuestaTercero=json_decode($this->ConsultarWebServic("ListarTercerosPorFiltro",true, $this->urlWebServiceTercero));
	
		if (is_array($strRespuestaTercero) || is_object($strRespuestaTercero)){
			foreach ($strRespuestaTercero as $key => $value) {
				$this->strParametros=array("strTercero"=>$value->StrIdTercero);
				$strFechasCompras=json_decode($this->ConsultarWebServic("ListarFechasCompraTercero",true, $this->urlWebServiceTercero));
				
				$promCompra = $this->CalcularPromedioCompra($strFechasCompras);
				$rptaDestape = $this->ConsultarGestionDestape($value->StrIdTercero, $_SESSION['idLogin']);
				$rptaStatusPedido = $this->ValidarPedidoTercero($value->StrIdTercero);


				/**Obtenemos la fecha y usamos la funcion para saber la cantidad de dias y retornamos*/
				$days = $this->CalcularDiasUltimaCompraPorTercero($value->UltimaCompra);//$this->ListarUltimaCompraPorTercero($value->StrIdTercero);
				

				$this->strParametros=array("strIdTercero"=>$value->StrIdTercero);
				$rptaContacto=json_decode($this->ConsultarWebServic("ListarContactosTercero",true, $this->urlWebServiceTercero));

				array_push($arrayHCNC,$days);
				array_push($arrayPA,$rptaStatusPedido);
				array_push($arrayGD,$rptaDestape);
				array_push($arrayFC, $promCompra);
			}
		}
		
		
		$return_arr = array("terceros" => $strRespuestaTercero, "HCNC" =>$arrayHCNC, "PA" =>$arrayPA, "GD" => $arrayGD, "FC" => $arrayFC, "contactos" => $rptaContacto);
		echo json_encode($return_arr);
	}

	//---------------------FILTROS------------------------------------

	function ConsultarCartera($idTercero){
		//VERIFICAR CONSULTA
		$this->strParametros=array("intCompania"=>1, "strNombre"=>$idTercero, "strCiudad"=>"");
		$strRespuestaTercero=json_decode($this->ConsultarWebServic("BuscarTerceroCartera",true, $this->urlWebServiceCartera));
		if($strRespuestaTercero == null){
			$r = 0;
		}else{
			$r = $strRespuestaTercero[0]->IntSaldoF;
			$r = str_replace(".00000","",$r);
		}
		echo ($r);
	}

	

	//Portafolio
	function ValidarExistenciaPortafolio($idUser, $idTercero, $strNombreTercero){
		$objPortafolio = new clsPortafolioModel();
		$idPortafolio = $objPortafolio->ValidarExistenciaPortafolio($idUser, $idTercero, $strNombreTercero);
		$return_arr = array("IdPortafolio" => $idPortafolio[0]['rpta'], "TipoAcceso" =>$idPortafolio[0]['intTipoAcceso']);
		echo json_encode($return_arr);
	}


	function RutaEncarpetado($ruta, $idTercero, $idPortafolio){
		$objPortafolio = new clsPortafolioModel();
		$arrayFolder = array();
		if(is_dir($ruta)) {
			if($dir = opendir($ruta)) {
				while(($archivo = readdir($dir)) !== false) {
					if($archivo != '.' && $archivo != '..'){
						$r = "".$archivo;
						//echo $archivo;
						if (is_dir($ruta.$archivo)){
							//echo "".$ruta.$archivo;
							//VALIDAR CON LAS CARPETAS DE 1000 2000 5000 700
							$cadena_de_texto = $archivo;
							$cadena_buscada   = '/1000|2000|3000|5000|700/';
							$posicion_coincidencia = preg_match($cadena_buscada, $cadena_de_texto);
							if($posicion_coincidencia){
								if($this->ValidarClasesHGI($archivo) !== false){
									$this->NumCarpetas = 0;
									$rpta = $objPortafolio->ConsultarDetallePorRuta($ruta.$archivo, $idPortafolio);
									$this->ContarCarpetasFotos($ruta.$archivo."/");
									array_push($arrayFolder, array(($archivo), $rpta[0]['cant'], $this->NumCarpetas));
								}
							}else{
								$this->NumCarpetas = 0;
								$rpta = $objPortafolio->ConsultarDetallePorRuta($ruta.$archivo, $idPortafolio);
								$this->ContarCarpetasFotos($ruta.$archivo."/");
								array_push($arrayFolder, array(($archivo), $rpta[0]['cant'], $this->NumCarpetas));

							}

						}else{
							//echo "no es directorio ".$ruta.$archivo;
						}
					}
				}
				closedir($dir);
			}
		}

		//$ruta = str_replace($this->rutaFotosPorSeccion."/", "", $ruta);
		$return_arr = array("folders" => $arrayFolder, "ruta" =>$ruta);
		echo json_encode($return_arr);
	}

	function ValidarClasesHGI($carpeta){

		if(count($this->arrayClasesVendedor) == 0){
			$objPortafolio = new clsPortafolioModel();
			$arrayFolder = array();
			
			/* Consultamos las lineas del vendedor asociado de acuerdo al usuario del DASH*/
			$LineasVendedor=$objPortafolio->ListarLineasPorUsuario($_SESSION['idLogin']);

			/* Obtenemos las clases del HGI */
			$objClaseWs= new clsClaseWebService();
			$objClaseWs->GetClases();
			$strClasesRpWs=json_decode($objClaseWs->GetRespuestaWs());

			if(sizeof($strClasesRpWs)!=0){
				for($i=0;$i<=sizeof($strClasesRpWs)-1;$i++){
					$blnCheckLinea='';
					$strClaseTr='';
					for($j=0;$j<=sizeof($LineasVendedor)-1;$j++){
						if(trim($strClasesRpWs[$i]->StrIdClase)==$LineasVendedor[$j]['intCodigoLinea']){
							$archivo = $strClasesRpWs[$i]->StrDescripcion;
							array_push($this->arrayClasesVendedor, $archivo);
						
							break;
						}
					}
				}        	                                                  
			}
		}
		
		return $rpta = array_search($carpeta, $this->arrayClasesVendedor);
		
	}

	function RutasEcarpetadoHome($idLogin, $idPortafolio, $ruta){
		$objPortafolio = new clsPortafolioModel();
		$arrayFolder = array();
		$arrayFail = array();
		
		/* Consultamos las lineas del vendedor asociado de acuerdo al usuario del DASH*/
		$LineasVendedor=$objPortafolio->ListarLineasPorUsuario($idLogin);
		

		/* Obtenemos las clases del HGI */
		$objClaseWs= new clsClaseWebService();
		$objClaseWs->GetClases();
		$strClasesRpWs=json_decode($objClaseWs->GetRespuestaWs());
		
		/*$rutaDB = $ruta."700";
		$this->NumCarpetas = 0;
		$rpta = $objPortafolio->ConsultarDetallePorRuta($rutaDB, $idPortafolio);
		$this->ContarCarpetasFotos($rutaDB."/");
		array_push($arrayFolder, array("700", $rpta[0]['cant'], ($this->NumCarpetas)));
		$rutaDB = $ruta."1000";
		$this->NumCarpetas = 0;
		$rpta = $objPortafolio->ConsultarDetallePorRuta($rutaDB, $idPortafolio);
		$this->ContarCarpetasFotos($rutaDB."/");
		array_push($arrayFolder, array("1000", $rpta[0]['cant'], ($this->NumCarpetas)));
		$rutaDB = $ruta."2000";
		$this->NumCarpetas = 0;
		$rpta = $objPortafolio->ConsultarDetallePorRuta($rutaDB, $idPortafolio);
		$this->ContarCarpetasFotos($rutaDB."/");
		array_push($arrayFolder, array("2000", $rpta[0]['cant'], ($this->NumCarpetas)));
		$rutaDB = $ruta."3000";
		$this->NumCarpetas = 0;
		$rpta = $objPortafolio->ConsultarDetallePorRuta($rutaDB, $idPortafolio);
		$this->ContarCarpetasFotos($rutaDB."/");
		array_push($arrayFolder, array("3000", $rpta[0]['cant'], ($this->NumCarpetas)));
		$rutaDB = $ruta."5000";
		$this->NumCarpetas = 0;
		$rpta = $objPortafolio->ConsultarDetallePorRuta($rutaDB, $idPortafolio);
		$this->ContarCarpetasFotos($rutaDB."/");
		array_push($arrayFolder, array("5000", $rpta[0]['cant'], ($this->NumCarpetas)));

		/*$cadena_de_texto = $ruta;
		$cadena_buscada   = '/1000|2000|3000|5000|700/';
		$posicion_coincidencia = preg_match($cadena_buscada, $cadena_de_texto);
		if($posicion_coincidencia){
			
		}		*/	


		if(sizeof($strClasesRpWs)!=0){
			for($i=0;$i<=sizeof($strClasesRpWs)-1;$i++){
				$blnCheckLinea='';
				$strClaseTr='';
				for($j=0;$j<=sizeof($LineasVendedor)-1;$j++){
				
					if(trim($strClasesRpWs[$i]->StrIdClase)==$LineasVendedor[$j]['intCodigoLinea']){
						$archivo = $strClasesRpWs[$i]->StrDescripcion;
						
						if(file_exists($this->strRutaOwncloud.strtoupper($archivo))){
						    //Se muestra carpeta

							$this->NumCarpetas = 0;
							$rpta = $objPortafolio->ConsultarDetallePorRuta($ruta.$archivo, $idPortafolio);
							$this->ContarCarpetasFotos($ruta.$archivo."/");
							array_push($arrayFolder, array($archivo, $rpta[0]['cant'], ($this->NumCarpetas)));
						
							break;
						}else{
							if($LineasVendedor[$j]['intCodigoLinea'] == 691){
								/*$this->NumCarpetas = 0;
								$rpta = $objPortafolio->ConsultarDetallePorRuta($ruta.$archivo, $idPortafolio);
								$this->ContarCarpetasFotos($ruta.$archivo."/");
								array_push($arrayFolder, array($archivo, $rpta[0]['cant'], ($this->NumCarpetas)));*/
							}
						}
					}else{
						//array_push($arrayFail, array($LineasVendedor[$j]['intCodigoLinea'],trim($strClasesRpWs[$i]->StrIdClase)));
					}
					
				}
			}        	                                                  
		}

		$return_arr = array("folders" => $arrayFolder, "ruta" =>$ruta, "fail"=>$arrayFail);
		echo json_encode($return_arr);
	}


	/* Consultamos las clases que tiene asociado el usuario*/
	function ValidarLineasUsuario($idLogin){
		$res = array();
		$objPortafolio= new clsPortafolioModel();
		/* Consultamos las lineas del vendedor asociado de acuerdo al usuario del DASH*/
		$LineasVendedor=$objPortafolio->ListarLineasPorUsuario($idLogin);

		/* Obtenemos las clases del HGI */
		$objClaseWs= new clsClaseWebService();
		$objClaseWs->GetClases();
		$strClasesRpWs=json_decode($objClaseWs->GetRespuestaWs());

		if(sizeof($strClasesRpWs)!=0){
			for($i=0;$i<=sizeof($strClasesRpWs)-1;$i++){
				$blnCheckLinea='';
				$strClaseTr='';
				for($j=0;$j<=sizeof($LineasVendedor)-1;$j++){
					if(trim($strClasesRpWs[$i]->StrIdClase)==$LineasVendedor[$j]['intCodigoLinea']){
						//Se muestra carpeta

						array_push($res, array($strClasesRpWs[$i]->StrDescripcion, $strClasesRpWs[$i]->StrIdClase));
						break;
					}
				}
			}        	                                                  
		}

		$return_arr = array("lineas" => $res);
		echo json_encode($return_arr);
	}

	function ContarCarpetasFotos($ruta){
		//echo $ruta."\n";
		if(is_dir(($ruta))) {
			if($dir = opendir($ruta)) {

				while(($archivo = readdir($dir)) !== false) {

					if($archivo != '.' && $archivo != '..'){
						$r = "".$archivo;
						//echo $ruta.$archivo;
						if (is_dir($ruta.$archivo)){
							//echo $ruta."\n";
							$this->NumCarpetas++;
							$this->ContarCarpetasFotos(($ruta.$archivo."/"));
						}
					}
				}
				closedir($dir);
			}
		}else{
			//echo "no existe".$ruta."\n";
		}
	
	}



	function RutasBack($ruta, $act, $idPortafolio){
		$rutaPrincipal = substr($ruta, 0, -1);
		$array = explode("/", $rutaPrincipal);
		$objPortafolio = new clsPortafolioModel();
		while(count($array) > 5){
			
			if($act == "true"){
				$rptaDB = $objPortafolio->AgregarDetalle($rutaPrincipal."/", $idPortafolio);
			}else{
				$rptaDB = $objPortafolio->EliminarDetalle($rutaPrincipal."/", $idPortafolio, 0);
			}

			if($rptaDB[0]['rpta'] == -1){
				$array = null;
			}else{
				$array = explode("/", $rutaPrincipal);
				array_pop($array);
				$rutaPrincipal = substr($rutaPrincipal, 0, -1);
				$rutaPrincipal = implode("/", $array);
			}
			
		}
	}

	function RutasPortafolio($ruta, $act, $idPortafolio){
		$objPortafolio = new clsPortafolioModel();
		$rptaDB = 0;
		
		
		if(is_dir($ruta)) {
			if($dir = opendir($ruta)) {
				while(($archivo = readdir($dir)) !== false) {
					if($archivo != '.' && $archivo != '..'){
						$r = "".$archivo;
						if (is_dir($ruta.$archivo)){
							$rutaDB = $ruta.$archivo."/";
							if($act == "true"){
								$rptaDB = $objPortafolio->AgregarDetalle($rutaDB, $idPortafolio);
							
							}else{
								$rptaDB = $objPortafolio->EliminarDetalle($rutaDB,  $idPortafolio, $this->ban);
								$this->ban = 1;
							}
							//$this->ContarCarpetas++;
							//echo $this->ContarCarpetas."\n";
							$this->RutasPortafolio($rutaDB, $act, $idPortafolio);
						}
					}
				}
				closedir($dir);
			}
		}
	}

	function TipoAccesoPortafolio($intTipoAcceso, $intIdPortafolio){
		$objPortafolio = new clsPortafolioModel();
		$rptaDB = $objPortafolio->ActualizarTipoDeAccesoPortafolio($intIdPortafolio, $intTipoAcceso);
		echo $rptaDB[0]['rpta'];
	}

	function PorcentajeParticipacion($strIdTercero){
		$this->strParametros=array("strTercero"=>$strIdTercero);
		$strRespuestaTercero=json_decode($this->ConsultarWebServic("ListarParticipacionClasesPorTercero",true, $this->urlWebServiceTercero));
		$sum = array_sum(array_column($strRespuestaTercero, 'StrValorCompra'));
		$return_arr = array("rpta" => $strRespuestaTercero, "pbra" => $sum);
		echo json_encode($return_arr);
	}






























	

	//---------------------------------------------------------------------------------------------------------------------------------------------------

	function FiltrarPortafolios($text, $idLogin, $mes, $año){
		$view = "";
		$total = 0;
		$objPortafolio = new clsPortafolioModel();
		$rpta = $objPortafolio->FiltrarPortafolios($text, $idLogin, $año, $mes);

		if ($rpta != null) {
			for($i=0;$i<=sizeof($rpta)-1;$i++){
			$idPortafolio = $rpta[$i]['intId'];
			$cant = $this->ConsultarDetallesPorId($idPortafolio);
			$size=sizeof($cant);
			for ($j=0; $j < $size; $j++) { 
				$total += $this->ContarFotos($cant[$j]['strRutaCarpeta']);
			}
			if (strlen($rpta[$i]['strNombre']) >= 16) {
				$nameP = substr(trim($rpta[$i]['strNombre']), 0, 16)."...";
			}else{
				$nameP = $rpta[$i]['strNombre'];
			}
			$view.="
			<div  oncontextmenu = 'Mostrar(event, ".$idPortafolio.");'  id='ms".$i."' class='portafolio'
			 ondblclick='ExpandirPortafolio(".$idPortafolio.");'>

			    <div class='notify' ><label id='notify".$idPortafolio."'>".$total."</label></div>

				<div onclick='fijo(\"ms".$i."\",".$idPortafolio.")' style='width: 100px; height: 100px; background-size: cover; background-position: center; background-image: url(\"../Images/portafolio.png\");'> 
				<label ></label>
						

						</div>
				<label id='NamePortafolio".$idPortafolio."' style='display: none;'>".$rpta[$i]['strNombre']."</label>
				<label id='NomPortafolio".$idPortafolio."' onmouseleave='titulo(".$idPortafolio.",true);' onmouseover='titulo(".$idPortafolio.", false);' onclick='fijo(\"ms".$i."\",event)' style='width:100px;height: 40px;' data-toggle='popover' data-trigger='focus' data-content='".$rpta[$i]['strNombre']."'>".$nameP."</label>
				<label id='idPortafolio' style='display: none; visibility: hidden;'>".$idPortafolio."</label><br>
				<label id='fecha".$idPortafolio."' style='width:100px; overflow:hidden; font-weight: normal;'>".$rpta[$i]['dtFecha']."</label>
			</div>";

			$total = 0;
		}
		echo $view;
		}
	}


	function BuscarPortafolio($nPortafolio, $idLogin){
		$objPortafolio = new clsPortafolioModel();
		$objPortafolio->ConsultarPortafolio($nPortafolio, $idLogin);
		$id = $objPortafolio->GetRpta();
		
		$objPortafolio = null;

		return $id[0]['intId'];
	}
	function BuscarPortafolios($idUser){
		$objPortafolio = new clsPortafolioModel();
		$objPortafolio->ListarPortafolios($idUser);
		$portafolios = $objPortafolio->GetRespuesta();
		return $portafolios;
	}

	function Check($nCarpeta, $idPortafolio, $EstadoCheck)
	{
		
		$ruta= $nCarpeta."/";
		//pasamos a minĂşsculas (opcional)
		//$ruta = strtolower($ruta) ;
		//comprueba si la ruta que le hemos pasado es un directorio
		if(is_dir($ruta)) {
			/*Insertamos o eliminamos la raiz */
			$objPortafolio = new clsPortafolioModel();
			$fecha = date("Y-m-d");
			if ($EstadoCheck == 'true') {
				/*$array = explode("/", $nCarpeta);
				array_pop($array);
				if (count($array) > 5) {
					$r = implode("/", $array);
				}else{
					$r = $nCarpeta;
				}*/
				
				$objPortafolio->AgregarDetalle($nCarpeta,$fecha, $idPortafolio);
			}else{
				$this->EliminarDetalle($nCarpeta, $idPortafolio);
			}
			/*Insertamos o eliminamos la raiz */

			//fijamos la ruta del directorio que se va a abrir
			if($dir = opendir($ruta)) {
				//si el directorio se puede abrir
				while(($archivo = readdir($dir)) !== false) {
					//le avisamos que no lea el "." y los dos ".."
					if($archivo != '.' && $archivo != '..') {
					//comprobramos que se trata de un directorio
						
						if (is_dir($ruta.$archivo)) {
							$objPortafolio = new clsPortafolioModel();
							if ($EstadoCheck == 'true') {
								$fecha = date("Y-m-d");
								$rutaCarpeta=$ruta.$archivo;
								$this->Check($rutaCarpeta, $idPortafolio, $EstadoCheck);
							}else{

								$rutaCarpeta=$ruta.$archivo;
								$this->Check($rutaCarpeta, $idPortafolio, $EstadoCheck);
							}
							
						}else{
							
						} 
					} 
				}
			//cerramos directorio abierto anteriormente
			closedir($dir);
			}else{
				echo "no se abre la carpeta";
			}
		}else{
			echo "no es directorio";
		}
	}
	function ListarPortafolio($idUsuario){

		$total = 0;
		$this->i = 0;
		$view="";
		$this->idLogin=trim($_SESSION['idLogin']);
		$portafolios = $this->BuscarPortafolios($idUsuario);
		for($i=0;$i<=sizeof($portafolios)-1;$i++){
			$idPortafolio = $this->BuscarPortafolio($portafolios[$i]['strNombre'], $this->idLogin);

			$cant = $this->ConsultarDetallesPorId($idPortafolio);
			$size=sizeof($cant);
			for ($j=0; $j < $size; $j++) { 
				$total += $this->ContarFotos($cant[$j]['strRutaCarpeta']);
			}
			if (strlen($portafolios[$i]['strNombre']) >= 16) {
				$nameP = substr(trim($portafolios[$i]['strNombre']), 0, 16)."...";
			}else{
				$nameP = $portafolios[$i]['strNombre'];
			}
			$view.="
			<div  oncontextmenu = 'Mostrar(event, ".$idPortafolio.");'  id='ms".$i."' class='portafolio'
			 ondblclick='ExpandirPortafolio(".$idPortafolio.");'>

			    <div class='notify' ><label id='notify".$idPortafolio."'>".$total."</label></div>

				<div onclick='fijo(\"ms".$i."\",".$idPortafolio.")' style='width: 100px; height: 100px; background-size: cover; background-position: center; background-image: url(\"../Images/portafolio.png\");'> 
				<label ></label>
						

						</div>
				<label id='NamePortafolio".$idPortafolio."' style='display: none;'>".$portafolios[$i]['strNombre']."</label>
				<label id='NomPortafolio".$idPortafolio."' onmouseleave='titulo(".$idPortafolio.",true);' onmouseover='titulo(".$idPortafolio.", false);' onclick='fijo(\"ms".$i."\",event)' style='width:100px;height: 40px;' data-toggle='popover' data-trigger='focus' data-content='".$portafolios[$i]['strNombre']."'>".$nameP."</label>
				<label id='idPortafolio' style='display: none; visibility: hidden;'>".$idPortafolio."</label><br>
				<label id='fecha".$idPortafolio."' style='width:100px; overflow:hidden; font-weight: normal;'>".$portafolios[$i]['dtFecha']."</label>
			</div>";

			$total = 0;
		}
		echo $view;
	}
	function ContarFotos($ruta1){
    	$total = 0;
    	$ruta = $ruta1."/";
		if(is_dir($ruta)) {
		//fijamos la ruta del directorio que se va a abrir
		if($dir = opendir($ruta)) {
		//si el directorio se puede abrir
		while(($archivo = readdir($dir)) !== false) {
		//le avisamos que no lea el "." y los dos ".."
			if($archivo != '.' && $archivo != '..') {
			//comprobramos que se trata de un directorio
				$r = $ruta.$archivo;
				if (!is_dir($ruta.$archivo)){
					if (strlen(stristr($archivo,'.jpg'))>0) {
						$total++;
					}
				}
			}
		}
		//cerramos directorio abierto anteriormente
		closedir($dir);
		} }
		//echo $total."<br>";
		return $total;
    }
	function EliminarPortafolio($IdPortafolio){
		echo $IdPortafolio;
		$objPortafolio = new clsPortafolioModel();
		$objPortafolio->EliminarPortafolio($IdPortafolio);
		$r = $objPortafolio->GetRespuesta();
		echo "<div id='EliminarDB' style='display:none;'>".$r[0]['Mensaje']."</div>";
	}
	function EditarNombrePortafolio($IdPortafolio, $NomPortafolio){
		$objPortafolio = new clsPortafolioModel();
		$objPortafolio->EditarNombrePortafolio($IdPortafolio, $NomPortafolio);
		$r = $objPortafolio->GetRespuesta();
		echo "<div id='Editado' style='display:none;'>".$r[0]['Mensaje']."</div>";
	}
	function OpenRoute($pos){
		$view = "";
		if (isset($_SESSION['StrDir'])) {
			$array = explode("/", $_SESSION['StrDir']);
			$ruta = "";
			$cant = sizeof($array);
			for ($i=0; $i <= $pos; $i++) { 
				$ruta .= $array[$i]."/";
			}

				$_SESSION['StrDir']=substr($ruta, 0,-1);
				$this->ListarArchivos();
				
		}else{
			echo "no hay nada ".$array;
		}
		
	}
	function Rutas(){
		$view = "";
		if (isset($_SESSION['StrDir'])) {
			$array = explode("/", $_SESSION['StrDir']);
			$cant = count($array);
			for ($i=0; $i < $cant; $i++) { 
				if ($i > 2 && $array[$i] != "fotos_nube") {
					$view.= "<label id='".$i."' class='ruta' onclick='OpenRoute(".$i.")'>".$array[$i]."</label> / ";
				}
			}
		}else{
			echo "no hay nada ".$array;
		}
		echo $view;
	}
	function ListarArchivos(){
		$view="";
		$Dir=scandir($_SESSION['StrDir']);
		$size=sizeof($Dir);
		$ban = 0;
		$inde = "0";
		$k=2;
		$this->idLogin=trim($_SESSION['idLogin']);
		//echo $this->idLogin;
		if($this->Tipo=='0'){ 

			for ($j=2; $j < $size  ; $j++) {

				if(is_dir($_SESSION['StrDir']."/".$Dir[$j])){
					$checked = "";
					
					if(isset($_POST['NombrePortafolio']) && (!isset($_POST['IdPortafolio']))){ //Portafolio recien creado
						
						
						$id = $this->BuscarPortafolio($_POST['NombrePortafolio'], $this->idLogin);
					}else{								   //Portafolio existente
						
						$id = $_POST['IdPortafolio'];
					}
					//echo $id;
					//enviar id login a la consulta detalle
					$cant = $this->ConsultarDetalle($_SESSION['StrDir']."/".$Dir[$j].'%', $id);
					//echo $cant;
					if ($cant > 0) {
						$checked = "checked";
						/* para el checkbox indeterminate*/
							$this->ContarCarpetas($_SESSION['StrDir']."/".$Dir[$j], $Dir[$j], $id);
							/*echo "|||||";
							echo $this->NumCarpetasSelect."::";
							echo $this->NumCarpetas;
							echo "|||||";*/

							if ($this->NumCarpetas == 0) { //check en blanco$_SESSION['StrDir']."/".$Dir[$j].'%',
								//si numCarpetas es 0 es porque es una hoja luego validar si esa hoja esta en la DB 
								if (($this->ConsultarDetalle($_SESSION['StrDir']."/".$Dir[$j].'%', $id)) > 0) {
									//encontro la hoja en la DB
									$checked = "checked";
									//echo "BD";
								}

							}elseif (($this->NumCarpetasSelect < $this->NumCarpetas)) { //check indeterminate 
								$inde = "1";
								//creamos un div con la informacion de la carpeta y el check que queremos editar
								$view.="<label id='cont".$this->i."' style='width:100px;  display:none; overflow:hidden;'>".$k."</label>";
							}else{  //check chuliado
								
							}
							$this->NumCarpetasSelect = 0;
							$this->NumCarpetas = 0;
						/* para el checkbox indeterminate*/
					}
					//no se utiliza <label id='".$k."' style='display: inline;'>".$_SESSION['StrDir']."</label>
					$this->i++;
					$view.="
					<div id='value".$k."' style='display:none;'> ".$inde."</div> <div  id='ms".$k."' class='image' style='overflow: hidden; display: inline-block; height: 160px; width: 100px; margin: 10px; text-align: center;' ondblclick='ExpandirDetalle(\"lb".$k."\",".$k.");'>


						<div style='width: 100px; height: 100px; background-size: cover; background-position: center; background-image: url(\"../Images/carpeta.png\");'> 
						<!--<img src='../Images/carpeta.png' style='height: 100px; '>-->

						<input name='Imagen' class='option-input'  type='checkbox' id='chk".$k."' value='img".$k."' onchange='Check(".$k.")' ".$checked." />

						</div><br>
						
						<label id='lb".$k."' style='width:100px; overflow:hidden;'>".$Dir[$j]."</label>
					</div>";
					$k++;
					$ban = 1;
					$cant = 0;
					$inde ='0';

				}

			}
				
			if ($ban != 1) {
				$this->Back();
				$view.= "<div id='uno' style='display:none;'>true</div>";
			}

		
		}
		
		//var_dump(scandir('./Images/'));
		echo $view;
		echo "<div id='limit' style='display:none;'> ".$this->i."</div>";
	}
	
	function ContarCarpetas($ruta2, $nCarpeta, $id){//ruta completa , y el nombre de la carpeta
		$ruta= $ruta2."/";
		//echo $ruta; 
		//pasamos a minĂşsculas (opcional)
		//$ruta = strtolower($ruta) ;
		//comprueba si la ruta que le hemos pasado es un directorio
		if(is_dir($ruta)) {

		//fijamos la ruta del directorio que se va a abrir
		if($dir = opendir($ruta)) {
		//si el directorio se puede abrir
		while(($archivo = readdir($dir)) !== false) {
		//le avisamos que no lea el "." y los dos ".."
		if($archivo != '.' && $archivo != '..') {
		//comprobramos que se trata de un directorio
		if (is_dir($ruta.$archivo)) {
		//contar.. con strcasecmp || strcmp || strncasecmp
			$r = $ruta.$archivo;
			$com = '../Images/FOTOS POR SECCION CON PRECIO/'.$nCarpeta;
			//echo $r."||".$com;
			if (strcasecmp($ruta,$nCarpeta) == 0) {
				echo "no es igual";
			}else{
				$this->NumCarpetas++;
				//echo $this->NumCarpetas;
				$checked = $this->ConsultarDetalle($r, $id);
				if ($checked > 0) {
					$this->NumCarpetasSelect++;
				}
				$this->ContarCarpetas($r,$nCarpeta,$id);

				//var_dump(strcasecmp($ruta,$nCarpeta));
			}/*
			if (strcmp($r, $com) == 0) {
				$this->NumCarpetas++;
				echo "+";
			}else{
				if (strcasecmp($ruta,$com) == 0) {
				   echo "-".$ruta."==".$com."-";
				}else{
					//echo "Carpeta: ".$nCarpeta." no es igual ".$com." => ".$r."          ";

				}

			}*/
			
		} }
		}
		//cerramos directorio abierto anteriormente
		closedir($dir);
		} }
		/*echo "<br><br><div id='Alerta' class='alert alert-success alert-dismissible' role='alert'>
				  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Carpetas selecciona
				</div>";*/
		
	}
	function DbClick($file){
		if(is_dir($_SESSION['StrDir']."/".$file)){
			$_SESSION['StrDir']=$_SESSION['StrDir']."/".$file;
			//echo $_SESSION['StrDir'];
			$this->ListarArchivos();
			//Enviamos el nombre de la carpeta en un div
			echo "<div id='carpeta' style='display:none;'>".$file."</div>";
		}		
	}
	function DirectorioActual(){
		$arDir=explode("/", $_SESSION['StrDir']);
		$this->DirectorioActual=$arDir[sizeof($arDir)-1];
	}

	function ValidarTipo(){
		for ($i=0; $i < sizeof($this->Parametros) ; $i++) { 
			$this->DirectorioActual();
			if($this->DirectorioActual==$this->Parametros[$i]['Nombre']){
				$this->Tipo=$this->Parametros[$i]['Cnfg'];
			}
		}
		//echo $this->Tipo;
	}
	function Back(){
		$arDir=explode('/', $_SESSION['StrDir']);

		if($_SESSION['StrDir']!='../images/Portafolio'){
			$_SESSION['StrDir']='';
			for ($i=0; $i <= sizeof($arDir)-2 ; $i++) { 
				$_SESSION['StrDir'].= $arDir[$i]."/";
			}
			$_SESSION['StrDir'] = substr($_SESSION['StrDir'], 0, -1);
		}
		$this->ListarArchivos();

	}

	function AgregarPortafolio($title){
		$objPortafolio = new clsPortafolioModel();
		$fecha = date("Y-m-d");
		$idUser = $_SESSION['idLogin'];
		$objPortafolio->AgregarPortafolio($title, $fecha, $idUser);
		$r = $objPortafolio->GetRespuesta();
		//Portafolio creado con exito
		echo "<div id='Creado' style='display:none;'>".$r[0]['Mensaje']."</div>";
	}
	function ConsultarDetalle($dir, $id){
		$objPortafolio = new clsPortafolioModel();
		$objPortafolio->ConsultarDetalle($dir, $id);
		$cont = $objPortafolio->GetRpta();
		$objPortafolio = null;
		return $cont[0]['COUNT(`intId`)'];
	}
	function ConsultarDetallesPorId($id){
		$objPortafolio = new clsPortafolioModel();
		$var = $objPortafolio->ConsultarDetallesPorId($id);
		return $var;
	}
	
	function EliminarDetalle($strDir, $intIdPortafolio)
	{
		$objPortafolio = new clsPortafolioModel();
		$objPortafolio->EliminarDetalle($strDir, $intIdPortafolio);
		$objPortafolio->GetRespuesta();
	}

	function ListarTercero($id)
	{
		$this->strParametros=array('intIdTercero'=>$id);
		$Lista="";
		$strRespuestaTercero=json_decode($this->ConsultarWebServic("ConsultarTercero",true, $this->urlWebServiceTercero));
		//var_dump($strRespuestaTercero);
		$id = str_replace("'","",$id);
		if ($strRespuestaTercero != null) {
			$Lista.="
			<div class='row'>
				<div class='col-lg-2'></div>
				<div class='col-lg-8'>
					<div class='input-group' >
					  <span class='input-group-addon span ' style='color:white'id='basic-addon1'><i class='glyphicon glyphicon-user'></i></span>
					  <input type='text' class='form-control lbl' placeholder='Nombre' value='".$strRespuestaTercero[0]->StrNombre."' aria-describedby='basic-addon1' readonly>
					</div>
				</div>
				<div class='col-lg-2'></div>
			</div><br>

			<div class='row'>
				<div class='col-lg-6'>
					<div class='input-group' >
					  <span class='input-group-addon span' id='basic-addon1' style='color:white'>#</span>
					  <input type='text' class='form-control lbl' placeholder='Cedula' value='".$id."' aria-describedby='basic-addon1' readonly>
					</div>
				</div>
				<div class='col-lg-6'>
					<div class='input-group'>
					  <span class='input-group-addon span' style='color:white' id='basic-addon1'><i class='glyphicon glyphicon-map-marker'></i>1</span>
					  <input type='text' class='form-control lbl' placeholder='Direccion 1' value='".$strRespuestaTercero[0]->StrDireccion."' aria-describedby='basic-addon1' readonly>
					</div>
				</div><br><br><br>
				<div class='col-lg-6'>
					<div class='input-group'>
					  <span class='input-group-addon span' style='color:white' id='basic-addon1'><i class='glyphicon glyphicon-earphone'></i></span>
					  <input type='text' class='form-control lbl' placeholder='Celular' value='".$strRespuestaTercero[0]->StrCelular."' aria-describedby='basic-addon1' readonly>
					</div>
				</div>
				<div class='col-lg-6'>
					<div class='input-group'>
					  <span class='input-group-addon span' style='color:white' id='basic-addon1'><i class='glyphicon glyphicon-map-marker'></i>2</span>
					  <input type='text' class='form-control lbl' placeholder='Direccion 2' value='".$strRespuestaTercero[0]->StrDireccion2."' aria-describedby='basic-addon1' readonly>
					</div>
				</div><br><br><br>
				<div class='col-lg-6'>
					<div class='input-group'>
					  <span class='input-group-addon span' style='color:white' id='basic-addon1'><i class='glyphicon glyphicon-phone-alt'></i></span>
					  <input type='text' class='form-control lbl' placeholder='Telefono' value ='".$strRespuestaTercero[0]->StrTelefono."'aria-describedby='basic-addon1' readonly>
					</div>
				</div>
				<div class='col-lg-6'>
					<div class='input-group'>
					  <span class='input-group-addon span' style='color:white' id='basic-addon1'><i class='glyphicon glyphicon-equalizer'></i></span>
					  <input type='text' class='form-control lbl' placeholder='Ciudad' value='".$strRespuestaTercero[0]->StrDescripcion."' aria-describedby='basic-addon1' readonly>
					</div>
				</div>
			</div>";
		}
		echo $Lista;
	}
	function FiltrarTercero($NomTercero){
			$this->strParametros=array('strNombre'=>$NomTercero);
			$Lista="";
			$strRespuestaTercero=json_decode($this->ConsultarWebServic("FiltrarTercero",true, $this->urlWebServiceTercero));
			//var_dump($strRespuestaTercero);
			if ($strRespuestaTercero != null) {
				for ($i=0; $i < sizeof($strRespuestaTercero); $i++) { 
					$Lista.="
					<tr>
						<td>
				      	<button type='button' onClick='ListarTercero(\"".$strRespuestaTercero[$i]->stridtercero."\");' class='btn btn-primary info' data-toggle='modal' data-target='#exampleModal'><i class='glyphicon glyphicon-info-sign' aria-hidden='true'></i>
						</button><br><br>
						<button type='button' onClick='AlertCompartirPortafolio(\"".$strRespuestaTercero[$i]->strnombre."\",\"".$strRespuestaTercero[$i]->stridtercero."\");' class='btn btn-default info select ocultar'><span class='glyphicon glyphicon-send' aria-hidden='true'></span>
					</button>
					   </td>
			      	   <td>".$strRespuestaTercero[$i]->strnombre."</td>
					</tr>
				";
				}
				
			}
			echo $Lista;
	}
	function ConsultarWebServic($strMetodo,$blnParametros, $url){
		$wsCliente='';
		$strWsRespuesta='';
		if($blnParametros){
			$wsCliente = new nusoap_client($url, 'wsdl');
			$strWsRespuesta=$wsCliente->call($strMetodo,$this->strParametros);

		}else{
			$wsCliente = new SoapClient($url);
		  	$strWsRespuesta=$wsCliente->$strMetodo();
		}
		return $strWsRespuesta;
	}
	function AgregarPortafolioTercero($idCliente,  $idPortafolio, $nombreCliente){
		$objPortafolioModel= new clsPortafolioModel();
		$rptaDescripcion = "";
		$objPortafolioModel->AgregarPortafolioTercero($idCliente, $idPortafolio, $nombreCliente);
		$rpta = $objPortafolioModel->GetRespuesta();
		//var_dump($rpta);
		//Si se vencio la fecha de disponible del portafolio retorna -1 si no el id del registro
		if ($rpta[0]['id'] != -1) {
			$rptaDescripcion = $rpta[0]['descripcion'];
			$objPortafolioModel = null;
			$fecha = "";
			$fecha = $_POST['fechaPortafolio'];
			$ArrayFecha = explode('-', $fecha);
			$dia = $ArrayFecha[2];
			$dia = $dia + 5;
			$fecha = $ArrayFecha[0]."-".$ArrayFecha[1]."-".$dia;


			$this->strParametros=array('intIdTercero'=>"'".$idCliente."'");
			//var_dump($this->strParametros);
			$Lista="";
			$strRespuestaTercero=json_decode($this->ConsultarWebServic("ConsultarTercero",true, $this->urlWebServiceTercero));
			//var_dump($strRespuestaTercero);
			if ($strRespuestaTercero != null) {
				$archivo = __DIR__ . "/archivo.ini";
				$contenido = parse_ini_file($archivo, true);
				$Url = $contenido["URL"]["Url"];
				$UsuarioAsociados = $this->ListarVendedoresAsociados();
				$Lista.="
<div class='row'>						
	<div class='col-lg-6'>
	".$UsuarioAsociados."
	</div>
	<div class='col-lg-6'>
		<div class='input-group' >
		  <span class='input-group-addon span' style='color:white'id='basic-addon1'><i class='glyphicon glyphicon-user'></i></span>
		  <input type='text' class='form-control lbl' placeholder='Sin dato' value='".$idCliente."' aria-describedby='basic-addon1' readonly>
		</div>
	</div>
</div><br>
<div class='row'>
	<div class='col-lg-6'>
		<div class='input-group' >
		  <i class='input-group-addon span' id='basic-addon1' style='color:white'>#</i>
		  <input type='text' class='form-control lbl' placeholder='Cedula' value='".$strRespuestaTercero[0]->StrNombre."' aria-describedby='basic-addon1' readonly>
		</div>
	</div>
	<div class='col-lg-6'>
		<div class='input-group'>
		  <span class='input-group-addon span' style='color:white' id='basic-addon1'><i class='glyphicon glyphicon-map-marker'></i>1</span>
		  <input type='text' class='form-control lbl' placeholder='Direccion 1' value='".$strRespuestaTercero[0]->StrDireccion."' aria-describedby='basic-addon1' readonly>
		</div>
	</div><br><br><br>
	<div class='col-lg-6'>
		<div class='input-group'>
		  <span class='input-group-addon span' style='color:white' id='basic-addon1'><i class='glyphicon glyphicon-earphone'></i></span>
		  <input type='text' class='form-control lbl' placeholder='Celular' value='".$strRespuestaTercero[0]->StrCelular."' aria-describedby='basic-addon1' readonly>
		</div>
	</div>
	<div class='col-lg-6'>
		<div class='input-group'>
		  <i class='input-group-addon span' style='color:white' id='basic-addon1'><i class='glyphicon glyphicon-map-marker'></i>2</i>
		  <input type='text' class='form-control lbl' placeholder='Direccion 2' value='".$strRespuestaTercero[0]->StrDireccion2."' aria-describedby='basic-addon1' readonly>
		</div>
	</div><br><br><br>
	<div class='col-lg-6'>
		<div class='input-group'>
		  <span class='input-group-addon span' style='color:white' id='basic-addon1'><i class='glyphicon glyphicon-phone-alt'></i></span>
		  <input type='text' class='form-control lbl' placeholder='Telefono' value ='".$strRespuestaTercero[0]->StrTelefono."'aria-describedby='basic-addon1' readonly>
		</div>
	</div>
	<div class='col-lg-6'>
		<div class='input-group'>
		  <span class='input-group-addon span' style='color:white' id='basic-addon1'><i class=' glyphicon glyphicon-equalizer'></i></span>
		  <input type='text' class='form-control lbl' placeholder='Ciudad' value='".$strRespuestaTercero[0]->StrDescripcion."' aria-describedby='basic-addon1' readonly>
		</div>
	</div>
</div><br>
<div class='row'>
	<div class='col-lg-6'>	
		<div class='bs-example bs-example-tooltip' data-example-id=static-tooltips> <div class='tooltip left' role=tooltip> <div class=tooltip-arrow></div> <div class=tooltip-inner> Tooltip on the left </div> </div></div>
		<textarea style='resize: none;' class='form-control' onclick='document.getElementById(\"error\").style.display = \"none\"' id='textArea' rows='3' placeholder='Descripcion..' value='".$rptaDescripcion."' required>".$rptaDescripcion."</textarea>
		<div id='error' style='display: none; color: #a94442; height: 15px;'>
			Por favor ingrese una descripcion!
		</div>
	</div>
	<div class='col-lg-6'>
		<label id='idRelacion' style='display: none;'>".$rpta[0]['id']."</label>
		<div class='input-group'>
		  <span class='input-group-addon span' style='color:white' id='basic-addon1'><i class='glyphicon glyphicon-share'></i></span>
		  <input type='text' id='link' class='form-control lbl' aria-describedby='inputGroup-sizing-default' readonly value='".$Url."?code=".$rpta[0]['id']."'><br>
		</div><br>
      	<button onclick='CopiarTexto(\"link\");' id='btnCopy' class='btn btn-primary'>Copiar</button>
	</div>
</div><br>
<div class='alert alert-info' role='alert'>
  <p>El cliente tendra dispinible <b>".$_POST['cantFotos']."</b> fotos del portafolio <b>".$_POST['nomPortafolio']."</b> este link es valido hasta <b>".$fecha." 12:00 pm</b> y debe autenticarse con el numero de cedula registrado en la base de datos</p>
</div>";
			}
			echo $Lista;
			
		}else{
			echo "<div class='alert alert-danger' role='alert'>Se ha vencido el link</div>";
		}	
					
	}
   	function ActualizarPortafolioTercero($idPortafolio,$descripcion, $idRelacion, $idVendedor)
   	{
   		$objPortafolioModel= new clsPortafolioModel();
		$fecha = date("Y-m-d");
		$objPortafolioModel->ActualizarPortafolioTercero($idPortafolio, $descripcion, $idRelacion, $idVendedor);
		$rpta = $objPortafolioModel->GetRespuesta();
		$objPortafolioModel = null;
		echo $rpta[0]['Mensaje'];
   	}

   	function ListarVendedoresAsociados()
   	{
   		$view = "<select class='form-control' id='vendedoresAsociados'>";
   		$objLoginModel= new clsLoginModel();
   		$this->idLogin=trim($_SESSION['idLogin']);
		$rpta = $objLoginModel->ListarUsuariosAsociados($this->idLogin);

		$objLoginModel = null;
		for ($i=0; $i < sizeof($rpta); $i++) { 
			$view.="

			  	<option value=".$rpta[$i]['strCedulaEmpleado'].">".$rpta[$i]['strNombre']."</option>
			  
			";
		}
		return $view.="</select>";
   	}
   	function ConsultarNombrePortafolio($IdPortafolio){
   		$objPortafolioModel= new clsPortafolioModel();
   		$rpta = $objPortafolioModel->ConsultarNombrePortafolio($IdPortafolio);

   		$rpta = $objPortafolioModel->GetRespuesta();
   		$objPortafolioModel = null;
   		echo $rpta[0]['rpta'];
   		//var_dump($rpta);
   	}
   	public function RestablecerPortafolio(){
   		$intCodPortafolio=trim($_POST['intCodPortafolio']);
   		$objPortafolioModel= new clsPortafolioModel();
   		$objPortafolioModel->RestablecerPortafolio($intCodPortafolio);
   		echo json_encode(array("Success"=>true,"Data"=>array("strMensaje"=>'Portafolio restablecido con éxito.')));

   	}
}

 ?>