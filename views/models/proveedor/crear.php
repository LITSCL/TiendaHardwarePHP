<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Crear Proveedor</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
	
		<div class="contenedor-formulario">		
			<h1>Crear Proveedor</h1>
			<?php 
			if (isset($_SESSION["crear_proveedor"]) && $_SESSION["crear_proveedor"] == "Exitoso"): 
			?>
				<strong class="alerta alerta-verde">Proveedor creado exitosamente</strong>
			<?php 
			endif;
			?>
			
			<?php 
			if (isset($_SESSION["crear_proveedor"]) && $_SESSION["crear_proveedor"] == "Fallido"):
			?>
				<strong class="alerta alerta-roja">Error al crear el Proveedor</strong>
			<?php 
			endif;
			?>
			<form action="<?=BASE_URL?>controllers/ProveedorControlador.php" method="POST">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required/>
				<label for="telefono">Telefono</label>
				<input type="text" name="telefono" required/>
				<label for="correo">Correo</label>
				<input type="email" name="correo" required/>
				<button type="submit" name="opcion" value="1">Crear</button>
			</form>
		</div>
		
	</div>
	<?php Helper::borrarSesion("crear_proveedor"); ?>
</body>
</html>