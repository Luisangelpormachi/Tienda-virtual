<?php
require_once 'models/Usuario.php';

class UsuarioController{

    public function index(){    
        echo "Controller = Usuario  <br> function = index";
    }

    public function register(){

        require_once 'views/usuario/register.php';

    }

    public function save(){

        $usuario = new Usuario();

        if(isset($_POST)){

            $nombre =  (isset($_POST["nombre"]) ? $_POST["nombre"] : '');
            $apellidos =  (isset($_POST["apellidos"]) ? $_POST["apellidos"] : '');
            $email =  (isset($_POST["email"]) ? $_POST["email"] : '');
            $password =  (isset($_POST["password"]) ? $_POST["password"] : '');

            $errores = [];
            $campos = [];
            
            if(!empty($nombre) && !is_numeric($nombre) && !preg_match('/[0-9]/', $nombre)){
                $campos['nombre'] = $nombre;
            }else{
                $errores['nombre'] = 'El nombre no es valido';
            }

            if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match('/[0-9]/', $apellidos)){
                $campos['apellidos'] = $nombre;
            }else{
                $errores['apellidos'] = 'Los apellidos no son validos';
            }

            if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
                $campos['email'] = $email;
            }else{
                $errores['email'] = 'El email no es valido';
            }

            if(!empty($password)){
                $campos['password'] = $password;
            }else{
                $errores['password'] = 'La contraseña no es valida';
            }

            $email_exist = $usuario->email_exist($email);

            if(!empty($email) && $email_exist == true) {
                $campos['email'] = $email;
                $errores['email_exist'] = "Email ya existe";
            }

            if(count($errores) == 0){

                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                

                // var_dump($usuario);
                $save = $usuario->save();

                if($save){
                    $_SESSION['register'] = "success";
                }else{
                    $_SESSION['register'] = "failed";
                }
                
            }else{
                $_SESSION['campos'] = $campos;
                $_SESSION['errores'] = $errores;
            }

            
        }

        header('Location: '.base_url.'usuario/register');
    }

    public function login(){

        if(isset($_POST['entrar'])){

            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            $campos = [];
            $errores = [];

            if($email){
                $campos['email'] = $email;
            }else{
                $errores['email'] = "Completar Email";
            }

            if($password){
                $campos['password'] = $password;
            }else{
                $errores['password'] = "Completar Password";
            }
            
            if(count($errores) == 0){

                $_SESSION['campos-login'] = $campos;

                $usuario = new Usuario();
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $identity = $usuario->login();
    
                // var_dump($identity);
                // die();
    
    
                if($identity && is_object($identity)){

                    $_SESSION['identity'] = $identity;
    
                    if($identity->rol == 'admin'){
                        $_SESSION['admin'] = true;
                    }
    
                }
                
                
            }else{

               $_SESSION['errores-login'] = $errores;
               $_SESSION['campos-login'] = $campos;

            }
            
        }
        
        header('location:'.base_url);

    }

    public function logout(){

        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
            Utils::DeleteCampos('campos-login');
            $_SESSION['identity'] = null;
            
            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
                $_SESSION['admin'] = null;
            }

            header('location:'.base_url);

        }

    }
        

    

}

?>