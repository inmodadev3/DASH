<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==6){
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
<script type="text/javascript">document.getElementById('page-wrapper').style.hegth='100vh';
let timerInterval
swal({
  title: 'Cargando...',
  html: 'Espere mientras carga la página.',
  timer: 2500,
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
});  </script>  
<style type="text/css">
  @media screen and (max-width: 1380px)  {                          
                      #tblReferencia{
                                 
                                     zoom:77%;
                                   
                                  width: 1380px;
                                  width: 100%;
                                  
                              }

    }
      @media screen and (min-width: 1380px)  {        
                      #tblReferencia{
                                   zoom:110%;
                                  width: 100%;
                                    
                              }
                               #page-wrapper{
                                height: 100vh;
                              }
    }
     .swal2-container {
     zoom : 1.4 ;
     -moz-transform: scale(1.4);
    }
</style>
  <?php 
        require_once("../Controller/PedidosController.php");
        $clsControllerPedido= new clsPedidosController();                                                 
 ?>
<button type="button" class="btn" style="background:#337ab7;" data-toggle="modal" data-target="#Primero"><i style="color:#fff;" class="fa fa-question-circle fa-fw"></i></button>
<div class="modal fade" id="Primero">
  <div class="modal-dialog">
    <div class="modal-content">     
      <div class="modal-header">
        <h5 class="display-inline-block"><strong>Generar Pedidos</strong></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>   
      <div class="modal-body">
      En esta pagina usted podra agregar pedidos.
      </div>      
      <div class="modal-footer">      
      </div>
    </div>
  </div>
</div>
<br><br>
<div class="row">
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i>Formulario Pedido                         
                        </div>
                        <div class="panel-body">
                           <div> 
                              <div class="row"> 
                                <div class="col-lg-4 col-xs-12">
                                  <label style="display: inline-block;">Fecha:</label>
                                  <input readonly="readonly" type="text" class="form-control" style="display: inline-block;width: 38%;" id="dtInicioPedido">
                                   <script>
                                      var Dia;
                                      var tiempo = new Date();
                                      if (tiempo.getMonth() <= 9) {
                                          Dia = "0" + (tiempo.getMonth() + 1);
                                      } else {
                                          Dia = (tiempo.getMonth() + 1);
                                      }
                                      document.getElementById("dtInicioPedido").value = tiempo.getDate() + "/" + Dia + "/" + tiempo.getFullYear();                                 
                                  </script>
                                </div>
                                <div class="col-lg-4 col-sm-12 col-xs-12 col-md-12"><input type="text" style="visibility: hidden;"></div>
                                <div class="col-lg-4 col-sm-12 col-md-12">
                                  <label>Nro Pedido</label>
                                  <?php
                                    $CodigoPedido=$clsControllerPedido->ObtenerCodigoPedido();

                                   ?>
                                  <input readonly='readonly'  class="w-25 display-inline-block form-control" type="number" min='1' value="<?=$CodigoPedido ?>"  id="txtCodigoPedido" onchange="ListarPedidos('2');" onkeypress="check();">                                
                                  <button disabled="true" type="button" onclick="EmpezarPedido();" id='btnEmpezarP' class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i> Empezar Pedido</button>

                              </div>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col-lg-3">
                                <label>Linea</label>
                                <select class="form-control display-inline-block" id="ddlLinea" onchange="ListarPedidos('2')">
                                <?php 
                                    if(isset($_SESSION['ddlLinea'])){
                                      echo $_SESSION['ddlLinea'];
                                    }
                                ?>
                                </select>
                              </div>
                              <div class="col-lg-3">
                                <label>Grupo</label>
                                <select class="form-control display-inline-block"  id="ddlGrupo" onchange="ListarPedidos('2')">
                                <?php
                                 if(isset($_SESSION['ddlGrupo'])){
                                      echo $_SESSION['ddlGrupo'];
                                    }
                                ?>
                                </select>
                              </div>
                              <div class="col-lg-3">
                                <label>Clase</label>
                                <select class="form-control display-inline-block"  id="ddlClase" onchange="ListarPedidos('2')">
                                <?php
                                  if(isset($_SESSION['ddlClase'])){
                                      echo $_SESSION['ddlClase'];
                                    }
                                ?>
                                </select>
                              </div>
                              <div class="col-lg-3">
                                <label>Tipo</label>
                                <select class="form-control display-inline-block"  id="ddlTipo" onchange="ListarPedidos('2')">
                                <?php 
                                  if(isset($_SESSION['ddlTipo'])){
                                      echo $_SESSION['ddlTipo'];
                                    }
                                ?>
                                </select>
                              </div>
                           </div>
                           <br>
                          <div id="dvContenidoPedido"  style="display: none;">
                             <button class="btn btn-default"  onclick="ClonarNewReferencia();"><i class="glyphicon glyphicon-plus"></i></button>
                             <button class="btn btn-default"  onclick="NewFila();"><i class="glyphicon glyphicon-minus"></i></button>
                            <br><br>
                            <div class="row">
                                <div class="col-lg-7">

                                   <input type="text" id="txtReferenciaBuscar"  onkeyup="ListarPedidos('BuscarReferencia');" class="form-control display-inline-block w-50" placeholder="Buscar Referencia..." >
                                </div>
                                <div class="col-lg-1"><input type="text" style="visibility: hidden;"></div>
                                <div class="col-lg-4">
                                    <label>Eliminar Referencia: </label>
                                    <select  id="ddlEliminarReferencia" class="form-control display-inline-block" style="width: 40%;"></select>
                                    <button  type="button" class="btn btn-default display-inline-block" onclick="EliminarReferencia();"><i class="glyphicon glyphicon-remove"></i></button>
                                </div>
                            </div> 
                           
                           <br>
                         
                         <div  style="height:1000px;overflow: scroll;width: 100%;">
                         <table class="table table-bordered table-hover" style="text-align: center;" id="tblReferencia">
                          <script type="text/javascript">

                          // document.getElementById("tblReferencia").style.zoom=0.78;


                          </script>
                        
                              <thead>
                                  <th>Foto</th>
                                  <th>Referencia</th>
                                  <th style="width:8%;">UDM</th>
                                  <th style="width:8%;">TipoEnvio</th>
                                   <th>Productos</th>   
                              </thead>
                              <tbody id="tblBodyReferencia">
                                    <tr>
                                        <td style="padding: 2px;">
                                          <label class="btn btn-default" for="my-file-selector0" onchange ="AgregarImagen('0');">
                                            <form  enctype="multipart/form-data" id="uploadimage">
                                            <input id="my-file-selector0" type="file" name='File' accept="image/*"  style="display:none;" 
                                            /></form>
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </label><br>
                                          <img  src="../img/img.png" onclick="MostrarImagen(this);" width="75" height="80" id="imgCrear0" >

                                           <label class="btn btn-default"  onclick="EliminarImgProducto('0');"><i class="glyphicon glyphicon-remove"></i></label><br><br>
                                       <label class="btn btn-default" for="myImg0" onchange ="AgregarImagenColores('0');">
                                            <form  enctype="multipart/form-data">
                                            <input id="myImg0" type="file" name='File' accept="image/*"  style="display:none;" 
                                            /></form>
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </label><br>
                                          <img  src="../img/img.png" onclick="MostrarImagen(this);" width="75" height="80" id="imgColores0" ><br>
                                           <label class="btn btn-default" onclick="EliminarImgColores('0');"><i class="glyphicon glyphicon-remove"></i></label>
                                      
                                        </td>
                                        <td style="padding: 2px;"> <br>
                                                <input type="text"  class="form-control" id="txtReferencia0" placeholder="Ingrese Referencia..."><br>
                                           <textarea placeholder="Observación" id="txtObservacion0" class="form-control" style="min-width: 200px;max-width:200px;min-height: 100px;max-height: 100px;"></textarea>
                                           <br>
                                        </td>
                                        <td>
                                             <select class="form-control display-inline-block" id="ddlUDM0">
                                              <?php
                                                 $Resultado=$clsControllerPedido->ConsultarWebService("ConsultarUnidades");
                                                 
                                                  $Color=explode("%",$Resultado->ConsultarUnidadesResult);
                                                 for($i=0;$i<=sizeof($Color)-1;$i++){
                                                    if($i%2!=0){
                                                    echo "<option value=".$Color[$i-1].">".$Color[$i]."</option>";
                                                    }
                                                 }
                                                $Resultado=null;
                                                
                                                ?>

                                             </select>
                                         </td>
                                        <td>
                                              <select class="form-control display-inline-block" id="ddlTipoEnvio0">
                                               <?php
                                                 $TipoEnvio=$clsControllerPedido->ListarTipoEnvio();
                                                 for($i=0;$i<=sizeof($TipoEnvio)-1;$i++){
                                                     echo "<option value=".$TipoEnvio[$i]['idCodigo'].">".$TipoEnvio[$i]['strTipoEnvio']."</option>";
                                                   }
                                                   $TipoEnvio=null;
                                                ?>
                                              </select>
                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="margin: 0;" id="tblReferenciaNewFila0">
                                            <thead>
                                              <th>Foto</th>
                                              <th style="width:16%;">Estilo</th>
                                              <th style="width:33%;">Color</th>
                                              <th style="width:15%;">Talla</th>
                                              <th style="width:13%;">Cantidad</th>
                                              <th>
                                                 <button class="btn btn-default"  onclick="ClonarNewFilaReferencia('0');"><i class="glyphicon glyphicon-plus"></i></button>
                                                <button class="btn btn-default"  onclick="NeWFilaReferencia('0');"><i class="glyphicon glyphicon-minus"></i></button>
                                              </th>
                                          </thead>
                                          <tbody>
                                            <tr>
                                            <td>
                                             <label class="btn btn-default" for="myImgEstilo0" onchange ="AgregarImagenEstilo('0');">
                                                  <form  enctype="multipart/form-data">
                                                  <input id="myImgEstilo0" type="file" name='File' accept="image/*"  style="display:none;" 
                                                  /></form>
                                                  <i class="glyphicon glyphicon-plus"></i>
                                              </label><br>
                                                <img  src="../img/img.png" onclick="MostrarImagen(this);" width="75" height="80" id="txtFotoEstilo0" ><br>
                                                <label class="btn btn-default"  onclick="EliminarImgEstilo('0');"><i class="glyphicon glyphicon-remove" ></i></label>
                                          </td>  
                                            <td style="display: none;">
                                              <input type="text" id="txtCodigo0" value="0"/>
                                            </td>
                                            <td>
                                                <select class="form-control display-inline-block" id="ddlEstilo0"> 
                                                  <option value="0">Sin Estilo</option> 
                                                    <?php
                                                    for($i=1;$i<=10;$i++){
                                                       echo "<option value='".$i."'>Estilo ".$i."</option>";
                                                    }
                                                     ?>
                                                </select>
                                            </td>
                                            <td>
                                                 <select class="float-left form-control w-50"  id="ddlColor0">
                                                  <?php

                                                      $Resultado=$clsControllerPedido->ConsultarWebService("Colores");
                                                     
                                                      $Color=explode("%",$Resultado->ColoresResult);
                                                      var_dump($Resultado);
                                                     for($i=0;$i<=sizeof($Color)-1;$i++){
                                                        if($i%2!=0){
                                                        echo "<option value=".$Color[$i-1].">".$Color[$i]."</option>";
                                                        }
                                                     }
                                                    $Resultado=null;
                                                  ?>
                                                  </select>
                                                  <input type="text" placeholder="Ingrese Codigo" id="txtColor0" class="form-control w-50"/>
                                            </td>
                                            <td>
                                               <input type="text" class="form-control display-inline-block" id="ddlTalla0" placeholder="Talla">
                                             <!--
                                                    $Resultado=$clsControllerPedido->ConsultarWebService("Tallas");
                                                    $Tallas=explode("%",$Resultado->TallasResult);
                                                     for($i=0;$i<=sizeof($Tallas)-1;$i++){
                                                        if($i%2!=0){
                                                        echo "<option value=".$Tallas[$i-1].">".$Tallas[$i]."</option>";
                                                        }
                                                     }
                                                    $Resultado=null;
                                                       </select>*/
                                                   -->

                                            
                                            </td>
                                             <td>
                                              <input type="number" min='1' placeholder="Cantidad" class="form-control display-inline-block " id="txtCantidad0">
                                             </td>
                                              <td>
                                                <button class="btn btn-default" onclick="AgregarProductoPedido('0');"><i class="glyphicon glyphicon-floppy-disk"></i></button>
                                                <button class="btn btn-default" onclick="EliminarLote('0');">
                                                  <i class="glyphicon glyphicon-remove"></i>
                                                </button>
                                              
                                             </td>
                                            </tr>                                          
                                          </tbody>
                                          </table>
                                       </td>
                                    </tr>                                 
                                  </tbody>
                          </table>
                        </div>
                      </div>
                  </div>                     
</div>
</div></div></div>
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
  function MostrarImagen(Tipo){
    document.getElementById("imgModel").src=Tipo.src;
    $('#ModalImg').modal('show') ; 
  }
</script>
</div>
                                             <!-- <select id="ddlTallaM" style="display: none;">
                                                <?php/*
                                                  $Resultado=$clsControllerPedido->ConsultarWebService("Tallas");
                                                  $Tallas=explode("%",$Resultado->TallasResult);
                                                   for($i=0;$i<=sizeof($Tallas)-1;$i++){
                                                      if($i%2!=0){
                                                      echo "<option value=".$Tallas[$i-1].">".$Tallas[$i]."</option>";
                                                      }
                                                   }
                                                  $Resultado=null;
                                                  $Tallas=null;*/
                                                ?>
                                              </select >-->
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
                                                  $Color=null;
                                                  ?>
                                                </select>
                                                <select  id="ddlTipoEnvioM"  style="display: none;">
                                                   <?php
                                                     $TipoEnvio=$clsControllerPedido->ListarTipoEnvio();
                                                     for($i=0;$i<=sizeof($TipoEnvio)-1;$i++){
                                                         echo "<option value=".$TipoEnvio[$i]['idCodigo'].">".$TipoEnvio[$i]['strTipoEnvio']."</option>";
                                                       }$TipoEnvio=null; 
                                                       $TipoEnvio=null;
                                                    ?>
                                                </select>
                                                <select  id="ddlUDMM"  style="display: none;">
                                                   <?php 
                                                     $Resultado=$clsControllerPedido->ConsultarWebService("ConsultarUnidades");
                                                      $UDM=explode("%",$Resultado->ConsultarUnidadesResult);
                                                     for($i=0;$i<=sizeof($UDM)-1;$i++){
                                                        if($i%2!=0){
                                                        echo "<option value=".$UDM[$i-1].">".$UDM[$i]."</option>";
                                                        }
                                                     }
                                                    $Resultado=null;
                                                    $UDM=null;
                                                    $clsControllerPedido=null;
                                                    ?>
                                                </select>                                           
 <script type="text/javascript">
document.getElementById("txtCodigoPedido").readOnly=false;
document.getElementById("btnEmpezarP").disabled=false;
document.getElementById("dvContenidoPedido").style.display="none";
var Nro=document.getElementById("txtCodigoPedido").value.trim();
var Contenidotbl=document.getElementById("tblBodyReferencia").innerHTML;
var Num=0;
var FilaNum=0;
  function EliminarReferencia(){
    var parametros = {
                            "btnEliminarReferencia" : 'true',
                            "txtReferencia" : document.getElementById("ddlEliminarReferencia").value.trim()
                        };
                        
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PedidosController.php',
                            type:  'post',
                            success:  function (response) {
                               strMensaje=response.split("%");
                                  const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });

                                  toast({
                                    type:strMensaje[1],
                                    title: "<span style='color:#686868'>"+strMensaje[0]+"</span>"
                                  });
                                   ListarPedidos("2");      
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
                      
  }

  function LlenarDdlEliminarReferencia(){
     var parametros = {
                            "ListarReferenciaLinea" : 'true',
                            "txtNroDocumento" : document.getElementById("txtCodigoPedido").value.trim() ,
                            "ddlLinea" : document.getElementById("ddlLinea").value.trim() ,
                            "ddlGrupo" : document.getElementById("ddlGrupo").value.trim() ,
                            "ddlClase" : document.getElementById("ddlClase").value.trim() ,
                            "ddlTipo" : document.getElementById("ddlTipo").value.trim() 
                      
                        };
                        
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PedidosController.php',
                            type:  'post',
                            
                            success:  function (response) {
                                   document.getElementById("ddlEliminarReferencia").innerHTML=response;
                                  
                                
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }

  function EliminarLote(Tipo){
    var parametros = {
                            "btnEliminarLote" : 'true',
                            "txtReferencia" : document.getElementById("txtReferencia"+document.getElementById("txtCodigo"+Tipo).value).value.trim(),
                            "ddlTalla":document.getElementById("ddlTalla"+Tipo).value.trim(),
                            "ddlColor":document.getElementById("ddlColor"+Tipo).value.trim(),
                            "ddlEstilo":document.getElementById("ddlEstilo"+Tipo).value.trim()
                          
                        };
                        
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PedidosController.php',
                            type:  'post',
                            
                            success:  function (response) {
                              strMensaje=response.split("%");
                                  const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });

                                  toast({
                                    type:strMensaje[1],
                                    title: "<span style='color:#686868'>"+strMensaje[0]+"</span>"
                                  });
                                   ListarPedidos("2");
                                
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }                                
var Numero=document.getElementById("txtCodigoPedido").value.trim();
function check(){
 if(parseInt(document.getElementById('txtCodigoPedido').value)>Numero){
            $.notify({                                     
                                        message: '<strong>No se encuentra mas pedidos</strong>'
                                    },{
                                        type: 'warning',
                                        placement: {
                                            from: "top",
                                            align: "right"
                                        },
                                        z_index: 1031  
                                    });
            document.getElementById("txtCodigoPedido").value="";
            document.getElementById("txtCodigoPedido").value=parseInt(Numero);
            return;
           }     
}
  function ListarPedidos(Tipo){
            if(document.getElementById("txtCodigoPedido").value.trim()<Numero){
              document.getElementById("btnEmpezarP").disabled=true;
            }
            if(Numero==document.getElementById("txtCodigoPedido").value){
              document.getElementById("btnEmpezarP").disabled=false;
               document.getElementById("dvContenidoPedido").style.display='none';
              return;
            }

           if(parseInt(document.getElementById('txtCodigoPedido').value)>Numero){
           const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                background: '#FFFFB0'
              });

              toast({
                type:'error',
                title: "<span style='color:#686868'>No se encuentran mas pedidos.</span>"
              });
             document.getElementById("txtCodigoPedido").value="";
            document.getElementById("txtCodigoPedido").value=parseInt(Numero);
            return;
           }
var parametros="";
 if(Tipo=='BuscarReferencia'){

                        parametros = {
                            "btnBuscarReferencia" : 'true',
                            "txtReferencia": document.getElementById("txtReferenciaBuscar").value.trim(),
                            "txtNroDocumento" : document.getElementById("txtCodigoPedido").value.trim() ,
                            "ddlLinea" : document.getElementById("ddlLinea").value.trim() ,
                            "ddlGrupo" : document.getElementById("ddlGrupo").value.trim() ,
                            "ddlClase" : document.getElementById("ddlClase").value.trim() ,
                            "ddlTipo" : document.getElementById("ddlTipo").value.trim() 
                      }

 } else{
    parametros = {
                            "btnListarPedidoLoteLinea" : 'true',
                            "txtNroDocumento" : document.getElementById("txtCodigoPedido").value.trim() ,
                            "ddlLinea" : document.getElementById("ddlLinea").value.trim() ,
                            "ddlGrupo" : document.getElementById("ddlGrupo").value.trim() ,
                            "ddlClase" : document.getElementById("ddlClase").value.trim() ,
                            "ddlTipo" : document.getElementById("ddlTipo").value.trim() 
                      }      
  }                    
      //document.getElementById("txtReferenciaBuscar").value="";               
            $.ajax({
                            data:  parametros,
                            url:   '../Controller/PedidosController.php',
                            type:  'post', 
                            success:  function (response) {
                                   document.getElementById("dvContenidoPedido").style.display='block';
                                    if(response=="NULL"){
                                      document.getElementById("tblBodyReferencia").innerHTML=Contenidotbl;
                                      Num=0;
                                      FilaNum=0;
                                      document.getElementById("ddlEliminarReferencia").innerHTML="";
                                      return;
                                    }
                                    
                                    document.getElementById("tblBodyReferencia").innerHTML=response;
                                    Num=parseInt(document.getElementById("valorFilaLote").value.trim());
                                    FilaNum=parseInt(document.getElementById("valorFila").value.trim());
                                    var ddlTipoEnvio=document.getElementById("ddlTipoEnvioM");
                                    var ddlEstilo=document.getElementById("ddlEstiloM");
                                    var ddlColor=document.getElementById("ddlColorM");
                                    var ddlTalla=document.getElementById("ddlTallaM");
                                    var ddlUDMM=document.getElementById("ddlUDMM");

                                    var ValorInicial;
                                    var Contenido="";

                                    for(var i=0;i<=FilaNum;i++){
                                      ValorInicial=document.getElementById("ddlUDM"+i).value;
                                      Contenido="";
                                      for(var k=0;k<=ddlUDMM.length-1;k++){
                                         Contenido=Contenido+"<option value='"+ddlUDMM[k].value+"'>"+ddlUDMM[k].innerHTML+"</option>";
                                      }
                                       document.getElementById("ddlUDM"+i).innerHTML=Contenido;
                                       $("#ddlUDM"+i).val(ValorInicial);
                                    }

                                    for(var i=0;i<=FilaNum;i++){
                                      ValorInicial=document.getElementById("ddlTipoEnvio"+i).value;
                                      Contenido="";
                                      for(var k=0;k<=ddlTipoEnvio.length-1;k++){
                                         Contenido=Contenido+"<option value='"+ddlTipoEnvio[k].value+"'>"+ddlTipoEnvio[k].innerHTML+"</option>";
                                      }
                                       document.getElementById("ddlTipoEnvio"+i).innerHTML=Contenido;
                                       $("#ddlTipoEnvio"+i).val(ValorInicial);
                                    }

                                     for(var i=0;i<=Num;i++){
                                      ValorInicial=document.getElementById("ddlEstilo"+i).value;
                                      Contenido="";
                                      for(var k=0;k<=ddlEstilo.length-1;k++){
                                         Contenido=Contenido+"<option value='"+ddlEstilo[k].value+"'>"+ddlEstilo[k].innerHTML+"</option>";
                                      }
                                       document.getElementById("ddlEstilo"+i).innerHTML=Contenido;
                                       $("#ddlEstilo"+i).val(ValorInicial);
                                    }
                                     for(var i=0;i<=Num;i++){
                                      ValorInicial=document.getElementById("ddlColor"+i).value;
                                      Contenido="";
                                      for(var k=0;k<=ddlColor.length-1;k++){
                                         Contenido=Contenido+"<option value='"+ddlColor[k].value+"'>"+ddlColor[k].innerHTML+"</option>";
                                      }
                                       document.getElementById("ddlColor"+i).innerHTML=Contenido;
                                       $("#ddlColor"+i).val(ValorInicial);
                                    }
                                     /*for(var i=0;i<=Num;i++){
                                      ValorInicial=document.getElementById("ddlTalla"+i).value;
                                      Contenido="";
                                      for(var k=0;k<=ddlTalla.length-1;k++){
                                         Contenido=Contenido+"<option value='"+ddlTalla[k].value+"'>"+ddlTalla[k].innerHTML+"</option>";
                                      }
                                       document.getElementById("ddlTalla"+i).innerHTML=Contenido;
                                       $("#ddlTalla"+i).val(ValorInicial);
                                    }*/

                                    LlenarDdlEliminarReferencia();
                                    response=null;   
                            },
                            error: function (error) {
                            alert('error; ' + eval(error))
                            }
                    })
  }

  function AgregarProductoPedido(Tipo){

/*
     var parametros = {
                            "btnAgregarProducto" : 'true',
                            "txtReferencia" : document.getElementById("txtReferencia"+document.getElementById("txtCodigo"+Tipo).value).value.trim(),
                            "ddlUDM" : document.getElementById("ddlUDM"+document.getElementById("txtCodigo"+Tipo).value).value.trim(),
                            "ddlLinea":document.getElementById("ddlLinea").value.trim(),
                            "ddlGrupo":document.getElementById("ddlGrupo").value.trim(),
                            "ddlClase":document.getElementById("ddlClase").value.trim(),
                            "ddlTipo":document.getElementById("ddlTipo").value.trim(),
                            "txtCantidad":document.getElementById("txtCantidad"+Tipo).value.trim(),
                            "ddlTipoEnvio":document.getElementById("ddlTipoEnvio"+document.getElementById("txtCodigo"+Tipo).value).value.trim(),
                            "txtNroDocumento":document.getElementById("txtCodigoPedido").value.trim(),
                            "ddlTalla":document.getElementById("ddlTalla"+Tipo).value.trim(),
                            "ddlColor":document.getElementById("ddlColor"+Tipo).value.trim(),
                            "ddlEstilo":document.getElementById("ddlEstilo"+Tipo).value.trim(),
                            "txtCodColorChina":document.getElementById("txtColor"+Tipo).value.trim(),
                            "File":document.getElementById("my-file-selector0").files[0]
                        };*/

                    if(document.getElementById("txtReferencia"+document.getElementById("txtCodigo"+Tipo).value).value.trim()==''){
                      const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });

                                  toast({
                                    type:'error',
                                    title: "<span style='color:#686868'>Ingrese Referencia.</span>"
                                  });
                                  return;
                    } 

                    if(document.getElementById("txtCantidad"+Tipo).value.trim()==''){
                      const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });

                                  toast({
                                    type:'error',
                                    title: "<span style='color:#686868'>Ingrese Cantidad.</span>"
                                  });
                                  return;
                    } 
                     if(document.getElementById("txtCantidad"+Tipo).value.trim()==0){
                      const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });

                                  toast({
                                    type:'error',
                                    title: "<span style='color:#686868'>Ingrese Cantidad validad.</span>"
                                  });
                                  return;
                    }   
                    var Data=new FormData();
                    Data.append("btnAgregarProducto","true");
                    Data.append("txtReferencia",document.getElementById("txtReferencia"+document.getElementById("txtCodigo"+Tipo).value).value.trim());

                     Data.append("txtObservacion",document.getElementById("txtObservacion"+document.getElementById("txtCodigo"+Tipo).value).value.trim());
                    Data.append("ddlUDM",document.getElementById("ddlUDM"+document.getElementById("txtCodigo"+Tipo).value).value.trim());
                    Data.append("ddlLinea",document.getElementById("ddlLinea").value.trim());
                    Data.append("ddlGrupo",document.getElementById("ddlGrupo").value.trim());
                    Data.append("ddlClase",document.getElementById("ddlClase").value.trim());
                    Data.append("ddlTipo",document.getElementById("ddlTipo").value.trim());
                    Data.append("txtCantidad",document.getElementById("txtCantidad"+Tipo).value.trim());
                    Data.append("ddlTipoEnvio",document.getElementById("ddlTipoEnvio"+document.getElementById("txtCodigo"+Tipo).value).value.trim());
                    Data.append("txtNroDocumento",document.getElementById("txtCodigoPedido").value.trim());
                    Data.append("ddlTalla",document.getElementById("ddlTalla"+Tipo).value.trim());
                    Data.append("ddlColor",document.getElementById("ddlColor"+Tipo).value.trim());
                    Data.append("ddlEstilo",document.getElementById("ddlEstilo"+Tipo).value.trim());
                    Data.append( "txtCodColorChina",document.getElementById("txtColor"+Tipo).value.trim());
                   
/*
                  if(document.getElementById("imgCrear"+document.getElementById("txtCodigo"+Tipo).value.trim()).src!="http://localhost/dash/public/Imagenes/img.png"){*/
                 Data.append('File',document.getElementById("my-file-selector"+document.getElementById("txtCodigo"+Tipo).value.trim()).files[0]);
                Data.append('img',document.getElementById("imgCrear"+document.getElementById("txtCodigo"+Tipo).value.trim()).src);
                   
                 Data.append('FileColores',document.getElementById("myImg"+document.getElementById("txtCodigo"+Tipo).value.trim()).files[0]);
                Data.append('imgColores',document.getElementById("imgColores"+document.getElementById("txtCodigo"+Tipo).value.trim()).src);

                Data.append('FileEstilo',document.getElementById("myImgEstilo"+Tipo).files[0]);
                Data.append('imgEstilo',document.getElementById("txtFotoEstilo"+Tipo).src);

                     


                      
                     
                       
      $.ajax({
                            data:  Data,
                            url:   '../Controller/PedidosController.php',
                            type:  'POST',
                            cache:false,
          contentType: false,
          processData: false,
                        


                            // tell jQuery not to process the data
                       
                            
                            success:  function (response) {
                                    Mensaje=response.split('%');
                                    const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });

                                  toast({
                                    type:Mensaje[1],
                                    title: "<span style='color:#686868'>"+Mensaje[0]+"</span>"
                                  });
                                    document.getElementById("dvContenidoPedido").style.display="block"; 

                                LlenarDdlEliminarReferencia();
                                ListarPedidos("1");
                                response=null;
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }

  function EmpezarPedido(){
       var parametros = {
                            "btnEmpezarPedido" : 'true'             
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PedidosController.php',
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
                                      Numero=parseInt(Numero)+1;
                                      document.getElementById("btnEmpezarP").disabled=true;
                                    document.getElementById("dvContenidoPedido").style.display="block";
                                   // ListarPedidos('EmpezarPedido');  
                                
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }

   function AgregarImagen(Tipo) {
            try {
              
                var FileImg = document.querySelector("input[id=my-file-selector"+Tipo+"]").files[0];
                var Img = document.getElementById("imgCrear"+Tipo);
                var leer = new FileReader();
                if (leer) {
                    leer.readAsDataURL(FileImg);
                    leer.onloadend = function () {
                        Img.src = leer.result;
                    };
                } else {
                    Img.src = " ";
                }
                FileImg=null;

            } catch (Exception) {
                alert(Exception);
            }

        }
         function AgregarImagenColores(Tipo) {
            try {
              
                var FileImg = document.querySelector("input[id=myImg"+Tipo+"]").files[0];
                var Img = document.getElementById("imgColores"+Tipo);
                var leer = new FileReader();
                if (leer) {
                    leer.readAsDataURL(FileImg);
                    leer.onloadend = function () {
                        Img.src = leer.result;
                    };
                } else {
                    Img.src = " ";
                }
                FileImg=null;

            } catch (Exception) {
                alert(Exception);
            }

        }
        function EliminarImgColores(Tipo){
          document.getElementById('imgColores'+Tipo).src='../img/img.png';
        }
         function EliminarImgEstilo(Tipo){
          document.getElementById('txtFotoEstilo'+Tipo).src='../img/img.png';
        }
         function EliminarImgProducto(Tipo){
          document.getElementById('imgCrear'+Tipo).src='../img/img.png';
        }
    function AgregarImagenEstilo(Tipo) {
            try {
              
                var FileImg = document.querySelector("input[id=myImgEstilo"+Tipo+"]").files[0];
                var Img = document.getElementById("txtFotoEstilo"+Tipo);
                var leer = new FileReader();
                if (leer) {
                    leer.readAsDataURL(FileImg);
                    leer.onloadend = function () {
                        Img.src = leer.result;
                    };
                } else {
                    Img.src = " ";
                }
                FileImg=null;

            } catch (Exception) {
                alert(Exception);
            }

        }
  function ClonarNewFilaReferencia(Tipo) {
    var table = document.getElementById("tblReferenciaNewFila"+Tipo);
    var row = table.insertRow(1);
    var cell0=row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    var cell3 = row.insertCell(3);
    var cell4 = row.insertCell(4);
    var cell5 = row.insertCell(5);
    var cell6= row.insertCell(6);
    //var ddlTallaM=document.getElementById("ddlTallaM");
    var ddlEstiloM=document.getElementById("ddlEstiloM");
    var ddlColorM=document.getElementById("ddlColorM");
    var OptionT;
    var OptionE;
    var OptionC;
   /* for(k=0;k<=ddlTallaM.length-1;k++){                         
      OptionT=OptionT+"<option value='"+ddlTallaM[k].value+"'>"+ddlTallaM[k].innerHTML+"</option>";   
     }<select class='form-control display-inline-block' id='ddlTalla"+Num+"''>"+OptionT+"</select>*/
     for(k=0;k<=ddlEstiloM.length-1;k++){                         
      OptionE=OptionE+"<option value='"+ddlEstiloM[k].value+"'>"+ddlEstiloM[k].innerHTML+"</option>";
     }
    for(k=0;k<=ddlColorM.length-1;k++){                         
      OptionC=OptionC+"<option value='"+ddlColorM[k].value+"'>"+ddlColorM[k].innerHTML+"</option>";
     }
    Num=Num+1;



    cell0.innerHTML="<input type='text' id='txtCodigo"+Num+"' value='"+Tipo+"'/>";
    cell1.innerHTML="<label class='btn btn-default' for='myImgEstilo"+Num+"' onchange ='AgregarImagenEstilo(\""+Num+"\");'>"+
                                                  "<form  enctype='multipart/form-data'>"+
                                                  "<input id='myImgEstilo"+Num+"' type='file' name='File' accept='image/*' style='display:none;'"+ 
                                                  "/></form>"+
                                                  "<i class='glyphicon glyphicon-plus'></i>"+
                                              "</label><br>"+
                                                "<img  src='../img/img.png' onclick='MostrarImagen(this);' width='75' height='80' id='txtFotoEstilo"+Num+"' >"+
                                                "<br>"+
                                           "<label onclick='EliminarImgEstilo(\""+Num+"\");' class='btn btn-default'><i class='glyphicon glyphicon-remove'></i></label>                                               ";
    cell2.innerHTML = " <select class='form-control display-inline-block' id='ddlEstilo"+Num+"'>"+OptionE+"</select>";
    cell3.innerHTML = "  <select class='float-left form-control w-50 ' id='ddlColor"+Num+"' >"+OptionC+"</select>"+
                                              "<input placeholder='Ingrese Codigo'  class='form-control w-50' id='txtColor"+Num+"'>"
                                          ;
    cell4.innerHTML = "<input type='text' class='form-control display-inline-block' id='ddlTalla"+Num+"' placeholder='Talla' >";  
    cell5.innerHTML = "<input  class='form-control display-inline-block ' min='1' id='txtCantidad"+Num+"' placeholder='Cantidad' type='number'>";
    cell6.innerHTML = " <button class='btn btn-default' onclick='AgregarProductoPedido(\""+Num+"\");'><i class='glyphicon glyphicon-floppy-disk'></i></button> <button class='btn btn-default' onclick='EliminarLote(\""+Num+"\");'>"+
                                                  "<i class='glyphicon glyphicon-remove'></i>"+
                                                "</button>";
    cell0.style.display="none";   
}
function obtenerValores(e) {    
              alert(document.getElementById("ddlEstilo"+e).value);  
              alert(document.getElementById("ddlColor"+e).value);  
              alert(document.getElementById("txtColor"+e).value);  
              alert(document.getElementById("ddlTalla"+e).value);  
              alert(document.getElementById("txtCantidad"+e).value); 
              alert(document.getElementById("txtCodigo"+e).value);
              alert(document.getElementById("txtReferencia"+document.getElementById("txtCodigo"+e).value).value);       
}
function NeWFilaReferencia(Tipo) {
   // document.getElementById("tblReferenciaNewFila"+Tipo).deleteRow(1);
   var nFilas = $("#tblReferenciaNewFila"+Tipo+" > tbody").children().length;
    if(nFilas!=1){
    document.getElementById("tblReferenciaNewFila"+Tipo).deleteRow(1);
    } 
}
function ClonarNewReferencia() {
    var table = document.getElementById("tblReferencia");
    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3=row.insertCell(2);
    var cell4=row.insertCell(3);
     var cell5 = row.insertCell(4);
    FilaNum=FilaNum+1;
    Num=Num+1;
   // var ddlTallaM=document.getElementById("ddlTallaM");
    var ddlEstiloM=document.getElementById("ddlEstiloM");
    var ddlColorM=document.getElementById("ddlColorM");
    var ddlTipoEnvio=document.getElementById("ddlTipoEnvioM");
    var ddlUDMM=document.getElementById("ddlUDMM");
    var OptionTE; 
    var OptionT;
    var OptionE;
    var OptionC;
    var OptionUDM;
    for(k=0;k<=ddlUDMM.length-1;k++){                         
      OptionUDM=OptionUDM+"<option value='"+ddlUDMM[k].value+"'>"+ddlUDMM[k].innerHTML+"</option>";
     }
    /*for(k=0;k<=ddlTallaM.length-1;k++){                         
      OptionT=OptionT+"<option value='"+ddlTallaM[k].value+"'>"+ddlTallaM[k].innerHTML+"</option>";
     }
      "<select class='form-control display-inline-block' id='ddlTalla"+Num+"''>"+OptionT+"</select>"+*/
    for(k=0;k<=ddlEstiloM.length-1;k++){                         
      OptionE=OptionE+"<option value='"+ddlEstiloM[k].value+"'>"+ddlEstiloM[k].innerHTML+"</option>";
     }
    for(k=0;k<=ddlTipoEnvio.length-1;k++){                         

      OptionTE=OptionTE+"<option value='"+ddlTipoEnvio[k].value+"'>"+ddlTipoEnvio[k].innerHTML+"</option>";
    }
    for(k=0;k<=ddlColorM.length-1;k++){                         
      OptionC=OptionC+"<option value='"+ddlColorM[k].value+"'>"+ddlColorM[k].innerHTML+"</option>";
    }
    cell1.innerHTML = "  <label class='btn btn-default' for='my-file-selector"+FilaNum+"' onchange ='AgregarImagen(\""+FilaNum+"\");'><input id='my-file-selector"+FilaNum+"' type='file' accept='image/*'  style='display:none;'>"+
                                           " <i class='glyphicon glyphicon-plus'></i>"+
                                      "  </label>"+
                                         " <img src='../img/img.png' onclick='MostrarImagen(this);'    width='75'"+ 
                                         "height='80' id='imgCrear"+FilaNum+"'><br>"
                                         +
                                           "<label class='btn btn-default' onclick='EliminarImgProducto(\""+FilaNum+"\");'><i class='glyphicon glyphicon-remove'></i></label><br><br>"
                                         +"  <label class='btn btn-default' for='myImg"+FilaNum+"' onchange ='AgregarImagenColores(\""+FilaNum+"\");'>"+
                                            "<form  enctype='multipart/form-data'>"+
                                            "<input id='myImg"+FilaNum+"' type='file' name='File' accept='image/*'  style='display:none;'"+ 
                                            "/></form>"+
                                            "<i class='glyphicon glyphicon-plus'></i>"+
                                          "</label>"+
                                          "<img  src='../img/img.png' onclick='MostrarImagen(this);' width='75' height='80' id='imgColores"+FilaNum+"'>"+
                                           "<br>"+
                                           "<label class='btn btn-default'  onclick='EliminarImgColores(\""+FilaNum+"\");'><i class='glyphicon glyphicon-remove'></i></label>                                               "
                                      ;
    cell1.style.padding="2px";                                     
    cell2.innerHTML = "   <br><input  class='form-control' id='txtReferencia"+FilaNum+"' placeholder='Ingrese Referencia...'>  <br>"+
    "<textarea placeholder='Observación' id='txtObservacion"+FilaNum+"' class='form-control' style='min-width: 200px;max-width:200px;min-height: 100px;max-height: 100px;'></textarea>  <br>";
    cell2.style.padding="2px";
    cell3.innerHTML="             <select class='form-control display-inline-block' id='ddlUDM"+FilaNum+"'>"+OptionUDM+"</select>";
    cell4.innerHTML="<select class='form-control display-inline-block' id='ddlTipoEnvio"+FilaNum+"'>"+OptionTE+"</select>";
    cell5.innerHTML = "<table class='table table-bordered' style='margin: 0;' id='tblReferenciaNewFila"+FilaNum+"'> "+
                                        "<thead>"+
                                        "<th>Foto</th><th style='width:16%;'>Estilo</th>"+
                                              "<th style='width:33%;'>Color</th>"+
                                              "<th style='width:15%;'>Talla</th>"+
                                              "<th style='width:13%;'>Cantidad</th>"+ 
                                        "<th>"+
                                           "<button class='btn btn-default' onclick='ClonarNewFilaReferencia(\""+FilaNum+"\");'><i class='glyphicon glyphicon-plus'></i></button> "+
                                          "<button class='btn btn-default'  onclick='NeWFilaReferencia(\""+FilaNum+"\");'><i class='glyphicon glyphicon-minus'></i></button>"
                                           +"</th>"+
                                     " </thead>"+
                                      "<tbody>"+
                                        "<tr>"+
                                        "<td><label class='btn btn-default' for='myImgEstilo"+Num+"' onchange ='AgregarImagenEstilo(\""+Num+"\");'>"+
                                                  "<form  enctype='multipart/form-data'>"+
                                                  "<input id='myImgEstilo"+Num+"' type='file' name='File' accept='image/*' style='display:none;'"+ 
                                                  "/></form>"+
                                                  "<i class='glyphicon glyphicon-plus'></i>"+
                                              "</label><br>"+
                                                "<img  src='../img/img.png' onclick='MostrarImagen(this);' width='75' height='80' id='txtFotoEstilo"+Num+"' ><br><label class='btn btn-default'  onclick='EliminarImgEstilo(\""+Num+"\");'><i class='glyphicon glyphicon-remove'></i></label>"+                                               "</td>"+
                                        "<td style='display: none;'><input type='text' id='txtCodigo"+Num+"' value='"+FilaNum+"'/> </td>"+
                                          "<td>"+
                                          "<select class='form-control display-inline-block' id='ddlEstilo"+Num+"'>"+OptionE+"</select>"+
                                        "</td>"+
                                       "<td>"+
                                         "  <select class='float-left form-control w-50 ' id='ddlColor"+Num+"' >"+OptionC+"</select>"+
                                              "<input  placeholder='Ingrese Codigo'  class='form-control w-50' id='txtColor"+Num+"'>"+
                                        "</td>"+
                                        "<td>"+
                                          "<input type='text' class='form-control display-inline-block' id='ddlTalla"+Num+"' placeholder='Talla'>"
                                          +
                                        "</td>"+ 
                                         "<td>"+
                                          "<input class='form-control display-inline-block' placeholder='Cantidad' min='1' type='number'  id='txtCantidad"+Num+"'>"+
                                         "</td>"+
                                        " <td>"+
                                          "<button class='btn btn-default' onclick='AgregarProductoPedido(\""+Num+"\");'><i class='glyphicon glyphicon-floppy-disk'></i></button><button style='margin-left:4px;' class='btn btn-default' onclick='EliminarLote(\""+Num+"\");'>"+
                                                  "<i class='glyphicon glyphicon-remove'></i></button>"+
                                         "</td>"+
                                        "</tr>"+
                                     " </tbody>"+
                                      "</table>";                
}
function NewFila() {
    var nFilas = $("#tblReferencia > tbody").children().length;
    if(nFilas>1){
    document.getElementById("tblReferencia").deleteRow(1);
    }
}

</script>
