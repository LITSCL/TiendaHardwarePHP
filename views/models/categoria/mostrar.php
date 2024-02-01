<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mostrar Categoría</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
	
		<div class="contenedor-paginacion-objetos">
		<?php 
		if ($paginadorHelper->mostrarDatos("tarjeta", "paginacion_producto") === true): 
		?>
		<?php 
		elseif ($paginadorHelper->mostrarDatos("tarjeta", "paginacion_producto") === "Pagina Inexistente"): 
		?>
			<h1 class="titulo-pagina-centrada">No se han encontrado resultados en esta página</h1>
		<?php 
		elseif ($paginadorHelper->mostrarDatos("tarjeta", "paginacion_producto") === "Sin Registros"): 
		?>
			<h1 class="titulo-pagina-centrada">No hay productos</h1>
		<?php 
		endif;
		?>	
		</div>

		<div class="contenedor-paginacion-paginas">
			<?php $paginadorHelper->mostrarPaginas(BASE_URL . "Categoria/Mostrar"); ?>
		</div>
		
	</div>

</body>
</html>