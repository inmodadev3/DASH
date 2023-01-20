<?php
if($_SESSION['idLogin']!=1 && $_SESSION['idLogin']!=25){
  echo "<script language='javascript'>window.location='../view/index.php?menu=Inicio'</script>;"; 
}
?>
<div id="page-wrapper">
  <button type="button" class="btn" style="background: #337ab7;" data-toggle="modal" data-target="#Primero"><i style="color:#fff;" class="fa fa-question-circle fa-fw"></i></button>
  <div class="modal fade" id="Primero">
    <div class="modal-dialog">
      <div class="modal-content">


        <div class="modal-header">
          <h4 class="modal-title">Ayuda</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>


        <div class="modal-body">
          En esta pagina usted podra crear las zonas asginando las ciudades
          correspondientes para cada una y posteriormente asignarlas a los 
          vendedores
        </div>      
        <div class="modal-footer">

        </div>

      </div>
    </div>
  </div>
  <br><br>
  <div class="panel panel-default">
    <div class="panel-heading">
     <i class="glyphicon glyphicon-user"></i> Usuarios
   </div>
   <div class="panel-body">
    <hr>
    <label>Nombre Empleado</label>
    <input id='txtNombreEmpleado' type="text" class="form-control" placeholder="Empleado">
    <label>Usuario</label>
    <input id='txtUsuario' type="text" class="form-control" placeholder="Usuario">
    <label>Clave</label>
    <input type="text" id='txtClave' class="form-control" placeholder="Clave"><label>Compañia</label>
    <select class="form-control" id='ddlCompanias'>

    </select>
    <input type="text" id='txtIdUsuario' style="display: none;">
    <br>
    <button class="btn btn-default" id='btnCrearUsuario' onclick="CrearLogin();" ><span class="glyphicon glyphicon-plus"></span></button>
    <button class="btn btn-default" id='btnEditarUsuario' onclick="EditarUsuario();" style="display: none;" ><span class="glyphicon glyphicon-ok"></span></button>
    <button class="btn btn-default" id='btnCancelarUsuario' onclick="CancelarUsuario();" style="display: none;" ><span class="glyphicon glyphicon-remove"></span></button>
    <hr>
    <div style="overflow-x: scroll;height: 300px;">
      <table class="table" id='tblUsuarios'>
        <thead>
          <th>#</th>
          <th>Usuario</th>
          <th>Clave</th>
          <th>Empleado</th>
          <th>Compañia</th>
          <th>Accion</th>
        </thead>
        <tbody id='tblbodyusuarios'>

        </tbody>
      </table>
    </div>
  </div>
</div> 

<hr>
<h3>Permisos</h3>
<div class="row">
  <div class="col-lg-6">
    <label>Usuario</label>
    <select onchange='BuscarUsuario();ConsultarPermisosUser(1);ConsultarPermisosUser(2);' class="form-control" id='ddlUsuarios'></select>
  </div>
  <div class="col-lg-6">
    <label>Empleado</label>
    <input type="text" class="form-control" id='txtEmpleado' disabled="disabled" placeholder="Empleado">
  </div>
</div>

<hr>
<div>
  <input type="radio" name="rdbEmpleados" id='rdbMadrinas' checked="checked" onchange="ListarEmpleados(1);">
  <label>Madrinas</label>&nbsp;
  <input type="radio" id='rdbVendedoresExt' name="rdbEmpleados" onchange="ListarEmpleados(2);">
  <label>Vendedores externos</label>&nbsp;
  <input type="radio" id='rdbVendedoresBg' name="rdbEmpleados" onchange="ListarEmpleados(3);">
  <label>Vendedores bodega</label>

</div>  <br>
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">Empleados</span>
  <select  class="form-control" id='ddlEmpleados'>

  </select> 
</div>
<br>
<br>
<button class="btn btn-default" onclick="AgregarEmpleadosAsociados()"><span class="glyphicon glyphicon-plus"></span></button>
<div style="overflow-x: scroll;height: 300px;">
  <table class="table table-striped">
    <thead>
      <th>Empleado</th>
      <th>Fecha asignacion</th>
      <th>Tipo visual</th>
      <th>Tipo Empleado</th>
      <th>Accion</th>
    </thead>
    <tbody id='tbodyempleadosasociados'>

    </tbody>
  </table>
</div>
<hr>
<div style="float: right; display: inline;">
  <select class="form-control" id='ddlPermisos'><option value="1">Blanca</option><option value="2">Verde</option><option value="3">Blanca y Verde</option></select>
</div>
<nav>
  <ul class="nav nav-tabs">

    <li id="PermisosWeb"><a class="nav-item nav-link active" style="text-decoration: none;" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Permisos Web</a></li>
    <li id="PermisosDesktop"><a class="nav-item nav-link" style="text-decoration: none;" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Permisos App</a></li>
    <li id="GestionPermisos"><a class="nav-item nav-link" style="text-decoration: none;" id="nav-profile-tab" data-toggle="tab" href="#nav-Create" role="tab" aria-controls="nav-Create" aria-selected="false">Crear Permisos</a></li>
  </ul>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <table class="table">
      <thead>
        <th>
          Vista
        </th>  
        <th>
          Ver
        </th> 
        <th>
          Editar
        </th>  
        <th>
          Ingresar
        </th>
        <th>
          Tipo Vista
        </th>
      </thead>
      <tbody id="tbodyWeb">

      </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <table class="table">
      <thead>
        <th>
          Vista
        </th>  
        <th>
          Ver
        </th> 
        <th>
          Editar
        </th>  
        <th>
          Ingresar
        </th>
        <th>
          Tipo Vista
        </th>
      </thead>
      <tbody id="tbodyDesktop">

      </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="nav-Create" role="tabpanel" aria-labelledby="nav-home-tab"><br>
    <div class="form-group row">
      <div class="col-lg-6">
        <div class="form-group">
          <label>Modulo</label>
          <input type="text" id="txtModulo" class="form-control" >
        </div>
        <div class="form-group">
          <label>Get</label>
          <input type="text" id="txtGet" class="form-control" >
        </div>
        <div class="form-group">
          <label>Descripción</label>
          <input type="text" id="txtDescripcionM" class="form-control" >
        </div>
        <div class="form-group">
          <label>Icono</label>
          <input type="text" id="txtIcono" class="form-control" >
        </div>
        <div class="form-check" onchange="radioChangeTipo();">
          <input class="form-check-input" type="radio" name="RadiosApp" id="radioWeb" value="optWeb">
          <label class="form-check-label" for="radioWeb">Web</label>

          <input class="form-check-input" type="radio" name="RadiosApp" id="radioDesktop" value="optDesktop">
          <label class="form-check-label" for="radioDesktop">
            Desktop
          </label> <br>
        </div>
        <div class="form-check" onchange="radioChange();">
          <input class="form-check-input" type="radio" name="exampleRadios" id="radioEncabezado" value="optEncabezado">
          <label class="form-check-label" for="radioEncabezado">Encabezado</label>

          <input class="form-check-input" type="radio" name="exampleRadios" id="radioDetalle" value="optDetalle">
          <label class="form-check-label" for="radioDetalle">Detalle</label><br>
          <div class="form-group" id="Modulos" style="display: none;">
            <label for="exampleFormControlSelect1">Modulos</label>
            <select class="form-control" id="exampleFormControlSelect1">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div><br>
        <div id="id" style="display: none;"></div>
        <center>
          <button class="btn btn-default" id="guardarPermiso" onclick="AgregarModulo()">Guardar  <span class="glyphicon glyphicon-plus"></span></button>
          <button class="btn btn-default" id="actualizarPermiso" style="display: none;" onclick="ActualizarModulo()">Actualizar  <span class="glyphicon glyphicon-plus"></span></button>
          <button class="btn btn-default" id="btnCancelar" onclick="limpiar()">Cancelar  <span class="glyphicon glyphicon-plus"></span></button>
        </center><br>

      </div>

      <div class="col-lg-6">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">Panel heading</div>
          <div  style="overflow-y: scroll;height:340px; ">
            <table class="table table-bordered">
             <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">GET</th>
                <th scope="col">PLATAFORMA</th>
                <th scope="col">DETALLE</th>
                <th scope="col">ACCION</th>
              </tr>
            </thead>
            <tbody id="tbodyPermisos">

            </tbody>
          </table>
        </div>
        <!-- Table -->
        <br>
        <center>
          <div class="btn-group mr-2" role="group" aria-label="First group" id="Paginas">
            <button type="button" class="btn btn-secondary">1</button>
            <button type="button" class="btn btn-secondary">2</button>
            <button type="button" class="btn btn-secondary">3</button>
            <button type="button" class="btn btn-secondary">4</button>
          </div>
        </center><br>
      </div>
    </div>
  </div>
</div>
</div>
</div>    
<script type="text/javascript">
  ConsultarModulos(1,1);
  ListarCompanias();
  function radioChange() {
      //Mostrar el combobox de Permisos/Modulos si selecciona el  radio detalle si no ocultarlo
      if ($('input:radio[name=exampleRadios]:checked').val() == "optDetalle") {
        $("#Modulos").css("display","inline");
      }else{
        $("#Modulos").css("display","none");
      }
    }
    //Llega con valor cuando se va editar un permiso, de lo contrario queda el valor por defecto
    function radioChangeTipo(detalle = null) {
      if ($('input:radio[name=RadiosApp]:checked').val() == "optDesktop") {
        ConsultarModulos(2,1,detalle);
      }else{
        ConsultarModulos(1,1,detalle);
      }
    }

    //NOTA: tipo: web/desktop    encabezado si: 1/ no:0
    function ConsultarModulos(tipo, encabezado, detalle) {
      var parametros = {
        "actConsultarModulos" : 'true',
        "tipo" : tipo
      };
      $.ajax({
        data:  parametros,
        url:   '../Controller/LoginController.php',
        type:  'post',

        success:  function (response) {
                //alert(response);
                $("#exampleFormControlSelect1").html(response);
                if (detalle != null) {$("#exampleFormControlSelect1 option[value='"+detalle+"']").prop("selected", true);}
              },
              error: function (error) {
                alert('error; ' + eval(error));
              }
            });
    }
    //Param:  intTipoPermiso  tipo de permiso si es para la web o para escritorio
    function AgregarModuloDetalle(intTipoPermiso) {
      var parametros = {
        "btnAgregarModuloDetalle" : 'true',
        "nombre" : $("#txtModulo").val(),
        "get" : $("#txtGet").val(),
        "descripcion" : $("#txtDescripcionM").val(),
        "idModulo" : $('#exampleFormControlSelect1').val(),
        "tipoPermiso" : intTipoPermiso,
        "icono" : $('#txtIcono').val()

      };
      $.ajax({
        data:  parametros,
        url:   '../Controller/LoginController.php',
        type:  'post',

        success:  function (response) {
          if (response == 1) {
            Swal.fire({
              position: 'top-end',
              type: 'success',
              title: 'Modulo ingresado',
              showConfirmButton: false,
              timer: 1500
            })
            limpiar();
          }else{
            if (response == -1) {
              Swal.fire({
                title: '<strong>Informacion</strong>',
                type: 'info',
                text: 'Ya existe el modulo'
              })
            }else{
              Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Revisar consola'
              })
              console.log("Error .AgregarModuloDetalle.  DB.......... \n"+response);
            }

          }
        },
        error: function (error) {
          alert('error; ' + eval(error));
        }
      });
    }

    function AgregarModulo() {
      if (validar()) {
        var intTipoPermiso;
        if ($('input:radio[name=RadiosApp]:checked').val() == "optWeb") {
          intTipoPermiso = 1;
        }else{
          intTipoPermiso = 2;
        }
        if ($('input:radio[name=exampleRadios]:checked').val() == "optDetalle") {
          AgregarModuloDetalle(intTipoPermiso);
        }else{
          var parametros = {
            "btnAgregarModulo" : 'true',
            "nombre" : $("#txtModulo").val(),
            "get" : $("#txtGet").val(),
            "descripcion" : $("#txtDescripcionM").val(),
            "tipoPermiso" : intTipoPermiso,
            "icono" : $('#txtIcono').val()

          };
          $.ajax({
            data:  parametros,
            url:   '../Controller/LoginController.php',
            type:  'post',

            success:  function (response) {
              if (response == 1) {
                Swal.fire({
                  position: 'top-end',
                  type: 'success',
                  title: 'Modulo ingresado',
                  showConfirmButton: false,
                  timer: 1500
                })
                limpiar();
              }else{
                if (response == -1) {
                  Swal.fire({
                    title: '<strong>Informacion</strong>',
                    type: 'info',
                    text: 'Ya existe el modulo'
                  })
                }else{
                  Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Revisar consola'
                  })
                  console.log("Error  .AgregarModulo. DB.......... \n"+response);
                }

              }
            },
            error: function (error) {
              alert('error; ' + eval(error));
            }
          });
        }
      }
    }
    //Param: tipo-Web o Desktop
    function ConsultarPermisosUser(tipo) {
      if ($('#ddlUsuarios').val() != -1) {
        var idUsuario = document.getElementById('ddlUsuarios').value;
        var parametros = {
          "btnConsultarPermisos" : 'true',
          "tipo" : tipo,
          "idUsuario" : idUsuario

        };
        $.ajax({
          data:  parametros,
          url:   '../Controller/LoginController.php',
          type:  'post',

          success:  function (response) {
            if (tipo == 2) {
              $("#tbodyDesktop").html(response);
            }else{
              $("#tbodyWeb").html(response);
            }

          },
          error: function (error) {
            alert('error; ' + eval(error));
          }
        });
      }else{
        alert("fdsa");
        $("#tbodyWeb").html("");
        $("#tbodyDesktop").html("");
      }
      
    }

    /*BORRAR*/
    function ConsultarPermisosUsuario() {
      var idUsuario = document.getElementById('ddlUsuarios').value;
      var parametros = {
        "actConsultarPermisosUsuario" : 'true',
        "idUsuario" : idUsuario

      };
      $.ajax({
        data:  parametros,
        url:   '../Controller/LoginController.php',
        type:  'post',

        success:  function (response) {
                //alert(response);
              },
              error: function (error) {
                alert('error; ' + eval(error));
              }
            });
    }
    /*BORRAR*/

    ConsultarPermisos(1);
    //Consulta todos los permisos de a 5 en cada pagina
    function ConsultarPermisos(tope) {
      var totalPermisos = 0;
      if ($('#tamañoPermisos').html()) {
        totalPermisos = $('#tamañoPermisos').html()
      }
      var parametros = {
        "actConsultarPermisos" : 'true',
        "tope" : tope*5,
        "totalPermisos" : totalPermisos

      };
      $.ajax({
        data:  parametros,
        url:   '../Controller/LoginController.php',
        type:  'post',

        success:  function (response) {
                //alert(response);
                $('#tbodyPermisos').html(response);
              },
              error: function (error) {
                alert('error; ' + eval(error));
              }
            });
    }
    Paginas();
    //Paginas para todos los permisos
    function Paginas() {
      var parametros = {
        "ConsultarPaginas" : 'true'

      };
      $.ajax({
        data:  parametros,
        url:   '../Controller/LoginController.php',
        type:  'post',

        success:  function (response) {
                //alert(response);
                $('#Paginas').html(response);
              },
              error: function (error) {
                alert('error; ' + eval(error));
              }
            });
    }
    //Carga los datos al formulario
    function EditarPermiso(id, nombre,  get, platform, descripcion, detalle, icono) {
      $('#id').html(id);
      $('#txtModulo').val(nombre);
      $('#txtGet').val(get);
      $('#txtDescripcionM').val(descripcion);
      $('#txtIcono').val(icono);

      if (platform == 'Web') {
        $('#radioWeb').prop("checked", true);    
      }else{
       $('#radioDesktop').prop("checked", true); 
     }
     if (id != detalle) {
      $('#radioDetalle').prop("checked", true);
      $('#radioEncabezado').prop("checked", false);
      radioChange();
      radioChangeTipo(detalle);

    }else{
      $('#radioEncabezado').prop("checked", true);
      $('#radioDetalle').prop("checked", false);
      radioChange();
    }
    $('#guardarPermiso').css("display","none");
    $('#actualizarPermiso').css("display","inline");
  }

    //Param: intTipoPermiso- Web o Desktop
    function ActualizarModuloDetalle(intTipoPermiso) {
      var parametros = {
        "btnActualizarModuloDetalle" : 'true',
        "nombre" : $("#txtModulo").val(),
        "get" : $("#txtGet").val(),
        "descripcion" : $("#txtDescripcionM").val(),
        "idModulo" : $('#exampleFormControlSelect1').val(),
        "tipoPermiso" : intTipoPermiso,
        "id" : $('#id').html(),
        "icono" : $('#txtIcono').val()

      };
      $.ajax({
        data:  parametros,
        url:   '../Controller/LoginController.php',
        type:  'post',

        success:  function (response) {
          if (response == 1) {
            Swal.fire({
              position: 'top-end',
              type: 'success',
              title: 'Actualizado',
              showConfirmButton: false,
              timer: 1500
            });
            ConsultarPermisos(1);
            Paginas();
            limpiar();
          }else{
            Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Revisar consola'
            })
            console.log("Error .ActualizarModuloDetalle. DB.......... \n"+response);
          }

        },
        error: function (error) {
          alert('error; ' + eval(error));
        }
      });
    }
    //Actualiza la informacion del permiso
    function ActualizarModulo() {
      var intTipoPermiso;
      if ($('input:radio[name=RadiosApp]:checked').val() == "optWeb") {
        intTipoPermiso = 1;
      }else{
        intTipoPermiso = 2;
      }
      if ($('input:radio[name=exampleRadios]:checked').val() == "optDetalle") {
        ActualizarModuloDetalle(intTipoPermiso);
      }else{
        var parametros = {
          "btnActualizarModulo" : 'true',
          "nombre" : $("#txtModulo").val(),
          "get" : $("#txtGet").val(),
          "descripcion" : $("#txtDescripcionM").val(),
          "tipoPermiso" : intTipoPermiso,
          "id" : $('#id').html(),
          "icono" : $('#txtIcono').val()

        };
        $.ajax({
          data:  parametros,
          url:   '../Controller/LoginController.php',
          type:  'post',

          success:  function (response) {
            if (response == 1) {
              Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Actualizado',
                showConfirmButton: false,
                timer: 1500
              });
              ConsultarPermisos(1);
              Paginas();
              limpiar();
            }else{
              Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Revisar consola'
              })
              console.log("Error .ActualizarModulo. DB.......... \n"+response);
            }
          },
          error: function (error) {
            alert('error; ' + eval(error));
          }
        });
      }
    }


    function EliminarPermiso(id) {
      Swal.fire({
        title: 'Estas seguro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
      }).then((result) => {
        if (result.value) {
         var parametros = {
          "actEliminarPermiso" : 'true',
          "idPermiso" : id
        };
        $.ajax({
          data:  parametros,
          url:   '../Controller/LoginController.php',
          type:  'post',

          success:  function (response) {
            if (response == 1) {
              Swal.fire(
                'Deleted!',
                'El permiso ha sido elimimnado correctamente',
                'success'
                )
              ConsultarPermisos(1);
              Paginas();
            }else{
             Swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Revisar consola'
            })
             console.log("Error .EliminarPermiso. DB.......... \n"+response);
           }
         },
         error: function (error) {
          alert('error; ' + eval(error));
        }
      });
        
      }else{

      }
    })
    }

    function limpiar() {
      $('#txtModulo').val("");
      $('#txtGet').val("");
      $('#txtDescripcionM').val("");  
      $('#radioWeb').attr("checked", true); 
      $('#radioEncabezado').attr("checked",  true);  
      $('#guardarPermiso').css("display","inline");
      $('#actualizarPermiso').css("display","none");
      $('#modulo').css("display", "none");
      $('#txtIcono').val("");

    }
  //Validar formulario de permisos
  function validar() {
    var bool = true;
    if ($('#txtModulo').val() == "") {
      $('#txtModulo').focus();
      bool = false;
    }else{
      if (document.getElementById('radioDetalle').checked == false && document.getElementById('radioEncabezado').checked == false) {
        $('#radioDetalle').focus();
        $('#radioEncabezado').focus();
        bool = false;
      }else{
        if (document.getElementById('radioDesktop').checked == false && document.getElementById('radioWeb').checked == false) {
          $('#radioDetalle').focus();
          $('#radioEncabezado').focus();
          bool = false;
        }
      }
    }
    return bool;
  }


  ListarUsuarios(1);
  ListarUsuarios(2);
  //Actualizacion de los permisos operaciones con checkbox
  function OperarCheckHijos(tipo, nombreHijo, intIdHijo, login) {
    var editar = 0;
    var ingresar = 0;
    var ver = 0;
    if (document.getElementById("chkd"+nombreHijo+"Editar").checked == true) { editar = 1;}
    if (document.getElementById("chkd"+nombreHijo+"Ingresar").checked == true) { ingresar = 1;}
    if (document.getElementById("chkd"+nombreHijo+"Ver").checked == true) { ver = 1;}
    switch (tipo){
      case 1:
      if (ver == 1) {
        ActualizarPermisosLogin(intIdHijo,login,1,editar,ingresar,$('#ddlPermisos').val());
      }else{
        ActualizarPermisosLogin(intIdHijo,login,0,editar,ingresar,$('#ddlPermisos').val());
      }
      break;
      case 2:
      if (editar == 1) {
        ActualizarPermisosLogin(intIdHijo,login,ver,1,ingresar,$('#ddlPermisos').val());
      }else{
        ActualizarPermisosLogin(intIdHijo,login,ver,0,ingresar,$('#ddlPermisos').val());
      }
      break;
      case 3:
      if (ingresar == 1) {
        ActualizarPermisosLogin(intIdHijo,login,ver,editar,1,$('#ddlPermisos').val());
      }else{
        ActualizarPermisosLogin(intIdHijo,login,ver,editar,0,$('#ddlPermisos').val());
      }
      break;
    } 
  }

  function OperarCheckPadres(tipo,nombrePadre,intIdPadre,login) {
    var ver = 0;
    var editar = 0;
    var ingresar = 0;
    var bool;
    if (document.getElementById("chk"+nombrePadre+"Ver").checked == true) { ver = 1;}
    if (document.getElementById("chk"+nombrePadre+"Editar").checked == true) { editar = 1;}
    if (document.getElementById("chk"+nombrePadre+"Ingresar").checked == true) { ingresar = 1;}
    switch(tipo){
      case 1:
      if (ver == 1) {
        ActualizarPermisosLogin(intIdPadre,login,1,editar,ingresar,$('#ddlPermisos').val());
        bool = true;
      }else{
        ActualizarPermisosLogin(intIdPadre,login,0,editar,ingresar,$('#ddlPermisos').val());
        bool = false;
      }
      break;
      case 2:
      if (editar == 1) {
        ActualizarPermisosLogin(intIdPadre,login,ver,1,ingresar,$('#ddlPermisos').val());
        bool = true;
      }else{
        ActualizarPermisosLogin(intIdPadre,login,ver,0,ingresar,$('#ddlPermisos').val());
        bool = false;
      }
      break;
      case 3:
      if (ingresar == 1) {
        ActualizarPermisosLogin(intIdPadre,login,ver,editar,1,$('#ddlPermisos').val());
        bool = true;
      }else{
        ActualizarPermisosLogin(intIdPadre,login,ver,editar,0,$('#ddlPermisos').val());
        bool = false;
      }
      break;
    }
    return bool; 
  }

  function chkVerHijo(nombreHijo, intIdPadre, intIdHijo, login, nombrePadre){
    if (validarComboboxUsuario()) {
      if ($("#list"+intIdPadre).html()) {
        var vectDetalle = $("#list"+intIdPadre).html().split("%");
        var bool = false;
        OperarCheckHijos(1,nombreHijo, intIdHijo, login);
        for (var i = 0; i < vectDetalle.length-1; i++) {
          var vectInfo = vectDetalle[i].split("/");
          var check = "chkd"+vectInfo[0]+"Ver";
          if (document.getElementById(check).checked == true) {
            bool = true;
            break;
          }

        }
      }
      document.getElementById("chk"+nombrePadre+"Ver").checked = bool;
      OperarCheckPadres(1,nombrePadre,intIdPadre,login);
    }else{
     Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: 'Seleccionar un usuario'
    })
   }
   

 }

 function chkEditarHijo(nombreHijo, intIdPadre, intIdHijo, login, nombrePadre){
  if (validarComboboxUsuario()) {
    if ($("#list"+intIdPadre).html()) {
      var vectDetalle = $("#list"+intIdPadre).html().split("%");
      var bool = false;
      OperarCheckHijos(2,nombreHijo, intIdHijo, login);
      for (var i = 0; i < vectDetalle.length-1; i++) {
        var vectInfo = vectDetalle[i].split("/");
        var check = "chkd"+vectInfo[0]+"Editar";
        if (document.getElementById(check).checked == true) {
          bool = true;
          break;
        }
        
      }
    }
    document.getElementById("chk"+nombrePadre+"Editar").checked = bool;
    OperarCheckPadres(2,nombrePadre,intIdPadre,login);
  }else{
   Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Seleccionar un usuario'
  });
 }
}

function chkIngresarHijo(nombreHijo, intIdPadre, intIdHijo, login, nombrePadre){
  if (validarComboboxUsuario()) {
    if ($("#list"+intIdPadre).html()) {
      var vectDetalle = $("#list"+intIdPadre).html().split("%");
      var bool = false;
      OperarCheckHijos(3,nombreHijo, intIdHijo, login);
      for (var i = 0; i < vectDetalle.length-1; i++) {
        var vectInfo = vectDetalle[i].split("/");
        var check = "chkd"+vectInfo[0]+"Ingresar";
        if (document.getElementById(check).checked == true) {
          bool = true;
          break;
        }
        
      }
    }
    document.getElementById("chk"+nombrePadre+"Ingresar").checked = bool;
    OperarCheckPadres(3,nombrePadre,intIdPadre,login);
  }else{
   Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Seleccionar un usuario'
  })
 }

}

function chkVer(strTipoChk,intId,login){
  if (validarComboboxUsuario()) {
   bool = OperarCheckPadres(1,strTipoChk,intId,login);
   if ($("#list"+intId).html()) {
    var vectDetalle = $("#list"+intId).html().split("%");
    var bool;
    for (var i = 0; i < vectDetalle.length-1; i++) {
      var vectInfo = vectDetalle[i].split("/");
      var check = "chkd"+vectInfo[0]+"Ver";
      editar = 0;
      ingresar = 0;
      if (document.getElementById("chkd"+vectInfo[0]+"Editar").checked == true) { editar = 1;}
      if (document.getElementById("chkd"+vectInfo[0]+"Ingresar").checked == true) { ingresar = 1;}

      if (bool) {
        ActualizarPermisosLogin(vectInfo[1],login,1,editar,ingresar,$('#ddlPermisos').val());
      }else{
        ActualizarPermisosLogin(vectInfo[1],login,0,editar,ingresar,$('#ddlPermisos').val());   
      }
      document.getElementById(check).checked = bool;

    }
  }
}else{
 Swal.fire({
  type: 'error',
  title: 'Oops...',
  text: 'Seleccionar un usuario'
})
}

}

function chkEditar(strTipoChk,intId,login){
  if (validarComboboxUsuario()) {
    bool = OperarCheckPadres(2,strTipoChk,intId,login);
    if ($("#list"+intId).html()) {
      var vectDetalle = $("#list"+intId).html().split("%");
      var bool;

      for (var i = 0; i < vectDetalle.length-1; i++) {
        var vectInfo = vectDetalle[i].split("/");
        var check = "chkd"+vectInfo[0]+"Editar";
        ver = 0;
        ingresar = 0;
        if (document.getElementById("chkd"+vectInfo[0]+"Ver").checked == true) { ver = 1;}
        if (document.getElementById("chkd"+vectInfo[0]+"Ingresar").checked == true) { ingresar = 1;}

        if (bool) {
          ActualizarPermisosLogin(vectInfo[1],login,ver,1,ingresar,$('#ddlPermisos').val());
        }else{
          ActualizarPermisosLogin(vectInfo[1],login,ver,0,ingresar,$('#ddlPermisos').val());   
        }
        document.getElementById(check).checked = bool;

      }
    }
  }else{
   Swal.fire({
    type: 'error',
    title: 'Oops...',
    text: 'Seleccionar un usuario'
  })
 }

}

function chkIngresar(strTipoChk,intId,login){
  if (validarComboboxUsuario()) {

    bool = OperarCheckPadres(3,strTipoChk,intId,login);
    if ($("#list"+intId).html()) {
      var vectDetalle = $("#list"+intId).html().split("%");
      var bool;

      for (var i = 0; i < vectDetalle.length-1; i++) {
        var vectInfo = vectDetalle[i].split("/");
        var check = "chkd"+vectInfo[0]+"Ingresar";
        ver = 0;
        editar = 0;
        if (document.getElementById("chkd"+vectInfo[0]+"Ver").checked == true) { ver = 1;}
        if (document.getElementById("chkd"+vectInfo[0]+"Editar").checked == true) { editar = 1;}

        if (bool) {
          ActualizarPermisosLogin(vectInfo[1],login,ver,editar,1,$('#ddlPermisos').val());
        }else{
          ActualizarPermisosLogin(vectInfo[1],login,ver,editar,0,$('#ddlPermisos').val());   
        }
        document.getElementById(check).checked = bool;

      }
    }
  }else{
    Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: 'Seleccionar un usuario'
    })
  }
}

function validarComboboxUsuario() {
  var bool = true;
  if ($('#ddlUsuarios').val() == -1) {
    bool = false;
  }
  return bool;
}
  //Actualizacion de los permisos operaciones con checkbox
  
  
  function ActualizarPermisosLogin(idPermiso, idLogin, ver, editar, ingresar, tipoVista) {
    var parametros = {
      "checkActualizarPermisos" : 'true',
      "idPermiso" : idPermiso,
      "idLogin" : idLogin,
      "ver" : ver,
      "editar" : editar,
      "ingresar" : ingresar,
      "tipoVista" : tipoVista

    };
    
    $.ajax({
      data:  parametros,
      url:   '../Controller/LoginController.php',
      type:  'post',                         
      success:  function (response) {
        if (response != 1) {
          Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Verificar en la consola'
          })
          console.log("Error... "+response);  
        }

      },
      error: function (error) {
        alert('error; ' + eval(error));
      }
    });
  }
















  function SeleccionarUsuario(intUsuario){
    var strNombre=document.getElementById('txtNombreEmpleado');
    var strClave=document.getElementById('txtClave');
    var strUsuario=document.getElementById('txtUsuario');
    var tblUsuarios=document.getElementById('tblUsuarios');
    var btnEditarUsuario=document.getElementById('btnEditarUsuario');
    var btnCrearUsuario=document.getElementById('btnCrearUsuario');
    var btnCancelarUsuario=document.getElementById('btnCancelarUsuario');
    var txtIdUsuario=document.getElementById('txtIdUsuario');
    var ddlCompanias=document.getElementById('ddlCompanias');

    btnCancelarUsuario.style.display='inline';
    btnCrearUsuario.style.display='none';
    btnEditarUsuario.style.display='inline';
    strNombre.value=tblUsuarios.rows[intUsuario].cells[3].innerHTML.trim();
    strClave.value=tblUsuarios.rows[intUsuario].cells[2].innerHTML.trim();
    strUsuario.value=tblUsuarios.rows[intUsuario].cells[1].innerHTML.trim();
    txtIdUsuario.value=tblUsuarios.rows[intUsuario].cells[6].innerHTML.trim();
    ddlCompanias.value=tblUsuarios.rows[intUsuario].cells[7].innerHTML.trim();

  }
  function CancelarUsuario(){
    var strNombre=document.getElementById('txtNombreEmpleado');
    var strClave=document.getElementById('txtClave');
    var strUsuario=document.getElementById('txtUsuario');
    var btnEditarUsuario=document.getElementById('btnEditarUsuario');
    var btnCrearUsuario=document.getElementById('btnCrearUsuario');
    var btnCancelarUsuario=document.getElementById('btnCancelarUsuario');
    var  intIdUsuario=document.getElementById('txtIdUsuario');

    intIdUsuario.value='';
    btnEditarUsuario.style.display='none';
    btnCrearUsuario.style.display='inline';
    btnCancelarUsuario.style.display='none';
    strNombre.value='';
    strClave.value='';
    strUsuario.value='';

  }
  function CrearLogin(){
    if($("#ddlCompanias option:selected").val()=='-1'){
      swal('Cree una compañia para poder continuar.');
      return;
    }
    var parametros = {
      "btnCrearLogin" : 'true',
      "txtUsuario" : document.getElementById("txtUsuario").value.trim(),
      "txtClave" : document.getElementById("txtClave").value.trim() , 
      "txtNombreEmpleado" : document.getElementById("txtNombreEmpleado").value.trim(),
      "intIdCompania" : $("#ddlCompanias option:selected").val()    
    };

    $.ajax({
      data:  parametros,
      url:   '../Controller/LoginController.php',
      type:  'post',                         
      success:  function (response) {
        console.log(response);
        strMensaje=response.split("%");
        const toast = swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          background: '#FFFFB0'

        });
        toast({
          type: strMensaje[1],
          title: "<span style='color:#686868'>"+strMensaje[0]+"</span>"

        });
        console.log(strMensaje[0]);
        document.getElementById("txtUsuario").value="";
        document.getElementById("txtClave").value="";
        document.getElementById("txtNombreEmpleado").value="";
        ListarUsuarios(1);  
        ListarUsuarios(2);       
      },
      error: function (error) {
        alert('error; ' + eval(error));
      }
    });
  }

  function ListarUsuarios(intTipo){
    var parametros = {
      "btnListarUsuarios" : 'true', 
      "intTipoListado":intTipo        
    };

    $.ajax({
      data:  parametros,
      url:   '../Controller/LoginController.php',
      type:  'post',                         
      success:  function (response) {
        if(intTipo==1){
         document.getElementById('tblbodyusuarios').innerHTML=response;
       }else{
        document.getElementById('ddlUsuarios').innerHTML=response;
      }
    },
    error: function (error) {
      alert('error; ' + eval(error));
    }
  });
  }

  function EditarUsuario(){
    var strUsuario=document.getElementById('txtUsuario');
    var strNombre=document.getElementById('txtNombreEmpleado');
    var strClave=document.getElementById('txtClave');
    var  intIdUsuario=document.getElementById('txtIdUsuario');
    var btnEditarUsuario=document.getElementById('btnEditarUsuario');
    var btnCrearUsuario=document.getElementById('btnCrearUsuario');
    var btnCancelarUsuario=document.getElementById('btnCancelarUsuario');
    var ddlCompanias=$("#ddlCompanias option:selected").val();

    if(strUsuario.value==''){
      Mensaje('Ingrese usuario.%error');
      strUsuario.focus();
      return;
    }

    if(strNombre.value==''){
      Mensaje('Ingrese nombre.%error');
      strNombre.focus();
      return;
    }

    if(strClave.value==''){
      Mensaje('Ingrese clave.%error');
      strClave.focus();
      return;
    }

    var parametros = {
      "btnEditarUsuario" : 'true',
      "strUsuario":strUsuario.value.trim(),
      "strClave":strClave.value.trim(),
      "strNombre":strNombre.value.trim(),
      "intIdUsuario":intIdUsuario.value.trim(),
      "intIdCompania" : ddlCompanias
    };                    
    $.ajax({
      data:  parametros,
      url:   '../Controller/LoginController.php',
      type:  'post',                       
      success:  function (response) {
        Mensaje(response);
        strUsuario.value='';
        strNombre.value='';
        strClave.value='';
        intIdUsuario.value='';
        btnEditarUsuario.style.display='none';
        btnCrearUsuario.style.display='inline';
        btnCancelarUsuario.style.display='none';
        ListarUsuarios(1);
        ListarUsuarios(2);

      },
      error: function (error) {
        alert('error; ' + eval(error));
      }
    }); 
  }
  function EliminarUsuario(intUsuario){

    var parametros = {
      "btnEliminarUsuario" : 'true',
      "txtIdUsuario":intUsuario

    };                    
    $.ajax({
      data:  parametros,
      url:   '../Controller/LoginController.php',
      type:  'post',                       
      success:  function (response) {
        Mensaje(response);
        ListarUsuarios(1);
        ListarUsuarios(2);

      },
      error: function (error) {
        alert('error; ' + eval(error));
      }
    }); 
  }
  function Mensaje(strDato){
    strMensaje=strDato.split("%");
    const toast = swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      background: '#FFFFB0'

    });
    toast({
      type: strMensaje[1],
      title: "<span style='color:#686868'>"+strMensaje[0]+"</span>"

    });
  }
  function BuscarUsuario(){
    var ddlUsuarios=document.getElementById('ddlUsuarios');
    var txtEmpleado=document.getElementById('txtEmpleado');

    if($("#ddlUsuarios option:selected").index()==0){
      txtEmpleado.value='';
      document.getElementById('tbodyempleadosasociados').innerHTML='';

      return;
    }
    var parametros = {
      "btnBuscarUsuario" : 'true',
      "intIdUsuario":ddlUsuarios.value.trim()
    };                    
    $.ajax({
      data:  parametros,
      url:   '../Controller/LoginController.php',
      type:  'post',                       
      success:  function (response) {

        txtEmpleado.value=response;
        ListarUsuariosAsociados();
                              //ListarPermisos();

                            },
                            error: function (error) {
                              alert('error; ' + eval(error));
                            }
                          }); 
  }
  ListarEmpleados(1);
  function ListarEmpleados(intTipo){
   var parametros = {
    "btnListarEmpleados" : 'true',
    "intTipoEmpleado":intTipo
  };                    
  $.ajax({
    data:  parametros,
    url:   '../Controller/LoginController.php',
    type:  'post',                       
    success:  function (response) {
     console.log(response);
     document.getElementById('ddlEmpleados').innerHTML=response;

   },
   error: function (error) {
    alert('error; ' + eval(error));
  }
}); 
}
function AgregarEmpleadosAsociados(){
  var ddlEmpleado=document.getElementById('ddlEmpleados');
  var ddlVista=document.getElementById('ddlPermisos');
  var rdbVendedoresExt=document.getElementById('rdbVendedoresExt');
  var rdbMadrina=document.getElementById('rdbMadrinas');
  var rdbVendedoresBg=document.getElementById('rdbVendedoresBg');
  var txtNombreEmpleado=document.getElementById('txtEmpleado');
  var ddlUsuarios=document.getElementById('ddlUsuarios');
  var strNombreEmpleado='';
  var strTipoEmpleado='VBG';
  if($("#ddlUsuarios option:selected").index()==0){
    txtEmpleado.value='';
    return;
  }
  if(rdbMadrina.checked){
    strTipoEmpleado='MD';
  }else if(rdbVendedoresExt.checked){
    strTipoEmpleado='VE';
  }
  if(ddlEmpleados.value=='TD'){
    var intTamano= document.getElementById("ddlEmpleados").length;
    for(i=1;i<=intTamano-1;i++){
      strNombreEmpleado=$("#ddlEmpleados option")[i].text;
      strEmpleado=$("#ddlEmpleados option")[i].value;
      var parametros = {
        "btnAgregarEmpeladosAsociados" : 'true',
        "intVista":ddlVista.value,
        "strCedulaEmpleado":strEmpleado,
        "strTipoEmpleado":strTipoEmpleado,
        "strNombreEmpleado":strNombreEmpleado,
        "intIdLogin":ddlUsuarios.value
      };                    
      $.ajax({
        data:  parametros,
        url:   '../Controller/LoginController.php',
        type:  'post',                       
        success:  function (response) {
         Mensaje(response);
         ListarUsuariosAsociados();
       },
       error: function (error) {
        alert('error; ' + eval(error));
      }
    });  
    }return;
  }else{
    strNombreEmpleado=$('select[id="ddlEmpleados"] option:selected').text();
    strEmpleado=ddlEmpleado.value;
  }
  var parametros = {
    "btnAgregarEmpeladosAsociados" : 'true',
    "intVista":ddlVista.value,
    "strCedulaEmpleado":strEmpleado,
    "strTipoEmpleado":strTipoEmpleado,
    "strNombreEmpleado":strNombreEmpleado,
    "intIdLogin":ddlUsuarios.value
  };                    
  $.ajax({
    data:  parametros,
    url:   '../Controller/LoginController.php',
    type:  'post',                       
    success:  function (response) {
     Mensaje(response);
     ListarUsuariosAsociados();
   },
   error: function (error) {
    alert('error; ' + eval(error));
  }
});  
}
function ListarUsuariosAsociados(){
  if($("#ddlUsuarios option:selected").index()==0){
    txtEmpleado.value='';
    return;
  }
  var ddlUsuarios=document.getElementById('ddlUsuarios');
  var parametros = {
    "btnListarUsuariosAsociados" : 'true',
    "intIdLogin":ddlUsuarios.value

  };                    
  $.ajax({
    data:  parametros,
    url:   '../Controller/LoginController.php',
    type:  'post',                       
    success:  function (response) {
     document.getElementById('tbodyempleadosasociados').innerHTML=response;
   },
   error: function (error) {
    alert('error; ' + eval(error));
  }
});  
}
function EliminarEmpleadoAsociado(intTipo){
 var parametros = {
  "btnEliminarEmpleadoAsociado" : 'true',
  "intTipoEmpleado":intTipo
};                    
$.ajax({
  data:  parametros,
  url:   '../Controller/LoginController.php',
  type:  'post',                       
  success:  function (response) {
   Mensaje(response);
   ListarUsuariosAsociados();
 },
 error: function (error) {
  alert('error; ' + eval(error));
}
});  

}
   //Listar Compañias
   function ListarCompanias(){
    var parametros = {
      "btnListarCompanias" : 'true'
    };
    $.ajax({
      data:  parametros,
      url:   '../Controller/CompaniasController.php',
      type:  'post',
      success:  function (response) {
        var data = JSON.parse(response);
        if(data==''){ 
          strHtml="<option value='-1'>No hay compañias creadas.</option>";
          $('#ddlCompanias').append(strHtml); 
          return;
        }
        data.forEach(function(row){
          strHtml="<option value='"+row.intIdCompania+"'>"+row.strDescripcion+"</option>";
          $('#ddlCompanias').append(strHtml); 
        });
      },
      error: function (error) {
        alert('error; ' + eval(error));
      }
    });
  }
</script>
<style type="text/css">
.swal2-container {
 zoom : 1.4 ;
 -moz-transform: scale(1.4);
}
</style>