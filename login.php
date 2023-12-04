<?php session_start(); ?>

<?php include('inc/funciones.php'); ?>
<?php include('inc/bbdd.php'); ?>

<?php

$titulo1 = "Login";
$titulo2 = "Iniciar sesión";

?>

<?php include("inc/header.php"); ?>

<section class="py-5">

	<div class="container px-4 px-lg-5 mt-5">

		<?php

		function mostrarFormulario($email, $password)
		{ ?>

			<form method="get" class="form-center">

			<div class="mb-3 text-center">

				<label for="usuario" class="form-label"><strong>Introduce tu email</strong></label>
				<input type="text" class="form-control text-center" id="email" name="email" value="<?= $email ?>"/>

				</div>
		
				<div class="mb-3 text-center">

				<label for="password" class="form-label"><strong>Introduce tu contraseña</strong></label>
				<input type="password" class="form-control text-center" id="password" name="password" value="<?= $password ?>">

				<br>

				<button type="submit" class="btn btn-primary" name="btn-enviar">Enviar</button>

				<a href="registro.php" class="btn btn-success">No tengo una cuenta</a>

			</form>

	<?php

		}

		if (!isset($_REQUEST['btn-enviar'])) {

			$email = "";
			$password = "";

			mostrarFormulario($email, $password);

		} else {

			$email = recoge('email');
			$password = recoge('password');

			$errores = "";

			if ($email == "") {

				$errores .= "<li>Debes introducir un email</li>";

			}

			if ($password == "") {

				$errores .= "<li>Debes introducir una contraseña</li>";

			}

			if ($errores != "") {

				echo "<div class='alert alert-danger' role='alert'>";

				echo "<ul>$errores</ul>";
				echo "</hr>";

				echo "</div>";

				mostrarFormulario($email, $password);

			} else {

				$login = login($email, $password);

				if ($login == 0) {

					echo "<h2 class='pagination justify-content-center'>Usuario y/o password incorrectos</p>";

				} else {

					$_SESSION['user'] = $email;

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