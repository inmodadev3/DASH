<div id="page-wrapper">
  <br>
  <div class="row">
    <div class="col-lg-6">
      <div class="panel panel-default text-center" style="padding: 0px;">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-10">
              <label>Crear Compañias</label>
              <input type="text" class="form-control" placeholder="Nombre" id='txtDescripcionCompania' >
            </div>
            <div class="col-lg-2">
              <br>
              <button class="form-control btn-default" id='btnCrearCompania' title='Crear compania' style="margin-top: 5px;" onclick="CrearCompania();"><i class="glyphicon glyphicon-plus"></i></button>
              <button title="Confirmar editar" class="form-control btn-default" style="margin-top: 5px;display: none;"  id='btnEditarCompania' onclick="EditarCompania()"><i class="glyphicon glyphicon-check"></i></button>
              <button title='Cancelar editar' class="form-control btn-default"   id='btnCancelarEditarCompania' style="margin-top: 5px;display: none;" onclick="CancelarEditar();"><i class="glyphicon glyphicon-remove" ></i></button>
              <label style="display: none" id='lblCompania'></label>
            </div>
          </div>
          <hr>
          <input type="text" class="form-control" placeholder="Buscar" id='txtBuscarCompania'>
          <div style="overflow-y: scroll;height: 300px;">
            <table class="table table-striped" id='tblCompanias'>
              <thead>
                <th class="text-center">Código</th>
                <th class="text-center">Descrición</th>
                <th class="text-center">Fecha Creación</th>
                <th class="text-center">Acción</th> 
              </thead>
              <tbody id='tblBodyCompanias'>

              </tbody>
            </table>  
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="panel panel-default text-center" style="padding: 0px;">
        <div class="panel-body">
          <label>Clases</label>
          <input type="text" placeholder="Buscar" class="form-control" id='txtBuscarClases' >
          <div style="overflow-y: scroll;height: 380px;">
            <table class="table table-striped" id='tblClases'>
              <thead>
                <th class="text-center">Código</th>
                <th class="text-center">Descrición</th>
                <th class="text-center">Acción</th> 
              </thead>
              <tbody id='tblBodyClases'>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default text-center" style="padding: 0px;">
    <div class="panel-body">
      <div class="row">
        <div class="col-lg-12">
          <h4><label>Compañia </label><br>
            <label id='lblIdCompania' style="display: none;"></label>
            <label id='lblCompaniaDescripcion'></label>
          </h4>
          <input type="text" placeholder="Buscar" class="form-control" id='txtBuscarDtCompania'>
          <div style="height: 400px; overflow-y: scroll;">
            <table class="table table-striped">
              <thead>
                <th class="text-center">Código</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Acción</th>
              </thead>
              <tbody id='tblBodyDetalleCompania'>
              </tbody>
            </table>
          </div>
        </div>  
      </div>
    </div>
  </div>

  <script type="text/javascript">
    GetClases();
    ListarCompanias();
  //Obtenemos las calses del HGI
  function GetClases(){
    var parametros = {
      "btnGetClases" : 'true'
    };
    $.ajax({
      data:  parametros,
      url:   '../Controller/CompaniasController.php',
      type:  'post',
      success:  function (response) { 
        var data = JSON.parse(response);
        var i=0;
        data.forEach(function(row){
          strHtml="<tr><td>"+row.StrIdClase+"</td><td>"+row.StrDescripcion+"</td><td><button class='btn btn-default' id='btnAsignarClase"+i+"' disabled='' onclick='AsignarClaseACompania(\""+row.StrIdClase+"\",\""+row.StrDescripcion+"\")'><i class='glyphicon glyphicon-share'></i></button></td></tr>";
          $('#tblBodyClases').append(strHtml);  
          i++;
        });
      },
      error: function (error) {
        alert('error; ' + eval(error));
      }
    });
  }
  //Crear una compañia
  function CrearCompania(){
    var strDescripcion=document.getElementById('txtDescripcionCompania');
    if(strDescripcion.value.trim()===''){
      strDescripcion.focus();
      swal("Error ingrese descripción.");
      return;
    }
    var parametros = {
      "btnCrearCompania" : 'true',
      "strDescripcion" : strDescripcion.value.trim()
    };
    $.ajax({
      data:  parametros,
      url:   '../Controller/CompaniasController.php',
      type:  'post',
      success:  function (response) { 
        var data = JSON.parse(response);
        swal(data);
        strDescripcion.value='';
        ListarCompanias();
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
        document.getElementById('tblBodyCompanias').innerHTML='';
        if(data==''){
          strHtml="<tr><td>No hay compañias creadas.</td></tr>";
          $('#tblBodyCompanias').append(strHtml);
          return;
        }
        var i=1;
        data.forEach(function(row){
          strHtml="<tr><td>"+row.intIdCompania+"</td><td>"+row.strDescripcion+"</td><td>"+row.dtFechaCreacion+"</td><td><button title='Editar' onclick='SeleccionarCompaniaEditar("+i+")' class='btn btn-default'><i class='glyphicon glyphicon-pencil'></i></button><button title='Seleccionar' class='btn btn-default' onclick='DetalleCompania("+row.intIdCompania+",\""+row.strDescripcion+"\")'><i class='glyphicon glyphicon-check'></i></button><button class='btn btn-default' title='Eliminar' onclick='ValidacionEliminarCompania("+row.intIdCompania+",\""+row.strDescripcion+"\")'><i class='glyphicon glyphicon-remove'></i></button></td></tr>";
          $('#tblBodyCompanias').append(strHtml); 
          i++; 
        });
      },
      error: function (error) {
        alert('error; ' + eval(error));
      }
    });
  }
  
//Verifica si se elimina una compañia
function ValidacionEliminarCompania(strIdCompania,strDesCompania){
  Swal.fire({
    title: 'Desea eliminar la compañia '+strDesCompania+'?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si',
    cancelButtonText: 'No'
  }).then((result) => {
    if (result.value) {
      //Elimina compañia
      EliminarCompania(strIdCompania);
    }
  })
}
//Eliminar compañia
function EliminarCompania(strIdCompania){
  if(document.getElementById('lblIdCompania').innerHTML.trim()==strIdCompania){
    document.getElementById('tblBodyDetalleCompania').innerHTML='';
    document.getElementById('lblCompaniaDescripcion').innerHTML='';
    document.getElementById('lblIdCompania').innerHTML='';
    btnAsignarClase(true);
  }
  var parametros = {
    "btnEliminarCompania" : 'true',
    "strIdCompania" : strIdCompania
  };
  $.ajax({
    data:  parametros,
    url:   '../Controller/CompaniasController.php',
    type:  'post',
    success:  function (response) {
      var data = JSON.parse(response);
      swal(data);
      ListarCompanias();
    },
    error: function (error) {
      alert('error; ' + eval(error));
    }
  });
}
//Seleccion editar compania
function SeleccionarCompaniaEditar(strRow){
  var txtDescripcionCompania=document.getElementById('txtDescripcionCompania');
  var btnCancelarEditarCompania=document.getElementById('btnCancelarEditarCompania');
  var btnEditarCompania=document.getElementById('btnEditarCompania');
  var btnCrearCompania=document.getElementById('btnCrearCompania');
  var tblCompanias=document.getElementById('tblCompanias');
  var lblCompania=document.getElementById('lblCompania');

  btnCancelarEditarCompania.style.display='inline';
  btnEditarCompania.style.display='inline';
  btnCrearCompania.style.display='none';
  txtDescripcionCompania.value=tblCompanias.rows[strRow].cells[1].innerHTML;
  lblCompania.innerHTML=tblCompanias.rows[strRow].cells[0].innerHTML;
}
//Cancelar editar
function CancelarEditar(){
  var txtDescripcionCompania=document.getElementById('txtDescripcionCompania');
  var btnCancelarEditarCompania=document.getElementById('btnCancelarEditarCompania');
  var btnEditarCompania=document.getElementById('btnEditarCompania');
  var btnCrearCompania=document.getElementById('btnCrearCompania');
  var lblCompania=document.getElementById('lblCompania');

  btnCancelarEditarCompania.style.display='none';
  btnEditarCompania.style.display='none';
  btnCrearCompania.style.display='inline';
  txtDescripcionCompania.value='';
  lblCompania.innerHTML='';
}

//Editar compania
function EditarCompania(){  
 var strDescripcion=document.getElementById('txtDescripcionCompania');
 var strIdCompania=document.getElementById('lblCompania');
 if(strDescripcion.value.trim()===''){
  strDescripcion.focus();
  swal("Error ingrese descripción.");
  return;
}
var parametros = {
  "btnEditarCompania" : 'true',
  "strIdCompania" : strIdCompania.innerHTML.trim(),
  "strDescripcion" : strDescripcion.value.trim()
};
strIdCompania.innerHTML='';
$.ajax({
  data:  parametros,
  url:   '../Controller/CompaniasController.php',
  type:  'post',
  success:  function (response) {
    var data = JSON.parse(response);
    swal(data);
    ListarCompanias();
    CancelarEditar();
  },
  error: function (error) {
    alert('error; ' + eval(error));
  }
});
}
//Listar detalle compañia
function GetDetalleCompania(strIdCompania){
  var parametros = {
    "btnDetalleCompania" : 'true',
    "strIdCompania" : strIdCompania
  };
  $.ajax({
    data:  parametros,
    url:   '../Controller/CompaniasController.php',
    type:  'post',
    success:  function (response) {
      var tblBodyDetalleCompania=document.getElementById('tblBodyDetalleCompania');

      var data = JSON.parse(response);
      if(data==''){
        tblBodyDetalleCompania.innerHTML='<tr><td><h4><strong>Sin clases.</strong></h4></td></tr>';  
        return;
      }
      tblBodyDetalleCompania.innerHTML='';
      data.forEach(function(row){
        strHtml="<tr><td>"+row.strCodigoClase+"</td><td>"+row.strDescripcion+"</td><td><button class='btn btn-default' onclick='EliminarClaseDtCompania("+row.intIdCompania+",\""+row.strCodigoClase+"\")'><i class='glyphicon glyphicon-remove'></i></button></td></tr>";
        $('#tblBodyDetalleCompania').append(strHtml);
      });


    },
    error: function (error) {
      alert('error; ' + eval(error));
    }
  });
}
//Aginar clase a compañia
function AsignarClaseACompania(strIdClase,strDescripcionCls){
  var strIdCompania=document.getElementById('lblIdCompania');
  var parametros = {
    "btnAsignarClaseACompania" : 'true',
    "strIdCompania" : strIdCompania.innerHTML.trim(),
    "strIdClase" : strIdClase,
    "strDescripcionCls" : strDescripcionCls
  };
  $.ajax({
    data:  parametros,
    url:   '../Controller/CompaniasController.php',
    type:  'post',
    success:  function (response) {
      swal(JSON.parse(response));
      GetDetalleCompania(strIdCompania.innerHTML.trim());
    },
    error: function (error) {
      alert('error; ' + eval(error));
    }
  });
}
//Detalle compania
function DetalleCompania(strIdCompania,strDescripcion){
  var lblIdCompania=document.getElementById('lblIdCompania');
  var lblCompaniaDescripcion=document.getElementById('lblCompaniaDescripcion');
  lblCompaniaDescripcion.innerHTML=strDescripcion;
  lblIdCompania.innerHTML=strIdCompania;
  btnAsignarClase(false);
  GetDetalleCompania(strIdCompania);
}
//Desactivar botones tabla clases
function btnAsignarClase(blnEstado){
 for(var i=0;i<=$("#tblClases tr").length-2;i++){
  document.getElementById('btnAsignarClase'+i).disabled=blnEstado;
} 
}
//Eliminar clase del detalle de una compañia
function EliminarClaseDtCompania(strIdCompania,strIdClase){
  var parametros = {
    "btnEliminarClaseDtCompania" : 'true',
    "strIdCompania" : strIdCompania,
    "strIdClase" : strIdClase
  };
  $.ajax({
    data:  parametros,
    url:   '../Controller/CompaniasController.php',
    type:  'post',
    success:  function (response) {
      GetDetalleCompania(strIdCompania);
    },
    error: function (error) {
      alert('error; ' + eval(error));
    }
  });
}
//Busqueda compañias
  $(document).ready(function () {
    (function ($) {
      $('#txtBuscarCompania').keyup(function () {      
        var rex = new RegExp($(this).val(), 'i');
        $('#tblBodyCompanias tr').hide();
        $('#tblBodyCompanias tr').filter(function () {
          return rex.test($(this).text());
        }).show();
      })
    }(jQuery));
  });
  //Busqueda clases
  $(document).ready(function () {
    (function ($) {
      $('#txtBuscarClases').keyup(function () {      
        var rex = new RegExp($(this).val(), 'i');
        $('#tblBodyClases tr').hide();
        $('#tblBodyClases tr').filter(function () {
          return rex.test($(this).text());
        }).show();
      })
    }(jQuery));
  });
   //Busqueda dt Compañia
  $(document).ready(function () {
    (function ($) {
      $('#txtBuscarDtCompania').keyup(function () {      
        var rex = new RegExp($(this).val(), 'i');
        $('#tblBodyDetalleCompania tr').hide();
        $('#tblBodyDetalleCompania tr').filter(function () {
          return rex.test($(this).text());
        }).show();
      })
    }(jQuery));
  });
</script>