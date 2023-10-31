<?php session_start() ?>

<?php include ("inc/bbdd.php"); ?>
<?php include ("inc/funciones.php"); ?>

<?php

    $titulo1 = "Procesar pedido";
    $titulo2 = "Últimos pasos";

?>

<?php include ("inc/header.php"); ?>

<?php 

    if (!isset($_SESSION['carrito'])) {

        header("Location:index.php");
        exit;

    } 

    if (!isset($_SESSION['user'])) { ?>

        <h2 class="pagination justify-content-center">Tienes que iniciar sesión para confirmar la compra</h2>
<?php   
        header("Location:login.php");
        exit;

    } 

        $email = $_SESSION['user'];
        $carrito = $_SESSION['carrito'];
        $total = $_SESSION['total'];

        $usuario = seleccionar_usuario($email);

        $idUsuario = $usuario['idUsuario'];

        $idPedido = insertarPedido($idUsuario, $carrito, $total);

        if ($idPedido) { ?>

            <br><br><br>
            <h2 class="pagination justify-content-center">Tu pedido <?=$idPedido?> ha sido procesado correctamente.</h2>

<?php
    

            unset($_SESSION['carrito']);
            unset($_SESSION['total']);

        } else { ?>

            <br><br><br>
            <h2 class="pagination justify-content-center">Tu pedido <?=$idPedido?> no ha sido procesado. Vuelve a intentarlo.</h2>

<?php

        }

?>  

<?php include ("inc/footer.php"); ?>