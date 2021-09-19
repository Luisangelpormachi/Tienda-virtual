<?php

class Utils{

    public static function DeleteSession($name){

        if(isset($_SESSION[$name])){

            $_SESSION[$name] = null;
            unset($_SESSION[$name]);

        }

        return $name;

    }

    public static function DeleteCampos($name){
        
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    public static function MostrarAlerta($session, $name){

        $mostrar = false;
        if(isset($session[$name]) && !empty($name)){
            $mostrar = "<div class='alert alert-danger'>$session[$name]</div>";
        }

        return $mostrar;
    }

    public static function isAdmin(){

        if(!isset($_SESSION['admin'])){
            header('location:'.base_url);
        }else{
            return true;
        }

    }

    public static function isIdentity(){

        if(!isset($_SESSION['identity'])){
            header('location:'.base_url);
        }else{
            return true;
        }

    }

    public static function showCategorias(){

        require_once 'models/Categoria.php';

        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        return $categorias;
    }

    public static function statsCarrito(){

        $stats = array(
            "cantidad" => 0,
            "total" => 0,
        );

        if(isset($_SESSION['carrito'])){
                
            foreach($_SESSION['carrito'] as $indice => $elemento){
                $stats['cantidad'] += $elemento['cantidad'];
                $stats['total'] += $elemento['precio'] * $elemento['cantidad'];
            }
            
        }

        return $stats;
    }

    public static function estadosPedidos(){

        $estados = ['enviado','preparacion','listo','confirmado']; 

        return $estados;
    }

    public static function MostrarEstado($estado){

        if($estado == 'enviado'){
            
            $result = 'Ya está enviado';

        }elseif($estado == 'preparacion'){
           
            $result = 'En preparación';

        }elseif($estado == 'listo'){

            $result = 'Preparado para enviar';
            
        }elseif($estado == 'confirmado'){

            $result = 'Pendiente';

        }

        return $result;
            
    }
}

?>