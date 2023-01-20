<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>DASH</title>
    <link href="../public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../public/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../public/vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../public/vendor/bootstrap/css/Estilos.css" rel="stylesheet">

    <script src="../public/vendor/jquery/jquery.js"></script>


    <script src="../public/vendor/bootstrap/js/sweetalert2.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../public/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../public/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../public/vendor/raphael/raphael.min.js"></script>
    <script src="../public/vendor/morrisjs/morris.min.js"></script>
 <!--   <script src="<../public/vendor/morrisjs/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="../public/dist/js/sb-admin-2.js"></script>
               
    <script src="../public/bootstrap-notify-master/bootstrap-notify.js"></script>

    <script src="../public/bootstrap-notify-master/bootstrap-notify.min.js"></script>
    <script src="../public/vendor/bootstrap/js/Charjs.js"></script>
    <script src="../public/vendor/bootstrap/js/jquery.tablesorter.js"></script>
    <script src="../public/vendor/bootstrap/js/jquery.metadata.js"></script>
    <script src="../public/vendor/bootstrap/js/jquery.tablesorter.min.js"></script>  
    
</head>
<style type="text/css">
    @media screen and (max-width: 760px) {
        .Session {
            display: none;
        }
    }
    @media screen and (min-width: 760px) {
        .SessionUL{
            visibility: hidden;  
        }
    }
</style>
<body>  
    <div id="wrapper" class="my-fixed-item" >      
        <nav class="navbar navbar-default navbar-static-top"  role="navigation" style="margin: 0; background: #337ab7; color: #fff;"  >
            <div class="navbar-header" style="width: 100%;">
                <a class="navbar-brand" href="?menu=Inicio" style="color: #fff;"><strong>DASH</strong></a>      
                <div class="display-inline-block" style="padding: 15px;" >
                    <?php echo "<label>".$_SESSION['Empleado']."</label>";  ?>
                </div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="display-inline-block" style="padding: 15px;float: right;">
                   <a href="?menu=Cerrar" style="color: #fff;" class="Session"><strong>Cerrar Sesion</strong></a>
                </div>
            </div>   
            <div class="clearfix"></div>
            <div class="navbar-default sidebar" role="navigation" style="margin: 0px;"> 
                <div class="sidebar-nav navbar-collapse collapse">
                    <ul class="nav" id="side-menu">
                        
                    </ul>
                </div>           
            </div>
        </nav>
    </div>
</body> 
<script>
    Menu();
    function Menu() {
        var parametros = {
                        "CargarMenu" : 'true'
                    };
        var rpta = $.ajax({
                        data:  parametros,
                        url:   '../Controller/HeaderController.php',
                        type:  'post',  
                        async: false,
                        
                        success:  function (response) {
                        },
                        error: function (error) {
                            alert('error; ' + eval(error));
                        }
                });
        rpta.then((response)=>{
            console.log(response);
           $('#side-menu').html(response); 
        });
    }
</script>
