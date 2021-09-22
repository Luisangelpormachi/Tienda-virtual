<?php if(isset($edit) && isset($pro) && is_object($pro)): ?>
    
    <h1 id="producto">Editar Producto "<?=$pro->nombre?>"</h1>
    <?php  
    $base_url = base_url."producto/save&id=".$pro->id;
    $value_submit = "Actualizar";

    $nombre = isset($_SESSION['campos']['nombre']) ? $_SESSION['campos']['nombre'] : $pro->nombre;
    $descripcion = isset($_SESSION['campos']['descripcion']) ? $_SESSION['campos']['descripcion'] : $pro->descripcion;
    $precio = isset($_SESSION['campos']['precio']) ? $_SESSION['campos']['precio'] : $pro->precio;
    $stock = isset($_SESSION['campos']['stock']) ? $_SESSION['campos']['stock'] : $pro->stock;

    ?>
<?php else:?>
    <h1 id="producto">Crear Productos</h1>
    <?php  
    $base_url = base_url."producto/save";
    $value_submit = "Guardar";

    $nombre = isset($_SESSION['campos']['nombre']) ? $_SESSION['campos']['nombre'] : '';
    $descripcion = isset($_SESSION['campos']['descripcion']) ? $_SESSION['campos']['descripcion'] : '';
    $precio = isset($_SESSION['campos']['precio']) ? $_SESSION['campos']['precio'] : '';
    $stock = isset($_SESSION['campos']['stock']) ? $_SESSION['campos']['stock'] : '';
    $categoria_id = isset($_SESSION['campos']['categoria']) ? $_SESSION['campos']['categoria'] : '';
    ?>
<?php endif; ?>


<form action="<?=$base_url?>" method="post"  class="form-register" enctype="multipart/form-data">

    <?php if(isset($_SESSION['producto']['failed'])):?>
        <?= Utils::MostrarAlerta($_SESSION['producto'], 'failed') ;?>
    <?php endif; ?>

    <label for="nombre">Nombre: </label>
    <input type="text" name="nombre" value="<?= $nombre ;?>">
    <?= isset($_SESSION['errores']['nombre']) ? Utils::MostrarAlerta($_SESSION['errores'], 'nombre') : '' ?>
    
    <label for="descripcion">Descripcion: </label>
    <textarea name="descripcion"><?= $descripcion ;?></textarea>
    <?= isset($_SESSION['errores']['descripcion']) ? Utils::MostrarAlerta($_SESSION['errores'], 'descripcion') : '' ?>

    <label for="precio">Precio: </label>
    <input type="text" name="precio" value="<?= $precio  ;?>">
    <?= isset($_SESSION['errores']['precio']) ? Utils::MostrarAlerta($_SESSION['errores'], 'precio') : '' ?>

    <label for="stock">Stock: </label>
    <input type="number" name="stock" value="<?= $stock ;?>">
    <?= isset($_SESSION['errores']['stock']) ? Utils::MostrarAlerta($_SESSION['errores'], 'stock') : '' ?>

    <label for="categoria">Categoria: </label>

    <select name="categoria">
        <?php $categorias = Utils::showCategorias() ;?>
        <?php while($categoria = $categorias->fetch_object()):?>
        <option value="<?= $categoria->id ?>" 
        <?= isset($pro) && is_object($pro) && $pro->categoria_id == $categoria->id ? 'selected' : null?>
        <?= isset($categoria_id) && $categoria_id == $categoria->id ? 'selected' : null?>
        <?= isset($pro) && isset($_SESSION['campos']['categoria']) && $_SESSION['campos']['categoria'] == $categoria->id ? 'selected' : null?>
        >
            <?=$categoria->nombre?>
        </option>
        <?php endwhile; ?>
    </select>
    
    <label for="imagen">Imagen: </label>

    <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)):?>
    <img src="<?=base_url."uploads/images/".$pro->imagen?>" class="thump"><br>
    <?php endif; ?>

    <input type="file" name="imagen">
    <?= isset($_SESSION['errores']['imagen']) ? Utils::MostrarAlerta($_SESSION['errores'], 'imagen') : '' ?>

    <input type="submit" name="guardar" value="<?=$value_submit?>">

</form>
<?php Utils::DeleteSession('errores');?>
<?php Utils::DeleteSession('producto');?>
<?php Utils::DeleteSession('campos');?>

