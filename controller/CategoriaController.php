<?php
require_once 'models/Categoria.php';
require_once 'models/Producto.php';

class CategoriaController{

    public function index(){    
        
        Utils::isAdmin();

        $categoria = new Categoria();
        $categorias = $categoria->getAll();  
        
        $limit = new Categoria();
        $limit = $limit->getAll(true);  
        
        require_once 'views/categoria/index.php';

    }

    public function ver(){

        if(isset($_GET['id']) && is_numeric($_GET['id'])){

            // traer la categoria
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);
            
            $categoria = $categoria->getOne();

            //traer los productos de la categoria
            $producto = new Producto();
            $producto->setCategoria_id($id);

            $productos = $producto->getAllCategoria();
        }
          
        require_once 'views/categoria/ver.php';
    }


    public function create(){

        Utils::isAdmin();

        require_once 'views/categoria/create.php';

    }

    public function save(){
        Utils::isAdmin();

        if(isset($_POST['agregar'])){

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;

            if($nombre){

                $newCategoria = new Categoria();
                $newCategoria->setNombre($nombre);

                $save = $newCategoria->save();

                if($save){
                    $_SESSION['success-crearCategoria'] = true;
                    header('location:'.base_url.'categoria/index');
                }else{
                    $_SESSION['failed-crearCategoria'] = true;
                    header('location:'.base_url.'categoria/create');
                }

            }else{

                header('location:'.base_url.'categoria/create');
                $_SESSION['errores-crearCategoria'] = "Complete el campo";

            }

            
        }
        
    }

}

?>