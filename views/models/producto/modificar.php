<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Modificar Producto</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<?php $producto = $producto->fetch_object(); ?>
	
	<div class="contenido">
	
		<div class="contenedor-formulario">
			<h1>Modificar Producto</h1>
			<?php 
			if (isset($_SESSION["modificar_producto"]) && $_SESSION["modificar_producto"] == "Exitoso"): 
			?>
				<strong class="alerta alerta-verde">Producto modificado exitosamente</strong>
			<?php 
			endif;
			?>
			
			<?php 
			if (isset($_SESSION["modificar_producto"]) && $_SESSION["modificar_producto"] == "Fallido"):
			?>
				<strong class="alerta alerta-roja">Error al modificar el producto</strong>
			<?php 
			endif;
			?>
			<form action="<?=BASE_URL?>controllers/ProductoControlador.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?=$producto->id?>" readonly/>
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" value="<?=$producto->nombre?>" required/>
				<label for="descripcion">Descripción</label>
				<textarea name="descripcion"><?=$producto->descripcion?></textarea>
				<label for="precio">Precio</label>
				<input type="number" name="precio" value="<?=$producto->precio?>" min="500"/>
				<label for="stock">Stock</label>
				<input type="number" name="stock" value="<?=$producto->stock?>" min="1"/>
				<label for="categoria">Categoría</label>
				<select name="categoria">
				<?php 
				while ($categoria = $categorias->fetch_object()):
				?>
					<?php 
					if ($categoria->id == $producto->categoria_id):
					?>
						<option value="<?=$categoria->id?>" selected><?=$categoria->nombre?></option>
					<?php 
					else:
					?>
						<option value="<?=$categoria->id?>"><?=$categoria->nombre?></option>
					<?php 
					endif;				
					?>				
				<?php 
				endwhile;
				?>
				</select>
				<label for="imagen">Imagen</label>
				<input type="file" name="imagen"/>
				<div class="contenedor-modificar-imagen">
					<img src="<?=BASE_URL?>uploads/models/producto/images/<?=$producto->imagen?>"/>
				</div>
				<button type="submit" name="opcion" value="2">Modificar</button>
			</form>
		</div>
		
	</div>
	<?php Helper::borrarSesion("modificar_producto"); ?>
</body>
</html>