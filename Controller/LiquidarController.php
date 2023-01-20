<?php 
include_once("../Model/clsComprasModel.php");
include_once("../Classes/nusoap/nusoap.php");
include_once("../WebServices/clsProductoWebService.php");

$clsLiquidarController = new clsLiquidarController();

if (isset($_POST['btnConsultarReferencias'])) {
	$clsLiquidarController->ConsultarReferencias();
}
if (isset($_POST['btnCargarReferenciasTerminadas'])) {
	$clsLiquidarController->CargarReferenciasTerminadas();
}

if (isset($_POST['btnIngresarPreciosDetalleCompra'])) {
	$clsLiquidarController->IngresarPreciosDetalleCompra($_POST['idDetalle'], $_POST['txtPrecioUno'], $_POST['txtPrecioDos'], $_POST['txtPrecioTres'], $_POST['txtPrecioCuatro'], $_POST['txtPrecioCinco'],  $_POST['txtReferencia'],  $_POST['txtDescripcion'], $_POST['txtDimension'], $_POST['txtCxU'], $_POST['txtUnidadMedida'], $_POST['txtCantidadContenedor'], $_POST['txtCantidadPaca'], $_POST['txtMaterial'], $_POST['txtObservacion'], $_POST['txtSexo'], $_POST['txtMarca']);
}

if (isset($_POST['btnConsultarPrecios'])) {
	//echo $_POST['precio1']." : ".$_POST['unidadMedida'];
	$clsLiquidarController->ConsultarPrecios($_POST['precio1'], $_POST['unidadMedida']);
}

if (isset($_POST['btnConsultarUnidadesMedida'])) {
	$clsLiquidarController->ConsultarUnidadesMedida();
}

if (isset($_POST['btnConsultarTblSexo'])) {
	$clsLiquidarController->ConsultarTblSexo();
}

if (isset($_POST['btnConsultarTblMaterial'])) {
	$clsLiquidarController->ConsultarTblMaterial();
}

if (isset($_POST['btnConsultarTblMarca'])) {
	$clsLiquidarController->ConsultarTblMarca();
}

if (isset($_POST['btnConsultarLoteReferencia'])) {
	$clsLiquidarController->ConsultarLoteReferencia($_POST['idDetalleReferencia']);
}
if (isset($_POST['btnEliminarLoteReferencia'])) {
	$clsLiquidarController->EliminarLoteReferencia($_POST['idLoteReferencia']);
}
if (isset($_POST['btnAgregarLoteReferencia'])) {
	$clsLiquidarController->AgregarLoteReferencia($_POST['idDetalleReferencia'], $_POST['color'], $_POST['estilo']);	
}
if (isset($_POST['btnActualizarLoteReferencia'])) {
	$clsLiquidarController->ActualizarLoteReferencia($_POST['idLote'], $_POST['color'], $_POST['estilo'], $_POST['idDetalle']);
}
if (isset($_POST['evtValidarReferencia'])) {
	$clsLiquidarController->ValidarReferencia($_POST['Referencia']);
}
if (isset($_POST['btnDuplicarReferenciaDetalleCompra'])) {
	//echo $_POST['idDetalle']." : ".$_POST['idDetalle']." : ".$_POST['txtReferenciaM']." : ".$_POST['txtDescripcionM']." : ".$_POST['txtCantidadM'];
	$clsLiquidarController->DuplicarReferenciaDetalle($_POST['idDetalle'], $_POST['txtReferenciaM'], $_POST['txtDescripcionM'], $_POST['txtCantidadM']);	
}

if(isset($_POST['btnprod'])){
	$clsLiquidarController->constprodhgi($_POST['referencia']);
}

class clsLiquidarController 
{

	private $urlWebService;
	function __construct()
	{
		$this->urlWebService = 'http://10.10.10.128/webserviceportal/WebService/WebServiceProductos.php?wsdl';
	}

	function ValidarReferencia($referencia)
	{
		$clsComprasModel = new clsComprasModel();
		$rpta = $clsComprasModel->ValidarReferenciaDetalle($referencia);
		//var_dump($rpta);
		echo $rpta[0]['rpta'];
	}
	function DuplicarReferenciaDetalle($idDetalle,  $referencia, $descripcion, $cantidad)
	{
		$clsComprasModel = new clsComprasModel();
		$rpta = $clsComprasModel->DuplicarReferenciaDetalle($idDetalle,  $referencia, $descripcion, $cantidad);
		//var_dump($rpta);
		echo $rpta[0]['rpta'];
	}

	function ConsultarLoteReferencia($idDetalleReferencia){
		$view="";
		$clsComprasModel = new clsComprasModel();
		$rpta = $clsComprasModel->ConsultarLoteReferenciaCompra($idDetalleReferencia);
		//var_dump($rpta);
		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 
				$idLote = $rpta[$i]['idLoteReferencia'];
				$view.='
					<tr>
						<td id="color'.$idLote.'">'.$rpta[$i]["strColor"].'</td>
						<td id="estilo'.$idLote.'">'.$rpta[$i]["strEstilo"].'</td>
						<td><button type="button" class="btn btn-outline-primary" onClick="EliminarLoteReferencia('.$idLote.','.$idDetalleReferencia.')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
							<button type="button" class="btn btn-outline-primary" onClick="EditarLoteReferencia('.$idLote.','.$idDetalleReferencia.')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
						</td>
					</tr>
				';
			}
		}
		echo $view;
	}
	function EliminarLoteReferencia($idLoteReferencia){
		$clsComprasModel = new clsComprasModel();
		$clsComprasModel->EliminarLoteReferenciaCompra($idLoteReferencia);
		$rpta = $clsComprasModel->GetRpta();
		echo $rpta;
	}
	function AgregarLoteReferencia($idDetalleReferencia, $color, $estilo){
		$clsComprasModel = new clsComprasModel();
		$clsComprasModel->AgregarLoteReferenciaCompra($idDetalleReferencia, $color, $estilo);
		$rpta = $clsComprasModel->GetRpta();
		echo $rpta;
	}
	function ActualizarLoteReferencia($idLote, $color, $estilo, $idDetalleReferencia)
	{
		$clsComprasModel = new clsComprasModel();
		$clsComprasModel->ActualizarLoteReferenciaCompra($idLote, $color, $estilo, $idDetalleReferencia);
		$rpta = $clsComprasModel->GetRpta();
		echo $rpta;
	}
	
	function ConsultarUnidadesMedida()
	{
		$view = "<option value='0'>Seleccione UDM</option>";
		$strRespuestaTercero=json_decode($this->ConsultarWebService("ListarUnidadesMedida",false, $this->urlWebService));
		//var_dump($strRespuestaTercero);
		for ($i=0; $i < sizeof($strRespuestaTercero); $i++) { 
			$view.= "
				<option value='".$strRespuestaTercero[$i]->StrIdUnidad."'>".$strRespuestaTercero[$i]->StrIdUnidad."</option>
			";
		}
		
		echo $view;

	}

	function ConsultarTblSexo()
	{
		$view = "<option value='-1'>Seleccione Género</option>";
		$strRpta=json_decode($this->ConsultarWebService("ListarTblSexoP",false, $this->urlWebService));
		//var_dump($strRespuestaTercero);
		for ($i=0; $i < sizeof($strRpta); $i++) { 
			$view.= "
				<option value='".$strRpta[$i]->StrDescripcion."'>".$strRpta[$i]->StrDescripcion."</option>
			";
		}
		
		echo $view;

	}

	function ConsultarTblMaterial()
	{
		$view = "<option value='-1'>Seleccione Material</option>";
		$strRpta=json_decode($this->ConsultarWebService("ListarTblMaterialP",false, $this->urlWebService));
		//var_dump($strRespuestaTercero);
		for ($i=0; $i < sizeof($strRpta); $i++) { 
			$view.= "
				<option value='".$strRpta[$i]->StrDescripcion."'>".$strRpta[$i]->StrDescripcion."</option>
			";
		}
		
		echo $view;

	}

	function ConsultarTblMarca()
	{
		$view = "<option value='-1'>Seleccione Marca</option>";
		$strRpta=json_decode($this->ConsultarWebService("ListarTblMarcaP",false, $this->urlWebService));
		for ($i=0; $i < sizeof($strRpta); $i++) { 
			$view.= "
				<option value='".$strRpta[$i]->StrDescripcion."'>".$strRpta[$i]->StrDescripcion."</option>
			";
		}
		
		echo $view;

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

	public function ConsultarReferencias()
	{
		$view="";
		$clsComprasModel = new clsComprasModel();
		$rpta = $clsComprasModel->consultarDetalleCompra(1);
		
		if ($rpta != null) {
			
			/*echo $costoTotal." ".$intOTM." ".$intArancel." ".$intIVA." ".$intDescargues." ".$intDepositoFranca." ".$intNaviera." ".$intTIC." ".$intOtrosUno." ".$intOtrosDos;
			exit();*/
			



			for ($i=0; $i < sizeof($rpta); $i++) { 
				//echo $rpta[$i]['intValorTotalCompra']."<br>";
				$costoTotal = $rpta[$i]['intValorTotalCompra'];
				$intOTM = $rpta[$i]['intOTM'];
				$intArancel = $rpta[$i]['intArancel'];
				$intIVA = $rpta[$i]['intIVA'];
				$intDescargues = $rpta[$i]['intDescargues'];
				$intDepositoFranca = $rpta[$i]['intDepositoFranca'];
				$intNaviera = $rpta[$i]['intNaviera'];
				$intTIC = $rpta[$i]['intTIC'];
				$intOtrosUno = $rpta[$i]['intOtrosUno'];
				$intOtrosDos = $rpta[$i]['intOtrosDos'];

				$costosIndirectos = $intOTM+$intArancel+$intIVA+$intDescargues+$intDepositoFranca+$intNaviera+$intTIC+$intOtrosUno+$intOtrosDos;

				$porcentaje = $costosIndirectos / ($costoTotal / (($rpta[$i]['intPorcentajeDescuento'] / 100)));

				//$costoReal = ((($rpta[$i]['intValor'] / ($rpta[$i]['intPorcentajeDescuento'] / 100))*(1+$porcentaje)) / $rpta[$i]['intCantidad']);
				//$costoReal = $rpta[$i]['intValor']; //para referencias ya listas...
				
			    $costoReal = ($rpta[$i]['intValor'] /(($rpta[$i]['intPorcentajeDescuento'] / 100)))*(1+$porcentaje); //costo real en verde y sin el descuento es el de blanca
				/*$estimado_uno = number_format((($costoReal*(1.5))*1.19));
				$estimado_dos = number_format((($costoReal*(1.1))*(1.5))*1.19);*/
				$estimado_uno = $costoReal;
				$estimado_dos = number_format(($costoReal*1.1));
				$view.="
					<tr>
						<td>".$i."</td>
						<td style='display: none;' id='costoreal'>".$costoReal ."</td>  
						<td id='referencia".$i."'>".$rpta[$i]['strReferencia']."</td>
                        <td style='display: none;' id='id".$i."'>".$rpta[$i]['intIdDetalle']."</td>                                            
                        <td id='descripcion".$i."'>".$rpta[$i]['strDescripcion']."</td> 

                        <td style='display: none;' id='materialprueba".$i."'>".$rpta[$i]["strMaterial"]."</td>
                                                                            
                        <td id='unidadMedida".$i."'>".$rpta[$i]['strUnidadMedida']."</td>  
						<td>".$rpta[$i]['strRaggi']."</td>  
						<td id='estimado1".$i."'>".$estimado_uno."</td> 
						<td id='estimado2".$i."'>".$estimado_dos."</td>
						<td style='display: none;' id='dimension".$i."'>".$rpta[$i]['strDimesion']."</td>
						<td style='display: none;' id='CxU".$i."'>".$rpta[$i]['intCxU']."</td>
						<td style='display: none;' id='cantidad".$i."'>".$rpta[$i]['intCantidad']."</td>
						<td style='display: none;' id='precio2".$i."'>".$rpta[$i]['intPrecio2']."</td>
						<td style='display: none;' id='costoindirectos'>".$costosIndirectos."</td>
						<td style='display: none;' >porcenteje == ".$porcentaje."</td>
						<td style='display: none;' >costo real == ".$costoReal."</td>
						<td style='display:none' id='txtCantidadPaca".$i."'>".$rpta[$i]['intCantidadPaca']."</td>
						
						<td style='display: none;' >valor == ".$rpta[$i]['intValor']."</td>
						<td class='boton btn btn-primary' onClick='CargarFormulario(".$i.");constprodhgi(".$i.");'
							
							><i class='glyphicon glyphicon-repeat'></i> Cargar</td>
					</tr>		


				";
			}
		}else{
			$view.="No hay informacion";
		}
		echo $view;
		//var_dump($rpta); //validar cuando esten los registros para mostrar la tabla
	}
	public function CargarReferenciasTerminadas()
	{
		$view="";
		$clsComprasModel = new clsComprasModel();
		$rpta = $clsComprasModel->consultarDetalleCompra(2);
		//var_dump($rpta);
		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 
				//echo $rpta[$i]['intIdDetalle']."<br>";
				/*$costoTotal = $rpta[$i]['intValorTotalCompra'];
				$intOTM = $rpta[$i]['intOTM'];
				$intArancel = $rpta[$i]['intArancel'];
				$intIVA = $rpta[$i]['intIVA'];
				$intDescargues = $rpta[$i]['intDescargues'];
				$intDepositoFranca = $rpta[$i]['intDepositoFranca'];
				$intNaviera = $rpta[$i]['intNaviera'];
				$intTIC = $rpta[$i]['intTIC'];
				$intOtrosUno = $rpta[$i]['intOtrosUno'];
				$intOtrosDos = $rpta[$i]['intOtrosDos'];

				$costosIndirectos = $intOTM+$intArancel+$intIVA+$intDescargues+$intDepositoFranca+$intNaviera+$intTIC+$intOtrosUno+$intOtrosDos;

				$porcentaje = $costosIndirectos / $costoTotal;

				$costoReal = ($rpta[$i]['intValor'] *(($rpta[$i]['intPorcentajeDescuento'] / 100)+1))*(1+$porcentaje);
				$estimado_uno = number_format((($costoReal*(1.5))*1.19));
				$estimado_dos = number_format((($costoReal*(1.1))*(1.5))*1.19);
				
						<td id='estimado1".$i."' style='display:none;'>".$estimado_uno."</td> 
						<td id='estimado2".$i."' style='display:none;'>".$estimado_dos."</td>
				*/

				//nuevo dos columnas 	intCantidadM y strUnidadMedidaM
				if ($rpta[$i]['strReferenciaM'] == "") {
					$rpta[$i]['strReferenciaM'] = $rpta[$i]['strReferencia'];
				}
				$id = $rpta[$i]['intIdDetalle'];
				$view.="
					<tr>
						<td id='referenciaM".$id."'>".$rpta[$i]['strReferenciaM']."</td>
						<td id='strRaggi".$id."'>".$rpta[$i]['strRaggi']."</td>
						<td id='iddescripcion".$id."'>".$rpta[$i]['strDescripcion']."</td>
                        <td id='intPrecio1".$id."'>".number_format($rpta[$i]['intPrecio1'])."</td>      
                        <td id='intPrecio2".$id."'>".number_format($rpta[$i]['intPrecio2'])."</td>                                         
                        <td id='intPrecio3".$id."'>".number_format($rpta[$i]['intPrecio3'])."</td>   
                        <td id='intPrecio4".$id."'>".number_format($rpta[$i]['intPrecio4'])."</td>   
                        <td id='intPrecio5".$id."'>".number_format($rpta[$i]['intPrecio5'])."</td>
                        <td id='strDimension".$id."' style='display:none;'>".$rpta[$i]['strDimesion']."</td>
                        <td id='intCxU".$id."' style='display:none;'>".$rpta[$i]['intCxU']."</td>
                        <td id='idCantidad".$id."' style='display:none;'>".$rpta[$i]['intCantidad']."</td>
						<td style='display: none;' id='cantidadM".$id."'>".$rpta[$i]['intCantidadM']."</td>
						<td style='display: none;' id='unidadMedidaM".$id."'>".$rpta[$i]['strUnidadMedidaM']."</td>
						<td style='display: none;' id='idreferencia".$id."'>".$rpta[$i]['strReferencia']."</td>
						<td style='display: none;' id='intCantidadPaca".$id."'>".$rpta[$i]['intCantidadPaca']."</td>
						<td style='display: none;' id='strMaterial".$id."'>".$rpta[$i]['strMaterial']."</td>
						<td style='display: none;' id='strObservacion".$id."'>".$rpta[$i]['strObservacion']."</td>
						<td style='display: none;' id='strSexo".$id."'>".$rpta[$i]['strSexo']."</td>
						<td style='display: none;' id='strMarca".$id."'>".$rpta[$i]['strMarca']."</td>


                        <td class='bg-success' style='color:#000;'>Para Sticker</td>
                        <td id='idunidadMedida".$id."' style='display:none;'>".strtoupper($rpta[$i]['strUnidadMedida'])."</td> 
                        <td><input type='button' value='Modificar' placeholder='0'   class='btn btn-primary' onclick='ActuralizarReferenciasLiquidadas(".$id.");'/> </td>  
					</tr>		


				";
			}
		}else{
			$view.="No hay informacion";
		}
		echo $view;
		//var_dump($rpta); //validar cuando esten los registros para mostrar la tabla
	}
	public function IngresarPreciosDetalleCompra($idDetalle, $txtPrecioUno, $txtPrecioDos, $txtPrecioTres, $txtPrecioCuatro, $txtPrecioCinco,  $txtReferencia,  $txtDescripcion, $txtDimension, $txtCxU, $txtUnidadMedida, $txtCantidadContenedor, $txtCantidadPaca, $txtMaterial, $txtObservacion , $txtSexo, $txtMarca)
	{
		$clsComprasModel = new clsComprasModel();
		$replace = array(",",".");
		$txtPrecioUno = str_replace($replace, "", $txtPrecioUno);
		$txtPrecioDos = str_replace($replace, "", $txtPrecioDos);
		$txtPrecioTres = str_replace($replace, "", $txtPrecioTres);
		$txtPrecioCuatro = str_replace($replace, "", $txtPrecioCuatro);
		$txtPrecioCinco = str_replace($replace, "", $txtPrecioCinco);

		$clsComprasModel->ActualizarRefDetalleCompra($txtReferencia, $txtDescripcion, $txtPrecioUno, $txtPrecioDos, $txtPrecioTres, $txtPrecioCuatro, $txtPrecioCinco, $idDetalle, 2, $txtDimension, $txtCxU, $txtUnidadMedida, $txtCantidadContenedor,$txtCantidadPaca, $txtMaterial, $txtObservacion , $txtSexo, $txtMarca);
		
		echo $clsComprasModel->GetRpta();
	}

	public function ConsultarPrecios($precio1, $udm)	
	{
		$view = "";
		if ($udm != 'doc') {
			$udm = 1;
		}else{
			$udm = 0;
		}

		$clsComprasModel = new clsComprasModel();
		$rpta = $clsComprasModel->ConsultarPrecios($precio1, $udm);
		if (!empty($rpta)) {
			$view = "<div id='precio2'>".$rpta[0]['intPrecio2']."</div>
					 <div id='precio3'>".$rpta[0]['intPrecio3']."</div>";
		}
		echo $view;
	}

	//Consultar a la bd del hgi los productos
	public function constprodhgi(){
		$referencia = $_POST['referencia'];
		$objWsProducto = new clsProductoWebService();
		$objWsProducto->ConsultarPrecios($referencia);
		$rpta = $objWsProducto->GetRespuestaWs();
		$rpta = json_decode(($rpta),true);
		$view='';

		if($rpta == null){
			$view = "<strong>REFERENCIA NUEVA, NO EXISTE INFORMACION. </strong>";
		}else{
			$view = "
			<td>".$rpta[0]['StrIdProducto']."</td>
			<td>".$rpta[0]['StrDescripcion']."</td>
			<td>".(substr($rpta[0]['IntPrecio1'],0,-6))."</td>
			<td>".(substr($rpta[0]['IntPrecio2'],0,-6))."</td>
			<td>".(substr($rpta[0]['IntPrecio3'],0,-6))."</td>
			<td>".(substr($rpta[0]['IntPrecio4'],0,-6))."</td>
			<td>".(substr($rpta[0]['IntPrecio5'],0,-6))."</td>
			<td>".$rpta[0]['StrParam3']."</td>
			<td>".$rpta[0]['StrUnidad']."</td>
			<td>".$rpta[0]['Material']."</td>
			<td>".$rpta[0]['Marca']."</td>
			<td>".$rpta[0]['Sexo']."</td>
			<td>".$rpta[0]['Linea']."</td>
			<td>".$rpta[0]['Clase']."</td>
			<td>".$rpta[0]['Grupo']."</td>
			<td>".$rpta[0]['Tipo']."</td>
			
			

		";
		}


		echo $view;
		
	}
}

 ?>