<h1 id="categoria">Crear categoria</h1>

<form action="<?= base_url ?>categoria/save" method="POST" class="form-register">

<?php if(isset($_SESSION['failed-crearCategoria'])):?>
    <div class="alert alert-danger">Failed</div>
<?php endif; ?>

    <label for="nombre">Nueva categoria:</label>
    <input type="text" name="nombre">

    <?php if(isset($_SESSION['errores-crearCategoria'])):?>

        <div class="alert alert-danger">
            <?= $_SESSION['errores-crearCategoria'] ?>
        </div>

    <?php endif; ?>

    <input type="submit" name="agregar" value="Agregar">
</form>

<?php Utils::DeleteSession('errores-crearCategoria'); ?>
<?php Utils::DeleteSession('failed-crearCategoria'); ?>
