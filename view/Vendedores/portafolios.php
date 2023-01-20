<?php
   if (isset($_SESSION['idportafolio'])) {
        $session_value = $_SESSION['idportafolio'];
    }else{
        $session_value = "0";
    }
     $blnPermiso=false;
    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
      if($_SESSION['Permisos'][$i]['idPermiso']==30){
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
/*NUEVO*/
ul,
#myUL {
    list-style-type: none;
}

#myUL {
    margin: 0;
    padding: 0;
}

.box {
    cursor: pointer;
    -webkit-user-select: none;
    /* Safari 3.1+ */
    -moz-user-select: none;
    /* Firefox 2+ */
    -ms-user-select: none;
    /* IE 10+ */
    user-select: none;
}

.box::before {
    font-size: 25px;
    content: "\2610";
    color: black;
    display: inline-block;
    margin-right: 6px;
}

.check-box::before {
    font-size: 25px;
    content: "\2611";
    color: dodgerblue;
}

.check-indeterminate::before {
    font-size: 30px;
    content: "\22A1";
    color: dodgerblue;
}

.nested {
    display: none;
}

.active {
    display: block;
    padding-left: 20px;

}

/*NUEVO*/




body {
    padding-right: 0 !important
}

.padd {
    padding-right: 0px;
}

.span {
    background: #4c7dd1;
    border: 1px solid #4c7dd1;
}

.portafolio {
    display: inline-block;
    height: 165px;
    width: 114px;
    padding: 5px;
    text-align: center;
}

.portafolio:hover {
    cursor: pointer;
    -webkit-border-radius: 10px 10px;
    -webkit-transform: scale(1.03);
    transform: scale(1.07);
}

.portafoliod {
    display: inline-block;
    background-color: #448bff;
    border-radius: 10px 10px;
    height: 170px;
    width: 116px;
    padding: 5px;
    text-align: center;
}

.ocultar {
    display: none;
}

.info {
    width: 40px;
    height: 30px;
    margin-top: -6px;

}

/*ESTILO PARA NUMERO DE FOTOS*/
.ruta {
    color: #428bca;
    cursor: pointer;
}

/*ESTILO PARA NUMERO DE FOTOS*/

/*ESTILO PARA NUMERO DE FOTOS*/
.notify {
    border-radius: 127px;
    border: 0px solid #000000;
    border-color: #ffff;
    background-color: red;
    float: right;
    width: 40px;
    color: #ffff;
}

/*ESTILO PARA NUMERO DE FOTOS*/

/*ESTILO PARA EL CHECKBOX*/

.option-input {
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    -o-appearance: none;
    appearance: none;
    position: relative;

    float: right;

    z-index: 100;
    outline: none;
    height: 35px;
    padding-top: 70px;
    padding-left: 70px;
    padding-right: 70px;

    top: 67px;
    bottom: 0;
    left: -4px;
    height: 25px;
    width: 25px;
    transition: all 0.15s ease-out 0s;
    background: #cbd1d8;
    border-style: solid;
    border-width: 0.5px;
    border-radius: 2px;
    border-width: 0.5px;
    /*border-color: #000;*/
    color: #fff;
    cursor: pointer;
    display: inline-block;
    margin-right: 0.5rem;
    position: relative;
    z-index: 1000;
}

.option-input:hover {
    background: #9faab7;
}

.option-input:checked {
    background: #007bff;
}

.option-input:indeterminate::before {
    height: 23px;
    width: 24px;

    position: absolute;
    content: '◼';
    display: inline-block;
    background: #007bff;
    font-size: 20px;
    text-align: center;
}

.option-input:indeterminate::after {
    background: #40e0d0;
    content: '';
    display: inline-block;
    position: relative;
    z-index: 100;
    Beverages
}

.option-input:checked::before {
    height: 25px;
    width: 25px;
    position: absolute;
    content: '✔';
    display: inline-block;
    font-size: 22px;
    text-align: center;
    line-height: 25px;
}

.option-input:checked::after {

    background: #007bff;
    content: '';
    display: inline-block;
    position: relative;
    z-index: 100;
}

/*ESTILO PARA EL CHECKBOX*/

/*ESTILO PARA EL MENU CLICK DERECHO*/
.menus {
    width: 250px;
    height: auto;
}

.menus ul li:hover {
    background: #eee;
    border-left: 4px solid #666;
}

.menus {
    position: absolute;
    /*border:1px solid black;*/
    z-index: 100000;
}

/*ESTILO PARA EL MENU CLICK DERECHO*

        /*ESTILO PARA LAS IMAGENES*/
.image:hover {
    cursor: pointer;
    background-color: #bcd6ff;
    -webkit-border-radius: 10px 10px;
    -webkit-transform: scale(1.03);
    transform: scale(1.03);
}

/*ESTILO PARA LAS IMAGENES*/
.contenedor {
    width: 90px;
    height: 240px;
    position: fixed;
    right: 0px;
    bottom: 0px;

    z-index: 10000;
}

.botonF1 {
    width: 60px;
    height: 60px;
    border-radius: 100%;
    /*background:#F44336;*/
    right: 0;
    bottom: 0;
    position: fixed;
    margin-right: 16px;
    margin-bottom: 16px;
    border: none;
    outline: none;
    color: #FFF;
    font-size: 36px;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    transition: .3s;
}

span {
    transition: .5s;
}

.botonF1:hover {
    -webkit-transform: scale(1.05);
    transform: scale(1.05);
}

.botonF1:hover span {
    transform: rotate(360deg);

}

.botonF1:active {
    transform: scale(1.1);
}

.animacionVer {
    transform: scale(1);
}

.swal2-container {
    zoom: 1.4;
    -moz-transform: scale(1.4);
}

/*PROGRESS*/
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


/*PROGRESS*/
</style>
<!-- Modals -->
<div class="modal fade" id="ModalObservaciones" tabindex="-1" role="dialog" aria-labelledby="ModalObservaciones" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Observaciones</h5>
        <div class="modal-title" id="idTerceroModalObsv" style="display:none"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
            <div class="form-row align-items-center">
                <div class="row">
                    <div class="col-sm-8">
                        <input type="text" id="observacionTercero" class="form-control mb-2" id="inlineFormInput" placeholder="Observación">
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" id="tipoGestion">
                            <option value="0">Llamada</option>
                            <option value="1">Envío de fotos</option>
                            <option value="2">Envío de portafolio</option>
                            <option value="3">Venta en sala</option>
                            <option value="4">Venta en dash</option>
                            <option value="5">Visita a cliente</option>
                            <option value="6">Pos venta</option>
                            <option value="7">Deshabilitar</option>
                            <option value="8">Varios</option>
                            <option value="9">TeleVenta</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary mb-2" onClick="GuardarGestion()">Guardar</button>
                    </div>
                </div>
            </div>
    <div class="row">
    <br>
    <div  style="overflow-y: scroll;height:50vh; ">
    <table class="table">
        <thead>
            <tr>
            <th scope="col" class="text-center">Vendedor</th>
            <th scope="col" class="text-center">Descripcion</th>
            <th scope="col" class="text-center">Tipo</th>
            <th scope="col" class="text-center">Fecha</th>
            </tr>
        </thead>
        <tbody id="tbodyGestion">
           
        </tbody>
        </table>
    </div>
    
    </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
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
                                <div class="panel panel-default">
                                    <div class="panel-heading text-center">
                                        Portafolio
                                    </div>

                                    <div class="panel-body">
                                        <!--<div class="row">
                                            <div class="col-lg-12">
                                                <center>
                                                <a href="http://www.inmodafantasy.com.co/Web/View/?code=<?php echo $_SESSION['idLogin']?>"
                                                    target="_blank"
                                                    id="link">http://www.inmodafantasy.com.co/Web/View/?code=<?php echo $_SESSION['idLogin']?></a>
                                                <button class="btn btn-default" onClick="CopiarLink();">
                                                    Copiar Link
                                                </button>
                                                </center>
                                            </div>
                                        </div>-->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="table-responsive-sm">
                                                    <table class="table">
                                                        <caption>Acceso portafolio <button  onclick='ValidarRestablecerPortafolio()' style="float: right;" class='btn btn-default'>Restablecer</button></caption>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" class="text-center">#</th>
                                                                <th scope="col" class="text-center">Restringido</th>
                                                                <th scope="col" class="text-center">Libre</th>
                                                                <th scope="col" class="text-center">Temporal (2 meses)
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th class="text-center">
                                                                    <label id="IdPortafolio"></label>
                                                                </th>
                                                                <th class="text-center">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="inlineRadioOptions" id="radio0"
                                                                        onchange="TipoAccesoPortafolio(0);">
                                                                </th>
                                                                <td class="text-center">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="inlineRadioOptions" id="radio1"
                                                                        onchange="TipoAccesoPortafolio(1);">
                                                                </td>
                                                                <td class="text-center">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="inlineRadioOptions" id="radio2"
                                                                        onchange="TipoAccesoPortafolio(2);">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12" id="InfoPortafolio">
                                                <!--<div>Nueva actualizacion!! Ahora todos los clientes podran ver todas las lineas</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
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





<div id="page-wrapper" style="min-height:100vh;">
    <div class="row">


        <!--Menu del portafolio con funcion delclick derecho-->
        <!--Label que guarda el id del portafolio-->
        <label id="IdTemporal" style="display: none;"></label>

        <div class="menus" id="menu" style="display: none;">

            <ul class="list-group">
                <li id="Abrir" class="list-group-item"
                    onclick="ExpandirPortafolio(document.getElementById('IdTemporal').innerHTML);">Abrir</li>
                <!--<li id="Eliminar" class="list-group-item" onclick="AlertEliminarPortafolio(document.getElementById('IdTemporal').innerHTML);">Eliminar</li>-->
                <li id="Renombrar" class="list-group-item"
                    onclick="NombrePortafolio(document.getElementById('IdTemporal').innerHTML)">Renombrar</li>
            </ul>
        </div>
        <!--Menu del portafolio con funcion delclick derecho-->

        <!--Contenido-->
        <div class="col-lg-12 align-self-center" id="div">

            <div class="row" style="">

                <!--<div class="col-lg-2" style="border: 1px ; border-style: none dotted none none; height: 100%;" >
                <div style="height: 100%;">
                    <input type="text" class="form-control" name="">
                </div>
            </div>-->
                <div class="row">
                    <div class="col-lg-10">
                        <br>
                        <button class="btn btn-default" id="btnHome" style="display: none;" onclick="Home();"><i
                                class="glyphicon glyphicon-home"></i></button>

                        <button class="btn btn-default" id="btnBack" style="display: none;" onclick="Back();"><i
                                class="glyphicon glyphicon-chevron-left"></i></button>
                        <!--modal
                    <button type="button" id="CrearPortafolio" class="btn btn-primary"><a href="#" data-toggle="modal" data-target="#modal-avisolegal"  style="text-decoration: none; color: #FFFFFF;">Crear Protafolio</a></button>
                    modal-->
                        <button type='button' class='btn btn-default' onclick="Finalizar(); FiltrarPortafolios();"
                            id="AñadirDetalles" style="display:none;">Finalizar Portafolio</button>

                    </div>
                </div>

                <!--SECCION DE FILTROS-->
                <div class="row" id="FiltroPortafolio">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <input type="search" id="txtFiltro" placeholder="Filtrar"
                                        onkeyup="FiltrarTerceros(event,'txtFiltro');" class="form-control"
                                        aria-label="...">
                                </div>
                            </div>
                            <div class="col-lg-2">
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
                                               Filtro de terceros segun las zonas y lineas <br>
                                               <br><br>Pendiente: organizar consulta para los terceros sin compra
                                               <br>
                                                Validar que se esten mostrando las carpetas de 1000, etc con sus respectivas lineas
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="">Zonas</label>
                            <select class="form-control" id="SelectZonas" multiple="multiple"
                                onchange="FiltrarXzonas('SelectZonas')">
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                            </select>
                        </div><br>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="">Lineas</label>
                            <select class="form-control" id="SelectLineas" multiple="multiple" class="form-control"
                                onchange="FiltrarXlineas('SelectLineas')">
                                <option value="1">Ensamble</option>
                                <option value="2">Acero</option>
                                <option value="3">Carey</option>
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
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="">Viaja</label>
                            <select class="form-control" id="SelectViaja" onchange="FiltrarXviaje('SelectViaja')">
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div><br>
                    </div>
                    <?php 
                        if($_SESSION['idLogin']==1 || $_SESSION['idLogin']==75 || $_SESSION['idLogin']==76){
                           ?><div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Sector</label>
                                    <select class="form-control" id="SelectSector" onchange="FiltrarXsector('SelectSector')">
                                        <option value="HUECO MEDELLIN">Hueco</option>
                                        <option value="PERIFERIA">Periferia</option>
                                    </select>
                                </div><br>
                            </div><?php
                        }
                     ?>
                     
                    <div class="col-lg-2" >
                        <div class="form-group" style="display:none">
                            <label for="">Con Historial</label>
                            <select class="form-control" id="SelectCompra" onchange="FiltrarXcompra('SelectCompra')" style="padding-left: 5px;">
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div><br>
                    </div>
                    <div class="col-lg-2 col-lg-offset-1" style="display: none;">
                        <table class="table">
                            <caption class="text-center">Restablecer Gestion Terceros</caption>
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Llamada</th>
                                    <th scope="col" class="text-center">Envío de fotos</th>
                                    <th scope="col" class="text-center">Envío de portafolio</th>
                                    <th scope="col" class="text-center">Venta en sala</th>
                                    <th scope="col" class="text-center">Venta en dash</th>
                                    <th scope="col" class="text-center">Visita a cliente</th>
                                    <th scope="col" class="text-center">Pos venta</th>
                                    <th scope="col" class="text-center">Deshabilitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-default" onclick="ResetGesion(1);"><span
                                                class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-default" onclick="ResetGesion(0);"><span
                                                class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-default" onclick="ResetGesion(2);"><span
                                                class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--SECCION DE FILTROS-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center" id="prueba">
                                <label id="NombrePortafolio"></label>
                                <label id="IdPortafolio" style="display: none;"></label>
                                <label id="IdP" style="display: none;"></label>
                                <div id="RutasAcceso"></div>
                            </div>
                            <div class="panel-body">
                                <div id="panel">
                                    <div id="scroll-terceros" style="overflow-y: scroll;height:60vh; ">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">Nombre</th>
                                                    <th scope="col" class="text-center">Estado</th>
                                                    <th scope="col" class="text-center">Viaja</th>
                                                    <th scope="col" class="text-center">Zonas</th>
                                                    <th scope="col" class="text-center">Frecuencia de Compra</th>
                                                    <th scope="col" class="text-center">Ultima Compra </th>
                                                    <th scope="col" class="text-center">Pedido Activo</th>
                                                    <th scope="col" class="text-center">Fuerte</th>
                                                    <th scope="col" class="text-center">Evaluar</th>
                                                    <th scope="col" class="text-center">Ultima gestion</th>
                                                    <th scope="col" class="text-center">Agregar Gestion</th>
                                                    <th scope="col" class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="PanelBody">
                                               
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
        <!--LISTADO DE TERCEROS
    <div id="ListaTerceros" class="col-lg-4 align-self-center">
        <br>
        <ul class="list-group">
          <li class="list-group-item">
            <div class="row">
              <div class="col-lg-12">
                <div class="input-group">
                    <span class="input-group-addon">
                    <i class="fa fa-search"></i>
                  </span>
                  <input type="text" id="cliente" class="form-control" placeholder="Filtrar clientes..." onkeyup="FiltrarClienteDB();">
                  
                </div>
                <div  style="overflow: scroll;height: 500px;">
                    <table class="table table-bordered" id="tabla">
                          <tbody id="terceros">
                            
                          </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </li>
          
          
        </ul>
    </div>
    LISTADO DE TERCEROS-->

        <!--LISTADO DETALLE TERCERO-->
        <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-sm modal-lg " role="document">
                <div class="modal-content" style="width: 800px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Informacion detallada</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div>
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
                        <div class="modal-body" style="text-align: center;" id="informacion">

                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" id="btnModal" style="display: none;" onclick="DescPortafolioTercero();"
                            class="btn btn-secondary">Enviar</button>
                        <button type="button" class="btn btn-secondary" onclick="PaddingRight()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--LISTADO DETALLE TERCERO-->
    </div>
</div>
<!--Contenido-->
<script type="text/javascript">
//RECIVIMOS JSON
/*
    ESTRUCTURA
    var parametros = {
        "nombre_post": "true",
    };
        $.ajax({
            data: parametros,
            url: '../Controller/PortafolioController.php',
            type: 'post',
            dataType: 'JSON',
            success: function(response) {
                $.each(response, function(index, item) {

                });
            },
            error: function(error) {
                alert('error; ' + eval(error));
            }
        });

*/


//-----------------------FUNCIONES INICIALES------------------------------
//HOUSE
//CargarPanelClientes();

//WORK
ConsultarZonas();
ConsultarLineas();
ConsultarParametroViaja();
$('#SelectLineas').val(0);
FiltrarTerceros( $.Event("keypress", {keyCode: 13}),'txtFiltro');
$("#scroll-terceros").scroll(function() {
    var windowHeight = $("#scroll-terceros").scrollTop();

    var contenido2 = $("#panel").offset();
    contenido2 = contenido2.top;

    if (windowHeight >= contenido2) {
        //console.log(windowHeight + " __ " + contenido2);
    } else {
        //console.log(windowHeight + " __ " + contenido2);
    }
});

function CopiarLink(){
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


function ConsultarZonas() {
    $('#SelectZonas').html("");
    var view = "";
    var parametros = {
        "ConsultarZonas": "true",
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        async: false,
        success: function(response) {
            //console.log(response);
            var array = [];
            $.each(response['zonas'], function(index, item) {
                if(array.indexOf(item.intId) == -1){
                    array.push(item.intId);
                    $('#SelectZonas').append("<option value='" + item.intId + "'>" + item
                        .strDescripcion +
                        "</option>");
                }
                    
            });
        },
        error: function(error) {
            console.log((error.responseText));
        }
    });
}

function ConsultarLineas() {
    $('#SelectLineas').html("");
    var view = "";
    var parametros = {
        "ConsultarLineas": "true",
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        async: false,
        success: function(response) {
            //console.log(response);
            $.each(response['lineas'], function(index, item) {
                $('#SelectLineas').append("<option value='" + item[1] + "'>" + item[0] +
                    "</option>");
            });
        },
        error: function(error) {
            console.log((error.responseText));
        }
    });
}

function ConsultarParametroViaja() {
    $('#SelectViaja').html("");
    var view = "";
    var parametros = {
        "ConsultarParamViaja": "true",
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(response) {
            //console.log(response);
            $.each(response['viaja'], function(index, item) {
                $('#SelectViaja').append("<option value='" + item
                    .StrDato1 + "'>" + item
                    .StrDato1 +
                    "</option>");
            });
        },
        error: function(error) {
            console.log((error.responseText));
        }
    });
}

function CargarPanelClientes() {
    $('#PanelBody').html("");
    var parametros = {
        "CargarPanelClientes": "true",
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(response) {
            //console.log(response['clientes']);
            $.each(response['clientes'], function(index, item) {
                //console.log(item.strnombre);
                RowTabla(item);
            });
        },
        error: function(error) {
            console.log((error.responseText));
        }
    });
}
//-----------------------FUNCIONES INICIALES------------------------------


//-----------------------DETALLE TERCERO----------------------------------
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

function OpenModalGestion(idTercero){
    $('#idTerceroModalObsv').html(idTercero);
    ConsultarGestiones(idTercero);
    $('#ModalObservaciones').modal('show');
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
//-----------------------DETALLE TERCERO----------------------------------


//-----------------------GESTION PORTAFOLIO-------------------------------

function SeleccionarTipoAccesoPortafolio(tipoAcceso) {
    if (tipoAcceso == 0) {
        $('#radio0').prop('checked', true);
    } else if (tipoAcceso == 1) {
        $('#radio1').prop('checked', true);
    } else if (tipoAcceso == 2) {
        $('#radio2').prop('checked', true);
    }
}


function TipoAccesoPortafolio(tipoAcceso) {
    var idPortafolio = $('#IdPortafolio').html();
    var parametros = {
        "chkTipoAccesoPortafolio": "true",
        tipoAcceso,
        idPortafolio
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        success: function(response) {},
        error: function(error) {
            console.log(error.responseText);
        }
    });
}



function MenuFolder(idTercero, idPortafolio, folder, id) {
    if ($('#' + id).children('ul').hasClass('active')) {
        $('#' + id).children('ul').removeClass('active');
    } else {
        if ($('#' + id).children('ul').length > 0) {
            $('#' + id).children('ul').addClass('active');
        } else {
            ConsultarFolders(idTercero, idPortafolio, folder, id, "");
        }
    }
}

function CheckFolder(idTercero, idPortafolio, folder, id,target) {
    //VERIFICAR
    //PENDIENTE VALIDAR SI ES INDETERMINATE O COMPLETO EN EL FRONT°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°
    var check = "";
    if ($('#' + id).children('span').hasClass('check-box')) {
        $('#' + id).children('span').removeClass('check-box');
        RutasPortafolioDB(idPortafolio, folder, false);
    } else if($('#' + id).children('span').hasClass('check-indeterminate')){
        $('#' + id).children('span').removeClass('check-indeterminate');
        RutasPortafolioDB(idPortafolio, folder, false);
    } else{
        check = "check-box";
        $('#' + id).children('span').addClass('check-box');
        RutasPortafolioDB(idPortafolio, folder, true);
    }
    //console.log(target.path);

    //ConsultarFolders(idTercero, idPortafolio, folder, id, check);
}

function RutasPortafolioDB(idPortafolio, folder, action) {
    var parametros = {
        "evtCheck": "true",
        "folder": folder,
        "action": action,
        "idPortafolio": idPortafolio
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        success: function(res) {
            console.log(res);
        },
        error: function(error) {
            console.log(eval(error.responseText));
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
                console.log("se imprime folders DESDE ACA");
                //console.log(res);
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
//-----------------------GESTION PORTAFOLIO-------------------------------



//----------------------------FILTROS-------------------------------------

function ListarZonas(tipo = 2) {
    var arrayZonas = [];
    if (tipo == 2 || tipo == 0) {
        $("#SelectZonas option:selected").each(function() {
            arrayZonas.push($(this).prop('value'));
        });
    }

    if (tipo == 2 || tipo == 1) {
        if (arrayZonas.length == 0) {
            $("#SelectZonas option").each(function() {
                arrayZonas.push($(this).prop('value'));
            });
        }
    }


    return arrayZonas;
}

function ListarLineas(tipo = 2) {
    var arrayLineas = [];
    if (tipo == 2 || tipo == 0) {
        $("#SelectLineas option:selected").each(function() {
            arrayLineas.push($(this).prop('value'));
        });
    }

    if (tipo == 2 || tipo == 1) {
        if (arrayLineas.length == 0) {
            $("#SelectLineas option").each(function() {
                arrayLineas.push($(this).prop('value'));
            });
        }
    }


    return arrayLineas;
}

function FiltrarTerceros(e, id, pagina = 0) {
    if (e !== null && e.keyCode === 13 || e == 11) {
        var arrayZonas = ListarZonas(1);
        var text = $('#' + id).val();
        var cargarmas = -1;
        //if(text != ""){cargarmas = 1;}
        var parametros = {
            "FiltrarTerceros": "true",
            text,
            arrayZonas,
            "Pagina": pagina
        };
        $.ajax({
            data: parametros,
            url: '../Controller/PortafolioController.php',
            type: 'post',
            dataType: 'JSON',
            success: function(res) {
                console.log(res);
                if(e != 11){$('#PanelBody').html("");}
                
                $.each(res['terceros'], function(index, item) {
                    //console.log(index);
                    var last = 0;
                    if ((index + 1) == res['terceros'].length) {
                        //console.log("ultimo "+index);
                        last = 1;
                    }
                    
                    RowTabla(item, res['HCNC'][index], res['PA'][index], res['GD'][index], res['FC']
                        [index], last,4);
                });
            },
            error: function(error) {
                console.log((error.responseText));
            }
        });
    }

}


function FiltrarXzonas(id, pagina = 0) {
    var arrayZonas = ListarZonas();
    var arrayLineas = ListarLineas();

    if (pagina == 0) {
        $('#PanelBody').html("");
    }
    console.log(arrayZonas);
    console.log(arrayLineas);
    var parametros = {
        "FiltrarTerceroXzona": "true",
        "Zonas": arrayZonas,
        "Lineas": arrayLineas,
        "Pagina": pagina
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(res) {
            console.log(res);
            $.each(res['terceros'], function(index, item) {
                //console.log(item);
                var last = 0;
                if ((index + 1) == res['terceros'].length) {
                    //console.log("ultimo "+index);
                    last = 1;
                }
                RowTabla(item, res['HCNC'][index], res['PA'][index], res['GD'][index], res['FC'][
                    index
                ], last, 1);
            });
        },
        error: function(error) {
            console.log(eval(error.responseText));
        }
    });
}

function FiltrarXlineas(id, pagina = 0) {
    var arrayZonas = ListarZonas();
    var arrayLineas = ListarLineas();
    console.log(arrayZonas);
    console.log(arrayLineas);
    if (pagina == 0) {
        $('#PanelBody').html("");
    }
    var parametros = {
        "FiltrarTerceroXlineas": "true",
        "Lineas": arrayLineas,
        "Zonas": arrayZonas,
        "Pagina": pagina
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(res) {
            console.log(res);
            $.each(res['terceros'], function(index, item) {
                //console.log(item); 
                var last = 0;
                if ((index + 1) == res['terceros'].length) {
                    //console.log("ultimo "+index);
                    last = 1;
                }
                RowTabla(item, res['HCNC'][index], res['PA'][index], res['GD'][index], res['FC'][
                    index
                ], last, 2);
            });
        },
        error: function(error) {
            console.log((error.responseText));
        }
    });
}

function FiltrarXsector(id, pagina = 0) {
    if (pagina == 0) {
        $('#PanelBody').html("");
    }

    var parametros = {
        "FiltrarTerceroXsector": "true",
        "Sector": $('#' + id).val(),
        "Pagina": pagina
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(res) {
            $.each(res['terceros'], function(index, item) {
                var last = 0;
                if ((index + 1) == res['terceros'].length) {
                    console.log("ultimo "+index);
                    last = 1;
                }
                RowTabla(item, res['HCNC'][index], res['PA'][index], res['GD'][index], last, last, 5);
            });
        },
        error: function(error) {
            console.log(((error.responseText)));
        }
    });
}

function FiltrarXviaje(id, pagina = 0) {
    var arrayZonas = ListarZonas(1);
    //var arrayLineas = ListarLineas(1);
    console.log(arrayZonas);
    //console.log(arrayLineas);
    var viaja = $('#' + id).val();
    if (pagina == 0) {
        $('#PanelBody').html("");
    }

    var parametros = {
        "FiltrarTerceroXviaje": "true",
        "Viaja": viaja,
        arrayZonas,
        "Pagina": pagina
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(res) {
            console.log(res['terceros']);
            $.each(res['terceros'], function(index, item) {
                console.log(item);
                var last = 0;
                if ((index + 1) == res['terceros'].length) {
                    //console.log("ultimo "+index);
                    last = 1;
                }
                RowTabla(item, res['HCNC'][index], res['PA'][index], res['GD'][index], last, 3);
            });
        },
        error: function(error) {
            console.log(((error.responseText)));
        }
    });
}

function FiltrarXcompra(id, pagina = 0){
    var arrayZonas = ListarZonas(1);
    var compra = $('#' + id).val();
    if (pagina == 0) {
        $('#PanelBody').html("");
    }

    var parametros = {
        "FiltrarTerceroXcompra": "true",
        compra,
        arrayZonas,
        "Pagina": pagina
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(res) {
            console.log(res['terceros']);
            $.each(res['terceros'], function(index, item) {
                console.log(item);
                var last = 0;
                if ((index + 1) == res['terceros'].length) {
                    last = 1;
                }
                RowTabla(item, res['HCNC'][index], res['PA'][index], res['GD'][index], last, 3);
            });
        },
        error: function(error) {
            console.log(((error.responseText)));
        }
    });
}

//----------------------------FILTROS-------------------------------------

//----------------------------GESTION DESTAPE-----------------------------

function ResetGesion(tipoGestion) {
    var parametros = {
        "ResetGesion": "true",
        tipoGestion,
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        success: function(res) {
            if (res == 1) {
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                console.log(res);
            }
        },
        error: function(error) {
            console.log((eval(error.responseText)));
        }
    });
}

function GestionDestapeTercero(obj, tipoGestion, idTercero) {
    //tipoGestion = 1 es gestion grupal
    //tipoGestion = 0 es gestion individual
    //tipoGestion = 2 es gestion externo
    var accion = 0;
    if ($('#' + obj.id).prop('checked')) {
        accion = 1;
    }
    var parametros = {
        "chkGestionDestape": "true",
        tipoGestion,
        idTercero,
        accion
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(res) {
            console.log(res['destape']);
        },
        error: function(error) {
            console.log((eval(error.responseText)));
        }
    });
}
//----------------------------GESTION DESTAPE-----------------------------


//----------------------------HTML VIEW-----------------------------------
function RowTabla(obj, HCNC = 0, PA, GD, FC, last, tipoFiltro = 1) {
    var chkG = "";
    var chkI = "";
    var chkE = "";
    var estadoHCNC = "";
    var estadoPedidoActivo = "";
    var usuarioG = "";
    var usuarioS = "";
    var usuarioE = "";

    /*if (GD['rpta'] == 3) {
        chkE = "checked";
    } else if (GD['rpta'] == 2) {
        chkI = "checked";
    } else if (GD['rpta'] == 1) {
        chkG = "checked";
    } else if (GD['rpta'] == 111){
        chkG = "checked";
        chkI = "checked";
        chkE = "checked";
    } else if (GD['rpta'] == 11){
        chkI = "checked";
        chkE = "checked";
    } else if (GD['rpta'] == 110){
        chkG = "checked";
        chkI = "checked";
    } else if (GD['rpta'] == 101){
        chkG = "checked";
        chkE = "checked";
    }
    usuarioG = GD['@usuarioG'] === undefined ? '' : GD['@usuarioG'];
    usuarioS = GD['@usuarioS'] === undefined ? '' : GD['@usuarioS'];;
    usuarioE = GD['@usuarioE'] === undefined ? '' : GD['@usuarioE'];;*/

    if (HCNC == -1) {
        HCNC = "Sin compras";
        //obj.FC = 0;
    } else if (FC > HCNC) {
        estadoHCNC = "success";
    } else if (FC < HCNC) {
        var dif = HCNC - FC;
        if (dif <= 10) {
            estadoHCNC = "warning";
        } else {
            estadoHCNC = "danger";
        }
    }

    if (PA[0]['intEstado'] == -1) {
        PA[0]['dtdiff'] = "Sin pedido iniciado";
    } else if (PA[0]['dtdiff'] <= 5) {
        estadoPedidoActivo = "success";
    } else if (PA[0]['dtdiff'] <= 10) {
        estadoPedidoActivo = "warning";
    } else if (PA[0]['dtdiff'] > 10) {
        estadoPedidoActivo = "danger";
    }

    if(obj.StrCausa == "GENERAL"){
        estadoTercero = "Activo";
    }else{
        estadoTercero = obj.StrCausa;
    }

    if (FC == -1) {
        FC = "";
    }
    if (obj.StrDesClase == undefined) {
        obj.StrDesClase = "";
    }

    var vendedor = '';
    var fechaGestion = '';
    if(GD['dtFechaGestion'] !== null){
        fechaGestion = GD['dtFechaGestion'];
        vendedor = GD['strNombreEmpleado']+'\n'+GD['strObservacion'];
    }
    console.log(GD);

    $('#PanelBody').append(`
        <tr>
        <th scope="row" class="text-center">` + obj.StrNombre + `</th>
        <th scope="row" class="text-center">` + estadoTercero + `</th>
        <td class="text-center">` + obj.StrDato1 + `</td>
        <td class="text-center">` + obj.StrDescripcion + `</td>
        <td class="text-center">` + FC + `</td>
        <td class="text-center ` + estadoHCNC + `">` + HCNC + `</td>
        <td class="text-center ` + estadoPedidoActivo + `">` + (PA[0]['dtdiff']) +
        `</td>
        <td class="text-center">` + obj.StrContactoTecnico2 + `</td>
        <td class="text-center">` + obj.StrRepLegal + `</td>
        
        <td class="text-center" data-toggle="tooltip" data-placement="left" title="` + vendedor + `">` + fechaGestion + `</td>
        
        <td class="text-center">
            <button type="button" class="btn btn-default" onClick="OpenModalGestion('` + obj
        .StrIdTercero +
        `', '` + obj.StrNombre + `')">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
        </td>

        <td class="text-center">
            <button type="button" class="btn btn-default" onClick="OpenModal('ModalGestionCliente', '` + obj
        .StrIdTercero +
        `', '` + obj.StrNombre + `')">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </button>
        </td>
        </tr>`);
    console.log(last);
    if (last == 1) {
        console.log("hptttt");
        $('#PanelBody').append(`
        <tr id="` + (Number(obj.rownumber) + 1) + `">
            <td colspan="10" class="text-center"><button type="button" class="btn btn-default" onclick="CargarDatos(` +
            (Number(obj.rownumber) + 1) + `, ` + tipoFiltro + `);">Cargar mas</button></td>
            
        </tr>`);
    }
}

function CargarDatos(pagina, tipoFiltro) {
    var inicio = pagina + 1;
    $('#' + pagina).css("display", "none");
    switch (tipoFiltro) {
        case 1:
            FiltrarXzonas('SelectZonas', inicio);
            break;
        case 2:
            FiltrarXlineas('SelectLineas', inicio);
            break;
        case 3:
            FiltrarXviaje('SelectViaja', inicio);
            break;
        case 4:
            FiltrarTerceros(11, 'txtFiltro', inicio);
            break;
        case 5:
            FiltrarXsector('SelectSector', inicio);
            break;

    }
}
//----------------------------HTML VIEW-----------------------------------


































//-----------------------------------------------------------------------------------------------------------------------------------------






var d = new Date();
$("#SelectMonth").val(d.getMonth() + 1);
$("#SelectYear").val(d.getFullYear());



function FiltrarPortafolios() {
    var parametros = {
        "evtFiltrarPortafolios": "true",
        "text": $("#txtFiltro").val(),
        "mes": $("#SelectMonth").val(),
        "año": $("#SelectYear").val()
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        success: function(response) {
            //alert(response);
            document.getElementById('TblArchivos').innerHTML = response;

        },
        error: function(error) {
            console.log(eval(error.responseText));
        }
    });
}





$("#menu").hide();

function titulo(id, visible) {
    if (visible) {
        $('#NomPortafolio' + id).popover('hide');
    } else {
        $('#NomPortafolio' + id).popover('show');
    }

}
//nuevo
function FiltrarClienteDB() {
    var NomTercero = $('#cliente').val();
    var parametros = {
        "evtFiltrarTercero": "true",
        "NomTercero": NomTercero
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        success: function(response) {
            document.getElementById('terceros').innerHTML = response;

        },
        error: function(error) {
            console.log(eval(error.responseText));
        }
    });
}
//nuevo
/*if ($_GET('id')) {
    alert('hola');
}else{
    alert('adios');
}*/
//cuando llege de otra parte no ejecutar finalizar!!!
//Finalizar();

//Listar clientes del usuario logeado
//alert(22);
//var session = '<%= Session["idportafolio1"] %>';
var session = <?php echo $session_value; ?> ;
if (session == "0") {
    //Finalizar(); 
    //FiltrarPortafolios();
    //alert("no existe la session");
}
//ListarTerceros();
var ban = 0;

function PaddingRight() {
    $('#exampleModal').modal('hide');
    $("body").addClass("padd");
}

function CopiarTexto(idelemento) {
    var codigoACopiar = document.getElementById(idelemento);
    codigoACopiar.select();
    var res = document.execCommand('copy');
    window.getSelection().removeAllRanges();

    document.getElementById('btnCopy').innerHTML = "Copiado";
    var clear = setInterval(function() {
        document.getElementById('btnCopy').innerHTML = "Copiar";
        clearInterval(clear);
    }, 1000);
}

document.oncontextmenu = function() {
    return true
}

$(document).click(function(e) {
    $("#menu").css("display", "none");
    document.oncontextmenu = function() {
        return true
    }
    if (e.button == 0) {
        //Cuando selecciona el portafolio 'ban = 1' ya que siempre se ejecuta esta funcion y no lo deseleccionara luego cambia 'ban = 0' para que se deseleccione afuera
        if (ban != 1) {
            if (document.getElementById('IdP').innerHTML != '') {
                var v = document.getElementById('IdP').innerHTML;

                var portafolio = document.getElementById(v);

                portafolio.classList.remove('portafoliod');
                portafolio.classList.add('portafolio');
                var btn = document.getElementsByClassName('select');
                for (var i = btn.length - 1; i >= 0; i--) {
                    btn[i].style.display = 'none';
                }
            }
        }
        ban = 0;
        //Ocultamos el menu del click derecho y habilitamos el click derecho
    }
});





function Mostrar(e, IdPortafolio) {
    //Deshabilitamos click derecho//
    document.getElementById('IdTemporal').innerHTML = IdPortafolio;
    document.oncontextmenu = function() {
        return false
    }

    $("#menu").css({
        'display': 'block',
        'left': e.pageX,
        'top': e.pageY
    });
    //Colocamos el id al div 

}
var sw = 1;
var IdActual = 0;
oldid = null;

function fijo(id, idPortafolio) {

    var portafolio = document.getElementById(id);
    var btn = document.getElementsByClassName('select');
    //Deseleccionamos el portafolio anterior y borramos el nombre del portafolio
    if (oldid != null && oldid != id) {
        document.getElementById(oldid).classList.remove('portafoliod');
        document.getElementById(oldid).classList.add('portafolio');
        document.getElementById('IdPortafolio').innerHTML = '';
        document.getElementById('IdP').innerHTML = "";
        for (var i = btn.length - 1; i >= 0; i--) {
            btn[i].style.display = 'none';
        }
    }
    //Seleccionamos el portafolio la primera vez y guardamos el nombre del portafolio
    if (portafolio.className == 'portafolio') {
        ban = 1;
        IdActual = id;
        portafolio.classList.remove('portafolio');
        portafolio.classList.add('portafoliod');
        document.getElementById('IdPortafolio').innerHTML = idPortafolio;
        document.getElementById('IdP').innerHTML = IdActual;
        for (var i = btn.length - 1; i >= 0; i--) {
            btn[i].style.display = 'inline';
        }
    } else { //Deseleccionamos el mismo portafolio y borramos el nombre del portafolio
        portafolio.classList.remove('portafoliod');
        portafolio.classList.add('portafolio');
        document.getElementById('IdPortafolio').innerHTML = '';
        document.getElementById('IdP').innerHTML = "";
        for (var i = btn.length - 1; i >= 0; i--) {
            btn[i].style.display = 'none';
        }
    }

    oldid = id;
    sw = 0;

}

function ListarArchivos() {
    var parametros = {
        "btnListarArchivos": 'true',
        "NombrePortafolio": document.getElementById("NombrePortafolio").innerHTML.trim()
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {
            document.getElementById('TblArchivos').innerHTML = response;
            $("#FiltroPortafolio").css("display", "none");

        },
        error: function(error) {
            console.log(eval(error.responseText));
        }
    });
}
//Muestra la ventana para ingresar el nombre del portafolio
function NombrePortafolio(IdPortafolio) {
    if (document.getElementById('Renombrar')) {
        swal({
            title: 'Editar nombre del portafolio',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off',
                id: 'CambioNomPortafolios'
            },
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !swal.isLoading()
        }).then((result) => {
            if (result.value) {
                //alert(document.getElementById('IdTemporal').innerHTML);   
                EditarNombrePortafolio(result.value);
                /*swal({
                  title: `${result.value.login}'s avatar`,
                  imageUrl: result.value.avatar_url
                })*/
            }
        })
    }

}
//Alert para eliminar portafolio
function AlertEliminarPortafolio(IdPortafolio) {
    swal({
        title: 'Está seguro?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminarlo!'
    }).then((result) => {
        if (result.value) {
            EliminarPortafolio(IdPortafolio);
        }
    })
}
//Alert para crear portafolio
function AlertCrearPortafolio() {

    swal({
        title: 'Nuevo Portafolio',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off',
            id: 'title'
        },
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        showLoaderOnConfirm: true,
        allowOutsideClick: () => !swal.isLoading()
    }).then((result) => {
        if (result.value) {
            Agregar();
        }
    })
}

//Eliminar portafolio
function EliminarPortafolio(IdPortafolio) {
    var parametros = {
        "btnEliminarPortafolio": 'true',
        "IdPortafolio": IdPortafolio
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        success: function(response) {
            //document.getElementById('TblArchivos').innerHTML=response;
            Mensajes();
            Finalizar();

        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}
//Editar nombre portafolio
function EditarNombrePortafolio(NomPortafolio) {
    var IdPortafolio = document.getElementById('IdTemporal').innerHTML;
    var parametros = {
        "btnEditarPortafolio": 'true',
        "IdPortafolio": IdPortafolio,
        "NombrePortafolio": NomPortafolio
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        success: function(response) {
            document.getElementById('TblArchivos').innerHTML = response;
            Mensajes();
            Finalizar();

        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}
//Abre el detalle del portafolio por primera vez
function ExpandirPortafolio(IdPortafolio) {

    /*var ListaTerceros = document.getElementById('ListaTerceros');
    ListaTerceros.style.display = 'none';*/
    $("#FiltroPortafolio").css("display", "none");
    $('#ListaTerceros').css('display', 'none');

    if ($('#div').hasClass('col-lg-8')) {
        //alert("1");
        $('#div').removeClass('col-lg-8');
        $('#div').addClass('col-lg-12');
    } else {
        if ($('#div').hasClass('col-lg-12')) {
            //alert("2");
        }
    }

    /*document.getElementById('div').classList.remove('col-lg-8');
    document.getElementById('div').classList.add('col-lg-12');*/
    if (document.getElementById('NamePortafolio' + IdPortafolio)) {
        document.getElementById('NombrePortafolio').innerHTML = document.getElementById('NamePortafolio' + IdPortafolio)
            .innerHTML;
    } else {
        ConsultarNombrePortafolio(IdPortafolio);
        //document.getElementById('NombrePortafolio').innerHTML = ConsultarNombrePortafolio(IdPortafolio);
    }


    var btn = document.getElementsByClassName('select');
    for (var i = btn.length - 1; i >= 0; i--) {
        btn[i].style.display = 'none';
    }

    var parametros = {
        "btnDbClick1": 'true',
        "IdPortafolio": IdPortafolio
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        //CrearPortafolio
        success: function(response) {
            document.getElementById('TblArchivos').innerHTML = response;
            document.getElementById('CrearPortafolio').style.display = 'none';
            document.getElementById('CrearPortafolio').style.visibility = 'hidden';
            document.getElementById("AñadirDetalles").style.visibility = "visible";
            document.getElementById("AñadirDetalles").style.display = 'inline';
            document.getElementById('btnHome').style.display = 'inline';
            document.getElementById('btnHome').style.visibility = 'visible';
            document.getElementById('btnBack').style.display = 'inline';
            document.getElementById('btnBack').style.visibility = "visible";
            //ocultar lista de terceros

            ValidarChk((document.getElementById('limit').innerHTML));

        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function ConsultarNombrePortafolio(IdPortafolio) {
    var parametros = {
        "ConsultarNombrePortafolio": 'true',
        "IdPortafolio": IdPortafolio
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {
            if (response != -1) {
                document.getElementById('NombrePortafolio').innerHTML = response;
            } else {
                //alert(response);
            }

        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function OpenRoute(pos) {
    var parametros = {
        "OpenRoute": 'true',
        "NombrePortafolio": document.getElementById('NombrePortafolio').innerHTML,
        "PosVector": pos
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {
            //colocamos la ruta(label) en el div de rutas
            //document.getElementById('RutasAcceso').innerHTML=response;
            document.getElementById('TblArchivos').innerHTML = response;

            ValidarChk((document.getElementById('limit').innerHTML) - 1);
            DefinirRuta();
        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function DefinirRuta() {
    var parametros = {
        "btnCrearRuta": 'true'
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {
            //colocamos la ruta(label) en el div de rutas
            document.getElementById('RutasAcceso').innerHTML = response;
            //document.getElementById('TblArchivos').innerHTML=response;

        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function ExpandirDetalle(id, ruta) {
    var Carpeta = document.getElementById(id).innerHTML.trim();
    //alert(Carpeta);
    var parametros = {
        "btnDbClick": 'true',
        "DbClick": Carpeta,
        "NombrePortafolio": document.getElementById("NombrePortafolio").innerHTML.trim()
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {

            document.getElementById('TblArchivos').innerHTML = response;
            ValidarChk((document.getElementById('limit').innerHTML) - 1);
            DefinirRuta();

            //Colocamos el label de la carpeta seleccionada

        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

//creamos el elemento y el id va ser la posicion del vector 
function CrearElemento(id) {
    //alert(Carpeta); <label id="RutasAcceso"><a href="#" onclick="Home()" id="Ruta"></a></label>


    var newEtiqueta = document.createElement("label");
    newEtiqueta.setAttribute('id', "");
    //newEtiqueta.setAttribute('href', "#");
    newEtiqueta.setAttribute('onclick', "ExpandirDetalleA('" + Carpeta + "')");
    var currentDiv = document.getElementById("RutasAcceso");
    newEtiqueta.innerHTML = Carpeta + " ";
    //var newContent = document.createTextNode(Carpeta); 
    currentDiv.appendChild(newEtiqueta);
}

function EditarElemento(Carpeta) {
    var b = document.getElementById('RutasAcceso');
    var count = b.getElementsByTagName('a').length;
    if (count > 1) {
        for (var i = count - 1; i >= 1; i--) {
            var a = document.getElementById('RutasAcceso').getElementsByTagName('a')[i].innerHTML;
            var tam = a.length;
            var carpeta = a.substr(0, tam - 1);
            if (Carpeta == carpeta) {
                return carpeta;
            }
        }
    }
    return "";
}

function EliminarElemento(Carpeta) {
    if (document.getElementById('lbl' + Carpeta)) {
        var eliminado = document.getElementById('lbl' + Carpeta);
        eliminado.parentNode.removeChild(eliminado);
        var eliminado = document.getElementById(Carpeta);
        eliminado.parentNode.removeChild(eliminado);
    }

}

function EliminarElementosAdelante(CarpetaActual) {
    var b = document.getElementById('RutasAcceso');
    var count = b.getElementsByTagName('a').length;
    if (count > 1) {
        for (var i = count - 1; i >= 1; i--) {
            var a = document.getElementById('RutasAcceso').getElementsByTagName('a')[i].innerHTML;
            var tam = a.length;
            var carpeta = a.substr(0, tam - 1);
            alert(CarpetaActual + "=" + carpeta);
            if (CarpetaActual != carpeta) {
                EliminarElemento(carpeta);
            } else {
                i = 0;
            }
        }
    }
}

function EliminarElementos() {
    var b = document.getElementById('RutasAcceso');
    var count = b.getElementsByTagName('a').length;
    if (count > 1) {
        for (var i = count - 1; i >= 1; i--) {
            var a = document.getElementById('RutasAcceso').getElementsByTagName('a')[i].innerHTML;
            var tam = a.length;
            var carpeta = a.substr(0, tam - 1);
            EliminarElemento(carpeta);
        }
    }
}

function Mensajes() {
    if (document.getElementById('Creado')) {
        if (document.getElementById('Creado').innerHTML == '1') {
            swal({
                position: 'top-end',
                type: 'success',
                title: 'Portafolio creado con exito',
                showConfirmButton: false,
                timer: 1500
            })
            ListarArchivos();
        } else {
            swal({
                type: 'error',
                title: 'Oops...',
                text: 'Ya existe el portafolio'
            })
            Finalizar();
        }
    }

    if (document.getElementById('Editado')) {
        swal({
            position: 'top-end',
            type: 'success',
            title: 'Portafolio editado con exito',
            showConfirmButton: false,
            timer: 1500
        })

    }
    if (document.getElementById('EliminarDB')) {
        swal({
            position: 'top-end',
            type: 'success',
            title: 'Portafolio eliminado con exito',
            showConfirmButton: false,
            timer: 1500
        })

    }
}

function ValidarChk(Limit) {

    //recorre las carpetas que pinto segun el limite(esta en un div con el valor) de carpetas que halla
    for (i = 2; i <= Limit; i++) {
        if (document.getElementById('value' + i)) {
            if (document.getElementById('value' + i).innerHTML.trim() == "1") {
                document.getElementById('chk' + i).indeterminate = true;
            }
        }

    }
    //si no tiene mas carpetas definimos un  div con true   y mostramos una alerta
    if (document.getElementById('uno')) {
        if (document.getElementById('uno').innerHTML == 'true') {
            swal({
                type: 'error',
                title: 'Oops...',
                text: 'No hay mas  carpetas disponibles!'
            })
        }
    }
}

history.pushState(null, null, location.href);
window.onpopstate = function() {
    history.go(1);
};

function Home() {

    var parametros = {
        "btnHome": 'true',
        "NombrePortafolio": document.getElementById("NombrePortafolio").innerHTML.trim()
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {
            document.getElementById('TblArchivos').innerHTML = response;
            EliminarElementos();
            ValidarChk((document.getElementById('limit').innerHTML) - 1);
            DefinirRuta();
        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function Back() {

    var parametros = {
        "btnBack": 'true',
        "NombrePortafolio": document.getElementById("NombrePortafolio").innerHTML.trim()
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {

            document.getElementById('TblArchivos').innerHTML = response;
            ValidarChk((document.getElementById('limit').innerHTML) - 1);
            DefinirRuta();
        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function Check(id) {
    var parametros = {
        "checkBox": 'true',
        "nombreCarpeta": document.getElementById("lb" + id).innerHTML.trim(),
        "NombrePortafolio": document.getElementById("NombrePortafolio").innerHTML.trim(),
        "EstadoCheck": document.getElementById("chk" + id).checked
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {
            //document.getElementById("TblArchivos").innerHTML = response;
            document.getElementById("AñadirDetalles").style.visibility = "visible";
            document.getElementById("AñadirDetalles").style.display = 'inline';
        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });

}

function Agregar() {

    var ListaTerceros = document.getElementById('ListaTerceros');
    ListaTerceros.style.visibility = 'hidden';
    ListaTerceros.style.display = 'none';
    document.getElementById('div').classList.remove('col-lg-8');
    document.getElementById('div').classList.add('col-lg-12');
    var parametros = {
        "btnAgregar": 'true',
        "title": document.getElementById("title").value
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {
            document.getElementById('TblArchivos').innerHTML = response;
            document.getElementById('NombrePortafolio').innerHTML = document.getElementById("title").value;
            document.getElementById('AñadirDetalles').style.visibility = 'visible';
            document.getElementById('AñadirDetalles').style.display = 'inline';
            document.getElementById('CrearPortafolio').style.visibility = "hidden";
            document.getElementById('CrearPortafolio').style.display = 'none';
            document.getElementById('btnHome').style.display = 'inline';
            document.getElementById('btnHome').style.visibility = 'visible';
            document.getElementById('btnBack').style.display = 'inline';
            document.getElementById('btnBack').style.visibility = "visible";
            Mensajes();

        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}


function Finalizar() {
    //cuando cierre se le va mostrar el protafolio
    var parametros = {
        "btnFinalizar": 'true'
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {
            document.getElementById('TblArchivos').innerHTML = response;
            document.getElementById("AñadirDetalles").style.visibility = "hidden";
            document.getElementById("AñadirDetalles").style.display = 'none';
            document.getElementById('CrearPortafolio').style.visibility = "visible";
            document.getElementById('CrearPortafolio').style.display = 'inline';
            document.getElementById('btnHome').style.display = 'none';
            document.getElementById('btnHome').style.visibility = 'visible';
            document.getElementById('btnBack').style.display = 'none';
            document.getElementById('btnBack').style.visibility = "visible";
            document.getElementById('NombrePortafolio').innerHTML = "Portafolios";
            document.getElementById('ListaTerceros').style.visibility = 'visible';
            document.getElementById('ListaTerceros').style.display = 'inline';

            document.getElementById('div').classList.remove('col-lg-12');
            document.getElementById('div').classList.add('col-lg-8');
            document.getElementById('RutasAcceso').innerHTML = "";

            $("#FiltroPortafolio").css("display", "block");
            $("#FiltroPortafolio").val("");
        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function ListarTerceros() {
    var parametros = {
        "evtFiltrarTercero": 'true',
        "NomTercero": ""
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {
            document.getElementById('terceros').innerHTML = response;
        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function ListarTercero(id) {
    document.getElementById('informacion').innerHTML = "";
    var parametros = {
        "btnListarTercero": 'true',
        "idTercero": id
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {
            document.getElementById('informacion').innerHTML = response;
            document.getElementById('carga1').style = "display:none";
            document.getElementById('btnModal').style.display = 'none';
            $('#exampleModal').modal('show');
        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}
/*function FiltrarCliente(e) {
        //if (e.keyCode === 13 && !e.shiftKey || e == -1) {
        var parametros = {
                            "btnFiltrarTercero" : 'true',
                            "NomTercero" : document.getElementById('cliente').value
                        };
      $.ajax({
                            data:  parametros,
                            url:   '../Controller/PortafolioController.php',
                            type:  'post',
                            
                            success:  function (response) {

                               document.getElementById('terceros').innerHTML=response;
                            },
                            error: function (error) {
                            alert('error; ' + eval(error));
                            }
                    });
        //}
    }*/
function AlertCompartirPortafolio(NombreCliente, idTercero) {
    var idPortafolio = document.getElementById('IdPortafolio').innerHTML;
    var cantFotos = document.getElementById('notify' + idPortafolio).innerHTML;
    if (cantFotos > 0) {
        var nomPortafolio = document.getElementById('NamePortafolio' + idPortafolio).innerHTML;
        var fechaPortafolio = document.getElementById('fecha' + idPortafolio).innerHTML;

        swal({
            title: 'Está seguro de enviar el <br> portafolio: <b>' + nomPortafolio +
                '</b><br> al cliente: <b>' + NombreCliente + '</b>',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                EnviarPortafolio(idTercero, NombreCliente);
                $('#exampleModal').modal('show');
                document.getElementById('textArea').focus();

            }
        })
    } else {
        swal({
            type: 'error',
            title: 'Oops...',
            text: 'Sin fotos en el portafolio!!'
        })
    }

}

function EnviarPortafolio(idTercero, NombreCliente) {
    var idPortafolio = document.getElementById('IdPortafolio').innerHTML;
    var nomPortafolio = document.getElementById('NamePortafolio' + idPortafolio).innerHTML;
    var fechaPortafolio = document.getElementById('fecha' + idPortafolio).innerHTML;
    var cantFotos = document.getElementById('notify' + idPortafolio).innerHTML;
    document.getElementById('informacion').innerHTML = "";
    var parametros = {
        "btnEnviarPortafolio": 'true',
        "idCliente": idTercero,
        "idPortafolio": idPortafolio,
        "nomPortafolio": nomPortafolio,
        "fechaPortafolio": fechaPortafolio,
        "cantFotos": cantFotos,
        "nombreCliente": NombreCliente
    };
    $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',

        success: function(response) {
            document.getElementById('informacion').innerHTML = response;
            document.getElementById('carga1').style = "display:none";
            document.getElementById('btnModal').style.display = 'inline';


        },
        error: function(error) {
            alert('error; ' + eval(error));
        }
    });
}

function DescPortafolioTercero() {
    var idPortafolio = document.getElementById('IdPortafolio').innerHTML;
    var idRelacion = document.getElementById('idRelacion').innerHTML;
    var idVendedor = document.getElementById('vendedoresAsociados').value;

    if (document.getElementById('textArea').value.length != 0) {
        document.getElementById('error').style.display = 'none';
        $('#exampleModal').modal('hide');
        var txtArea = document.getElementById('textArea').value;
        var parametros = {
            "btnDescPortafolioTercero": 'true',
            "idPortafolio": idPortafolio,
            "txtArea": txtArea,
            "idRelacion": idRelacion,
            "idVendedor": idVendedor
        };
        $.ajax({
            data: parametros,
            url: '../Controller/PortafolioController.php',
            type: 'post',

            success: function(response) {
                //document.getElementById('TblArchivos').innerHTML = response;
                swal({
                    position: 'top-end',
                    type: 'success',
                    title: response,
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            error: function(error) {
                alert('error; ' + eval(error));
            }
        });
    } else {
        //document.getElementById('error').style.display='inline';
        $('body').css('padding-right', '0px');
        if ($('#textArea').hasClass('textAreadefault')) {
            $('#textArea').removeClass('placeholderdefault');
            $('#textArea').removeClass('textAreadefault');
            document.getElementById('error').style.display = 'inline';
            $('#textArea').addClass('placeholdererror');
            $('#textArea').addClass('textAreaerror');
        } else {
            $('#textArea').addClass('placeholdererror');
            document.getElementById('error').style.display = 'inline';
            $('#textArea').addClass('textAreaerror');
        }


        var clear = setInterval(function() {
            $('#textArea').removeClass('textAreaerror');
            document.getElementById('error').style.display = 'none';
            $('#textArea').removeClass('placeholdererror');
            $('#textArea').addClass('placeholderdefault');
            $('#textArea').addClass('textAreadefault');
            clearInterval(clear);
        }, 2000);

        $('#textArea').attr('data-toggle', "tooltip");
        $('#textArea').attr('data-placement', "top");
        $('#textArea').attr('title', "tooltip");

    }

}
function ValidarRestablecerPortafolio(){
        var intCodPortafolio=document.getElementById('IdPortafolio');
        Swal.fire({
          title: "¿Desea restablecer este portafolio "+intCodPortafolio.innerHTML.trim()+"?",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si',
          cancelButtonText: 'No'
        }).then((result) => {
          if (result.value) {
            RestablecerPortafolio();
          }
        })
}
function RestablecerPortafolio(){
    var intCodPortafolio=document.getElementById('IdPortafolio');
    var InfoPortafolio=document.querySelectorAll('span.box');
    for(var i=0;i<=InfoPortafolio.length-1;i++){
       InfoPortafolio[i].classList.remove('check-box');
       InfoPortafolio[i].classList.remove('check-indeterminate');
    }

    var parametros = {
            "CmdRestablecerPortafolio" : 'true',
            "intCodPortafolio" : intCodPortafolio.innerHTML.trim()
        };
        $.ajax({
            data: parametros,
            url: '../Controller/PortafolioController.php',
            type: 'post',
            success: function(response) {
                var JsonData=JSON.parse(response);
                if(JsonData['Success']){
                    swal(JsonData['Data']['strMensaje']);
                }else{
                    swal('Ocurrio un error comunicate con el area de sistemas.');
                }
            },
            error: function(error) {
                alert('error; ' + eval(error));
            }
        });
}


function ConsultarGestiones(idTercero){
    $('#tbodyGestion').html("");
    var parametros = {
            "ConsultarGestiones" : 'true',
            "IdTercero" : idTercero
        };
        $.ajax({
        data: parametros,
        url: '../Controller/PortafolioController.php',
        type: 'post',
        dataType: 'JSON',
        async: false,
        success: function(response) {
            $.each(response['gestiones'], function(index, item) {
                var tipo = '';
                if(item.intTipoGestion == 0){
                    tipo = 'Llamada';
                }else
                    if(item.intTipoGestion == 1){
                        tipo = 'Envío de fotos';
                    }else
                        if(item.intTipoGestion == 2){
                            tipo = 'Envío de portafolio';
                        }
                        else
                            if(item.intTipoGestion == 3){
                                tipo = 'Venta en sala';
                            }
                            else
                                if(item.intTipoGestion == 4){
                                    tipo = 'Venta en dash';
                                }
                                else
                                    if(item.intTipoGestion == 5){
                                        tipo = 'Visita a cliente';
                                    }
                                    else
                                        if(item.intTipoGestion == 6){
                                            tipo = 'Pos venta';
                                    }
                                    else
                                        if(item.intTipoGestion == 7){
                                            tipo = 'Deshabilitar';   
                                            }
                                            else
                                                if(item.intTipoGestion == 8){
                                                tipo = 'Varios';
                                            }else
                                                if(item.intTipoGestion == 9){
                                                tipo = 'TeleVenta'
                                            }
                var observacion = 'Sin observación';
                if(item.strObservacion != null && item.strObservacion != ''){
                    observacion = item.strObservacion;
                }
                $('#tbodyGestion').append(`
                    <tr>
                        <th scope="row" class="text-center">`+item.strNombreEmpleado+`</th>
                        <td class="text-center"><textarea style="width: 100%" rows="2" disabled>`+observacion+`</textarea></td>
                        <td class="text-center">`+tipo+`</td>
                        <td class="text-center">`+item.dtFechaGestion+`</td>
                    </tr>
                `)
                console.log(item);
            });
        },
        error: function(error) {
            console.log((error.responseText));
        }
    });
}

function GuardarGestion(){
        var parametros = {
            "btnGuardarObservacion" : 'true',
            "Observacion" : $('#observacionTercero').val(),
            "IdTercero" : $('#idTerceroModalObsv').html(),
            "TipoGestion" : $('#tipoGestion').val()
        };
        $.ajax({
            data: parametros,
            url: '../Controller/PortafolioController.php',
            type: 'post',
            async: false,
            success: function(response) {
                console.log(response);
                $('#observacionTercero').val("");
                ConsultarGestiones($('#idTerceroModalObsv').html());
            },
            error: function(error) {
                console.log((error.responseText));
            }
        });
    
}



/*Filtrar datos en la tabla de clientes
    document.querySelector("#cliente").onkeyup = function(){
        $TableFilter("#tabla", this.value);
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
    }*/
/*Filtrar datos en la tabla de clientes*/

/*$( function() {
   $( document ).tooltip();
 } );*/

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

let timerInterval
swal({
    title: 'Cargando...',
    html: 'Espere mientras carga la página.',
    timer: 4000,
    allowOutsideClick: false,
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

<?php 
 if (isset($_GET['idTercero']) && isset($_GET['nombreTercero'])) {
    echo "<script>
        OpenModal('ModalGestionCliente','".$_GET['idTercero']."', '".$_GET['nombreTercero']."');
    </script>";
}


if (isset($_SESSION['idportafolio'])) {
        echo "<script>
            ExpandirPortafolio(".$_SESSION['idportafolio'].");
        </script>";

        unset($_SESSION['idportafolio']);
    } ?>

<style type="text/css">
.placeholdererror::-webkit-input-placeholder {
    color: #a94442;
}

.textAreaerror {
    border-color: #a94442;
    background: #f2dede;
}

.placeholderdefault::-webkit-input-placeholder {
    color: #ccc;
}

.textAreadefault {
    border-color: #ccc;
    background: #FFFFFF;
}
</style>