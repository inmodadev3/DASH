<style>
#snackbar {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 90%;
    bottom: 30px;
    font-size: 17px;
}

#snackbar.hidden {
    visibility: hidden;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

#snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s;
    animation: fadein 0.5s;
}

@-webkit-keyframes fadein {
    from {
        bottom: 0;
        opacity: 0;
    }

    to {
        bottom: 30px;
        opacity: 1;
    }
}

@keyframes fadein {
    from {
        bottom: 0;
        opacity: 0;
    }

    to {
        bottom: 30px;
        opacity: 1;
    }
}

@-webkit-keyframes fadeout {
    from {
        bottom: 30px;
        opacity: 1;
    }

    to {
        bottom: 0;
        opacity: 0;
    }
}

@keyframes fadeout {
    from {
        bottom: 30px;
        opacity: 1;
    }

    to {
        bottom: 0;
        opacity: 0;
    }
}

.ir-arriba {
  display:none;
  padding:10px;
  height: 50px;
  z-index: 100000;
  width: 50px;
  background:#337ab7 ;
  font-size:20px;
  color:#fff;
  cursor:pointer;
  position: fixed;
  bottom:20px;
  right:20px;
  border-radius:100px;

}

.resaltar{
    border-color : #96c7f5; 
    background: #cae5ff;
}

.carousel-control{
    opacity: .1 !important;
}

.carousel-control:focus, .carousel-control:hover {
    opacity: .05 !important;
}
</style>

<div id="page-wrapper" style="min-height:100vh;">
    <span class="ir-arriba icon-arrow-up2 text-center" ><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></span>


    <!-- Modal Mover Fotos de carpeta -->
    <div class="modal fade bd-example-modal-lg" id="ModalMoveFiles" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <center>
                        <h5 class="modal-title" id="title-modal-mover">Modal title</h5>
                    </center>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-header">
                    <button type="button" class="btn btn-primary" onClick="MoverFotoDirectorio();">Mover</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="RutasAcceso">
                                <ol class="breadcrumb" id="rutasModalMover">
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="DirectorioMove">


                    </div>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </center>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <!-- Modal Mover Fotos de carpeta -->


    <!-- Modal carousel de fotos -->
    <div class="modal fade" id="ModalCarousel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <center>
                        <h4 class="modal-title" id="Titulo_Referencia_Modal"><b>Fotos</b></h4>
                    </center>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" id="elementsCarousel">

                                </div>

                                <!-- Left and right controls -->

                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onClick="ModalAgotado();">Agotar</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal carousel de fotos -->




    <!-- Toast para deshacer-->
    <div id="snackbar"><button onclick="AgotarReferencia(true)" class="btn btn-default">Deshacer</button></div>
    <div id="actualizar_guiones" style="display:none;"></div>
    <!-- Toast para deshacer-->



    <!-- Modal Agotados-->
    <div class="modal fade" id="ModalAgotado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <center>
                        <h5 class="modal-title" id="titulo"></h5>
                    </center>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="infoAgotado">
                        <div class="col-sm-6">
                            <div class="radio">
                                <label><input type="radio" name="optradio" id="optTodos">Total</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="radio">
                                <label><input type="radio" name="optradio" id="optGuion">Parcial</label>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="infoGuion" style="display: none;">
                        <div class="col-sm-4">
                            <div class="input-group" id="guiones">

                                <input type="number" id="guion1" class="form-control" placeholder="Guion"
                                    aria-describedby="basic-addon1"><br>
                                <div class="alert alert-danger" role="alert" style="display: none;" id="errorGuion1">
                                    Porfavor Digitar guion</div>


                            </div>
                        </div>
                        <div class="col-sm-2">
                            <center>
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary" onClick="AgregarGuion();"><span
                                            class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </center>

                        </div>
                        <div class="col-sm-6">
                            <center>
                                <form>
                                    <div class="form-group col-xs-12">
                                        <input type="file" name="fileNameModal" class="form-control" id="fileNameModal"><br>
                                        <div class="alert alert-danger" role="alert" style="display: none;"
                                            id="errorFileUpload">Porfavor seleccione la foto a cargar</div>
                                        <div class="alert alert-danger" role="alert" style="display: none;"
                                        id="errorNameFileUpload">El nombre de la foto no coincide</div>
                                    </div>
                                </form>
                            </center>

                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <center>
                        <div id="accion" style="display: none;"></div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="textBtnActModalAgotado"
                            onClick="AgotarValidar();">Guardar</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Agotados-->

    <!--modal agotados fotos subida-->
    <div class="modal fade" id="ModalAgotadoDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <center>
                        <h5 class="modal-title" id="titulo"></h5>
                    </center>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="infoGuion">
                        <div class="col-sm-6">
                            <div class="input-group" id="guiones1">


                            </div>
                        </div>
                        <div class="col-sm-6">
                            <center>
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary" onClick="AgregarGuionCargaFoto();"><span
                                            class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </center>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <center>
                        <div id="accion" style="display: none;"></div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="textBtnActModalAgotado" onClick="AgotarValidar();">Actualizar</button>
                        <button type="button" class="btn btn-primary" id="textBtnActModalAgotado" onClick="CargarFoto();">Modificar solo foto</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <!--modal agotados fotos subida-->
    <div class="row">
        <div class="col-lg-12 align-self-center" id="div">
            <br>
            <div class="row" style="">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="text" id="txtFiltro" placeholder="Filtrar" onkeyup="Filtrar();"
                                class="form-control" aria-label="...">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <form>
                            <div class="form-group col-xs-12">
                                <label>Adjuntar imagenes</label>
                                <input type="file" name="fileName" multiple="true" class="form-control" id="fileName">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <center>
                            <button type="button" class="btn btn-primary" id="btnCargarFotos"
                                onClick="CargarFotos();"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span></button>
                            <button type="button" style="display: none;" class="btn btn-primary" id="btnMover"
                                onClick="MoverFotos();">Mover</button>
                            <button type="button" style="display: none;" class="btn btn-primary" id="btnAgotarCheck" onClick="AgotarListaReferencias();">Agotar</button>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" style="color: black" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li style="cursor: pointer;"><a onClick="CheckAll();">Seleccionar todos</a></li>
                                    <li style="cursor: pointer;"><a onClick="SelectInvertida();">Seleccion Invertida</a></li>
                                </ul>
                        
                            </div>

                            <!--<button type="button" class="btn btn-primary" id="btnCHeckAll"
                            onClick="CheckAll();">Seleccionar todos</button>
                            <button type="button" class="btn btn-primary" id="btnSelectInvertida"
                            onClick="SelectInvertida();">Seleccion Invertida</button>-->
                            <div style="display:none;" id="referencias_mover">
                            </div>
                        </center>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <br>
                        <div class="panel panel-default">
                            <div class="panel-heading text-center" id="prueba">
                                <div id="RutasAcceso">
                                    <ol class="breadcrumb" id="breadcrumb">
                                    </ol>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div id="TblArchivos">


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
AbrirCarpeta();


$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });
  $('.ir-arriba').click(function(){
    $('body, html').animate({
      scrollTop: '0px'
    }, 300);
  });
  $(window).scroll(function(){
    if( $(this).scrollTop() > 0 ){
      $('.ir-arriba').slideDown(300);
    } else {
      $('.ir-arriba').slideUp(300);
    }
  });


// --------------------- ---------------------- SECCION VISTA HTML ----------------- ----------------------

//La ruta comienza con / y termina sin /
function AbrirCarpeta(ruta = "", id = "TblArchivos", filtrar = -1, word = "", referenciaResaltar = "") {
    //alert(referenciaResaltar);
    //console.log(referenciaResaltar);
    $('#' + id).html("");
    var view = "";
    var parametros = {
        "home": 'true',
        "ruta": ruta,
        "filtro": filtrar,
        "word": word
    };
    let request = $.ajax({
        data: parametros,
        url: '../Controller/AgotadosController.php',
        type: 'post',
        dataType: 'JSON',
        async: false,
        success: function(response) {
            //console.log(response);
            $.each(response, function(index, item) {
                //Mostramos la ruta en la que esta

                Breadcrumbs(item, id);


                if (filtrar == -1) {
                    view += VistaCarpetasSinFiltro(item, id);
                } else {
                    view += VistaCarpetasConFiltro(item, id);
                }

                //Pintamos las carpetas

                if (id == "TblArchivos") {

                    $('#referencias_mover').html("");
                    $('#btnMover').css("display", "none");
                    if (filtrar == -1) {
                        //Pintamos las fotos sin filtro
                        view += VistaFotosSinFiltro(item, referenciaResaltar);


                    } else {
                        view += VistaFotosConFiltro(item);
                    }


                    //Agregamos fotos al carousel
                    if(filtrar == -1){
                        ModalCarousel(item.fotos);
                    }
                    
                }




            })
            //Agregamos html
            if (id == "TblArchivos" && view == "") {
                if(filtrar != -1){
                    //alert(referenciaResaltar);
                    view = '<div class="row">' +
                    "<div class='col-sm-12')'>" +
                    '<a href="#" class="thumbnail"><img src="../Images/sin-resultados.png" alt="..."></a>'+
                    '</div>';
                }else{
                    //alert(referenciaResaltar);
                    view = '<div class="row">' +
                    "<div class='col-sm-12')'>" +
                    '<a href="#" class="thumbnail"><img src="../Images/carpeta-vacia.png" alt="..."></a>'+
                    '</div>';
                }
                    
                
            }
            $('#' + id).append(view);
            /*if(referenciaResaltar != ""){
                $('#TblArchivos div:first-child').before($('#'+referenciaResaltar));
            }*/
        },
        error: function(error) {
            console.log(error.responseText);
        }
    });
}

function VistaCarpetasSinFiltro(item, id) {
    let view = "";
    $.each(item.carpetas.split("/"), function(index, carpeta) {
        //console.log(item);
        if (carpeta != "") {
            var ruta = "/" + item.ruta + "/" + carpeta;
            ruta = ruta.replace("//", "/");
            view += '<div class="col-sm-2">' +
                '<div class="image" style="cursor: pointer; overflow: hidden; display: inline-block; height: 160px; width: 100px; margin: 10px; text-align: center;" onclick="AbrirCarpeta(\'' +
                ruta + '\', \'' + id + '\');">' +
                "<div style='width: 100px; height: 100px; background-size: cover; background-position: center; background-image: url(\"../Images/carpeta.png\");'>" +
                "<!--<img src='../Images/carpeta.png' style='height: 100px; '>-->" +
                "</div>" +
                "<label style='width:100px; overflow:hidden;'>" + carpeta +
                "</label>" +
                '</div>' +
                "</div>";
        }
    })
    return view;
}

function VistaCarpetasConFiltro(item, id) {
    let view = "";
    $.each(item.carpetas.split("*"), function(index, item) {
        //console.log(item);
        vectCarpetas = item.split(":");
        carpeta = vectCarpetas[0];
        ruta = vectCarpetas[1];
        if (carpeta != "") {
            ruta = ruta.replace("//", "/");
            view += '<div class="col-sm-2">' +
                '<div class="image" style="cursor: pointer; overflow: hidden; display: inline-block; height: 160px; width: 100px; margin: 10px; text-align: center;" onclick="AbrirCarpeta(\'' +
                ruta + '\', \'' + id + '\');">' +
                "<div style='width: 100px; height: 100px; background-size: cover; background-position: center; background-image: url(\"../Images/carpeta.png\");'>" +
                "<!--<img src='../Images/carpeta.png' style='height: 100px; '>-->" +
                "</div>" +
                "<label style='width:100px; overflow:hidden;' title='" + ruta + "'>" + carpeta +
                "</label>" +
                '</div>' +
                "</div>";
        }
    })
    return view;
}

function VistaFotosSinFiltro(item, referenciaResaltar) {
    //alert(referenciaResaltar);
    let view = "";
    //let array = item.fotos.split("/");
    let array = item.fotos;
    //console.log(array);
    //let array2 = array.split("_");
    $.each(array, function(index, item) {
        console.log(item);
        //item = item.split("_");
        
        let visible = "hidden";
        let referencia = item[0];
        let classBtn = "primary";
        let textBtn = "Agotar";
        let backgroundP = "";
        let backgroundT1 = "";
        let backgroundT2 = "";
        let backgroundA = "";
        let resaltar = "";
        let visibleGuionAgotado = "";
        if(item[2] != -1)
            visible = "hidden";
        else{
            visible = "visible";
            item[2] = "Sin descripcion";
        }
            
        item[1] == 1 ? visibleGuionAgotado = "visible" : visibleGuionAgotado = "hidden";//Validar si esta no no agotado
        item[3] == 1 ? backgroundP = "background: #E86565;" : backgroundP = "";
        item[4] == 1 ? backgroundT1 = "background: #E86565;" : backgroundT1 = "";
        item[5] == 1 ? backgroundT2 = "background: #E86565;" : backgroundT2 = "";
        item[6] == 1 ? backgroundA = "background: #E86565;" : backgroundA = "";

        if(Array.isArray(referenciaResaltar)){
            var id = referenciaResaltar.indexOf(referencia);
            if(id != -1){
                resaltar = "resaltar";
            }else{
                resaltar = "";
            }
        }else{
            referenciaResaltar == referencia ? resaltar = "resaltar" : resaltar = "";
        }
        

        
        var d = new Date();
        var n = d.getMilliseconds() +""+ d.getDay() +""+ d.getMinutes() +""+ d.getSeconds();
        if (item[0] != "") {
            view += '<div class="col-sm-3" id=' + referencia + '>' +
                '<div class="thumbnail '+resaltar+'">' +
                '<img src="../../../ownCloud/fotos_nube/' + referencia +
                '.jpg?nocache='+n+'" alt="..."  style="height: 164px;" onClick="OpenModal(\'' + referencia +
                '\');">' +
                '<div class="caption">' +

                '<div class="row">' +
                '<div class="col-sm-12">' +
                '<h4>' + referencia + '</h4>' +
                '</div>' +
                '<div class="col-sm-12" style="height: 50px;">' +
                '<p>' + item[2] + '</p>' +
                '<p>Fecha: ' + item[7] + '</p>' +
                '</div>' +
                '</div>' +

                '<div class="row">' +
                '<div class="col-sm-10">' +

                '</div>' +
                '<div class="col-sm-2">' +
                '<div class="input-group">' +
                '<input type="checkbox" id="chk' + referencia + '" onclick="HabilitarBtnMover(\'' +
                referencia + '\', this.id);">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="row">' +

                '<div class="col-sm-4">' +
                    
                    '<div class="btn-group">' +
                        '<button type="button" class="btn btn-default dropdown-toggle" style="color: black" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                        '<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>' +
                        '</button>' +
                        '<ul class="dropdown-menu">' +
                            '<li><a onclick="ModalAgotado(\'' + referencia + '\');" style="cursor: pointer;" title="Agotar la referencia '+referencia+'" ><span class="glyphicon glyphicon-send" aria-hidden="true"></span></a></li>' +
                            '<li><a href="../Controller/AgotadosController.php?archivo='+referencia+'.jpg&ruta='+TransformarRutaParaView()+'" title="Descargar foto" ><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a></li>' +
                            '<li><a onclick="EliminarReferencia(\'' + referencia + '\');" style="cursor: pointer;" title="Eliminar foto" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></li>' +
                        '</ul>' +
                        
                    '</div>' +
                    
                '</div>' +
                '<div class="col-sm-4">' +
                
                    '<div class="btn-group">' +
                    '<button type="button" class="btn btn-default dropdown-toggle" style="color: red" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                    '<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>' +
                    '</button>' +
                    '<ul class="dropdown-menu">' +
                    '<li><a style="cursor: pointer; ' + backgroundP + '" id="backP' + referencia +
                    '" onclick="GestionPromocionTendencia(\'' + referencia +
                    '\', \'PROMOCIONES\', this.id)">Promociones</a></li>' +
                    '<li><a style="cursor: pointer; ' + backgroundT1 + '" id="backT1' + referencia +
                    '" onclick="GestionPromocionTendencia(\'' + referencia +
                    '\', \'TENDENCIA ACTUAL\', this.id)">Tendencia Actual</a></li>' +
                    '<li><a style="cursor: pointer; ' + backgroundT2 + '" id="backT2' + referencia +
                    '" onclick="GestionPromocionTendencia(\'' + referencia +
                    '\', \'TENDENCIA PROXIMA\', this.id)">Tendencia Proxima</a></li>' +
                    '<li><a style="cursor: pointer; ' + backgroundA + '" id="backA' + referencia +
                    '" onclick="GestionPromocionTendencia(\'' + referencia +
                    '\', \'ACTUALIZACIONES\', this.id)">ACTUALIZACIONES</a></li>' +
                    '</ul>' +
                '</div>' +



                '</div>' +
                '<div class="col-sm-2">' +
                '<center>'+
                '<span class="glyphicon glyphicon-warning-sign" title="La referencia tiene guiones agotados" aria-hidden="true" style="color: #d9534f; visibility: ' +
                visibleGuionAgotado + '"></span>' +
                '</center>'+
                '</div>' +
                '<div class="col-sm-2">' +
                '<span class="glyphicon glyphicon-exclamation-sign" title="La referencia no se encuentra en la base de datos" aria-hidden="true" style="color: #d9534f; visibility: ' +
                visible + '"></span>' +
                '</div>' +

                '</div>' +

                '</div>' +
                '</div>' +
                '</div>';

        }

        //console.log(item[0]);
    })
    return view;
}

function VistaFotosConFiltro(item) {
    let view = "";

    $.each(item.fotos.split("//"), function(index, item) {
        //console.log(item);
        item = item.split(":");
        let visible = "hidden";
        let referencia = item[0];
        item[2] != -1 ? visible = "hidden" : visible = "visible";
        var d = new Date();
        var n = d.getMilliseconds();
        //Validar si esta no no agotado
        if (referencia != "") {
            view += '<div class="col-sm-3" id=' + index + ' onclick="IrDestinoFoto(this.id, \'' + referencia +
                '\', \'' + item[1] + '\');">' +
                '<div class="thumbnail" >' +
                '<img src="../../../ownCloud/fotos_nube/' + referencia +
                '.jpg?nocache='+n+'" alt="..."  style="height: 164px;">' +
                '<div class="caption">' +

                '<div class="row">' +
                '<div class="col-sm-12">' +
                '<h4>' + referencia + '</h4>' +
                '</div>' +
                '<div class="col-sm-12" style="height: 40px;">' +
                '<p>' + item[2] + '</p>' +
                '</div>' +
                '</div>' +

                '<div class="row">' +
                '<div class="col-sm-10" style="height: 50px;">' +
                '<div>' + item[1] + '</div>' +
                '</div>' +
                '<div class="col-sm-2">' +
                '<span class="glyphicon glyphicon-exclamation-sign" title="La referencia no se encuentra en la base de datos" aria-hidden="true" style="color: #d9534f; visibility: ' +
                visible + '"></span>' +

                '</div>' +

                '</div>' +

                '</div>' +

                '</div>' +
                '</div>' +
                '</div>';

        }


        //console.log(item[0]);
    })
    return view;
}

function IrDestinoFoto(id, referencia, rutaSecundaria) {
    //let rutaSecundaria = $('#'+id+' .caption div:last-child div:first-child div').html();
    let rutaPrincipal = ObtenerRuta();
    let rutaCompleta = rutaPrincipal.replace(":", "/");
    rutaCompleta = rutaCompleta.substring(0, rutaCompleta.length - 1) + rutaSecundaria;
    rutaCompleta = rutaCompleta.replace("//", "/").replace("HOME", "");
    rutaCompleta = rutaCompleta.substring(0, rutaCompleta.length - 1);
    rutaCompleta = rutaCompleta.replace(/:/g, "/");
    rutaCompleta = rutaCompleta.replace("//", "/");
    AbrirCarpeta(rutaCompleta, "TblArchivos", -1, "", referencia);

    find(referencia);
    
    //ruta = "", id = "TblArchivos", filtrar=-1, word=""
    //alert(rutaCompleta);
}
// --------------------- ---------------------- SECCION VISTA HTML ----------------- ----------------------

//---------------------- ---------------------- Modal carousel ---------------------- ---------------------
$('.carousel').carousel({
    interval: 0
})

function EstablecerTituloModal(){
    let ref = $('#elementsCarousel .active .carousel-caption h3').html();
    $('#Titulo_Referencia_Modal').html("<b>"+ref+"</b>");
}

$('#myCarousel').on('slid.bs.carousel', function () {
    EstablecerTituloModal();
})

function OpenModal(referencia) {
    $("#" + referencia).addClass("active");
    EstablecerTituloModal();
    $("#ModalCarousel").modal('show');
}

$('#myCarousel').on('hidden.bs.carousel', function() {

})
$('#ModalCarousel').on('hidden.bs.modal', function(e) {
    $(".item").removeClass("active");

})

function ModalCarousel(vectReferencias) {
    $("#elementsCarousel").html("");
    var view = '';
    var d = new Date();
    var n = d.getMilliseconds();
    $.each(vectReferencias, function(index, item) {
        //item = item.split("_");
        if (item != "") {
            $("#elementsCarousel").append(
                '<div class="item" id="' + item[0] + '">' +
                '<img src="../../../ownCloud/fotos_nube/' + item[0] + '.jpg?nocache='+n+'" alt="In Moda Fanstasy">' +
                '<div class="carousel-caption">' +
                ' <h3 id="idReferenciaModal" style="display: none;">' + item[0] + '</h3>' +
                '</div>' +
                '</div>');
        }

    });
    //$("#elementsCarousel").append(view);

}

//---------------------- ---------------------- Modal carousel ---------------------- ---------------------

//---------------------- -----------------Ruta de actual de las fotos -------------------------------------
function Breadcrumbs(item, id) {
    if (id == "TblArchivos") {
        idBreadcrumbs = "breadcrumb";
    } else {
        idBreadcrumbs = "rutasModalMover";
    }
    let breadcrumb = '<li><a onclick="AbrirCarpeta(\'\',\'' + id + '\')" style="cursor: pointer;">HOME</a></li>';
    let ruta = "/";
    let vectorRuta = item.ruta.split("/");
    vectorRuta.pop();
    $.each(vectorRuta, (index, item) => {
        ruta += "/" + item;
        ruta = ruta.replace(",", "/");
        ruta = ruta.replace("//", "/")
        breadcrumb += '<li><a onclick="AbrirCarpeta(\'' + ruta + '\', \'' + id +
            '\')" style="cursor: pointer;">' +
            item + '</a></li>';
    });
    $("#" + idBreadcrumbs).html(breadcrumb);

}

function ObtenerRuta(id = "breadcrumb") {
    let childrens = $('#RutasAcceso .breadcrumb').children();
    let rpta = "";
    $("#RutasAcceso #" + id + " li a").each(function() {
        rpta += $(this).html() + ":";
    });
    /*$.each(childrens, (index, value)=>{
        rpta += $('#RutasAcceso .breadcrumb li a').html()+" ";
    });*/
    return rpta;
}
//---------------------- -----------------Ruta de actual de las fotos -------------------------------------


// ---------------------- ---------------------- SECCION AGOTADOS  ------------------------------ ----------------------
$("#optGuion").click(() => {
    $("#infoGuion").css("display", "inline");
    let cant = $('#guiones .row .col-sm-8 input:last').attr('id');
    if (cant === undefined) {
        AgregarGuion();
    }
    if ($('#accion').html() == "0") {
        $('#textBtnActModalAgotado').html("Agotar guiones");
    } else {
        $('#textBtnActModalAgotado').html("Actualizar");
    }
});

$("#optTodos").click(() => {
    $("#infoGuion").css("display", "none");
    /*if ($('#accion').html() == "0") {
        $('#textBtnActModalAgotado').html("Agotar");
    } else {
        $('#textBtnActModalAgotado').html("Sacar de agotados");
    }*/
    $('#textBtnActModalAgotado').html("Agotar");
});

function ModalAgotado(id) {
    //si es nulo es porque fue activado desde el carousel
    if (id == null) {
        id = $(".active h3").html();
        $("#ModalCarousel").modal('hide');
    }
    $('input[name="optradio"]').prop('checked', false);
    $('input[id="optTodos"]').prop('checked', true);
    $("#infoGuion").css("display", "none");
    $('#ModalAgotado').modal('show');

    $('#optTodos').attr("checked");
    $('#guiones').html("");
    $("#titulo").html(id);

        //Consultar si tiene guiones agotados si lo hay piintar los campos
        ConsultarGuionesAgotados(id);
    
}

//Confirmacion para agotar la referencia
function AgotarValidar() {
    Swal.fire({
        title: 'Estas seguro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Agotar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            if ($("#infoGuion").css("display") == "inline") {
                if (ValidarCamposGuiones()) {

                    $('#errorFileUpload').css("display", "none");
                    $('#errorNameFileUpload').css("display", "none");
                    if ($('#fileNameModal')[0].files.length != 0) {
                        let archivo_subir = document.getElementById('fileNameModal').files[0].name;
                        archivo_subir = archivo_subir.replace(".JPG", "").replace(".jpg", "");
                        if(archivo_subir === $('#titulo').html()){
                            if ($('#accion').html() == "0") {
                                //Agotar guiones de la referncia ok
                                AgotarReferencia(false);
                                CargarFotoGuionesActualizados();
                                $('#ModalAgotado').modal('hide');
                                let ruta = TransformarRutaParaView();
                                AbrirCarpeta(ruta);
                            } else {
                                //actualizar guiones de la referencia
                                AgotarReferencia(false, "actualizar");
                                //ActualizarGuionesAgotados();
                                CargarFotoGuionesActualizados();
                                $('#ModalAgotado').modal('hide');
                                let ruta = TransformarRutaParaView();
                                AbrirCarpeta(ruta);
                            }     
                        }else{
                            $('#errorNameFileUpload').css("display", "inline-block");
                        }
                        
                    } else {
                        $('#errorFileUpload').css("display", "inline-block");
                    }
                }
            } else {
                AgotarReferencia(false, "", 1);
                $('#ModalAgotado').modal('hide');
                let ruta = TransformarRutaParaView();
                AbrirCarpeta(ruta);
            }

        }
    })

}

function AgotarReferencia(deshacer, actualizar = "", total = -1, referencia = "") {
    let ruta = ObtenerRuta();
    let guiones;
    if(referencia == ""){
        referencia = $('#titulo').html();
    }
    if(total == 1){
        guiones = -1;
    }else{
        guiones = ValidarCamposGuiones(1);
    }
    if(deshacer == true){
        if($('#actualizar_guiones').html() == 1){
            actualizar="actualizar";
        }else{
        }
    }
    var parametros = {
        "actAgotarReferencia": 'true',
        "referencia": referencia,
        "guion": guiones,
        "ruta": ruta,
        "deshacer": deshacer, 
        "actualizar" : actualizar
    }
    $.ajax({
        data: parametros,
        url: '../Controller/AgotadosController.php',
        type: 'post',
        dataType: 'JSON',
        async: false,
        success: function(response) {
            //console.log("response 1");
            console.log(response);
            $('#actualizar_guiones').html(0);
            if(actualizar == "actualizar"){
                //OK
                //alert($('#actualizar_guiones').html());
                $('#actualizar_guiones').html(1);
                //voy aca revisar
                $.each(response[0].datos, (index, item) => {
                    console.log(item + "  pos: "+index);
                });
            }else{
                //OK
                $.each(response, (index, item) => {
                if (guiones != -1) {
                    
                    console.log(item);
                    $.each(item.datos.split(":"), (index, valor) => {
                        console.log(valor);
                        if (valor != "") {
                            if (valor != 1) {
                                //Hubo un error en la base de datos
                                //console.log(valor);
                                Swal.fire({
                                    position: 'top-end',
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Algo salio mal!'
                                })
                            } else {
                                let id = "#TblArchivos #" + $('#titulo').html();
                                //Mostramos el icono de agotado
                                if (deshacer == true) {
                                    $(id).css('display', 'inline-block');
                                } else {
                                    $(id).css('display', 'none');
                                }

                            }
                        }

                    });
                } else {
                    console.log(item);
                    if (item < 1) {
                        console.log("Hubo un error en la DB... " + item);
                        Swal.fire({
                            position: 'top-end',
                            type: 'error',
                            title: 'Oops...',
                            text: 'Algo salio mal!'
                        })
                    } else {
                        let id = "#TblArchivos #" + $('#titulo').html();
                        //ocultamos foto
                        if (deshacer == true) {
                            $(id).css('display', 'inline-block');
                        } else {
                            $(id).css('display', 'none');
                        }
                    }
                }
            });
            }
               
        },
        error: function(error) {
            console.log(error.responseText);
        }
    });
    if(deshacer != true && referencia == ""){
        SnackbarAgotado(deshacer);
    }
}

function AgotarListaReferencias(){
    let referncias = $('#referencias_mover').html().trim();
    let array = referncias.split("*");
    array.pop();

    Swal.fire({
        title: 'Estas seguro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Agotar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            array.forEach(element => {
                AgotarReferencia(false, "", 1, element);
            });
            let ruta = TransformarRutaParaView();
            AbrirCarpeta(ruta);
        }
    })
}

function EliminarReferenciaAgotada() {
    let referencia = $('#titulo').html();
    var parametros = {
        "EliminarReferenciaAgotada": 'true',
        "referencia": referencia
    }
    $.ajax({
        data: parametros,
        url: '../Controller/AgotadosController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(response) {
            $.each(response, (index, item) => {
                if (item.datos[0]["rpta"] == "1") {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Agotado eliminado',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#' + referencia + ' .thumbnail .caption div:last-child div:first-child .btn')
                        .removeClass("btn-danger");
                    $('#' + referencia + ' .thumbnail .caption div:last-child div:first-child .btn')
                        .addClass("btn-primary");
                    $('#' + referencia + ' .thumbnail .caption div:last-child div:first-child .btn')
                        .html("Disponible");
                }
            });
        },
        error: function(error) {
            console.log(error.responseText);
        }
    });
}

function ActualizarGuionesAgotados() {
    let guiones = ValidarCamposGuiones(1);
    let ruta = ObtenerRuta();
    var parametros = {
        "ActualizarGuionesAgotados": 'true',
        "referencia": $('#titulo').html(),
        "guiones": guiones
    }
    $.ajax({
        data: parametros,
        url: '../Controller/AgotadosController.php',
        type: 'post',
        dataType: 'JSON',
        success: function(response) {
            console.log(response);
            $.each(response, (index, item) => {
                if (item.datos[0]["rpta"]) {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Agotado eliminado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        },
        error: function(error) {
            console.log(error.responseText);
        }
    });
}
//-----------------------------------------------------VALIDACION DE GUIONES--------------------------------------
function ValidarCamposGuiones(opt = 0) {
    let cant = $('#guiones').children().length;
    let rpta = "";

    if (cant > 0) {
        for (let i = 1; i <= cant; i++) {
            if (opt == 0) {
                if ($('#guiones #' + i + ' .col-sm-8 #guion' + i).val() == '') {
                    $('#errorGuion' + i).css("display", "inline-block");
                    return false;
                } else {
                    //console.log($('#guiones #' + i + ' .col-sm-8 #guion' + i).val());
                    $('#errorGuion' + i).css("display", "none");
                }
                rpta = true;
            } else {
                rpta += $('#guiones #' + i + ' .col-sm-8 #guion' + i).val() + ":";
            }
        }
    } else {
        rpta = -1;
    }

    return rpta;
}

function ValidarCamposGuionesCargaFotos(opt = 0) {
    let cant = $('#guiones1').children().length;
    let rpta = "";

    if (cant > 0) {
        for (let i = 1; i <= cant; i++) {
            if (opt == 0) {
                if ($('#guiones #' + i + ' .col-sm-8 #guion' + i).val() == '') {
                    $('#errorGuion' + i).css("display", "inline-block");
                    return false;
                } else {
                    $('#errorGuion' + i).css("display", "none");
                }
                rpta = true;
            } else {
                rpta += $('#guiones #' + i + ' .col-sm-8 #guion' + i).val() + ":";
            }
        }
    } else {
        rpta = -1;
    }

    return rpta;
}




//-----------------------------------------------------VALIDACION DE GUIONES--------------------------------------
function AgregarGuion(value = "") {
    let cant = $('#guiones .row .col-sm-8 input:last').attr('id');
    if (cant === undefined) {
        cant = 1;
    } else {
        cant = cant.replace("guion", "");
        cant++;
    }
    let view = '<div class="row" id=' + cant + '>' +
        '<div class="col-sm-8">' +
        '<input type="text" id="guion' + cant +
        '" class="form-control" placeholder="Guion"  aria-describedby="basic-addon1" min="0" value=' + value + '>' +
        '<div class="alert alert-danger" role="alert" style="display: none;" id="errorGuion' + cant + '">' +
        'Porfavor Digitar guion</div>' +
        '</div>' +
        '<div class="col-sm-4">' +
        '<button type="button" class="btn btn-danger" onClick="EliminarGuion(' + cant + ');">' +
        '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>' +
        '</div>' +
        '</div>';
    $("#guiones").append(view);
}

function AgregarGuionCargaFoto(value = "") {
    let cant = $('#guiones1 .row .col-sm-8 input:last').attr('id');
    if (cant === undefined) {
        cant = 1;
    } else {
        cant = cant.replace("guion", "");
        cant++;
    }
    let view = '<div class="row" id=' + cant + '>' +
        '<div class="col-sm-8">' +
        '<input type="number" id="guion' + cant +
        '" class="form-control" placeholder="Guion"  aria-describedby="basic-addon1" min="0" value=' + value + '>' +
        '<div class="alert alert-danger" role="alert" style="display: none;" id="errorGuion' + cant + '">' +
        'Porfavor Digitar guion</div>' +
        '</div>' +
        '<div class="col-sm-4">' +
        '<button type="button" class="btn btn-danger" onClick="EliminarGuion(' + cant + ');">' +
        '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>' +
        '</div>' +
        '</div>';
    $("#guiones1").append(view);
}

function ConsultarGuionesAgotados(referencia, modal = 0) {
    var view = "";
    var parametros = {
        "ConsultarGuiones": 'true',
        "referencia": referencia
    };
    $.ajax({
        data: parametros,
        url: '../Controller/AgotadosController.php',
        type: 'post',
        dataType: 'JSON',
        async: false,
        success: function(response) {
            console.log(response);
            $.each(response[0].datos, (index, item) => {
                if(item[0] != -1 && item[0] != 0){
                    if(modal == 0){ //se muestran guiones para actualizar
                        AgregarGuion(item['strDescripcion']);
                    }else{ // se muestran guiones para actualizar carga de fotos
                        AgregarGuionCargaFoto(item['strDescripcion']);
                    }
                    // definimos que ya esta agotado
                    $('#accion').html(1);
                }else{
                    $('#accion').html(0);
                }
                
            });
        },
        error: function(error) {
            console.log(error.responseText);
        }
    });
}

function EliminarGuion(id) {
    $('#' + id).remove();
}

function SnackbarAgotado(visible) {
    if (!visible) { //Mostrar
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function() {
            x.className = x.className.replace("show", "hidden");
        }, 7000);
    } else { //Ocultar
        var x = document.getElementById("snackbar");
        x.className = "hidden";
        x.className = x.className.replace("show", "hidden");
    }

}
// ---------------------- ---------------------- SECCION AGOTADOS  ------------------------------ ----------------------

// ---------------------- ----------------------  SECCION UPLOAD FILE ---------------------- ---------------------------
function CargarFotos(id = "fileName") {
    //console.log(document.getElementById("fileName").files);
    var fotosParaReemplazar = new Array();
    var fotosResaltar = new Array();
    //console.log($('#' + id)[0].files);
    if ($('#' + id)[0].files.length != 0) {
        $.each($('#' + id)[0].files, (index, value) => {
            let referencia = value['name'].replace(".jpg", "");
            fotosResaltar.push(referencia);
            var view = "";
            var Data = new FormData();
            Data.append("btnCargarFotos", "true");
            Data.append("ruta", ObtenerRuta());
            Data.append('File', value);
            $.ajax({
                url: "../Controller/AgotadosController.php",
                type: "post",
                data: Data,
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                success: function(response) {
                    console.log(response);
                    // 1: bien // -1: error // 0: formato errado // 2: ya existe el archivo
                    if (response == -1) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Hubo un error'
                        })
                    } else if (response == '0') {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'El archivo no tiene el formato correcto (' + value[
                                'name'] + ')'
                        })
                        console.log(value);
                    } else if (response == '2') {
                        //alert("existe la referencia: "+value['name']+" index: "+index);
                        fotosParaReemplazar.push([$('#' + id)[0].files[index],0]);

                    } else if (response == 3) {
                        fotosParaReemplazar.push([$('#' + id)[0].files[index],1]);
                        /*$("#ModalAgotadoDetalle").modal('show');
                        ConsultarGuionesAgotados(referencia, "1");*/
                    } else if (response == 1) {
                        //alert("se cargo la foto "+value['name']);
                    }
                },
                error: function(error) {
                    console.log(error.responseText);
                }
            });
        });
        if (fotosParaReemplazar.length > 0) {
            ObjetoRecursivo(fotosParaReemplazar, 0);
        }
        let ruta = TransformarRutaParaView();
        AbrirCarpeta(ruta, "TblArchivos", -1, "", fotosResaltar);
        //find(fotosResaltar[1]);
    } else {
        Swal.fire(
            'Por favor seleccione los archivos a cargar'
        )
    }

}

//Vrerifica por cada foto que ya exista en el encarpetado
function ObjetoRecursivo(objeto, index, mostrarModal = true, opcionBtn = true) {
    //console.log(objeto);
    var info = "";
    var check = "";
    if(objeto.length > 1){
        check =  '<div class="form-check"> ' +
                    '<input type="checkbox" class="form-check-input" id="chkVerificacion">' +
                    '<label class="form-check-label" for="chkVerificacion"> Hacer esto para los ' + objeto
                    .length + '</label>' +
                    '</div>"';
    }
    if (index <= objeto.length) {
        if (mostrarModal) {
            if(objeto[index][1] == 1){
                info = '<strong style="color: red;">Esta referencia tiene guiones agotados!!!!</strong>';
            }
            Swal.fire({
                title: 'Quieres reemplazar la foto ' + objeto[index][0]['name'] + '?',
                html: info+ check,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Reemplazar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if ($('#chkVerificacion').is(':checked')) {
                    mostrarModal = false;
                }
                if (result.value) {
                    ReemplazarFoto(objeto[index][0]);
                }else{
                    opcionBtn = false;
                }

                ObjetoRecursivo(objeto, index + 1, mostrarModal, opcionBtn);

            })
        } else {
            if(opcionBtn){
                ReemplazarFoto(objeto[index][0]);
                ObjetoRecursivo(objeto, index + 1, mostrarModal, opcionBtn);
            }else{
                //alert("boton cancelado");
            }
            
        }


    }

}


function ReemplazarFoto(objeto) {
    //console.log(objeto);
    //alert(ObtenerRuta());
    var Data = new FormData();
    Data.append("btnReemplazarFoto", "true");
    Data.append("ruta", ObtenerRuta());
    Data.append('File', objeto);
    $.ajax({
        url: "../Controller/AgotadosController.php",
        type: "post",
        data: Data,
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        success: function(response) {
            console.log(response);
            // 1: bien // -1: error // 0: formato errado // 2: ya existe el archivo
            if (response == -1) {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Hubo un error'
                })
            } else if (response == 0) {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'El archivo no tiene el formato correcto (' + objeto['name'] + ')'
                })
                console.log(objeto);
            } else if (response == 1) {
                //alert("se reemplazo la foto .. " + objeto['name']);
            }
        },
        error: function(error) {
            console.log(error.responseText);
        }
    });
}


function CargarFotoGuionesActualizados() {
    //console.log(document.getElementById("fileName").files);
    var fotosParaReemplazar = new Array();
    //console.log($('#' + id)[0].files);
    if ($('#fileNameModal')[0].files.length != 0) {
        $.each($('#fileNameModal')[0].files, (index, value) => {
            var view = "";
            var Data = new FormData();
            Data.append("btnCargarFotoGuionesActualizados", "true");
            Data.append("ruta", ObtenerRuta());
            Data.append('File', value);
            $.ajax({
                url: "../Controller/AgotadosController.php",
                type: "post",
                data: Data,
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                success: function(response) {
                    console.log(response);
                    // 1: bien // -1: error // 0: formato errado // 2: ya existe el archivo
                    if (response == -1) {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Hubo un error'
                        })
                    } else if (response == '0') {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'El archivo no tiene el formato correcto (' + value[
                                'name'] + ')'
                        })
                        console.log(value);
                    } else if (response == 1) {
                        //alert("se cargo la foto "+value['name']);

                    }
                },
                error: function(error) {
                    console.log(error.responseText);
                }
            });
        });
        
    } else {
        Swal.fire(
            'Por favor seleccione los archivos a cargar'
        )
    }

}

// ---------------------- ----------------------  SECCION UPLOAD FILE ---------------------- ---------------------------


// ---------------------- ----------------------  SECCION DOWNLOAD FILE ---------------------- ---------------------------

function DescargarFotos() {
    var parametros = {
        "DescargarFotos": 'true',
        "referencias": $('#referencias_mover').html().trim(),
        "rutaActual": ObtenerRuta()
    }
    $.ajax({
        data: parametros,
        url: '../Controller/AgotadosController.php',
        type: 'post',
        success: function(response) {
           console.log(response);
        },
        error: function(error) {
            console.log(error.responseText);
        }
    });
}

// ---------------------- ----------------------  SECCION DOWNLOAD FILE ---------------------- ---------------------------

// ---------------------- ----------------------  SECCION ELIMINAR FILE ---------------------- ---------------------------

function EliminarReferencia(nombreFoto){
    Swal.fire({
        title: 'Estas seguro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            var parametros = {
                "btnEliminarFoto": 'true',
                "nombreFoto": nombreFoto
            }
            $.ajax({
                data: parametros,
                url: '../Controller/AgotadosController.php',
                type: 'post',
                success: function(response) {
                    AbrirCarpeta(TransformarRutaParaView(), "TblArchivos");
                },
                error: function(error) {
                    console.log(error.responseText);
                }
            });
        }
    })


    
}

// ---------------------- ----------------------  SECCION ELIMINAR FILE ---------------------- ---------------------------

//---------------------- ---------------------- SECCION PROMOCIONES Y TENDENCIAS ---------------------- ---------------

function GestionPromocionTendencia(referencia, carpeta, id) {
    var parametros = {
        "CopiarFoto": 'true',
        "referencia": referencia,
        "carpeta": carpeta,
        "ruta": ObtenerRuta()
    }
    $.ajax({
        data: parametros,
        url: '../Controller/AgotadosController.php',
        type: 'post',
        success: function(response) {
            if (response == 0) {
                $('#' + id).css("background", "");
            } else {
                $('#' + id).css("background", "#E86565");
            }
            let ruta = TransformarRutaParaView();
            if(ruta.indexOf("PROMOCIONES-") > -1 || ruta.indexOf("TENDENCIA") > -1 || ruta.indexOf("ACTUALIZACIONES-") > -1){
                AbrirCarpeta(ruta);
            }
            
        },
        error: function(error) {
            console.log(error.responseText);
        }
    });

}

//---------------------- ---------------------- SECCION PROMOCIONES Y TENDENCIAS ---------------------- -----


//---------------------- ---------------------- SECCION MOVER FOTOS ------------ ---------------------- -----

function CheckAll(){
    /*$("#selectall").on("click", function() {
        $(".case").attr("checked", this.checked);
    });*/
    $('#referencias_mover').html("");
    $("input:checkbox").each(function(){
        $('#'+$(this).prop("id")).prop("checked", true);
        var referencia = $(this).prop("id").replace("chk", "");
        $('#referencias_mover').append(referencia + "*");
        
    });

    SelectCard();
}

function HabilitarBtnMover(referencia, id) {

    if ($('#' + id).is(':checked')) {
        $('#referencias_mover').append(referencia + "*");
        $('#TblArchivos #'+referencia+' .thumbnail').addClass('resaltar');
    } else {
        $('#TblArchivos #'+referencia+' .thumbnail').removeClass('resaltar');
        let v = document.getElementById("referencias_mover").innerHTML.replace(referencia + "*", "");
        document.getElementById("referencias_mover").innerHTML = v;
    }

    AccionBotonesMenu();
}

function AccionBotonesMenu(){
    if ($("input:checkbox:checked").length > 0) {
        $('#btnMover').css("display", "inline-block");
        $('#btnAgotarCheck').css("display", "inline-block");
    } else {
        $('#btnMover').css("display", "none");
        $('#btnAgotarCheck').css("display", "none");
    }
}

function MoverFotos() {

    $('#ModalMoveFiles').modal('show');
    $('#title-modal-mover').html($('#referencias_mover').html().trim().replace('*', " - "));
    AbrirCarpeta("", "DirectorioMove");




    
}

function MoverFotoDirectorio() {
    let rutaMover = ObtenerRuta("rutasModalMover");
    let rutaActual = ObtenerRuta();
    let referncias = $('#referencias_mover').html().trim();
    //alert("ruta actual: "+rutaActual+" ruta destino: "+rutaMover+"   "+referncias.trim());
    var parametros = {
        "MoverFoto": 'true',
        "rutaMover": rutaMover,
        "rutaActual": rutaActual,
        "referencias": referncias
    }
    $.ajax({
        data: parametros,
        url: '../Controller/AgotadosController.php',
        type: 'post',
        async: false,
        success: function(response) {
            console.log(response);
            if (response == -1) {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Hubo un error'
                })
            } else {

                Swal.fire({
                    type: 'success',
                    title: 'Elemento movido',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#ModalMoveFiles').modal('hide');
                var fotosResaltar = referncias.split("*");
                AbrirCarpeta(TransformarRutaParaView("rutasModalMover"), "TblArchivos", -1, "", fotosResaltar);
                referencias = fotosResaltar[0];
                //alert(fotosResaltar[0]);
            }
        },
        error: function(error) {
            console.log(error.responseText);
        }
    });
    find(referencias);
}

//---------------------- ---------------------- SECCION MOVER FOTOS ------------ ---------------------- -----


//---------------------- ---------------------- SECCION FILTRO ------------ ---------------------- ----------
//Funcion para filtrar referencias y carpetas
function Filtrar() {
    //alert($("#txtFiltro").val());
    let ruta = "";
    if (ObtenerRuta() == "HOME:") {
        ruta = "";
    } else {
        ruta = TransformarRutaParaView();
    }

    $('#TblArchivos').html("");
    if ($("#txtFiltro").val() == "") {
        AbrirCarpeta(ruta, "TblArchivos");
    } else {
        AbrirCarpeta(ruta, "TblArchivos", 1, $("#txtFiltro").val());
    }
}

//---------------------- ---------------------- SECCION FILTRO ------------ ---------------------- ----------

//---------------------- ---------------------- SECCION ARCHIVOS SELECCIONADOS ------------ -----------------

function SelectInvertida(){
    var array = $('#TblArchivos').children();
    $('#TblArchivos').children().each(function(elem){
        console.log($(this).prop("id"));
        var id = $(this).prop("id");
        if(id != ""){
            if($('#TblArchivos #'+id+' .thumbnail').hasClass('resaltar')){
                $('#TblArchivos #'+id+' .thumbnail').removeClass('resaltar');

            }else{
                $('#TblArchivos #'+id+' .thumbnail').addClass('resaltar');
                
            }
        }
    });
    CheckCard();
    
}

function CheckCard(){
    
    //$('#btnMover').css("display", "inline-block");
    $('#referencias_mover').html("");
    $('#TblArchivos').children().each(function(elem){
        var id = $(this).prop("id");
        if(id != ""){
            if($('#TblArchivos #'+id+' .thumbnail').hasClass('resaltar')){
                $('#chk'+id).prop("checked", true);
                $('#referencias_mover').append(id + "*");
            }else{
                $('#chk'+id).prop("checked", false);
            } 
        }
       
    });

    AccionBotonesMenu();
}

function SelectCard(){
    $("input:checkbox").each(function(){
        var id = $(this).prop("id").replace("chk", "");
        if($('#'+$(this).prop("id")).prop("checked")){
            $('#TblArchivos #'+id+' .thumbnail').addClass('resaltar');
        }else{
            $('#TblArchivos #'+id+' .thumbnail').removeClass('resaltar');
        }
    });
}

//---------------------- ---------------------- SECCION ARCHIVOS SELECCIONADOS ------------ -----------------

//---------------------- ---------------------- FUNCIONES ----------------- ---------------------- ----------

function TransformarRutaParaView(id = "breadcrumb") {
    let ruta = ObtenerRuta(id);
    let vect = ruta.split(":");
    vect.shift();
    vect.pop();
    ruta = "/" + vect.toString().replace(/,/g, "/");
    ruta = ruta.replace(/,/g, "/");
    return ruta;
}

//---------------------- ---------------------- FUNCIONES ----------------- ---------------------- ----------
</script>