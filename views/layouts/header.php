<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title> Tienda de camisetas </title>
        <link rel="stylesheet" href="<?= base_url ?>assets/css/style.css">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script defer src="https://kit.fontawesome.com/93ef79ad81.js" crossorigin="anonymous"></script>
        <script defer src="<?=base_url?>assets/js/index.js"></script>     
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

            <button class="nav-toggle">
                    <i class="fas fa-bars"></i>
            </button>

            <!-- MENU -->
            <nav class="navbar">
                <ul> 
                    <button class="nav-toggle">
                        <i class="fas fa-bars"></i>
                    </button> 

                    <li>
                        <a href="<?= base_url ?>">Inicio</a>
                    </li>

                    <?php 
                    $categorias = Utils::showCategorias();
                    while($categoria = $categorias->fetch_object()):?>
                    
                    <li>
                        <a href="<?= base_url.'categoria/ver&id='.$categoria->id."#main"?>"><?=$categoria->nombre?></a>
                    </li>

                    <?php endwhile; ?>
                </ul>
            </nav>

            <!-- CONTENT -->
            
            <div id="content">