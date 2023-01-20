<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==21){
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
<style type="text/css">
   .swal2-container {
     zoom : 1.4 ;
     -moz-transform: scale(1.4);
    }
    th:hover{
      cursor: pointer;
    }
</style>
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
            <i class="fa fa-user fa-fw"></i>Clientes
        </div>
       
        <div class="panel-body">
          <div class="input-group">
              <span class="input-group-addon" ><i class="fa fa-search"></i></span>
              <input type="text" class="form-control" placeholder="Buscar" id='txtbuscarcliente' onkeyup="BuscarTercero();">
          </div>
          <div>
            <label>Ciudad</label>
            <select class="form-control" id='ddlCiudadesAsociadas' onchange="ListarClientes();">
              
            </select>
          </div>
          <br>
              <div style="overflow-y: scroll;height:550px; ">             
                <table class="table table-striped table-hover" id='tblVendedores'>
                  <thead>
                    <th>#</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                                <th>Nombre Tienda</th>
                    <th>Dirección</th>
                    <th>Dirección 2</th>
                    <th>Telefono</th>
                    <th>Celular</th>
                    <th>Descuento</th>
                    <th>Cupo</th>
                    <th>Saldo Cartera</th>
                    <th>Cupo Disponible</th>
                    <th>Ultima Visita</th>
                                <th>Acciones</th>
                  </thead>
                  <tbody id='tblclientesvendedores'>

                  </tbody>
                </table>
              </div>
            <br>
            </div>
          </div>
        </div>
    </div>
<div>
  </div>  
</div>  

<div class="modal fade bd-example-modal-lg" id="ModalGestionCliente" tabindex="-1" role="dialog"
    aria-labelledby="ModalGestionCliente" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="lblNombreTercero">Nombre Tercero</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ModalGestionCliente-body">
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        Informacion cliente
                    </div>

                    <div class="panel-body" id="InfoTercero">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <label for="" class="col-sm-2 col-form-label text-center">Identificacion</label>
                                    <label for="" class="col-sm-2 col-form-label text-center">Zona</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Email</label>
                                    <label for="" class="col-sm-2 col-form-label text-center">Ultima Compra</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Observaciones</label>
                                </div>
                                <div class="row">
                                    <label id="lblIdentificacion" style="font-weight: normal;"
                                        class="col-sm-2 col-form-label text-center"></label>
                                    <label id="lblZona" style="font-weight: normal;"
                                        class="col-sm-2 col-form-label text-center"></label>
                                    <label id="lblEmail" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lblUltimaCompra" style="font-weight: normal;"
                                        class="col-sm-2 col-form-label text-center"></label>
                                    <label id="lblObservaciones" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        Informacion Financiera
                    </div>

                    <div class="panel-body" id="InfoFinanciera">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <label for="" class="col-sm-1 col-form-label text-center">Cupo</label>
                                    <label for="" class="col-sm-2 col-form-label text-center">Descuento</label>
                                    <label for="" class="col-sm-2 col-form-label text-center">Cartera</label>
                                    <label for="" class="col-sm-1 col-form-label text-center">Plazo</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Tiempo prom.
                                        recaudo</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Tiempo prom.
                                        compra</label>
                                </div>
                                <div class="row">
                                    <label id="lblcupo" style="font-weight: normal;"
                                        class="col-sm-1 col-form-label text-center"></label>
                                    <label id="lbldesC" style="font-weight: normal;"
                                        class="col-sm-2 col-form-label text-center"></label>
                                    <label id="lblcartera" style="font-weight: normal;"
                                        class="col-sm-2 col-form-label text-center"></label>
                                    <label id="lblplazo" style="font-weight: normal;"
                                        class="col-sm-1 col-form-label text-center"></label>
                                    <label id="lblpromrecaudo" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lblpromcompra" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        Informacion detallada
                    </div>

                    <div class="panel-body" id="InfoDetalle">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <label for="" class="col-sm-3 col-form-label text-center">Tipo Cliente</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Encargado de
                                        compras</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Direccion 1</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Direccion 2</label>
                                </div>
                                <div class="row">
                                    <label id="lbltipocliente" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lblencargadocompras" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lbldireccion1" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lbldireccion2" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <label for="" class="col-sm-3 col-form-label text-center">Lista Precio</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Telefono</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Celular</label>
                                    <label for="" class="col-sm-3 col-form-label text-center">Fax</label>
                                </div>
                                <div class="row">
                                    <label id="lblparam1" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lbltelefono" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lblcelular" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                    <label id="lblFax" style="font-weight: normal;"
                                        class="col-sm-3 col-form-label text-center"></label>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        Contactos
                    </div>

                    <div class="panel-body">
                        <div class="row" id="rowContactos">
                            
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading text-center">
                        Gestion
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading text-center">
                                        Estadistica de lineas mas vendidas
                                    </div>

                                    <div class="panel-body" id="Estadisticas-lineas">
                                        <canvas id="myChart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $( document ).ready(function() {
    DdlCiudadesAsociadas();
  });
  var $i=0;
  function ListarClientes(){
    $i=0;

    document.getElementById('tblclientesvendedores').innerHTML='';
        var parametros={
                
                            "btnListarClientes" : 'true',
                            "strCiudad" : document.getElementById('ddlCiudadesAsociadas').value.trim()
                        };
                   
        $.ajax({
            data:  parametros,
                    url:   '../Controller/ParametrizarVendedorController.php',
                    type:  'post',                           
                    success:  function (response) {  
                      
                      document.getElementById('tblclientesvendedores').innerHTML=response;
                      $i=0;
                    },
                    error: function (error) {
                    alert('error; ' + eval(error));
                    }
        })
  }
  function BuscarTercero(){
    var txtTercero =document.getElementById('txtbuscarcliente');
    if(txtTercero.value.trim()==''){
      ListarClientes();
      return;
    }
    var parametros={
                    "btnBuscarTerceroUsuario" : 'true',
                    "strTercero" : txtTercero.value.trim()
                   };        
    $.ajax({
                data:  parametros,
                url:   '../Controller/TerceroController.php',
                type:  'post',                           
                success:  function (response) {                  
                  document.getElementById('tblclientesvendedores').innerHTML=response;
                },
                error: function (error) {
                alert('error; ' + eval(error));
                }
            })
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
                  ListarClientes();
                },
                error: function (error) {
                alert('error; ' + eval(error));
                }
            })
  }

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
        if($i=0){
          clearInterval(timerInterval);
          Cargando();
        }
        if($i=1){
          clearInterval(timerInterval);
        }
        
      }
    }).then((result) => {
      if (
        result.dismiss === swal.DismissReason.timer
      ) {
        
      }
    });
}  
function OpenModal(id, idTercero, nombreTercero) {
    //ESTADISTICAS DE LAS CLASES
    EstadisticaClases(idTercero);
    //console.log(idTercero + " " + nombreTercero);
    //MOSTRAMOS VENTANA DE CARGA
    Loading(true);
    //CONSULTAMOS EL ID DEL PORTAFOLIO
    var {
        IdPortafolio,
        TipoAcceso
    } = ValidarExistenciaPortafolio(idTercero, nombreTercero);
    //TIPO DE ACCESO AL PORTAFOLIO
    SeleccionarTipoAccesoPortafolio(TipoAcceso);
    ConsultarFolders(idTercero, IdPortafolio);
    ConsultarCartera(idTercero);
    $('#IdPortafolio').html(IdPortafolio);
    var parametros = {
        "CargarPanelDetalleTercero": "true",
        idTercero
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        async: true,
        success: function(res) {
            SweetAlert.close();
            console.log(res);


            var html = '';
            $('#rowContactos').html('');
            res['contactos'].forEach(val=>{
                html+=`<div class="col-sm-12">
                            <div class="row">
                                <label for="" class="col-sm-4 col-form-label text-center">Nombre</label>
                                <label for="" class="col-sm-4 col-form-label text-center">Telefono</label>
                                <label for="" class="col-sm-4 col-form-label text-center">Celular</label>
                            </div>
                            <div class="row" style="padding-bottom: 10px;">
                                <label style="font-weight: normal;"
                                    class="col-sm-4 col-form-label text-center">`+val.StrApellidos+` `+val.StrNombres+`</label>
                                <label style="font-weight: normal;"
                                    class="col-sm-4 col-form-label text-center">`+val.StrTelefono+`</label>
                                <label style="font-weight: normal;"
                                    class="col-sm-4 col-form-label text-center">`+val.StrCelular+`</label>
                            </div>
                        </div>`;
            });
            $('#rowContactos').append(html);


            $('#' + id).modal('show');
            var obj = res['terceros'];
            var lista = res['contactos'];
            var obj1 = res['FC'];
            var listaPrecio = '';
            if(lista !== []){
                for (let index = 0; index < obj[0]['IntPrecio']; index++) {
                    listaPrecio+='* ';
                }
            }
            console.log(obj[0]['StrDescuento'])
            $('#lblpromcompra').html(obj1[0]);
            $('#lbltipocliente').html(obj[0]['StrDescripcionTipoTercero']);
            $('#lblencargadocompras').html(obj[0]['StrVendedorAsociado']);
            $('#lblIdentificacion').html(obj[0]['StrIdTercero']);
            $('#lblObservaciones').html(obj[0]['StrOtrosDatos']);
            var strIdTercero = obj[0]['StrIdTercero'];
            $('#lblZona').html(obj[0]['StrDescripcion']);
            $('#lblNombreTercero').html(obj[0]['StrNombre']);
            $('#lblUltimaCompra').html(obj[0]['UltimaCompra']);
            $('#lblEmail').html(obj[0]['StrMailFE']);
            $('#lblcupo').html(new Intl.NumberFormat().format(obj[0]['IntCupo']));
            $('#lbldesC').html(obj[0]['StrDescuento']);
            $('#lblplazo').html(obj[0]['IntPlazo']);
            $('#lbltelefono').html(obj[0]['StrTelefono']);
            $('#lblFax').html(obj[0]['StrFax']);
            $('#lblcelular').html(obj[0]['StrCelular']);
            $('#lbldireccion1').html(obj[0]['StrDireccion']);
            $('#lbldireccion2').html(obj[0]['StrDireccion2']);
            $('#lblparam1').html(listaPrecio);
        },
        error: function(error) {
            console.log((error.responseText));
        }
    });
}

function EstadisticaClases(idTercero) {
    var labes = []; //['acero', 'lindas', 'apliques','ska', 'bowl', 'kick', 'filp', 'varial', 'pop'];
    var data = []; //[5, 40, 10, 5, 3, 2, 6, 4, 25];
    var parametros = {
        "PorcentajeParticipacion": "true",
        idTercero
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        async: true,
        success: function(response) {
            //console.log(response);
            $.each(response['rpta'], function(index, item) {
                data.push(item.Cantidad);
                labes.push(item.StrDescripcion);
            });
        },
        error: function(error) {
            console.log((error.responseText));
        }
    });
    $("#Estadisticas-lineas").html('<canvas id="myChart" width="400" height="400"></canvas>');

    var ctx = document.getElementById('myChart');
    //$('#myChart').html("");

    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labes,
            datasets: [{
                label: '# of Votes',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 61, 96, 0.2)',
                    'rgba(61, 129, 255, 0.2)',
                    'rgba(61, 251, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 61, 96, 1)',
                    'rgba(61, 129, 255, 1)',
                    'rgba(61, 251, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {}
    });
}

function Loading(display) {
    let timerInterval;
    swal({
        title: 'Cargando...',
        html: 'Espere mientras carga la página.',
        allowOutsideClick: false,
        onOpen: () => {
            swal.showLoading()
        },
        onClose: () => {
            clearInterval(timerInterval);

        }
    });
}

function ValidarExistenciaPortafolio(idTercero, nombreTercero) {
    var resDB = {};
    var parametros = {
        "ValidarExistenciaPortafolio": "true",
        "idTercero": idTercero,
        "nombreTercero": nombreTercero
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        async: false,
        dataType: 'JSON',
        success: function(res) {
            resDB = res;
        },
        error: function(error) {
            console.log((eval(error.responseText)));
        }
    });
    return resDB;
}

function SeleccionarTipoAccesoPortafolio(tipoAcceso) {
    if (tipoAcceso == 0) {
        $('#radio0').prop('checked', true);
    } else if (tipoAcceso == 1) {
        $('#radio1').prop('checked', true);
    } else if (tipoAcceso == 2) {
        $('#radio2').prop('checked', true);
    }
}

function ConsultarCartera(idTercero) {
    var rpta = -1;
    var parametros = {
        "ConsultarCartera": "true",
        idTercero
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        success: function(res) {
            //console.log(res);
            cartera = Intl.NumberFormat().format(res);
            if (cartera === NaN) {
                cartera = '0';
            }
            //console.log(res);
            $('#lblcartera').html(cartera);
        },
        error: function(error) {
            console.log(eval(error.responseText));
        }
    });
}

function ConsultarFolders(idTercero, idPortafolio, folder = "main", id = "InfoPortafolio", check = "") {
    //Validando active

    if (!$('#' + id).children('ul')) {

    } else {
        var view = "";
        var parametros = {
            "RutaEncarpetado": "true",
            "folder": folder,
            "idTercero": idTercero,
            "idPortafolio": idPortafolio
        };
        console.log(parametros);
        $.ajax({
            data: parametros,
            url: '../Controller/PortafolioController.php',
            type: 'post',
            async: true,
            dataType: 'JSON',
            success: function(res) {
                console.log("se imprime folders");
                console.log(res);
                if (res['folders'].length != 0) {
                    var newFolder = "";
                    //check = "";//este dato lo traemos di ya tiene portafolio y seleccionar las carpetas que ya tiene
                    var active = "active";
                    if (folder != "main") {
                        newFolder = folder + "-";
                        active = "";
                    }
                    $('#' + id).children('ul').remove();

                    view += "<ul class='nested active'>";
                    res['folders'].forEach(item => {
                        console.log(item[0])
                        check = "";
                        displayIcon = "none";
                        if (item[1] > 0) {
                            if (item[1] == (item[2]+1)) {
                                check = "check-box";
                            } else {
                                check = "check-indeterminate";
                            }
                        }
                        //console.log(item);
                        if (item[2] > 0) {
                            displayIcon = "inline";
                        }
                        folder = newFolder + item[0];
                        var id = folder.replace(/ /g, "");
                        id = id.replace(/,/g, "");
                        view += `
                        <li id="` + id + `" >
                            <span class="box ` + check + `"
                                 onClick="CheckFolder(\'` + idTercero + `\',\'` + idPortafolio + `\',\'` + folder +
                            `\',\'` + id + `\',event);">
                            </span>
                            <label style="cursor:pointer" onclick="MenuFolder(\'` + idTercero + `\',\'` +
                            idPortafolio + `\',\'` + folder + `\',\'` + id + `\');">` + item[0] + `
                            </lable>
                            <span style="cursor:pointer; display: ` + displayIcon + `" class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                        </li>`;
                        //alert("fin each");
                    });
                    /* $.each(res['folders'], function(index, item) {
                         //console.log(item);
                         
                     });*/
                    view += "</ul>";
                    $('#' + id).append(view);
                }

                  

            },
            error: function(error) {
                console.log((error.responseText));
            }
        });
    }



    /*$('#' + id).append(view);
    var toggler = document.getElementsByClassName("box");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
            this.classList.toggle("check-box");
            if (this.parentElement.querySelector(".nested") !== null) {
                this.parentElement.querySelector(".nested").classList.toggle("active");
            }

        });
    }*/
}

</script>