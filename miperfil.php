<?php session_start(); ?>

<?php include ("inc/bbdd.php"); ?>
<?php include ("inc/funciones.php"); ?>

<?php

    $titulo1 = "Mi perfil";
    $titulo2 = "Datos de mi perfil";

?>

<?php include("inc/header.php"); ?> 

<?php		

	if (!isset($_SESSION['user'])) {		
		
		header("Location: login.php");
	
	}

    $email = $_SESSION['user'];

    $usuario = seleccionar_usuario2 ($email);

?>

<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

        <table class="table">

            <thead>

                <tr>

                    <th scope="col">Email</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col"></th>
                    <th scope="col"></th>



                </tr>

            </thead>

            <tbody>

                <?php

                    foreach ($usuario as $usu) {		

                        $idUsuario = $usu['idUsuario'];
                        $email = $usu['email'];
                        $nombre = $usu['nombre'];
                        $apellidos = $usu['apellidos'];
                        $direccion = $usu['direccion'];
                        $telefono = $usu['telefono'];

                ?>

                    <tr>		

                        <td><?= $email ?></td>
                        <td><?= $nombre ?></td>
                        <td><?= $apellidos ?></td>
                        <td><?= $direccion ?></td>
                        <td><?= $telefono ?></td>

                        <td><a href="editarPerfil.php?idUsuario=<?=$idUsuario?>" class="btn btn-primary">Editar datos</a></td>
                        <td><a href="cambiarPassword.php?idUsuario=<?=$idUsuario?>" class="btn btn-primary">Cambiar contraseña</a></td>

                    </tr>

                <?php

                    }
                
                ?>
            
            </tbody>
        
        </table>

</section>

<?php include("inc/footer.php"); ?>