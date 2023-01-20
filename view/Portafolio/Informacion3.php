<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==31){
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
	.swal2-container {
     zoom : 1.4 ;
     -moz-transform: scale(1.4);
    }

	.progress-circle.indefinite .progress {
	  stroke: #9e9e9e;
	  stroke-width: 10;
	  stroke-dashoffset: 0;
	  stroke-dasharray: 63 188;
	  animation: progress-indef 2s linear infinite;
	}

	.progress-circle.indefinite .bg {
	  stroke: #eee;
	  stroke-width: 10;
	}

	@keyframes progress-indef {
	  0% { stroke-dashoffset: 251; }
	  100% { stroke-dashoffset: 0; }
	}

	.ExcelDescargado{
		background: #6c757d;
	}
    
</style>
<div id="page-wrapper" style="min-height:100vh;">
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document" style="width: 900px;">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Informacion del pedido</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <ul class="list-group" id="modal-body">
			  
			</ul>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>

  <div class="row" >
	<div class="col-lg-12 align-self-center"  id="div">
		<div class="row" style="">

			<div class="row">
				<div class="col-lg-12">
					<br>
					<button type="button" class="btn btn-primary" onclick="FiltrarInformacion()">Actualizar</button> 
					<?php if ($_SESSION['idLogin'] == 1	|| $_SESSION['idLogin'] == 25) {
						?>
						<form action="../Controller/InformacionPortafolioController.php" style="display: none;" method="POST" id="GenerarInformeExcel">
							<input type="text" name="btnGenerarInformeExcel">
						</form>
						<button type="button" style="display: none" class="btn btn-primary" onclick="DescargarInforme();">Informe</button>
					<?php 
					} ?>
					<br><br>
					<div class="panel panel-default">
					  <div class="panel-heading text-center"  id="prueba">Proceso de pedidos</div>
					  	
					  <div class="panel-body">
					  	<div id="TblArchivos">
							  
							  <!-- Table -->
							  	<div class="row">
							  		<div class="col-lg-8">
							  			<div class="input-group">
									  	  <span class="input-group-addon">
									  	  	<i class="fa fa-search"></i>
									  	  </span>
									      <input type="text" id="buscar" class="form-control" placeholder="Filtrar...">
									      
									    </div><br>
							  		</div>
							  		<div class="col-lg-2">
						  				<div class="form-group">
										    <select class="form-control" id="SelectYear" onchange="FiltrarInformacion()">
										      <option value="2018">2018</option>
										      <option value="2019">2019</option>
										      <option value="2020">2020</option>
										      <option value="2021">2021</option>
										      <option value="2022">2022</option>
										    </select>
										</div><br>
					  				</div>
						  			<div class="col-lg-2">
						  				<div class="form-group">
										    <select class="form-control" id="SelectMonth" onchange="FiltrarInformacion()">
										      <option value="1">Enero</option>
										      <option value="2">Febrero</option>
										      <option value="3">Marzo</option>
										      <option value="4">Abril</option>
										      <option value="5">Mayo</option>
										      <option value="6">Junio</option>
										      <option value="7">Julio</option>
										      <option value="8">Agosto</option>
										      <option value="9">Septiembre</option>
										      <option value="10">Octubre</option>
										      <option value="11">Noviembre</option>
										      <option value="12">Diciembre</option>
										    </select>
										</div><br>
						  			</div>
							  	</div>
							    <div style="overflow-y: scroll;height:340px; ">
							    	<div id="carga2">
							   			<center>
										<svg class="progress-circle indefinite" width="100" height="100">
										  <g transform="rotate(-90,50,50)">
										    <circle class="bg" r="20" cx="50" cy="50" fill="none"></circle>
										    <circle class="progress" r="20" cx="50" cy="50" fill="none"></circle>
										  </g>
										</svg>
										</center>
							   		</div>
							    	<table class="table table-bordered"   id="tabla" style="display: none;">
								   	<thead>
								   		<th>Pedido</th>
								   		<th>Cliente</th>
								   		<th>Vendedor</th>
								   		<th>Fecha Creacion</th>
								   		<th>Fecha Finalizacion</th>
								   		<th>Valor Total</th>
								   		<th>Observaciones</th>
								   		<th>Acciones</th>
								   	</thead>
								   	<tbody id="tbody">
								   		
								   	</tbody>
								  </table>
							    </div>
							  
					  	</div>
					  </div>
					</div>
					
					<div class="panel panel-default">
					  <div class="panel-heading text-center"  id="prueba1">Portafolios compartidos</div>
					  	
					  <div class="panel-body">
					  	<div id="TblArchivos">
					  		<div class="row">
					  			<div class="col-lg-12">
					  				<div class="input-group">
								  	  <span class="input-group-addon">
								  	  	<i class="fa fa-search"></i>
								  	  </span>
								      <input type="text" id="buscar1" class="form-control" placeholder="Filtrar...">
								    </div>
								    <br>
					  			</div>
					  		</div>
							    <div style="overflow-y: scroll;height:340px; ">
							    	<div id="carga1">
							   			<center>
										<svg class="progress-circle indefinite" width="100" height="100">
										  <g transform="rotate(-90,50,50)">
										    <circle class="bg" r="20" cx="50" cy="50" fill="none"></circle>
										    <circle class="progress" r="20" cx="50" cy="50" fill="none"></circle>
										  </g>
										</svg>
										</center>
							   		</div>
							    	<table class="table table-bordered" id="tabla1" style="display: none;">
								   	<thead>
								   		<th>Link</th>
								   		<th>Nombre Portafolio</th>
								   		<th>Cedula cliente</th>
								   		<th>Nombre cliente</th>
								   		<th>Nombre vendedor</th>
								   		<th>Descripcion</th>
								   		<th>Compartido</th>
								   		<th>Visto</th>
								   		<th>Ultima visita</th>
								   	</thead>
								   	<tbody id="tbody1">
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
  </div>
</div>

<script>

	var d = new Date();
	$( "#SelectMonth" ).val(d.getMonth()+1);
	$( "#SelectYear" ).val(d.getFullYear());
	ListarPortafolioTercero($( "#SelectMonth" ).val(), $( "#SelectYear" ).val());
	ListarDetallePortafolioPedido($( "#SelectMonth" ).val(), $( "#SelectYear" ).val());
	
	function FiltrarInformacion() {
		ListarPortafolioTercero($( "#SelectMonth" ).val(), $( "#SelectYear" ).val());
		ListarDetallePortafolioPedido($( "#SelectMonth" ).val(), $( "#SelectYear" ).val());
	}

	//Mostrar todos los portafolios compartidos
	function ListarPortafolioTercero(mes, año) {
	var parametros = {
                        "btnListarPortafolioTercero" : 'true',
                        "mes" : mes,
                        "año" : año
                    };
  		$.ajax({
                        data:  parametros,
                        url:   '../Controller/InformacionPortafolioController.php',
                        type:  'post',
                        
                        success:  function (response) {

                           document.getElementById('tbody1').innerHTML=response;
                           document.getElementById('carga1').style="display:none";
                           document.getElementById('tabla1').style="display:inline-block";
                        },
                        error: function (error) {
                        alert('error; ' + eval(error));
                        }
                });
	}

	//Mostrar todos los pedidos iniciados, finalizados o en progreso
	function ListarDetallePortafolioPedido(mes, año) {
		var parametros = {
                            "btnListarDetallePortafolioPedido" : 'true',
                        	"mes" : mes,
                        	"año" : año

                        };
      					$.ajax({
                            data:  parametros,
                            url:   '../Controller/InformacionPortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {

                               document.getElementById('tbody').innerHTML=response;
                           	   document.getElementById('carga2').style="display:none";
                               document.getElementById('tabla').style="display:inline-block";
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}


	function HabilitarPedido(strIdTercero, intIdPortafolio, intIdPortafolioTercero){
		var parametros = {
                            "btnHabilitarPedido" : 'true',
                            "strIdTercero" : strIdTercero,
                            "intIdPortafolio" : intIdPortafolio,
                            "intIdPortafolioTercero" : intIdPortafolioTercero
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/InformacionPortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                            	if (response == 1) {
                            		Swal({
									  position: 'top-end',
									  type: 'success',
									  title: 'Portafolio activado',
									  showConfirmButton: false,
									  timer: 1500
									})
                            		ListarDetallePortafolioPedido($( "#SelectMonth" ).val(), $( "#SelectYear" ).val());
                            	}else{
                            		Swal.fire(
									  'Informacion?',
									  'Pedido finalizado',
									  'question'
									);
                            	}
                            	
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}

	function AbrirPortafolio(IdPortafolio){
		//alert(IdPortafolio);
		window.location="https://www.inmodafantasy.com.co/DASH/view/index.php?menu=portafolios&id="+IdPortafolio;
		//window.location="http://localhost/DASH/view/index.php?menu=portafolios&id="+IdPortafolio;
		//http://localhost/DASH/view/index.php?menu=infoPortafolio
		//alert(IdPortafolio);
	}
	function VisualizarPedido(IdPedido){
		var parametros = {
                            "btnVisualizarPedido" : 'true',
                            "IdPedido" : IdPedido
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/InformacionPortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                            	document.getElementById("modal-body").innerHTML = response;
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}
	function ConsultarIngresoPortafolio(codigo, IdTercero) {
		var parametros = {
                            "LinkArchivoIni" : 'true'
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/InformacionPortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                            	response = 'http://www.inmodafantasy.com.co/Web/View/'+'?code='+codigo;
                            	Swal({
                            		html: "Informacion para el ingreso al portafolio link: <a href='"+response+"' target='_blank'>"+response+"</a> Identificacion: "+IdTercero
                            	});
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });


		
	}
	//Se actualiza el estado del pedido (estado = 2) y se descarga el excel
	function GenerarExcel(IdPortafolio) {
		var parametros = {
                            "actualizarEstadoPedidoCliente" : 'true',
                            "intId" : IdPortafolio
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/InformacionPortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                            	console.log(response);
                            	ListarPortafolioTercero(d.getMonth()+1,d.getFullYear());
                            	ListarDetallePortafolioPedido(d.getMonth()+1,d.getFullYear());
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
		document.getElementById('excel'+IdPortafolio).submit();
	}


	function ActualizarVigenciaPortafolio(intIdPortafolio, strIdTercero, intIdPortafolioTercero){
		var parametros = {
            "btnActualizarVigenciaPortafolio" : 'true',
            "intIdPortafolio" : intIdPortafolio,
            "strIdTercero" : strIdTercero,
            "intIdPortafolioTercero" : intIdPortafolioTercero
        };
      $.ajax({
		        data:  parametros,
		        url:   '../Controller/InformacionPortafolioController.php',
		        type:  'post',
		        
		        success:  function (response) {
		        	if (response == 1) {
		        		Swal({
						  position: 'top-end',
						  type: 'success',
						  title: 'Portafolio actualizado',
						  showConfirmButton: false,
						  timer: 1500
						})
		        	}else{
		        		Swal({
						  position: 'top-end',
						  type: 'warning',
						  title: 'Portafolio con fecha disponible',
						  showConfirmButton: false,
						  timer: 1500
						})
		        	}
		        },
		        error: function (error) {
		        alert('error; ' + eval(error));
		        }
		});
	}

	function DescargarInforme() {
		document.getElementById("GenerarInformeExcel").submit();
	}

	/*Filtrar datos en la tabla de clientes*/
	document.querySelector("#buscar").onkeyup = function(){
        $TableFilter("#tabla", this.value);
    }
    
    $TableFilter = function(id, value){
        var rows = document.querySelectorAll(id + ' tbody tr');
        
        for(var i = 0; i < rows.length; i++){
            var showRow = false;
            
            var row = rows[i];
            row.style.display = 'none';
            
            for(var x = 0; x < row.childElementCount; x++){
                if(row.children[x].textContent.toLowerCase().indexOf(value.toLowerCase().trim()) > -1){
                    showRow = true;
                    break;
                }
            }
            
            if(showRow){
                row.style.display = null;
            }
        }
    }
    /*Filtrar datos en la tabla de clientes*/

    /*Filtrar datos en la tabla de Portafolio compartidos*/
	document.querySelector("#buscar1").onkeyup = function(){
        $TableFilter("#tabla1", this.value);
    }
    
    $TableFilter = function(id, value){
        var rows = document.querySelectorAll(id + ' tbody tr');
        
        for(var i = 0; i < rows.length; i++){
            var showRow = false;
            
            var row = rows[i];
            row.style.display = 'none';
            
            for(var x = 0; x < row.childElementCount; x++){
                if(row.children[x].textContent.toLowerCase().indexOf(value.toLowerCase().trim()) > -1){
                    showRow = true;
                    break;
                }
            }
            
            if(showRow){
                row.style.display = null;
            }
        }
    }
    /*Filtrar datos en la tabla de Portafolio compartidos*/
    

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
		if (result.dismiss === swal.DismissReason.timer) {}
	}); 
</script>
