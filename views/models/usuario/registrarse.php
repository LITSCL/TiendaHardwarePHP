<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrarse</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
	
		<div class="contenedor-formulario">
			<h1>Registrarse</h1>
			<?php 
			if (isset($_SESSION["registro"]) && $_SESSION["registro"] == "Exitoso"): 
			?>
				<strong class="alerta alerta-verde">Registro exitoso</strong>
			<?php 
			endif;
			?>
			
			<?php 
			if (isset($_SESSION["registro"]) && $_SESSION["registro"] == "Fallido"):
			?>
				<strong class="alerta alerta-roja">Registro fallido</strong>
			<?php 
			endif;
			?>
			<form action="<?=BASE_URL?>controllers/UsuarioControlador.php" method="POST">
				<label for="correo">Correo</label>
				<input type="email" name="correo" required/>
				<label for="clave">Contraseña</label>
				<input type="password" name="clave" required/>
				<label for="primerNombre">Primer Nombre</label>
				<input type="text" name="primerNombre" required/>
				<label for="segundoNombre">Segundo Nombre</label>
				<input type="text" name="segundoNombre" required/>
				<label for="apellidoPaterno">Apellido Paterno</label>
				<input type="text" name="apellidoPaterno" required/>
				<label for="apellidoMaterno">Apellido Materno</label>
				<input type="text" name="apellidoMaterno" required/>
				<button type="submit" name="opcion" value="1">Registrarse</button>
			</form>
		</div>
		
	</div>
	<?php Helper::borrarSesion("registro"); ?>
</body>
</html>