<?php
date_default_timezone_set('America/Bogota');
@session_start();
include_once ("../Model/clsCartaColoresModel.php");
include_once ("../WebServices/clsProductoWebService.php");

$objCartaColor= new clsCartaColoresController();
if(isset($_POST['btnCrearCartaColores'])){
	$objCartaColor->CrearCartaColores();
}
if(isset($_POST['btnListarCartaColores'])){
	$objCartaColor->ListarCartaColores();
}
if(isset($_POST['btnEditarCartaColores'])){
	$objCartaColor->EditarCartaColores();
}
if(isset($_POST['btnEliminarCartaColores'])){
	$objCartaColor->EliminarCartaColores();
}
if(isset($_POST['btnListarColoresPorProductoHGI'])){
	$objCartaColor->ListarColoresPorProductoHGI();
}
if(isset($_POST['btnAgregarColorACartaColores'])){
	$objCartaColor->AgregarColorACartaColores();
}
if(isset($_POST['btnListarDetallCartaColores'])){
	$objCartaColor->ListarDetallCartaColores();
}
if(isset($_POST['btnEliminarColorDeCarta'])){
	$objCartaColor->EliminarColorDeCarta();
}
if(isset($_POST['btnPresentacionPorProducto'])){
	$objCartaColor->GetPresentacionPorProducto();
}
$objCartaColor=null;
class clsCartaColoresController
{
	//Crear Carta Colores
	public function CrearCartaColores(){
		$strDescripcionCarta=trim($_POST['txtDescripcionCarta']);
		$strIdReferencia=trim($_POST['txtIdReferencia']);
		$strPresentacion=trim($_POST['strPresentacion']);

		//Validar referencia escrita si existe en el HGI
		$objWsProducto= new clsProductoWebService();
		$objWsProducto->ValidarExistenciaProducto($strIdReferencia);
		if(sizeof(json_decode($objWsProducto->GetRespuestaWs()))==0){
			echo json_encode("No éxiste la referencia en el HGI.");
		}else{
			//Crear Carta de colores
			$objCartaModel= new clsCartaColoresModel();
			$objCartaModel->CrearCartaColores($strDescripcionCarta,$strIdReferencia,$_SESSION['idLogin'],$strPresentacion);
			echo json_encode($objCartaModel->GetRespuesta()[0]['strMensaje']);
		}
	}
	//Listar Carta de colores
	public function ListarCartaColores(){
		$objCartaModel = new clsCartaColoresModel();

		$objCartaModel->ListarCartaColores($_SESSION['idLogin']); 
		$ArrayCartaColores=$objCartaModel->GetRespuesta();
		$Json=array();
		foreach($ArrayCartaColores as $array){
            array_push($Json,$array);//Convierte el Array en json ordenado
        }
        echo json_encode($Json); //Devuelve el json al view
    }
    //Eliminar Carta de colores
    public function EliminarCartaColores(){
    	$intIdCartaColores=trim($_POST['intIdCartaColores']);
    	$objCartaModel = new clsCartaColoresModel();
    	$objCartaModel->EliminarCartaColores($intIdCartaColores); 
    }
    //Editar carta colores
    public function EditarCartaColores(){
    	$strDescripcionCarta=trim($_POST['strDescripcion']);
    	$intIdCartaColores=trim($_POST['intIdCartaColores']);
    	$strPresentacion=trim($_POST['strPresentacion']);

    	$objCartaModel = new clsCartaColoresModel();
    	$objCartaModel->EditarCartaColores($intIdCartaColores,$strDescripcionCarta,$strPresentacion);
    } 
    //Listar colores producto HGI
    public function ListarColoresPorProductoHGI(){
    	$strIdReferencia=trim($_POST['intIdRefHGI']);
    	$objWsProducto= new clsProductoWebService();
    	$objWsProducto->ListarColoresPorProductoHGI($strIdReferencia);

    	echo $objWsProducto->GetRespuestaWs();
    }
    //Listar presentacion producto HGI
    public function GetPresentacionPorProducto(){
    	$strIdReferencia=trim($_POST['strIdReferencia']);
    	$objWsProducto= new clsProductoWebService();
    	$objWsProducto->GetPresentacionPorProducto($strIdReferencia);

    	echo $objWsProducto->GetRespuestaWs();
    }
    //Seleccionar color a una carta 
    public function AgregarColorACartaColores(){
    	$intIdCartaColores=trim($_POST['intIdCartaColores']);
    	$strIdColor=trim($_POST['strIdColor']);
    	$strDescripcion=trim($_POST['strDescripcion']);
    	$intCantColor=trim($_POST['intCantColor']);
    	$intIdUsuario=trim($_SESSION['idLogin']);

    	$objCartaModel= new clsCartaColoresModel();
    	$objCartaModel->AgregarColorACartaColores($intIdCartaColores,$strIdColor,$strDescripcion,$intCantColor,$intIdUsuario);

    	echo (json_encode($objCartaModel->GetRespuesta()[0]['strMensaje']));
    }
    //Listar detalle carta de colores
	public function ListarDetallCartaColores(){
		$intIdCartaColores=trim($_POST['intIdCartaColores']);
		$objCartaModel = new clsCartaColoresModel();
		$objCartaModel->ListarDetallCartaColores($intIdCartaColores); 
		$ArrayCartaColores=$objCartaModel->GetRespuesta();
		$Json=array();
		foreach($ArrayCartaColores as $array){
            array_push($Json,$array);//Convierte el Array en json ordenado
        }
        echo json_encode($Json); //Devuelve el json al view
    }
     //Eliminar color de carta colores
	public function EliminarColorDeCarta(){
		$intIdDetallCartaColores=trim($_POST['intIdDetallCartaColores']);
		$objCartaModel = new clsCartaColoresModel();
		$objCartaModel->EliminarColorDeCarta($intIdDetallCartaColores); 
		
		echo 'eliminado';
    }
}