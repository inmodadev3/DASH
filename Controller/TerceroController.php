<?php 
date_default_timezone_set('America/Bogota');
include_once ("../WebServices/clsTerceroWebService.php");
include_once ("../Model/clsTerceroModel.php");
include_once ("../Controller/VendedorController.php");
@session_start();
$objTercero=new clsTerceroController();
if(isset($_POST['btnBuscarTerceroRecepcion'])){
	 $objTercero->BuscarTerceroRecepcion();
}
if(isset($_POST['btnConsultarMvTercero'])){
	 $objTercero->ConsultarMvTerceros();
}
if(isset($_POST['btnConsultarDetalleDocTercero'])){
	 $objTercero->ConsultarDetalleDocTercero();
}
if(isset($_POST['btnListarTiposTerceros'])){
	 $objTercero->ListarTiposTerceros();
}
if(isset($_POST['btnActualizarTercero'])){
	 $objTercero->ActualizarTercero();
}
if(isset($_POST['btnConsultarPrecioPorSegmento'])){
	$objTercero->ConsultarPrecioPorSegmento();
}
if(isset($_POST['btnAsociarVendedorATercero'])){
	$objTercero->CrearEncabezadoFacturaRecepcion();
}
if(isset($_POST['btnBuscarTerceroUsuario'])){
	$objTercero->BuscarTerceroUsuario();
}
$objTercero=null;
class clsTerceroController 
{
	function __construct()
	{
		
	}


	/*------------------------------ VISTA RECEPCION ---------------------------------------*/
	/*Method for consult customer in agreement to his Cartera*/
	public function BuscarTerceroRecepcion(){
		$strNombre=trim($_POST['strName']);
		$objWsCustomer= new clsTerceroWebService();
		$objWsCustomer->BuscarTerceroRecepcion($strNombre);
		$strResultWs=json_decode($objWsCustomer->GetRespuestaWs());
		$strContentTable='';
		for($i=0;$i<=sizeof($strResultWs)-1;$i++){
			@$strContentTable.="<tr><td>".($i+1)."</td><td>".trim($strResultWs[$i]->StrIdTercero)."</td><td>".trim($strResultWs[$i]->StrNombre)."</td><td><button type='button' class='btn btn-primary' onclick='SelectCustomer(".($i+1).");'>Seleccionar</button></td><td style='display:none'>".trim($strResultWs[$i]->IntPrecio)."</td><td style='display:none'>".trim($strResultWs[$i]->StrRepLegal)."</td><td style='display:none'>".trim($strResultWs[$i]->StrDireccion)."</td><td style='display:none'>".trim($strResultWs[$i]->StrDireccion2)."</td><td style='display:none'>".trim($strResultWs[$i]->StrTelefono)."</td><td style='display:none'>".trim($strResultWs[$i]->StrCelular)."</td><td style='display:none'>".number_format(trim($strResultWs[$i]->IntSaldoCartera))."</td><td style='display:none'>".number_format(trim($strResultWs[$i]->IntCupo))."</td><td style='display:none'>".trim($strResultWs[$i]->StrCiudad)."</td><td style='display:none'>".trim($strResultWs[$i]->StrIdCiudad)."</td>
				<td style='display:none'>".trim($strResultWs[$i]->IntIdTipoTercero)."</td>
				<td style='display:none'>".trim($strResultWs[$i]->strNombreTercero)."</td></tr>";
		}
		if($strContentTable!=''){
		echo $strContentTable;
		}else{
			echo "<tr><td>No se encontro.</td></tr>";
		}
	}
	/*Consultar movimientos de los terceros por cedula*/
	public function ConsultarMvTerceros(){
		$strCedula=trim($_POST['strCedula']);
		$objClienteWs = new clsTerceroWebService();
		$objClienteWs->ConsultarMvTerceros($strCedula);
		$strRespuesta=json_decode($objClienteWs->GetRespuestaWs());
		$strContenidoTabla='';
		for($i=0;$i<=sizeof($strRespuesta)-1;$i++){
			$strContenidoTabla.="<tr><td>".($i+1)."</td><td>".$strRespuesta[$i]->IntIdTransaccion."</td><td>".$strRespuesta[$i]->StrDescripcion."</td><td>".$strRespuesta[$i]->IntDocumento."</td><td>".$strRespuesta[$i]->IntDocRef."</td><td>".$strRespuesta[$i]->dtFecha."</td><td>".number_format($strRespuesta[$i]->SubTotal)."</td><td>".number_format($strRespuesta[$i]->Iva)."</td><td>".number_format($strRespuesta[$i]->Total)."</td></tr>";
		}
		if($strContenidoTabla==''){
			echo "<tr><td>Sin movimientos</td></tr>";
		}else{
		echo $strContenidoTabla;
		}
	}
	/* Consultar el detalle de un documento de un tercero */
	public function ConsultarDetalleDocTercero(){
		$strDocumento=trim($_POST['strDocumento']);
		$strCedula=trim($_POST['strCedula']);
		$intIdTransaccion=trim($_POST['intIdTransaccion']);

		$objClienteWs= new clsTerceroWebService();
		$objClienteWs->ConsultarDetalleDocTercero($strDocumento,$strCedula,$intIdTransaccion);
		$strContenidoTabla='';
		$strRespuesta=json_decode($objClienteWs->GetRespuestaWs());
		for($i=0;$i<=sizeof($strRespuesta)-1;$i++){
			$strContenidoTabla.="<tr><td>".($i+1)."</td><td>".$strRespuesta[$i]->StrProducto."</td><td>".$strRespuesta[$i]->StrDescripcion."</td><td>".$strRespuesta[$i]->IntCantidad."</td><td>".number_format($strRespuesta[$i]->IntValorUnitario)."</td></tr>";

		}
		if($strContenidoTabla==''){
			echo "<tr><td>No hay productos.</td></tr>";
		}else{
			echo $strContenidoTabla;		
		}	
	}
	/* Tipos de tercero segmento */
	public function ListarTiposTerceros(){
		$objClienteWs= new clsTerceroWebService();
		$objClienteWs->ListarTiposTerceros();
		$strResultWs=json_decode($objClienteWs->GetRespuestaWs());
		$strContenidoSelect='';
		for($i=0;$i<=sizeof($strResultWs)-1;$i++){
			$strContenidoSelect.="<option value='".$strResultWs[$i]->IntIdTipoTercero."'>".$strResultWs[$i]->StrDescripcion."</option>";
		}
		echo $strContenidoSelect;
	}
	/* Actualizar tercero*/
	public function ActualizarTercero(){
		$strCedula=trim($_POST['strCedula']);
		$strNombre1=trim($_POST['strNombre1']);
		$strNombre2=trim($_POST['strNombre2']);
		$strApellido1=trim($_POST['strApellido1']);
		$strApellido2=trim($_POST['strApellido2']);
		$intIdSegmento=trim($_POST['intIdSegmento']);
		$strEstadoFoto=trim($_POST['strEstadoFoto']);
		$strDireccion1=trim($_POST['strDireccion1']);
		$strDireccion2=trim($_POST['strDireccion2']);
		$strTelefono1=trim($_POST['strTelefono1']);
		$strTelefono2=trim($_POST['strTelefono2']);
		$intIdCiudad=trim($_POST['intIdCiudad']);

		$objTerceroWs= new clsTerceroWebService();
		$objTerceroWs->ActualizarTercero($strCedula,$strNombre1,$strNombre2,$strApellido1,$strApellido2,$intIdSegmento,$strEstadoFoto,$strDireccion1,$strDireccion2,$strTelefono1,$strTelefono2,$intIdCiudad);
		$strResultWs=json_decode($objTerceroWs->GetRespuestaWs());
		if($strResultWs==1){
	  		echo 'Tercero actualizado con éxito.';
		}else{
			echo 'Erro actualzia tercero.';
		}
	}
	/* obtener precio del tercero deacuerdo a su segmento*/
	public function ConsultarPrecioPorSegmento(){
		$strIdSegmento=trim($_POST['strIdSegmento']);
		$objTerceroWs= new clsTerceroWebService();
		$objTerceroWs->ConsultarPrecioPorSegmento($strIdSegmento);
		$strRespuestaWs=json_decode($objTerceroWs->GetRespuestaWs());
		echo $strRespuestaWs[0]->IntPrecio;
	}
	/* Crear encabezado factura de venta en recepcion a tercero(Asociar vendedor a tercero) */
	public function CrearEncabezadoFacturaRecepcion(){
		$strIdLogin=trim($_SESSION['idLogin']);
		$strCedulaTercero=trim($_POST['strCedulaTercero']);
		$strPreferenciaTercero=trim($_POST['strPreferenciaTercero']);
		$strPrecio=trim($_POST['strPrecio']);
		$strObservacion=trim($_POST['strObservacion']);
		$strIdVendedor=trim($_POST['strIdVendedor']);

		$objTercero= new clsTerceroModel();
		$objTercero->CrearEncabezadoFacturaRecepcion($strIdLogin,$strCedulaTercero,$strPreferenciaTercero,$strPrecio,$strObservacion,$strIdVendedor);
		$strRespuesta=($objTercero->GetRespuesta());
		if($strRespuesta[0]['strMensaje']==1){
			echo 'Vendedor asociado con éxito.';
		}else{
			echo 'Error.';
		}
	}



	/*------------------------------VISTA VENDEDOR-TERCERO ---------------------------------------*/
	/* Listar terceros por ciudades */
	public function ListarTerceroPorCiudad($strIdCiudad,$strTipoLista,$strTercero){
		$objTerceroWs= new clsTerceroWebService();
		$objTerceroWs->ListarTerceroPorCiudad($strIdCiudad,$strTipoLista,$strTercero);
		$strRespuestaWs=json_decode($objTerceroWs->GetRespuestaWs());
		return $strRespuestaWs;
	}
	/*Buscar tercero con cartera*/
	public function BuscarTerceroUsuario(){
		$strTercero=trim($_POST['strTercero']);
		$objVendedor= new clsVendedorController();
		$strIdCiudad=$objVendedor->GetCiudadesAsociadasAVendedor();
		$objTerceroWs= new clsTerceroWebService();
		$objTerceroWs->ListarTerceroPorCiudad($strIdCiudad,'Busqueda',$strTercero);
		$strRespuestaTercero=json_decode($objTerceroWs->GetRespuestaWs());
		if(trim($strIdCiudad)!=''){
		$tabla='';
		for($i=0;$i<=sizeof($strRespuestaTercero)-1;$i++){
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

        				</td>";;
				 $tabla.="</tr>";
			}
			echo $tabla;
		}else{
			echo "<tr><td><h1>No Tiene Vendedores Asociados</h1></td></tr>";
		}
	}
}




/*function OpenModalGestion(idTercero){
    $('#idTerceroModalObsv').html(idTercero);
    ConsultarGestiones(idTercero);
    $('#ModalObservaciones').modal('show');
}

function OpenModal(id, idTercero, nombreTercero) {
    //ESTADISTICAS DE LAS CLASES
    EstadisticaClases(idTercero);
    //console.log(idTercero + " " + nombreTercero);
    //MOSTRAMOS VENTANA DE CARGA
    Loading(true);
    //CONSULTAMOS EL ID DEL PORTAFOLIO
    var {
        IdPortafolio,
        TipoAcceso
    } = ValidarExistenciaPortafolio(idTercero, nombreTercero);
    //TIPO DE ACCESO AL PORTAFOLIO
    SeleccionarTipoAccesoPortafolio(TipoAcceso);
    ConsultarFolders(idTercero, IdPortafolio);
    ConsultarCartera(idTercero);
    $('#IdPortafolio').html(IdPortafolio);
    var parametros = {
        "CargarPanelDetalleTercero": "true",
        idTercero
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        async: true,
        success: function(res) {
            SweetAlert.close();
            console.log(res);


            var html = '';
            $('#rowContactos').html('');
            res['contactos'].forEach(val=>{
                html+=`<div class="col-sm-12">
                            <div class="row">
                                <label for="" class="col-sm-4 col-form-label text-center">Nombre</label>
                                <label for="" class="col-sm-4 col-form-label text-center">Telefono</label>
                                <label for="" class="col-sm-4 col-form-label text-center">Celular</label>
                            </div>
                            <div class="row" style="padding-bottom: 10px;">
                                <label style="font-weight: normal;"
                                    class="col-sm-4 col-form-label text-center">`+val.StrApellidos+` `+val.StrNombres+`</label>
                                <label style="font-weight: normal;"
                                    class="col-sm-4 col-form-label text-center">`+val.StrTelefono+`</label>
                                <label style="font-weight: normal;"
                                    class="col-sm-4 col-form-label text-center">`+val.StrCelular+`</label>
                            </div>
                        </div>`;
            });
            $('#rowContactos').append(html);


            $('#' + id).modal('show');
            var obj = res['terceros'];
            var lista = res['contactos'];
            var obj1 = res['FC'];
            var listaPrecio = '';
            if(lista !== []){
                for (let index = 0; index < obj[0]['IntPrecio']; index++) {
                    listaPrecio+='* ';
                }
            }
            console.log(obj[0]['StrDescuento'])
            $('#lblpromcompra').html(obj1[0]);
            $('#lbltipocliente').html(obj[0]['StrDescripcionTipoTercero']);
            $('#lblencargadocompras').html(obj[0]['StrVendedorAsociado']);
            $('#lblIdentificacion').html(obj[0]['StrIdTercero']);
            $('#lblObservaciones').html(obj[0]['StrOtrosDatos']);
            var strIdTercero = obj[0]['StrIdTercero'];
            $('#lblZona').html(obj[0]['StrDescripcion']);
            $('#lblNombreTercero').html(obj[0]['StrNombre']);
            $('#lblUltimaCompra').html(obj[0]['UltimaCompra']);
            $('#lblEmail').html(obj[0]['StrMailFE']);
            $('#lblcupo').html(new Intl.NumberFormat().format(obj[0]['IntCupo']));
            $('#lbldesC').html(obj[0]['StrDescuento']);
            $('#lblplazo').html(obj[0]['IntPlazo']);
            $('#lbltelefono').html(obj[0]['StrTelefono']);
            $('#lblFax').html(obj[0]['StrFax']);
            $('#lblcelular').html(obj[0]['StrCelular']);
            $('#lbldireccion1').html(obj[0]['StrDireccion']);
            $('#lbldireccion2').html(obj[0]['StrDireccion2']);
            $('#lblparam1').html(listaPrecio);
        },
        error: function(error) {
            console.log((error.responseText));
        }
    });
}

<div class="modal fade bd-example-modal-lg" id="ModalGestionCliente" tabindex="-1" role="dialog"
    aria-labelledby="ModalGestionCliente" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="lblNombreTercero">Nombre Tercero</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ModalGestionCliente-body">
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        Informacion cliente
                    </div>

                    <div class="panel-body" id="InfoTercero">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <label for="" class="col-sm-2 col-form-label text-center">Identificacion</label>
                                    <label for="" class="col-sm-2 col-form-label text-center">Zona</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Email</label>
                                    <label for="" class="col-sm-2 col-form-label text-center">Ultima Compra</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Observaciones</label>
                                </div>
                                <div class="row">
                                    <label id="lblIdentificacion" style="font-weight: normal;"
                                        class="col-sm-2 col-form-label text-center"></label>
                                    <label id="lblZona" style="font-weight: normal;"
                                        class="col-sm-2 col-form-label text-center"></label>
                                    <label id="lblEmail" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lblUltimaCompra" style="font-weight: normal;"
                                        class="col-sm-2 col-form-label text-center"></label>
                                    <label id="lblObservaciones" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        Informacion Financiera
                    </div>

                    <div class="panel-body" id="InfoFinanciera">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <label for="" class="col-sm-1 col-form-label text-center">Cupo</label>
                                    <label for="" class="col-sm-2 col-form-label text-center">Descuento</label>
                                    <label for="" class="col-sm-2 col-form-label text-center">Cartera</label>
                                    <label for="" class="col-sm-1 col-form-label text-center">Plazo</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Tiempo prom.
                                        recaudo</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Tiempo prom.
                                        compra</label>
                                </div>
                                <div class="row">
                                    <label id="lblcupo" style="font-weight: normal;"
                                        class="col-sm-1 col-form-label text-center"></label>
                                    <label id="lbldesC" style="font-weight: normal;"
                                        class="col-sm-2 col-form-label text-center"></label>
                                    <label id="lblcartera" style="font-weight: normal;"
                                        class="col-sm-2 col-form-label text-center"></label>
                                    <label id="lblplazo" style="font-weight: normal;"
                                        class="col-sm-1 col-form-label text-center"></label>
                                    <label id="lblpromrecaudo" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lblpromcompra" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        Informacion detallada
                    </div>

                    <div class="panel-body" id="InfoDetalle">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <label for="" class="col-sm-3 col-form-label text-center">Tipo Cliente</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Encargado de
                                        compras</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Direccion 1</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Direccion 2</label>
                                </div>
                                <div class="row">
                                    <label id="lbltipocliente" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lblencargadocompras" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lbldireccion1" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lbldireccion2" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <label for="" class="col-sm-3 col-form-label text-center">Lista Precio</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Telefono</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Celular</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Fax</label>
                                </div>
                                <div class="row">
                                    <label id="lblparam1" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lbltelefono" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lblcelular" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lblFax" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        Contactos
                    </div>

                    <div class="panel-body">
                        <div class="row" id="rowContactos">
                            
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        Gestion
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading text-center">
                                        Estadistica de lineas mas vendidas
                                    </div>

                                    <div class="panel-body" id="Estadisticas-lineas">
                                        <canvas id="myChart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading text-center">
                                        Portafolio
                                    </div>

                                    <div class="panel-body">
                                        <!--<div class="row">
                                            <div class="col-lg-12">
                                                <center>
                                                <a href="http://www.inmodafantasy.com.co/Web/View/?code=<?php echo $_SESSION['idLogin']?>"
                                                    target="_blank"
                                                    id="link">http://www.inmodafantasy.com.co/Web/View/?code=<?php echo $_SESSION['idLogin']?></a>
                                                <button class="btn btn-default" onClick="CopiarLink();">
                                                    Copiar Link
                                                </button>
                                                </center>
                                            </div>
                                        </div>-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="table-responsive-sm">
                                                    <table class="table">
                                                        <caption>Acceso portafolio <button  onclick='ValidarRestablecerPortafolio()' style="float: right;" class='btn btn-default'>Restablecer</button></caption>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="text-center">#</th>
                                                                <th scope="col" class="text-center">Restringido</th>
                                                                <th scope="col" class="text-center">Libre</th>
                                                                <th scope="col" class="text-center">Temporal (2 meses)
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th class="text-center">
                                                                    <label id="IdPortafolio"></label>
                                                                </th>
                                                                <th class="text-center">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="inlineRadioOptions" id="radio0"
                                                                        onchange="TipoAccesoPortafolio(0);">
                                                                </th>
                                                                <td class="text-center">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="inlineRadioOptions" id="radio1"
                                                                        onchange="TipoAccesoPortafolio(1);">
                                                                </td>
                                                                <td class="text-center">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="inlineRadioOptions" id="radio2"
                                                                        onchange="TipoAccesoPortafolio(2);">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12" id="InfoPortafolio">
                                                <!--<div>Nueva actualizacion!! Ahora todos los clientes podran ver todas las lineas</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> */