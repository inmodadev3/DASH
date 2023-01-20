<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==3){
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
<div id="page-wrapper" style="height: 1600px;">
<style type="text/css">
    @media screen and (min-width: 1380px) {
                              #page-wrapper{ 
                                  height: 100vh; 
                     }
    }

    .progress-circle.indefinite .progress {
      stroke: #9e9e9e;
      stroke-width: 10;
      stroke-dashoffset: 0;
      stroke-dasharray: 63 188;
      animation: progress-indef 2s linear infinite;
    }

    .progress-circle.indefinite .bg {
      stroke: #eee;
      stroke-width: 10;
    }

    @keyframes progress-indef {
      0% { stroke-dashoffset: 251; }
      100% { stroke-dashoffset: 0; }
    }
    /*NUNEVO*/
    .table-wrapper-scroll-y {
      display: block;
      max-height: 200px;
      overflow-y: auto;
      -ms-overflow-style: -ms-autohiding-scrollbar;
      }
    /*NUNEVO*/
</style>
<button type="button" class="btn" style="background:#337ab7;" data-toggle="modal" data-target="#Primero"><i style="color:#fff;" class="fa fa-question-circle fa-fw"></i></button></center>
<br>

<div class="modal fade" id="Primero">
  <div class="modal-dialog">
    <div class="modal-content">   
      <div class="modal-header">
        <h4 class="modal-title">Ayuda</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>    
      <div class="modal-body">
        Bienvendio a la página de registrar Compras. Aquí podrás asociar documentos para utilizar las diferentes referencias que en este se involucran.
      </div>      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<br>
<!-- /.--------------------------------------------------------->
<!-- Tabla De precios Actuales Del Hgi -->
<!-- /.--------------------------------------------------------->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-user fa-fw"></i>Precios Actuales
            </div>
            <div class="panel-body table-responsive">
                <div class=row>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <table class="table table-hover table-bordered " id="tblprueba"> 
                                <thead>
                                    <tr class="bg-primary">  
                                        <th>Referencia</th>
                                        <th>Descripcion</th> 
                                        <th>precio 1</th>
                                        <th>Precio 2</th>
                                        <th>Precio 3</th>
                                        <th>Precio 4</th>
                                        <th>Precio 5</th>
                                        <th>Dimension</th>
                                        <th>Unidad Medida</th>
                                        <th>Material</th>
                                        <th>Marca</th>
                                        <th>Género</th>
                                        <th>linea</th>
                                        <th>clase</th>
                                        <th>Grupo</th>
                                        <th>Tipo</th>
                                    </tr>
                                </thead>
                                <tbody id="prueba1">
                                        
                                </tbody>    
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- /.--------------------------------------------------------->
<div class="row">
         <div class="col-sm-12">    
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Consultar Compras
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <div class="row">
                                <div class="col-lg-7"> 
                                    <div class="input-group custom-search-form input-group-right" style="width: 100%;">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                    <div class="col-lg-12"> <input type="text" class="form-control" id="search" placeholder="Buscar"></div>
                                   
                                    </div><br>  
                                    <div id="div1" style="height: 590px;">
                                        <div id="carga">
                                            <center>
                                            <svg class="progress-circle indefinite" width="100" height="100">
                                              <g transform="rotate(-90,50,50)">
                                                <circle class="bg" r="20" cx="50" cy="50" fill="none"></circle>
                                                <circle class="progress" r="20" cx="50" cy="50" fill="none"></circle>
                                              </g>
                                            </svg>
                                            </center>
                                        </div>
                                        <table class="table table-hover table-striped table-bordered" id="tblTable" style="display: none;"> 
                                            <thead>
                                                <tr>  
                                                    <th>#</th>                                   
                                                    <th>Referencia</th>
                                                    <th>Descripcion</th>
                                              
                                                    <th>Unidad Medida</th>

                                                    <th>Raggi</th>
                                                    <th>Estimado uno</th>
                                                    <th>Estimado dos</th>
                                                    <th>Operacion</th>
                                                    <!--<th>Estado</th>-->
                                                 
                                                </tr>
                                            </thead>
                                            <tbody id="tabla">
                                                
                                            </tbody>    
                                        </table>
                                    </div>
                                </div> 


 <div class="col-lg-5">

           <div id="ocultar"  class="panel panel-default ">
                    <div class="panel-heading" >
                             <i class="fa fa-edit fa-fw"></i> Formulario
                    </div>                       
                     <div class="panel-body" >
                        <form method="post" action="<?= URL ?>Compras/Consultar" id="frmLiquidar" >

                            <div class="row">
                                <div class="col-lg-6">
                                        <div style="display: none;" id="preciosDB">
                                      
                                        </div>

                                        <div id="idDetalle"></div>
                                        <div id="unidadMedida" style="display: none;"></div>
                                        <div id="Cantidad" style="display: none;"></div>
                                        <div class="form-group">
                                            <label>Referencia Original: </label>
                                            <label id="lblReferenciaContenedor"></label>
                                            <!--<label>Referencia</label>-->
                                            <input type="text"  name="txtReferencia" class="form-control" id="txtReferencia">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción:</label>
                                            <!--DOÑA ANGELA-->
                                            <label id="lblDescripcion"></label>
                                            <!--DOÑA ANGELA-->
                                            <input type="text" name="txtDescripcion" id="txtDescripcion" class="form-control" >
                                        </div>
                                       <div class="form-group">
                                            <label>Estimado Uno</label>
                                            <input type="text" name="txtEstimadoUno"  id="txtEstimadoUno" class="form-control" readonly="readonly"  >
                                        </div>
                                        <div class="form-group">
                                            <label>Estimado Dos</label>
                                            <input type="text" name="txtEstimadoDos"  id="txtEstimadoDos" class="form-control" readonly="readonly" >
                                        </div>   
                                        <div class="form-group">
                                            <label>Dimension</label>
                                            <input type="text" name="txtDimension" id="txtDimension" class="form-control" readonly="readonly" >
                                        </div>  
                                        <div class="form-group">
                                            <label>CxU</label>
                                            <input type="text" name="txtCxU" id="txtCxU" class="form-control" readonly="readonly" >
                                        </div> 
                                        <div class="form-group">
                                            <label>Cantidad Paca</label>
                                            <input type="text" name="txtCantidadPaca" id="txtCantidadPaca" class="form-control" readonly="readonly" value="0">
                                        </div> 
                                        <div class="form-group">
                                            <label>Material:</label>
                                            <label id="cbxMaterial1"></label>

                                            <input 
                                            type="text" 
                                            id="cbxMaterial2"
                                            class="form-control" 
                                            >
                                            <br/>
                                            <select class="form-control" id="cbxMaterial"
                                            style='display: none;'>
                                            </select>
                                        </div>      
                                        <div class="form-group">
                                            <label>Observacion</label>
                                            <textarea name="txtObservacion" id="txtObservacion" class="form-control" readonly="readonly" ></textarea>
                                        </div>             
                                      
                                 </div>
                                 <div class="col-lg-6">
                                      <div class="form-group">
                                            <label>Precio 1</label>
                                            <input  onchange ="calcular();"  id="txtPrecioUno" type="text" onkeyup="format(txtPrecioUno);calcular();" onchange="format(txtPrecioUno);" name="txtPrecioUno" class="form-control" placeholder="0">
                                        </div>
                                        <div class="form-group">
                                            <label>Precio 2</label>
                                            <input  type="text"  name="txtPrecioDos" placeholder="0"  id="txtPrecioDos" class="form-control" onkeyup="format(txtPrecioDos)" onchange="format(txtPrecioDos);" >
                                        </div>
                                        <div class="form-group">
                                            <label>Precio 3</label>

                                            <input type="text" name="txtPrecioTres" placeholder="0" id="txtPrecioTres" class="form-control" onkeyup="format(txtPrecioTres)" onchange="format(txtPrecioTres);" >
                                        </div>
                                        <div class="form-group">
                                            <label>Precio 4</label>
                                            <input  type="text"  id="txtPrecioCuatro" placeholder="0" name="txtPrecioCuatro" class="form-control" onkeyup="format(txtPrecioCuatro)" onchange="format(txtPrecioCuatro);" />
                                        </div>
                                        <div class="form-group" style="display:none;">
                                            <label>Precio 5</label>
                                            <input  type="text"  id="txtPrecioCinco" placeholder="0" name="txtPrecioCinco" class="form-control" onkeyup="format(txtPrecioCinco)" onchange="format(txtPrecioCinco);" />
                                        </div>
                                        <div class="form-group">
                                            <label>Cantidad</label>
                                            <input  type="text" class="form-control" id="txtCantidadContenedor" placeholder="0"/>
                                        </div>
                                        <div class="form-group">
                                          <label for="sel1">Unidad de medida:</label>
                                          <select class="form-control" id="sel1" onchange="calcular()">
                                            <option>1</option>
                                            <option>2</option>
                                          </select>
                                        </div>
                                         
                                        <input type="hidden" name="txtIDReferencia" id="txtIDReferencia">
                                             

                                        <div class="form-group">
                                            <label>Género</label>
                                            <select class="form-control" id="cbxSexo">
                                            </select>
                                        </div>      
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <select class="form-control" id="cbxMarca">
                                            </select>
                                        </div>

                                </div>
                                <div class="col-lg-12">
                                   <div class="form-group">
                                      <label>Unidad Medida Original: </label>
                                      <label id="lblUnidadMedida"></label>
                                      <br>
                                      <label>Cantidad Original: </label>
                                      <label id="lblCantidadContenedor"></label>
                                  </div> 
                                </div>  
                            </div>
                             <button class="btn btn-default" type="button" id="btnLiquidar" name="btnLiquidar" value="true" onclick="IngresarPreciosDetalleCompra();"><i class="glyphicon glyphicon-ok"></i> Liquidar</button>
                             <!--NUEVO-->
                             <button class="btn btn-default" type="button" id="btnDuplicar" name="btnDuplicar"data-toggle="modal" data-target="#ModalDuplicate" onclick="CargarDatosModal();"><i class="glyphicon glyphicon-duplicate"></i> Duplicar</button>
                             <!--NUEVO-->
                             <button class="btn btn-default " type="button" onclick="cancelar();"><i class="glyphicon glyphicon-remove"></i> Cancelar</button>
                         </form>
                    </div>
             </div>

</div>
            <!--NUEVO-->
              <div class="modal fade" id="ModalDuplicate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="<?= URL ?>Compras/Consultar" id="frmLiquidar" >

                      <div class="row">
                          <div class="col-lg-6">
                                  <div style="display: none;" id="preciosDB">
                                
                                  </div>

                                  <div id="idDetalleM"></div>
                                  <div id="unidadMedida" style="display: none;"></div>
                                  <div class="form-group">
                                      <label>Referencia</label>
                                      <input type="text" class="form-control" id="txtReferenciaM" onkeyup="ValidarReferencia();">
                                  </div>
                                  <div class="form-group">
                                      <label>Descripción</label>
                                      <input type="text" id="txtDescripcionM" class="form-control" >
                                  </div>
                                 <!--<div class="form-group">
                                      <label>Estimado Uno</label>
                                      <input type="text" name="txtEstimadoUno"  id="txtEstimadoUno" class="form-control" readonly="readonly"  >
                                  </div>
                                  <div class="form-group">
                                      <label>Estimado Dos</label>
                                      <input type="text" name="txtEstimadoDos"  id="txtEstimadoDos" class="form-control" readonly="readonly" >
                                  </div>   
                                  <div class="form-group">
                                      <label>Dimension</label>
                                      <input type="text" name="txtDimension" id="txtDimension" class="form-control" readonly="readonly" >
                                  </div>  
                                  <div class="form-group">
                                      <label>CxU</label>
                                      <input type="text" name="txtCxU" id="txtCxU" class="form-control" readonly="readonly" >
                                  </div> 
                                  <div class="form-group">
                                      <label>Unidad Medida: </label>
                                      <label id="lblUnidadMedida"></label>
                                  </div>          -->        
                                
                           </div>
                           <div class="col-lg-6">
                                <div class="form-group">
                                      <label>Cantidad Disponible: <label id="lblCantidadM"></label></label>
                                      <input id="txtCantidadM" type="text" class="form-control" placeholder="0" onkeyup="format(txtCantidadM); ValidarCantidad();" onchange="format(txtCantidadM);">
                                  </div>
                                  <!--<div class="form-group">
                                      <label>Precio 2</label>
                                      <input  type="text"  name="txtPrecioDos" placeholder="0"  id="txtPrecioDos" class="form-control" onkeyup="format(txtPrecioDos)" onchange="format(txtPrecioDos);" >
                                  </div>
                                  <div class="form-group">
                                      <label>Precio 3</label>

                                      <input type="text" name="txtPrecioTres" placeholder="0" id="txtPrecioTres" class="form-control" onkeyup="format(txtPrecioTres)" onchange="format(txtPrecioTres);" >
                                  </div>
                                  <div class="form-group">
                                      <label>Precio 4</label>
                                      <input  type="text"  id="txtPrecioCuatro" placeholder="0" name="txtPrecioCuatro" class="form-control" onkeyup="format(txtPrecioCuatro)" onchange="format(txtPrecioCuatro);" />
                                  </div>
                                  <div class="form-group">
                                      <label>Precio 5</label>
                                      <input  type="text"  id="txtPrecioCinco" placeholder="0" name="txtPrecioCinco" class="form-control" onkeyup="format(txtPrecioCinco)" onchange="format(txtPrecioCinco);" />
                                  </div>-->
                                  <!--<div class="form-group">
                                      <label>Color</label>
                                      <input  type="text"  id="txtColor" placeholder="0" name="txtColor" class="form-control"/>
                                  </div>
                                  <div class="form-group">
                                    <label for="sel1">Unidad de medida:</label>
                                    <select class="form-control" id="sel1" onchange="calcular()">
                                      <option>1</option>
                                      <option>2</option>
                                    </select>
                                  </div>-->

                                  <!--<div class="form-group">
                                      <label>Unidad de medida</label>
                                      <input  type="text"  id="txtUnidadMedida" placeholder="0" name="txtUnidadMedida" class="form-control"/>
                                  </div>-->
                                  <input type="hidden"S id="txtIDReferenciaM">
                                       <hr>
                          </div>
                          <div class="col-lg-12">
                            <center>
                              <div id="ErrorCantidad" style="color: red; display: none;">No se admite cantida mayor a la disponible</div><br>
                              <div id="ErrorCantidadBD" style="color: red; display: none;">No hay cantidad disponible en la base de datos</div><br>
                              <div id="ErrorReferenciaR" style="color: red; display: inline;">La referencia ya existe</div>
                            </center>
                          </div>
                      </div>
                   </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="DuplicarReferenciaDetalleCompra();">Guardar</button>
                  </div>
                </div>
              </div>
            </div>
            <!--NUEVO-->
</div></div></div></div></div>

           
           
           <div class="row">
             
             <div class="col-lg-12">
               <div class="panel panel-default">
                 <div class="panel-heading">
                   <i class="fa fa-user fa-fw"></i>Estilo Referencia
                 </div>
                 <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="row">
                       <div class="col-lg-12">
                         <div class="form-group">
                            <div id="idLote" style="display: none;"></div>
                            <label>Color</label>
                            <input  type="text"  id="txtColorLote" name="txtColorLote" class="form-control" style="width: 50%;"/>
                        </div>
                       </div>
                       <div class="col-lg-12">
                         <div class="form-group">
                            <label>Estilo</label>
                            <input  type="text"  id="txtEstiloLote" name="txtEstiloLote" class="form-control" style="width: 50%;"/>
                          </div>
                       </div>
                       <div class="col-lg-12">
                            <button type="button" id="btnAgregarLote" class="btn btn-primary" onclick="AgregarLoteReferencia();">Agregar</button>
                            <button type="button" id="btnActualizarLote" class="btn btn-primary" style="display: none;" onclick="ActualizarLoteReferencia();">Actualizar</button>
                        </div>
                     </div>
                     </div>
                     <div class="col-lg-6">
                      <div class="table-wrapper-scroll-y">
                          <table class="table table-hover table-striped table-bordered" id="tblTableModificar2">
                              <thead>
                                  <tr>          
                                      <th>Color</th>
                                      <th>Estilo</th>
                                      <th>Accion</th>                                         
                                  </tr>
                              </thead>
                              <tbody id="tabla2">
                                
                              </tbody>     
                          </table>
                      </div>
                      
                  </div>
                  </div>
                 </div>
               </div>
             </div>
           </div>
           
            <div class="row">
                <div class="col-lg-12">                                    
                 <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i>Referencias Terminadas
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <!--  <div class="input-group custom-search-form input-group-right">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                                <input type="text" class="form-control" id="search" placeholder="Buscar">
                            </div><br>-->
                            <div class="row">
                            <div class="col-lg-12">   
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                  </span>
                                  <input type="text" id="buscar" class="form-control" placeholder="Buscar">
                                  
                                </div><br>
                            <div id="div1">
                                    <div id="carga1">
                                        <center>
                                        <svg class="progress-circle indefinite" width="100" height="100">
                                          <g transform="rotate(-90,50,50)">
                                            <circle class="bg" r="20" cx="50" cy="50" fill="none"></circle>
                                            <circle class="progress" r="20" cx="50" cy="50" fill="none"></circle>
                                          </g>
                                        </svg>
                                        </center>
                                    </div>
                                 <table class="table table-hover table-bordered" id="tblTableModificar" style="visibility: hidden;">
                                    <thead>
                                        <tr>                                                                                  
                                            <th>Referencia</th>
                                            <th>Raggi</th> 
                                            <th>Descripcion</th>                                           
                                            <th>Precio 1</th>
                                            <th>Precio 2</th>
                                            <th>Precio 3</th>
                                            <th>Precio 4</th>
                                            <th>Precio 5</th>
                                            <th>Estado</th>
                                            <th>Operaciones</th>                                     
                                        </tr>
                                    </thead>
                                     <tbody id="tabla1">
                                       
                                     </tbody>     
                                </table>
                               
                            </div>
                            </div>
                            </div>

                                </div>
                            </div> 
                        </div>
                    </div>
          

<script>
CargarReferencias();
CargarReferenciasTerminadas();
CambiarEstFormulario(true);
CargarComboBox();
ConsultarTblSexo();
ConsultarTblMaterial();
ConsultarTblMarca();
//NUEVO
function CargarDatosModal() {
  $('#idDetalleM').val($('#idDetalle').val());
  $('#txtReferenciaM').val($('#txtReferencia').val());
  $('#txtDescripcionM').val($('#txtDescripcion').val());
  $('#lblCantidadM').html($('#Cantidad').html());
}

function ValidarCantidad() {
  var cantidadDB = Number($('#lblCantidadM').html());
  var cantidadM = Number($('#txtCantidadM').val().replace(",",""));
  if (cantidadM > cantidadDB) {
    $('#ErrorCantidad').css("display","inline");
    return false;
  }else{
    $('#ErrorCantidad').css("display","none");
    if (cantidadDB == 0) {
      $('#ErrorCantidadBD').css("display","inline");
      return false;
    }else{
      $('#ErrorCantidadBD').css("display","none");
    }
  }
  return true;
}
function ValidarReferencia() {
  var parametros = {
                    "evtValidarReferencia" : 'true',
                    "Referencia" : $('#txtReferenciaM').val()
                };
    $.ajax({
        data:  parametros,
        url:   '../Controller/LiquidarController.php',
        type:  'post',
        
        success:  function (response) {
            if (response == 1) {
              $('#ErrorReferenciaR').css("display","inline");
            }else{
              $('#ErrorReferenciaR').css("display","none");
            }
        },
        error: function (error) {
        alert('error; ' + eval(error));
        }
    });
}
function DuplicarReferenciaDetalleCompra() {
  if (ValidarModel()) {

      var idDetalle = $('#idDetalleM').val();
      var txtReferenciaM = $('#txtReferenciaM').val();
      var txtDescripcionM = $('#txtDescripcionM').val();
      var txtCantidadM = $('#txtCantidadM').val();
      var parametros = {
                    "btnDuplicarReferenciaDetalleCompra" : 'true',
                    "idDetalle" : idDetalle,
                    "txtReferenciaM" : txtReferenciaM,
                    "txtDescripcionM" : txtDescripcionM,
                    "txtCantidadM" : txtCantidadM
                };
    $.ajax({
        data:  parametros,
        url:   '../Controller/LiquidarController.php',
        type:  'post',
        
        success:  function (response) {
            if (response == 1) {
              Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Referencia duplicada con exito',
                showConfirmButton: false,
                timer: 2000
              })
              CargarReferencias();
              /*var lastRow =(parseInt($("#tabla tr").length))-1;
              alert(lastRow);
              CargarFormulario(0);*/
              cancelar();
              $('#txtReferenciaM').val('');
              $('#txtDescripcionM').val('');
              $('#txtCantidadM').val('');
              $('#ModalDuplicate').modal('hide');
            }else{
              Console.log("Error DuplicarReferenciaDetalleCompra :: "+response);
            }
        },
        error: function (error) {
        alert('error; ' + eval(error));
        }
    });
  }else{
    alert("Campos no validos!!");
  }  
}
function ValidarModel(){
  if (!ValidarCantidad()){
    return false;
  }else{
    if ($('#txtReferenciaM').val() == "") {
    return false;
    }else{
      if ($('#txtDescripcionM').val() == "") {
        return false;
      }else{
        if ($('#txtCantidadM').val() == "") {
          return false;
        }else{
          if ($('#ErrorReferenciaR').css('display') == "inline") {
            return false;
          }
        }
      }
    }
  }
  return true;
}
//NUEVO
function CargarComboBox() {
    var parametros = {
                    "btnConsultarUnidadesMedida" : 'true'
                };
    $.ajax({
        data:  parametros,
        url:   '../Controller/LiquidarController.php',
        type:  'post',
        
        success:  function (response) {
            //alert(response);
            document.getElementById('sel1').innerHTML=response;
        },
        error: function (error) {
        alert('error; ' + eval(error));
        }
    });
}
function ConsultarTblSexo() {
    var parametros = {
                    "btnConsultarTblSexo" : 'true'
                };
    $.ajax({
        data:  parametros,
        url:   '../Controller/LiquidarController.php',
        type:  'post',
        
        success:  function (response) {
            //alert(response);
            document.getElementById('cbxSexo').innerHTML=response;
        },
        error: function (error) {
        alert('error; ' + eval(error));
        }
    });
}
function ConsultarTblMaterial() {
    var parametros = {
                    "btnConsultarTblMaterial" : 'true'
                };
    $.ajax({
        data:  parametros,
        url:   '../Controller/LiquidarController.php',
        type:  'post',
        
        success:  function (response) {
            //alert(response);
            document.getElementById('cbxMaterial').innerHTML=response;
        },
        error: function (error) {
        alert('error; ' + eval(error));
        }
    });
}
function ConsultarTblMarca() {
    var parametros = {
                    "btnConsultarTblMarca" : 'true'
                };
    $.ajax({
        data:  parametros,
        url:   '../Controller/LiquidarController.php',
        type:  'post',
        
        success:  function (response) {
            document.getElementById('cbxMarca').innerHTML=response;
        },
        error: function (error) {
        alert('error; ' + eval(error));
        }
    });
}
function CargarReferencias() {
    var parametros = {
                    "btnConsultarReferencias" : 'true'
                };
    $.ajax({
        data:  parametros,
        url:   '../Controller/LiquidarController.php',
        type:  'post',
        
        success:  function (response) {
            //alert(response);
            document.getElementById('tabla').innerHTML=response;
            document.getElementById('carga').style="display:none";
            document.getElementById('tblTable').style="display:inline-block";
        },
        error: function (error) {
        alert('error; ' + eval(error));
        }
    });
}
function CargarReferenciasTerminadas() {
    var parametros = {
                    "btnCargarReferenciasTerminadas" : 'true'
                };
    $.ajax({
        data:  parametros,
        url:   '../Controller/LiquidarController.php',
        type:  'post',
        
        success:  function (response) {
            //alert(response);
            document.getElementById('tabla1').innerHTML=response;
            document.getElementById('carga1').style="display:none";
            document.getElementById('tblTableModificar').style="visibility:visible";
        },
        error: function (error) {
          alert('error; ' + eval(error));
        }
    });
}
  

  function ConsultarLote(idDetalleReferencia){
     var parametros = {
                    "btnConsultarLoteReferencia" : 'true',
                    "idDetalleReferencia" : idDetalleReferencia
                };
    $.ajax({
        data:  parametros,
        url:   '../Controller/LiquidarController.php',
        type:  'post',
        
        success:  function (response) {
            //alert(response);
            document.getElementById('tabla2').innerHTML=response;
        },
        error: function (error) {
        alert('error; ' + eval(error));
        }
    });
  }
  function EliminarLoteReferencia(idLoteReferencia, idDetalleReferencia) {
    //alert(idLoteReferencia);
    var parametros = {
                    "btnEliminarLoteReferencia" : 'true',
                    "idLoteReferencia" : idLoteReferencia
                };
    $.ajax({
        data:  parametros,
        url:   '../Controller/LiquidarController.php',
        type:  'post',
        
        success:  function (response) {
            //alert(response);
            if (response == 1) {
              ConsultarLote(idDetalleReferencia);
              Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Eliminado con exito',
                showConfirmButton: false,
                timer: 1500
              })
            }else{
              console.log('Error '+response);
              Swal({
                type: 'error',
                title: 'Oops...',
                text: 'Hubo un error al eliminar!'
              })
            }
        },
        error: function (error) {
        alert('error; ' + eval(error));
        }
    });
  }
  function AgregarLoteReferencia(){

    var id = $('#idDetalle').val();
    var color = $('#txtColorLote').val();
    var estilo = $('#txtEstiloLote').val();
    var parametros = {
                    "btnAgregarLoteReferencia" : 'true',
                    "idDetalleReferencia" : id,
                    "color" : color,
                    "estilo" : estilo 
                };
    $.ajax({
        data:  parametros,
        url:   '../Controller/LiquidarController.php',
        type:  'post',
        
        success:  function (response) {
            //alert(response);
            if (response == 1) {
              ConsultarLote(id);
              $('#txtColorLote').val("");
              $('#txtEstiloLote').val("");
              Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Agregado con exito',
                showConfirmButton: false,
                timer: 1500
              })
            }else{
              console.log('Error '+response);
              Swal({
                type: 'error',
                title: 'Oops...',
                text: 'Hubo un error al agregar!'
              })
            }
        },
        error: function (error) {
        alert('error; ' + eval(error));
        }
    });
  }
  function EditarLoteReferencia(idLote, idDetalleReferencia ) {
    $('#btnActualizarLote').css('display', 'inline');
    $('#btnAgregarLote').css('display', 'none');
    $('#txtColorLote').val($('#color'+idLote).html());
    $('#txtEstiloLote').val($('#estilo'+idLote).html());
    $('#idLote').html(idLote);
  }
  function ActualizarLoteReferencia() {
    var id = $('#idLote').html();
    var color = $('#txtColorLote').val();
    var estilo = $('#txtEstiloLote').val();
    var idDetalleReferencia = $('#idDetalle').val();
    var parametros = {
                    "btnActualizarLoteReferencia" : 'true',
                    "idLote" : id,
                    "color" : color,
                    "estilo" : estilo,
                    "idDetalle" : idDetalleReferencia
                };
    $.ajax({
        data:  parametros,
        url:   '../Controller/LiquidarController.php',
        type:  'post',
        
        success:  function (response) {
            //alert(response);
            if (response == 1) {
              ConsultarLote(idDetalleReferencia);
              $('#btnActualizarLote').css('display', 'none');
              $('#btnAgregarLote').css('display', 'inline');
              $('#txtColorLote').val("");
              $('#txtEstiloLote').val("");
              Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Actualizado con exito',
                showConfirmButton: false,
                timer: 1500
              })
            }else{
              console.log('Error '+response);
              Swal({
                type: 'error',
                title: 'Oops...',
                text: 'Hubo un error al actualizar!'
              })
            }
        },
        error: function (error) {
        alert('error; ' + eval(error));
        }
    });
  }

function CargarFormulario(numero) {
    //DOÑA ANGELA
    cancelar();
    //DOÑA ANGELA
    $('#idDetalle').val($('#id'+numero).html());
    var udm = $('#unidadMedida'+numero).html().toUpperCase();
    $("#sel1 option:selected").removeAttr("selected");
    if ($("#sel1 option[value='"+udm+"']").val() != undefined) {
        $("#sel1 option[value='"+udm+"']").prop("selected", true);
    }else{
        $("#sel1 option[value='0']").attr("selected", true);
    }    
    $("#cbxMarca option:selected").removeAttr("selected");
    udm = $('#strMarca'+numero).html();
    if (udm == "") {
      $("#cbxMarca option[value=0]").prop("selected", true);
    }else{
      $("#cbxMarca option[value="+udm+"]").prop("selected", true);
    }

    $("#cbxSexo option:selected").removeAttr("selected");
    udm = $('#strSexo'+numero).html();
    if (udm == "") {
      $("#cbxSexo option[value=0]").prop("selected", true);
    }else{
      $("#cbxSexo option[value="+udm+"]").prop("selected", true);
    }

    $("#cbxMaterial option:selected").removeAttr("selected");
    udm = $('#strMaterial'+numero).html();
    if (udm == "") {
      $("#cbxMaterial option[value=0]").prop("selected", true);
    }else{
      $("#cbxMaterial option[value="+udm+"]").prop("selected", true);
    }
    $('#cbxMaterial1').html($('#materialprueba'+numero).html());
    $('#lblUnidadMedida').html($('#unidadMedida'+numero).html());
    //$('#idDetalle').val($('#id'+numero).html());
    $('#txtEstimadoUno').val($('#estimado1'+numero).html());
    $('#txtEstimadoDos').val($('#estimado2'+numero).html());
    $('#lblReferenciaContenedor').html($('#referencia'+numero).html());
    $('#txtReferencia').val($('#referencia'+numero).html());
    //DOÑA ANGELA
    $('#lblDescripcion').html($('#descripcion'+numero).html());
    $('#lblCantidadContenedor').html($('#cantidad'+numero).html());
    //$('#txtCantidadContenedor').val($('#cantidad'+numero).html());
    $('#txtCxU').val(0);
    $('#txtCantidadPaca').val($('#txtCantidadPaca'+numero).html());
    //DOÑA ANGELA
    //$('#txtDescripcion').val($('#descripcion'+numero).html());
    //$('#txtColor').val($('#color'+numero).html());
    $('#txtDimension').val($('#dimension'+numero).html());
    $('#txtPrecioDos').val(new Intl.NumberFormat('es-MX').format($('#precio2'+numero).html()));
    //$('#txtCxU').val($('#CxU'+numero).html());
    CambiarEstFormulario(false); 

    //NUEVO
    $('#Cantidad').html($('#cantidad'+numero).html());
    //NUEVO
    
    ConsultarLote($('#idDetalle').val());
    
}

function CambiarEstFormulario(blnEstado){
    $('#txtReferencia').attr("readOnly", blnEstado);
    $('#txtDescripcion').attr("readOnly", blnEstado);
    $('#txtPrecioUno').attr("readOnly", blnEstado);
    $('#txtPrecioDos').attr("readOnly", blnEstado);
    $('#txtPrecioTres').attr("readOnly", blnEstado);
    $('#txtPrecioCuatro').attr("readOnly", blnEstado);
    $('#txtPrecioCinco').attr("readOnly", blnEstado);
    $('#btnLiquidar').attr("disabled", blnEstado); 
    $('#txtDimension').attr("readonly", blnEstado); 
    $('#txtDescripcion').attr("readonly", blnEstado);
    $('#txtCxU').attr("readonly", blnEstado);
    $('#txtCantidadPaca').attr("readonly", blnEstado);
    $('#txtColorLote').attr("readonly", blnEstado);
    $('#txtEstiloLote').attr("readonly", blnEstado);
    $('#txtObservacion').attr("readonly", blnEstado);
    $('#btnAgregarLote').attr("disabled", blnEstado);
    $('#btnDuplicar').attr("disabled", blnEstado);
    $('#txtCantidadContenedor').attr("readonly", blnEstado);
}      
function cancelar(){
    $("#sel1 option[value='0']").prop("selected", true);
    $("#cbxMaterial option[value='-1']").prop("selected", true);
    $("#cbxSexo option[value='-1']").prop("selected", true);
    $("#cbxMarca option[value='-1']").prop("selected", true);
    $('#txtReferencia').val("");
    $('#txtDescripcion').val("");
    $('#txtEstimadoDos').val("");
    $('#txtEstimadoUno').val("");
    $('#txtPrecioUno').val("");
    $('#txtPrecioDos').val("");
    $('#txtPrecioTres').val("");
    $('#txtPrecioCuatro').val("");
    $('#txtPrecioCinco').val("");
    $('#txtDimension').val("");
    $('#txtDescripcion').val("");
    $('#txtCxU').val("");
    $('#lblUnidadMedida').html("");
    $('#txtCantidadPaca').val("");
    $('#txtObservacion').val("");
    $('#lblCantidadContenedor').html("");
    $('#txtCantidadContenedor').val("");
    $('#lblDescripcion').html("");
    $('#lblReferenciaContenedor').html("");
    $('#cbxMaterial1').html("");
    $('#cbxMaterial2').val("");
    $('#txtColorLote').val("");
    $('#txtEstiloLote').val("");
    $("#tblTableModificar2 > tbody").empty();
    
    CambiarEstFormulario(true); 
}
function calcular() {
    var x = document.getElementById("txtPrecioUno").value.replace(",", "");
    //var udm = $('#unidadMedida').html();
    $("#sel1 option:selected").removeAttr("selected");
    var udm = $('#sel1').val();
    //alert(x+" udm: "+udm.toLowerCase());
    var P3;
    var P2;
    if (x != "") {
        var parametros = {
                      "btnConsultarPrecios" : 'true',
                      "precio1" : x,
                      "unidadMedida" : udm.toLowerCase()

                  };
      $.ajax({
          data:  parametros,
          url:   '../Controller/LiquidarController.php',
          type:  'post',
          
          success:  function (response) {
              //alert(response);
              document.getElementById('preciosDB').innerHTML=response;
                if (typeof $('#precio2').html() != "undefined") {
                    P2= $('#precio2').html();
                    P3= $('#precio3').html();
                }else{
                    P2=Math.round(x*1.1);
                    P3=Math.round(x*1.2);
                }       
                var P4=Math.round(x*2); //esperar por formula
                var P5=Math.round(x/2);
                document.getElementById("txtPrecioDos").value=new Intl.NumberFormat('es-MX').format(P2);     
                document.getElementById("txtPrecioTres").value =new Intl.NumberFormat('es-MX').format(P3);  
                document.getElementById("txtPrecioCuatro").value =new Intl.NumberFormat('es-MX').format(P4);
                document.getElementById("txtPrecioCinco").value =new Intl.NumberFormat('es-MX').format(P5);
           },
          error: function (error) {
          alert('error; ' + eval(error));
          }
      });
    }
    

    
    //var P2=Math.round(x*1.1);
    //var P3=Math.round(x*1.3);
    
}
    function format(input){
        var num = input.value.replace(/\,/g,"");
        if(!isNaN(num) || num.value=="."){
        num = num.toString().split("").reverse().join("").replace(/(?=\d*\,?)(\d{3})/g,"$1,");
        num = num.split("").reverse().join("").replace(/^[\,]/,"");
        input.value = num;
        }

        else{ 

             $.notify({ message:'Solo se permiten numeros.'  },{
                                    type: 'warning',
                                    placement: {
                                    from: 'top',
                                    align: 'right'
                                                },
                                     z_index: 1031           
                                            });   
                                   
        input.value = input.value.replace(/[^\d\,]*/g,"");
        }
    }

    function Validar(Tipo){
        var txtReferencia="";
        txtReferencia= document.getElementById("txtReferencia");
        var txtDescripcion="";
        txtDescripcion=document.getElementById("txtDescripcion");
        var txtPrecioUno="";
        txtPrecioUno= document.getElementById("txtPrecioUno").value.trim();
        var txtPrecioDos="";

        txtPrecioDos= document.getElementById("txtPrecioDos");
        var  txtPrecioTres="";
        txtPrecioTres= document.getElementById("txtPrecioTres");
        var txtPrecioCuatro="";
     
        txtPrecioCuatro=  document.getElementById("txtPrecioCuatro");
        var txtDimension = document.getElementById("txtDimension");

        var txtCxU = document.getElementById("txtCxU");
        var cbxUdm = $('#sel1').val();

        var txtCantidadPaca = $('#txtCantidadPaca').val();
        //var txtMaterial = $('#txtMaterial').val();

        var txtCantidadContenedor = "";
        txtCantidadContenedor = $('#txtCantidadContenedor').val();
        switch(Tipo){
            case 1:
            /*if(txtMaterial == ""){
                 $.notify({ message:'Ingrese un material.'  },{
                                type: 'warning',
                                placement: {
                                from: 'top',
                                align: 'right'
                                            },
                                 z_index: 1031           
                                        });   
                 document.getElementById("txtMaterial").focus();
                 return false;
            }*/
            if(txtCantidadPaca == ""){
                 $.notify({ message:'Ingrese una cantidad paca.'  },{
                                type: 'warning',
                                placement: {
                                from: 'top',
                                align: 'right'
                                            },
                                 z_index: 1031           
                                        });   
                 document.getElementById("txtCantidadPaca").focus();
                 return false;
            }
            if(txtCantidadContenedor == ""){
                 $.notify({ message:'Ingrese una cantidad.'  },{
                                type: 'warning',
                                placement: {
                                from: 'top',
                                align: 'right'
                                            },
                                 z_index: 1031           
                                        });   
                 document.getElementById("txtCantidadContenedor").focus();
                 return false;
            }
            if(cbxUdm == "0"){
                 $.notify({ message:'Ingrese una UDM.'  },{
                                type: 'warning',
                                placement: {
                                from: 'top',
                                align: 'right'
                                            },
                                 z_index: 1031           
                                        });   
                 document.getElementById("sel1").focus();
                 return false;
            }

            if(txtCxU.value.trim()==""){
                 $.notify({ message:'Ingrese CxU.'  },{
                                type: 'warning',
                                placement: {
                                from: 'top',
                                align: 'right'
                                            },
                                 z_index: 1031           
                                        });   
                 document.getElementById("txtCxU").focus();
                 return false;
            }

           

            if(txtDimension.value.trim()==""){
                 $.notify({ message:'Ingrese una Dimension.'  },{
                                type: 'warning',
                                placement: {
                                from: 'top',
                                align: 'right'
                                            },
                                 z_index: 1031           
                                        });   
                 document.getElementById("txtDimension").focus();
                 return false;
            }

            if(txtReferencia.value.trim()==""){
                 $.notify({ message:'Cargue una Referencia.'  },{
                                type: 'warning',
                                placement: {
                                from: 'top',
                                align: 'right'
                                            },
                                 z_index: 1031           
                                        });   
                 document.getElementById("txtReferencia").focus();
                 return false;
            }

             if(txtDescripcion.value.trim()==""){
                 $.notify({ message:'Ingrese Descripcion.'  },{
                                type: 'warning',
                                placement: {
                                from: 'top',
                                align: 'right'
                                            },
                                 z_index: 1031           
                                        });  
                document.getElementById("txtDescripcion").focus(); 
                 return false;
            }
             if(txtPrecioUno==""){
                 $.notify({ message:'Ingrese Precio Uno.'  },{
                                type: 'warning',
                                placement: {
                                from: 'top',
                                align: 'right'
                                            },
                                 z_index: 1031           
                                        }); 
                 document.getElementById("txtPrecioUno").focus();   
                 return false;
            }
             if(txtPrecioDos.value.trim()==null){
                 $.notify({ message:'Ingrese Precio Dos.'  },{
                                type: 'warning',
                                placement: {
                                from: 'top',
                                align: 'right'
                                            },
                                 z_index: 1031           
                                        });
                                         
                   document.getElementById("txtPrecioDos").focus();                  

                 return false;
            }
             if(txtPrecioTres.value.trim()==null){
                 $.notify({ message:'Ingrese Precio Tres.'  },{
                                type: 'warning',
                                placement: {
                                from: 'top',
                                align: 'right'
                                            },
                                 z_index: 1031           
                                        });  
                          document.getElementById("txtPrecioTres").focus();  
                 return false;
            }
             if(txtPrecioCuatro.value==null){
                 $.notify({ message:'Ingrese Precio Cuatro.'  },{
                                type: 'warning',
                                placement: {
                                from: 'top',
                                align: 'right'
                                            },
                                 z_index: 1031           
                                        });   
                   document.getElementById("txtPrecioCuatro").focus(); 
                 return false;
            }

            break;
        }
        return true;
     }

function IngresarPreciosDetalleCompra() {
    if (Validar(1)){
     //alert($('#sel1').val());
        //DOÑA ANGELA NUEVO PARAMETRO CANTIDAD
        var parametros = {
                    "btnIngresarPreciosDetalleCompra" : 'true',
                    "idDetalle" : $('#idDetalle').val(),
                    "txtPrecioUno" : $('#txtPrecioUno').val(),
                    "txtPrecioDos" : $('#txtPrecioDos').val(),
                    "txtPrecioTres" : $('#txtPrecioTres').val(),
                    "txtPrecioCuatro" : $('#txtPrecioCuatro').val(),
                    "txtPrecioCinco" : $('#txtPrecioCinco').val(),
                    "txtReferencia" : $('#txtReferencia').val(),
                    "txtDescripcion" : $('#txtDescripcion').val(),
                    "txtDimension" : $('#txtDimension').val(),
                    "txtCxU" : $('#txtCxU').val(),
                    "txtUnidadMedida" : $('#sel1').val(),
                    "txtCantidadContenedor" : $('#txtCantidadContenedor').val(),
                    "txtCantidadPaca" : $('#txtCantidadPaca').val(),
                    "txtMaterial" : $('#cbxMaterial2').val(),
                    "txtObservacion" : $('#txtObservacion').val(),
                    "txtSexo" : $('#cbxSexo').val(),
                    "txtMarca" : $('#cbxMarca').val()
                };
        $.ajax({
            data:  parametros,
            url:   '../Controller/LiquidarController.php',
            type:  'post',
            
            success:  function (response) {
              alert(response)
                if (response == 1) {
                    Swal({
                          position: 'top-end',
                          type: 'success',
                          title: 'Registro guardado',
                          showConfirmButton: false,
                          timer: 1500
                        })
                    CargarReferencias();
                    CambiarEstFormulario(true);
                    cancelar();
                    CargarReferenciasTerminadas();
                }else{
                  console.log('Error '+response);
                  Swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Hubo un error en el registro!'
                  })
                }
            },
            error: function (error) {
            alert('error; ' + eval(error));
            }
        });
    }

    
}
function ActuralizarReferenciasLiquidadas(id){
    CambiarEstFormulario(false);
    $('#lblUnidadMedida').html("");
    $("#sel1 option:selected").removeAttr("selected");
    var udm = $('#unidadMedidaM'+id).html();
    if (udm == "") {
      $("#sel1 option[value=0]").prop("selected", true);
    }else{
      $("#sel1 option[value="+udm+"]").prop("selected", true);
    }

    $("#cbxMarca option:selected").removeAttr("selected");
    udm = $('#strMarca'+id).html();
    if (udm == "") {
      $("#cbxMarca option[value=General]").prop("selected", true);
    }else{
      $("#cbxMarca option[value='"+udm+"']").prop("selected", true);
    }

    $("#cbxSexo option:selected").removeAttr("selected");
    udm = $('#strSexo'+id).html();
    if (udm == "") {
      $("#cbxSexo option[value=General]").prop("selected", true);
    }else{
      $("#cbxSexo option[value='"+udm+"']").prop("selected", true);
    }

    $("#cbxMaterial option:selected").removeAttr("selected");
    udm = $('#strMaterial'+id).html();
    if (udm == "") {
      $("#cbxMaterial option[value=General]").prop("selected", true);
    }else{
      $("#cbxMaterial option[value='"+udm+"']").prop("selected", true);
    }

    $('#idDetalle').val(id);
    if ($('#referenciaM'+id).html() == "") {
      $('#txtReferencia').val($('#idreferencia'+id).html()).focus();  
    }else{
      $('#txtReferencia').val($('#referenciaM'+id).html()).focus();
    }
    $('#lblReferenciaContenedor').html($('#idreferencia'+id).html()).focus();
    $('#txtDescripcion').val($('#iddescripcion'+id).html());
    $('#unidadMedida').html($('#idunidadMedida'+id).html());
    var intPrecio2 = $('#intPrecio2'+id).html();
    var intPrecio3 = $('#intPrecio3'+id).html();
    var intPrecio4 = $('#intPrecio4'+id).html();
    var intPrecio5 = $('#intPrecio5'+id).html();
    $('#txtPrecioUno').val($('#intPrecio1'+id).html());
    $('#txtPrecioDos').val(intPrecio2);
    $('#txtPrecioTres').val(intPrecio3);
    $('#txtPrecioCuatro').val(intPrecio4);
    $('#txtPrecioCinco').val(intPrecio5);
    $('#txtDimension').val($('#strDimension'+id).html());
    $('#txtCxU').val($('#intCxU'+id).html());
    $('#lblUnidadMedida').html($('#idunidadMedida'+id).html());
    $('#Cantidad').html($('#idCantidad'+id).html());
    $('#txtCantidadContenedor').val("");
    $('#lblCantidadContenedor').html($('#idCantidad'+id).html());
    $('#txtCantidadContenedor').val($('#cantidadM'+id).html());
    $('#txtCantidadPaca').val($('#intCantidadPaca'+id).html());
    $('#txtObservacion').val($('#strObservacion'+id).html());
    $('body,html').animate({scrollTop : 0}, 500);

    ConsultarLote($('#idDetalle').val());

}

document.querySelector("#buscar").onkeyup = function(){
        $TableFilter("#tblTableModificar", this.value);
    }
    
    $TableFilter = function(id, value){
        var rows = document.querySelectorAll(id + ' tbody tr');
        
        for(var i = 0; i < rows.length; i++){
            var showRow = false;
            
            var row = rows[i];
            row.style.display = 'none';
            
            for(var x = 0; x < row.childElementCount; x++){
                if(row.children[x].textContent.toLowerCase().indexOf(value.toLowerCase().trim()) > -1){
                    showRow = true;
                    break;
                }
            }
            
            if(showRow){
                row.style.display = null;
            }
        }
    }

    //Consultar en liquidar controller la funcion constprodhgi
    function constprodhgi(numero){
        var refs = document.getElementById("referencia"+numero).innerHTML;
        parametros = {
            'btnprod': 'true',
            'referencia': refs
        };
        $.ajax({
            data: parametros,
            url:   '../Controller/LiquidarController.php',
            type: 'post',

            success: function (response){
                document.getElementById('prueba1').innerHTML = response
            },
            error : function(error){
                alert("error" + eval(error));
            },
        });
    }
</script>


