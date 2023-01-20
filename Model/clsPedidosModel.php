<?php


include_once ("../Model/clsConexion.php");
class clsPedidosModel 
{
	
	function __construct()
	{
		# code...
	}

	 public function ObtenerCodigoPedido()
     {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ObtenerCodigoPedido()";
            $query = $db->prepare($sql);        
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }

     public function ListarTipoEnvio()
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_ListarTipoEnvio()";
            $query = $db->prepare($sql);        
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
     public function EmpezarPedido()
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();
         
            $sql= "CALL SP_EmpezarPedido()";
            $query = $db->prepare($sql);        
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null;  
    }
       public function AddReferencia($strReferencia,$strUDM,$idLinea,$idGrupo,$idClase,$idTipo,$idTipoEnvio,$intNroDocumento,$strRutaImagen,$strObservacion,$strRutaFileColores)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion(); 
         
            $sql= "CALL SP_AgregarReferencia(?,?,?,?,?,?,?,?,?,?,?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$strReferencia);
            $query->bindparam(2,$strUDM);
            $query->bindparam(3,$idLinea);
            $query->bindparam(4,$idGrupo);
            $query->bindparam(5,$idClase);
            $query->bindparam(6,$idTipo);
            
            $query->bindparam(7,$idTipoEnvio);
            $query->bindparam(8,$intNroDocumento);
            $query->bindparam(9,$strRutaImagen);
            $query->bindparam(10,$strObservacion);
            $query->bindparam(11,$strRutaFileColores);
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
           public function AddLote($strReferencia,$idColor,$idTalla,$idEstilo,$idCodColorChina,$intCantidad,$strRutaFotoEstilo)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_AgregarLoteReferencia(?,?,?,?,?,?,?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$strReferencia);
            $query->bindparam(2,$idEstilo);
            $query->bindparam(3,$idColor);
            $query->bindparam(4,$idTalla);
            $query->bindparam(5,$idCodColorChina);
            $query->bindparam(6,$intCantidad);
            $query->bindparam(7,$strRutaFotoEstilo);
                
            $query->execute();

            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
           public function ListarPedidoEncabezado($intNroDocumento,$SQL)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql=$SQL;
            $query = $db->prepare($sql);   
            $query->bindparam(1,$intNroDocumento);
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
           public function ListarPedidoDetalle($intNroDocumento)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarLotePorPedido  (?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$intNroDocumento);
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
             public function EliminarLotePedido($strReferencia,$idColor,$idTalla,$idEstilo)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_EliminarLotePedido (?,?,?,?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$strReferencia);
            $query->bindparam(2,$idColor);
            $query->bindparam(3,$idTalla);
            $query->bindparam(4,$idEstilo);
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
            public function ListarLoteReferenciaPorLinea($intNroDocumento,$idClase,$idLinea,$idGrupo,$idTipo)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarReferenciaPorLineaPedido (?,?,?,?,?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$intNroDocumento);
            $query->bindparam(2,$idClase);
            $query->bindparam(3,$idTipo);
            $query->bindparam(4,$idGrupo);
            $query->bindparam(5,$idLinea);
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
            public function ListarPedidoDetallePorLinea($intNroDocumento,$idClase,$idLinea,$idGrupo,$idTipo)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarLotePorLineaPedido (?,?,?,?,?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$intNroDocumento);
            $query->bindparam(2,$idTipo);
            $query->bindparam(3,$idClase);
            $query->bindparam(4,$idGrupo);
            $query->bindparam(5,$idLinea);
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
             public function EliminarReferencia($strReferencia)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_EliminarReferencia (?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$strReferencia);
            
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
    public function ListarLineaPorPedido($intNroDocumento)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListaDelineasPorPedido (?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$intNroDocumento);
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
      public function ListarLineaPorPedidoDescargados($intNroDocumento)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_ListarLineaPedidoDescargado (?)";
            $query = $db->prepare($sql);   
            $query->bindparam(1,$intNroDocumento);
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
              public function BuscarReferencia($strReferencia,$intNroDocumento,$idClase,$idLinea,$idGrupo,$idTipo)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_BuscarReferenciaPorLinea (?,?,?,?,?,?)";
            $query = $db->prepare($sql); 
            $query->bindparam(1,$strReferencia);  
            $query->bindparam(2,$intNroDocumento);
            $query->bindparam(3,$idLinea);
            $query->bindparam(4,$idGrupo);
            $query->bindparam(5,$idClase);
            $query->bindparam(6,$idTipo);
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }
    public function BuscarLotePorReferencia($strReferencia,$intNroDocumento,$idClase,$idLinea,$idGrupo,$idTipo)
    {
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_BuscarLotePorReferencia (?,?,?,?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$strReferencia);
            $query->bindparam(2,$intNroDocumento);
            $query->bindparam(3,$idLinea);
            $query->bindparam(4,$idGrupo);
            $query->bindparam(5,$idClase);
            $query->bindparam(6,$idTipo);
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
            return $query->fetchAll();
    }

    public function CambiarEstadoReferenciaDescargado($intNroDocumento,$idClase,$idLinea,$idGrupo,$idTipo){
            $Conexion = new clsConexion();
            $Conexion->AbrirConexion();
            $db=$Conexion->Conexion();       
            $sql= "CALL SP_CambiarEstadoDescargadoExcelPedido (?,?,?,?,?)";
            $query = $db->prepare($sql);  
            $query->bindparam(1,$intNroDocumento);
            $query->bindparam(2,$idLinea);
            $query->bindparam(3,$idGrupo);
            $query->bindparam(4,$idClase);
            $query->bindparam(5,$idTipo);
            $query->execute();
            $Conexion->CerrarConexion();
            $Conexion=null; 
          
    }



}