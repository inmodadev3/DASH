<?php 
include_once("../Classes/nusoap/nusoap.php");
include_once("../Model/clsAgotados.php");
$FotosController = new FotosController();
session_start();



if(isset($_POST['Inicio'])){
	$FotosController->ConsultarProductosHGI();
}



if(isset($_POST['home'])){
	/*$ftp_server = "192.168.1.4";
	$conn_id = ftp_connect($ftp_server);
	$ftp_user_name = "user";
	$ftp_user_pass = "password";
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
	$contents = ftp_nlist($conn_id, '/htdocs/OwnCloud/fotos_nube');
	$rpta = "";
	for ($i = 0 ; $i < count($contents) ; $i++)
		$rpta.= "<a href=".substr($contents[$i],1).">" . substr($contents[$i],1) . "</a>";
	ftp_close($conn_id);

	$return_arr[] = array("prueba"=>"", "fotos"=>"", "rpta"=>"", "carpetas" =>"", "ruta"=>"", "filtrar"=>"", "word"=>"");
	echo json_encode($return_arr);*/
	if($_POST['ruta'] == ""){
		$ruta = "../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO";
	}else{
		$ruta = "../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO".$_POST['ruta'];
	}
	
	$FotosController->AbrirCarpeta($ruta, $_POST['filtro'], $_POST['word']);
}

if(isset($_POST['actAgotarReferencia'])){
	
	if($_POST['actualizar'] == "actualizar" && $_POST['deshacer'] == "false"){
		//Consulto guiones agotados actuales guardo session para poder deshacer
		if(!isset($_SESSION)){ 
			session_start(); 
		}
		$rpta = $FotosController->ConsultarDetalleAgotado($_POST['referencia'], false);
		$r = array();
		foreach ($rpta as $key => $value) {
			foreach ($value as $key1 => $value1) {
				if($key1 == "strDescripcion"){
					$r[$key] = $value1;
				}
			}
		}
		unset($_SESSION['guiones_agotados']); 
		$_SESSION['guiones_agotados'] = $r;
		
		//Actualizo guiones agotados
		$FotosController->EliminarDetalleAgotado(0, $_POST['referencia'], 0);//ok
		$FotosController->AgregarDetalleAgotado($_POST['referencia'], $_POST['guion'], $_POST['ruta']);
	}else{	
		//Deshacer los cambios realizados
		if($_POST['deshacer'] == "true"){
			//CASO 1: Deshacer actualizacion 
			if($_POST['actualizar'] == "actualizar"){
				$FotosController->EliminarDetalleAgotado(0, $_POST['referencia'], 0);//ok DB
				if(!isset($_SESSION)){ 
					session_start(); 
				}
				$guiones = "";
				foreach ( $_SESSION['guiones_agotados'] as $key => $value) {
					$guiones.=$value.":";
				}

				//ARREGLADO!!!
				$FotosController->AgregarDetalleAgotado($_POST['referencia'], $guiones , $_POST['ruta'], false);
				$FotosController->DeshacerFotosActualizado($_POST['referencia']);
			}else{
				//CASO 2: Deshacer referencia total
				if($_POST['guion'] == -1){
					/*$return_arr[] = array("rpta"=>"deshacer total");
					echo json_encode($return_arr);*/
					$FotosController->DeshacerAgotado($_POST['referencia']);
				}else{
					//CASO 3: Deshacer guiones nuevos
					/*$return_arr[] = array("rpta"=>$_SESSION['rutas_save']);
					echo json_encode($return_arr);*/
					$FotosController->DeshacerDetalleAgotado($_POST['referencia']);
				}
			}
			
		}else{
			if($_POST['guion'] == -1){
				//Agregar Agotado REVISAR!!!
				$return_arr[] = array("rpta"=>"agotar total");
				echo json_encode($return_arr);
				$FotosController->AgregarAgotado($_POST['referencia'], $_POST['ruta']);
			}else{
				$return_arr[] = array("rpta"=>$_POST['guion']);
				echo json_encode($return_arr);
				//Agregar Detalle Agotado
				$FotosController->AgregarDetalleAgotado($_POST['referencia'], $_POST['guion'], $_POST['ruta']);
			}
		}
	}

	
}

if(isset($_POST['ConsultarGuiones'])){
	$FotosController->ConsultarDetalleAgotado($_POST['referencia']);
}

if(isset($_POST['EliminarReferenciaAgotada'])){
	$FotosController->EliminarAgotado($_POST['referencia']);
}

if(isset($_POST['ActualizarGuionesAgotados'])){
	$FotosController->ActualizarGuionesAgotados($_POST['referencia'], $_POST['guiones']);
}

if(isset($_POST['btnCargarFotos'])){
	$FotosController->CargarFotos($_POST['ruta']);
}

if(isset($_POST['btnReemplazarFoto'])){
	$FotosController->CargarFotos($_POST['ruta'], true);
}

if(isset($_POST['CopiarFoto'])){
	$FotosController->PegarFoto($_POST['referencia'], $_POST['carpeta']."-", $_POST['ruta']);
}

if(isset($_POST['MoverFoto'])){
	$FotosController->MoverFoto($_POST['rutaMover'], $_POST['rutaActual'], $_POST['referencias']);
}

if (isset($_GET['archivo'])) {

	$FotosController->DescargarFotos($_GET['archivo'], $_GET['ruta']);
}

if (isset($_POST['btnEliminarFoto'])) {
	$FotosController->EliminarFotos($_POST['nombreFoto']);
	
}

if(isset($_POST['btnCargarFotoGuionesActualizados'])){
	$FotosController->CargarFotoGuionesActualizados($_POST['ruta'], true);
}



class FotosController
{
	private $urlWebService;
	private $strParametros;
	private $fotosFiltro = "";
	private $carpetasFiltro = "";
	private $rptaProducto = "";
	private $vectorFotosParaConsultarHGI = array();
	private $topeFiltro = 100;
	private $Json = array();

	private $pbra = 0;

	private $rutaFotosPorSeccion = "../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO";
    function __construct(){
		$this->urlWebService = 'http://10.10.10.128/webserviceportal/WebService/WebServiceProductos.php?wsdl';
	}

	function AbrirCarpeta($ruta2, $filtrar, $word)
	{
		$fotos = "";
		$carpetas = "";
		$rpta = "hola";
		$carpetaEspecial = "";
		$rptaHGI = -1;
		$ruta= $ruta2."/";
		if(is_dir($ruta)) {
			if($dir = opendir($ruta)) {
				while(($archivo = readdir($dir)) !== false) {
					if($archivo != '.' && $archivo != '..'){
						$r = "".$archivo;
						if (!is_dir($ruta.$archivo)){
							//Fotos
							if (strlen(stristr($archivo,'.jpg'))>0) {
									//Consultar referencias por clasificacion
									if(preg_match('/-/i', $_POST['ruta'])){
										//Llenar vector de las fotos que hay en la ruta
										if(sizeof($this->vectorFotosParaConsultarHGI) == 0){
											$this->LlenarVectorFotosDeCarpetaEspecial($ruta);
											$this->ConsultarProductosJSON();
										}
									}else{
										if($this->rptaProducto == ""){
											$this->ConsultarProductosPorClasificacion($ruta);
										}
									}

									if($filtrar == 1){
										//recorrer directorio desde la ruta actual y retorno todas las fotos y carpetas coincidentes, formo el json y lo retorno
										$this->FiltrarInformacion($ruta, $word, "fotos");
										$fotos = $this->fotosFiltro;
										$carpetas = $this->carpetasFiltro;
										break;
									}else{
										$archivo = str_replace('.jpg','', $archivo);
										//Validar si esta agotado
										$rpta = $this->ConsultarDetalleAgotado($archivo, false);
										//validar si existe la referencia en el HGI
										//$rptaHGI = $this->ValidarExistenciaHGI($archivo); Consultar en la session que se crea, por ahora no se utiliza
										if(sizeof($this->rptaProducto) > 0){
											$rptaHGI = $this->ConsultarReferenciaObjetoHGI($archivo, $this->rptaProducto);
										}
										$fechaFoto = date ("j-m-y H:i:s", filemtime($ruta.$archivo.".jpg"));
										//validar si esta en promocion y tendencia
										$Promocion = $this->ValidarFotoEncarpetado($this->rutaFotosPorSeccion."/PROMOCIONES-/".$archivo.".jpg");
										$TendenciaA = $this->ValidarFotoEncarpetado($this->rutaFotosPorSeccion."/TENDENCIA ACTUAL-/".$archivo.".jpg");
										$TendenciaP = $this->ValidarFotoEncarpetado($this->rutaFotosPorSeccion."/TENDENCIA PROXIMA-/".$archivo.".jpg");
										$CarpetaGeneral = $this->ValidarFotoEncarpetado($this->rutaFotosPorSeccion."/ACTUALIZACIONES-/".$archivo.".jpg");
										$fotos.=$archivo."_".$rpta[0]["rpta"]."_".$rptaHGI."_".$Promocion."_".$TendenciaA."_".$TendenciaP."_".$CarpetaGeneral."_".$fechaFoto."/";
									}	
							}
						}else{
							//Carpetas
							if((strcmp ($archivo , "1000" ) != 0)  &&  (strcmp ($archivo , "2000" ) != 0)  &&  (strcmp ($archivo , "5000" ) != 0)){

								if($filtrar == 1){
									$this->FiltrarInformacion($ruta, $word, "fotos");
									$fotos = $this->fotosFiltro;
									$carpetas = $this->carpetasFiltro;
									break;
								}else{
									$carpetas.=$archivo."/";
								}

								
							}
						}
					}
				}
				closedir($dir);
			}
		}
		//Quitamos parte de la ruta que sobra
		$res = "";
		if($fotos != "" && $filtrar != 1){
			$delimiters = Array("/","_");
			$res = $this->multiexplode($delimiters,$fotos);
			foreach ($res as $key => $row) {
				if(array_key_exists(6, $row)){
					if($row[6] == ""){
						unset($res[$key]);
					}else{
						$aux[$key] = $row[6];
					}	
				}else{
					unset($res[$key]);
				}
				
			}
			usort($res, array('FotosController','compareByTimeStamp')); 
			//var_dump($aux);
			//array_multisort($res, $aux);
			//usort($res, 'sort_by_orden');
			//var_dump($res);
			//exit();
			$fotos = $res;
		}

		//Ordenamos las carpetas en orden alfabetico
		if($filtrar != 1){
			$arrayCarpetas = explode("/", $carpetas);
			sort($arrayCarpetas);
			$carpetas = implode("/", $arrayCarpetas);
		}	

		$ruta = str_replace($this->rutaFotosPorSeccion."/", "", $ruta);
		$return_arr[] = array("prueba"=>"", "fotos"=>$fotos, "rpta"=>$carpetaEspecial, "carpetas" =>$carpetas, "ruta"=>$ruta, "filtrar"=>$filtrar, "word"=>$word);
		echo json_encode($return_arr);
		
	}

	private static function compareByTimeStamp($time1, $time2){ 
		if (strtotime($time1[6]) < strtotime($time2[6])) 
			return 1; 
		else if (strtotime($time1[6]) > strtotime($time2[6]))  
			return -1; 
		else
			return 0; 
	}

	function multiexplode($delimiters,$string) {
		$ary = explode($delimiters[0],$string);
		array_shift($delimiters);
		if($delimiters != NULL) {
			foreach($ary as $key => $val) {
				 $ary[$key] = $this->multiexplode($delimiters, $val);
			}
		}
		return  $ary;
	}

	//Funcion recursiva que recorre desde una ruta dada y busca coincidencias tanto en archivos como carpetas
	function FiltrarInformacion($ruta, $word, $tipo){
		if(is_dir($ruta)) {
			if($dir = opendir($ruta)) {
				while(($archivo = readdir($dir)) !== false) {
					if($archivo != '.' && $archivo != '..') {
						$r = $ruta.$archivo;

						if (!is_dir($ruta.$archivo)){
								$foto = str_replace('.jpg','', $archivo);
									//if($foto == strtoupper($word)){
									if(strpos($foto, strtoupper($word)) !== false){
										$this->topeFiltro--;
										$rutaview = str_replace($this->rutaFotosPorSeccion, "", $ruta);
										$rutaview = str_replace($_POST['ruta'], "", $rutaview);
										$rptaHGI = "";//$this->ValidarExistenciaHGI($foto);
										$this->fotosFiltro.= $foto.":".$rutaview.":".$rptaHGI."//";
									}

							
						}else{
								//$carpeta = str_replace('.jpg','', $archivo);
									//if($archivo == strtoupper($word)){
								if(strpos($archivo, strtoupper($word)) !== false){
									$this->topeFiltro--;
									$rutaview = str_replace($this->rutaFotosPorSeccion, "", $r);
									$this->carpetasFiltro.= $archivo.":".$rutaview."*";
								}
								if($this->topeFiltro > 0){
									$r = $r."/";
									$this->FiltrarInformacion($r, $word, $tipo);
								}
						}
					}
				}
				closedir($dir);
			} 
		}
	}

	function LlenarVectorFotosDeCarpetaEspecial($ruta){
		if(is_dir($ruta)) {
			if($dir = opendir($ruta)) {
				while(($archivo = readdir($dir)) !== false) {
					if($archivo != '.' && $archivo != '..') {
						$r = $ruta.$archivo;

						if (!is_dir($ruta.$archivo)){
							$foto = str_replace('.jpg','', $archivo);
							$this->pbra.="__".$foto;
							array_push($this->vectorFotosParaConsultarHGI, $foto);
						}
					}
				}
				closedir($dir);
			} 
		}
	}

//---------------------------------Encabezado agotados------------------------------------
	function AgregarAgotado($referncia, $rutaFoto, $rptaView = true){
		$objModelAgotados = new clsAgotado();

		$this->strParametros = '';
		$this->strParametros=array('strReferencia'=>$referncia);
		$rptaProducto=json_decode($this->ConsultarWebService("Producto",true, $this->urlWebService));
		if($rptaProducto == null){
			$rptaDB = $objModelAgotados->AgregarReferenciaAgotada($referncia, $_SESSION['idLogin'],0,0,0,0,str_replace("::","",$this->getIP()));
		}else{
			//$strParametros = "-- ".$referncia.$_SESSION['idLogin']."'".$rptaProducto[0]->StrLinea."'"."'".$rptaProducto[0]->StrGrupo."'". "'".$rptaProducto[0]->StrClase."'"."'".$rptaProducto[0]->StrTipo."'"."'".str_replace("::","",$this->getIP())."'";
			$rptaDB = $objModelAgotados->AgregarReferenciaAgotada($referncia, $_SESSION['idLogin'],$rptaProducto[0]->StrLinea, $rptaProducto[0]->StrGrupo, $rptaProducto[0]->StrClase,$rptaProducto[0]->StrTipo,str_replace("::","",$this->getIP()));
		}
		//Copiamos y eliminamos la referencia
		$this->PegarFotoAgotados($rutaFoto, $referncia);

		if($rptaView){

			$this->EliminarFotos($referncia);
			if(!isset($_SESSION)){ 
				session_start(); 
			}
			unset($_SESSION['rutas_save']); 
			$_SESSION['rutas_save'] = $this->Json;
			$return_arr[] = array("datos"=>$rptaDB[0]["rpta"], "rutas_session" =>$_SESSION['rutas_save'], "referencia" => $referncia);
			//$return_arr[] = array("datos"=>$strParametros, "rptaEliminar" => $referncia);$this->getIP()

			echo json_encode($return_arr);
		}else{
			return $rptaDB[0]["rpta"];
		}
		
	}

	function EliminarAgotado($referncia, $rptaView = false){
			$objModelAgotados = new clsAgotado();
			$rptaDB = $objModelAgotados->EliminarReferenciaAgotada($referncia);
			if($rptaView){
				//retornar rpta....
				return $rptaDB;
			}
			$return_arr[] = array("datos"=>$rptaDB);
			echo json_encode($return_arr);
	}

	function ConsultarAgotado($referncia){
			$objModelAgotados = new clsAgotado();
			$rptaDB = $objModelAgotados->ConsultarReferenciaAgotada($referncia);
			
			return $rptaDB;
	}
//---------------------------------Encabezado agotados------------------------------------

//---------------------------------Detalle agotados---------------------------------------

	//Agregamos registro del encabezado y el detalle, pegamos foto en la carpeta de agotados no se llena la session de rutas ya que no se eliminan
	//Si returnView es false es porque se se omiten lineas y retorna al mismo controlador
	function AgregarDetalleAgotado($referncia, $guiones, $rutaFoto, $returnView = true){
		$objModelAgotados = new clsAgotado();
		$guiones = explode(":",$guiones);
		array_pop($guiones);
		$rptaDB = "";
		$rptaAgotado = $this->ConsultarAgotado($referncia);
		if($rptaAgotado[0]["rpta"] == -1){ //si no existe crea el encabezado
				$idAgotado = $this->AgregarAgotado($referncia, $rutaFoto, false);
		}else{ //ya existe pego la foto en agotados
			$idAgotado = $rptaAgotado[0]["intIdRefAgotada"];
			if($returnView){
				$this->PegarFotoAgotados($rutaFoto, $referncia);
			}
		}
		
		$vect_guiones = array($idAgotado);
		foreach($guiones as $item){
			array_push($vect_guiones, $item);
			$rpta = $objModelAgotados->AgregarDetalleReferenciaAgotada($idAgotado, $item);
			$rptaDB.=$rpta[0]["rpta"].":";
		}

		

		if($returnView){
			//---Guardamos el id y los guiones para poder deshacer la operacion
			if(!isset($_SESSION)){ 
				session_start(); 
			}
			unset($_SESSION['guiones']);
			$_SESSION['guiones'] = $vect_guiones;
			//---Guardamos el id y los guiones para poder deshacer la operacion
			$return_arr[] = array("datos"=>$rptaDB, "ruta"=>$rutaFoto);
			echo json_encode($return_arr);
		}else{
			return $rptaDB;
		}
		
	}

	//si ban es igual a 0 elimina todo el detalle
	function EliminarDetalleAgotado($id, $descripcion, $ban = 1){
		$objModelAgotados = new clsAgotado();
		$rptaDB = $objModelAgotados->EliminarDetalleReferenciaAgotada($id, $descripcion, $ban);
		return $rptaDB[0]['rpta'];
	}

	function ActualizarGuionesAgotados($referncia, $guiones){
		$this->EliminarDetalleAgotado(0, $referencia, 0);
		
		echo $this->AgregarDetalleAgotado($referncia, $guiones);
	}

	function ActualizarGuionesDB($referencia, $guiones){
		foreach($guiones as $item){
			$rpta = $objModelAgotados->AgregarDetalleReferenciaAgotada($idAgotado, $item);
		}
		
	}

	function ConsultarDetalleAgotado($referncia, $view = true){
		$objModelAgotados = new clsAgotado();
		$rptaDB = $objModelAgotados->ConsultarDetalleReferenciaAgotada($referncia);
		if($view){
			$return_arr[] = array("datos"=>$rptaDB);
			echo json_encode($return_arr);
		}else{
			return $rptaDB;
		}
		
	}
//---------------------------------Detalle agotados-----------------------------------------

//--------------------------------Manejo de archivos----------------------------------------
	
	function ConvertirRutaView($src){
		$src = str_replace( ":", "/", $src);
		$src = str_replace("HOME", "", $src);
		$src = str_replace("//", "/", $src);

		return $src;
	}

	//Funcion para pegar imagenes a la carpeta de agotados
	function PegarFotoAgotados($src, $referncia){
		$src = $this->ConvertirRutaView($src);
		$ruta = $this->rutaFotosPorSeccion."/".$src.$referncia.".jpg";
		//sudo chmod -R 777 Nombre de la carpeta
		if (file_exists("../../Agotados/".$referncia)) {
				$this->SacarFotoAgotados($referncia);
				
		} else {
				mkdir("../../Agotados/".$referncia, 0700, true);
				mkdir("../../Agotados/".$referncia."/Agotado", 0700, true);
				mkdir("../../Agotados/".$referncia."/Historico", 0700, true);
		}
		//chmod( "../../Agotados/".$referncia."/Agotado", 777);
		copy($ruta, "../../Agotados/".$referncia."/Agotado/".$referncia.".jpg");
	}

	//Funcion para pegar la foto a una carpeta inicial un nivel, ejemplo: carpetas de promociones y tendencias
	function PegarFoto($referncia, $carpeta, $rutaActual){
		$src = $this->ConvertirRutaView($rutaActual);

		$rutaFoto = $this->rutaFotosPorSeccion."/".$src.$referncia.".jpg";

		if(file_exists($this->rutaFotosPorSeccion."/".$carpeta."/".$referncia.".jpg")){
			unlink($this->rutaFotosPorSeccion."/".$carpeta."/".$referncia.".jpg");
			echo 0;
		}else{
			copy($rutaFoto, $this->rutaFotosPorSeccion."/".$carpeta."/".$referncia.".jpg");
			echo 1;
		}
		
	}
	//Funcion que elimina la foto de agotados y la pega a la carpeta Historico donde queda con la fecha y hora de la accion
	function SacarFotoAgotados($referncia){
		if(file_exists("../../Agotados/".$referncia."/Agotado/".$referncia.".jpg")){
			$newFile =  date("Y-m-d H:i:s").$referncia.".jpg";

			//Guardar el nombre del archivo de la carpeta de historicos para la opcion de deshacer
			if(!isset($_SESSION)){ 
				session_start(); 
			}
			unset($_SESSION['nombre_archivo_historico']); 
			$_SESSION['nombre_archivo_historico'] = $newFile;


			rename("../../Agotados/".$referncia."/Agotado/".$referncia.".jpg", "../../Agotados/".$referncia."/Agotado/".$newFile);
			copy("../../Agotados/".$referncia."/Agotado/".$newFile, "../../Agotados/".$referncia."/Historico/".$newFile);
			unlink("../../Agotados/".$referncia."/Agotado/".$newFile);
		}
	}

	function chmod_r($dir, $dirPermissions) {
		$dp = opendir($dir);
		 while($file = readdir($dp)) {
		   if (($file == ".") || ($file == ".."))
			  continue;
  
		  $fullPath = $dir."/".$file;
  
		   if(is_dir($fullPath)) {
			  //echo('DIR:' . $fullPath . "\n");
			  chmod($fullPath, $dirPermissions);
			  $this->chmod_r($fullPath, $dirPermissions);
		   } else {
			  //echo('FILE:' . $fullPath . "\n");
			  chmod($fullPath, $dirPermissions);
		   }
  
		 }
	   closedir($dp);
	}

	function SacarFotoAgotadosDeshacer($referncia){
		$rpta = "No existe la foto en agotado";
		$this->chmod_r("../../Agotados/".$referncia."/Historico", 0777, 0777);
		$this->chmod_r("../../Agotados/".$referncia."/Agotado", 0777, 0777);
		if(file_exists("../../Agotados/".$referncia."/Agotado/".$referncia.".jpg") ){
			if(!isset($_SESSION)){ 
				session_start(); 
			}
			//revisar!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			if(file_exists("../../Agotados/".$referncia."/Historico/".$_SESSION['nombre_archivo_historico'])){
				rename("../../Agotados/".$referncia."/Historico/".$_SESSION['nombre_archivo_historico'], "../../Agotados/".$referncia."/Historico/".$referncia.".jpg");
				if(copy("../../Agotados/".$referncia."/Historico/".$referncia.".jpg", "../../Agotados/".$referncia."/Agotado/".$referncia.".jpg")){
					unlink("../../Agotados/".$referncia."/Historico/".$referncia.".jpg");
					$rpta = "reemplazo de historico hacia agotados";
				}else{
					$rpta = "fallo al copiar la foto hacia agotados";
				}
				
			}else{
				//eeliminar de agotados ya que no existe en el historico
				$rpta = "elimino foto de agotados";
				unlink("../../Agotados/".$referncia."/Agotado/".$referncia.".jpg");
			}
			
		}
		unset($_SESSION['nombre_archivo_historico']);
		$return_arr[] = array("rpta2"=>$rpta);
		echo json_encode($return_arr);
	}

	//Funcion recursiva que busca y elimina todas las referencias coincidentes de fotos_nube
	function EliminarFotos($referncia, $ruta = "../../ownCloud/fotos_nube" ){
		$rpta = 0;
		$ruta = $ruta."/";
		if(is_dir($ruta)) {
			if($dir = opendir($ruta)) {
				while(($archivo = readdir($dir)) !== false) {
					if($archivo != '.' && $archivo != '..') {
						$r = $ruta.$archivo;

						if (!is_dir($ruta.$archivo)){
							$arch = str_replace('.jpg','', $archivo);
							
							if($referncia == $arch){
								$rpta = $archivo;
								//Eliminamos la foto
								array_push($this->Json, $ruta.$archivo);
								unlink($ruta.$archivo);
							}
						}else{
							$this->EliminarFotos($referncia, $r);
						}
					}
				}
				closedir($dir);
			} 
		}
	}

	function ValidarFotoEncarpetado($ruta){
		if(file_exists($ruta)){
			return 1;
		}else{
			return 0;
		}
	}

	//Funcion que valida si existe o no un archivo en el directorio
	function ValidarExistenciaFotoEnDir($referencia, $ruta = "../../ownCloud/fotos_nube", $redundante = true){
		$rpta = false;
		$ruta = $ruta."/";
		if(is_dir($ruta)) {
			if($dir = opendir($ruta)) {
				while(($archivo = readdir($dir)) !== false) {
					if($archivo != '.' && $archivo != '..') {
						$r = $ruta.$archivo;

						if (!is_dir($ruta.$archivo)){
							$arch = str_replace('.jpg','', $archivo);
							
							if($referencia == $arch){
								$rpta = true;

							}
						}else{
							if($redundante){
								$r = $this->ValidarExistenciaFotoEnDir($referencia, $r);
								if($r){
									return $r;
								}
							}
							
						}
					}
				}
				closedir($dir);
			} 
		}
		return $rpta;
	}

	//Funcion que sube la foto validando tipo de archivo, existencia en dir y si esta agotado lo elimina
	function CargarFotos($ruta, $boolReemplazar = false){
		$src = str_replace( ":", "/", $ruta);
		$src = str_replace("HOME", "", $src);
		$src = str_replace("//", "/", $src);
		if(@isset($_FILES['File'])){
			//var_dump($_FILES['File']);
			$filename= $_FILES['File']['name'];
			$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
			if($imageFileType == "jpg" ) {
			
				$encarpetado=$this->rutaFotosPorSeccion.$src;
				$fotos_nube = "../../ownCloud/fotos_nube/";
				if (!empty($filename)){
					$referncia = str_replace(".jpg","", $filename);
					if($this->ValidarExistenciaFotoEnDir($referncia)){
						//Existe en el encarpetado
						if($boolReemplazar){
							//Subir foto si reemplazar es true
							if ((move_uploaded_file($_FILES['File']['tmp_name'], $encarpetado.$filename))){//Cargamos la foto a la ruta donde esta situado
								//Pendiente reeemplazaar en el encarpetado
								$this->ReemplazarFotoActualizada($referncia, $encarpetado.$filename);
								if(!file_exists($fotos_nube.$filename)){
									copy($encarpetado.$filename, $fotos_nube.$filename);
								}
							}
							echo 1;	
						}else{
							$rptaAgotado = $this->ConsultarAgotado($referncia);
							if($rptaAgotado[0]["rpta"] == -1){ //no existe
								//retorno 2 para reemplazar la foto en el encarpetado vista
								echo 2;
							}else{//existe
								//consultar guiones 
								//diseñar modal para actualizar guiones 
								//actualizar

								echo 3;//"mostar guiones agotados";
							}
						}

						

						











					}else if ((move_uploaded_file($_FILES['File']['tmp_name'], $encarpetado.$filename))){//Cargamos la foto a la ruta donde esta situado

						//validar si existe agotados en la bd
						$rptaAgotado = $this->ConsultarAgotado($referncia);
						if($rptaAgotado[0]["rpta"] != -1){ //ya existe
							/*$this->EliminarAgotado($referncia, true);
							//ELiminamos la foto de la carpeta de agotados
							$this->SacarFotoAgotados($referncia);*/
							echo "existe en agotados";
						}

						//Pegar la foto afuera
						copy($encarpetado.$filename, "../../ownCloud/fotos_nube/".$filename);
						//si no existe el agotado con el move_uploaded_file ya pega la foto en el encarpetado

						echo "sube la foto al  encarpetado";

						
					}else{
						echo -1;
					}
				}
			}else{
				echo 0;
			}
		}
	}

	//Funcion que sube la foto con los guiones actualizados, reemplaza en todo el encarpetado por la foto editada
	function CargarFotoGuionesActualizados($ruta){
		$src = str_replace( ":", "/", $ruta);
		$src = str_replace("HOME", "", $src);
		$src = str_replace("//", "/", $src);
		if(@isset($_FILES['File'])){
			//var_dump($_FILES['File']);
			$filename= $_FILES['File']['name'];
			$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
			if($imageFileType == "jpg" ) {
			
				$encarpetado=$this->rutaFotosPorSeccion.$src;
				$fotos_nube = "../../ownCloud/fotos_nube/";
				if (!empty($filename)){
					if ((move_uploaded_file($_FILES['File']['tmp_name'], $encarpetado.$filename))){
						$referncia = str_replace(".jpg","", $filename);
						//Pegar la foto afuera
						copy($encarpetado.$filename, "../../ownCloud/fotos_nube/".$filename);
						array_push($this->Json, $encarpetado.$filename);
						//Reemplazamos fotos existentes
						$this->ReemplazarFotoActualizada($referncia, $encarpetado.$filename);
						if(!isset($_SESSION)){ 
							session_start(); 
						}
						unset($_SESSION['rutas_save']); 
						$_SESSION['rutas_save'] = $this->Json;
						echo 1;
					}else{
						echo -1;
					}
				}
			}else{
				echo 0;
			}
		}
	}

	//Busca si hay fotos en otras carpetas si lo encuentra lo reemplaza por la nueva foto(Editada con guiones agotados)
	function ReemplazarFotoActualizada($referncia, $rutaOrigenFoto, $ruta = "../../ownCloud/fotos_nube"){
		$rpta = 0;
		$ruta = $ruta."/";
		if(is_dir($ruta)) {
			if($dir = opendir($ruta)) {
				while(($archivo = readdir($dir)) !== false) {
					if($archivo != '.' && $archivo != '..') {
						$r = $ruta.$archivo;

						if (!is_dir($r)){
							$arch = str_replace('.jpg','', $archivo);
							
							if($referncia == $arch && $rutaOrigenFoto != $r){
								copy($rutaOrigenFoto, $r);
								array_push($this->Json, $ruta.$archivo);
							}
						}else{
							$this->ReemplazarFotoActualizada($referncia, $rutaOrigenFoto, $r);
						}
					}
				}
				closedir($dir);
			} 
		}
	}

	//Funcion para mover una o varias imagenes de una carpeta a otra
	function MoverFoto($rutaMover, $rutaActual, $referencias){
		$rutaActual = $this->rutaFotosPorSeccion.$this->ConvertirRutaView($rutaActual);
		$rutaMover = $this->rutaFotosPorSeccion.$this->ConvertirRutaView($rutaMover);
		$vectorReferencias = explode("*", $referencias);
		array_pop($vectorReferencias);
		foreach( $vectorReferencias as $index => $value){
			try {
				copy($rutaActual.$value.".jpg", $rutaMover.$value.".jpg");
				unlink($rutaActual.$value.".jpg");
				$rpta = 1;
			} catch (\Throwable $th) {
				echo $rpta = -1;
			}
			
		}
		echo $rpta;
	}


//--------------------------------Manejo de archivos----------------------------------------

//--------------------------------Web Service-----------------------------------------------

	//Forma 1

	//Funcion que valida si la referencia esta en la session de productos HGI
	function ValidarExistenciaHGI($referncia){
		if(isset($_SESSION["ProductosHGI"])){
			$key = array_search($referncia, array_column($_SESSION["ProductosHGI"], 'StrIdProducto'));
			if($key == false){
				return -1;
			}else{
				return $_SESSION["ProductosHGI"][$key]->StrDescripcion;
			}
		}else{
			return -1;
		}
	}

	//Funcion que consulta y guarda todos los productos en una session para luego ser consultada
	function ConsultarProductosHGI(){
		$rptaProducto=json_decode($this->ConsultarWebService("ListarProductos",false, $this->urlWebService));
		if(isset($_SESSION["ProductosHGI"])){
			unset($_SESSION["ProductosHGI"]);
		}
		$_SESSION["ProductosHGI"] = $rptaProducto;
	}

	
	//Forma 2 en uso 

	function ConsultarProductosJSON(){
		if(!empty($this->vectorFotosParaConsultarHGI)){
			$this->rptaProducto = "";
			$this->strParametros=array('strProductos'=>json_encode($this->vectorFotosParaConsultarHGI));
			$this->rptaProducto=json_decode($this->ConsultarWebService("ListarProductosPorVector",true, $this->urlWebService));
		}
		
	}

	function ConsultarProductosPorClasificacion($ruta){
		
		if($this->rptaProducto == ""){
			$ruta = str_replace($this->rutaFotosPorSeccion."/", "", $ruta);
			$vect = explode("/", $ruta);
			$clase = 'general';
			$linea = 'general';
			$grupo = 'general';
			$tipo = 'general';
			for ($i=0; $i < sizeof($vect); $i++) { 
				if($i == 0 && $vect[$i] != ""){
					$clase = $vect[$i];
				}else if($i == 1 && $vect[$i] != ""){
					$linea = $vect[$i];
				}else if($i == 2 && $vect[$i] != ""){
					$grupo = $vect[$i];
				}else if($i == 3 && $vect[$i] != ""){
					$tipo = $vect[$i];
				}
			}
			$this->strParametros=array('strClase'=>$clase, 'strLinea'=>$linea, 'strGrupo'=>$grupo, 'strTipo'=>$tipo);
			$this->rptaProducto=json_decode($this->ConsultarWebService("ListarProductosPorClasificacion",true, $this->urlWebService));
		}
		
		
	}

	function ConsultarReferenciaObjetoHGI($referncia, $array){
		$key = array_search($referncia, array_column($array, 'StrIdProducto'));
		if($key === false){
			return -1;
		}else{
			return $array[$key]->StrDescripcion;
		}
		
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

//--------------------------------Web Service-----------------------------------------------		



//--------------------------------SECCION DESHACER------------------------------------------



function DeshacerAgotado($referncia){
	//ELimina el encabezado Base de datos
	$this->EliminarAgotado($referncia, true);

	//Pega la foto de agotados a las rutas guardadas del encarpetado de fotos_nube
	if(isset($_SESSION['rutas_save'])){
		foreach ($_SESSION['rutas_save'] as $key => $value) {
			copy("../../Agotados/".$referncia."/Agotado/".$referncia.".jpg", $value);
		}
	}

	//Encarpetado Agotados
	$this->SacarFotoAgotados($referncia);
}

function DeshacerDetalleAgotado($referncia){
	//ELimina el encabezado y detalle Base de datos
	$this->chmod_r("../../Agotados/".$referncia."/Agotado", 0777, 0777);
	if(!isset($_SESSION)){ 
		session_start(); 
	}
	foreach ($_SESSION['guiones'] as $key => $value) {
		if($key != 0){
			$this->EliminarDetalleAgotado($_SESSION['guiones'][0], $value);
		}
	}

	if(isset($_SESSION['rutas_save'])){
		foreach ($_SESSION['rutas_save'] as $key => $value) {
			copy("../../Agotados/".$referncia."/Agotado/".$referncia.".jpg", $value);
		}
	}

	/*$src = $this->ConvertirRutaView($rutaActual);
	$ruta = "../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO/".$src.$referncia.".jpg";
	copy("../../Agotados/".$referncia."/Agotado/".$referncia.".jpg", $ruta);

	//Pegar la foto afuera
	copy($ruta, "../../ownCloud/fotos_nube/".$referncia.".jpg");*/
	$this->SacarFotoAgotadosDeshacer($referncia);
}

function DeshacerFotosActualizado($referncia){
	$r = "";
	$this->chmod_r("../../Agotados/".$referncia, 0777);
	if(isset($_SESSION['rutas_save'])){
		foreach ($_SESSION['rutas_save'] as $key => $value) {
			if(file_exists("../../Agotados/".$referncia."/Agotado/".$referncia.".jpg") && file_exists( $value) ){
				//chmod($value, 0777);
				if(copy("../../Agotados/".$referncia."/Agotado/".$referncia.".jpg", $value)){
					$r.=$key.": ".$value."_____";
				}else{
					$r.="bad ".$value;
				}
			}
		}
	}
	$return_arr[] = array("rpta1"=>$r);
	echo json_encode($return_arr);
	$this->SacarFotoAgotadosDeshacer($referncia);
}


//--------------------------------SECCION DESHACER------------------------------------------


function DescargarFotos($referencia, $rutaDefault){
	 //Utilizamos basename por seguridad, devuelve el 
	//nombre del archivo eliminando cualquier ruta. 
	$archivo = basename($referencia);

	$ruta = '../../ownCloud/fotos_nube/'.$archivo;
	if(!file_exists($ruta)){
		$ruta = $this->rutaFotosPorSeccion.$rutaDefault.'/'.$archivo;
	}
	//echo $ruta;
	if (is_file($ruta)){
		header('Content-Type: application/force-download');
		header('Content-Disposition: attachment; filename='.$archivo);
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($ruta));
	
		readfile($ruta);
	}else{
		exit();
	}
}

function getIP(){

    if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        return $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        return $_SERVER["REMOTE_ADDR"];
    }

}

}




?>