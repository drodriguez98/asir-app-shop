<?php session_start(); ?>

<?php include("inc/bbdd.php"); ?>
<?php include("inc/funciones.php"); ?>

<?php

$titulo1 = "Nosotros";
$titulo2 = "¿Quiénes somos?";

?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title><?= $titulo1; ?></title>

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

        <!-- Bootstrap and CSS -->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />

    </head>

    <body class="d-flex flex-column min-vh-100">

        <!--    Nav    -->

        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <div class="container px-4 px-lg-5">

                <a class="navbar-brand" href="index.php">Mi Grupito</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="productos.php">Productos</a></li>
                        <li class="nav-item"><a class="nav-link" href="nosotros.php">Nosotros</a></li>

                    </ul>

                    <?php

                    if (isset($_SESSION['user'])) { ?>    

                                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                                <li class="nav-item"> <a href="miPerfil.php" class="nav-link"><?php echo $_SESSION['user']; ?></a></li>

                                </ul>          

                                <div class="text-end">

                                    <a href="misPedidos.php" class="btn btn-light">Mis pedidos</a>

                                </div>

                                <a href="carrito.php" class="btn btn-outline-dark">

                                    <i class="bi-cart-fill me-1"></i>Carrito<span class="badge bg-dark text-white ms-1 rounded-pill">0</span>

                                </a>

                                <div class="text-end">
        
                                    <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>

                                </div>

                    <?php } else { ?>

                                <form class="d-flex">

                                    <a href="carrito.php" class="btn btn-outline-dark">

                                        <i class="bi-cart-fill me-1"></i>Carrito<span class="badge bg-dark text-white ms-1 rounded-pill">0</span>

                                    </a>

                                </form>

                                <div class="text-end">

                                    <a href="login.php" class="btn btn-light">Iniciar sesión</a>

                                </div>

                        <?php } ?>
                    

                </div>

            </div>

        </nav>

        <header class="bg-dark py-5">

            <div class="container px-4 px-lg-5 my-5">

                <div class="text-center text-white">

                    <h1 class="display-4 fw-bolder">¿Quiénes somos?</h1>
                    
                    <p class="lead fw-normal text-white-50 mb-0"><br>Mi Grupito es una asociación de la zona del Morrazo cuyo objetivo es fomentar el comercio local a través de una plataforma online que facilite la compra-venta de los productos. </p>

                </div>

            </div>

        </header>

        <?php include("inc/footer.php"); ?>