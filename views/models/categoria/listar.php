<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Listar Categorías</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
	
		<?php 
		if (isset($_SESSION["eliminar_categoria"]) && $_SESSION["eliminar_categoria"] == "Exitoso"): 
		?>
			<strong class="alerta alerta-verde">Categoría eliminada exitosamente</strong>
		<?php 
		elseif (isset($_SESSION["eliminar_categoria"]) && $_SESSION["eliminar_categoria"] == "Fallido"): 
		?>
			<strong class="alerta alerta-roja">Error al eliminar la categoría</strong>
		<?php 
		endif;
		?>
		<div class="contenedor-paginacion-objetos">
		<?php 
		if ($paginadorHelper->mostrarDatos("tabla", "paginacion_categoria", array("ID", "Nombre", "Acción 1", "Acción 2")) === true): 
		?>
		<?php 
		elseif ($paginadorHelper->mostrarDatos("tabla", "paginacion_categoria", array("ID", "Nombre", "Acción 1", "Acción 2")) === "Pagina Inexistente"): 
		?>
			<h1 class="titulo-pagina-centrada">No se han encontrado resultados en esta página</h1>
		<?php 
		elseif ($paginadorHelper->mostrarDatos("tabla", "paginacion_categoria", array("ID", "Nombre", "Acción 1", "Acción 2")) === "Sin Registros"): 
		?>
			<h1 class="titulo-pagina-centrada">No hay categorias</h1>
		<?php 
		endif;
		?>	
		</div>

		<div class="contenedor-paginacion-paginas">
			<?php $paginadorHelper->mostrarPaginas(BASE_URL . "Categoria/Listar"); ?>
		</div>
		
	</div>
	<?php Helper::borrarSesion("eliminar_categoria"); ?>
</body>
</html>