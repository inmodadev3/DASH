<?php 
session_start();
if(isset($_SESSION['Empleado'])){
  echo "<script language='javascript'>window.location='../view/index.php?menu=Inicio'</script>;"; 
}

?>
<style type="text/css">@media screen and (max-width: 991px) {
    .container-fluid {
       margin-top: -20%;
    }
}</style>

<meta name="description" content="In Moda Fantasy">
<meta property="og:title" content="DASH" />
<meta property="og:url" content="https://app.inmodafantasy.com.co/DASH/view/" />
<meta property="og:description" content="In Moda Fantasy">
<meta property="og:image" itemprop="image" content="https://app.inmodafantasy.com.co/DASH/Images/logo.png">
<meta property="og:locale" content="es_ES" />


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../public/vendor/bootstrap/css/Estilos.css" rel="stylesheet">
<script src="../public/vendor/jquery/jquery.min.js"></script>
<script src="../public/vendor/jquery/jquery.js"></script>
<script src="../public/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../public/bootstrap-notify-master/bootstrap-notify.js"></script>
<script src="../public/bootstrap-notify-master/bootstrap-notify.min.js"></script>
<script src="../public/vendor/bootstrap/js/sweetalert2.js"></script>
<script src="../public/vendor/bootstrap/js/jquery.tablesorter.js"></script>
<script src="../public/vendor/bootstrap/js/jquery.metadata.js"></script>
<script src="../public/vendor/bootstrap/js/jquery.tablesorter.min.js"></script>
<script src="../public/vendor/jquery/jquery.knob.min.js"></script>


<br><br><br><br><br>
<div class="container-fluid text-center">
  <div class="row Login">
    <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6" style="margin-top:7%; ">

      <img src="../Images/logo_empresa.png" width="200"><br>
      <img src="../Images/sipe.png" onclick="location.href='https://ventas.inmodafantasy.com.co:8443/sipe'" width="40" height="40" style="cursor: pointer;">
    </div>
    <div class="col-md-6 col-xs-12 col-sm-12 col-lg-4 text-center"><br><br>
      <div class="panel panel-primary" style="width:100%;height: 260px; margin: auto; ">
            <div class="panel-heading">
              <strong>Ingreso DASH</strong>
            </div>
            <div class="panel-body">
              <form action="../Controller/LoginController.php" method="post" name="frmLogin">
                <div class="form-group">
                  <label for="exampleInputEmail1">Usuario</label>
                  <input type="text" class="form-control" name="txtUsuario" placeholder="Usuario">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Clave</label>
                  <input type="Password" class="form-control" name="txtClave" onkeypress="validar(event);" placeholder="Clave">
                </div>
                <input type="hidden" name="btnIngresarDash" value="true">
                <input type="button" onclick="Cargar();" value="Ingresar" class="btn btn-primary">
                <script type="text/javascript">
                    function validar(e){
                        tecla = (document.all) ? e.keyCode : e.which;
                        if(tecla==13){
                            Cargar();
                        }
                    }
                </script>
                <br><br> 
                <br>
                <div class="progress" style="visibility: hidden;" id="prg">   
                  <div class="progress-bar" role="progressbar" aria-valuenow="0" id="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                    <div id='CargaHTML'>0%</div>
                  </div>
                </div>
              </form>
            <script type="text/javascript">
                <?php            
                 if(isset($_SESSION['Mensaje'])){
                   echo " $.notify({ message:'<strong>".$_SESSION['Mensaje']."</strong>'},{
                                 type: 'success',
                                 placement: {
                                 from: 'top',
                                  align: 'right'
                                    },
                                  });";
                                  $_SESSION['Mensaje']=NULL;
                 }
                ?>
                function Cargar(){                
                    let timerInterval
                    swal({
                      title: 'Cargando...',
                      html: 'Espere mientras cargan los modulos del DASH.',
                      timer: 300000,
                      onOpen: () => {
                        swal.showLoading();  
                      },
                      onClose: () => {
                        clearInterval(timerInterval);
                      }
                       }).then((result) => {
                      if (
                        result.dismiss === swal.DismissReason.timer
                      ) {   
                      }
                  });                   
                  document.frmLogin.submit();
                }                
              </script>
            </div>
        </div>
    </div>
  </div>
<style type="text/css">
    .swal2-container {
     zoom : 1.4 ;
     -moz-transform: scale(1.4);
    }     
</style>

