<?php 
include_once ("../Model/clsPortafolioModel.php");
include_once ("../Model/clsLoginModel.php");
include_once("../Classes/nusoap/nusoap.php");
session_start();

if(!isset($_SESSION['StrDir'])){
$_SESSION['StrDir']='../../ownCloud/fotos_nube/FOTOS  POR SECCION CON PRECIO';
//echo 'ojo';
}


$Mosaico = new Mosaico();

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
		$this->strParametros = "";


	}
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
			//var_dump($this->strParametros);
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
		  <input type='text' id='link' class='form-control lbl' aria-describedby='inputGroup-sizing-default' readonly value='https://".$Url."?code=".$rpta[0]['id']."'><br>
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
}

 ?>