<?php
    $intTipoVista=0;
    $strDdlVista='';
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==18){
        if($_SESSION['Permisos'][$i]['intVer']==1){
          $blnPermiso=true;
          $intTipoVista=$_SESSION['Permisos'][$i]['intTipoVista'];
        }
        break;
       }
    }
    if(!($blnPermiso)){
      echo "<script language='javascript'>window.location='../view/index.php?menu=Inicio'</script>;"; 
    }
     switch ($intTipoVista) {
        case '1':
         $strDdlVista="<option value='1'>Blanca</option>";
        break;
        case '2':
         $strDdlVista="<option value='2'>Verde</option>";
        break;      
        case '3':
         $strDdlVista="<option value='1'>Blanca</option><option value='2'>Verde</option>";
        break;

    }
?>
<div id="page-wrapper">	
	<br>
	<div class="row">
		<div class="col-lg-12">	
      <div class="panel panel-default">
          <div class="panel-heading">
            <i class="glyphicon glyphicon-signal"></i> Estadistica Recaudo
          </div>
      <div class="panel-body">	
      <ul class="nav nav-tabs">
        <li>
          <li class="active"><a data-toggle="tab" href="#PorVendedor"> Por Vendedores</a></li> 
          <li><a data-toggle="tab" href="#Ciudades" onclick="CargarTablaCiudades();"> Por Ciudades</a></li>
        </li>          
      </ul>
      <div class="tab-content">
        <div id="PorVendedor" class="tab-pane fade in active"> 
          <div class="row">
            <div class="col-lg-5">
              <label>Año</label>
               <select name="ano" id='anno' class="form-control" onchange="PintarEstructura(1,'');">
               </select>
            </div>
              <div class="col-lg-2">
              <label>Compañia</label>
               <select id='ddlCompania' class="form-control" onchange="DdlCompania();">
                <?php   
                echo $strDdlVista;
                ?>
               </select>
            </div>
            <div class="col-lg-5" onchange="PintarEstructura(1,'');">
              <label>Mes</label>
               <select name="mes" class="form-control" id='mes'>
                <option value="-1">Ninguno</option>
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
            </div>
          </div>           
           <div class="row">
            <div class="col-lg-7" id='ContGraficaRecaudo'>
              <div id='Canvas'>
                  <div class="row">
                  <div class="col-lg-10">
                    <h3>Recaudo</h3>
                  </div>
                  <div class="col-lg-2">
                    <br>
                    <button class='btn btn-default' onclick='location.reload();'>Actualizar</button>
                  </div>
                  </div>
                  <canvas id="CvinforGeneralPorVendedor"></canvas>
              </div>
              <div id="CvVentas"></div>
              </div>
            <div class="col-lg-5">
              <br>
              <input type="text" placeholder="Buscar" id='txtBuscarVendedor' onkeyup="BusquedaTbl('txtBuscarVendedor','tblVendedores');" class="form-control">
              <br>
              <div  style="overflow:scroll; height: 600px;" id='ContTblVendedores'>
              <table class="table"><thead><th>Seleccionar</th><th>Cedula</th><th>Vendedor</th><th>Cargo</th></thead><tbody id='tblVendedores'></tbody></table>
              </div>
            </div>                                         
		     </div>
       </div>
      <div id="Ciudades" class="tab-pane fade">
          <div class="row">
            <div class="col-lg-5">
              <label>Año</label>
               <select name="ano"  class="form-control" onchange="" id='ddlAnnoCiudad' onchange="PintarEstructura(2,'');">
               </select>
            </div>
              <div class="col-lg-2">
              <label>Compañia</label>
               <select id='ddlCompaniaCiudad' class="form-control" onchange="DdlCompania();">
               <?php echo $strDdlVista;?>
               </select>
            </div>
            <div class="col-lg-5" onchange="">
              <label>Mes</label>
               <select name="mes" class="form-control"  id='ddlMesCiudad' onchange="PintarEstructura(2,'');">
                <option value="-1">Ninguno</option>
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
            </div>
          </div>           
           <div class="row">
            <div class="col-lg-8" id='ContGraficaRecaudoCiudad'>
              <div id='CanvasCiudades'>
                  <div class="row">
                  <div class="col-lg-10">
                    <h3>Recaudo</h3>
                  </div>
                  <div class="col-lg-2">
                    <br>
                    <button class='btn btn-default' onclick='location.reload();'>Actualizar</button>
                  </div>
                  </div>
                    <canvas id="CvinforGeneralPorCiudad"></canvas>
              </div>
              <div id='CvCiudades'></div>
              </div>
            <div class="col-lg-4">
              <br>
              <input type="text" placeholder="Buscar" id='txtBuscarCiudad'  onkeyup="BusquedaTbl('txtBuscarCiudad','tblCiudades');" class="form-control">
              <br>
              <div  style="overflow:scroll; height: 600px;" id='ContTblCiudades'>
              <table class="table"><thead style="width: 100%;"><th>Seleccionar</th><th>Codigo</th><th>Ciudad</th></thead><tbody id='tblCiudades'></tbody></table>
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
           var fecha = new Date();
            for(var i=fecha.getFullYear();i>=2016;i--)
            {
                $("select[name=ano]").append(new Option(i,i));
            }
            $("select[name=ano]").change(function(){
                fecha=new Date($("select[name=ano]").val(), $("select[name=mes]").val(), 0);
                $("select[name=dia]").find('option').remove();
                for(var i=1;i<=fecha.getDate();i++)
                {
                   $("select[name=dia]").append(new Option(i,"dia "+i));
                }
            });
             $("select[name=mes]").change(function(){
                fecha=new Date($("select[name=ano]").val(), $("select[name=mes]").val(), 0);
                $("select[name=dia]").find('option').remove();
                for(var i=1;i<=fecha.getDate();i++)
                {
                   $("select[name=dia]").append(new Option(i,"dia "+i));
                }
            });         
</script>
<script type="text/javascript">
 
   VendedoresAsociados();
      var Fecha= new Date();
    document.getElementById('mes').value=(Fecha.getMonth()+1);
    document.getElementById('anno').value=Fecha.getFullYear();

    var ChartJs;
    PintarTblContenido(1);
    PintarTblContenido(2);
    function DdlCompania(){

       ChartJs.destroy();
    
       PintarEstructura(1,'');
       PintarEstructura(2,'');
    }
     function PintarTblContenido(Tipo){
          switch(Tipo){
            case 1:
               var parametros = {
                              "btnPintarTblVendedores" : 'true'
                           } 
            break;
            case 2:
               var parametros = {
                              "btnPintarTblCiudades" : 'true'
                           } 
            break;

          }
                          
                 $.ajax({
                            data:  parametros,
                            url:   '../Controller/RecaudoController.php',
                            type:  'post',                        
                            success:  function (response) { 
                            switch(Tipo){
                              case 1:
                                  document.getElementById('tblVendedores').innerHTML=response;
                              break;
                              case 2:
                                  document.getElementById('tblCiudades').innerHTML=response;
                              break;
                            }                           
                                                  
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                        });
    }
      
  


     function VendedoresAsociados(){

               var parametros = {
                              "btnVendedoresAsociados" : 'true',
                              'intTipo':'0'
                               } 
  
                          
                 $.ajax({
                            data:  parametros,
                            url:   '../Controller/RecaudoController.php',
                            type:  'post',                        
                            success:  function (response) { 
                              console.log(response);
                                   if(response=='true'){

                                        PintarEstructura(1,'');
                                        PintarEstructura(2,'');
                                   }else{
                                    alert('Notiene vend');
                                   }
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                        });
      
    }
    function PintarInformeGrafica(Tipo,id){

      switch(Tipo)
      {
         case 1:
         if(id != ''){

          var parametros = {
                      "btnJsInformeVendedor" : 'true',
                      "txtAnno":document.getElementById('anno').value.trim(),
                      "txtMes":document.getElementById('mes').value.trim(),
                      "txtVendedor":document.getElementById('tblVendedores').rows[id-1].cells[1].innerHTML.trim(),
                         'intTipo':'1',
                           "intCompania":document.getElementById('ddlCompania').value

                    };
         }else{
           var parametros = {
                      "btnJsInformeVendedor" : 'true',
                      "txtAnno":document.getElementById('anno').value.trim(),
                      "txtMes":document.getElementById('mes').value.trim(),
                      "txtVendedor":id.trim(),
                         'intTipo':'1',
                           "intCompania":document.getElementById('ddlCompania').value
                    };
         }
         break;
         case 2:
           if(id!=''){
       
 
          var parametros = {
                      "btnJsInformeCiudades" : 'true',
                      "txtAnno":document.getElementById('ddlAnnoCiudad').value.trim(),
                      "txtMes":document.getElementById('ddlMesCiudad').value.trim(),
                      "txtVendedor":document.getElementById('tblCiudades').rows[id-1].cells[1].innerHTML.trim(),
                         'intTipo':'1',
                           "intCompania":document.getElementById('ddlCompaniaCiudad').value

                    };
         }else{
           var parametros = {
                      "btnJsInformeCiudades" : 'true',
                      "txtAnno":document.getElementById('ddlAnnoCiudad').value.trim(),
                      "txtMes":document.getElementById('ddlMesCiudad').value.trim(),
                      "txtVendedor":id.trim(),
                         'intTipo':'1',
                           "intCompania":document.getElementById('ddlCompaniaCiudad').value
                    };
         }


         break;
         }                  
                 $.ajax({
                            data:  parametros,
                            url:   '../Controller/RecaudoController.php',
                            type:  'post',                        
                            success:  function (response) { 
                              switch(Tipo){
                               case 1:                               
                             
                                  DatosTotal=response.split("?");
                            
                                   CreacionGraficaJS(DatosTotal[0],DatosTotal[1],DatosTotal[2],DatosTotal[3],DatosTotal[4],DatosTotal[5],Tipo);  
                              
                                break;
                                 case 2:                               
                                
                                  DatosTotal=response.split("?");
                                   CreacionGraficaJS(DatosTotal[0],DatosTotal[1],DatosTotal[2],DatosTotal[3],DatosTotal[4],DatosTotal[5],Tipo); 
                                
                                break;
                              }                             
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                        });  
    }   
    function PintarEstructura(Tipo,id){

 
      switch(Tipo)
      {
         case 1:
         if(id!=''){
          var parametros = {
                      "btnPintarEstructuraPorVendedor" : 'true',
                      "txtAnno":document.getElementById('anno').value.trim(),
                      "txtMes":document.getElementById('mes').value.trim(),
                      "txtVendedor":document.getElementById('tblVendedores').rows[id-1].cells[1].innerHTML.trim(),
                         "txtNombre":document.getElementById('tblVendedores').rows[id-1].cells[2].innerHTML.trim(),
                          'intTipo':'1',
                          "intCompania":document.getElementById('ddlCompania').value

                    };
         }else{
           var parametros = {
                      "btnPintarEstructuraPorVendedor" : 'true',
                      "txtAnno":document.getElementById('anno').value.trim(),
                      "txtMes":document.getElementById('mes').value.trim(),
                      "txtVendedor":id.trim(),
                      "txtNombre":'' ,
                       'intTipo':'1',
                         "intCompania":document.getElementById('ddlCompania').value
                    };
         }
         break;
         case 2:
         if(id!=''){
          var parametros = {
                      "btnPintarEstructuraPorCiudades" : 'true',
                      "txtAnno":document.getElementById('ddlAnnoCiudad').value.trim(),
                      "txtMes":document.getElementById('ddlMesCiudad').value.trim(),
                      "txtVendedor":document.getElementById('tblCiudades').rows[id-1].cells[1].innerHTML.trim(),
                      "txtNombre":document.getElementById('tblCiudades').rows[id-1].cells[2].innerHTML.trim(),
                       'intTipo':'1',
                         "intCompania":document.getElementById('ddlCompaniaCiudad').value

                    };
          
         }else{
           var parametros = {
                      "btnPintarEstructuraPorCiudades" : 'true',
                      "txtAnno":document.getElementById('ddlAnnoCiudad').value.trim(),
                      "txtMes":document.getElementById('ddlMesCiudad').value.trim(),
                      "txtVendedor":id.trim(),
                      "txtNombre":'' ,
                       'intTipo':'1',
                         "intCompania":document.getElementById('ddlCompaniaCiudad').value
                    };
         }
         break;
         }    
        
                 $.ajax({
                            data:  parametros,
                            url:   '../Controller/RecaudoController.php',
                            type:  'post',                        
                            success:  function (response) { 
                   
                               switch(Tipo)
                                {
                                   case 1:
                  
                                    document.getElementById('CvVentas').innerHTML=response;
                                    PintarInformeGrafica(1,id);
                                    break;
                                    case 2:                              
                                    document.getElementById('CvCiudades').innerHTML=response;
                                    PintarInformeGrafica(2,id);
                                    break;
                                  }
 
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                        });   
    }  
function CreacionGraficaJS(DatoUno,DatoDos,DatoTres,DatoCuatro,DatoCinco,intNroGraficas,Tipo){
if(Tipo==1){
  ContenedorJSGrafica='CvinforGeneralPorVendedor';
 }else{
  ContenedorJSGrafica='CvinforGeneralPorCiudad';
 } 
  
    var ContenidoDos={
                  label: DatoCuatro,
                  data: [],
                  backgroundColor: [
                     
                  ],
                  borderColor: [
                      
                  ],
                  borderWidth: 1
              };
          var Contenido={
          type: 'line',
          data: {
              labels: [],
              datasets: [ContenidoDos]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      }; 
          DatosNroUno=DatoUno.split(',');
          DatosNroDos=DatoDos.split('*');
          DatosNroTres=DatoTres.split('*');
          DatosNroCinco=DatoCinco.split(',');
        for(i=0;i<=DatosNroUno.length-2;i++){
          Contenido.data.labels.push(DatosNroUno[i]);
          ContenidoDos.data.push(DatosNroCinco[i]);
          ContenidoDos.backgroundColor.push(DatosNroDos[i]);
          ContenidoDos.borderColor.push(DatosNroTres[i]);
        }

      var ctxs = document.getElementById(ContenedorJSGrafica).getContext('2d');
      ChartJs = new Chart(ctxs,Contenido);
      ChartJs.update();   
}
let timerInterval
swal({
  title: 'Cargando...',
  html: 'Espere mientras carga la página.',
  timer: 2000,
  onOpen: () => {
    swal.showLoading(); 
  },
  onClose: () => {
    clearInterval(timerInterval); 
     CargarTablaVendores();

  }
}).then((result) => {
  if (
    result.dismiss === swal.DismissReason.timer
  ) {   
  }
});  
function CargarTablaVendores(){
 setTimeout(function(){ document.getElementById("ContTblVendedores").style.height=((document.getElementById('ContGraficaRecaudo').offsetHeight-71))+"px"; 
   }, 500);
}  
function CargarTablaCiudades(){
 setTimeout(function(){  document.getElementById("ContTblCiudades").style.height=((document.getElementById('ContGraficaRecaudoCiudad').offsetHeight-74))+"px"; 
   }, 500);
}  
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
<style type="text/css">
    .swal2-container {
     zoom : 1.4 ;
     -moz-transform: scale(1.4);
    }    
</style>
