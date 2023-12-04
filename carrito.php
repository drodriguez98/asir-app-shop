<?php session_start(); ?>

<?php include("inc/bbdd.php"); ?>
<?php include("inc/funciones.php"); ?>

<?php

$titulo1 = "Carrito";
$titulo2 = "Tu carrito de la compra";

?>

<?php include("inc/header.php"); ?>

<?php

if (isset($_SESSION['carrito'])) {

    $carrito = $_SESSION['carrito'];

} else {

    $carrito = "";

}

?>

<?php

if (empty($carrito)) { ?>

                        <br><br><br>
                        <h2 class="pagination justify-content-center">No hay productos</h2>

            <?php

} else {

    ?>

                    <!--    Contenedor de la sección     -->

                    <section class="py-5">

                        <div class="container px-4 px-lg-5 mt-5">

                            <table class="table">

                                <thead>

                                    <tr>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Total</th>
                                    </tr>

                                </thead>

                                <tbody>
                
                                <?php

                                $total = 0;


                                foreach ($carrito as $idProducto => $cantidad) {

                                    $producto = seleccionar_producto($idProducto);
                                    $nombre = $producto['nombre'];
                                    $precio = $producto['precioOferta'];
                                    $subtotal = $precio * $cantidad;
                                    $total += $subtotal;

                                    ?>    
                                                    <tr>
                                                        <th scope="row"><?= $nombre ?></th>
                                                        <td><a class="text-decoration-none" href="procesaCarrito.php?idProducto=<?= $idProducto ?>&operacion=remove">-</a> <?= $cantidad ?> <a class="text-decoration-none" href="procesaCarrito.php?idProducto=<?= $idProducto ?>&operacion=add">+</a></td>
                                                        <td><?= $precio ?>€</td>
                                                        <td><?= $subtotal ?>€</td>
                                                    </tr>

                                            <?php

                                }

                                ?>
 
                                <?php

                                $_SESSION['total'] = $total;

                                ?>

                                    <tr>
                                        <th colspan="3">Total</th>
                                        <td><?= $total ?>€</td>

                                    </tr>

                                </tbody>

                            </table>

                            <a href="procesaCarrito.php?operacion=empty" class="btn btn-danger">Vaciar carrito</a>
                            <a href="procesaPedido.php" class="btn btn-success">Pagar</a>

                        </div>

                    </section>

<?php } ?>

<?php include("inc/footer.php"); ?>
