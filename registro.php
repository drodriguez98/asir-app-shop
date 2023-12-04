<?php session_start(); ?>

<?php include ('inc/funciones.php'); ?>
<?php include ('inc/bbdd.php'); ?>

<?php

    $titulo1 = "Registro";
    $titulo2 = "Página de registro";

?>

<?php include("inc/header.php"); ?>

<div class="container px-4 px-lg-5 mt-5">

    <?php function mostrarFormulario ($email, $password, $password2, $nombre, $apellidos, $direccion, $telefono) { ?>

        <form method="get">

            <div class="mb-3 text-center">

            <label for="email" class="form-label"><strong>Email</strong></label>
            <input type="text" class="form-control text-center" id="email" name="email" value="<?=$email ?>"/>

            </div>
            
            <div class="mb-3 text-center">

            <label for="password" class="form-label"><strong>Contraseña</strong></label>
            <input type="password" class="form-control text-center" id="password" name="password" value="<?=$password ?>">

            </div>

            <div class="mb-3 text-center">

                <label for="password" class="form-label"><strong>Vuelve a introducir la contraseña</strong></label>
                <input type="password" class="form-control text-center" id="password2" name="password2" value="<?=$password2 ?>">

            </div>

            <div class="mb-3 text-center">

                <label for="nombre" class="form-label"><strong>Nombre</strong></label>
                <input type="text" class="form-control text-center" id="nombre" name="nombre" value="<?=$nombre ?>">

            </div>

            <div class="mb-3 text-center">

                <label for="apellidos" class="form-label"><strong>Apellidos </strong></label>
                <input type="text" class="form-control text-center" id="apellidos" name="apellidos" value="<?=$apellidos ?>">

            </div>

            <div class="mb-3 text-center">

                <label for="direccion" class="form-label"><strong>Dirección</strong></label>
                <input type="text" class="form-control text-center" id="direccion" name="direccion" value="<?=$direccion ?>">

            </div>

            <div class="mb-3 text-center">

                <label for="telefono" class="form-label"><strong>Teléfono</strong></label>
                <input type="text" class="form-control text-center" id="telefono" name="telefono" value="<?=$telefono ?>">

            </div>

            <ul class="mb-3 pagination justify-content-center">

                <button type="submit" class="btn btn-primary" name="btn-enviar">Enviar</button>

            </ul>

        </form>

    <?php } ?>


<!--	Recogida de datos	-->

<?php

    if (!isset($_REQUEST['btn-enviar'])) {
		
		$email = "";	
		$password = "";
        $password2 = "";
        $nombre = "";
        $apellidos = "";
        $direccion = "";
        $telefono = "";
		
        mostrarFormulario ($email, $password, $password2, $nombre, $apellidos, $direccion, $telefono);
	
	} else {		

		$email = recoge('email');	
		$password = recoge('password');
        $password2 = recoge('password2');
        $nombre = recoge('nombre');
        $apellidos = recoge('apellidos');
        $direccion = recoge('direccion');
        $telefono = recoge('telefono');

		$errores = "";	

		if ($email == "") {
	
			$errores.= "<li>Debes introducir un email</li>";
	
		}

        if ($nombre == "") {
	
			$errores.= "<li>Debes introducir tu nombre</li>";
	
		}

        if ($apellidos == "") {
	
			$errores.= "<li>Debes introducir tus apellidos</li>";
	
		} 

        if ($direccion == "") {
	
			$errores.= "<li>Debes introducir una dirección</li>";
	
		} 

        if ($telefono == "") {
	
			$errores.= "<li>Debes introducir un teléfono de contacto</li>";
	
		} 
        
        
        else {

			$repetido = seleccionar_email ($email);

			if ($repetido) {

				$errores.= "<li>Ya existe un usuario con ese email</li>";
			}
		}
	
		if ($password == "" or $password2 == "")  {
	
			$errores.= "<li>Debes introducir la contraseña dos veces</li>";
	
		}

        if ($password != $password2)  {
	
			$errores.= "<li>Las contraseñas no coinciden</li>";
	
		}

		if ($errores != "") {		
			
			echo "<div class='alert alert-danger' role='alert'>";
			
				echo "<ul>$errores</ul>";
				echo "</hr>";
			
			echo "</div>";

			mostrarFormulario ($email, $password, $password2, $nombre, $apellidos, $direccion, $telefono);
        
        } 

		else {				

			$registro = registro ($email, $password, $nombre, $apellidos, $direccion, $telefono);

			if ($registro == 0) {	

				echo "<p>No se ha podido realizar la operación</p>";

			} else {	

				$_SESSION['user'] = $usuario;

				header("Location: index.php");

			}

		}

	}

?>

</div>

</section>

</body>

</html>

<?php include("inc/footer.php"); ?>