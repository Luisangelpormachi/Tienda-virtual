<h1>Gestion Producto</h1>



<div class="sub-main">

<?php if(isset($_SESSION['producto']['success'])):?>
    <div class="alert alert-success">Nuevo producto agregado correctamente</div>
<?php endif; ?>

<?php if(isset($_SESSION['producto']['success-update'])):?>
    <div class="alert alert-success">producto actualizado correctamente</div>
<?php endif; ?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'success'):?>
    <div class="alert alert-success">Eliminado correctamente</div>
<?php endif; ?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed'):?>
    <div class="alert alert-danger">failed on delete</div>
<?php endif; ?>

<a href="<?= base_url ?>producto/create" class="button button-function">Crear Producto</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>DESCRIPCIÓN</th>
            <th>PRECIO</th>
            <th>STOCK</th>
            <th>OPERACIONES</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $enumeracion = 1;
        while($pro = $productos->fetch_object()):?>
        <tr>
            <td><?= $enumeracion++ ?></td>
            <td><?= $pro->nombre ?></td>
            <td><?= $pro->descripcion ?></td>
            <td><?= $pro->precio ?></td>
            <td><?= $pro->stock ?></td>
            <td>
                <a href="<?=base_url?>producto/edit&id=<?= $pro->id ?>" class="button button-gestion button-green">Editar</a>
                <a href="<?=base_url?>producto/delete&id=<?= $pro->id ?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

    
</div>

<?php Utils::DeleteSession('producto');?>
<?php Utils::DeleteSession('delete');?>