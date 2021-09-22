<?php
require_once 'models/Pedido.php';
require_once 'models/Producto.php';

class PedidoController{

    public function index(){    

        if(isset($_SESSION['carrito'])){
            $count = [];
            foreach($_SESSION['carrito'] as $indice => $elemento){
                    if($elemento['limite'] == true){
                        $count[] = true;
                    }
            }

            if(!empty($count)){

                header('Location:'.base_url.'carrito/index');
            }
            
        }
        
        require_once 'views/pedido/index.php';
        
    }

    public function add(){


        if(isset($_POST['confirmar_pedido']) && isset($_SESSION['identity'])){


            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            $errores = [];
            $campos = [];

            if($provincia == false){
                $errores['provincia'] = 'el campo es obligatorio';
            }else{
                $campos['provincia'] = $provincia;
            }

            if($localidad == false){
                $errores['localidad'] = 'el campo es obligatorio';
            }else{
                $campos['localidad'] = $localidad;
            }

            if($direccion == false){
                $errores['direccion'] = 'el campo es obligatorio';
            }else{
                $campos['direccion'] = $direccion;
            }


            if(count($errores) == 0){

                $usuario_id = $_SESSION['identity']->id;
                $stats = Utils::statsCarrito();
               
                $pedido = new Pedido();
                
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($stats['total']);

                $save = $pedido->save();
                $lineas_pedidos = $pedido->lineas_pedidos();
                
                if($save && $lineas_pedidos){

                    $pedido->updateStock();
                    Utils::DeleteSession('carrito');
                    
                    $_SESSION['pedido'] = 'confirm';
            
                }else{
                    $_SESSION['pedido'] = 'failed';
                }

                header('location:'.base_url.'pedido/confirmado?#confirmado');

            }else{
                
                $_SESSION['errores-pedido'] = $errores;
                $_SESSION['campos-pedido'] = $campos;

                header('location:'.base_url.'pedido/index');
            }
            

        }else{
            header('location:'.base_url.'pedido/index');
        }

        
    }
    
    public function confirmado(){
        
        if(isset($_SESSION['identity'])){

            $usuario_id = $_SESSION['identity']->id;

            $pedido = new Pedido();
            $pedido = $pedido->getOneByUser($usuario_id); 

            if(is_object($pedido)){ 

            $pedido_id = $pedido->id;

            $pedido_producto = new Pedido();
            $productos = $pedido_producto->getProductoByPedido($pedido_id);

            } 

        }else{

            header('location:'.base_url);

        }

        require_once 'views/pedido/confirmado.php';

    }

    public function mis_pedidos(){

        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;

        $mis_pedidos = new Pedido();
        $mis_pedidos->setUsuario_id($usuario_id);

        $pedidos = $mis_pedidos->getAllByUser();

        require_once 'views/pedido/mis_pedidos.php';

    }

    public function detalle(){

        Utils::isIdentity();

        if(isset($_GET['id'])){

            $id = $_GET['id'];

            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();
            $pedido = $pedido->fetch_object();

            $usuario = new Pedido();
            $usuario->setId($id);
            $usuario = $usuario->getUserByPedido();
            $usuario = $usuario->fetch_object();

            $usuario_id = $_SESSION['identity']->id;

            $pedido_producto = new Pedido();
            $productos = $pedido_producto->getProductoByPedido($id);

            require_once 'views/pedido/detalle.php';

        }else{
            header('location:'.base_url.'pedido/mis_pedidos');
        }


    }

    public function gestion(){

        Utils::isAdmin();
        
        $gestion = true;

        $pedidos = new Pedido();
        $pedidos = $pedidos->getAll();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function actualizar_estado(){

        Utils::isAdmin();

        if(isset($_POST['cambiar_estado']) && isset($_GET['id'])){

            $id = $_GET['id'];
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;

            if($estado){

                $pedido = new Pedido();
                $pedido->setEstado($estado);
                $pedido->setId($id);
                $update = $pedido->updateState();

                if($update){
                    $_SESSION['update_estado'] = 'estado se actualizo correctamente';
                }else{
                    header('Location:'.base_url);   
                }
            }

            header('Location:'.base_url.'pedido/detalle&id='.$id.'?#pedido');
        }
        
    }
    
}

?>