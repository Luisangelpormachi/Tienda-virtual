
<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'confirm'):?>

<h1 id="confirmado">Tu pedido se ha confirmado</h1>

<div class="sub-main">    
    <p>
        Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria  a este numero de cuenta 
        ES6621000418401234567891 con el coste del 
        pedido, será procesado y enviado.
    </p>

    <br><hr><br>
    <h3>Dirección del envío</h3>
    Provincia:  <?= $pedido->provincia ?><br>
    Localidad:  <?= $pedido->localidad ?><br>
    Dirección:  <?= $pedido->direccion ?>

    <br><br>
    <h3>Datos del pedido</h3>
    Numero de pedido:  <?= $pedido->id ?><br>
    Total a pagar: S/.  <?= $pedido->coste ?><br>
    Productos: <br><br>

    <div class="table-wrapper">
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
<?php else: ?>

<h1>Tu pedido NO ha podido procesarse</h1>

<?php endif; ?>