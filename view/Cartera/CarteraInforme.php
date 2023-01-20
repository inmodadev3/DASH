<?php
    $intTipoVista=0;
    $strDdlVista='';
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==8){
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
  </div><br><br>
   <div class="panel panel-default">
        <div class="panel-heading">
          <i class="glyphicon glyphicon-cog"></i> Consulta Cartera
        </div>
      <div class="panel-body">    
      <h1  style="margin:0px;">Cartera</h1>
      <hr>
      <label>Compañia</label><br>
      <select class="form-control" id='ddlCompania' onchange="ListarTerceroCartera()"  style="display: inline;width: 25%; ">
                <?php   
                echo  $strDdlVista;
                ?>
      </select><br>
      <label>Ciudad</label><br>
      <select class="form-control" id="ddlCiudadesAsociadas" onchange="ListarTerceroCartera()">

      </select>
      <br>
      <div class="row">
      <div class="col-lg-12 col-xs-12">
      		  <input type="text" placeholder="Buscar" style="display: inline-block;" class="form-control" id="txtBuscarTercero" onkeyup ="BuscarTerceroCartera()"><br><br>
      	    <form action="../Controller/CarteraController.php" method="Post" style="display: inline-block;">
      	    <input type="hidden" name="btnGenerarExcel">
            <input type="hidden" name="intCompania" id='txtIncompania'>
            <input type="hidden" name="strCiudad" id='txtCiudad'>
            <label>Todas las ciudades</label> <input type="checkbox" name="" id='chkTdCiudades' onchange="GetStrCiudades();"><br>
            <button type="submit"  name="btnExcel" class="btn btn-default"><i class="glyphicon glyphicon-download"></i> Descagar</button>
      	</form>
      </div>
      </div>
      <br>
      <div style="overflow:scroll; height: 600px;">
        <table class="table table-striped" id="tblCartera2">
        	<thead>
        		<th >#</th>
        		<th >Cedula Tercero</th>
        		<th >Nombre</th>
        		<th >Documento</th>
        		<th >Fecha Generada</th>
        		<th>Fecha Vencimiento</th>
        		<th >Saldo</th>
        		<th>Ciudad</th>
        		<th>Tiempo</th>
        		<th>Telefono</th>
        		<th>Celular</th>
        		<th >Cupo</th>
        		<th >Plazo</th>
            <th >Cedula Vendedor</th>
            <th >Nombre Vendedor</th>
            <th>Transacción</th>
            <th>Tipo Tercero</th>
            <th>Dirección1</th>
            <th>Dirección2</th>
        	</thead>
        	<tbody id='tblCartera' >
        		
        	</tbody>
        </table>
      </div>
</div>      
</div><br>
</div>   
<script type="text/javascript">
  /* General */
  function Cargando(){
let timerInterval
swal({
  title: 'Cargando...',
  html: 'Espere mientras carga la página.',
  timer: 1000,
  onOpen: () => {
    swal.showLoading(); 
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
}  
</script>   
<script type="text/javascript">
    $( document ).ready(function() {
      DdlCiudadesAsociadas();
    });
	function ListarTerceroCartera(){
        if(document.getElementById('txtIncompania')){
          document.getElementById('txtIncompania').value=document.getElementById('ddlCompania').value;
          GetStrCiudades();
        }   
        
        var ddlCiudad=document.getElementById('ddlCiudadesAsociadas');
        var ddlCompania=document.getElementById('ddlCompania');
		    var parametros = {
                            "btnListarCartera" : 'true',
                            'intCompania':ddlCompania.value ,
                            'strCiudad' : ddlCiudad.value            
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/CarteraController.php',
                            type:  'post',
                            
                            success:  function (response) {
                                document.getElementById('tblCartera').innerHTML=response; document.getElementById('txtBuscarTercero').value="";
                                  //$("#tblCartera2").tablesorter();
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
	}
  /*Metodo obtiene todas las ciudades del select para descargar el excel*/
function GetStrCiudades(){
  var chkCiudad=document.getElementById('chkTdCiudades');
  if(!(chkCiudad.checked)){
    document.getElementById('txtCiudad').value="'"+document.getElementById('ddlCiudadesAsociadas').value+"'";
    return;
  }
  var intCtnOption= $('#ddlCiudadesAsociadas option').length;
  var strCiudades='';
  for(var i=0;i<=intCtnOption-1;i++){
    strCiudades+="'"+document.getElementById('ddlCiudadesAsociadas')[i].value+"',";
  } 
  document.getElementById('txtCiudad').value=strCiudades;
}
  /*Metodo para construir ddl de las ciudades asociadas*/
  function DdlCiudadesAsociadas(){
    Cargando();
    var parametros={
      "btnDdlCiudadesAsociadas" : 'true'
    };        
    $.ajax({
      data:  parametros,
      url:   '../Controller/VendedorController.php',
      type:  'post',                           
      success:  function (response) {                  
        document.getElementById('ddlCiudadesAsociadas').innerHTML=response;
        ListarTerceroCartera();
      },
      error: function (error) {
        alert('error; ' + eval(error));
      }
    })
  }
  function BuscarTerceroCartera(){
    var strNombreTercero=document.getElementById('txtBuscarTercero');
    var ddlCompania=document.getElementById('ddlCompania');
    var ddlCiudad=document.getElementById('ddlCiudadesAsociadas');
    if(strNombreTercero.value.trim()==''){
      ListarTerceroCartera();
      return;
    }
    var parametros = {
                            "btnBuscarTercero" : 'true',
                            'intCompania': ddlCompania.value,
                            'strCiudad' : ddlCiudad.value,
                            "strNombreTercero" : strNombreTercero.value.trim()          
                      }; 
            $.ajax({
                            data:  parametros,
                            url:   '../Controller/CarteraController.php',
                            type:  'post',
                            success:  function (response) {
                              document.getElementById('tblCartera').innerHTML=response; 
                            },
                            error: function (error) {
                             alert('error; ' + eval(error));
                            }
                    });
  }
</script>
<style type="text/css">
    .swal2-container {
      zoom : 1.4 ;
      -moz-transform: scale(1.4);
    }      
    @media screen and (min-width: 1380px)  {        
            #page-wrapper{
               height: 100vh;
                        }
    }
    th:hover{
        cursor: pointer;
    }
</style>
