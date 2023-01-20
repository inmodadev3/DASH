<?php 
include_once("../Model/clsComprasModel.php");
include_once("../Model/clsEstadosModel.php");
include_once('../Classes/PHPExcel.php');
$clsComprasController = new clsComprasController();
/*Vista: RegistrarCompras*/
if (isset($_POST['btnConsultarReferencias'])) {
	$clsComprasController->ConsultarReferencias();
}
if (isset($_POST['btnRegistrarDocumento'])) {
	$clsComprasController->RegistrarDocumento($_POST["importacion"], $_POST["Raggi"], $_POST["txtTRM"], $_POST["txtOTM"], $_POST["txtArancel"], $_POST["txtIVA"], $_POST["txtDescargues"], $_POST["txtDeposito"], $_POST["txtNaviera"], $_POST["txtTIC"], $_POST["txtOtrosUno"], $_POST["txtOtrosDos"], $_POST["TRMChk"], $_POST["chkOTMUSD"], $_POST["chkOTMSUP"], $_POST["chkArancelUSD"], $_POST["chkArancelSUP"], $_POST["chkIVAUSD"], $_POST["chkIVASUP"], $_POST["chkDescarguesUSD"], $_POST["chkDescarguesSUP"], $_POST["chkDepositoUSD"], $_POST["chkDepositoSUP"], $_POST["chkNavieraUSD"], $_POST["chkNavieraSUP"], $_POST["chkTICUSD"], $_POST["chkTICSUP"], $_POST["chkOtrosUnoUSD"], $_POST["chkOtrosUnoSUP"], $_POST["chkOtrosDosUSD"], $_POST["chkOtrosDosSUP"], $_POST["txtPorcentaje"], $_POST["fileName"]);
}
if (isset($_POST['btnRegistrarReferencias'])) {
	$clsComprasController->RegistrarReferencias();
}
/*Vista: RegistrarCompras*/

/*Vista: Estados*/
if (isset($_POST['btnCargarReferenciasTerminadas'])) {
	$clsComprasController->CargarReferenciasTerminadas($_POST['estado']);
}
if (isset($_POST['accionFiltrar'])) {
	$clsComprasController->FiltrarInformacion($_POST['text'], $_POST['estado']);
}
/*Vista: Estados*/


class clsComprasController{
	
	
	private $strReferencia;
	private $strDescripcion;
	private $intPrecioUno;
	private $intPrecioDos;
	private $intPrecioTres;
	private $intPrecioCuatro;
	private $intIDRefencia;


	public function __construct(){
			$this->strReferencia="";
			$this->strDescripcion="";
			$this->intPrecioUno=0;
			$this->intPrecioDos=0;
			$this->intPrecioTres=0;
			$this->intPrecioCuatro=0;
			$this->intIDReferencia=0;

	}

	public function ConsultarReferencias()
	{
		$view="";
		$clsComprasModel = new clsComprasModel();
		$rpta = $clsComprasModel->consultarDetalleCompra(1);
		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 
				//echo $rpta[$i]['intIdDetalle']."<br>";
				//".$rpta[$i]['intEstado']."
				$view.="
					<tr>
						<td>".$rpta[$i]['intIdDetalle']."</td>
						<td>".$rpta[$i]['strRaggi']."</td>
						<td>".$rpta[$i]['strCaja']."</td>
						<td>".$rpta[$i]['strReferencia']."</td>
						<td>".$rpta[$i]['strDescripcion']."</td>
						<td>".$rpta[$i]['intCantidad']."</td>
						<td>".$rpta[$i]['strUnidadMedida']."</td>
						<td>".$rpta[$i]['intValor']."</td>	 
						<td class='bg-success' style='color:#000;' >Para liquidar</td>	     
					</tr>		


				";
			}
		}else{
			$view.="No hay informacion";
		}
		echo $view;
	}

	public function RegistrarReferencias()
	{
		$rta = 1;
		$clsComprasModel = new clsComprasModel();
		if(@isset($_FILES['File'])){
			$location="../ArchivosCompras/";
			$filename= $_FILES['File']['name'];
			if (!empty($filename)) {
				if (move_uploaded_file($_FILES['File']['tmp_name'], $location.date("d-m-Y").$filename)) {
					$inputFileType = PHPExcel_IOFactory::identify($location.date("d-m-Y").$filename);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($location.date("d-m-Y").$filename);
					$sheet = $objPHPExcel->getSheet(0); 
					$highestRow = $sheet->getHighestRow(); 
					$highestColumn = $sheet->getHighestColumn();

		            if(($objPHPExcel->getActiveSheet()->getCell('B'.'2')->getCalculatedValue())==""){
		             		echo "esta vacio";
		                    
		            }else{
		             	$clsComprasModel = new clsComprasModel();
		             	$valor = str_replace(",", "", $_POST["txtTRM"]);
		             	$valor = str_replace(".", "", $valor);
						for ($row = 2; $row <= $highestRow; $row++){ 
							$caja = trim($sheet->getCell("A".$row)->getValue());
							$referencia = trim($sheet->getCell("B".$row)->getValue());
							$costo = trim($sheet->getCell("F".$row)->getValue());
							if ($referencia != "" && $costo != ""){
								$descripcion =trim(str_replace('"', '', $sheet->getCell("C".$row)->getValue()));
								$cantidad = trim($sheet->getCell("D".$row)->getValue());
								$unidadMedida = trim(str_replace('"','',$sheet->getCell("E".$row)->getValue()));

								//nuevo
								$color = $sheet->getCell("G".$row)->getValue();
								$cxu = $sheet->getCell("I".$row)->getValue();
								$dimension = $sheet->getCell("H".$row)->getValue();
								$estilo = $sheet->getCell("J".$row)->getValue();
								$cantidadPaca = $sheet->getCell("K".$row)->getValue();
								$material= $sheet->getCell("L".$row)->getValue();
								
								//nuevo

								//$costo = $sheet->getCell("F".$row)->getValue();
								$costo = str_replace("$", "", $costo);
								if($_POST["TRMChk"] == 'true'){

									$costo = $costo*$valor;
									
								}

								$rpta = $clsComprasModel->registrarReferencias($caja,$referencia,$cantidad,$unidadMedida,$costo,$descripcion, 1, $color, $cxu, $dimension, $estilo,$cantidadPaca,$material);
								var_dump($rpta);
								
								if (!$rpta) {
									$rta = 0;
								}
							}else{
								$row = $highestRow + 1;
							}
						}

		            }	
				}
			}
				
					
		}else{
			echo "fail";
		}
		echo $rta;
	}

	public function RegistrarDocumento($importacion, $Raggi, $txtTRM, $txtOTM, $txtArancel, $txtIVA, $txtDescargues, $txtDeposito, $txtNaviera, $txtTIC, $txtOtrosUno, $txtOtrosDos,  $TRMChk, $chkOTMUSD, $chkOTMSUP, $chkArancelUSD, $chkArancelSUP, $chkIVAUSD, $chkIVASUP, $chkDescarguesUSD, $chkDescarguesSUP, $chkDepositoUSD, $chkDepositoSUP, $chkNavieraUSD, $chkNavieraSUP, $chkTICUSD, $chkTICSUP, $chkOtrosUnoUSD, $chkOtrosUnoSUP, $chkOtrosDosUSD, $chkOtrosDosSUP, $txtPorcentaje, $fileName){

		$arrayCheckedSup = array($chkOTMSUP, 
						$chkArancelSUP, 
						$chkIVASUP, 
						$chkDescarguesSUP, 
						$chkDepositoSUP, 
						$chkNavieraSUP, 
						$chkTICSUP, 
						$chkOtrosUnoSUP,
						$chkOtrosDosSUP);
		$ArrayCombertir= Array( $txtOTM, $txtArancel, $txtIVA, $txtDescargues, $txtDeposito, $txtNaviera, $txtTIC, $txtOtrosUno, $txtOtrosDos);
		if ($txtTRM != "") {
			$txtTRM = str_replace(",", "", $txtTRM);
			$arrayVariables= Array("txtOTM","txtArancel","txtIVA","txtDescargues","txtDeposito","txtNaviera","txtTIC","txtOtrosUno","txtOtrosDos");
			$arrayChecked = array($chkOTMUSD,
							$chkArancelUSD, 
							$chkIVAUSD,
							$chkDescarguesUSD,	
							$chkDepositoUSD, 
							$chkNavieraUSD, 
							$chkTICUSD, 
							$chkOtrosUnoUSD,
							$chkOtrosDosUSD);

			for($i=0;$i<=8;$i++){
				 if($ArrayCombertir[$i]!="" && @$arrayChecked[$i]){
				 	$ArrayCombertir[$i] *= $txtTRM; 
				 	//$compra->__SET($arrayVariables[$i],($ArrayCombertir[$i]*$_POST["txtTRM"]));
				 }
			}

		}
		/*for ($i=0; $i < sizeof($arrayCheckedSup); $i++) { 
			$n = $arrayCheckedSup[$i];
			//echo $n;
			if ($n) {
				$arrayCheckedSup[$i] = 1;
			}else{
				$arrayCheckedSup[$i] = 0;
			}
		}*/
		/*echo $Raggi." ".$importacion." ".$txtTRM." ".$txtOTM." ".$chkOTMUSD." ".$chkOTMSUP." ".$txtArancel." ".$chkArancelUSD." ".$chkArancelSUP." ".$txtIVA." ".$chkIVAUSD." ".$chkIVASUP." ".$txtDescargues." ".$chkDescarguesUSD." ".$chkDescarguesSUP." ".$txtDeposito." ".$chkDepositoUSD." ".$chkDepositoSUP." ".$txtNaviera." ".$chkNavieraUSD." ".$chkNavieraSUP." ".$txtTIC." ".$chkTICUSD." ".$chkTICSUP." ".$txtOtrosUno." ".$chkOtrosUnoUSD." ".$chkOtrosUnoSUP." ".$txtOtrosDos." ".$chkOtrosDosUSD." ".$chkOtrosDosSUP." ".$txtPorcentaje;*/
		$clsComprasModel = new clsComprasModel();
		$rpta = $clsComprasModel->registrarCompra($Raggi, $importacion, $txtTRM, $ArrayCombertir[0], $chkOTMUSD, $chkOTMSUP, $ArrayCombertir[1], $chkArancelUSD, $chkArancelSUP, $ArrayCombertir[2], $chkIVAUSD, $chkIVASUP, $ArrayCombertir[3], $chkDescarguesUSD, $chkDescarguesSUP, $ArrayCombertir[4], $chkDepositoUSD, $chkDepositoSUP,  $ArrayCombertir[5], $chkNavieraUSD, $chkNavieraSUP,  $ArrayCombertir[6], $chkTICUSD, $chkTICSUP, $ArrayCombertir[7], $chkOtrosUnoUSD, $chkOtrosUnoSUP, $ArrayCombertir[8], $chkOtrosDosUSD, $chkOtrosDosSUP, $txtPorcentaje);
		//var_dump($rpta);
		echo $rpta;
	}

	/*-------------------------------------------Metodos para la vista Estados*/
	public function FiltrarInformacion($text,  $estado)
	{
		$view="";
		$clsEstadosModel = new clsEstadosModelo();
		$rpta = $clsEstadosModel->filtrarInformacionCompras($text, $estado);
		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 
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


                        <td id='idunidadMedida".$id."' style='display:none;'>".strtoupper($rpta[$i]['strUnidadMedida'])."</td> 
					</tr>		


				";
			}
		}else{
			$view.="No hay informacion";
		}
		echo $view;
	}

	public function CargarReferenciasTerminadas($estado)
	{
		$view="";
		$clsComprasModel = new clsComprasModel();
		$rpta = $clsComprasModel->consultarDetalleCompra($estado);
		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 
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

                        <td id='idunidadMedida".$id."' style='display:none;'>".strtoupper($rpta[$i]['strUnidadMedida'])."</td>
					</tr>		


				";
			}
		}else{
			$view.="No hay informacion";
		}
		echo $view;
	}
	/*-------------------------------------------Metodos para la vista Estados*/
}