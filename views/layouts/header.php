<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title> Tienda de camisetas </title>
        <link rel="stylesheet" href="<?= base_url ?>assets/css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="container">
            <!-- HEAD -->

            <header id="header">  
                <div id="logo">
                    <a href="<?= base_url ?>" class="cont-img">
                        <img src="<?= base_url ?>assets/img/camiseta.png" alt="camiseta logo">
                    </a>
                    <a href="<?= base_url ?>">TIENDA DE CAMISETAS</a>
                </div>
            </header>

            <!-- MENU -->

            <nav id="navbar">
                <ul>
                    <li>
                        <a href="<?= base_url ?>">Inicio</a>
                    </li>

                    <?php 
                    $categorias = Utils::showCategorias();
                    while($categoria = $categorias->fetch_object()):?>
                    
                    <li>
                        <a href="<?= base_url.'categoria/ver&id='.$categoria->id?>"><?=$categoria->nombre?></a>
                    </li>

                    <?php endwhile; ?>
                </ul>
                
            </nav>

            <!-- CONTENT -->
            
            <div id="content">