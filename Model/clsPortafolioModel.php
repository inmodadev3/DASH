<?php 
include_once ("../Model/clsConexion.php");
class clsPortafolioModel 
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
	function AgregarPortafolio($strTitulo, $dtFecha, $idUser){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_AgregarPortafolio(?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strTitulo);
        $query->bindparam(2,$dtFecha);
        $query->bindparam(3,$idUser);
           
        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;   
	}
	function AgregarDetalle($strRuta, $intIdEncabezado){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_AgregarDetallePortafolio(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strRuta);
        $query->bindparam(2,$intIdEncabezado);
           
        $query->execute();
   		
        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	function ConsultarPortafolio($strNombre, $intIdUser){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ConsultarPortafolioPorNombre(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strNombre);
        $query->bindparam(2,$intIdUser); 

        $query->execute();
   		$this->intNum=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
	}
	function ConsultarDetallePorRuta($strRuta, $intIdPortafolio){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_ConsultarDetallePorRuta(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strRuta);
        $query->bindparam(2,$intIdPortafolio); 
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function GestionDestapeTercero($intIdLogin, $strIdTercero, $intTipoGestion, $intAccion){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_GestionDestapeMadrinaTercero(?,?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdLogin);
        $query->bindparam(2,$strIdTercero); 
        $query->bindparam(3,$intTipoGestion); 
        $query->bindparam(4,$intAccion); 
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function ReiniciarGestionDestapeTercero($intIdLogin, $intTipoGestion){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_ReiniciarGesionTercero(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intTipoGestion);
        $query->bindparam(2,$intIdLogin);
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function ActualizarTipoDeAccesoPortafolio($intIdPortafolio, $intTipoAcceso){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_ActualizarTipoDeAccesoPortafolio(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdPortafolio);
        $query->bindparam(2,$intTipoAcceso);
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function ConsultarGestionDestape($intIdLogin, $strIdTercero){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 
        $sql= "CALL SP_ConsultarGestionDestapeMadrinaTercero(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdLogin);
        $query->bindparam(2,$strIdTercero); 
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListarCiudadesPorZonaPorVendedor($intIdZona){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();       
        $sql= "CALL SP_ListarCiudadesPorZona(?)";
        $query = $db->prepare($sql);
        $query->bindparam(1,$intIdZona);                     
        $query->execute();
        
        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll(PDO::FETCH_ASSOC);
     }

     public function ListarLineasPorUsuario($intIdLogin){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();       
        $sql= "CALL SP_ListarLineasPorUsuario(?)";
        $query = $db->prepare($sql);
        $query->bindparam(1,$intIdLogin);                     
        $query->execute();
        
        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll(PDO::FETCH_ASSOC);

        
     }
     
     public function ListarZonasPorUsuario($intIdLogin){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();       
        $sql= "CALL SP_ListarZonasPorUsuario(?)";
        $query = $db->prepare($sql);
        $query->bindparam(1,$intIdLogin);                     
        $query->execute();
        
        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll(PDO::FETCH_ASSOC);

        
     }

     public function ListarIdVendedorPorLogin($intIdLogin){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();       
        $sql= "CALL SP_ListarIdVendedorPorLogin(?)";
        $query = $db->prepare($sql);
        $query->bindparam(1,$intIdLogin);                     
        $query->execute();
        
        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll(PDO::FETCH_ASSOC);

        
     }

     
     public function ConsultarGestiones($intIdLogin, $strIdTercero){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();       
        $sql= "CALL SP_ConsultarGestiones(?,?)";
        $query = $db->prepare($sql);
        $query->bindparam(1,$intIdLogin); 
        $query->bindparam(2,$strIdTercero);                     
        $query->execute();
        
        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll(PDO::FETCH_ASSOC);
     }


     public function GuardarGestion($intIdLogin, $strIdTercero, $observacion, $intTipoGestion){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();       
        $sql= "CALL SP_GuardarGestionObservacion(?,?,?,?)";
        $query = $db->prepare($sql);
        $query->bindparam(1,$intIdLogin);  
        $query->bindparam(2,$strIdTercero);  
        $query->bindparam(3,$observacion);      
        $query->bindparam(4,$intTipoGestion);                     
        $query->execute();
        
        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll(PDO::FETCH_ASSOC);
     }
    





	function ConsultarDetallesPorId($intIdPortafolio){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ConsultarDetallesPorId(?)";
        $query = $db->prepare($sql);   
        //$query->bindparam(1,$strDir);
        $query->bindparam(1,$intIdPortafolio);   
           
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll();
	}
	function EliminarDetalle($strDir, $intIdPortafolio, $intFolderPrincipal){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_EliminarDetallePortafolio(?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$strDir);
        $query->bindparam(2,$intIdPortafolio);
        $query->bindparam(3,$intFolderPrincipal);
           
        $query->execute();
        $Conexion->CerrarConexion();
        $Conexion=null;
        
   		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	function ValidarExistenciaPortafolio($intIdUser, $strIdTercero, $strNombreTercero){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ConsultarPortafolio(?,?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdUser);
        $query->bindparam(2,$strIdTercero);
        $query->bindparam(3,$strNombreTercero);
           
        $query->execute();
        $Conexion->CerrarConexion();
        $Conexion=null;
        return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	function ListarDetallePortafolio($intIdPortafolio){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_ListarDetallePortafolio(?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdPortafolio);
           
        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
	}
	function EliminarPortafolio($intIdPortafolio){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_EliminarPortafolio(?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdPortafolio);
           
        $query->execute();
   		$this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
	}
	function EditarNombrePortafolio($intIdPortafolio, $strNombre){
		$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion(); 

        $sql= "CALL SP_EditarNombrePortafolio(?,?)";
        $query = $db->prepare($sql);   
        $query->bindparam(1,$intIdPortafolio);
        $query->bindparam(2,$strNombre);
           
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
    function AgregarPortafolioTercero($intIdTercero, $intIdPortafolio, $strNombreTercero)
    {
    	$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();       
        $sql= "CALL SP_AgregarPortafolioTercero(?,?,?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$intIdTercero);
        $query->bindparam(2,$intIdPortafolio);
        $query->bindparam(3,$strNombreTercero);
        $query->execute();
        $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }
    function ActualizarPortafolioTercero($intIdPortafolio, $strDescripcion, $intId, $intIdVendedor){
    	$Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();       
        $sql= "CALL SP_ActualizarPortafolioTercero(?,?,?,?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$intIdPortafolio);
        $query->bindparam(2,$strDescripcion);
        $query->bindparam(3,$intId);
        $query->bindparam(4,$intIdVendedor);
        $query->execute();
        $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }
    function ConsultarNombrePortafolio($intIdPortafolio)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();       
        $sql= "CALL SP_ConsultarNombrePortafolio(?)";
        $query = $db->prepare($sql);  
        $query->bindparam(1,$intIdPortafolio);
        $query->execute();
        $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null;
    }

    public function FiltrarPortafolios($strText, $intIdlogin, $año,  $mes)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
     
        $sql= "CALL SP_FiltrarPortafolios(?,?,?,?)";
        $query = $db->prepare($sql); 
        $query->bindParam(1,$strText);
        $query->bindParam(2,$intIdlogin);
        $query->bindParam(3,$año);
        $query->bindParam(4,$mes);       
        $query->execute();

        $Conexion->CerrarConexion();
        $Conexion=null; 
        return $query->fetchAll();
    }


    public function RestablecerPortafolio($intCodPortafolio)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
        $sql= "CALL SP_RestablecerPortafolio(?)";
        $query = $db->prepare($sql); 
        $query->bindParam(1,$intCodPortafolio);      
        $query->execute();
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
    
}


 ?>