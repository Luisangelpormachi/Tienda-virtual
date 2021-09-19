<?php
require_once 'models/Producto.php';


class CarritoController{

        public function index(){

            if(isset($_SESSION['carrito'])){
                $carrito = $_SESSION['carrito'];
                // var_dump($_SESSION['carrito']);
                // die();
            }
            
            require_once 'views/carrito/index.php';
        }

        public function add(){

            if(isset($_GET['id'])){
                $producto_id = $_GET['id'];
            }else{
                header('Location:'.base_url);
            }


            if(isset($_SESSION['carrito'])){

                $counter = 0;

                foreach($_SESSION['carrito'] as $indice => $elemento){

                    if($elemento['producto_id'] == $producto_id){
                        $_SESSION['carrito'][$indice]['cantidad']++; 
                        $counter++;   
                    
                    }
                    
                    if($elemento['cantidad'] > $elemento['stock']){
                            
                        $_SESSION['carrito'][$indice]['limite'] = true;
                    }else{
                        
                        $_SESSION['carrito'][$indice]['limite'] = false;
                    }

                }

            }
            
            if(!isset($counter) || $counter == 0){

                $producto = new Producto();
                $producto->setId($producto_id);
                $producto = $producto->getOne();

                if($producto->stock > 0){
                    
                    $_SESSION['carrito'][] = array(

                        "producto_id" => $producto->id,
                        "precio" => $producto->precio,
                        "cantidad" => 1,
                        "stock" => intval($producto->stock),
                        "limite" => false,
                        "producto" => $producto,   
                    );

                }else{

                    $_SESSION['carrito'][] = array(

                        "producto_id" => $producto->id,
                        "precio" => $producto->precio,
                        "cantidad" => 1,
                        "stock" => intval($producto->stock),
                        "limite" => true,
                        "producto" => $producto,   
                    );

                }    
            }

            header('location:'.base_url.'carrito/index');
        }

        public function delete(){

            if(isset($_SESSION['carrito']) && isset($_GET['indice'])){
                
                $indice = $_GET['indice'];
                unset($_SESSION['carrito'][$indice]);

            }

            header('location:'.base_url.'carrito/index');
        }

        public function up(){

            if(isset($_SESSION['carrito']) && isset($_GET['indice'])){
                
                $indice = $_GET['indice'];
                $_SESSION['carrito'][$indice]['cantidad']++;

                if($_SESSION['carrito'][$indice]['cantidad'] > $_SESSION['carrito'][$indice]['stock']){
                            
                    $_SESSION['carrito'][$indice]['limite'] = true;
                }else{
                    
                    $_SESSION['carrito'][$indice]['limite'] = false;
                }

            }

            header('location:'.base_url.'carrito/index');
        }

        public function down(){

            if(isset($_SESSION['carrito']) && isset($_GET['indice'])){
                
                $indice = $_GET['indice'];

                $_SESSION['carrito'][$indice]['cantidad']--;

                if($_SESSION['carrito'][$indice]['cantidad'] > $_SESSION['carrito'][$indice]['stock']){
                            
                    $_SESSION['carrito'][$indice]['limite'] = true;
                }else{
                    
                    $_SESSION['carrito'][$indice]['limite'] = false;
                }

                if($_SESSION['carrito'][$indice]['cantidad'] == 0 ){                  
                    unset($_SESSION['carrito'][$indice]);        
                }

                
            }

            header('location:'.base_url.'carrito/index');
        }

        public function delete_all(){

            if(isset($_SESSION['carrito'])){
                unset($_SESSION['carrito']);

                header('location:'.base_url.'carrito/index');
            }

        }
}

?>