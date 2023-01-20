<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==34){
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
<div class="panel panel-default">
  <div class="panel-heading">Busqueda Cliente</div>
  <div class="panel-body">
  <hr><br>
	<button class="btn btn-primary" style="margin-top: -27px;"  type="button"  data-toggle="modal" data-target=".ModalSearchCustomer" id='btnBuscar'>Buscar</button>
	<button class="btn btn-primary" style="margin-top: -27px;"  type="button" onclick="EditarCliente()" disabled="true" id='btnEditar'>Editar</button>
  <button class="btn btn-primary" style="margin-top: -27px;" id='btnLimpiar' disabled="true" onclick="LimpiarTercero()">Limpiar</button>
  <br><br>
	<div class="row">
	  <div class="col-lg-6">
        <label>Cedula</label>
	  	  <input type="text" class="form-control" placeholder="Cedula" aria-describedby="basic-addon1" id='txtDocumentCustomer' disabled>
        <label>Nombre</label>
        <input type="hidden" id='txtNombreTercero'>
	  	  <input type="text" id='txtNameCustomer' class="form-control" placeholder="Nombre" aria-describedby="basic-addon1" disabled>
        <label>Precio</label>
        <input type="hidden" id='txtTypeSegmento'>
	  	  <input type="text" id='txtTypePrice' class="form-control" placeholder="Segmento" aria-describedby="basic-addon1" disabled>
        <label>Fotos</label>
	  	  <input type="text" id='txtImageCustomer' class="form-control" placeholder="Fotos" aria-describedby="basic-addon1" disabled>
        <label>Direccion1</label>
	  	  <input type="text" id='txtAddressCustomerOne' class="form-control" placeholder="Direccion1" aria-describedby="basic-addon1" disabled>
        <label>Direccion2</label>
	  	  <input type="text" id='txtAddressCustomerTwo' class="form-control" placeholder="Direccion2" aria-describedby="basic-addon1" disabled>
  	  </div>
  	  <div class="col-lg-6">
        <label>Cartera</label>
        <input type="text" id='txtCashCustomer' class="form-control" placeholder="Cartera" aria-describedby="basic-addon1" disabled>
        <label>Cupo</label>
	  	  <input type="text" class="form-control" placeholder="Cupo" id='txtQuotaCustomer' aria-describedby="basic-addon1" disabled>
        <label>Telefono1</label>
	  	  <input type="text" class="form-control" id='txtPhoneCustomerOne' placeholder="Telefono1" aria-describedby="basic-addon1" disabled>
        <label>Telefono2</label>
	  	  <input type="text" class="form-control" id='txtPhoneCustomerTwo' placeholder="Telefono2" aria-describedby="basic-addon1" disabled>
        <label>Ciudad</label>
        <input type="hidden" id='txtIdCiudad'>
	  	  <input type="text" class="form-control" id='txtCityCustomer' placeholder="Ciudad" aria-describedby="basic-addon1" disabled>
  	  </div>
  	</div>
  	<hr>
  	<h4>Movimiento</h4>
  	<div>
      <div  style="overflow-y: scroll;height: 300px;">
  		<table class="table table-bordered">
  			<thead>
  				<th>#</th>
  				<th>Transacción</th>
  				<th>Descripción</th>
  				<th>Documento</th>
  				<th>Doc Referencia</th>
  				<th>Fecha</th>
  				<th>Valor</th>
  				<th>Iva</th>
  				<th>Total</th>
  			</thead>
  			<tbody id='TbodyMovimientos'>
  				<tr>
  					<td>Sin movimientos</td>
  				</tr>
  			</tbody>
  		</table>
      </div>
  		<hr>
  		<label>Documento</label><br>
  		<select class="form-control" style="display: inline-block;width: 15%;" id='ddlTransaccion'>
  			<option value="04">04</option>
        <option value="041">041</option>
  		</select>
  		<input type="text" class="form-control w-50" style="display: inline-block;" placeholder="Documento" id='txtDocDetalle'>
  		<button class="btn btn-primary" style="margin-top: -2px;" onclick="ConsultarDetalleDocTercero()" id='btnBuscarDetalleDocumento' disabled="true">Buscar</button>
  		<br><br>
      <div style="overflow-y:scroll;height: 250px; ">
  		<table class="table table-bordered">
  			<thead>
  				<th>#</th>
  				<th>Producto</th>
  				<th>Descripción</th>
  				<th>Cantidad</th>
  				<th>Valor</th>
   			</thead>
  			<tbody id='TbodyDetalleDoc'>
  				<tr>
  					<td>No contiene productos.</td>
  				</tr>
  			</tbody>
  		</table>
      </div>
  	</div>
  	<hr>
  	<div>
  		<h3>Asignar Vendedor</h3>
        <label>Observación</label>
        <textarea maxlength="200" class="form-control" id='txtObservacion' style="resize: none;width: 100%;height:100px; " placeholder="Observación" aria-describedby="basic-addon1"></textarea><br>
       <label>Estado Tercero</label><br>
        <input type="radio" checked="true"  name="rdbEstadoTercero" id='rdbEspera'/> <label for="rdbEspera"> Espera</label>
        <input type="radio" name="rdbEstadoTercero" id='rdbEnviar'/> <label for="rdbEnviar"> Envíar</label>
  		<select class="form-control" id='DdlVendedores'>
  		</select><br>
  		<button class="btn btn-primary" onclick="AsociarVendedorATercero()" disabled="true" id='btnAsignarVendedor'>Asignar</button>
  	</div>
  	<hr>
  </div>
</div>
</div>


<script type="text/javascript">
  /* General*/
   $(document).ready(function($){
        ListarCiudades();
        ListarTiposTerceros();
        ListarVendedores();

    });
</script>
<script type="text/javascript">
  
  /* Ciudad */
  function ListarCiudades(){
        var strParameters = {
                            "btnListarCiudades" : 'true'
                                   
                         };
            $.ajax({
                            data:  strParameters,
                            url:   '../Controller/CiudadController.php',
                            type:  'post',
                            success:  function (response) {
                              document.getElementById('DdlCiudades').innerHTML=response;
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }
</script>
<script type="text/javascript">
  /* function listar tipos de terceros */
  function ListarTiposTerceros(){
         var strParameters = {
                            "btnListarTiposTerceros" : 'true'  
                         };
            $.ajax({
                            data:  strParameters,
                            url:   '../Controller/TerceroController.php',
                            type:  'post',
                            success:  function (response) {
                               document.getElementById('DdlSegmento').innerHTML=response;
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }
</script>






<script type="text/javascript">
   /* Vendedor */ 


    function ListarVendedores(){
        
        var strParameters = {
                            "btnListarVendedores" : 'true'            
                         };
            $.ajax({
                            data:  strParameters,
                            url:   '../Controller/VendedorController.php',
                            type:  'post',
                            success:  function (response) {
                              document.getElementById('DdlVendedores').innerHTML=response;
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }

</script>





<script type="text/javascript">
  /* Tercero */
  /*function consult Tercero */
    var strDocument=document.getElementById('txtDocumentCustomer');
    var strName=document.getElementById('txtNameCustomer');
    var strPrice=document.getElementById('txtTypePrice');
    var strImage=document.getElementById('txtImageCustomer');
    var strAddressOne=document.getElementById('txtAddressCustomerOne');
    var strAddressTwo=document.getElementById('txtAddressCustomerTwo');
    var strCash=document.getElementById('txtCashCustomer');
    var strQuota=document.getElementById('txtQuotaCustomer');
    var strPhoneOne=document.getElementById('txtPhoneCustomerOne');
    var strPhoneTwo=document.getElementById('txtPhoneCustomerTwo');
    var strCity=document.getElementById('txtCityCustomer');
    var strIdCiudad=document.getElementById('txtIdCiudad');
    var strNombreTercero=document.getElementById('txtNombreTercero');
    var strTipoSegmento=document.getElementById('txtTypeSegmento');

  
    function ConsultCustomer(){
        var strDocumentCustomer=document.getElementById('txtNameCustomerSearch');
        if(strDocumentCustomer.value.trim()==''){
          document.getElementById('TblBodyCustomer').innerHTML='<tr><td>Buscar Tercero</td></tr>';
          return;
        }
        var strParameters = {
                            "btnBuscarTerceroRecepcion" : 'true',
                            'strName':strDocumentCustomer.value.trim()             
                         };
            $.ajax({
                            data:  strParameters,
                            url:   '../Controller/TerceroController.php',
                            type:  'post',
                            success:  function (response) {
                              document.getElementById('TblBodyCustomer').innerHTML=response;
                       
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }
/* movimiento de un tercero*/
  function ConsultarMvTercero(strCedula){

        if(strCedula==''){
          return;
        }
        var strParameters = {
                            "btnConsultarMvTercero" : 'true',
                            'strCedula':strCedula           
                         };
            $.ajax({
                            data:  strParameters,
                            url:   '../Controller/TerceroController.php',
                            type:  'post',
                            
                            success:  function (response) {
                              document.getElementById('TbodyMovimientos').innerHTML=response;
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }
  /* consulta el detalle del documento de un tercero*/
    function ConsultarDetalleDocTercero(){
      var intIdTransaccion=document.getElementById('ddlTransaccion');
      var strDocumento=document.getElementById('txtDocDetalle');
      var strCedula=document.getElementById('txtDocumentCustomer');
        var strParameters = {
                            "btnConsultarDetalleDocTercero" : 'true',
                            'strCedula':strCedula.value.trim(),
                            "strDocumento" : strDocumento.value.trim(),
                            "intIdTransaccion":intIdTransaccion.value        
                         };
            $.ajax({
                            data:  strParameters,
                            url:   '../Controller/TerceroController.php',
                            type:  'post',
                            
                            success:  function (response) {
                              document.getElementById('TbodyDetalleDoc').innerHTML=response;
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }
  /* seleccionar cliente y asignarlo */
  function SelectCustomer(intRow){
    

    var tblCustomer=document.getElementById('tblCustomer');
    strDocument.value=tblCustomer.rows[intRow].cells[1].innerHTML;
    strName.value=tblCustomer.rows[intRow].cells[2].innerHTML;
    strPrice.value=tblCustomer.rows[intRow].cells[4].innerHTML;
    strImage.value=tblCustomer.rows[intRow].cells[5].innerHTML;
    strAddressOne.value=tblCustomer.rows[intRow].cells[6].innerHTML;
    strAddressTwo.value=tblCustomer.rows[intRow].cells[7].innerHTML;
    strPhoneOne.value=tblCustomer.rows[intRow].cells[8].innerHTML;
    strPhoneTwo.value=tblCustomer.rows[intRow].cells[9].innerHTML;
    strCash.value=tblCustomer.rows[intRow].cells[10].innerHTML;
    strQuota.value=tblCustomer.rows[intRow].cells[11].innerHTML;
    strCity.value=tblCustomer.rows[intRow].cells[12].innerHTML;
    strIdCiudad.value=tblCustomer.rows[intRow].cells[13].innerHTML;
    strTipoSegmento.value=tblCustomer.rows[intRow].cells[14].innerHTML;
    strNombreTercero.value=tblCustomer.rows[intRow].cells[15].innerHTML;
    
    ConsultarMvTercero(strDocument.value);
    document.getElementById('btnBuscar').disabled=true;
    document.getElementById('btnAsignarVendedor').disabled=false;
    document.getElementById('btnBuscarDetalleDocumento').disabled=false;
    document.getElementById('btnLimpiar').disabled=false;
    document.getElementById('btnEditar').disabled=false;
    $('.ModalSearchCustomer').modal('hide');
  }
/* Limpiar vista */
  function LimpiarTercero(){
    strDocument.value='';
    strName.value='';
    strPrice.value='';
    strImage.value='';
    strAddressOne.value='';
    strAddressTwo.value='';
    strPhoneOne.value='';
    strPhoneTwo.value='';
    strCash.value='';
    strQuota.value='';
    strCity.value='';
    strIdCiudad.value='';
    strNombreTercero.value='';
    document.getElementById('txtDocDetalle').value='';
    document.getElementById('TbodyDetalleDoc').innerHTML='<tr><td>No hay productos.</td></tr>';
    document.getElementById('TbodyMovimientos').innerHTML='<tr><td>Sin movimientos.</td></tr>';
    document.getElementById('TblBodyCustomer').innerHTML='<tr><td>Buscar Tercero.</td></tr>';
    document.getElementById('btnEditar').disabled=true;
    document.getElementById('btnLimpiar').disabled=true;
    document.getElementById('btnBuscar').disabled=false;
    document.getElementById('btnAsignarVendedor').disabled=true;
    document.getElementById('txtObservacion').value='';
    document.getElementById('btnBuscarDetalleDocumento').disabled=true;
  }
  /* Editar Cliente */
  function EditarCliente(){
    $('.ModalEditarCliente').modal('show');
    var strNombreTerceroData=document.getElementById('txtNombreTercero').value.split('%%');
    var strCedulaEditar=document.getElementById('txtCedulaEditar');
    var strNombre1Editar=document.getElementById('txtPNombre');
    var strNombre2Editar=document.getElementById('txtSNombre');
    var strApellido1Editar=document.getElementById('txtPApellido');
    var strApellido2Editar=document.getElementById('txtSApellido');
    var ddlSegmento=document.getElementById('DdlSegmento');
    var strTelefono1Editar=document.getElementById('txtTelefono1Editar');
    var strTelefono2Editar=document.getElementById('txtTelefono2Editar');
    var ddlCidudad=document.getElementById('DdlCiudades');
    var strFotoEditar=document.getElementById('txtFotosEditar');
    var strDireccion1Editar=document.getElementById('txtDireccion1Editar');
    var strDireccion2Editar=document.getElementById('txtDireccion2Editar');
    strCedulaEditar.value=strDocument.value.trim();
    strNombre1Editar.value=strNombreTerceroData[2];
    strNombre2Editar.value=strNombreTerceroData[3];
    strApellido1Editar.value=strNombreTerceroData[0];
    strApellido2Editar.value=strNombreTerceroData[1];
    strFotoEditar.value=strImage.value.trim();
    strDireccion1Editar.value=strAddressOne.value.trim();
    strDireccion2Editar.value=strAddressTwo.value.trim();
    strTelefono1Editar.value=strPhoneOne.value.trim();
    strTelefono2Editar.value=strPhoneTwo.value.trim();
    ddlCidudad.value=document.getElementById('txtIdCiudad').value;
    ddlSegmento.value=document.getElementById('txtTypeSegmento').value;
  }
  /*Actualizar Tercero */

  function ActualizarTercero(){
        var strCedulaEditar=document.getElementById('txtCedulaEditar');
        var strNombre1Editar=document.getElementById('txtPNombre');
        var strNombre2Editar=document.getElementById('txtSNombre');
        var strApellido1Editar=document.getElementById('txtPApellido');
        var strApellido2Editar=document.getElementById('txtSApellido');
        var ddlSegmento=document.getElementById('DdlSegmento');
        var strTelefono1Editar=document.getElementById('txtTelefono1Editar');
        var strTelefono2Editar=document.getElementById('txtTelefono2Editar');
        var ddlCidudad=document.getElementById('DdlCiudades');
        var strFotoEditar=document.getElementById('txtFotosEditar');
        var strDireccion1Editar=document.getElementById('txtDireccion1Editar');
        var strDireccion2Editar=document.getElementById('txtDireccion2Editar');
      var strParameters = {
                            "btnActualizarTercero" : 'true',
                            'strCedula':strCedulaEditar.value.trim(),
                            'strNombre1':strNombre1Editar.value.trim(),
                            'strNombre2':strNombre2Editar.value.trim(),
                            'strApellido1':strApellido1Editar.value.trim(),
                            'strApellido2':strApellido2Editar.value.trim(),
                            'intIdSegmento':ddlSegmento.value.trim(),
                            'strEstadoFoto':strFotoEditar.value.trim(),
                            'strDireccion1':strDireccion1Editar.value.trim(),
                            'strDireccion2':strDireccion2Editar.value.trim(),
                            'strTelefono1':strTelefono1Editar.value.trim(),
                            'strTelefono2':strTelefono2Editar.value.trim(), 
                            'intIdCiudad':ddlCidudad.value.trim()        
                         };
            $.ajax({
                            data:  strParameters,
                            url:   '../Controller/TerceroController.php',
                            type:  'post',
                            
                            success:  function (response) {
                              document.getElementById('txtNombreTercero').value=strApellido1Editar.value.trim()+'%%'+strApellido2Editar.value.trim()+'%%'+strNombre1Editar.value.trim()+'%%'+strNombre2Editar.value.trim();
                              strName.value=strApellido1Editar.value.trim()+' '+strApellido2Editar.value.trim()+' '+strNombre1Editar.value.trim()+' '+strNombre2Editar.value.trim();
                              strImage.value=strFotoEditar.value.trim();
                              strAddressOne.value=strDireccion1Editar.value.trim();
                              strAddressTwo.value=strDireccion2Editar.value.trim();
                              strPhoneOne.value=strTelefono1Editar.value.trim();
                              strPhoneTwo.value=strTelefono2Editar.value.trim();
                              strCity.value=$('#DdlCiudades :selected').text();
                              document.getElementById('txtTypeSegmento').value=document.getElementById('DdlSegmento').value.trim();
                              document.getElementById('txtIdCiudad').value=document.getElementById('DdlCiudades').value.trim();
                              $('.ModalEditarCliente').modal('hide');
                              ConsultarPrecioPorSegmento();
                              Swal.fire('Cliente actualizado con éxito.');
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }
/* consulta tipo de precio del tercero*/
    function ConsultarPrecioPorSegmento(){

        var strParameters = {
                            "btnConsultarPrecioPorSegmento" : 'true',
                            'strIdSegmento':document.getElementById('DdlSegmento').value.trim()     
                         };
            $.ajax({
                            data:  strParameters,
                            url:   '../Controller/TerceroController.php',
                            type:  'post',
                            
                            success:  function (response) {
                              document.getElementById('txtTypePrice').value=response;
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }
</script>

<script type="text/javascript">
  /* Tercero Vendedor */
  function AsociarVendedorATercero(){
        var rdbEnviar=document.getElementById('rdbEnviar');  
        /* 1 Espera 2 Enviar  preferencia tercero*/
        var strPreferenciaTercero='1';
        if(rdbEnviar.checked){
          strPreferenciaTercero='2';
        }
        var strParameters = {
                            "btnAsociarVendedorATercero" : 'true'  ,
                            "strCedulaTercero" : strDocument.value.trim(),
                            "strPreferenciaTercero" : strPreferenciaTercero  ,
                            "strPrecio" : strPrice.value.trim() ,
                            "strObservacion" : document.getElementById('txtObservacion').value.trim() ,
                            "strIdVendedor" : document.getElementById('DdlVendedores').value.trim()            
                            };
            $.ajax({
                            data:  strParameters,
                            url:   '../Controller/TerceroController.php',
                            type:  'post',
                            success:  function (response) {
                              Swal.fire(response);
                              LimpiarTercero();
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
  }

</script>

<!-- Model Search Customer -->
<div class="modal fade ModalSearchCustomer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="padding: 25px;">
      <div class="row" >
        <div class="col-lg-12">
          <h2>Busqueda</h2>
          <input type="text" id='txtNameCustomerSearch' class="form-control" placeholder="Buscar" onkeyup="ConsultCustomer();">
          <br>
          <div style="overflow: scroll;height:400px; ">
           <table class="table table-bordered" id='tblCustomer'>
             <thead>
               <th>#</th>
               <th>Cedula</th>
               <th>Nombre</th>
               <th>Acción</th>
             </thead>
             <tbody id='TblBodyCustomer'>
               <tr><td>Buscar Tercero</td></tr>
             </tbody>
           </table> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--- modal editar cliente -->
<div class="modal fade ModalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="padding: 25px;">
    <div class="row text-center">
      <h2>Editar Cliente</h2>
    <div class="col-lg-6">
        <label>Cedula</label>
        <input type="text" class="form-control" placeholder="Cedula" aria-describedby="basic-addon1" id='txtCedulaEditar'  disabled>
        <label>Primer Nombre</label>
        <input type="text" class="form-control" placeholder="Nombre" aria-describedby="basic-addon1" id='txtPNombre'>
        <label>Segundo Nombre</label>
        <input type="text" class="form-control" placeholder="Nombre" aria-describedby="basic-addon1" id='txtSNombre'>
        <label>Primer Apellido</label>
        <input type="text" class="form-control" placeholder="Nombre" aria-describedby="basic-addon1" id='txtPApellido'>
        <label>Segundo Apellido</label>
        <input type="text" class="form-control" placeholder="Nombre" aria-describedby="basic-addon1" id='txtSApellido'>
        <label>Segmento</label>
        <select id='DdlSegmento' class="form-control"></select>
      </div>
      <div class="col-lg-6">
        <label>Telefono1</label>
        <input type="text" class="form-control"   placeholder="Telefono1" aria-describedby="basic-addon1"  id='txtTelefono1Editar'>
        <label>Telefono2</label>
        <input type="text" class="form-control"   placeholder="Telefono2" aria-describedby="basic-addon1"  id='txtTelefono2Editar'>
        <label>Ciudad</label>
        <select class="form-control" id='DdlCiudades'></select>
        <label>Fotos</label>
        <input type="text"  class="form-control" placeholder="Fotos" aria-describedby="basic-addon1" id='txtFotosEditar' >
        <label>Direccion1</label>
        <input type="text"  class="form-control" placeholder="Direccion1" aria-describedby="basic-addon1" id='txtDireccion1Editar'>
        <label>Direccion2</label>
        <input type="text"  class="form-control" placeholder="Direccion2" aria-describedby="basic-addon1" id='txtDireccion2Editar'>
      </div>
    </div>
    <br>
    <div class="text-center">
    <button class="btn btn-primary" onclick="ActualizarTercero()">Guardar</button>
    <button class="btn btn-danger" onclick="
    $('.ModalEditarCliente').modal('hide');">Cancelar</button>
    </div>  
    </div>
  </div>
</div>