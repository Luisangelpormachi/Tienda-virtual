<?php if(isset($_SESSION['identity'])) :?>
    
    <h1 id="pedido">Hacer Pedido</h1>
       
        <form action="<?=base_url?>pedido/add" method="POST" class="form-register   ">

            <a href="<?=base_url?>carrito/index?#carrito">Ver los productos y los precios del pedido</a>

            <label for="">Provincia</label>
            <input type="text" name="provincia" value="<?= isset($_SESSION['campos-pedido']['provincia']) ? $_SESSION['campos-pedido']['provincia'] : ''; ?>">
            <?= isset($_SESSION['errores-pedido']['provincia']) ? Utils::MostrarAlerta($_SESSION['errores-pedido'], 'provincia') : ''?>

            <label for="">Localidad</label>
            <input type="text" name="localidad" value="<?= isset($_SESSION['campos-pedido']['localidad']) ? $_SESSION['campos-pedido']['localidad'] : ''; ?>">
            <?= isset($_SESSION['errores-pedido']['localidad']) ? Utils::MostrarAlerta($_SESSION['errores-pedido'], 'localidad') : ''?>

            <label for="">Dirección</label>
            <input type="text" name="direccion" value="<?= isset($_SESSION['campos-pedido']['direccion']) ? $_SESSION['campos-pedido']['direccion'] : ''; ?>">
            <?= isset($_SESSION['errores-pedido']['direccion']) ? Utils::MostrarAlerta($_SESSION['errores-pedido'], 'direccion') : ''?>

            <input type="submit" name="confirmar_pedido" value="Confirmar pedido">

        </form>

<?php else: ?>

    <div class="sub-main">
        <p>Inicia sesion o identificate para que puedas realizar el pedido</p>

        

    </div>

<?php endif; ?>
<?php Utils::DeleteSession('errores-pedido') ?>
<?php Utils::DeleteSession('campos-pedido') ?>