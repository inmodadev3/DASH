<?php
ini_set('max_execution_time', 300);
date_default_timezone_set("America/Bogota");
include_once ("../Model/clsVendedoresModel.php");
include_once ("../Controller/TerceroController.php");
include_once ("../WebServices/clsClaseWebService.php");
date_default_timezone_set('America/Bogota');
$objVendedorController= new clsParametrizarVendedor();
if(isset($_POST['btnListarVendedoresNoParametrizados'])){
$objVendedorController->PintarTablaVendedores();
}
if(isset($_POST['btnAgregarVendedor'])){
$objVendedorController->AgregarVendedor();
}
if(isset($_POST['btnListarLineas']))
{
$objVendedorController->PintarTblLineas();
}
if(isset($_POST['btnAgregarLineasVendedor'])){
$objVendedorController->AsignarLineasVendedor();
}
if(isset($_POST['btnListarCiudadesPorZona'])){
$objVendedorController->ListarCiudadesPorZona();
}
if(isset($_POST['btnIngresarIngreso'])){
$objVendedorController->IngresarIngreso();
}
if(isset($_POST['btnListarIngresos'])){
$objVendedorController->ListarIngresos();
}
if(isset($_POST['btnListarMetaDeVendedor'])){
$objVendedorController->ListarMetasPorVendedor();
}
if(isset($_POST['btnActualizarValorMeta'])){
$objVendedorController->ActualizarMeta();
}
if(isset($_POST['btnConsultarVendedor'])){
$objVendedorController->ConsultarVendedor();
}
if(isset($_POST['btnGenerarComision'])){
$objVendedorController->CalcularComision();
}
if(isset($_POST['btnListarLiquidacion'])){
$objVendedorController->ListarLiquidacion();
}
if(isset($_POST['btnListarLiquidacionPeriodo'])){
$objVendedorController->ConsultarLiquidacionPeriodo();
}
if(isset($_POST['btnListarVendedorPorTipo'])){
$objVendedorController->ListarVendedoresPorTipo();
}
if(isset($_POST['btnEliminarIngreso'])){
$objVendedorController->EliminarIngreso();
}
if(isset($_POST['btnImprimirLiquidacion'])){
$objVendedorController->ImprimirLiquidacion();
}
if(isset($_POST['btnVisualizarIngreso'])){
$objVendedorController->ListarIngreso();
}
if(isset($_POST['btnActualizarIngreso'])){
$objVendedorController->ActualizarIngreso();
}
if(isset($_POST['btnAgregarEgreso'])){
$objVendedorController->AgregarEgreso();
}
if(isset($_POST['btnListarEgresos'])){
$objVendedorController->ListarEgresos();
}
if(isset($_POST['btnListarEgresosComision'])){
$objVendedorController->ListarEgresoComision();
}
if(isset($_POST['btnEfectuarEgresos'])){
$objVendedorController->EfectuarEgresoComision();
}
if(isset($_POST['btnEstadoEgreso'])){
	$objVendedorController->EstadoEgreso();
}
if(isset($_POST['btnListarDocumentoLiquidacion'])){
$objVendedorController->ListarDocumentosLiquidacion();
}
if(isset($_POST['btnEliminarLiquidacion'])){
$objVendedorController->EliminarLiquidacion();
}
if(isset($_POST['btnEliminarEgreso'])){
$objVendedorController->EliminarEgreso();
}
if(isset($_POST['btnConsultarEmpleadosAsociados'])){
$objVendedorController->ConsultarEmpleadosAsociados();
}
if(isset($_POST['btnConsultarCompaniaEmpleadosAsociados'])){
$objVendedorController->ConsultarCompaniaEmpleadosAsociados();
}
if(isset($_POST['btnConsultarDocumentos'])){
$objVendedorController->ConsultarDocumentos();
}
if(isset($_POST['btnConsultarTipoEmpleado'])){
$objVendedorController->ConsultarTipoEmpleado();
}
if(isset($_POST['btnListarClientes'])){
$objVendedorController->ListarClientes();
}
if(isset($_POST['btnListarProductos'])){
$objVendedorController->ListarProductos();
}
if(isset($_POST['btnListarTransaccion'])){
$objVendedorController->ListarTransacciones();
}

if(isset($_POST['btnListarZonas'])){
$objVendedorController->PintarTblZonas($_POST['txtCedula']);
}
if(isset($_POST['btnActualizarZonasVendedor'])){
$objVendedorController->ActualizarZonasVendedor($_POST['strCedulaVendedor'], $_POST['txtCodigoZona'], $_POST['blnEstadoZonaVendedor']);
}
$objVendedorController=null;
class clsParametrizarVendedor
{
	private $UrlWebService;
	private $strIdTipoEmpleado;
	private $strNombre;
	private $strComision;
	private $strFlete;
	private $strDescuento;
	private $strDeduccion;
	private $ddlZona;
	private $strCedula;
	private $strIdCodigoLinea;
	private $blnEstadoLineaVendedor;
	private $intIdZona;
	private $intSerie;
	private $intValor;
	private $dtFechaInicial;
	private $dtFechaFinal;
	private $strPeriocidad;
	private $intTipo;
	private $intMeta;
	private $intTipoMeta;
	private $intValorMeta;
	private $strBaseMeta;
	private $strTipoBaseMeta;
	private $intCompania;
	private $strTipoBase;
	private $strTipoVendedor;
	private $strVendedor;
	private $strTipoBaseIngreso;
	private $intIva;
	private $intDescuento;
	private $intTiempoVisita;
	private $strDiasVisita;
	private $strTipoMeta;
	private $intAnno;
	private $strCodigo;
	private $intEstado;
	private $intMes;
	private $strMesTipo;
	private $intIdIngreso;
	private $intNroLiquidacion;
	private $strTipoTemporal;
	private $intCuota;
	private $intIdLiquidacion;
	private $idLogin;
	private $strTransacciones;
	function __construct()
	{	
		$this->UrlWebService="http://10.10.10.150/webservice/WebModaService.asmx?WSDL";
		$this->strIdTipoEmpleado='';
		$this->strNombre='';
		$this->strTipoTemporal='';
		$this->intCuota=0;
		$this->strComision='';
		$this->strFlete='';
		$this->strDescuento='';
		$this->strDeduccion='';
		$this->ddlZona='';
		$this->strCedula='';
		$this->strIdCodigoLinea='';
		$this->blnEstadoLineaVendedor='';
		$this->intIdZona='';
		$this->intSerie='';
		$this->strCodigo='';
		$this->intValor='';
		$this->dtFechaInicial='';
		$this->dtFechaFinal='';
		$this->strPeriocidad='';
		$this->intTipo='';
		$this->intMeta='';
		$this->intTipoMeta='';
		$this->intValorMeta='';
		$this->strBaseMeta='';
		$this->strTipoBaseMeta='';
		$this->intCompania='';
		$this->strTipoBase='';
		$this->strTipoVendedor='';
		$this->strVendedor='';
		$this->strTipoBaseIngreso='';
		$this->intIva='';
		$this->intDescuento='';
		$this->intTiempoVisita='';
		$this->strDiasVisita='';
		$this->strTipoMeta='';
		$this->intAnno='';
		$this->intEstado='';
		$this->intMes='';
		$this->strMesTipo='';
		$this->intIdIngreso='';
		$this->intNroLiquidacion='';
		$this->intIdLiquidacion='';
		$this->idLogin='';
		$this->strTransacciones='';
	}
	private function ConsultarWebService($Tipo){
			$client = new SoapClient($this->UrlWebService);
			$WebService=$client->$Tipo(); 
			$client=null;
		  	return	$WebService;
	}

	
	public function PintarTablaVendedores(){
		  $EstructuraTablaVendedores="";
		  $objVendedorModel= new clsVendedoresModel();
		  $objVendedorModel->ListarVendedores();
		  $Vendedores=$objVendedorModel->GetRespuesta();

		  @session_start();
		  $objVendedoresAsociados=new clsVendedoresModel();
		  $objVendedoresAsociados->ConsultarEmpleadosAsociados($_SESSION['idLogin'],'','2');
		  $strVendedoresAsociados=$objVendedoresAsociados->GetRespuesta();


		  $TablaVendedores=$this->ConsultarWebService('ConsultarVendedores');
		  $DatosVendedores=explode('&',$TablaVendedores->ConsultarVendedoresResult);
		  $k=1;
		  $strZonaVendedor='';

		  if(sizeof($strVendedoresAsociados)==0 && $_SESSION['idLogin']!='1'){
		  	$EstructuraTablaVendedores='<tr><td><h3>No tiene vendedores asociados.</h3></td></tr>';
		  }
		  for($i=1;$i<=sizeof($DatosVendedores)-2;$i++){	
		  	$DatosVendedoresFila=explode('%',$DatosVendedores[$i]);	 

		  		$blnBandera=false;	
				for($j=0;$j<=sizeof($objVendedoresAsociados->GetRespuesta())-1;$j++){
						if($strVendedoresAsociados[$j]['strCedulaEmpleado']==$DatosVendedoresFila[0]){
						    $blnBandera=true;
						}
				}
				if($_SESSION['idLogin']=='1'){
					$blnBandera=true;
				}
			    if($blnBandera){	 
		  		for($j=0;$j<=sizeof($Vendedores)-1;$j++){
		  			if($DatosVendedoresFila[0]==$Vendedores[$j]['strCedula']){
		  				$strZonaVendedor=$Vendedores[$j]['intIdZona'];
		  				$strCompaniaVendedor=$Vendedores[$j]['intIdCompania'];
		  				break;
		  			}
		  		}
		  		@$EstructuraTablaVendedores.="<tr id='cell".$k."'><td>".$k."</td><td>".$DatosVendedoresFila[0]."</td><td>".$DatosVendedoresFila[1]."</td><td style='display:none;'>".$DatosVendedoresFila[2]."</td><td>".$DatosVendedoresFila[3]."</td><td><button type='button' class='btn btn-default' onclick='SeleccionarVendedor(\"".$k."\");'><i class='glyphicon glyphicon-log-in'></i></button></td><td style='display:none'>".$strZonaVendedor."</td><td>".$strCompaniaVendedor."</td></tr>";		  	
		  			$k++;
		  			$strZonaVendedor='';
		  		}
		  }
	
		 echo $EstructuraTablaVendedores;
	}
	//Esete metodo funciona para....
	public function AgregarVendedor(){
		$this->strIdTipoEmpleado=trim($_POST['txtTipoEmpleado']);
		$this->strCedula=trim($_POST['txtCedula']);
		$this->strNombre=trim($_POST['txtNombre']);
		$this->intIdZona=trim($_POST['ddlZona']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->AgregarVendedor($this->strIdTipoEmpleado,$this->strCedula,$this->strNombre,$this->intIdZona);
		$this->AgregarMetas();
		$objVendedorModel=null;
	}
	public function ListarZonasVendedor(){
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ListarZonasVendedor();
		$ZonasVendedor=$objVendedorModel->GetRespuesta();
		$EstructuraDddlZonas='';
		for($i=0;$i<=sizeof($ZonasVendedor)-1;$i++){
			$EstructuraDddlZonas.="<option value='".$ZonasVendedor[$i]['intId']."'>".$ZonasVendedor[$i]['strDescripcion']."</option>";
		}
		$objVendedorModel=null;
		return $EstructuraDddlZonas;
	}
	public function PintarTblLineas(){
		//Se cambio lineas por clases 31/05/2019
		$this->strCedula=trim($_POST['txtCedula']);
		@session_start();
		$EstruturaTblLineas='';
		$objVendedorModel= new clsVendedoresModel();
		/* Consultamos las lineas del vendedor asociado de acuerdo al usuario del DASH*/
		$objVendedorModel->ListarLineasPorVendedor($this->strCedula);
		$LineasVendedor=$objVendedorModel->GetRespuesta();

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
             			$blnCheckLinea='checked';
             			$strClaseTr='success';
             			break;
             		}
             	}
             	$EstruturaTblLineas.="<tr id='rowL".($i+1)."' class='".$strClaseTr."'><td><input ".$blnCheckLinea." type='checkbox' id='checkL".($i+1)."' onchange='tblLineasSelect(".($i+1).")'></td><td>".$strClasesRpWs[$i]->StrIdClase."</td><td>".$strClasesRpWs[$i]->StrDescripcion."</td></tr>";
             }        	                                                  
         }else{
         	echo 'No se a cargado la Lineas.';
         }
	      echo $EstruturaTblLineas;
	      $objVendedorModel=null;
	}
	public function PintarTblZonas($txtCedula){
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ListarZonasVendedor();
		$Zonas=$objVendedorModel->GetRespuesta();
		$FilasZonas = "";

		$objVendedorModel->ListarZonasVendedor2($txtCedula);
		$ZonasVendedor=$objVendedorModel->GetRespuesta();
		$FilasZonas = "";
		
		for($i=0;$i<=sizeof($Zonas)-1;$i++){
			$blnCheckLinea = "";
			$strClaseTr = "";
			for($j=0;$j<=sizeof($ZonasVendedor)-1;$j++){
				if(trim($Zonas[$i]['intId'])==$ZonasVendedor[$j]['intIdZona']){
					$blnCheckLinea='checked';
					$strClaseTr='success';
					break;
				}
			}
			$FilasZonas.="<tr id='rowZ".($i+1)."' class='".$strClaseTr."'><td><input ".$blnCheckLinea." type='checkbox' id='checkZ".($i+1)."' onchange='tblLineasSelect(".($i+1).")'>
			</td><td>".$Zonas[$i]['intId']."</td><td>".$Zonas[$i]['strDescripcion']."</td></tr>";
		}

		echo $FilasZonas;

	}
	public function ActualizarZonasVendedor($txtCedula, $txtCodigoZona, $txtEstado){
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ActualizarZonasVendedor($txtCedula, $txtCodigoZona, $txtEstado);
		$rpta=$objVendedorModel->GetRespuesta();
		var_dump($rpta);

	}
	public function AsignarLineasVendedor(){
		$this->strCedula=trim($_POST['txtCedulaVendedor']);
		$this->strIdCodigoLinea=trim($_POST['txtCodigoLinea']);
		$this->blnEstadoLineaVendedor=trim($_POST['txtEstadoLineaVendedor']);
		$this->intIdZona=trim($_POST['ddlZona']);
		$intIdCompania= trim($_POST['intIdCompania']);
		 $objVendedorModel= new clsVendedoresModel();
		if($this->blnEstadoLineaVendedor=='true'){
			$objVendedorModel->AsignarLineaVendedor($this->strCedula,$this->strIdCodigoLinea,$this->intIdZona,$intIdCompania);
		}
		if($this->blnEstadoLineaVendedor=='false'){
			$objVendedorModel->EliminarLineaVendedor($this->strCedula,$this->strIdCodigoLinea,$this->intIdZona,$intIdCompania);
		}
		$objVendedorModel=null;
	}
	public function ListarCiudadesPorZona(){
		$this->intIdZona=trim($_POST['txtZona']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ListarCiudadesPorZonaPorVendedor($this->intIdZona);
		$strCiudadesVendedor=$objVendedorModel->GetRespuesta();
		if($strCiudadesVendedor==null){
			echo ' <li class="list-group-item list-group-item-default"><strong>No hay ciudades registradas para esta zona.</strong></li>';
			$objVendedorModel=null;
			return;
		}
		$EstructuraCiudadesPorZona='';
		$strCiudades =explode('%',$this->ConsultarWebService('ConsultarCiudades')->ConsultarCiudadesResult);
		$k=0;
		for($i=0;$i<=sizeof($strCiudadesVendedor)-1;$i++){
			for($k=0;$k<=sizeof($strCiudades);$k=$k+2){
			if($strCiudadesVendedor[$i]['intIdCiudad']==$strCiudades[$k]){
				$EstructuraCiudadesPorZona.="<li class='list-group-item list-group-item-default'><strong>".$strCiudades[$k+1]."</strong></li>";
				break;
			}}
		}
		echo $EstructuraCiudadesPorZona;
		$objVendedorModel=null;
	}
	public function IngresarIngreso(){
		$this->strNombre=trim($_POST['strNombre']);
		$this->intSerie=trim($_POST['intSerie']);
		$this->intValor=trim($_POST['intValor']);
		$this->dtFechaInicial=trim($_POST['dtFechaInicial']);
		$this->dtFechaFinal=trim($_POST['dtFechaFinal']);
		$this->strPeriocidad=trim($_POST['strPeriocidad']);
		$this->intTipo=trim($_POST['intTipo']);
		$this->intMeta=trim($_POST['intMeta']);
		$this->intTipoMeta=trim($_POST['intTipoMeta']);
		$this->intValorMeta=trim($_POST['intValorMeta']);
		$this->strBaseMeta=trim($_POST['strBaseMeta']);
		$this->strTipoBaseMeta=trim($_POST['strTipoBaseMeta']);
		$this->intCompania=trim($_POST['intCompania']);
		$this->strCedula=trim($_POST['intCedulaVendedor']);
		$this->strTipoBase=trim($_POST['strTipoBase']);
		$this->strTipoVendedor=trim($_POST['strTipoVendedor']);
		$this->strVendedor=trim($_POST['strVendedor']);
		$this->strTipoBaseIngreso=trim($_POST['strTipoBaseIngreso']);
		$this->intIva=trim($_POST['intIva']);
		$this->intDescuento=trim($_POST['intDescuento']);
		$this->intTiempoVisita=trim($_POST['intTiempoVisita']);
		$this->strDiasVisita=trim($_POST['strDiasVisita']);
		$this->intEstado=trim($_POST['intEstado']);
		$this->strTransacciones=trim($_POST['strTransacciones'],",");
		$strTipoPeriocidad=2;
		$strDia=date("d");

		$strDiaCreacion='01';
		$strMes=date('m');
		$intAnno=date('Y');
		if($this->intTipo==0){
		if($this->strPeriocidad=='MS'){
			$strTipoPeriocidad=0;
		}else{
		if($strDia>=1 && $strDia<=15){
			$strTipoPeriocidad=1;
		}else{
			$strDiaCreacion='16';
		}
		}
		}else if($this->intTipo==2){
			$strDia=explode("-",str_replace("0", "", $this->dtFechaInicial));
			if($strDia[2]>=1 && $strDia[2]<=15){
				$strTipoPeriocidad=1;
			}else{
				$strDiaCreacion='16';
				$strTipoPeriocidad=2;	
			}
		}else if($this->intTipo==1){
			$this->strPeriocidad='MS';
			$strDia=explode("-",str_replace("0", "", $this->dtFechaInicial));
			if($strDia[2]>=1 && $strDia[2]<=15){
				$strTipoPeriocidad=1;
			}else{
				$strDiaCreacion='16';
				$strTipoPeriocidad=2;	
			}
		}	
		if($strMes<=9){
			$strMes='0'.$strMes;
		}
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->IngresarIngreso($this->strNombre,$this->intSerie,$this->intValor,$this->dtFechaInicial,$this->dtFechaFinal,$this->strPeriocidad,$this->intTipo,$this->intMeta,$this->intTipoMeta,$this->intValorMeta,$this->strBaseMeta,$this->strTipoBaseMeta,$this->intCompania,$this->strCedula,$this->strTipoBase,$this->strTipoVendedor,$this->strVendedor,$this->strTipoBaseIngreso,$this->intIva,$this->intDescuento,$this->intTiempoVisita,$this->strDiasVisita,$strTipoPeriocidad,$this->intEstado,date('Y-m-d'),$this->strTransacciones);	
		echo $objVendedorModel->GetRespuesta()[0]['Mensaje'];
		$objVendedorModel=null;
	}

	public function ListarIngresos(){
		$this->strCedula=trim($_POST['strCedula']);
		$this->intCompania=trim($_POST['intCompania']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ListarIngresos($this->strCedula,$this->intCompania);
		$strIngresos=$objVendedorModel->GetRespuesta();
		$strEstructuraTblIngreso='';	
		if($strIngresos==null){
			$strEstructuraTblIngreso='<tr><td><h3>No se encuentra ingresos registrados</h3></td><tr>';
		}
		for($i=0;$i<=sizeof($strIngresos)-1;$i++){
			if($strIngresos[$i]['intCompania']==1){
				$strCompania='Blanca';
			}else{
				$strCompania='Verde';
			}
			if($strIngresos[$i]['strEstado']==1){
				$strEstado='Activo';
			}else{
				$strEstado='Desactivado';
			}
			$strEstructuraTblIngreso.="<tr><td style='display:none;'>".$strIngresos[$i]['intId']."</td><td>".($i+1)."</td><td>".$strIngresos[$i]['strNombre']."</td><td>".$strCompania."</td><td>".$strIngresos[$i]['dtCreacion']."</td><td>".$strIngresos[$i]['strPeriocidad']."</td><td>".$strEstado."</td><td><button class='btn btn-default' onclick='VistaIngreso(\"".$strIngresos[$i]['intId']."\")'><span class='glyphicon  glyphicon-pencil'></span></button>&nbsp;<button class='btn btn-default' onclick='EliminarIngreso(\"".$strIngresos[$i]['intId']."\")'><span class='glyphicon glyphicon-remove'></span></button></td></tr>";
		}
		echo $strEstructuraTblIngreso;
		$objVendedorModel=null;	
	}
	private function AgregarMetas(){
		$this->strCedula=trim($_POST['txtCedula']);
		$strTipoMeta=array('VN','RC','RCVN');
		$objVendedorModel= new clsVendedoresModel();
		for($i=1;$i<=2;$i++){
		for($j=0;$j<=sizeof($strTipoMeta)-1;$j++){
		$objVendedorModel->AgregarMetas($strTipoMeta[$j],$this->strCedula,date('Y'),$i);
		}}
		$objVendedorModel=null;
	}
	public function ListarMetasPorVendedor(){
		$this->strCedula=trim($_POST['strCedula']);
		$this->strTipoMeta=trim($_POST['strTipoMeta']);
		$this->intAnno=trim($_POST['intAnno']);
		$this->intCompania=trim($_POST['intCompania']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ListarMetasPorVendedor($this->strCedula,$this->intAnno,$this->strTipoMeta,$this->intCompania);
		$strRespuesta=$objVendedorModel->GetRespuesta();
		$strEstructuraTblMeta="";
		for($i=0;$i<=sizeof($strRespuesta)-1;$i++){
			if($strRespuesta[$i]['intCompania']=='1'){
				$strCompania='Blanca';
			}else{
				$strCompania='Verde';
			}
			$strEstructuraTblMeta.="<tr><td>".($i+1)."</td><td style='display:none;'>".$strRespuesta[$i]['intId']."</td><td>".$strRespuesta[$i]['strNombre']."</td><td>".number_format($strRespuesta[$i]['intValor'])."</td><td>".$strCompania."</td></tr>";
		}
		echo $strEstructuraTblMeta;
		$objVendedorModel=null;
	}
	private function Validar($Tipo){
		switch ($Tipo) {
			case 'ActualizarMeta':
					if($this->intValor==''){
						echo 'iIngrese valor.%error';
						return false;
					}
					if(!(is_numeric($this->intValor))){
						echo 'Ingrese solo números en el campo valor de la meta.%error';
						return false;
					}
					if($this->intValor<0){
						echo 'Ingrese valor correcto.%error';
						return false;
					}
			break;	
		}
		return true;
	}
	public function ActualizarMeta(){
		$this->strCodigo=trim($_POST['strCodigo']);
		$this->intValor=trim($_POST['intValor']);
		if(!$this->Validar('ActualizarMeta')){
			return;
		}
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ActualizarMeta($this->strCodigo,$this->intValor);
		echo $objVendedorModel->GetRespuesta()[0]['Mensaje']."%success";
		$objVendedorModel=null;
	}
	public function CalcularComision(){	


		$this->strCedula=trim($_POST['strCedula']);
		$this->intCompania=trim($_POST['intCompania']);
		$this->intMes=trim($_POST['strMes']);
		$this->strMesTipo=trim($_POST['intPeriodo']);
		$this->intAnno=trim($_POST['intAnno']);

		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ConsultarIngresosVendedor($this->strCedula,$this->intCompania);
		$strRespuesta=$objVendedorModel->GetRespuesta();
		$objVendedorModel->ListarLineasPorVendedor($this->strCedula);
		$strRespuestaLineas=$objVendedorModel->GetRespuesta();
		$objVendedorModel->ListarCiudadesPorVendedor($this->strCedula);
		$strRespuestaCiudades=$objVendedorModel->GetRespuesta();



	    $blnEstado=false;
	    $strValor='';
	    $intContador=0;
	    if($strRespuesta==null){
	    	echo '8';
	    	return;
	    }
	    if($strRespuestaLineas==null){
	    	echo '9';
	    	return;
	    }
	    @session_start();
	    $objVendedorModel->CrearLiquidacionEncabezado($this->strCedula,$this->intMes,$this->intCompania,$this->strMesTipo,$_SESSION['Empleado'],$this->intAnno);

	    for($p=0;$p<=sizeof($strRespuesta)-1;$p++){
    		//Calcular metas
			if($strRespuesta[$p]['intMeta']==1){

	    		$intValorMeta=0;
	    		$intValorMetaBase=0;
	    		$strMes='';
				if($strRespuesta[$p]['intTipoMeta']==0){
					$intValorMeta=$strRespuesta[$p]['intValorMeta'];
				}else{
					$ArrayMeses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
					for($i=0;$i<=sizeof($ArrayMeses)-1;$i++){
						if(($i+1)==$this->intMes){
							$strMes=$ArrayMeses[$i];
						}
					}
						//suma la meta de verde y blanca
						for($intCompania=1;$intCompania<=2;$intCompania++){
						$objVendedorModel->ConsultarMetaAVendedor($this->strCedula,$strMes,$intCompania,$strRespuesta[$p]['strBaseMeta'],$this->intAnno);
				
						$intValorMeta+=$objVendedorModel->GetRespuesta()[0]['intValor'];
						}
					
						if($intValorMeta==null){
							$intValorMeta=0;
						}
						if($intValorMeta!=null){
						if($this->strMesTipo==1 || $this->strMesTipo==2){
							$intValorMeta=$intValorMeta/2;
						}}

				}	

				//metaa
				//blanca ventas
				$parametros=array(); 
				$parametros['Cia']='1';
				$parametros['Tipo']=$strRespuesta[$p]['strBaseMeta'];
				$parametros['TipoVendedor']='PP';
				$parametros['Vendedor']=$strRespuesta[$p]['strCedulaVendedor'];	
				$parametros['Transacciones']="'04','041'";
				$strAnno='';

				$strDia='';
				$strDiasUltimo="01";
				if($this->strMesTipo==1){
					$strMes=$this->intMes;
					$strAnno=$this->intAnno;
					$strDia='15';
				}else
				if($this->strMesTipo==2){
					if($strRespuesta[$p]['strPeriocidad']=='QC'){
						$strDiasUltimo="16";
					}
					$strMes=$this->intMes;
					$strAnno=$this->intAnno;
					$strDia=date("d",(mktime(0,0,0,$strMes+1,1,$strAnno)-1));
				}else if($this->strMesTipo==0){
					$strMes=$this->intMes;
					$strAnno=$this->intAnno;
					$strDia=date("d",(mktime(0,0,0,$strMes+1,1,$strAnno)-1));
				}
				if($strMes<=9){
					$strMes="0".$strMes;
				}	
				$parametros['FechaIni']=$strAnno.'-'.$strMes.'-'.$strDiasUltimo;
				$parametros['FechaFin']=$strAnno.'-'.$strMes.'-'.$strDia;			
				$client = new SoapClient($this->UrlWebService);
				$strWSVenta=$client->LiquidarComision($parametros);
				echo $strWSVenta;
				if($strWSVenta->LiquidarComisionResult==null){
					$intValorMetaBase=0;
				}else{			
				$strMeta=explode("&#",$strWSVenta->LiquidarComisionResult);
				for($t=0;$t<=sizeof($strRespuestaLineas)-1;$t++){
					for($w=0;$w<=sizeof($strMeta)-2;$w++){
						$strMetaFila=explode('%',$strMeta[$w]);
						if($strRespuesta[$p]['strTipoBaseMeta']=='TTss'){
							$intValorMetaBase+=$strMetaFila[4];
						}else{
						if($strRespuestaLineas[$t]['intCodigoLinea']==$strMetaFila[3]){
							$intValorMetaBase+=$strMetaFila[4];
						}}
					}
				}
				//ventas  verde meta total
				$parametros=array(); 
				$parametros['Cia']='2';
				$parametros['Tipo']=$strRespuesta[$p]['strBaseMeta'];
				$parametros['TipoVendedor']='PP';
				$parametros['Vendedor']=$strRespuesta[$p]['strCedulaVendedor'];	
				$parametros['Transacciones']="'09'";
				$strAnno='';
			
				$strDia='';
				$strDiasUltimo="01";
				if($this->strMesTipo==1){
					$strMes=$this->intMes;
					$strAnno=$this->intAnno;
					$strDia='15';
				}else
				if($this->strMesTipo==2){
					if($strRespuesta[$p]['strPeriocidad']=='QC'){
						$strDiasUltimo="16";
					}
					$strMes=$this->intMes;
					$strAnno=$this->intAnno;
					$strDia=date("d",(mktime(0,0,0,$strMes+1,1,$strAnno)-1));
				}else if($this->strMesTipo==0){
					$strMes=$this->intMes;
					$strAnno=$this->intAnno;
					$strDia=date("d",(mktime(0,0,0,$strMes+1,1,$strAnno)-1));
				}
				if($strMes<=9){
					$strMes="0".$strMes;
				}
				$parametros['FechaIni']=$strAnno.'-'.$strMes.'-'.$strDiasUltimo;
				$parametros['FechaFin']=$strAnno.'-'.$strMes.'-'.$strDia;	
				echo $parametros;	

				$client = new SoapClient($this->UrlWebService);
				$strWSVenta=$client->LiquidarComision($parametros);
				if($strWSVenta->LiquidarComisionResult==null){
					if($intValorMetaBase==0){
						$intValorMetaBase=0;
					}
				}else{			
				$strMeta=explode("&#",$strWSVenta->LiquidarComisionResult);
				for($t=0;$t<=sizeof($strRespuestaLineas)-1;$t++){
					for($w=0;$w<=sizeof($strMeta)-2;$w++){
						$strMetaFila=explode('%',$strMeta[$w]);
						if($strRespuesta[$p]['strTipoBaseMeta']=='TT'){
							$intValorMetaBase+=$strMetaFila[4];
						}else{
						if($strRespuestaLineas[$t]['intCodigoLinea']==$strMetaFila[3]){
							$intValorMetaBase+=$strMetaFila[4];
						}}
					}
				}
			}	
			if($intValorMetaBase>=$intValorMeta){
				$blnEstado=true;
			}else{
				$blnEstado=false;
				}
			}
				$strWSVenta=null;
			}else{
				$blnEstado=true;	
			}
			//echo $intValorMetaBase;

			/*Meta*/
			$intMontoIngreso=0;
			$blnActualizarIngreso=false;
			$blnEstadoIngreso=1;
			$intCantidad=0;
			if($this->strMesTipo==0){
			if($strRespuesta[$p]['strPeriocidad']=='MS'){		
					$intCantidad=1;
					$intEstadoTipoPeriocidad=0;	
			}else{
					$intCantidad=2;
					$intEstadoTipoPeriocidad=1;
			}
			}
			if($this->strMesTipo==1){
							if($strRespuesta[$p]['strPeriocidad']=='QC'){
							$intCantidad=1;
							$intEstadoTipoPeriocidad=2;}
			}

			else if($this->strMesTipo==2){
						if($strRespuesta[$p]['strPeriocidad']=='MS'){
								$intCantidad=1;
								$intEstadoTipoPeriocidad=0;	
						}
						if($strRespuesta[$p]['strPeriocidad']=='QC'){
							$intCantidad=1;
							$intEstadoTipoPeriocidad=1;
						}
			}




			//agregar mes a aplicar
			if(!(explode("-", $strRespuesta[$p]['dtFechaInicial'])[0]<=$this->intAnno)){
				$blnEstado=false;
			 }
			 if(explode("-", $strRespuesta[$p]['dtFechaInicial'])[0]==$this->intAnno){
			 if(!(explode("-",str_replace('0','',$strRespuesta[$p]['dtFechaInicial']))[1]<=$this->intMes)){
					$blnEstado=false;
			 }}

			if($blnEstado){ 
				if($strRespuesta[$p]['intSerie']==0){
					if($strRespuesta[$p]['intTipo']==0){
						$blnActualizarIngreso=true;
						$blnEstadoIngreso=1;
						$intMontoIngreso=$strRespuesta[$p]['intValor']*$intCantidad;
				}else if($strRespuesta[$p]['intTipo']==1){
					if(explode("-",str_replace("0", "", $strRespuesta[$p]['dtFechaInicial']))[1]==$this->intMes && explode("-",$strRespuesta[$p]['dtFechaInicial'])[0]==$this->intAnno){
						$intMontoIngreso=$strRespuesta[$p]['intValor'];
						$blnEstadoIngreso=0;
						$intEstadoTipoPeriocidad=-1;
						$blnActualizarIngreso=true;
				 	}			
				}else if($strRespuesta[$p]['intTipo']==2){
					//trae  uno rectificar cuando es QC periodo 1 
					$blnEstadoUltimoDia=true;
					if(explode("-",str_replace("0", "", $strRespuesta[$p]['dtFechaFinal']))[1]<$this->intMes && $strRespuesta[$p]['strPeriocidad']=='MS' && explode("-", $strRespuesta[$p]['dtFechaFinal'])[0]==$this->intAnno){
						$intMontoIngreso=0;
						$blnActualizarIngreso=true;
						$blnEstadoIngreso=0;
						$intEstadoTipoPeriocidad=-1;
						$blnEstadoUltimoDia=false;
						
					}else{
					//pendiente cuando applico mesual no me aplica la quincena en el tiempo 1 a 15
				
	

					if(explode("-",str_replace("0", "", $strRespuesta[$p]['dtFechaFinal']))[1]==$this->intMes && ($this->strMesTipo==2 || $this->strMesTipo==0) && (explode("-", $strRespuesta[$p]['dtFechaFinal'])[2])<=15 && explode("-", $strRespuesta[$p]['dtFechaFinal'])[0]==$this->intAnno){
							
								$intMontoIngreso=0;
								
								$blnActualizarIngreso=true;
								$blnEstadoIngreso=0;
								$intEstadoTipoPeriocidad=-1;
								$blnEstadoUltimoDia=false;
					}

					if($this->intMes>explode("-",str_replace("0", "", $strRespuesta[$p]['dtFechaFinal']))[1]  && explode("-", $strRespuesta[$p]['dtFechaFinal'])[0]==$this->intAnno){
								$intMontoIngreso=0;
								$blnActualizarIngreso=true;
								$blnEstadoIngreso=0;
								$intEstadoTipoPeriocidad=-1;
								$blnEstadoUltimoDia=false;
								
					}}
				    
				    if($blnEstadoUltimoDia){
					if($this->intMes>=explode("-",str_replace("0", "", $strRespuesta[$p]['dtFechaInicial']))[1] && explode("-",$strRespuesta[$p]['dtFechaInicial'])[0]==$this->intAnno){
							$blnActualizarIngreso=true;
							$blnEstadoIngreso=1;
							$intMontoIngreso=$strRespuesta[$p]['intValor']*$intCantidad;
					}}					
					}				
			} 
			else 
		     {
		     
				//obtener documentos ventas
				$intBaseIngreso=0;
				$strVendedor=$strRespuesta[$p]['strVendedor'];
				if($strRespuesta[$p]['strTipoVendedor']=='PP'){
					$strVendedor=$strRespuesta[$p]['strCedulaVendedor'];
				}
				if($strRespuesta[$p]['strTipoVendedor']=='GN'){
					$strVendedor='';	
				}
				$parametros=array();

				$parametros['Cia']=$strRespuesta[$p]['intCompania'];
				$parametros['Tipo']=$strRespuesta[$p]['strTipoBase'];
				$parametros['TipoVendedor']=$strRespuesta[$p]['strTipoVendedor'];
				$parametros['Vendedor']=$strVendedor;
				$strFechaDia = new DateTime($strRespuesta[$p]['dtUltimaFechaLiqui']);	
				$dtFecha=explode("-",$strRespuesta[$p]['dtUltimaFechaLiqui']);
				$strMesUno='01';
				$intCantidad=1;



				if($this->strMesTipo==1){
					$strMes=$this->intMes;
					$strAnno=$this->intAnno;
					$strDia='15';
				}else
				if($this->strMesTipo==2){
					if($strRespuesta[$p]['strPeriocidad']=='QC'){
					$strMesUno='16';
					}
					$strMes=$this->intMes;
					$strAnno=$this->intAnno;
					$strDia=date("d",(mktime(0,0,0,$strMes+1,1,$strAnno)-1));
				}else
				if($this->strMesTipo==0){
					$strMes=$this->intMes;
					$strAnno=$this->intAnno;
					$strDia=date("d",(mktime(0,0,0,$strMes+1,1,$strAnno)-1));
				}
					//rango de fecha para consultar cuanto es unico y temporal			
					if($this->intMes==explode('-', $strRespuesta[$p]['dtFechaInicial'])[1] && $this->intAnno==explode('-', $strRespuesta[$p]['dtFechaInicial'])[0]){
						$strMes=$this->intMes;
						$strAnno=$this->intAnno;
						$strMesUno=explode('-', $strRespuesta[$p]['dtFechaInicial'])[2];
						$strDia=explode('-', $strRespuesta[$p]['dtFechaFinal'])[2];
						if($strRespuesta[$p]['strPeriocidad']=='QC' && ($this->strMesTipo==2)){
							$strMesUno='16';
						}
					}
					//Ingreso de documentos liquidados
					$blnEstadoAgregarDocumentos=false;
					if($this->strMesTipo==1 && $strRespuesta[$p]['strPeriocidad']=='QC'){
						$blnEstadoAgregarDocumentos=true;
					}
					if(($strRespuesta[$p]['strPeriocidad']=='MS'|| $strRespuesta[$p]['strPeriocidad']='QC') && ($this->strMesTipo==2 || $this->strMesTipo==0)){
						$blnEstadoAgregarDocumentos=true;
					}	
				



				if($strMes<=9){
					$strMes="0".$strMes;
				}	
				$parametros['FechaIni']=$strAnno.'-'.$strMes.'-'.$strMesUno;
				//$parametros['FechaFin']=$strAnno."-".$strMes."-31";
				$parametros['FechaFin']=$strAnno."-".$strMes."-".$strDia;	
				$parametros['Transacciones']=$strRespuesta[$p]['strTransacciones'];
				

				echo $strAnno.'-'.$strMes.'-'.$strMesUno;
				echo '<br>';
				echo $strAnno."-".$strMes."-".$strDia;
				var_dump($parametraos);
				var_dump($strDia);
				var_dump("parametros");
				$client = new SoapClient($this->UrlWebService);
				$WebService=$client->LiquidarComision($parametros);
				$client=null;
				$parametros=array(); 
				$parametros['Vendedor']=$strRespuesta[$p]['strCedulaVendedor'];
				$client = new SoapClient($this->UrlWebService);
				$WebServiceUltimaVisita=$client->UltimaVisita($parametros); 
				$client=null;
				$blnEstadoMonto=true;
				//ciudades
				
			
		
		  		$strContenidoWebService=explode("&#",$WebService->LiquidarComisionResult);
		  		$strContenidoWebServiceTiempoVisita=explode("&",$WebServiceUltimaVisita->UltimaVisitaResult);
		  		var_dump($strContenidoWebService);
		  	


		  		if($strRespuesta[$p]['strTipoBase']=='VN'){
		 		// necesito que me envie el total de la factura y su iva
		  		if($strRespuesta[$p]['strTipoBaseIngreso']=='LZ'){	  		

				  		for($i=0;$i<=sizeof($strContenidoWebService)-2;$i++){
				  			$blnEstadoMonto=true;
				  			$strContenidoWebServiceFila=explode("%",$strContenidoWebService[$i]);
				  	
				  			for($j=0;$j<=sizeof($strRespuestaLineas)-1;$j++){	

				  				if($strRespuestaLineas[$j]['intCodigoLinea']==$strContenidoWebServiceFila[3]){

				  					if($strRespuesta[$p]['intTiempoVisita']==1){	
				  						

					  					for($k=0;$k<=sizeof($strContenidoWebServiceTiempoVisita)-2;$k++){
					  							$strTiempoVisita=explode("%",$strContenidoWebServiceTiempoVisita[$k]);
					  								if($strTiempoVisita[0]==$strContenidoWebServiceFila[2]){
								  						if($strRespuesta[$p]['strDiasVisita']>$strTiempoVisita[2]){
								  							$blnEstadoMonto=true;
								  							break;
								  						}else{
								  							$blnEstadoMonto=false;	
								  							break;
								  						}
								  					}else{
								  						$blnEstadoMonto=false;
								  					}
					  					}
				  					}

				  					//validar ciudades//

				  				if($blnEstadoMonto){
				  					if(sizeof($strRespuestaCiudades)==0){
				  						$blnEstadoMonto=false;
				  					}
				  					for($c=0;$c<=sizeof($strRespuestaCiudades)-1;$c++){
				  						if(trim($strContenidoWebServiceFila[8])==trim($strRespuestaCiudades[$c]['intIdCiudad'])){
				  							$blnEstadoMonto=true;
				  							break;
				  						}else{
				  							$blnEstadoMonto=false;
				  							//break;
				  						}
				  					}
				  				}

				  					if($strRespuesta[$p]['intIva']==1){
				  						if($blnEstadoMonto){
				  							$intBaseIngreso+=($strContenidoWebServiceFila[4]+$strContenidoWebServiceFila[5]);
				  							if($blnEstadoAgregarDocumentos){
				  							$objVendedorModel->AgregarDocumentosLiquidacion($strContenidoWebServiceFila[0],($strContenidoWebServiceFila[4]+$strContenidoWebServiceFila[5]),'01',$this->intAnno,$strRespuesta[$p]['intId'],$strContenidoWebServiceFila[1],$strContenidoWebServiceFila[6],$strContenidoWebServiceFila[7],$strContenidoWebServiceFila[9]);}
				  						}	
				  					}else{
				  						if($blnEstadoMonto){
				  							$intBaseIngreso+=($strContenidoWebServiceFila[4]);
				  							if($blnEstadoAgregarDocumentos){
				  							$objVendedorModel->AgregarDocumentosLiquidacion($strContenidoWebServiceFila[0],($strContenidoWebServiceFila[4]),'01',$this->intAnno,$strRespuesta[$p]['intId'],$strContenidoWebServiceFila[1],$strContenidoWebServiceFila[6],$strContenidoWebServiceFila[7],$strContenidoWebServiceFila[9]);}
				  						}
				  					}


				  				}
				  			}
				  		}

		
				}else{
				  			for($i=0;$i<=sizeof($strContenidoWebService)-2;$i++){
				  			$blnEstadoMonto=true;	
				  			$strContenidoWebServiceFila=explode("%",$strContenidoWebService[$i]);
				  				if($strRespuesta[$p]['intTiempoVisita']==1){	
				  						for($k=0;$k<=sizeof($strContenidoWebServiceTiempoVisita)-2;$k++){
				  							$strTiempoVisita=explode("%",$strContenidoWebServiceTiempoVisita[$k]);
				  							if($strTiempoVisita[1]==$strContenidoWebServiceFila[0]){
						  						   if($strTiempoVisita[0]==$strContenidoWebServiceFila[2]){
								  						if($strRespuesta[$p]['strDiasVisita']>$strTiempoVisita[2]){
								  							$blnEstadoMonto=true;
								  							break;
								  						}else{
								  							$blnEstadoMonto=false;	
								  							break;
								  						}
								  					}else{
								  						$blnEstadoMonto=false;
								  					}
						  						}
				  						}
				  				}	
					  			if($strRespuesta[$p]['intIva']==1){  
					  			if($blnEstadoMonto){	
					  		  			$intBaseIngreso+=($strContenidoWebServiceFila[4]+$strContenidoWebServiceFila[5]);
					  		  			if($blnEstadoAgregarDocumentos){
					  		  			$objVendedorModel->AgregarDocumentosLiquidacion($strContenidoWebServiceFila[0],($strContenidoWebServiceFila[4]+$strContenidoWebServiceFila[5]),'01',$this->intAnno,$strRespuesta[$p]['intId'],$strContenidoWebServiceFila[1],$strContenidoWebServiceFila[6],$strContenidoWebServiceFila[7],0,$strContenidoWebServiceFila[9]);}
					  		    } 		
				  		    	}else{
				  		    	if($blnEstadoMonto){
				  		    		  $intBaseIngreso+=($strContenidoWebServiceFila[4]);
				  		    		  if($blnEstadoAgregarDocumentos){
				  		    		  $objVendedorModel->AgregarDocumentosLiquidacion($strContenidoWebServiceFila[0],$strContenidoWebServiceFila[4],'01',$this->intAnno,$strRespuesta[$p]['intId'],$strContenidoWebServiceFila[1],$strContenidoWebServiceFila[6],$strContenidoWebServiceFila[7],0,$strContenidoWebServiceFila[9]);	 }
				  				}
				  				}
				  			}
				}
		  		}else{
		  			// diferente de VN---------------------------------------------------------------------------------------------------
		  			$ll=0;
		  			if($strRespuesta[$p]['strTipoBaseIngreso']=='LZ'){	  
		  			//

		  			for($i=0;$i<=sizeof($strContenidoWebService)-2;$i++){
		  				
		  			$strContenidoWebServiceFila=explode("%",$strContenidoWebService[$i]);
		  			$blnEstadoMonto=true;

		  			for($j=0;$j<=sizeof($strRespuestaLineas)-1;$j++){	  	

		  			if($strRespuestaLineas[$j]['intCodigoLinea']==trim($strContenidoWebServiceFila[5])){
		  				
		  				

		  				if($strContenidoWebServiceFila[8]!='08' && $strContenidoWebServiceFila[8]!='36' && $strContenidoWebServiceFila[8]!='14'  && $strContenidoWebServiceFila[8] !='24'){

		  				if($strRespuesta[$p]['intTiempoVisita']==1){

		  					for($k=0;$k<=sizeof($strContenidoWebServiceTiempoVisita)-2;$k++){
		  							$strTiempoVisita=explode("%",$strContenidoWebServiceTiempoVisita[$k]);
		  							if($strTiempoVisita[0]==$strContenidoWebServiceFila[4]){
				  						if($strRespuesta[$p]['strDiasVisita']>$strTiempoVisita[2]){
				  							$blnEstadoMonto=true;
				  							break;
				  						}else{
				  							$blnEstadoMonto=false;	
				  							break;
				  						}
				  					}else{
				  						$blnEstadoMonto=false;
				  					}
		  						}
		  					}

		  					//validar ciudades recaudos//
				  			
				  			if($blnEstadoMonto){
				  				if(sizeof($strRespuestaCiudades)==0){
				  					$blnEstadoMonto=false;
				  				}
				  				for($c=0;$c<=sizeof($strRespuestaCiudades)-1;$c++){

				  						if(trim($strContenidoWebServiceFila[11])==trim($strRespuestaCiudades[$c]['intIdCiudad'])){
				  							$blnEstadoMonto=true;
				  							break;
				  						}else{
				  							$blnEstadoMonto=false;
				  						
				  						}
				  				}
				  			}


		  					$intMontoTotal=0;	
			  				if($strRespuesta[$p]['intIva']==1){
			  					if($blnEstadoMonto){
			  					if(str_replace(",","." ,$strContenidoWebServiceFila[6])>=1){
			  						$intBaseIngreso+=($strContenidoWebServiceFila[7]);
			  						$intMontoTotal=($strContenidoWebServiceFila[7]);
			  					}else{	
			  					$intBaseIngreso+=($strContenidoWebServiceFila[7]*str_replace(",","." ,$strContenidoWebServiceFila[6]));
			  					$intMontoTotal=($strContenidoWebServiceFila[7]*str_replace(",","." ,$strContenidoWebServiceFila[6]));
			  					}
			  					}	
			  				}else{
			  					if($blnEstadoMonto){
			  					if(str_replace(",","." ,$strContenidoWebServiceFila[6])>=1){
			  						$intBaseIngreso+=($strContenidoWebServiceFila[7]/1.19);
			  						$intMontoTotal=($strContenidoWebServiceFila[7]/1.19);
			  					}else{	
			  					$intBaseIngreso+=(($strContenidoWebServiceFila[7]*str_replace(",","." ,$strContenidoWebServiceFila[6]))/1.19);
			  					$intMontoTotal=(($strContenidoWebServiceFila[7]*str_replace(",","." ,$strContenidoWebServiceFila[6]))/1.19);
			  					}
			  					}
			  				}


			  					if($strRespuesta[$p]['intDescuento']==0){
				  				if($blnEstadoMonto){	
					  				for($u=0;$u<=sizeof($strContenidoWebService)-2;$u++){
					  					$strContenidoWebServiceDescuento=explode("%",$strContenidoWebService[$u]);
					  						for($h=0;$h<=sizeof($strRespuestaLineas)-1;$h++){
					  						if($strRespuestaLineas[$h]['intCodigoLinea']==trim($strContenidoWebServiceDescuento[5])){
					  						if(trim($strContenidoWebServiceDescuento[8])=='08' && trim($strContenidoWebServiceFila[2])==trim($strContenidoWebServiceDescuento[2])){

						  					if(trim($strContenidoWebServiceFila[0])==trim($strContenidoWebServiceDescuento[0]) && trim($strContenidoWebServiceDescuento[5])==trim($strContenidoWebServiceFila[5])){
						  						if(str_replace(",","." ,$strContenidoWebServiceDescuento[6])>=1){
						  								
						  							$intBaseIngreso-=($strContenidoWebServiceDescuento[7]);
						  							$intMontoTotal=($intMontoTotal-($strContenidoWebServiceDescuento[7]));
						  						}else{
						  							$intBaseIngreso-=($strContenidoWebServiceDescuento[7]*str_replace(",","." ,$strContenidoWebServiceDescuento[6]));
						  							$intMontoTotal=($intMontoTotal-($strContenidoWebServiceDescuento[7]*str_replace(",","." ,$strContenidoWebServiceDescuento[6])));
						  						}

						  						}

						  						}
						  					}
						  				}
				  					}
				  				}
		  			 	   }
						if($blnEstadoMonto && $blnEstadoAgregarDocumentos){	
		  			 	   $objVendedorModel->AgregarDocumentosLiquidacion($strContenidoWebServiceFila[0],$intMontoTotal,'01',$this->intAnno,$strRespuesta[$p]['intId'],$strContenidoWebServiceFila[3],$strContenidoWebServiceFila[9],$strContenidoWebServiceFila[10],$strContenidoWebServiceFila[2],$strContenidoWebServiceFila[12]);
		  			 	}
			  			}
		  				}
		  				}
		  				}
		  				}else{ 
		  			for($i=0;$i<=sizeof($strContenidoWebService)-2;$i++){
		  			$strContenidoWebServiceFila=explode("%",$strContenidoWebService[$i]);
		  			$blnEstadoMonto=true;
		  			if($strContenidoWebServiceFila[8]!='08' && $strContenidoWebServiceFila[8]!='36' && $strContenidoWebServiceFila[8]!='14'
		  		       && $strContenidoWebServiceFila[8] !='24'){
		  				if($strRespuesta[$p]['intTiempoVisita']==1){	
		  						for($k=0;$k<=sizeof($strContenidoWebServiceTiempoVisita)-2;$k++){
		  							$strTiempoVisita=explode("%",$strContenidoWebServiceTiempoVisita[$k]);
		  							if($strTiempoVisita[0]==$strContenidoWebServiceFila[4]){
				  						if($strRespuesta[$p]['strDiasVisita']>$strTiempoVisita[2]){
				  							$blnEstadoMonto=true;
				  							break;
				  						}else{
				  							$blnEstadoMonto=false;	
				  							break;
				  						}
				  					}else{
				  						$blnEstadoMonto=false;
				  					}
		  						}	
		  				}
		  				$intMontoTotal=0;
		  				
		  				//lineas por porcentaje
		  				if($strRespuesta[$p]['intIva']==1){
			  					if($blnEstadoMonto){
			  					if(str_replace(",","." ,$strContenidoWebServiceFila[6])>=1){
			  						$intBaseIngreso+=($strContenidoWebServiceFila[7]);
			  						$intMontoTotal=($strContenidoWebServiceFila[7]);
			  					}else{	
			  					$intBaseIngreso+=($strContenidoWebServiceFila[7]*str_replace(",","." ,$strContenidoWebServiceFila[6]));
			  					$intMontoTotal=($strContenidoWebServiceFila[7]*str_replace(",","." ,$strContenidoWebServiceFila[6]));
			  					}
			  					}	
			  				}else{
			  					if($blnEstadoMonto){
			  					if(str_replace(",","." ,$strContenidoWebServiceFila[6])>=1){
			  						$intBaseIngreso+=($strContenidoWebServiceFila[7]/1.19);
			  						$intMontoTotal=($strContenidoWebServiceFila[7]/1.19);
			  					}else{	
			  					$intBaseIngreso+=((($strContenidoWebServiceFila[7]/1.19)*(str_replace(",","." ,$strContenidoWebServiceFila[6]))));
			  					$intMontoTotal=((($strContenidoWebServiceFila[7]/1.19)*(str_replace(",","." ,$strContenidoWebServiceFila[6]))));
			  					}
			  					}
			  				}
			  
		  					if($strRespuesta[$p]['intDescuento']==0){
				  				if($blnEstadoMonto){	
					  				for($j=0;$j<=sizeof($strContenidoWebService)-2;$j++){
					  					$strContenidoWebServiceDescuento=explode("%",$strContenidoWebService[$j]);
					  				
					  					
					  						if(trim($strContenidoWebServiceDescuento[8])=='08' && trim($strContenidoWebServiceFila[2])==trim($strContenidoWebServiceDescuento[2])){

						  					if(trim($strContenidoWebServiceFila[0])==trim($strContenidoWebServiceDescuento[0]) && trim($strContenidoWebServiceDescuento[5])==trim($strContenidoWebServiceFila[5])){
						  						if(str_replace(",","." ,$strContenidoWebServiceDescuento[6])>=1){
						  								
						  							$intBaseIngreso-=($strContenidoWebServiceDescuento[7]);
						  							$intMontoTotal=($intMontoTotal-($strContenidoWebServiceDescuento[7]));
						  						}else{
						  							$intBaseIngreso-=($strContenidoWebServiceDescuento[7]*str_replace(",","." ,$strContenidoWebServiceDescuento[6]));
						  							$intMontoTotal=($intMontoTotal-($strContenidoWebServiceDescuento[7]*str_replace(",","." ,$strContenidoWebServiceDescuento[6])));
						  						}

						  						}

						  						}
						  					
						  				
				  					}
				  				}
		  			 	   }
		  			    if($blnEstadoMonto && $blnEstadoAgregarDocumentos){	
		  			 	   $objVendedorModel->AgregarDocumentosLiquidacion($strContenidoWebServiceFila[0],$intMontoTotal,'01',$this->intAnno,$strRespuesta[$p]['intId'],$strContenidoWebServiceFila[3],$strContenidoWebServiceFila[9],$strContenidoWebServiceFila[10],$strContenidoWebServiceFila[2],$strContenidoWebServiceFila[12]);
		  			 	}
		  			}
		  			}
		  			} 		
		  		}
		  		$intBaseIngreso=($intBaseIngreso*$strRespuesta[$p]['intValor'])/100;
					if($strRespuesta[$p]['intTipo']==0){
						$blnActualizarIngreso=true;
						$blnEstadoIngreso=1;
						$intMontoIngreso=$intBaseIngreso*$intCantidad;	
				}else if($strRespuesta[$p]['intTipo']==1){
					if(explode("-",str_replace("0", "", $strRespuesta[$p]['dtFechaInicial']))[1]==$this->intMes && explode("-", $strRespuesta[$p]['dtFechaInicial'])[0]==$this->intAnno){
						$intMontoIngreso=$intBaseIngreso;
						$blnEstadoIngreso=0;
						$intEstadoTipoPeriocidad=-1;
						$blnActualizarIngreso=true;
					}			
				}else if($strRespuesta[$p]['intTipo']==2){
					$blnEstadoUltimoDia=true;
					if(explode("-",str_replace("0", "", $strRespuesta[$p]['dtFechaFinal']))[1]<$this->intMes && $strRespuesta[$p]['strPeriocidad']=='MS' && explode("-", $strRespuesta[$p]['dtFechaFinal'])[0]==$this->intAnno){
						$intMontoIngreso=0;
						$blnActualizarIngreso=true;
						$blnEstadoIngreso=0;
						$intEstadoTipoPeriocidad=-1;
						$blnEstadoUltimoDia=false;
					}else{
					if(explode("-",str_replace("0", "", $strRespuesta[$p]['dtFechaFinal']))[1]==$this->intMes && ($this->strMesTipo==2 || $this->strMesTipo==0) && (explode("-", $strRespuesta[$p]['dtFechaFinal'])[2])<=15 && explode("-", $strRespuesta[$p]['dtFechaFinal'])[0]==$this->intAnno){
								$intMontoIngreso=0;
								$blnActualizarIngreso=true;
								$blnEstadoIngreso=0;
								$intEstadoTipoPeriocidad=-1;
								$blnEstadoUltimoDia=false;
					}
					if($this->intMes>explode("-",str_replace("0", "", $strRespuesta[$p]['dtFechaFinal']))[1] && explode("-", $strRespuesta[$p]['dtFechaFinal'])[0]==$this->intAnno){
								$intMontoIngreso=0;
								$blnActualizarIngreso=true;
								$blnEstadoIngreso=0;
								$intEstadoTipoPeriocidad=-1;
								$blnEstadoUltimoDia=false;
					}
				    }
				    if($blnEstadoUltimoDia){
					if($this->intMes>=explode("-",str_replace("0", "", $strRespuesta[$p]['dtFechaInicial']))[1] && explode("-",$strRespuesta[$p]['dtFechaInicial'])[0]==$this->intAnno){
							$blnActualizarIngreso=true;
							$blnEstadoIngreso=1;
							$intMontoIngreso=$intBaseIngreso*$intCantidad;
					}}					
					}	
			}

		}
					$blnActualizar=false;
					if($this->intMes==12 && ($this->strMesTipo==2 || $this->strMesTipo==0)){
							$strMes='01';
							$strDia='01';
							$strAnno=date('Y')+1;
							$blnActualizar=true;
					}else{
						if($strRespuesta[$p]['strPeriocidad']=='MS' && ($this->strMesTipo==2 || $this->strMesTipo==0)){			
							$strMes=$this->intMes+1;
							$strDia='01';
							$strAnno=date('Y');
							$blnActualizar=true;
						}
						if($strRespuesta[$p]['strPeriocidad']=='QC'){
						if($this->strMesTipo==1){
							$strMes=$this->intMes;
							$strDia='16';
							$strAnno=date('Y');
							$blnActualizar=true;
						}else{
							$strMes=$this->intMes+1;
							$strDia='01';
							$strAnno=date('Y');
							$blnActualizar=true;
						}}
					}
					//if(explode('-',str_replace('0','',$strRespuesta[$p]['dtUltimaFechaLiqui']))[1] != $this->intMes){
					//	$blnActualizar=false;
					//}
		
					if($blnActualizar){	
					if($strMes<=9){
							$strMes=(str_replace('0','', $strMes));
					}	
					$objVendedorModel->ActualizarIngreso($this->strCedula,$this->intCompania,$strRespuesta[$p]['intId'],$intEstadoTipoPeriocidad,$blnEstadoIngreso,$strAnno.'-'.$strMes.'-'.$strDia);
					$objVendedorModel->CrearDetalleLiquidacion($strRespuesta[$p]['intId'],$intMontoIngreso,1);
				}	
			} 	
	}


	public function ListarLiquidacion(){
		$this->strCedula=trim($_POST['strCedula']);
		$this->intCompania=trim($_POST['intCompania']);
		$this->intMes=trim($_POST['intMes']);
		$this->intAnno=trim($_POST['intAnno']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ListarLiquidacion($this->strCedula,$this->intCompania,$this->intMes,$this->intAnno);
		$strRespuesta=$objVendedorModel->GetRespuesta();
		$strEstructuraTbl='';
		$k=1;
		$strTipoMes='';
			for($i=0;$i<=sizeof($strRespuesta)-1;$i++){
				if($strRespuesta[$i]['strMes']==$this->intMes){

				if($strRespuesta[$i]['intTipoMes']==1){
					$strTipoMes='Quincena-1';
				}else if($strRespuesta[$i]['intTipoMes']==2){
					$strTipoMes='Quincena-2  ';
				}else if($strRespuesta[$i]['intTipoMes']==0){
						$strTipoMes='Mensual';
				}	
				$strEstructuraTbl.="<tr><td>".($k)."</td><td>$".number_format($strRespuesta[$i]['intTotal'])."</td><td>".$strRespuesta[$i]['dtFechaCreacion']."</td><td>".$strTipoMes."</td><td><button class='btn btn-default' onclick='ImprimirLiquidacion(\"".$strRespuesta[$i]['intId']."\")'><span class='glyphicon glyphicon glyphicon-file'></span></button>&nbsp;<button class='btn btn-default' onclick='EliminarLiquidacion(\"".$strRespuesta[$i]['intId']."\")'><span class='glyphicon glyphicon-remove'></span></button></td></tr>";
				$k++;
				}
			}
			echo $strEstructuraTbl;
		}
	public function ConsultarVendedor(){
		$this->strCedula=trim($_POST['strCedula']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ConsultarVendedor($this->strCedula);
		$strRespuesta=$objVendedorModel->GetRespuesta();
		if($strRespuesta==null){
			echo 'No se encuentra el vendedor.%error';
			return;
		}
		echo $strRespuesta[0]['strNombre']."%";
	}
	public function ConsultarLiquidacionPeriodo(){
		$this->strCedula=trim($_POST['strCedula']);
		$this->intCompania=trim($_POST['intCompania']);
		$this->intMes=trim($_POST['intMes']);
		$this->intAnno=trim($_POST['intAnno']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ListarLiquidacion($this->strCedula,$this->intCompania,$this->intMes,$this->intAnno);
		$strRespuesta=$objVendedorModel->GetRespuesta();
		$strContenido='';
		for($i=0;$i<=sizeof($strRespuesta)-1;$i++){
			$strContenido.=$strRespuesta[$i]['strMes']."%".$strRespuesta[$i]['intTipoMes']."%".$strRespuesta[$i]['intAnno']."&";
		}
		echo $strContenido;
	}
	public function ListarVendedoresPorTipo(){
		$this->strTipoVendedor=trim($_POST['strTipoVendedor']);
		$strTipo='';
		switch ($this->strTipoVendedor) {
			case 'VE':
				$strTipo='09';
				break;
			case 'BG':
				$strTipo='17';
				break;
			case 'MD':
				$strTipo='16';
				break;
		}
		$TablaVendedores=$this->ConsultarWebService('ConsultarVendedores');
		$DatosVendedores=explode('&',$TablaVendedores->ConsultarVendedoresResult);
		$strVendedores='TD%TODOS&';	
		
		for($i=0;$i<=sizeof($DatosVendedores)-2;$i++){
			$DatosVendedoresFila=explode('%',$DatosVendedores[$i]);
			if(trim($DatosVendedoresFila[2])==$strTipo){
				$strVendedores.=$DatosVendedoresFila[0]."%".$DatosVendedoresFila[1]."&";	
			}
		}
		echo $strVendedores;
	}
	public function EliminarIngreso(){
		$this->intIdIngreso=trim($_POST['intIdIngreso']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->EliminarIngreso($this->intIdIngreso);
		$strRespuesta=$objVendedorModel->GetRespuesta();
		if($strRespuesta[0]['Mensaje']==1){
			echo 'Ingreso Eliminado correctamente.%success';
		}else{
			echo 'No se puede eliminar el ingreso.<br>Posee una relación con una liquidación.%error';
		}
		
	}
	public function ImprimirLiquidacion(){
		session_start();
		if(isset($_SESSION['NrLiquidacion'])){
			unset($_SESSION["NrLiquidacion"]); 
		}
		$this->intNroLiquidacion=trim($_POST['intNroLiquidacion']);
		$_SESSION['NrLiquidacion']=$this->intNroLiquidacion;

	}
	public function ListarIngreso(){
		$this->intIdIngreso=trim($_POST['intIdIngreso']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ListarIngreso($this->intIdIngreso);
		$strRespuesta=$objVendedorModel->GetRespuesta();
		$strRespuesta=trim($strRespuesta[0]['intSerie']).'%'.$strRespuesta[0]['strNombre'].'%'.$strRespuesta[0]['intValor'].'%'.$strRespuesta[0]['dtFechaInicial'].'%'.$strRespuesta[0]['dtFechaFinal'].'%'.$strRespuesta[0]['strPeriocidad'].'%'.$strRespuesta[0]['intTipo'].'%'.$strRespuesta[0]['intMeta'].'%'.$strRespuesta[0]['intTipoMeta'].'%'.$strRespuesta[0]['intValorMeta'].'%'.$strRespuesta[0]['strBaseMeta'].'%'.$strRespuesta[0]['strTipoBase'].'%'.$strRespuesta[0]['strTipoBaseIngreso'].'%'.$strRespuesta[0]['intIva'].'%'.$strRespuesta[0]['intDescuento'].'%'.$strRespuesta[0]['intTiempoVisita'].'%'.$strRespuesta[0]['strDiasVisita'].'%'.$strRespuesta[0]['dtCreacion'].'%'.$strRespuesta[0]['strTipoVendedor'].'%'.$strRespuesta[0]['strVendedor'].'%'.$strRespuesta[0]['strEstado'].'%'.$strRespuesta[0]['strTransacciones'];
		echo $strRespuesta;
	}
	public function ActualizarIngreso(){
		$this->intIdIngreso=trim($_POST['intIdIngreso']);
		$this->strNombre=trim($_POST['strNombre']);
		$this->intValor=trim($_POST['intValor']);
		$this->intEstado=trim($_POST['intEstado']);
		$this->intSerie=trim($_POST['intSerie']);
		$this->dtFechaInicial=trim($_POST['dtFechaInicial']);
		$this->dtFechaFinal=trim($_POST['dtFechaFinal']);
		$this->intTipo=trim($_POST['intTipo']);
		$this->strPeriocidad=trim($_POST['strPeriocidad']);
		$this->intMeta=trim($_POST['intMeta']);
		$this->intTipoMeta=trim($_POST['intTipoMeta']);
		$this->intValorMeta=trim($_POST['intValorMeta']);
		$this->strBaseMeta=trim($_POST['strBaseMeta']);
		$this->strTipoBaseMeta=trim($_POST['strTipoBaseMeta']);
		$this->strTipoBase=trim($_POST['strTipoBase']);
		$this->strTipoVendedor=trim($_POST['strTipoVendedor']);
		$this->strVendedor=trim($_POST['strVendedor']);
		$this->strTipoBaseIngreso=trim($_POST['strTipoBaseIngreso']);
		$this->intIva=trim($_POST['intIva']);
		$this->intDescuento=trim($_POST['intDescuento']);
		$this->intTiempoVisita=trim($_POST['intTiempoVisita']);
		$this->strDiasVisita=trim($_POST['strDiasVisita']);
		$this->strTransacciones=trim($_POST['strTransacciones'],",");
		
		$intTipoPeriocidad=0;
		
		if($this->strPeriocidad=='QC'){
			if(date('d')>=1 && date('d')<=15){
				$intTipoPeriocidad=1;
			}else{
				$intTipoPeriocidad=2;
			}
		}


		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ActualizarIngresoTotal($this->intIdIngreso,$this->strNombre,$this->intValor,$this->intEstado,$this->intSerie,$this->dtFechaInicial,$this->dtFechaFinal,$this->intTipo,$this->strPeriocidad,$this->intMeta,$this->intTipoMeta,$this->intValorMeta,$this->strBaseMeta,$this->strTipoBaseMeta,$this->strTipoBase,$this->strTipoVendedor,$this->strVendedor,$this->strTipoBaseIngreso,$this->intIva,$this->intDescuento,$this->intTiempoVisita,$this->strDiasVisita,$intTipoPeriocidad,$this->strTransacciones);	
		echo $objVendedorModel->GetRespuesta()[0]['Mensaje'];
		$objVendedorModel=null;
	}
	public function AgregarEgreso(){
		$this->strNombre=trim($_POST['strNombre']);
		$this->intValor=trim($_POST['intValor']);
		$this->intSerie=trim($_POST['intSerie']);
		$this->dtFechaInicial=trim($_POST['dtFechaInicial']);
		$this->dtFechaFinal=trim($_POST['dtFechaFinal']);
		$this->strPeriocidad=trim($_POST['strPeriocidad']);
		$this->strCedula=trim($_POST['intCedulaVendedor']);
		$this->strTipoTemporal=trim($_POST['strTipoTemporal']);
	 	$this->intCuota=trim($_POST['intCuota']);
		$this->intEstado=trim($_POST['intEstado']);
		$this->intCompania=trim($_POST['intCompania']);
		$strTipoPeriocidad=0;
		$flMontoAdescontar=0;
		$strDia=date("d");
		$strDiaCreacion='01';
		$strMes=date('m');
		$intAnno=date('Y');
		if($this->intSerie==0){
		if($this->strPeriocidad=='QC'){
			if($strDia>=1 && $strDia<=15){
				$strTipoPeriocidad=1;
			}else{
				$strTipoPeriocidad=2;
				$strDiaCreacion='16';
			}
		}
		}else if($this->intSerie==1 || $this->intSerie==2){
			$strDia=explode("-",str_replace("0", "", $this->dtFechaInicial));
			if($strDia[2]>=1 && $strDia[2]<=15){
				$strTipoPeriocidad=1;
			}else{
				$strDiaCreacion='16';
				$strTipoPeriocidad=2;	
			}
		}
		if($strMes<=9){
			$strMes='0'.str_replace('0','',$strMes);
		}
		if($this->intCuota!=0){
			$flMontoAdescontar=($this->intValor/$this->intCuota);
		}

		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->AgregarEgreso($this->strNombre,$this->intValor,$this->intSerie,$this->dtFechaInicial,$this->dtFechaFinal,$this->strPeriocidad,$this->strCedula,$this->strTipoTemporal,$this->intCuota,$this->intEstado,$intAnno.'-'.$strMes.'-'.$strDiaCreacion,$strTipoPeriocidad,$this->intCompania,$flMontoAdescontar);	
		echo $objVendedorModel->GetRespuesta()[0]['Mensaje'];
		$objVendedorModel=null;
	}
	public function ListarEgresos(){
		$this->strCedula=trim($_POST['intCedulaVendedor']);
		$this->intCompania=trim($_POST['intCompania']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ListarEgresos($this->strCedula,$this->intCompania);	
		$strRespuesta=$objVendedorModel->GetRespuesta();
		$strEstructuraTbl='';
		if($strRespuesta==null){
				$strEstructuraTbl='<tr><td><h3>No se encuentra egresos registrados.</h3></td></tr>';
		}
		$strCompania='';
		$strTipoEgreso='';
		for($i=0;$i<=sizeof($strRespuesta)-1;$i++){
			if($strRespuesta[$i]['intEstado']=='1'){
				$strEstado='Activo';
				$strGlyphicon='glyphicon glyphicon-ok';
			}else{
				$strEstado='Desactivado';
				$strGlyphicon='glyphicon glyphicon-minus';
			}
			if($strRespuesta[$i]['intCompania']==1){
				$strCompania='Blanca';
			}else{
				$strCompania='Verde';
			}
			if($strRespuesta[$i]['intSerie']=='0'){
				$strTipoEgreso='Fijo';
			}else if($strRespuesta[$i]['intSerie']=='0'){
				$strTipoEgreso='Unico';
			}else{
				$strTipoEgreso='Temporal';
			}
			$strEstructuraTbl.="<tr><td>".($i+1)."</td><td>".$strRespuesta[$i]['strNombre']."</td><td>".$strCompania."</td><td>".$strRespuesta[$i]['dtCreacion']."</td><td>".$strRespuesta[$i]['dtFechaInicial']."</td><td>".$strRespuesta[$i]['strPeriocidad']."</td><td>".$strRespuesta[$i]['intValor']."</td><td>".$strTipoEgreso."</td><td>".$strRespuesta[$i]['intCantidadCuotas']."</td><td>".$strEstado."</td><td><button onclick='EstadoEgreso(\"".$strRespuesta[$i]['intId']."\")' title='Estado' class='btn btn-default'><i class='".$strGlyphicon."'></i></button>
				<button onclick='EliminarEgreso(\"".$strRespuesta[$i]['intId']."\")' title='Eliminar' class='btn btn-default'><i class='glyphicon glyphicon-remove'></i></button></td></tr>";
		}
		echo $strEstructuraTbl;
		$objVendedorModel=null;
	}
	public function ListarEgresoComision(){
		$this->strCedula=trim($_POST['intCedulaVendedor']);
		$this->intCompania=trim($_POST['intCompania']);
		$this->intMes=trim($_POST['intMes']);
		$this->intAnno=trim($_POST['intAnno']);
		$this->strTipoMes=trim($_POST['intPeriodo']);

		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ListarEgresosComision($this->strCedula,$this->intCompania);

		$strRespuesta=$objVendedorModel->GetRespuesta();
		
		$strTabla="";
		$h=0;
		for ($i=0;$i<=sizeof($strRespuesta)-1;$i++){
			$blnEstado=true;

			if($this->strTipoMes=='1'){
				if($strRespuesta[$i]['strPeriocidad']=='MS'){
					$blnEstado=false;
				}
			}
			if(!(explode("-", $strRespuesta[$i]['dtFechaInicial'])[0]<=$this->intAnno)){
				$blnEstado=false;
			}
			if(explode("-", $strRespuesta[$i]['dtFechaInicial'])[0]==$this->intAnno){
			if(!(explode("-",str_replace('0','',$strRespuesta[$i]['dtFechaInicial']))[1]<=$this->intMes)){
					$blnEstado=false;
			}}
			if($strRespuesta[$i]['intSerie']==1){
				if(!(explode("-",str_replace("0", "", $strRespuesta[$i]['dtFechaInicial']))[1]==$this->intMes && explode("-",$strRespuesta[$i]['dtFechaInicial'])[0]==$this->intAnno)){
					$blnEstado=false;
				}
			}
			else if($strRespuesta[$i]['intSerie']==2){
				if($strRespuesta[$i]['strTipoTemporal']!='1'){

					if(!(explode("-",str_replace("0", "", $strRespuesta[$i]['dtFechaInicial']))[1]<=$this->intMes && explode("-",$strRespuesta[$i]['dtFechaInicial'])[0]==$this->intAnno)){
					$blnEstado=false;			
					}
					if($strRespuesta[$i]['strPeriocidad']=='QC'){
					if(explode("-",str_replace("0", "", $strRespuesta[$i]['dtFechaFinal']))[1]==$this->intMes && ($this->strTipoMes==2 || $this->strTipoMes==0) && (explode("-", $strRespuesta[$i]['dtFechaFinal'])[2])<=15 && explode("-", $strRespuesta[$i]['dtFechaFinal'])[0]==$this->intAnno){
						$blnEstado=false;
					}
					if($this->intMes>explode("-",str_replace("0", "", $strRespuesta[$i]['dtFechaFinal']))[1] && explode("-", $strRespuesta[$i]['dtFechaFinal'])[0]==$this->intAnno){
						 $blnEstado=false;	
					}}else if($strRespuesta[$i]['strPeriocidad']=='MS'){
					if((explode("-",str_replace("0", "", $strRespuesta[$i]['dtFechaFinal']))[1]<$this->intMes && $strRespuesta[$i]['strPeriocidad']=='MS' && explode("-", $strRespuesta[$i]['dtFechaFinal'])[0]==$this->intAnno)){
							$blnEstado=false;	
					}	}
				}
			}
			$strTipoEgreso='';
			if($blnEstado){
			if($strRespuesta[$i]['intSerie']=='0'){
				$strTipoEgreso='Fijo';
			}else if ($strRespuesta[$i]['intSerie']=='0'){
				$strTipoEgreso='Unico';
			}else{
				$strTipoEgreso='Temporal';
			}

			if($strRespuesta[$i]['intSerie']=='2' && $strRespuesta[$i]['strTipoTemporal']=='1'){
				 $strTabla.="<tr><td><input type='checkbox' id='chkEgreso".$h."' checked='checked'/></td><td>".($h+1)."</td><td style='display:none'>".$strRespuesta[$i]['intId']."</td><td>".$strRespuesta[$i]['strNombre']."</td><td>".$strRespuesta[$i]['flValorCuota']."</td><td>".$strTipoEgreso."</td><td>".$strRespuesta[$i]['intCantidadCuotas']."</td><td>".$strRespuesta[$i]['intValor']."</td></tr>";		
			}else{	
	      		$strTabla.="<tr><td><input type='checkbox' id='chkEgreso".$h."' checked='checked'/></td><td>".($h+1)."</td><td style='display:none'>".$strRespuesta[$i]['intId']."</td><td>".$strRespuesta[$i]['strNombre']."</td><td>".$strRespuesta[$i]['intValor']."</td><td>".$strTipoEgreso."</td><td>".$strRespuesta[$i]['intCantidadCuotas']."</td><td>".$strRespuesta[$i]['flValorCuota']."</td></tr>";
	      	}
	      	$h++;
	      	}		
		}
		if($strTabla==''){
			echo '0';
			return;
		}else{
			echo $strTabla;	
		}	
			
	}

	public function EfectuarEgresoComision(){
		$this->strCedula=trim($_POST['intCedulaVendedor']);
		$this->intCompania=trim($_POST['intCompania']);
		$this->strMesTipo=trim($_POST['intPeriodo']);
		$this->intMes=trim($_POST['intMes']);
		$this->intAnno=trim($_POST['intAnno']);	
		$mtEgresos=trim($_POST['mtEgresos']);
	
		$mtEgresos=explode('&',$mtEgresos);

		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ListarEgresosComision($this->strCedula,$this->intCompania,$this->strMesTipo);	
		$strRespuesta=$objVendedorModel->GetRespuesta();
		$strTabla="";
		$intCantidad=2;
		$intCantidadCuotas=0;
		var_dump($mtEgresos);
		for ($i=0;$i<=sizeof($strRespuesta)-1;$i++){
			$blnEstado=true;
			if($mtEgresos[0]!=''){
			for($k=0;$k<=sizeof($mtEgresos)-2;$k++){
				$mtEgresosDesglozado=explode("%",$mtEgresos[$k]);
				if($strRespuesta[$i]['intId']==$mtEgresosDesglozado[1] && $mtEgresosDesglozado[0]=='1'){
					$blnEstado=true;
					break;
				}else{
					$blnEstado=false;
				}	
			}}else{
				$blnEstado=false;
			}
			if($strRespuesta[$i]['strTipoTemporal']!='0'){
			if(!(explode("-", $strRespuesta[$i]['dtFechaInicial'])[0]<=$this->intAnno)){
				$blnEstado=false;
			 }
			 if(explode("-", $strRespuesta[$i]['dtFechaInicial'])[0]==$this->intAnno){
			 if(!(explode("-",str_replace('0','',$strRespuesta[$i]['dtFechaInicial']))[1]<=$this->intMes)){
					$blnEstado=false;
			 }}
			}
			if($strRespuesta[$i]['intSerie']==1){
				if(!(explode("-",str_replace("0", "", $strRespuesta[$i]['dtFechaInicial']))[1]==$this->intMes && explode("-",$strRespuesta[$i]['dtFechaInicial'])[0]==$this->intAnno)){
					$blnEstado=false;
				}
			}
			else if($strRespuesta[$i]['intSerie']==2){
				if($strRespuesta[$i]['strTipoTemporal']!='1'){
					if(!(explode("-",str_replace("0", "", $strRespuesta[$i]['dtFechaInicial']))[1]<=$this->intMes && explode("-",$strRespuesta[$i]['dtFechaInicial'])[0]==$this->intAnno)){
						$blnEstado=false;
					
					}
				}else if($strRespuesta[$i]['strTipoTemporal']=='1'){
					if($strRespuesta[$i]['intCantidadCuotas']=='0'){
						$blnEstado=false;
					}
				}	
			}
			if($strRespuesta[$i]['intSerie']==1){
				if(explode("-",str_replace("0", "", $strRespuesta[$i]['dtFechaInicial']))[1]==$this->intMes && explode("-", $strRespuesta[$i]['dtFechaInicial'])[0]==$this->intAnno){
			 		$objVendedorModel->ActualizarEgreso($strRespuesta[$i]['intId'],0,0,0,'',0,'0000-00-00',-1);
			 		
			 		}
				
			}else
			if($strRespuesta[$i]['intSerie']==2){
			if($strRespuesta[$i]['strPeriocidad']=='QC'){

							if(explode("-",str_replace("0", "", $strRespuesta[$i]['dtFechaFinal']))[1]==$this->intMes && (explode("-", $strRespuesta[$i]['dtFechaFinal'])[2])<=15 && explode("-", $strRespuesta[$i]['dtFechaFinal'])[0]==$this->intAnno){

									$objVendedorModel->ActualizarEgreso($strRespuesta[$i]['intId'],0,0,0,'',0,'0000-00-00',-1);
									
							}else if($this->intMes>explode("-",str_replace("0", "", $strRespuesta[$i]['dtFechaFinal']))[1]  && explode("-", $strRespuesta[$i]['dtFechaFinal'])[0]==$this->intAnno){

									$objVendedorModel->ActualizarEgreso($strRespuesta[$i]['intId'],0,0,0,'',0,'0000-00-00',-1);
									
							}
						}else if($strRespuesta[$i]['strPeriocidad']=='MS'){

								if((explode("-",str_replace("0", "", $strRespuesta[$i]['dtFechaFinal']))[1]<$this->intMes && $strRespuesta[$i]['strPeriocidad']=='MS' && explode("-", $strRespuesta[$i]['dtFechaFinal'])[0]==$this->intAnno)){

									$objVendedorModel->ActualizarEgreso($strRespuesta[$i]['intId'],0,0,0,'',0,'0000-00-00',-1);
									$blnEstado=false;
								}	
						} 
			}	

			if($blnEstado){
			
				$intMontoTotal=$strRespuesta[$i]['intValor']*1;
				if($strRespuesta[$i]['strPeriocidad']=='QC'){	
					if(($this->strMesTipo==0)){
					 	$intMontoTotal=$strRespuesta[$i]['intValor']*2;
					}
				}
				if($strRespuesta[$i]['intSerie']==2){					
					 if($strRespuesta[$i]['strTipoTemporal']=='1'){
						$intCantidadCuotas=$strRespuesta[$i]['intCantidadCuotas']-1;
						$intMontoTotal=$strRespuesta[$i]['flValorCuota']*1;	
						if(($this->strMesTipo==0) && $strRespuesta[$i]['strPeriocidad']=='QC' && $strRespuesta[$i]['intCantidadCuotas']!=1){
							$intCantidadCuotas=$strRespuesta[$i]['intCantidadCuotas']-2;
							$intMontoTotal=$strRespuesta[$i]['flValorCuota']*2;
						}

						$objVendedorModel->ActualizarEgreso($strRespuesta[$i]['intId'],1,$intCantidadCuotas,($strRespuesta[$i]['intValor']-$strRespuesta[$i]['flValorCuota']),'',0,'0000-00-00',-1);
						if($intCantidadCuotas<=0){
							$objVendedorModel->ActualizarEgreso($strRespuesta[$i]['intId'],0,0,0,'',0,'0000-00-00',-1);
						}
						}
					}				
					$objVendedorModel->CrearDetalleLiquidacion($strRespuesta[$i]['intId'],$intMontoTotal,0);			
			}
					$intTipoPeriocidad=0;
					if($this->intMes==12 && ($this->strMesTipo==2 || $this->strMesTipo==0)){
							$strMes='01';
							$strDia='01';
							$strAnno=$this->intAnno+1;
							if($strRespuesta[$i]['strPeriocidad']=='QC'){
							$intTipoPeriocidad=1;
							}
					}else{
						if($strRespuesta[$i]['strPeriocidad']=='MS' && ($this->strMesTipo==2 || $this->strMesTipo==0)){			
							$strMes=$this->intMes+1;
							$strDia='01';
							$strAnno=$this->intAnno;
						}
						if($strRespuesta[$i]['strPeriocidad']=='QC'){
						if($this->strMesTipo==1){
							$strMes=$this->intMes;
							$strDia='16';
							$strAnno=$this->intAnno;
							$intTipoPeriocidad=2;
						}else{
							$strMes=$this->intMes+1;
							$strDia='01';
							$strAnno=$this->intAnno;
							$intTipoPeriocidad=1;
						}}
					}
					if($strMes<=9)	{
						$strMes='0'.$strMes;
					}

					$objVendedorModel->ActualizarEgreso($strRespuesta[$i]['intId'],2,0,0,$this->strCedula,$this->intCompania,$strAnno.'-'.$strMes.'-'.$strDia,$intTipoPeriocidad);
	}
}
public function EstadoEgreso(){
	$this->intIdIngreso=trim($_POST['intIdEgreso']);
	$objVendedorModel= new clsVendedoresModel();
	$objVendedorModel->EstadoEgreso($this->intIdIngreso);
	$strRespuesta=$objVendedorModel->GetRespuesta();
	$objVendedorModel=null;
	echo $strRespuesta[0]['Mensaje'];
}
	public function ListarDocumentosLiquidacion(){
		$this->intIdLiquidacion=trim($_POST['intIdLiquidacion']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ListarDocumentosLiquidacion($this->intIdLiquidacion);
		$strRespuesta=$objVendedorModel->GetRespuesta();
		$strContenido='';
		$blnEstado=true;
		$intSumaTotal=0;
		for($i=0;$i<=sizeof($strRespuesta)-1;$i++){
				if($blnEstado){
					$strContenido.="<tr><td class='text-center'><h4 >".$strRespuesta[$i]['strNombre']."</h4></td><td></td><td></td><td></td></tr>";
					$blnEstado=false;
				}	
					$strContenido.="<tr><td>".($i+1)."</td><td>".$strRespuesta[$i]['strDocumento']."</td><td>".number_format($strRespuesta[$i]['intBaseMonto'])."</td><td>".$strRespuesta[$i]['dtFechaDocumento']."</td></tr>";
					$intSumaTotal+=$strRespuesta[$i]['intBaseMonto'];
				
			if($i!=(sizeof($strRespuesta)-1)){	
			if(!($strRespuesta[$i]['intIdMovimiento']==$strRespuesta[$i+1]['intIdMovimiento'])){
				$strContenido.=
				"<tr><td><h4>Total:</h4></td><td></td><td>".number_format($intSumaTotal)."</td><td></td></tr><tr><td class='text-center'><h4>".$strRespuesta[$i+1]['strNombre']."</h4></td><td></td><td></td><td></td></tr>";
				$intSumaTotal=0;
			}
		}
		}
		$objVendedorModel=null;
		$strRespuesta=null;
		echo $strContenido."<tr><td><h4>Total:</h4></td><td></td><td>".number_format($intSumaTotal)."</td><td></td></tr>";

	}
	public function EliminarLiquidacion(){
		$this->intIdLiquidacion=trim($_POST['intIdLiquidacion']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->EliminarLiquidacion($this->intIdLiquidacion);
		$strRespuesta=$objVendedorModel->GetRespuesta();
		echo $strRespuesta[0]['Mensaje'];
	}

	public function EliminarEgreso(){
		$this->intIdIngreso=trim($_POST['intIdEgreso']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->EliminarEgreso($this->intIdIngreso);
		$strRespuesta=$objVendedorModel->GetRespuesta();
		$objVendedorModel=null;
		echo $strRespuesta[0]['Mensaje'];
	}

	public function ConsultarEmpleadosAsociados(){
		@session_start();
		$this->idLogin=trim($_SESSION['idLogin']);
		$this->strIdTipoEmpleado=trim($_POST['strTipoEmpleado']);
		$intEmpelado='';
		switch ($this->strIdTipoEmpleado) {
			case 'MD':
				$intEmpelado=16;
			break;
			case 'VBG':
				$intEmpelado=17;
			break;
			case 'VE':
				$intEmpelado='09';
			break;
		}
		$objVendedorModel= new clsVendedoresModel();
		$blnEmpleadosTodos=false;
		if($this->idLogin!='1'){
		$objVendedorModel->ConsultarEmpleadosAsociados($this->idLogin,'',0,0);
		$strEmpleadosAsociados=$objVendedorModel->GetRespuesta();
		}

 		$strEmpleadosWS=explode('&', $this->ConsultarWebService('ConsultarVendedores')->ConsultarVendedoresResult);

 		$strCntEmpleados="<option value='-1'>Seleccione...</option>";
 		if($this->idLogin!=1){
 		if($strEmpleadosAsociados[0]['intIdEmpleado']!=''){
 			//$strCntEmpleados.='<option value="TD">TODOS</option>';
 		}}
 		if($this->idLogin==1){
 			//$strCntEmpleados.='<option value="TD">TODOS</option>';
 		}

 		for($i=0;$i<=sizeof($strEmpleadosWS)-2;$i++){
 			$strEmpleados=explode('%', $strEmpleadosWS[$i]);
 			if($this->idLogin=='1'){
 					if(trim($strEmpleados[2])==$intEmpelado){
 					$strCntEmpleados.="<option value='".$strEmpleados[0]."'>".$strEmpleados[1]."</option>";
 					}
 			}else{
 				for($j=0;$j<=sizeof($strEmpleadosAsociados)-1;$j++){
	
 				if(trim($strEmpleadosAsociados[$j]['strCedulaEmpleado'])==trim($strEmpleados[0]) && trim($strEmpleados[2])==$intEmpelado){
 						$strCntEmpleados.="<option value='".$strEmpleadosAsociados[$j]['strCedulaEmpleado']."'>".$strEmpleadosAsociados[$j]['strNombre']."</option>";
 				}

 			}
 		}}

 		echo $strCntEmpleados;
		$objVendedorModel=null;
	}
	public function ConsultarCompaniaEmpleadosAsociados(){
		session_start();
		$this->idLogin=trim($_SESSION['idLogin']);
		$this->strCedula=trim($_POST['strEmpleado']);
		$objVendedorModel= new clsVendedoresModel();
		$strCntEmpleados="<option value='1'>Blanca</option><option value='2'>Verde</option>";
		if($this->idLogin!='1'){
		$objVendedorModel->ConsultarCompaniaEmpleadosAsociados($this->idLogin,$this->strCedula);
		$strEmpleadosAsociados=$objVendedorModel->GetRespuesta();
		if($strEmpleadosAsociados[0]['intTipoVista']=='1'){
			$strCntEmpleados="<option value='1'>Blanca</option>";
		}else if($strEmpleadosAsociados[0]['intTipoVista']=='2'){
		   $strCntEmpleados="<option value='2'>Verde</option>";
		}
		}
		echo $strCntEmpleados;
		$objVendedorModel=null;	
	}
	public function ListarCiudadesPorVendedor($strVendedor){
		$objVendedorModel = new clsVendedoresModel();
		$objVendedorModel->ListarCiudadesPorVendedor(str_replace("'", "",$strVendedor));
		$strCiudades=$objVendedorModel->GetRespuesta();
		$strContenido='';
		for($i=0;$i<=sizeof($strCiudades)-1;$i++){
			$strContenido.="'".$strCiudades[$i]['intIdCiudad']."',";
		}
		return $strContenido;
	}
	public function ConsultarDocumentos(){
				@session_start();
				$this->idLogin=trim($_SESSION['idLogin']);
				$this->intCompania=trim($_POST['intCompania']);
				$this->strCedula="'".((string)trim($_POST['strCedulaEmpleado']))."'";
				$this->intMes=trim($_POST['intMes']);
				$this->intAnno=trim($_POST['intAnno']);
				$this->strTipoVendedor=trim($_POST['strTipoEmpleado']);
				$strTipoRecaudo=trim($_POST['ddlTipoRecaudo']);
				$objVendedorModel= new clsVendedoresModel();
				$strTipoVendedor='09';

				//para ventas	
				if($this->strTipoVendedor=='MD'){
					$strTipoVendedor='16';
				}else if($this->strTipoVendedor=='VBG'){
					$strTipoVendedor='17';
				}
				//buscar que vendedores tiene y asignarlos in('','','');
				if($this->strCedula=="'TD'"){
					if($this->idLogin!='1'){
					$this->strCedula="";
					$objVendedorModel->ConsultarEmpleadosAsociados($this->idLogin,$this->strTipoVendedor,1);
					
					$strEmpleadosAsociados=$objVendedorModel->GetRespuesta();

					$strComa=',';
					for($i=0;$i<=sizeof($strEmpleadosAsociados)-1;$i++){

						if($strEmpleadosAsociados[$i]['intTipoVista']==$this->intCompania || $strEmpleadosAsociados[$i]['intTipoVista']==3){

						if($i==sizeof($strEmpleadosAsociados)-1){
							$this->strCedula.="'".$strEmpleadosAsociados[$i]['strCedulaEmpleado']."'";	
						}else{
							$this->strCedula.="'".$strEmpleadosAsociados[$i]['strCedulaEmpleado']."'".$strComa;	
						}}
					}}else{
						$this->strCedula="''";
					}
					
				}
				$strCtnDocumentos=null;


				$parametros=array();
				$parametros['Cia']=$this->intCompania;
				$parametros['TipoV']=$strTipoVendedor;
				$parametros['Vendedor']=$this->strCedula;
				$parametros['Periodo']=$this->intMes;
				$parametros['Ano']=$this->intAnno;
				$intValorTotalDocumentos=0;
				$intValorTotalCartera=0;
				$client = new SoapClient($this->UrlWebService);
				$WebService=$client->ConsultarFacturas($parametros);
				$strDocumentosWS=explode('#&', $WebService->ConsultarFacturasResult);
				if($strDocumentosWS[0]==''){
					$strCtnDocumentos.='<tr><td><h3>No hay facturas generadas.</h3></td></tr>';
				}

				for($i=0;$i<=sizeof($strDocumentosWS)-2;$i++){
					$strDocumentos=explode('%', $strDocumentosWS[$i]);

					$strCtnDocumentos.="<tr><td>".$strDocumentos[1]."</td><td>".$strDocumentos[0]."</td><td>".$strDocumentos[2]."</td><td>".number_format((str_replace(',', '.',$strDocumentos[3])))."</td><td>".number_format((str_replace(',', '.',$strDocumentos[4])))."</td><td>".number_format((str_replace(',', '.',$strDocumentos[5])))."</td><td>".explode(' ',$strDocumentos[8])[0]."</td><td>".$strDocumentos[6]."</td><td>".$strDocumentos[7]."</td><td><button class='btn btn-default' onclick=ListarProductos(\"".$strDocumentos[8]."\",\"".$strDocumentos[1]."\")><i class='glyphicon glyphicon-list-alt'></i></button></td></tr>";
					$intValorTotalDocumentos+=((int)$strDocumentos[5]);
				}

				$strCtnDocumentos=
				//CARTERA
				$strCtnDocumentos.='$$';
				$parametros=array();
				$parametros['Cia']=$this->intCompania;
				$parametros['TipoV']=$strTipoVendedor;
				$parametros['Vendedor']=$this->strCedula;

				$client = new SoapClient($this->UrlWebService);
				$WebService=$client->CarteraGeneral($parametros);	


				$strDocumentosWS=explode('&#', $WebService->CarteraGeneralResult);
			
				if($strDocumentosWS[0]==''){
					$strCtnDocumentos.='<tr><td><h3>No posee cartera pendiente.</h3></td></tr>';
				}
				for($i=0;$i<=sizeof($strDocumentosWS)-2;$i++){
					$strDocumentos=explode('%', $strDocumentosWS[$i]);
					$Color="";
					if ((int)$strDocumentos[9]<=-10) {
						$Color="success";
					}elseif ((int)$strDocumentos[9]>-10 && (int)$strDocumentos[9]<=0) {
						$Color="warning";
					}elseif ((int)$strDocumentos[9]>0) {
						$Color="danger";
					}
					if($strDocumentos[5]>0){
					$strCtnDocumentos.="<tr><td>".$strDocumentos[3]."</td><td>".$strDocumentos[1]."</td><td>".$strDocumentos[4]."</td><td>".$strDocumentos[5]."</td><td>".number_format(str_replace(',', '.', (int)$strDocumentos[7]))."</td><td>".$strDocumentos[8]."</td><td class='".$Color."'>".$strDocumentos[9]."</td><td>".$strDocumentos[10]."</td><td>".$strDocumentos[11]."</td></tr>";
					}
						$intValorTotalCartera+=((int)$strDocumentos[7]);

					
				}
				$strCtnDocumentos.='$$';
				//Cartera por ciudad
				$intValorTotalCarteraCiudad=0;
				$parametros=array();
				$parametros['Cia']=$this->intCompania;
				$strCiudades=trim($this->ListarCiudadesPorVendedor($this->strCedula),",");
				$parametros['Ciudades']=$strCiudades;
						
				$client = new SoapClient($this->UrlWebService);
				$WebService=$client->CarteraGeneralCiudades($parametros);	
				$strDocumentosWS=explode('&#', $WebService->CarteraGeneralCiudadesResult);	

				for($i=0;$i<=sizeof($strDocumentosWS)-2;$i++){
					$strDocumentos=explode('%', $strDocumentosWS[$i]);
					$Color="";
					if ((int)$strDocumentos[9]<=-10) {
						$Color="success";
					}elseif ((int)$strDocumentos[9]>-10 && (int)$strDocumentos[9]<=0) {
						$Color="warning";
					}elseif ((int)$strDocumentos[9]>0) {
						$Color="danger";
					}
					if($strDocumentos[5]>0){
					$strCtnDocumentos.="<tr><td> ".$strDocumentos[3]."</td><td>".$strDocumentos[1]."</td><td>".$strDocumentos[4]."</td><td>".$strDocumentos[5]."</td><td>".number_format(str_replace(',', '.', (int)$strDocumentos[7]))."</td><td>".$strDocumentos[8]."</td><td class='".$Color."'>".$strDocumentos[9]."</td><td>".$strDocumentos[10]."</td><td>".$strDocumentos[11]."</td></tr>";
					}
						$intValorTotalCarteraCiudad+=((int)$strDocumentos[7]);					
				}


				$strCtnDocumentos.='$$';
				//pagadas
				$intMes=$this->intMes;
				if($this->intMes<=9){
					$intMes='0'.$this->intMes;
				}
				$strCedulaVendedor='';
				if($this->strTipoVendedor!='TD'){
					$this->strTipoVendedor='PP';
					$strCedulaVendedor=(string)trim($_POST['strCedulaEmpleado']);
				}
	

				$parametros=array();
				$parametros['Cia']=$this->intCompania;
				$parametros['Tipo']=$strTipoRecaudo;
				$parametros['TipoVendedor']=$this->strTipoVendedor;
				$parametros['Vendedor']=$strCedulaVendedor;
				$parametros['FechaIni']=$this->intAnno.'-'.$intMes.'-01';
				$parametros['FechaFin']=$this->intAnno."-".$intMes."-".date("d",(mktime(0,0,0,$intMes+1,1,$this->intAnno)-1));
				$parametros['Transacciones']="'041','04','117','17','47'";

				$client = new SoapClient($this->UrlWebService);
				$WebService=$client->LiquidarComision($parametros);
				$strDocumentosWS=explode('&#', $WebService->LiquidarComisionResult);
	
				$intValorTotalPagadas=0;
				$intValorPagadas=0;
				$intValorDescuento=0;
				$k=0;
				$Array= Array();
				for($i=0;$i<=sizeof($strDocumentosWS)-2;$i++){
					$strDocumentos=explode('%', $strDocumentosWS[$i]);
					$intValorTotalPagadas=$strDocumentos[7];
					for($j=0;$j<=sizeof($strDocumentosWS)-2;$j++){
						$strDocumentosDescuento=explode('%', $strDocumentosWS[$j]);	
						if(trim($strDocumentos[8])=='01'){
						if(trim($strDocumentos[0])==trim($strDocumentosDescuento[0]) && trim($strDocumentosDescuento[8])=='08' ){
							$intValorTotalPagadas=$strDocumentos[7]-$strDocumentosDescuento[7];
							$intValorDescuento=$strDocumentosDescuento[7];
						}}
					}
					$blnEstado=true;
					for($h=0;$h<=sizeof($Array)-1;$h++){
						if($Array[$h]==$strDocumentos[0] && ($Array[$h+1]==$strDocumentos[2])){
							$blnEstado=false;
							break;
						}
					}

					if($blnEstado){
					if(trim($strDocumentos[8])!='08' && trim($strDocumentos[8])!='14' && trim($strDocumentos[8])!='36'){

					$Array[$k]=$strDocumentos[0];
					$Array[$k+1]=$strDocumentos[2];
					$k++;
					$strCtnDocumentos.="<tr><td>".$strDocumentos[2]."</td><td>".$strDocumentos[0]."</td><td>".$strDocumentos[1]."</td><td>".$strDocumentos[3]."</td><td>".number_format($intValorTotalPagadas)."</td><td>".number_format($intValorDescuento)."</td></tr>";
					$intValorPagadas+=(int)$intValorTotalPagadas;
					}}

				}

				$strCtnDocumentos.='$$';


				//liquidadas				
				if($this->strCedula=="''"){
					$this->strCedula="0";
				}
				$intValorTotalLiquidadas=0;
				$intValorTotalLiquidadasAPagar=0;
				if($this->strCedula!=""){
			
				$strCedula=explode(',', $this->strCedula);
				$blnEstado=true;
				for($j=0;$j<=sizeof(explode(',',$this->strCedula))-1;$j++){
					$objVendedorModel->ListarDocumentosPagadosVendedor(trim(str_replace("'","",$strCedula[$j])),$this->intMes,$this->intAnno,$this->intCompania,$this->idLogin);
				$strDocumentosWS=$objVendedorModel->GetRespuesta();
				$strTituloComision='';
				$blnEstadoTipoFactura=true;
				$intSumaTotal=0;
				$intSumaTotalPorcentaje=0;
				$k=1;
				$intSubTotalLiquidacion=0;
				$intSumaTipoTransaccion=0;
				$strDescuento='';
				$strIva='-Antes de iva.';
				$strMeta='';
				$strTiempoVisita='';
				for($i=0;$i<=sizeof($strDocumentosWS)-1;$i++){
						if($blnEstado){
							if($strDocumentosWS[$i]['intDescuento']==1){
							$strDescuento='-Descuento Incluido.';
							}
							if($strDocumentosWS[$i]['intIva']==1){
								$strIva='-Iva Incluido.';
							}
							if($strDocumentosWS[$i]['intMeta']==1){
								$strMeta='-Con Meta de '.$strDocumentosWS[$i]['intValorMeta'];
							}
							if($strDocumentosWS[$i]['intTiempoVisita']==1){
								$strTiempoVisita='-Tiempo de visita:'.$strDocumentosWS[$i]['strDiasVisita'].' dias.';
							}	
									$strCtnDocumentos.="<tr><td style='padding:10px;'><strong>".strtoupper($strDocumentosWS[$i]['strNombre'])."</strong><br>
										$strIva  $strDescuento <br> $strMeta  $strTiempoVisita</td><td style='padding:10px;' >".$strDocumentosWS[$i+1]['intValor']." %</td><td style='padding:10px;'></td><td style='padding:10px;'></td></tr>";
									$blnEstado=false;
						}		
						if($blnEstadoTipoFactura){
							$strCtnDocumentos.="<tr><td style='padding:10px;padding-left:25px;'><strong>".strtoupper($strDocumentosWS[$i]['strNombreTransaccion'])."</strong></td><td style='padding:10px;' ></td><td style='padding:10px;'></td><td style='padding:10px;'></td></tr>";
							$blnEstadoTipoFactura=false;
						}
						$strCtnDocumentos.="<tr><td style='padding: 10px;padding-left:50px;'>".($k)."   ".$strDocumentosWS[$i]['strTercero']."</td><td style='padding: 10px;'>".$strDocumentosWS[$i]['strDocumento']."</td><td style='padding: 10px;'>".$strDocumentosWS[$i]['intRecibo']."</td><td style='padding: 10px;' >".number_format($strDocumentosWS[$i]['intBaseMonto'])."</td><td style='padding:10px;' >".$strDocumentosWS[$i]['intValor']." %</td>
						<td style='padding:10px;'>".number_format(($strDocumentosWS[$i]['intBaseMonto']*$strDocumentosWS[$i]['intValor'])/100)."</td><td style='padding: 10px;' >".$strDocumentosWS[$i]['dtFechaDocumento']."</td></tr>";
							$intSumaTotal+=$strDocumentosWS[$i]['intBaseMonto'];
							$intSumaTipoTransaccion+=$strDocumentosWS[$i]['intBaseMonto'];
							$intSubTotalLiquidacion+=(($strDocumentosWS[$i]['intBaseMonto']*$strDocumentosWS[$i]['intValor'])/100);
							$intSumaTotalPorcentaje+=(($strDocumentosWS[$i]['intBaseMonto']*$strDocumentosWS[$i]['intValor'])/100);
							@$intValorTotalLiquidadas+=(int)$strDocumentosWS[$i]['intBaseMonto'];
							$intValorTotalLiquidadasAPagar+=(($strDocumentosWS[$i]['intBaseMonto']*$strDocumentosWS[$i]['intValor'])/100);
						if($i!=(sizeof($strDocumentosWS)-1) || $i!=0){		
							if((trim($strDocumentosWS[$i]['strNombreTransaccion'])!=trim(@$strDocumentosWS[$i+1]['strNombreTransaccion']))){
							$strCtnDocumentos.=
							"<tr ><td style='padding:10px;'>Sub Total:</td><td style='padding:10px;'></td><td style='padding:10px;'></td><td style='padding:10px;'>".number_format($intSumaTipoTransaccion)."</td><td style='padding:10px;'></td><td style='padding:10px;'>".number_format($intSubTotalLiquidacion)."</td><td style='padding:10px;'></td></tr>";
						}}
						if($i!=(sizeof($strDocumentosWS)-1)){	
								if(!(trim($strDocumentosWS[$i]['strNombreTransaccion'])==trim($strDocumentosWS[$i+1]['strNombreTransaccion']) && trim($strDocumentosWS[$i]['strNombre'])==trim($strDocumentosWS[$i+1]['strNombre']))){
										$blnEstadoTipoFactura=true;
										$strDescuento='';
										$strIva='-Antes de iva.';
										$strMeta='';
										$strTiempoVisita='';
										$intSumaTipoTransaccion=0;
										$intSubTotalLiquidacion=0;
								}
						}
						$k++;	
						if($i!=(sizeof($strDocumentosWS)-1)){	
						if(!($strDocumentosWS[$i]['intIdMovimiento']==$strDocumentosWS[$i+1]['intIdMovimiento'])){
							if($strDocumentosWS[$i+1]['intDescuento']==1){
							$strDescuento='-Descuento Incluido.';
							}
							if($strDocumentosWS[$i+1]['intIva']==1){
								$strIva='-Iva Incluido.';
							}
							if($strDocumentosWS[$i+1]['intMeta']==1){
								$strMeta='-Con Meta. '.$strDocumentosWS[$i]['intValorMeta'];
							}
							if($strDocumentosWS[$i+1]['intTiempoVisita']==1){
								$strTiempoVisita='-Tiempo de visita:'.$strDocumentosWS[$i+1]['strDiasVisita'].' dias.';
							}
							$strCtnDocumentos.=
							"<tr ><td style='padding:10px;'>TOTAL ".strtoupper($strDocumentosWS[$i-1]['strNombre']).":</td><td style='padding:10px;'></td><td style='padding:10px;'></td><td style='padding:10px;'>".number_format($intSumaTotal)."</td><td style='padding:10px;'></td><td style='padding:10px;'>".number_format($intSumaTotalPorcentaje)."</td><td style='padding:20px;'></td></tr><tr><td style='padding:20px;'></td><td style='padding:20px;'></td><td style='padding:20px;'></td><td style='padding:20px;'></td><td style='padding:20px;'></td></tr><tr><td style='padding:10px;'><strong>".strtoupper( $strDocumentosWS[$i+1]['strNombre'])."</strong><br>
										$strIva  $strDescuento <br> $strMeta $strTiempoVisita</td><td style='padding:10px;' >".$strDocumentosWS[$i+1]['intValor']." %</td><td style='padding:10px;'></td><td style='padding:10px;'></td></tr><tr></tr>";
								$intSumaTotal=0;
								$intSumaTotalPorcentaje=0;
								$intSumaTipoTransaccion=0;
								$intSubTotalLiquidacion=0;
								$strTituloComision=strtoupper($strDocumentosWS[$i+1]['strNombre']);
							$k=1;
						}
					}
					
				}

				}
				$strCtnDocumentos.="<tr><td style='padding:10px;'>TOTAL ".$strTituloComision.":</td><td style='padding:10px;'></td><td style='padding:10px;'></td><td style='padding:10px;'>".number_format($intSumaTotal)."</td><td style='padding:10px;'></td><td style='padding:10px;'>".number_format($intSumaTotalPorcentaje)."</td><td style='padding:10px;'></td></tr>";
				}else{
					$strCtnDocumentos.='<tr><td><h3>No posee documentos liquidados.</h3></td></tr>';
				}
	
				echo $strCtnDocumentos."$$".number_format($intValorTotalDocumentos).'$$'.number_format($intValorTotalCartera).'$$'.number_format($intValorPagadas).'$$'.number_format($intValorTotalLiquidadas).'$$'.number_format($intValorTotalLiquidadasAPagar);	
				$objVendedorModel=null;	
	}
	public function ConsultarTipoEmpleado(){
		@session_start();
		$this->idLogin=trim($_SESSION['idLogin']);
		$objVendedorModel= new clsVendedoresModel();
		$objVendedorModel->ConsultarTipoEmpleado($this->idLogin);
		$strEmpleadosAsociados=$objVendedorModel->GetRespuesta();
		 $strTipoEmpleado='';
		for($i=0;$i<=sizeof($strEmpleadosAsociados)-1;$i++){
			$strTipoEmpleado.=$strEmpleadosAsociados[$i]['Mensaje'].'%';
		}
		if($this->idLogin=='1'){
			echo '1%1%1';
		}else{
			echo $strTipoEmpleado;
		}
	}
	public function ListarClientes(){
		@session_start();
		$this->idLogin=trim($_SESSION['idLogin']);
		$strCiudad=trim($_POST['strCiudad']);
		//$objVendedorModel= new clsVendedoresModel();
		//$objVendedorModel->CiudadesVendedoresAsociados($this->idLogin);
		//$Ciudades=$objVendedorModel->GetRespuesta();
		//$StrCiudades="";
		if(($strCiudad)!='0'){
			/*for($i=0;$i<=sizeof($Ciudades)-1;$i++){
				$StrCiudades.="'".$Ciudades[$i]["intIdCiudad"]."',";
			}
			$StrCiudades=trim($StrCiudades,',');*/
			$objTerceros= new clsTerceroController();
			$strRespuestaTercero=$objTerceros->ListarTerceroPorCiudad("'".$strCiudad."'",'','');
			$tabla="";
			$blnEstado=true;
			for($i=0;$i<=sizeof($strRespuestaTercero)-1;$i++){
				$blnEstado=false;
				$strEstado='';
				$Cupo ="";
				if($strRespuestaTercero[$i]->IntCupo==1){
					$Cupo= "Contado";
				}else{
					$Cupo= number_format($strRespuestaTercero[$i]->IntCupo);
				}


				if ($strRespuestaTercero[$i]->DIFFecha<=150) {
					$Estado="success";
				}else if ($strRespuestaTercero[$i]->DIFFecha>150 && $strRespuestaTercero[$i]->DIFFecha<=180) {
					$Estado="warning";
				}else if ($strRespuestaTercero[$i]->DIFFecha>180) {
					$Estado="danger";
				}
				if($strRespuestaTercero[$i]->IntTipoTercero=='05'){
					$strEstado='danger';
				}
				$Color="";
				if ($strRespuestaTercero[$i]->CupoDisponible<0) {
					$Color="danger";
				}


				 $tabla.="<tr class='".$strEstado."'>";
				 $tabla.="<td>".($i+1)."</td>";
				 $tabla.="<td>".$strRespuestaTercero[$i]->StrIdTercero."</td>";
				 $tabla.="<td>".$strRespuestaTercero[$i]->StrNombre."</td>";
				 $tabla.="<td>".$strRespuestaTercero[$i]->StrDescripcion."</td>";
				 $tabla.="<td>".$strRespuestaTercero[$i]->StrNombreComercial."</td>";
				 $tabla.="<td>".$strRespuestaTercero[$i]->StrDireccion."</td>";
				 $tabla.="<td>".$strRespuestaTercero[$i]->StrDireccion2."</td>";
				 $tabla.="<td>".$strRespuestaTercero[$i]->StrTelefono."</td>";
				 $tabla.="<td>".$strRespuestaTercero[$i]->StrCelular."</td>";
				 $tabla.="<td>".$strRespuestaTercero[$i]->Descuento."</td>";
				 $tabla.="<td>".$Cupo."</td>";

				 $tabla.="<td>".(number_format((int)$strRespuestaTercero[$i]->SaldoCartera))."</td>";
				 $tabla.="<td class='".$Color."'>".(number_format((int)$strRespuestaTercero[$i]->CupoDisponible))."</td>";
				  if(is_null(explode(" ",$strRespuestaTercero[$i]->DatFecha)[0]) || $strRespuestaTercero[$i]->DatFecha==''){
				  	$tabla.="<td class='danger' style='border-color: red red red red;'>Sin Movimiento</td>";
				  }else{
					$tabla.="<td class='".$Estado."'>".explode(" ",$strRespuestaTercero[$i]->DatFecha)[0]."</td>";
				  }
				 $tabla.="<td class='text-center'>
            				<button type='button' class='btn btn-default' onClick='
            					OpenModal(\"ModalGestionCliente\", \"".$strRespuestaTercero[$i]->StrIdTercero."\", \"".$strRespuestaTercero[$i]->StrNombre."\")
            					'>
                			<span class='glyphicon glyphicon-fullscreen' aria-hidden='true'></span>
            				</button>

        				</td>";
				 $tabla.="</tr>";
			}
			if($blnEstado){
				echo '<tr><td><h3>No existe clientes.</h3></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
			}else{
				echo $tabla;	
			}
		}else{
			echo "<tr><td><h1>Error</h1></td></tr>";
		}
		


	}
	public function ListarProductos(){
		$parametros['Cia']=$_POST['StrCompania'];
		$parametros['Transaccion']=$_POST['StrTransaccion'];
		$parametros['Documento']=$_POST['StrDocumento'];
		$client = new SoapClient($this->UrlWebService);
		$WebService=$client->ProductosDocumentos($parametros);	
		$strProductos=explode('#!', $WebService->ProductosDocumentosResult);
		$strTablaProductos='';	
		$files = glob('../FotosFacturacion/*');
		foreach($files as $file){
			    if(is_file($file)){
			    	 chmod($file,0777);
					 unlink($file);
					}
		 }
		for($i=0;$i<=sizeof($strProductos)-2;$i++){
			$strTabla=explode('$', $strProductos[$i]);
			if(@getimagesize("http://10.10.10.128/owncloud/fotos_nube/".trim($strTabla[0]).".jpg")){		
				copy("http://10.10.10.128/owncloud/fotos_nube/".trim($strTabla[0]).".jpg",$_SERVER['DOCUMENT_ROOT']."/DASH/FotosFacturacion/".trim($strTabla[0]).".jpg");
				$RutaImagen="../FotosFacturacion/".trim($strTabla[0]).".jpg";
			}else{
				$RutaImagen='../Images/agotado.png';
			}
			$strTablaProductos.="<tr><td><img src='".$RutaImagen."' width='300'></td><td><B><h5>".$strTabla[0]."</h5></B></td><td>".$strTabla[1]."</td><td>".number_format($strTabla[2])."</td><td>".number_format($strTabla[3])."</td><td>".number_format($strTabla[4])."</td><td>".number_format($strTabla[5])."</td><td>".number_format($strTabla[6])."</td></tr>";
		}
		echo $strTablaProductos;
	}
	public function ListarTransacciones()
	{
		$client = new SoapClient($this->UrlWebService);
		$WebService=$client->ConsultarTransacciones();
		$strContenido=explode("&#", $WebService->ConsultarTransaccionesResult);
		$strTransacciones='';
		$h=0;
		for($i=0;$i<=sizeof($strContenido)-2;$i++){
			$strContenidoTransaccion=explode('%',$strContenido[$i]);
			if($strContenidoTransaccion[0]!='99'){
			$strTransacciones.="<tr id='rowTransaccion".$h."'><td><input id='chk".$h."' onclick='SelectCheckbox(\"chk".$h."\",\"rowTransaccion".$h."\")' type='checkbox'></td><td>".$strContenidoTransaccion[0]."</td><td>".$strContenidoTransaccion[1]."</td></tr>";
				$h++;
			}
		}
		echo $strTransacciones."<tr id='rowTransaccion".($h)."'><td><input id='chk".($h)."' onclick='SelectCheckbox(\"chk".($h)."\",\"rowTransaccion".($h)."\")' type='checkbox'></td><td>041</td><td>VENTAS DE CONTADO</td></tr>";
	}

}