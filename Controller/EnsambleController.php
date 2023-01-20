<?php 
require_once('../WebServices/clsEnsambleWebService.php');
$objEnsambleController = new clsEnsambleController();
if (isset($_POST['btnConsultarProducto'])) {
$objEnsambleController->ProductoEnsamble();
}
$objEnsambleController=null;
class clsEnsambleController{
	private $strReferencia;
	private $intCantReferencia;
	private $intCantManoObra;
	private $intValorManoObra;
	public function __construct(){
		$this->strReferencia='';
		$this->intCantReferencia='';
		$this->intValorManoObra='';
		$this->intCantManoObra='';
	}
	public function ProductoEnsamble(){
		$this->strReferencia=trim($_POST['strReferencia']);
		$this->intCantReferencia=trim($_POST['intCantReferencia']);
		$this->intCantManoObra=trim($_POST['intCantManoObra']);
		$this->intValorManoObra=trim($_POST['intValorManoObra']);
		if($this->intValorManoObra==''){
			$this->intValorManoObra=0;
		}
		$objWebService = new clsEnsambleWebService();
		$objWebService->ProductoEnsamble($this->strReferencia);
		$strRespuesta=json_decode($objWebService->GetRespuestaWs());
		$strContenido='';
		$intTotal=0;
		$intBandera=1;
		$blnEstado=true;
			for($i=0;$i<=sizeof($strRespuesta)-1;$i++){
			@$intCantidad=$strRespuesta[$i]->intcantidad*$this->intCantReferencia;
			if($intBandera==1){
			$strContenido.="<tr><td style='border:none;text-align: center;border-right:1px solid #ddd;border-left:1px solid #ddd;'>".$this->strReferencia."</td></tr><tr><td style='border-top:none;border-left:1px solid #ddd;border-bottom:1px solid #ddd;border-right:1px solid #ddd;text-align: center;'>".$strRespuesta[$i]->strdescripcionproducto."</td></tr>";
			}
			$intBandera=0;
			$strContenido.="<tr><td style='border:none;'></td><td style='border-left:1px solid #ddd;border-right:1px solid #ddd;'>".$strRespuesta[$i]->strproductosecundario."</td><td style='border-right:1px solid #ddd;'>".$strRespuesta[$i]->strdescripcion."</td><td style='border-right:1px solid #ddd;'>".$strRespuesta[$i]->strunidad."</td ><td style='border-right:1px solid #ddd;'>".$strRespuesta[$i]->intcantidad."</td><td style='border-right:1px solid #ddd;'>".$intCantidad."</td><td style='border-right:1px solid #ddd;'>".($strRespuesta[$i]->intprecio1)."</td><td style='border-right:1px solid #ddd;'>".($strRespuesta[$i]->intotal)."</td></tr>";
			$blnEstado=false;
			@$intTotal+=($strRespuesta[$i]->intotal);
		}
		if($blnEstado){
			$strContenido="<tr><td><h4>El producto ".$this->strReferencia." no tiene ensamble.</h4></td></tr>";
		}else{
			$strContenido.="<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style='border:1px solid #ddd;'><strong>Costo: </strong>".($intTotal+($this->intCantManoObra*$this->intValorManoObra))." <strong><br>Precio 1: </strong>".(($intTotal+($this->intCantManoObra*$this->intValorManoObra))*1.55)*1.19."<br><strong>Precio 2: </strong>".(($intTotal+($this->intCantManoObra*$this->intValorManoObra))*1.75)*1.19."</td></tr>";
		}
		echo $strContenido;
	}

}