<?php

include_once ("../Model/clsLoginModel.php");
$objLogin= new clsLoginDASH();
session_start();
if(isset($_POST['btnIngresarDash'])){
$objLogin->ValidarSession();
}
if(isset($_POST["btnListarPermisios"])){
$objLogin->ListarPermisosUsuario();
}
if(isset($_POST['btnActualizarPermisos'])){
$objLogin->AgregarPermisos();
}
if(isset($_POST['btnCrearLogin'])){
$objLogin->CrearLogin();
}
if(isset($_POST['btnListarUsuarios'])){
$objLogin->ListarUsuarios($_POST['intTipoListado']);
}
if(isset($_POST['btnEliminarUsuario'])){
$objLogin->EliminarUsuario();
}
if(isset($_POST['btnEditarUsuario'])){
$objLogin->EditarUsuario();
}
if(isset($_POST['btnBuscarUsuario'])){
$objLogin->BuscarUsuario();
}
if(isset($_POST['btnListarEmpleados'])){
$objLogin->ListarEmpleados();
}
if(isset($_POST['btnAgregarEmpeladosAsociados'])){
$objLogin->AgregarEmpeladosAsociados();
}
if(isset($_POST['btnListarUsuariosAsociados'])){
$objLogin->ListarUsuariosAsociados();
}
if(isset($_POST['btnEliminarEmpleadoAsociado'])){
$objLogin->EliminarEmpleadoAsociado();
}
if(isset($_POST['actConsultarModulos'])){
$objLogin->ConsultarModulos($_POST['tipo']);
}
if(isset($_POST['btnAgregarModulo'])){
$objLogin->AgregarModulo($_POST['nombre'],$_POST['get'],$_POST['descripcion'], $_POST['tipoPermiso'],$_POST['icono']);
}
if(isset($_POST['btnAgregarModuloDetalle'])){
$objLogin->AgregarModuloDetalle($_POST['nombre'],$_POST['get'],$_POST['descripcion'],$_POST['idModulo'],$_POST['tipoPermiso'],$_POST['icono']);
}
if(isset($_POST['btnConsultarPermisos'])){
	$objLogin->ConsultarPermisos($_POST['tipo'],$_POST['idUsuario']);
}
if(isset($_POST["actConsultarPermisosUsuario"])){
$objLogin->ListarPermisosUsuario();
}
if(isset($_POST["checkActualizarPermisos"])){
$objLogin->ActualizarPermisosLogin($_POST['idPermiso'],$_POST['idLogin'],$_POST['ver'],$_POST['editar'],$_POST['ingresar'],$_POST['tipoVista']);
}
if(isset($_POST["actConsultarPermisos"])){
$objLogin->ConsultarAllPermisos($_POST['tope'], $_POST['totalPermisos']);
}
if(isset($_POST["ConsultarPaginas"])){
$objLogin->Paginas();
}
if(isset($_POST["btnActualizarModulo"])){
$objLogin->ActualizarModulo($_POST['nombre'],$_POST['get'],$_POST['descripcion'], $_POST['tipoPermiso'], $_POST['id'], $_POST['icono']);
}
if(isset($_POST["btnActualizarModuloDetalle"])){
$objLogin->ActualizarModuloDetalle($_POST['nombre'],$_POST['get'],$_POST['descripcion'],$_POST['idModulo'],$_POST['tipoPermiso'], $_POST['id'], $_POST['icono']);
}
if(isset($_POST["actEliminarPermiso"])){
$objLogin->EliminarModulo($_POST['idPermiso']);
}


$objLogin=null;
class clsLoginDASH
{
	private $strUsuario;
	private $strClave;
	private $strNombreEmpleado;
	private $stridUsuario;
	private $chkCompras;
	private $chkLiquidar;
	private $chkStickers;
	private $chkPedidos;
	private $chkCargarCompra;
	private $chkAgregarPedidos;
	private $chkGenerarExcelPedido;
	private $chkCartera;
	private $chkGenerarExcelCartera;
	private $boolEstadoHGI;
	private $chkInformes;
	private $chkVendedores;
	private $intIdUsuario;
	private $UrlWebService;
	private $intTipoEmpleado;
	private $strCedulaEmpleado;
	private $intTipoVista;


	function __construct()

	{	
		$this->intTipoVista='';
		$this->strCedulaEmpleado='';
		$this->strNombreEmpleado="";
		$this->stridUsuario="";
		$this->strUsuario="";
		$this->strClave="";
		$this->chkCompras="";
		$this->chkLiquidar="";
		$this->chkStickers="";
		$this->chkPedidos="";
		$this->chkCargarCompra="";
		$this->chkAgregarPedidos="";
		$this->chkGenerarExcelPedido="";
		$this->chkCartera="";
		$this->chkGenerarExcelCartera="";
		$this->boolEstadoHGI="false";
		$this->chkInformes='';
		$this->chkVendedores="";
		$this->intIdUsuario='';
		$this->UrlWebService="http://10.10.10.150/webservice/WebModaService.asmx?WSDL";
		$this->intTipoEmpleado='';
	}
	public function ConsultarWebService($Tipo){
		$client = new SoapClient($this->UrlWebService);
		$WebService=$client->$Tipo();
		return	$WebService;
	}
	private function Validar($Tipo){
		switch ($Tipo) {
			case 'Verificar Login':
				if($this->strUsuario==""){
					$_SESSION['Mensaje']="Ingrese Usuario.";
					return false;
				}
				if($this->strClave==""){				
					$_SESSION['Mensaje']="Ingrese Clave.";
					return false;
				}
			break;
			case 'Crear Login':
				if($this->strUsuario==""){
					echo "Ingrese Usuario.%error";
					return false;
				}
				if($this->strClave==""){				
					echo "Ingrese Clave.%error";
					return false;
				}
				if($this->strNombreEmpleado==""){				
					echo "Ingrese Nombre Empleado.%error";
					return false;
				}
			break;
		}
		return true;
	}
	public function ValidarSession(){
		
		$this->strUsuario=trim($_POST['txtUsuario']);
		$this->strClave=trim($_POST['txtClave']);
		if(!$this->Validar("Verificar Login")){
			echo "<script language='javascript'>window.location='../view/Login.php'</script>;";
			return;
		}
		
		$objLogin= new clsLoginModel();
		$Respuesta=$objLogin->ValidarLogin($this->strUsuario,$this->strClave);
		if($Respuesta[0]['Estado']=='0'){
			$_SESSION['Mensaje']="No existe Usuario o Clave.";
			echo "<script language='javascript'>window.location='../view/Login.php'</script>;";
			return;
		}
		$_SESSION['Empleado']=$Respuesta[0]['strNombreEmpleado'];
		if($Respuesta[0]['Estado']=='2'){
			echo "<script language='javascript'>window.location='../view/index.php?menu=Inicio'</script>;";
			return;
		}
		$_SESSION['idLogin']=$Respuesta[0]['idLogin'];
		$objLogin=null;
		for($i=0;$i<=sizeof($Respuesta)-1;$i++){
			if($this->boolEstadoHGI=="false"){
				if(($Respuesta[$i]['idPermiso']=='6' && $Respuesta[$i]['intVer']=='1') || ($Respuesta[$i]['idPermiso']=='7'  && $Respuesta[$i]['intVer']=='1') || ($Respuesta[$i]['idPermiso']=='11'  && $Respuesta[$i]['intVer']=='1')){
					//$this->CargarWebServiceHGIDdl();
			    }
			}else{
			    	$i=sizeof($Respuesta)*5;
			}
		}
		echo "<script language='javascript'>window.location='../view/index.php?menu=Inicio'</script>;";
		$Respuesta=null;
	}
	private function CargarWebServiceHGIDdl(){
		include_once ("../Controller/PedidosController.php");
		$objPedido= new clsPedidosController();
		$_SESSION["ddlLinea"]="";
		$_SESSION["ddlGrupo"]="";
		$_SESSION["ddlClase"]="";
		$_SESSION["ddlTipo"]="";
		 $LineaPedido=$objPedido->ListarLinea();

        for($i=0;$i<=sizeof($LineaPedido->ObtenerResult->Linea)-1;$i++){
            $_SESSION['ddlLinea'].="<option value=".$LineaPedido->ObtenerResult->Linea[$i]->Codigo.">".$LineaPedido->ObtenerResult->Linea[$i]->Descripcion."</option>";
            $_SESSION['ddlLineaVendedor']=$LineaPedido->ObtenerResult->Linea;
        }
         $LineaGrupo=$objPedido->ListarGrupo();
         for($i=0;$i<=sizeof($LineaGrupo->ObtenerResult->Grupo)-1;$i++){
            $_SESSION['ddlGrupo'].="<option value=".$LineaGrupo->ObtenerResult->Grupo[$i]->Codigo.">".$LineaGrupo->ObtenerResult->Grupo[$i]->Descripcion."</option>";
         }
         $LineaClase=$objPedido->ListarClase();
        for($i=0;$i<=sizeof($LineaClase->ObtenerResult->Clase)-1;$i++){
            $_SESSION['ddlClase'].="<option value=".$LineaClase->ObtenerResult->Clase[$i]->Codigo.">".$LineaClase->ObtenerResult->Clase[$i]->Descripcion."</option>";
        }
        $LineaTipo=$objPedido->ListarTipos();
        for($i=0;$i<=sizeof($LineaTipo->ObtenerResult->Tipo)-1;$i++){
             $_SESSION['ddlTipo'].="<option value=".$LineaTipo->ObtenerResult->Tipo[$i]->Codigo.">".$LineaTipo->ObtenerResult->Tipo[$i]->Descripcion."</option>";
        }
        $this->boolEstadoHGI="true";
        $LineaTipo=null;
		$LineaPedido=null;
        $LineaClase=null;
        $LineaGrupo=null;
        $LineaTipo=null;
        $objPedido=null;
	}
	public function ListarUsuarios($intTipo){
		$objLogin= new clsLoginModel();
		$Respuesta=$objLogin->ListarUsuarios();
		$ListaUsuarios="";
		$blnEstado=true;
		for($i=0;$i<=sizeof($Respuesta)-1;$i++){
			if($intTipo==1){
			$ListaUsuarios.="<tr><td>".($i+1)."</td><td>".$Respuesta[$i]['strUsuario']."</td><td>".$Respuesta[$i]['strClave']."</td><td>".$Respuesta[$i]['strNombreEmpleado']."</td><td>".$Respuesta[$i]['strDescripcion']."</td><td><button class='btn btn-default' onclick='SeleccionarUsuario(\"".($i+1)."\");'><span class='glyphicon glyphicon-edit'></span></button><button class='btn btn-default' onclick='EliminarUsuario(\"".$Respuesta[$i]['idLogin']."\");'><span class='glyphicon glyphicon-remove'></span></button></td><td style='display:none'>".$Respuesta[$i]['idLogin']."</td><td style='display:none'>".$Respuesta[$i]['intIdCompania']."</td></tr>";
			}else{
				if($blnEstado){
					$ListaUsuarios.="<option value='-1'>Seleccione usuario...</option>";
					$blnEstado=false;
				}
				$ListaUsuarios.="<option value='".$Respuesta[$i]['idLogin']."'>".$Respuesta[$i]['strUsuario']."</option>";
			}
		}
		$Respuesta=null;
		$objLogin=null;
		echo $ListaUsuarios;
	}
	public function CrearLogin(){
		$this->strUsuario=trim($_POST['txtUsuario']);
		$this->strClave=trim($_POST['txtClave']);
		$this->strNombreEmpleado=trim($_POST['txtNombreEmpleado']);
		$intIdCompania=trim($_POST['intIdCompania']);
		if(!$this->Validar("Crear Login")){
			return;
		}
		$objLogin= new clsLoginModel();
	    $Respuesta=$objLogin->CrearLogin($this->strUsuario,$this->strClave,$this->strNombreEmpleado,$intIdCompania);
	    $rpta = $objLogin->ListarPermisos(0,0);
	    $idLogin =  $Respuesta[0][1];
	    for ($i=0; $i < sizeof($rpta); $i++) { 
	    	$idPermiso = $rpta[$i]['idPermiso'];

	    	$objLogin->AgregarPermisos($idPermiso,$idLogin,0,0,0);
	    }


		echo $Respuesta[0]['Mensaje']."%success";
		$objLogin=null;
		$Respuesta=null;
	}
	public function EliminarUsuario(){
		$this->stridUsuario=trim($_POST['txtIdUsuario']);
		if($this->stridUsuario==""){
			echo "Seleccione el Usuario.%error";
			return;
		}
		$objLogin= new clsLoginModel();
	    $Respuesta=$objLogin->EliminarUsuario($this->stridUsuario);
		echo $Respuesta[0]['Mensaje']."%success";
		$objLogin=null;
		$Respuesta=null;
	}
	public function EditarUsuario(){
		$this->strNombreEmpleado=trim($_POST['strNombre']);
		$this->strUsuario=trim($_POST['strUsuario']);
		$this->strClave=trim($_POST['strClave']);
		$this->intIdUsuario=trim($_POST['intIdUsuario']);
		$intIdCompania=trim($_POST['intIdCompania']);
		$objLogin= new clsLoginModel();
	    $Respuesta=$objLogin->EditarUsuario($this->strNombreEmpleado,$this->strUsuario,$this->strClave,$this->intIdUsuario,$intIdCompania);
		echo $Respuesta[0]['Mensaje'].'%success';
		$Respuesta=null;
		$objLogin=null;
	}
	public function BuscarUsuario(){
		$this->intIdUsuario=trim($_POST['intIdUsuario']);
		$objLogin= new clsLoginModel();
	    $Respuesta=$objLogin->BuscarUsuario($this->intIdUsuario);
		echo $Respuesta[0]['strNombreEmpleado']	;
	}
	public function ListarEmpleados(){
		$this->intTipoEmpleado=trim($_POST['intTipoEmpleado']);
		$strContenido=$this->ConsultarWebService('ConsultarVendedores');
	
		$intTipo=-1;
		switch ($this->intTipoEmpleado) {
			case '1':
				$intTipo=16;
				break;
			case '2':
				$intTipo='09';
				break;	
			case '3':
				$intTipo=17;
				break;
		}
		$strRespuesta='<option value="TD">TODOS</option>';
		$strEmpleados=explode("&",$strContenido->ConsultarVendedoresResult);
		for($i=0;$i<=sizeof($strEmpleados)-2;$i++){
			$strContenidoEmpleado=explode("%",$strEmpleados[$i]);
			if($strContenidoEmpleado[2]!=0){
			if((string)$intTipo==trim($strContenidoEmpleado[2])){	
			$strRespuesta.="<option value='".$strContenidoEmpleado[0]."'>".$strContenidoEmpleado[1]."</option>";
			}
			}
		}
		echo $strRespuesta;
	}

	public function AgregarEmpeladosAsociados(){
		$this->strCedulaEmpleado=trim($_POST['strCedulaEmpleado']);
		$this->intTipoVista=trim($_POST['intVista']);
		$this->intTipoEmpleado=trim($_POST['strTipoEmpleado']);
		$this->strNombreEmpleado=trim($_POST['strNombreEmpleado']);
		$this->intIdUsuario=trim($_POST['intIdLogin']);
		$objLogin= new clsLoginModel();	    
	    $strRespuesta=$objLogin->AgregarEmpeladosAsociados($this->strCedulaEmpleado,$this->intTipoVista,$this->intTipoEmpleado,$this->strNombreEmpleado,$this->intIdUsuario);
	    $objLogin=null;
	    echo $strRespuesta[0]['Mensaje']."%success";
	}
	public function ListarUsuariosAsociados(){
		$this->intIdUsuario=trim($_POST['intIdLogin']);
		$objLogin = new clsLoginModel();	    
	    $strRespuesta=$objLogin->ListarUsuariosAsociados($this->intIdUsuario);
	    $objLogin=null;
	    $strContenido='';
	    $strTipoVista='';
	    if($strRespuesta==null){
	    	echo '<tr><td><h3>No hay empleados asociados.</h3></td></tr>';
	    }
	 	for($i=0;$i<=sizeof($strRespuesta)-1;$i++){
	 		switch ($strRespuesta[$i]['intTipoVista']) {
	 			case 1:
	 				 $strTipoVista='Blanca'; 
	 				break;
	 			case 2:
	 				  $strTipoVista='Verde';
	 				break;
	 			case 3:
	 				$strTipoVista='Verde y Blanca';
	 			break;	
	 		}
	 		$strContenido.="<tr><td>".$strRespuesta[$i]['strNombre']."</td><td>".$strRespuesta[$i]['dtFechaCreacion']."</td><td>".$strTipoVista."</td><td>".$strRespuesta[$i]['strTipoEmpleado']."</td><td><button class='btn btn-default' onclick='EliminarEmpleadoAsociado(\"".$strRespuesta[$i]['intIdEmpleado']."\")'><span class='glyphicon glyphicon-remove'></span></button></td></tr>";		
	 	}
	 	echo $strContenido;
	 	$objLogin=null;
	}

	public function EliminarEmpleadoAsociado(){
		$this->intIdUsuario=trim($_POST['intTipoEmpleado']);
		$objLogin = new clsLoginModel();	    
	    $strRespuesta=$objLogin->EliminarEmpleadoAsociado($this->intIdUsuario);
	    $objLogin=null;	
	    echo $strRespuesta[0]['Mensaje'].'%success';
	}








	public function ConsultarModulos($tipo)
	{
		$view = "";
		$objLogin = new clsLoginModel();
		$rpta=$objLogin->ConsultarModulos($tipo, 1);
		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 
				$view.="<option value=".$rpta[$i]['idPermiso'].">".$rpta[$i]['strPermiso']."</option>";
			}
		}
		echo $view;
		//var_dump($rpta);
	}

	public function AgregarModulo($modulo, $get, $descripcion, $tipoPermiso, $icono)
	{
		$objLogin = new clsLoginModel();
		$rpta=$objLogin->AgregarModulos($modulo, $get, $descripcion, $tipoPermiso, $icono);
		//var_dump($rpta);
		echo $rpta[0]['rpta'];
	}

	public function AgregarModuloDetalle($modulo, $get, $descripcion, $idPermiso, $tipoPermiso, $icono)
	{
		$objLogin = new clsLoginModel();
		$rpta=$objLogin->AgregarModuloDetalle($modulo, $get, $descripcion, $idPermiso, $tipoPermiso, $icono);
		//var_dump($rpta);
		echo $rpta[0]['rpta'];
	}

	public function ConsultarPermisos($tipo, $idUsuario)
	{
		$view = "";
		$objLogin = new clsLoginModel();
		$rpta=$objLogin->ConsultarModulos($tipo,1);

		//CONSULTAR PERMISOS POR LOGIN
		$strRespuesta=$objLogin->ListarPermisosPorUsuario($idUsuario);
		
		/*for ($i=0; $i <=sizeof($strRespuesta)-1 ; $i++) { 
			$strCtnPermisos.=$strRespuesta[$i]['idPermiso'].'%'.$strRespuesta[$i]['intVer'].'%'.$strRespuesta[$i]['intEditar'].'%'.$strRespuesta[$i]['intIngresar'].'%'.$strRespuesta[$i]['intTipoVista'].'&';
		}*/
		
		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 

				$idPermiso = $rpta[$i]['idPermiso'];
				$nombre = $rpta[$i]['strPermiso'];
				$ver1 = "chk".$rpta[$i]['strPermiso']."Ver";
				$editar1 = "chk".$rpta[$i]['strPermiso']."Editar";
				$ingresar1 = "chk".$rpta[$i]['strPermiso']."Ingresar";

				$rptaDetalle=$objLogin->ConsultarModulosDetalle($idPermiso,$tipo);

				//VALIDAR PERMISOS Y CHECKEAR
				$checkVer = "";
				$checkEditar = "";
				$checkIngresar = "";
				$key = array_search($idPermiso, array_column($strRespuesta, 'idPermiso'));
				if ($key >= 0) {
					if ($strRespuesta[$key]['intVer'] == 1) {
						$checkVer = "checked";
					}
					if ($strRespuesta[$key]['intEditar'] == 1) {
						$checkEditar = "checked";
					}
					if ($strRespuesta[$key]['intIngresar'] == 1) {
						$checkIngresar = "checked";
					}
				}

				$view.="<tr>
                      <td><h4><strong>".$rpta[$i]['strPermiso']."</strong></h4></td>
                      <td><input type='checkbox' id='".$ver1."' onchange='chkVer(\"$nombre\",\"$idPermiso\",\"$idUsuario\")' ".$checkVer."></td>
                      <td><input type='checkbox'  id='".$editar1."' onchange='chkEditar(\"$nombre\",\"$idPermiso\",\"$idUsuario\")' ".$checkEditar."></td>
                      <td><input type='checkbox'  id='".$ingresar1."' onchange='chkIngresar(\"$nombre\",\"$idPermiso\",\"$idUsuario\")' ".$checkIngresar."></td>
                     
                    </tr>";
                $checkboxs = "";
                if ($rptaDetalle != null) {
                	for ($j=0; $j < sizeof($rptaDetalle); $j++) { 
	                	$ver = "chkd".$rptaDetalle[$j]['strPermiso']."Ver";
						$editar = "chkd".$rptaDetalle[$j]['strPermiso']."Editar";
						$ingresar = "chkd".$rptaDetalle[$j]['strPermiso']."Ingresar";
						$idPermisoHijo = $rptaDetalle[$j]['idPermiso'];
						$nombreHijo = $rptaDetalle[$j]['strPermiso'];
	                    $checkboxs.= $rptaDetalle[$j]['strPermiso']."/".$idPermisoHijo."%";



	                    $checkVer = "";
						$checkEditar = "";
						$checkIngresar = "";
						$key = array_search($idPermisoHijo, array_column($strRespuesta, 'idPermiso'));
						if ($key >= 0) {
							if ($strRespuesta[$key]['intVer'] == 1) {
								$checkVer = "checked";
							}
							if ($strRespuesta[$key]['intEditar'] == 1) {
								$checkEditar = "checked";
							}
							if ($strRespuesta[$key]['intIngresar'] == 1) {
								$checkIngresar = "checked";
							}
						}



	                	$view.="<tr>
	                       <td style='text-align:center;'>".$rptaDetalle[$j]['strPermiso']."</td>
	                       <td><input type='checkbox' id='".$ver."'  onchange='chkVerHijo(\"$nombreHijo\",\"$idPermiso\",\"$idPermisoHijo\",\"$idUsuario\",\"$nombre\");' ".$checkVer."></td>
	                       <td><input type='checkbox' id='".$editar."' onchange='chkEditarHijo(\"$nombreHijo\",\"$idPermiso\",\"$idPermisoHijo\",\"$idUsuario\",\"$nombre\");' ".$checkEditar."></td>
	                       <td><input type='checkbox'  id='".$ingresar."' onchange='chkIngresarHijo(\"$nombreHijo\",\"$idPermiso\",\"$idPermisoHijo\",\"$idUsuario\",\"$nombre\");' ".$checkIngresar."></td><td></td>
	                    </tr>  ";
	                }
	               $view.="<tr style='display: none;'><td> <div id='list".$idPermiso."'>".$checkboxs."</div> </td></tr> ";
                }
                
                $view.="<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>";
			}
		}
		echo $view;
	}

	public function ActualizarPermisosLogin($intIdPermiso, $intIdLogin, $intVer, $intEditar, $intIngresar, $tipoVista)
	{
		$objLogin = new clsLoginModel();
		$rpta = $objLogin->ActualizarPermisosLogin($intIdPermiso, $intIdLogin, $intVer, $intEditar, $intIngresar, $tipoVista);
		echo $rpta[0]['rpta'];
	}

	//Lista toda la tabla permisos
	public function ConsultarAllPermisos($tope, $totalPermisos)
	{
		$inicio = 0;
		if ($tope != 0) {
			$inicio = $tope - 5;
		}
		$view = "";
		$objLogin = new clsLoginModel();
		$rpta = $objLogin->ListarPermisos($inicio,5);
		$total = sizeof($rpta);
		if (($totalPermisos-$tope) < 5 && ($totalPermisos-$tope) > 0) {
			$tope = $total;
		}
		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 
				$plataforma = "";
				if ($rpta[$i]['intTipoPermiso'] == 1) {
					$plataforma = "Web";
				}else{
					$plataforma = "Desktop";
				}
				$id = $rpta[$i]['idPermiso'];
				$nombre = $rpta[$i]['strPermiso'];
				$get = $rpta[$i]['strGet'];
				$iddetalle = $rpta[$i]['intDetalle'];
				$descripcion = $rpta[$i]['strDescripcion'];
				$icono = $rpta[$i]['strClaseIcono'];

				$view.=" 
				  <tr>
                    <td>".$rpta[$i]['idPermiso']."</td>
                    <td>".$rpta[$i]['strPermiso']."</td>
                    <td>".$rpta[$i]['strGet']."</td>
                    <td>".$plataforma."</td>
                    <td>".$rpta[$i]['intDetalle']."</td>
                    <td><button class='btn btn-default' onclick='EditarPermiso(\"$id\",\"$nombre\",\"$get\",\"$plataforma\",\"$descripcion\",\"$iddetalle\",\"$icono\")'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>
                    <button class='btn btn-default' onclick='EliminarPermiso(\"$id\")'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></td>
                  </tr>";
			}
		}
		echo $view;
	}

	public function Paginas()
	{
		$view = "";
		$objLogin = new clsLoginModel();
		$rpta = $objLogin->ListarPermisos(0,0);
		
		if ($rpta != null) {
			$total = sizeof($rpta);
			$cantidad = ($total/5)+1;
			for ($i=1; $i <= $cantidad; $i++) {
				$view.="<button type='button' class='btn btn-secondary' onclick='ConsultarPermisos(".$i.");'>".$i."</button>";
			}
		}
		echo $view.="<div style='display: none;' id='tamañoPermisos'>".$total."</div>";
	}

	public function ActualizarModulo($nombre,$get,$descripcion, $tipoPermiso, $id, $icono)
	{
		$objLogin = new clsLoginModel();
		$rpta = $objLogin->ActualizarModulo($nombre,$get,$descripcion, $tipoPermiso, $id, $icono);
		echo $rpta[0]['rpta'];
	}

	public function ActualizarModuloDetalle($nombre,$get,$descripcion, $idModulo, $tipoPermiso, $id, $icono)
	{
		$objLogin = new clsLoginModel();
		$rpta = $objLogin->ActualizarModuloDetalle($nombre,$get,$descripcion, $idModulo, $tipoPermiso, $id, $icono);
		echo $rpta[0]['rpta'];
	}

	public function EliminarModulo($id)
	{
		$objLogin = new clsLoginModel();
		$rpta = $objLogin->EliminarModulo($id);
		echo $rpta[0]['rpta'];
	}
}





?>