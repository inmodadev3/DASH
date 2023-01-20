<?php
mb_internal_encoding("UTF-8");
include_once ("../Model/clsConexion.php");
class clsVendedoresModel
{
	private $strMensaje;
	function __construct()
	{
		$this->strMensaje='';
	}
	public function GetRespuesta(){
		return $this->strMensaje;
	}
	 public function AgregarVendedor($strIdTipoEmpleado,$strCedula,$strNombre,$intIdZona)	
    	{
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_AgregarVendedorParametrizado(?,?,?,?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$strIdTipoEmpleado);
            $query->bindparam(2,$strCedula);
            $query->bindparam(3,$strNombre);
            $query->bindparam(4,$intIdZona);        
            $query->execute();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
   		}
   		 public function ListarVendedores()	
    	{
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarVendedores()";
            $query = $db->prepare($sql);             
            $query->execute();
            $this->strMensaje=$query->fetchAll();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
        }
        public function ListarZonasVendedor2($strIdVendedor){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarVendedorZonas(?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$strIdVendedor);                
            $query->execute();
            $this->strMensaje=$query->fetchAll();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
        }
   		public function ListarZonasVendedor(){
   			$Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarZonas()";
            $query = $db->prepare($sql);                   
            $query->execute();
            $this->strMensaje=$query->fetchAll();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
        }
        public function ActualizarZonasVendedor($strIdVendedor, $intIdZona, $intAccion){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ActualizarVendedoresZonas(?,?,?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$strIdVendedor);    
            $query->bindparam(2,$intIdZona);
            $query->bindparam(3,$intAccion);              
            $query->execute();
            $this->strMensaje=$query->fetchAll();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
        }
        public function AsignarLineaVendedor($strCedula,$strIdCodigoLinea,$intIdZona,$intIdCompania){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_AsignarLineaAVenededor(?,?,?,?)";
            $query = $db->prepare($sql);    
            $query->bindparam(1,$strIdCodigoLinea);  
            $query->bindparam(2,$strCedula);   
            $query->bindparam(3,$intIdZona);    
            $query->bindparam(4,$intIdCompania);             
            $query->execute();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
        }
        public function EliminarLineaVendedor($strCedula,$strIdCodigoLinea,$intIdZona,$intIdCompania){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_EliminarLineaAVendedor(?,?,?,?)";
            $query = $db->prepare($sql);    
            $query->bindparam(1,$strCedula);  
            $query->bindparam(2,$strIdCodigoLinea); 
            $query->bindparam(3,$intIdZona); 
            $query->bindparam(4,$intIdCompania);                
            $query->execute();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
         }   
         public function ListarLineasPorVendedor($strCedula){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarLineasPorVendedor(?)";
            $query = $db->prepare($sql);
            $query->bindparam(1,$strCedula);                     
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
         }
         public function ListarCiudadesPorZonaPorVendedor($intIdZona){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarCiudadesPorZona(?)";
            $query = $db->prepare($sql);
            $query->bindparam(1,$intIdZona);                     
            $query->execute();
            $this->strMensaje=$query->fetchAll();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
         }
         public function IngresarIngreso($strNombre,$intSerie,$intValor,$dtFechaInicial,$dtFechaFinal,$strPeriocidad,$intTipo,$intMeta,$intTipoMeta,$intValorMeta,$strBaseMeta,$strTipoBaseMeta,$intCompania,$strCedula,$strTipoBase,$strTipoVendedor,$strVendedor,$strTipoBaseIngreso,$intIva,$intDescuento,$intTiempoVisita,$strDiasVisita,$strTipoPeriocidad,$intEstado,$dtFechaCreacion,$strTransacciones){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_IngresarIngreso(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $query = $db->prepare($sql);
            $query->bindparam(1,$strNombre);  
            $query->bindparam(2,$intSerie);  
            $query->bindparam(3,$intValor);  
            $query->bindparam(4,$dtFechaInicial);  
            $query->bindparam(5,$dtFechaFinal); 
            $query->bindparam(6,$strPeriocidad); 
            $query->bindparam(7,$intTipo); 
            $query->bindparam(8,$intMeta); 
            $query->bindparam(9,$intTipoMeta); 
            $query->bindparam(10,$intValorMeta);  
            $query->bindparam(11,$strBaseMeta);
            $query->bindparam(12,$strTipoBaseMeta);
            $query->bindparam(13,$intCompania);
            $query->bindparam(14,$strCedula);
            $query->bindparam(15,$strTipoBase);
            $query->bindparam(16,$strTipoVendedor);
            $query->bindparam(17,$strVendedor);
            $query->bindparam(18,$strTipoBaseIngreso);
            $query->bindparam(19,$intIva);
            $query->bindparam(20,$intDescuento);
            $query->bindparam(21,$intTiempoVisita);
            $query->bindparam(22,$strDiasVisita); 
            $query->bindparam(23,$strTipoPeriocidad); 
            $query->bindparam(24,$intEstado);
            $query->bindparam(25,$dtFechaCreacion);  
            $query->bindparam(26,$strTransacciones);                  
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
         }
           
        public function ListarIngresos($strCedula,$intCompania){
           $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarIngresos(?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strCedula); 
            $query->bindparam(2,$intCompania);          
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;         
        }
        public function AgregarMetas($strTipoMeta,$strCedula,$strAnno,$intCompania){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_AgregarMetas(?,?,?,?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$strTipoMeta); 
            $query->bindparam(2,$strCedula); 
            $query->bindparam(3,$strAnno); 
            $query->bindparam(4,$intCompania); 
            $query->execute();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;   
        }
        public function ListarMetasPorVendedor($strCedula,$intAnno,$strTipoMeta,$intCompania){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarMetasPorVendedor(?,?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strCedula); 
            $query->bindparam(2,$intAnno); 
            $query->bindparam(3,$strTipoMeta); 
            $query->bindparam(4,$intCompania); 
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;   
        }
        public function ActualizarMeta($intCodigo,$intValor){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ActualizarMetaVendedor(?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intCodigo); 
            $query->bindparam(2,$intValor);  
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;
        }
        public function ConsultarVendedor($strCedula){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarVendedor(?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strCedula); 
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;
        }
        public function ConsultarIngresosVendedor($strCedula,$intCompania){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarIngresosPorVendedor(?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strCedula); 
            $query->bindparam(2,$intCompania); 
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;  
        }
        public function ActualizarIngreso($strCedula,$intCompania,$intId,$intTipoPeriocidad,$blnEstadoIngreso,$dtFechaUltima){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ActualizarIngreso(?,?,?,?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intTipoPeriocidad); 
            $query->bindparam(2,$intId); 
            $query->bindparam(3,$strCedula); 
            $query->bindparam(4,$intCompania);
            $query->bindparam(5,$blnEstadoIngreso); 
            $query->bindparam(6,$dtFechaUltima);
            $query->execute();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;  
        }
         public function CrearLiquidacionEncabezado($strCedula,$strMes,$intCompania,$strMesTipo,$strUsuarioRegistro,$dtCreacion){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_AgregarLiquidacionPorVendedor(?,?,?,?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strCedula); 
            $query->bindparam(2,$strMes); 
            $query->bindparam(3,$intCompania); 
            $query->bindparam(4,$strMesTipo); 
            $query->bindparam(5,$strUsuarioRegistro); 
            $query->bindparam(6,$dtCreacion);
            $query->execute();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;    
         }
         public function CrearDetalleLiquidacion($intIdMovimiento,$intValor,$intTipoMovimiento){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_AgregarMovimientosADetalle(?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intIdMovimiento); 
            $query->bindparam(2,$intValor);
            $query->bindparam(3,$intTipoMovimiento); 
            $query->execute();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
         }
        public function ConsultarMetaAVendedor($strCedula,$strMes,$intCompania,$strTipoMeta,$intAnno){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ConsultarMetaAVendedor(?,?,?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strCedula); 
            $query->bindparam(2,$strMes); 
            $query->bindparam(3,$intCompania); 
            $query->bindparam(4,$strTipoMeta); 
            $query->bindparam(5,$intAnno); 
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
         }
         public function ListarLiquidacion($strCedula,$intCompania,$intMes,$intAnno){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarLiquidacionGeneradadAVendedor(?,?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strCedula); 
            $query->bindparam(2,$intCompania); 
            $query->bindparam(3,$intMes);
            $query->bindparam(4,$intAnno); 
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
         }
        public function EliminarIngreso($intIdIngreso){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_EliminarIngreso(?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$intIdIngreso); 
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;   
        }
        public function ListarIngreso($intId){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarIngreso(?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intId);         
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;         
        }
        public function ActualizarIngresoTotal($intIdIngreso,$strNombre,$intValor,$intEstado,$intSerie,$dtFechaInicial,$dtFechaFinal,$intTipo,$strPeriocidad,$intMeta,$intTipoMeta,$intValorMeta,$strBaseMeta,$strTipoBaseMeta,$strTipoBase,$strTipoVendedor,$strVendedor,$strTipoBaseIngreso,$intIva,$intDescuento,$intTiempoVisita,$strDiasVisita,$intTipoPeriocidad,$strTransacciones){
 

            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ActualizarIngresoTotal(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intIdIngreso);
            $query->bindparam(2,$strNombre);
            $query->bindparam(3,$intValor);
            $query->bindparam(4,$intEstado);
            $query->bindparam(5,$intSerie); 
            $query->bindparam(6,$dtFechaInicial); 
            $query->bindparam(7,$dtFechaFinal); 
            $query->bindparam(8,$intTipo);
            $query->bindparam(9,$strPeriocidad);
            $query->bindparam(10,$intMeta);  
            $query->bindparam(11,$intTipoMeta);
            $query->bindparam(12,$intValorMeta); 
            $query->bindparam(13,$strBaseMeta); 
            $query->bindparam(14,$strTipoBaseMeta);   
            $query->bindparam(15,$strTipoBase);   
            $query->bindparam(16,$strTipoVendedor); 
            $query->bindparam(17,$intIva);
            $query->bindparam(18,$intDescuento);
            $query->bindparam(19,$strVendedor);   
            $query->bindparam(20,$strTipoBaseIngreso); 
            $query->bindparam(21,$intTiempoVisita);   
            $query->bindparam(22,$strDiasVisita); 
            $query->bindparam(23,$intTipoPeriocidad); 
            $query->bindparam(24,$strTransacciones); 
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;        
        }
        public function AgregarEgreso($strNombre,$intValor,$intSerie,$dtFechaInicial,$dtFechaFinal,$strPeriocidad,$strCedula,$strTipoTemporal,$intCuota,$intEstado,$dtFechaUltima,$strTipoPeriocidad,$intCompania,$intValorPorCuota){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_AgregarEgreso(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strNombre);
            $query->bindparam(2,$intValor);
            $query->bindparam(3,$intSerie);
            $query->bindparam(4,$dtFechaInicial); 
            $query->bindparam(5,$dtFechaFinal); 
            $query->bindparam(6,$strPeriocidad); 
            $query->bindparam(7,$strCedula); 
            $query->bindparam(8,$strTipoTemporal); 
            $query->bindparam(9,$intCuota); 
            $query->bindparam(10,$intEstado); 
            $query->bindparam(11,$dtFechaUltima);  
            $query->bindparam(12,$strTipoPeriocidad); 
            $query->bindparam(13,$intCompania);
            $query->bindparam(14,$intValorPorCuota);         
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;   
        }
        public function ListarEgresos($strCedulaVendedor,$intCompania){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarEgresos(?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strCedulaVendedor);
            $query->bindparam(2,$intCompania);         
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;         
        }
         public function ListarEgresosComision($strCedulaVendedor,$intCompania){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarEgresosComision(?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strCedulaVendedor);
            $query->bindparam(2,$intCompania);           
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;         
        }
        public function ActualizarEgreso($intId,$intEstado,$intCuotas,$intMontoTotal,$strCedulaVendedor,$intCompania,$dtUltimaFecha,$intTipoPeriocidad){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ActualizarEgreso(?,?,?,?,?,?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intId);
            $query->bindparam(2,$intEstado); 
            $query->bindparam(3,$intCuotas); 
            $query->bindparam(4,$intMontoTotal); 
            $query->bindparam(5,$strCedulaVendedor); 
            $query->bindparam(6,$intCompania); 
            $query->bindparam(7,$dtUltimaFecha); 
            $query->bindparam(8,$intTipoPeriocidad);             
            $query->execute();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;         
        }
        public function EstadoEgreso($intIdIngreso){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ActualizarEstadoEgreso(?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intIdIngreso);
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;     
        }
        public function AgregarDocumentosLiquidacion($intDocumento,$intMontoMovimiento,$strConcepto,$intAnno,$intMovimiento,$dtFechaDocumento,$strTransaccion,$strNombreTransaccion,$strRecibo,$strTercero){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_AgregarDocumentosLiquidacion(?,?,?,?,?,?,?,?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intDocumento);
            $query->bindparam(2,$intMontoMovimiento);
            $query->bindparam(3,$strConcepto);
            $query->bindparam(4,$intAnno);
            $query->bindparam(5,$intMovimiento);
            $query->bindparam(6,$dtFechaDocumento);
            $query->bindparam(7,$strTransaccion);
            $query->bindparam(8,$strNombreTransaccion); 
            $query->bindparam(9,$strRecibo); 
            $query->bindparam(10,$strTercero); 
            $query->execute();
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 

        }
        public function ListarDocumentosLiquidacion($intIdLiquidacion){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarDocumentosLiquidacion(?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intIdLiquidacion);
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
        }
        public function ListarCiudadesPorVendedor($intCedulaVendedor){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarCiudadesDeVendedor(?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intCedulaVendedor);
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null; 
        }
        public function EliminarLiquidacion($intIdLiquidacion){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_EliminarLiquidacion(?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intIdLiquidacion);
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;  
        }
        public function EliminarEgreso($intIdIngreso){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_EliminarEgreso(?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intIdIngreso);
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;     
        }
        public function ConsultarCompaniaEmpleadosAsociados($idLogin,$strCedulaEmpleado){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ConsultarCpEmpleadosAsociados(?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$idLogin);
            $query->bindparam(2,$strCedulaEmpleado);
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;  
        }
        public function ConsultarEmpleadosAsociados($intIdLogin,$strTipoVendedor,$intTipo){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ConsultarEmpleadosAsociados(?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intIdLogin);
            $query->bindparam(2,$strTipoVendedor); 
            $query->bindparam(3,$intTipo); 
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;  
        }
        public function ConsultarTipoEmpleado($intIdLogin){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ConsultarTipoEmpleadoLogin(?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intIdLogin);
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;  
        }
           public function ListarDocumentosPagadosVendedor($strCedula,$intMes,$intAnno,$intCompania,$idLogin){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarDocumentosPagadosVendedor(?,?,?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strCedula);
            $query->bindparam(2,$intMes);
            $query->bindparam(3,$intAnno);
            $query->bindparam(4,$intCompania);
            $query->bindparam(5,$idLogin);
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;  
        }
        public function CiudadesVendedoresAsociados($StrLogin){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_CiudadesVendedoresAsociados(?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$StrLogin);
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;  
        }
        public function ZonasCiudadesVendedoresAsociados($StrLogin){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ZonasCiudadesVendedoresAsociados(?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$StrLogin);
            $query->execute();
            $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
            $query=null;
            $Conexion->CerrarConexion();
            $Conexion=null;  
        }

}