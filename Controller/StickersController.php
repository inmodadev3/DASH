<?php 

include_once("../Model/clsComprasModel.php");

$clsStikersController = new clsStikersController();

if (isset($_POST['btnConsultarReferencias'])) {
	$clsStikersController->ConsultarReferencias();
}

class clsStikersController 
{
	function __construct()
	{
		
	}

	public function ConsultarReferencias()
	{
		$view="";
		$clsComprasModel = new clsComprasModel();
		$rpta = $clsComprasModel->consultarDetalleCompra(2);
		if ($rpta != null) {
			for ($i=0; $i < sizeof($rpta); $i++) { 
				//echo $rpta[$i]['intIdDetalle']."<br>";
				$view.="
					<tr>
						<td>".$i."</td>
						
						<td id='referencia".$i."'>".$rpta[$i]['strReferencia']."</td>
                        <td style='display: none;' id='id".$i."'>".$rpta[$i]['intIdDetalle']."</td>                                            
                        <td id='descripcion".$i."'>".$rpta[$i]['strDescripcion']."</td>                                                      
                        <td id='unidadMedida".$i."'>".$rpta[$i]['strUnidadMedida']."</td>  
						<td class='boton btn btn-primary' onClick='CargarFormulario(".$i.");'><i class='glyphicon glyphicon-repeat'></i> Cargar</td> 
						<td style='display: none;' id='intCantidad".$i."'>".$rpta[$i]['intCantidad']."</td>
						<td style='display: none;' id='intPrecio1".$i."'>".$rpta[$i]['intPrecio1']."</td> 
						<td style='display: none;' id='intPrecio2".$i."'>".$rpta[$i]['intPrecio2']."</td> 
						<td style='display: none;' id='intPrecio3".$i."'>".$rpta[$i]['intPrecio3']."</td> 
						<td style='display: none;' id='intPrecio4".$i."'>".$rpta[$i]['intPrecio4']."</td> 
						<td style='display: none;' id='intPrecio5".$i."'>".$rpta[$i]['intPrecio5']."</td> 

					</tr>		


				";
			}
		}else{
			$view.="No hay informacion";
		}
		echo $view;
		//var_dump($rpta); //validar cuando esten los registros para mostrar la tabla
	}

}

 ?>