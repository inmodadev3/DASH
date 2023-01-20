<?php 

include_once ("../Model/clsLoginModel.php");
$obj = new clsHeaderController();
session_start();

if(isset($_POST['CargarMenu'])){
	$obj->CargarMenu();
}

class clsHeaderController
{
	
	function __construct()
	{
		
	}
	function CargarMenu()
	{
		$view = '
				<li class="sidebar-search">
	                 <div class="input-group custom-search-form">
	                    <input type="text" class="form-control" placeholder="Buscar">
	                    <span class="input-group-btn">
	                    <button class="btn btn-default" type="button">
	                        <i class="fa fa-search"></i>
	                    </button></span>
	                 </div>
                 </li>';
		$objLogin = new clsLoginModel();
		$rpta=$objLogin->ConsultarModulos(1,1);
		//CONSULTAR PERMISOS POR LOGIN
		if(!isset($_SESSION['idLogin'])){
			return;
		}
		$strRespuesta=$objLogin->ListarPermisosPorUsuario($_SESSION['idLogin']);

		$_SESSION['Permisos']=$strRespuesta;
		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 
				
				$idPermiso = $rpta[$i]['idPermiso'];
				$idDetalle = $rpta[$i]['intDetalle'];
				$nombre = $rpta[$i]['strPermiso'];
				$ver1 = "chk".$rpta[$i]['strPermiso']."Ver";
				$editar1 = "chk".$rpta[$i]['strPermiso']."Editar";
				$ingresar1 = "chk".$rpta[$i]['strPermiso']."Ingresar";
				$icono = $rpta[$i]['strClaseIcono'];
				if ($icono == "") {
					$icono = "warning-sign";
				}
				$rptaDetalle=$objLogin->ConsultarModulosDetalle($idPermiso,1);
				$class = "";
				if ($rptaDetalle != null) {
					$class = "glyphicon glyphicon-triangle-bottom";
				}

				//VALIDAR PERMISOS Y PINTAR SOLO LOS HABILITADOS
				$key = array_search($idPermiso, array_column($strRespuesta, 'idPermiso'));
				if ($key >= 0) {
					if ($strRespuesta[$key]['intVer'] == 1) {
						if ($idPermiso == $idDetalle) { //ENCABEZADOS
							$view.='
							 <li> 
                             	<a href="#" style="color:#337ab7;"><strong><i class="glyphicon glyphicon-'.$icono.'"></i>   '.$nombre.'<span style="float: right;" class="'.$class.'"></span></strong></a>';
						}
					}
				}
				
				
                $checkboxs = "";
                //$rptaDetalle = null;
                if ($rptaDetalle != null) {
                	$view.='<ul class="nav nav-second-level">';
                	for ($j=0; $j < sizeof($rptaDetalle); $j++) { 
	                	$ver = "chk".$rptaDetalle[$j]['strPermiso']."Ver";
						$editar = "chk".$rptaDetalle[$j]['strPermiso']."Editar";
						$ingresar = "chk".$rptaDetalle[$j]['strPermiso']."Ingresar";
						$idPermisoHijo = $rptaDetalle[$j]['idPermiso'];
						$nombreHijo = $rptaDetalle[$j]['strPermiso'];
	                    $checkboxs.= $rptaDetalle[$j]['strPermiso']."/".$idPermisoHijo."%";
	                    $get = $rptaDetalle[$j]['strGet'];
	                    $icono = $rptaDetalle[$j]['strClaseIcono'];
	                    if ($icono == "") {
							$icono = "warning-sign";
						}
	                    $key = array_search($idPermisoHijo, array_column($strRespuesta, 'idPermiso'));
						if ($key >= 0) {
							if ($strRespuesta[$key]['intVer'] == 1) {//DETALLE
								$view.='
                                <li>
                                    <a href="?menu='.$get.'"  style="color:#888888;"><strong><i class="glyphicon glyphicon-'.$icono.'"></i> '.$nombreHijo.'</strong></a>
                                </li>
                            ';
							}
						}
	                	
	                }
	                $view.=' </ul>';
                }
                if ($idPermiso == $idDetalle) {
					 $view.='</li>  ';
				}
               
			}
			$view.='<li class="SessionUL">
                         <a href="?menu=Cerrar" style="color: #337ab7;" ><strong>Cerrar Session</strong></a>
                    </li>   ';
		}
		echo $view;
	}
}
?>