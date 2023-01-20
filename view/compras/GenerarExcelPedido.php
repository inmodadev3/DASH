<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==7){
        if($_SESSION['Permisos'][$i]['intVer']==1){
          $blnPermiso=true;
        }
        break;
       }
    }
    if(!($blnPermiso)){
      echo "<script language='javascript'>window.location='../view/index.php?menu=Inicio'</script>;"; 
    }


 require_once("../Controller/PedidosController.php");
$clsControllerPedido= new clsPedidosController();                                               
 
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
<div id="page-wrapper">
<style type="text/css">
  @media screen and (min-width: 1380px) {
                              #page-wrapper{ 
                                  height: 100vh; 
                     }
    }
</style>
<button type="button" class="btn" data-toggle="modal" style="background:#337ab7;" data-target="#Primero"><i style="color:#fff;" class="fa fa-question-circle fa-fw"></i></button>
<div class="modal fade" id="Primero">
  <div class="modal-dialog">
    <div class="modal-content">  
      <div class="modal-header">
        <h5 class="display-inline-block"><strong>Generar Excel</strong></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
     <div class="modal-body">
      En esta pagina usted podra descargar sus pedidos registrados previamente.
      </div>      
      <div class="modal-footer">
       
      </div>

    </div>
  </div>
</div>

<br><br>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i>Formulario Pedido
                        </div>
                        <div class="panel-body">
                           <div> 
                              <div class="row"> 
                                <div class="col-lg-4 col-xs-12">
                                 <div class="input-group">
                                  <span class="input-group-addon">Fecha</span>
                                  <input type="text" class="form-control"  id='dtaDocumento' readonly="readonly">
                                </div>
                              </div>
                              <div class="col-lg-4 col-sm-4 col-xs-4"><input type="text" style="visibility: hidden;"></div>
                              <div class="col-lg-4 col-sm-12 col-xs-12"  style="float:right;">
                                  <label>Nro Documento</label>
                                   <input  class="w-25 display-inline-block form-control" type="number" min="1" value="1" id="txtNroDocumento" onchange="ListarLineaPorPedido();"/>
                                </div>
                              </div>
                            </div>
                              <div class="row">
                                <div class="col-lg-12">     
                                  <form action="../Controller/PedidosController.php" method="post" id='frmExcel' style="display: none;">
                                    <input type="text" name="btnGenerarExcel">
                                    <input type="text" name="ArrayExcel" id='Excel'>
                                    <input type="text" name="txtNroDocumento" id="txtDocumento">                                  
                                  </form>
                                  <h4 class="display-inline-block"><strong>No Descargados</strong></h4><br>
                                   <button onclick="GenerarExcel();" class="btn btn-default"><i class="glyphicon glyphicon-download"></i> Generar Excel</button><div class="clearfix"></div><br>
                                 <div class="scroll">  
                                <table class="table table-bordered" id='tblExcelPedido'>
                                  <thead>
                                    <th>Descargar</th>
                                    <th>Linea</th>
                                    <th>Grupo</th>
                                    <th>Clase</th>
                                    <th>Tipo</th>
                                    <th>Ver</th>
                                  </thead>
                                  <tbody id='tblCuerpo'>
                                    
                                  </tbody>

                                </table>
                              </div>
                                <br>
                                 <h4 class="display-inline-block"><strong>Descargados</strong></h4>
                             <div class="scroll"> 
                                <table class="table table-bordered" id='tblExcelGenerado'>
                                  <thead>
                                    <th>Descargar</th>
                                    <th>Linea</th>
                                    <th>Grupo</th>
                                    <th>Clase</th>
                                    <th>Tipo</th>
                                    <th>Ver</th>
                                  </thead>
                                  <tbody id='tblCuerpoDescargado'>
                                    
                                  </tbody>
                                </table>
                               </div> <br>
                               <button onclick="DuplicarExcel();" class="btn btn-default" style="float: right;"><i class="glyphicon glyphicon-duplicate"></i> Duplicar Excel</button>

                              </div>
                              </div>
                            
                         
                         
                         
    </div>

    </div>
    </div>
    </div>


     
    </div>
</div>
 <select id="ddlTallaM"  style="display: none;">
         <?php
         
           $Resultado=$clsControllerPedido->ConsultarWebService("Tallas");
           $Tallas=explode("%",$Resultado->TallasResult);
          for($i=0;$i<=sizeof($Tallas)-1;$i++){
                  if($i%2!=0){
                    echo "<option value=".$Tallas[$i-1].">".$Tallas[$i]."</option>";
                  }
          }
          $Resultado=null;?>
</select >
<select id="ddlEstiloM"  style="display: none;"> 
  <option value="0">Sin Estilo</option> 
      <?php
          for($i=1;$i<=10;$i++){
              echo "<option value='".$i."'>Estilo ".$i."</option>";
          }
     ?>
</select> 
<select id="ddlColorM"  style="display: none;">
  <?php
  $Resultado=$clsControllerPedido->ConsultarWebService("Colores");
  $Color=explode("%",$Resultado->ColoresResult);
  for($i=0;$i<=sizeof($Color)-1;$i++){
        if($i%2!=0){
              echo "<option value=".$Color[$i-1].">".$Color[$i]."</option>";
         }
  }
  $Resultado=null;

?>
 </select> 
                                <select  id="ddlLinea"  style="display: none;">
                                <?php
                                 if(isset($_SESSION['ddlLinea'])){
                                      echo $_SESSION['ddlLinea'];
                                    }
                                ?>
                                </select>                                                 
                                <select id="ddlGrupo"  style="display: none;">
                                <?php
                                 if(isset($_SESSION['ddlGrupo'])){
                                      echo $_SESSION['ddlGrupo'];
                                    }
                                ?>
                                </select>
                         
                                <select id="ddlClase"  style="display: none;">
                                <?php 
                                  if(isset($_SESSION['ddlClase'])){
                                      echo $_SESSION['ddlClase'];
                                    }
                                ?>
                                </select>                       
                                <select  id="ddlTipo"  style="display: none;">
                                <?php
                                 if(isset($_SESSION['ddlTipo'])){
                                      echo $_SESSION['ddlTipo'];
                                    }
                                ?>
                                </select>
                         
<div class="modal fade" id="ModalDetalleReferenciaLinea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Referencias</h4>
      </div>
      <div class="modal-body">
            <table class="table table-bordered" id='tblReferencias'>
               <tbody id='tblReferenciaDetalle'>
               </tbody>
            </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id='ModalImg' aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="text-align: center; padding: 0px;margin: 0px;vertical-align: center ; background-color:rgba(255,255,255,.0);box-shadow: none;border:none">
      <img src="" id="imgModel" style="width:70%;height: auto; border-radius: 5px;-webkit-box-shadow: 0px 0px 32px 5px rgba(214,207,214,1);
      -moz-box-shadow: 0px 0px 32px 5px rgba(214,207,214,1);
      box-shadow: 0px 0px 32px 5px rgba(214,207,214,1);"  />
    </div>
  </div>
</div>
<script type="text/javascript">
  document.getElementById("frmExcel").style.display="none";
  function OcultarImg(){
  
       $('#ModalDetalleReferenciaLinea').modal({ keyboard: true }) ;
          $('#ModalImg').modal({ keyboard: false }) ;
        
    

  }
  function MostrarImagen(Tipo){
    document.getElementById("imgModel").src=Tipo.src;
    $('#ModalImg').modal('show') ; 
     $('#ModalDetalleReferenciaLinea').modal('hide') ;
  }
</script>
<script type="text/javascript">
ListarLineaPorPedido();
ListarLineaPorPedidoDescargado();
    function ListarLineaPorPedido(){
   ListarLineaPorPedidoDescargado();
         var parametros = {
                            "ListarLineaPorPedido" : 'true',
                            "txtNroDocumento" : document.getElementById("txtNroDocumento").value.trim()
                        };
                        
                $.ajax({   
                            data:  parametros,
                            url:   '../Controller/PedidosController.php',
                            type:  'post',
                            
                            success:  function (response) {
                              document.getElementById("tblCuerpo").innerHTML=response;
                              document.getElementById("dtaDocumento").value="";
                                if(response!=""){
                                 document.getElementById("dtaDocumento").value= document.getElementById('dtDocumento').value.split('-').reverse().join('/');
                               }
                                    var ddlLinea=document.getElementById("ddlLinea");
                                    var ddlGrupo=document.getElementById("ddlGrupo");
                                    var ddlClase=document.getElementById("ddlClase");
                                      var tblReferencias=document.getElementById("tblExcelPedido");
                                    var ddlTipo=document.getElementById("ddlTipo");
                                    var nFilas = $("#tblExcelPedido > tbody").children().length;

                                    for(var k=0;k<=nFilas-1;k++){
                                    for(var i=0;i<=ddlLinea.length-1;i++){
                                      if(ddlLinea[i].value.trim()==tblReferencias.rows[k+1].cells[5].innerHTML.trim()){
                                        tblReferencias.rows[k+1].cells[5].innerHTML=ddlLinea[i].innerHTML;
                                    
                                      }
                                    }

                                    for(var h=0;h<=ddlGrupo.length-1;h++){
                                      if(ddlGrupo[h].value.trim()==tblReferencias.rows[k+1].cells[6].innerHTML.trim()){
                                        tblReferencias.rows[k+1].cells[6].innerHTML=ddlGrupo[h].innerHTML;

                                      }
                                    }

                                    for(var j=0;j<=ddlClase.length-1;j++){
                                       

                                      if(ddlClase[j].value.trim()==tblReferencias.rows[k+1].cells[7].innerHTML.trim())
                                      {               
                                       tblReferencias.rows[k+1].cells[7].innerHTML=ddlClase[j].innerHTML;
                                      }
                                    }
                                       for(var j=0;j<=ddlTipo.length-1;j++){
                                       

                                      if(ddlTipo[j].value.trim()==tblReferencias.rows[k+1].cells[8].innerHTML.trim())
                                      {               
                                       tblReferencias.rows[k+1].cells[8].innerHTML=ddlTipo[j].innerHTML;
                                      }
                                    }}

                        
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
                      
  }  
     function ListarLineaPorPedidoDescargado(){
    
         var parametros = {
                            "btnListarPedidoLineaDescargado" : 'true',
                            "txtNroDocumento" : document.getElementById("txtNroDocumento").value.trim()
                        };
                        
                $.ajax({   
                            data:  parametros,
                            url:   '../Controller/PedidosController.php',
                            type:  'post',
                            
                            success:  function (response) {
                                 document.getElementById("tblCuerpoDescargado").innerHTML=response;
                                  var ddlLinea=document.getElementById("ddlLinea");
                                    var ddlGrupo=document.getElementById("ddlGrupo");
                                    var ddlClase=document.getElementById("ddlClase");
                                      var tblReferencias=document.getElementById("tblExcelGenerado");
                                    var ddlTipo=document.getElementById("ddlTipo");
                                    var nFilas = $("#tblExcelGenerado > tbody").children().length;

                                    for(var k=0;k<=nFilas-1;k++){
                                    for(var i=0;i<=ddlLinea.length-1;i++){
                                      if(ddlLinea[i].value.trim()==tblReferencias.rows[k+1].cells[5].innerHTML.trim()){
                                        tblReferencias.rows[k+1].cells[5].innerHTML=ddlLinea[i].innerHTML;
                                    
                                      }
                                    }

                                    for(var h=0;h<=ddlGrupo.length-1;h++){
                                      if(ddlGrupo[h].value.trim()==tblReferencias.rows[k+1].cells[6].innerHTML.trim()){
                                        tblReferencias.rows[k+1].cells[6].innerHTML=ddlGrupo[h].innerHTML;

                                      }
                                    }

                                    for(var j=0;j<=ddlClase.length-1;j++){
                                       

                                      if(ddlClase[j].value.trim()==tblReferencias.rows[k+1].cells[7].innerHTML.trim())
                                      {               
                                       tblReferencias.rows[k+1].cells[7].innerHTML=ddlClase[j].innerHTML;
                                      }
                                    }
                                       for(var j=0;j<=ddlTipo.length-1;j++){
                                       

                                      if(ddlTipo[j].value.trim()==tblReferencias.rows[k+1].cells[8].innerHTML.trim())
                                      {               
                                       tblReferencias.rows[k+1].cells[8].innerHTML=ddlTipo[j].innerHTML;
                                      }
                                    }}
                               
                        
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
                      
  } 

   function ListarReferenciaPorLinea(Tipo){
   var parametros="";
          parametros = {
                            "btnListarPedidoLinea" : 'true',
                            "txtNroDocumento" : document.getElementById("txtNroDocumento").value.trim() ,
                            "ddlLinea" : document.getElementById("idLinea"+Tipo).innerHTML.trim() ,
                            "ddlGrupo" : document.getElementById("idGrupo"+Tipo).innerHTML.trim() ,
                            "ddlClase" : document.getElementById("idClase"+Tipo).innerHTML.trim() ,
                            "ddlTipo" : document.getElementById("idTipo"+Tipo).innerHTML.trim() 
                      }
            $.ajax({
                            data:  parametros,
                            url:   '../Controller/PedidosController.php',
                            type:  'post', 
                            success:  function (response) {
                                    document.getElementById("tblReferenciaDetalle").innerHTML=response;
                                    $('#ModalDetalleReferenciaLinea').modal('show');
                                    var ddlEstilo=document.getElementById("ddlEstiloM");
                                    var tblReferencia=document.getElementById("tblReferencias");
                                    var ddlColor=document.getElementById("ddlColorM");
                                    var ddlTalla=document.getElementById("ddlTallaM");
                                    var nFilas = $("#tblReferencias > tbody").children().length;

                                    for(var k=0;k<=nFilas-1;k++){
                                    for(var i=0;i<=ddlEstilo.length-1;i++){
                                      if(ddlEstilo[i].value.trim()==tblReferencias.rows[k].cells[0].innerHTML.trim()){
                                        tblReferencias.rows[k].cells[0].innerHTML=ddlEstilo[i].innerHTML;
                                      }
                                    } 
                                    for(var h=0;h<=ddlColor.length-1;h++){
                                      if(ddlColor[h].value.trim()==tblReferencias.rows[k].cells[1].innerHTML.trim()){
                                        tblReferencias.rows[k].cells[1].innerHTML=ddlColor[h].innerHTML;

                                      }
                                    }

                                    for(var j=0;j<=ddlTalla.length-1;j++){
                                       

                                      if(ddlTalla[j].value.trim()==tblReferencias.rows[k].cells[2].innerHTML.trim())
                                      {               
                                       tblReferencias.rows[k].cells[2].innerHTML=ddlTalla[j].innerHTML;
                                      }
                                    }

                                  }
                                  ListarLineaPorPedido();
                                  ListarLineaPorPedidoDescargado();
                            },
                            error: function (error) {
                            alert('error; ' + eval(error))
                            }
                    })
  }

function GenerarExcel(){

  var nFilas = $("#tblCuerpo").children().length;
  var tblExcelPedido=document.getElementById("tblCuerpo");
var ArrayExcel="";

  for(var i=0;i<=nFilas-1 ;i++){
    if(document.getElementById("chk"+i).checked){
      ArrayExcel=tblExcelPedido.rows[i].cells[1].innerHTML+"-"+tblExcelPedido.rows[i].cells[2].innerHTML+"-"+
      tblExcelPedido.rows[i].cells[3].innerHTML+"-"+tblExcelPedido.rows[i].cells[4].innerHTML+"<"+ArrayExcel;
    }
  }
  if(ArrayExcel.trim()===""){
  
          const toast = swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          background: '#FFFFB0'

        });
        toast({
          type: 'error',
          title: "<span style='color:#686868'>Seleccione una linea.</span>"
          
        });
         return;
  }
  document.getElementById("Excel").value=ArrayExcel;
  document.getElementById("txtDocumento").value=document.getElementById("txtNroDocumento").value.trim();
  document.getElementById('frmExcel').submit();
  setTimeout(function(){   ListarLineaPorPedidoDescargado();
  ListarLineaPorPedido(); }, 2000);
}

function DuplicarExcel(){

var nFilas = $("#tblCuerpoDescargado").children().length;
var tblExcelPedido=document.getElementById("tblCuerpoDescargado");
var ArrayExcel="";

  for(var i=0;i<=nFilas-1 ;i++){
    if(document.getElementById("chkD"+i).checked){
      ArrayExcel=tblExcelPedido.rows[i].cells[1].innerHTML+"-"+tblExcelPedido.rows[i].cells[2].innerHTML+"-"+
      tblExcelPedido.rows[i].cells[3].innerHTML+"-"+tblExcelPedido.rows[i].cells[4].innerHTML+"<"+ArrayExcel;
    }
  }
  if(ArrayExcel.trim()===""){
     const toast = swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          background: '#FFFFB0'

        });
        toast({
          type: 'error',
          title: "<span style='color:#686868'>Seleccione una linea.</span>"
          
        });
         return;
  }
  document.getElementById("Excel").value=ArrayExcel;
  document.getElementById("txtDocumento").value=document.getElementById("txtNroDocumento").value.trim();
document.getElementById('frmExcel').submit();

}
</script>
