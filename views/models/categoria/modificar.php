<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Modificar Categoría</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<?php $categoria = $categoria->fetch_object(); ?>
	
	<div class="contenido">
	
		<div class="contenedor-formulario">
			<h1>Modificar Categoría</h1>
			<?php 
			if (isset($_SESSION["modificar_categoria"]) && $_SESSION["modificar_categoria"] == "Exitoso"): 
			?>
				<strong class="alerta alerta-verde">Categoría modificada exitosamente</strong>
			<?php 
			endif;
			?>
			
			<?php 
			if (isset($_SESSION["modificar_categoria"]) && $_SESSION["modificar_categoria"] == "Fallido"):
			?>
				<strong class="alerta alerta-roja">Error al modificar la categoría</strong>
			<?php 
			endif;
			?>
			<form action="<?=BASE_URL?>controllers/CategoriaControlador.php" method="POST">
				<input type="hidden" name="id" value="<?=$categoria->id?>" readonly/>
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" value="<?=$categoria->nombre?>" required/>
				<button type="submit" name="opcion" value="2">Modificar</button>
			</form>
		</div>
		
	</div>
	<?php Helper::borrarSesion("modificar_categoria"); ?>
</body>
</html>