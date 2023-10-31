<?php session_start(); ?>

<?php include ('inc/bbdd.php'); ?>

<?php

    $titulo1 = "Logout";
    $titulo2 = "Sesión finalizada";

?>

<?php 
    
    unset($_SESSION['user']);

    unset($_SESSION['carrito']);

?>

<?php include ('inc/header.php'); ?>