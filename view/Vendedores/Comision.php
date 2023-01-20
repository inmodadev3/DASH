<?php
    $blnPermiso=false;  
    $intTipoVista=0;
    $strDdlVista='';
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==13){
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
		<div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-user fa-fw"></i> Comisión
        </div>
        <div class="panel-body">	
        
        	<div class="row">
        		<div class="col-lg-4" style="float: right;">
              <br>
              <div class="row">
               <!-- <div class="col-lg-3"><button disabled="disabled" id='btnNuevo' class="btn btn-default" onclick="NuevaComision()">Nuevo</button></div>-->
                <div class="col-lg-9"><input type="number" placeholder="Cedula" id='txtCedulaVendedor' class="form-control" style="display: inline;" onkeypress="KeyPressEnter(event);"></div>
              </div>  
        			
        		</div>
        		<div class="col-lg-8">       		
        			<h2>Comision</h2>
        		</div>
        	</div>	
        	<hr>
                    <label>Vendedor: <label id='lblVendedor'></label> </label><br>
                    <label>Mes </label>
            <select class='form-control' onchange="ListarLiquidacion()" id='ddlMes' style="width: 20%;display: inline-block;">
             

            </select>          
                 <label>Año </label>
                <select class='form-control' id='ddlAnno' onchange="LlenarDdl()" style="width: 20%;display: inline-block;"></select>
                <label>Compañia </label>
                <select class='form-control' id='ddlCompania' style="width: 20%;display: inline-block;" onchange="ListarLiquidacion()">
                <?php   
                  echo $strDdlVista;
                ?>
                </select><br><br>
                <label>Periodo</label>
                <select class='form-control'  id='ddlPeriodo' style="width: 20%;display: inline-block;">
                </select>
        	<button style="float: right;" type="button" id='btnGenerarLiquidacion' class="btn btn-default" onclick="GenerarComision();" disabled="disabled">Generar</button>    
        	<table class="table">
        		<thead>
        			<th>
        				#
        			</th>
                <th>
                Total
              </th>
                <th>
                Creación
              </th>
                <th>
                Detalle
              </th>
                  <th>
                Acción
              </th>
        		</thead>
        		<tbody id='tbodyLiquidaciones'>
        		
        		</tbody>
        	</table>
          <hr>
              <div class="input-group">
              <span class="input-group-addon" ><i class="fa fa-search"></i></span>
              <input type="text" class="form-control" placeholder="Buscar" id='txtBuscarVendedorNoParametrizado'>
          </div><br>
          <div style="overflow-y: scroll;height:200px; ">             
                <table class="table table-striped table-hover" id='tblVendedores'>
                  <thead>
                    <th>#</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Tipo Empleado</th>
                    <th>Asignar</th>
                  </thead>
                  <tbody id='tblVendedore'>

                  </tbody>
                </table>
              </div>
        </div>
        </div>	
	</div>
</div>	
<footer  style="height: 200px;">
  


</footer>

</div>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id='mdlEgresos'>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="padding: 25px;">
      <h3>Egresos a efectuar</h3>
      <hr>
      <table class='table' id='tblEgresos'>
            <theah>
              <th>Efectuar</th>
              <th>#</th>
              <th>Nombre</th>
              <th>Valor</th>
              <th>Tipo Egreso</th>
              <th>Cuotas</th>
              <th>Monto Total</th>
            </theah>
             <tbody id='CntEgresos'>
             <tbody>
      </table>
      <hr>
      <button type="button" class="btn btn-default" onclick="EfectuarEgresos(1);" id='btnAceptarEgresos'>Aceptar</button>
      <button type="button" class="btn btn-default" onclick=" Cancelar()">Cancelar</button>
      <input type="hidden" id='txtPeriocidad'>
    </div>
  </div>
</div>
<script type="text/javascript">
     LlenarDdl();
     function Cancelar(){
      $('#mdlEgresos').modal('hide');
      EfectuarEgresos(0);
     }

     function NuevaComision(){
        document.getElementById("btnNuevo").disabled = true;
        document.getElementById('txtCedulaVendedor').readOnly=false;
        document.getElementById('ddlPeriodo').disabled=false;
        document.getElementById('txtCedulaVendedor').value='';
        document.getElementById('lblVendedor').innerHTML='';
        document.getElementById('tbodyLiquidaciones').innerHTML='';
        document.getElementById('btnGenerarLiquidacion').disabled=true;
         LlenarDdl();
         var ddlMes=document.getElementById('ddlMes');
         for(var i=0;i<=2;i++){
             $("#ddlPeriodo option[value='"+i+"']").remove();
         }
         ddlMes.selectedIndex=0;
     }
     function LlenarDdl(){
             $("#ddlPeriodo").removeAttr("disabled");
             document.getElementById('btnGenerarLiquidacion').disabled=false;
              document.getElementById('tbodyLiquidaciones').innerHTML='';
              $("#ddlPeriodo option").remove();
              var Fecha=new Date(); 
              var strMeses = ["Seleccione..","Enero", "Febrero", "Marzo",'Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
              $('#ddlAnno').append("<option value='"+Fecha.getFullYear()+"'>"+Fecha.getFullYear()+"</option>");
              var intAnnoSelect=document.getElementById('ddlAnno').value;
               
              $("#ddlAnno option").remove();
              for(var i=Fecha.getFullYear();i>=2018;i--){
                 $('#ddlAnno').append("<option value='"+i+"'>"+i+"</option>");
              }
      
              $("#ddlAnno > option[value="+intAnnoSelect+"]").attr("selected",true);
              var intAnno=document.getElementById('ddlAnno').value.trim();
              $("#ddlMes option").remove();

             if(intAnno==Fecha.getFullYear()){   
              var intMeses=(Fecha.getMonth()+1);
              if(Fecha.getDate()>=16){
                intMeses=intMeses+1; 
              }
              if((Fecha.getMonth()+1)==1){
                intMeses=1;
              }

                for(var i=1;i<=intMeses+1;i++){  
                  $('#ddlMes').append("<option value='"+(i-1)+"'>"+strMeses[(i-1)]+"</option>");
              }}else{
                for(var i=1;i<=13;i++){  
                  $('#ddlMes').append("<option value='"+(i-1)+"'>"+strMeses[(i-1)]+"</option>");
              } }
              

         
    }
    function LlenarDdlPeriodo(){
              var Fecha=new Date(); 
              var intMeses=(Fecha.getMonth()+1)-1;
              if(Fecha.getDate()>=16){
                intMeses=intMeses+1;
              } 
              var ultimoDia = new Date(Fecha.getFullYear(), intMeses, 0);

              /*if(Fecha.getHours()=='19'){
              if(ultimoDia.getDate()==Fecha.getDate()){
                $("#ddlPeriodo [value='2']").remove();
                $("#ddlPeriodo [value='0']").remove();
                $('#ddlPeriodo').append("<option value='2'>2</option>");
                $('#ddlPeriodo').append("<option value='0'>Mes</option>");
              }*/ 
              
    }
                    function KeyPressEnter(e){
                        tecla = (document.all) ? e.keyCode : e.which;
                        if(tecla==13){
                            ConsultarVendedor();
                        }
                    }
                    function ConsultarVendedor(){
                      var txtCedulaVendedor=document.getElementById('txtCedulaVendedor');
                      if(txtCedulaVendedor.value==''){
                        return;
                      }
                      $('#btnNuevo').removeAttr('disabled');
                      txtCedulaVendedor.readOnly='readonly';
                            var parametros = {
                              "btnConsultarVendedor" : 'true',
                              "strCedula":txtCedulaVendedor.value.trim()
                            };
                           $.ajax({
                            data:  parametros,
                            url:   '../Controller/ParametrizarVendedorController.php',
                            type:  'post',                        
                            success:  function (response) { 
                             
                              strMensaje=response.split("%");
                              if(strMensaje[1]=='error'){

                                Mensaje(strMensaje[1],strMensaje[0]);
                                return;
                              }
                             
                              document.getElementById('lblVendedor').innerHTML=strMensaje[0];
                                     ListarLiquidacion();
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                        });   
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
                        function GenerarComision(){
                          var txtCedulaVendedor=document.getElementById('txtCedulaVendedor');
                          if(txtCedulaVendedor.value.trim()==''){
                             swal({
                                  type: 'error',
                                  title: 'Generar Comision',
                                  text: 'Ingrese cedula del vendedor'
                                });
                            txtCedulaVendedor.focus();
                          }
                       
                         document.getElementById('btnGenerarLiquidacion').disabled=true;
                            var parametros = {
                              "btnGenerarComision" : 'true',
                              "strCedula":document.getElementById('txtCedulaVendedor').value.trim(),
                              "intPeriodo":document.getElementById('ddlPeriodo').value,
                              "strMes":document.getElementById('ddlMes').value,
                              "intAnno":document.getElementById('ddlAnno').value,
                              "intCompania":document.getElementById('ddlCompania').value
                            };
                            $.ajax({
                            data:  parametros,
                            url:   '../Controller/ParametrizarVendedorController.php',
                            type:  'post',                        
                            success:  function (response) {
                                document.getElementById('btnGenerarLiquidacion').disabled=false;
                              if(response=='8'){
                                swal({
                                  type: 'error',
                                  title: 'Parametrizar Vendedor',
                                  text: 'El vendedor no esta parametrizado.'
                                  
                                });
                                return;
                              }else if(response=='9'){
                                 swal({
                                  type: 'error',
                                  title: 'Asignación Lineas',
                                  text: 'El vendedor no tiene lineas asignadas.'
                              
                                });
                                 return;
                              }

                              console.log(response);
                              ListarEgresosComision();
                              document.getElementById('txtPeriocidad').value=document.getElementById('ddlPeriodo').value;
                              ListarLiquidacion();
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                        });  
                        }
                         function ListarLiquidacion(){

                          if(document.getElementById('ddlMes').value==0){
                            $("#ddlPeriodo").removeAttr("disabled");
                            document.getElementById('btnGenerarLiquidacion').disabled=false;
                            document.getElementById('tbodyLiquidaciones').innerHTML='';
                             $("#ddlPeriodo option").remove();
                            return;
                          }
                            var parametros = {
                              "btnListarLiquidacion" : 'true',
                              "strCedula":document.getElementById('txtCedulaVendedor').value.trim(),
                              "intAnno":document.getElementById('ddlAnno').value,
                              "intCompania":document.getElementById('ddlCompania').value,
                              "intMes":document.getElementById('ddlMes').value

                            };
                            $.ajax({
                            data:  parametros,
                            url:   '../Controller/ParametrizarVendedorController.php',
                            type:  'post',                        
                            success:  function (response) { 
                             
                             document.getElementById('tbodyLiquidaciones').innerHTML=response;
                             ConsultarLiquidacionPeriodo();
                          
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                        });  
                        }
                       function ConsultarLiquidacionPeriodo(){
                        var txtCedulaVendedor=document.getElementById('txtCedulaVendedor');
                            if(txtCedulaVendedor.value==''){
                              return;
                            }
                            var parametros = {
                              "btnListarLiquidacionPeriodo" : 'true',
                              "strCedula":txtCedulaVendedor.value.trim(),
                               "intAnno":document.getElementById('ddlAnno').value,
                              "intCompania":document.getElementById('ddlCompania').value,
                              "intMes":document.getElementById('ddlMes').value
                            };
                            $.ajax({
                            data:  parametros,
                            url:   '../Controller/ParametrizarVendedorController.php',
                            type:  'post',                        
                            success:  function (response) { 

                             // var value=document.getElementById('ddlMes').value;
                              //$('#ddlMes option').remove();
                              //LlenarDdl();
                              //document.getElementById('ddlMes').value =value;
                             var strDatosUno=response.split("&");
                             var strDatosDos='';
                             var blnEstado=true;
                             var intMes=12;
                             var intMes;
                             
                             $("#ddlPeriodo option[value='1']").remove();
                             $("#ddlPeriodo option[value='2']").remove();
                             $("#ddlPeriodo option[value='0']").remove();
                           
                            // $('#ddlPeriodo').append("<option value='2'>2</option>");
                             $('#ddlPeriodo').append("<option value='0'>Mes</option>");
                               $('#ddlPeriodo').append("<option value='1'>1</option>");      
                             $("#ddlPeriodo").removeAttr("disabled");
                             if(response!=''){
                             /*for(var i=1;i<=12;i++){
                                 blnEstado=true;
                                 for(var j=0;j<=strDatosUno.length-1;j++){
                                   strDatosDos=strDatosUno[j].split('%');    
                                   if(i==strDatosDos[0]){
                                    blnEstado=false;
                                    break;
                                   }
                                 }
                                 if(blnEstado){
                                   intMes=intMes-1;
                                  
                                 }
                             } */
                             var blnEstadoPeriodo=true;
                              var intValorddl=document.getElementById('ddlMes');
                              for(var i=0;i<=strDatosUno.length-1;i++){
                                strDatosDos=strDatosUno[i].split('%');
                                if(strDatosDos[0]==intValorddl.value){
                                if(strDatosDos[1]==1){   
                                   $("#ddlPeriodo option[value='1']").remove();
                                   blnEstadoPeriodo=false;
                                   $('#ddlPeriodo').append("<option value='2'>2</option>");
                                   $("#ddlPeriodo option[value='0']").remove();
                                }else
                                if(strDatosDos[1]==2){
                                   $("#ddlPeriodo option[value='2']").remove();
                                    $("#ddlPeriodo option[value='1']").remove();
                                     blnEstadoPeriodo=false;
                                     $("#ddlPeriodo option[value='0']").remove();
                                   $('#ddlPeriodo').attr('disabled', 'disabled');
                                }else
                                if(strDatosDos[1]==0){
                                    $('#ddlPeriodo').attr('disabled', 'disabled');
                                    $("#ddlPeriodo option[value='1']").remove();
                                    $("#ddlPeriodo option[value='2']").remove();
                                     blnEstadoPeriodo=false;
                                    $("#ddlPeriodo option[value='0']").remove();
                                }
                                }
                              }
                            }
                             
                              /*if(strDatosUno==''){
                                intCantMeses=2;
                              }else{
                               strDatosDos=strDatosUno[strDatosUno.length-2].split('%');
                                intCantMeses=parseInt(strDatosDos[0])+2;
                                if(document.getElementById('ddlPeriodo').length==0){
                                  intCantMeses=parseInt(strDatosDos[0])+2;
                                }
                              }
                              var blnEstadoUno=true;
                              var blnEstadoDos=true;
                          
                             

                           
                               for(var i=intCantMeses;i<=12;i++){
                                      $("#ddlMes option[value='"+i+"']").remove();
                                }*/
                            /*  if(document.getElementById('ddlMes').length!=1){
                                var ddlMes=document.getElementById('ddlMes').length-2;
                              var intMes;
                             for(var i=0;i<=strDatosUno.length-1;i++){
                                strDatosDos=strDatosUno[i].split('%'); 
                                if(strDatosDos[0]==ddlP.options[ddlMes].value){
                                if(strDatosDos[1]==0){
                                  blnEstadoDos=false;  
                                  break;
                                }
                                if(strDatosDos[1]==2){
                                  blnEstadoDos=false;
                                }
                                 intMes=parseInt(strDatosDos[0])+1;
                              }
                            }
                             if(blnEstadoDos){
                                 $("#ddlMes option[value='"+intMes+"']").remove();
                              }
                            }*/

                         
 var ddlP=document.getElementById('ddlMes');
 var ddlAnno=document.getElementById('ddlAnno');

                                var Fecha= new Date();
                           
                              /*if(document.getElementById('ddlMes').length==1){
                                 //$('#ddlPeriodo').append("<option value='2'>2</option>");
                                $('#ddlPeriodo').append("<option value='0'>Mes</option>");
                              }*/
                        //    
          ///              if(true){ 
                            //  if((Fecha.getMonth()+1)==1){
                                  //$('#ddlPeriodo').append("<option value='2'>2</option>");
                                  //$('#ddlPeriodo').append("<option value='0'>Mes</option>");  
                            //  }
                           /* if(blnEstadoPeriodo){
                            if(document.getElementById('ddlMes').value<(Fecha.getMonth()+1)){
                               ///$('#ddlPeriodo').append("<option value='2'>2</option>");
                               $('#ddlPeriodo').append("<option value='0'>Mes</option>");  
                             }}*/
        //  }

                            /* if((Fecha.getMonth()+1)==ddlP.value && (Fecha.getFullYear()==ddlAnno.value)){
                                  $("#ddlPeriodo option[value='0']").remove();
                                  $("#ddlPeriodo option[value='2']").remove();
                              }

                              if(ddlP.value==12 && Fecha.getDate()>=28){
                                  $('#ddlPeriodo').append("<option value='0'>Mes</option>");  
                                  $('#ddlPeriodo').append("<option value='2'>2</option>");  
                              }



                              if(document.getElementById('ddlPeriodo').length==0){
                                document.getElementById('btnGenerarLiquidacion').disabled=true;
                              }else{
                                document.getElementById('btnGenerarLiquidacion').disabled=false;
                              }*/
                            
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                        });  
                        }


                        function ImprimirLiquidacion(IntNumeroLiq){
                            var parametros = {
                              "btnImprimirLiquidacion" :'true',
                              "intNroLiquidacion":IntNumeroLiq
                            };
                            $.ajax({
                            data:  parametros,
                            url:   '../Controller/ParametrizarVendedorController.php',
                            type:  'post',                        
                            success:  function (response) { 
                         
                              window.open('../Controller/InformeLiquidacionController.php', '_blank');
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                        });
                        }
                        function ListarEgresosComision(){
                            var txtCedulaVendedor=document.getElementById('txtCedulaVendedor');
                            if(txtCedulaVendedor.value==''){
                              alert('Ingrese vendedor.');
                              return;
                            }
                        var parametros={
                             "btnListarEgresosComision":'true',
                              "intCedulaVendedor":txtCedulaVendedor.value.trim(),
                              "intCompania":document.getElementById('ddlCompania').value,
                              "intMes":document.getElementById('ddlMes').value,
                              "intAnno":document.getElementById('ddlAnno').value,
                              "intPeriodo":document.getElementById('ddlPeriodo').value

                        }
                        $.ajax({
                                    data:  parametros,
                                    url:   '../Controller/ParametrizarVendedorController.php',
                                    type:  'post',                           
                                    success:  function (response){
                                        $('#mdlEgresos').modal({backdrop: 'static', keyboard: false});
                                      $('#mdlEgresos').modal('show');
                                      if(response.trim()!='0'){
                                    
                                        document.getElementById('btnAceptarEgresos').disabled=false;
                                      document.getElementById('CntEgresos').innerHTML=response;
                                     }else{
                                      document.getElementById('CntEgresos').innerHTML='<tr><td>No dispone de egresos para aplicar.</td></tr>';
                                      document.getElementById('btnAceptarEgresos').disabled=true;
                                     }
                                    },
                                    error: function (error) {
                                        alert('error; ' + eval(error));
                                    }
                                  });
                      }
                      function EfectuarEgresos(Tipo){
                          var intNrFilas=$("#tblEgresos tr").length;
                          var tblEgresos=document.getElementById('tblEgresos');
                          var CtnMatrizEgreso='';
                          var intContador=0;
              
                          if(Tipo==1){
                          for( i=1;i<=(intNrFilas-1);i++){
                            if(document.getElementById('chkEgreso'+(i-1)).checked){
                                intChkEstado='1';  
                            }else{
                               intChkEstado='0';  
                            }
                           
                
                            CtnMatrizEgreso+=intChkEstado+'%'+tblEgresos.rows[i].cells[2].innerHTML+'%'+tblEgresos.rows[i].cells[4].innerHTML+'&';}
                          }
                          
                          var parametros={
                             "btnEfectuarEgresos":'true',
                             "mtEgresos":CtnMatrizEgreso, 
                             "intCedulaVendedor":txtCedulaVendedor.value.trim(),
                             "intCompania":document.getElementById('ddlCompania').value,
                             "intPeriodo":document.getElementById('txtPeriocidad').value.trim(),
                             "intMes":document.getElementById('ddlMes').value,
                             "intAnno":document.getElementById('ddlAnno').value 

                          };
                          $.ajax({
                                    data:  parametros,
                                    url:   '../Controller/ParametrizarVendedorController.php',
                                    type:  'post',                           
                                    success:  function (response){
                                    //console.log(response);
                                    $('#mdlEgresos').modal('hide');
                                     ListarLiquidacion();
                                    },
                                    error: function (error) {
                                        alert('error; ' + eval(error));
                                    }
                                });
                      }
                      function EliminarLiquidacion(intIdLiquidacion){
                        var parametros={
                             "btnEliminarLiquidacion":'true',
                             "intIdLiquidacion":intIdLiquidacion, 

                          };
                          $.ajax({
                                    data:  parametros,
                                    url:   '../Controller/ParametrizarVendedorController.php',
                                    type:  'post',                           
                                    success:  function (response){
                                    Mensaje('success',response);
                                   
                                     ListarLiquidacion();
                                    },
                                    error: function (error) {
                                        alert('error; ' + eval(error));
                                    }
                                });
                      }
                     Vendedores();
                      function Vendedores(){
                        var parametros = {
                          "btnListarVendedoresNoParametrizados" : 'true'
                         };
                      $.ajax({
                            data:  parametros,
                            url:   '../Controller/ParametrizarVendedorController.php',
                            type:  'post',                           
                            success:  function (response) {  
                              document.getElementById('tblVendedore').innerHTML=response;
                             
                              
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                      });}

                        $(document).ready(function (){ 
                                  (function ($) {     
                                      $('#txtBuscarVendedorNoParametrizado').keyup(function () {
                                          var rex = new RegExp($(this).val(), 'i');
                                          $('#tblVendedore tr').hide();
                                          $('#tblVendedore tr').filter(function () {                    
                                              return rex.test($(this).text());
                                    
                                          }).show();
                                      }) 
                                  }(jQuery));
                        
                      });
                        
                        function SeleccionarVendedor(intNroFila){
                          var tblVendedores=document.getElementById('tblVendedores');
                          var txtComisionVendedor=document.getElementById('txtCedulaVendedor');
                          txtComisionVendedor.value=tblVendedores.rows[intNroFila].cells[1].innerHTML;
                          $("#ddlMes > option[value='0']").prop("selected",true);
                           $("#ddlCompania > option[value='1']").prop("selected",true);
                          ConsultarVendedor();
                        
                        }
</script>
<style type="text/css">
    .swal2-container {
     zoom : 1.4 ;
     -moz-transform: scale(1.4);
    }    
</style>