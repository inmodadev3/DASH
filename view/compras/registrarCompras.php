<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==2){
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
<button type="button" class="btn " style="background:#337ab7;" data-toggle="modal" data-target="#Primero"><i style="color:#fff;" class="fa fa-question-circle fa-fw"></i></button></center>
<div class="modal fade" id="Primero">
  <div class="modal-dialog">
    <div class="modal-content">

      
      <div class="modal-header">
        <h4 class="modal-title">Ayuda</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      
      <div class="modal-body">
      En esta pagina usted podra cargar los productos correspondientes a la importacion.
      Con el siguiente archivo <a href="../FormatoDeArchivos/FormatoCompra.xlsx">Archivo Excel</a>
      Por favor siga el modelo.
      </div>      
      <div class="modal-footer">
       
      </div>

    </div>
  </div>
</div>
<!-- Modal Porentaje-->
<div class="modal fade" id="SegundoModal" >
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body text-center">      
          <h4>Porcentaje Descuento</h4>
                <hr>  
                Ingrese el porcentaje de descuento de la factura.<br><br>
                <input type="number" class="form-control" style="width: 50%; margin: auto;" id="txtPorcentaje"  min="0" onkeypress="document.getElementById('lblMensaje').innerHTML=''"><br>
                 <label id="lblMensaje" class="alert alert-warning" style="width: 50%;"> </label><hr>
                <button class="btn btn-primary" onclick="Registro(2);">Aceptar</button>

                 <button type="button" class="btn btn-default" style="color:#337ab7;" data-dismiss="modal" onclick="Limpiar();">Cancelar</button>

        </div>
    </div>
  </div>
</div>







<div style="float: right; align-items: center;text-align: center;">
    <h5>Valor Dolar</h5>
    <h4>
<div id="DolarCO3"><h2><a href="https://dolar.wilkinsonpc.com.co/">Dolar Hoy Colombia</a></h2>

    <a href="https://dolar.wilkinsonpc.com.co/indicadores-economicos-dolar.html">Indicadores Economicos</a></div>

<script type="text/javascript" src="https://dolar.wilkinsonpc.com.co/widgets/gratis/dolar-cop-usd-3.js"></script>
</h4>
</div>
<div class="clearfix"></div>
                 
            <div class="row">
                <div class="col-lg-12">


                <h1  style="margin:0;">Cargar Compra</h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
     <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Formulario
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                            <form role="form" action="../Controller/ComprasController.php" method="get" enctype="multipart/form-data" name="moveFile" id="moveFile">
                                 <fieldset>
                               <div class="form-group col-xs-12">
                                     <div class="form-group col-xs-12">
                                        <label>Adjunte un documento para registrar las Referencias</label>
                                        <input type="file" name="fileName" class="form-control" id="fileName">
                                    </div>               
                                    <br></br>
                                    <div class="form-group col-xs-12">
                                        <label>Importaciรณn</label>     
                                        <input type="text" name="importacion" class="form-control" required="required" id="importacion" value="de">
                                    </div>
                                    <div class="form-group col-xs-12">                    
                                        <label>Raggi</label>
                                      
                                        <input  type="text"  name="docReferencia" class="form-control" required="required" id="Raggi" value="2">                    
                                       
                                    </div>
                                    <div class="form-group col-xs-12">
                                          <input type="checkbox" name="chkTRMCUSD" id="TRMChk"       onchange="HabilitarTRM();" checked="true"><small>USD</small>
                                        <label>TRM</label>
                                          <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                         <input  type="text"  name="txtTRM" class="form-control"  id="txtTRM" onkeyup="format(txtTRM)" onchange="format(txtTRM)" value="2" onchange="format(txtTRM)" >                   
                                        </div>
                                      
                                    </div>
                                    <div class="form-group col-xs-12 col-lg-6">
                                        <input type="checkbox" name="chkOTMUSD" id="chkOTMUSD"><small>USD</small> <input type="checkbox" name="chkOTMSUP" id="chkOTMSUP"><small>Soporte</small> <label>OTM</label>
                                        <input class="form-control" value="2" name="txtOTM" id="txtOTM" type="number" min="0">  
                                    </div>
                                    <div class="form-group col-xs-12 col-lg-6">
                                        <input type="checkbox" name="chkArancelUSD" id="chkArancelUSD"><small>USD</small> <input type="checkbox" name="chkArancelSUP" id="chkArancelSUP"><small>Soporte</small> <label>Arancel</label>
                                        <input class="form-control" name="txtArancel" value="2" id="txtArancel" type="number" min="0">  
                                    </div>   
                                    <div class="form-group col-xs-12 col-lg-6">
                                        <input type="checkbox" name="chkIVAUSD" id="chkIVAUSD"><small>USD</small> <input type="checkbox" name="chkIVASUP" id="chkIVASUP"><small>Soporte</small> <label>IVA</label>
                                        <input class="form-control" name="txtIVA" value="2" id="txtIVA" type="number" min="0">  
                                    </div>
                                    <div class="form-group col-xs-12 col-lg-6 ">
                                        <input type="checkbox" name="chkDescarguesUSD" id="chkDescarguesUSD"><small>USD</small> <input type="checkbox" name="chkDescarguesSUP" id="chkDescarguesSUP"><small>Soporte</small> <label>Descargues</label>
                                        <input class="form-control" name="txtDescargues" id="txtDescargues" type="number" value="2" min="0">  
                                    </div> 
                                    <div class="form-group col-xs-12 col-lg-6">
                                        <input type="checkbox" name="chkDepositoUSD" id="chkDepositoUSD"><small>USD</small> <input type="checkbox" name="chkDepositoSUP" id="chkDepositoSUP"><small>Soporte</small> <label>Depรณsito Zona Franca</label>
                                        <input class="form-control" name="txtDeposito" id="txtDeposito" type="number" value="2" min="0">  
                                    </div>
                                    <div class="form-group col-xs-12 col-lg-6">
                                        <input type="checkbox" name="chkNavieraUSD" id="chkNavieraUSD"><small>USD</small> <input type="checkbox" name="chkNavieraSUP" id="chkNavieraSUP"><small>Soporte</small> <label>Naviera</label>
                                        <input class="form-control" name="txtNaviera" id="txtNaviera" type="number" value="2" min="0">  
                                    </div> 
                                    <div class="form-group col-xs-12 col-lg-6">
                                        <input type="checkbox" name="chkTICUSD" id="chkTICUSD"><small>USD</small> <input type="checkbox" name="chkTICSUP" id="chkTICSUP"><small>Soporte</small> <label>Trans. Int. China</label>
                                        <input class="form-control" name="txtTIC" id="txtTIC" type="number" value="2" min="0">  
                                    </div>
                                    <div class="form-group col-xs-12 col-lg-6">
                                        <input type="checkbox" name="chkOtrosUnoUSD" id="chkOtrosUnoUSD"><small>USD</small> <input type="checkbox" name="chkOtrosUnoSUP" id="chkOtrosUnoSUP"><small>Soporte</small> <label>Otros <small>1</small></label>
                                        <input class="form-control" name="txtOtrosUno" id="txtOtrosUno" type="number" value="2" min="0">  
                                    </div>  
                                    <div class="form-group col-xs-12 col-lg-6">
                                        <input type="checkbox" name="chkOtrosDosUSD" id="chkOtrosDosUSD"><small>USD</small> <input type="checkbox" name="chkOtrosDosSUP" id="chkOtrosDosSUP"><small>Soporte</small> <label>Otros <small>2</small></label>
                                        <input class="form-control" name="txtOtrosDos" id="txtOtrosDos" type="number" value="2" min="0">  
                                    </div>             
                                    <div class="form-group col-xs-12">
                                   <!-- <input class="btn btn-success" type="button" name="moveFile"  value="Registrar" onclick="Registro();">-->
                                    <button type="button" class="btn btn-default"  onclick="Registro(1);"><span class='glyphicon glyphicon-floppy-disk'></span> Registrar</button>
                                    </div>
                                    <input type="hidden" name="txtPorcentaje" id="txtPorcentajeDos">
                                     <input type="text" value="false" name="moveFile" style="visibility: hidden;"/>
                                </div>
                            </fieldset>
                             </form> 
</div></div></div></div>
</div>

<div class="row">
                <div class="col-lg-12">    
            <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Consultar Compras
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="input-group custom-search-form input-group-right">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                                <input type="text" class="form-control" id="search" placeholder="Buscar">
                            </div><br>
                            <div class="row">
                            <div class="col-lg-12">   
                            <div id="div1">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>    
                                            <th>
                                            <strong>#</strong></th> 
                                            <th>Raggi</th>      
                                            <th>Caja</th>      

                                            <th>Referencia</th>
                                            <th>Descripcion</th>
                                            <th>Cantidad</th>
                                            <th>UDM</th>
                                            <th>Costo</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla">
                                    </tbody>   
                                </table>
                            </div><br>
                            </div>
                            </div>

                                </div>
                            </div>
                        </div>
                    </div>
           </div>

<script type="text/javascript">
    
    ConsultarReferencias();
    Limpiar();
    InicializarInput();
    function HabilitarTRM(){
        var chkTRM=document.getElementById("TRMChk");

        /*if(chkTRM.checked){
            document.getElementById("txtTRM").readOnly=false;
            document.getElementById("txtTRM").value="";
        }else{
            document.getElementById("txtTRM").readOnly=true;
            document.getElementById("txtTRM").value="";
        }*/
    }
   
    function ConsultarReferencias(){
        var parametros = {
                        "btnConsultarReferencias" : 'true'
                    };
        $.ajax({
            data:  parametros,
            url:   '../Controller/ComprasController.php',
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
     function RegistrarReferencias() {
        //alert("RegistrarReferencias");
        var Data = new FormData();
        Data.append("btnRegistrarReferencias","true");//recibir parametro
        Data.append("TRMChk",document.getElementById("TRMChk").checked);
        Data.append("txtTRM",document.getElementById("txtTRM").value.trim());
        Data.append('File',document.getElementById("fileName").files[0]);
        //formData.append(f.attr("name"), $(this)[0].files[0]);
        $.ajax({
            url: "../Controller/ComprasController.php",
            type: "post",
            data: Data,
            cache: false,
            contentType: false,
            processData: false,

            success:  function (response) {
                //alert(response);
                if (response == 1) {
                    Swal({
                          position: 'top-end',
                          type: 'success',
                          title: 'Registro guardado',
                          showConfirmButton: false,
                          timer: 1500
                        })
                    Limpiar();
                    ConsultarReferencias();
                }else{
                    console.log('Error '+response);
                    Swal({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Algo salio mal con la hoja de excel!'
                        })
                }
            },
            error: function (error) {
            alert('error; ' + eval(error));
            }
        });
            
    }

    function InicializarInput(){
        document.getElementById('txtOTM').value=0; 
        document.getElementById('txtIVA').value=0; 
        document.getElementById('txtDeposito').value=0; 
        document.getElementById('txtTIC').value=0; 
        document.getElementById('txtOtrosDos').value=0; 
        document.getElementById('txtArancel').value=0; 
        document.getElementById('txtDescargues').value=0; 
        document.getElementById('txtNaviera').value=0; 
        document.getElementById('txtOtrosUno').value=0;   
    }

    function Registro(Tipo){
        rpta = validar(Tipo);
        if (Tipo == 1 && rpta) {
            $('#SegundoModal').modal('show');
        }
        if (rpta && Tipo == 2) {
            var parametros = {
                        "btnRegistrarDocumento" : 'true',
                        "importacion" : document.getElementById("importacion").value.trim(),
                        "Raggi" : document.getElementById("Raggi").value.trim(),
                        "txtTRM" : document.getElementById("txtTRM").value.trim(),
                        "txtOTM" : document.getElementById("txtOTM").value.trim(),
                        "txtArancel" : document.getElementById("txtArancel").value.trim(),
                        "txtIVA" : document.getElementById("txtIVA").value.trim(),
                        "txtDescargues" : document.getElementById("txtDescargues").value.trim(),
                        "txtDeposito" : document.getElementById("txtDeposito").value.trim(),
                        "txtNaviera" : document.getElementById("txtNaviera").value.trim(),
                        "txtTIC" : document.getElementById("txtTIC").value.trim(),
                        "txtOtrosUno" : document.getElementById("txtOtrosUno").value.trim(),
                        "txtOtrosDos" : document.getElementById("txtOtrosDos").value.trim(),

                        "TRMChk" : +document.getElementById("TRMChk").checked,

                        "chkOTMUSD" : +document.getElementById("chkOTMUSD").checked,
                        "chkOTMSUP" : +document.getElementById("chkOTMSUP").checked,

                        "chkArancelUSD" : +document.getElementById("chkArancelUSD").checked,
                        "chkArancelSUP" : +document.getElementById("chkArancelSUP").checked,

                        "chkIVAUSD" : +document.getElementById("chkIVAUSD").checked,
                        "chkIVASUP" : +document.getElementById("chkIVASUP").checked,

                        "chkDescarguesUSD" : +document.getElementById("chkDescarguesUSD").checked,
                        "chkDescarguesSUP" : +document.getElementById("chkDescarguesSUP").checked,

                        "chkDepositoUSD" : +document.getElementById("chkDepositoUSD").checked,
                        "chkDepositoSUP" : +document.getElementById("chkDepositoSUP").checked,

                        "chkNavieraUSD" : +document.getElementById("chkNavieraUSD").checked,
                        "chkNavieraSUP" : +document.getElementById("chkNavieraSUP").checked,

                        "chkTICUSD" : +document.getElementById("chkTICUSD").checked,
                        "chkTICSUP" : +document.getElementById("chkTICSUP").checked,

                        "chkOtrosUnoUSD" : +document.getElementById("chkOtrosUnoUSD").checked,
                        "chkOtrosUnoSUP" : +document.getElementById("chkOtrosUnoSUP").checked,

                        "chkOtrosDosUSD" : +document.getElementById("chkOtrosDosUSD").checked,
                        "chkOtrosDosSUP" : +document.getElementById("chkOtrosDosSUP").checked,

                        "txtPorcentaje" : document.getElementById("txtPorcentaje").value.trim(),
                        "fileName" : document.getElementById("fileName").value.trim()

                    };
            $.ajax({
                data:  parametros,
                url:   '../Controller/ComprasController.php',
                type:  'post',
                
                success:  function (response) {
                    //alert(response);
                    $('#SegundoModal').modal('hide');
                    if(response == 1){
                        RegistrarReferencias();
                    }else{
                        console.log('Error '+response);
                        Swal({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Algo salio mal revisar porfavor!'
                        })
                    }
                    //document.getElementById('tabla').innerHTML=response;
                },
                error: function (error) {
                alert('error; ' + eval(error));
                }
            });
        }

        /*document.getElementById("txtPorcentajeDos").value=document.getElementById("txtPorcentaje").value.trim();
         document.getElementById("txtTRM").value= document.getElementById("txtTRM").value.replace(",","");
        document.getElementById("moveFile").submit();*/
    }
   

    function validar(Tipo){
                var Importacion="";
                var Raggi="";
                var Porcentaje="";
                var File="";
                var chkTRM=document.getElementById("TRMChk");
                var chkOTMUSD=document.getElementById("chkOTMUSD");
                var chkArancelUSD=document.getElementById("chkArancelUSD");
                var chkIVAUSD=document.getElementById("chkIVAUSD");
                var chkDescarguesUSD=document.getElementById("chkDescarguesUSD");
                var chkDepositoUSD=document.getElementById("chkDepositoUSD");
                var chkNavieraUSD=document.getElementById("chkNavieraUSD");
                var chkTICUSD=document.getElementById("chkTICUSD");
                var chkOtrosUnoUSD=document.getElementById("chkOtrosUnoUSD");
                var chkOtrosDosUSD=document.getElementById("chkOtrosDosUSD");
                var TRM="";


                Porcentaje=document.getElementById("txtPorcentaje").value.trim();
                Importacion=document.getElementById("importacion").value.trim();
                Raggi=document.getElementById("Raggi").value.trim();
                File=document.getElementById("fileName").value.trim();
                TRM=document.getElementById("txtTRM").value.trim();

                switch(Tipo){
                    case 1:

                    if(File==""){
                       
                             $.notify({ message:'Seleccione el archivo.'  },{
                           type: 'warning',
                            placement: {
                            from: 'top',
                             align: 'right'
                                        },
                             z_index: 1031
                                    }); 
                                    document.getElementById("fileName").focus();   
            
                        return false;
                    }


                    if(Importacion==""){
                       
                             $.notify({ message:'Ingrese Importaciรณn.'  },{
                           type: 'warning',
                            placement: {
                            from: 'top',
                             align: 'right'
                                        },
                             z_index: 1031
                                    }); 
                                    document.getElementById("importacion").focus();   
            
                        return false;
                    }
                    if(Raggi==""){
                         
                             $.notify({ message:'Ingrese Raggi.'  },{
                            type: 'warning',
                            placement: {
                            from: 'top',
                            align: 'right'
                                        },
                             z_index: 1031           
                                    });   
                                    document.getElementById("Raggi").focus();    
            
                      return false;
                    }

                     if(chkTRM.checked && TRM==""){

                          $.notify({ message:'Ingrese TRM.'  },{
                            type: 'warning',
                            placement: {
                            from: 'top',
                            align: 'right'
                                        },
                             z_index: 1031           
                                    });   
                                    document.getElementById("txtTRM").focus();   
                                    return false; 
                     }
                     if(chkOTMUSD.checked && TRM==""){
                        $.notify({ message:'Ingrese TRM para calcular OTM.'  },{
                            type: 'warning',
                            placement: {
                            from: 'top',
                            align: 'right'
                                        },
                             z_index: 1031           
                                    });   
                                    document.getElementById("txtTRM").focus();   
                                    return false; 
                     }
                       if(chkArancelUSD.checked && TRM==""){
                        $.notify({ message:'Ingrese TRM para calcular ARANCEL.'  },{
                            type: 'warning',
                            placement: {
                            from: 'top',
                            align: 'right'
                                        },
                             z_index: 1031           
                                    });   
                                    document.getElementById("txtTRM").focus();   
                                    return false; 
                     }
                      if(chkIVAUSD.checked && TRM==""){
                        $.notify({ message:'Ingrese TRM para calcular ARANCEL.'  },{
                            type: 'warning',
                            placement: {
                            from: 'top',
                            align: 'right'
                                        },
                             z_index: 1031           
                                    });   
                                    document.getElementById("txtTRM").focus();   
                                    return false; 
                     }
                      if(chkDescarguesUSD.checked && TRM==""){
                        $.notify({ message:'Ingrese TRM para calcular DESCARGUE.'  },{
                            type: 'warning',
                            placement: {
                            from: 'top',
                            align: 'right'
                                        },
                             z_index: 1031           
                                    });   
                                    document.getElementById("txtTRM").focus();   
                                    return false; 
                     }
                      if(chkDepositoUSD.checked && TRM==""){
                        $.notify({ message:'Ingrese TRM para calcular DEPOSITO.'  },{
                            type: 'warning',
                            placement: {
                            from: 'top',
                            align: 'right'
                                        },
                             z_index: 1031           
                                    });   
                                    document.getElementById("txtTRM").focus();   
                                    return false; 
                     }
                         if(chkNavieraUSD.checked && TRM==""){
                        $.notify({ message:'Ingrese TRM para calcular NAVIERA.'  },{
                            type: 'warning',
                            placement: {
                            from: 'top',
                            align: 'right'
                                        },
                             z_index: 1031           
                                    });   
                                    document.getElementById("txtTRM").focus();   
                                    return false; 
                     }
                      if(chkTICUSD.checked && TRM==""){
                        $.notify({ message:'Ingrese TRM para calcular TIC.'  },{
                            type: 'warning',
                            placement: {
                            from: 'top',
                            align: 'right'
                                        },
                             z_index: 1031           
                                    });   
                                    document.getElementById("txtTRM").focus();   
                                    return false; 
                     }
                     if(chkOtrosUnoUSD.checked && TRM==""){
                        $.notify({ message:'Ingrese TRM para calcular OTRO UNO.'  },{
                            type: 'warning',
                            placement: {
                            from: 'top',
                            align: 'right'
                                        },
                             z_index: 1031           
                                    });   
                                    document.getElementById("txtTRM").focus();   
                                    return false; 
                     }
                        if(chkOtrosDosUSD.checked && TRM==""){
                        $.notify({ message:'Ingrese TRM para calcular OTRO DOS.'  },{
                            type: 'warning',
                            placement: {
                            from: 'top',
                            align: 'right'
                                        },
                             z_index: 1031           
                                    });   
                                    document.getElementById("txtTRM").focus();   
                                    return false; 
                     }
                    break;
                    case 2:
                    if(Porcentaje==""){


                                    document.getElementById("lblMensaje").innerHTML="Ingrese porcentaje.";
                                    document.getElementById("txtPorcentaje").focus(); 
                                    return false;  
                    }

                    break;
                }

                return true;
        
                    
    }
    function Limpiar(){
        $('#lblMensaje').html("");
        $('#fileName').val("");
        $('#txtTRM').val("");
        $('#txtOTM').val("");
        $('#txtArancel').val("");
        $('#txtIVA').val("");
        $('#importacion').val("");
        $('#Raggi').val("");
        $('#txtDeposito').val("");
        $('#txtTIC').val("");
        $('#txtOtrosDos').val("");
        $('#txtDescargues').val("");
        $('#txtNaviera').val("");
        $('#txtOtrosUno').val("");
        $('#txtPorcentaje').val("");
    }
    function format(input,tipo)
    {
        var num = input.value.replace(/\,/g,"");
        if(!isNaN(num)){
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

</script>
<!--<script type="text/javascript">


   
    

    /*


  

  */

</script>-->