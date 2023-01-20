<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==14){
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
<button type="button" style="background:#337ab7;" class="btn" data-toggle="modal" data-target="#Primero"><i style="color:#fff;" class="fa fa-question-circle fa-fw"></i></button>

<div class="modal fade" id="Primero">
  <div class="modal-dialog">
    <div class="modal-content">

      
      <div class="modal-header">
        <h4 class="modal-title" style="display: inline-block;">Ayuda</h4>
        <button type="button" class="close" data-dismiss="modal" style="display: inline-block;">&times;</button>
      </div>
      <div class="modal-body">
     	Aquí podra registrar todos los movimientos que estaran disponibles para el vendedor en su comisión.
      </div>      
    </div>
  </div>
</div>
<br>
<br>
<div class="row">
  <div class="col-lg-12">
    <h3>Movimientos</h3>
    <span id='cntRdMD' style="display: none;">
    <input type="radio" name="rdbEmpleado"  id='rdbMD' onchange="DdlEmpleados();">
    <label id='rdbMD'>Madrinas</label>
    </span>
    <span id='cntRdVE'  style="display: none;">
    <input type="radio" name="rdbEmpleado" id='rdbVE' onchange="DdlEmpleados();">
    <label for='rdbVE'>Vendedores externos</label>
    </span>
    <span id='cntRdVBG'  style="display: none;">
    <input type="radio" name="rdbEmpleado" id='rdbVBG' onchange="DdlEmpleados();">
    <label for='rdbVBG'>Vendedores bodega</label>
    </span>
    <div class="row">
    <div class="col-lg-3">
    <label>Vendedores asociados</label>
    <select class="form-control" id='ddlEmpleados' onchange="ConsultarCompaniaEmpleadosAsociados();"><option></option></select>
      </div>
      <span id='ctnCartera'>
      <div class="col-lg-3">
      <label>Mes</label>
      <select class="form-control" id='ddlMes' onchange="ConsultarDocumentos()">
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
      <div class="col-lg-3">
      <label>Año</label>
      <select class="form-control" id='ddlAnno' onchange="ConsultarDocumentos()">
      </select>
      </div>
      </span>
      <div class="col-lg-3">
      <label>Compañia</label>
      <select class="form-control" id='ddlCompania' onchange="ConsultarDocumentos()"><option></option></select>
      </div>
    </div>
    <br>  
    <div>
      
      <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active" onclick="document.getElementById('ctnCartera').style.display='inline'"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" >Facturas</a></li>
      <li role="presentation" onclick="document.getElementById('ctnCartera').style.display='none'"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Cartera</a></li>
      <li role="presentation" onclick="document.getElementById('ctnCartera').style.display='inline'"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Recaudos</a></li>
      <li role="presentation" onclick="document.getElementById('ctnCartera').style.display='inline'"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Liquidadas</a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
          <br>
          <div class="row">
            <div class="col-lg-8">
              <div class="input-group">
                <span class="input-group-addon" ><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Buscar" id='txtBuscarEmpleadosDocumentos'>
              </div>
            </div>
            <div class="col-lg-4">
               <label>Total:</label>
               <label id='intValorTotalFacturas'>0</label>
            </div>
        </div>
          <br>
           <div style="overflow: scroll;height: 450px;">
              <table class="table table-striped" id='tblDocumentos'>
                <thead>
                  <th>Documento</th>
                  <th>Tipo</th>
                  <th>Cliente</th>
                  <th>Subtotal</th>
                  <th>Iva</th>
                  <th>Total</th>
                  <th>Facturado</th>
                  <th>Cedula Vendedor</th>
                  <th>Vendedor</th>
                </thead>
                <tbody id='tbodyfacturas'>
                      
                </tbody>
              </table>
           </div> 
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">
              <br>
              <div class="row">
              <div class="col-lg-8">
              <div class="input-group">
                  <span class="input-group-addon" ><i class="fa fa-search"></i></span>
                  <input type="text" class="form-control" placeholder="Buscar" id='txtBuscarEmpleadosCartera'>
              </div>
             </div>
              <div class="col-lg-4">
               <label>Total Propias:</label>
               <label id='intValorTotalCartera'>0</label>
              </div>
              </div>
              <br>
           <h3>Propias</h3>
          <div style="overflow: scroll;height: 450px;">
              <table class="table table-striped" id='tblCartera'>
                <thead>
                  <th>Documento</th>
                  <th>Cliente</th>
                  <th>Fecha Generada</th>
                  <th>Fecha Vencimiento</th>
                  <th>Total</th>
                  <th>Ciudad</th>
                  <th>Tiempo</th>
                  <th>Telefono</th>
                  <th>Celular</th>
                </thead>
                <tbody id='tbodycartera'>
                  
                </tbody>
              </table>
           </div> 
           <hr>
           <h3>Oportunidad de recaudo</h3>
              <div style="overflow: scroll;height: 450px;">
              <table class="table table-striped" id='tblCartera'>
                <thead>
                  <th>Documento</th>
                  <th>Cliente</th>
                  <th>Fecha Generada</th>
                  <th>Fecha Vencimiento</th>
                  <th>Total</th>
                  <th>Ciudad</th>
                  <th>Tiempo</th>
                  <th>Telefono</th>
                  <th>Celular</th>
                </thead>
                <tbody id='tbodycarteraciudad'>
                  
                </tbody>
              </table>
           </div> 
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">
          <br>
            <div class="row">
              <div class="col-lg-6">
              <div class="input-group">
                  <span class="input-group-addon" ><i class="fa fa-search"></i></span>
                  <input type="text" class="form-control" placeholder="Buscar" id=''>
              </div>
             </div>
              <div class="col-lg-2">
               <label>Total:</label>
               <label id='intValorTotalPagadas'>0</label>
              </div>
               <div class="col-lg-4">
                <div class="row">
                  <div class="col-lg-4">
                    <label >Tipo Recaudo</label>
                  </div>
                  <div class="col-lg-8">
                      <select class="form-control" id='ddlTipoRecaudo' onchange="ConsultarDocumentos();"><option value="RC">Recaudo Terceros</option><option value="RCVN">Recaudo segun ventas</option></select>
                  </div>
                 </div>     
               </div>    
              </div>
           <br>
          <div style="overflow: scroll;height: 450px;">
              <table class="table table-striped">
                <thead>
       
                  
                  <th>Nro Doc_Pago</th>
                  <th>Nro Doc_Venta</th>
                     <th>Fecha Venta</th>
                        <th>Fecha Recaudo</th>
                           <th>Valor</th>
                              <th>Descuento</th>
                </thead>
                <tbody id='tbodypagadas'>
                  
                 </tbody>
              </table>
           </div> 
        </div>
        <div role="tabpanel" class="tab-pane" id="settings">
          <br>
          <div class="row">
          <div class="col-lg-8">
              <div class="input-group">
                  <span class="input-group-addon" ><i class="fa fa-search"></i></span>
                  <input type="text" class="form-control" placeholder="Buscar" id='txtBuscarEmpleadosLiquidacion'>
              </div>
             </div>
              <div class="col-lg-4">
                 <label>Total:</label>
                 <label id='intValorTotalLiquidadas'>0</label><br>
                 <label>Total a pagar:</label>
                 <label id='intValorTotalLiquidadasAPagar'>0</label>
               </div>
             </div>

              <br>
          <div style="overflow: scroll;height: 450px;">
              <table class="table table-striped" id='tblliquidas' >
                <thead>
                  <th>Tipo de documento</th>
                  <th>Documento</th>
                  <th>Recibo</th>
                  <th>Valor</th>
                  <th>Porcentaje</th>
                  <th>Valor a pagar</th>
                  <th>Fecha de pago</th>
                </thead>
                <tbody  id='tbodyliquidadas'></tbody>
                  
              </table>
           </div> 
        </div>
      </div>
    </div>
  </div>  
</div> 

<div class="modal fade bs-example-modal-lg"  tabindex="-1" role="dialog" id='mdProductos' aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 90%;">
    <div class="modal-content">
    <div style="overflow-x: scroll;width:100%;">
     <table class="table">
        <thead>
          <th>Foto</th>
          <th><strong>Referencia</strong></th>
          <th>Descripción</th>
          <th>Valor Unitario</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
          <th>Iva</th>
          <th>Total</th>
             </thead>
          <tbody id='tbodyproductos'>
            
          </tbody>
     
     </table>
   </div>
    </div>
  </div>
</div>
<footer style="height: 200px">
  
</footer> 
<script type="text/javascript">
   var Fecha=new Date(); 
   for(var i=Fecha.getFullYear();i>=2018;i--){
                 $('#ddlAnno').append("<option value='"+i+"'>"+i+"</option>");
      }
  
    function Mensaje(strTipo,strMensaje){
     const toast = swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    background: '#FFFFB0'
                                  });

                                  toast({
                                    type:strTipo,
                                    title: "<span style='color:#686868'>"+strMensaje+"</span>"
                                  });
  }
 
  ConsultarTipoEmpleado();
  function ConsultarTipoEmpleado(){
     var parametros={
                             "btnConsultarTipoEmpleado":'true'
                    };
                        $.ajax({
                                    data:  parametros,
                                    url:   '../Controller/ParametrizarVendedorController.php',
                                    type:  'post',                           
                                    success:  function (response){
                                      var strDatos=response.trim().split('%');
                                      var strTipoEmp='';
                                      if(strDatos[0]!=1){
                                      for(j=1;j<=3;j++){
                                        switch(j){
                                          case 1:
                                          strTipoEmp='MD';
                                          break;
                                          case 2:
                                          strTipoEmp='VE';
                                          break;

                                          case 3:
                                          strTipoEmp='VBG';
                                          break;
                                        }
                                      for(i=0;i<=strDatos.length-1;i++){
                                          if(strDatos[i]==strTipoEmp){
                                            switch(j){
                                              case 1:
                                              document.getElementById('cntRdMD').style.display='inline';
                                              if(!(document.getElementById('rdbVE').checked) && !(document.getElementById('rdbVBG').checked)){
                                              document.getElementById('rdbMD').checked=true;}
                                              break;
                                              case 2:
                                              document.getElementById('cntRdVE').style.display='inline';
                                               if(!(document.getElementById('rdbMD').checked) && !(document.getElementById('rdbVBG').checked)){
                                               document.getElementById('rdbVE').checked=true;}
                                              break;
                                              case 3:
                                              document.getElementById('cntRdVBG').style.display='inline';
                                              if(!(document.getElementById('rdbMD').checked) && !(document.getElementById('rdbVE').checked)){
                                              document.getElementById('rdbVBG').checked=true;}
                                              break;
                                            }
                                          }
                                      }
                                      }
                                    }else{
                                        document.getElementById('rdbMD').checked=true;
                                        document.getElementById('cntRdVBG').style.display='inline';
                                        document.getElementById('cntRdVE').style.display='inline';
                                        document.getElementById('cntRdMD').style.display='inline';
                                    }
                                        DdlEmpleados(); 
                                    },
                                    error: function (error) {
                                        alert('error; ' + eval(error));
                                    }
                                });  
  }
  function DdlEmpleados(){
    document.getElementById('tbodyliquidadas').innerHTML='';
   document.getElementById('tbodyfacturas').innerHTML='';
   document.getElementById('tbodycartera').innerHTML='';
   document.getElementById('tbodypagadas').innerHTML=''; 
    var rdbMD=document.getElementById('rdbMD');
    var rdbVBG=document.getElementById('rdbVBG');
    document.getElementById('ddlCompania').innerHTML='';
    document.getElementById('intValorTotalFacturas').innerHTML=0;
    document.getElementById('intValorTotalCartera').innerHTML=0;
    document.getElementById('intValorTotalLiquidadas').innerHTML=0;
     document.getElementById('intValorTotalLiquidadasAPagar').innerHTML=0;
    var strTipoEmpleado='VE';
    if(rdbMD.checked){
      strTipoEmpleado='MD';
    }else if(rdbVBG.checked){
      strTipoEmpleado='VBG';
    }
    var parametros={
                             "btnConsultarEmpleadosAsociados":'true',
                             "strTipoEmpleado":strTipoEmpleado
                    };
                        $.ajax({
                                    data:  parametros,
                                    url:   '../Controller/ParametrizarVendedorController.php',
                                    type:  'post',                           
                                    success:  function (response){
                              
                                      document.getElementById('ddlEmpleados').innerHTML=response;
                                    },
                                    error: function (error) {
                                        alert('error; ' + eval(error));
                                    }
                                });
  }
  function ConsultarCompaniaEmpleadosAsociados(){
    var strEmpleado=document.getElementById('ddlEmpleados');
    if(strEmpleado.value=='-1'){
      document.getElementById('ddlCompania').innerHTML='';
      document.getElementById('tbodycartera').innerHTML='';
      document.getElementById('tbodyfacturas').innerHTML='';
      document.getElementById('tbodypagadas').innerHTML='';
      document.getElementById('tbodyDocumentos').innerHTML='';
       document.getElementById('intValorTotalFacturas').innerHTML='0';
          document.getElementById('intValorTotalCartera').innerHTML='0';
          document.getElementById('intValorTotalLiquidadas').innerHTML='0';
           document.getElementById('intValorTotalLiquidadasAPagar').innerHTML='0';
          document.getElementById('intValorTotalPagadas').innerHTML='0';
      return;
    }
    var parametros={
                             "btnConsultarCompaniaEmpleadosAsociados":'true',
                             "strEmpleado":strEmpleado.value
                    };
                        $.ajax({
                                    data:  parametros,
                                    url:   '../Controller/ParametrizarVendedorController.php',
                                    type:  'post',                           
                                    success:  function (response){
                                        
                                     document.getElementById('ddlCompania').innerHTML=response;
                                     ConsultarDocumentos();
                                      (function ($) {     
                                        $('#txtBuscarEmpleadosDocumentos').keyup(function () {
                                            var rex = new RegExp($(this).val(), 'i');
                                            $('#tblDocumentos tr').hide();
                                            $('#tblDocumentos tr').filter(function () {                    
                                                return rex.test($(this).text());
                                         
                                            }).show();
                                        }) 
                                    }(jQuery));
                                    (function ($) {     
                                        $('#txtBuscarEmpleadosCartera').keyup(function () {
                                            var rex = new RegExp($(this).val(), 'i');
                                            $('#tblCartera tr').hide();
                                            $('#tblCartera tr').filter(function () {                    
                                                return rex.test($(this).text());
                                         
                                            }).show();
                                        }) 
                                    }(jQuery));
                                     (function ($) {     
                                        $('#txtBuscarEmpleadosLiquidacion').keyup(function () {
                                            var rex = new RegExp($(this).val(), 'i');
                                            $('#tblliquidas tr').hide();
                                            $('#tblliquidas tr').filter(function () {                    
                                                return rex.test($(this).text());
                                         
                                            }).show();
                                        }) 
                                    }(jQuery));
                                    },
                                    error: function (error) {
                                        alert('error; ' + eval(error));
                                    }
                                });
  }
  function ConsultarDocumentos(){
    var ddlCompania=document.getElementById('ddlCompania');
    var ddlAnno=document.getElementById('ddlAnno');
    var ddlMes=document.getElementById('ddlMes');
    var ddlEmpleado=document.getElementById('ddlEmpleados');
    var ddlTipoRecaudo=document.getElementById('ddlTipoRecaudo');
    var strTipoEmpleado='VBG';
    if(document.getElementById('rdbMD').checked){
      strTipoEmpleado='MD';
    }else if(document.getElementById('rdbVE').checked){
      strTipoEmpleado='VE';
    }

     var parametros={
                             "btnConsultarDocumentos":'true',
                             "intCompania":ddlCompania.value,
                             "strCedulaEmpleado":ddlEmpleado.value
                             ,"intMes":ddlMes.value
                             ,"intAnno":ddlAnno.value,
                             'strTipoEmpleado':strTipoEmpleado,
                             "ddlTipoRecaudo":ddlTipoRecaudo.value
                    };
                        $.ajax({
                                    data:  parametros,
                                    url:   '../Controller/ParametrizarVendedorController.php',
                                    type:  'post',                           
                                    success:  function (response){
                                      var strContenido=response.split('$$');

                                      console.log(strContenido);
                                
                                        
                                     document.getElementById('tbodyfacturas').innerHTML=strContenido[0];
                                           document.getElementById('tbodycartera').innerHTML=strContenido[1];
                                                 document.getElementById('tbodycarteraciudad').innerHTML=strContenido[2];
                                     document.getElementById('tbodypagadas').innerHTML=strContenido[3];
                                     document.getElementById('tbodyliquidadas').innerHTML=strContenido[4];


                                      document.getElementById('intValorTotalFacturas').innerHTML=strContenido[5]+' $';
                                      document.getElementById('intValorTotalCartera').innerHTML=strContenido[6]+ ' $';

                                       document.getElementById('intValorTotalPagadas').innerHTML=strContenido[7]+' $';

                                       document.getElementById('intValorTotalLiquidadas').innerHTML=strContenido[8]+ ' $';

                                       document.getElementById('intValorTotalLiquidadasAPagar').innerHTML=strContenido[9]+' $';
                                    },
                                    error: function (error) {
                                        alert('error; ' + eval(error));
                                    }
                                });
}
function ListarProductos(Transaccion,Documento){

  var ddlCompania=document.getElementById('ddlCompania');
  var parametros={
                             "btnListarProductos":'true',
                             "StrCompania":ddlCompania.value,
                             "StrTransaccion":Transaccion,
                             "StrDocumento":Documento
                             
                    };
                        $.ajax({
                                    data:  parametros,
                                    url:   '../Controller/ParametrizarVendedorController.php',
                                    type:  'post',                           
                                    success:  function (response){
                                     
                                     document.getElementById('tbodyproductos').innerHTML=response;
                                     $('#mdProductos').modal('show');
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
    th:hover{
      cursor: pointer;
    }
</style>