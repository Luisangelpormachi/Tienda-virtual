
<?php if(isset($gestion)): ?>
<h1>Gestión de pedidos</h1>

<?php else:?>
<h1>Mis pedidos</h1>

<?php endif;?>   

<div class="sub-main">
<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>NUMERO</th>
                <th>COSTE</th>
                <th>FECHA - HORA</th>

                <?php if(isset($gestion)): ?>
                    <th>ESTADO</th>
                <?php endif;?>  
            </tr>
        </thead>
        <tbody>
            <?php while($pedido = $pedidos->fetch_object()):?>
                <tr>      
                    <td>
                        <a href="<?=base_url?>pedido/detalle&id=<?=$pedido->id?>">
                        <?= $pedido->id ?>
                        </a>        
                    </td>             
                    <td><?= $pedido->coste ?></td>
                    <td><?= $pedido->fecha ?> | <?= $pedido->hora ?></td>

                    <?php if(isset($gestion)): ?>
                    <td><?= Utils::MostrarEstado($pedido->estado) ?></td>
                    <?php endif;?> 
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</div>

