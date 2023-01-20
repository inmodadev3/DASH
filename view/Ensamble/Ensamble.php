<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==32){
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
<div id="page-wrapper" >	
<br><br>
<div class="panel panel-default" >
<div class="panel-body" >
<h4>Ensamble</h4>
<label>Referencia</label>
<div class="row">
	<div class="col-lg-6">
	 <div class='row'>
	 	<div class='col-lg-2'>
	 		<input type="number" onchange="ConsultarProducto();" min='1' class='form-control' value='1' id='txtCantReferencia'>
	 	</div>
	 	<div class='col-lg-10'>
	 	 <input type="text" id="txtReferencia" class='form-control' onkeypress="Enter(event);" style="display: inline-block;" placeholder="Buscar">
	 	</div>
	 </div>
	</div>

	<script type="text/javascript">
		function Enter(e)
		{
			tecla = (document.all) ? e.keyCode : e.which;
            if(tecla==13){
                ConsultarProducto();

            }
		}
	</script>
	<div class="col-lg-6">	
   		<button class="btn btn-default" onclick="ConsultarProducto();">Buscar</button>
   		<button class="btn btn-default" style="display: none;" id='btnPDFEnsamble' onclick="ImprimirPDFEnsamble()">PDF</button>
	</div>
</div>
<hr>
<label>Mano de obra</label>
 		<div class='row'>
   			<div class="col-lg-1">
   				<input type="number" onchange="ConsultarProducto();" min='1' class='form-control' value="1" id='txtCantManoObra'>
   			</div>
   			<div class="col-lg-4">
   				<input type="number" min='1' placeholder="Mano Obra" class='form-control' value="0" id='txtValorManoObra' onkeyup="ConsultarProducto();">

   			</div>	
   			<div class="col-lg-7">
   				<div style="width: 100%;">
				   	<textarea   style="width: 100%;height: 80px;resize: none;display: none;" id='txtAreaObservacion' maxlength="300" placeholder="Observación"></textarea>
				</div>
   			</div>
   		</div>	

<div style="overflow-x: scroll;">   		
<table class="table" id='tblEnsamble'>
	<thead>
		<th>Referencia</th>
		<th>Referencia 
		<br>ensamblada</th>
		<th>Descripción</th>
		<th>Unidad</th>
		<th>Cantidad</th>
		<th>Cantidad para <br>	 ensamblar</th>
		<th>Precio</th>
		<th>Total</th>
	</thead>
	<tbody id='tbodyensamble'>
		<tr><td></td></tr>
	</tbody>
</table>
</div>
</div>
</div>
</div>
<style type="text/css">
    .swal2-container {
     zoom : 1.4 ;
     -moz-transform: scale(1.4);
    }    
</style>
<script type="text/javascript">
	
function ConsultarProducto(){
	var strReferencia=document.getElementById('txtReferencia');
	var intCantReferencia=document.getElementById('txtCantReferencia');
	var intCantManoObra=document.getElementById('txtCantManoObra');
	var intValorManoObra=document.getElementById('txtValorManoObra');
	if(strReferencia.value.trim()==''){
	    document.getElementById('tbodyensamble').innerHTML='';
		strReferencia.focus();
		Swal(
		  'Ingrese referencia a buscar.'
		);
		document.getElementById('btnPDFEnsamble').style.display='none';
        document.getElementById('txtAreaObservacion').style.display='none';
		return;
	}
	if(intCantReferencia.value.trim()<=0){
		intCantReferencia.focus();
		Swal(		
		  'Ingrese cantidad.'
		);
	    document.getElementById('btnPDFEnsamble').style.display='none';
        document.getElementById('txtAreaObservacion').style.display='none';
		return;
	}
	
               var parametros = {
                              "btnConsultarProducto" : 'true',
                              "strReferencia":strReferencia.value.trim(),
                              "intCantReferencia":intCantReferencia.value.trim(),
                              "intCantManoObra":intCantManoObra.value.trim(),
                              "intValorManoObra":intValorManoObra.value.trim()
                               }                          
                 $.ajax({
                            data:  parametros,
                            url:   '../Controller/EnsambleController.php',
                            type:  'post',                        
                            success:  function (response) { 
                    
                                document.getElementById('tbodyensamble').innerHTML=response;
                                 var nFilas = $("#tblEnsamble tr").length;
                                if(nFilas>2){
                                	document.getElementById('btnPDFEnsamble').style.display='inline';
                                	document.getElementById('txtAreaObservacion').style.display='inline';


                                }else{
                                	document.getElementById('btnPDFEnsamble').style.display='none';
 								document.getElementById('txtAreaObservacion').style.display='none';
 								
                                 document.getElementById('txtAreaObservacion').value='';
                                }
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                        });
 }
 function ImprimirPDFEnsamble(){



 	var intcantidadreferencia=document.getElementById('txtCantReferencia').value.trim();
 	var strreferencia=document.getElementById('txtReferencia').value.trim();
 	var intcantidadmanoobra=document.getElementById('txtCantManoObra').value.trim();
 	var intvalormanoobra=document.getElementById('txtValorManoObra').value.trim();
 	var strAreaObservacion=document.getElementById('txtAreaObservacion').value.trim();

 	 window.open('../Controller/InformeEnsambleController.php?strproducto='+strreferencia+'&intcantidadreferencia='+intcantidadreferencia+'&intcantidadmanoobra='+intcantidadmanoobra+'&intvalorobra='+intvalormanoobra+'&strobservacion='+strAreaObservacion+'', '_blank');
 }
</script>
