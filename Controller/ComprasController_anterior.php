<?php 
include_once("../Model/clsComprasModel.php");
include_once('../Classes/PHPExcel.php');
$clsComprasController = new clsComprasController();

if (isset($_POST['btnConsultarReferencias'])) {
	
	$clsComprasController->ConsultarReferencias();
}
if (isset($_POST['btnRegistrarDocumento'])) {
	//echo $_POST['chkOTMUSD'];
	$clsComprasController->RegistrarDocumento($_POST["importacion"], $_POST["Raggi"], $_POST["txtTRM"], $_POST["txtOTM"], $_POST["txtArancel"], $_POST["txtIVA"], $_POST["txtDescargues"], $_POST["txtDeposito"], $_POST["txtNaviera"], $_POST["txtTIC"], $_POST["txtOtrosUno"], $_POST["txtOtrosDos"], $_POST["TRMChk"], $_POST["chkOTMUSD"], $_POST["chkOTMSUP"], $_POST["chkArancelUSD"], $_POST["chkArancelSUP"], $_POST["chkIVAUSD"], $_POST["chkIVASUP"], $_POST["chkDescarguesUSD"], $_POST["chkDescarguesSUP"], $_POST["chkDepositoUSD"], $_POST["chkDepositoSUP"], $_POST["chkNavieraUSD"], $_POST["chkNavieraSUP"], $_POST["chkTICUSD"], $_POST["chkTICSUP"], $_POST["chkOtrosUnoUSD"], $_POST["chkOtrosUnoSUP"], $_POST["chkOtrosDosUSD"], $_POST["chkOtrosDosSUP"], $_POST["txtPorcentaje"], $_POST["fileName"]);
}
if (isset($_POST['btnRegistrarReferencias'])) {
	
	$clsComprasController->RegistrarReferencias();
}

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
		//var_dump($rpta); //validar cuando esten los registros para mostrar la tabla
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
							$caja = $sheet->getCell("A".$row)->getValue();
							$referencia = $sheet->getCell("B".$row)->getValue();
							$costo = $sheet->getCell("F".$row)->getValue();
							if ($referencia != "" && $costo != ""){
								$descripcion = $sheet->getCell("C".$row)->getValue();
								$cantidad = $sheet->getCell("D".$row)->getValue();
								$unidadMedida = $sheet->getCell("E".$row)->getValue();

								//nuevo
								$color = $sheet->getCell("G".$row)->getValue();
								$cxu = $sheet->getCell("I".$row)->getValue();
								$dimension = $sheet->getCell("H".$row)->getValue();
								$estilo = $sheet->getCell("J".$row)->getValue();
								
								//nuevo

								//$costo = $sheet->getCell("F".$row)->getValue();
								$costo = str_replace("$", "", $costo);
								if($_POST["TRMChk"] == 'true'){
									$costo = $costo*$valor;
								}


								$rpta = $clsComprasModel->registrarReferencias($caja,$referencia,$cantidad,$unidadMedida,$costo,$descripcion, 1, $color, $cxu, $dimension, $estilo);
								//var_dump($rpta);
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















	public function ValidarImportacion(){
		//$compra = new Compras();
		$compra->__SET("importacion", $_POST["importacion"]);
		$valor= $compra->ValidarImportacion();
		/*foreach ($valor as $key => $value): 
	           $valor=$value->Respuesta;
	   		 endforeach; 		 
				if($valor=="0"){
					
					echo "Ya existe la importacion.";
					exit();
				}else{
					echo "1";
				}*/
	}


	public function ActualizarCompra() {
		$compra = new Compras();		
	/*	if(!isset($_POST['moveFile'])){				
			$resultado = $compra->consultarRegistros();
			require APP . 'view/_templates/header.php';
			require APP . 'view/compras/registrarCompras.php';
			require APP . 'view/_templates/footer.php';
			exit();
		} 	 	*/	
		require APP.'Classes/PHPExcel/IOFactory.php';		
		$array = array("chkOTMUSD","chkOTMSUP", 
						"chkArancelUSD", "chkArancelSUP", 
						"chkIVAUSD", "chkIVASUP", 
						"chkDescarguesUSD",	"chkDescarguesSUP", 
						"chkDepositoUSD", "chkDepositoSUP", 
						"chkNavieraUSD", "chkNavieraSUP", 
						"chkTICUSD", "chkTICSUP", 
						"chkOtrosUnoUSD", "chkOtrosUnoSUP",
						"chkOtrosDosUSD", "chkOtrosDosSUP");

		if($_POST["txtTRM"]==""){		
		
				
				$compra->__SET("txtOTM", $_POST["txtOTM"]);
				$compra->__SET("txtArancel", $_POST["txtArancel"]);
				$compra->__SET("txtIVA", $_POST["txtIVA"]);
				$compra->__SET("txtDescargues", $_POST["txtDescargues"]);
				$compra->__SET("txtDeposito", $_POST["txtDeposito"]);
				$compra->__SET("txtNaviera", $_POST["txtNaviera"]);
				$compra->__SET("txtTIC", $_POST["txtTIC"]);
				$compra->__SET("txtOtrosUno", $_POST["txtOtrosUno"]);
				$compra->__SET("txtOtrosDos", $_POST["txtOtrosDos"]);

		}else{
				$ArrayCombertir= Array( $_POST["txtOTM"], $_POST["txtArancel"], $_POST["txtIVA"], $_POST["txtDescargues"], 
				$_POST["txtDeposito"], $_POST["txtNaviera"], $_POST["txtTIC"], $_POST["txtOtrosUno"], $_POST["txtOtrosDos"]);
				$arrayVariables= Array("txtOTM","txtArancel","txtIVA","txtDescargues","txtDeposito","txtNaviera","txtTIC","txtOtrosUno","txtOtrosDos");
				$arrayChecked = array("chkOTMUSD",
								"chkArancelUSD", 
								"chkIVAUSD",
								"chkDescarguesUSD",	
								"chkDepositoUSD", 
								"chkNavieraUSD", 
								"chkTICUSD", 
								"chkOtrosUnoUSD",
								"chkOtrosDosUSD");

				for($i=0;$i<=8;$i++){
					 if($ArrayCombertir[$i]!="" && @$_POST[$arrayChecked[$i]]){
					 	$compra->__SET($arrayVariables[$i],($ArrayCombertir[$i]*$_POST["txtTRM"]));
					 }else{
					 	$compra->__SET($arrayVariables[$i],$ArrayCombertir[$i]);
					 }
				}
		}

		$compra->__SET("importacion", $_POST["importacion"]);
		$compra->__SET("documentoReferencia", $_POST["docReferencia"]);
		$compra->__SET("txtTRM", $_POST["txtTRM"]);
		$compra->__SET("intPorcentaje",$_POST["txtPorcentaje"]);
		
		for ($i=0; $i <= 17; $i++) { 
			@$numero= $_POST[$array[$i]];
			if ($numero){
				$numero=1;
				$compra->__SET($array[$i],$numero);										
			}else{
				$numero=0;
				$compra->__SET($array[$i],$numero);
			}
		}					
			if(isset($_POST['moveFile'])){
				$filename= $_FILES['fileName']['name'];
				$file_tmp= $_FILES['fileName']['tmp_name'];
			}
			$time = time();
			if(isset($filename)){
				if(!empty($filename)){
					$location="myfile/";
					if(move_uploaded_file($file_tmp, $location.date("d-m-Y").$filename))
					{					
								$_SESSION["mensaje"]= "
			                             $.notify({ message:'Documento cargado.'  },{
			                           type: 'success',
			                            placement: {
			                            from: 'top',
			                             align: 'right'
			                                        },
			                                    });    
			            ";

			        
												//$compra= new Compras();															
						$objPHPExcel= PHPEXCEL_IOFactory::load($location.date("d-m-Y").$filename);
						$objPHPExcel->setActiveSheetIndex(0);
						$numeroFilas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
			            if(($objPHPExcel->getActiveSheet()->getCell('A'.'2')->getCalculatedValue())==""){
			             		$_SESSION["mensaje"]= "
			                             $.notify({ message:'El documento esta vacio.'  },{
			                           type: 'danger',
			                            placement: {
			                            from: 'top',
			                             align: 'right'
			                                        },
			                                    });";
			                    $resultado = $compra->consultarRegistros();
					            require APP . 'view/_templates/header.php';
								require APP . 'view/compras/registrarCompras.php';
								require APP . 'view/_templates/footer.php';
								exit();
			             }   
			            $respuesta=$compra->registrarCompra();      
						for ($i=2; $i <=$numeroFilas; $i++) { 	
							$compra->__SET("caja",$caja = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue());			
							$compra->__SET("referencia", $referencia=$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue());


							$compra->__SET("descripcion",$descripcion = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue());


							$compra->__SET("cantidad",$cantidad = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue());

							if($_POST["txtTRM"]!=""){
							
							$compra->__SET("costo",($costo = ($objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue()))*$_POST["txtTRM"]);

							}else{
								
	//remplace . por ""	var_dump($objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue());
								
								$compra->__SET("costo",$costo =(str_replace(".","",($objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue())) ));

							}

							$compra->__SET("strUnidadMedida",$strUnidadMedida = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue());
							$compra->registrarReferencias();
							$compra->RegistrarDetalleReferencia();						
						}
					}
								$resultado = $compra->consultarRegistros();
								require APP . 'view/_templates/header.php';
								require APP . 'view/compras/registrarCompras.php';
								require APP . 'view/_templates/footer.php';
								exit();
				}else{
					
					$_SESSION["mensaje"]= "
						                 $.notify({ message:'No selecciono el documento.'  },{
						                 type: 'danger',
						                  placement: {
						                 from: 'top',
						                 align: 'right'
						                   },
						                   });";					

				}
			}else{
				$_SESSION["mensaje"]= "
                 $.notify({ message:'Documento Vacio.'  },{
                 type: 'danger',
                 placement: {
                 from: 'top',
                 align: 'right'
                  },
                });    
            ";
				}
	
		$resultado = $compra->consultarRegistros();
		require APP . 'view/_templates/header.php';
		require APP . 'view/compras/registrarCompras.php';
		require APP . 'view/_templates/footer.php';	

		
	
	}






	public function Consultar(){
		$compra = new Compras();
		if(isset($_POST["txtIDReferencia"])){
			$this->ActuarlizarReferencias();
			$resultadorReferenciaSticker= $compra->consultarReferenciasPorSticker();
			}	

		$resultadoReferencias= $compra->consultarRegistros();
		$resultadoDocumento=$compra->ConsultarValorTotalDocumento();
		$resultadoImportacion=$compra->ConsultarValorTotalImportacion();
		$resultadorReferenciaSticker= $compra->consultarReferenciasPorSticker();
		//$registros = $compra->consultarDetallesReferencias();	

		require APP . 'view/_templates/header.php';					
		require APP . 'view/compras/vistaAuxiliar.php';			
        require APP . 'view/_templates/footer.php';	

		
	}


	private function Validar($Tipo){

	switch($Tipo){
	 case "Actualizar Referencia":

				if($this->strReferencia==""){
					$_SESSION["mensaje"]= "
		                 $.notify({ message:'Ingrese referencia.'  },{
		                 type: 'danger',
		                 placement: {
		                 from: 'top',
		                 align: 'right'
		                  },
		                });    
		            ";
					return false;
				}
				if($this->strDescripcion==""){
					$_SESSION["mensaje"]= "
		                 $.notify({ message:'Ingrese Descripcion.'  },{
		                 type: 'danger',
		                 placement: {
		                 from: 'top',
		                 align: 'right'
		                  },
		                });    
		            ";
			            return false;
				}
				if($this->intPrecioUno==0){
				$_SESSION["mensaje"]= "
	                 $.notify({ message:'Ingrese Precio Uno.'  },{
	                 type: 'danger',
	                 placement: {
	                 from: 'top',
	                 align: 'right'
	                  },
	                });    
	            ";
			            return false;
				}
				if($this->intPrecioDos==0){
					$_SESSION["mensaje"]= "
		                 $.notify({ message:'Ingrese Precio Dos'  },{
		                 type: 'danger',
		                 placement: {
		                 from: 'top',
		                 align: 'right'
		                  },
		                });    
		            ";
			            return false;
				}
				if($this->intPrecioTres==0){
					$_SESSION["mensaje"]= "
		                 $.notify({ message:'Ingrese Precio Tres.'  },{
		                 type: 'danger',
		                 placement: {
		                 from: 'top',
		                 align: 'right'
		                  },
		                });    
		            ";	
			            return false;
				}
				if($this->intPrecioCuatro==0){
					$_SESSION["mensaje"]= "
		                 $.notify({ message:'Ingrese Precio Cuatro.'  },{
		                 type: 'danger',
		                 placement: {
		                 from: 'top',
		                 align: 'right'
		                  },
		                });    
		            ";
			            return false;
				}
				if(!is_numeric($this->intPrecioUno)){
					$_SESSION["mensaje"]= "
		                 $.notify({ message:'Ingrese solo numeros en Precio Uno.'  },{
		                 type: 'danger',
		                 placement: {
		                 from: 'top',
		                 align: 'right'
		                  },
		                });    
		            ";
			            return false;
				}
				if(!is_numeric($this->intPrecioDos)){
					$_SESSION["mensaje"]= "
		                 $.notify({ message:'Ingrese solo numeros en Precio Dos.'  },{
		                 type: 'danger',
		                 placement: {
		                 from: 'top',
		                 align: 'right'
		                  },
		                });    
		            "; 
			            return false;
				}
				if(!is_numeric($this->intPrecioTres)){
					$_SESSION["mensaje"]= "
		                 $.notify({ message:'Ingrese solo numeros en Precio Tres.'  },{
		                 type: 'danger',
		                 placement: {
		                 from: 'top',
		                 align: 'right'
		                  },
		                });    
		            ";
			            return false;
				}
				if(!is_numeric($this->intPrecioCuatro)){
					$_SESSION["mensaje"]= "
		                 $.notify({ message:'Ingrese solo numeros en Precio Cuatro.'  },{
		                 type: 'danger',
		                 placement: {
		                 from: 'top',
		                 align: 'right'
		                  },
		                });    
		            "; 
			            return false;
				}
			}

		return true;
	}
	public function ActuarlizarReferencias(){
 		$this->strReferencia=trim($_POST["txtReferencia"]);
 		$this->strDescripcion=trim($_POST["txtDescripcion"]);
 		$this->intPrecioUno=trim($_POST["txtPrecioUno"]);
 		$this->intPrecioDos=trim($_POST["txtPrecioDos"]);
 		$this->intPrecioTres=trim($_POST["txtPrecioTres"]);
 		$this->intPrecioCuatro=trim($_POST["txtPrecioCuatro"]);
 		$this->intIDReferencia=trim($_POST["txtIDReferencia"]);
		if(!$this->Validar("Actualizar Referencia")){
		return;
		}
		$Compras = new Compras();
		
		$Respuesta=$Compras->ActualizarReferenciaBD($this->strReferencia,$this->strDescripcion,$this->intPrecioUno,$this->intPrecioDos,$this->intPrecioTres,$this->intPrecioCuatro,$this->intIDReferencia);

		$_SESSION["mensaje"]= "
		                 $.notify({ message:'procesio exitoso.' },{
		                 type: 'success',
		                 placement: {
		                 from: 'top',
		                 align: 'right'
		                  },
		                });    
		            "; 		
	}
}