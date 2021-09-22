<?php
ob_start();

session_start();

require_once 'autoload.php';
require_once 'config/DataBase.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layouts/header.php';
require_once 'views/layouts/sidebar.php';

function Show_Error(){
    $Error = new ErrorController();
    $Error->index();

    return $Error;
}

if(isset($_GET['controller'])){

    $nombre_controlador = $_GET['controller']."Controller";

}elseif(!isset($_GET['controller']) && !isset($_GET['method'])){

    $nombre_controlador = controller_default;

}else{

    Show_Error();
    exit();
}   

if(class_exists($nombre_controlador)){

    $controller = new $nombre_controlador();

    if(isset($_GET['method']) && method_exists($controller, $_GET['method'])){

        $method = $_GET['method'];
        
        $controller->$method();
    
    }elseif(!isset($_GET['controller']) && !isset($_GET['method'])){

        $method_default = method_default;
        $controller->$method_default();
        

    }else{
    
        Show_Error();
    
    }

}else{

    Show_Error();

}


require_once 'views/layouts/footer.php';





?>

