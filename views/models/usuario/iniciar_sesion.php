<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Iniciar Sesión</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
	
		<div class="contenedor-formulario">
			<h1>Iniciar Sesión</h1>
			<?php 
			if (isset($_SESSION["error_login"])): 
			?>
				<strong class="alerta alerta-roja"><?=$_SESSION["error_login"]?></strong>
			<?php 
			endif;
			?>
			<form action="<?=BASE_URL?>controllers/UsuarioControlador.php" method="POST">
				<label for="correo">Correo</label>
				<input type="email" name="correo"/>
				<label for="clave">Contraseña</label>
				<input type="password" name="clave"/>
				<button type="submit" name="opcion" value="2">Iniciar Sesión</button>
			</form>
		</div>
		
	</div>
	<?php Helper::borrarSesion("error_login"); ?>
</body>
</html>