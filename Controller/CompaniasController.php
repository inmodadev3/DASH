<?php 
@session_start();
date_default_timezone_set('America/Bogota');
include_once ("../WebServices/clsClaseWebService.php");
include_once ("../Model/clsCompaniasModel.php");
$objCompania=new clsCompaniaController();
if(isset($_POST['btnGetClases'])){
	$objCompania->GetClases();
}
if(isset($_POST['btnCrearCompania'])){
	$objCompania->AddCompania();
}
if(isset($_POST['btnListarCompanias'])){
	$objCompania->GetCompanias();
}
if(isset($_POST['btnEliminarCompania'])){
	$objCompania->DeleteCompania();
}
if(isset($_POST['btnEditarCompania'])){
	$objCompania->EditCompania();
}
if(isset($_POST['btnDetalleCompania'])){
	$objCompania->GetDetalleCompania();
}
if(isset($_POST['btnAsignarClaseACompania'])){
	$objCompania->AsignarClaseACompania();
}
if(isset($_POST['btnEliminarClaseDtCompania'])){
	$objCompania->EliminarClaseDtCompania();
}
$objCompania=null;
class clsCompaniaController 
{
	//Obtener todas las clases del HGI para el respectivo uso en HGI
	public function GetClases(){
		$objClasesWs= new clsClaseWebService();
		$objClasesWs->GetClases();
		echo $objClasesWs->GetRespuestaWs();
	}
	//Crear compañia
	public function AddCompania(){
		$strDescripcion=trim($_POST['strDescripcion']);
		$objCompania= new clsCompaniasModel();
		$objCompania->AddCompania($strDescripcion,$_SESSION['idLogin']);
		echo json_encode('Compañia '.$strDescripcion.' creada con éxito.');
	}
	//Listar compañias
	public function GetCompanias(){
		$objCompania= new clsCompaniasModel();
		$objCompania->GetCompanias();
		$strCompanias = $objCompania->GetRespuesta();
		$Json=array(); 
		foreach($strCompanias as $array){
            array_push($Json,$array);//Convierte el Array en json ordenado
        }
        echo json_encode($Json);
    }
	//Eliminar compañia
    public function DeleteCompania(){
    	$strIdCompania=trim($_POST['strIdCompania']);
    	$objCompania= new clsCompaniasModel();
    	$objCompania->DeleteCompania($strIdCompania);
    	echo json_encode('Compañia eliminada con éxito.');
    }
	//Editar compañia
    public function EditCompania(){
    	$strIdCompania=trim($_POST['strIdCompania']);
    	$strDescripcion=trim($_POST['strDescripcion']);
    	$objCompania= new clsCompaniasModel();
    	$objCompania->EditCompania($strIdCompania,$strDescripcion);
    	echo json_encode('Compañia editada con éxito.');
    }
	//Detalle compañia
    public function GetDetalleCompania(){
    	$strIdCompania=trim($_POST['strIdCompania']);
    	$objCompania= new clsCompaniasModel();
    	$objCompania->GetDetalleCompania($strIdCompania);
    	$strCompanias = $objCompania->GetRespuesta();
    	$Json=array(); 
    	foreach($strCompanias as $array){
            array_push($Json,$array);//Convierte el Array en json ordenado
        }
        echo json_encode($Json);
    }
    //Asignar clase a compañia
    public function AsignarClaseACompania(){
    	$strIdCompania=trim($_POST['strIdCompania']);
    	$strIdClase=trim($_POST['strIdClase']);
    	$strDescripcionCls=trim($_POST['strDescripcionCls']);
    	$objCompania= new clsCompaniasModel();
    	$objCompania->AsignarClaseACompania($strIdCompania,$strIdClase,$strDescripcionCls,$_SESSION['idLogin']);
    	$strCompanias = $objCompania->GetRespuesta();
    	echo json_encode($strCompanias[0]['strMensaje']);
    }
    //Eliminar clase del detalle de una compañia
    public function EliminarClaseDtCompania(){
    	$strIdCompania=trim($_POST['strIdCompania']);
    	$strIdClase=trim($_POST['strIdClase']);
    	$objCompania= new clsCompaniasModel();
    	$objCompania->EliminarClaseDtCompania($strIdCompania,$strIdClase);
    }
}