<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==37){
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
    <button type="button" class="btn" style="background: #337ab7;" data-toggle="modal" data-target="#Primero"><i
            style="color:#fff;" class="fa fa-question-circle fa-fw"></i></button>
    <div class="modal fade" id="Primero">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ayuda</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    En esta pagina usted podra consultar y asignar los pedidos que los vendedores envian a la compañia
                </div>
                <div class="modal-footer">

                </div>

            </div>
        </div>
        <style>
        table tbody tr td:nth-child(2) {
            text-align: center;
        }
        </style>
    </div><br><br>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon-cog"></i> Pedidos nuevos
                    </div>
                    <div class="panel-body">
                        <div style="overflow:scroll; height: 600px;">
                            <table class="table" id="tblCartera2">
                                <thead>
                                    <th>#</th>
                                    <th>Pedido</th>
                                    <th> Nro Pedido Vendedor</th>
                                    <th> Vendedor</th>
                                    <th>Cliente</th>
                                    <th>Tipo Pedido</th>
                                    <th>Ciudad</th>
                                    <th>Fecha Pedido</th>
                                    <th>Fecha Recepcion</th>
                                    <th>Accion</th>
                                </thead>
                                <tbody id='tblPedidosVendedores'>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon-cog"></i> Pedidos Asignados
                    </div>
                    <div class="panel-body">
                        <div style="overflow:scroll; height: 600px;">
                            <table class="table" id="tblCartera2">
                                <thead>
                                    <th>#</th>
                                    <th>Pedido</th>
                                    <th> Nro Pedido Vendedor</th>
                                    <th> Vendedor</th>
                                    <th>Cliente</th>
                                    <th>Tipo Pedido</th>
                                    <th>Fecha Pedido</th>
                                    <th>Fecha Recepcion</th>
                                    <th>Vendedor Asignado</th>
                                    <th>Accion</th>
                                </thead>
                                <tbody id='tblPedidosAsignados'>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick=" Ocultar(); "><span aria-hidden="true">&times;</span></button>
                    <h4 id="Cliente-Modal"></h4>
                </div>
                <div class="modal-body">
                    <select id="select-vendedores" class="form-control">

                    </select>

                    <table class="table table-striped" id="tblModal">
                        <thead>
                            <th>#</th>
                            <th>Imagen</th>
                            <th>Referencia</th>
                            <th>Descripcion</th>
                        </thead>
                        <tbody id="tblProductosModal">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalDatosHgi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">Envio de pedido # <b id="idPedidoDash"></b></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <select class="form-control" id="selectCompania">
                                    <option value='1'>Blanca</option>
                                    <option value='2'>Verde</option>
                                    <option value='3'>Ani-k</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <input type="number" class="form-control" id="transaccion" placeholder="Transaccion"
                                    required>
                                <div id="invalid-Transaccion" style="color:red; display:none">
                                    Por favor ingresar # de transaccion
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <input type="number" class="form-control" id="documento" placeholder="Documento">
                                <div id="invalid-Documento" style="color:red; display:none">
                                    Por favor ingresar # de documento
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtFiltro" placeholder="Filtrar">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12" style="overflow-x: scroll;height: 400px;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Cargar</th>
                                        <th scope="col">Img</th>
                                        <th scope="col">Referencia</th>
                                        <th scope="col">UDM</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio U.</th>
                                    </tr>
                                </thead>
                                <tbody id="tbDetallePedido">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onClick="ValidarCamposEnvio();">Enviar</button>
                    </div>
                </div>
            </div>
            <form id="FrmGenerarExcel" style="display: none;" action='../Controller/PedidosVendedoresController.php'
                method="post">
                <input type="text" name="strIdPedido" id='txtIdPedido'>
                <input type="text" name="btnGenerarExcelPedido" value="true">
            </form>
            <script>
            function Ocultar() {
                $('#select-vendedores').hide();
                $('#tblModal').hide();
            }
            window.onload = function() {
                $('#select-vendedores').hide();
                $('#tblModal').hide();
                ListarPedidos();
            }

            function ListarPedidos() {
                $('#tblPedidosVendedores').html('');
                $('#tblPedidosAsignados').html('');

                var parametros = {
                    "btnListarPedidos": 'true'
                };
                /*
                  intTipoPedido indica de donde vino el pedido App,Madrinas,Sisve.

                  0=App;
                  1=Sisve;
                  2=Madrinas;

                */
                $.ajax({
                    data: parametros,
                    url: '../Controller/PedidosVendedoresController.php',
                    type: 'post',

                    success: function(response) {
                        var table = document.getElementById('tblPedidosVendedores');
                        var data = JSON.parse(response);
                        i = 1;
                        j = 1;
                        data.forEach(function(row) {
                            if (row.intEstado != 7) {
                                strTipoPedido = '';
                                if (row.intTipo == 0) {
                                    strTipoPedido =
                                        '<h3 style="display: inline; font-size: 120%; background: #bbb;" class="badge badge-warning text-white">IM</h3>';
                                }
                                if (row.intEstado == 1) {
                                    html = '<tr> ' +
                                        '<td>' + i + '</td>' +
                                        '<td>' + row.intIdPedido + '</td>' +
                                        '<td>' + row.strIdPedidoVendedor + '</td>' +
                                        '<td>' + row.strNombVendedor + '</td>' +
                                        '<td>' + row.strNombCliente + '</td>' +
                                        '<td>' + strTipoPedido + '</td>' +
                                        '<td>' + row.strCiudadCliente + '</td>' +
                                        '<td>' + row.dtFechaFinalizacion + '</td>' +
                                        '<td>' + row.dtFechaEnvio + '</td>' +
                                        '<td><button class="btn btn-default" title="Visualizar" data-toggle="modal" data-target="#myModal" onclick="ListarDetalle(' +
                                        row.intIdPedido + ',\'' + row.strNombCliente +
                                        '\')"><i class="glyphicon glyphicon-eye-open" ></i></button> ' +
                                        '<button class="btn btn-default" title="Asignar Separador" data-toggle="modal" data-target="#myModal" onclick="ListarSeparadores(' +
                                        row.intIdPedido + ',\'' + row.strNombCliente +
                                        '\')"><i class="glyphicon glyphicon-share"></i></button> </td>' +
                                        '</tr>';
                                    $('#tblPedidosVendedores').append(html);
                                    i++;
                                }
                                if (row.intEstado == 2 || row.intEstado == 3 || row.intEstado == 4 || row.intEstado == -1) {
                                    //console.log(row.intEstado)
                                    stateClass = '';
                                    style='';
                                    if(row.intEstado == 3){
                                        stateClass = 'warning';
                                    }else if(row.intEstado == 4){
                                        stateClass = 'success';
                                    }else if(row.intEstado == -1){
                                        style = 'style="background: #dce4eb;"';
                                    }

                                    html = '<tr class="'+stateClass+'" '+style+'> ' +
                                        '<td>' + j + '</td>' +
                                        '<td>' + row.intIdPedido + '</td>' +
                                        '<td>' + row.strIdPedidoVendedor + '</td>' +
                                        '<td>' + row.strNombVendedor + '</td>' +
                                        '<td>' + row.strNombCliente + '</td>' +
                                        '<td>' + strTipoPedido + '</td>' +
                                        '<td>' + row.dtFechaFinalizacion + '</td>' +
                                        '<td>' + row.dtFechaEnvio + '</td>' +
                                        '<td>' + row.strNombVendAsignado + '</td>' +
                                        '<td> <button class="btn btn-default" title="Ver PDF" onclick="GenerarPDF(' +
                                        row.intIdPedido +
                                        ')"><i class="glyphicon glyphicon-eye-open"></i></button> ';

                                    if(row.intEstado == -1){
                                        html +=
                                            '<button class="btn btn-default" title="Verificar Pedido" onclick="ActualizarEstadoPedido(' +
                                            row.intIdPedido + ', 2)" id="btnFinalizarPedido' + row
                                            .intIdPedido +
                                            '"><i class="glyphicon glyphicon-ok-circle" ></i></button>' +
                                            '<button class="btn btn-default" style="display:none;" title="Excel" id="btnExcelPedido' +
                                            row.intIdPedido +
                                            '"><i class="glyphicon glyphicon-file" onclick="GenerarExcelPedido(' +
                                            row.intIdPedido + ')"></i></button>' +
                                            '<button class="btn btn-default" title="Reasignar Separador" onclick="QuitarVendAsignado(' +
                                            row.intIdPedido + ')" id="btnFinalizarPedido' + row
                                            .intIdPedido +
                                            '"><i class="glyphicon glyphicon-remove" ></i></button>' +
                                            '</td>';
                                    }else if (row.intEstado == 2) {
                                        html +=
                                            '<button class="btn btn-default" title="Verificar Pedido" onclick="ActualizarEstadoPedido(' +
                                            row.intIdPedido + ', 3, 1)" id="btnFinalizarPedido' + row
                                            .intIdPedido +
                                            '"><i class="glyphicon glyphicon-ok" ></i></button>' +
                                            '<button class="btn btn-default" style="display:none;" title="Excel" id="btnExcelPedido' +
                                            row.intIdPedido +
                                            '"><i class="glyphicon glyphicon-file" onclick="GenerarExcelPedido(' +
                                            row.intIdPedido + ')"></i></button>' +
                                            '</td>';
                                    } else if(row.intEstado == 3){
                                        html += '<button class="btn btn-default" title="Enviar Pedido" onClick="InputTransaccionDoc(' +
                                        row.intIdPedido +
                                        ')"><i class="glyphicon glyphicon-send"></i></button> ';
                                    }else if(row.intEstado == 4){
                                        html +=
                                            '<button class="btn btn-default" style="display:none" title="Excel" id="btnExcelPedido"><i class="glyphicon glyphicon-file" onclick="GenerarExcelPedido(' +
                                            row.intIdPedido + ')"></i></button></td>';
                                    }
                                    html += '</tr>';
                                    $('#tblPedidosAsignados').append(html);
                                    j++;
                                }
                            }
                        })
                    },
                    error: function(error) {
                        alert('errores; ' + eval(error));
                    }
                });
            }

            /**Envio de pedidos HGI */

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
            //Confimar Transaccion y documento
            function InputTransaccionDoc(idPedido) {
                $('#tbDetallePedido').html("");
                setTimeout(() => {
                    $('#transaccion').focus();
                }, 500);
                $('#modalDatosHgi').modal('show');
                $('#idPedidoDash').html(idPedido);
                ConsultarDetallePedido(idPedido);
            }

            //Validar Campos
            function ValidarCamposEnvio() {
                ban = 1;
                if ($('#transaccion').val() == "") {
                    ban = -1;
                    $('#invalid-Transaccion').css('display', 'inline-block');
                    $('#transaccion').focus();
                } else {

                    $('#invalid-Transaccion').css('display', 'none');
                }
                if ($('#documento').val() == "") {
                    ban = -1;
                    $('#invalid-Documento').css('display', 'inline-block');
                    $('#documento').focus();
                } else {

                    $('#invalid-Documento').css('display', 'none');
                }

                if (ban == 1) {
                    EnviarPedidoHgi();
                }
            }

            $('#transaccion').focusout(function() {
                if ($('#invalid-Transaccion').is(":visible")) {
                    if ($('#transaccion').val() != "") {
                        $('#invalid-Transaccion').css('display', 'none');
                    }
                }
            });

            $('#documento').focusout(function() {
                if ($('#invalid-Documento').is(":visible")) {
                    if ($('#documento').val() != "") {
                        $('#invalid-Documento').css('display', 'none');
                    }
                }
            });


            //Enviar pedido al HGI
            function EnviarPedidoHgi() {
                array = [];
                error = 0;
                $('#tbDetallePedido tr').each(function(key, value) {
                    //console.log($(this).html() + "\n");

                    if ($("#check-" + (key + 1)).prop('checked')) {
                        row = [];
                        //row.push("idProducto" : $('#idProducto-'+(key + 1)).html());
                        if ($('#cantidad-' + (key + 1)).val() == "" || $('#cantidad-' + (key + 1)).val() <= 0) {
                            error = 1;
                            $('#cantidad-' + (key + 1)).focus();
                        }

                        const isLargeNumber = (element) => element[0] == $('#idProducto-' + (key + 1)).html();
                        const k = array.findIndex(isLargeNumber);
                        if(k !== -1){
                            array[k][1] =parseInt(array[k][1]) +parseInt($('#cantidad-' + (key + 1)).val()); 
                        }else{
                            array.push([$('#idProducto-' + (key + 1)).html(), $('#cantidad-' + (key + 1)).val()])
                        }

                    }

                });

                //console.log(array);
                if (error == 0) {
                    Loading(true);

                    var parametros = {
                        "btnEnviarPedidoHgi": 'true',
                        "strIdPedido": $('#idPedidoDash').html(),
                        "intTransaccion": $('#transaccion').val(),
                        "intDocumento": $('#documento').val(),
                        "arrayReferencias": array,
                        "intCompania":$("#selectCompania").val()
                    };
                    $.ajax({
                        data: parametros,
                        url: '../Controller/PedidosVendedoresController.php',
                        type: 'post',

                        success: function(response) {
                            console.log(response);
                            if (response != 1) {
                                text = "Hubo un error al insertar registros";
                                if (response == -1) {
                                    text = "Número de documento inválido.";
                                }
                                if (response == -2) {
                                    text = "Cantidad incorrecta";
                                }
                                Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text
                                })
                            } else {
                                FinalizarPedidoSeparador($('#idPedidoDash').html());
                                ActualizarEstadoPedido($('#idPedidoDash').html(),4,$('#transaccion').val(),$('#documento').val());
                                $('#modalDatosHgi').modal('hide');
                                $('#documento').val("");
                                $('#transaccion').val("");
                                Swal.fire({
                                    position: 'top-end',
                                    type: 'success',
                                    title: 'Pedido sincronizado',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }

                        }
                    });
                }

            }

            function ConsultarDetallePedido(idPedido) {
                var parametros = {
                    "btnConsultarDetallePedido": 'true',
                    "strIdPedido": idPedido
                };
                $.ajax({
                    data: parametros,
                    url: '../Controller/PedidosVendedoresController.php',
                    type: 'post',

                    success: function(response) {
                        //console.log(response);
                        var data = JSON.parse(response);
                        data.forEach((element, key) => {
                            $('#tbDetallePedido').append(`
                              <tr>
                                <th scope="row">` + (key + 1) + `</th>
                                <td><input type="checkbox" checked="checked" name="checkEnviar"
                                        id='check-` + (key + 1) + `'></td>
                                <td><img src="../../..//ownCloud/fotos_nube/` + element['strIdProducto'] +
                                `.jpg"/ height="100" widht="150"></td>
                                
                                <td id="idProducto-` + (key + 1) + `">` + element['strIdProducto'] + `</td>
                                <td id="UDM-` + (key + 1) + `">` + element['strUnidadMedida'] + `</td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="cantidad-` + (key + 1) + `"
                                            placeholder="Cantidad" value="` + element['intCantidad'] + `" min=1>
                                        <div id="invalid-Documento" style="color:red; display:none">
                                            Por favor ingresar la cantidad
                                        </div>
                                    </div>
                                </td>
                                <td id="precio-` + (key + 1) + `">$ ` + element['intPrecio'] + `</td>
                              </tr>
                          `)
                        });
                    }
                });

            }

            /**Envio de pedidos HGI */


            /**Actualizacion de estados de los pedidos */

            function ActualizarEstadoPedido(strIdPedido, intEstado, intTransaccion = -1, intDocumento = -1){
                if(intTransaccion != -1){ intTransaccion = <?php echo $_SESSION['idLogin']; ?>}
                var parametros = {
                    "btnActualizarEstadoPedido": 'true',
                    strIdPedido,
                    intEstado,
                    intTransaccion,
                    intDocumento
                };
                $.ajax({
                    data: parametros,
                    url: '../Controller/PedidosVendedoresController.php',
                    type: 'post',

                    success: function(response) {
                        ListarPedidos();
                    }
                });
            }
            /**Actualizacion de estados de los pedidos */



            //Generar excel del pedido
            function ValidarFinalizarPedido(strIdPedido) {
                Swal.fire({
                    title: 'Desea finalizar el pedido ' + strIdPedido + '?',
                    html: "Descargara un excel para posteriormente ser subido al HGI.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.value) {
                        GenerarExcelPedido(strIdPedido);
                        document.getElementById('btnExcelPedido' + strIdPedido).style.display = 'inline';
                        document.getElementById('btnFinalizarPedido' + strIdPedido).style.display = 'none';
                    }
                })
            }

            function GenerarExcelPedido(strIdPedido) {
                document.getElementById('txtIdPedido').value = strIdPedido;
                document.getElementById('FrmGenerarExcel').submit();
                //Finalizar pedido del separador
                FinalizarPedidoSeparador(strIdPedido);
            }

            function GenerarPDF(intPedido) {
                open('../Reports/InformePedido.php?pedido=' + intPedido);
            }

            function ListarDetalle(strIdPedido, strNombCliente) {
                var parametros = {
                    "btnConsultarDetallePedido": 'true',
                    "strIdPedido": strIdPedido
                };
                $.ajax({
                    data: parametros,
                    url: '../Controller/PedidosVendedoresController.php',
                    type: 'post',

                    success: function(response) {
                        var data = JSON.parse(response);

                        $('#Cliente-Modal').html(strNombCliente);
                        $('#tblModal').show();
                        document.getElementById('tblProductosModal').innerHTML = '';
                        var i = 1;
                        data.forEach(function(row) {
                            html = '<tr><td>' + (i) + '</td>' +
                                '<td><img src="../../..//ownCloud/fotos_nube/' + row.strIdProducto +
                                '.jpg"/ height="100" widht="150"></td>' +
                                '<td>' + row.strIdProducto + '</td>' +
                                '<td>' + row.strDescripcion + '</td></tr>';
                            $('#tblProductosModal').append(html);
                            i++;
                        });
                        $('.modal-footer').html(
                            '<button type="button" class="btn btn-primary" onclick="$(\'#tblModal\').hide();" data-dismiss="modal" >Cerrar</button>'
                        );
                    }
                });
            }

            function ListarSeparadores(strIdPedido, strNombCliente) {

                $('#select-vendedores').show();
                var parametros = {
                    "btnListarVendedores": 'true'
                };
                $.ajax({
                    data: parametros,
                    url: '../Controller/PedidosVendedoresController.php',
                    type: 'post',

                    success: function(response) {
                        var table = document.getElementById('tblPedidosVendedores');
                        var data = JSON.parse(response);

                        data.forEach(function(row) {

                            $('#select-vendedores').append($('<option>', {
                                value: row.StrIdVendedor,
                                text: row.StrNombre
                            }));
                            console.log('1')
                        })

                    }
                })
                $('#Cliente-Modal').html(strNombCliente);
                $('.modal-footer').html('<button type="button" class="btn btn-primary" onclick="AsignarSeparador(' +
                    strIdPedido + ')">Asignar</button>');
            }

            function AsignarSeparador(strIdPedido) {
                if ($('#select-vendedores option:selected').val() != 0) {
                    $('#myModal').modal('toggle');
                    $('#select-vendedores').hide();
                    var parametros = {
                        "btnAsignarSeparador": 'true',
                        "strIdPedido": strIdPedido,
                        "strIdSeparador": $('#select-vendedores option:selected').val(),
                        "strSeparador": $('#select-vendedores option:selected').text()

                    };
                    $.ajax({
                        data: parametros,
                        url: '../Controller/PedidosVendedoresController.php',
                        type: 'post',

                        success: function(response) {

                            GenerarPDF(strIdPedido);
                            ListarPedidos();
                        }
                    })
                }
                /*
                 */
            }

            function FinalizarPedidoSeparador(strIdPedido) {
                var parametros = {
                    "btnFinalizarPedidoSeparador": 'true',
                    "strIdPedido": strIdPedido
                };
                $.ajax({
                    data: parametros,
                    url: '../Controller/PedidosVendedoresController.php',
                    type: 'post',

                    success: function(response) {
                        ListarPedidos();
                    }
                })
            }

            function QuitarVendAsignado(strIdPedido) {
                var parametros = {
                    "btnQuitarVendAsignado": 'true',
                    "strIdPedido": strIdPedido
                };
                $.ajax({
                    data: parametros,
                    url: '../Controller/PedidosVendedoresController.php',
                    type: 'post',

                    success: function(response) {
                        ListarPedidos();
                    }
                })
            }



            (function($) {
                $('#txtFiltro').keyup(function() {
                    var rex = new RegExp($(this).val(), 'i');
                    $('#tbDetallePedido tr').hide();
                    $('#tbDetallePedido tr').filter(function() {
                        return rex.test($(this).text());

                    }).show();
                })

            }(jQuery));
            </script>