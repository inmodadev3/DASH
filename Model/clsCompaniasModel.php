<?php 
include_once ("../Model/clsConexion.php");
class clsCompaniasModel
{
	private $strMensaje;
    function __construct()
    {
        $this->strMensaje='';
    }
    public function GetRespuesta(){
        return $this->strMensaje;
    }
    public function AddCompania($strDescripcion,$intIdLogin){
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();
        $sql= "CALL SP_CrearCompania(?,?)";
        $query = $db->prepare($sql); 
        $query->bindParam(1,$strDescripcion); 
        $query->bindParam(2,$intIdLogin);       
        $query->execute();
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }

    public function GetCompanias()
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();  
        $sql= "CALL SP_ListarCompanias()";
        $query = $db->prepare($sql);       
        $query->execute();
        $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
    public function DeleteCompania($strIdCompania)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();  
        $sql= "CALL SP_EliminarCompania(?)";
        $query = $db->prepare($sql);
        $query->bindParam(1,$strIdCompania);        
        $query->execute();
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
    public function EditCompania($strIdCompania,$strDescripcion)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();  
        $sql= "CALL SP_ActualizarCompania(?,?)";
        $query = $db->prepare($sql);
        $query->bindParam(1,$strIdCompania);
        $query->bindParam(2,$strDescripcion);        
        $query->execute();
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
    public function GetDetalleCompania($strIdCompania)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();  
        $sql= "CALL SP_ListarDetalleCompania(?)";
        $query = $db->prepare($sql);
        $query->bindParam(1,$strIdCompania);      
        $query->execute();
        $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
    public function AsignarClaseACompania($strIdCompania,$strIdClase,$strDescripcionCls,$intIdLogin)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();  
        $sql= "CALL SP_AsignarClaseACompania(?,?,?,?)";
        $query = $db->prepare($sql);
        $query->bindParam(1,$strIdCompania);
        $query->bindParam(2,$strIdClase);
        $query->bindParam(3,$strDescripcionCls); 
        $query->bindParam(4,$intIdLogin);      
        $query->execute();
        $this->strMensaje=$query->fetchAll(PDO::FETCH_ASSOC);
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
     public function EliminarClaseDtCompania($strIdCompania,$strIdClase)
    {
        $Conexion = new clsConexion();
        $Conexion->AbrirConexion();
        $db=$Conexion->Conexion();  
        $sql= "CALL SP_EliminarClaseDtCompania(?,?)";
        $query = $db->prepare($sql);
        $query->bindParam(1,$strIdCompania);
        $query->bindParam(2,$strIdClase);     
        $query->execute();
        $query=null;
        $Conexion->CerrarConexion();
        $Conexion=null; 
    }
}