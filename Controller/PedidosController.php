<?php 
date_default_timezone_set('America/Bogota');
include_once ("../Model/clsPedidosModel.php");
$objPedido=new clsPedidosController();

if(isset($_POST['btnEmpezarPedido'])){
	echo $objPedido->EmpezarPedido();
}

if(isset($_POST['btnAgregarProducto'])){
	if($objPedido->AddReferencia()){	
			$objPedido->AddLote();
	}
}
if(isset($_POST['btnListarPedido'])){
//$objPedido->ListarPedidoEncabezado('1');
}
if(isset($_POST['ListarReferenciaLinea'])){
	$objPedido->ListarReferenciaPorLinea();
}
if(isset($_POST['btnEliminarLote'])){
$objPedido->EliminarLotePedido();

}
if(isset($_POST['btnListarPedidoLoteLinea'])){
$objPedido->ListarLotePorLineaReferencia();
}

if(isset($_POST['btnEliminarReferencia'])){
$objPedido->EliminarReferencia();
}
if(isset($_POST['ListarLineaPorPedido'])){
$objPedido->ListarLineaPorPedido("1");
}
if(isset($_POST['btnListarPedidoLineaDescargado'])){
$objPedido->ListarLineaPorPedido("2");
}
if(isset($_POST['btnListarPedidoLinea'])){
	$objPedido->ReferenciaPorLinea();
}
if(isset($_POST['btnGenerarExcel'])){
$objPedido->GenerarExcelPedidos();
}

if(isset($_POST['btnBuscarReferencia'])){
$objPedido->ListarPedidoEncabezado("1");
}
$objPedido=null;

class clsPedidosController 
{
	private $UrlWebService="";
	private $strReferencia;
	private $strUDM;
	private $idLinea;
	private $idGrupo;
	private $idClase;
	private $idTipo;
	private $intCantidad;
	private $idTipoEnvio;
	private $intNroDocumento;
	private $idEstilo;
	private $idColor;
	private $idTalla;
	private $strCodColorChina;
	private $strRutaFile;
	private $strObservacion;
	private $strRutaFileColores="";

	function __construct()
		{//http://181.143.42.218/WebModaService.asmx?WSDL  inmodafantasy.com.co  http://webservice.inmodafantasy.com.co
			$this->UrlWebService="http://10.10.10.150/webservice/WebModaService.asmx?WSDL";
			$this->strReferencia="";
			$this->strUDM="";
			$this->idLinea="";
			$this->idGrupo="";
			$this->idClase="";
			$this->idTipo="";
			$this->strCodColorChina="";
			$this->intCantidad="";
			$this->idTipoEnvio="";
			$this->intNroDocumento="";
			$this->idEstilo="";
			$this->idColor="";
			$this->idTalla="";
			$this->strRutaFile="";
			$this->strRutaFileColores="";
			$this->strObservacion="";
	}

	public function ConsultarWebService($Tipo){		
			$client = new SoapClient($this->UrlWebService);
			$WebServiceSticker=$client->$Tipo(); 
			$client=null;
		  	return	$WebServiceSticker;
	}
	private function ConsultarWebServiceHGI($URL,$Tipo){
		$parametros=array();
		$parametros['usuario']="Servicio";
		$parametros['clave']="Servicio";
		$parametros['codigo_compania']="1";
		$parametros['codigo_empresa']="1";
		$client = new SoapClient($URL);
		$result = $client->Autenticar($parametros); 
		$parametros=array(); 
		$parametros['codigo']="*";
		$result = $client->$Tipo($parametros);
		$parametros=null;
		$client=null;
		return $result; 
	}
	private function Validar($Tipo){
		switch ($Tipo) {
			case 'AddPedido':
				if($this->strReferencia==""){
					echo   "Ingrese la referencia del producto.<br>%error";
					return false;
				}	/*		
				if($this->strCodColorChina==""){
					echo   "Ingrese codigo del color.%error";
					return false;
				}*/
					if($this->intCantidad==""){
					echo  "Ingrese cantidad de la referencia.<br>%error";
					return false;
				}
				/*if($this->idTalla==""){
					echo  "Ingrese Talla de la referencia.<br>%error";
					return false;
				}*/
				if(!is_numeric($this->intCantidad)){
					echo  "Ingrese solo numeros en el campo cantidad de la referencia.<br>%error";
					return false;
				}

				if(!is_numeric($this->intNroDocumento)){
					echo  "Ingrese solo numeros en el numero de documento.%error";
					return false;
				}
				/*if($this->idEstilo=='0' && $this->idColor=='0' && $this->idTalla=='0'){
					echo "<strong>Debe ingresar un Estilo o Color o Talla</strong>";
					return false;
				}*/
				

			break;
		
		}
		return true;	

	}
	public function ObtenerCodigoPedido(){
	$objPedido = new clsPedidosModel();
	$CodigoPedidos= $objPedido->ObtenerCodigoPedido();
	$objPedido=null;
	if($CodigoPedidos==null){
            return 1;
        }else{	
			return $CodigoPedidos[0]['CodigoPedido'];
		}
	}

	public function ListarTipoEnvio(){
		$objPedido= new clsPedidosModel();
		$CodigoPedidos=$objPedido->ListarTipoEnvio();
		$objPedido=null;
		return $CodigoPedidos;	
	}

	public function ListarLinea(){
		$strLineas=$this->ConsultarWebServiceHGI("http://hgi.inmodafantasy.com.co/hginetserviciosweb/ServiciosWCF/Productos/ServicioLineas.svc?WSDL","Obtener");	
		return $strLineas;
	}
	public function ListarGrupo(){
		$strGrupo=$this->ConsultarWebServiceHGI("http://hgi.inmodafantasy.com.co/hginetserviciosweb/ServiciosWCF/Productos/ServicioGrupos.svc?WSDL","Obtener");	
		return $strGrupo;
	}
	public function ListarClase(){
		$strClases=$this->ConsultarWebServiceHGI("http://hgi.inmodafantasy.com.co/hginetserviciosweb/ServiciosWCF/Productos/ServicioClases.svc?WSDL","Obtener");	
		return $strClases;
	}
	public function ListarTipos(){
		$strTipo=$this->ConsultarWebServiceHGI("http://hgi.inmodafantasy.com.co/hginetserviciosweb/ServiciosWCF/Productos/ServicioTipos.svc?WSDL","Obtener");	
		return $strTipo;
	}
	public function EmpezarPedido(){
		$objPedido= new clsPedidosModel();
		$objPedido->EmpezarPedido();
		$objPedido=null;
		return 'Pedido iniciado.';
	}
	public function AddReferencia(){
		$objPedido= new clsPedidosModel();
		$this->strReferencia=trim($_POST["txtReferencia"]);
		$this->strUDM=trim($_POST['ddlUDM']);
		$this->idLinea=trim($_POST['ddlLinea']);
		$this->idGrupo=trim($_POST['ddlGrupo']);
		$this->idClase=trim($_POST['ddlClase']);
		$this->idTipo=trim($_POST['ddlTipo']);
		$this->idTalla=trim($_POST['ddlTalla']);
		$this->idColor=trim($_POST['ddlColor']);
		$this->idEstilo=trim($_POST['ddlEstilo']);
		$this->strCodColorChina=trim($_POST['txtCodColorChina']);
		$this->intCantidad=trim($_POST['txtCantidad']);		
		$this->idTipoEnvio=trim($_POST['ddlTipoEnvio']);
		$this->intNroDocumento=trim($_POST['txtNroDocumento']);
		$this->strObservacion=trim($_POST['txtObservacion']);
		if(!$this->Validar("AddPedido")){
			return false;
		}		
			if(@isset($_FILES['File'])){
				$RutaImg="../img/".$this->strReferencia.".jpg";
				@move_uploaded_file($_FILES['File']['tmp_name'],$RutaImg);				
			}else{
				$img=explode("?",$_POST['img']);
				$imgRuta= explode("/",str_replace("//", "/", $img[0]));
				$RutaImg="../".$imgRuta[3]."/".$imgRuta[4];	
			}


			if(@isset($_FILES['FileColores'])){
				$RutaImgColores="../img/".$this->strReferencia."Colores.jpg";
				@move_uploaded_file($_FILES['FileColores']['tmp_name'],$RutaImgColores);				
			}else{
				$ImgColores=explode("?",$_POST['imgColores']);
				$ImgeColores= explode("/",str_replace("//", "/", $ImgColores[0]));
				$RutaImgColores="../".$ImgeColores[3]."/".$ImgeColores[4];	
			}



		$this->strRutaFile=trim($RutaImg);
		$this->strRutaFileColores=trim($RutaImgColores);		
		$Respuesta=$objPedido->AddReferencia($this->strReferencia,$this->strUDM,$this->idLinea,$this->idGrupo,$this->idClase,$this->idTipo,$this->idTipoEnvio,$this->intNroDocumento,$this->strRutaFile,$this->strObservacion,$this->strRutaFileColores);
		$objPedido=null;			
		echo $Respuesta[0]['Mensaje'];
		$Respuesta=null;
		return true;	
	}
	public function AddLote(){
		$objPedido= new clsPedidosModel();
		
			if(@isset($_FILES['FileEstilo'])){
				$RutaImgEstilo="../img/".$this->strReferencia."Estilo".time().".jpg";
				move_uploaded_file($_FILES['FileEstilo']['tmp_name'],$RutaImgEstilo);				
			}else{
				$ImgColores=explode("?",$_POST['imgEstilo']);
				$ImgeColores= explode("/",str_replace("//", "/", $ImgColores[0]));
				$RutaImgEstilo="../".$ImgeColores[3]."/".$ImgeColores[4];	
			}




	
		$Respuesta=$objPedido->AddLote($this->strReferencia,$this->idColor,$this->idTalla,$this->idEstilo,$this->strCodColorChina,$this->intCantidad,$RutaImgEstilo);
		$objPedido=null;
		echo "<br>".$Respuesta[0]['Mensaje']."%success";	
		$Respuesta=null;
	}
	public function ListarLotePorLineaReferencia(){
		$objPedido= new clsPedidosModel();
		$this->idLinea=trim($_POST['ddlLinea']);
		$this->idGrupo=trim($_POST['ddlGrupo']);
		$this->idClase=trim($_POST['ddlClase']);
		$this->idTipo=trim($_POST['ddlTipo']);
		
		$this->ListarPedidoEncabezado('2');
	}
	public function ListarReferenciaPorLinea(){		
		$objPedido= new clsPedidosModel();
		$this->intNroDocumento=trim($_POST['txtNroDocumento']);
		$this->idLinea=trim($_POST['ddlLinea']);
		$this->idGrupo=trim($_POST['ddlGrupo']);
		$this->idClase=trim($_POST['ddlClase']);
		$this->idTipo=trim($_POST['ddlTipo']);
		$Respuesta=$objPedido->ListarLoteReferenciaPorLinea($this->intNroDocumento,$this->idClase,$this->idLinea,$this->idGrupo,$this->idTipo);
		$objPedido=null;
		$Contenido="";
		for($i=0;$i<=sizeof($Respuesta)-1;$i++){
		$Contenido.="<option value=".$Respuesta[$i]['strReferencia'].">".$Respuesta[$i]['strReferencia']."</option>";
		}
		echo $Contenido;
		$Respuesta=null;
	}
	public function ListarPedidoEncabezado($Tipo){
		$objPedido= new clsPedidosModel();
		$this->intNroDocumento=trim($_POST['txtNroDocumento']);
		
		if($Tipo=='1'){
		   $this->strReferencia=trim($_POST['txtReferencia']);
		   $this->idLinea=trim($_POST['ddlLinea']);
		   $this->idGrupo=trim($_POST['ddlGrupo']);
		   $this->idClase=trim($_POST['ddlClase']);
		   $this->idTipo=trim($_POST['ddlTipo']);
		   $Respuesta=$objPedido->BuscarReferencia($this->strReferencia,$this->intNroDocumento,$this->idClase,$this->idLinea,$this->idGrupo,$this->idTipo);
			$RespuestaLote=$objPedido->BuscarLotePorReferencia($this->strReferencia,$this->intNroDocumento,$this->idClase,$this->idLinea,$this->idGrupo,$this->idTipo);

				/*$Respuesta=$objPedido->ListarPedidoEncabezado($this->intNroDocumento,'CALL SP_ListarPedidosEncabezado(?)');
				$RespuestaLote=$objPedido->ListarPedidoDetalle($this->intNroDocumento);*/
		}else{
				$Respuesta=$objPedido->ListarLoteReferenciaPorLinea($this->intNroDocumento,$this->idClase,$this->idLinea,$this->idGrupo,$this->idTipo);
				$RespuestaLote=$objPedido->ListarPedidoDetallePorLinea($this->intNroDocumento,$this->idClase,$this->idLinea,$this->idGrupo,$this->idTipo);
			
		}

		
		$Contenido="";
		$k=0;

		for($i=0;$i<=sizeof($Respuesta)-1;$i++){

		$Contenido.="<tr><td style='padding: 2px;'>".
                     "<label class='btn btn-default' for='my-file-selector".$i."' onchange ='AgregarImagen(\"".$i."\");'>".
                      "<input id='my-file-selector".$i."' type='file' accept='image/*'  style='display:none;'> <i class='glyphicon glyphicon-plus'></i> </label><br>".
                        "<img  src='".$Respuesta[$i]['strRutaFoto']."?nocache=".time()."' onclick='MostrarImagen(this);' width='75' height='80' id='imgCrear".$i."'/>".
                        "<br>".
                                           "<label onclick='EliminarImgProducto(\"".$i."\");' class='btn btn-default'><i class='glyphicon glyphicon-remove'></i></label>                                              <br><br> ".
                        	"<label class='btn btn-default' for='myImg".$i."' onchange ='AgregarImagenColores(\"".$i."\");'>".
                                            "<form  enctype='multipart/form-data'>".
                                            "<input id='myImg".$i."' type='file' name='File' accept='image/*'  style='display:none;'". 
                                            "/></form>".
                                            "<i class='glyphicon glyphicon-plus'></i>".
                                       		"</label><br>".
                                            "<img  src='".$Respuesta[$i]['strRutaFotoColores']."?nocache=".time()."' onclick='MostrarImagen(this);' width='75' height='80' id='imgColores".$i."'>" .
                                            "<br>".
                                           "<label onclick='EliminarImgColores(\"".$i."\");' class='btn btn-default'><i class='glyphicon glyphicon-remove'></i></label>                                               "                                 
                    ."</td>".
                     "<td style='padding: 2px;'><br>".
                        "<input type='text' value=".$Respuesta[$i]['strReferencia']."  class='form-control' id='txtReferencia".$i."' placeholder='Ingrese Referencia...' readonly='readonly'><br>".
                        "<textarea style='min-width: 200px;max-width:200px;min-height: 100px;max-height: 100px;' placeholder='Observación' id='txtObservacion".$i."' class='form-control'>".$Respuesta[$i]['strObservacion']."</textarea><br>".
                     "</td>".
                     "<td>".
                        "<select class='form-control display-inline-block' id='ddlUDM".$i."'>".
                        	"<option value=".$Respuesta[$i]['strUnidadMedida'].">".$Respuesta[$i]['strUnidadMedida']."</option>"
                        ."</select>".
                     "</td>".
                     "<td>".
                         "<select class='form-control display-inline-block' id='ddlTipoEnvio".$i."'>"
							."<option value=".$Respuesta[$i]['idTipoEnvio'].">".$Respuesta[$i]['idTipoEnvio']."</option>"
                        ."</select>".
                    "</td>".
                     "<td>".
                         "<table class='table table-bordered' style='margin: 0;' id='tblReferenciaNewFila".$i."'>".
                                "<thead>". 
                                   "<th>Foto</th><th style='width:16%;'>Estilo</th>".
                                   "<th style='width:33%;'>Color</th>".
                                   "<th style='width:15%;'>Talla</th>".
                                   "<th style='width:13%;'>Cantidad</th>".
                                   "<th>".
                                       "<button class='btn btn-default'  onclick='ClonarNewFilaReferencia(\"".$i."\");'><i class='glyphicon glyphicon-plus'></i></button>".
                                         "<button class='btn btn-default' style='Margin-left:4px;' onclick='NeWFilaReferencia(\"".$i."\");'><i class='glyphicon glyphicon-minus'></i></button>".
                                    "</th>".
                                "</thead><tbody>";


                                while(true){
									$Ocultar="";
                                		if(trim($RespuestaLote[$k]['idLote'])==0 && trim($RespuestaLote[$k]['idColor'])==0 &&  trim($RespuestaLote[$k]['idTalla'])==0 && trim($RespuestaLote[$k]['intCantidad'])==0 && trim($RespuestaLote[$k]['idColorAlternoChina'])=='Sin Codigo'){
                                			$Ocultar=" style='display:none;'";
                                		}
                                		
	                                	$Contenido.="<tr".$Ocultar.">".
	                                	"<td style='display: none;'>".
	                                		"<input type='text' id='txtCodigo".$k."' value='".$i."'/>".
	                                    "</td>".
	                                	 "<td style='display:none;'>". 
	                                    	"<input type='text' id='txtIdLote".$k."' value='".$RespuestaLote[$k]['id']."'/>".
	                                    "</td>".
                                        "<td><label class='btn btn-default' for='myImgEstilo".$k."' onchange ='AgregarImagenEstilo(\"".$k."\");'>".
                                                  "<form  enctype='multipart/form-data'>".
                                                  "<input id='myImgEstilo".$k."' type='file' name='File' accept='image/*' style='display:none;'".
                                                  "/></form>".
                                                  "<i class='glyphicon glyphicon-plus'></i>".
                                              "</label><br>".
                                                "<img  src='".$RespuestaLote[$k]['strRutaFotoEstilo']."?nocache=".time()."' onclick='MostrarImagen(this);' width='75' height='80' id='txtFotoEstilo".$k."' >".
                                                      "<br>".
                                           "<label onclick='EliminarImgEstilo(\"".$k."\");' class='btn btn-default'><i class='glyphicon glyphicon-remove'></i></label>                                              </td>".
	                                   
	                                    "<td>".
	                                        "<select class='form-control' id='ddlEstilo".$k."'>". 
	                                            "<option value='".$RespuestaLote[$k]['idLote']."'>".$RespuestaLote[$k]['idLote']."</option>". 
	                                         "</select>".
	                                    "</td>".	
	                                     "<td>".
	                                       "<select class='float-left form-control w-50'  id='ddlColor".$k."'>".
	                                          "<option value=".$RespuestaLote[$k]['idColor'].">".$RespuestaLote[$k]['idColor']."</option>".           
	                                        "</select>".
	                                            "<input type='text' placeholder='Ingrese Codigo' value='".$RespuestaLote[$k]['idColorAlternoChina']."' id='txtColor".$k."' class='form-control w-50'/>".
	                                    "</td>".
	                                    "<td>".
	                                        "<input type='text' class='form-control display-inline-block' id='ddlTalla".$k."' placeholder='Talla' value='".$RespuestaLote[$k]['idTalla']."'>".
	                                       /* "<select class='form-control display-inline-block' id='ddlTalla".$k."'>".
	                                          "<option value=".$RespuestaLote[$k]['idTalla'].">".$RespuestaLote[$k]['idTalla']."</option>".
	                                        "</select>".*/
	                                    "</td>".
	                                     "<td>".
	                                        "<input type='number' value='".$RespuestaLote[$k]['intCantidad']."'  placeholder='Cantidad' class='form-control display-inline-block ' id='txtCantidad".$k."'>".
	                                    "</td>".
	                                    "<td>".
	                                       "<button class='btn btn-default' onclick='AgregarProductoPedido(\"".$k."\");'><i class='glyphicon glyphicon-floppy-disk'></i></button> <button class='btn btn-default' onclick='EliminarLote(\"".$k."\");'>".
                                                  "<i class='glyphicon glyphicon-remove'></i>".
                                                "</button>".
	                                    "</td> </tr>";
	                                
	                                  
	                                 if($k==sizeof($RespuestaLote)-1){
	                                 	break;
	                                 }   
	                                if(!($RespuestaLote[$k]['strReferencia']==$RespuestaLote[$k+1]['strReferencia'])){
	                                	$k++;
	                                	break;
	                                }else{
	                                	$k++;
	                                }
	                               

                                }
                                    $Contenido.="</tbody>".
                         "</table>".
                   "</td>".
                   "</tr>";           
		}
		$objPedido=null;
		if($i>0){
		echo "<tr style='display:none;'><td><input type='text' value='".($i-1)."' id='valorFila'/><input type='text' value='".$k."' id='valorFilaLote'/></td></tr>".$Contenido;
	}else{
		echo "NULL";
	}
		$Respuesta=null;
		$RespuestaLote=null;
	}
	public function EliminarLotePedido(){
		$objPedido= new clsPedidosModel();
		$this->idTalla=trim($_POST['ddlTalla']);
		$this->idColor=trim($_POST['ddlColor']);
		$this->idEstilo=trim($_POST['ddlEstilo']);
		$this->strReferencia=trim($_POST['txtReferencia']);
		if($this->strReferencia==""){
			echo 'Ingrese referencia.%error';
			return;
		}
		
		$Respuesta=$objPedido->EliminarLotePedido($this->strReferencia,$this->idColor,$this->idTalla,$this->idEstilo);
		$objPedido=null;
		echo $Respuesta[0]['Mensaje']."%success";
		$Respuesta=null;
	}
	public function EliminarReferencia(){
		$objPedido= new clsPedidosModel();
		$this->strReferencia=trim($_POST['txtReferencia']);
		$Respuesta=$objPedido->EliminarReferencia($this->strReferencia);
		if($this->strReferencia==""){
			echo 'Seleccione referencia.%error';
			return;
		}
		$objPedido=null;
		echo $Respuesta[0]['Mensaje']."%success";
		$Respuesta=null;
	}
	public function ListarLineaPorPedido($Tipo){
		$objPedido= new clsPedidosModel();
		$this->intNroDocumento=trim($_POST['txtNroDocumento']);
		$Contenido="";
		if($Tipo=="1"){
			$Respuesta=$objPedido->ListarLineaPorPedido($this->intNroDocumento);
			
			for($i=0;$i<=sizeof($Respuesta)-1;$i++){
					$Contenido.="<tr>".
									"<td><input type='checkbox' id='chk".$i."' /></td>".
									"<td style='display:none;' id='idLinea".$i."'>".$Respuesta[$i]['idLinea']."</td>".
									"<td style='display:none;'  id='idGrupo".$i."'>".$Respuesta[$i]['idGrupo']."</td>".
									"<td style='display:none;'  id='idClase".$i."'>".$Respuesta[$i]['idClase']."</td>".
									"<td style='display:none;'  id='idTipo".$i."'>".$Respuesta[$i]['idTipo']."</td>".
									"<td>".$Respuesta[$i]['idLinea']."</td>".
									"<td>".$Respuesta[$i]['idGrupo']."</td>".
									"<td>".$Respuesta[$i]['idClase']."</td>".
									"<td>".$Respuesta[$i]['idTipo']."</td>".
									"<td style='display:none;'><input type='text' value='".$Respuesta[$i]['datFecha']."' id='dtDocumento' /></td>".
									"<td><button class='btn btn-default' onclick='ListarReferenciaPorLinea(\"".$i."\")'><i class='glyphicon glyphicon-eye-open' style='color:#000;'></i></button></td></tr>";
			}
		}else{
			$Respuesta=$objPedido->ListarLineaPorPedidoDescargados($this->intNroDocumento);
			for($i=0;$i<=sizeof($Respuesta)-1;$i++){
					$Contenido.="<tr>".
									"<td><input type='checkbox' id='chkD".$i."' /></td>".
									"<td style='display:none;' id='idLinea".$i."D'>".$Respuesta[$i]['idLinea']."</td>".
									"<td style='display:none;' id='idGrupo".$i."D'>".$Respuesta[$i]['idGrupo']."</td>".
									"<td style='display:none;' id='idClase".$i."D'>".$Respuesta[$i]['idClase']."</td>".
									"<td style='display:none;' id='idTipo".$i."D'>".$Respuesta[$i]['idTipo']."</td>".	
									"<td>".$Respuesta[$i]['idLinea']."</td>".
									"<td>".$Respuesta[$i]['idGrupo']."</td>".
									"<td>".$Respuesta[$i]['idClase']."</td>".
									"<td>".$Respuesta[$i]['idTipo']."</td>".
									"<td><button class='btn btn-default' onclick='ListarReferenciaPorLinea(\"".$i."D\")'><i class='glyphicon glyphicon-eye-open' style='color:#000;'></i></button></td></tr>";
			}
		}
		
		$objPedido=null;
		echo $Contenido;
		$Contenido=null;
		$Respuesta=null;
	}
	public function ReferenciaPorLinea(){
		$objPedido= new clsPedidosModel();
		$this->intNroDocumento=trim($_POST['txtNroDocumento']);
		$this->idLinea=trim($_POST['ddlLinea']);
		$this->idGrupo=trim($_POST['ddlGrupo']);
		$this->idClase=trim($_POST['ddlClase']);
		$this->idTipo=trim($_POST['ddlTipo']);
		$Respuesta=$objPedido->ListarLoteReferenciaPorLinea($this->intNroDocumento,$this->idClase,$this->idLinea,$this->idGrupo,$this->idTipo);
		$RespuestaLote=$objPedido->ListarPedidoDetallePorLinea($this->intNroDocumento,$this->idClase,$this->idLinea,$this->idGrupo,$this->idTipo);
		$k=0;
		$Contenido="";
		for($i=0;$i<=sizeof($Respuesta)-1;$i++){
		$Contenido.="<tr><td style='background:#879BF8;text-align:center;padding-top:35px;'><strong>".$Respuesta[$i]['strReferencia']."<td></td><td></td><td></td></strong></td><td  style='text-align: center;'>"
		."<img  src='".$Respuesta[$i]['strRutaFoto']."' width='75' height='80' onclick='MostrarImagen(this);'/></td></tr>";
		while(true){
					$Ocultar="";
                    if(trim($RespuestaLote[$k]['idLote'])==0 && trim($RespuestaLote[$k]['idColor'])==0 &&  trim($RespuestaLote[$k]['idTalla'])==0 && trim($RespuestaLote[$k]['intCantidad'])==0 && trim($RespuestaLote[$k]['idColorAlternoChina'])=='Sin Codigo'){
                                			$Ocultar=" style='display:none;'";
                    }                              		
					$Contenido.="<tr".$Ocultar."><td><strong>Estilo</strong></td><td><strong>Color</strong></td><td><strong>Talla</strong></td><td><strong>Codigo Color China</strong></td><td><strong>Cantidad</strong></td></tr>
					<tr".$Ocultar."><td id='idLote".$k."'>".$RespuestaLote[$k]['idLote']."</td>".
					"<td id='idColor".$k."'>".$RespuestaLote[$k]['idColor']."</td>".
					"<td id='idTalla".$k."'>".$RespuestaLote[$k]['idTalla']."</td>".
					"<td id='idCodColor".$k."'>".$RespuestaLote[$k]['idColorAlternoChina']."</td>".
					"<td id='txtCantidad".$k."'>".$RespuestaLote[$k]['intCantidad']."</td>".
					"</tr>";
	               
	                if($k==sizeof($RespuestaLote)-1){
	                                 	break;
	                }   
	                if(!($RespuestaLote[$k]['strReferencia']==$RespuestaLote[$k+1]['strReferencia'])){
	                                	$k++;
	                                	break;
	                     }else{
	                                	$k++;
	                 }}
		}
		echo $Contenido;
		$Respuesta=null;
		$RespuestaLote=null;
		$Contenido=null;
		$objPedido=null;
	}
	
	public function GenerarExcelPedidos(){
		$objPedido= new clsPedidosModel();
		//$ResultadoTallas=$this->ConsultarWebService("Tallas");
        //$Tallas=explode("%",$ResultadoTallas->TallasResult);
        $TipoEnvio=$this->ListarTipoEnvio();            
		$ArrayExcel=$_POST['ArrayExcel'];
		$this->intNroDocumento=trim($_POST['txtNroDocumento']);
		require_once '../Classes/PHPExcel.php';
	    $objPHPExcel = new PHPExcel();
		$DatosExcel=explode("<",$ArrayExcel);
				$fila=1;
				
		for($j=0;$j<=sizeof($DatosExcel)-1;$j++){
		   if(trim($DatosExcel[$j])==""){
				break;
			}
			$k=0;
			$Respuesta="";
			$RespuestaLote="";	
		$Datos=explode("-",$DatosExcel[$j]);
		$Respuesta=($objPedido->ListarLoteReferenciaPorLinea($this->intNroDocumento,$Datos[2],$Datos[0],$Datos[1],$Datos[3]));
		$RespuestaLote=($objPedido->ListarPedidoDetallePorLinea($this->intNroDocumento,$Datos[2],$Datos[0],$Datos[1],$Datos[3]));
		$objPedido->CambiarEstadoReferenciaDescargado($this->intNroDocumento,$Datos[2],$Datos[0],$Datos[1],$Datos[3]);
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setVisible(false);		
		for($i=0;$i<=sizeof($Respuesta)-1;$i++){
			if(trim($Respuesta[$i]['strRutaFoto']) != '../img/img.png'){
					$objDrawing = new PHPExcel_Worksheet_Drawing();
					 
                    $img =$Respuesta[$i]['strRutaFoto']; 
                    $objDrawing->setPath($img);
                
                    $objDrawing->setOffsetX(0);    
                    $objDrawing->setOffsetY(4);  
                    $objDrawing->setCoordinates('A'.($fila+2));
                    $objDrawing->setResizeProportional(false);
                    $objDrawing->setWidthAndHeight(190,95);
                    $objDrawing->setWorksheet($objPHPExcel->setActiveSheetIndex(0));
			        $objDrawing=null;
			    }

			        if(trim($Respuesta[$i]['strRutaFotoColores']) != '../img/img.png'){
			        $objDrawing = new PHPExcel_Worksheet_Drawing();
			        
                    $img =$Respuesta[$i]['strRutaFotoColores'];
                    $objDrawing->setPath($img);
                	
                    $objDrawing->setOffsetX(2);    
                    $objDrawing->setOffsetY(4);  
                    $objDrawing->setCoordinates('E'.($fila+2));
                    $objDrawing->setResizeProportional(false);
                    $objDrawing->setWidthAndHeight(190,95);
                    $objDrawing->setWorksheet($objPHPExcel->setActiveSheetIndex(0));
			        $objDrawing=null;
			    }





			   		$objPHPExcel->setActiveSheetIndex(0)
					    ->mergeCells('H'.$fila.':I'.($fila));
					   	    $objPHPExcel->setActiveSheetIndex(0)
					    ->mergeCells('O'.$fila.':Q'.($fila));
					    $objPHPExcel->setActiveSheetIndex(0)
					    ->mergeCells('J'.$fila.':N'.($fila));

					    $objPHPExcel->setActiveSheetIndex(0)
					    ->mergeCells('J'.($fila+1).':N'.($fila+1));
						$estilo = array( 
						        'alignment' => array(
						            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						        )
						    );
  						$objPHPExcel->getActiveSheet(0)->getStyle("A".$fila.':Q'.($fila+14))->applyFromArray($estilo);
					$objPHPExcel->setActiveSheetIndex(0)
					    ->setCellValue('J'.($fila+2),'PHOTO STYLE') 
					    ->setCellValue('K'.($fila+2), 'STYLE')  
					    ->setCellValue('L'.($fila+2),  'SIZE')
					    ->setCellValue('M'.($fila+2), 'COLOR CODE')
					    ->setCellValue('N'.($fila+2), 'QUANTITY')
					    ->setCellValue('O'.$fila, 'OBSERVATION')
					    ->setCellValue('J'.$fila, 'REFERENCE')
					    ->setCellValue('H'.($fila), 'SHIPPING TYPE')
					    ->setCellValue('A'.($fila), 'PRODUCT')
					    ->setCellValue('E'.($fila), 'COLOR');
					$estilo = array(
					    'font'  => array(
					        'bold'  => true,
					        'fillcolor' => array('rgb' => '#000'),
					        'size'  => 12
					       
					    ));
					$objPHPExcel->getActiveSheet(0)->getStyle('J'.($fila+1))->applyFromArray(
					    array(
					        'fill' => array(
					            'type' => PHPExcel_Style_Fill::FILL_SOLID,
					            'color' => array('rgb' => '33BBFF')
					        )
					    )
					);
			     		    
	  			   $objPHPExcel->getActiveSheet(0)->getStyle('H'.$fila)->applyFromArray($estilo);
	   	 		   $objPHPExcel->getActiveSheet(0)->getStyle('J'.($fila))->applyFromArray($estilo);
	   	   	       $objPHPExcel->getActiveSheet(0)->getStyle('O'.($fila))->applyFromArray($estilo);
	   	   	       $objPHPExcel->getActiveSheet(0)->getStyle('A'.($fila))->applyFromArray($estilo);
	   	   	       $objPHPExcel->getActiveSheet(0)->getStyle('E'.($fila))->applyFromArray($estilo);
 				   $TipoEnvioM="";      
for($t=0;$t<=sizeof($TipoEnvio)-1;$t++){
	 if($TipoEnvio[$t]['idCodigo']==$Respuesta[$i]['idTipoEnvio']){
	 				if($TipoEnvio[$t]['strTipoEnvio']=='Aereo'){

                    	$TipoEnvioM='Air';
	 				}else{
	 					$TipoEnvioM='Maritime';
	 				}
                    }
                                                     
 }     
				 $objPHPExcel->setActiveSheetIndex(0)
			      ->setCellValue('J'.($fila+1),$Respuesta[$i]['strReferencia'])  
			      ->setCellValue('H'.($fila+1),$TipoEnvioM)
			      ->setCellValue('O'.($fila+1),$Respuesta[$i]['strObservacion']);
				$objPHPExcel->getActiveSheet(0)->setTitle('Referencias');
				$l=$fila+1;
				$TallaM="";
				$EstiloM="";
				$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('J')->setAutoSize(false);
				$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setWidth(25);

		while(true){
			if(trim($RespuestaLote[$k]['idLote'])=="0" && trim($RespuestaLote[$k]['idColor'])=="0" &&  trim($RespuestaLote[$k]['idTalla'])=="0" && trim($RespuestaLote[$k]['intCantidad'])==-"0" && trim($RespuestaLote[$k]['idColorAlternoChina'])=="Sin Codigo"){
				}else{     
							/*for($r=0;$r<=sizeof($Tallas)-1;$r++){
					                  if($r%2!=0){ 
					                    if($Tallas[$r-1]==$RespuestaLote[$k]['idTalla']){
					                    	$TallaM=$Tallas[$r];
					                    }
					                    if($RespuestaLote[$k]['idTalla']=='0'){
					                    	$TallaM='Same Photo';
					                    }
					                  }
					          }*/
					        if($RespuestaLote[$k]['idLote']=='0'){
					        	$EstiloM="Same Photo";
					        }else{
					        	$EstiloM="Style ".$RespuestaLote[$k]['idLote'];
					        }

							 $objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('K'.($fila+3),$EstiloM)
								->setCellValue('L'.($fila+3),$RespuestaLote[$k]['idTalla'])
								->setCellValue('M'.($fila+3),$RespuestaLote[$k]['idColorAlternoChina'])
								->setCellValue('N'.($fila+3),$RespuestaLote[$k]['intCantidad']);
								$objPHPExcel->getActiveSheet()->getRowDimension(($fila+3))->setRowHeight(80);
									$estilo = array( 
						        'alignment' => array(
						            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						        )
						    );
							$objPHPExcel->getActiveSheet(0)->getStyle('K'.($fila+3))->applyFromArray($estilo);
							$objPHPExcel->getActiveSheet(0)->getStyle('M'.($fila+3))->applyFromArray($estilo);
						    $objPHPExcel->getActiveSheet(0)->getStyle('N'.($fila+3))->applyFromArray($estilo);
							$objPHPExcel->getActiveSheet(0)->getStyle('L'.($fila+3))->applyFromArray($estilo);

					    	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('M')->setAutoSize(TRUE);
					   		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('K')->setAutoSize(TRUE);
							$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('L')->setAutoSize(TRUE);
							

							$estilo = array( 
																		  'borders' => array(
																		    'allborders' => array(
																		      'style' => PHPExcel_Style_Border::BORDER_THIN
																		    )
																		  )
											);
												$objPHPExcel->getActiveSheet(0)->getStyle('J'.($fila+3).':N'.($fila+3))->applyFromArray($estilo);

					if($RespuestaLote[$k]['strRutaFotoEstilo']!='../img/img.png'){

					
			        $objDrawing = new PHPExcel_Worksheet_Drawing();
			        
                    $img =$RespuestaLote[$k]['strRutaFotoEstilo'];
                    $objDrawing->setPath($img);
                	
                    $objDrawing->setOffsetX(1);    
                    $objDrawing->setOffsetY(1);  
                    $objDrawing->setCoordinates('J'.($fila+3));
                    $objDrawing->setResizeProportional(false);
                    $objDrawing->setWidthAndHeight(174,102);
                    $objDrawing->setWorksheet($objPHPExcel->setActiveSheetIndex(0));
			        $objDrawing=null;
			    	}


											
								  $fila++;
				}
	 				$k++; 
	 				
	                if(($RespuestaLote[$k-1]['strReferencia']!=$RespuestaLote[$k]['strReferencia'])){
	                                
	                                	break;
	                  }                                			 
		}	  
		$objPHPExcel->setActiveSheetIndex(0)
		 ->mergeCells('H'.($l).':I'.($fila+2));
		$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('O'.($l).':Q'.($fila+2));
		$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('A'.($l).':C'.($l+2));
		$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('E'.($l).':G'.($l+2));

			$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('A'.($l-1).':C'.($l-1));
			$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('E'.($l-1).':G'.($l-1));

		$estilo = array( 
							'borders' => array(
								'allborders' => array(
									 'style' => PHPExcel_Style_Border::BORDER_THIN
													)
											)
						);
						$objPHPExcel->getActiveSheet(0)->getStyle('H'.($l-1).':Q'.($fila+2))->applyFromArray($estilo);
						$objPHPExcel->getActiveSheet(0)->getStyle('E'.($l).':G'.($l+2))->applyFromArray($estilo);
							$objPHPExcel->getActiveSheet(0)->getStyle('A'.($l).':C'.($l+2))->applyFromArray($estilo);
								$objPHPExcel->getActiveSheet(0)->getStyle('E'.($l-1).':G'.($l-1))->applyFromArray($estilo);
									$objPHPExcel->getActiveSheet(0)->getStyle('A'.($l-1).':C'.($l-1))->applyFromArray($estilo);

								$estilo = array( 
						        'alignment' => array(
						            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						        )
						    );
								
								$estilo = array( 
						        'alignment' => array(
						            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						        )
						    );
						$objPHPExcel->getActiveSheet()->getStyle('O'.$l)->getAlignment()->setWrapText(true);
						$objPHPExcel->getActiveSheet(0)->getStyle('O'.($l).':Q'.($fila+2))->applyFromArray($estilo);
  						$objPHPExcel->getActiveSheet(0)->getStyle('H'.($l).':I'.($fila+2))->applyFromArray($estilo);
		
		$fila=$fila+8;
		}				
}
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="PedidoArticulos.xlsx"');
			header('Cache-Control: max-age=0');
			ob_end_clean();
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');

		exit();
	}
}


