<?php
require_once('../Classes/nusoap/nusoap.php');
class clsTerceroWebService
 
{
	private $urlWebService;
	private $strRespuestaWs;
	private $strParametros;
	function __construct()
	{
		$this->urlWebService='http://10.10.10.128/WebServicePortal/WebService/WebServiceTercero.php?wsdl';
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


	/*----------------------- VISTA  VENDEDOR-TERCERO -------------------------------------*/
	
	public function ListarTerceroPorCiudad($strIdCiudad,$strTipoLista,$strTercero){
		$this->parametros= array('strIdCiudad'=>$strIdCiudad,'strTipoLista'=>$strTipoLista,'strTercero'=>$strTercero);
		$this->strRespuestaWs=$this->ConsultarWebService('ListarTerceroPorCiudad',true);
	}

	/*----------------------- VISTA RECEPCION -------------------------------------*/
	
	public function BuscarTerceroRecepcion($strNombre){
		$this->parametros= array('strName'=>$strNombre);
		$this->strRespuestaWs=$this->ConsultarWebService('BuscarTerceroRecepcion',true);
	}
	public function ConsultarMvTerceros($strCedula){
		$this->parametros= array('strCedula'=>$strCedula);
		$this->strRespuestaWs=$this->ConsultarWebService('ConsultarMvTerceros',true);
	}
	public function ConsultarDetalleDocTercero($strDocumento,$strCedula,$intIdTransaccion){
		$this->parametros= array('strDocumento'=>$strDocumento,'strCedula'=>$strCedula,'intIdTransaccion'=>$intIdTransaccion);
		$this->strRespuestaWs=$this->ConsultarWebService('ConsultarDetalleDocTercero',true);
	}
	public function ActualizarTercero($strCedula,$strNombre1,$strNombre2,$strApellido1,$strApellido2,$intIdSegmento,$strEstadoFoto,$strDireccion1,$strDireccion2,$strTelefono1,$strTelefono2,$intIdCiudad){
		$this->parametros= array('strCedula'=>$strCedula,'strNombre1'=>$strNombre1,'strNombre2'=>$strNombre2,'strApellido1'=>$strApellido1,'strApellido2'=>$strApellido2,'intIdSegmento'=>$intIdSegmento,'strEstadoFoto'=>$strEstadoFoto,'strDireccion1'=>$strDireccion1,'strDireccion2'=>$strDireccion2,'strTelefono1'=>$strTelefono1,'strTelefono2'=>$strTelefono2,'intIdCiudad'=>$intIdCiudad);
		$this->strRespuestaWs=$this->ConsultarWebService('ActualizarTercero',true);
	}
	public function ConsultarPrecioPorSegmento($strIdSegmento){
		$this->parametros= array('strIdSegmento'=>$strIdSegmento);
		$this->strRespuestaWs=$this->ConsultarWebService('ConsultarPrecioPorSegmento',true);
	}
	public function ListarTiposTerceros(){
		$this->strRespuestaWs=$this->ConsultarWebService('ListarTiposTerceros',false);
	}

}