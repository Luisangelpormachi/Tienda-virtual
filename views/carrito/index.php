

<h1>Listado de Carrito</h1>

<?php if(isset($_SESSION['carrito'])):?>
    <div class="sub-main">
    <?php foreach($_SESSION['carrito'] as $indice => $elemento):?>
        
        <?php if($elemento['limite'] == true):?>              
            <li>
                <a><?=$_SESSION['carrito'][$indice]['producto']->nombre?></a>  cantidad maxima <?=$_SESSION['carrito'][$indice]['producto']->stock?>
            </li>
        <?php endif;?>
    <?php endforeach; ?>
    </div> 
<?php endif;?>

<div class="sub-main">
<?php if(isset($carrito) && $carrito != null) :?>
    <table>
        <thead>
            <tr>
                <th>IMAGEN</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>CANTIDAD</th>
                <th>ELIMINAR</th>
            </tr>      
        </thead>
        <tbody>

            <?php 
                foreach($carrito as $indice => $elemento): 
                $producto = $elemento['producto'];
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
                <td><?= $elemento['precio']?></td>
                <td>
                    <?= $elemento['cantidad']?>
                    <div class="updown-cantidad">
                        <a class="up-cantidad" href="<?=base_url?>carrito/up&indice=<?=$indice?>">+</a>
                        <a class="down-cantidad" href="<?=base_url?>carrito/down&indice=<?=$indice?>">-</a>
                    </div>
                </td>
                <td>
                    <a href="<?=base_url?>carrito/delete&indice=<?=$indice?>" class="button alert alert-danger">Quitar</a>
                </td>
            </tr>
        
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php $stats = Utils::statsCarrito(); ?>

    <div class="total-carrito">
        <h3>Precio total: S/. <?= $stats['total']?></h3>
        <a href="<?=base_url?>pedido/index" class="button">Hacer pedido</a>
    </div>
    
    <div class="delete-carrito">
        <a href="<?=base_url?>carrito/delete_all" class="button button-red">Vaciar carrito</a>
    </div>

<?php else: ?>

    <p>Tu carrito esta vac??o</p>

<?php endif; ?>

</div>

<?php Utils::DeleteSession('limite_stock');?>