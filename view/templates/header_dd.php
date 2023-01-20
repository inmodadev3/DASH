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
    
</head>

</style>
<body>  
    <div id="wrapper" class="my-fixed-item" >      
        <nav class="navbar navbar-default navbar-static-top"  role="navigation" style="margin: 0; background: #337ab7; color: #fff;"  >
            <div class="navbar-header" style="width: 100%;">
                 <a class="navbar-brand" href="?menu=Inicio" style="color: #fff;"><strong>DASH</strong></a>      
                <div class="display-inline-block" style="padding: 15px;" >
                <?php
                //falta agregar clientes
                $arrayPermisos= array('false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false');
                $arrayPermisosEditar= array('false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false');
                $arrayPermisosIngresar= array('false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false','false');
                $arrayPermisosVista= array('','','','','','','','','','','','','','','','','','','','','');
          
                if(isset($_SESSION['Empleado'])){
                    echo "<label>".$_SESSION['Empleado']."</label>"; 
                    if(isset($_SESSION['Permisos'])){

                      if(sizeof($_SESSION['Permisos'])!=0){  
                      if($_SESSION['Permisos'][0]['intTipoVista']==3){
                                 $_SESSION['intTipoVista']= "<option value='1'>Blanca</option>
                                 <option value='2'>Verde</option>";
                      }else if($_SESSION['Permisos'][0]['intTipoVista']==1){
                                 $_SESSION['intTipoVista']= " <option value='1'>Blanca</option>";
                      }else{
                                 $_SESSION['intTipoVista']= " <option value='2'>Verde</option>";
                      }}
                    

                    
                    for($i=0;$i<=sizeof($_SESSION['Permisos'])-1;$i++){
                        $blnEstado=false;
                        switch (($_SESSION['Permisos'][$i]['idPermiso'])) {
                            case (($i+1)): 
                                    if($_SESSION['Permisos'][$i]['intVer']=='1'){
                                        $arrayPermisos[$i]='true';
                                    }
                                    if($_SESSION['Permisos'][$i]['intEditar']=='1'){
                                        $arrayPermisosEditar[$i]='true';
                                    }
                                    if($_SESSION['Permisos'][$i]['intIngresar']=='1'){
                                        $arrayPermisosIngresar[$i]='true';
                                    }
                                        $arrayPermisosVista[$i]=$_SESSION['Permisos'][$i]['intTipoVista'];
                                break;
                        } 
                     } 
                  } 

                }

                   ?>
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
                <div class="sidebar-nav navbar-collapse">

                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                        </li>
                         <?php if($arrayPermisos[0]=="true"){ ?>
                        <li>
                            <a href="#" style="color:#337ab7;"><span class="glyphicon glyphicon-shopping-cart"  style="color:#337ab7;"></span> <strong>Compras</strong> <span style="float: right;" class="glyphicon glyphicon-triangle-bottom"></span></a>
                            <ul class="nav nav-second-level">
                                 <?php if($arrayPermisos[1]=="true"){ ?>
                                <li>
                                    <a href="?menu=Compra"  style="color:#888888;"><strong><i class="glyphicon glyphicon-log-in"></i> Cargar Compra</strong></a>
                                </li>
                                 <?php }?>
                                 <?php if($arrayPermisos[2]=="true"){ ?>
                                <li>
                                   <a href="?menu=Liquidar"  style="color:#888888;"><strong><i class="glyphicon glyphicon-usd"></i> Liquidar</strong></a>   
                                </li>
                                <?php }?>
                                <?php if ($_SESSION['idLogin'] == 1) {?>
                                    <li>
                                   <a href="?menu=Estados"  style="color:#888888;"><strong><i class="glyphicon glyphicon-th-large"></i> Estados</strong></a>   
                                </li>
                                <?php } ?>
                            </ul>                 
                        </li>  
                        <?php }?>

                        <?php if($arrayPermisos[3]=="true"){ ?>
                        <li>  
                             <a href="?menu=Stickers"   style="color:#337ab7;"><strong><i class="glyphicon glyphicon-tags"  style="color:#337ab7;"></i> Stickers</span></strong></a>
                           
                        </li> 
                        <?php }?>
                        <?php if($arrayPermisos[4]=="true"){ ?>
                          <li>
                            <a href="#" style="color:#337ab7;"><strong><i class="glyphicon glyphicon-folder-close"></i> Pedidos<span style="float: right;" class="glyphicon glyphicon-triangle-bottom"></span></strong></a>
                            <ul class="nav nav-second-level" >
                                <?php if($arrayPermisos[5]=="true"){ ?>
                                <li>      
                                     <a href="?menu=GenerarPedido" style="color:#888888;"><strong><i class="glyphicon glyphicon-log-in"></i> Agregar Pedido</strong></a>
                                </li>
                                <?php }?>
                                <?php if($arrayPermisos[6]=="true"){ ?>
                                <li>
                                   <a href="?menu=GenerarExcelPedido" style="color:#888888;"><strong><i class="glyphicon glyphicon-duplicate"></i> Generar Excel pedidos</strong></a>  
                                </li>
                                <?php }?>
                            </ul>                 
                        </li> 
                          <?php }?>   
                        <?php if($arrayPermisos[7]=="true"){ ?>                   
                          <li>
                            <a href="#" style="color:#337ab7;"><strong><i class="glyphicon glyphicon-usd"></i> Cartera<span style="float: right;" class="glyphicon glyphicon-triangle-bottom"></span></strong></a>
                            <ul class="nav nav-second-level" >
                                <?php if($arrayPermisos[8]=="true"){ ?>
                                <li>
                                     <a href="?menu=Cartera" style="color:#888888;"><strong><i class="glyphicon glyphicon-log-in"></i> Descargar Informe</strong></a>
                                </li> 
                                <?php }?>   
                            </ul>                   
                          </li> 
                         <?php }?>    
                        <?php if($arrayPermisos[9]=="true"){ ?>    
                            <li>    
                           <a href="#" style="color:#337ab7;"><strong><i class="glyphicon glyphicon-user"></i> Vendedores<span style="float: right;" class="glyphicon glyphicon-triangle-bottom"></span></strong></a>
                            <ul class="nav nav-second-level" >
                                <?php if($arrayPermisos[10]=="true"){ ?>
                                <li>
                                     <a href="?menu=Vendedores" style="color:#888888;"><strong><i class="glyphicon glyphicon-log-in"></i> Vendedores</strong></a>   
                                </li> 
                                <?php } ?> 
                                 <?php if($arrayPermisos[11]=="true"){ ?>
                                <li>
                                     <a href="?menu=Ciudades" style="color:#888888;"><strong><i class="glyphicon glyphicon-log-in"></i> Zonas</strong></a>                               
                                </li> 
                                <?php } ?> 
                                  <?php if($arrayPermisos[12]=="true"){ ?>
                                 <li>
                                     <a href="?menu=Comision" style="color:#888888;"><strong><i class="glyphicon  glyphicon-log-in"></i> Comision</strong></a>                                     
                                </li> 
                                 <?php } ?>
                                 <?php if($arrayPermisos[13]=="true"){ ?>
                                <li>                                  
                                     <a href="?menu=Movimientos" style="color:#888888;"><strong><i class="glyphicon  glyphicon-log-in"></i> Movimientos</strong></a>
                                  
                                </li> 
                                <?php } ?>    
                                 <?php if($arrayPermisos[20]=="true"){ ?>
                                <li>
                                     <a href="?menu=VendedoresTerceros" style="color:#888888;"><strong><i class="glyphicon  glyphicon-log-in"></i> Clientes</strong></a>                                   
                                </li>  
                                  <?php } ?>  
                            </ul>    
                        </li>
                         <?php } ?> 
                         <?php  ?>    
                            <li>    
                           <a href="#" style="color:#337ab7;"><strong><i class="glyphicon glyphicon-briefcase"></i> Portafolios<span style="float: right;" class="glyphicon glyphicon-triangle-bottom"></span></strong></a>
                            <ul class="nav nav-second-level" >
                                <li>
                                     <a href="?menu=portafolios" style="color:#888888;"><strong><i class="glyphicon  glyphicon-briefcase"></i> Portafolios</strong></a>                                   
                                </li> 
                                <li>
                                     <a href="?menu=infoPortafolio" style="color:#888888;"><strong><i class="glyphicon  glyphicon-info-sign"></i> Procesos de Pedidos</strong></a>                                   
                                </li>   
                            </ul>    
                        </li>
                         <?php  ?> 
                         <li>
                             <?php ?>
                           <!-- <a href="#" style="color:#337ab7;"><strong><img src="../img/sipe.png" style="width: 20px;height: 20px;"> Sipe<span style="float: right;" class="glyphicon glyphicon-triangle-bottom"></span></strong></a>
                            <ul class="nav nav-second-level" >
                                <li>
                                     <a href="?menu=ClientesSipeAdministrar" style="color:#888888;"><strong><i class="glyphicon glyphicon-log-in"></i> Administrar</strong></a>
                                     
                                </li>  
                                <li>
                                     <a href="?menu=ClientesSipe" style="color:#888888;"><strong><i class="glyphicon glyphicon-log-in"></i> Clientes</strong></a>
                                     
                                </li>                                
                            </ul> -->
                            <?php  ?>   
                        </li>
                         <?php if($arrayPermisos[14]=="true"){ ?>                     
                        <li>     
                            <a href="#" style="color:#337ab7;"><strong><i class="glyphicon glyphicon-stats"></i> Informes<span style="float: right;" class="glyphicon glyphicon-triangle-bottom"></span></strong></a>
                                  
                            <ul class="nav nav-second-level" >
                                 <?php if($arrayPermisos[15]=="true"){ ?>
                                <li>
                                     <a href="?menu=CarteraInforme" style="color:#888888;"><strong><i class="glyphicon glyphicon-signal"></i> Cartera</strong></a>                                     
                                </li>  
                                   <?php } ?>
                                   <?php if($arrayPermisos[16]=="true"){ ?>
                                <li> 
                                     <a href="?menu=VentasInforme" style="color:#888888;"><strong><i class="glyphicon glyphicon-signal"></i> Ventas</strong></a>                        
                                </li>
                                <?php } ?>  
                                 <?php if($arrayPermisos[17]=="true"){ ?>               
                                 <li>
                                     <a href="?menu=RecaudoInforme" style="color:#888888;"><strong><i class="glyphicon glyphicon-signal"></i> Recaudo</strong></a>                                 
                                </li> 
                                   <?php } ?>                                      
                            </ul>
                        </li>
                        <?php } ?> 
                          <?php if($arrayPermisos[18]=="true"){ ?>
                           <li>
                             
                            <a href="#" style="color:#337ab7;"><strong><i class="glyphicon glyphicon-cog"></i> Administración<span style="float: right;" class="glyphicon glyphicon-triangle-bottom"></span></strong></a>
                            <ul class="nav nav-second-level" >
                                    <?php if($arrayPermisos[19]=="true"){ ?>
                                <li> 
                                     <a href="?menu=AsignarPermisos" style="color:#888888;"><strong><i class="glyphicon glyphicon-log-in"></i> Asignar Permisos</strong></a>
                                    
                                </li> 
                                   <?php } ?>
                            </ul>            
                        </li>
                          <?php } ?> 
                        <li> 
                            <a href="#" style="color:#337ab7;"><strong><i class="glyphicon glyphicon-cog"></i> Ensamble<span style="float: right;" class="glyphicon glyphicon-triangle-bottom"></span></strong></a>
                            <ul class="nav nav-second-level" >
                                  
                                <li> 
                                     <a href="?menu=LiquidarProductoEnsmable" style="color:#888888;"><strong><i class="glyphicon glyphicon-log-in"></i> Liquidar</strong></a>
                                    
                                </li> 
                                   
                            </ul>            
                        </li>
                         <li> 
                            <a href="#" style="color:#337ab7;"><strong><i class="glyphicon glyphicon-cog"></i> Ventas<span style="float: right;" class="glyphicon glyphicon-triangle-bottom"></span></strong></a>
                            <ul class="nav nav-second-level">
                                <li> 
                                     <a href="?menu=Recepcion" style="color:#888888;"><strong><i class="glyphicon glyphicon-log-in"></i> Recepcion</strong></a>
                                </li> 
                            </ul>            
                        </li>
                        <li class="SessionUL">
                             <a href="?menu=Cerrar" style="color: #337ab7;" ><strong>Cerrar Session</strong></a>
                        </li>   
                    </ul>     
              </div>           
            </div>
    </nav>
</div>
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
