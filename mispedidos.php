<?php session_start(); ?>

<?php include ("inc/bbdd.php"); ?>
<?php include ("inc/funciones.php"); ?>

<?php

    $titulo1 = "Mis pedidos";
    $titulo2 = "Historial de pedidos";

?>

<?php include("inc/header.php"); ?> 

<?php		

	if (!isset($_SESSION['user'])) {		
		
		header("Location: login.php");
	
	}

    $email = $_SESSION['user'];
	
	$pagina = recoge('pagina');		

	if ($pagina == "") {

		$pagina = 1;
		
	} 

	$inicio = ($pagina - 1) * NUMELEMENTOS;	

    $usuario = seleccionar_usuario($email);

    $idUsuario = $usuario['idUsuario'];

	$pedidos = paginacion_pedidos ($inicio, NUMELEMENTOS, $idUsuario);

?>

<!--    Contenedor de la sección     -->

<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

        <table class="table">

            <thead>

                <tr>

                    <th scope="col">ID Pedido</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>

                </tr>

            </thead>

            <tbody>

                <?php

                    foreach ($pedidos as $pedido) {		

                        $idPedido = $pedido['idPedido'];
                        $fecha = $pedido['fecha'];
                        $estado = $pedido['estado'];
                        $total = $pedido['total'];

                ?>

                    <tr>		

                        <th scope="row"><?= $idPedido ?></th>
                        <td><?= $fecha ?></td>
                        <td><?= $estado ?></td>
                        <td><?= $total ?> €</td>
                        <td><a href="detallespedido.php?idPedido=<?=$idPedido?>" class="btn btn-primary">Ver detalles</a></td>

                    </tr>

                <?php

                    }
                
                ?>
            
            </tbody>
        
        </table>

                

</section>

<?php include("inc/footer.php"); ?>