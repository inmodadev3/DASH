<?php
date_default_timezone_set('America/Bogota');
include_once ("../Model/clsVendedoresModel.php");
include_once ("../WebServices/clsCarteraWebService.php");
$objCartera= new clsCarteraController();
if(isset($_POST['btnGenerarExcel'])){
$objCartera->GenerarExcel();
}
if(isset($_POST['btnListarCartera'])){
$objCartera->ListarCarteraTercero();
}
if(isset($_POST['btnPintarEstructuraPorVendedor'])){
$objCartera->CrearEstructuraGrafica('CarteraPorVendedor','CarteraPorVendedorResult','inforGeneralPorVendedor');
}
if(isset($_POST['btnJsInformeVendedor'])){
$objCartera->CarteraPorVendedorGrafica('CarteraPorVendedor','CarteraPorVendedorResult','inforGeneralPorVendedor');
}
if(isset($_POST['btnPintarEstructuraPorCiudad'])){
$objCartera->CrearEstructuraGrafica('CarteraPorCiudad','CarteraPorCiudadResult','inforGeneralPorCiudad');
}
if(isset($_POST['btnJsInformeCiudad'])){
$objCartera->CarteraPorVendedorGrafica('CarteraPorCiudad','CarteraPorCiudadResult','inforGeneralPorCiudad');
}
if(isset($_POST['btnBuscarTercero'])){
$objCartera->BuscarTerceroCartera();
}
$objCartera=null;
class clsCarteraController
{	private $UrlWebService;
	private $intCompania;
	function __construct()
	{
	 $this->UrlWebService="http://10.10.10.150/webservice/WebModaService.asmx?WSDL";
	 $this->intCompania='';		
	}
	public function ConsultarWebService($Tipo){
			
			$client = new SoapClient($this->UrlWebService);
			$parametros=array();
			$parametros['Cia']=$this->intCompania;
			$parametros['Vendedor']="''";
			$parametros['TipoV']="''";
			$WebService=$client->$Tipo($parametros);
			$client=null;
		  	return	$WebService;
	}
	/*----------------------------VISTA CARTERA--------------------------------*/
	/*Listar cartera tercero*/
	public function ListarCarteraTercero(){
		$this->intCompania=trim($_POST['intCompania']);
		$strCiudad=trim("'".$_POST['strCiudad']."'");
		$objCarteraWebService= new clsCarteraWebService();
		$objCarteraWebService->CarteraGeneral($this->intCompania,true,$strCiudad);
		$strRespuestaWs=json_decode($objCarteraWebService->GetRespuestaWs());
		$this->TipoDeHTML('Table',$strRespuestaWs);	
	}
	//Busqueda del tercero con cartera like
	public function BuscarTerceroCartera(){
		$this->intCompania=trim($_POST['intCompania']);
		$strNombre=trim($_POST['strNombreTercero']);
		$strCiudad=trim("'".$_POST['strCiudad']."'");
		$objCarteraWebService= new clsCarteraWebService();
		$objCarteraWebService->BuscarTerceroCartera($this->intCompania,$strNombre,$strCiudad);
		$strRespuestaWs=json_decode($objCarteraWebService->GetRespuestaWs());
		$this->TipoDeHTML('Table',$strRespuestaWs);
	}
	/* Metodo para pintar tipo de HTML*/
	public function TipoDeHTML($strTipo,$strRespuestaWs){
		$strHTML='';
		switch ($strTipo) {
			case 'Table':
				for($i=0;$i<=sizeof($strRespuestaWs)-1;$i++){ 
			   	  	if($strRespuestaWs[$i]->IntTipoTercero=='11'){
			   	  		$strIm="<td style='background:#FFCE97;'>IM</td>";
			   	  	}else{
			   	  		$strIm='<td></td>';
			   	  	}
				  	$strHTML.="<tr><td>".($i+1)."</td><td>".$strRespuestaWs[$i]->StrIdTercero."</td><td>".$strRespuestaWs[$i]->StrNombre."</td><td>".$strRespuestaWs[$i]->IntDocumento."</td><td>".$strRespuestaWs[$i]->DatFecha."</td><td>".$strRespuestaWs[$i]->DatVencimiento."</td><td>".number_format(trim($strRespuestaWs[$i]->IntSaldoF))."</td><td>".$strRespuestaWs[$i]->StrDescripcion."</td><td>".$strRespuestaWs[$i]->IntEdadDoc."</td><td>".$strRespuestaWs[$i]->StrTelefono."</td><td>".$strRespuestaWs[$i]->StrCelular."</td><td>".number_format(trim($strRespuestaWs[$i]->IntCupo))."</td><td>".$strRespuestaWs[$i]->IntPlazo."</td><td>".$strRespuestaWs[$i]->IdVendedor."</td><td>".$strRespuestaWs[$i]->VendedorNombre."</td><td>".$strRespuestaWs[$i]->IntTransaccion."</td>".$strIm."<td>".$strRespuestaWs[$i]->StrDireccion."</td><td>".$strRespuestaWs[$i]->StrDireccion2."</td></tr>"; 
				}
			break;
		}
		echo $strHTML;
	}




	/* Metodo general excel de la cartera de los terceros*/
	public function GenerarExcel()
	{
		require_once '../Classes/PHPExcel.php';
	    $objPHPExcel = new PHPExcel();
	    $objPHPExcel->setActiveSheetIndex(0);

	    $this->intCompania=trim($_POST['intCompania']);
	    $strCiudad=trim($_POST['strCiudad'],",");
		$objCarteraWebService= new clsCarteraWebService();
		$objCarteraWebService->CarteraGeneral($this->intCompania,false,$strCiudad);
		$strRespuestaWs=json_decode($objCarteraWebService->GetRespuestaWs());


	   	$strArrayColumna= array('A1','B1','C1','D1','E1','F1','G1','H1','I1','J1','K1','L1','M1','N1','O1','P1','Q1','R1');
	   	$strArrayDescripcion= array('Cedula Tercero','Nombre','Documento','Fecha Generada','Fecha Vencimiento','Saldo','Ciudad','Tiempo','Telefono','Celular','Cupo','Plazo','Cedula Vendedor','Vendedor','Tipo','Transaccion','Dirección1','Dirección2');
	   	$Estilo1=array(
					        'fill' => array(
					            'type' => PHPExcel_Style_Fill::FILL_SOLID,
					            'color' => array('rgb' => '33BBFF')
					        )
					 );
	    $Estilo2 = array(
					    'font'  => array(
					        'bold'  => true,
					        'fillcolor' => array('rgb' => '#000'),
					        'size'  => 12
					       
					    ));
	   	for($i=0;$i<=15;$i++){	
	    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($strArrayColumna[$i],$strArrayDescripcion[$i]);
	    	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(trim($strArrayColumna[$i],'1'))->setAutoSize(TRUE);
	    	$objPHPExcel->getActiveSheet(0)->getStyle($strArrayColumna[$i])->applyFromArray($Estilo1);
	    	$objPHPExcel->getActiveSheet(0)->getStyle($strArrayColumna[$i])->applyFromArray($Estilo2);
	   	}
	   	    	
	  	$j=2;	 	 
	  	$strIm=''; 	 
	    for ($i=0; $i <=sizeof($strRespuestaWs)-1; $i++) {     	
	  		if($strRespuestaWs[$i]->IntTipoTercero=='11'){
	  			$strIm='IM';
	  		}
	    		$objPHPExcel->setActiveSheetIndex(0)
			      ->setCellValue('A'.$j,trim($strRespuestaWs[$i]->StrIdTercero))
			      ->setCellValue('B'.$j,trim($strRespuestaWs[$i]->StrNombre))
			      ->setCellValue('C'.$j,trim($strRespuestaWs[$i]->IntDocumento))
			      ->setCellValue('D'.$j,trim($strRespuestaWs[$i]->DatFecha))
			      ->setCellValue('E'.$j,trim($strRespuestaWs[$i]->DatVencimiento))
			      ->setCellValue('F'.$j,trim($strRespuestaWs[$i]->IntSaldoF))
			      ->setCellValue('G'.$j,trim($strRespuestaWs[$i]->StrDescripcion))
			      ->setCellValue('H'.$j,trim($strRespuestaWs[$i]->IntEdadDoc))
			      ->setCellValue('I'.$j,trim($strRespuestaWs[$i]->StrTelefono))
			      ->setCellValue('J'.$j,trim($strRespuestaWs[$i]->StrCelular))
			      ->setCellValue('K'.$j,trim($strRespuestaWs[$i]->IntCupo))
			      ->setCellValue('L'.$j,trim($strRespuestaWs[$i]->IntPlazo))
			      ->setCellValue('M'.$j,trim($strRespuestaWs[$i]->IdVendedor))
			      ->setCellValue('N'.$j,trim($strRespuestaWs[$i]->VendedorNombre))
			      ->setCellValue('O'.$j,trim($strIm))
			      ->setCellValue('P'.$j,trim($strRespuestaWs[$i]->IntTransaccion))
			      ->setCellValue('Q'.$j,trim($strRespuestaWs[$i]->StrDireccion))
			      ->setCellValue('R'.$j,trim($strRespuestaWs[$i]->StrDireccion2));
			      $strIm='';
			      $j++;		    	
		}
		$strCompania='Verde';
		if($this->intCompania==1){
			$strCompania='Blanca';
		}
		$objPHPExcel->getActiveSheet(0)->setTitle('Informe Cartera');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$strCompania.'_Informe_Cartera_'.date('Y/m/d').'.xlsx"');
		header('Cache-Control: max-age=0');
		ob_end_clean();
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit();
	}










/* Vista informes  cartera */
	public function CarteraPorVendedorGrafica($WebService,$TipoWebService,$idCanvas){
		$this->intCompania=trim($_POST['intCompania']);
		$ContenidoWebService=$this->ConsultarWebService($WebService);
		session_start();
		$objVendedoresAsociados=new clsVendedoresModel();
	    $objVendedoresAsociados->ConsultarEmpleadosAsociados($_SESSION['idLogin'],'','2');
		$strVendedoresAsociados=$objVendedoresAsociados->GetRespuesta();

		$InformeCartera="";
		$Suma=0.0;
		$Nro="";
		$ColorFondo="";
		$ColorBorder="";
		$k=0;
		$Porcentaje="";
		$blnColor=true;
		$w=0;
		$Contador=0;
		$DatosInforme=explode("%",$ContenidoWebService->$TipoWebService);
		for($i=0;$i<=(sizeof($DatosInforme)-2);$i=$i+3){
		$Suma+=(double)$DatosInforme[$i+2];	
			
		}
		$k=0;
		for($i=0;$i<=(sizeof($DatosInforme)-2);$i=$i+3){
			if($DatosInforme[$i+2] > 0){
			//$Suma+=(double)$DatosInforme[$i+2];	
			$w++;	
			$Porcentaje.=(int)$DatosInforme[$i+2].",";
			$Nro.="'".$k."',";
			if((bool)$blnColor){
				$ColorFondo.= "'rgb(102, 0, 255,0.2)',";
				$ColorBorder.="'rgb(102, 0, 255,0.8)',";
				$blnColor=false;
			}else{
				$blnColor=true;
			    $ColorFondo.= "'rgb(128, 159, 255,0.2)',";
			    $ColorBorder.="'rgb(128, 159, 255,0.8)',";
			}
			if($w==20){
				$Contador++;
				$Porcentaje.="%";
				$Nro.="%";
				$ColorFondo.="%";
				$ColorBorder.="%";
				$w=1;
			}			
			$k++;
			}
		}
		$Rango=explode("%",$Porcentaje);
		$NroCv=explode("%",$Nro);
		$ColorFondoCv=explode("%", $ColorFondo);
		$ColorBorderCv=explode("%", $ColorBorder);
		$blnEstado=true;
		for($i=0;$i<=$Contador;$i++){	
		$InformeCartera.="var Cctx".$i." = document.getElementById('Cv".$idCanvas."".$i."');".
                                    "var myChart = new Chart(Cctx".$i.",{".
                                        "type: 'bar',".
                                        "data: {".
                                            "labels: [".$NroCv[$i]."],".
                                            "datasets: [{";
                                            	if((bool)$blnEstado){
                                            		$InformeCartera.="label: 'Valor en cartera $".number_format($Suma)."',";
                                            		$blnEstado=false;
                                            	}else{
                                            		$InformeCartera.="label: '',";
                                            	}
                                               $InformeCartera.="data: [".$Rango[$i]."],".
                                                "backgroundColor: ["
                                                    .$ColorFondoCv[$i].
                                                "],".
                                                "borderColor: [".
                                                  $ColorBorderCv[$i].
                                                "],".
                                                "borderWidth: 1".
                                            "}]".
                                        "}".
                                    "}); ";
            }                        
			$l=0;
			$blnColor=true;
            for($i=0;$i<=(sizeof($DatosInforme)-2);$i=$i+3){
            	$Porcentaje=((100/$Suma)*(int)$DatosInforme[$i+2]);
			if($DatosInforme[$i+2]!=0){
				 if((bool)$blnColor){
                                    	 $ColorFondo= "'rgb(102, 0, 255,0.2)'";
                                    	 $ColorBorder= "'rgb(102, 0, 255,0.8)'";
                                    	 $blnColor=false;
									}else{
										 $ColorFondo=  "'rgb(128, 159, 255,0.2)'";
										 $ColorBorder=  "'rgb(128, 159, 255,0.8)'";
                                    	 $blnColor=true;
				}
				$InformeCartera.="var Vctx".$i." = document.getElementById('".$idCanvas."".$l."');".
                                    "var myChart = new Chart(Vctx".$i.",{".
                                        "type: 'doughnut',".
                                        "data: {".
                                            "labels: [".(int)$Porcentaje.",'X'],".
                                            "datasets: [{".
                                                "label: 'Valor en cartera $',".
                                                "data: [".$Porcentaje.",".(100-$Porcentaje)." ],".
                                                "backgroundColor: [".$ColorFondo."],".
                                                "borderColor: [".$ColorBorder."],".
                                                "borderWidth: 1".
                                            "}]".
                                        "}".
                                    "});";
                                    $l++;                                
                                    }
		}                        
	        echo $InformeCartera; 
	        $ContenidoWebService=null;
	        $DatosInforme=null;                     
		
	}
	public function CrearEstructuraGrafica($WebService,$TipoWebService,$idCanvas){
		$this->intCompania=trim($_POST['intCompania']);
		$Suma=0;
		$Porcentaje=0;
		$ContenidoWebService=$this->ConsultarWebService($WebService);

		$DatosInforme=explode("%",$ContenidoWebService->$TipoWebService);
		session_start();
		$TablaDatosGrafica='<div>';
		if($WebService=='CarteraPorVendedor'){
		  $objVendedoresAsociados=new clsVendedoresModel();
	      $objVendedoresAsociados->ConsultarEmpleadosAsociados($_SESSION['idLogin'],'','2');
		  $strVendedoresAsociados=$objVendedoresAsociados->GetRespuesta();
		  	if(sizeof($strVendedoresAsociados)==0 && $_SESSION['idLogin']!='1'){
			$TablaDatosGrafica.='<tr><td><h4>No tiene vendedores asociados.</h4></td></tr>';
			}
		}else if($WebService=='CarteraPorCiudad'){
		  $objVendedorModel= new clsVendedoresModel();
		  $objVendedorModel->CiudadesVendedoresAsociados($_SESSION['idLogin']);
	      $strCiudadesAsociadas=$objVendedorModel->GetRespuesta();
	      if(sizeof($strCiudadesAsociadas)==0 && $_SESSION['idLogin']!='1'){
			$TablaDatosGrafica.='<tr><td><h4>No ciudades asociadas los vendedores.</h4></td></tr>';
			}
		}
		$k=0;
		$Contador=0;
		$w=0;

		for($i=0;$i<=(sizeof($DatosInforme)-2);$i=$i+3){
			$blnBandera=false;
			switch ($WebService) {
				case 'CarteraPorVendedor':
					for($j=0;$j<=sizeof($strVendedoresAsociados)-1;$j++){
						if($strVendedoresAsociados[$j]['strCedulaEmpleado']==trim($DatosInforme[$i])){
							$blnBandera=true;
							break;
						}
					}
				break;
				case 'CarteraPorCiudad':
					for($j=0;$j<=sizeof($strCiudadesAsociadas)-1;$j++){
						if($strCiudadesAsociadas[$j]['intIdCiudad']==trim($DatosInforme[$i])){
							$blnBandera=true;
							break;
						}
					}
				break;
			}	
			if($_SESSION['idLogin']=='1'){
				$blnBandera=true;
			}
			
			if($DatosInforme[$i+2]>0){	
			$w++;
			if($blnBandera){
			$TablaDatosGrafica.="<tr><td>".$k."</td><td>".$DatosInforme[$i+1]."</td><td>".number_format((float)$DatosInforme[$i+2])."</td></tr>";
			}

			$k++;
			if($w==20){
				$Contador++;
				$w=1;
			}
			}
		}
		$CantCanvas="<div style='width:100%;'>";
		for($i=0;$i<=$Contador;$i++){
			$CantCanvas.="<canvas id='Cv".$idCanvas."".$i."''></canvas>";
		}
		$CantCanvas.='</div>';
		$Estructura="<div class='row' id='Cont".$idCanvas."'><div class='col-lg-8 col-md-11 col-sm-11 col-xs-11'> <br><div class='row'><div class='col-lg-10'><h3>Cartera</h3></div><div class='col-lg-2'><br><button class='btn btn-default' style='float:left;' onclick='location.reload();'>Actualizar</button></div></div>".$CantCanvas."</div><div class='col-lg-4 col-md-11 col-sm-11 col-xs-12'><br><label style='float:right;'>Ultima actualización: <small>".date('Y-m-d h:i:s')."</small></label><br><br><br><input type='text' id='txt".$idCanvas."' onkeyup='BusquedaTbl(\""."txt".$idCanvas."\",\""."tblN".$idCanvas."\");'  class='form-control' placeholder='Buscar'><br>
                        <div style='overflow:scroll;height:200px;' id='tbl".$idCanvas."'><table class='table table-striped'><thead><th>#</th><th>Vendedor</th><th>Monto</th></thead><tbody id='tblN".$idCanvas."'>".$TablaDatosGrafica."</tbody></table></div></div></div><hr>";  
                        $k=0;
        for($i=0;$i<=(sizeof($DatosInforme)-2);$i=$i+3){
			$Suma+=(float)$DatosInforme[$i+2];
		}	
		$blnFila=true;
		$h=0;
		$x=0;
		for($i=0;$i<((sizeof($DatosInforme)-1));$i=$i+3){
			if($DatosInforme[$i+2]>0){
				$h++;
				if((bool)$blnFila){
					//$Estructura.="<div class='row'>";
					$blnFila=false;
				}
				$Porcentaje=((100/$Suma)*(int)$DatosInforme[$i+2]);
				//$Estructura.="<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12 text-center' style='margin:0px;'> <div class='thumbnail'><small>".($x)."</small><div style='width:75%;margin:auto;'><canvas id='".$idCanvas."".$k."' style='width:90%;'></canvas></div><div class='caption'><small><strong>".$DatosInforme[$i+1]."</strong></small><br><small>$".number_format((int)$DatosInforme[$i+2])."</small><br><label><strong>".(int)$Porcentaje."%</strong></label></div></div></div>";
	                        $k++;
	            if($h==4){
	            	//$Estructura.="</div><hr>";
	            	$h=0;
	            	$blnFila=true;
	            }
	            $x++;
	        }                          
		}
		if($h!=4){
			$Estructura.="</div><hr>";
		}
		echo $Estructura."</div>";
		$ContenidoWebService=null;
		$DatosInforme=null;
	}


}