<?php 
include_once ("../Model/clsPortafolioModel.php");
include_once ("../Model/clsInfoPedidoModel.php");
include_once ("../Model/clsLoginModel.php");
include_once ("../Model/clsVendedoresModel.php");
include_once("../Classes/nusoap/nusoap.php");
session_start();

$objInfoPortafolio = new InformacionPortafolioController();

if(!isset($_SESSION['idLogin'])){
	echo "<script language='javascript'>window.location='../view/Login.php'</script>;";	
}

if (isset($_POST['btnListarPedidoProgress'])) {
	$objInfoPortafolio->ListarPedidoProgress($_SESSION['idLogin']);
}

if (isset($_POST['btnListarPedidosFinalizados'])) {
	$objInfoPortafolio->ListarPedidosFinalizados($_SESSION['idLogin']);
}

if (isset($_POST['btnListarPedidoImpresos'])) {
	$objInfoPortafolio->ListarPedidosImpresos($_SESSION['idLogin'], $_POST['mes'], $_POST['año']);
}

if (isset($_POST['btnEliminarPedido'])) {
	$objInfoPortafolio->EliminarPedido($_POST['intIdPedido']);
}
if (isset($_POST['btnVisualizarPedido'])) {
	//echo $_POST['IdPedido'];
	$objInfoPortafolio->VisualizarPedido($_POST['IdPedido']);
}

if (isset($_POST['btnEnviarPedido'])) {
	$objInfoPortafolio->EnviarPedido($_POST['intIdPedido'], $_POST['strFactCorreo'], $_POST['strFactTelefono'], $_POST['strFactCelular'], $_POST['strFactCiudad'], $_POST['strObservacionGeneral']);
}

if(isset($_POST['FiltrarTerceros'])){
	$objInfoPortafolio->FiltrarTerceros($_POST['text']);
}

if(isset($_POST['ActualizarTerceroPedido'])){
	$objInfoPortafolio->ActualizarTerceroPedido($_POST['nombre'], $_POST['ciudad'], $_POST['idPedido'], $_POST['idTercero']);
}









if (isset($_POST['btnHabilitarPedido'])) {
	//echo "string";
	$objInfoPortafolio->HabilitarPedido($_POST['strIdTercero'], $_POST['intIdPortafolio'], $_POST['intIdPortafolioTercero']);
}

if (isset($_POST['btnConsultarIngresoPortafolio'])) {
	$objInfoPortafolio->ConsultarIngresoPortafolio($_POST['IdPortafolio'], $_POST['IdTercero']);
}
if (isset($_POST['btnGenerarExcel'])) {
	//echo $_POST['txtId'],$_POST['strIdTercero'];
	$objInfoPortafolio->GenerarExcel($_POST['txtId'],$_POST['strIdTercero']);
}
if (isset($_POST['btnActualizarVigenciaPortafolio'])) {
	$objInfoPortafolio->ActualizarVigenciaCreacionPortafolio($_POST['intIdPortafolio'],$_POST['strIdTercero'],$_POST['intIdPortafolioTercero']);
}
if (isset($_POST['LinkArchivoIni'])) {
	$objInfoPortafolio->LinkArchivoIni();
}
if (isset($_POST['btnListarPortafolioTercero'])) {
	$objInfoPortafolio->ListarPortafoliosTercero($_SESSION['idLogin'], $_POST['mes'],$_POST['año']);
}

if (isset($_POST['btnGenerarInformeExcel'])) {
	$objInfoPortafolio->GenerarInformeExcel();
}

if (isset($_POST['actualizarEstadoPedidoCliente'])) {
	$objInfoPortafolio->ActualizarEstadoPedidoCliente($_POST['intId']);
}


/**
 * 
 */
class InformacionPortafolioController 
{
	private $urlWebServiceTercero;
	private $strParametros;
	private $urlWebService;
	private $urlWebServicePedidos;
	function __construct()
	{
		$this->urlWebServiceTercero="http://10.10.10.128/webserviceportal/WebService/WebServiceTercero.php?wsdl";
		$this->urlWebService = 'http://10.10.10.128/webserviceportal/WebService/WebServiceProductos.php?wsdl';
		$this->urlWebServicePedidos = 'http://10.10.10.128/webserviceportal/WebService/WebServicePedido.php?wsdl';
		$this->strParametros = "";
	}

	function ConsultarZonasUsuario($idLogin){
		$objPortafolio= new clsPortafolioModel();
		/* Consultamos las lineas del vendedor asociado de acuerdo al usuario del DASH*/
		$ZonasVendedor=$objPortafolio->ListarZonasPorUsuario($idLogin);
		$zonas = array();
		foreach ($ZonasVendedor as $key => $value) {
			array_push($zonas, $value['intId']);
		}
		return $zonas;

	}

	function ObtenerCiudadesPorZona(){
		$objPortafolio = new clsPortafolioModel();
		$zonas = $this->ConsultarZonasUsuario($_SESSION['idLogin']);
	
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

	function ConsultarIdVendedor(){
		$idVendedor = "";
		@session_start();
		if(isset($_SESSION['idVendedor'])){
			$idVendedor = $_SESSION['idVendedor'];
		}else{
			$objPortafolio = new clsPortafolioModel();
			$rptaDB = $objPortafolio->ListarIdVendedorPorLogin($_SESSION['idLogin']);
			
			$idVendedor = $rptaDB;
			$_SESSION['idVendedor'] = $idVendedor;
		}
		return $idVendedor;
	}

	function FiltrarTerceros($text){
		$arrayHCNC = array();
		$arrayPA = array();
		$arrayGD = array();
		$arrayFC = array();

		$ciudades = $this->ObtenerCiudadesPorZona();
		$idVendedor = $this->ConsultarIdVendedor();

		$this->strParametros=array('strIdClases'=>"", "strIdCiudades"=>$ciudades, "strViaja"=>"", "strText"=>"'%".$text."%'", "strCompra"=>"", "strIdVendedor" => $idVendedor[0]['strCedula'], "strPagina"=>0);
		$strRespuestaTercero=json_decode($this->ConsultarWebService("ListarTercerosPorFiltro",true, $this->urlWebServiceTercero));
	
		if (is_array($strRespuestaTercero) || is_object($strRespuestaTercero)){
			foreach ($strRespuestaTercero as $key => $value) {
				$this->strParametros=array("strTercero"=>$value->StrIdTercero);
			}
		}
		
		
		$return_arr = array("terceros" => $strRespuestaTercero);
		echo json_encode($return_arr);
	}

	function ActualizarTerceroPedido($nombre, $ciudad, $idPedido, $idTercero){
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$rpta = $objInfoPedidoPortafolio->ActualizarTerceroPedido($nombre, $ciudad, $idPedido, $idTercero);
		echo $rpta[0]['rpta'];
	}










	function ListarPedidosImpresos($idLogin, $mes, $año){
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$rpta = $objInfoPedidoPortafolio->ListarPedidoClientePorUsuario($idLogin, $mes, $año);
		$return_arr = array("pedidos" => $rpta);
		echo json_encode($return_arr);
	}

	function ListarPedidosFinalizados($idLogin)
	{
		$view ="";
		//echo "string";
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$rpta = $objInfoPedidoPortafolio->ListarPedidoCliente($idLogin, 0);
		$return_arr = array("pedidos" => $rpta);
		echo json_encode($return_arr);
	}



	function ListarPedidoProgress($idLogin){
		$view ="";

		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$rpta = $objInfoPedidoPortafolio->ListarPedidoCliente($idLogin, 1);
		$return_arr = array("pedidos" => $rpta);
		echo json_encode($return_arr);
	}

	function EliminarPedido($intIdPortafolio){
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$rpta = $objInfoPedidoPortafolio->EliminarPedido($intIdPortafolio);
		
		echo $rpta[0]['rpta'];
	}


	function EnviarPedido($intIdPedido, $strFactCorreo, $strFactTelefono,$strFactCelular,$strFactCiudad,$strObservacionGeneral){

		
		/*'[{"EncabezadoPedido":
			["
				56
				%10005485  cedula
				%MARIN GALLEGO ELIO FABIO  nombre
				%
				%3252714
				%3058952651   celular
				%CR 11 18 58 CEN  dir1
				%CR 11 18 58 CEN  dir2
				%PEREIRA   ciudad
				%
				%1
				%3
				%11-06-2019\/16:20:34
				%3
				%VPYYNN    total del pedido en letras
				%11-06-2019\/17:03:23
				%Sin Observaci\u00f3n
				%1041203925
				%GALLEGO ARISTIZABAL JULIETH LILIANA"],
			"DetallePedido":
			[[["
				3 ref
				%talla
				%ENSAMBLE GOLFID% des
				%56 color
				%cant
				%ZZNN 
				%0
				%ZZNN
				%unddemedida
				%OBSERVACION"]
			,["HE0522%*12%CORTAU\u00d1AS MEDIANO TRIM%-1%45%RPNN%2%YZSNN%ASD"],["HE1570%%CORTAU\u00d1AS PARA NI\u00d1A%%87%PNN%3%YZSNN%ASDAS"]]]}]'

			*/
		
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$rpta = $objInfoPedidoPortafolio->ConsultarDetallePedidoCliente($intIdPedido, 1);
		//var_dump($rpta);
		$formato = array();
		$detalle = array();
		foreach ($rpta as $key => $value) {
			array_push($detalle, array($value['strReferencia']."%".""."%".$value['strDescripcion']."%".""."%"
			.$value['intCantidad']."%".$value['intPrecioUnitario']."%"."0"."%".$value['intPrecioUnitario']."%"
			.$value['strUdm']."%".$value['strObservacionReferencia']));
			
		}

		$ciudad = str_replace(array("Á","É","´Í","Ó","Ú"), array("A","E","I","O","U"), $rpta[0]['strCiudad']);
		$volorTotal = $this->TotalPedidoLetras($rpta[0]['intvalortotal']);
		$formato1 = array("EncabezadoPedido"=>array($rpta[0]['intIdpedidocliente']."%".$rpta[0]['strIdTercero']."%".$rpta[0]['strNombreTercero']."%". "0"."%"
		.$rpta[0]['strTelefono']."%".$rpta[0]['strCelular']."%".$rpta[0]['strDireccion1']."%".$rpta[0]['strDireccion2']."%".$ciudad."%".""
		."%".""."%".""."%".$rpta[0]['fechafin']."%".sizeof($rpta)."%".$volorTotal."%".""."%".$strObservacionGeneral."%".$rpta[0]['idVendedor']."%".$rpta[0]['strNombreVendedor']."%"."2"."%"."1"."%".$strFactCorreo."%".$strFactTelefono."%".$strFactCelular."%".$strFactCiudad."%")
		, "DetallePedido"=>array($detalle));

		$formato = array($formato1);
		$json = json_encode($formato);
		//var_dump($json);
		$this->strParametros = array("strJsonPedido"=>$json, "US"=>"", "CC"=>"");

		$rptaw = $this->ConsultarWebService("CapturarJsonPedidosVendedor", $this->strParametros, $this->urlWebServicePedidos);


		if($rptaw == 1){
			$this->ActualizarEstadoPedidoCliente($intIdPedido);
		}
		echo($rptaw);
	}

	function TotalPedidoLetras($valor){
		$letras = array("N","Z","Y","W","V","U","S","R","P","O");
		$numeros = array(0,1,2,3,4,5,6,7,8,9);
		$res = str_replace($numeros, $letras, $valor);
		return $res;
	}

	function ConsultarWebService($strMetodo,$blnParametros, $url){
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
















	function HabilitarPedido($strIdTercero, $intIdPortafolio, $intIdPortafolioTercero)
	{
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$objInfoPedidoPortafolio->HabilitarPedido($strIdTercero, $intIdPortafolio, $intIdPortafolioTercero);
		$rpta = $objInfoPedidoPortafolio->GetRespuesta();

		$objInfoPedidoPortafolio = null;
		//var_dump($rpta);
		echo $rpta[0]['rpta'];
	}

	function ListarUsuariosAsociados(){
		
	}
	function ConsultarNombreClienteLogueado($identificacionCliente)
	{
		//echo $identificacionCliente;//1061695270 1061695270
		$rpta = "";
		$this->strParametros = '';
		$this->strParametros=array('intIdTercero'=>$identificacionCliente);
		//var_dump($this->strParametros);
		$strRespuestaTercero=json_decode($this->ConsultarWebService("ConsultarTercero",true, $this->urlWebServiceTercero));
		//var_dump($strRespuestaTercero);
		if (sizeof($strRespuestaTercero) != 0) {
			$rpta = $strRespuestaTercero[0]->StrNombre;
		}else{
			$rpta = null;
		}
		return $rpta;
	}
	
	function VisualizarPedido($intIdPedido){
		$view = "
			<li class='list-group-item'>
			 	<div class='row'>
			   		<div class='col-md-2'><div><b>Foto</b></div></div>
					<div class='col-md-10'>
					   	<div class='row'>
						  	<div class='col-md-2'><div><b>Referencia</b></div></div>
						  	<div class='col-md-2'><div><b>Observacion</b></div></div>
						  	<div class='col-md-2'><div><b>Cantidad</b></div></div>
						  	<div class='col-md-2'><div><b>Precio U.</b></div></div>
						  	<div class='col-md-2'><div><b>Precio S.</b></div></div>
						  	<div class='col-md-2'><div><b>Valor Total</b></div></div>
						</div>
				   	</div>
				</div>
		    </li>
		";
		//echo "string";
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();

		$rpta = $objInfoPedidoPortafolio->ConsultarDetallePedidoCliente($intIdPedido);
		//var_dump($rpta);


		for ($i=0; $i < sizeof($rpta); $i++) { 
				$referencia = $rpta[$i]['strReferencia'];

				$id = $rpta[$i]['intId'];
				$view.="
				<li class='list-group-item'>
					<div class='row'>
						<div class='col-md-2'><img src='http://app.inmodafantasy.com.co/ownCloud/fotos_nube/".$rpta[$i]['strReferencia'].".jpg' alt='' style='width: 100px;'>
					   	</div>

					   	<div class='col-md-10'>
					   	<div class='row'>
						  	<div class='col-md-2'><div><b>".$rpta[$i]['strReferencia']."</b></div></div>
						  	<div class='col-md-2' style='overflow:hidden; white-space: nowrap;'>
						  		  	<label for='message-text' class='col-form-label'>Observacion:</label>
	            					<div id='message-text'>".$rpta[$i]['strObservacion']."</div>
						  	</div>
						  	<div class='col-md-2'><div id='cantidad'>".$rpta[$i]['intCantidad']."</div></div>
						  	<div class='col-md-2'><div>".number_format($rpta[$i]['intPrecioUnitario'])."</div></div>
						  	<div class='col-md-2'><div>".number_format($rpta[$i]['intPrecioSugerido'])."</div></div>
						  	<div class='col-md-2'><div>".number_format($rpta[$i]['intValorTotal'])."</div></div>
						</div>
					   	</div>
					  	

					</div>

			     
			    </li>";
			}
			if ($view == "") {
				$view = '
					<div class="alert alert-warning" role="alert">
  <a href="#" class="alert-link">No hay productos seleccionados en el momento</a>
</div>
				';
			}
			echo $view;
		
	}

	function ConsultarIngresoPortafolio($intIdPortafolio, $intIdTercero)
	{
		//echo $intIdPortafolio." :: ".$intIdTercero;
		$rpta = '';
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$objInfoPedidoPortafolio->ConsultarIngresoPortafolio($intIdPortafolio,$intIdTercero);
		$rpta = $objInfoPedidoPortafolio->GetRespuesta();
		//var_dump($rpta);
		$objInfoPedidoPortafolio = null;
		if ($rpta[0]['rpta'] != -1) {
			$rpta = "Codigo = ".$rpta[0]['rpta']." : Cedula = ".$intIdTercero;
		}else{
			$rpta = "Hubo un problemas en la DB";
		}
		
		echo $rpta;
	}

	
	public function GenerarInformeExcel()
	{
		require_once '../Classes/PHPExcel.php';
		PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
		$obPHPExcel = new PHPExcel();

		$Titulos = array("Pedido", "Cedula", "Nombre", "Observación", "Usuario", "Abierto", "Finalizado", "Total","Vendedor", "Cant Pedidos Finalizados", "Cant Pedidos Sin Finalizar");
		$obPHPExcel->setActiveSheetIndex(0);
		$obPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', $Titulos[0])
		->setCellValue('B1', $Titulos[1])
		->setCellValue('C1', $Titulos[2])
		->setCellValue('D1', $Titulos[3])
		->setCellValue('E1', $Titulos[4])
		->setCellValue('F1', $Titulos[5])
		->setCellValue('G1', $Titulos[6])
		->setCellValue('H1', $Titulos[7])
		->setCellValue('I1', $Titulos[8])
		->setCellValue('K1', $Titulos[9])
		->setCellValue('L1', $Titulos[10]);
		
		foreach ($obPHPExcel->getWorksheetIterator() as $worksheet) {

		    $obPHPExcel->setActiveSheetIndex($obPHPExcel->getIndex($worksheet));

		    $sheet = $obPHPExcel->getActiveSheet();
		    $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
		    $cellIterator->setIterateOnlyExistingCells(true);
		    /** @var PHPExcel_Cell $cell */
		    foreach ($cellIterator as $cell) {
		        $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
		    }
		}

		$obPHPExcel->getActiveSheet(0)->getStyle('A1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
		$obPHPExcel->getActiveSheet(0)->getStyle('B1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
		$obPHPExcel->getActiveSheet(0)->getStyle('C1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
		$obPHPExcel->getActiveSheet(0)->getStyle('D1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
		$obPHPExcel->getActiveSheet(0)->getStyle('E1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
		$obPHPExcel->getActiveSheet(0)->getStyle('F1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
		$obPHPExcel->getActiveSheet(0)->getStyle('G1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
		$obPHPExcel->getActiveSheet(0)->getStyle('H1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
		$obPHPExcel->getActiveSheet(0)->getStyle('I1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
		$obPHPExcel->getActiveSheet(0)->getStyle('K1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
		$obPHPExcel->getActiveSheet(0)->getStyle('L1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);

		//CONSULTAR CP
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$objInfoPedidoPortafolio->ListarInformePedidos();
		$rpta = $objInfoPedidoPortafolio->GetRespuesta();
		$totalPedidosFinalizados = 0;
		$totalPedidosSinFinalizar = 0;
		$ultimoRegistro = sizeof($rpta);

		if ($rpta != "") {
			for ($i=0; $i < sizeof($rpta); $i++) { 
				if (number_format($rpta[$i]['Valor Total']) != 0) {
					$totalPedidosFinalizados++;
				}else{
					$totalPedidosSinFinalizar++;
				}
				$this->strParametros = "";
				$this->strParametros=array('intIdTercero'=>"'".$rpta[$i]['strIdTercero']."'");
				$strRespuestaTercero=json_decode($this->ConsultarWebService("ConsultarTercero",true, $this->urlWebServiceTercero));

				$obPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.($i+2), $rpta[$i]['Id Pedido'])
				->setCellValue('B'.($i+2), $rpta[$i]['strIdTercero'])
				->setCellValue('C'.($i+2), $strRespuestaTercero[0]->StrNombre)
				->setCellValue('D'.($i+2), $rpta[$i]['Observacion Pedido'])
				->setCellValue('E'.($i+2), $rpta[$i]['Usuario'])
				->setCellValue('F'.($i+2), $rpta[$i]['fechaini'])
				->setCellValue('G'.($i+2), $rpta[$i]['fechafin'])
				->setCellValue('H'.($i+2), number_format($rpta[$i]['Valor Total']))
				->setCellValue('I'.($i+2), $rpta[$i]['Nombre Vendedor']);
			}
		}
		$obPHPExcel->setActiveSheetIndex(0)
		->setCellValue('K2', $totalPedidosFinalizados)
		->setCellValue('L2', $totalPedidosSinFinalizar);


		$ultimoRegistro+=4;
		//INFORME PORTAFOLIOS COMPARTIDOS
		$Titulos2 = array("#", "Cedula", "Descripcion", "Visto", "Ultima Visita", "Creado", "Nombre Vendedor");
		$obPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$ultimoRegistro, $Titulos2[0])
		->setCellValue('B'.$ultimoRegistro, $Titulos2[1])
		->setCellValue('C'.$ultimoRegistro, $Titulos2[2])
		->setCellValue('D'.$ultimoRegistro, $Titulos2[3])
		->setCellValue('E'.$ultimoRegistro, $Titulos2[4])
		->setCellValue('F'.$ultimoRegistro, $Titulos2[5])
		->setCellValue('G'.$ultimoRegistro, $Titulos2[6])
		->setCellValue('H'.$ultimoRegistro, $Titulos2[7])
		->setCellValue('I'.$ultimoRegistro, $Titulos2[8])
		->setCellValue('K'.$ultimoRegistro, $Titulos2[9])
		->setCellValue('L'.$ultimoRegistro, $Titulos2[10]);

		$columnas = array("A","B","C","D","E","F","G","H");
		for ($i=0; $i < sizeof($Titulos2); $i++) { 
			$obPHPExcel->getActiveSheet(0)->getStyle($columnas[$i].$ultimoRegistro)->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
		}

		$ultimoRegistro++;
		$objInfoPedidoPortafolio->ListarPortafoliosTercero($_SESSION['idLogin']);
		$rpta = $objInfoPedidoPortafolio->GetRespuesta();
		$objInfoPedidoPortafolio = null;

		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 
				$obPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.($i+$ultimoRegistro), $rpta[$i]['Codigo'])
				->setCellValue('B'.($i+$ultimoRegistro), $rpta[$i]['IdTercero'])
				->setCellValue('C'.($i+$ultimoRegistro), $rpta[$i]['Descripcion'])
				->setCellValue('D'.($i+$ultimoRegistro), $rpta[$i]['Visto'])
				->setCellValue('E'.($i+$ultimoRegistro), $rpta[$i]['UltimaVisita'])
				->setCellValue('F'.($i+$ultimoRegistro), $rpta[$i]['FechaCreado'])
				->setCellValue('G'.($i+$ultimoRegistro), $rpta[$i]['NombreVendedor']);
			}
		}

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="'.'_'.date('Y/m/d').'.xls"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($obPHPExcel, 'Excel5');
				 ob_end_clean();
				$objWriter->save('php://output');

		exit;
	}

	

	public function generarExcel($intIdPedido, $strIdTercero){

		require_once '../Classes/PHPExcel.php';
		PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
		 $obPHPExcel = new PHPExcel();
		
		
	
		$TituloCliente=array("Cedula","Nombre","Telefono","Celular","Direccion1","Direccion2","Ciudad","Cartera","Cupo");
		$titulosColumnas = array('CODIGO EAN', 'ESTILO', 'DESCRIPCION', 'COLOR','CANTIDAD','PRECIO');
		$obPHPExcel->setActiveSheetIndex(0);
		$obPHPExcel->setActiveSheetIndex(0)
		    ->setCellValue('B9',  $titulosColumnas[0])  
		    ->setCellValue('C9',  $titulosColumnas[1])
		    ->setCellValue('D9',  $titulosColumnas[2])
		    ->setCellValue('E9',  $titulosColumnas[3])
		    ->setCellValue('F9',  $titulosColumnas[4])
		    ->setCellValue('G9',  $titulosColumnas[5]);
		 $obPHPExcel->setActiveSheetIndex(0)
		    ->setCellValue('B1',  $TituloCliente[0])  
		    ->setCellValue('B3',  $TituloCliente[1])
		    ->setCellValue('B5',  $TituloCliente[2])
		    ->setCellValue('C1',  $TituloCliente[3])
		    ->setCellValue('C3',  $TituloCliente[4])
		    ->setCellValue('C5',  $TituloCliente[5])
		    ->setCellValue('D1',  $TituloCliente[6])
		    ->setCellValue('D3',  $TituloCliente[7])
		    ->setCellValue('D5',  $TituloCliente[8]);

	    $obPHPExcel->getActiveSheet(0)->getStyle('B1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);  $obPHPExcel->getActiveSheet(0)->getStyle('B3')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);  $obPHPExcel->getActiveSheet(0)->getStyle('B5')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);  $obPHPExcel->getActiveSheet(0)->getStyle('C1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);  $obPHPExcel->getActiveSheet(0)->getStyle('C3')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);  $obPHPExcel->getActiveSheet(0)->getStyle('C5')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);  $obPHPExcel->getActiveSheet(0)->getStyle('D1')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);  $obPHPExcel->getActiveSheet(0)->getStyle('D3')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);  $obPHPExcel->getActiveSheet(0)->getStyle('D5')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);

	         $obPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setAutoSize(TRUE);
	         $obPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setAutoSize(TRUE);
	         $obPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setAutoSize(TRUE);
	         $obPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setAutoSize(TRUE);
	         $obPHPExcel->setActiveSheetIndex(0)->getColumnDimension('F')->setAutoSize(TRUE);
	         $obPHPExcel->setActiveSheetIndex(0)->getColumnDimension('G')->setAutoSize(TRUE);
	         $obPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setVisible(false);
	         $obPHPExcel->getActiveSheet(0)->getStyle('B9')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
	          $obPHPExcel->getActiveSheet(0)->getStyle('C9')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
	           $obPHPExcel->getActiveSheet(0)->getStyle('D9')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
	            $obPHPExcel->getActiveSheet(0)->getStyle('E9')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
	             $obPHPExcel->getActiveSheet(0)->getStyle('F9')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
	              $obPHPExcel->getActiveSheet(0)->getStyle('G9')->applyFromArray(
			    array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => '33BBFF')
			        ),
			        'font'  => array(
				        'bold'  => true,
				        'size'  => 11,
				        'name'  => 'Calibri',
				        'color' => array('rgb' => 'FFFFFF')
				    )
			    )
			);
	
	$this->strParametros = "";
	$this->strParametros=array('intIdTercero'=>"'".$strIdTercero."'");
	$strRespuestaTercero=json_decode($this->ConsultarWebService("ConsultarTercero",true, $this->urlWebServiceTercero));
		

	if (sizeof($strRespuestaTercero) != 0) {
		$Celular = $strRespuestaTercero[0]->StrCelular;
		$Ciudad = $strRespuestaTercero[0]->StrDescripcion;
		$Nombre = $strRespuestaTercero[0]->StrNombre;
		$Direccion1 = $strRespuestaTercero[0]->StrDireccion;
		$Cartera = "";
		$Telefono = $strRespuestaTercero[0]->StrTelefono;
		$Direccion2 = $strRespuestaTercero[0]->StrDireccion2;
		$Cupo = $strRespuestaTercero[0]->IntCupo;
	}else{
		$Celular = "";
		$Ciudad ="";
		$Nombre ="";
		$Direccion1 = "";
		$Cartera = "";
		$Telefono = "";
		$Direccion2 = "";
		$Cupo = "";
	}

	$obPHPExcel->setActiveSheetIndex(0)
	->setCellValue('B2', $strIdTercero)
	->setCellValue('B4', $Nombre)
	->setCellValue('C2', $Celular)
	->setCellValue('D2', $Ciudad)
	->setCellValue('C4', $Direccion1)
	->setCellValue('D4', $Cartera)
	->setCellValue('B6', $Telefono)
	->setCellValue('C6', $Direccion2)
	->setCellValue('D6', $Cupo);

	$objInfoPedidoPortafolio = new clsInfoPedidoModel();
	$rpta = $objInfoPedidoPortafolio->ConsultarDetallePedidoCliente($intIdPedido);

	for ($i=0; $i < sizeof($rpta); $i++) {
	$this->strParametros = "";
	$this->strParametros=array('strReferencia'=>"'".$rpta[$i]['strReferencia']."'");
								
	$StrDescripcionProducto=json_decode($this->ConsultarWebService("ConsultarProducto",true, $this->urlWebService));
	//NUEVO
	if($rpta[$i]['intPrecioSugerido'] != 0){
		$precioUnitario = $rpta[$i]['intPrecioSugerido'];
	}else{
		$precioUnitario = $rpta[$i]['intPrecioUnitario'];
	}
	$precioUnitario = $this->FormatoPrecio($precioUnitario);
	//NUEVO TAMBIEN LINEA 263
	if (ctype_digit(str_replace(" ", "",$rpta[$i]['strObservacion']))) {
		$rpta[$i]['strObservacion'] = "N ".$rpta[$i]['strObservacion'];
	}
	$Observacion = str_replace("-", " guion", $rpta[$i]['strObservacion']);
	$obPHPExcel->setActiveSheetIndex(0)
	->setCellValue(('B'.($i+10)), $rpta[$i]['strReferencia'])
	->setCellValue(('C'.($i+10)), "")// estilo
	->setCellValue(('D'.($i+10)), $StrDescripcionProducto[0]->strdescripcion) // DESCRIPCION DEL PRODUCTO
	->setCellValue(('E'.($i+10)), $Observacion)
	->setCellValue(('F'.($i+10)), $rpta[$i]['intCantidad'])
	->setCellValue(('G'.($i+10)), $precioUnitario);//intValorTotal

	}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="'.str_replace(' ', '_', trim($strRespuestaTercero[0]->StrNombre)).'_'.date('Y/m/d').'.xls"');
				header('Cache-Control: max-age=0');
				$objWriter = PHPExcel_IOFactory::createWriter($obPHPExcel, 'Excel5');
				 ob_end_clean();
				$objWriter->save('php://output');

		exit;
	}

	function FormatoPrecio($valor)
	{
		$valor = str_replace("0", "N", $valor);
		$valor = str_replace("1", "Z", $valor);
		$valor = str_replace("2", "Y", $valor);
		$valor = str_replace("3", "W", $valor);
		$valor = str_replace("4", "V", $valor);
		$valor = str_replace("5", "U", $valor);
		$valor = str_replace("6", "S", $valor);
		$valor = str_replace("7", "R", $valor);
		$valor = str_replace("8", "P", $valor);
		$valor = str_replace("9", "O", $valor);

		return $valor;
	}

	function ActualizarVigenciaCreacionPortafolio($intIdPortafolio, $strIdTercero, $intIdPortafolioTercero){
		$rpta = '';
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$objInfoPedidoPortafolio->ActualizarVigenciaCreacionPortafolio($intIdPortafolio,$strIdTercero, $intIdPortafolioTercero);
		$rpta = $objInfoPedidoPortafolio->GetRpta();
		
		echo $rpta[0]['rpta'];
	}

	function LinkArchivoIni()
	{
		$archivo = __DIR__ . "/archivo.ini";
		$contenido = parse_ini_file($archivo, true);
		$Url = $contenido["URL"]["Url"];
		echo $Url;
	}

	function ActualizarEstadoPedidoCliente($intId){
		$rpta = '';
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$objInfoPedidoPortafolio->ActualizarEstadoPedidoCliente($intId);
		$rpta = $objInfoPedidoPortafolio->GetRpta();
		
		//echo $rpta[0]['rpta'];
	}
	
}
 ?>