<?php

require_once('../Classes/nusoap/nusoap.php');
class clsProductoWebService 
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
	public function ValidarExistenciaProducto($strReferencia){
		$this->parametros= array('strReferencia'=>$strReferencia);
		$this->strRespuestaWs=$this->ConsultarWebService('Producto',true);
	}
	public function ListarColoresPorProductoHGI($strIdProducto){
		$this->parametros= array('strIdProducto'=>$strIdProducto);
		$this->strRespuestaWs=$this->ConsultarWebService('ColoresPorProducto',true);
	}
	public function GetPresentacionPorProducto($strIdProducto){
		$this->parametros= array('strIdProducto'=>$strIdProducto);
		$this->strRespuestaWs=$this->ConsultarWebService('PresentacionPorProducto',true);
	}
	
	public function GetCantidadFinalProducto($strReferencia){
		$this->parametros= array('strReferencia'=>$strReferencia);
		$this->strRespuestaWs=$this->ConsultarWebService('CantidadFinalProducto',true);
	}

	public function GetProductos($strReferencia,$intNroResultados){
		$this->parametros= array('strReferencia'=>$strReferencia,'intNroResultados'=>$intNroResultados);
		$this->strRespuestaWs=$this->ConsultarWebService('BusquedaProductosCoincidencias',true);
	}
	public function GetImagenesProductos($strReferencia){
		$this->parametros= array('strReferencia'=>$strReferencia);
		$this->strRespuestaWs=$this->ConsultarWebService('ImagenesProducto',true);
	}
	public function ConsultarPrecios($strReferencia){
		$this->parametros = array('strReferencia'=>$strReferencia);
		$this->strRespuestaWs=$this->ConsultarWebService('Producto',true);
	}
}