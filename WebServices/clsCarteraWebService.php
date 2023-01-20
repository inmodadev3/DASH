<?php
require_once('../Classes/nusoap/nusoap.php');
class clsCarteraWebService 
{
	private $urlWebService;
	private $strRespuestaWs;
	private $strParametros;
	function __construct()
	{
		$this->urlWebService='http://10.10.10.128/WebServicePortal/WebService/WebServiceCartera.php?wsdl';
		$this->strRespuestaWs='';
		$this->strParametros='';
	}
	public function ConsultarWebService($strMetodo,$blnParametros){
		$wsCliente='';
		$strWsRespuesta='';
		if($blnParametros){
			$wsCliente = new nusoap_client($this->urlWebService, 'wsdl');
			$strWsRespuesta=$wsCliente->call($strMetodo,$this->parametros);
		}else{
			$wsCliente = new SoapClient($this->urlWebService);
		    $strWsRespuesta=$wsCliente->$strMetodo();
		}
		return $strWsRespuesta;
	}
	public function GetRespuestaWs(){
		return $this->strRespuestaWs;
	}
	public function CarteraGeneral($intCompania,$blnTop,$strCiudad){
		$this->parametros= array('intCompania'=>$intCompania,'blnTop'=>$blnTop,'strCiudad'=>$strCiudad);
		$this->strRespuestaWs=$this->ConsultarWebService('CarteraGeneral',true);
	}
	public function BuscarTerceroCartera($intCompania,$strNombre,$strCiudad){
		$this->parametros= array('intCompania'=>$intCompania,'strNombre'=>$strNombre,'strCiudad'=>$strCiudad);
		$this->strRespuestaWs=$this->ConsultarWebService('BuscarTerceroCartera',true);
	}

}