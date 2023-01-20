<?php

class clsConexion
{
  
    public $db = null;
    public function Conexion(){
        return $this->db;
    }
    public function AbrirConexion()
    {

            $servername = "10.10.10.128";
            $username = "root";
            $password = "Sistemas2018*";
            try {
                $this->db = new PDO("mysql:host=$servername;dbname=dash", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                }
            catch(PDOException $e)
                {
                echo "Connection error: " . $e->getMessage() . $e;
                }    
    }

    public function CerrarConexion(){
         $this->db=null;

    }
}
