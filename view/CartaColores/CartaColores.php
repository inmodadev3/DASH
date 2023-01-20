<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-default text-center" style="padding: 0px;">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-10">
							<label>Crear Carta Colores</label>
							<input type="text" class="form-control" placeholder="Nombre Carta Color" id='txtNbmCartaColores' ><br>
							<input type="text" class="form-control" placeholder="Referencia" id='txtReferenciaAsociar'><br>
							<select class="form-control" id='ddlPresentacion'></select>
						</div>
						<div class="col-lg-2">
							<br>
							<button class="form-control btn-default" id='btnCrearCartaColores' title='Crear Carta Colores' style="margin-top: 5px;" onclick="CrearCartaColores();"><i class="glyphicon glyphicon-plus"></i></button>


							<button title="Confirmar editar" class="form-control btn-default" style="margin-top: 5px;display: none;"  id='btnEditarCartaColores' onclick="EditarCartaColores()"><i class="glyphicon glyphicon-check"></i></button>
							<button title='Cancelar editar' class="form-control btn-default"   id='btnCancelarEditarCartaColores' style="margin-top: 5px;display: none;" onclick="CancelarEditarCartaColores();"><i class="glyphicon glyphicon-remove" ></i></button>
							<button title='Buscar Presentacion' class="form-control btn-default"   id='btnBuscarPresentacion' style="margin-top: 5px;" onclick="PresentacionPorProducto('')"><i class="glyphicon glyphicon-search"  ></i></button>
							<label style="display: none" id='lblCartaColores'></label>

						</div>
					</div>
					<hr>
					<input type="text" class="form-control" placeholder="Buscar" id='txtBuscarCartaColores'>
					<div style="overflow-y: scroll;height: 300px;">
						<table class="table table-striped" id='tblCartaColores'>
							<thead>
								<th class="text-center">Código</th>
								<th class="text-center" style="width: 10px;">Descripción</th>
								<th class="text-center">Referencia</th>
								<th class="text-center">Presentación</th>
								<th class="text-center">Fecha Creación</th>
								<th class="text-center">Fecha Modificación</th>
								<th class="text-center">Acción</th> 
							</thead>
							<tbody id='tblBodyCartaColores'>

							</tbody>
						</table>  
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="panel panel-default text-center" style="padding: 0px;">
				<div class="panel-body">
					<label>Colores HGI</label>
					<input type="text" placeholder="Buscar" class="form-control" id='txtBuscarColores' >
					<div style="overflow-y: scroll;height: 380px;">
						<table class="table table-striped" id='tblColores'>
							<thead>
								<th class="text-center">Código</th>
								<th class="text-center">Descrición</th>
								<th class="text-center">Acción</th> 
							</thead>
							<tbody id='tblBodyColores'>
								<tr><td><h4><strong>No ha seleccionado una carta de color.</strong></h4></td></tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default text-center" style="padding: 0px;">
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-12">
					<h4><label>Color</label><br>
						<label id='lblIdCartaColores' style="display: none;"></label>
						<label id='lblCartaColorDescripcion'></label>
					</h4>
					<input type="text" placeholder="Buscar" class="form-control" id='txtBuscarDtColores'>
					<div style="height: 400px; overflow-y: scroll;">
						<table class="table table-striped">
							<thead>
								<th class="text-center">Código</th>
								<th class="text-center">Descripción</th>
								<th class="text-center">Cantidad</th>
								<th class="text-center">Acción</th>
							</thead>
							<tbody id='tblBodyDetalleCartaColores'>
								<tr><td><h4><strong>Seleccione una carta de colores.</strong></h4></td></tr>
							</tbody>
						</table>
					</div>
				</div>  
			</div>
		</div>
	</div>
	<script type="text/javascript">
		//Crear Carta Colores
		ListarCartaColores(); 
		function CrearCartaColores(){
			var txtNbmCartaColores=document.getElementById('txtNbmCartaColores');
			var txtReferenciaAsociar=document.getElementById('txtReferenciaAsociar');
			var ddlPresentacion=document.getElementById('ddlPresentacion');
			if(txtNbmCartaColores.value.trim()===''){
				txtNbmCartaColores.focus();
				swal('Ingrese nombre de la carte de colores.');	
				return;
			}
			if(txtReferenciaAsociar.value.trim()===''){
				txtReferenciaAsociar.focus();
				swal('Ingrese referencia para asociar.');
				return;
			}
			if(ddlPresentacion.value.trim()==''){
				swal('Seleccione presentación del producto.');
				return;
			}
			var parametros = {
				"btnCrearCartaColores" : 'true',
				"txtDescripcionCarta": txtNbmCartaColores.value.trim(),
				"txtIdReferencia": txtReferenciaAsociar.value.trim(),
				"strPresentacion" : ddlPresentacion.value.trim()
			};
			$.ajax({
				data:  parametros,
				url:   '../Controller/CartaColoresController.php',
				type:  'post',
				success:  function (response) {
					var data = JSON.parse(response);
					swal(data);
					ListarCartaColores();
					document.getElementById('txtNbmCartaColores').value='';
					document.getElementById('txtReferenciaAsociar').value='';
					ddlPresentacion.innerHTML='';
					document.getElementById('tblBodyColores').innerHTML="<tr><td><h4><strong>No ha seleccionado una carta de color.</strong></h4></td></tr>";
					document.getElementById('tblBodyDetalleCartaColores').innerHTML="<tr><td><h4><strong>Seleccione una carta de colores.</strong></h4></td></tr>";
					document.getElementById('lblCartaColorDescripcion').innerHTML='';
				},
				error: function (error) {
					alert('error; ' + eval(error));
				}
			});
		}
		function ListarCartaColores(){
			var parametros = {
				"btnListarCartaColores" : 'true'
			};
			$.ajax({
				data:  parametros,
				url:   '../Controller/CartaColoresController.php',
				type:  'post',
				success:  function (response) { 
					var data = JSON.parse(response);
					if(data==''){
						document.getElementById('tblBodyCartaColores').innerHTML='<tr><td><h4><strong>No hay carta de colores creada.</strong></h4></td></tr>';
						return;
					}
					document.getElementById('tblBodyCartaColores').innerHTML='';
					data.forEach(function(row){
						html =  '<tr> '+
						'<td>'+row.intIdCartaColores+'</td>'+
						'<td>'+row.strDescripcionPlCl+'</td>'+
						'<td>'+row.strIdProducto+'</td>'+
						'<td>'+row.strPresentacion+'</td>'+
						'<td>'+row.dtFechaCreacion+'</td>'+
						'<td>'+row.dtFechaModificacion+'</td>'+
						"<td><button title='Editar' class='btn btn-default' onclick='EditarEstadoCartaColores("+row.intIdCartaColores+",\""+row.strDescripcionPlCl+"\",\""+row.strIdProducto+"\",\""+row.strPresentacion+"\")'><i class='glyphicon glyphicon-pencil'></i></button><button title='Seleccionar' onclick='ListarColoresPorProductoHGI(\""+row.strIdProducto+"\",\""+row.strDescripcionPlCl+"\","+row.intIdCartaColores+")' class='btn btn-default'><i class='glyphicon glyphicon-check'></i></button><button class='btn btn-default' title='Eliminar' onclick='ValidacionEliminarCartaColor("+row.intIdCartaColores+",\""+row.strDescripcionPlCl+"\")'><i class='glyphicon glyphicon-remove' ></i></button></td>"+
						'</tr>';
						$('#tblBodyCartaColores').append(html);  
					});
				},
				error: function (error) {
					alert('error; ' + eval(error));
				}
			});
		}
		//Editar carta colores
		 function EditarEstadoCartaColores(intIdCartaColores,strNbmCartaColores,strReferenciaAsociada,strPresentacion){

			document.getElementById('lblCartaColores').innerHTML=intIdCartaColores;
			document.getElementById('btnCrearCartaColores').style.display='none';
			document.getElementById('btnEditarCartaColores').style.display='inline';
			document.getElementById('btnCancelarEditarCartaColores').style.display='inline';
			document.getElementById('txtNbmCartaColores').value=strNbmCartaColores;
			document.getElementById('txtNbmCartaColores').focus();
			document.getElementById('txtReferenciaAsociar').value=strReferenciaAsociada;
			document.getElementById('txtReferenciaAsociar').disabled=true;

			 PresentacionPorProducto(strPresentacion);


		}
		//Editar carta colores

		function EditarCartaColores(){

			var lblCartaColores = document.getElementById('lblCartaColores');
			var strNombreCartaColores = document.getElementById('txtNbmCartaColores');
			var ddlPresentacion=document.getElementById('ddlPresentacion');
			if(strNombreCartaColores.value.trim()==''){
				swal('Ingrese nombre de la carta de color a modificar.');
				strNombreCartaColores.focus();
				return;
			}
			var parametros = {
				"btnEditarCartaColores" : 'true',
				"intIdCartaColores" : lblCartaColores.innerHTML.trim(),
				"strDescripcion" : strNombreCartaColores.value.trim(),
				"strPresentacion" : ddlPresentacion.value.trim()
			};
			$.ajax({
				data:  parametros,
				url:   '../Controller/CartaColoresController.php',
				type:  'post',
				success:  function (response) {
					ListarCartaColores();
					CancelarEditarCartaColores();
					document.getElementById('tblBodyColores').innerHTML="<tr><td><h4><strong>No ha seleccionado una carta de color.</strong></h4></td></tr>";
					document.getElementById('tblBodyDetalleCartaColores').innerHTML="<tr><td><h4><strong>Seleccione una carta de colores.</strong></h4></td></tr>";
					document.getElementById('lblCartaColorDescripcion').innerHTML='';
				},
				error: function (error) {
					alert('error; ' + eval(error));
				}
			});
		}
		//Verifica si se elimina una compañia
		function ValidacionEliminarCartaColor(intIdCartaColores,strDesCartaColor){
			Swal.fire({
				title: 'Desea eliminar la carta de color '+strDesCartaColor+'?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si',
				cancelButtonText: 'No'
			}).then((result) => {
				if (result.value) {
			      //Elimina compañia
			      EliminarCartaColores(intIdCartaColores);
			  }
			})
		}
		//Editar carta colores
		function EliminarCartaColores(intIdCartaColores){

			var parametros = {
				"btnEliminarCartaColores" : 'true',
				"intIdCartaColores" : intIdCartaColores
			};
			$.ajax({
				data:  parametros,
				url:   '../Controller/CartaColoresController.php',
				type:  'post',
				success:  function (response) {
					ListarCartaColores();
					CancelarEditarCartaColores();
					document.getElementById('tblBodyColores').innerHTML='<tr><td><h4><strong>No ha seleccionado una carta de color.</strong></h4></td></tr>';
					document.getElementById('tblBodyDetalleCartaColores').innerHTML='<tr><td><h4><strong>Seleccione una carta de colores.</strong></h4></td></tr>';
					document.getElementById('lblCartaColorDescripcion').innerHTML='';

				},
				error: function (error) {
					alert('error; ' + eval(error));
				}
			});
		}
		//Listar colores por producto HGI
		function ListarColoresPorProductoHGI(intIdRefHGI,strDescripcionCartaColor,intIdCartaColores){

			var parametros = {
				"btnListarColoresPorProductoHGI" : 'true',
				"intIdRefHGI" : intIdRefHGI
			};
			$.ajax({
				data:  parametros,
				url:   '../Controller/CartaColoresController.php',
				type:  'post',
				success:  function (response) {
					var data = JSON.parse(response);
					document.getElementById('tblBodyColores').innerHTML='';
					if(data==''){
						document.getElementById('lblCartaColorDescripcion').innerHTML=strDescripcionCartaColor;
						$('#tblBodyColores').append("<tr><td><h4><strong>No hay colores para la carta "+strDescripcionCartaColor+"</strong></h4></td></tr>");
						document.getElementById('tblBodyDetalleCartaColores').innerHTML=
						'<tr><h4><strong>No hay colores en la carta.</strong><h4></tr>';
						return;		
					}
					data.forEach(function(row){
						html =  '<tr> '+
						'<td>'+row.StrIdColor+'</td>'+
						'<td>'+row.StrColor+'</td>'+
						'<td><button title="Seleccionar" class="btn btn-default" onclick="CantColorSeleccion(\''+row.StrIdColor+'\',\''+row.StrColor+'\',\''+strDescripcionCartaColor+'\',\''+intIdCartaColores+'\')"><i class="glyphicon glyphicon-check" ></i></button></td>'+
						'</tr>';
						$('#tblBodyColores').append(html);
					});
					document.getElementById('lblCartaColorDescripcion').innerHTML=strDescripcionCartaColor;
					ListarDetallCartaColores(intIdCartaColores,strDescripcionCartaColor);
				},
				error: function (error) {
					alert('error; ' + eval(error));
				}
			});
		}
		//Pedir cantidad del color a asignar
		function CantColorSeleccion(strIdColor,strDescripcionColor,strDescripcionCartaColor,intIdCartaColores){
			Swal.fire({
				title: 'Ingrese cantidad del color '+strDescripcionColor+' para la carta '+strDescripcionCartaColor,
				html: "<input type='text' id='txtCantColorPorCartaColor' placeholder='Cantidad' class='form-control'>",
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si',
				cancelButtonText: 'No'
			}).then((result) => {
				if (result.value) {
					document.getElementById('lblCartaColorDescripcion').innerHTML=strDescripcionCartaColor;
					var intCantColor=document.getElementById('txtCantColorPorCartaColor').value.trim();
					AgregarColorACartaColores(intIdCartaColores,strIdColor,strDescripcionColor,intCantColor);

				}
			})
		}
		//Seleccionar color HGI
		function AgregarColorACartaColores(intIdCartaColores,strIdColor,strDescripcion,intCantColor){
			var parametros = {
				"btnAgregarColorACartaColores" : 'true',
				"intIdCartaColores" : intIdCartaColores,
				"strIdColor" : strIdColor,
				"strDescripcion" : strDescripcion,
				"intCantColor" : intCantColor
			};
			$.ajax({
				data:  parametros,
				url:   '../Controller/CartaColoresController.php',
				type:  'post',
				success:  function (response) {
					var data = JSON.parse(response);
					swal(data);
					var strDescripcionCartaColor=document.getElementById('lblCartaColorDescripcion');
					ListarDetallCartaColores(intIdCartaColores,strDescripcionCartaColor.innerHTML.trim());
				},
				error: function (error) {
					alert('error; ' + eval(error));
				}
			});
		}
		//Cancelar editar carta colores
		function CancelarEditarCartaColores(){
			document.getElementById('lblCartaColores').innerHTML='';
			document.getElementById('btnCrearCartaColores').style.display='inline';
			document.getElementById('btnEditarCartaColores').style.display='none';
			document.getElementById('btnCancelarEditarCartaColores').style.display='none';
			document.getElementById('txtNbmCartaColores').value='';
			document.getElementById('txtReferenciaAsociar').value='';
			document.getElementById('txtReferenciaAsociar').disabled=false;
			document.getElementById('ddlPresentacion').innerHTML='';
		}

		//Listar detalle de la carta de colores
		function ListarDetallCartaColores(intIdCartaColores,strDescripcionCartaColor){
			var parametros = {
				"btnListarDetallCartaColores" : 'true',
				"intIdCartaColores" : intIdCartaColores
			};
			$.ajax({
				data:  parametros,
				url:   '../Controller/CartaColoresController.php',
				type:  'post',
				success:  function (response) {
					var data = JSON.parse(response);
					document.getElementById('tblBodyDetalleCartaColores').innerHTML='';
					if(data==''){
						$('#tblBodyDetalleCartaColores').append("<tr><td><h4><strong>No hay colores asignados.</strong></h4></td></tr>");
						return;		
					}
					data.forEach(function(row){
						html =  '<tr> '+
						'<td>'+row.strIdColor+'</td>'+
						'<td>'+row.strDescripcion+'</td>'+
						'<td>'+row.strCantColor+'</td>'+
						'<td><button title="Seleccionar" class="btn btn-default" onclick="EliminarColorDeCarta(\''+row.intIdDetallCartaColores+'\',\''+strDescripcionCartaColor+'\',\''+intIdCartaColores+'\')"><i class="glyphicon glyphicon-remove" ></i></button></td>'+
						'</tr>';
						$('#tblBodyDetalleCartaColores').append(html);
					});
					document.getElementById('lblCartaColorDescripcion').innerHTML=strDescripcionCartaColor;
				},
				error: function (error) {
					alert('error; ' + eval(error));
				}
			});
		}
			//Seleccionar color HGI
			function EliminarColorDeCarta(intIdDetallCartaColores,strDescripcionCartaColor,intIdCartaColores){
				var parametros = {
					"btnEliminarColorDeCarta" : 'true',
					"intIdDetallCartaColores" : intIdDetallCartaColores
				};
				$.ajax({
					data:  parametros,
					url:   '../Controller/CartaColoresController.php',
					type:  'post',
					success:  function (response) {

						ListarDetallCartaColores(intIdCartaColores,strDescripcionCartaColor);
					},
					error: function (error) {
						alert('error; ' + eval(error));
					}
				});
			}
			//Presentacion por producto HGI
			function PresentacionPorProducto(strPresentacion){
				var strIdReferencia=document.getElementById('txtReferenciaAsociar');
				if(strIdReferencia.value.trim()==''){
					swal("Ingrese la referencia para buscar su presentación");
					return;
				}
				var parametros = {
					"btnPresentacionPorProducto" : 'true',
					"strIdReferencia" : strIdReferencia.value.toUpperCase().trim()
				};
				$.ajax({
					data:  parametros,
					url:   '../Controller/CartaColoresController.php',
					type:  'post',
					success:  function (response) {
						var strData= JSON.parse(response);
						if(strData==''){
							swal("No existe la referencia para su presentación.");
							document.getElementById('ddlPresentacion').innerHTML='';
						}else{
							document.getElementById('ddlPresentacion').innerHTML='';
							strData.forEach(function(row){
								html="<option value='"+row.StrUnidad+"'>"+row.StrUnidad+"</option>";
								$('#ddlPresentacion').append(html);
							});
							if(strPresentacion!=''){	
								$("#ddlPresentacion option[value="+ strPresentacion +"]").attr("selected",true);
							}
						}
					},
					error: function (error) {
						alert('error; ' + eval(error));
					}
				});
			}
		  //Busqueda dt Compañia
		  $(document).ready(function () {
		  	(function ($) {
		  		$('#txtBuscarCartaColores').keyup(function () {      
		  			var rex = new RegExp($(this).val(), 'i');
		  			$('#tblBodyCartaColores tr').hide();
		  			$('#tblBodyCartaColores tr').filter(function () {
		  				return rex.test($(this).text());
		  			}).show();
		  		})
		  	}(jQuery));
		  });
		  $(document).ready(function () {
		  	(function ($) {
		  		$('#txtBuscarColores').keyup(function () {      
		  			var rex = new RegExp($(this).val(), 'i');
		  			$('#tblBodyColores tr').hide();
		  			$('#tblBodyColores tr').filter(function () {
		  				return rex.test($(this).text());
		  			}).show();
		  		})
		  	}(jQuery));
		  });
		</script>