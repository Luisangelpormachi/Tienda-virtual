
<h1>Registrarse</h1>

<div id="register">

<form action="<?= base_url ?>usuario/save" method="POST" class="form-register">

    <?php if(isset($_SESSION['register'])): ?>

    <?php switch($_SESSION['register']){

        case('success');
            echo '<div class="alert alert-success"> Registrado correctamente </div>';
        break;
        
        case('failed');
            echo '<div class="alert alert-danger"> Falló al registrar </div>';
        break;

        case('incompleted');
            echo '<div class="alert alert-danger"> Complete los todos los campos </div>';
        break;
        
    }?>

    <?php endif; ?>

    <?= isset($_SESSION['errores']['email_exist']) ?  Utils::MostrarAlerta($_SESSION['errores'], 'email_exist') : '';?>

    <label for="nombre">Nombres:</label>
    <input type="text" name="nombre" value="<?=  isset($_SESSION['campos']['nombre']) ? $_SESSION['campos']['nombre'] : ''?>">
    <?=  isset($_SESSION['errores']) ? Utils::MostrarAlerta($_SESSION['errores'], 'nombre') : '' ;?>

    <label for="apellido">Apellidos:</label>
    <input type="text" name="apellidos" value="<?=  isset($_SESSION['campos']['apellidos']) ? $_SESSION['campos']['apellidos'] : ''?>">
    <?= isset($_SESSION['errores']) ?  Utils::MostrarAlerta($_SESSION['errores'], 'apellidos') : '';?>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?=  isset($_SESSION['campos']['email']) ? $_SESSION['campos']['email'] : ''?>">
    <?= isset($_SESSION['errores']) ?  Utils::MostrarAlerta($_SESSION['errores'], 'email') : '';?>

    <label for="password">Password:</label>
    <input type="password" name="password" value="<?=  isset($_SESSION['campos']['password']) ? $_SESSION['campos']['password'] : ''?>">
    <?= isset($_SESSION['errores']) ?  Utils::MostrarAlerta($_SESSION['errores'], 'password') : '';?>

    <input type="submit" value="Registrarse">

</form>

</div>

<?php Utils::DeleteSession('register');?>
<?php Utils::DeleteSession('errores');?>
<?php Utils::DeleteCampos('campos');?>