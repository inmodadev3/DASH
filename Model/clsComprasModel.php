<?php 
include_once ("../Model/clsConexion.php");
class clsComprasModel
{

    private $strMensaje, $intId;
    function __construct()
    {
        $this->strMensaje='';
        $this->intNum=0;
    }
    public function GetRespuesta(){
        return $this->strMensaje;
    }
    public function GetRpta(){
        return $this->intNum;
    }
	  public function registrarReferencias($strCaja,$strReferencia,$intCantidad,$strUnidadMedida,$intValor,$strDescripcion,$intEstado,$strColor, $intCxU,  $strDimension, $strEstilo, $intCantidadPaca, $strMaterial){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();

            $sql="CALL SP_AgregarDocumentoDetalleCompra(?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stm= $db->prepare($sql);
            $stm->bindParam(1, $strCaja);
            $stm->bindParam(2, $strReferencia);
            $stm->bindParam(3, $intCantidad);
            $stm->bindParam(4, $strUnidadMedida); 
            $stm->bindParam(5, $intValor);
            $stm->bindParam(6, $strDescripcion);
            $stm->bindParam(7, $intEstado); 
            $stm->bindParam(8, $strColor); 
            $stm->bindParam(9, $intCxU); 
            $stm->bindParam(10, $strDimension); 
            $stm->bindParam(11, $strEstilo);
            $stm->bindParam(12, $intCantidadPaca);
            $stm->bindParam(13, $strMaterial);  

            return $stm->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
        

        }
     

        public function registrarCompra($Raggi, $importacion, $txtTRM, $txtOTM, $chkOTMUSD, $chkOTMSUP, $txtArancel, $chkArancelUSD, $chkArancelSUP, $txtIVA, $chkIVAUSD, $chkIVASUP, $txtDescargues, $chkDescarguesUSD, $chkDescarguesSUP, $txtDeposito, $chkDepositoUSD, $chkDepositoSUP,  $txtNaviera, $chkNavieraUSD, $chkNavieraSUP,  $txtTIC, $chkTICUSD, $chkTICSUP, $txtOtrosUno, $chkOtrosUnoUSD, $chkOtrosUnoSUP, $txtOtrosDos, $chkOtrosDosUSD, $chkOtrosDosSUP, $intPorcentaje)
        {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();


            $sql = "CALL registrarDocumento(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $query = $db->prepare($sql);
            $query->bindparam(1, $Raggi);
            $query->bindparam(2, $importacion);
            $query->bindparam(3, $txtTRM);
            $query->bindparam(4, $txtOTM);
            $query->bindparam(5, $chkOTMUSD);
            $query->bindparam(6, $chkOTMSUP);
            $query->bindparam(7, $txtArancel);
            $query->bindparam(8, $chkArancelUSD);
            $query->bindparam(9, $chkArancelSUP);
            $query->bindparam(10, $txtIVA);
            $query->bindparam(11, $chkIVAUSD);
            $query->bindparam(12, $chkIVASUP);
            $query->bindparam(13, $txtDescargues);
            $query->bindparam(14, $chkDescarguesUSD);
            $query->bindparam(15, $chkDescarguesSUP);
            $query->bindparam(16, $txtDeposito);
            $query->bindparam(17, $chkDepositoUSD);
            $query->bindparam(18, $chkDepositoSUP);
            $query->bindparam(19, $txtNaviera);
            $query->bindparam(20, $chkNavieraUSD);
            $query->bindparam(21, $chkNavieraSUP);
            $query->bindparam(22, $txtTIC);
            $query->bindparam(23, $chkTICUSD);
            $query->bindparam(24, $chkTICSUP);
            $query->bindparam(25, $txtOtrosUno);
            $query->bindparam(26, $chkOtrosUnoUSD);
            $query->bindparam(27, $chkOtrosUnoSUP);
            $query->bindparam(28, $txtOtrosDos);
            $query->bindparam(29, $chkOtrosDosUSD);
            $query->bindparam(30, $chkOtrosDosSUP);
            $query->bindparam(31, $intPorcentaje);

            return $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
    

        }

        public function consultarDetalleCompra($intEstado)
        {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ConsultarDetalleCompra(?)";
            $query = $db->prepare($sql); 
            $query->bindParam(1,$intEstado);       
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
        }


        public function ValidarImportacion(){
            $Conexion = new Model();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
            
            $sql= "CALL SP_ValidarImportacion(?)";
            $query = $db->prepare($sql);
            $query->bindParam(1, $this->importacion);
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 

            return $query->fetchAll();

        }

        public function ConsultarValorTotalDocumento(){
            $Conexion = new Model();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();

             $sql= "CALL SP_ExtraerSumaDocumento";
            $query = $db->prepare($sql);
            $query->execute();


            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
        }
        public function ConsultarValorTotalImportacion(){
            $Conexion = new Model();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();

            $sql= "CALL SP_ExtraerSumaImportacion";
            $query = $db->prepare($sql);
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
        }

        public function RegistrarDetalleReferencia($costo, $cantidad){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();

            $sql="CALL SP_AgregarRefenciasDetalle(?,?)";
            $stm=$db->prepare($sql);
            $stm->bindParam(1, $costo);
            $stm->bindParam(2, $cantidad); 
            return $stm->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
        }

      

    public function ActualizarRefDetalleCompra($strReferencia,$strDescripcion,$intPrecioUno,$intPrecioDos,$intPrecioTres,$intPrecioCuatro,$intPrecioCinco,$intIdDetalle, $intEstado, $strDimension, $intCxU, $strUnidadMedida, $intCantidadContenedor, $intCantidadPaca, $strMaterial, $txtObservacion , $txtSexo, $txtMarca){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
            $cantidad = -1; //se actualiza en c#
            $udm = -1;  //se actualiza en c#SP_ActualizarRefDetalleCompra
            //DOÑA ANGELA ACTUALIZAR PROCEDIMIENTO ALMACENADO
            $sql= "CALL SP_ActualizarRefDetalleCompra(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $query = $db->prepare($sql);
            $query->bindParam(1, $intIdDetalle);
            $query->bindParam(2, $strDescripcion);
            $query->bindParam(3, $intPrecioUno);
            $query->bindParam(4, $intPrecioDos);
            $query->bindParam(5, $intPrecioTres);
            $query->bindParam(6, $intPrecioCuatro);
            $query->bindParam(7, $intPrecioCinco);
            $query->bindParam(8, $strReferencia);
            $query->bindParam(9, $intCantidadContenedor);
            $query->bindParam(10,$udm);
            $query->bindParam(11,$intEstado);
            $query->bindParam(12,$strDimension);
            //$query->bindParam(13,$strColor);
            $query->bindParam(13,$intCxU);
            $query->bindParam(14,$strUnidadMedida);
            $query->bindParam(15,$intCantidadPaca);
            $query->bindParam(16,$strMaterial);
            $query->bindParam(17,$txtObservacion);
            $query->bindParam(18,$txtSexo);
            $query->bindParam(19,$txtMarca);
            $this->intNum=$query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
    }

    public function ConsultarPrecios($intPrecio1, $intUdm)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ConsultarPrecioEmpresa(?,?)";
            $query = $db->prepare($sql); 
            $query->bindParam(1,$intPrecio1);       
            $query->bindParam(2,$intUdm); 
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }

    public function consultarReferenciasPorSticker()
        {
            $Conexion = new Model();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ConsultarReferenciaPorStiker";
            $query = $db->prepare($sql);        
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
        }
    function ConsultarLoteReferenciaCompra($idReferenciaDetalle){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_ConsultarLoteReferenciaCompra(?)";
        $query = $db->prepare($sql); 
        $query->bindparam(1, $idReferenciaDetalle);
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll();
    }
    function EliminarLoteReferenciaCompra($idLoteReferencia){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_EliminarLoteReferenciaCompra(?)";
        $query = $db->prepare($sql); 
        $query->bindparam(1, $idLoteReferencia);
        $this->intNum = $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
    function AgregarLoteReferenciaCompra($idDetalleReferencia, $strColor, $strEstilo){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_AgregarLoteReferenciaCompra(?,?,?)";
        $query = $db->prepare($sql); 
        $query->bindparam(1, $idDetalleReferencia);
        $query->bindparam(2, $strColor);
        $query->bindparam(3, $strEstilo);
        $this->intNum = $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
    function ActualizarLoteReferenciaCompra($intIdLote, $strColor, $strEstilo, $intIdDetalle){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_ActualizarLoteReferenciaCompra(?,?,?,?)";
        $query = $db->prepare($sql); 
        $query->bindparam(1, $intIdLote);
        $query->bindparam(2, $strColor);
        $query->bindparam(3, $strEstilo);
        $query->bindparam(4, $intIdDetalle);
        $this->intNum = $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
    //NUEVO
    function ValidarReferenciaDetalle($strReferencia){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_ValidarReferenciaDetalle(?)";
        $query = $db->prepare($sql); 
        $query->bindparam(1, $strReferencia);
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll();
    }
    function DuplicarReferenciaDetalle($intIdDetalle, $strReferencia, $strDescripcion, $intCantidad){
       $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_DuplicarReferenciaDetalle(?,?,?,?)";
        $query = $db->prepare($sql); 
        $query->bindparam(1, $intIdDetalle);
        $query->bindparam(2, $strReferencia);
        $query->bindparam(3, $strDescripcion);
        $query->bindparam(4, $intCantidad);
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll(); 
    }
    //NUEVO
}
