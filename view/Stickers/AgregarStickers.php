<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==4){
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
<style type="text/css">
  @media screen and (min-width: 1380px) {
                              #page-wrapper{ 
                                  height: 100vh; 
                     }
    }
</style>
<button type="button" style="background:#303F9F;" class="btn" data-toggle="modal" data-target="#Primero"><i style="color:#fff;" class="fa fa-question-circle fa-fw"></i></button>

<div class="modal fade" id="Primero">
  <div class="modal-dialog">
    <div class="modal-content">

      
      <div class="modal-header">
        <h4 class="modal-title">Ayuda</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      
      <div class="modal-body">
      En esta pagina usted podra cargar los productos correspondientes a la importacion.
      Con el siguiente archivo <a href="../prueba.xlsx">Archivo Excel</a>
      Por favor siga el modelo.
      </div>      
      <div class="modal-footer">
       
      </div>

    </div>
  </div>
</div>
<br>
<br>

<div class="row">
         <div class="col-sm-12">    
           <div class="panel panel-default">
              <div class="panel-heading">
                  <i class="fa fa-user fa-fw"></i>Stickers
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
                          <div id="div1">
                              <table class="table table-hover table-bordered">
                                  <thead>
                                      <tr>  
                                          <th>#</th>      
                                                                              
                                          <th>Referencia</th>
                                          <th>Descripcion</th>                                          
                                          <th>Unidad Medida</th>
                                          <!--<th>Estado</th>--> 
                                          <th>Operacion</th>     
                                      </tr>
                                  </thead>
                                  <tbody id="tabla">

                                  </tbody>    
                              </table>
                          </div><br>
                      </div>	
                             

                                


				 <div class="col-lg-5">

        		   <div class="panel panel-default ">
                 	   <div class="panel-heading" >
                 	            <i class="fa fa-edit fa-fw"></i> Ingresar
                  	  </div>                       
                     <div class="panel-body" >

                        <form method="post" action="<?= URL ?>Stickers/ActuarlizarReferencias" id="frmStickers" >
	                            <div class="row">
                                 
	                                <div class="col-lg-6">

                                        <div class="form-group">
                                            <label>Referencia</label>
                                            <input type="text"  name="txtReferencia" class="form-control" id="txtReferencia" maxlength="15">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <input type="text" name="txtDescripcion" id="txtDescripcion" class="form-control" >
                                        </div>
                                       <div class="form-group">
                                            <label>Unidad Medida</label>
                                            <input type="text" name="txtUDM"  id="txtUDM" class="form-control"  >
                                        </div>
                                        <div class="form-group">
                                            <label>Cantidad por unidad medida</label>
                                            <input type="number" name="txtCantUDM"  id="txtCantUDM" class="form-control" min="0" required="true">                                 
                                 </div>
                             </div>
                                 <div class="col-lg-6">
                                 	  
                                      <div class="form-group">
                                            <label>Precio 1</label>
                                            <input  id="txtPrecioUno" type="text" onkeyup="format(txtPrecioUno); calcular()" onchange="format(txtPrecioUno);" maxlength="10" name="txtPrecioUno" class="form-control" placeholder="0">
                                        </div>
                                        <div class="form-group">
                                            <label>Precio 2</label>
                                            <input  type="text"  name="txtPrecioDos" placeholder="0"  
                                            id="txtPrecioDos" class="form-control" onkeyup="format(txtPrecioDos)" onchange="format(txtPrecioDos);" >
                                        </div>
                                        <div class="form-group">
                                            <label>Precio 3</label>

                                            <input type="text" name="txtPrecioTres" placeholder="0" 
                                            id="txtPrecioTres" class="form-control" 
                                            onkeyup="format(txtPrecioTres)" onchange="format(txtPrecioTres);" >
                                        </div><br>
                                        <div class="form-group">
                                            <label>Precio 4</label>
                                            <input  type="text"  id="txtPrecioCuatro" placeholder="0" name="txtPrecioCuatro" class="form-control" onkeyup="format(txtPrecioCuatro)" onchange="format(txtPrecioCuatro);" />
                                        </div>
                                        <div class="form-group">
                                            <label>Precio 5</label>
                                            <input  type="text"  id="txtPrecioCinco" placeholder="0" name="txtPrecioCinco" class="form-control" onkeyup="format(txtPrecioCinco)" onchange="format(txtPrecioCuatro);" />
                                        </div>

                                        <input type="hidden" name="txtIDReferencia" id="txtIDReferencia">
                                         
                                       
                                </div>
                            </div>
                             <button class="btn btn-default" type="button" id="btnLiquidar" name="btnLiquidar" value="true" onclick="TerminarReferencia();"> <i class="glyphicon glyphicon-ok"></i> Terminar</button>
                                         <button class="btn btn-default " type="button" onclick="cancelar();"><i class="glyphicon glyphicon-remove"></i> Cancelar</button>
                                     
                         </form>
                         </div>
                       </div>
                      </div>
                    </div> 
							   	</div>

								<div style="padding: 10px;">   
                                      <div class="row">
                                        <div class="col-lg-3">
	                                         <label>Color</label>
                                          	<select class="form-control display-inline-block col-xs-12" id="ddlColor">
                                            
                                          		 <?php

                                               $Colores=explode("%", $WebServiceStickerColores["ColoresResult"]);
                                                 for($i=0;$i<=sizeof($Colores)-1;$i++){
                                                    if($i%2!=0){
                                                    echo "<option value=".$Colores[$i-1].">".$Colores[$i]."</option>";
                                                    }
                                                 }
                                                $WebServiceStickerColores=null;
                                              ?>
                                          	</select>
                                          </div>
                                          <div class="col-lg-3">
                                        	<label>Talla</label>
                                          	<select class="form-control display-inline-block" id="ddlTalla">
                                            
                                              <?php
                                             
                                               $Tallas=explode("%", $WebServiceStickerTallas["TallasResult"]);
                                                 for($i=0;$i<=sizeof($Tallas)-1;$i++){
                                                    if($i%2!=0){
                                                    echo "<option value=".$Tallas[$i-1].">".$Tallas[$i]."</option>";
                                                    }
                                                 }
                                                $WebServiceStickerTallas=null;
                                          
                                              ?>
                                          	</select>   
                                          </div>
                                          <div class="col-lg-3">

                                          	<label>Estilo</label>
                                          	<select class="form-control display-inline-block"  id="dllEstilo">
                                                <option value="0">Sin Estilo</option> 
                                          		<?php
                                          		for($i=1;$i<=10;$i++){
                                          			 echo "<option value='".$i."'>Estilo ".$i."</option>";
                                          		}
                                          		 ?>
                                          	</select>
                                          </div>
                                            <div class="col-lg-3">
                                              <br>
                                          	<input type="button" onclick="AddLote();" value="+ Add" class="btn btn-success" id="btnAdd" style="width: 100%;">
                                            
                                            </div> 
                                          
                                           </div> 
                                      		<br><br>
                                          <div id="div1" style="height: 200px;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>  
                                                    <th>#</th>      
                                                    <th>Referencia</th>
                                                    <th>Color</th>                                    
                                                    <th>Talla</th>
                                                    <th>Estilo</th>                                          
                                                         
                                                </tr>
                                            </thead>
                                            <tbody id="tblLote">
                                                                                     
                                            </tbody>    
                                        </table>
                                    </div>

                                    
                  </div>

</div>
</div>
</div>
           <br>
            <div class="row">
              <div class="col-lg-12">                                    
                  <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i>Referencias Terminadas
                        </div>                   
                        <div class="panel-body">                 
                            <div class="row">
                            <div class="col-lg-12">   
                            <div id="div1">
                                 <table class="table table-hover" id="tblTableModificar">
                                    <thead>
                                        <tr>                                                                                   
                                            <th>#</th>                                                                             
                                            <th>Referencia</th>
                                            <th>Descripcion</th>                                           
                                            <th>Precio 1</th>
                                            <th>Precio 2</th>
                                            <th>Precio 3</th>
                                            <th>Precio 4</th>
                                         
                                                 <th>CxU</th>
                                            <th>UDM</th>
                                               <th>Estado</th>
                                       
                                            <th>Operaciones</th>                                     
                                        </tr>
                                    </thead>
                                     <tbody id="tblXFoto">
                                      <?php $i=0; foreach ($ResultadoReferenciaXFoto as $key => $value): ?>  

                                                      <tr>
                                                          

                                                         
                                                          <td><?=$i;?></td>
                                                            <td style="display: none;">
                                                                <?php echo $value->intIdReferencia ?> 
                                                            </td> 
                                                           
                                                                                                                               
                                                      <td>
                                                        <?php echo $value->strReferencia ?>
                                                   
                                                     </td>

                                                        <td>
                                                          <?php echo $value->strDescripcion ?>

                                                          </td>                                            
                                                          <td>
                                                              <?php echo number_format($value->intPrecioUno) ?>

                                                           </td>                                           
                                                             <td>
                                                                 <?php echo number_format($value->intPrecioDos) ?>
                                                             </td>
                                                               <td>
                                                                  <?php echo number_format($value->intPrecioTres) ?>
                                                               </td>

                                                              <td>
                                                                 <?php echo number_format($value->intPrecioCuatro) ?>

                                                               </td>
                                                             

                                                                         <td >
                                                                            <?php echo $value->strCantXUnidad ?>
                                                     
                                                     </td>
                                                       
                                                         <td >
                                                             <?php echo $value->strUnidadMedida ?>
                                                       
                                                     </td>
                                                      <td class="bg-primary"><strong>Por Foto</strong></td>
                                                     <td><button onclick="ActualizarRefXFoto('<?=$i?>');" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button>


                                                          <button type="button" class="btn btn-info"  onclick="VisualizarLote('<?=$i?>');"> <span class="glyphicon glyphicon-list"></span></button>
                                                              </td>
                                                     
                                            </tr>
                                           
                                     <?php $i++;  endforeach;$ResultadoReferenciaXFoto=null; ?>  
                                         </tbody>     
                                </table>
                               
                            </div>
                            </div>
                            </div>
    
                            </div>
                      </div> 
                 </div>
            </div>
              <button type="button" class="btn btn-success glyphicon glyphicon-qrcode" onclick="GenerarExcel();"></button>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="ModalLote">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Lote Referencia</h4>
      </div>
      <div class="modal-body">

        <table class="table table-hover">
           <thead>
                                        <tr>                                                                                   
                                             <th>#</th>      
                                                    <th>Referencia</th>
                                                    <th>Color</th>                                    
                                                    <th>Talla</th>
                                                    <th>Estilo</th>                       
                                        </tr>
                                    </thead>
                                     <tbody id="tblLoteFoto">

                                     </tbody>

         </table> 
      </div>
    
    </div>
  </div>
</div>

  
    
     
 <table class="table table-hover" id="tblReporteExcel">
           <thead>
                                        <tr>                                                                              
                                                    <th>Referencia</th>
                                                    <th>Descripcion</th>                                    
                                                    <th>Precio Uno</th>
                                                    <th>Precio Dos</th> 
                                                    <th>Precio Tres</th> 
                                                    <th>Estilo</th>    
                                                    <th>Color</th>  
                                                    <th>Talla</th>                    
                                        </tr>
                                    </thead>
                                     <tbody id="tblExcel">

                                     </tbody>

         </table> 

<script type="text/javascript" id="Mensaje"></script>
<script type="text/javascript">
  CargarReferencias();
  function CargarReferencias() {
    //alert("hola");
      var parametros = {
                      "btnConsultarReferencias" : 'true'
                  };
      $.ajax({
          data:  parametros,
          url:   '../Controller/StickersController.php',
          type:  'post',
          
          success:  function (response) {
              //alert(response);
              document.getElementById('tabla').innerHTML=response;
          },
          error: function (error) {
          alert('error; ' + eval(error));
          }
      });
  }

  function CargarFormulario(i){
    $('#txtReferencia').val($('#referencia'+i).html());
    $('#txtDescripcion').val($('#descripcion'+i).html());
    $('#txtUDM').val($('#unidadMedida'+i).html());
    $('#txtCantUDM').val($('#intCantidad'+i).html());
    $('#txtPrecioUno').val($('#intPrecio1'+i).html());
    $('#txtPrecioDos').val($('#intPrecio2'+i).html());
    $('#txtPrecioTres').val($('#intPrecio3'+i).html());
    $('#txtPrecioCuatro').val($('#intPrecio4'+i).html());
    $('#txtPrecioCinco').val($('#intPrecio5'+i).html());
    
  }

  function format(input){
      var num = input.value.replace(/\,/g,"");
      if(!isNaN(num) || num.value=="."){
        num = num.toString().split("").reverse().join("").replace(/(?=\d*\,?)(\d{3})/g,"$1,");
        num = num.split("").reverse().join("").replace(/^[\,]/,"");
        input.value = num;
      }else{ 

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

  function calcular() {
      var x = document.getElementById("txtPrecioUno").value.replace(",", "");

      var P2=Math.round(x*1.1);
      var P3=Math.round(x*1.3);
      var P4=Math.round(x*2);
      var P5=Math.round(x/2);
      document.getElementById("txtPrecioDos").value=new Intl.NumberFormat().format(P2);           
      document.getElementById("txtPrecioTres").value =new Intl.NumberFormat().format(P3);  
      document.getElementById("txtPrecioCuatro").value =new Intl.NumberFormat().format(P4);
      document.getElementById("txtPrecioCinco").value =new Intl.NumberFormat().format(P5);
  }

</script>
