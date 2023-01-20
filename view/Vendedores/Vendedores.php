<?php
$blnPermiso=false;
for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
	if($_SESSION['Permisos'][$i]['idPermiso']==14){
		if($_SESSION['Permisos'][$i]['intVer']==1){
			$blnPermiso=true;
		}
		break;
	}
}
if(!($blnPermiso)){
	echo "<script language='javascript'>window.location='../view/index.php?menu=Inicio'</script>;"; 
}

include_once('../Controller/ParametrizarVendedorController.php');
$objVendedor= new clsParametrizarVendedor();

?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12"> 
			<button type="button" style="background:#337ab7;" class="btn" data-toggle="modal" data-target="#Primero"><i style="color:#fff;" class="fa fa-question-circle fa-fw"></i></button>
			<div class="modal fade" id="Primero">
				<div class="modal-dialog">
					<div class="modal-content">  
						<div class="modal-header">
							<h4 class="modal-title">Ayuda</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<label>Aquí podra registrar todos los movimientos que estaran disponibles para el vendedor en su comisión.</label>
						</div>      
					</div>
				</div>
			</div>
			<br>
			<br>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-user fa-fw"></i>Vendedores
						</div>

						<div class="panel-body">

							<div class="input-group">
								<span class="input-group-addon" ><i class="fa fa-search"></i></span>
								<input type="text" class="form-control" placeholder="Buscar" id='txtBuscarVendedorNoParametrizado'>
							</div>
							<br>
							<div style="overflow-y: scroll;height:340px; ">      				
								<table class="table table-striped table-hover" id='tblVendedores'>
									<thead>
										<th>#</th>
										<th>Cedula</th>
										<th>Nombre</th>
										<th>Tipo Empleado</th>
										<th>Asignar</th>
									</thead>
									<tbody id='tblVendedoreNoParametrizados'>

									</tbody>
								</table>
							</div>
							<br>
						</div>
					</div>
				</div>
			</div>
			<div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-user fa-fw"></i>Vendedor en Parametrización
					</div>

					<div class="panel-body">
						<div class="row">
							<div class="col-lg-2">
								<label>Tipo Empleado</label>
								<input readonly="readonly" type="text" id='txtTipoEmpleado' class="form-control">
								<input type="text" style="display: none;" id='txtidTipoempleado'>
							</div>
							<div class="col-lg-2">
								<label>Cedula</label>
								<input  readonly="readonly" type="text" id='txtCedula' class="form-control">
							</div>
							<div class="col-lg-3">
								<label>Nombre</label>
								<input  readonly="readonly" type="text" id='txtNombre' class="form-control">
							</div>	
							<div class="col-lg-2">
								<label>Compañia</label>
								<select class="form-control" id='ddlCompanias'></select>
							</div>	
							<div class="col-lg-3">
								<label>Zona</label>
								<div class="row">
									<div class="col-lg-9">
										<select class="form-control" style="display: inline-block;" id='ddlZonas'>
											<?php
											include_once('../Controller/ParametrizarVendedorController.php');
											$objVendedor= new clsParametrizarVendedor();
											echo $objVendedor->ListarZonasVendedor();
											?>
										</select>
									</div>
									<div class="col-lg-3">
										<label class="btn btn-default" id='btnVisualizarCiudadesZona' onclick="VisualizarCiudadesPorZona();"><i class="glyphicon glyphicon-eye-open"></i></label>
									</div>	
								</div>	
							</div>
						</div>
						<br>
			<div style="overflow: scroll;height:200px;">
					<table class="table table-striped" id='tblZonasM'>
		        		<thead style="width: 100%;">
		        			<th>Asignación</th>
		        			<th>Zona</th>
		        			<th>Descripción</th>
		        		</thead>
		        		<tbody id='tblZonas'>
		        			
		        		</tbody>
        			</table>
        	</div>
			<br>
			<button class="btn btn-default" id='btnAsignarZona' onclick="AsignarZonasVendedor();" >Asignar Zonas</button>
        	<br><br>
						<input type="text" placeholder="Buscar" id='txtBuscarLinea' class="form-control">
						<br><input type="checkbox" disabled="disabled" id='ChkLineasTodas' onclick="ChkLineasTodas()"><label for='ChkLineasTodas'> &nbsp;Todas</label>
						<br>
						<div style="overflow: scroll;height:200px;">
							<table class="table table-striped" id='tblLineasM'>
								<thead style="width: 100%;">
									<th>Asignación</th>
									<th>Codigo</th>
									<th>Descripción</th>
								</thead>
								<tbody id='tblLineas'>

								</tbody>
							</table>
						</div>	
						<br>
						<button class="btn btn-default" id='btnAsignar' onclick="AsignarLineasYZonaAVendedor();" disabled="true">Asignar</button>
						<button class="btn btn-default" id='btnCancelar' style="float: right;" onclick="Cancelar();">Cancelar</button>     	
					</div>
				</div>		        	
			</div>
			<div id='pnGeneral' style="display: none;">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-user fa-fw"></i> Asignación Comisiones
					</div>
					<div class="panel-body">
						<h3>Compañia</h3><select class="form-control" id="ddlCompania" onchange="ListarEgresosIngresos();"><option value="1">Blanca</option><option value="2">Verde</option></select><br>
						<div class="row">
							<div class="col-lg-8">
								<div class="panel panel-default" id='pnContenido'>
									<div class="panel-heading">
										<i class="fa fa-user fa-fw"></i>Ingresos 
									</div>
									<div class="panel-body">
										<input type="hidden" id='txtIdIngreso'>
										<div class="row">
											<div class="col-lg-8">				        	
												<input checked="checked" type="radio"  id='rdbActivado' name="rdbEstado">
												<label for='rdbActivado'>Activado</label>
												<input  type="radio" id='rdbDesactivado'  name="rdbEstado">
												<label for='rdbDesactivado'>Desactivado</label>
											</div>
											<div class="col-lg-4">
												<span id='ctnFechaInicialAplicar'>
													<label>Fecha a aplicar:<input type="date" id='dtFechaInicialFijo' class="form-control"></label>
												</span>
											</div>
										</div>	

										<label>Ingreso</label>
										<input type="text" id='txtNombreIngreso' class="form-control" placeholder="Nombre">
										<hr>
										<input type="radio" name="rdbIngreso" id='rdbValorIngreso' checked="checked"  onchange="ContenidoUno(1);">
										<label for='rdbValorIngreso'>Valor</label>
										<input type="radio"  name="rdbIngreso" id='rdbPorcentajeIngreso'  onchange="ContenidoUno(2);">
										<label for='rdbPorcentajeIngreso'>%</label><br>
										<input type="number" placeholder="Dato"  class="form-control" id='txtDato'>
										<hr>
										<div id='ContenidoUno'  style="display:none;">
											<span style="padding: 10px;">
												<label>Transacción</label>
												<div style="overflow-x:scroll; height: 200px; ">
													<table class="table" id='tbltransacciones'>
														<thead>
															<th>Acción</th>
															<th>Transacción</th>
															<th>Tipo</th>
														</thead>
														<tbody id='tbodytransacciones'>

														</tbody>
													</table>
												</div>
												<hr>	
												<label>Base</label>						
												<select class="form-control" onchange="ddlBase()" id='ddlBase'>
													<option value="VN">Ventas</option>
													<option value="RC">Recaudo Terceros</option>
													<option value="RCVN">Recaudo segun ventas</option>
													<!--<option value="REC">Recuperacion de cartera</option>-->
												</select>
												<span id='ContenidoRecuperacionCartera'>
													<br>	
													<select class="form-control" id='ddlTipoContenidoUno' onchange="ddlTipoContenidoUno();">
														<option value="GN">General</option>
														<option value="VE">Vendedores Externos</option>
														<option value="BG">Bodega</option>
														<option value="MD">Madrinas</option>
														<option value="PP">Propias</option>
													</select>
													<span id='ddlVendedores' style="display: none;">	
														<br>
														<select class="form-control" id='ddlVendedoresContenido'  onchange="ddlVendedores()" >
															<option>TODOS</option>	
														</select>
													</span>
													<span id='ddlTipoValor'>
														<br>
														<select class="form-control" id='ddlTipoBaseIngreso'>
															<option value="TL">Total</option>
															<option value="LZ">Linea y Zona</option>
														</select>
													</span>
													<hr>
												</span>
											</span>
										</div>
										<label>Tipo</label><br>
										<input type="radio"  checked="checked" name="rdbTipoIngreso" id='rdbTipoFijo' onchange="ContenidoTipoIngreso(1)">
										<label for='rdbTipoFijo'>Fijo</label>&nbsp;
										<input id='rdbTipoUnico' type="radio" name="rdbTipoIngreso" onchange="ContenidoTipoIngreso(2)">
										<label for='rdbTipoUnico'>Unico</label>&nbsp;
										<input id='rdbTipoTemporal' type="radio" name="rdbTipoIngreso" onchange="ContenidoTipoIngreso(3)">
										<label for='rdbTipoTemporal'>Temporal</label>&nbsp;
										<br>
										<span id='ContenidoTipo' style="display: none;">
											<label>Fecha Inicial</label>
											<input type="date" id='dtFechaInicial' class="form-control">
											<span id='ContenidoTipoFechaFinal' >		
												<label>Fecha Final</label>
												<input type="date" id='dtFechaFinal' class="form-control">
											</span>
										</span>
										<span id='ContenidoPeriocidad'>
											<label>Periocidad</label>
											<select class="form-control" id='ddlPeriocidad'><option value="MS">Mensual</option><option  value='QC'>Quincenal</option></select>
										</span>
										<hr>
										<span style="display: none;" id='Contenidodocumentos'>
											<label>Iva</label>&nbsp;<input type="checkbox" id='chkIva'><br>
											<span id='ContenidoDescuento' style="display: none;"> 
												<label>Descuento</label>&nbsp;<input type="checkbox" id='chkDescuento'><br>
											</span>
											<label>Tiempo visita</label>
											&nbsp;<input type="checkbox" id='chkTiempoVisita' onchange="TiempoVisita()"><br>
											<span id='ContenidoTiempoVisita' style="display: none;">
												<input type="number" class="form-control" placeholder="Dias" id='txtDiasVisita'>
											</span>
										</span>

										<label>Meta</label>&nbsp;<input type="checkbox" id='rdbMetaIngreso' onchange="chkMeta()"><br>
										<span id='ContenidoMeta' style="display: none">
											<input checked="checked" onchange="ddlMeta(1)" type="radio" id='rdbTipoMetaFija' name="rdbMeta">
											<label for='rdbTipoMetaFija'>Fija</label>&nbsp;
											<input id='rdbTipoMetaVariable' onchange="ddlMeta(2)" type="radio" name="rdbMeta">&nbsp;<label for='rdbTipoMetaVariable'>Variable</label>&nbsp;(Segun mes de la tabla de metas)<br>
											<span id='ContenidoBaseDescuento'>
												<input type="number" placeholder="Valor" id='txtValorMeta' class="form-control" >
											</span>	

											<label>base</label><select class="form-control" id='ddlBaseMeta'><option value="VN">Ventas</option>	</select><br>
											<select class="form-control" id='ddlTipoBaseMeta'><option value="TT">Total</option>
												<option value="LZ">Linea y zona</option>	</select>	

											</span>
											<hr>
											<button type="button" onclick="AgregarIngreso('1')" id='btnAgregarIngreso' class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button>
											<button type="button" class="btn btn-default" id='btnEditarIngreso' style="display: none;" onclick="AgregarIngreso('2')"><span class="glyphicon glyphicon-edit"></span></button>
											<button type="button" class="btn btn-default" id='btnCancelarIngreso' style="display: none;" onclick="CancelarEditarIngreso();"><span class="glyphicon glyphicon-remove"></span></button>
										</div>
									</div>
								</div> 
								<div class="col-lg-4">
									<div id='pnContenidoDos'>
										<h4>Tabla de meta por meses</h4>
										<label>Tipo</label>
										<select class="form-control" id='ddlTipoMeta' onchange="ListarMetasDeVendedor()">
											<option value="VN">Ventas</option>
											<option value="RC">Recaudo</option>
											<option value="RCVN">Recaudo segun ventas</option>
										</select>
										<label>Año</label>
										<select class="form-control" id='ddlAnoMeta'  onchange="ListarMetasDeVendedor();"></select>
										<label>Mes</label>
										<select class="form-control" id='ddlMesMeta' onchange="ObtenerValorMes();">
											<option value="0">Seleccione...</option>
											<option value="Enero">Enero</option>
											<option value="Febrero">Febrero</option>
											<option value="Marzo">Marzo</option>
											<option value="Abril">Abril</option>
											<option value="Mayo">Mayo</option>
											<option value="Junio">Junio</option>
											<option value="Julio">Julio</option>
											<option value="Agosto">Agosto</option>
											<option value="Septiembre">Septiembre</option>
											<option value="Octubre">Octubre</option>
											<option value="Noviembre">Noviembre</option>
											<option value="Diciembre">Diciembre</option>
										</select><br>
										<input type="number" min='1' class="form-control" id='txtValorMetaTabla' placeholder="Valor">
										<input type="text" style="display: none;" id='txtCodigoValorMeta'>
										<br>
										<button type="button" class="btn btn-default" onclick="ActualizarValorMeta();"><i class="glyphicon glyphicon-plus"></i></button>
										<br>
										<br>
										<div style="overflow-y: scroll;height: 180px;" id='pnTblContenidoMeta'>
											<table class="table table-striped" id='tblMetaMeses'>
												<thead>
													<th>#</th>
													<th>Mes</th>
													<th>Valor</th>
													<th>Compañia</th>
												</thead>
												<tbody id='tbodyMeta'>

												</tbody>
											</table>
										</div>	
									</div> 
								</div> 	
							</div>	
							<hr>    
							<h3>Ingresos</h3>
							<div style="overflow-y: scroll;height: 300px;">
								<table class="table table-striped">
									<thead>
										<th>#</th>
										<th>Nombre</th>
										<th>Compania</th>
										<th>Fecha Creación</th>
										<th>Tipo</th>
										<th>Estado</th>
										<th>Acción</th>

									</thead>
									<tbody id='tbodyIngresos'>

									</tbody>
								</table>
							</div>
						</div>
					</div> 
					<div>
						<div class="panel panel-default" id='pnContenido'>
							<div class="panel-heading">
								<i class="fa fa-user fa-fw"></i>Egresos 
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-8">
										<label for='rdbActivadoEgreso'>Activado</label>&nbsp;<input name='rdbEgresos' checked="checked" type="radio" id='rdbActivadoEgreso'>
										<label for='rdbDesactivadoEgreso'>Desactivado</label>&nbsp;<input name='rdbEgresos' type="radio" id='rdbDesactivadoEgreso'>
									</div>
									<div class="col-lg-4">
										<span id='ctnFechaInicialAplicarEgreso'>
											<div class="input-group">
												<span class="input-group-addon"><strong>Fecha a aplicar</strong></span>
												<input type="date" class="form-control"  id='dtFechaEgresoAplicar'>
											</div>
										</span>	
									</div>	
								</div>

								<hr>

								<div class="input-group">
									<span class="input-group-addon">Nombre</span>
									<input type="text" class="form-control" placeholder="Nombre" id='txtNombreEgreso'>
								</div><br>
								<div class="input-group">
									<span class="input-group-addon">Valor</span>
									<input type="number" class="form-control" placeholder="Valor" id='txtValorEgreso'>
								</div>
								<hr>
								<label>Tipo</label><br>
								<input type="radio"  checked="checked" name="rdbTipoEgreso" id='rdbTipoFijoEgreso' onchange="ContenidoTipoEgreso(1)">
								<label for='rdbTipoFijoEgreso'>Fijo</label>&nbsp;
								<input id='rdbTipoUnicoEgreso' type="radio" name="rdbTipoEgreso" onchange="ContenidoTipoEgreso(2)">
								<label for='rdbTipoUnicoEgreso'>Unico</label>&nbsp;
								<input id='rdbTipoTemporalEgreso' type="radio" name="rdbTipoEgreso" onchange="ContenidoTipoEgreso(3)">
								<label for='rdbTipoTemporalEgreso'>Temporal</label>&nbsp;
								<br>
								<span id='dtEgresoTipo' style="display: none;">
									<span id='PnTemporal' style="display: none;">
										<input type="radio" name='rdbTemporal' onchange="chkSaldoEgreso()" id='rdbPorFecha' checked="checked"><label>Por Fecha</label>
										<input  onchange="chkSaldoEgreso()" type="radio" name='rdbTemporal' id='chkConSaldo'>&nbsp;<label for='chkConSaldo'> Por Cuotas</label><br>
									</span>
									<span id='PnchkSaldo' style="display: none;">
										<div class="input-group">
											<span class="input-group-addon">Cuotas</span>
											<input type="number" class="form-control" placeholder="Nro Cuotas" id='txtValorSaldo'>
										</div>
									</span>
									<span id='PnTemporalDt'>
										<label>Fecha Inicial</label>
										<input type="date" id='dtFechaInicialEgreso' class="form-control">
										<span id='dtEgresoFechaFinal'>							
											<label>Fecha Final</label>
											<input type="date" id='dtFechaFinalEgreso' class="form-control">
										</span>
									</span>
								</span>
								<span id='ddlPeriocidadEgreso'>
									<label>Periocidad</label>
									<select class="form-control" id='ddlPeriocidadEgresos'><option value="MS">Mensual</option><option  value='QC'>Quincenal</option></select>
								</span>

								<hr>
								<button class="btn btn-default" onclick="AgregarEgreso()"><i class="glyphicon glyphicon-plus"></i></button>
								<hr>
								<div style="overflow: scroll;height: 300px;">
									<table class="table table-striped">
										<tr>
											<thead>
												<th>#</th>
												<th>Nombre</th>
												<th>Compañia</th>
												<th>Fecha Creación</th>
												<th>Fecha a aplicar</th>
												<th>Tipo</th>
												<th>Valor</th>
												<th>Tipo</th>
												<th>Cuotas</th>
												<th>Estado</th>
												<th>Acción</th>
											</thead>
										</tr>
										<tbody id='tbodyEgresos'>

										</tbody>	
									</table>
								</div>
							</div>
						</div>
					</div>							
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade ModalCiudadesZonas" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id='ModalCiudadesZona'>
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="row">
					<div class="col-lg-12">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">ZONA <label id='lblZona'></label></h4>
						</div>
						<div id='dvContenidoCiudades'>

						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<style type="text/css">
	.swal2-container {
		zoom : 1.4 ;
		-moz-transform: scale(1.4);
	}
	th:hover{
		cursor: pointer;
	}
</style>
<script type="text/javascript">
	
	window.onload = function() {
		LlenarDdlAnnos();
		ListarCompanias();
	};
	var Fecha= new Date();
	var Dia=Fecha.getDate();
	var Mes=(Fecha.getMonth() +1);
	if((Fecha.getMonth() +1)<=9){
		Mes='0'+(Fecha.getMonth() +1);
	}
	if(Fecha.getDate()<=9){
		Dia='0'+Fecha.getDate();
	}

	document.getElementById('dtFechaInicial').value=Fecha.getFullYear() + "-" + Mes + "-" + Dia;
	document.getElementById('dtFechaFinal').value=Fecha.getFullYear() + "-" + Mes + "-" + Dia;
	document.getElementById('dtFechaInicialEgreso').value=Fecha.getFullYear() + "-" + Mes + "-" + Dia;
	document.getElementById('dtFechaFinalEgreso').value=Fecha.getFullYear() + "-" + Mes + "-" + Dia;
	document.getElementById('dtFechaInicialFijo').value=Fecha.getFullYear() + "-" + Mes + "-" + Dia;
	document.getElementById('dtFechaEgresoAplicar').value=Fecha.getFullYear() + "-" + Mes + "-" + Dia;

	function EliminarIngreso(Tipo){
		var parametros={
			"btnEliminarIngreso":'true',
			"intIdIngreso":Tipo
		}
		$.ajax({
			data:  parametros,
			url:   '../Controller/ParametrizarVendedorController.php',
			type:  'post',                           
			success:  function (response) { 
				Datos= response.split('%');	
				Mensaje(Datos[1],Datos[0]);
				ListarIngresos();

			},
			error: function (error) {
				alert('error; ' + eval(error));
			}
		});
	}
	function ObtenerValorMes(){
		var lengthTabla=$("#tblMetaMeses tr").length;
		var ddlMesMeta=document.getElementById('ddlMesMeta');
		var tblMeta=document.getElementById('tblMetaMeses');
		if(ddlMesMeta.value==0){
			document.getElementById('txtValorMetaTabla').value='';
			document.getElementById('txtCodigoValorMeta').value='';
			return;
		}
		for(i=1;i<=lengthTabla;i++){
			if(ddlMesMeta.value.trim()==tblMeta.rows[i].cells[2].innerHTML.trim()){
				document.getElementById('txtValorMetaTabla').value=tblMeta.rows[i].cells[3].innerHTML.trim().split(',').join('');
				document.getElementById('txtCodigoValorMeta').value=tblMeta.rows[i].cells[1].innerHTML.trim();
				break;
			}
		}
	}
	function chkSaldoEgreso(){
		var chkSaldo=document.getElementById('chkConSaldo');
		if(chkSaldo.checked){
			document.getElementById('PnchkSaldo').style.display='inline';
			document.getElementById('PnTemporalDt').style.display='none';
			document.getElementById('ctnFechaInicialAplicarEgreso').style.display='inline';
		}else{
			document.getElementById('PnchkSaldo').style.display='none';
			document.getElementById('PnTemporalDt').style.display='inline';
			document.getElementById('ctnFechaInicialAplicarEgreso').style.display='none';
		}

	}
	function LlenarDdlAnnos(){
		var Fecha=new Date();

		for(var i=2018;i<=Fecha.getFullYear();i++){

			$('#ddlAnoMeta').append("<option value='"+i+"'>"+i+"</option>");
		}
		document.getElementById('ddlAnoMeta').value=Fecha.getFullYear();
	}

	function ListarMetasDeVendedor(){
		// 1 blanca 2 verde
		var parametros={
			"btnListarMetaDeVendedor":'true',
			"strCedula":document.getElementById('txtCedula').value.trim(),
			"strTipoMeta":document.getElementById('ddlTipoMeta').value,
			"intAnno":document.getElementById('ddlAnoMeta').value,
			"intCompania": "1"
		}
		$.ajax({
			data:  parametros,
			url:   '../Controller/ParametrizarVendedorController.php',
			type:  'post',                           
			success:  function (response) { 
				$('#ddlMesMeta').prop('selectedIndex',0); 
				document.getElementById('txtValorMetaTabla').value='';
				document.getElementById('txtCodigoValorMeta').value='';
				document.getElementById('tbodyMeta').innerHTML=response;

			},
			error: function (error) {
				alert('error; ' + eval(error));
			}
		});
	}
	function ListarVendedorPorTipo(){
		var parametros={
			"btnListarVendedorPorTipo":'true',
			"strTipoVendedor":document.getElementById('ddlTipoContenidoUno').value.trim()
		}
		$.ajax({
			data:  parametros,
			url:   '../Controller/ParametrizarVendedorController.php',
			type:  'post',                           
			success:  function (response) {
				console.log(response);                             
				var strDatos=response.split('&');
				var strContenidoVendedor='';
				$('#ddlVendedores option').remove();
				for(var i=0;i<=strDatos.length-2;i++){
					strContenidoVendedor=strDatos[i].split('%');
					$('#ddlVendedoresContenido').append("<option value='"+strContenidoVendedor[0]+"'>"+strContenidoVendedor[1]+"</option>"); 
				}

			},
			error: function (error) {
				alert('error; ' + eval(error));
			}
		});
	}
	function ActualizarValorMeta(){
		var txtValorMeta=document.getElementById('txtValorMetaTabla');
		if(!Validar('ActualizarValorMeta')){
			return;
		}
		var parametros={
			"btnActualizarValorMeta":'true',
			"strCodigo":document.getElementById('txtCodigoValorMeta').value.trim(),
			"intValor":txtValorMeta.value.trim()
		}
		$.ajax({
			data:  parametros,
			url:   '../Controller/ParametrizarVendedorController.php',
			type:  'post',                           
			success:  function (response) {                           	
				var strMensaje=response.split("%");
				if(strMensaje[1]!='success'){
					document.getElementById('txtValorMetaTabla').focus();
					Mensaje(strMensaje[1],strMensaje[0]);
					return;
				} 
				Mensaje(strMensaje[1],strMensaje[0]); 
				ListarMetasDeVendedor();
			},
			error: function (error) {
				alert('error; ' + eval(error));
			}
		});
	}
	function Validar(Tipo){
		switch(Tipo){
			case 'ActualizarValorMeta':		
			var txtValorMeta=document.getElementById('txtValorMetaTabla');
			var ddlMesMeta=document.getElementById('ddlMesMeta');
			if(ddlMesMeta.value=='0'){
				Mensaje('error','Seleccione mes.');
				ddlMesMeta.focus();
				return false;
			}
			if(txtValorMeta.value.trim()==''){
				Mensaje('error','Ingrese valor.');
				txtValorMeta.focus();
				return false;
			}
			break;
		}
		return true;
	}
	function ContenidoUno(Tipo){
		var rdbFijo=document.getElementById('rdbTipoFijo');
		if(rdbFijo.checked){
			document.getElementById('ctnFechaInicialAplicar').style.display='inline';
		}
		switch(Tipo){
			case 1:
			document.getElementById('ContenidoUno').style.display='none';
			document.getElementById('Contenidodocumentos').style.display='none';
			document.getElementById('pnTblContenidoMeta').style.height=(document.getElementById('pnTblContenidoMeta').offsetHeight-290)+"px"; 

			break;
			case 2:
			document.getElementById('ContenidoUno').style.display='inline';
			document.getElementById('Contenidodocumentos').style.display='inline';
			document.getElementById('pnTblContenidoMeta').style.height="465px"; 
			ListarTransacciones();
			break;
		}



	}
	function ddlTipoContenidoUno(){
		ListarVendedorPorTipo();
		var TipoValor=document.getElementById('ddlTipoContenidoUno');
		if(TipoValor.value=='GN' || TipoValor.value=='PP'){
			document.getElementById('ddlTipoValor').style.display='inline';
			document.getElementById('ddlVendedores').style.display='none';
		}else{
			document.getElementById('ddlTipoValor').style.display='inline';
			document.getElementById('ddlVendedores').style.display='inline';	
		}
	}
	function ContenidoTipoEgreso(intTipoEgreso){
		var dtEgresoTipo=document.getElementById('dtEgresoTipo');
		var dtEgresoFechaFinal=document.getElementById('dtEgresoFechaFinal');
		switch(intTipoEgreso){
			case 1:
			dtEgresoTipo.style.display='none';
			document.getElementById('ddlPeriocidadEgreso').style.display='inline';
			document.getElementById('ctnFechaInicialAplicarEgreso').style.display='inline';
			break;
			case 2:
			dtEgresoTipo.style.display='inline';
			dtEgresoFechaFinal.style.display='none';
			document.getElementById('ddlPeriocidadEgreso').style.display='none';
			document.getElementById('PnTemporal').style.display='none';
			document.getElementById('PnTemporalDt').style.display='inline';
			document.getElementById('PnchkSaldo').style.display='none';
			document.getElementById('ctnFechaInicialAplicarEgreso').style.display='none';
			break;
			case 3:
			dtEgresoTipo.style.display='inline';
			dtEgresoFechaFinal.style.display='inline';
			document.getElementById('ddlPeriocidadEgreso').style.display='inline';
			document.getElementById('PnTemporal').style.display='inline';
			document.getElementById('PnTemporalDt').style.display='inline';
			document.getElementById('PnchkSaldo').style.display='none';
			document.getElementById('ctnFechaInicialAplicarEgreso').style.display='none';
			$('#rdbPorFecha').prop('checked', true);
			break;
		}
	}
	function ContenidoTipoIngreso(Tipo){
		var ContenidoTipo=document.getElementById('ContenidoTipo');
		var ContenidoFechaFinal=document.getElementById('ContenidoTipoFechaFinal');
		var chkSerie=document.getElementById('rdbValorIngreso');
		switch(Tipo){
			case 1:
			ContenidoTipo.style.display='none';
			document.getElementById('ContenidoPeriocidad').style.display='inline';
			document.getElementById('ctnFechaInicialAplicar').style.display='inline';

			break;
			case 2:
			ContenidoTipo.style.display='inline';
			ContenidoFechaFinal.style.display='none';
			document.getElementById('ContenidoPeriocidad').style.display='none';
			document.getElementById('ctnFechaInicialAplicar').style.display='none';
			break;
			case 3:
			ContenidoTipo.style.display='inline';
			ContenidoFechaFinal.style.display='inline';
			document.getElementById('ContenidoPeriocidad').style.display='inline';
			document.getElementById('ctnFechaInicialAplicar').style.display='none';
			break;
		}
	}
	function ddlBase(){
		var ddlBase=document.getElementById('ddlBase');
		if(ddlBase.value=='VN'){
			document.getElementById('ContenidoDescuento').style.display='none';
			document.getElementById('ContenidoRecuperacionCartera').style.display='inline';
			document.getElementById('pnTblContenidoMeta').style.height='460px';
		}else{
			if(ddlBase.value=='REC'){
				document.getElementById('ContenidoRecuperacionCartera').style.display='none';
				document.getElementById('pnTblContenidoMeta').style.height=(document.getElementById('pnTblContenidoMeta').offsetHeight-163)+"px"; 
			}else{
				document.getElementById('ContenidoDescuento').style.display='inline';	
				document.getElementById('ContenidoRecuperacionCartera').style.display='inline';
				document.getElementById('pnTblContenidoMeta').style.height='485px';

			}
		}

	}
	function ddlMeta(Tipo){
		switch(Tipo){
			case 1:
			document.getElementById('ContenidoBaseDescuento').style.display='inline';
			break;
			case 2:
			document.getElementById('ContenidoBaseDescuento').style.display='none';
			break;
		}
	}
	function chkMeta(){
		if(document.getElementById('rdbMetaIngreso').checked){
			document.getElementById('ContenidoMeta').style.display='inline';
		}else{
			document.getElementById('ContenidoMeta').style.display='none';
		}
	}
	function TiempoVisita(){
		if(document.getElementById('chkTiempoVisita').checked){
			document.getElementById('ContenidoTiempoVisita').style.display='inline';
		}else{
			document.getElementById('ContenidoTiempoVisita').style.display='none';	
		}
	}
	function Mensaje(strTipo,strMensaje){
		const toast = swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000,
			background: '#FFFFB0'
		});

		toast({
			type:strTipo,
			title: "<span style='color:#686868'>"+strMensaje+"</span>"
		});
	}
	function AgregarIngreso(intProcedimientoIngreso){
		var txtNombre=document.getElementById('txtNombreIngreso');
		var chkSerie=document.getElementById('rdbValorIngreso');
		var txtDato=document.getElementById('txtDato');
		var chkTipoFijo=document.getElementById('rdbTipoFijo');
		var chkTipoUnico=document.getElementById('rdbTipoUnico');
		var chkTipoTemporal=document.getElementById('rdbTipoTemporal');
		var dtFechaInicial=document.getElementById('dtFechaInicial');
		var dtFechaFinal=document.getElementById('dtFechaFinal');
		var ddlPeriocidad=document.getElementById('ddlPeriocidad');
		var chkMeta=document.getElementById('rdbMetaIngreso');
		var txtValorMeta=document.getElementById('txtValorMeta');
		var chkTipoMeta=document.getElementById('rdbTipoMetaFija');
		var ddlBaseMeta=document.getElementById('ddlBaseMeta');
		var ddlTipoBaseMeta=document.getElementById('ddlTipoBaseMeta');
		var ddlCompania=document.getElementById('ddlCompania');
		var intCedulaVendedor=document.getElementById('txtCedula');
		var chkEstado=document.getElementById('rdbDesactivado');
		var intEstado=1;
		if(chkEstado.checked){
			intEstado=0;
		}
		var intSerie=1;
		var intTipo=2;
		var intTipoMeta=-1;
		var intMeta=0;
		var intValorMeta=0;
		var strBaseMeta='NA';
		var strTipoBaseMeta='NA';
		var dtFechaIN='0000-00-00';
		var dtFechaFN='0000-00-00';
		if(txtNombre.value.trim()==''){
			Mensaje('error','Ingrese nombre del ingreso.');
			txtNombre.focus();
			return;
		}	
		if(txtDato.value.trim()==''){
			Mensaje('error','Ingrese valor del ingreso.');
			txtDato.focus();
			return;
		}
		if(chkSerie.checked){
			intSerie=0;
		}
		if(chkTipoFijo.checked){
			intTipo=0;

			dtFechaIN=document.getElementById('dtFechaInicialFijo').value;

		}else if(chkTipoUnico.checked){
			intTipo=1;
			dtFechaIN=dtFechaInicial.value;	
		}else{	

			var x=new Date();
			var dtFechaInicialIN = dtFechaInicial.value.split("-");
			x.setFullYear(dtFechaInicialIN[0],dtFechaInicialIN[1]-1,dtFechaInicialIN[2]);
			var hoy = new Date();     
			var dtFinal = new Date(dtFechaFinal.value);
			if (dtFinal < x){
				Mensaje('error','Ingrese fecha final mayor a la inicial.');
				dtFechaFinal.focus();
				return;
			}
			dtFechaIN=dtFechaInicial.value;
			dtFechaFN=dtFechaFinal.value;
		}
		if(chkMeta.checked){
			intMeta=1;
			if(chkTipoMeta.checked){
				intTipoMeta=0;
				intValorMeta=txtValorMeta.value.trim();
				if(txtValorMeta.value.trim()==''){
					Mensaje('error','Ingrese valor de la meta.');
					txtValorMeta.focus();
					return;
				}	
			}else{
				intTipoMeta=1;
				intValorMeta=0;	
			}

			strBaseMeta=ddlBaseMeta.value;
			strTipoBaseMeta=ddlTipoBaseMeta.value;

		}


		if(chkSerie.checked){	
			if(intProcedimientoIngreso=='1'){
				var parametros={
					'btnIngresarIngreso':'true',
					"strNombre":txtNombre.value.trim(),
					"intSerie":intSerie,
					"intValor":txtDato.value.trim(),
					"dtFechaInicial":dtFechaIN,
					"dtFechaFinal":dtFechaFN,
					"strPeriocidad":ddlPeriocidad.value,
					"intTipo":intTipo,
					"intMeta":intMeta,
					"intTipoMeta":intTipoMeta,
					"intValorMeta":intValorMeta,
					"strBaseMeta":strBaseMeta,
					"strTipoBaseMeta":strTipoBaseMeta,
					"intCompania":ddlCompania.value,			
					"intCedulaVendedor":intCedulaVendedor.value.trim(),
					"strTipoBase":'NA',
					"strTipoVendedor":'NA',
					"strVendedor":'NA',
					"strTipoBaseIngreso":'NA',
					"intIva":'-1',
					"intDescuento":'-1',
					"strTransacciones":'NA',
					"intTiempoVisita":'-1',
					"strDiasVisita":'NA',

					"intEstado":intEstado
				}}else{
					var parametros={
						'btnActualizarIngreso':'true',
						'intIdIngreso':document.getElementById('txtIdIngreso').value.trim(),
						"strNombre":txtNombre.value.trim(),
						"intValor":txtDato.value.trim(),
						"intEstado":intEstado,
						"intSerie":intSerie,
						"dtFechaInicial":dtFechaIN,
						"dtFechaFinal":dtFechaFN,
						"intTipo":intTipo,
						"strPeriocidad":ddlPeriocidad.value,
						"intMeta":intMeta,
						"intTipoMeta":intTipoMeta,	
						"intValorMeta":intValorMeta,
						"strBaseMeta":strBaseMeta,
						"strTipoBaseMeta":strTipoBaseMeta,
						"strTipoBase":'NA',
						"strTipoVendedor":'NA',
						"strVendedor":'NA',
						"strTipoBaseIngreso":'NA',
						"intIva":'-1',
						"intDescuento":'-1',
						"intTiempoVisita":'-1',
						"strTransacciones":'NA',
						"strDiasVisita":'NA'
					}
				}

				$.ajax({
					data:  parametros,
					url:   '../Controller/ParametrizarVendedorController.php',
					type:  'post',                           
					success:  function (response) { 
						txtDato.value='';
						txtNombre.value='';
						txtValorMeta.value='';
						Mensaje('success',response);
						CancelarEditarIngreso();
						ListarIngresos();
						document.getElementById('pnTblContenidoMeta').style.height=(document.getElementById('pnTblContenidoMeta').offsetHeight-290)+"px"; 
					},
					error: function (error) {
						alert('error; ' + eval(error));
					}
				});
			}else{
				var ddlTipoBase=document.getElementById('ddlBase');
				var ddlTipoVendedor=document.getElementById('ddlTipoContenidoUno');
				var ddlVendedor=document.getElementById('ddlVendedoresContenido');
				var ddlTipoIngresoBase=document.getElementById('ddlTipoBaseIngreso');
				var chkIva=document.getElementById('chkIva');
				var chkDescuento=document.getElementById('chkDescuento');
				var chkTiempoVisita=document.getElementById('chkTiempoVisita');
				var txtDiasVisita=document.getElementById('txtDiasVisita');
				var intIva=0;
				var intTiempoVisita=0;
				var intDescuento=-1;
				var strVendedor=ddlVendedor.value;
				var strDiasVisita='NA';
				if(chkTiempoVisita.checked){
					if(txtDiasVisita.value.trim()==''){
						Mensaje('error','Ingrese dias de visita.');
						txtDiasVisita.focus();
						return;
					}}
					var strTipoIngresoBase=ddlTipoBaseIngreso.value;
					if(ddlTipoVendedor.value=='GN' || ddlTipoVendedor.value=='PP'){
						strVendedor='NA';
					}
					if(chkIva.checked){
						intIva=1;
					}
					if(ddlTipoBase.value!='VN'){
						if(chkDescuento.checked)
						{
							intDescuento=1;
						}else{
							intDescuento=0;
						}
					}	

					if(chkTiempoVisita.checked){
						intTiempoVisita=1;
						strDiasVisita=txtDiasVisita.value.trim();
					}
					var intTamanoTransacciones=$("#tbltransacciones tr").length;
					var strTransacciones='';
					var blnEstadoTransacciones=false;
					for(i=0;i<=intTamanoTransacciones-2;i++){
						if(document.getElementById('chk'+i).checked){
							strTransacciones="'"+document.getElementById('tbltransacciones').rows[i+1].cells[1].innerHTML+"',"+strTransacciones;
							blnEstadoTransacciones=true;
						}
					}

					if(!blnEstadoTransacciones){
						Mensaje('error','Seleccione una Transacción.');
						return;
					}

					if(intProcedimientoIngreso=='1'){
						var parametros={
							'btnIngresarIngreso':'true',
							"strNombre":txtNombre.value.trim(),
							"intSerie":intSerie,
							"intValor":txtDato.value.trim(),
							"dtFechaInicial":dtFechaIN,
							"dtFechaFinal":dtFechaFN,
							"strPeriocidad":ddlPeriocidad.value,
							"intTipo":intTipo,
							"intMeta":intMeta,
							"intTipoMeta":intTipoMeta,
							"intValorMeta":intValorMeta,
							"strBaseMeta":strBaseMeta,
							"strTipoBaseMeta":strTipoBaseMeta,
							"intCompania":ddlCompania.value,
							"intCedulaVendedor":intCedulaVendedor.value.trim(),
							"strTipoBase":ddlTipoBase.value,
							"strTipoVendedor":ddlTipoVendedor.value,
							"strVendedor":strVendedor,
							"strTipoBaseIngreso":strTipoIngresoBase,
							"intIva":intIva,
							"intDescuento":intDescuento,
							"intTiempoVisita":intTiempoVisita,
							"strDiasVisita":strDiasVisita,
							"strTransacciones":strTransacciones,
							"intEstado":intEstado
						}}else{
							var parametros={
								'btnActualizarIngreso':'true',
								'intIdIngreso':document.getElementById('txtIdIngreso').value.trim(),
								"strNombre":txtNombre.value.trim(),
								"intValor":txtDato.value.trim(),
								"intEstado":intEstado,
								"intSerie":intSerie,
								"dtFechaInicial":dtFechaIN,
								"dtFechaFinal":dtFechaFN,
								"intTipo":intTipo,
								"strPeriocidad":ddlPeriocidad.value,
								"intMeta":intMeta,
								"intTipoMeta":intTipoMeta,		
								"intValorMeta":intValorMeta,
								"strBaseMeta":strBaseMeta,
								"strTipoBaseMeta":strTipoBaseMeta,
								"strTipoBase":ddlTipoBase.value,
								"strTipoVendedor":ddlTipoVendedor.value,
								"strVendedor":strVendedor,
								"strTipoBaseIngreso":strTipoIngresoBase,
								"intIva":intIva,
								"intDescuento":intDescuento,
								"intTiempoVisita":intTiempoVisita,
								"strDiasVisita":strDiasVisita,
								"strTransacciones":strTransacciones
							}


						}

						$.ajax({
							data:  parametros,
							url:   '../Controller/ParametrizarVendedorController.php',
							type:  'post',                           
							success:  function (response) {
								txtDato.value='';
								txtNombre.value='';  
								txtValorMeta.value='';
								Mensaje('success',response);
								ListarIngresos();
								CancelarEditarIngreso();
								document.getElementById('pnTblContenidoMeta').style.height=(document.getElementById('pnTblContenidoMeta').offsetHeight-290)+"px"; 
							},
							error: function (error) {
								alert('error; ' + eval(error));
							}
						});
					}

				}
			</script>

			<script type="text/javascript">

				function ListarIngresos(){
					var ddlCompania=document.getElementById('ddlCompania');
					if(ddlCompania.value==1){
						document.getElementById('chkIva').style.display='inline';
						$('#chkIva').prop('checked',false);
					}else{
						document.getElementById('chkIva').style.display='none';
						$('#chkIva').prop('checked',true);
					}



					var parametros={
						"btnListarIngresos":'true',
						"strCedula":document.getElementById('txtCedula').value.trim(),
						"intCompania":document.getElementById('ddlCompania').value
					}
					$.ajax({
						data:  parametros,
						url:   '../Controller/ParametrizarVendedorController.php',
						type:  'post',                           
						success:  function (response) {  
							document.getElementById('tbodyIngresos').innerHTML=response;
							
						},
						error: function (error) {
							alert('error; ' + eval(error));
						}
					});
				}



				function tblLineasSelect(row){
					blnCheck=document.getElementById("checkL"+row).checked;		
					if(blnCheck){		
						document.getElementById("rowL"+row).className='success';						
					}else{		
						document.getElementById("rowL"+row).classList.remove('success');
					}
				}
				function PintarTblZonas(intCedulaVendedor){
					var parametros = {
						"btnListarZonas" : 'true',
						"txtCedula":intCedulaVendedor.trim()
					};
					$.ajax({
							data:  parametros,
							url:   '../Controller/ParametrizarVendedorController.php',
							type:  'post',                           
							success:  function (response) { 
								document.getElementById('tblZonas').innerHTML=response;
							},
							error: function (error) {
							alert('error; ' + eval(error));
							}
						});
				}
				function PintarTblLineas(intCedulaVendedor){
					var parametros = {
						"btnListarLineas" : 'true',
						"txtCedula":intCedulaVendedor.trim()
					};
					$.ajax({
						data:  parametros,
						url:   '../Controller/ParametrizarVendedorController.php',
						type:  'post',                           
						success:  function (response) { 

							document.getElementById('tblLineas').innerHTML=response;
						},
						error: function (error) {
							alert('error; ' + eval(error));
						}
					});

				}
				ListarVendedoresNoParametrizados();
				function ListarVendedoresNoParametrizados(){
					var parametros = {
						"btnListarVendedoresNoParametrizados" : 'true'
					};
					$.ajax({
						data:  parametros,
						url:   '../Controller/ParametrizarVendedorController.php',
						type:  'post',                           
						success:  function (response) {  
							document.getElementById('tblVendedoreNoParametrizados').innerHTML=response;


						},
						error: function (error) {
							alert('error; ' + eval(error));
						}
					});
				}$(document).ready(function () { 
					(function ($) {			
						$('#txtBuscarVendedorNoParametrizado').keyup(function () {
							var rex = new RegExp($(this).val(), 'i');
							$('#tblVendedoreNoParametrizados tr').hide();
							$('#tblVendedoreNoParametrizados tr').filter(function () {                   	
								return rex.test($(this).text());

							}).show();
						}) 
					}(jQuery));
					(function ($) {			
						$('#txtBuscarVendedorParametrizado').keyup(function () {
							var rex = new RegExp($(this).val(), 'i');
							$('#tblVendedoreParametrizados tr').hide();
							$('#tblVendedoreParametrizados tr').filter(function () {                   	
								return rex.test($(this).text());

							}).show();
						})

					}(jQuery));  
					(function ($) {			
						$('#txtBuscarLinea').keyup(function () {
							var rex = new RegExp($(this).val(), 'i');
							$('#tblLineas tr').hide();
							$('#tblLineas tr').filter(function () {                   	
								return rex.test($(this).text());

							}).show();
						})

					}(jQuery));                                     
				});
				function SeleccionarVendedor(FilaTblVendedor){
					var intTamDdlZona= document.getElementById("ddlZonas").length;

					if(intTamDdlZona==0){
						const toast = swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000,
							background: '#FFFFB0'
						});

						toast({
							type:'error',
							title: "<span style='color:#686868'>Para poder continuar debe ingresar una Zona previamente.</span>"
						});
						return;

					}
					var tblVendedor=document.getElementById('tblVendedores');
					var strVendedor=tblVendedor.rows[FilaTblVendedor].cells[1].innerHTML;
					document.getElementById('txtTipoEmpleado').value=tblVendedor.rows[FilaTblVendedor].cells[4].innerHTML;
					document.getElementById('txtCedula').value=tblVendedor.rows[FilaTblVendedor].cells[1].innerHTML;
					document.getElementById('txtNombre').value=tblVendedor.rows[FilaTblVendedor].cells[2].innerHTML;

					document.getElementById('txtidTipoempleado').value=tblVendedor.rows[FilaTblVendedor].cells[3].innerHTML;
					document.getElementById('ChkLineasTodas').disabled=false;
					document.getElementById('btnAsignar').disabled = false;
					document.getElementById('btnAsignarZona').disabled = false;
					PintarTblLineas(strVendedor);
					PintarTblZonas(strVendedor);
					document.getElementById('btnAsignar').focus();

					if(tblVendedor.rows[FilaTblVendedor].cells[6].innerHTML.trim()!=''){
						document.getElementById("ddlZonas").value=tblVendedor.rows[FilaTblVendedor].cells[6].innerHTML.trim();
					}
					if(tblVendedor.rows[FilaTblVendedor].cells[7].innerHTML.trim()!=''){
						document.getElementById("ddlCompanias").value=tblVendedor.rows[FilaTblVendedor].cells[7].innerHTML.trim();
					}else{
						document.getElementById("ddlCompanias").value=1;
					}
					AgregarVendedor();

				}
				function Cancelar(){
					document.getElementById('txtTipoEmpleado').value='';
					document.getElementById('txtCedula').value='';
					document.getElementById('txtNombre').value='';
					document.getElementById('tblLineas').innerHTML='';
					document.getElementById('txtidTipoempleado').value='';
					document.getElementById('btnAsignar').disabled=true;
					document.getElementById('btnAsignarZona').disabled = true;
					document.getElementById('ChkLineasTodas').disabled=true;
					document.getElementById('txtBuscarVendedorNoParametrizado').focus();
					$('#ddlZonas').prop('selectedIndex',0);
					document.getElementById('pnGeneral').style.display='none';
					document.getElementById('txtDato').value='';
					document.getElementById('txtNombreIngreso').value='';
					document.getElementById('txtValorMeta').value='';
					document.getElementById('txtValorMetaTabla').value='';
				}
				function VisualizarCiudadesPorZona(){
					var ddlZona=document.getElementById('ddlZonas').value.trim();
					var parametros = {
						"txtZona": ddlZona,
						"btnListarCiudadesPorZona" : 'true'
					};
					$.ajax({
						data:  parametros,
						url:   '../Controller/ParametrizarVendedorController.php',
						type:  'post',                           
						success:  function (response) {  
							$('#ModalCiudadesZona').modal('show');
							document.getElementById('lblZona').innerHTML=document.getElementById('ddlZonas').options[document.getElementById('ddlZonas').selectedIndex].text;
							document.getElementById('dvContenidoCiudades').innerHTML=response;
						},
						error: function (error) {
							alert('error; ' + eval(error));
						}
					});
				}
				function AsignarZonasVendedor(){
					
					var strCedulaVendedor= document.getElementById('txtCedula').value.trim();
					
					var intNroFilasLineas=$("#tblZonas tr").length;
					for(i=1;i<=intNroFilasLineas;i++){
						blnCheck=document.getElementById("checkZ"+i).checked;
						intCodigoTblLinea=-1;
						blnEstadoZonaVendedor=1;
						if(!blnCheck){
							blnEstadoZonaVendedor=0;
						}
						var parametros = {
							"btnActualizarZonasVendedor" : 'true',
							strCedulaVendedor, 
							blnEstadoZonaVendedor,
							"txtCodigoZona" : document.getElementById("tblZonas").rows[i-1].cells[1].innerHTML.trim(),
						}
						$.ajax({
							data:  parametros,
							url:   '../Controller/ParametrizarVendedorController.php',
							type:  'post',                           
							success:  function (res){
								console.log(res);
								blnEstado=true;
						
							},
							error: function (error) {
								alert('error; ' + eval(error));
							}
						});

					}
				}
				function AsignarLineasYZonaAVendedor(){
					var blnEstado=false;
					intNroFilasLineas=$("#tblLineas tr").length;
					strCedulaVendedor=document.getElementById('txtCedula').value.trim();	
					for(i=1;i<=intNroFilasLineas;i++){

						blnCheck=document.getElementById("checkL"+i).checked;
						intCodigoTblLinea=-1;
						blnEstadoLineaVendedor=true;
						if(!blnCheck){
							blnEstadoLineaVendedor=false;
						}
						var parametros = {
							"btnAgregarLineasVendedor" : 'true',
							"txtCedulaVendedor" : strCedulaVendedor,
							"txtCodigoLinea" : document.getElementById("tblLineas").rows[i-1].cells[1].innerHTML.trim(),
							"txtEstadoLineaVendedor": blnEstadoLineaVendedor, 
							"ddlZona":document.getElementById('ddlZonas').value.trim(),
							"intIdCompania" : $("#ddlCompanias option:selected").val()

						};
						$.ajax({
							data:  parametros,
							url:   '../Controller/ParametrizarVendedorController.php',
							type:  'post',                           
							success:  function (response){
								blnEstado=true;

							},
							error: function (error) {
								alert('error; ' + eval(error));
							}
						});

					}
					ListarVendedoresNoParametrizados();

					const toast = swal.mixin({
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000,
						background: '#FFFFB0'
					});

					toast({
						type:'success',
						title: "<span style='color:#686868'>Operación Completada.</span>"
					});

				}

				function AgregarVendedor(){

					var parametros={
						"txtTipoEmpleado":document.getElementById('txtidTipoempleado').value.trim(),
						"txtCedula": document.getElementById('txtCedula').value.trim(),
						"txtNombre":document.getElementById('txtNombre').value.trim(),
						"ddlZona":document.getElementById('ddlZonas').value.trim(),		
						"btnAgregarVendedor" : true
					}

					$.ajax({
						data:  parametros,
						url:   '../Controller/ParametrizarVendedorController.php',
						type:  'post',                           
						success:  function (response){
							ListarMetasDeVendedor();
							ListarIngresos();
							ListarEgresos();
							document.getElementById('pnGeneral').style.display='inline';
						},
						error: function (error) {
							alert('error; ' + eval(error));
						}
					});
				}
				ListarTransacciones();
				function VistaIngreso(intId){
					var parametros={
						"intIdIngreso": intId,
						"btnVisualizarIngreso":'true'
					}			
					$.ajax({
						data:  parametros,
						url:   '../Controller/ParametrizarVendedorController.php',
						type:  'post',                           
						success:  function (response){

							document.getElementById('txtIdIngreso').value=intId;
							var strDatos=response.split('%');
							if(strDatos[0]=='1'){
								document.getElementById('Contenidodocumentos').style.display='inline';
								document.getElementById('ddlVendedores').style.display='none';
								document.getElementById('ContenidoUno').style.display='inline';
								$('#rdbPorcentajeIngreso').prop('checked', false);
								$('#ddlTipoContenidoUno option:selected').removeAttr('selected');
								$('#ddlBase option:selected').removeAttr('selected');
								$('#ddlVendedoresContenido option:selected').removeAttr('selected');
								$('#ddlTipoBaseIngreso option:selected').removeAttr('selected');
								$('#rdbValorIngreso').prop('checked', false);
								$('#rdbPorcentajeIngreso').prop('checked', true);	
								$("#ddlBase > option[value="+strDatos[11]+"]").prop("selected",true);

								$("#ddlTipoContenidoUno > option[value="+strDatos[18]+"]").prop("selected",true);
								if(strDatos[18].trim()!='GN' && strDatos[18].trim()!='PP'){
									ddlTipoContenidoUno();
									$("#ddlVendedoresContenido > option[value="+strDatos[19]+"]").prop("selected",true);	
									document.getElementById('ddlVendedores').style.display='inline';
								}

								if(strDatos[11]=='VN'){
									document.getElementById('ContenidoDescuento').style.display='none';
								}else{
									document.getElementById('ContenidoDescuento').style.display='inline';
								}
								if(strDatos[14]=='1'){
									$("#chkDescuento").prop('checked',true);
								}else{
									$("#chkDescuento").prop('checked',false);
								}
								if(strDatos[13]=='1'){
									$("#chkIva").prop('checked',true);
								}else{
									$("#chkIva").prop('checked',false);
								}
								if(strDatos[15]=='1'){
									$("#chkTiempoVisita").prop('checked',true);
									document.getElementById('txtDiasVisita').value=strDatos[16];
									document.getElementById('ContenidoTiempoVisita').style.display='inline';
								}else{
									$("#chkTiempoVisita").prop('checked',false);
									document.getElementById('txtDiasVisita').value='';
									document.getElementById('ContenidoTiempoVisita').style.display='none';
								}
								$("#ddlTipoBaseIngreso > option[value="+strDatos[12]+"]").prop("selected",true);
								document.getElementById('pnTblContenidoMeta').style.height="465px"; 
							}else{
								document.getElementById('Contenidodocumentos').style.display='none';
								document.getElementById('ContenidoUno').style.display='none';
								$('#rdbValorIngreso').prop('checked', true);
								$('#rdbPorcentajeIngreso').prop('checked', false);
								document.getElementById('pnTblContenidoMeta').style.height=(document.getElementById('pnTblContenidoMeta').offsetHeight-290)+"px"; 	
							}

							var strTransacciones=strDatos[21].split(",");
							intNroTransacciones=$("#tbltransacciones tr").length;
							alert(intNroTransacciones);
							for(k=0;k<=strTransacciones.length-2;k++){
								document.getElementById('chk'+k).checked=false;
								SelectCheckbox('chk'+k,'rowTransaccion'+k);
							}
							for(i=0;i<=intNroTransacciones-2;i++){
								for(k=0;k<=strTransacciones.length-1;k++){
									if("'"+document.getElementById('tbodytransacciones').rows[i].cells[1].innerHTML+"'"==strTransacciones[k]){
										document.getElementById('chk'+i).checked=true;
										SelectCheckbox('chk'+i,'rowTransaccion'+i);
									}
								}
							}	

							if(strDatos[20]=='1'){
								$('#rdbActivado').prop('checked', true);
							}else{
								$('#rdbDesactivado').prop('checked', true);
							}
							document.getElementById('txtNombreIngreso').value=strDatos[1];
							document.getElementById('txtDato').value=strDatos[2];
							$('#rdbTipoFijo').prop('checked', false);
							$('#rdbTipoUnico').prop('checked', false);
							$('#rdbTipoTemporal').prop('checked', false);
							if(strDatos[6]=='0'){
								$('#rdbTipoFijo').prop('checked', true);
								$('#rdbTipoUnico').prop('checked', false);
								$('#rdbTipoTemporal').prop('checked', false);
								document.getElementById('ContenidoPeriocidad').style.display='inline';
								document.getElementById('ContenidoTipoFechaFinal').style.display='none';
								document.getElementById('ContenidoTipo').style.display='none';

								document.getElementById('dtFechaInicialFijo').value=strDatos[3];
								document.getElementById('ctnFechaInicialAplicar').style.display='inline';                		
							}else if (strDatos[6]=='1'){
								$('#rdbTipoUnico').prop('checked', true);
								$('#rdbTipoTemporal').prop('checked', false);
								$('#rdbTipoFijo').prop('checked', false);
								document.getElementById('dtFechaInicial').value=strDatos[3];
								document.getElementById('ContenidoTipo').style.display='inline';
								document.getElementById('ContenidoPeriocidad').style.display='none';
								document.getElementById('ContenidoTipoFechaFinal').style.display='none';
								document.getElementById('ContenidoPeriocidad').style.display='none'; 
								document.getElementById('ctnFechaInicialAplicar').style.display='none';
							}else if(strDatos[6]=='2'){
								$('#rdbTipoTemporal').prop('checked', true);
								$('#rdbTipoUnico').prop('checked', false);
								$('#rdbTipoFijo').prop('checked', false);
								document.getElementById('ContenidoTipo').style.display='inline';
								document.getElementById('dtFechaInicial').value=strDatos[3];
								document.getElementById('dtFechaFinal').value=strDatos[4]; 
								document.getElementById('ContenidoTipoFechaFinal').style.display='inline';
								document.getElementById('ContenidoPeriocidad').style.display='inline'; 
								document.getElementById('ctnFechaInicialAplicar').style.display='none';      		
							}
							$("#ddlPeriocidad > option[value='MS']").prop("selected",false);
							$("#ddlPeriocidad > option[value='QC']").prop("selected",false);
							$("#ddlPeriocidad > option[value="+ strDatos[5]+"]").prop("selected",true);	
							if(strDatos[7]=='1'){
								$("#rdbMetaIngreso").prop('checked',true);
								document.getElementById('ContenidoMeta').style.display='inline';                
								if(strDatos[8]=='0'){
									document.getElementById('txtValorMeta').value=strDatos[9];
									$('#rdbTipoMetaFija').prop('checked', true);
									$('#rdbTipoMetaVariable').prop('checked',false);
									document.getElementById('ContenidoBaseDescuento').style.display='inline';
								} else{
									$('#rdbTipoMetaFija').prop('checked', false);
									$('#rdbTipoMetaVariable').prop('checked',true);
									document.getElementById('ContenidoBaseDescuento').style.display='none';
								}
							}else{
								$("#rdbMetaIngreso").prop('checked',false);
								document.getElementById('ContenidoMeta').style.display='none';  
							}
							document.getElementById('btnEditarIngreso').style.display='inline';
							document.getElementById('btnCancelarIngreso').style.display='inline';
							document.getElementById('btnAgregarIngreso').style.display='none'; 
							document.getElementById('txtNombreIngreso').focus();           		
						},
						error: function (error) {
							alert('error; ' + eval(error));
						}
					});
}
function CancelarEditarIngreso(){
	document.getElementById('txtDato').value='';
	document.getElementById('txtNombreIngreso').value='';
	$('#rdbValorIngreso').prop('checked', true);
	$('#rdbActivado').prop('checked',true);
	$('#rdbTipoFijo').prop('checked',true);
	$('#rdbMetaIngreso').prop('checked',false);
	$("#ddlPeriocidad > option[value='MS']").attr("selected",false);
	$("#ddlPeriocidad > option[value='QC']").attr("selected",false);
	$("#ddlPeriocidad > option[value='MS']").attr("selected",true);	
	document.getElementById('ContenidoPeriocidad').style.display='inline';
	document.getElementById('ContenidoTipo').style.display='none';
	document.getElementById('ContenidoTipo').style.display='none';
	document.getElementById('ContenidoUno').style.display='none';
	document.getElementById('Contenidodocumentos').style.display='none';
	document.getElementById('ContenidoMeta').style.display='none';
	document.getElementById('btnAgregarIngreso').style.display='inline';
	document.getElementById('btnCancelarIngreso').style.display='none';
	document.getElementById('btnEditarIngreso').style.display='none';
	document.getElementById('txtIdIngreso').value='';
	document.getElementById('pnTblContenidoMeta').style.height=(document.getElementById('pnTblContenidoMeta').offsetHeight-290)+"px"; 
	document.getElementById('ctnFechaInicialAplicar').style.display='inline';
	var Fecha= new Date();
	var Dia=Fecha.getDate();
	var Mes=(Fecha.getMonth() +1);
	if((Fecha.getMonth() +1)<=9){
		Mes='0'+(Fecha.getMonth() +1);
	}
	if(Fecha.getDate()<=9){
		Dia='0'+Fecha.getDate();
	}
	document.getElementById('dtFechaInicialFijo').value=Fecha.getFullYear() + "-" + Mes + "-" + Dia; 
	intNroTransacciones=$("#tbltransacciones tr").length;
	for(k=0;k<=intNroTransacciones-2;k++){
		document.getElementById('chk'+k).checked=false;
		SelectCheckbox('chk'+k,'rowTransaccion'+k);
	}
}
function AgregarEgreso(){
	var rdbTipoFijoEgreso=document.getElementById('rdbTipoFijoEgreso');
	var rdbTipoUnicoEgreso=document.getElementById('rdbTipoUnicoEgreso');
	var rdbTipoTemporalEgreso=document.getElementById('rdbTipoTemporalEgreso');
	var intValor=document.getElementById('txtValorEgreso');
	var strNombre=document.getElementById('txtNombreEgreso');
	var dtFechaFinal=document.getElementById('dtFechaFinalEgreso');
	var dtFechaInicial=document.getElementById('dtFechaInicialEgreso');
	var ddlPeriocidad=document.getElementById('ddlPeriocidadEgresos');
	var chkSaldo=document.getElementById('chkConSaldo');
	var txtValorSaldo=document.getElementById('txtValorSaldo');
	var txtCedulaVendedor=document.getElementById('txtCedula');
	var rdbActivo=document.getElementById('rdbActivadoEgreso');	
	var rdbPorFecha=document.getElementById('rdbPorFecha');

	var strPeriocidad='NA';  
	var intSerie=-1; 
	var strFechaInicial='0000-00-00';
	var strFechaFinal='0000-00-00';
	var strTipoTemporal='NA';
	var intCuota=0;
	var intEstado=1;

	if(strNombre.value==''){
		Mensaje('error','Ingrese nombre del egreso.');
		strNombre.focus();
		return;
	} 
	if(intValor.value==''){
		Mensaje('error','Ingrese valor del egreso.');
		intValor.focus();
		return;
	} 	
	if(rdbTipoFijoEgreso.checked){
		intSerie=0;
		strPeriocidad=ddlPeriocidad.value;
		strFechaInicial=document.getElementById('dtFechaEgresoAplicar').value;	
	}else if(rdbTipoUnicoEgreso.checked){
		intSerie=1;
		strFechaInicial=dtFechaInicial.value.trim();

	}else if(rdbTipoTemporalEgreso.checked){

		intSerie=2;

		strPeriocidad=ddlPeriocidad.value;
		if(chkSaldo.checked){	    	 
			if(txtValorSaldo.value.trim()==''){
				Mensaje('error','Ingrese saldo.');
				txtValorSaldo.focus();
				return;
			}  	
			intCuota=txtValorSaldo.value.trim();
			strTipoTemporal=1;
			strFechaInicial=document.getElementById('dtFechaEgresoAplicar').value;
		}else{
			var x=new Date();
			var dtFechaInicialIN = dtFechaInicial.value.split("-");
			x.setFullYear(dtFechaInicialIN[0],dtFechaInicialIN[1]-1,dtFechaInicialIN[2]);
			var hoy = new Date();	     
			var dtFinal = new Date(dtFechaFinal.value);
			if (dtFinal < x){
				Mensaje('error','Ingrese fecha final mayor a la inicial.');
				dtFechaFinal.focus();
				return;
			}	
			strTipoTemporal=0;
			strFechaInicial=dtFechaInicial.value.trim();
			strFechaFinal=dtFechaFinal.value.trim();
		}		    
	}
	if(!rdbActivo.checked){
		intEstado=0;
	}
	var parametros = {
		"btnAgregarEgreso": 'true',
		"strNombre" : strNombre.value.trim(),
		"intValor" : intValor.value.trim(),
		"intSerie" : intSerie,
		"dtFechaInicial" : strFechaInicial,
		"dtFechaFinal" : strFechaFinal,
		"strPeriocidad" :strPeriocidad,
		"intCedulaVendedor" : txtCedulaVendedor.value.trim(),
		"strTipoTemporal" : strTipoTemporal,
		"intCuota" : intCuota,
		"intEstado" : intEstado,
		'intCompania':document.getElementById('ddlCompania').value.trim()
	};
	$.ajax({
		data:  parametros,
		url:   '../Controller/ParametrizarVendedorController.php',
		type:  'post',                           
		success:  function (response) {  
			Mensaje('success',response);
			ListarEgresos();
			LimpiarEgreso();
			document.getElementById('ctnFechaInicialAplicarEgreso').style.display='inline';
			var Fecha= new Date();
			var Dia=Fecha.getDate();
			var Mes=(Fecha.getMonth() +1);
			if((Fecha.getMonth() +1)<=9){
				Mes='0'+(Fecha.getMonth() +1);
			}
			if(Fecha.getDate()<=9){
				Dia='0'+Fecha.getDate();
			}
			document.getElementById('dtFechaEgresoAplicar').value=Fecha.getFullYear() + "-" + Mes + "-" + Dia; 
		},
		error: function (error) {
			alert('error; ' + eval(error));
		}
	});
}
function ListarEgresos(){
	var strVendedor=document.getElementById('txtCedula').value.trim();
	if(strVendedor==''){
		Mensaje('Error','Seleccione vendedor.');
		strVendedor.focus();
		return;
	}
	var parametros={
		"btnListarEgresos":'true',
		"intCedulaVendedor":strVendedor,
		'intCompania':document.getElementById('ddlCompania').value.trim()
	}

	$.ajax({
		data:  parametros,
		url:   '../Controller/ParametrizarVendedorController.php',
		type:  'post',                           
		success:  function (response){
			document.getElementById('tbodyEgresos').innerHTML=response;

		},
		error: function (error) {
			alert('error; ' + eval(error));
		}
	});
}
function LimpiarEgreso(){
	$("#rdbActivadoEgreso").prop('checked',true);
	document.getElementById('txtNombreEgreso').value='';
	document.getElementById('txtValorEgreso').value='';
	$("#rdbTipoFijoEgreso").prop('checked',true);
	document.getElementById('dtEgresoTipo').style.display='none';
	document.getElementById('ddlPeriocidadEgreso').style.display='inline';
	document.getElementById('txtValorSaldo').value='';
	$("#ddlPeriocidadEgresos > option[value='MS']").prop("selected",false);
	$("#ddlPeriocidadEgresos > option[value='QC']").prop("selected",false);
	$("#ddlPeriocidadEgresos > option[value='MS']").prop("selected",true);	
}
function EstadoEgreso(intEgreso){
	var parametros={
		"btnEstadoEgreso":'true',
		"intIdEgreso":intEgreso    
	}

	$.ajax({
		data:  parametros,
		url:   '../Controller/ParametrizarVendedorController.php',
		type:  'post',                           
		success:  function (response){
			Mensaje('success',response);
			ListarEgresos();
		},
		error: function (error) {
			alert('error; ' + eval(error));
		}
	});
}
function ListarEgresosIngresos(){
	ListarIngresos();
	ListarEgresos();
	var Fecha= new Date();
	var Dia=Fecha.getDate();
	var Mes=(Fecha.getMonth() +1);
	if((Fecha.getMonth() +1)<=9){
		Mes='0'+(Fecha.getMonth() +1);
	}
	if(Fecha.getDate()<=9){
		Dia='0'+Fecha.getDate();
	}
	document.getElementById('dtFechaInicialFijo').value=Fecha.getFullYear() + "-" + Mes + "-" + Dia;

	CancelarEditarIngreso(); 
}
function EliminarEgreso(intTipoEgreso){
	var parametros={
		"btnEliminarEgreso":'true',
		"intIdEgreso":intTipoEgreso    
	}

	$.ajax({
		data:  parametros,
		url:   '../Controller/ParametrizarVendedorController.php',
		type:  'post',                           
		success:  function (response){

			Mensaje('success',response);
			ListarEgresos();
		},
		error: function (error) {
			alert('error; ' + eval(error));
		}
	});
}
function ChkLineasTodas(){
	var blnEstado=document.getElementById('ChkLineasTodas').checked;
	for(i=1;i<=$("#tblLineasM tr").length;i++){
		document.getElementById('checkL'+i).checked=blnEstado;
		if(blnEstado){
			document.getElementById("rowL"+i).className='success';	
		}else{
			document.getElementById("rowL"+i).classList.remove('success');
		}
	}
}
function SelectCheckbox(strChk,strTipo){
	var chk=document.getElementById(strChk);
	if(chk.checked){
		document.getElementById(strTipo).className='success';	
	}else{
		document.getElementById(strTipo).classList.remove('success');
	}

}
function ListarTransacciones(){
	var parametros={
		"btnListarTransaccion":'true' 
	}

	$.ajax({
		data:  parametros,
		url:   '../Controller/ParametrizarVendedorController.php',
		type:  'post',                           
		success:  function (response){

			document.getElementById('tbodytransacciones').innerHTML=response;
		},
		error: function (error) {
			alert('error; ' + eval(error));
		}
	});
}
 //Listar Compañias
 function ListarCompanias(){
 	var parametros = {
 		"btnListarCompanias" : 'true'
 	};
 	$.ajax({
 		data:  parametros,
 		url:   '../Controller/CompaniasController.php',
 		type:  'post',
 		success:  function (response) {
 			var data = JSON.parse(response);
 			if(data==''){ 
 				strHtml="<option value='-1'>No hay compañias creadas.</option>";
 				$('#ddlCompanias').append(strHtml); 
 				return;
 			}
 			data.forEach(function(row){
 				strHtml="<option value='"+row.intIdCompania+"'>"+row.strDescripcion+"</option>";
 				$('#ddlCompanias').append(strHtml); 
 			});
 		},
 		error: function (error) {
 			alert('error; ' + eval(error));
 		}
 	});
 }
 let timerInterval
 swal({
 	title: 'Cargando...',
 	html: 'Espere mientras carga la página.',
 	timer: 2000,
 	onOpen: () => {
 		swal.showLoading()  
 	},
 	onClose: () => {
 		clearInterval(timerInterval); 
 	}
 }).then((result) => {
 	if (
 		result.dismiss === swal.DismissReason.timer
 		) {   
 	}
}); 


</script>