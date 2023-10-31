<?php session_start(); ?>

<?php include ('inc/funciones.php'); ?>
<?php include ('inc/bbdd.php'); ?>

<?php

    $titulo1 = "Editar perfil";
    $titulo2 = "Introduce los nuevos datos";

?>

<?php include("inc/header.php"); ?>

<section class="py-5">

	<div class="container px-4 px-lg-5 mt-5">

		<?php 
		
			function mostrarFormulario ($idUsuario, $email, $nombre, $apellidos, $direccion, $telefono) { ?>

				<form method="get" class="form-center">

                    <br>

                    <div class="mb-3 text-center">

                        <label for="idUsuario" class="form-label"><strong>ID Usuario</label></strong>
                        <input type="text" class="form-control text-center" id="idUsuario" name="idUsuario" value="<?=$idUsuario ?>" readonly="readonly" />

                    </div>

                    <br>

					<div class="mb-3 text-center">

					<label for="usuario" class="form-label"><strong>Introduce tu email</strong></label>
					<input type="text" class="form-control text-center" id="email" name="email" value="<?=$email ?>"/>

					</div>
					
                    <br>

                    <div class="mb-3 text-center">

                        <label for="nombre" class="form-label"><strong>Introduce tu nombre</strong></label>
                        <input type="text" class="form-control text-center" id="nombre" name="nombre" value="<?=$nombre ?>"/>

                    </div>

                    <br>

					<div class="mb-3 text-center">

					<label for="apellidos" class="form-label"><strong>Introduce tus apellidos</strong></label>
					<input type="text" class="form-control text-center" id="apellidos" name="apellidos" value="<?=$apellidos ?>"/>

					</div>

                    <br>

					<div class="mb-3 text-center">

					<label for="direccion" class="form-label"><strong>Introduce tu direccion</strong></label>
					<input type="text" class="form-control text-center" id="direccion" name="direccion" value="<?=$direccion ?>"/>

					</div>

                    <br>

					<div class="mb-3 text-center">

					<label for="telefono" class="form-label"><strong>Introduce tu telefono</strong></label>
					<input type="text" class="form-control text-center" id="telefono" name="telefono" value="<?=$telefono ?>"/>

					</div>

                    <br>

                    <ul class="pagination justify-content-center">

					    <button type="submit" class="btn btn-primary" name="btn-enviar">Enviar</button>

                    </ul>

				</form>

<?php } ?>

<?php

    if (!isset($_REQUEST['btn-enviar'])) {
		
		$idUsuario = recoge('idUsuario');
		
		if ($idUsuario == "") {
			
			header('Location: index.php');
			exit;
		
		}
		
        $email = $_SESSION['user'];
		$usuario = seleccionar_usuario($email);
		
        $email = $usuario ['email'];
        $nombre = $usuario ['nombre'];
        $apellidos = $usuario ['apellidos'];
        $direccion = $usuario ['direccion'];
        $telefono = $usuario ['telefono'];

        mostrarFormulario ($idUsuario, $email, $nombre, $apellidos, $direccion, $telefono);
		
    } else {
		
		$idUsuario = recoge('idUsuario');
        $email = recoge('email');
        $nombre = recoge('nombre');
        $apellidos = recoge('apellidos');
        $direccion = recoge('direccion');
        $telefono = recoge('telefono');

        $errores = "";

        if ($idUsuario == "") {

            $errores.= "<li>Debes introducir el ID del usuario</li>";

        }

        if ($nombre == "") {

            $errores.= "<li>Debes introducir tu nombre</li>";

        }

        if ($apellidos == "") {

            $errores.= "<li>Debes introducir tus apellidos</li>";

        }

        if ($direccion == "") {

            $errores.= "<li>Debes introducir tu dirección</li>";

        }

        if ($telefono == "") {

            $errores.= "<li>Debes introducir un número de teléfono</li>";

        }

		
        if ($errores != "") {
			
			echo "<div class='alert alert-danger' role= 'alert'>";
			
				echo "<ul>$errores</ul>";
				echo "</hr>";
			
			echo "</div>";

            mostrarFormulario ($idUsuario, $email, $nombre, $apellidos, $direccion, $telefono);
        
        } 
		
        else {

            $editado = editar_usuario ($idUsuario, $email, $nombre, $apellidos, $direccion, $telefono);
			
			if ($editado) { 
			
?>	

				<div class="alert alert-success text-center" role= "alert">
				
					<h2>Datos actualizados correctamente</h2>
				
				</div>
							
<?php
	
			} else {
				
?>
			
				<div class="alert alert-danger text-center" role= "alert">
				
					<p>No hemos podido actualizar los datos</p>
					
				</div>
<?php
				
				mostrarFormulario ($idUsuario, $email, $nombre, $apellidos, $direccion, $telefono);

			}

		}
		
	}

?>

</div>

	</div>

</section>

</body>

</html>

<?php include("inc/footer.php"); ?>