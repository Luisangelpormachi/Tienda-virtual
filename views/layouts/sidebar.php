
<!-- SIDEBAR  -->
<aside id="sidebar">

    <div class="block-aside">
        <?php $stats = Utils::statsCarrito(); ?>
        <h3>Carrito de compras</h3>
        <ul>
            <li>
                <a href="<?=base_url?>carrito/index">Productos (<?=$stats['cantidad']?>)</a>
            </li>
            <li>
                <a href="<?=base_url?>carrito/index">Total S/. <?=$stats['total']?></a>
            </li>
            <li>
                <a href="<?=base_url?>carrito/index?#main">Ver Carrito</a>
            </li>
        </ul>
    </div>

    <?php if(!isset($_SESSION['identity'])): ?>

    <div id="login" class="block-aside">
        <h3>Entrar a la web</h3>
        <form action="<?= base_url ?>usuario/login" method="POST">
            <?= isset($_SESSION['errores-login']['email_exist']) ? Utils::MostrarAlerta($_SESSION['errores-login'], 'email_exist') : '' ?>
            <?= isset($_SESSION['errores-login']['email_not_exist']) ? Utils::MostrarAlerta($_SESSION['errores-login'], 'email_not_exist') : '' ?>
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= isset($_SESSION['campos-login']['email']) ? $_SESSION['campos-login']['email'] : '' ?>">
            <?= isset($_SESSION['errores-login']) ? Utils::MostrarAlerta($_SESSION['errores-login'], 'email') : '' ?>
            <label for="password">Password:</label>
            <input type="password" name="password" value="<?= isset($_SESSION['campos-login']['password']) ? $_SESSION['campos-login']['password'] : '' ?>">  
            <?= isset($_SESSION['errores-login']) ? Utils::MostrarAlerta($_SESSION['errores-login'], 'password') : '' ?>
            <input type="submit" name="entrar" value="Entrar">
        </form>
        
        <?php Utils::DeleteCampos('campos-login');?>
        <?php Utils::DeleteSession('errores-login');?>
    </div>
    
    <ul>
        <li><a href="<?= base_url ?>usuario/register#register">Registrate aquí</a></li>
    </ul>

    <?php elseif(isset($_SESSION['identity'])): ?>

    <div id="login" class="block-aside">
        <h3><strong>Usuario: </strong><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellidos ?></h3>
    
        <ul>
      

            <?php if(isset($_SESSION['admin'])):?>

            <li><a href="<?= base_url ?>categoria/index?#categorias">Gestionar categorias</a></li>
            <li><a href="<?= base_url ?>producto/gestion?#productos">Gestionar productos</a></li>
            <li><a href="<?= base_url ?>pedido/gestion?#pedidos">Gestionar pedidos</a></li>

            <?php endif; ?>

            <li><a href="<?= base_url ?>pedido/mis_pedidos?#pedidos">Mis pedidos</a></li>   
            <li><a href="<?= base_url ?>usuario/logout">Cerrar Sesión</a></li>

        
        </ul>

    </div>
    
    <?php endif; ?>
    


</aside>

<!-- MAIN  -->
<div id="main">