<?php session_start(); ?>

<?php include ("inc/bbdd.php"); ?>
<?php include ("inc/funciones.php"); ?>

<?php

    $titulo1 = "Catálogo de productos";
    $titulo2 = "Todos nuestros productos";

?>

<?php include("inc/header.php"); ?> 

<?php		

	$pagina = recoge('pagina');		

	if ($pagina == "") {

		$pagina = 1;
		
	} 

	$inicio = ($pagina - 1) * NUMELEMENTOS;	

	$productos = paginacion_productos ($inicio, NUMELEMENTOS);

?>


<!--    Contenedor de la sección     -->

<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

<?php

    foreach ($productos as $producto) {		

    $idProducto = $producto['idProducto'];
    $nombre = $producto['nombre'];
    $introDescripcion = $producto['introDescripcion'];
    $descripcion = $producto['descripcion'];
    $imagenP = $producto['imagenP'];
    $imagenG = $producto['imagenG'];
    $precio = $producto['precio'];
    $precioOferta = $producto['precioOferta'];
    $estado = $producto['estado'];

?>
            <!-- Product section-->

                <div class="col mb-5">

                    <div class="card h-100">

                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Oferta</div>

                        <img class="card-img-top" src="img/<?= $imagenP ?>" alt="..." />

                        <div class="card-body p-4">

                            <div class="text-center">

                                <h5 class="fw-bolder"><?= $nombre ?></h5>

                                <span class="text-muted text-decoration-line-through"><?= $precio ?> €</span>

                                <?= $precioOferta ?> €

                            </div>

                        </div>

                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">

                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="producto.php?idProducto=<?=$idProducto ?>">Ver más</a></div>

                        </div>

                    </div>

                </div>
    
<?php } ?>

            </div>

        </div>

    </section>

    <!--		Menú de paginación		-->

    <nav aria-label="Page navigation example">	

        <ul class="pagination justify-content-center">

            <?php		

                $num_paginas = num_paginas_productos(NUMELEMENTOS);

            ?>

            <li class="page-item" <?php if ($pagina == 1) {print "disabled"; }?>> <a class="page-link" href="productos.php?pagina=<?=$pagina - 1; ?>">Anterior</a></li>

            <?php

                for ($i = 1; $i <= $num_paginas; $i++) {
                
            ?>

                    <li class="page-item"><a class="page-link" href="productos.php?pagina=<?=$i?>"><?php echo $i?></a></li>
                
            <?php } ?>

            <li class="page-item" <?php if ($pagina >= $num_paginas) {print "disabled"; }?>><a class="page-link" href="productos.php?pagina=<?=$pagina + 1; ?>">Siguiente</a></li>

        </ul>

    </nav> 

<?php include("inc/footer.php"); ?>