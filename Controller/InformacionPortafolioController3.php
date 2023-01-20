<?php 
include_once ("../Model/clsInfoPedidoModel.php");
include_once ("../Model/clsLoginModel.php");
include_once("../Classes/nusoap/nusoap.php");
session_start();

$objInfoPortafolio = new InformacionPortafolioController();

if (isset($_POST['btnListarDetallePortafolioPedido'])) {
	$objInfoPortafolio->ListarDetallePortafolioPedido($_SESSION['idLogin'], $_POST['mes'],$_POST['año']);
}

if (isset($_POST['btnHabilitarPedido'])) {
	//echo "string";
	$objInfoPortafolio->HabilitarPedido($_POST['strIdTercero'], $_POST['intIdPortafolio'], $_POST['intIdPortafolioTercero']);
}
if (isset($_POST['btnVisualizarPedido'])) {
	//echo $_POST['IdPedido'];
	$objInfoPortafolio->VisualizarPedido($_POST['IdPedido']);
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
	function __construct()
	{
		$this->urlWebServiceTercero="http://10.10.10.128/webserviceportal/WebService/WebServiceTercero.php?wsdl";
		$this->urlWebService = 'http://10.10.10.128/webserviceportal/WebService/WebServiceProductos.php?wsdl';
		$this->strParametros = "";
	}
	function ListarPortafoliosTercero($idLogin, $mes, $año)
	{
		$view ="";
		//echo "string";
		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$objInfoPedidoPortafolio->ListarPortafoliosTercero($idLogin, $mes, $año);
		$rpta = $objInfoPedidoPortafolio->GetRespuesta();
		$objInfoPedidoPortafolio = null;
		//var_dump($rpta);
		$archivo = __DIR__ . "/archivo.ini";
		$contenido = parse_ini_file($archivo, true);
		$Url = $contenido["URL"]["Url"];
		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 
				$clases = "";
				$displayActivar = "none";
				$displayVisualizar = "none";
				//$nombreCliente = $this->ConsultarNombreClienteLogueado("'".$rpta[$i]['IdTercero']."'");
				$nombreCliente = $rpta[$i]['NombreTercero'];
				if ($nombreCliente == null) {
					$nombreCliente = "Sin nombre";
				}
				//finalizo pedido sin valor   
				if ($rpta[$i]['Visto'] == null) {
					$clases.="danger ";
					$fechaVisto = ""; 
				}else{
					$clases.="info";
					$fechaVisto = $rpta[$i]['Visto']; 
				}
				$view.="
				
							   		<tr class=".$clases.">
							   			<td id='".$rpta[$i]['Codigo']."'><a href='http://app.inmodafantasy.com.co/Web/View/?code=".$rpta[$i]['Codigo']."'  target='_blank'>".$Url."?code=".$rpta[$i]['Codigo']."</a></td>
							   			<td id='".$rpta[$i]['NombrePortafolio']."'>".$rpta[$i]['NombrePortafolio']."</td>
							   			<td id='".$rpta[$i]['IdTercero']."'>".$rpta[$i]['IdTercero']."</td>
							   			<td>".$nombreCliente."</td>
							   			<td>".$rpta[$i]['NombreVendedor']."</td>
							   			<td>".$rpta[$i]['Descripcion']."</td>
							   			<td>".$rpta[$i]['FechaCreado']."</td>
							   			<td>".$fechaVisto."</td>
							   			<td>".$rpta[$i]['UltimaVisita']."</td>
							   			
							   				
							   		</tr>



				";

			}
		}else{
			echo "Sin informacion";
		}
		echo $view;
	}



	function ListarDetallePortafolioPedido($idLogin, $mes, $año){
		$view ="";

		$objInfoPedidoPortafolio = new clsInfoPedidoModel();
		$objInfoPedidoPortafolio->ListarPedidoCliente($idLogin, $mes, $año);
		$rpta = $objInfoPedidoPortafolio->GetRespuesta();
		$objInfoPedidoPortafolio = null;
		//var_dump($rpta);
		//$view = $idLogin;
		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 
				$clases = "";
				$displayActivar = "none";
				$displayVisualizar = "none";
				$idTercero = $rpta[$i]['strIdTercero'];
				$idPortafolio = $rpta[$i]['strIdPortafolio'];
				//$nombreCliente = $this->ConsultarNombreClienteLogueado("'".$rpta[$i]['strIdTercero']."'");
				$nombreCliente = $rpta[$i]['NombreTercero'];
				if ($nombreCliente == null) {
					$nombreCliente = "Sin nombre";
				}
				
				//finalizo correctamente
				if ($rpta[$i]['intEstado'] == 0 && $rpta[$i]['intEstado'] != null && $rpta[$i]['intvalortotal'] != 0) {
					$clases.="success ";
					$displayActivar = "inline";
					$displayVisualizar = "inline";
				}
				//finalizo pedido sin valor   
				if ($rpta[$i]['intEstado'] == 0 && $rpta[$i]['intvalortotal'] == 0) {
					$clases.="danger ";
					$displayActivar = "inline";
				}
				//Excel descargado pedido terminado
				if ($rpta[$i]['intEstado'] == 2) {
					$clases.="alert-warning";
					$displayActivar = "inline";
				}

				$view.="
							   		<tr class=".$clases.">
							   			<td id='".$rpta[$i]['strIdPortafolio']."'>".$rpta[$i]['intId']."</td>
							   			<td id='".$rpta[$i]['strIdTercero']."'>".$nombreCliente."</td>
							   			<td>".$rpta[$i]['strNombreVendedor']."</td>
							   			<td>".$rpta[$i]['fechaini']."</td>
							   			<td>".$rpta[$i]['fechafin']."</td>
							   			<td>".number_format($rpta[$i]['intvalortotal'])."</td>
							   			<td style='max-height: 150px;'>
							   				
				            					<div id='message-text'>".$rpta[$i]['strObservacion']."</div>
											
										</td>
							   			
							   			<td>
							   				<button class='btn btn-default' data-toggle='modal' title='Visualizar el pedido' data-target='#exampleModalCenter' onclick='VisualizarPedido(".$rpta[$i]['intId'].")' ><i class='glyphicon glyphicon-eye-open'></i></button>
							   				<form style='display:none' action='../Controller/InformacionPortafolioController.php' method='post' id='excel".$rpta[$i]['intId']."'>
							   				<input type='text' name='btnGenerarExcel'>
							   				<input type='text' name='txtId' value='".$rpta[$i]['intId']."'>
							   				<input type='text' name='strIdTercero' value='".$rpta[$i]['strIdTercero']."'>
							   				</form>
							   				<button name='btnGenerarExcel' onclick='GenerarExcel(".$rpta[$i]['intId'].")' title='Descargar excel'  class='btn btn-default'><i class='glyphicon glyphicon-file'></i></button>
							   				<button class='btn btn-default' title='Habilitar pedido cuando el cliente lo finalizo' onclick='HabilitarPedido(\"".$rpta[$i]['strIdTercero']."\",".$rpta[$i]['strIdPortafolio'].", ".$rpta[$i]['intIdPortafolioTercero'].")' style='display: ".$displayActivar."'><i class='glyphicon glyphicon-ok'></i></button>
							   				<button class='btn btn-default' title='Ir al portafolio' onclick='AbrirPortafolio(".$rpta[$i]['strIdPortafolio'].");'><i class='glyphicon glyphicon-briefcase'></i></button>
							   				<button class='btn btn-default' title='Consultar codigo de ingreso' style='display:inline;' onclick='ConsultarIngresoPortafolio(".$rpta[$i]['intIdPortafolioTercero'].",\"".$rpta[$i]['strIdTercero']."\")'><i class='glyphicon glyphicon-info-sign'></i></button>
							   				<button class='btn btn-default'  title='Habilita 5 dias mas para ver el portafolio' onclick='ActualizarVigenciaPortafolio(".$idPortafolio.",\"".$idTercero."\", ".$rpta[$i]['intIdPortafolioTercero'].")'><i class='glyphicon glyphicon-calendar'></i></button>
							   				</td>
							   				
							   		</tr>
				";

			}
		}else{
			echo "Sin informacion";
		}

		echo $view;



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
						<div class='col-md-2'><img src='http://181.143.42.219:8888/ownCloud/fotos_nube/".$rpta[$i]['strReferencia'].".jpg' alt='' style='width: 100px;'>
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
		
		echo $rpta[0]['rpta'];
	}
	
}
 ?>