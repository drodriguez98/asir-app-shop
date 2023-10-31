<?php session_start(); ?>
 
<?php include ("inc/bbdd.php"); ?>
<?php include ("inc/funciones.php"); ?>

<?php

    $idPedido= recoge('idPedido');

    $titulo1 = "Detalles del pedido nº $idPedido";
    $titulo2 = "Detalles del pedido nº $idPedido";

    if (!isset($_SESSION['user'])) {		
		
        header("Location: login.php");

    }

    $email = $_SESSION['user'];

    if ($idPedido == "") {
			
        header('Location: index.php');
        exit;
    
    }
		
?>

<?php include("inc/header.php"); ?>

<!--    Contenedor de la sección     -->

<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <!-- Tabla Pedido -->

            <table class="table"  border="1">

                <thead>

                    <tr>

                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                        $pedido = seleccionar_pedido ($idPedido);

                        foreach ($pedido as $ped) {		

                            $fecha = $ped['fecha'];
                            $estado = $ped['estado'];
                            $total = $ped['total'];

                    ?>

                        <tr>		

                            <th scope="row"><?= $fecha ?></th>
                            <td><?= $estado ?></td>

                        </tr>

                    <?php

                        }
                    
                    ?>

                </tbody>

            </table>


            <!-- Tabla usuario -->
            
            <br><br><br>

            <table class="table"  border="1">

                <thead>

                    <tr>

                        <th scope="col">Email</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Teléfono</th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                        
                        $usuario = seleccionar_usuario2 ($email);
                        
                        foreach ($usuario as $usu) {		

                            $email = $usu['email'];
                            $nombre = $usu['nombre'];
                            $apellidos = $usu['apellidos'];
                            $direccion = $usu['direccion'];
                            $telefono = $usu['telefono'];

                    ?>

                        <tr>		

                            <th scope="row"><?= $email ?></th>
                            <td><?= $nombre ?></td>
                            <td><?= $apellidos ?></td>
                            <td><?= $direccion ?></td>
                            <td><?= $telefono ?></td>

                        </tr>

                    <?php

                        }
                    
                    ?>

                </tbody>

            </table>

            <!-- Tabla detalles-pedido  -->

            <br><br><br>

            <table class="table" border="1">

                <thead>

                    <tr>

                        <th scope="col">ID Producto</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                        
                        $detalles_ped = seleccionar_detalles_pedido ($idPedido);
                        
                        foreach ($detalles_ped as $detalle) {		

                            $idProducto = $detalle['idProducto'];
                            $nombre = $detalle['nombre'];
                            $cantidad = $detalle['cantidad'];
                            $precio = $detalle['precioOferta'];

                    ?>

                        <tr>		

                            <th scope="row"><?= $idProducto ?></th>
                            <td><?= $nombre ?></td>
                            <td><?= $cantidad ?></td>
                            <td><?= $precio ?></td>

                        </tr>


                    <?php

                        }
                    
                    ?>

                        <th colspan=3><td><strong><?php echo $total;?> €</strong></td></th>

                </tbody>

            </table>

</section>