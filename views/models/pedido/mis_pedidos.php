<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<title>Mis Pedidos</title>
	<?php require_once 'views/includes/head_styles.php'; ?>
	<?php require_once 'views/includes/head_scripts.php'; ?>
	<?php require_once 'views/includes/head_random.php'; ?>
</head>
<body>
	<?php require_once 'views/includes/header.php'; ?>
	
	<div class="contenido">
	
		<div class="contenedor-pagina-centrada">
			<div class="contenedor-paginacion-objetos">
			<?php 
			if ($paginadorHelper->mostrarDatos("tabla", "paginacion_pedido", array("N° Pedido", "Coste", "Fecha", "Estado")) === true): 
			?>
			<?php 
			elseif ($paginadorHelper->mostrarDatos("tabla", "paginacion_pedido", array("N° Pedido", "Coste", "Fecha", "Estado")) === "Pagina Inexistente"): 
			?>
			<h1 class="titulo-pagina-centrada">No se han encontrado resultados en esta página</h1>
			<?php 
			elseif ($paginadorHelper->mostrarDatos("tabla", "paginacion_pedido", array("N° Pedido", "Coste", "Fecha", "Estado")) === "Sin Registros"): 
			?>
				<h1 class="titulo-pagina-centrada">No tienes pedidos</h1>
			<?php 
			endif;
			?>		
			</div>
	
			<div class="contenedor-paginacion-paginas">
				<?php $paginadorHelper->mostrarPaginas(BASE_URL . "Pedido/MisPedidos"); ?>
			</div>
		</div>
		
	</div>	
</body>
</html>