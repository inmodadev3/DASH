<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==16){
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
<div id="page-wrapper">	
	<br>
	<div class="row">
		<div class="col-lg-12">
      <div class="panel panel-default">
          <div class="panel-heading">
            <i class="glyphicon glyphicon-signal"></i> Estadistica Cartera
          </div>
      <div class="panel-body">  

			<ul class="nav nav-tabs">
				<li>
          <li class="active"><a data-toggle="tab" href="#PnVendedor"> Por Vendedores</a></li> 
			    <li><a data-toggle="tab" href="#PnCiudad" onclick="CargarTabla();"> Por Ciudades</a></li>
        </li>		   		 
			</ul>
		<div class="tab-content">

        
		    <div  id='PnVendedor' class="tab-pane fade in active"> 
         <!-- <select onchange='PintarEstructuraPorVendedor(1)' id='ddlVendedor' class='form-control'><option value='1'>Blanca</option><option value='2'>Verde</option></select> -->
         	 <div id='PorVendedor'>
           </div>
		    </div>
  
		    <div  id='PnCiudad' class="tab-pane fade">
          <!--<select onchange='PintarEstructuraPorVendedor(2)' id='ddlCiudad' class='form-control'><option value='1'>Blanca</option><option value='2'>Verde</option></select>-->
		      <div id='Ciudades'>
           </div> 
		    </div>	    
		</div>
	</div>	
</div>
</div>
</div>
</div>
<script type="text/javascript">
    PintarEstructuraPorVendedor(1);
    PintarEstructuraPorVendedor(2);
    function PintarEstructuraPorVendedor(Tipo){
      var intCompania=1;
      switch(Tipo){
        case 1:
          //intCompania=document.getElementById('ddlVendedor').value;

        break;
        case 2:
          //intCompania=document.getElementById('ddlCiudad').value;
        break;
      }


      switch(Tipo)
      {
         case 1:
           var parametros = {
                      "btnPintarEstructuraPorVendedor" : 'true',
                     "intCompania":intCompania
                    };
         break;
        case 2:
          var parametros = {
                              "btnPintarEstructuraPorCiudad" : 'true',
                              "intCompania":intCompania
                           }
        break;
      }   
                 $.ajax({
                            data:  parametros,
                            url:   '../Controller/CarteraController.php',
                            type:  'post',                        
                            success:  function (response) { 
                                    
                               switch(Tipo)
                                {
                                   case 1:
                                      document.getElementById('PorVendedor').innerHTML=response;
                                      PintarInformeCarteraGrafica(1,intCompania);
                                        
                                    break;
                                    case 2:
                                      document.getElementById('Ciudades').innerHTML=response;
                                      PintarInformeCarteraGrafica(2,intCompania);
                                    break;  
                               }                          
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                        });   
    } 
        function PintarInformeCarteraGrafica(Tipo,intCompania){
      switch(Tipo){
        case 1:
              var parametros = {
                                   "btnJsInformeVendedor" : 'true',
                                  "intCompania":intCompania
                               }
        break;
        case 2:
          var parametros = {
                              "btnJsInformeCiudad" : 'true',
                              "intCompania":intCompania
                           }
        break;
      }                  
                 $.ajax({
                            data:  parametros,
                            url:   '../Controller/CarteraController.php',
                            type:  'post',                        
                            success:  function (response) { 
                              switch(Tipo){
                                case 1:
                                    document.getElementById('jsGraficasPorVendedor').innerHTML=response;

                                break;
                                case 2:
                                  
                                    document.getElementById('jsGraficasPorCiudad').innerHTML=response;
                                break;    
                              }                             
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
    CargarTablaCiudades();  
  }
}).then((result) => {
  if (
    result.dismiss === swal.DismissReason.timer
  ) {   
  }
}); 
function CargarTabla(){
  setTimeout(function(){     document.getElementById("tblinforGeneralPorCiudad").style.height=((document.getElementById('ContinforGeneralPorCiudad').offsetHeight)-146)+"px"; 
 }, 500);  
}
function CargarTablaCiudades(){
 setTimeout(function(){ document.getElementById("tblinforGeneralPorVendedor").style.height=((document.getElementById('ContinforGeneralPorVendedor').offsetHeight)-146)+"px"; 
   }, 500);
}
setInterval(function(){location.reload()},300000);
 function BusquedaTbl(txInput,tblBusqueda) {

                    var tabla = document.getElementById(tblBusqueda);
                  var busqueda = document.getElementById(txInput).value.toLowerCase();
                  var cellsOfRow="";
                  var found=false;
                  var compareWith="";
                  for (var i = 0; i < tabla.rows.length; i++) {
                      cellsOfRow = tabla.rows[i].getElementsByTagName('td');
                      found = false;
                      for (var j = 0; j < cellsOfRow.length; j++)
                      {
                          compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                          if (busqueda.length == 0 || (compareWith.indexOf(busqueda) > -1))
                          {
                              found = true;
                          }
                      }
                      if(found)
                      {
                          tabla.rows[i].style.display = '';
                      } else {
                          tabla.rows[i].style.display = 'none';
                      }
                  }
              }
</script>
<script type="text/javascript" id="jsGraficasPorCiudad"></script>
<script type="text/javascript" id="jsGraficasPorVendedor"></script>
<style type="text/css">
    .swal2-container {
     zoom : 1.4 ;
     -moz-transform: scale(1.4);
    }    
</style>
