<?php if(isset($pro)) :?>
    <h1><?=$pro->nombre?></h1>
    <div class="detail-product">
        <div class="imagen">
            <?php if(!empty($pro->imagen)):?>
            <img src="<?= base_url.'uploads/images/'.$pro->imagen?>"  class="center">
            <?php else:?>
            <img src="<?= base_url?>assets/img/camiseta.png" class="center">
            <?php endif;?>
        </div>
        <div class="data">
            <h2><?= $pro->descripcion ?></h2>
            <p>S/. <?= $pro->precio ?></p>
            <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
        </div>
    </div>    
<?php else: ?>
        <h1>El producto no existe</h1>
<?php endif; ?>