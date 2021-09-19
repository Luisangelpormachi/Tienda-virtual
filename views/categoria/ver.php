<?php if(isset($categoria)) :?>

    <h1><?=$categoria->nombre?></h1>
    <?php if($productos->num_rows == 0):?>
        <p class="sub-main">No hay productos</p>
    <?php else:?>

        <?php while($pro = $productos->fetch_object()): ?>
        <div class="product">
        <a href="<?=base_url?>producto/ver&id=<?=$pro->id?>">
        
            <?php if(!empty($pro->imagen)):?>
            <img src="<?= base_url.'uploads/images/'.$pro->imagen?>">
            <?php else:?>
            <img src="<?= base_url?>assets/img/camiseta.png">
            <?php endif;?>

            <h2><?= $pro->nombre ?></h2>
            <p><?= $pro->precio ?></p>
                    
        </a>  
            <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
        </div>
        <?php endwhile; ?>

    <?php endif;?>

   

<?php else: ?>
    <h1>Sin categoria</h1>
<?php endif; ?>
