<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Crear Categoría</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
	
		<div class="contenedor-formulario">
			<h1>Crear Categoría</h1>
			<?php 
			if (isset($_SESSION["crear_categoria"]) && $_SESSION["crear_categoria"] == "Exitoso"): 
			?>
				<strong class="alerta alerta-verde">Categoría creada exitosamente</strong>
			<?php 
			endif;
			?>
			
			<?php 
			if (isset($_SESSION["crear_categoria"]) && $_SESSION["crear_categoria"] == "Fallido"):
			?>
				<strong class="alerta alerta-roja">Error al crear la categoría</strong>
			<?php 
			endif;
			?>
			<form action="<?=BASE_URL?>controllers/CategoriaControlador.php" method="POST">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required/>
				<button type="submit" name="opcion" value="1">Crear</button>
			</form>
		</div>
		
	</div>
	<?php Helper::borrarSesion("crear_categoria"); ?>
</body>
</html>