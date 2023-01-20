<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==4){
        if($_SESSION['Permisos'][$i]['intVer']==1){
          $blnPermiso=true;
        }
        break;
       }
    }
    if(!($blnPermiso)){
      echo "<script language='javascript'>window.location='../view/index.php?menu=Inicio'</script>;"; 
    }
?>
<style type="text/css">
.table-wrapper-scroll-y {
	display: block;
	max-height: 500px;
	overflow-y: auto;
	-ms-overflow-style: -ms-autohiding-scrollbar;
}
.contenedor-xls{
	border:1px solid #ddd;
	padding: 10px;
	border-radius: 20px;
}
body{
	background: #fff;
}
.Contenedor-Modal{
	position: fixed;
	visibility: hidden;
	top: 120%;
	right: 0;
	bottom: 0;
	left: 0;
	z-index: 100000;
	transition: all 0.5s ease;
}
.Efecto-Modal-Abrir{
	visibility: visible;
	top:0%;
	transition: all 0.5s ease;
}

.Contenedor-Opaco{
	height: 100%;
	width: 100%;
	opacity: 0.2;
	background: #337ab7;
	position: absolute;
}
.Contenido-modal{
	background:#fff;
	width: 400px;
	height: 200px;
	position: absolute;
	border-radius: 20px;
	min-width: 400px;
	min-height: 200px;
}
.Centrar-contenido{
	height: 100%;
	display: flex;
	align-items: center;
	justify-content: center;
}
</style>

<div id="page-wrapper" style="height: 600px;">
<br>

	<!-- Modal confirmación -->
	<div class="Contenedor-Modal" id='Contenedor-Modal'>
		<div class="Contenedor-Opaco" id='Contenedor-Opaco'>
		</div>
		<div class="Centrar-contenido">
			<div class="Contenido-modal text-center">
				<div class="Centrar-contenido">
					<div>
						<h2>¿Desea descargar el archivo del liquidador de productos?</h2>
						<hr>
						<div>
							<button class="btn btn-default" onclick="DescargarXlsProductos()">Si</button>
							<button class="btn btn-default" onclick="
							document.getElementById('Contenedor-Modal').classList.remove('Efecto-Modal-Abrir');">No</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--- Modal  -->
<div class="row">
  <div class="col-lg-4">
  	<div class="form-group">
		    <select class="form-control" id="select">
		      <option value="2">Sin sticker (liquidados)</option>
		      <option value="3">Con sticker (por subir)</option>
		      <option value="4">Subidos HGI</option>
		    </select>
		  </div>
  </div>
  <div class="col-lg-8">
    <div class="form-group">
      <input type="text" id="txtFiltro"  placeholder="Filtrar" onkeyup="FiltrarDatos();" class="form-control" aria-label="...">
    </div><!-- /input-group -->
  </div>
</div>
<br>
<div class="contenedor-xls">
		<h4>Descargar archivo xls de los productos liquidados.</h4>
		<form id='frmDescargarXlsProductos' action='../Controller/ProductosController.php' method="post">
			<select class="form-control" id='ddlEncabezadoCompra' name='ddlEncabezadoCompra'>
			</select>
			<div>
				<label>Estado</label>
				<input type="radio" name='rdbEstado' value='2' checked=""> 2
				<input type="radio" name='rdbEstado' value='3'> 3
			</div>
			<input type="hidden" name="btnGenerarXlsProductosLiquidados">
			<button type="button" class="btn btn-default" onclick="ValidarDescargaXlsProductos()">Descargar</button>
		</form>
	</div>
<br>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Informacion</div>

		  <!-- Table -->
		  <div class="table-wrapper-scroll-y">
		  	<table class="table table-hover table-bordered" id="tblTableModificar">
                <thead>
                    <tr>                                                                                  
                        <th>Referencia</th>
                        <th>Raggi</th> 
                        <th>Descripcion</th>                                           
                        <th>Precio 1</th>
                        <th>Precio 2</th>
                        <th>Precio 3</th>
                        <th>Precio 4</th>
                        <th>Precio 5</th>	                                
                    </tr>
                </thead>
                 <tbody id="tabla1">
                   
                 </tbody>     
            </table>
		  </div>
		  
		</div>
	</div>
		
</div>
</div>

<script type="text/javascript">
	
	CargarEstado(2);
	GetEncabezadoCompraProductos();

	function FiltrarDatos() {
		if ($('#txtFiltro').val() != "") {
			var parametros = {
			                    "accionFiltrar" : 'true',
			                    "text" : $("#txtFiltro").val(),
			                    "estado" : $("#select option:selected").val()
			                };
			    $.ajax({
			        data:  parametros,
			        url:   '../Controller/ComprasController.php',
			        type:  'post',
			        
			        success:  function (response) {
			            //alert(response);
			            document.getElementById('tabla1').innerHTML=response;
			        },
			        error: function (error) {
			        alert('error; ' + eval(error));
			        }
			    });
		}else{
			CargarEstado( $("#select option:selected").val());
		}
		
	}

	$(document).on('change', '#select', function(event) {
		CargarEstado($("#select option:selected").val());
	});

	function CargarEstado(estado) {
		var parametros = {
	                    "btnCargarReferenciasTerminadas" : 'true',
	                    "estado" : estado
	                };
	    $.ajax({
	        data:  parametros,
	        url:   '../Controller/ComprasController.php',
	        type:  'post',
	        
	        success:  function (response) {
	            //alert(response);
	            document.getElementById('tabla1').innerHTML=response;
	        },
	        error: function (error) {
	        alert('error; ' + eval(error));
	        }
	    });
	}
	/* Carga inicial de las compras del año */
	function GetEncabezadoCompraProductos(){
		var parametros = {
			"btnGetEncabezadoCompraProductos" : 'true'
		};
		$.ajax({
			data:  parametros,
			url:   '../Controller/ProductosController.php',
			type:  'post',
			success:  function (response) {
				console.log(response+'see');
				var JsonData=JSON.parse(response);
				var ddlEncabezadoCompra=document.getElementById('ddlEncabezadoCompra');
				console.log(JsonData);
				ddlEncabezadoCompra.innerHTML='';
				if(JsonData['Success']){
					for(var i=0;i<=JsonData['Data'].length-1;i++){
						var OptionSelect=document.createElement("option");
						OptionSelect.text=JsonData['Data'][i]['strDescripcion'];
						OptionSelect.value=JsonData['Data'][i]['strIdCompra'];
						ddlEncabezadoCompra.add(OptionSelect);
					}
				}else{
					document.getElementById('ddlEncabezadoCompra').innerHTML=`<option>No hay compras registradas este año.</option>`;
				}
			},
			error: function (error) {
				alert('error; ' + eval(error));
			}
		});
	}
	//Evento modal cerrar
	DivContenedorModal=document.getElementById('Contenedor-Modal');
	DivContenedorModal.addEventListener('click',(Click) => {
		console.log(Click.target.id);
		if(Click.target.id=='Contenedor-Opaco'){
			DivContenedorModal.classList.remove('Efecto-Modal-Abrir');
		}
	});
	/*Validación modal si descarga el excel de los productos ya liquidados */
	function ValidarDescargaXlsProductos(){
		var DivContenedorModal=document.getElementById('Contenedor-Modal');
		DivContenedorModal.classList.add('Efecto-Modal-Abrir');
	}
	/*Confirmación de la descarga de los productos finalizados */
	function DescargarXlsProductos(){
		document.getElementById('frmDescargarXlsProductos').submit();
		DivContenedorModal.classList.remove('Efecto-Modal-Abrir');
	}
</script>

