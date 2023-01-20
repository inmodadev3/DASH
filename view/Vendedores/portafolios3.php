<?php
   if (isset($_SESSION['idportafolio'])) {
		$session_value = $_SESSION['idportafolio'];
	}else{
		$session_value = "0";
	}
	 $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==30){
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
body { padding-right: 0 !important }
		.padd{
			padding-right: 0px;
		}
		.span{
			background: #4c7dd1;
			border: 1px solid #4c7dd1;
		}
		.portafolio{
			display: inline-block;height: 165px; width: 114px; padding : 5px; text-align: center;
		}
		.portafolio:hover{
			cursor:pointer;
			-webkit-border-radius: 10px 10px;
			-webkit-transform:scale(1.03);transform:scale(1.07);
		}
		.portafoliod{
			display: inline-block; background-color:#448bff; border-radius: 10px 10px; height: 170px; width: 116px; padding :5px; text-align: center;
		}
		
		.ocultar{
			display: none; 
		}
		.info{
			width: 40px;
			height: 30px;
			margin-top: -6px;

		}
		/*ESTILO PARA NUMERO DE FOTOS*/
		.ruta{
			color: #428bca;
			cursor: pointer;
		}
		/*ESTILO PARA NUMERO DE FOTOS*/

		/*ESTILO PARA NUMERO DE FOTOS*/
		.notify{
			border-radius: 127px;
			border: 0px solid #000000;
			border-color: #ffff;
		  	background-color: red;
		  	float: right;
		  	width: 40px;
		  	color: #ffff;
		  }
		/*ESTILO PARA NUMERO DE FOTOS*/

		/*ESTILO PARA EL CHECKBOX*/
		
		.option-input {
		  -webkit-appearance: none;
		  -moz-appearance: none;
		  -ms-appearance: none;
		  -o-appearance: none;
		  appearance: none;
		  position: relative;

		  float: right;

		  z-index: 100;
		  outline: none;
		  height: 35px;
		  padding-top: 70px;
		  padding-left: 70px;
		  padding-right: 70px;

		  top: 67px;
		  bottom: 0;
		  left: -4px;
		  height: 25px;
		  width: 25px;
		  transition: all 0.15s ease-out 0s;
		  background: #cbd1d8;
		  border-style: solid;
		  border-width: 0.5px;
		  border-radius: 2px;
		  border-width: 0.5px;
		  /*border-color: #000;*/
		  color: #fff;
		  cursor: pointer;
		  display: inline-block;
		  margin-right: 0.5rem;
		  position: relative;
		  z-index: 1000;
		}
		.option-input:hover {
		  background: #9faab7;
		}
		.option-input:checked {
		  background: #007bff;
		}
		.option-input:indeterminate::before{
		  height: 23px;
		  width: 24px;

		  position: absolute;
		  content: '◼';
		  display: inline-block;
		  background: #007bff;
		  font-size: 20px;
		  text-align: center;		}
		.option-input:indeterminate::after{
		  background: #40e0d0;
		  content: '';
		  display: inline-block;
		  position: relative;
		  z-index: 100;
		}
		.option-input:checked::before {
		  height: 25px;
		  width: 25px;
		  position: absolute;
		  content: '✔';
		  display: inline-block;
		  font-size: 22px;
		  text-align: center;
		  line-height: 25px;
		}
		.option-input:checked::after {

		  background: #007bff;
		  content: '';
		  display: inline-block;
		  position: relative;
		  z-index: 100;
		}
		/*ESTILO PARA EL CHECKBOX*/
		
		/*ESTILO PARA EL MENU CLICK DERECHO*/
		.menus{
			width: 250px;
			height: auto;
		}
		.menus ul li:hover{
			background: #eee;
			border-left: 4px solid #666;
		}
		.menus{
		      position:absolute;      
		      /*border:1px solid black;*/
		      z-index: 100000;
		}
		/*ESTILO PARA EL MENU CLICK DERECHO*

		/*ESTILO PARA LAS IMAGENES*/
		.image:hover{
			cursor:pointer;
			background-color: #bcd6ff;
			-webkit-border-radius: 10px 10px;
			-webkit-transform:scale(1.03);transform:scale(1.03);
		}
		/*ESTILO PARA LAS IMAGENES*/
		.contenedor{
		  width:90px;
		  height:240px;
		  position:fixed;
		  right:0px;
		  bottom:0px;

		  z-index: 10000;
		}
		.botonF1{
		  width:60px;
		  height:60px;
		  border-radius:100%;
		  /*background:#F44336;*/
		  right:0;
		  bottom:0;
		  position:fixed;
		  margin-right:16px;
		  margin-bottom:16px;
		  border:none;
		  outline:none;
		  color:#FFF;
		  font-size:36px;
		  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
		  transition:.3s; 
		}
		span{
		  transition:.5s;  
		}
		.botonF1:hover{
			 -webkit-transform:scale(1.05);transform:scale(1.05);
		}
		.botonF1:hover span{
		  transform:rotate(360deg);
		 
		}
		.botonF1:active{
		  transform:scale(1.1);
		}
		.animacionVer{
		  transform:scale(1);
		}
		.swal2-container {
	     zoom : 1.4 ;
	     -moz-transform: scale(1.4);
	    }
	    /*PROGRESS*/
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
	    /*PROGRESS*/
</style>

<!--<script type="text/javascript" src="../public/vendor/jquery/Concurrent.Thread.js"></script>-->

	
<div id="page-wrapper" style="min-height:100vh;">
  <div class="row" >
	<!--Boton Flotante Crear portafolio-->
	<div class="contenedor">
		<button class="botonF1 btn btn-primary" onclick ="AlertCrearPortafolio();" type="button" id="CrearPortafolio">+</button>
		
	</div>
	<!--Boton Flotante Crear portafolio-->

	<!--Menu del portafolio con funcion delclick derecho-->
		<!--Label que guarda el id del portafolio-->
		<label id="IdTemporal" style="display: none;"></label>

		<div class="menus" id="menu" style="display: none;">

			<ul class="list-group">
			  <li id="Abrir" class="list-group-item" onclick="ExpandirPortafolio(document.getElementById('IdTemporal').innerHTML);">Abrir</li>
			  <!--<li id="Eliminar" class="list-group-item" onclick="AlertEliminarPortafolio(document.getElementById('IdTemporal').innerHTML);">Eliminar</li>-->
			  <li id="Renombrar" class="list-group-item" onclick="NombrePortafolio(document.getElementById('IdTemporal').innerHTML)">Renombrar</li>
			</ul>
		</div>
	<!--Menu del portafolio con funcion delclick derecho-->

	<!--Contenido-->
    <div class="col-lg-8 align-self-center"  id="div">

      	<div class="row" style="">

			<!--<div class="col-lg-2" style="border: 1px ; border-style: none dotted none none; height: 100%;" >
				<div style="height: 100%;">
					<input type="text" class="form-control" name="">
				</div>
			</div>-->
			<div class="row">
				<div class="col-lg-10">
					<br>
					<button class="btn btn-default" id="btnHome" style="display: none;" onclick="Home();"><i class="glyphicon glyphicon-home" ></i></button>
									
					<button class="btn btn-default" id="btnBack" style="display: none;" onclick="Back();"><i class="glyphicon glyphicon-chevron-left" ></i></button>
					<!--modal
					<button type="button" id="CrearPortafolio" class="btn btn-primary"><a href="#" data-toggle="modal" data-target="#modal-avisolegal"  style="text-decoration: none; color: #FFFFFF;">Crear Protafolio</a></button>
					modal-->
					<button type='button' class='btn btn-default' onclick="Finalizar(); FiltrarPortafolios();" id="AñadirDetalles" style="display:none;">Finalizar Portafolio</button>

				</div>
			</div>
			
			<!--<label id="RutasAcceso"><a href="#" onclick="Home()" id="Ruta"></a></label> -->
			<div class="row" id="FiltroPortafolio">
				<div class="col-lg-8">
			    <div class="form-group">
			      <input type="text" id="txtFiltro"  placeholder="Filtrar" onkeyup="FiltrarPortafolios();" class="form-control" aria-label="...">
			    </div><!-- /input-group -->
			  </div>
			  <div class="col-lg-2">
  				<div class="form-group">
				    <select class="form-control" id="SelectYear" onchange="FiltrarPortafolios()">
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
				    <select class="form-control" id="SelectMonth" onchange="FiltrarPortafolios()">
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
			<div class="row">
				<div class="col-lg-12">
					<br>
					<div class="panel panel-default">
					  <div class="panel-heading text-center"  id="prueba">
					  	<label id="NombrePortafolio"></label>
					  	<label id="IdPortafolio" style="display: none;"></label>
					  	<label id="IdP" style="display: none;"></label>
					  	<div id="RutasAcceso"></div>
					  </div>
					  <div class="panel-body">
					  	<div id="TblArchivos">

					  	</div>
					  </div>
					</div>
							
							
				</div>
			</div>
		</div>
    </div>
    <!--LISTADO DE TERCEROS-->
    <div id="ListaTerceros" class="col-lg-4 align-self-center">
    	<br>
    	<ul class="list-group">
		  <li class="list-group-item">
		  	<div class="row">
			  <div class="col-lg-12">
			    <div class="input-group">
			    	<span class="input-group-addon">
			        <i class="fa fa-search"></i>
			      </span>
			      <input type="text" id="cliente" class="form-control" placeholder="Filtrar clientes..." onkeyup="FiltrarClienteDB();">
			      
			    </div><!-- /input-group -->
			    <div  style="overflow: scroll;height: 500px;">
				  	<table class="table table-bordered" id="tabla">
						  <tbody id="terceros">
						    
						  </tbody>
					</table>
				  </div>
			  </div><!-- /.col-lg-6 -->
			</div>
		  </li>
		  
		  
		</ul>
    </div>
    <!--LISTADO DE TERCEROS-->

    <!--LISTADO DETALLE TERCERO-->
    <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog  modal-sm modal-lg " role="document">
	    <div class="modal-content" style="width: 800px;">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Informacion detallada</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div>
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
		      <div class="modal-body" style="text-align: center;" id="informacion">
			      	
		      </div>
	      </div>
	  		 
	     
	      <div class="modal-footer">
	      	<button type="button" id="btnModal" style="display: none;" onclick ="DescPortafolioTercero();" class="btn btn-secondary">Enviar</button>
	        <button type="button" class="btn btn-secondary" onclick="PaddingRight()">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!--LISTADO DETALLE TERCERO-->
</div></div>
	<!--Contenido-->
<script type="text/javascript">
	var d = new Date();
	$( "#SelectMonth" ).val(d.getMonth()+1);
	$( "#SelectYear" ).val(d.getFullYear());



	function FiltrarPortafolios() {
		var parametros={
			"evtFiltrarPortafolios" : "true",
			"text" : $("#txtFiltro").val(),
			"mes" : $( "#SelectMonth" ).val(),
			"año" : $( "#SelectYear" ).val()
		};
		$.ajax({
			data:  parametros,
            url:   '../Controller/PortafolioController.php',
            type:  'post',
            success:  function (response) {
            	//alert(response);
            	document.getElementById('TblArchivos').innerHTML=response;
               
            },
            error: function (error) {
            alert('error; ' + eval(error));
            }
		});
	}





	$("#menu").hide();
	function titulo(id,visible){
		if (visible) {
			$('#NomPortafolio'+id).popover('hide');
		}else{
			$('#NomPortafolio'+id).popover('show');
		}
		
	}
	//nuevo
	function FiltrarClienteDB(){
		var NomTercero = $('#cliente').val();
		var parametros={
			"evtFiltrarTercero" : "true",
			"NomTercero" : NomTercero
		};
		$.ajax({
			data:  parametros,
            url:   '../Controller/PortafolioController.php',
            type:  'post',
            success:  function (response) {
            	//alert(response);
            	document.getElementById('terceros').innerHTML=response;
               
            },
            error: function (error) {
            alert('error; ' + eval(error));
            }
		});
	}
	//nuevo
	/*if ($_GET('id')) {
		alert('hola');
	}else{
		alert('adios');
	}*/
	//cuando llege de otra parte no ejecutar finalizar!!!
	//Finalizar();

	//Listar clientes del usuario logeado
	//alert(22);
	//var session = '<%= Session["idportafolio1"] %>';
	var session = <?php echo $session_value; ?>;
   	if(session == "0"){
   		//Finalizar();
   		FiltrarPortafolios();
    	//alert("no existe la session");
   	}
	ListarTerceros();
	var ban = 0;
	function PaddingRight() {
		$('#exampleModal').modal('hide');
		$( "body" ).addClass( "padd");
	}	
	function CopiarTexto(idelemento){
		var codigoACopiar = document.getElementById(idelemento);
	 	codigoACopiar.select();
	    var res = document.execCommand('copy');
	    window.getSelection().removeAllRanges();

	    document.getElementById('btnCopy').innerHTML = "Copiado";
	    var clear = setInterval(function(){ document.getElementById('btnCopy').innerHTML = "Copiar";
	    clearInterval(clear);}, 1000);
	}

document.oncontextmenu = function(){return true}
 
 $(document).click(function(e){
		            $("#menu").css("display", "none");
					document.oncontextmenu = function(){return true}
                  if(e.button == 0){
						//Cuando selecciona el portafolio 'ban = 1' ya que siempre se ejecuta esta funcion y no lo deseleccionara luego cambia 'ban = 0' para que se deseleccione afuera
						if (ban != 1) {
							if (document.getElementById('IdP').innerHTML != '') {
												var v = document.getElementById('IdP').innerHTML;
											
												var portafolio = document.getElementById(v);
												
												portafolio.classList.remove('portafoliod');
												portafolio.classList.add('portafolio');
												var btn = document.getElementsByClassName('select');
												for (var i = btn.length - 1; i >= 0; i--) {
													btn[i].style.display = 'none';
												}
											}
							}
							ban = 0;
						//Ocultamos el menu del click derecho y habilitamos el click derecho
                  }
            });
           



	
	function Mostrar(e, IdPortafolio) {
		//Deshabilitamos click derecho//
		document.getElementById('IdTemporal').innerHTML = IdPortafolio;
		document.oncontextmenu = function(){return false}

		$("#menu").css({'display':'block', 'left':e.pageX, 'top':e.pageY});
		//Colocamos el id al div 

	}
	var sw=1;
	var IdActual = 0;
	oldid=null; 
	function fijo(id,idPortafolio){

		var portafolio = document.getElementById(id);
		var btn = document.getElementsByClassName('select');
		//Deseleccionamos el portafolio anterior y borramos el nombre del portafolio
		if(oldid!=null && oldid!=id){
				document.getElementById(oldid).classList.remove('portafoliod');
				document.getElementById(oldid).classList.add('portafolio');
				document.getElementById('IdPortafolio').innerHTML = '';
				document.getElementById('IdP').innerHTML = "";
				for (var i = btn.length - 1; i >= 0; i--) {
					btn[i].style.display = 'none';
				}
		}
		//Seleccionamos el portafolio la primera vez y guardamos el nombre del portafolio
		if (portafolio.className == 'portafolio') {
				ban = 1;
				IdActual = id;
				portafolio.classList.remove('portafolio');
				portafolio.classList.add('portafoliod');
				document.getElementById('IdPortafolio').innerHTML = idPortafolio;
				document.getElementById('IdP').innerHTML = IdActual;
				for (var i = btn.length - 1; i >= 0; i--) {
					btn[i].style.display = 'inline';
				}
		}else{ //Deseleccionamos el mismo portafolio y borramos el nombre del portafolio
			portafolio.classList.remove('portafoliod');
			portafolio.classList.add('portafolio');
			document.getElementById('IdPortafolio').innerHTML = '';
			document.getElementById('IdP').innerHTML = "";
			for (var i = btn.length - 1; i >= 0; i--) {
				btn[i].style.display = 'none';
			}
		}	

		oldid=id;
		sw=0;
	
	}
	function ListarArchivos(){
		   var parametros = {
                            "btnListarArchivos" : 'true',
                            "NombrePortafolio" : document.getElementById("NombrePortafolio").innerHTML.trim()         
                        };
      $.ajax({
                            data:  parametros,
                            url:    '../Controller/PortafolioController.php',
                            type:  'post',

                            success:  function (response) {
                               document.getElementById('TblArchivos').innerHTML=response; 
                               $("#FiltroPortafolio").css("display","none");
                               	
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}
	//Muestra la ventana para ingresar el nombre del portafolio
	function NombrePortafolio(IdPortafolio) {
		if (document.getElementById('Renombrar')) {
				swal({
				  title: 'Editar nombre del portafolio',
				  input: 'text',
				  inputAttributes: {
				    autocapitalize: 'off',
				    id: 'CambioNomPortafolios'
				  },
				  showCancelButton: true,
				  confirmButtonText: 'Aceptar',
				  showLoaderOnConfirm: true,
				  allowOutsideClick: () => !swal.isLoading()
				}).then((result) => {
				  if (result.value) {
				  	//alert(document.getElementById('IdTemporal').innerHTML);	
				    EditarNombrePortafolio(result.value);
				    /*swal({
				      title: `${result.value.login}'s avatar`,
				      imageUrl: result.value.avatar_url
				    })*/
				  }
				})
		}
		
	}
	//Alert para eliminar portafolio
	function AlertEliminarPortafolio(IdPortafolio){
		swal({
		  title: 'Está seguro?',
		  text: "You won't be able to revert this!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminarlo!'
		}).then((result) => {
		  if (result.value) {
		    EliminarPortafolio(IdPortafolio);
		  }
		})
	}
	//Alert para crear portafolio
	function AlertCrearPortafolio() {
		
		swal({
				  title: 'Nuevo Portafolio',
				  input: 'text',
				  inputAttributes: {
				    autocapitalize: 'off',
				    id: 'title'
				  },
				  showCancelButton: true,
				  confirmButtonText: 'Aceptar',
				  showLoaderOnConfirm: true,
				  allowOutsideClick: () => !swal.isLoading()
				}).then((result) => {
				  if (result.value) {
				  	Agregar();
				  }
				})
	}
	
	//Eliminar portafolio
	function EliminarPortafolio(IdPortafolio){
		var parametros = {
                            "btnEliminarPortafolio" : 'true',
                            "IdPortafolio" :  IdPortafolio
                        };
     					$.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            success:  function (response) {
                               //document.getElementById('TblArchivos').innerHTML=response;
								Mensajes();
								Finalizar();
                               
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}
	//Editar nombre portafolio
	function EditarNombrePortafolio(NomPortafolio) {
		var IdPortafolio = document.getElementById('IdTemporal').innerHTML;
		var parametros = {
                            "btnEditarPortafolio" : 'true',
                            "IdPortafolio" :  IdPortafolio,
                            "NombrePortafolio" :  NomPortafolio
                        };
     					$.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            success:  function (response) {
                                document.getElementById('TblArchivos').innerHTML=response;
								Mensajes();
								Finalizar();
                               
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}
	//Abre el detalle del portafolio por primera vez
	function ExpandirPortafolio(IdPortafolio){

		/*var ListaTerceros = document.getElementById('ListaTerceros');
		ListaTerceros.style.display = 'none';*/
		$("#FiltroPortafolio").css("display","none");
		$('#ListaTerceros').css('display','none');

		if ($('#div').hasClass('col-lg-8')) {
			//alert("1");
			$('#div').removeClass('col-lg-8');
			$('#div').addClass('col-lg-12');
		}else{
			if ($('#div').hasClass('col-lg-12')) {
				//alert("2");
			}
		}
		
		/*document.getElementById('div').classList.remove('col-lg-8');
		document.getElementById('div').classList.add('col-lg-12');*/
		if (document.getElementById('NamePortafolio'+IdPortafolio)) {
			document.getElementById('NombrePortafolio').innerHTML = document.getElementById('NamePortafolio'+IdPortafolio).innerHTML;
		}else{
			ConsultarNombrePortafolio(IdPortafolio);
			//document.getElementById('NombrePortafolio').innerHTML = ConsultarNombrePortafolio(IdPortafolio);
		}
		
		
		var btn = document.getElementsByClassName('select');
		for (var i = btn.length - 1; i >= 0; i--) {
			btn[i].style.display = 'none';
		}

		var parametros = {
                            "btnDbClick1" : 'true',
                            "IdPortafolio" :  IdPortafolio
                        };
     					$.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            //CrearPortafolio
                            success:  function (response) {
                               document.getElementById('TblArchivos').innerHTML=response;
                               document.getElementById('CrearPortafolio').style.display = 'none';
                               document.getElementById('CrearPortafolio').style.visibility = 'hidden';
                               document.getElementById("AñadirDetalles").style.visibility = "visible";
                               document.getElementById("AñadirDetalles").style.display = 'inline';
                               document.getElementById('btnHome').style.display = 'inline';
                               document.getElementById('btnHome').style.visibility = 'visible';
                               document.getElementById('btnBack').style.display = 'inline';
                               document.getElementById('btnBack').style.visibility = "visible";
                               //ocultar lista de terceros

								ValidarChk((document.getElementById('limit').innerHTML));
                               
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}
	function ConsultarNombrePortafolio(IdPortafolio) {
		var parametros = {
	            "ConsultarNombrePortafolio" : 'true',
	            "IdPortafolio" : IdPortafolio
	        };
		$.ajax({
	            data:  parametros,
	            url:   '../Controller/PortafolioController.php',
	            type:  'post',
	            
	            success:  function (response) {
	            	if (response != -1) {
	            		document.getElementById('NombrePortafolio').innerHTML = response;
	            	}else{
	            		//alert(response);
	            	}
	            	
	            },
	            error: function (error) {
	            alert('error; ' + eval(error));
	            }
	    });
	}

	function OpenRoute(pos){
		var parametros = {
                            "OpenRoute" : 'true',
                            "NombrePortafolio" : document.getElementById('NombrePortafolio').innerHTML,
                            "PosVector" : pos
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                            	//colocamos la ruta(label) en el div de rutas
                       			//document.getElementById('RutasAcceso').innerHTML=response;
                       			document.getElementById('TblArchivos').innerHTML=response;

                               	ValidarChk((document.getElementById('limit').innerHTML)-1);
                               	DefinirRuta();
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}
	function DefinirRuta(){
		var parametros = {
                            "btnCrearRuta" : 'true'
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                            	//colocamos la ruta(label) en el div de rutas
                       			document.getElementById('RutasAcceso').innerHTML=response;
                       			//document.getElementById('TblArchivos').innerHTML=response;
                               	
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}
	function ExpandirDetalle(id, ruta){
		var Carpeta = document.getElementById(id).innerHTML.trim();
		//alert(Carpeta);
		var parametros = {
                            "btnDbClick" : 'true',
                            "DbClick" : Carpeta,
                            "NombrePortafolio" : document.getElementById("NombrePortafolio").innerHTML.trim()
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {

                       			document.getElementById('TblArchivos').innerHTML=response;
                               	ValidarChk((document.getElementById('limit').innerHTML)-1);
                            	DefinirRuta();

								 //Colocamos el label de la carpeta seleccionada
                               	
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}
	
	//creamos el elemento y el id va ser la posicion del vector 
	function CrearElemento(id){
		//alert(Carpeta); <label id="RutasAcceso"><a href="#" onclick="Home()" id="Ruta"></a></label>
		

			var newEtiqueta = document.createElement("label");
			newEtiqueta.setAttribute('id', ""); 
			//newEtiqueta.setAttribute('href', "#");
			newEtiqueta.setAttribute('onclick', "ExpandirDetalleA('"+Carpeta+"')");
			var currentDiv = document.getElementById("RutasAcceso"); 
			newEtiqueta.innerHTML = Carpeta+" ";
		    //var newContent = document.createTextNode(Carpeta); 
		    currentDiv.appendChild(newEtiqueta); 
	}
	function EditarElemento(Carpeta){
		var b = document.getElementById('RutasAcceso');
    	var count = b.getElementsByTagName('a').length;
    	if (count > 1) {
    		for (var i = count - 1; i >= 1; i--) {
	    		var a = document.getElementById('RutasAcceso').getElementsByTagName('a')[i].innerHTML;
				var tam = a.length;
				var carpeta = a.substr(0,tam-1);
				if (Carpeta == carpeta) {
					return carpeta;
				}
	    	}
    	}
    	return "";
	}
	function EliminarElemento(Carpeta){
		if (document.getElementById('lbl'+Carpeta)) {
			var eliminado = document.getElementById('lbl'+Carpeta);
			eliminado.parentNode.removeChild(eliminado);
			var eliminado = document.getElementById(Carpeta);
			eliminado.parentNode.removeChild(eliminado);
		}
		
	}
	function EliminarElementosAdelante(CarpetaActual){
		var b = document.getElementById('RutasAcceso');
    	var count = b.getElementsByTagName('a').length;
    	if (count > 1) {
    		for (var i = count - 1; i >= 1; i--) {
	    		var a = document.getElementById('RutasAcceso').getElementsByTagName('a')[i].innerHTML;
				var tam = a.length;
				var carpeta = a.substr(0,tam-1);
				alert(CarpetaActual+"="+carpeta);
				if (CarpetaActual != carpeta) {
					EliminarElemento(carpeta);
				}else{
					i = 0;
				}
			}
	    }
	}
	function EliminarElementos() {
		var b = document.getElementById('RutasAcceso');
    	var count = b.getElementsByTagName('a').length;
    	if (count > 1) {
    		for (var i = count - 1; i >= 1; i--) {
	    		var a = document.getElementById('RutasAcceso').getElementsByTagName('a')[i].innerHTML;
				var tam = a.length;
				var carpeta = a.substr(0,tam-1);
				EliminarElemento(carpeta);
	    	}
    	}
	}
	function Mensajes(){
		if (document.getElementById('Creado')) {
			if (document.getElementById('Creado').innerHTML == '1') {
				swal({
				  position: 'top-end',
				  type: 'success',
				  title: 'Portafolio creado con exito',
				  showConfirmButton: false,
				  timer: 1500
				})
                ListarArchivos();
			}else{
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Ya existe el portafolio'
				})
				Finalizar();
			}
		}
		
		if (document.getElementById('Editado')) {
				swal({
				  position: 'top-end',
				  type: 'success',
				  title: 'Portafolio editado con exito',
				  showConfirmButton: false,
				  timer: 1500
				})
			
		}
		if (document.getElementById('EliminarDB')) {
				swal({
				  position: 'top-end',
				  type: 'success',
				  title: 'Portafolio eliminado con exito',
				  showConfirmButton: false,
				  timer: 1500
				})
			
		}
	}
	function ValidarChk(Limit){

		//recorre las carpetas que pinto segun el limite(esta en un div con el valor) de carpetas que halla
		for(i=2;i<=Limit;i++){
			if (document.getElementById('value'+i)) {
				if(document.getElementById('value'+i).innerHTML.trim() == "1"){
					document.getElementById('chk'+i).indeterminate=true;
				}
			}
			
		}
		//si no tiene mas carpetas definimos un  div con true   y mostramos una alerta
		if (document.getElementById('uno')) {
			if(document.getElementById('uno').innerHTML=='true'){
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'No hay mas  carpetas disponibles!'
				})
			}
		}
	}

	history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
    function Home(){
    	
    	var parametros = {
                            "btnHome" : 'true',
                            "NombrePortafolio" : document.getElementById("NombrePortafolio").innerHTML.trim()      
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                               document.getElementById('TblArchivos').innerHTML=response;
                               EliminarElementos();
                               	ValidarChk((document.getElementById('limit').innerHTML)-1);
                               	DefinirRuta();
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
    }
    function Back(){

    	var parametros = {
                            "btnBack" : 'true',
                            "NombrePortafolio" : document.getElementById("NombrePortafolio").innerHTML.trim()     
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {

                               document.getElementById('TblArchivos').innerHTML=response; 
                               	ValidarChk((document.getElementById('limit').innerHTML)-1);
                               	DefinirRuta();
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
    }
    function Check(id){
    	var parametros = {
                            "checkBox" : 'true',
                            "nombreCarpeta" : document.getElementById("lb"+id).innerHTML.trim(),
                            "NombrePortafolio" : document.getElementById("NombrePortafolio").innerHTML.trim(),
                            "EstadoCheck" : document.getElementById("chk"+id).checked
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                            	//document.getElementById("TblArchivos").innerHTML = response;
                            	document.getElementById("AñadirDetalles").style.visibility = "visible";
                            	document.getElementById("AñadirDetalles").style.display = 'inline';
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });

    }
    function Agregar() {

		var ListaTerceros = document.getElementById('ListaTerceros');
		ListaTerceros.style.visibility = 'hidden';
		ListaTerceros.style.display = 'none';
		document.getElementById('div').classList.remove('col-lg-8');
		document.getElementById('div').classList.add('col-lg-12');
    	var parametros = {
                            "btnAgregar" : 'true',
                            "title" : document.getElementById("title").value
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                               document.getElementById('TblArchivos').innerHTML=response;
                               document.getElementById('NombrePortafolio').innerHTML=document.getElementById("title").value;
                               document.getElementById('AñadirDetalles').style.visibility='visible';
                               document.getElementById('AñadirDetalles').style.display='inline';
                               document.getElementById('CrearPortafolio').style.visibility = "hidden";
                               document.getElementById('CrearPortafolio').style.display = 'none';
                               document.getElementById('btnHome').style.display = 'inline';
                               document.getElementById('btnHome').style.visibility = 'visible';
                               document.getElementById('btnBack').style.display = 'inline';
                               document.getElementById('btnBack').style.visibility = "visible";
                               Mensajes();
                               
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
    }

    
	function Finalizar(){
		//cuando cierre se le va mostrar el protafolio
		var parametros = {
                            "btnFinalizar" : 'true'
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                               document.getElementById('TblArchivos').innerHTML=response;
                               document.getElementById("AñadirDetalles").style.visibility = "hidden";
                               document.getElementById("AñadirDetalles").style.display = 'none';
                               document.getElementById('CrearPortafolio').style.visibility = "visible";
                               document.getElementById('CrearPortafolio').style.display = 'inline';
                               document.getElementById('btnHome').style.display = 'none';
                               document.getElementById('btnHome').style.visibility = 'visible';
                               document.getElementById('btnBack').style.display = 'none';
                               document.getElementById('btnBack').style.visibility = "visible";
                               document.getElementById('NombrePortafolio').innerHTML="Portafolios";
                               document.getElementById('ListaTerceros').style.visibility = 'visible';
                               document.getElementById('ListaTerceros').style.display = 'inline';

							   document.getElementById('div').classList.remove('col-lg-12');
							   document.getElementById('div').classList.add('col-lg-8');
                               document.getElementById('RutasAcceso').innerHTML = "";

							   $("#FiltroPortafolio").css("display","block");
							   $("#FiltroPortafolio").val("");
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}
	function ListarTerceros(){
		var parametros = {
                            "evtFiltrarTercero" : 'true',
                            "NomTercero" : "" 
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                               document.getElementById('terceros').innerHTML=response;
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}

	function ListarTercero(id){
		document.getElementById('informacion').innerHTML="";
		var parametros = {
                            "btnListarTercero" : 'true',
                            "idTercero" : id
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                               document.getElementById('informacion').innerHTML=response;
                            	document.getElementById('carga1').style = "display:none";
                               document.getElementById('btnModal').style.display = 'none';
                               $('#exampleModal').modal('show');
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}	
	/*function FiltrarCliente(e) {
		//if (e.keyCode === 13 && !e.shiftKey || e == -1) {
		var parametros = {
                            "btnFiltrarTercero" : 'true',
                            "NomTercero" : document.getElementById('cliente').value
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {

                               document.getElementById('terceros').innerHTML=response;
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  		//}
	}*/
	function AlertCompartirPortafolio(NombreCliente, idTercero){
		var idPortafolio = document.getElementById('IdPortafolio').innerHTML;
		var cantFotos = document.getElementById('notify'+idPortafolio).innerHTML;
		if (cantFotos > 0) {
			var nomPortafolio = document.getElementById('NamePortafolio'+idPortafolio).innerHTML;
			var fechaPortafolio = document.getElementById('fecha'+idPortafolio).innerHTML;

			swal({
			  title: 'Está seguro de enviar el <br> portafolio: <b>'+nomPortafolio+'</b><br> al cliente: <b>'+NombreCliente+'</b>',
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Aceptar'
			}).then((result) => {
			  if (result.value) {
			  		EnviarPortafolio(idTercero, NombreCliente);
			    	$('#exampleModal').modal('show');
			    	document.getElementById('textArea').focus();
					
			  }
			})
		}else{
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Sin fotos en el portafolio!!'
			})	
		}
		
	}
	function EnviarPortafolio(idTercero, NombreCliente){
		var idPortafolio = document.getElementById('IdPortafolio').innerHTML;
		var nomPortafolio = document.getElementById('NamePortafolio'+idPortafolio).innerHTML;
		var fechaPortafolio = document.getElementById('fecha'+idPortafolio).innerHTML;
		var cantFotos  = document.getElementById('notify'+idPortafolio).innerHTML;
		document.getElementById('informacion').innerHTML="";
		var parametros = {
                            "btnEnviarPortafolio" : 'true',
                            "idCliente" : idTercero,
                            "idPortafolio" : idPortafolio,
                            "nomPortafolio" : nomPortafolio,
                            "fechaPortafolio" : fechaPortafolio,
                            "cantFotos" : cantFotos,
                            "nombreCliente" : NombreCliente
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                            	document.getElementById('informacion').innerHTML=response;
                            	document.getElementById('carga1').style = "display:none";
                            	document.getElementById('btnModal').style.display = 'inline';
                            	
                            	
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}
	function DescPortafolioTercero(){
		var idPortafolio = document.getElementById('IdPortafolio').innerHTML;
		var idRelacion = document.getElementById('idRelacion').innerHTML;
		var idVendedor = document.getElementById('vendedoresAsociados').value;

		if (document.getElementById('textArea').value.length != 0) {
			document.getElementById('error').style.display='none';
			$('#exampleModal').modal('hide');
			var txtArea = document.getElementById('textArea').value;
			var parametros = {
                            "btnDescPortafolioTercero" : 'true',
                            "idPortafolio" : idPortafolio,
                            "txtArea" : txtArea,
                            "idRelacion" : idRelacion,
                            "idVendedor" : idVendedor
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {
                            	//document.getElementById('TblArchivos').innerHTML = response;
                            	swal({
								  position: 'top-end',
								  type: 'success',
								  title: response,
								  showConfirmButton: false,
								  timer: 1500
								})
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
		}else{
			//document.getElementById('error').style.display='inline';
			$('body').css('padding-right', '0px');
			if ($('#textArea').hasClass('textAreadefault')) {
				$('#textArea').removeClass('placeholderdefault');
				$('#textArea').removeClass('textAreadefault');
				document.getElementById('error').style.display='inline';
				$('#textArea').addClass('placeholdererror');
				$('#textArea').addClass('textAreaerror');
			}else{
				$('#textArea').addClass('placeholdererror');
				document.getElementById('error').style.display='inline';
				$('#textArea').addClass('textAreaerror');
			}
			

			var clear = setInterval(function(){ 
				$('#textArea').removeClass('textAreaerror');
				document.getElementById('error').style.display='none';
				$('#textArea').removeClass('placeholdererror');
				$('#textArea').addClass('placeholderdefault');
				$('#textArea').addClass('textAreadefault');
	    	clearInterval(clear);}, 2000);

			$('#textArea').attr('data-toggle',"tooltip");
			$('#textArea').attr('data-placement',"top");
			$('#textArea').attr('title',"tooltip");

		}
		
	}
	/*Filtrar datos en la tabla de clientes
	document.querySelector("#cliente").onkeyup = function(){
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
    }*/
    /*Filtrar datos en la tabla de clientes*/

	 /*$( function() {
	    $( document ).tooltip();
	  } );*/

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

 <?php if (isset($_SESSION['idportafolio'])) {
		echo "<script>
			ExpandirPortafolio(".$_SESSION['idportafolio'].");
		</script>";

  		unset($_SESSION['idportafolio']);
	} ?>

<style type="text/css">
	.placeholdererror::-webkit-input-placeholder{
		color: #a94442;
	}
	.textAreaerror{
		border-color: #a94442;
		background: #f2dede;
	}
	.placeholderdefault::-webkit-input-placeholder{
		color: #ccc;
	}
	.textAreadefault{
		border-color: #ccc;
		background: #FFFFFF;
	}

</style>
 