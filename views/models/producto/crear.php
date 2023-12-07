<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Crear Producto</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
	
		<div class="contenedor-formulario">
			<h1>Crear Producto</h1>
			<?php 
			if (isset($_SESSION["crear_producto"]) && $_SESSION["crear_producto"] == "Exitoso"): 
			?>
				<strong class="alerta alerta-verde">Producto creado exitosamente</strong>
			<?php 
			endif;
			?>
			
			<?php 
			if (isset($_SESSION["crear_producto"]) && $_SESSION["crear_producto"] == "Fallido"):
			?>
				<strong class="alerta alerta-roja">Error al crear el producto</strong>
			<?php 
			endif;
			?>
			<form action="<?=BASE_URL?>controllers/ProductoControlador.php" method="POST" enctype="multipart/form-data">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" required/>
				<label for="descripcion">Descripción</label>
				<textarea name="descripcion" required></textarea>
				<label for="precio">Precio</label>
				<input type="number" name="precio" min="500"/>
				<label for="stock">Stock</label>
				<input type="number" name="stock" min="1"/>
				<label for="categoria">Categoría</label>
				<select name="categoria">
				<?php 
				while ($categoria = $categorias->fetch_object()):
				?>
					<option value="<?=$categoria->id?>"><?=$categoria->nombre?></option>
				<?php 
				endwhile;
				?>
				</select>
				<label for="imagen">Imagen</label>
				<input type="file" name="imagen" required/>
				<button type="submit" name="opcion" value="1">Crear</button>
			</form>
		</div>
		
	</div>
	<?php Helper::borrarSesion("crear_producto"); ?>
</body>
</html>