<?php
require_once('../Classes/nusoap/nusoap.php');
class clsDocumentoWebService 
{
	private $urlWebService;
	private $strRespuestaWs;
	private $strParametros;
	function __construct()
	{
		$this->urlWebService='http://10.10.10.128/WebServicePortal/WebService/WebServiceDocumento.php?wsdl';
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

	/*----------------------------------VISTA RECEPCIÓN-------------------------------------*/

	
	public function EnviarPedidoHgi($IntBan,$IntTransaccion,$IntDocumento,$StrProducto,$IntCantidadDoc,$StrUnidad,$IntValorUnitario,$IntValorTotal,$StrCompania){
		$this->parametros= array('IntBan'=>$IntBan, 'IntTransaccion'=>$IntTransaccion, "IntDocumento"=>$IntDocumento, "StrProducto"=>$StrProducto, "IntCantidadDoc"=>$IntCantidadDoc,
	"StrUnidad"=>$StrUnidad, "IntValorUnitario"=>$IntValorUnitario, "IntValorTotal"=>$IntValorTotal, "StrCompania"=>$StrCompania);
		$this->strRespuestaWs= $this->ConsultarWebService('InsertarDetalleDocumento',true);
	}


}