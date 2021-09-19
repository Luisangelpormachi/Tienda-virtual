
<?php if($pedido != null):?>

    <h1>Detalle de Pedido N° <?= $pedido->id  ?></h1>

    <div class="sub-main">   
    <?php if(isset($_SESSION['admin'])): ?> 
    <?php $estados = Utils::estadosPedidos();?>  

        <h3>Cambiar estado de pedido</h3>
        <form action="<?=base_url?>pedido/actualizar_estado&id=<?=$pedido->id?>" method="POST">           
            <select name="estado">
            <?php foreach($estados as $estado):?>
                <option value="<?=$estado?>" <?=isset($pedido) && $pedido->estado == $estado ? 'selected' : null ?>><?=$estado?></option>
            <?php endforeach;?>
            </select>
            <input type="submit" name="cambiar_estado" value="Cambiar estado">
        </form>

    <?php else: ?> 
    <p>
        Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria  con el coste del 
        pedido, será procesado y enviado.
    </p>
    <?php endif; ?>
    
    <br><hr><br>
    <h3>Datos del cliente</h3>
    Nombres: <?= $usuario->nombre ?> <?= $usuario->apellidos ?><br>
    Correo:  <?= $usuario->email ?><br><br>

    <h3>Dirección del envío</h3>
    Provincia:  <?= $pedido->provincia ?><br>
    Localidad:  <?= $pedido->localidad ?><br>
    Dirección:  <?= $pedido->direccion ?>

    <br><br>
    <h3>Datos del pedido</h3>
    Numero de pedido:  <?= $pedido->id ?><br>
    Total a pagar: S/.  <?= $pedido->coste ?><br>
    Estado:  <?= Utils::MostrarEstado($pedido->estado) ?><br>
    Productos: <br><br>

    <div class="pedido-detalle">
    <table>
        <thead>
            <tr>
                <th>IMAGEN</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>CANTIDAD</th>
            </tr>      
        </thead>
        <tbody>

            <?php 
                while($producto = $productos->fetch_object()): 
            ?>

            <tr>
                <td>
                    <?php if(!empty($producto->imagen)):?>
                    <img src="<?= base_url.'uploads/images/'.$producto->imagen?>" class="img-carrito">
                    <?php else:?>
                    <img src="<?= base_url?>assets/img/camiseta.png" class="img-carrito">
                    <?php endif;?>
                </td>
                <td>
                    <a href="<?=base_url?>producto/ver&id=<?=$producto->id?>">
                    <?= $producto->nombre ?>
                    </a>
                </td>
                <td><?= $producto->precio ?></td>
                <td><?= $producto->unidades ?></td>
            </tr>
        
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>    
                       
</div>

<?php  else: ?>

    <h1>Pedido no existe</h1>

<?php  endif; ?>