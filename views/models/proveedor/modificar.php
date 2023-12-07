<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Modificar Proveedor</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<?php $proveedor = $proveedor->fetch_object(); ?>
	
	<div class="contenido">
	
		<div class="contenedor-formulario">
			<form action="<?=BASE_URL?>controllers/ProveedorControlador.php" method="POST">
				<h1>Crear Proveedor</h1>
				<?php 
				if (isset($_SESSION["modificar_proveedor"]) && $_SESSION["modificar_proveedor"] == "Exitoso"): 
				?>
					<strong class="alerta alerta-verde">Proveedor creado exitosamente</strong>
				<?php 
				endif;
				?>
				
				<?php 
				if (isset($_SESSION["modificar_proveedor"]) && $_SESSION["modificar_proveedor"] == "Fallido"):
				?>
					<strong class="alerta alerta-roja">Error al crear el Proveedor</strong>
				<?php 
				endif;
				?>
				<input type="hidden" name="id" value="<?=$proveedor->id?>" readonly/>
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" value="<?=$proveedor->nombre?>" required/>
				<label for="telefono">Telefono</label>
				<input type="text" name="telefono" value="<?=$proveedor->telefono?>" required/>
				<label for="correo">Correo</label>
				<input type="email" name="correo" value="<?=$proveedor->correo?>" required/>
				<button type="submit" name="opcion" value="2">Modificar</button>
			</form>
		</div>
		
	</div>
	<?php Helper::borrarSesion("modificar_proveedor"); ?>
</body>
</html>