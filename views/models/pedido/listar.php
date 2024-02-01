<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Listar Pedidos</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
	
		<div id="contenedorTablaPedidos" class="contenedor-paginacion-objetos">
		<?php 
		if ($paginadorHelper->mostrarDatos("tabla", "paginacion_pedido", array("ID", "Ciudad", "Comuna", "Calle", "Coste", "Estado", "Fecha", "Hora", "Usuario", "Acción 1")) === true): 
		?>
		<?php 
		elseif ($paginadorHelper->mostrarDatos("tabla", "paginacion_pedido", array("ID", "Ciudad", "Comuna", "Calle", "Coste", "Estado", "Fecha", "Hora", "Usuario", "Acción 1")) === "Pagina Inexistente"): 
		?>
			<h1 class="titulo-pagina-centrada">No se han encontrado resultados en esta página</h1>
		<?php 
		elseif ($paginadorHelper->mostrarDatos("tabla", "paginacion_pedido", array("ID", "Ciudad", "Comuna", "Calle", "Coste", "Estado", "Fecha", "Hora", "Usuario", "Acción 1")) === "Sin Registros"): 
		?>
			<h1 class="titulo-pagina-centrada">No hay pedidos</h1>
		<?php 
		endif;
		?>	
		</div>

		<div class="contenedor-paginacion-paginas">
			<?php $paginadorHelper->mostrarPaginas(BASE_URL . "Pedido/Listar"); ?>
		</div>
		
	</div>
</body>
</html>