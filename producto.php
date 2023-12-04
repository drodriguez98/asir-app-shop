<?php session_start(); ?>

<?php include("inc/bbdd.php"); ?>
<?php include("inc/funciones.php"); ?>

<?php

$idProducto = recoge('idProducto');

if ($idProducto == "") {

    header('Location: index.php');
    exit;

}

$producto = seleccionar_producto($idProducto);

if (empty($producto)) {

    header('Location: index.php');
    exit;

}

$nombre = $producto['nombre'];
$descripcion = $producto['descripcion'];
$imagenG = $producto['imagenG'];
$precio = $producto['precio'];
$precioOferta = $producto['precioOferta'];

?>

<?php

$numProductos = 0;

if (!empty($_SESSION['carrito'])) {

    $cantidades = $_SESSION['carrito'];

    foreach ($cantidades as $cantidad) {

        $numProductos = $numProductos + $cantidad;

    }

}

?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title><?= $nombre; ?></title>

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

        <!-- Bootstrap and CSS -->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />

    </head>

    <body class="d-flex flex-column min-vh-100">

        <!--    Nav    -->

        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <div class="container px-4 px-lg-5">

                <a class="navbar-brand" href="#!">Mi Grupito</a>

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

                                    <i class="bi-cart-fill me-1"></i>Carrito<span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo $numProductos; ?></span>

                                </a>

                                <div class="text-end">

                                    <a href="logout.php" class="btn btn-outline-dark">Cerrar sesión</a>

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

        <!-- Product section-->

        <section class="py-5">

            <div class="container px-4 px-lg-5 my-5">

                <div class="row gx-4 gx-lg-5 align-items-center">

                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="img/<?= $imagenG ?>" alt="..." /></div>

                    <div class="col-md-6">

                        <h1 class="display-5 fw-bolder"><?= $nombre ?></h1>

                        <div class="fs-5 mb-5">

                            <span class="text-decoration-line-through"><?= $precio ?></span>

                            <span><?= $precioOferta ?></span>

                        </div>

                        <p class="lead"><?= $descripcion ?></p>
                        
                        <div class="d-flex">

                            <a href="procesaCarrito.php?idProducto=<?= $idProducto ?>&operacion=add" class="btn btn-outline-dark flex-shrink-0">  

                                <i class="bi-cart-fill me-1"></i>

                                Añadir al carrito

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </section>

<?php include("inc/footer.php"); ?>