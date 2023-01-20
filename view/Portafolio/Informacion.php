<?php
    $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==31){
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
    zoom: 1.4;
    -moz-transform: scale(1.4);
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
    0% {
        stroke-dashoffset: 251;
    }

    100% {
        stroke-dashoffset: 0;
    }
}

.invalid{
    display: none;
    width: 100%;
    margin-top: .25rem;
    font-size: 80%;
    color: #dc3545;
}

.ExcelDescargado {
    background: #6c757d;
}
</style>
<!-- MODAL DATOS FACTURACION ELECTRONICA -->
<div class="modal" tabindex="-1" id="ModalFactE" role="dialog">
    <div class="modal-dialog" role="document">
        <div id="lblIdPedido"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos Facturación Electronica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>La base de datos de este cliente se encuentra desactualizada por favor llene los siguientes datos
                    para poder enviar el pedido</p>
                <p> <b>Nota:</b> Por favor solicitar el RUT y enviarlo a los canales autorizados
                    (info@inmodafantasy.com.co, inmoda870@hotmail.com ó WPP 317 534 90 40 ), recuerde que sin este
                    documento es posible que no se despache su pedido.
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group col-xs-12 col-lg-12">
                                <input type="email" class="form-control" id="lblFactCorreo"
                                    placeholder="Correo Facturacion">
                                    <div id="invalid-Correo" class="invalid">
                                        Por favor ingresar un email válido
                                    </div>
                            </div>
                            <br>
                            <div class="form-group col-xs-12 col-lg-6">
                                <input type="number" class="form-control" id="lblFactTelefono" placeholder="Telefono">
                                <div id="invalid-Telefono" class="invalid">
                                        Por favor ingresar un # de teléfono válido
                                    </div>
                            </div>
                            <br>

                            <div class="form-group col-xs-12 col-lg-6">
                                <input type="number" class="form-control" id="lblFactCelular" placeholder="Celular">
                                <div id="invalid-Celular" class="invalid">
                                        Por favor ingresar un # de celular válido
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group col-xs-12">
                                <input type="text" class="form-control" id="lblFactCiudad" placeholder="Ciudad">
                                <div id="invalid-Ciudad" class="invalid">
                                        Por favor ingresar la ciudad
                                    </div>
                            </div>
                            <br>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick='ValidarFormularioMarcado()'>Enviar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<div id="page-wrapper" style="min-height:100vh;">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick=" Ocultar(); "><span aria-hidden="true">&times;</span></button>
                    <h4 id="Cliente-Modal"></h4>
                </div>
                <div class="modal-body">
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
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 900px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Informacion del pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group" id="modal-body">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 align-self-center" id="div">
            <div class="row" style="">

                <div class="row"><br>
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-lg-1">

                                <button type="button" class="btn btn-primary"
                                    onclick="ActualizarPaneles()">Actualizar</button>
                                <?php if ($_SESSION['idLogin'] == 1	|| $_SESSION['idLogin'] == 25) {
						?>
                                <form action="../Controller/InformacionPortafolioController.php" style="display: none;"
                                    method="POST" id="GenerarInformeExcel">
                                    <input type="text" name="btnGenerarInformeExcel">
                                </form>
                                <button type="button" style="display: none" class="btn btn-primary"
                                    onclick="DescargarInformeadministrador();">Informe</button>
                                <?php 
					} ?>
                            </div>
                            <div class="col-lg-1">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalinfo" style="display:none;">
                                    <i class="glyphicon glyphicon-question-sign" aria-hidden="true"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modalinfo" tabindex="-1" role="dialog"
                                    aria-labelledby="modalinfoLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalinfoLabel">Informacion General</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Estados Pedidos:
                                                1 -> Iniciado
                                                0 -> Finalizado
                                                2 -> Impreso
                                                <br>
                                                Si el cliente finaliza el pedido y quiere iniciar
                                                otro se generará otro pedido..
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade bd-example-modal-lg" id="modalAsignacionDeTercero" tabindex="-1"
                                    role="dialog" aria-labelledby="modalinfoLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalinfoLabel">Asociar tercero al pedido
                                                </h5>
                                                <h5 class="modal-title" id="modalIdPedido"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <input type="text" id="txtFiltro" placeholder="Filtrar"
                                                                onkeyup="FiltrarTerceros(event,'txtFiltro');"
                                                                class="form-control" aria-label="...">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <table class="table">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th scope="col">Nombre</th>
                                                                        <th scope="col">Identificacion</th>
                                                                        <th scope="col">Ciudad</th>
                                                                        <th scope="col">Telefono</th>
                                                                        <th scope="col">Acciones</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbodyTerceros">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-lg-5">
                                <a href="https://app.inmodafantasy.com.co/Web/View/?code=<?php echo $_SESSION['idLogin']?>"
                                    target="_blank"
                                    id="link">https://app.inmodafantasy.com.co/Web/View/?code=<?php echo $_SESSION['idLogin']?></a>
                                <button class="btn btn-default" onClick="CopiarLink();">
                                    Copiar Link
                                </button>
                            </div>
                        </div><br>
                        <div class="panel panel-default">
                            <div class="panel-heading text-center" id="prueba">Pedidos en progreso</div>

                            <div class="panel-body">
                                <div id="TblArchivos">

                                    <!-- Table -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                                <input type="text" id="buscar" class="form-control"
                                                    placeholder="Filtrar...">

                                            </div><br>
                                        </div>
                                    </div>
                                    <div style="overflow-y: scroll;height:340px; ">
                                        <div id="carga2">
                                            <center>
                                                <svg class="progress-circle indefinite" width="100" height="100">
                                                    <g transform="rotate(-90,50,50)">
                                                        <circle class="bg" r="20" cx="50" cy="50" fill="none"></circle>
                                                        <circle class="progress" r="20" cx="50" cy="50" fill="none">
                                                        </circle>
                                                    </g>
                                                </svg>
                                            </center>
                                        </div>
                                        <table class="table table-bordered" id="tabla" style="display: none;">
                                            <thead>
                                                <th>Pedido</th>
                                                <th>Cliente</th>
                                                <th>Identificacion</th>
                                                <th>Fecha Creacion</th>
                                                <th>N° Visitas</th>
                                                <th>Valor Total</th>
                                                <th>Acciones</th>
                                            </thead>
                                            <tbody id="tbodypedidosprogress">

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading text-center" id="prueba1">Pedidos Finalizados</div>

                            <div class="panel-body">
                                <div id="TblArchivos">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                                <input type="text" id="buscar1" class="form-control"
                                                    placeholder="Filtrar...">
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div style="overflow-y: scroll;height:340px; ">
                                        <div id="carga1">
                                            <center>
                                                <svg class="progress-circle indefinite" width="100" height="100">
                                                    <g transform="rotate(-90,50,50)">
                                                        <circle class="bg" r="20" cx="50" cy="50" fill="none"></circle>
                                                        <circle class="progress" r="20" cx="50" cy="50" fill="none">
                                                        </circle>
                                                    </g>
                                                </svg>
                                            </center>
                                        </div>
                                        <table class="table table-bordered" id="tabla1" style="display: none;">
                                            <thead>
                                                <th>Pedido</th>
                                                <th>Cliente</th>
                                                <th>Identificacion</th>
                                                <th>Fecha Creacion</th>
                                                <th>Fecha Finalizacion</th>
                                                <th>Valor Total</th>
                                                <th>Observaciones</th>
                                                <th>Acciones</th>
                                            </thead>
                                            <tbody id="tbodypedidosfinalizados">
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--VOY EN PEDIDOS IMPRESOSS------------------------------>
                        <div class="panel panel-default">
                            <div class="panel-heading text-center">Pedidos Impresos</div>

                            <div class="panel-body">
                                <div id="TblArchivos">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                                <input type="text" id="buscar2" class="form-control"
                                                    placeholder="Filtrar...">
                                            </div>
                                            <br>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <select class="form-control" id="SelectYear"
                                                    onchange="ActualizarPaneles()">
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>

                                                </select>
                                            </div><br>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <select class="form-control" id="SelectMonth"
                                                    onchange="ActualizarPaneles()">
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
                                            </div><br>
                                        </div>
                                    </div>
                                    <div style="overflow-y: scroll;height:340px; ">
                                        <div id="carga3">
                                            <center>
                                                <svg class="progress-circle indefinite" width="100" height="100">
                                                    <g transform="rotate(-90,50,50)">
                                                        <circle class="bg" r="20" cx="50" cy="50" fill="none"></circle>
                                                        <circle class="progress" r="20" cx="50" cy="50" fill="none">
                                                        </circle>
                                                    </g>
                                                </svg>
                                            </center>
                                        </div>
                                        <table class="table table-bordered" id="tabla2">
                                            <thead>
                                                <th>Pedido</th>
                                                <th>Estado</th>
                                                <th>Cliente</th>
                                                <th>Identificacion</th>
                                                <th>Fecha Envio</th>
                                                <th>Separador</th>
                                                <th>Valor Total</th>
                                                <th>Acciones</th>
                                            </thead>
                                            <tbody id="tbodypedidosimpresos">
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var d = new Date();
$("#SelectMonth").val(d.getMonth() + 1);
$("#SelectYear").val(d.getFullYear());
ListarPedidosFinalizados();
ListarPedidosProgress();
ListarPedidosImpresos($("#SelectMonth").val(), $("#SelectYear").val());

function ActualizarPaneles() {
    $('#tbodypedidosimpresos').html("");
    LimpiarPaneles();
    ListarPedidosFinalizados();
    ListarPedidosProgress();
    ListarPedidosImpresos($("#SelectMonth").val(), $("#SelectYear").val());
}

function LimpiarPaneles() {
    $('#tbodypedidosprogress').html("");
    $('#tbodypedidosfinalizados').html("");
    $('#tbodypedidosimpresos').html("");
}

function AsignarTercero(idPedido) {

    $('#modalAsignacionDeTercero').modal('show');
    $('#modalIdPedido').html(idPedido);

}

function AsignarTerceroPedido(idTercero, nombre, ciudad, idPedido) {
    //Pediente crear procedimiento y conectar controlado modelo y bd
    Swal.fire({
        text: "Asociar el pedido a " + nombre,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Asociar'
    }).then((result) => {
        if (result.value) {
            $('#modalAsignacionDeTercero').modal('hide');
            var parametros = {
                "ActualizarTerceroPedido": "true",
                nombre,
                ciudad,
                idPedido,
                idTercero
            };
            $.ajax({
                data: parametros,
                url: '../Controller/InformacionPortafolioController.php',
                type: 'post',
                success: function(res) {
                    if (res == 1) {
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Tercero asociado',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        ActualizarPaneles();
                    } else {
                        Swal.fire({
                            position: 'top-end',
                            type: 'error',
                            title: 'Hubo un erro',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        console.log(res);
                    }
                },
                error: function(error) {
                    console.log((error.responseText));
                }
            });
        }
    })

}

function FiltrarTerceros(e, id, pagina = 0) {
    if (e !== null && e.keyCode === 13) {
        var text = $('#' + id).val();
        var parametros = {
            "FiltrarTerceros": "true",
            text,
        };
        $.ajax({
            data: parametros,
            url: '../Controller/InformacionPortafolioController.php',
            type: 'post',
            dataType: 'JSON',
            success: function(res) {
                console.log(res);
                $('#tbodyTerceros').html("");
                $.each(res['terceros'], function(index, item) {
                    console.log(item);
                    $('#tbodyTerceros').append(`
                    <tr>
                        <th scope="row">` + item.StrNombre + `</th>
                        <td>` + item.StrIdTercero + `</td>
                        <td>` + item.StrDescripcion + `</td>
                        <td></td>
                        <td><button type="button" onclick="AsignarTerceroPedido('` + item.StrIdTercero + `','` + item
                        .StrNombre + `','` + item.StrDescripcion + `','` + $('#modalIdPedido')
                        .html() + `');" class="btn btn-default" aria-label="Left Align">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            </button>
                        </td>
                    </tr>
                    
                    `);
                });
            },
            error: function(error) {
                console.log((error.responseText));
            }
        });
    }

}


//Mostrar todos los pedidos Finalizados
function ListarPedidosFinalizados(mes, año) {
    var parametros = {
        "btnListarPedidosFinalizados": 'true'
    };
    $.ajax({
        data: parametros,
        url: '../Controller/InformacionPortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(res) {
            $.each(res['pedidos'], function(index, item) {
                console.log(item);
                estado = "";
                disabled = "";
                display = "none";
                if (item.intvalortotal == 0) {
                    estado = "danger";
                    disabled = "disabled";
                }
                if (item.strIdTercero == "0128" || item.strIdTercero == "0127" || item
                    .strIdTercero == "0126" || item.strIdTercero == "0125") {
                    disabled = "disabled";
                    display = "block";
                }
                $('#tbodypedidosfinalizados').append(
                    `<tr class="` + estado + `">
							<td id='` + item.intId + `'>` + item.intId + `</td>
							<td>` + item.strNomTercero + `</td>
                            <td>` + item.strIdTercero + `</td>
							<td>` + item.fechaini + `</td>
							<td>` + item.fechafin + `</td>
                            <td>$` + Intl.NumberFormat().format(item.intvalortotal) + `</td>
							<td> 
                                <div class="input-group">
                                    <textarea class="form-control" aria-label="With textarea" id="descripcionP` + item
                    .intId + `">` + item.strObservacion +
                    `</textarea>
                                </div></td>
							<td>
								<button class='btn btn-default' data-toggle='modal' title='Visualizar el pedido' data-target='#exampleModalCenter' onclick='VisualizarPedido(` +
                    item.intId + `)' ><i class='glyphicon glyphicon-eye-open'></i></button>
                                <button style="display: ` + display +
                    `" class='btn btn-default' data-toggle='modal' title='Asignar tercero' onclick='AsignarTercero(` +
                    item.intId + `)' ><i class='glyphicon glyphicon-user'></i></button>
                                <button ` + disabled +
                    ` class='btn btn-default' title='Enviar Pedido' onclick='EnviarPedido(` +
                    item.intId + `,` + item.intMarcado + `)' ><i class='glyphicon glyphicon-send'></i></button>
								<button class='btn btn-default' title='Eliminar pedido' style='display:inline;' onclick="EliminarPedido('` +
                    item.intId + `')"><i class='glyphicon glyphicon-remove'></i></button>
							</td>
						</tr>
						`
                );
            });
            document.getElementById('carga1').style = "display:none";
            document.getElementById('tabla1').style = "display:inline-block";
        },
        error: function(error) {
            alert((error.responseText));
        }
    });
}

//Mostrar todos los pedidos en progreso
function ListarPedidosProgress() {
    var parametros = {
        "btnListarPedidoProgress": 'true'
    };
    $.ajax({
        data: parametros,
        url: '../Controller/InformacionPortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(res) {
            console.log(res);
            $.each(res['pedidos'], function(index, item) {
                //console.log(item);
                if (item.strObservacion == null) {
                    item.strObservacion = "";
                }
                var cantVisitas = parseInt(item.intCantVisitas) + 1;
                $('#tbodypedidosprogress').append(
                    `<tr>
							<td id='` + item.intId + `'>` + item.intId + `</td>
							<td>` + item.strNomTercero + `</td>
                            <td>` + item.strIdTercero + `</td>
							<td>` + item.fechaini + `</td>
							<td>` + (cantVisitas) + `</td>
							<td>$` + Intl.NumberFormat().format(item.intvalortotal) +
                    `</td>
							<td>
								<button class='btn btn-default' data-toggle='modal' title='Visualizar el pedido' data-target='#exampleModalCenter' onclick='VisualizarPedido(` +
                    item.intId + `)' ><i class='glyphicon glyphicon-eye-open'></i></button>
								<button class='btn btn-default' title='Ir al portafolio' onclick='AbrirPortafolio(` + item.strIdTercero +
                    `,"` + item.strNombreTercero + `");'><i class='glyphicon glyphicon-briefcase'></i></button>
								<button class='btn btn-default' title='Consultar codigo de ingreso' style='display:none;' onclick='ConsultarIngresoPortafolio(".$rpta[$i]['intIdPortafolioTercero'].",\"".$rpta[$i]['strIdTercero']."\")'><i class='glyphicon glyphicon-info-sign'></i></button>
								<button class='btn btn-default' title='Eliminar pedido' style='' onclick="EliminarPedido('` +
                    item.intId + `')"><i class='glyphicon glyphicon-remove'></i></button>
							</td>
						 </tr>
						`
                );

            });
            //document.getElementById('tbody').innerHTML=res;


            document.getElementById('carga2').style = "display:none";
            document.getElementById('tabla').style = "display:inline-block";
        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function ListarPedidosImpresos(mes, año) {
    console.log(mes + " " + año);
    var parametros = {
        "btnListarPedidoImpresos": 'true',
        mes,
        año
    };
    $.ajax({
        data: parametros,
        url: '../Controller/InformacionPortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(res) {

            document.getElementById('carga3').style = "display:none";
            document.getElementById('tabla2').style = "display:inline-block";
            console.log(res['pedidos']);
            $.each(res['pedidos'], function(index, item) {
                if(item.intEstado == -1){
                    estado = 'Verificando';
                }else if(item.intEstado == 0){
                    estado = 'Anulado';
                }else if (item.intEstado == 1) {
                    estado = "En espera";
                } else if (item.intEstado == 2) {
                    estado = "Separando";
                } else if (item.intEstado == 3) {
                    estado = "Separando";
                } else if (item.intEstado == 4){
                    estado = "Facturado";
                } else if (item.intEstado == 5){
                    estado = 'Facturado';
                } 
                else{
                    estado = item.intEstado;
                }
                if (item.strNombVendAsignado == null) {
                    vendedor = "Sin asignar";
                } else {
                    vendedor = item.strNombVendAsignado;
                }
                //console.log(item);
                $('#tbodypedidosimpresos').append(
                    `<tr>
							<td id='` + item.intIdPedido + `'>` + item.intIdPedido + `</td>
                            <td>` + estado + `</td>
							<td>` + item.strNombCliente + `</td>
							<td>` + item.strIdCliente + `</td>
							<td>` + item.dtFechaEnvio + `</td>
							<td>` + vendedor + `</td>
                            <td>$` + Intl.NumberFormat().format(item.intValorTotal) +
                    `</td>
							<td>
                                <button class="btn btn-default" title="Visualizar" data-toggle="modal" data-target="#myModal" onclick="ListarDetalle('` +
                    item.intIdPedido + `','` + item.strNombCliente + `')"><i class="glyphicon glyphicon-eye-open" ></i></button>
								
                            </td>
						 </tr>
						`
                );

            });
            //document.getElementById('tbody').innerHTML=res;
        },
        error: function(error) {
            console.log(eval(error));
        }
    });
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
            console.log(data);
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

function EliminarPedido(intIdPedido) {
    var parametros = {
        "btnEliminarPedido": 'true',
        intIdPedido
    };
    $.ajax({
        data: parametros,
        url: '../Controller/InformacionPortafolioController.php',
        type: 'post',
        async: false,
        success: function(response) {
            console.log(response);
            if (response == 1) {
                ActualizarPaneles();
                Swal({
                    position: 'top-end',
                    type: 'success',
                    title: 'Portafolio eliminado',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire(
                    'Informacion?',
                    'Error',
                    'question'
                );
                console.log(response);
            }

        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

$('#lblFactCorreo').keypress(function(){
    $('#invalid-Correo').css('display','none');
    $('#lblFactCorreo').css('border-color','#28a745');
})

$('#lblFactTelefono').keypress(function(){
    $('#invalid-Telefono').css('display','none');
    $('#lblFactTelefono').css('border-color','#28a745');
})

$('#lblFactCelular').keypress(function(){
    $('#invalid-Celular').css('display','none');
    $('#lblFactCelular').css('border-color','#28a745');
})

$('#lblFactCiudad').keypress(function(){
    $('#invalid-Ciudad').css('display','none');
    $('#lblFactCiudad').css('border-color','#28a745');
})

function ValidarFormularioMarcado(){
    var ban = 0;

    const emailval = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    if($('#lblFactCorreo').val() == "" || !(emailval.test($('#lblFactCorreo').val()))){
        ban = 1;
        $('#lblFactCorreo').css('border-color','#dc3545');
        $('#invalid-Correo').css('display','inline');
    } if($('#lblFactTelefono').val() == "" || ($('#lblFactTelefono').val().length != 7)){
        ban = 1;
        $('#lblFactTelefono').css('border-color','#dc3545');
        $('#invalid-Telefono').css('display','inline');
    } if($('#lblFactCelular').val() == "" || ($('#lblFactCelular').val().length != 10)){
        ban = 1;
        $('#lblFactCelular').css('border-color','#dc3545');
        $('#invalid-Celular').css('display','inline');
    } if($('#lblFactCiudad').val() == ""){
        ban = 1;
        $('#lblFactCiudad').css('border-color','#dc3545');
        $('#invalid-Ciudad').css('display','inline');
    }

    if(ban == 0){
        ConfirmarDatosTercero($('#lblIdPedido').html(), $('#lblFactCorreo').val(), $('#lblFactTelefono').val(), $('#lblFactCelular').val(), $('#lblFactCiudad').val());
    }
}

function EnviarPedido(intIdPedido, intMarcado){
    $('#lblIdPedido').html('');
    //ARREGLAR !!consultar campo directamente del HGI!!!!!!!!!!!!!!!!11
    //intMarcado == 0 || intMarcado == null
    if(false){
        $('#ModalFactE').modal('show');
        $('#lblIdPedido').html(intIdPedido);
    }else{
        Swal.fire({
            title: 'Enviar Pedido',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#ce5d5d',
            confirmButtonText: 'Enviar!'
        }).then((result) => {
            if (result.value) {
                ConfirmarDatosTercero(intIdPedido, "", "", "", "");
            }
            
        });
    }
}

function ConfirmarDatosTercero(intIdPedido, strFactCorreo, strFactTelefono, strFactCelular, strFactCiudad) {
   
            var parametros = {
                "btnEnviarPedido": 'true',
                intIdPedido,
                strFactCorreo,
                strFactTelefono,
                strFactCelular,
                strFactCiudad,
                "strObservacionGeneral": $('#descripcionP' + intIdPedido).val()
            };
            $.ajax({
                data: parametros,
                url: '../Controller/InformacionPortafolioController.php',
                type: 'post',
                async: false,
                success: function(response) {
                    console.log(response);
                    if (response == 1) {
                        $('#ModalFactE').modal('hide');
                        limpiarModalFactElectronica();
                        ActualizarPaneles();
                        Swal({
                            position: 'top-end',
                            type: 'success',
                            title: 'Pedido Enviado',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else {
                        Swal.fire(
                            'Informacion?',
                            'Error',
                            'question'
                        );
                        console.log(response);
                    }

                },
                error: function(error) {
                    alert('error; ' + eval(error));
                    console.log(error);
                }
            });

}
function limpiarModalFactElectronica(){
    $('#lblIdPedido').html("");
    $('#lblFactCorreo').val("");
    $('#lblFactTelefono').val("");
    $('#lblFactCelular').val("");
    $('#lblFactCiudad').val("");
}







/* FUNCIONES GENERALES */
function CopiarLink() {
    var codigoACopiar = document.getElementById("link");
    // Crea un campo de texto "oculto"
    var aux = document.createElement("input");

    // Asigna el contenido del elemento especificado al valor del campo
    aux.setAttribute("value", codigoACopiar.innerHTML);

    // Añade el campo a la página
    document.body.appendChild(aux);

    // Selecciona el contenido del campo
    aux.select();

    // Copia el texto seleccionado
    document.execCommand("copy");

    // Elimina el campo de la página
    document.body.removeChild(aux);
}



/* ---------------------------------------------------------------------------------------------------------- */


function HabilitarPedido(strIdTercero, intIdPortafolio, intIdPortafolioTercero) {
    var parametros = {
        "btnHabilitarPedido": 'true',
        "strIdTercero": strIdTercero,
        "intIdPortafolio": intIdPortafolio,
        "intIdPortafolioTercero": intIdPortafolioTercero
    };
    $.ajax({
        data: parametros,
        url: '../Controller/InformacionPortafolioController.php',
        type: 'post',

        success: function(response) {
            if (response == 1) {
                Swal({
                    position: 'top-end',
                    type: 'success',
                    title: 'Portafolio activado',
                    showConfirmButton: false,
                    timer: 1500
                })
                ListarDetallePortafolioPedido($("#SelectMonth").val(), $("#SelectYear").val());
            } else {
                Swal.fire(
                    'Informacion?',
                    'Pedido finalizado',
                    'question'
                );
            }

        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function AbrirPortafolio(IdTercero, NombreTercero) {
    //alert(IdTercero + " " + NombreTercero);
    //window.location="https://www.inmodafantasy.com.co/DASH/view/index.php?menu=portafolios&id="+IdPortafolio;
    window.location = "http://app.inmodafantasy.com.co/DASH/view/index.php?menu=portafolios&idTercero=" + IdTercero +
        "&nombreTercero=" + NombreTercero;
    //http://localhost/DASH/view/index.php?menu=infoPortafolio
    //alert(IdPortafolio);
}

function VisualizarPedido(IdPedido) {
    var parametros = {
        "btnVisualizarPedido": 'true',
        "IdPedido": IdPedido
    };
    $.ajax({
        data: parametros,
        url: '../Controller/InformacionPortafolioController.php',
        type: 'post',

        success: function(response) {
            document.getElementById("modal-body").innerHTML = response;
        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function ConsultarIngresoPortafolio(codigo, IdTercero) {
    var parametros = {
        "LinkArchivoIni": 'true'
    };
    $.ajax({
        data: parametros,
        url: '../Controller/InformacionPortafolioController.php',
        type: 'post',

        success: function(response) {
            response = 'app.inmodafantasy.com.co/Web/View/' + '?code=' + codigo;
            Swal({
                html: "Informacion para el ingreso al portafolio link: <a href='" + response +
                    "' target='_blank'>" + response + "</a> Identificacion: " + IdTercero
            });
        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });



}
//Se actualiza el estado del pedido (estado = 2) y se descarga el excel
function GenerarExcel(IdPortafolio) {
    var parametros = {
        "actualizarEstadoPedidoCliente": 'true',
        "intId": IdPortafolio
    };
    $.ajax({
        data: parametros,
        url: '../Controller/InformacionPortafolioController.php',
        type: 'post',

        success: function(response) {
            console.log(response);
            ListarPedidosFinalizados(d.getMonth() + 1, d.getFullYear());
            ListarDetallePortafolioPedido(d.getMonth() + 1, d.getFullYear());
        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
    document.getElementById('excel' + IdPortafolio).submit();
}


function ActualizarVigenciaPortafolio(intIdPortafolio, strIdTercero, intIdPortafolioTercero) {
    var parametros = {
        "btnActualizarVigenciaPortafolio": 'true',
        "intIdPortafolio": intIdPortafolio,
        "strIdTercero": strIdTercero,
        "intIdPortafolioTercero": intIdPortafolioTercero
    };
    $.ajax({
        data: parametros,
        url: '../Controller/InformacionPortafolioController.php',
        type: 'post',

        success: function(response) {
            if (response == 1) {
                Swal({
                    position: 'top-end',
                    type: 'success',
                    title: 'Portafolio actualizado',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal({
                    position: 'top-end',
                    type: 'warning',
                    title: 'Portafolio con fecha disponible',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function DescargarInforme() {
    document.getElementById("GenerarInformeExcel").submit();
}

/*Filtrar datos en la tabla de pedidos en progreso*/
document.querySelector("#buscar").onkeyup = function() {
    $TableFilter("#tabla", this.value);
}

$TableFilter = function(id, value) {
    var rows = document.querySelectorAll(id + ' tbody tr');

    for (var i = 0; i < rows.length; i++) {
        var showRow = false;

        var row = rows[i];
        row.style.display = 'none';

        for (var x = 0; x < row.childElementCount; x++) {
            if (row.children[x].textContent.toLowerCase().indexOf(value.toLowerCase().trim()) > -1) {
                showRow = true;
                break;
            }
        }

        if (showRow) {
            row.style.display = null;
        }
    }
}
/*Filtrar datos en la tabla de pedidos en progreso*/

/*Filtrar datos en la tabla de pedidos finalizados*/
document.querySelector("#buscar1").onkeyup = function() {
    $TableFilter("#tabla1", this.value);
}

$TableFilter = function(id, value) {
    var rows = document.querySelectorAll(id + ' tbody tr');

    for (var i = 0; i < rows.length; i++) {
        var showRow = false;

        var row = rows[i];
        row.style.display = 'none';

        for (var x = 0; x < row.childElementCount; x++) {
            if (row.children[x].textContent.toLowerCase().indexOf(value.toLowerCase().trim()) > -1) {
                showRow = true;
                break;
            }
        }

        if (showRow) {
            row.style.display = null;
        }
    }
}
/*Filtrar datos en la tabla de pedidos finalizados*/


/*Filtrar datos en la tabla de pedidos enviados*/
document.querySelector("#buscar2").onkeyup = function() {
    $TableFilter("#tabla2", this.value);
}

$TableFilter = function(id, value) {
    var rows = document.querySelectorAll(id + ' tbody tr');

    for (var i = 0; i < rows.length; i++) {
        var showRow = false;

        var row = rows[i];
        row.style.display = 'none';

        for (var x = 0; x < row.childElementCount; x++) {
            if (row.children[x].textContent.toLowerCase().indexOf(value.toLowerCase().trim()) > -1) {
                showRow = true;
                break;
            }
        }

        if (showRow) {
            row.style.display = null;
        }
    }
}
/*Filtrar datos en la tabla de pedidos enviados*/


let timerInterval
swal({
    title: 'Cargando...',
    html: 'Espere mientras carga la página.',
    timer: 2000,
    onOpen: () => {
        swal.showLoading()
    },
    onClose: () => {
        clearInterval(timerInterval);
    }
}).then((result) => {
    if (result.dismiss === swal.DismissReason.timer) {}
});
</script>