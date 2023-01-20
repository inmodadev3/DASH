<?php

require_once('../Classes/nusoap/nusoap.php');
class clsEnsambleWebService 
{
	private $urlWebService;
	private $strRespuestaWs;
	private $strParametros;
	function __construct()
	{
		$this->urlWebService='http://10.10.10.128/WebServicePortal/WebService/WebServiceProductos.php?wsdl';
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
	public function ProductoEnsamble($strReferencia){
		$this->parametros= array('strReferencia'=>$strReferencia);
		$this->strRespuestaWs=$this->ConsultarWebService('ProductoEnsamble',true);
	}
	public function ListarUbicacionProductos($strProductos){
		$this->parametros= array('strProductos'=>$strProductos);
		$this->strRespuestaWs=$this->ConsultarWebService('ListarUbicacionProductos',true);
	}

}