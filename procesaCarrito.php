<?php session_start() ?>

<?php include ("inc/funciones.php"); ?>

<?php 

    $idProducto = recoge ('idProducto');
    $operacion = recoge ('operacion');

    switch ($operacion) {

        case "add":

            if (isset($_SESSION['carrito'][$idProducto])) {

                $_SESSION['carrito'][$idProducto]++;

            } else {

                $_SESSION['carrito'][$idProducto] = 1;

            }
        
            break; 

        case "remove":

            if (isset($_SESSION['carrito'][$idProducto])) {

                $_SESSION['carrito'][$idProducto]--;

                if ($_SESSION['carrito'][$idProducto] <= 0) {

                    unset($_SESSION['carrito'][$idProducto]);

                }

            }
        
            break; 

        case "empty":

            unset($_SESSION['carrito']);
            break;

        default: 

            header("Location: index.php");
            exit;   

    }

header("Location: carrito.php");
exit;