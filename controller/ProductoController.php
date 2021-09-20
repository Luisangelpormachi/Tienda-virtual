<?php
require_once 'models/Producto.php';

class ProductoController{

    public function index(){    
        
        $producto = new Producto();
        $productos = $producto->getRandom(6);

        require_once 'views/producto/destacados.php';

    }

    public function ver(){
        
        if(isset($_GET['id'])){

            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);

            $pro = $producto->getOne();

            require_once 'views/producto/ver.php';
        }

    } 

    public function gestion(){
        
        Utils::isAdmin();

        $producto = new Producto();
        $productos = $producto->getAll();

        require_once 'views/producto/gestion.php';

    }

    public function create(){

        Utils::isAdmin();
        $categorias = Utils::showCategorias();

        require_once 'views/producto/create.php';

    }

    public function save(){
        Utils::isAdmin();

        if(isset($_POST['guardar'])){

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;

            $campos = [];
            $errores = [];

            if(!empty($nombre)){
                $campos['nombre'] = $nombre;
            }else{
                $errores['nombre'] = 'El nombre no es valido';
            }

            if(!empty($descripcion)){
                $campos['descripcion'] = $descripcion;
            }else{
                $errores['descripcion'] = 'El descripcion no es valido';
            }

            if(!empty($precio) && !preg_match('/[a-zA-Z]/', $precio)){
                $campos['precio'] = $precio;
            }else{
                $errores['precio'] = 'El precio no es valido';
            }

            if(!empty($stock) && is_numeric($stock) && !preg_match('/[a-zA-Z]/', $stock)){
                $campos['stock'] = $stock;
            }else{
                $errores['stock'] = 'El stock no es valido';
            }

            if(!empty($categoria) && is_numeric($categoria) && !preg_match('/[a-zA-Z]/', $categoria)){
                $campos['categoria'] = $categoria;
            }else{
                $errores['categoria'] = 'La categoria no es valido';
            }

            // if ($_FILES['imagen']['name'] == null) {
            //     $errores['imagen'] = 'La imagen es obligatorio';
            // }
            

            if(count($errores) == 0){

                $newProducto = new Producto();

                $newProducto->setNombre($nombre);
                $newProducto->setDescripcion($descripcion);
                $newProducto->setPrecio($precio);
                $newProducto->setStock($stock);
                $newProducto->setCategoria_id($categoria);
                
                // guardar imagen
                $file = $_FILES['imagen'];
                $filename = $file['name'];
                $mimetype = $file['type'];

                if($mimetype == 'image/jpg' || $mimetype == 'image/png'  || $mimetype == 'image/jpeg'){

                    if(!is_dir('uploads/images')){
                        mkdir('uploads/images', 0777, true);
                    }

                    $newProducto->setImagen($filename);
                    move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                }

                if(isset($_GET['id'])){

                    $id = $_GET['id'];
                    
                    $newProducto->setId($id);
                    $update = $newProducto->update();

                    if($update){

                        $producto['success-update'] = 'success';
                        $_SESSION['producto'] = $producto;
    
                        header('location:'.base_url.'producto/gestion');
                    }else{
    
                        $producto['failed'] = 'failed';
                        $_SESSION['producto'] = $producto;
    
                        header('location:'.base_url.'producto/edit&id='.$id);
                    }

                }else{
                    $save = $newProducto->save();
                    $producto = [];

                    if($save){

                        $producto['success'] = 'success';
                        $_SESSION['producto'] = $producto;
    
                        header('location:'.base_url.'producto/gestion');
                    }else{
    
                        $producto['failed'] = 'failed';
                        $_SESSION['producto'] = $producto;
    
                        header('location:'.base_url.'producto/create');
                    }
                }           
                

            }else{
                
                if(isset($_GET['id'])){
                
                $id = $_GET['id'];
                $_SESSION['errores'] = $errores;
                $_SESSION['campos'] = $campos;
                header('location:'.base_url.'producto/edit&id='.$id);
                
                }else{

                $_SESSION['errores'] = $errores;
                $_SESSION['campos'] = $campos;
                header('location:'.base_url.'producto/create');        

                }

            }
 
        }

    }
  

    public function edit(){
        
        Utils::isAdmin();

        if(isset($_GET['id'])){

            $edit = true;

            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);

            $pro = $producto->getOne();

            require_once 'views/producto/create.php';
        }

    }   

    public function delete(){
        
        Utils::isAdmin();
        
        if(isset($_GET['id'])){

            $id = $_GET['id'];
            $producto = new Producto(); 
            $producto->setId($id);

            $delete = $producto->delete();
            
            if($delete){
                $_SESSION['delete'] = 'success';
            }else{
                $_SESSION['delete'] = 'failed';
            }  

        }

        header('location:'.base_url.'producto/gestion');
    }

}

?>