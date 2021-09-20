<?php

require_once 'config/DataBase.php';


class Producto{

    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getCategoria_id(){
        return $this->categoria_id;
    }
    public function setCategoria_id($categoria_id){
        $this->categoria_id = $categoria_id;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function getPrecio(){
        return $this->precio;
    }
    public function setPrecio($precio){
        $this->precio = $this->db->real_escape_string($precio);
    }

    public function getStock(){
        return $this->stock;
    }
    public function setStock($stock){
        $this->stock = $this->db->real_escape_string($stock);
    }

    public function getOferta(){
        return $this->oferta;
    }
    public function setOferta($oferta){
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    public function getFecha(){
        return $this->fecha;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    
    public function getImagen(){
        return $this->imagen;
    }
    public function setImagen($imagen){
        $this->imagen = $imagen;
    }

    public function getAll(){

        $sql = "SELECT * FROM productos WHERE eliminado = 0  ORDER BY id DESC";
        $ejecutar = $this->db->query($sql);

        $result = false;
        
        if($ejecutar){
            $result = $ejecutar;
        }

        return $result;
    }

    public function getRandom($limit){

        $sql = "SELECT * FROM productos WHERE eliminado = 0 AND stock > 0 ORDER BY RAND() LIMIT $limit";
        $ejecutar = $this->db->query($sql);

        $result = false;
        
        if($ejecutar){
            $result = $ejecutar;
        }

        return $result;
    }

    public function getOne(){

        $sql = "SELECT * FROM productos WHERE id = {$this->getId()}";

        $ejecutar = $this->db->query($sql);

        $result = false;
        if($ejecutar){
            $result = $ejecutar->fetch_object();
        }

        return $result;
    }

    public function getAllCategoria(){

        $sql = "SELECT p.*, c.nombre AS 'categoria_nombre' FROM productos p"
                ." INNER JOIN categorias c ON p.categoria_id = c.id"
                ." WHERE p.categoria_id = {$this->getCategoria_id()} AND eliminado = 0 AND stock > 0";

        $ejecutar = $this->db->query($sql);
        
        // echo $sql;
        // var_dump($ejecutar);
        // die();

        $result = false;
        if($ejecutar){
            $result = $ejecutar;
        }
        return $result;
    }

    public function save(){

        $sql = "INSERT INTO productos VALUES(NULL, {$this->getCategoria_id()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, null, CURDATE(), '{$this->getImagen()}', 0)";

        $ejecutar = $this->db->query($sql);

        $result = false;
        if($ejecutar){
            $result = true;
        }

        return $result;
    }

    public function update(){
        $sql = "UPDATE productos SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()},  categoria_id='{$this->getCategoria_id()}'";
        
        if(!empty($this->getImagen())){
        $sql .= ", imagen='{$this->getImagen()}'";
        }

        $sql .= " WHERE id = {$this->getId()}";

        $ejecutar = $this->db->query($sql);

        $result = false;
        if($ejecutar){
            $result = true;
        }

        return $result;
    }

    public function delete(){
        

        // $sql = "DELETE FROM productos WHERE id = {$this->getId()}";
        $sql = "UPDATE productos SET eliminado = 1 WHERE id = {$this->getId()}";
        $ejecutar = $this->db->query($sql);

        $result = false;
        if($ejecutar){
            $result = true;
        }

        return $result;
    }

}

?>