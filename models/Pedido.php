<?php

class Pedido{

    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
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

    public function getUsuario_id(){
        return $this->usuario_id;
    }

    public function setUsuario_id($usuario_id){
        $this->usuario_id = $usuario_id;
    }
    
    public function getProvincia(){
        return $this->provincia;
    }

    public function setProvincia($provincia){
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    public function getLocalidad(){
        return $this->localidad;
    }

    public function setLocalidad($localidad){
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function setDireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    public function getCoste(){
        return $this->coste;
    }

    public function setCoste($coste){
        $this->coste = $coste;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getHora(){
        return $this->hora;
    }

    public function setHora($hora){
        $this->hora = $hora;
    }

    public function getOne(){

        $sql = "SELECT * FROM pedidos WHERE id = {$this->getId()}";
        $ejecutar = $this->db->query($sql);

        $result = false;
        if($ejecutar){
            $result = $ejecutar;
        }
        return $result;
    }

    public function getAll(){

        $sql = "SELECT * FROM pedidos ORDER BY id DESC";
        $ejecutar = $this->db->query($sql);

        $result = false;
        if($ejecutar){
            $result = $ejecutar;
        }
        return $result;
    }

    public function save(){
        $sql = "INSERT INTO pedidos VALUES(NULL, {$this->getUsuario_id()}, '{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirmado', CURDATE(), CURTIME())";
        
        $ejecutar = $this->db->query($sql);

        $result = false;
        if($ejecutar){
            $result = true;
        }
        
        return $result;
    }

    public function lineas_pedidos(){
        
        $sql = "SELECT LAST_INSERT_ID() AS 'pedido' ";
        $ejecutar = $this->db->query($sql);
        $pedido_id = $ejecutar->fetch_object()->pedido;

        foreach($_SESSION['carrito'] as $indice => $elemento){

            $producto_id = $elemento['producto_id'];
            $cantidad = $elemento['cantidad'];
      
            $sql = "INSERT INTO lineas_pedidos VALUES(NULL, $pedido_id, $producto_id, $cantidad)";
            $ejecutar = $this->db->query($sql);
        }
        $result = false;

        if($ejecutar){
            $result = true;
        }

        return $result;
    }

    public function getOnebyUser($usuario_id){

        $sql = "SELECT * FROM pedidos WHERE usuario_id = $usuario_id ORDER BY id DESC LIMIT 1";
        $ejecutar = $this->db->query($sql);

        $result = false;
        if($ejecutar){
            $result = $ejecutar->fetch_object();
        }

        return $result;
    }

    public function getProductoByPedido($pedido_id){

        $sql = "SELECT pr.*, lp.unidades FROM productos pr
               INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id
               INNER JOIN pedidos pe ON lp.pedido_id = pe.id 
               WHERE pe.id = $pedido_id";

        $ejecutar = $this->db->query($sql);

        $result = false;
        if($ejecutar){
            $result = $ejecutar;
        }
        return $result;
    }

    public function getAllByUser(){

        $sql = "SELECT * FROM pedidos WHERE usuario_id = '{$this->getUsuario_id()}' ORDER BY id DESC";
        $ejecutar = $this->db->query($sql);

        $result = false;
        if($ejecutar){
            $result = $ejecutar;
        }
        return $result;
    }

    public function updateState(){
        $sql = "UPDATE  pedidos SET estado = '{$this->getEstado()}' WHERE id = {$this->getId()}";
        
        $ejecutar = $this->db->query($sql);

        $result = false;
        if($ejecutar){
            $result = true;
        }
        
        return $result;
    }

    public function getUserByPedido(){

        $sql = "SELECT us.* FROM usuarios us
                INNER JOIN pedidos pe ON pe.usuario_id = us.id
                WHERE pe.id = {$this->getId()}";

        $ejecutar = $this->db->query($sql);

        $resul = false;
        if($ejecutar){
            $resul = $ejecutar;
        }

        return $resul;
    }

    public function updateStock(){       

        if(isset($_SESSION['carrito'])){

            foreach($_SESSION['carrito'] as  $elemento){
                
                $producto_id = $elemento['producto_id'];
                $cantidad = $elemento['cantidad'];

                //actualizar stock
                $sql = "UPDATE productos SET stock = stock - $cantidad 
                WHERE id = $producto_id";
                $ejecutar = $this->db->query($sql);
            }
        }

        $result = false;
        if($ejecutar){
            $result = true;
        }

        return $result;
    }

    
}

?>