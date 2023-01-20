<?php 
date_default_timezone_set('America/Bogota');
include_once ("../WebServices/clsProductoWebService.php");
include_once ("../Model/clsProductosModel.php");
include_once  ('../Classes/PHPExcel/IOFactory.php');
$objProducto= new clsProductoController();
if(isset($_POST['btnBusquedaProducto'])){
	$objProducto->BusquedaProducto();
}
if(isset($_POST['btnGenerarXlsProductosLiquidados'])){
	$objProducto->GenerarExcelProdutosLiquidados();
}
if(isset($_POST['btnGetEncabezadoCompraProductos'])){
	$objProducto->GetEncabezadoCompraProductos();
}
if(isset($_POST['actFotosCarousel'])){
	$objProducto->GetFotosCarousel($_POST['url'], $_POST['referencia']);
}
$objProducto=null;
class clsProductoController
{
	#Metodos publicos


	public function CantidadProducto($strIdProducto){
		//$strIdProducto = trim($_POST['strReferencia']);
		$objWsProducto2 = new clsProductoWebService();
		$objWsProducto2->GetCantidadFinalProducto($strIdProducto);
	    $rpta2= $objWsProducto2->GetRespuestaWs();
		
		$cantidad=substr($rpta2,22,-3);
		return $cantidad;		
	}



	public function BusquedaProducto(){
		$strIdProducto=trim($_POST['strReferencia']);
		$objWsProducto= new clsProductoWebService();
		$objWsProducto->GetProductos($strIdProducto,'30');
		$rpta = $objWsProducto->GetRespuestaWs();
		$rpta = json_decode($rpta,true);
		$strCntProductos = "";
		
		if($rpta['Success']){
			foreach ($rpta['Data']['Productos'] as $key => $value) {
			//var_dump($value);

			$cant =$this->CantidadProducto($value['strReferencia']);

			$rutaImg = "../../ownCloud/fotos_nube/".trim($value['strReferencia'].".jpg");
			//echo $rutaImg;
			if (!file_exists($rutaImg)) {
					$clase = "";
					$linea = "";
					$grupo = "";
					$tipo = "";
					$clasificacion = "";
					if($value['strClase'] !== "GENERAL"){ $clasificacion.=$value['strClase']."/";}
					if($value['strLinea'] !== "GENERAL"){ $clasificacion.=$value['strLinea']."/";}
					if($value['strGrupo'] !== "GENERAL"){ $clasificacion.=$value['strGrupo']."/";}
					if($value['strTipo'] !== "GENERAL"){ $clasificacion.=$value['strTipo']."/";}
					$rutaImg = "../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO/".$clasificacion.trim($value['strReferencia'])."/".trim($value['strReferencia']."$1.jpg");
					//echo $rutaImg;
					if (!file_exists($rutaImg)) {
						$rutaImg = "../Images/img-no-disponible.jpg";
						
					}else{
						$carousel = 1;
						$rutaImg = str_replace(" ", "%20", $rutaImg);
					}
			}
			

			$strCntProductos.="
						<div class='contenedor-card'>
						<div class='contenido-img'>
						<img data-referencia='".$value['strReferencia']."' 
							src='".str_replace("#","%23",$rutaImg)."'
						 	id='ImgBusquedaProducto' class='img-responsive'  alt='Inmodafantasy JPG'>
						</div>
						<div>
						<div>
						<b>Referencia</b><br>
						<span>".$value['strReferencia']."</span><br>

						<b>Descripción</b><br>
						<span>".$value['strDescripcion']."</span><br>

						<b>Unidad Medida </b><br>
						<span>".$value['strUnidadMedida']."</span><br>

						<b>Tamaño </b><br>
						<span>".$value['strTamano']."</span><br>

						<b>Cantidad por empaque </b><br>
						<span>".$value['intCantXPacas']."</span><br>

						<b>Precio </b><br>
						<span>".$value['strPrecioUno']."</span><br>

						<b>Ubicación </b><br>
						<span> ".$value['strUbicacion']."</span>

					<div>
									<b>Existencia en inventario </b><br>
									<span> " .$cant."</span>	
									</div>
			
						</div>
						</div>
						</div>
						";
			}
		}else{
			$strCntProductos = -1;
		}
		
		echo $strCntProductos;
	}
	//Metodo para generar excel de los productos ya liquidados segun su estado y compra
	public function GenerarExcelProdutosLiquidados(){
		$intEstadoProducto=trim($_POST['rdbEstado']);
		$strIdCompra=trim($_POST['ddlEncabezadoCompra']);
		$objProductosModel= new clsProductosModel();
		$objProductosModel->GetProductosLiquidadosCompra($strIdCompra,$intEstadoProducto);
		$ArrayRespuesta=$objProductosModel->GetRespuesta();


		$fileType = 'Excel5'; 
		$fileName = '../FormatoDeArchivos/Productos.xls';
		$objReader = PHPExcel_IOFactory::createReader($fileType); 
		$objPHPExcel = $objReader->load($fileName); 
		$i=2;
		for($j=0;$j<=sizeof($ArrayRespuesta)-1;$j++){
			$objPHPExcel->setActiveSheetIndex(0)->
			setCellValue(('A'.$i),trim($ArrayRespuesta[$j]['strReferenciaM']))->
			setCellValue(('B'.$i),trim($ArrayRespuesta[$j]['strDescripcion']))->
			setCellValue(('C'.$i),trim($ArrayRespuesta[$j]['intCxU']))->
			setCellValue(('D'.$i),trim('0'))->
			setCellValue(('E'.$i),trim('0'))->
			setCellValue(('F'.$i),trim('0'))->
			setCellValue(('G'.$i),trim('0'))->
			setCellValue(('H'.$i),trim($ArrayRespuesta[$j]['strUnidadMedidaM']))->
			setCellValue(('I'.$i),trim($ArrayRespuesta[$j]['strUnidadMedidaM']))->
			setCellValue(('J'.$i),trim('01'))->
			setCellValue(('K'.$i),trim('0'))->
			setCellValue(('L'.$i),trim($ArrayRespuesta[$j]['intPrecio1']))->
			setCellValue(('M'.$i),trim($ArrayRespuesta[$j]['intPrecio2']))->
			setCellValue(('N'.$i),trim($ArrayRespuesta[$j]['intPrecio3']))->
			setCellValue(('O'.$i),trim($ArrayRespuesta[$j]['intPrecio4']))->
			setCellValue(('P'.$i),trim($ArrayRespuesta[$j]['intPrecio5']))->
			setCellValue(('Q'.$i),trim('0'))->
			setCellValue(('R'.$i),trim('0'))->
			setCellValue(('S'.$i),trim('0'))->
			setCellValue(('T'.$i),trim('0'))->
			setCellValue(('U'.$i),trim('1'))->
			setCellValue(('V'.$i),trim('1'))->
			setCellValue(('W'.$i),trim('1'))->
			setCellValue(('X'.$i),trim('1'))->
			setCellValue(('Y'.$i),trim('0'))->
			setCellValue(('Z'.$i),trim('0'))->
			setCellValue(('AA'.$i),trim('1'))->
			setCellValue(('AB'.$i),trim('0'))->
			setCellValue(('AC'.$i),trim('0'))->
			setCellValue(('AD'.$i),trim($ArrayRespuesta[$j]['strImportacion']))->
			setCellValue(('AE'.$i),trim($ArrayRespuesta[$j]['strDimesion']))->
			setCellValue(('AF'.$i),trim(''))->
			setCellValue(('AG'.$i),trim($ArrayRespuesta[$j]['strSexo']))->
			setCellValue(('AH'.$i),trim($ArrayRespuesta[$j]['strMaterial']))->
			setCellValue(('AI'.$i),trim($ArrayRespuesta[$j]['strMarca']))->
			setCellValue(('AJ'.$i),trim($ArrayRespuesta[$j]['strObservacion']))->
			setCellValue(('AK'.$i),trim($ArrayRespuesta[$j]['intCantidadM']))->
			setCellValue(('AL'.$i),trim('1'))
			;
			$i++;
		}
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="ProductosLiquidadosCompra.xls"');
		header('Cache-Control: max-age=0');
		ob_end_clean();
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}
	//Metodo para obtener el encabezado de la compra china de productos
	public function GetEncabezadoCompraProductos(){
		$objModelProductos= new clsProductosModel();
		$objModelProductos->GetEncabezadoCompraProductos(date('Y'));
		$objRespuesta=$objModelProductos->GetRespuesta();
		$ArrayEncabezadoCompra=array();
		$blnEstado=false;
		for($i=0;$i<=sizeof($objRespuesta)-1;$i++){
			array_push($ArrayEncabezadoCompra, array("strIdCompra"=>$objRespuesta[$i]['intIdDocumentoReferencia'],"strDescripcion"=>$objRespuesta[$i]['strRaggi'],
			));
			$blnEstado=true;
		}
		echo json_encode(array("Success"=>$blnEstado,
			"Data"=>$ArrayEncabezadoCompra));
	}

	/*public function GetFotosCarousel($dir){
		$dir = str_replace("%20", " ", $dir);
		$dir = str_replace("https://www.inmodafantasy.com.co/", "../../", $dir);
		$array = explode("/", $dir);
		array_pop($array);
			$dir = implode("/", $array);
			if(is_file($dir)){
			$this->FotosCarousel($dir);
			}else{
				$result = array();
				 $cdir = scandir($dir);
				foreach ($cdir as $key => $value){
			      	if (!in_array($value,array(".",".."))){
			         	if (is_dir($dir . DIRECTORY_SEPARATOR . $value)){
			            	$result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
				         }
				         else{
				            $result[] = $value;
				         }
			      	}
			    }
			    $dir = str_replace(" ", "%20", $dir);
			    $dir = str_replace("../../","https://www.inmodafantasy.com.co/", $dir);
				echo json_encode(array("url"=>$dir, "fotos"=>array_reverse($result)));
			}
		
	}*/
	public function GetFotosCarousel($dir, $referencia){
		$objWsProducto= new clsProductoWebService();
		$objWsProducto->GetImagenesProductos($referencia);
		$rpta = $objWsProducto->GetRespuestaWs();
		$rpta = json_decode($rpta,true);

		echo json_encode(array("urls"=>$rpta));
		
	}
}