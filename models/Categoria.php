<?php
require_once 'config/DataBase.php';

class Categoria{

    private $id;
    private $nombre;
    private $db;

    public function __construct(){
        $this->db = DataBase::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getAll($limit = null){

        $sql = "SELECT * FROM categorias ORDER BY id DESC ";
        
        if($limit){
            $sql .= "LIMIT 1";
        }
        
        $ejecutar = $this->db->query($sql);  
        

        return $ejecutar;
    }

    public function getOne(){
        $sql = "SELECT * FROM categorias WHERE id = {$this->getId()}";
        $ejecutar = $this->db->query($sql);

        $result = false;
        if($ejecutar){
            $result = $ejecutar->fetch_object();
        }

        return $result;
    }

    public function save(){

        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}')";
        $ejecutar = $this->db->query($sql);

        $result = false;
        
        if($ejecutar){
            $result = $ejecutar;
        }

        return $result;
    }


}

?>


