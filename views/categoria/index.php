<h1>Listado de Categorias</h1>

<?php $limit = $limit->fetch_object();?>      

<div id="categorias" class="sub-main">
    <a href="<?= base_url ?>categoria/create?#categoria" class="button button-function">Crear categoria</a>
    <div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>NOMBRE</th>
            </tr>
        </thead>
        <tbody>           
            <?php 
            $enumeracion = 1;
            while($categoria = $categorias->fetch_object()):?>           
                <?php if(isset($_SESSION['success-crearCategoria']) && $categoria->id == $limit->id): ?>               
                <tr>
                    <td class="success-crearCategoria" title="Último agregado"><?=$categoria->id?></td>
                    <td class="success-crearCategoria" title="Último agregado"><?=$categoria->nombre?></td>
                </tr>
                <?php else: ?>
                <tr>
                    <td><?=$enumeracion++?></td>
                    <td><?=$categoria->nombre?></td>
                </tr>
                <?php endif; ?>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>
</div>

<?php Utils::DeleteSession('success-crearCategoria'); ?>





