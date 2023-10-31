<?php session_start(); ?>

<?php include ('inc/funciones.php'); ?>
<?php include ('inc/bbdd.php'); ?>

<?php

    $titulo1 = "Cambiar contraseña";
    $titulo2 = "Introduce los datos";

?>

<?php include("inc/header.php"); ?>

<section class="py-5">

	<div class="container px-4 px-lg-5 mt-5">

		<?php 
		
			function mostrarFormulario ($idUsuario, $passwordOld, $passwordNew1, $passwordNew2) { ?>

                <form method="get">

                    <br>

                    <div class="mb-3 text-center">

                        <label for="idUsuario" class="form-label">ID Usuario</label>
                        <input type="text" class="form-control text-center" id="idUsuario" name="idUsuario" value="<?=$idUsuario ?>" readonly="readonly" />

                    </div>

                    <br>

                    <div class="mb-3 text-center">

                        <label for="passwordOld" class="form-label">Contraseña actual</label>
                        <input type="password" class="form-control text-center" id="passwordOld" name="passwordOld" value="<?=$passwordOld ?>" />

                    </div>

                    <br>

                    <div class="mb-3 text-center">

                        <label for="passwordNew1" class="form-label">Contraseña nueva</label>
                        <input type="password" class="form-control text-center" id="passwordNew1" name="passwordNew1" value="<?=$passwordNew1 ?>" />

                    </div>

                    <br>

                    <div class="mb-3 text-center">

                        <label for="passwordNew2" class="form-label">Vuelve a introducir la nueva contraseña</label>
                        <input type="password" class="form-control text-center" id="passwordNew2" name="passwordNew2" value="<?=$passwordNew2 ?>" />

                    </div>

                    <br><br>

                    <div class="mb-3 text-center">

                    <button type="submit" class="btn btn-outline-dark" name="btn-enviar">Actualizar datos</button>

                    </div>

                </form>

<?php } ?>

<?php

    if (!isset($_REQUEST['btn-enviar'])) {
		
        $idUsuario = recoge('idUsuario');
        $passwordOld = "";
        $passwordNew1 = "";
        $passwordNew2 = "";
		
        mostrarFormulario ($idUsuario, $passwordOld, $passwordNew1, $passwordNew2);
		
    } else {

        $errores = "";

        $idUsuario = recoge('idUsuario');
		$passwordOld = recoge('passwordOld');
        $passwordNew1 = recoge('passwordNew1');
        $passwordNew2 = recoge('passwordNew2');
    
        $email = $_SESSION['user'];
		$usuario = seleccionar_usuario($email);

        $passwordbbdd = $usuario ['password'];

        $verificada = password_verify($passwordOld, $passwordbbdd);

        if (!$verificada) {

            $errores.= "<li>La contraseña actual no es correcta</li>";

        }
   

        if ($idUsuario == "") {

            $errores.= "<li>Debes introducir el ID del usuario</li>";

        }

        if ($passwordOld == "") {

            $errores.= "<li>Debes introducir tu contraseña actual</li>";

        }

        if ($passwordNew1 == "") {

            $errores.= "<li>Debes introducir una contraseña nueva</li>";

        }

        if ($passwordNew2 == "") {

            $errores.= "<li>Debes introducir una contraseña nueva</li>";

        }

        if ($passwordNew1  != $passwordNew2) {

            $errores.= "<li>Las contraseñas no coinciden</li>";

        }

        if ($errores != "") {
			
			echo "<div class='alert alert-danger' role= 'alert'>";
			
				echo "<ul>$errores</ul>";
				echo "</hr>";
			
			echo "</div>";

            mostrarFormulario ($idUsuario, $passwordOld, $passwordNew1, $passwordNew2);
        
        } 
		
        else {

            $cambiada = cambiarPassword ($idUsuario, $passwordNew1);
			
			if ($cambiada) { 
			
?>	

				<div class="alert alert-success" role= "alert">
				
                    <h2 class="pagination justify-content-center">Datos actualizados correctamente</h2>
				
				</div>
							
<?php
	
			} else {
				
?>
			
				<div class="alert alert-danger" role= "alert">
				
                    <h2 class="pagination justify-content-center">No hemos podido actualizar los datos</h2>
					
				</div>
<?php
				
				mostrarFormulario ($idUsuario, $passwordOld, $passwordNew1, $passwordNew2);

                

			}

		}
		
	}

?>

</div>

</section>

<?php include("inc/footer.php"); ?>