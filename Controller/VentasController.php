<?php
date_default_timezone_set('America/Bogota');
$objVentas= new clsVentasController();
if(isset($_POST['txtMes'])){
if($_POST['txtMes']=='-1'){
				$Tipo='InformeVentasMes';
}else{
				$Tipo='InformeVentasDiario';
}
}
if(isset($_POST['btnPintarEstructuraPorVendedor'])){

$objVentas->CrearEstructuraGraficaVentas($Tipo,$Tipo.'Result','inforGeneralPorVendedor','Vendedor');
}
if(isset($_POST['btnJsInformeVendedor'])){
$objVentas->VentasGraficaJs($Tipo,$Tipo.'Result','inforGeneralPorVendedor','Vendedor');
}

if(isset($_POST['txtMes'])){
if($_POST['txtMes']=='-1'){
				
				$Tipo='InformeVentasMesCiudad';
}else{
				$Tipo='InformeVentasDiarioCiudad';
}
}

if(isset($_POST['btnPintarEstructuraPorCiudades'])){
$objVentas->CrearEstructuraGraficaVentas($Tipo,$Tipo.'Result','inforGeneralPorVendedorCiudad','Ciudad');
}
if(isset($_POST['btnJsInformeCiudades'])){
$objVentas->VentasGraficaJs($Tipo,$Tipo.'Result','inforGeneralPorVendedorCiudad','Ciudad');
}

if(isset($_POST['btnPintarTblVendedores'])){
$objVentas->PintarTablaVendedores(1,'ConsultarVendedores','ConsultarVendedoresResult');
}
if(isset($_POST['btnPintarTblCiudades'])){
$objVentas->PintarTablaVendedores(2,'CarteraPorCiudad','CarteraPorCiudadResult');
}
if(isset($_POST['btnVendedoresAsociados'])){
$objVentas->VendedoresAsociados();

}

$objVentas=null;
class clsVentasController
{	
	private $idCanvas;
	private $UrlWebService;
	private $strAnno;
	private $strMes;
	private $strVendedor;
	private $strVendedorNombre;
	private $intCompania;
	function __construct()
	{
	 $this->UrlWebService="http://10.10.10.150/webservice/WebModaService.asmx?WSDL";
	 $this->strAnno='';
	 $this->strMes='';
	 $this->strVendedor='';
	 $this->strVendedorNombre='';
	 $this->intCompania='';	
	}
	public function ConsultarWebService($Tipo,$strAnno,$strMes,$strCodigoBusqueda,$strParametroTipo,$strVendedoresAsociados){
			$parametros=array(); 
			$parametros['ano']=$strAnno;
			$parametros[$strParametroTipo]=$strCodigoBusqueda;
			$parametros['Cia']=$this->intCompania;
			if($strVendedoresAsociados!=''){
				$parametros['Vendedor']=$strVendedoresAsociados;
			}
			$client = new SoapClient($this->UrlWebService);
			if($strMes=='-1'){
				if($strParametroTipo=='Vendedor'){
				$Tipo='InformeVentasMes';
				}else{
				$Tipo='InformeVentasMesCiudad';
				}
			}else{
				$parametros['mes']=$strMes;
			}


			if($Tipo=='ConsultarVendedores'){
				$WebService=$client->$Tipo();
				return	$WebService;
			}
			$WebService=$client->$Tipo($parametros); 
			$client=null;

		  	return	$WebService;

	}
	public function CiudadesAsociadas(){
			include_once ("../Model/clsVendedoresModel.php");
			$strCiudades='ND';
			$objVendedorModel= new clsVendedoresModel();
		    $objVendedorModel->CiudadesVendedoresAsociados($_SESSION['idLogin']);
	     	$strCiudadesAsociadas=$objVendedorModel->GetRespuesta();
	     	if(sizeof($strCiudadesAsociadas)>=1){
	     		$strCiudades='';
	     	}
	     	$strComa=',';
	     	 for($i=0;$i<=sizeof($strCiudadesAsociadas)-1;$i++){
				     	if($i==sizeof($strCiudadesAsociadas)-1){
							$strCiudades.="'".$strCiudadesAsociadas[$i]['intIdCiudad']."'";	
						}else{
							$strCiudades.="'".$strCiudadesAsociadas[$i]['intIdCiudad']."'".$strComa;	
						}
				}

			return $strCiudades;	  
	    	 
	}
	public function VentasGraficaJs($WebService,$TipoWebService,$idCanvas,$strParametroTipo){
		$this->strAnno=trim($_POST['txtAnno']);
		$this->strMes=trim($_POST['txtMes']);
		$this->strVendedor=trim($_POST['txtVendedor']);
		$this->intCompania=trim($_POST['intCompania']);
		$strVendedoresAsociados='';
		session_start();
		if($this->strVendedor=='' && $_SESSION['idLogin']!='1' && $strParametroTipo=='Vendedor') {
			$this->strVendedor=$this->VendedoresAsociados();			
		}
		if($this->strVendedor!=''  &&  $strParametroTipo=='Ciudad'){
			$this->strVendedor=trim("'".$this->strVendedor."'");
			$strVendedoresAsociados=$this->VendedoresAsociados();
		}
		if($this->strVendedor=='' && $_SESSION['idLogin']!='1' && $strParametroTipo=='Ciudad'){
		
			$this->strVendedor=$this->CiudadesAsociadas();
			$strVendedoresAsociados=$this->VendedoresAsociados();		

		}
		$ContenidoWebService=$this->ConsultarWebService($WebService,$this->strAnno,$this->strMes,$this->strVendedor,$strParametroTipo,$strVendedoresAsociados);
		$InformeCartera='';
		$Suma=0.0;
		$Nro="";
		$ColorFondo="";
		$ColorBorder="";
		$k=0;
		$ContadorGraficaJS=0;
		$Porcentaje="";
		$blnColor=true;
		$DatosInforme=explode("%",$ContenidoWebService->$TipoWebService);
		for($i=0;$i<=(sizeof($DatosInforme)-2);$i=$i+2){
		$Suma+=(double)$DatosInforme[$i+1];	
		}
		for($i=0;$i<=(sizeof($DatosInforme)-2);$i=$i+2){
			if($DatosInforme[$i+1] > 0){	
			$Porcentaje.=(int)$DatosInforme[$i+1].",";
			$Nro.=(int)$DatosInforme[$i]." , ";
			if((bool)$blnColor){
				$ColorFondo.= "rgb(102, 0, 255,0.2)*";
				$ColorBorder.="rgb(102, 0, 255,0.8)*";
				$blnColor=false;
			}else{
				$blnColor=true;
			    $ColorFondo.= "rgb(128, 159, 255,0.2)*";
			    $ColorBorder.="rgb(128, 159, 255,0.8)*";
			}	
			if($k==20){
				$ContadorGraficaJS++;
				$k=0;
			}					
			$k++;
			}
		}		                                		                        
	      echo trim($Nro)."?".trim($ColorFondo)."?".trim($ColorBorder)."?".number_format(trim($Suma))."?".trim($Porcentaje)."?".trim($ContadorGraficaJS);      
	        $ContenidoWebService=null;
	        $DatosInforme=null;                        	
	}
	public function CrearEstructuraGraficaVentas($WebService,$TipoWebService,$idCanvas,$strParametroTipo){
			$this->strAnno=trim($_POST['txtAnno']);
		$this->strMes=trim($_POST['txtMes']);
		$this->strVendedor=trim($_POST['txtVendedor']);
		$this->strVendedorNombre=trim($_POST['txtNombre']);
		$this->intCompania=trim($_POST['intCompania']);
		$strVendedoresAsociados='';
		session_start();
		if($this->strVendedor=='' && $_SESSION['idLogin']!='1' && $strParametroTipo=='Vendedor'){
			$this->strVendedor=$this->VendedoresAsociados();			
		}
		if($this->strVendedor!=''  &&  $strParametroTipo=='Ciudad'){
			$this->strVendedor=trim("'".$this->strVendedor."'");
			$strVendedoresAsociados=$this->VendedoresAsociados();
		}
		if($this->strVendedor=='' && $_SESSION['idLogin']!='1' && $strParametroTipo=='Ciudad'){
		
			$this->strVendedor=$this->CiudadesAsociadas();
			$strVendedoresAsociados=$this->VendedoresAsociados();

		}

		$ContenidoWebService=$this->ConsultarWebService($WebService,$this->strAnno,$this->strMes,$this->strVendedor,$strParametroTipo,$strVendedoresAsociados);
			$TablaDatosGrafica='';
		
		$DatosInforme=explode("%",$ContenidoWebService->$TipoWebService);	
		if($ContenidoWebService->$TipoWebService==null || $DatosInforme[1]==0){
			echo $TablaDatosGrafica.="<tr style='display:none;'><td class='text-center'><strong>No hay registros.</strong></td><td></td></tr>";

		}
		$strTextoTblGrafica='';
		$strTipoTituloTblGrafica='Dias';
		$strMeses =  array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$blnMeses=false;
		if($this->strMes=='-1'){
			$blnMeses=true;
			$strTipoTituloTblGrafica='Meses';
			$this->strMes='Ninguno';
		}else{
			for($j=0;$j<=11;$j++){
						if($this->strMes==($j+1)){
							$this->strMes=$strMeses[$j];
							break;
					}
				}
		}
		if($this->strVendedor==''){
			$this->strVendedorNombre='Ninguno';
		}
		for($i=0;$i<=(sizeof($DatosInforme)-2);$i=$i+2){
			if($DatosInforme[$i+1] > 0){
			if((bool)$blnMeses){
					for($j=0;$j<=11;$j++){
						if(trim($DatosInforme[$i])==($j+1)){
							$strTextoTblGrafica=$strMeses[$j];
							break;
					}
				}
			}else{
				$strTextoTblGrafica=$DatosInforme[$i];
			}
			$TablaDatosGrafica.="<tr><td  class='text-center'>".$strTextoTblGrafica."</td><td  class='text-center'>".number_format((double)$DatosInforme[$i+1])."</td></tr>";
			}
		}
		$Estructura="<div id='Cont".$idCanvas."'><br><div class='row'><div class='col-lg-12 text-center'><label>".$strParametroTipo.":<small>".$this->strVendedorNombre."</small>&nbsp;&nbsp;Año:<small>".$this->strAnno."</small>&nbsp;&nbsp;Mes:<small>".$this->strMes."</small></label><input type='text' placeholder='Buscar' id='txtBuscarEstadistica' onkeyup='BusquedaTbl(\"txtBuscarEstadistica\",\"tblVentaEstadistica\");' class='form-control'></div></div><br><div style='overflow:scroll;height:200px;'><table class='table table-striped'><thead><th class='text-center'>".$strTipoTituloTblGrafica."</th><th class='text-center'>Monto</th></thead><tbody id='tblVentaEstadistica'>".$TablaDatosGrafica."</tbody></table></div></div>";  
		echo $Estructura;
		$ContenidoWebService=null;
		
	}
public function PintarTablaVendedores($Tipo,$WebService,$MensajeWebService){
		  $EstructuraTabla="";		  
		  $TablaVendedores=$this->ConsultarWebService($WebService,0,0,0,0,'');
		  include_once ("../Model/clsVendedoresModel.php");
		  session_start();
		  $objVendedoresAsociados=new clsVendedoresModel();
		  $objVendedoresAsociados->ConsultarEmpleadosAsociados($_SESSION['idLogin'],'','2');
		  $strVendedoresAsociados=$objVendedoresAsociados->GetRespuesta();	


		  $objVendedorModel= new clsVendedoresModel();
		  $objVendedorModel->CiudadesVendedoresAsociados($_SESSION['idLogin']);
	      $strCiudadesAsociadas=$objVendedorModel->GetRespuesta();

		  if(sizeof($strVendedoresAsociados)=='0'  && $_SESSION['idLogin']!='1'){
		  	$EstructuraTabla='<tr><td><h3>No tiene empleados asociados.</h3></td></tr>';
		  }
		  $k=1;
		switch ($Tipo) {
			case 1:
			 $DatosWebService=explode('&',$TablaVendedores->$MensajeWebService);
				for($i=1;$i<=sizeof($DatosWebService)-2;$i++){				
					  	$DatosVendedoresFila=explode('%',$DatosWebService[$i]);
					  	$blnBandera=false;	
					  	for($j=0;$j<=sizeof($objVendedoresAsociados->GetRespuesta())-1;$j++){
							if($strVendedoresAsociados[$j]['strCedulaEmpleado']==$DatosVendedoresFila[0]){
								$blnBandera=true;
							}
						}
						if($_SESSION['idLogin']=='1'){
							$blnBandera=true;
						}
						if($blnBandera){
					  	if(trim($DatosVendedoresFila[2])!='0'){	  	
					  	$EstructuraTabla.="<tr id='cell".$k."'><td><button type='button' class='btn btn-default' onclick='PintarEstructura(1,".$k.");'><i class='glyphicon glyphicon-log-in'></i></button></td><td>".$DatosVendedoresFila[0]."</td><td>".$DatosVendedoresFila[1]."</td><td style='display:none;'>".$DatosVendedoresFila[2]."</td><td>".$DatosVendedoresFila[3]."</td></tr>";		  	
					  		$k++;
					  		}	  	
						}}
				break;
			
			case 2: 
				 $DatosWebService=explode('%',$TablaVendedores->$MensajeWebService);
				for($i=0;$i<=(sizeof($DatosWebService)-2);$i=$i+3){	  

						$blnBandera=false;	
					  	for($j=0;$j<=sizeof($strCiudadesAsociadas)-1;$j++){
							if($strCiudadesAsociadas[$j]['intIdCiudad']==$DatosWebService[$i]){
								$blnBandera=true;
								break;
							}
						}
						if($_SESSION['idLogin']=='1'){
							$blnBandera=true;
						}
						if($blnBandera){		
					  	$EstructuraTabla.="<tr id='cellCiudades".$k."'><td><button type='button' class='btn btn-default' onclick='PintarEstructura(2,".$k.");'><i class='glyphicon glyphicon-log-in'></i></button></td><td>".$DatosWebService[$i]."</td><td>".$DatosWebService[$i+1]."</td></tr>";		  	
					  		$k++;}	  	
				}
				break;

		}
		  
		 echo $EstructuraTabla;
	
	}
	public function VendedoresAsociados(){
				@session_start();
				$intTipo=trim($_POST['intTipo']);
				if($_SESSION['idLogin']!='1'){
				  include_once ("../Model/clsVendedoresModel.php");

				  $strVendedores='';
		  		  $strComa=',';
				  $objVendedoresAsociados=new clsVendedoresModel();
				  $objVendedoresAsociados->ConsultarEmpleadosAsociados($_SESSION['idLogin'],'','2');
				  $strVendedoresAsociados=$objVendedoresAsociados->GetRespuesta();	
				  if($strVendedoresAsociados==null){
				  	$strVendedores='false';
				  }
				  for($i=0;$i<=sizeof($strVendedoresAsociados)-1;$i++){
				     	if($i==sizeof($strVendedoresAsociados)-1){
							$strVendedores.="'".$strVendedoresAsociados[$i]['strCedulaEmpleado']."'";	
						}else{
							$strVendedores.="'".$strVendedoresAsociados[$i]['strCedulaEmpleado']."'".$strComa;	
						}
				  }
				  if($intTipo=='1'){
					  return $strVendedores;
					}else{
					  echo 'true';
					}
				}else{
					echo 'true';
				}	
	}
}