<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title> Tienda de camisetas </title>
        <link rel="stylesheet" href="assets/css/style.css"> 
    </head>
    <body>
        <div id="container">
            <!-- HEAD -->

            <header id="header">  
                <div id="logo">
                    <img src="assets/img/camiseta.png" alt="camiseta logo">
                    <a href="index.php">TIENDA DE CAMISETAS</a>
                </div>
            </header>

            <!-- MENU -->

            <nav id="navbar">
                <ul>
                    <li>
                        <a href="index.php">Inicio</a>
                    </li>
                    <li>
                        <a href="index.php">categoria 1</a>
                    </li>
                    <li>
                        <a href="index.php">categoria 2</a>
                    </li>
                    <li>
                        <a href="index.php">categoria 3</a>
                    </li>
                    <li>
                        <a href="index.php">categoria 4</a>
                    </li>
                    <li>
                        <a href="index.php">categoria 5</a>
                    </li>
                </ul>
                
            </nav>

            <!-- CONTENT -->
            
            <div id="content">

                <!-- SIDEBAR  -->
                <aside id="sidebar">
                    <div id="login" class="block-aside">
                        <h3>Entrar a la web</h3>
                        <form action="" method="POST">
                            <label for="email">Email:</label>
                            <input type="email" name="email">
                            <label for="password">Password:</label>
                            <input type="password" name="password">  
                            <input type="submit" value="Entrar">
                        </form>
                    </div>
                    <ul>
                        <li><a href="">Mis pedidos</a></li>
                        <li><a href="">Gestionar categorias</a></li>
                        <li><a href="">Gestionar productos</a></li>
                    </ul>
                </aside>

                <!-- MAIN  -->
                <div id="main">
                        <h1>Productos Destacados</h1>
                        <div class="product">
                            <img src="assets/img/camiseta.png">
                            <h2>Camiseta celeste</h2>
                            <p>280 Soles</p>
                            <a href="" class="button">Comprar</a>
                        </div>
                        <div class="product">
                            <img src="assets/img/camiseta.png">
                            <h2>Camiseta celeste</h2>
                            <p>280 Soles</p>
                            <a href="" class="button">Comprar</a>
                        </div>
                        <div class="product">
                            <img src="assets/img/camiseta.png">
                            <h2>Camiseta celeste</h2>
                            <p>280 Soles</p>
                            <a href="" class="button">Comprar</a>                    
                        </div>
                                              
                </div>

            </div>

            <footer id="footer">
                <p>
                    Desarrollado por Luis Ángel Pormachi Quichca &copy; <?= date('Y') ?>
                </p>
            </footer>
        </div>

    </body>
</html>