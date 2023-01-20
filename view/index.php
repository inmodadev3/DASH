<!DOCTYPE html>
<html lang="es">
	<?php
	session_start(); 	
	if(!isset($_SESSION['Empleado'])){

	    echo "<script language='javascript'>window.location='../view/Login.php'</script>;"; 
	}
	include_once('templates/header.php');
	require_once('templates/footer.php');
	if (isset($_GET['menu'])) {			
			if ($_GET['menu']=='Compra') {
			   require_once('../view/compras/registrarCompras.php');		
			}
			else if ($_GET['menu']=='Estados') {
			   require_once('../view/compras/Estados.php');		
			} 
		    else if ($_GET['menu']=='Liquidar') {
			   require_once('../view/compras/Liquidar.php');		
			} 
			else if ($_GET['menu']=='Stickers') {
			   require_once('../view/Stickers/AgregarStickers.php');		
			}
			else if ($_GET['menu']=='GenerarPedido') {
			   require_once('../view/compras/GenerarPedido.php');		
			} 
			else if($_GET['menu']=='GenerarExcelPedido'){
			 require_once('../view/compras/GenerarExcelPedido.php');	
			} 
		    else if($_GET['menu']=='AsignarPermisos'){
			 require_once('../view/Administrador/AsignarPermisos.php');	
			} 
			else if($_GET['menu']=='Inicio'){
			 require_once('../view/templates/Inicio.php');	
			} 
			else if($_GET['menu']=='Cartera'){
			 require_once('../view/Cartera/CarteraInforme.php');	
			}else if($_GET['menu']=='Ciudades'){
			 require_once('../view/Ciudades/Ciudades.php');	
			}  
			else if($_GET['menu']=='Vendedores'){
			 require_once('../view/Vendedores/Vendedores.php');	
			}
			else if($_GET['menu']=='PedidosVendedores'){
			 require_once('../view/Pedidos/PedidosVendedores.php');	
			}
			else if($_GET['menu']=='Comision'){
			 require_once('../view/Vendedores/Comision.php');	
			}
			else if($_GET['menu']=='Movimientos'){
				 require_once('../view/Vendedores/Movimientos.php');
			}
			 else if($_GET['menu']=='ClientesSipe'){
			 require_once('../view/Sipe/Clientes.php');	
			} else if($_GET['menu']=='ClientesSipeAdministrar'){
			 require_once('../view/Sipe/Administrar.php');	
			} 
			 else if($_GET['menu']=='CarteraInforme'){
			 require_once('../view/Informes/CarteraInforme.php');	
			} 
			else if($_GET['menu']=='VentasInforme'){
			 require_once('../view/Informes/VentasInforme.php');	
			} 
			else if($_GET['menu']=='RecaudoInforme'){
			 require_once('../view/Informes/RecaudoInforme.php');	
			}
			else if($_GET['menu']=='LiquidarProductoEnsmable'){
			 require_once('../view/Ensamble/Ensamble.php');	
			}
			else if($_GET['menu']=='VendedoresTerceros'){
			 require_once('../view/Vendedores/Terceros.php');	
			}
			 else if($_GET['menu'] =='portafolios'){
			 	if (isset($_GET['id'])) {
			 		$_SESSION['idportafolio'] = $_GET['id'];
			 	}
			 	require_once('../view/Vendedores/portafolios.php'); 
			 }
			 else if($_GET['menu'] =='infoPortafolio'){
			 	require_once('../view/Portafolio/Informacion.php');
			 	
			}else if($_GET['menu']=='Recepcion'){
			 require_once('../view/Ventas/Recepcion.php');	
			}else if($_GET['menu']=='AgotadosFotos'){
			 require_once('../view/Agotados/Fotos.php');	
			}else if($_GET['menu']=='CrearCompanias'){
			 require_once('../view/Compañias/Compañias.php');	
			}else if($_GET['menu']=='CartaColores'){
			 require_once('../view/CartaColores/CartaColores.php');	
			}else if($_GET['menu']=='BuscarProducto'){
			 require_once('../view/Producto/BusquedaProducto.php');	
			}
		    else if($_GET['menu']=='Cerrar'){
				session_destroy();
				echo "<script language='javascript'>window.location='../view/Login.php'</script>;";
			}else{
				 require_once('../view/templates/error.php');
			}
		}else{
			if(isset($_SESSION['Empleado'])){
    			echo "<script language='javascript'>window.location='../view/Index.php?menu=Inicio'</script>;"; 
			}else{
			echo "<script language='javascript'>window.location='../view/Login.php'</script>;";
			}	
		}
	?>
<footer>		
</footer>	
</body>
</html>
