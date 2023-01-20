<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==12){
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
   zoom : 1.4  ;
   -moz-transform: scale(1.4);
}
</style>
<script type="text/javascript">
let timerInterval
swal({
  title: 'Cargando...',
  html: 'Espere mientras carga la página.',
  timer: 3000,
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
<div id="page-wrapper">
<style type="text/css">

    @media only screen and (min-width: 1400px) {
                     #page-wrapper{ 
                       height: 100vh; 
                     }
    }
 </style>   
<button type="button" class="btn" style="background: #337ab7;" data-toggle="modal" data-target="#Primero"><i style="color:#fff;" class="fa fa-question-circle fa-fw"></i></button>
<div class="modal fade" id="Primero">
  <div class="modal-dialog">
    <div class="modal-content">

      
      <div class="modal-header">
        <h4 class="modal-title">Ayuda</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      
      <div class="modal-body">
      En esta pagina usted podra crear las zonas asginando las ciudades
      correspondientes para cada una y posteriormente asignarlas a los 
      vendedores
      </div>      
      <div class="modal-footer">
       
      </div>

    </div>
  </div>
</div>

<br>
<br>
<div class="row">
    <div class="col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-user fa-fw"></i>Formulario Zonas
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
            	
              		<div class="row">
	                  
              	
	          			<div class="col-lg-12">
	          				<label>Nueva zona</label>
	          				
	          			</div>
	          		</div>
	          		<div class="row">
	          			
	          					<div class="col-lg-10">
									<input class="form-control"  type="input" id="txtDescZona" >
								</div>
									<div class="col-lg-2">
								<button class="btn btn-default" onclick="AgregarZona()" name="Btn" ><i class="glyphicon glyphicon-plus"></i></button>
							</div>
    				<div class="row">
    					<div class="col-xs-12">
                          <br>
                    
                    		<div style="overflow: scroll;height: 200px;">
                    	
    	                		<table class="table table-responsive table-striped" id='TblZonasMaestro'>
    		                		<thead>
    		                			<tr>
    			                			<th>Codigo Zona</th>
    			                			<th>Descripcion</th>
    			                			<th>Accion</th>
    			                		</tr>
    		                		</thead>
    		                		<tbody id="TblZonas">
    		                			
    		                		</tbody>
    		                	</table>
    	               		</div>
    	          		 </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

	<div class="col-xs-6">

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-user fa-fw"></i>Ciudades
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
            		<div class="input-group">
    			  		<span class="input-group-addon" id="sizing-addon3">
    			  			<div class="glyphicon glyphicon-search">
    			  				
    			  			</div>
    			  		</span>
    		 		 <input type="text" id="txtBuscar" class="form-control" placeholder="Buscar" aria-describedby="sizing-addon3">
    				</div>
    			
                    <br>

            	<div style="overflow: scroll;height: 225px;">
                	<table   class="table table-responsive" id='tblCiudadesGeneral'>
                		<thead>
                			<tr>
                    			<th>Ciudad</th>
                    			<th>Descripcion</th>
                    			<th>Accion</th>
                    		</tr>
                		</thead>
                		<tbody id="tblCiudades">
                			<?php
                			include_once('../Controller/ZonasController.php');
                				$Ciudades = new clsZonasController();
                				$tabla=$Ciudades->ConsultarCiudades();
                				echo $tabla;

                    			?>
                		</tbody>
                	</table>
            	</div>
    		</div>
    	</div>
    </div> 
</div>
<div class="row">
	<div class="col-xs-12">
<div id="pnCiudadesZona" class="collapse">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i>Ciudades
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
  				<div class="row">
  					<div class="col-lg-3">
  						<label>Codigo Zona</label>
  						<input class="form-control" type="input" id="CodZona" disabled="true">
  					</div>

                    <div class="col-lg-3">
                        <label>Zona</label>
                        <input class="form-control"  style="display: inline-block;" type="input" id="DescZona">                  
                    </div>  
                    <div class="col-lg-3">
                            <div class="row">
                            <div class="col-lg-2">
                            <div><label>Editar</label>
                            </div>
                            <button onclick="EditarZona();" class="btn btn-default"><i class="glyphicon glyphicon-edit"></i></button>
                            </div>
                            <div class="col-lg-10">
                            <div><label>
                            Todas Las Ciudades
                            </label></div>
                            <button class="btn btn-default" onclick="AgregarCiudadesGeneral()"><i class="glyphicon glyphicon-share"></i></button>
                            </div>
                            </div>
                    </div>         
  				</div>

  			
						<br>
                	<div style="overflow: scroll;height: 410px;">
	                	<table  class="table table-responsive table-striped" >
	                		<thead>
	                			<tr>
		                			<th>Ciudad</th>
		                			<th>Descripcion</th>
		                			<th>Accion</th>
		                		</tr>
	                		</thead>
	                		<tbody id="tblCiudadesPorZona">
	                			
	                		</tbody>
	                	</table>
                	</div>
				</div>
			</div>
		</div>
	</div>
</div>
   

	

	
<script type="text/javascript">
	ListarZonas();
    function EditarZona(){

     var parametros = {
                            "btnEditarZona" : 'true',
                            "CodZona" :document.getElementById('CodZona').value.trim(),
                            "txtZona": document.getElementById('DescZona').value.trim()
                                                  
                        };
    $.ajax({
           data:  parametros,
                            url:   '../Controller/ZonasController.php',
                            type:  'post',
                            
                            success:  function (response) {
                               
                                const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });
                                    TipoMensaje=response.split('%');
                                  toast({
                                    type:TipoMensaje[1],
                                    title: "<span style='color:#686868'>"+TipoMensaje[0]+"</span>"
                                  });
                               
                            ListarZonas();
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
    });  
    }
$(document).ready(function () {
 
            (function ($) {
 
                $('#txtBuscar').keyup(function () {
                	
 	
                    var rex = new RegExp($(this).val(), 'i');
                    $('#tblCiudades tr').hide();
                    $('#tblCiudades tr').filter(function () {
                    	
                        return rex.test($(this).text());
                 
                    }).show();
                   	
                })
  
            }(jQuery));
 
                                    
});
function AgregarZona(){
	 var parametros = {
                            "ConsultarZonas" : 'true',
                            "txtDescripcionZona" : document.getElementById("txtDescZona").value.trim(), 
                        };
	$.ajax({
		   data:  parametros,
                            url:   '../Controller/ZonasController.php',
                            type:  'post',
                            
                            success:  function (response) {

                            	if(response == "%%"){
                            	  const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });

                                  toast({
                                    type:'error',
                                    title: "<span style='color:#686868'>Ingrese Descripcion.</span>"
                                  });
                            	}else{
                            		const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });

                                  toast({
                                    type:'success',
                                    title: "<span style='color:#686868'>Zona agregada con exito.</span>"
                                  });
                                        ListarZonas();  
                            	}

                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
	});
	document.getElementById('txtDescZona').value="";
}
function ListarZonas(){
	 var parametros = {
                            "ListarZonas" : 'true',
                            
                        };
	$.ajax({
		   data:  parametros,
                            url:   '../Controller/ZonasController.php',
                            type:  'post',
                            
                            success:  function (response) {
                            	if(response == "%%"){
                            	 $.notify({                                     
                                        message: '<strong>Ingrese Descripción</strong>'
                                    },{
                                        type: 'danger',
                                        placement: {
                                            from: "top",
                                            align: "right"
                                        },
                                        z_index: 1031  
                                    });
                            	}else{

                            		document.getElementById('TblZonas').innerHTML=response;
		                            	
                            	}

                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
	});

}
function AsignarZona(CodZona){
    document.getElementById("CodZona").value=document.getElementById("TblZonas").rows[CodZona-1].cells[0].innerHTML;
    document.getElementById("DescZona").value=(document.getElementById("TblZonas").rows[CodZona-1].cells[1].innerHTML);

    for (i = 1; i <= document.getElementById("TblZonas").rows.length; i++) {
        if(i!=CodZona){
        document.getElementById("Zona_"+i).className="";
        } 
        document.getElementById("pnCiudadesZona").className="collapse";

    }
    for (i = 1; i <= document.getElementById("tblCiudades").rows.length; i++) {
       
        document.getElementById("btnCiudad_"+i).disabled=false;  
    }
    
    document.getElementById("Zona_"+CodZona).className="success";
    ListarCiudadesPorZona();


    
}
function AgregarCiudadesGeneral(){
        var nFilas = $("#tblCiudadesGeneral tr").length;

        for(i=0;i<=nFilas;i++){

         var parametros = {
                            "AgregarCiudadAZona" : 'true',
                            "CodZona" : document.getElementById("CodZona").value,
                            "CodCiudad" : document.getElementById("tblCiudades").rows[i].cells[0].innerHTML
                            
                        };
         
        $.ajax({
           data:  parametros,
                            url:   '../Controller/ZonasController.php',
                            type:  'post',
                            
                            success:  function (response) {
                               
                             

                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
    }); 
    }
       const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });

                                  toast({
                                    type:'success',
                                    title: "<span style='color:#686868'>"+response+"</span>"
                                  });         
    ListarCiudadesPorZona();
}
function AgregarCiudadAZona(CodCiudad){

     var parametros = {
                            "AgregarCiudadAZona" : 'true',
                            "CodZona" : document.getElementById("CodZona").value,
                            "CodCiudad" : document.getElementById("tblCiudades").rows[CodCiudad-1].cells[0].innerHTML,
                            
                        };
    $.ajax({
           data:  parametros,
                            url:   '../Controller/ZonasController.php',
                            type:  'post',
                            
                            success:  function (response) {
                               
                                const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });

                                  toast({
                                    type:'success',
                                    title: "<span style='color:#686868'>"+response+"</span>"
                                  });
                                ListarCiudadesPorZona();

                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
    });  
   // document.getElementById("Ciudad_"+CodCiudad).style.display="none";

}
function ListarCiudadesPorZona(){
  
 
     var parametros = {
                            "ListarCiudadesPorZona" : 'true',
                            "CodZona" : document.getElementById("CodZona").value,
                            
                            
                        };
    $.ajax({
           data:  parametros,
                            url:   '../Controller/ZonasController.php',
                            type:  'post',
                            
                            success:  function (response) {
                               
                               document.getElementById("tblCiudadesPorZona").innerHTML=response;
                                /*$.notify({                                     
                                        message: response
                                    },{
                                        type: 'success',
                                        placement: {
                                            from: "top",
                                            align: "right"
                                        },
                                        z_index: 1031  
                                    });*/
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
    });  


}
function EliminarCiudadPorZona(CodCiudad){
   

     var parametros = {
                            "EliminarCiudadPorZona" : 'true',
                            "CodCiudad" : document.getElementById("tblCiudadesPorZona").rows[CodCiudad-1


                            ].cells[0].innerHTML,
                            "CodZona" : document.getElementById("CodZona").value,
                            
                            
                        };
    $.ajax({
           data:  parametros,
                            url:   '../Controller/ZonasController.php',
                            type:  'post',
                            
                            success:  function (response) {
                               ListarCiudadesPorZona();
                               const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });

                                  toast({
                                    type:'success',
                                    title: "<span style='color:#686868'>"+response+"</span>"
                                  });
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
    });  


}
</script>


